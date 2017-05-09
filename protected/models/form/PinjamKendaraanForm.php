<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 5/8/2017
 * Time: 8:14 PM
 */
class PinjamKendaraanForm extends CFormModel
{
    public $kendaraan_id;
    public $kegiatan;
    public $supir;
    public $waktu_mulai;
    public $waktu_selesai;
    public $nodin;
    public $id_peminjam;
    public $id;


    public function rules()
    {
        return array(
            array('kendaraan_id, waktu_mulai, waktu_selesai', 'required'),
            array('kendaraan_id, waktu_mulai, waktu_selesai, kegiatan, supir, nodin', 'safe'),
            array('waktu_mulai','validasiWaktuAwal'),
            array('waktu_selesai','validasiWaktuSelesai'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'waktu_mulai'=>'Waktu Awal Peminjaman',
            'waktu_selesai'=>'Waktu Selesai Peminjaman',
            'kendaraan_id'=>'Kendaraan',
            'kegiatan' => 'Deskripsi Kegiatan'
        );
    }

    public function validasiWaktuAwal($attr, $param) {
        if(!$this->hasErrors()) {
            $sql="
                select 
                      count(*) peminjaman
                from trx_peminjaman_kendaraan
                where 
                (waktu_mulai <= to_timestamp(:waktuAwal,'DD/MM/YYYY hh24:mi')  and waktu_selesai >= to_timestamp(:waktuAwal,'DD/MM/YYYY hh24:mi'))
                and status = 1
                and kendaraan_id = :id_kendaraan";
            if (!empty($this->id)|| !is_null($this->id)) {
                $sql .= " and id != ". $this->id;
            }
            $data = Yii::app()->db->createCommand($sql);
            $data->bindValue(':waktuAwal',$this->waktu_mulai);
            $data->bindValue(':id_kendaraan',$this->kendaraan_id);
            $rawData = $data->queryAll();
            $count = $rawData[0]['peminjaman'];
            if(intval($count) > 0 ) {
                $this->addError($attr, 'Sudah terdapat peminjaman kendaraan pada waktu mulai tersebut');
            }
        }
    }

    public function validasiWaktuSelesai($attr, $param) {
        if(!$this->hasErrors()) {
            $sql="
                select 
                      count(*) peminjaman
                from trx_peminjaman_kendaraan
                where 
                (waktu_mulai <= to_timestamp(:waktuAwal,'DD/MM/YYYY hh24:mi')  and waktu_selesai >= to_timestamp(:waktuAwal,'DD/MM/YYYY hh24:mi'))
                and status = 1
                and kendaraan_id = :id_kendaraan";
            if (!empty($this->id)|| !is_null($this->id)) {
                $sql .= " and id != ". $this->id;
            }
            $data = Yii::app()->db->createCommand($sql);
            $data->bindValue(':waktuAwal',$this->waktu_selesai);
            $data->bindValue(':id_kendaraan',$this->kendaraan_id);
            $rawData = $data->queryAll();
            $count = $rawData[0]['peminjaman'];
            if(intval($count) > 0 ) {
                $this->addError($attr, 'Sudah terdapat peminjaman kendaraan pada waktu selesai tersebut');
            }
        }
    }

    public function simpanPeminjamanKendaraan($param) {
        $this->attributes = $param;
        $this->kegiatan = $param['kegiatan'];
        $this->supir = $param['supir'];
        if($this->validate()) {
            $today = new DateTime();
            $model = new TrxPeminjamanKendaraanCustom();
            $model->waktu_mulai = new CDbExpression("TO_TIMESTAMP(:mulai,'DD-MM-YYYY hh24:mi')", array(":mulai"=>$this->waktu_mulai));
            $model->waktu_selesai = new CDbExpression("TO_TIMESTAMP(:selesai,'DD-MM-YYYY hh24:mi')", array(":selesai"=>$this->waktu_selesai));
            $model->status = StatusPeminjaman::MENUNGGU_PERSETUJUAN;
            $model->kendaraan_id = $this->kendaraan_id;
            $file = CUploadedFile::getInstance($this,'nodin');
            $model->peminjam = Yii::app()->user->getState('user_name');
            $model->id_peminjam = Yii::app()->user->getState('user_id');
            $model->kegiatan = $this->kegiatan;
            $model->supir = $this->supir;
            if(!is_null($file)) {
                //echo '<pre>';var_dump($file->name);die;
                $filename = 'pinjamkendaraan'.$today->format('THis').'.'.$file->getExtensionName();
                $file->saveAs(Yii::app()->basePath . '/data/nodin_kendaraan/'.$filename);
                $model->nodin = $filename;
            }
            if ($model->save()) {
                $this->id = $model->id;
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function loadPeminjamanModel($id) {
        $modelPeminjaman = TrxPeminjamanKendaraanCustom::model()->findByPk($id);
        $this->kendaraan_id = $modelPeminjaman->kendaraan_id;
        $this->kegiatan  = $modelPeminjaman->kegiatan;
        $this->supir = $modelPeminjaman->supir;
        $this->waktu_mulai = $modelPeminjaman->waktu_mulai;
        $this->waktu_selesai = $modelPeminjaman->waktu_selesai;
        $this->id = $modelPeminjaman->id;
    }

    public function updateFormPeminjaman($param) {
        $this->attributes = $param;
        $this->kegiatan = $param['kegiatan'];
        $this->supir = $param['supir'];
        if ($this->validate()) {
            $today = new DateTime();
            $model = TrxPeminjamanKendaraanCustom::model()->findByPk($this->id);
            $model->kendaraan_id = $this->kendaraan_id;
            $model->kegiatan = $this->kegiatan;
            $model->supir = $this->supir;
            $model->waktu_mulai = new CDbExpression("TO_TIMESTAMP(:mulai,'DD-MM-YYYY hh24:mi')", array(":mulai"=>$this->waktu_mulai));
            $model->waktu_selesai = new CDbExpression("TO_TIMESTAMP(:selesai,'DD-MM-YYYY hh24:mi')", array(":selesai"=>$this->waktu_selesai));
            $file = CUploadedFile::getInstance($this,'nodin');
            if(!is_null($file)) {
                $filename = 'pinjamkendaraan'.$today->format('THis').'.'.$file->getExtensionName();
                $file->saveAs(Yii::app()->basePath . '/data/nodin_kendaraan/'.$filename);
                $model->nodin = $filename;
            }
            $model->save();
            return true;
        } else {
            return false;
        }

    }
}