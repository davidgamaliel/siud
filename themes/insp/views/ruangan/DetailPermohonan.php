<div class="row border-bottom white-bg dashboard-header">
    <div class="col--sm-8">
        <h2>Detail Permohonan Peminjaman Ruangan</h2>
        <?php
        $this->breadcrumbs=array(
            'Detail pinjam Kendaraan',
        );
        ?>
    </div>
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
                    <h5></h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ruangan</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->namaRuangan; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Mulai Peminjaman</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->formatedWaktuMulai; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Waktu Selesai Peminjaman</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->formatedWaktuAkhir; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kegiatan</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->kegiatan ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->namaStatus ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nodin yang Diunggah</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo CHtml::link(
                                            $model->nodin,
                                            Yii::app()->createUrl('ruangan/viewNodinRuangan', array('id' => $model->id)) ,
                                            array('class'=>'button','target'=>'_blank')) ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <?php if(BLAuthorization::isPegawai() && $model->namaStatus == 'Disetujui'): ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alasan Disetujui</label>
                                <div class="col-sm-10">
                                    <label class="form-control"><?php echo $model->alasan ; ?></label>
                                </div>
                            </div>
                        <?php elseif(BLAuthorization::isPegawai() && $model->namaStatus == 'Ditolak'): ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alasan Ditolak</label>
                                <div class="col-sm-10">
                                    <label class="form-control"><?php echo $model->alasan ; ?></label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?php if(BLAuthorization::isPegawai()): ?>
                                    <?php echo CHtml::link('Kembali',array('ruangan/kelolaPermohonan'),array('class'=>'btn btn-primary')); ?>
                                <?php else: ?>
                                    <?php echo CHtml::link('Kembali',array('ruangan/listPermohonan'),array('class'=>'btn btn-primary')); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>