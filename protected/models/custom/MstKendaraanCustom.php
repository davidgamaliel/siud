<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 12:18 PM
 */
class MstKendaraanCustom extends MstKendaraan
{
    public function getNamakendaraan($id) {
        $model = MstKendaraan::model()->findByPk($id);
        return $model->nama;
    }
}