<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 12:21 PM
 */
class StatusPeminjaman
{
    const MENUNGGU_PERSETUJUAN = 3 ;
    const DISETUJUI = 1;
    const DITOLAK = 2;

    public static function getStatusPeminjaman($kode) {
        $options = array(
            self::MENUNGGU_PERSETUJUAN => 'Diproses',
            self::DISETUJUI => 'Disetujui',
            self::DITOLAK => 'Ditolak'
        );
        return strtoupper($options[$kode]);
    }
}