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
        Yii::app()->user->setFlash('success','Perubahan status kartu berhasil disimpan');
        $model = new TrxPeminjamanKendaraanCustom();
        $this->render('listPermohonan', array(
           'model'=>$model
        ));
    }

    public function actionDetailPermohonan($id) {
        //tambahin logic mau load file apa
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk($id);
        $this->render('detailPermohonan', array(
            'model'=>$model
        ));
    }

    public function actionSetujuiPeminjaman() {
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->status = StatusPeminjaman::DISETUJUI;
        if($model->save()) {
            $result = array('status'=>'berhasil','id'=>$model->id);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal');
            echo CJSON::encode($result);
        }
    }

    public function actionTolakPeminjaman() {
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->status = StatusPeminjaman::DITOLAK;
        if($model->save()) {
            $result = array('status'=>'berhasil','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
    }
}