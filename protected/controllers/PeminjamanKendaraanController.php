<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 11:02 AM
 */
class PeminjamanKendaraanController extends Controller
{
    public $layout = '//layouts/column2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionPinjamKendaraan() {
        $model = new TrxPeminjamanKendaraanCustom();
        $model_kendaraan = MstKendaraan::model()->findAll(array('order'=>'id asc'));
        if(isset($_POST['TrxPeminjamanKendaraanCustom'])) {
//            $file = CUploadedFile::getInstance($model,'nodin');
//            echo "<pre>";var_dump($file);die;
            $model->simpan($_POST['TrxPeminjamanKendaraanCustom']);
        }
        $this->render('pinjamKendaraan', array(
            'model' => $model,
            'model_kendaraan'=>$model_kendaraan
        ));

    }

    public function actionlistPeminjaman() {
        $model = new TrxPeminjamanKendaraanCustom();
        $this->render('listPeminjaman', array(
            'model'=>$model
        ));
    }

    public function actionListPermohonan() {
        $model = new TrxPeminjamanKendaraanCustom();
        $this->render('listPermohonan', array(
           'model'=>$model
        ));
    }

    public function actionDetailPermohonan($id) {
        //tambahin logic mau load file apa
        $model = TrxPeminjamanKendaraan::model()->findByPk($id);
        $this->render('detailPermohonan', array(
            'model'=>$model
        ));
    }
}