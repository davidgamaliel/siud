<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/23/2017
 * Time: 10:07 AM
 */
?>
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Tambah Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'tambah kendaraan',
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
                    <h5>Silakan isi form berikut untuk menambah daftar kendaraan yang dapat digunakan</h5>

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
                            <label class="col-sm-2 control-label">Nama Kendaraan</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'nama',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'nama', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Polisi</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'no_polisi',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model, 'no_polisi', array('class' => 'text-danger')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keterangan Tambahan</label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model,'keterangan',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

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
