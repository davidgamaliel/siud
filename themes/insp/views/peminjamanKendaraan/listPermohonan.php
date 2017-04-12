<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Permohonan Peminjaman Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar permohonan peminjaman kendaraan',
    );
    ?>
</div>
<div class="row">
    <div class="alert alert-success alert-dismissable col-lg-12" id="peringatan1" style="display: none;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <b>Perhatian! </b>
        <p id="pesan_peringatan"></p>
    </div>
</div>
<div class="row">
    <div class="alert alert-success alert-dismissable col-lg-12" id="peringatan2" style="display: none;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <b>Perhatian! </b>
        <p id="pesan_peringatan"></p>
    </div>
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
                        'id'=>'list-peminjaman',
                        'dataProvider'=>$model->listPermohonan(),
                        'ajaxUpdate'=>true,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'name'=>'ID permohonan',
                                'value'=>'$data->id',
                                //'headerHtmlOptions'=>array('style'=>'display:none'),
                                //'htmlOptions'=>array('style'=>'display:none'),
                            ),
                            array(
                                'name'=>'kendaraan_id',
                                'value'=>'MstKendaraanCustom::getNamaKendaraan($data->kendaraan_id)',
                            ),
                            'waktu_mulai',
                            'waktu_selesai',
                            'supir',
                            'nodin',
                            array(
                                'name'=>'status',
                                'value'=>'StatusPeminjaman::getStatusPeminjaman($data->status)'
                            ),
                            array(
                                'header'=>'aksi',
                                'class'=>'CButtonColumn',
                                'template'=>'{detail} {setujui} {tolak}',
                                'buttons'=>array(
                                    'detail'=>array(
                                        'label'=>'<i class="fa fa-file-text-o"></i>',
                                        'options'=>array(
                                            'title'=>'Alokasi Stok Kartu',
                                            'class'=>'btn btn-sm btn-primary',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        'url'=>'Yii::app()->createUrl("peminjamanKendaraan/detailPermohonan", array("id"=>$data->id))',
                                        'visible'=>'true'
                                    ),
                                    'setujui'=>array(
                                        'label'=>'<i class="fa fa-check-square"></i>',
                                        'options'=>array(
                                            'title'=>'Alokasi Stok Kartu',
                                            'class'=>'btn btn-sm btn-success setujui',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        //'url'=>'Yii::app()->createUrl("cardOrder/cardInstantAllocation", array("id"=>$data->ID))',
                                        'visible'=>'true',
                                        'click' => "js:function(event){  
												event.preventDefault();
												var id_permintaan = $(this).parent().parent().children(':nth-child(2)').html()
												$('#modalCardNominative').modal('show');
												".CHtml::ajax(array(
                                                'url'=>Yii::app()->createUrl('peminjamanKendaraan/setujuiPeminjaman'),
                                                'type'=>'POST',
                                                'data'=>'js:{id: id_permintaan}',
                                                'dataType'=>'JSON',
                                                'success'=>"function(data){
                                                                    console.log('data terkirim');
                                                                    if(data['status']=='berhasil'){
                                                                        document.getElementById('pesan_peringatan').innerHTML = 'Permintaan dengan id = ' + data['id'] + ' , berhasil disetujui'
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }else{
                                                                         document.getElementById('pesan_peringatan').innerHTML = 'Permintaan dengan id = ' + data['id'] + ' , gagal disetujui'
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }
                                                                }"
                                            ))
                                            ."
										}"
                                    ),
                                    'tolak'=>array(
                                        'label'=>'<i class="fa fa-minus-square"></i>',
                                        'options'=>array(
                                            'title'=>'Alokasi Stok Kartu',
                                            'class'=>'btn btn-sm btn-danger tolak',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        //'url'=>'Yii::app()->createUrl("cardOrder/cardInstantAllocation", array("id"=>$data->ID))',
                                        'visible'=>'true',
                                        'click' => "js:function(event){  
												event.preventDefault();
												var id_permintaan = $(this).parent().parent().children(':nth-child(2)').html()
												console.log('id yang mau dirubah', id_permintaan)
												$('#modalCardNominative').modal('show');
											
												".CHtml::ajax(array(
                                                                'url'=>Yii::app()->createUrl('peminjamanKendaraan/tolakPeminjaman'),
                                                                'type'=>'POST',
                                                                'data'=>'js:{id: id_permintaan}',
                                                                'dataType'=>'JSON',
                                                                'success'=>"function(data){
                                                                    console.log('data terkirim');
                                                                    if(data['status']=='berhasil'){
                                                             
                                                                        document.getElementById('pesan_peringatan').innerHTML = 'Permintaan dengan id = ' + data['id'] + ' , berhasil ditolak'
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }else{
                                                                      
                                                                         document.getElementById('pesan_peringatan').innerHTML = 'Permintaan dengan id = ' + data['id'] + ' , gagal ditolak'
                                                                         $('#peringatan2').show();
                                                                         $('#peringatan1').hide();
                                                                         $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }
                                                                }"
                                            ))
                                            ."
										}"
                                    ),
                                )
                            )
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