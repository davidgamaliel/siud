<?php
Yii::app()->clientScript->registerScript('search', "
$('#TranPeminjamanRuangan_tanggal_peminjaman').datepicker({
    format: 'dd/mm/yyyy',
    parentEl: '#gofront'
});

$('#TranPeminjamanRuangan_waktu_peminjaman').clockpicker({
    autoclose: true,
    parentEl: '#gofront'
});
");
?>
<div class="row  border-bottom white-bg dashboard-header">
	<div class="col-sm-8">
		<h2>Form Permohonan Peminjaman Ruangan</h2>
	</div>
	<?php
		$this->breadcrumbs=array(
			'pinjam Ruangan',
		);
	?>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Silakan isi form berikut untuk mengajukan peminjaman ruangan</h5>
                    
                </div>
                <div class="ibox-content">
                <?php
                    $form = $this->beginWidget('CActiveForm',array(
                            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                    ));
                ?>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'tanggal_peminjaman'); ?></label>
                            <div class="input-group date col-sm-10" >
                            	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	 <?php echo $form->textField($model, 'tanggal_peminjaman', array('class'=>'form-control')); ?>
                                <!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="12/03/2017"> -->
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                        	<label class="col-sm-2 control-label"><?php echo $form->label($model, 'waktu_peminjaman'); ?></label>
                            <div class="col-sm-10">
                            	<!-- <input type="text" class="form-control"> -->
                            	<?php echo $form->textField($model, 'waktu_peminjaman', array('class'=>'form-control')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'id_ruangan'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->dropDownList($model, 'id_ruangan', $dropdownRuangan, array('prompt'=>'Pilih Ruangan', 'class'=>'form-control m-b')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kegiatan</label>
                            <div class="col-sm-10"><?php echo $form->textField($model, 'kegiatan', array('class'=>'form-control')); ?></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Upload Nodin</label>
                            <div class="col-sm-10">
                                <?php echo $form->fileField($model, 'nodin', array('size'=>20, 'class'=>'form-control'));?>&nbsp;<i>Upload file dalam format JPG</i>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
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
