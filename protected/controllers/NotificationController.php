<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 7/11/2017
 * Time: 11:50 PM
 */
class NotificationController extends Controller
{
    public $layout = '//layouts/column2';

    public function actionGetNotificationPegawai() {
        $arr = array(
            "mobilSetuju" => TrxPeminjamanKendaraanCustom::TotalPeminjamanKendaraanByUser(intval(Yii::app()->user->getState('user_id')),1),
            "mobilTolak"=>TrxPeminjamanKendaraanCustom::TotalPeminjamanKendaraanByUser(intval(Yii::app()->user->getState('user_id')),2),
            "ruanganSetuju" => TranPeminjamanRuanganCustom::TotalPeminjamanRuanganByUser(intval(Yii::app()->user->getState('user_id')),1),
            "ruanganTolak" => TranPeminjamanRuanganCustom::TotalPeminjamanRuanganByUser(intval(Yii::app()->user->getState('user_id')),2),
        );
        echo json_encode($arr);
    }

    public function actionGetNotificationAdmin() {
        $arr = array(
            "mobilPersetujuan" => TrxPeminjamanKendaraanCustom::TotalPeminjamanKendaraanForAdmin(3),
            "ruanganPersetujuan" => TranPeminjamanRuanganCustom::TotalPeminjamanRuanganForAdmin(3),
        );
        echo json_encode($arr);
    }
}