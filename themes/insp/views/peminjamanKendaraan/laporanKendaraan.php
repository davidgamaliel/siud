<?php
/**
 * Created by PhpStorm.
 * User: reals
 * Date: 5/3/2017
 * Time: 10:14 PM
 */
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Selamat Datang di <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h2>
    </div>
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
                <label class="col-sm-1" style="vertical-align: middle">Bulan</label>
                <div class="col-sm-2">
                    <?php echo CHtml::dropDownList('bulan', $bulan, $allBulan, array('class'=>'form-control m-b')); ?>
                </div>
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
                'text' => 'Grafik Permohonan Kendaraan '. $allBulan[$bulan] . ' '. $tahun,
            ),
            'xAxis' => array(
                'text' => 'Nama Kendaraan',
                'categories' => array('Kendaraan'),
            ),
            'yAxis' => array(
                'text' => 'Jumlah Permohonan',
            ),
            'labels' => array(
                'items' => array(
                    array(
                        'html' => 'Jumlah Permohonan Kendaraan',
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
                    'name' => 'Disetujui',
                    'data' => $setuju,
                ),
                array(
                    'type' => 'column',
                    'name' => 'Ditolak',
                    'data' => $tolak,
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
                    Daftar Permohonan
                </div>
                <div class="ibox-content">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'list-permohonan-ruangan',
                        'dataProvider'=>$provider,
                        'ajaxUpdate'=>true,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'header'=>'ID permohonan',
                                'value'=>'$data["id"]',
                                'headerHtmlOptions'=>array('style'=>'display:none'),
                                'htmlOptions'=>array('style'=>'display:none'),
                            ),
                            array(
                                'name'=>'Nama Pemohon',
                                'value'=>'TmstUserCustom::namaPeminjamKendaraanByUserId($data["id_peminjam"])'
                            ),
                            array(
                                'header'=>'kendaraan_id',
                                'value'=>'MstKendaraanCustom::getNamaKendaraan($data["kendaraan_id"])',
                            ),
                            array(
                                'header'=>'Waktu Awal Peminjaman',
                                'value'=>'TrxPeminjamanKendaraanCustom::tampilanTanggal($data["waktu_mulai"])'
                            ),
                            array(
                                'header'=>'Waktu Akhir Peminjaman',
                                'value'=>'TrxPeminjamanKendaraanCustom::tampilanTanggal($data["waktu_selesai"])'
                            ),
                            array(
                                'header'=>'Supir',
                                'value'=>'$data["supir"]',
                            ),
                            array(
                                'header'=>'File Nodin',
                                'value'=>'CHtml::link(
                                            $data["nodin"],
                                            Yii::app()->createUrl(\'/peminjamankendaraan/viewNodin\', array(\'id\' => $data["id"])) ,
                                            array(\'class\'=>\'button\',\'target\'=>\'_blank\'))',
                                'type'=>'raw',
                            ),
                            array(
                                'header'=>'status',
                                'value'=>'StatusPeminjaman::getStatusPeminjaman($data["status"])'
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
                {extend: 'excel', title: 'Permohonan Peminjaman Kendaraan'},
                {extend: 'pdf', title: 'Permohonan Peminjaman Kendaraan'},

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

