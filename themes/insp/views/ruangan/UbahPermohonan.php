<?php
Yii::app()->clientScript->registerScript('search', "
$('#TranPeminjamanRuangan_waktu_awal_peminjaman').datetimepicker({
    format: 'DD/MM/YYYY H:mm'
});
$('#TranPeminjamanRuangan_waktu_akhir_peminjaman').datetimepicker({
    useCurrent: false,
    format: 'DD/MM/YYYY H:mm'
});
$('#TranPeminjamanRuangan_waktu_awal_peminjaman').on(\"dp.change\",function (e) {
    $('#TranPeminjamanRuangan_waktu_akhir_peminjaman').data(\"DateTimePicker\").minDate(e.date);
});
$('#TranPeminjamanRuangan_waktu_akhir_peminjaman').on(\"dp.change\",function (e) {
    $('#TranPeminjamanRuangan_waktu_awal_peminjaman').data(\"DateTimePicker\").maxDate(e.date);
});
");
?>
<div class="row  border-bottom white-bg dashboard-header">
	<div class="col-sm-8">
		<h2>Form Ubah Permohonan Peminjaman Ruangan</h2>
	</div>
	<?php
		$this->breadcrumbs=array(
			'pinjam Ruangan',
		);
	?>
</div>

<?php if(Yii::app()->user->hasFlash('warning')):?>
<div class="row">
    <div class="alert alert-warning alert-dismissable col-lg-12">
        <p><?php echo Yii::app()->user->getFlash('warning'); ?></p>
    </div>
</div>
<?php endif; ?>

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
                            <label class="col-sm-2 control-label">Waktu Mulai Peminjaman</label>
                            <div class="col-sm-3" id="datetimepicker1">
                                <?php echo $form->textField($model,'waktu_awal_peminjaman',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'waktu_awal_peminjaman', array('class' => 'text-danger')); ?>
                            </div>
                            <label class="col-sm-1 control-label">s/d</label>
                            <label class="col-sm-2 control-label">Waktu Selesai Peminjaman</label>
                            <div class="col-sm-3" id="datetimepicker2">
                                <?php echo $form->textField($model,'waktu_akhir_peminjaman',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'waktu_akhir_peminjaman', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'id_ruangan'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->dropDownList($model, 'id_ruangan', $dropdownRuangan, array('prompt'=>'Pilih Ruangan', 'class'=>'form-control m-b')); ?>
                                <?php echo $form->error($model, 'id_ruangan', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'kegiatan'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model, 'kegiatan', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'kegiatan', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'nodin'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->fileField($model, 'nodin', array('size'=>20));?>&nbsp;<i>Upload file dalam format JPG</i>
                                <?php echo $form->error($model, 'nodin', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <!-- <button class="btn btn-white" type="submit">Cancel</button> -->
                                <?php echo CHtml::link('Kembali',array('ruangan/kelolaPermohonan'), array('class'=>'btn btn-white')); ?>
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
