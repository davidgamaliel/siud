<?php

/**
 * Created by PhpStorm.
 * User: reals
 * Date: 3/12/2017
 * Time: 12:21 PM
 */
class StatusPeminjaman
{
    const MENUNGGU_PERSETUJUAN = 0 ;
    const DISETUJUI = 1;
    const DITOLAK = 99;

    public static function getStatusPeminjaman($kode) {
        $options = array(
            self::MENUNGGU_PERSETUJUAN => 'Menunggu Persetujuan',
            self::DISETUJUI => 'Disetujui',
            self::DITOLAK => 'Ditolak'
        );
        return strtoupper($options[$kode]);
    }
}