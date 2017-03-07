<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/animate.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/style.css">
    <!--JQUERY-->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
		<div class="well-lg white-bg text-default">
			<?php echo $content; ?>
		</div>
        <hr/>
        <div class="text-center row small">
			PT. Artajasa Pembayaran Elektronis © 2016
		</div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/bootstrap.min.js"></script>
</body>
</html>

