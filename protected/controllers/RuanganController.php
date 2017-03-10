<?php

class RuanganController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPinjamRuangan() {
		$data = array();
		$logic = new BLRuangan();
		$model = new TranPeminjamanRuangan();


		$dropdownRuangan = $logic->getRuanganDropdown();

		$data['dropdownRuangan'] = $dropdownRuangan;
		$data['model'] = $model;
		$this->render('pinjamRuangan', $data);
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