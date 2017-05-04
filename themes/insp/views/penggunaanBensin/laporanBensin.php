<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 5/4/2017
 * Time: 8:50 PM
 */
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Laporan Penggunaan Bensin</h2>
    </div>
</div>

<div class="wrapper wrapper-content">
        <?php
        $this->widget('ext.highcharts.HighchartsWidget', array(
            'scripts' => array(
                'modules/exporting',
                'themes/grid-light',
            ),
            'options' => array(
                'title' => array(
                    'text' => 'Grafik Penggunaan Bensin',
                ),
                'xAxis' => array(
                    'text' => 'Nama Ruangan',
                    'categories' => $allBensin,
                ),
                'yAxis' => array(
                    'text' => 'Jumlah Penggunaan Bensin',
                ),
                'labels' => array(
                    'items' => array(
                        array(
                            'html' => 'Jumlah Penggunaan Bensin Per Bulan',
                            'style' => array(
                                'left' => '50px',
                                'top' => '18px',
                                'color' => 'js:(Highcharts.theme && Highcharts.theme.textColor) || \'black\'',
                            ),
                        ),
                    ),
                ),
                'series' => array(
                    array(
                        'type' => 'column',
                        'name' => 'Jumlah bensin(*dalam liter)',
                        'data' => $jumlahBensin,
                    ),
                ),
            )
        ));
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
                        'dataProvider'=>$model->listLaporan(),
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
                            'unit_kerja',
                            'keperluan',
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

