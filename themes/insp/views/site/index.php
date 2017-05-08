<?php $this->pageTitle=Yii::app()->name; ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Selamat Datang di <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h2>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php if($isPegawai): ?>
		<?php $this->renderPartial('/ruangan/ListPeminjaman', array('provider'=>$provider)) ?>
		<?php $this->renderPartial('/peminjamanKendaraan/listPeminjaman', array('model'=>$kendaraanCustom)) ?>
	<?php elseif($isAdmin): ?>

		<?php
			$this->widget('ext.highcharts.HighchartsWidget', array(
			    'scripts' => array(
			        'modules/exporting',
			        'themes/grid-light',
			    ),
			    'options' => array(
			        'title' => array(
			            'text' => 'Grafik Permohonan Ruangan ' . $bulan . ' - ' . $tahun,
			        ),
			        'xAxis' => array(
			        	'text' => 'Nama Ruangan',
			            'categories' => $allRuangan,
			        ),
			        'yAxis' => array(
			        	'text' => 'Jumlah Permohonan',
			        ),
			        'labels' => array(
			            'items' => array(
			                array(
			                    'html' => 'Jumlah Permohonan Ruangan',
			                    'style' => array(
			                        'left' => '50px',
			                        'top' => '18px',
			                        'color' => 'js:(Highcharts.theme && Highcharts.theme.textColor) || \'black\'',
			                    ),
			                ),
			            ),
			        ),
			        'series' => array(
			            array(
			                'type' => 'column',
			                'name' => 'Disetujui',
			                'data' => $setuju,
			            ),
			            array(
			                'type' => 'column',
			                'name' => 'Ditolak',
			                'data' => $tolak,
			            ),
			            array(
			                'type' => 'column',
			                'name' => 'Diproses',
			                'data' => $proses,
			            ),
			        ),
			    )
			));
		?>
        <?php
        $this->widget('ext.highcharts.HighchartsWidget', array(
            'scripts' => array(
                'modules/exporting',
                'themes/grid-light',
            ),
            'options' => array(
                'title' => array(
                    'text' => 'Grafik Permohonan Kendaraan ' . $bulan . ' - ' . $tahun,
                ),
                'xAxis' => array(
                    'text' => 'Nama Ruangan',
                    'categories' => $allKendaraan,
                ),
                'yAxis' => array(
                    'text' => 'Jumlah Permohonan',
                ),
                'labels' => array(
                    'items' => array(
                        array(
                            'html' => 'Jumlah Permohonan Kendaraan',
                            'style' => array(
                                'left' => '50px',
                                'top' => '18px',
                                'color' => 'js:(Highcharts.theme && Highcharts.theme.textColor) || \'black\'',
                            ),
                        ),
                    ),
                ),
                'series' => array(
                    array(
                        'type' => 'column',
                        'name' => 'Disetujui',
                        'data' => $setujuKendaraan,
                    ),
                    array(
                        'type' => 'column',
                        'name' => 'Ditolak',
                        'data' => $tolakKendaraan,
                    ),
                    array(
                        'type' => 'column',
                        'name' => 'Diproses',
                        'data' => $prosesKendaraan,
                    ),
                ),
            )
        ));
        ?>
	<?php endif; ?>
</div>
<?php if($isAdmin): ?>
<div>
	<?php $this->renderPartial('/ruangan/ListPermohonan', array('provider' => $ruangan)) ?>
</div>
<div>
	<?php $this->renderPartial('/peminjamanKendaraan/listPermohonan', array('model' => $kendaraan)) ?>
</div>
<?php endif;?>