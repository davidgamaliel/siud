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
                    $form = $this->beginWidget('CActiveForm');
                ?>
                    <!-- <form class="form-horizontal"> -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $form->label($model, 'tanggal_peminjaman'); ?></label>
                            <div class="input-group date col-sm-10" data-provide="datepicker" >
                            	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	 <?php echo $form->textField($model, 'tanggal_peminjaman', array('class'=>'form-control datepicker')); ?>
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
                        
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo $form->label($model, 'id_ruangan'); ?></label>

                            <div class="col-sm-10">
                                <?php echo $form->dropDownList($model, 'id_ruangan', $dropdownRuangan, array('prompt'=>'Pilih Ruangan', 'class'=>'form-control m-b')); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Kegiatan</label>

                            <div class="col-sm-10"><input type="text" class="form-control"></div>
                        </div>
                        <!-- <div class="hr-line-dashed"></div> -->
                        <div class="form-group"><label class="col-sm-2 control-label">Upload Nodin</label>

                            <div class="col-sm-10"><input type="text" class="form-control"></div>
                        </div>
                        <!-- <div class="hr-line-dashed"></div> -->

                       
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </div>
                    <!-- </form> -->
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    Yii::app()->clientScript->registerScript('datepicker', "
        $('#TranPeminjamanRuangan_tanggal_peminjaman').datepicker({
          format: 'mm-dd-yyyy'
        });
        alert('tes');
    ");
?>
