<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Kelola Permohonan Peminjaman Kendaraan</h2>
    </div>
    <?php
    $this->breadcrumbs=array(
        'daftar permohonan peminjaman kendaraan',
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
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'list-peminjaman',
                        'dataProvider'=>$model->listPermohonanUser(),
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
                                'name'=>'Kendaraan',
                                'value'=>'MstKendaraanCustom::getNamaKendaraan($data->kendaraan_id)',
                            ),
                            array(
                                'name'=>'Tanggal Awal Peminjaman',
                                'value'=>'TrxPeminjamanKendaraanCustom::tampilanTanggal($data->waktu_mulai)'
                            ),
                            array(
                                'name'=>'Tanggal Akhir Peminjaman',
                                'value'=>'TrxPeminjamanKendaraanCustom::tampilanTanggal($data->waktu_selesai)'
                            ),
                            array(
                                'name'=>'Supir',
                                'value'=>'$data->supir',
                            ),
                            array(
                                'name'=>'Nodin',
                                'value'=>'CHtml::link(
                                            $data->nodin,
                                            Yii::app()->createUrl(\'/peminjamankendaraan/viewNodin\', array(\'id\' => $data->id)) ,
                                            array(\'class\'=>\'button\',\'target\'=>\'_blank\'))',
                                'type'=>'raw',

                            ),

                            //'nodin',

                            array(
                                'name'=>'Status',
                                'value'=>'StatusPeminjaman::getStatusPeminjaman($data->status)'
                            ),
                            array(
                                'header'=>'aksi',
                                'class'=>'CButtonColumn',
                                'template'=>'{detail} {edit}',
                                'buttons'=>array(
                                    'detail'=>array(
                                        'label'=>'<i class="fa fa-file-text-o"></i>',
                                        'options'=>array(
                                            'title'=>'Detail',
                                            'class'=>'btn btn-sm btn-primary',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        'url'=>'Yii::app()->createUrl("peminjamanKendaraan/detailPermohonanPegawai", array("id"=>$data->id))',
                                        'visible'=>'true'
                                    ),

                                    'edit'=>array(
                                        'label'=>'<i class="fa fa-pencil-square-o"></i>',
                                        'options'=>array(
                                            'title'=>'Edit',
                                            'class'=>'btn btn-sm btn-success',
                                            'data-toggle'=>'tooltip',
                                        ),
                                        'url'=>'Yii::app()->createUrl("peminjamanKendaraan/editPermohonan", array("id"=>$data->id))',
                                        'visible'=>'$data->status == StatusPeminjaman::MENUNGGU_PERSETUJUAN'
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
                        'itemsCssClass' => 'table table-striped table-hover data_pinjam_kendaraan',
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
    function myFunction() {
        location.reload();
    }
    $(document).ready(function(){
        $('.data_pinjam_kendaraan').DataTable({
            'bInfo': false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [/*
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
            */]

        });

        /* Init DataTables */
        /*var oTable = $('#editable').DataTable();*/

        /* Apply the jEditable handlers to the table */
        /*oTable.$('td').editable( '../example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );*/


    });
</script>