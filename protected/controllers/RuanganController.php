<?php

class RuanganController extends Controller
{
    public $layout = '//layouts/column2';
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPinjamRuangan() {
		$data = array();
		$logic = new BLRuangan();
		$model = new TranPeminjamanRuangan();

		$dropdownRuangan = $logic->getRuanganDropdown();

		if(isset($_POST["TranPeminjamanRuangan"])) {
			/*var_dump($_POST["TranPeminjamanRuangan"]);
			die();*/
			// $logic->insertRuangan($_POST["TranPeminjamanRuangan"], $model);

			$model->attributes = $_POST['TranPeminjamanRuangan'];
			$today = new DateTime();
			$thisDate = $model->waktu_awal_peminjaman;
			$isClashed = $logic->istimeClashed($model->waktu_awal_peminjaman, $model->waktu_akhir_peminjaman, $model->id_ruangan);
			if($isClashed) {
				Yii::app()->user->setFlash('warning', 'Jadwal ruangan yang dipilih bentrok dengan jadwal yang sudah ada');
			}
			else {
				$mulai = $model->waktu_awal_peminjaman != null ? DateTime::createFromFormat('d/m/Y G:i', $model->waktu_awal_peminjaman) : false;
				$akhir = $model->waktu_akhir_peminjaman != null ? DateTime::createFromFormat('d/m/Y G:i', $model->waktu_akhir_peminjaman) : false;
				$model->waktu_awal_peminjaman = $mulai == false ? null : $mulai->format('Y-m-d H:i'); //new CDbExpression("TO_TIMESTAMP(:mulai,'DD-MM-YYYY hh24:mi')", array(":mulai"=>$model->waktu_awal_peminjaman));
		        $model->waktu_akhir_peminjaman = $akhir == false ? null : $akhir->format('Y-m-d H:i'); //new CDbExpression("TO_TIMESTAMP(:selesai,'DD-MM-YYYY hh24:mi')", array(":selesai"=>$model->waktu_akhir_peminjaman));
				$model->id_user_peminjam = Yii::app()->user->getState('user_id');
				$model->status_id = 3;
				$berkas = CUploadedFile::getInstance($model, 'nodin');
				if($berkas != null) {
					$filename = 'pinjamruangan'.$today->format('THis').'.'.$berkas->getExtensionName();
				}


				if(is_object($berkas) && get_class($berkas) ==='CUploadedFile') {
					$model->nodin = $berkas;
					$model->nodin->saveAs(Yii::app()->params['nodinRuangan'].$filename);
					$model->nodin = $filename;
				}

				if($model->validate()) {
					$model->save();
					$this->redirect(array('site/index'));
				}
				else {
					/*echo '<pre>' ; var_dump($model->getErrors());
					die();
*/				}
			}
		}

		$data['dropdownRuangan'] = $dropdownRuangan;
		$data['model'] = $model;
		$this->render('PinjamRuangan', $data);
	}

