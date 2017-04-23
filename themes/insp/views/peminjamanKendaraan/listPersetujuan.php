<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Persetujuan Peminjaman Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar Persetujuan peminjaman kendaraan',
    );
    ?>
</div>
<div class="wrapper wrapper-content animate fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Daftar Persetujuan
                </div>
                <div class="ibox-content">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'trx-card-order-custom-grid-instant',
                        'dataProvider'=>$model->listPersetujuan(),
                        'ajaxUpdate'=>false,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'name'=>'kendaraan_id',
                                'value'=>'MstKendaraanCustom::getNamaKendaraan($data->kendaraan_id)',
                            ),
                            'tanggal_peminjaman',
                            'waktu_peminjaman',
                            'supir',
                            'nodin',
                            array(
                                'name'=>'status',
                                'value'=>'StatusPeminjaman::getStatusPeminjaman($data->status)'
                            ),

                            array(
    'class'=>'CButtonColumn',
    'template'=>'{view}{accept}{delete}',
    'buttons'=>array(
        'accept'=>array(
                'imageUrl'=>Yii::app()->request->baseUrl.'/images/check.png',                          
                'url' => 'Yii::app()->createUrl("/adsBanner/accept", array("id" => $data->id_ads_banner))',
                'options'=>array('confirm'=>'Are you sure want to approve?'),
                ),
         ),
)



                            // array(
                            //     'class'=>'CButtonColumn',
                            //     'template' => '{view}{accept}{pending}{cancel}{update}{delete}'
                            //     'button'=>array
                            //     (
                            //         'accept'=> array
                            //         (
                            //             'label'=>'Setujui',
                            //             'imageUrl'=>Yii::app()->basePath. '/images/konformasi/ok.png',
                            //         ),
                            //     ),
                            //     ),


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