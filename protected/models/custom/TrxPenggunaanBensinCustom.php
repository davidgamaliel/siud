<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/21/2017
 * Time: 9:36 AM
 */
class TrxPenggunaanBensinCustom extends TrxPenggunaanBensin
{
    public function simpan($param) {
        $this->attributes = $param;
        $file = CUploadedFile::getInstance($this,'file_struk');
        if(!is_null($file)) {
            $file->saveAs(Yii::app()->basePath . '/data/struk_bensin/'.$file->name);
            $this->file_struk = $file->name;
        }
        if($this->validate())
            $this->save();
    }

    public function listLaporan() {
        $criteria = new CDbCriteria();
        return new CActiveDataProvider($this, array(
           'criteria'=> $criteria,
            'sort'=> array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public function riwayatPenggunaan() {
        $criteria = new CDbCriteria();
        $criteria->compare('"t".id_pemohon',Yii::app()->user->getState('user_id'));
        return new CActiveDataProvider($this, array(
            'criteria'=> $criteria,
            'sort'=> array(
                'defaultOrder'=>'id asc'
            )
        ));
    }

    public static function tampilanTanggal($tanggal) {
        $arrayBulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4=> 'April',
            5 => 'Mei',
            6=> 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        //echo "<pre>";var_dump($tanggal);die;
        if(!is_null($tanggal) & !empty($tanggal)) {
            $temp = explode(' ',$tanggal);
            $tempTanggal = explode('-',$temp[0]);
            return ''. $tempTanggal[2] . ' ' . $arrayBulan[intval($tempTanggal[1])]  . ' ' . $tempTanggal[0];
        }
        else {
            return '';
        }
    }
}