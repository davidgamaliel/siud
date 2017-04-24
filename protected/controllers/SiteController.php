<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
	    $model = new MstKendaraanCustom;
		$setuju = array();
		$tolak = array();
		$proses = array();
		$data = array();
		$isPegawai = BLAuthorization::isPegawai();
		$isAdmin = BLAuthorization::isAdmin();
		$logicRuangan = new BLRuangan();
		if($isPegawai) {
			$provider = $logicRuangan->getAllRuangan();
			$data['provider'] = $provider;
		}
		if($isAdmin) {
			$kendaraan = new TrxPeminjamanKendaraanCustom();
			$today = (new DateTime())->setTimeZone(new DateTimeZone('Asia/Jakarta'));
			$ruangan = new CActiveDataProvider('TranPeminjamanRuangan', array(
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
			$allRuangan = array();
			$allApprovedRuangan = $logicRuangan->getAllApprovedRuangan();
			$allDataRuangan = $logicRuangan->getArrayAllRuangan();
			
			foreach ($allDataRuangan as $data) {
				$allRuangan[] = $data['nama'];
				$setuju[] = intval($logicRuangan->getJumlahRuanganSetuju($data['nama'])[0]['jumlah']);
				$tolak[] = intval($logicRuangan->getJumlahRuanganTolak($data['nama'])[0]['jumlah']);
				$proses[] = intval($logicRuangan->getJumlahRuanganProses($data['nama'])[0]['jumlah']);
			}
			$data['kendaraan'] = $kendaraan;
			$data['ruangan'] = $ruangan;
			$data['allRuangan'] = $allRuangan;
			
		}
		//var_dump($setuju);
		$data['setuju'] = $setuju;
		$data['tolak'] = $tolak;
		$data['proses'] = $proses;
		$data['isPegawai'] = $isPegawai;
		$data['isAdmin'] = $isAdmin;
		$data['model'] = $model;
		$this->render('index', $data);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		$this->layout = '//layouts/login-layout';
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->user->clearStates();
		$this->redirect(Yii::app()->homeUrl);
	}
}