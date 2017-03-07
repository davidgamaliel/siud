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
		<!--JQUERY-->
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php $logoimg = CHtml::image( Yii::app()->request->baseUrl.'/images/papua/logo83.png'); ?>
<?php $logoimg80 = CHtml::image( Yii::app()->request->baseUrl.'/images/papua/logo80.png'); ?>
<body>
	<div id="wrapper">
		<!--sidebar start-->
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<?php $this->widget('zii.widgets.CMenu',array(
					'id'=>'side-menu',
					'items'=>array(
						array(
							'label'=>'<div class="dropdown profile-element">
                            <span class="clear">
								<span class="block m-t-xs">
									<div class="logo font-bold">'.$logoimg.'</div>
								</span>
							</span>
                        </div>
                        <div class="logo-element">
                            '.$logoimg80.'
                        </div>',
							'itemOptions'=>array('class'=>'nav-header')
						),
						//main side-menu starts here
						array('label'=>'<i class="fa fa-home"></i> <span class="nav-label">Beranda</span>', 'url'=>array('/site/index')),
						array('label'=>'<i class="fa fa-black-tie"></i> <span class="nav-label">Peran</span> <span class="fa arrow"></span>', 'url'=>array('#'),
							'items'=>array(
								array('label'=>'<i class="fa fa-eye"></i> <span class="nav-label">Lihat Peran</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Tambah Peran</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-pencil"></i> <span class="nav-label">Ubah Peran</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-trash"></i> <span class="nav-label">Hapus Peran</span>', 'url'=>array('#')),
							),
							'visible'=>!Yii::app()->user->isGuest
						),
						array('label'=>'<i class="fa fa-group"></i> <span class="nav-label">Nasabah</span> <span class="fa arrow"></span>', 'url'=>array('#'),
							'items'=>array(
								array('label'=>'<i class="fa fa-eye"></i> <span class="nav-label">Lihat Nasabah</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Tambah Nasabah</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-pencil"></i> <span class="nav-label">Ubah Nasabah</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-trash"></i> <span class="nav-label">Hapus Nasabah</span>', 'url'=>array('#')),
							),
							'visible'=>!Yii::app()->user->isGuest
						),
						array('label'=>'<i class="fa fa-building"></i> <span class="nav-label">Cabang</span> <span class="fa arrow"></span>', 'url'=>array('#'),
						'items'=>array(
							array('label'=>'<i class="fa fa-eye"></i> <span class="nav-label">Lihat Cabang</span>', 'url'=>array('#')),
							array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Tambah Cabang</span>', 'url'=>array('#')),
							array('label'=>'<i class="fa fa-pencil"></i> <span class="nav-label">Ubah Cabang</span>', 'url'=>array('#')),
							array('label'=>'<i class="fa fa-trash"></i> <span class="nav-label">Hapus Cabang</span>', 'url'=>array('#')),
						),
						'visible'=>!Yii::app()->user->isGuest
						),
						array('label'=>'<i class="fa fa-credit-card-alt"></i> <span class="nav-label">Tipe Kartu</span> <span class="fa arrow"></span>', 'url'=>array('#'),
							'items'=>array(
								array('label'=>'<i class="fa fa-eye"></i> <span class="nav-label">Lihat Tipe Kartu</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Tambah Tipe Kartu</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-pencil"></i> <span class="nav-label">Ubah Tipe Karatu</span>', 'url'=>array('#')),
								array('label'=>'<i class="fa fa-trash"></i> <span class="nav-label">Hapus Tipe Kartu</span>', 'url'=>array('#')),
							),
							'visible'=>!Yii::app()->user->isGuest
						),
					),
					'submenuHtmlOptions'=>array('class'=>'nav nav-second-level collapse'),
					'encodeLabel' => false,
					'htmlOptions' => array('class' => 'nav metismenu', 'id'=>'side-menu'),

				)); ?>
			</div>
		</nav><!--sidebar ends-->
		<!--page start-->
		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<!--top navbar start-->
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header hidden-lg hidden-md">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>''.Yii::app()->user->name.' ', 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'<i class="fa fa-sign-out"></i> Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						),
						'encodeLabel' => false,
						'htmlOptions' => array('class' => 'nav navbar-top-links navbar-right'),
					)); ?>
				</nav><!--top navbar ends-->
			</div>
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
</body>
</html>