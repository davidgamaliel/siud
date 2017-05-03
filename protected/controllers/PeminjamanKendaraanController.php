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

    public function actionPinjamKendaraan() {
        $model = new TrxPeminjamanKendaraanCustom();
        $model_kendaraan = MstKendaraan::model()->findAll(array('condition'=>'ketersediaan = true','order'=>'id asc'));
        if(isset($_POST['TrxPeminjamanKendaraanCustom'])&& isset($_POST['submit'])) {
//            $file = CUploadedFile::getInstance($model,'nodin');
//            echo "<pre>";var_dump($file);die;
            $berhasil = $model->simpan($_POST['TrxPeminjamanKendaraanCustom']);
            if($berhasil) {
                Yii::app()->user->setFlash('success','Permohonan peminjaman berhasil dibuat');
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonan',array('id'=>$model->id)));
            }
            else {
                Yii::app()->user->setFlash('errors','Permohonan peminjaman gagal dibuat');
            }
        }
        $this->render('pinjamKendaraan', array(
            'model' => $model,
            'model_kendaraan'=>$model_kendaraan
        ));

    }

    public function actionPinjamKendaraanPegawai() {
        $model = new TrxPeminjamanKendaraanCustom();
        $model_kendaraan = MstKendaraan::model()->findAll(array('order'=>'id asc'));
        if(isset($_POST['TrxPeminjamanKendaraanCustom'])&& isset($_POST['submit'])) {
//            $file = CUploadedFile::getInstance($model,'nodin');
//            echo "<pre>";var_dump($file);die;
            $berhasil = $model->simpan($_POST['TrxPeminjamanKendaraanCustom']);
            if($berhasil) {
                Yii::app()->user->setFlash('success','Permohonan peminjaman berhasil dibuat');
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonanPegawai',array('id'=>$model->id)));
            }
            else {
                Yii::app()->user->setFlash('errors','Permohonan peminjaman gagal dibuat');
            }
        }
        $this->render('pinjamKendaraanPegawai', array(
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
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk($id);
        $this->render('detailPermohonan', array(
            'model'=>$model
        ));
    }

    public function actionDetailPermohonanPegawai($id) {
        //tambahin logic mau load file apa
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk($id);
        $this->render('detailPermohonanPegawai', array(
            'model'=>$model
        ));
    }

    public function actionSetujuiPeminjaman() {
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->status = StatusPeminjaman::DISETUJUI;
//        $model_kendaraan = MstKendaraanCustom::model()->findByPk($model->kendaraan_id);
//        $model_kendaraan->ketersediaan = false;
        if($model->save()) {
            $model_kendaraan->save();
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
//        $model_kendaraan = MstKendaraanCustom::model()->findByPk($model->kendaraan_id);
//        $model_kendaraan->ketersediaan = true;
        if($model->save()) {
            $model_kendaraan->save();
            $result = array('status'=>'berhasil','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
    }

    public function actionKelolaKendaraan() {
        $model = new MstKendaraanCustom;
        $this->render('kelolaKendaraan', array(
            'model'=>$model
        ));
    }

    public function actionEditkendaraan($id) {
        $model = MstKendaraanCustom::model()->findByPk($id);

        $this->render('editKendaraan', array(
           'model'=>$model
        ));
    }

    public function actionTambahKendaraan() {
        $model = new MstKendaraanCustom;

        if(isset($_POST['MstKendaraanCustom'])) {
            $berhasil = $model->simpanKendaraan($_POST['MstKendaraanCustom']);
            if($berhasil) {
                Yii::app()->user->setFlash('success','Kendaraan berhasil ditambahkan');
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/kelolaKendaraan'));
            }
            else {
                Yii::app()->user->setFlash('errors','Gagal menambahkan kendaraan');
            }
        }
        $this->render('tambahKendaraan', array(
           'model' => $model
        ));
    }

    public function actionStatusKendaraanTersedia() {
        $model = MstKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->ketersediaan = true;
        if($model->save()) {
            $result = array('status'=>'berhasil','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
    }

    public function actionStatusKendaraanTidakTersedia() {
        $model = MstKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->ketersediaan = false;
        if($model->save()) {
            $result = array('status'=>'berhasil','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
    }

     public function actionListPinjamKendaraan() {
        $model = new TrxPeminjamanKendaraanCustom();
        $this->render('listpinjamKendaraan', array(
            'model'=>$model
        ));
    }

    public function actionViewNodin($id)
    {
        $penggunaNodin = TrxPeminjamanKendaraan::model()->findByPk($id);
        if($penggunaNodin) {
            $imgName = $penggunaNodin->nodin;
            $split = explode('.', $imgName);
            $filepath = Yii::app()->basePath . '/data/nodin_kendaraan/' . $imgName;
            if(file_exists($filepath)) {
                if($split[count($split) - 1] == 'pdf') {
                    header("Content-type: application/pdf");
                    header('Content-Disposition: inline; filename="'.$imgName.'"');
                    $file = readfile($filepath);
                }
                else {
                    Yii::app()->getRequest()->sendFile($imgName, @file_get_contents($filepath), $split[count($split) - 1]);
                }
            }
        }

    }

    public function actionEditPermohonan($id) {
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk($id);
        $model_kendaraan = MstKendaraan::model()->findAll(array('condition'=>'ketersediaan = true','order'=>'id asc'));
        if(isset($_POST['TrxPeminjamanKendaraanCustom'])&& isset($_POST['submit'])) {
//            $file = CUploadedFile::getInstance($model,'nodin');
            $berhasil = $model->simpan($_POST['TrxPeminjamanKendaraanCustom']);
            if($berhasil) {
                Yii::app()->user->setFlash('success','Permohonan peminjaman berhasil dibuat');
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonan',array('id'=>$model->id)));
            }
            else {
                Yii::app()->user->setFlash('errors','Permohonan peminjaman berhasil dibuat');
            }
        }
        $this->render('pinjamKendaraan', array(
            'model' => $model,
            'model_kendaraan'=>$model_kendaraan
        ));

    }

    public function actionDetailKendaraanPeminjaman($id) {
        $model = new TrxPeminjamanKendaraanCustom();
        $this->render('detailKendaraanPeminjaman', array(
            'model' => $model,
            'id'=>$id
        ));
    }
}
