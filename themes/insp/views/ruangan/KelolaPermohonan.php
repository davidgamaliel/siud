<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/21/2017
 * Time: 10:05 AM
 */
?>
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Kelola Permohonan Peminjaman Ruangan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar laporan penggunaan bensin',
    );
    ?>
</div>
<div class="wrapper wrapper-content animate fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!-- <div class="ibox-title">
                    Daftar Peminjaman
                </div> -->
                <div class="ibox-content">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'list-permohonan-user',
                        'dataProvider'=>$provider,
                        'ajaxUpdate'=>false,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'header'=>'Ruangan',
                                'name'=>'id_ruangan',
                                'value'=>'$data->idRuangan->nama',
                            ),
                            array(
                                'header'=>'Waktu Awal Peminjaman',
                                'value'=>'$data->formatedWaktuMulai',
                            ),
                            array(
                                'header'=>'Waktu Akhir Peminjaman',
                                'value'=>'$data->formatedWaktuAkhir',
                            ),
                            array(
                                'header'=>'Kegiatan',
                                'value'=>'$data->kegiatan',
                            ),
                            array(
                                'header'=>'Nodin',
                                'value'=>'CHtml::link(
                                            \'nodin\',
                                            Yii::app()->createUrl(\'/ruangan/viewNodinRuangan\', array(\'id\' => $data->id)) ,
                                            array(\'class\'=>\'button\',\'target\'=>\'_blank\'))',
                                'type'=>'raw',
                            ),
                            array(
                                'header'=>'Status',
                                'value'=>'$data->status->nama',
                            ),
                            array(
                                'header'=>'aksi',
                                'class'=>'CButtonColumn',
                                'template'=>'{ubah}',
                                'buttons'=>array(
                                    'ubah'=>array(
                                        'label'=>'<i class="fa fa-pencil-square-o"></i>',
                                        'options'=>array(
                                            'title'=>'Ubah',
                                            'class'=>'btn btn-sm btn-success',
                                        ),
                                        'url'=>'Yii::app()->createUrl("ruangan/ubahPermohonan", array("id"=>$data->id))',
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
