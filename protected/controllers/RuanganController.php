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
			$logic->insertRuangan($_POST["TranPeminjamanRuangan"], $model);
			$model->attributes = $_POST['TranPeminjamanRuangan'];
			$model->id_user_peminjam = Yii::app()->user->getState('user_id');
			$model->status_id = 3;
			$thisDate = $model->tanggal_peminjaman;
			$model->tanggal_peminjaman = date('Y-m-d', strtotime($thisDate));
			$berkas = CUploadedFile::getInstance($model, 'nodin');
			$filename = 'pinjamruangan'.str_replace('/', '', $thisDate).'.jpg';


			if(is_object($berkas) && get_class($berkas) ==='CUploadedFile') {
				$model->nodin = $berkas;
				$model->nodin->saveAs(Yii::app()->params['nodinRuangan'].$filename);
				$model->nodin = $filename;
			}

			if($model->validate()) {
				$model->save();
				$this->redirect(array('ruangan/listPermohonan'));
			}
			else {
				var_dump($model->getErrors());
				die();
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
				'defaultOrder'=>'tanggal_peminjaman DESC'
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