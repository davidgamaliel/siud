<?php $this->pageTitle=Yii::app()->name; ?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Selamat Datang di <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h2>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php if($isPegawai): ?>
		<?php $this->renderPartial('/ruangan/ListPeminjaman', array('provider'=>$provider)) ?>
	<?php elseif($isAdmin): ?>
		<?php
			$this->Widget('ext.highcharts.HighchartsWidget', array(
			   'options'=>array(
			      'title' => array('text' => 'Fruit Consumption'),
			      'xAxis' => array(
			         'categories' => array('Apples', 'Bananas', 'Oranges')
			      ),
			      'yAxis' => array(
			         'title' => array('text' => 'Fruit eaten')
			      ),
			      'series' => array(
			         array('name' => 'Jane', 'data' => array(1, 0, 4)),
			         array('name' => 'John', 'data' => array(5, 7, 3))
			      )
			   )
			));
		?>
	<?php endif; ?>
</div>