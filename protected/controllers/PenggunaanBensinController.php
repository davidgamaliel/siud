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
            $model->simpan($_POST['TrxPenggunaanBensinCustom']);
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
}