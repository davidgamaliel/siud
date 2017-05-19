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
        $model->attributes = $data;
        if($model->validate()) {
            $model->save();
        }
        return $model;
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
        $stsSetuju = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Disetujui'));
        if($idRuangan == null || $idRuangan == '') {
            return false;
        }
        $criteria = new CDbCriteria();
        $criteria->condition = "id_ruangan = :ruangan AND status_id = :status AND waktu_akhir_peminjaman > to_timestamp(:begin, 'DD-MM-YYYY hh24:mi') AND waktu_awal_peminjaman < to_timestamp(:end, 'DD-MM-YYYY hh24:mi')";
        $criteria->params = array(':begin'=>$begin, ':end'=>$end, ':ruangan'=>$idRuangan, ':status'=>$stsSetuju->id);
        $clashed = TranPeminjamanRuangan::model()->findAll($criteria);
        if($clashed && count($clashed) > 0) {
            $result = true;
        }
        return $result;
    }

    public function viewNodinRuangan($id)
    {
        $peminjaman = TranPeminjamanRuangan::model()->findByPk($id);
        var_dump($peminjaman);

        if($peminjaman) {
            $imgName = $peminjaman->nodin;
            $filepath = Yii::app()->params['nodinRuangan'] . $imgName;
            if(file_exists($filepath)) {
                var_dump($filepath);
                /*header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $filepath . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($filepath));
                header('Accept-Ranges: bytes');*/
                header('Content-Disposition: attachment; charset=UTF-8; filename="'.$filepath.'"');
                $utf8_content = mb_convert_encoding($content, "SJIS", "UTF-8");
                echo $utf8_content;
                Yii::app()->end();

                //readfile($filepath);
            }
        }

    }

    public function getAllApprovedRuangan($begin=null, $end=null)
    {
        $sql = 'select tr.nama, count(tpr.id_ruangan)
                from tran_peminjaman_ruangan tpr 
                     left join tmst_ruangan tr on tr.id = tpr.id_ruangan
                     left join tref_status_permohonan tsp on tsp.id = tpr.status_id
                where tsp.nama = \'Disetujui\'';
        if($begin != null && $end != null) {
            $sql .= ' AND waktu_awal_peminjaman BETWEEN  to_timestamp(\'' . $begin . '\', \'YYYY-MM-DD\') AND to_timestamp(\'' . $end . '\', \'YYYY-MM-DD\')';
        }

        $sql .= ' group by tr.nama';
        $command = Yii::app()->db->createCommand($sql);

        $result = $command->queryAll();
        return $result;
    }

    public function getAllDisapprovedRuangan($begin=null, $end=null)
    {
        $sql = 'select tr.nama, count(tpr.id_ruangan)
                from tran_peminjaman_ruangan tpr 
                     left join tmst_ruangan tr on tr.id = tpr.id_ruangan
                     left join tref_status_permohonan tsp on tsp.id = tpr.status_id
                where tsp.nama = \'Ditolak\'';
        if($begin != null && $end != null) {
            $sql .= ' AND waktu_awal_peminjaman BETWEEN  to_timestamp(\'' . $begin . '\', \'YYYY-MM-DD\') AND to_timestamp(\'' . $end . '\', \'YYYY-MM-DD\')';
        }

        $sql .= ' group by tr.nama';
        $command = Yii::app()->db->createCommand($sql);

        $result = $command->queryAll();
        return $result;
    }

    public function getAllProcessedRuangan()
    {
        $sql = 'select tr.nama, count(tpr.id_ruangan)
                from tran_peminjaman_ruangan tpr 
                     left join tmst_ruangan tr on tr.id = tpr.id_ruangan
                     left join tref_status_permohonan tsp on tsp.id = tpr.status_id
                where tsp.nama = \'Diproses\'
                group by tr.nama';
        $command = Yii::app()->db->createCommand($sql);

        $result = $command->queryAll();
        return $result;
    }

    public function getAllPeminjamanByUserId($id)
    {
        $result = false;
        $statusProses = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Diproses'));
        $today = (new DateTime())->setTimeZone(new DateTimeZone('Asia/Jakarta'));
        $criteria = new CDbCriteria();
        //$criteria->condition = 'status_id = :status AND id_user_peminjam = :idUser AND waktu_awal_peminjaman > :waktuAwal';
        $criteria->condition = 'id_user_peminjam = :idUser';
        $criteria->order = 'waktu_awal_peminjaman DESC';
        //$criteria->params = array(':status'=>$statusProses->id, ':idUser'=>$id, ':waktuAwal'=>$today->format('Y-m-d H:i'));
        $criteria->params = array( ':idUser'=>$id);

        $provider = new CActiveDataProvider('TranPeminjamanRuangan', array(
            'criteria'=>$criteria,
        ));
        if($provider) {
            $result = $provider;
        }
        return $result;
    }

    public function getArrayAllRuangan()
    {
        $sql = 'select nama from tmst_ruangan order by nama';
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function getJumlahRuanganSetuju($ruangan, $begin=null, $end=null)
    {
        $sql = 'select count(tpr.id) as jumlah
                from tmst_ruangan tr left join tran_peminjaman_ruangan tpr on tr.id = tpr.id_ruangan
                where tpr.status_id = 1
                and tr.nama = \''.$ruangan.'\'';
        if($begin != null && $end != null) {
            $sql .= ' AND tpr.waktu_awal_peminjaman BETWEEN  to_timestamp(\'' . $begin . '\', \'YYYY-MM-DD\') AND to_timestamp(\'' . $end . '\', \'YYYY-MM-DD\')';
        }
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function getJumlahRuanganTolak($ruangan, $begin=null, $end=null)
    {
        $sql = 'select count(tpr.id) as jumlah
                from tmst_ruangan tr left join tran_peminjaman_ruangan tpr on tr.id = tpr.id_ruangan
                where tpr.status_id = 2
                and tr.nama = \''.$ruangan.'\'';
        if($begin != null && $end != null) {
            $sql .= ' AND tpr.waktu_awal_peminjaman BETWEEN  to_timestamp(\'' . $begin . '\', \'YYYY-MM-DD\') AND to_timestamp(\'' . $end . '\', \'YYYY-MM-DD\')';
        }
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function getJumlahRuanganProses($ruangan, $begin=null, $end=null)
    {
        $sql = 'select count(tpr.id) as jumlah
                from tmst_ruangan tr left join tran_peminjaman_ruangan tpr on tr.id = tpr.id_ruangan
                where tpr.status_id = 3
                and tr.nama = \''.$ruangan.'\'';
        if($begin != null && $end != null) {
            $sql .= ' AND tpr.waktu_awal_peminjaman BETWEEN  to_timestamp(\'' . $begin . '\', \'YYYY-MM-DD\') AND to_timestamp(\'' . $end . '\', \'YYYY-MM-DD\')';
        }
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function getArrayDataAllRuangan()
    {
        $setuju = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Disetujui'));
        $tolak = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Ditolak'));
        $proses = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Diproses'));
        $sql = 'select tr.nama,
                       count(tpr.id) as jumlah,
                       '.$setuju->id.' as status
                from tmst_ruangan tr left join tran_peminjaman_ruangan tpr on tr.id = tpr.id_ruangan
                where tpr.status_id = 1
                group by tr.nama
                union
                select tr.nama,
                       count(tpr.id) as jumlah,
                       '.$tolak->id.' as status
                from tmst_ruangan tr left join tran_peminjaman_ruangan tpr on tr.id = tpr.id_ruangan
                where tpr.status_id = 2
                group by tr.nama
                union
                select tr.nama,
                       count(tpr.id) as jumlah,
                       '.$proses->id.' as status
                from tmst_ruangan tr left join tran_peminjaman_ruangan tpr on tr.id = tpr.id_ruangan
                where tpr.status_id = 3
                group by tr.nama
                ';
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function getAllTahunPeminjaman()
    {
        $result = array();
        $sql = "select distinct to_char(waktu_awal_peminjaman, 'YYYY') as tahun
                from tran_peminjaman_ruangan";
        $command = Yii::app()->db->createCommand($sql);
        $tahun = $command->queryAll();
        if($tahun) {
            foreach ($tahun as $value) {
                $result[$value['tahun']] = $value['tahun'];
            }
        }
        return $result;
    }

    public function updateRuangan($data, $model) {
        $model->attributes = $data;
        if($model->validate()) {
            $model->update();
        }
        return $model;
    }

    public function formatedDatefromDb($timestamp) {
        $tanggalSplit = explode(' ', $timestamp);
        $date = explode('-', $tanggalSplit[0])[2] . '/' . explode('-', $tanggalSplit[0])[1] . '/' . explode('-', $tanggalSplit[0])[0];
        $time = explode(':', $tanggalSplit[1])[0] . ':' . explode(':', $tanggalSplit[1])[1];
        return $date . ' ' . $time;
    }
        
}

?>