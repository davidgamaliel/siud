<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 12:18 PM
 */
class MstKendaraanCustom extends MstKendaraan
{
    public static function getNamakendaraan($id) {
        $model = MstKendaraan::model()->findByPk($id);
        return $model->nama;
    }

    public function getAllKendaraan() {
        $criteria = new CDbCriteria;
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=> array(
                'defaultOrder'=>'nama asc'
            )
        ));
    }

    public function simpanKendaraan($param) {
        $this->attributues = $param;
        $this->save();
    }
}