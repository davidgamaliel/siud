<div class="row border-bottom white-bg dashboard-header">
    <div class="col--sm-8">
        <h2>Detail Permohonan Peminjaman Kendaraan</h2>
        <?php
        $this->breadcrumbs=array(
            'Detail pinjam Kendaraan',
        );
        ?>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Mulai Peminjaman</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo$model->waktu_mulai; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Selesai Peminjaman</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo$model->waktu_selesai; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Polisi</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo$model->no_polisi; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kendaraan</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo MstKendaraanCustom::getNamakendaraan($model->kendaraan_id) ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">kegiatan</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->kegiatan ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dukungan Supir</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->supir ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nodin yang Diunggah</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->nodin ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?php echo CHtml::link('Kembali',array('peminjamanKendaraan/listPermohonan'),array('class'=>'btn btn-primary')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>