<?php

/**
 * BLAuthorization
 *
 * Class untuk menghandle business logic yang berkenaan dengan otentikasi dan otorisasi
 * @author Zaki Rahman <zaki@pusilkom.ui.ac.id>
 * @package model
 * @version 1.0
 */
class BLRuangan {

    private $password_iteration = 50;
    private $subtree = array();

    /**
     * authorize a user with his/her password
     * @param string the username to be authorized
     * @param string the password to be authorized
     */
    public function getRuanganDropdown() {
        $returnValue = array();

        $allRuangan = TmstRuangan::model()->findAll();
        if($allRuangan) {
            foreach ($allRuangan as $ruangan) {
                $returnValue[$ruangan->id] = $ruangan->nama;
            }
        }

        return $returnValue;
    }

    public function insertRuangan($data, $model) {

    }

    public function getStatusPermohonanDropdown() {
        $returnValue = array();

        $allStatus = TrefStatusPermohonan::model()->findAll();
        if($allStatus) {
            foreach ($allStatus as $status) {
                $returnValue[$status->id] = $status->nama;
            }
        }

        return $returnValue;
    }

    public function getListPeminjaman($id) {
        $today = new DateTime();
        $format = $today->format('d-m-y');
        $provider = new CActiveDataProvider('TranPeminjamanRuangan', array(
            'criteria'=>array(
                'condition'=>"status_id=1 AND waktu_awal_peminjaman >= to_timestamp('" . $format . "' , 'DD-MM-YY') AND id_ruangan = " . $id ."",
                'order'=>'waktu_awal_peminjaman DESC',
            ),
        ));

        return $provider;
    }

    public function getAllRuangan() {
        $today = new DateTime();
        $format = $today->format('d-m-y');
        $provider = new CActiveDataProvider('TmstRuangan', array(
            'sort'=>array(
                'defaultOrder'=>'nama'
            )
        ));

        return $provider;
    }

    public function istimeClashed($begin, $end, $idRuangan) {
        $result = false;
        $criteria = new CDbCriteria();
        $criteria->condition = "id_ruangan = :ruangan AND waktu_akhir_peminjaman > to_timestamp(:begin, 'DD-MM-YYYY hh24:mi') AND waktu_awal_peminjaman < to_timestamp(:end, 'DD-MM-YYYY hh24:mi')";
        $criteria->params = array(':begin'=>$begin, ':end'=>$end, ':ruangan'=>$idRuangan);
        $clashed = TranPeminjamanRuangan::model()->findAll($criteria);
        if($clashed && count($clashed) > 0) {
            $result = true;
        }
        return $result;
    }
        
}

?>