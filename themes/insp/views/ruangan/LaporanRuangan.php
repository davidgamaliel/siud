<?php $this->pageTitle=Yii::app()->name; ?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Selamat Datang di <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h2>
	</div>
</div>

<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-ruangan',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
    )); 
?>

<div class="wrapper wrapper-content">
	<div>
		<form>
			<div class="form horizontal">
				<label class="col-sm-1" style="vertical-align: middle">Bulan</label>
				<div class="col-sm-2">
		            <?php echo CHtml::dropDownList('bulan', $bulan, $allBulan, array('class'=>'form-control m-b')); ?>
		        </div>
				<label class="col-sm-1  control-label">Tahun</label>
				<div class="col-sm-2">
		            <?php echo CHtml::dropDownList('tahun', $tahun, $allTahun, array('class'=>'form-control m-b')); ?>
		        </div>
		        <?php 
		        	echo CHtml::submitButton('Pilih', array('class'=>'btn btn-primary', 'name'=>'pilih')); 
		        	$this->endWidget();
		        ?> 
			</div>
		</form>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
			$this->widget('ext.highcharts.HighchartsWidget', array(
			    'scripts' => array(
			        'modules/exporting',
			        'themes/grid-light',
			    ),
			    'options' => array(
			        'title' => array(
			            'text' => 'Grafik Permohonan Ruangan '. $allBulan[$bulan] . ' '. $tahun,
			        ),
			        'xAxis' => array(
			        	'text' => 'Nama Ruangan',
			            'categories' => array('Ruangan'),
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
			        ),
			    )
			));
		?>
</div>