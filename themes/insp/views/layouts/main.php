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
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/plugins/datetimepicker/datetimepicker.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/sources/css/plugins/dataTables/dataTables.bootstrap.css">
		<!--JQUERY-->
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php $logoimg = CHtml::image( Yii::app()->request->baseUrl.'/images/logo/siud-logo.png'); ?>
<?php $logoimg80 = CHtml::image( Yii::app()->request->baseUrl.'/images/logo/siud-logo.png'); ?>
<?php
$orderinfo = '';
if(BLAuthorization::isPegawai()) {
    $mobilSetuju = TrxPeminjamanKendaraanCustom::TotalPeminjamanKendaraanByUser(intval(Yii::app()->user->getState('user_id')),1);
    $mobilTolak = TrxPeminjamanKendaraanCustom::TotalPeminjamanKendaraanByUser(intval(Yii::app()->user->getState('user_id')),2);
    $ruanganSetuju= TranPeminjamanRuanganCustom::TotalPeminjamanRuanganByUser(intval(Yii::app()->user->getState('user_id')),1);
    $ruanganTolak=TranPeminjamanRuanganCustom::TotalPeminjamanRuanganByUser(intval(Yii::app()->user->getState('user_id')),2);
    $inventarisSetuju= TranPerbaikanInventarisCustom::TotalPelaporanPerbaikanInventarisByUser(intval(Yii::app()->user->getState('user_id')),1);
    $inventarisTolak=TranPerbaikanInventarisCustom::TotalPelaporanPerbaikanInventarisByUser(intval(Yii::app()->user->getState('user_id')),2);
    $iconmobil = '<i class="fa fa-car " aria-hidden="true"></i> &nbsp';
    $iconruangan = '<i class="fa fa-building " aria-hidden="true"></i> &nbsp';
    $iconinventaris = '<i class="fa fa-wrench " aria-hidden="true"></i> &nbsp';
    $iconmobilGagal ='<a href="'.Yii::app()->createUrl('peminjamanKendaraan/listpinjamKendaraan').'">'.'<span class="label label-danger" title="Jumlah peminjaman kendaraan yang ditolak" id="JumlahKendaraanDitolak">'.$mobilTolak.'</span> </a>  &nbsp';
    $iconmobilSetuju ='<a href="'.Yii::app()->createUrl('peminjamanKendaraan/listpinjamKendaraan').'">'.'<span class="label label-info" title="Jumlah peminjaman kendaraan yang disetujui" id="JumlahKendaraanDisetujui">'.$mobilSetuju.' </span> </a>&nbsp';
    $iconruanganGagal ='<a href="'.Yii::app()->createUrl('ruangan/kelolaPermohonan').'">'.'<span class="label label-danger" title="Jumlah peminjaman ruangan yang ditolak" id="JumlahRuanganDitolak">'.$ruanganTolak.' </span> </a>&nbsp';
    $iconruanganSetuju ='<a href="'.Yii::app()->createUrl('ruangan/kelolaPermohonan').'">'.'<span class="label label-info" title="Jumlah peminjaman ruangan yang disetujui" id="JumlahRuanganDisetujui">'.$ruanganSetuju.' </span> </a>&nbsp';
    $iconinventarisGagal = '<a href="'.Yii::app()->createUrl('inventaris/listPermohonanPegawai').'">'.'<span class="label label-danger" title="Jumlah pelaporan perbaikan inventaris yang ditolak" id="JumlahInventarisDitolak">'.$inventarisTolak.' </span> </a>&nbsp';
    $iconinventarisSetuju = '<a href="'.Yii::app()->createUrl('inventaris/listPermohonanPegawai').'">'.'<span class="label label-info" title="Jumlah pelaporan perbaikan inventaris yang disetujui" id="JumlahInventarisDisetujui">'.$inventarisSetuju.' </span> </a>&nbsp';

    $orderinfo = $iconruangan.$iconruanganSetuju.$iconruanganGagal.$iconmobil.$iconmobilSetuju.$iconmobilGagal.$iconinventaris.$iconinventarisGagal.$iconinventarisSetuju;
}
if(BLAuthorization::isAdmin()) {
    $mobilPeminjaman = TrxPeminjamanKendaraanCustom::TotalPeminjamanKendaraanForAdmin(3);
    $ruanganPeminjaman = TranPeminjamanRuanganCustom::TotalPeminjamanRuanganForAdmin(3);
    $inventarisPelaporan = TranPerbaikanInventarisCustom::TotalPelaporanPerbaikanInventarisForAdmin(3);
    $iconmobil = '<i class="fa fa-car " aria-hidden="true"></i> &nbsp';
    $iconruangan = '<i class="fa fa-building " aria-hidden="true"></i> &nbsp';
    $iconinventaris = '<i class="fa fa-wrench " aria-hidden="true"></i> &nbsp';
    $iconmobilPeminjaman ='<a href="'.Yii::app()->createUrl('peminjamanKendaraan/listPermohonan').'">'. '<span class="label label-info" title="Jumlah peminjaman kendaraan yang menunggu persetujuan" id="JumlahKendaraanmenungguPersetujuan">'.$mobilPeminjaman.' </span></a> &nbsp';
    $iconruanganPeminjaman = '<a href="'.Yii::app()->createUrl('ruangan/listPermohonan').'">'.'<span class="label label-info" title="Jumlah peminjaman ruangan yang menunggu persetujuan" id="JumlahRuanganmenungguPersetujuan">'.$ruanganPeminjaman.' </span></a> &nbsp';
    $iconinventarisPelaporan = '<a href="'.Yii::app()->createUrl('inventaris/listPermohonan').'">'.'<span class="label label-info" title="Jumlah pelaporan perbaikan inventaris yang menunggu persetujuan" id="JumlahPerbaikiInventarismenungguPersetujuan">'.$inventarisPelaporan.' </span></a> &nbsp';

    $orderinfo = $iconruangan.$iconruanganPeminjaman.$iconmobil.$iconmobilPeminjaman.$iconinventaris.$iconinventarisPelaporan;
}
//
?>
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
						array('label'=>'<i class="fa fa-building"></i> <span class="nav-label">Ruangan</span> <span class="fa arrow"></span>', 'url'=>'',
							'items'=>array(
								array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Form Peminjaman</span>', 'url'=>array('/ruangan/pinjamRuangan'),'visible'=>BLAuthorization::isPegawai() || BLAuthorization::isAdmin()),
								array('label'=>'<i class="fa fa-list"></i> <span class="nav-label">Daftar Permohonan</span>', 'url'=>array('/ruangan/listPermohonan'), 'visible'=> BLAuthorization::isAdmin()),
								array('label'=>'<i class="fa fa-list"></i> <span class="nav-label">Daftar Ruangan</span>', 'url'=>array('/ruangan/listPeminjaman'), 'visible'=> BLAuthorization::isPegawai()),
								array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Kelola Ruangan</span>', 'url'=>array('/ruangan/daftarRuangan'), 'visible'=> BLAuthorization::isAdmin()),
								array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Status Permohonan</span>', 'url'=>array('/ruangan/kelolaPermohonan'), 'visible'=> BLAuthorization::isPegawai()),
								array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Rekap</span>', 'url'=>array('/ruangan/laporanRuangan'), 'visible'=> BLAuthorization::isAdmin()),
							),
							'visible'=>!Yii::app()->user->isGuest
						),
						array('label'=>'<i class="fa fa-car"></i> <span class="nav-label">Kendaraan</span> <span class="fa arrow"></span>', 'url'=>'',
							'items'=>array(
								array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Form Peminjaman</span>', 'url'=>array('/peminjamanKendaraan/pinjamKendaraan'),'visible'=>BLAuthorization::isAdmin()),
								array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Form Peminjaman</span>', 'url'=>array('/peminjamanKendaraan/pinjamKendaraanPegawai'),'visible'=>BLAuthorization::isPegawai()),
                                array('label'=>'<i class="fa fa-list"></i> <span class="nav-label">Daftar Kendaraan</span>', 'url'=>array('/peminjamanKendaraan/listPeminjaman'), 'visible'=> BLAuthorization::isPegawai()),
								array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Status Permohonan</span>', 'url'=>array('/peminjamanKendaraan/listpinjamKendaraan'), 'visible'=> BLAuthorization::isPegawai()),
								array('label'=>'<i class="fa fa-list-ul"></i> <span class="nav-label">Daftar Permohonan</span>', 'url'=>array('/peminjamanKendaraan/listPermohonan'),'visible'=>BLAuthorization::isAdmin()),
                                array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Kelola Kendaraan</span>', 'url'=>array('/peminjamanKendaraan/kelolaKendaraan'), 'visible'=> BLAuthorization::isAdmin()),
                                array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Rekap</span>', 'url'=>array('/peminjamanKendaraan/laporanKendaraan'), 'visible'=> BLAuthorization::isAdmin()),
							),
							'visible'=>!Yii::app()->user->isGuest
						),
                        array('label'=>'<i class="fa fa-tachometer"></i> <span class="nav-label">Bensin</span> <span class="fa arrow"></span>', 'url'=>'',
                            'items'=>array(
                                array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Form Penggunaan Bensin</span>', 'url'=>array('/penggunaanBensin/penggunaanBensin'),'visible'=>BLAuthorization::isPegawai() || BLAuthorization::isAdmin()),
                                array('label'=>'<i class="fa fa-list"></i> <span class="nav-label">Riwayat Penggunaan Bensin</span>', 'url'=>array('/penggunaanBensin/riwayatPenggunaan'), 'visible'=> BLAuthorization::isPegawai()),
                                array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Rekap</span>', 'url'=>array('/penggunaanBensin/laporanBensin'), 'visible'=> BLAuthorization::isAdmin()),
                            ),
                            'visible'=>!Yii::app()->user->isGuest
                        ),
                        array('label'=>'<i class="fa fa-wrench"></i> <span class="nav-label">Perbaikan Inventaris</span> <span class="fa arrow"></span>', 'url'=>'',
                            'items'=>array(
                                array('label'=>'<i class="fa fa-plus"></i> <span class="nav-label">Form Perbaikan Barang</span>', 'url'=>array('/inventaris/laporPerbaikan'),'visible'=>BLAuthorization::isPegawai() || BLAuthorization::isAdmin()),
                                array('label'=>'<i class="fa fa-list-ul"></i> <span class="nav-label">Daftar Permohonan</span>', 'url'=>array('/inventaris/listPermohonan'),'visible'=>BLAuthorization::isAdmin()),
                                array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Status Permohonan</span>', 'url'=>array('/inventaris/listPermohonanPegawai'), 'visible'=> BLAuthorization::isPegawai()),
                                array('label'=>'<i class="fa fa-list-alt"></i> <span class="nav-label">Rekap</span>', 'url'=>array('/inventaris/laporanPerbaikanInventaris'), 'visible'=> BLAuthorization::isAdmin()),
                            ),
                            'visible'=>!Yii::app()->user->isGuest
                        ),
						/*array('label'=>'<i class="fa fa-black-tie"></i> <span class="nav-label">Peran</span> <span class="fa arrow"></span>', 'url'=>array('#'),
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
						),*/
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
                            array('label'=>$orderinfo, 'visible'=>!Yii::app()->user->isGuest),
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
				LEMSANEG &copy; 2017
			</div><!--footer ends-->
		</div><!--page ends-->
	</div><!--wrapper ends-->
	<!-- Mainly scripts -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/moment/moment.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/jquery-2.1.1.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Custom and plugin javascript -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/inspinia.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/pace/pace.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/clockpicker/clockpicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/datetimepicker/datetimepicker.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/dataTables/datatables.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/sources/js/plugins/dataTables/jquery.dataTables.js"></script>

    <?php $check = BLAuthorization::isPegawai();
    if($check){
        Yii::app()->clientScript->registerScript('beepBeep',"
			function getNotificationPegawai() {
				$.ajax({
					url : '".Yii::app()->createUrl('Notification/getNotificationPegawai')."',
					type : 'post',
					data : {'val1' : '123'},
					success : function(response) {
						var obj = jQuery.parseJSON(response);
						$('#JumlahKendaraanDitolak').html(obj['mobilTolak']);
						$('#JumlahKendaraanDisetujui').html(obj['mobilSetujui']);
						$('#JumlahRuanganDitolak').html(obj['ruanganTolak']);
						$('#JumlahRuanganDisetujui').html(obj['ruanganSetujui']);
					}
				});
			}
			getNotificationPegawai();
			setInterval(function(){getNotificationPegawai()},60000);
			
		");
    }
    else{

    }?>

    <?php $check = BLAuthorization::isAdmin();
    if($check){
        Yii::app()->clientScript->registerScript('beepBeep',"
			function getNotificationAdmin() {
				$.ajax({
					url : '".Yii::app()->createUrl('Notification/getNotificationAdmin')."',
					type : 'post',
					data : {'val1' : '123'},
					success : function(response) {
						var obj = jQuery.parseJSON(response);
						$('#JumlahKendaraanmenungguPersetujuan').html(obj['mobilPersetujuan']);
						$('#JumlahRuanganmenungguPersetujuan').html(obj['ruanganPersetujuan']);
					}
				});
			}
			getNotificationAdmin();
			setInterval(function(){getNotificationAdmin()},60000);
			
		");
    }
    else{

    }?>


</body>
</html>