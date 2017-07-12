
<?php
Yii::app()->clientScript->registerScript('search', "
$('#TranPerbaikanInventarisCustom_tanggal_laporan').datetimepicker({
    useCurrent: false,
    format: 'DD/MM/YYYY H:mm'
});
");
?>
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Form Pelaporan Perbaikan inventaris</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'Lapor Perbaikakn',
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
                    <h5>Silakan isi form berikut untuk mengajukan pelaporan perbaikan inventaris</h5>

                </div>
                <div class="ibox-content">
                    <?php
                    $form = $this->beginWidget('CActiveForm',array(
                        'id' => 'form-perbaikan-inventaris',
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Pelaporan</label>
                            <div class="col-sm-3" id="datetimepicker1">
                                <?php echo $form->textField($model,'tanggal_laporan',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'tanggal_laporan', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Barang</label>
                            <div class="col-sm-10">
                                <?php
                                $list = CHtml::listData($modelInventaris,'id', function ($modelInventaris) { return CHtml::encode($modelInventaris->nama);});
                                echo CHtml::dropDownList('TranPerbaikanInventarisCustom[inventaris_id]','',$list,array('class'=>'form-control m-b'));
                                ?>
                                <?php echo $form->error($model, 'inventaris_id', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Divisi</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'divisi',array('class'=>'form-control')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah</label>
                            <div class="col-sm-10">
                                <?php echo $form->numberField($model,'jumlah',array('class'=>'form-control')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model,'deskripsi',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <!-- <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kegiatan</label>
                            <div class="col-sm-10">
                                <?php //echo $form->textArea($model,'kegiatan',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dukungan Supir</label>
                            <div class="col-sm-10">
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Upload Nodin</label>
                            <div class="col-sm-10">
                                <?php //echo $form->fileField($model,'nodin'); ?><i>Upload file dalam format JPG</i>
                                <?php //echo $form->error($model, 'nodin', array('class' => 'text-danger')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> -->


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?php echo CHtml::link('Kembali',Yii::app()->request->urlReferrer ,array('class' => 'btn btn-white')); ?>
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