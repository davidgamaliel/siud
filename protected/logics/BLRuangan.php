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
        
}

?>