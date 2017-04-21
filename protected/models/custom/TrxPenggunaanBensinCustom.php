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
}