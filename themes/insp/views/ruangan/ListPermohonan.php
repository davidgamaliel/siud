<?php
Yii::app()->clientScript->registerScript('search', "
$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('value') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body textarea').val(recipient)

  var element = document.getElementById('listStatus');
  listStatus.value = recipient;
})
");
?>


<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Permohonan Peminjaman Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar permohonan peminjaman ruangan',
    );
    ?>
</div>
<div class="wrapper wrapper-content animate fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Daftar Permohonan
                </div>
                <div class="ibox-content">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'trx-card-order-custom-grid-instant',
                        'dataProvider'=>$provider,
                        'ajaxUpdate'=>false,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'name'=>'Peminjam',
                                'value'=>'$data->id_user_peminjam != null ? $data->idUserPeminjam->username : ""',
                            ),
                            array(
                                'name'=>'Ruangan',
                                'value'=>'$data->id_ruangan != null ? $data->idRuangan->nama : ""',
                            ),
                            'tanggal_peminjaman',
                            array(
                                'header'=>'Waktu Peminjaman',
                                'name'=>'waktu_peminjaman',
                                'value'=>'$data->waktu_awal_peminjaman . " - " . $data->waktu_akhir_peminjaman',
                            ),
                            'kegiatan',
                            array(
                                'header'=>'Nodin',
                                'name'=>'nodin',
                                'value'=>'$data->nodin == null || $data->nodin == "" ? "Belum Upload" : "Sudah Upload"',
                            ),
                            array(
                                'header'=>'Status',
                                'class' => 'CButtonColumn',
                                'template'=>'{setuju}{tolak}{proses}',
                                'buttons'=>array(
                                    'setuju'=>array(
                                        'label'=>'Disetujui',
                                        'visible'=>'$data->status_id == 1',
                                        'url'=>'CHtml::normalizeUrl(array("/ruangan/ubahStatus", "id"=>$data->id))',
                                        'options'=>array(
                                            'class'=>'btn btn-primary btn-sm',
                                            'data-toggle'=>'modal',
                                            'data-target'=>'#myModal',
                                            'data-value'=>"1",
                                        ),
                                    ),
                                    'tolak'=>array(
                                        'label'=>'Ditolak',
                                        'visible'=>'$data->status_id == 2',
                                        'url'=>"CHtml::normalizeUrl('#')",
                                        'options'=>array(
                                            'class'=>'btn btn-danger btn-sm',
                                            'data-toggle'=>'modal',
                                            'data-target'=>'#myModal',
                                            'data-value'=>'2',
                                        ),
                                    ),
                                    'proses'=>array(
                                        'label'=>'Diproses',
                                        'visible'=>'$data->status_id == 3',
                                        'url'=>"CHtml::normalizeUrl('#')",
                                        'options'=>array(
                                            'class'=>'btn btn-warning btn-sm',
                                            'data-toggle'=>'modal',
                                            'data-target'=>'#myModal',
                                            'data-value'=>'3',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        'htmlOptions' => array(
                            'class' => 'table table-striped'
                        ),
                        'pager' => array(
                            'header' => '',
                            'prevPageLabel' =>'<i class="fa fa-angle-left"></i>',
                            'nextPageLabel' =>'<i class="fa fa-angle-right"></i>',
                            'firstPageLabel' =>'<i class="fa fa-angle-double-left"></i>',
                            'lastPageLabel' =>'<i class="fa fa-angle-double-right"></i>',
                            'cssFile' => false,
                            'htmlOptions' => array(
                                'class' => 'pagination',
                            ),
                        ),
                        'pagerCssClass' => 'blank',
                        'itemsCssClass' => 'table table-striped table-hover',
                        'cssFile' => false,
                        'summaryCssClass' => 'dataTables_info',
                        'summaryText' => Yii::t('form','Showing {start} to {end} of {count} entries'),
                        'template' => '{items}<div class="row"><div class="col-md-5 col-sm-12">{summary}</div><div class="col-md-7 col-sm-12">{pager}</div></div><br />',
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h4 class="modal-title">Beri Status Permohonan</h4>
                    <!-- <small class="font-bold">Beri atau ubah status permohonan peminjam. Harap sertakan alasan</small> -->
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label text-left">Status</label>

                        <div class="col-sm-10">
                            <?php echo CHtml::dropDownList('listStatus', $status, $dropdownStatus, array('class'=>'form-control m-b')); ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2">Alasan</label> 
                        <div class="col-md-10">
                            <textarea class="form-control textarea" rows="3" name="Message" id="Message" placeholder="Message"></textarea>    
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <p style="color:transparent">
                        test
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                    <?php echo CHtml::submitButton('Simpan', array('class'=>'btn btn-primary')); ?> 
                </div>
            </div>
        </div>
    </div>