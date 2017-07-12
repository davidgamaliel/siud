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
        	var_dump($_POST);
        	$success = $model->simpan($_POST['TranPerbaikanInventarisCustom']);
        	if($success) {
        		var_dump('Berhasil');
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
}