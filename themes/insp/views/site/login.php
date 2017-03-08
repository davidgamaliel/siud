<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
$logoimg = CHtml::image( Yii::app()->request->baseUrl.'/images/logo/logo.png','logo', array('class'=>'img-responsive', 'style'=>'width:55%;margin:0 auto;'));
?>
<div style="margin-bottom: 10px;"><?php echo $logoimg; ?></div>
<h2>Proyek Kami</h2>
<h3>Management Assets</h3>
<p>Please fill out the following form with your login credentials;</p>
<div class="m-t">
	<div class="form-group">
		<?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>'email@domain')); ?>
		<?php echo $form->error($model,'username', array('class'=>'label-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password', array('class'=>'label-danger')); ?>
	</div>
	<p class="text-muted text-center">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe', array('class'=>'text-danger')); ?>
	</p>
	<button type="submit" class="btn btn-success block full-width m-b">Login</button>
</div>
<?php $this->endWidget(); ?>