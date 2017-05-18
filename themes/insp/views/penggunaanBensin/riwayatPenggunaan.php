<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 4/23/2017
 * Time: 12:19 PM
 */
?>
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Laporan Penggunaan Bensin</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'Riwayat Laporan Penggunaan Bensin',
    );
    ?>
</div>
<div class="wrapper wrapper-content animate fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Daftar Peminjaman
                </div>
                <div class="ibox-content">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'trx-card-order-custom-grid-instant',
                        'dataProvider'=>$model->riwayatPenggunaan(),
                        'ajaxUpdate'=>false,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'header'=>'Pemohon',
                                'name'=>'id_pemohon',
                                'value'=>'$data->id_pemohon == null ? "" : $data->idPemohon->username',
                            ),
                            'jabatan',
                            array(
                                'header'=>'Jumlah Bensin (liter)',
                                'value'=>'$data->jumlah_bensin'
                            ),
                            array(
                                'header'=>'Tanggal',
                                'value'=>'TrxPenggunaanBensinCustom::tampilanTanggal($data->tanggal)'
                            ),
                            array(
                                'header'=>'File Struk',
                                'name'=>'file_struk',
                                'value'=>'CHtml::link(
                                            $data->file_struk,
                                            Yii::app()->createUrl(\'/penggunaanBensin/viewStrukBensin\', array(\'id\' => $data->id)) ,
                                            array(\'class\'=>\'button\',\'target\'=>\'_blank\'))',
                                'type'=>'raw',

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

