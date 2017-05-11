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
        <h2>Rekap Penggunaan Bensin</h2>
    </div>
</div>

<div class="row">
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
</div>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'report-ruangan',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
));
?>

<div class="wrapper wrapper-content">
    <div>
        <form>
            <div class="form horizontal">
                <label class="col-sm-1  control-label">Tahun</label>
                <div class="col-sm-2">
                    <?php echo CHtml::dropDownList('tahun', $tahun, $allTahun, array('class'=>'form-control m-b')); ?>
                </div>
                <?php
                echo CHtml::submitButton('Pilih', array('class'=>'btn btn-primary', 'name'=>'pilih'));
                $this->endWidget();
                ?>
            </div>
        </form>
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
                    'text' => 'Grafik Total Harga Penggunaan Bensin',
                ),
                'xAxis' => array(
                    'text' => 'Per Bulan',
                    'categories' => $allBensin,
                ),
                'yAxis' => array(
                    'text' => 'Total Harga Penggunaan Bensin',
                ),
                'labels' => array(
                    'items' => array(
                        array(
                            'html' => 'Jumlah Pengeluaran Bensin Per Bulan',
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
                        'name' => 'Total Harga Bensin(*rupiah)',
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
                                'value'=>'$data->id_pemohon == null ? "" : $data->idPemohon->username',
                            ),
                            array(
                                'header'=>'Unit Kerja',
                                'value'=>'$data->unit_kerja'
                            ),
                            array(
                                'header'=>'Keperluan',
                                'value'=>'$data->keperluan'
                            ),
                            array(
                                'header'=>'Total Harga Penggunaan Bensin (*rupiah)',
                                'value'=>'$data->jumlah_bensin'
                            ),
                            array(
                                'header'=>'Tanggal',
                                'value'=>'TrxPenggunaanBensinCustom::tampilanTanggal($data->tanggal)'
                            ),
                            array(
                                'header'=>'File Struk',
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
                {extend: 'excel', title: 'Total Harga Penggunaan Bensin'},
                {extend: 'pdf', title: 'Total Harga Penggunaan Bensin'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });
    });
</script>

