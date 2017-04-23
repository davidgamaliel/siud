<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 12:18 PM
 */
class MstKendaraanCustom extends MstKendaraan
{

    public function rules()
    {
        $defaultRule = parent::rules();
        $newRule = array(
            array('no_polisi', 'uniqueNopol'),
        );

        return array_merge($defaultRule, $newRule);
    }

    public function uniqueNopol ($attribute) {
        if($this->isNewRecord){
            if(! $this->hasErrors()) {
                $count = self::model()->countByAttributes(array(
                   'no_polisi'=> $this->no_polisi
                ));
                if($count)
                    $this->addError($attribute, 'Nomor polisi sudah terdaftar pada kendaraan lain');
            }
        }
        else {
            $count = self::model()->countBySql('Select count(*) from mst_kendaraan where no_polisi = :nopol and id != :idEdit', array('nopol'=>$this->no_polisi, 'idEdit'=>$this->id));
            if ($count > 0)
                $this->addErrors($attribute, 'Nomor polisi sudah terdaftar pada kendaraan lain');
        }
    }

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
        $this->attributes = $param;
        if($this->validate()) {
            $this->save();
            return true;
        }
        else {
            return false;
        }
    }

    public static function tampilanKetersediaan($id) {
        $model = self::model()->findByPk($id);
        if($model->ketersediaan) {
            return "Tersedia";
        }
        else {
            return "Sedang digunakan";
        }
    }
}