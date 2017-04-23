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
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Daftar Kendaraan Yang Dikelola
                </div>
                <div class="ibox-content">
                    <div align="right"><?php echo CHtml::link('Tambah Kendaraan', array('/peminjamanKendaraan/tambahKendaraan'), array('class'=>'btn btn-primary', 'align'=>'right')); ?></div>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'trx-card-order-custom-grid-instant',
                        'dataProvider'=>$model->getAllKendaraan(),
                        'ajaxUpdate'=>false,
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
