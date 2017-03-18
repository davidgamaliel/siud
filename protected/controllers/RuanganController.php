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
			$model->attributes = $_POST['TranPeminjamanRuangan'];
			$thisDate = $model->tanggal_peminjaman;
			$model->tanggal_peminjaman = date('Y-m-d', strtotime($thisDate));
			$berkas = CUploadedFile::getInstance($model, 'nodin');
			$filename = 'pinjamruangan'.str_replace('/', '', $thisDate).''.$model->waktu_peminjaman.'.jpg';

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
		$provider = new CActiveDataProvider('TranPeminjamanRuangan', array(
			'sort'=>array(
				'defaultOrder'=>'tanggal_peminjaman DESC'
			)
		));

		$data['provider'] = $provider;
		$this->render('listPermohonan', $data);
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