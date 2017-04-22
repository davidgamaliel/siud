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
				var_dump('Ruangan bentrok');
				die;
			}
			else {
				$model->waktu_awal_peminjaman = new CDbExpression("TO_TIMESTAMP(:mulai,'DD-MM-YYYY hh24:mi')", array(":mulai"=>$model->waktu_awal_peminjaman));
		        $model->waktu_akhir_peminjaman = new CDbExpression("TO_TIMESTAMP(:selesai,'DD-MM-YYYY hh24:mi')", array(":selesai"=>$model->waktu_akhir_peminjaman));
				$model->id_user_peminjam = Yii::app()->user->getState('user_id');
				$model->status_id = 3;
				$berkas = CUploadedFile::getInstance($model, 'nodin');
				$filename = 'pinjamruangan'.$today->format('THis').'.'.$berkas->getExtensionName();


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
					// var_dump($model->getErrors());
					// die();
				}
			}
		}

		$data['dropdownRuangan'] = $dropdownRuangan;
		$data['model'] = $model;
		$this->render('pinjamRuangan', $data);
	}

	public function actionListPermohonan() {
		$data = array();
		$model = new TranPeminjamanRuangan();
		$logic = new BLRuangan();
		$dropdownStatus = $logic->getStatusPermohonanDropdown();
		$provider = new CActiveDataProvider('TranPeminjamanRuangan', array(
			'sort'=>array(
				'defaultOrder'=>'waktu_awal_peminjaman'
			)
		));

		$data['status'] = '';
		$data['dropdownStatus'] = $dropdownStatus;
		$data['provider'] = $provider;
		$this->render('listPermohonan', $data);
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
		$this->render('listPeminjaman', $data);
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
		$this->render('detailRuanganPeminjaman', $data);
	}


	public function actionTambahRuangan() {
		$data = array();
		$model = new TmstRuangan();
		$logic = new BLRuangan();

		if(isset($_POST['TmstRuangan'])) {
			$result = $logic->insertRuangan($_POST['TmstRuangan'], $model);
		}

		$data['model'] = $model;
		$this->render('tambahRuangan', $data);
	}

	public function actionDaftarRuangan()
	{
		$data = array();
		$logic = new BLRuangan();
		$provider = $logic->getAllRuangan();

		$data['provider'] = $provider;
		$this->render('daftarRuangan', $data);
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
		$this->render('kelolaPermohonan', $data);
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