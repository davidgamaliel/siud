<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/23/2017
 * Time: 8:16 AM
 */
?>
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Kendaraan Yang Dikelola</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar kendaraan',
    );
    ?>
</div>
<div class="wrapper wrapper-content animate fadeInRight">
    <div class="row">
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
                    Daftar Kendaraan Yang Dikelola
                </div>
                <div class="ibox-content">
                    <div align="right"><?php echo CHtml::link('Tambah Kendaraan', array('/peminjamanKendaraan/tambahKendaraan'), array('class'=>'btn btn-primary', 'align'=>'right')); ?></div>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'list-peminjaman',
                        'dataProvider'=>$model->getAllKendaraan(),
                        'ajaxUpdate'=>true,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'name'=>'ID permohonan',
                                'value'=>'$data->id',
                                'headerHtmlOptions'=>array('style'=>'display:none'),
                                'htmlOptions'=>array('style'=>'display:none'),
                            ),
                            array(
                                'name'=>'kendaraan',
                                'value'=>'$data->nama',
                            ),
                            array(
                                'name'=>'No Polisi',
                                'value'=>'$data->no_polisi',
                            ),
                            array(
                                'name'=>'Keterangan',
                                'value'=>'$data->keterangan',
                            ),
                            array(
                                'name'=>'Ketersediaan Kendaraan',
                                'value'=>'MstKendaraanCustom::tampilanKetersediaan($data->id)'
                            ),
                            array(
                                'header'=>'aksi',
                                'class'=>'CButtonColumn',
                                'template'=>'{ubah}',
                                'buttons'=>array(
                                    'ubah'=>array(
                                        'label'=>'<i class="fa fa-pencil"></i>',
                                        'options'=>array(
                                            'title'=>'Ubah',
                                            'class'=>'btn btn-sm btn-primary',
                                        ),
                                        'url'=>'Yii::app()->createUrl("peminjamanKendaraan/editKendaraan",array("id"=>$data->id))',
                                        'visible'=>'true'
                                    ),
                                )
                            ),
                            array(
                                'header'=>'Ubah Ketersediaan',
                                'class'=>'CButtonColumn',
                                'template'=>'{tersedia} {tidak_tersedia}',
                                'buttons'=>array(
                                    'tersedia'=>array(
                                        'label'=>'<i class="fa fa-check-square"></i>',
                                        'options'=>array(
                                            'title'=>'status menjadi tersedia',
                                            'class'=>'btn btn-sm btn-info tersedia',
                                        ),
                                        'visible'=>'true',
                                        'click' => "js:function(event){  
												event.preventDefault();
												var id_kendaraan = $(this).parent().parent().children(':nth-child(2)').html()
												console.log('ID KENDARAAN ', id_kendaraan);
												$('#modalCardNominative').modal('show');
											
												".CHtml::ajax(array(
                                                'url'=>Yii::app()->createUrl('peminjamanKendaraan/statusKendaraanTersedia'),
                                                'type'=>'POST',
                                                'data'=>'js:{id: id_kendaraan}',
                                                'dataType'=>'JSON',
                                                'success'=>"function(data){
                                                                    console.log('data terkirim');
                                                                    if(data['status']=='berhasil'){
                                                             
                                                                        document.getElementById('pesan_peringatan').innerHTML = 'Berhasil merubah status ketersediaan kendaraan menjadi tersedia'
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }else{
                                                                      
                                                                         document.getElementById('pesan_peringatan').innerHTML = 'Gagal merubah status ketersediaan kendaraan'
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
                                    'tidak_tersedia'=>array(
                                        'label'=>'<i class="fa fa-minus-square"></i>',
                                        'options'=>array(
                                            'title'=>'status menjadi tidak tersedia',
                                            'class'=>'btn btn-sm btn-danger tidak_tersedia',
                                        ),
                                        'visible'=>'true',
                                        'click' => "js:function(event){  
												event.preventDefault();
												var id_kendaraan = $(this).parent().parent().children(':nth-child(2)').html()
												$('#modalCardNominative').modal('show');
											
												".CHtml::ajax(array(
                                                'url'=>Yii::app()->createUrl('peminjamanKendaraan/statusKendaraanTidakTersedia'),
                                                'type'=>'POST',
                                                'data'=>'js:{id: id_kendaraan}',
                                                'dataType'=>'JSON',
                                                'success'=>"function(data){
                                                                    console.log('data terkirim');
                                                                    if(data['status']=='berhasil'){
                                                             
                                                                        document.getElementById('pesan_peringatan').innerHTML = 'Berhasil merubah status ketersediaan kendaraan menjadi tidak tersedia'
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }else{
                                                                      
                                                                         document.getElementById('pesan_peringatan').innerHTML = 'Gagal merubah status ketersediaan kendaraan'
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
                        'itemsCssClass' => 'table table-striped table-hover data_table_ruangan',
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
<script>
    $(document).ready(function(){
        $('.data_table_ruangan').DataTable({
            'info': false,
            dom: '<"html5buttons"Br>lTfgitp',
            buttons: [
            ]

        });
    });
</script>

