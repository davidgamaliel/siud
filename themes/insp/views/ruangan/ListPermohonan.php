<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Permohonan Peminjaman Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar permohonan peminjaman ruangan',
    );
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
                        'id'=>'trx-card-order-custom-grid-instant',
                        'dataProvider'=>$provider,
                        'ajaxUpdate'=>false,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'name'=>'Ruangan',
                                'value'=>'$data->id_ruangan != null ? $data->idRuangan->nama : ""',
                            ),
                            'tanggal_peminjaman',
                            array(
                                'header'=>'Waktu Peminjaman',
                                'name'=>'waktu_peminjaman',
                                'value'=>'$data->waktu_awal_peminjaman . " - " . $data->waktu_akhir_peminjaman',
                            ),
                            'kegiatan',
                            array(
                                'header'=>'Nodin',
                                'name'=>'nodin',
                                'value'=>'$data->nodin == null || $data->nodin == "" ? "Belum Upload" : "Sudah Upload"',
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