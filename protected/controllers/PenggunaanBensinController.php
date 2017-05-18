<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/21/2017
 * Time: 9:34 AM
 */
class PenggunaanBensinController extends Controller
{
    public $layout = '//layouts/column2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionPenggunaanBensin() {
        $model = new TrxPenggunaanBensinCustom();
        if(isset($_POST['TrxPenggunaanBensinCustom'])) {
            $model->id_pemohon = Yii::app()->user->getState('user_id');
            if ($model->simpan($_POST['TrxPenggunaanBensinCustom'])) {
                if (Yii::app()->user->getState('role_id') == 1) {
                    Yii::app()->user->setFlash('success','Laporan penggunaan bensin berhasil ditambahkan');
                    $this->redirect(Yii::app()->createUrl('penggunaanBensin/laporanBensin'));
                }
                else {
                    Yii::app()->user->setFlash('success','Laporan penggunaan bensin berhasil ditambahkan');
                    $this->redirect(Yii::app()->createUrl('penggunaanBensin/riwayatPenggunaan'));
                }
            }
        }
        $this->render('penggunaanBensin', array(
           'model'=> $model
        ));
    }

    public function actionListPenggunaan() {
        $model = new TrxPenggunaanBensinCustom();
        $this->render('listPenggunaan', array(
           'model'=>$model
        ));
    }

    public function actionViewStrukBensin($id)
    {
        $penggunaBensin = TrxPenggunaanBensin::model()->findByPk($id);
        if($penggunaBensin) {
            $imgName = $penggunaBensin->file_struk;
            $split = explode('.', $imgName);
            $filepath = Yii::app()->basePath . '/data/struk_bensin/' . $imgName;
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

    public function actionRiwayatPenggunaan() {
        $model = new TrxPenggunaanBensinCustom;
        $this->render('riwayatPenggunaan', array(
            'model'=>$model
        ));
    }

    public function actionLaporanBensin() {
        $model = new TrxPenggunaanBensinCustom();
        $allWaktuPenggunaanBensin = $model->getAllBulanTahunPenggunaan();
        $allBensin = array();
        $allTahun = $model->getAllTahunPeminjaman();
        $allBulan = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
        $jumlahBensin = array();
        $tahun = Date('Y');
        if(isset($_POST['pilih'])) {
            $tahun = $_POST['tahun'];
        }
        $allDataDipilih = $model->getBulanAdaData($tahun);
        foreach ($allDataDipilih as $setiap) {
            $allBensin[] = $allBulan[$setiap['bulan']];
            $jumlahBensin[] = intval($model->getTotalPenggunaanBensinDalam1Bulan1Tahun($setiap['bulan'],$tahun)[0]['total']);
        }
//        foreach ($allWaktuPenggunaanBensin as $data) {
//            $allBensin[] = $data['stampel2'];
//            $jumlahBensin[] = intval($model->getTotalPenggunaanBensinDalam1Bulan($data['stampel'])[0]['total']);
//
//        }

        $this->render('laporanBensin', array(
            'tahun'=> $tahun,
            'model' => $model,
            'allBensin'=>$allBensin,
            'jumlahBensin'=>$jumlahBensin,
            'allTahun'=>$allTahun,
        ));
    }
}