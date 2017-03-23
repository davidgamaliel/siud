<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!--INSPINIA shiz-->
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/animate.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/style.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/plugins/datapicker/bootstrap-datepicker.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/plugins/clockpicker/clockpicker.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/plugins/datetimepicker/bootstrap-material-datetimepicker.css">
		<!--JQUERY-->
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php $logoimg = CHtml::image( Yii::app()->request->baseUrl.'/images/logo/logo.png'); ?>
<?php $logoimg80 = CHtml::image( Yii::app()->request->baseUrl.'/images/logo/logo.png'); ?>
<body>
	<div id="wrapper">
		<!--page start-->
		<div id="page-wrapper" class="gray-bg">
		
			<?php echo $content; ?>
			<div class="footer small">
				PT. Artajasa Pembayaran Elektronis &copy; 2016
			</div><!--footer ends-->
		</div><!--page ends-->
	</div><!--wrapper ends-->
	<!-- Mainly scripts -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Custom and plugin javascript -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/inspinia.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/pace/pace.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/clockpicker/clockpicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/datetimepicker/bootstrap-material-datetimepicker.js"></script>
</body>
</html>