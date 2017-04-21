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
}