	public function actionListPermohonan() {
		$data = array();
		$model = new TranPeminjamanRuangan();
		$logic = new BLRuangan();
		$today = (new DateTime())->setTimeZone(new DateTimeZone('Asia/Jakarta'));
		$dropdownStatus = $logic->getStatusPermohonanDropdown();
		$provider = new CActiveDataProvider('TranPeminjamanRuangan', array(
			'criteria'=>array(
		        'condition'=>'waktu_awal_peminjaman > '. '\'' . $today->format('Y-m-d H:i') . '\'',
		    ),
			'sort'=>array(
				'defaultOrder'=>'waktu_awal_peminjaman'
			),
			'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		$data['status'] = '';
		$data['dropdownStatus'] = $dropdownStatus;
		$data['provider'] = $provider;
		$this->render('ListPermohonan', $data);
	}

	public function actionUbahStatus() {
		$data = array();
		$idPinjam = $_GET['id'];
		$ruanganPinjam = TranPeminjamanRuangan::model()->findByPk($idPinjam);

		$dropdownStatus = $logic->getStatusPermohonanDropdown();

		$pesan['pesan'] = $ruanganPinjam->keterangan;
		$data['status'] = $ruanganPinjam->status_id;
		$data['dropdownStatus'] = $dropdownStatus;
		echo $this->renderPartial('_ubahStatus', $data);
		// $this->render('_ubahStatus', $data);
	}

	public function actionSetujuiPeminjaman() {
        $model = TranPeminjamanRuangan::model()->findByPk(intval($_POST['id']));
        $model->status_id = 1;
        if($model->save()) {
            $result = array('status'=>'berhasil','id'=>$model->id);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal');
            echo CJSON::encode($result);
        }
    }

    public function actionTolakPeminjaman() {
        $model = TranPeminjamanRuangan::model()->findByPk(intval($_POST['id']));
        $model->status_id = 2;
        if($model->save()) {
            $result = array('status'=>'berhasil','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
        else {
            $result = array('status'=>'gagal','id'=>$_POST['id']);
            echo CJSON::encode($result);
        }
    }

    public function actionListPeminjaman() {
		$data = array();
		$model = new TranPeminjamanRuangan();
		$logic = new BLRuangan();
		$provider = $logic->getAllRuangan();

		$data['status'] = '';
		$data['provider'] = $provider;
		$this->render('ListPeminjaman', $data);
	}

	public function actionDetailRuanganPeminjaman() {
		$data = array();
		$model = new TranPeminjamanRuangan();
		$logic = new BLRuangan();
		$provider = $logic->getListPeminjaman($_GET['id']);
		$isEmpty = count($provider->getData()) <= 0 ? true : false;
		
		$data['isEmpty'] = $isEmpty;
		$data['status'] = '';
		$data['provider'] = $provider;
		$this->render('DetailRuanganPeminjaman', $data);
	}


	public function actionTambahRuangan() {
		$data = array();
		$model = new TmstRuangan();
		$logic = new BLRuangan();

		if(isset($_POST['TmstRuangan'])) {
			$result = $logic->insertRuangan($_POST['TmstRuangan'], $model);
		}

		$data['model'] = $model;
		$this->render('TambahRuangan', $data);
	}

	public function actionDaftarRuangan()
	{
		$data = array();
		$logic = new BLRuangan();
		$provider = $logic->getAllRuangan();

		$data['provider'] = $provider;
		$this->render('DaftarRuangan', $data);
	}

	public function actionViewNodinRuangan($id)
    {
        $peminjaman = TranPeminjamanRuangan::model()->findByPk($id);
        if($peminjaman) {
            $imgName = $peminjaman->nodin;
            $split = explode('.', $imgName);
            $filepath = Yii::app()->params['nodinRuangan'] . $imgName;
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

    public function actionKelolaPermohonan() {
		$data = array();
		$model = new TranPeminjamanRuangan();
		$logic = new BLRuangan();
		$userId = Yii::app()->user->getState('user_id');
		$provider = $logic->getAllPeminjamanByUserId($userId);

		$data['status'] = '';
		$data['provider'] = $provider;
		$this->render('KelolaPermohonan', $data);
	}

	public function actionLaporanRuangan() {
		$data = array();
		$model = new TranPeminjamanRuangan();
		$logic = new BLRuangan();
		$allRuangan = array();
		$statusApp = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Disetujui'));
		$statusDisApp = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Ditolak'));
		$statusProc = TrefStatusPermohonan::model()->findByAttributes(array('nama'=>'Diproses'));
		$setuju = array();
		$tolak = array();
		$proses = array();
		
		$tahun = Date('Y');
		$bulan = Date('m');
		$allTahun = $logic->getAllTahunPeminjaman();
		$allBulan = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];

		if(isset($_POST['pilih'])) {
			$tahun = $_POST['tahun'];
			$bulan = $_POST['bulan'];
		}
		
		$begin = Date($tahun.'-'.$bulan.'-'.'01');
		$end = Date($tahun.'-'.$bulan.'-'.'t');
		
		/*$setuju = $logic->getAllApprovedRuangan($begin, $end);
		if($setuju) $setuju = [intval($setuju[0]['count'])];
		else $setuju = [0];

		$tolak = $logic->getAllDisapprovedRuangan($begin, $end);
		if($tolak) $tolak = [intval($tolak[0]['count'])];
		else $tolak = [0];*/

		$allRuangan = array();
		$allApprovedRuangan = $logic->getAllApprovedRuangan($begin, $end);
		$allDataRuangan = $logic->getArrayAllRuangan();
		foreach ($allDataRuangan as $data) {
			$allRuangan[] = $data['nama'];
			$setuju[] = intval($logic->getJumlahRuanganSetuju($data['nama'], $begin, $end)[0]['jumlah']);
			$tolak[] = intval($logic->getJumlahRuanganTolak($data['nama'], $begin, $end)[0]['jumlah']);
			$proses[] = intval($logic->getJumlahRuanganProses($data['nama'], $begin, $end)[0]['jumlah']);
		}

		$mulai = DateTime::createFromFormat('d-m-Y', '01-'.$bulan.'-'.$tahun);
		$endString = $mulai->format('t').'-'.$bulan.'-'.$tahun;
		$akhir = DateTime::createFromFormat('d-m-Y', $endString);
		$condition = '(status_id = ' . $statusApp->id . ' OR status_id = ' . $statusDisApp->id . ' OR status_id = ' . $statusProc->id . ') AND waktu_awal_peminjaman BETWEEN \'' . $mulai->format('Y-m-d H:i') . '\' AND \'' . $akhir->format('Y-m-d H:i') . '\'';

		$provider = new CActiveDataProvider('TranPeminjamanRuangan', array(
			'criteria'=>array(
		        'condition'=> $condition,
		    ),
			'sort'=>array(
				'defaultOrder'=>'waktu_awal_peminjaman'
			),
			'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		$data['allRuangan'] = $allRuangan;
		$data['setuju'] = $setuju;
		$data['tolak'] = $tolak;
		$data['proses'] = $proses;
		$data['provider'] = $provider;
		$data['tahun'] = $tahun;
		$data['bulan'] = $bulan;
		$data['allTahun'] = $allTahun;
		$data['allBulan'] = $allBulan;
		$data['allRuangan'] = $allRuangan;
		$data['setuju'] = $setuju;
		$data['tolak'] = $tolak;
		$this->render('LaporanRuangan',  $data);
	}

	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}