<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Kelola Ruangan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar peminjaman ruangan',
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
                    <div align="right"><?php echo CHtml::link('Tambah Ruangan', array('/ruangan/tambahRuangan'), array('class'=>'btn btn-primary', 'align'=>'right')); ?></div>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'daftar_ruangan',
                        'dataProvider'=>$provider,
                        'ajaxUpdate'=>true,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'name'=>'ID Ruangan',
                                'value'=>'$data->id',
                                'headerHtmlOptions'=>array('style'=>'display:none'),
                                'htmlOptions'=>array('style'=>'display:none'),
                            ),
                            array(
                                'header'=>'Nama',
                                'value'=>'$data->nama',
                            ),
                            array(
                                'header'=>'Lokasi',
                                'value'=>'$data->lokasi',
                            ),
                            array(
                                'header'=>'Fasilitas',
                                'value'=>'$data->fasilitas',
                            ),
                            array(
                                'header'=>'Kapasitas',
                                'value'=>'$data->kapasitas',
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
                                        'url'=>'Yii::app()->createUrl("ruangan/ubahRuangan", array("id"=>$data->id))',
                                        'visible'=>'true'
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