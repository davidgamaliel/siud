<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 11:05 AM
 */
class TrxPeminjamanKendaraanCustom extends TrxPeminjamanKendaraan
{
    public $fileUpload;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $defaultRule = parent::rules();
        $newRule = array(
            array('kendaraan_id, peminjam, waktu_mulai, waktu_selesai, no_polisi', 'required')  ,
//            array('MIN_REQUEST','numerical','integerOnly'=>true,'min'=>1,'max'=>9999999),
            //array('MAX_REQUEST','notLessThanMin')
        );

        return array_merge($defaultRule, $newRule);
    }

    public function listPermohonan()
    {
        $criteria = new CDbCriteria;
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public function listPeminjaman() {
        $criteria = new CDbCriteria;
        $criteria->compare('status',array(0,1));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public function simpan($param) {
        $today = new DateTime();
        $this->attributes = $param;
        $this->waktu_mulai = new CDbExpression("TO_TIMESTAMP(:mulai,'DD-MM-YYYY hh24:mi')", array(":mulai"=>$this->waktu_mulai));
        $this->waktu_selesai = new CDbExpression("TO_TIMESTAMP(:selesai,'DD-MM-YYYY hh24:mi')", array(":selesai"=>$this->waktu_selesai));
        $this->status = StatusPeminjaman::MENUNGGU_PERSETUJUAN;
        $this->kendaraan_id = intval($this->kendaraan_id);
        $this->peminjam = Yii::app()->user->getState('user_name');
        $file = CUploadedFile::getInstance($this,'nodin');
        $filename = 'pinjamkendaraan'.$today->format('THis').'.'.$file->getExtensionName();
        $this->id_peminjam = Yii::app()->user->getState('user_id');
        if(!is_null($file)) {
            //echo '<pre>';var_dump($file->name);die;
            $file->saveAs(Yii::app()->basePath . '/data/nodin_kendaraan/'.$filename);
            $this->nodin = $filename;
        }
        if($this->validate()) {
            $this->save();
            return true;
        }
        else {
            return false;
        }
    }

    public function setujuiPeminjaman() {
        $this->status = StatusPeminjaman::DISETUJUI;
        if($this->save()) {
            $result = array('status'=>'berhasil','id'=>$this->id);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal');
            echo CJSON::encode($result);
        }
    }

    public function tolakPeminjaman() {
        $this->status = StatusPeminjaman::DITOLAK;
        if($this->save()) {
            $result = array('status'=>'berhasil','id'=>$this->id);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal');
            echo CJSON::encode($result);
        }
    }

    public function listPinjamKendaraan() {
        $criteria = new CDbCriteria;
        $criteria->compare('status',array(0,1));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public function listPermohonanUser()
    {
        $criteria = new CDbCriteria;
        $criteria -> compare('"t".id_peminjam',Yii::app()->user->getState('user_id'));

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id asc'
            )
        ));
    }  
}