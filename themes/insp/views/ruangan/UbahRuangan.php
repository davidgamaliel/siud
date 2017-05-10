<div class="row  border-bottom white-bg dashboard-header">
	<div class="col-sm-8">
		<h2>Form Ubah Ruangan</h2>
	</div>
	<?php
		$this->breadcrumbs=array(
			'Ubah Ruangan',
		);
	?>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Silakan isi form berikut untuk menambahkan ruangan</h5>
                    
                </div>
                <div class="ibox-content">
                <?php
                    $form = $this->beginWidget('CActiveForm',array(
                            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                    ));
                ?>
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'nama'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model, 'nama', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'nama', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'lokasi'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model, 'lokasi', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'lokasi', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'fasilitas'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model, 'fasilitas', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'fasilitas', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'kapasitas'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->numberField($model, 'kapasitas', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'kapasitas', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?php echo CHtml::link('Kembali', array('/ruangan/daftarRuangan'), array('class'=>'btn btn-white')); ?>
                                <?php echo CHtml::submitButton('Kirim', array('class'=>'btn btn-primary')); ?> 
                                <!-- <button class="btn btn-primary" type="submit">Kirim</button> -->
                            </div>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>