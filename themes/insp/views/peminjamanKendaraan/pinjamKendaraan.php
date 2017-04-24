<?php
Yii::app()->clientScript->registerScript('search', "
$('#TrxPeminjamanKendaraanCustom_waktu_mulai').datetimepicker({
    useCurrent: false,
    format: 'DD/MM/YYYY H:mm'
});
$('#TrxPeminjamanKendaraanCustom_waktu_selesai').datetimepicker({
    useCurrent: false,
    format: 'DD/MM/YYYY H:mm'
});
$('#TrxPeminjamanKendaraanCustom_waktu_mulai').on(\"dp.change\",function (e) {
    $('#TrxPeminjamanKendaraanCustom_waktu_selesai').data(\"DateTimePicker\").minDate(e.date);
});
$('#TrxPeminjamanKendaraanCustom_waktu_selesai').on(\"dp.change\",function (e) {
    $('#TrxPeminjamanKendaraanCustom_waktu_mulai').data(\"DateTimePicker\").maxDate(e.date);
});
");
?>
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Form Permohonan Peminjaman Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'pinjam Kendaraan',
    );
    ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?php if (Yii::app()->user->hasFlash('success')) : ?>
            <div class="form-group">
                <div class="alert alert-success alert-dismissable col-md-12">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <b>Success! </b><?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('errors')) : ?>
            <div class="form-group">
                <div class="alert alert-danger alert-dismissable col-md-12">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <b>Error! </b><?php echo Yii::app()->user->getFlash('errors'); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Silakan isi form berikut untuk mengajukan peminjaman kendaraan</h5>

                </div>
                <div class="ibox-content">
                    <?php
                    $form = $this->beginWidget('CActiveForm',array(
                        'id' => 'upload-form',
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    echo "<pre>";var_dump($form->error)
                    ?>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Mulai Peminjaman</label>
                            <div class="col-sm-3" id="datetimepicker1">
                                <?php echo $form->textField($model,'waktu_mulai',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'waktu_mulai', array('class' => 'text-danger')); ?>
                            </div>
                            <label class="col-sm-1 control-label">s/d</label>
                            <label class="col-sm-2 control-label">Waktu Selesai Peminjaman</label>
                            <div class="col-sm-3" id="datetimepicker2">
                                <?php echo $form->textField($model,'waktu_selesai',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'waktu_selesai', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kendaraan</label>
                            <div class="col-sm-10">
                                <?php
                                $list = CHtml::listData($model_kendaraan,'id', function ($model_kendaraan) { return CHtml::encode($model_kendaraan->nama.' - '.$model_kendaraan->no_polisi);});
                                echo CHtml::dropDownList('TrxPeminjamanKendaraanCustom[kendaraan_id]','',$list,array('class'=>'form-control m-b'));
                                ?>
                                <?php echo $form->error($model, 'kendaraan_id', array('class' => 'text-danger')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kegiatan</label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model,'kegiatan',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dukungan Supir</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Upload Nodin</label>
                            <div class="col-sm-10">
                                <?php echo $form->fileField($model,'nodin',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'nodin', array('class' => 'text-danger')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?php echo CHtml::link('Kembali',Yii::app()->request->urlReferrer ,array('class' => 'btn btn-warning')); ?>
                                <?php echo CHtml::submitButton('Kirim', array('class' => 'btn btn-primary', 'name' => 'submit', 'id' => 'submit')); ?>
                            </div>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>