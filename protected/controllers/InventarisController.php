<?php

class InventarisController extends Controller
{
    public $layout = '//layouts/column2';
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLaporPerbaikan()
	{
		$data = array();

		$model = new TranPerbaikanInventarisCustom();
        $model->unsetAttributes();
        $model_inventaris = TmstInventaris::model()->findAll(array('order'=>'id asc'));
        if(isset($_POST['TranPerbaikanInventarisCustom'])) {
        	$success = $model->simpan($_POST['TranPerbaikanInventarisCustom']);
        	if($success) {
                $this->redirect(array('inventaris/detailLaporan', 'id'=>$model->id));
        	}
        	//die();
        }
        /*//var_dump($model);
        var_dump('</ br>');
        var_dump($model_inventaris);
        die();*/
        $data['model'] = $model;
        $data['modelInventaris'] = $model_inventaris;
		$this->render('laporPerbaikan', $data);
	}

    public function actionListPermohonan()
    {
        $model = new TranPerbaikanInventarisCustom();
        /*echo "<pre>"; var_dump($model->listPermohonan()->getData());
        die();*/
        $this->render('listPermohonan', array(
           'model'=>$model
        ));
    }

    public function actionDetailLaporan()
    {
        $id = $_GET['id'];
        $model = TranPerbaikanInventarisCustom::model()->findByPk($id);
        /*echo "<pre>"; var_dump($model->listPermohonan()->getData());
        die();*/
        $this->render('detailLaporan', array(
           'model'=>$model
        ));
    }

    public function actionSetujuiPermohonan() {
        $model = TranPerbaikanInventarisCustom::model()->findByPk(intval($_POST['id'])); //TrxPeminjamanKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->status = StatusPeminjaman::DISETUJUI;
        $model->alasan = $_POST['alasan'];
        
        if($model->saveAttributes(array('status', 'alasan'))) {
            NotifikasiCustom::insertInventaris($model);
            $result = array('status'=>'berhasil','id'=>$model->id, 'message'=>'berhasil menyetujui permohonan');
            echo CJSON::encode($result);
        }
    }

    public function actionTolakPermohonan() {
        $model = TranPerbaikanInventarisCustom::model()->findByPk(intval($_POST['id'])); //TrxPeminjamanKendaraanCustom::model()->findByPk(intval($_POST['id']));
        $model->status = StatusPeminjaman::DITOLAK;
        $model->alasan = $_POST['alasan'];
        if($model->saveAttributes(array('status', 'alasan'))) {
            NotifikasiCustom::insertInventaris($model);
            $result = array('status'=>'berhasil','id'=>$_POST['id'],'message'=>'berhasil menolak permohonan');
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id'],'message'=>'gagal menolak permohonan');
            echo CJSON::encode($result);
        }
    }

    public function actionListPermohonanPegawai() {
        NotifikasiCustom::deleteNotifikasi(Yii::app()->user->getState('user_id'),'tran_perbaikan_inventaris');
        $model = new TranPerbaikanInventarisCustom();
        $this->render('listPermohonanPegawai', array(
            'model'=>$model
        ));
    }

    public function actionEditLaporan($id) {
        $data = array();
        $model_inventaris = TmstInventaris::model()->findAll(array('order'=>'id asc'));
        if($id) {
            $model = TranPerbaikanInventarisCustom::model()->findByPk($id);
            $date = explode('-', $model->tanggal_laporan)[2] . '/' . explode('-', $model->tanggal_laporan)[1] . '/' . explode('-', $model->tanggal_laporan)[0];

            $model->tanggal_laporan = $date . '00:00';
            $data['model'] = $model;
        }
        if(isset($_POST['TranPerbaikanInventarisCustom'])) {
            $success = $model->simpan($_POST['TranPerbaikanInventarisCustom']);
            if($success) {
                $this->redirect(array('inventaris/detailLaporan', 'id'=>$model->id));
            }
        }
       
        $data['modelInventaris'] = $model_inventaris;
        $this->render('laporPerbaikan', $data);

    }

    public function actionLaporanPerbaikanInventaris() {
        $model = new TranPerbaikanInventarisCustom(); //TrxPeminjamanKendaraanCustom();
        $allKendaraan = array();

        $tahun = Date('Y');
        $bulan = Date('m');
        $allTahun = $model->getAllTahunPeminjaman();
        $allBulan = $allBulan = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
        $setuju = array();
        $tolak = array();
        $proses = array();

        if(isset($_POST['pilih'])) {
            $tahun = $_POST['tahun'];
            $bulan = $_POST['bulan'];
        }

        $begin = Date($tahun.'-'.$bulan.'-'.'01');
        $end = Date($tahun.'-'.$bulan.'-'.'t');

//        $setuju = $model->getAllApprovedKendaraan($begin, $end);
//        if($setuju) $setuju = [intval($setuju[0]['count'])];
//        else $setuju = [0];
//
//        $tolak = $model->getAllDisapprovedKendaraan($begin, $end);
//        if($tolak) $tolak = [intval($tolak[0]['count'])];
//        else $tolak = [0];

        $allInventaris = array();
        $allDataInventaris = $model->getArrayAllInventaris();
        foreach ($allDataInventaris as $setiap) {
            $allInventaris[] = $setiap['nama'];
            $setuju[] = intval($model->getJumlahPerbaikanInventarisSetuju($setiap['nama'], $begin, $end)[0]['jumlah']);
            $tolak[] = intval($model->getJumlahPerbaikanInventarisDitolak($setiap['nama'], $begin, $end)[0]['jumlah']);
            $proses[] = intval($model->getJumlahPerbaikanInventarisDiproses($setiap['nama'], $begin, $end)[0]['jumlah']);
        }

        $dataList = $model->getDetailAllApprovedDisapprovedInventarisUntukLaporan($begin, $end);
        $this->render('laporanPerbaikanInventaris', array(
            'tahun' => $tahun,
            'bulan' => $bulan,
            'allTahun' => $allTahun,
            'allBulan' => $allBulan,
            'allInventaris' => $allInventaris,
            'setuju' => $setuju,
            'tolak' => $tolak,
            'provider' => $dataList,
            'allInventaris'=>$allInventaris,
            'setuju'=>$setuju,
            'tolak'=>$tolak,
            'proses'=>$proses,
        ));

    }
}