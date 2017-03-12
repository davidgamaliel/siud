<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 11:05 AM
 */
class TrxPeminjamanKendaraanCustom extends TrxPeminjamanKendaraan
{
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
}