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
        
}

?>