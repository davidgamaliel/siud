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
        $model = new PinjamKendaraanForm();
        $model->unsetAttributes();
        $model_kendaraan = MstKendaraan::model()->findAll(array('condition'=>'ketersediaan = true','order'=>'id asc'));
        if(isset($_POST['PinjamKendaraanForm'])&& isset($_POST['submit'])) {
            if($model->simpanPeminjamanKendaraan($_POST['PinjamKendaraanForm']))
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonan',array('id'=>$model->id)));
        }
        $this->render('pinjamKendaraanPegawai2', array(
            'model' => $model,
            'model_kendaraan'=>$model_kendaraan
        ));

    }

    public function actionPinjamKendaraanPegawai() {
        $model = new PinjamKendaraanForm();
        $model->unsetAttributes();
        $model_kendaraan = MstKendaraan::model()->findAll(array('order'=>'id asc'));
        if(isset($_POST['PinjamKendaraanForm'])&& isset($_POST['submit'])) {
            if($model->simpanPeminjamanKendaraan($_POST['PinjamKendaraanForm']))
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonanPegawai',array('id'=>$model->id)));
        }
        $this->render('pinjamKendaraanPegawai2', array(
            'model' => $model,
            'model_kendaraan'=>$model_kendaraan
    ));

    }

    public function actionPinjamKendaraanPegawai2() {
        $model = new PinjamKendaraanForm();
        $model->unsetAttributes();
        $model_kendaraan = MstKendaraan::model()->findAll(array('order'=>'id asc'));
        if(isset($_POST['PinjamKendaraanForm'])&& isset($_POST['submit'])) {
            if($model->simpanPeminjamanKendaraan($_POST['PinjamKendaraanForm']))
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonanPegawai',array('id'=>$model->id)));
        }
        $this->render('pinjamKendaraanPegawai2', array(
            'model' => $model,
            'model_kendaraan'=>$model_kendaraan
        ));

    }

    public function actionlistPeminjaman() {
        $model = new MstKendaraanCustom;
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
        $waktuMulai = TrxPeminjamanKendaraanCustom::validasiWaktuMulai(intval($_POST['id']));
        $waktuSelesai =TrxPeminjamanKendaraanCustom::validasiWaktuSelesai(intval($_POST['id']));
        if($waktuMulai && $waktuSelesai) {
            if($model->saveAttributes(array('status'))) {
                $result = array('status'=>'berhasil','id'=>$model->id, 'message'=>'berhasil menyetujui permohonan', 'waktuMulai'=>$waktuMulai, 'waktuSelesai'=>$waktuSelesai);
                echo CJSON::encode($result);
            }
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id'], 'message'=>'Sudah ada jadwal peminjaman yang disetujui pada waktu tersebut');
            echo CJSON::encode($result);
        }
    }

    public function actionTolakPeminjaman() {
        $model = TrxPeminjamanKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->status = StatusPeminjaman::DITOLAK;
        if($model->saveAttributes(array('status'))) {
            $result = array('status'=>'berhasil','id'=>$_POST['id'],'message'=>'berhasil menolak permohonan');
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id'],'message'=>'gagal menolak permohonan');
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
        $model = new PinjamKendaraanForm();
        $model->loadPeminjamanModel($id);
        $model_kendaraan = MstKendaraan::model()->findAll(array('condition'=>'ketersediaan = true','order'=>'id asc'));
        if(isset($_POST['PinjamKendaraanForm'])&& isset($_POST['submit'])) {
            if($model->updateFormPeminjaman($_POST['PinjamKendaraanForm'])) {
                Yii::app()->user->setFlash('success','Permohonan peminjaman berhasil diubah');
                $this->redirect(Yii::app()->createUrl('peminjamanKendaraan/detailPermohonanPegawai',array('id'=>$model->id)));
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
    public function actionLaporanKendaraan() {
        $model = new TrxPeminjamanKendaraanCustom();
        $allKendaraan = array();

        $tahun = Date('Y');
        $bulan = Date('m');
        $allTahun = $model->getAllTahunPeminjaman();
        $allBulan = $allBulan = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
        $setuju = array();
        $tolak = array();
        $proses = array();

        if(isset($_POST['pilih'])) {
            $tahun = $_POST['tahun'];
            $bulan = $_POST['bulan'];
        }

        $begin = Date($tahun.'-'.$bulan.'-'.'01');
        $end = Date($tahun.'-'.$bulan.'-'.'t');

//        $setuju = $model->getAllApprovedKendaraan($begin, $end);
//        if($setuju) $setuju = [intval($setuju[0]['count'])];
//        else $setuju = [0];
//
//        $tolak = $model->getAllDisapprovedKendaraan($begin, $end);
//        if($tolak) $tolak = [intval($tolak[0]['count'])];
//        else $tolak = [0];

        $allKendaraan = array();
        $allDataKendaraan = $model->getArrayAllKendaraan();
        foreach ($allDataKendaraan as $setiap) {
            $allKendaraan[] = $setiap['nama'];
            $setuju[] = intval($model->getJumlahKendaraanSetuju($setiap['nama'], $begin, $end)[0]['jumlah']);
            $tolak[] = intval($model->getJumlahKendaraanDitolak($setiap['nama'], $begin, $end)[0]['jumlah']);
            $proses[] = intval($model->getJumlahKendaraanDiproses($setiap['nama'], $begin, $end)[0]['jumlah']);
        }

        $dataList = $model->getDetailAllApprovedDisapprovedKendaraanUntukLaporan($begin, $end);
        $this->render('laporanKendaraan', array(
            'tahun' => $tahun,
            'bulan' => $bulan,
            'allTahun' => $allTahun,
            'allBulan' => $allBulan,
            'allKendaraan' => $allKendaraan,
            'setuju' => $setuju,
            'tolak' => $tolak,
            'provider' => $dataList,
            'allKendaraan'=>$allKendaraan,
            'setuju'=>$setuju,
            'tolak'=>$tolak,
            'proses'=>$proses,
        ));

    }
}
