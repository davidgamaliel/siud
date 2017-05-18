<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/21/2017
 * Time: 9:38 AM
 */
Yii::app()->clientScript->registerScript('search', "
$('#TrxPenggunaanBensinCustom_tanggal').datetimepicker({
    useCurrent: false,
    format: 'DD/MM/YYYY H:mm'
});
");
?>

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>laporan Penggunaan Bensin</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'laporan penggunaan bensin',
    );
    ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Silakan isi form berikut untuk laporan penggunaan bensin</h5>
                </div>
                <div class="ibox-content">
                    <?php
                    $form = $this->beginWidget('CActiveForm',array(
                        'id' => 'upload-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Penggunaan Bensin</label>
                            <div class="col-sm-3" id="datetimepicker1">
                                <?php echo $form->textField($model,'tanggal',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'tanggal', array('class' => 'text-danger')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jabatan</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'jabatan', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'jabatan', array('class'=>'text-daanger')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Total Pengeluaran Bensin (rupiah)</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'jumlah_bensin', array('class'=>'form-control', 'type'=>'number')); ?>
                                <?php echo $form->error($model,'jumlah_bensin', array('class'=>'text-daanger')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Struk Bensin</label>
                            <div class="col-sm-10">
                                <?php echo $form->fileField($model,'file_struk',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'file_struk', array('class' => 'text-danger')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
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
