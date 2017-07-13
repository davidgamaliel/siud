<div class="row border-bottom white-bg dashboard-header">
    <div class="col--sm-8">
        <h2>Detail Laporan Permohonan Perbaikan Inventaris</h2>
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
                            <label class="col-sm-2 control-label">Waktu Pelaporan</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo TranPerbaikanInventarisCustom::tampilanTanggal($model->tanggal_laporan); ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Barang</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->inventaris->nama ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Divisi</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->divisi ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->jumlah ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <label class="form-control"><?php echo $model->deskripsi ; ?></label>
                                <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                            </div>
                        </div>
                        <?php if($model->status == StatusPeminjaman::DISETUJUI) {?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alasan Disetujui</label>
                                <div class="col-sm-10">
                                    <label class="form-control"><?php echo $model->alasan ; ?></label>
                                    <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                                </div>
                            </div>
                        <?php } else if ($model->status == StatusPeminjaman::DITOLAK){?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alasan Ditolak</label>
                                <div class="col-sm-10">
                                    <label class="form-control"><?php echo $model->alasan ; ?></label>
                                    <?php //echo $form->textField($model,'supir',array('class'=>'form-control')); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <!-- <?php// echo CHtml::link('Kembali',array('inventaris/listLaporanPerbaikan'),array('class'=>'btn btn-primary')); ?> -->
                                <?php if(BLAuthorization::isPegawai()) {
                                        echo CHtml::link('Kembali',array('inventaris/listPermohonanPegawai'),array('class'=>'btn btn-primary')); 
                                    } else {
                                        echo CHtml::link('Kembali',array('inventaris/listPermohonan'),array('class'=>'btn btn-primary')); 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>