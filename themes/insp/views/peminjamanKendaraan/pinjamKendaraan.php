<?php
Yii::app()->clientScript->registerScript('search', "
$('#TrxPeminjamanKendaraanCustom_waktu_mulai').datetimepicker({
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
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Silakan isi form berikut untuk mengajukan peminjaman kendaraan</h5>

                </div>
                <div class="ibox-content">
                    <?php
                    $form = $this->beginWidget('CActiveForm');
                    ?>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Mulai Peminjaman</label>
                            <div class="col-sm-3" id="datetimepicker1">
                                <?php echo $form->textField($model,'waktu_mulai',array('class'=>'form-control')); ?>
                            </div>
                            <label class="col-sm-1 control-label">s/d</label>
                            <label class="col-sm-2 control-label">Waktu Selesai Peminjaman</label>
                            <div class="col-sm-3" id="datetimepicker2">
                                <?php echo $form->textField($model,'waktu_selesai',array('class'=>'form-control')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Polisi</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'no_polisi',array('class'=>'form-control')); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kendaraan</label>
                            <div class="col-sm-10">
                                <?php
                                $list = CHtml::listData($model_kendaraan,'id', function ($model_kendaraan) { return CHtml::encode($model_kendaraan->nama);});
                                echo CHtml::dropDownList('TrxPeminjamanKendaraanCustom_kendaraan_id','',$list,array('class'=>'form-control m-b'));
                                ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kegiatan</label>
                            <div class="col-sm-10">
                                <?php echo $form->textField($model,'kegiatan',array('class'=>'form-control')); ?>
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
                                <?php echo $form->textField($model,'nodin',array('class'=>'form-control')); ?>
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