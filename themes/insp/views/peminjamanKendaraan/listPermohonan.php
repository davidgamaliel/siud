<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-8">
        <h2>Daftar Permohonan Peminjaman Kendaraan</h2>
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
        <p id="pesan_peringatan1"></p>
    </div>
</div>
<div class="row">
    <div class="alert alert-danger alert-dismissable col-lg-12" id="peringatan2" style="display: none;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <b>Perhatian! </b>
        <p id="pesan_peringatan2"></p>
    </div>
</div>
<br/>
<div class="col-md-1">
    <?php echo CHtml::button('Refresh Halaman', array('class' => 'btn btn-warning','onclick'=>"myFunction()")); ?>
</div>
<br/>
<br/>

<div class="wrapper wrapper-content animate fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Daftar Permohonan
                </div>
                <div class="ibox-content CGridViewContainer">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'list-peminjaman',
                        'dataProvider'=>$model->listPermohonan(),
                        'ajaxUpdate'=>true,
                        'columns'=>array(
                            array(
                                'header'=>'No',
                                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
                            ),
                            array(
                                'header'=>'ID permohonan',
                                'value'=>'$data->id',
                                'headerHtmlOptions'=>array('style'=>'display:none'),
                                'htmlOptions'=>array('style'=>'display:none'),
                            ),
                            array(
                                'name'=>'Nama Pemohon',
                                'value'=>'TmstUserCustom::namaPeminjamKendaraan($data->id)'
                            ),
                            array(
                                'header'=>'kendaraan_id',
                                'value'=>'MstKendaraanCustom::getNamaKendaraan($data->kendaraan_id)',
                            ),
                            array(
                                'header'=>'Waktu Awal Peminjaman',
                                'value'=>'TrxPeminjamanKendaraanCustom::tampilanTanggal($data->waktu_mulai)'
                            ),
                            array(
                                'header'=>'Waktu Akhir Peminjaman',
                                'value'=>'TrxPeminjamanKendaraanCustom::tampilanTanggal($data->waktu_selesai)'
                            ),
                            array(
                                'header'=>'Supir',
                                'value'=>'$data->supir',
                            ),
                             array(
                                'header'=>'File Nodin',
                                'value'=>'CHtml::link(
                                            $data->nodin,
                                            Yii::app()->createUrl(\'/peminjamankendaraan/viewNodin\', array(\'id\' => $data->id)) ,
                                            array(\'class\'=>\'button\',\'target\'=>\'_blank\'))',
                                'type'=>'raw',

                            ),
                            //'nodin',
                            array(
                                'header'=>'status',
                                'value'=>'StatusPeminjaman::getStatusPeminjaman($data->status)'
                            ),
                            array(
                                'header'=>'aksi',
                                'class'=>'CButtonColumn',
                                'template'=>'{detail} {setujui} {tolak}',
                                'buttons'=>array(
                                    'detail'=>array(
                                        'label'=>'<i class="fa fa-file-text-o"></i>',
                                        'options'=>array(
                                            'title'=>'Detail',
                                            'class'=>'btn btn-sm btn-primary',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        'url'=>'Yii::app()->createUrl("peminjamanKendaraan/detailPermohonan", array("id"=>$data->id))',
                                        'visible'=>'true'
                                    ),
                                    'setujui'=>array(
                                        'label'=>'<i class="fa fa-check-square"></i>',
                                        'options'=>array(
                                            'title'=>'Setujui',
                                            'class'=>'btn btn-sm btn-success setujui',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        //'url'=>'Yii::app()->createUrl("cardOrder/cardInstantAllocation", array("id"=>$data->ID))',
                                        'visible'=>'true',
                                        'click' => "js:function(event){  
												event.preventDefault();
												var id_permintaan = $(this).parent().parent().children(':nth-child(2)').html()
												$('#modalCardNominative').modal('show');
												".CHtml::ajax(array(
                                                'url'=>Yii::app()->createUrl('peminjamanKendaraan/setujuiPeminjaman'),
                                                'type'=>'POST',
                                                'data'=>'js:{id: id_permintaan}',
                                                'dataType'=>'JSON',
                                                'success'=>"function(data){
                                                                    console.log('data terkirim', data);
                                                                    if(data['status']=='berhasil'){
                                                                        document.getElementById('pesan_peringatan1').innerHTML =data['message']
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }else{
                                                                         document.getElementById('pesan_peringatan2').innerHTML = data['message']
                                                                        $('#peringatan2').show();
                                                                        $('#peringatan1').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }
                                                                }"
                                            ))
                                            ."
										}"
                                    ),
                                    'tolak'=>array(
                                        'label'=>'<i class="fa fa-minus-square"></i>',
                                        'options'=>array(
                                            'title'=>'Tolak',
                                            'class'=>'btn btn-sm btn-danger tolak',
                                            'data-toggle' => 'tooltip',
                                        ),
                                        //'url'=>'Yii::app()->createUrl("cardOrder/cardInstantAllocation", array("id"=>$data->ID))',
                                        'visible'=>'true',
                                        'click' => "js:function(event){  
												event.preventDefault();
												var id_permintaan = $(this).parent().parent().children(':nth-child(2)').html()
												console.log('id yang mau dirubah', id_permintaan)
												$('#modalCardNominative').modal('show');
											
												".CHtml::ajax(array(
                                                                'url'=>Yii::app()->createUrl('peminjamanKendaraan/tolakPeminjaman'),
                                                                'type'=>'POST',
                                                                'data'=>'js:{id: id_permintaan}',
                                                                'dataType'=>'JSON',
                                                                'success'=>"function(data){
                                                                    console.log('data terkirim');
                                                                    if(data['status']=='berhasil'){
                                                             
                                                                        document.getElementById('pesan_peringatan1').innerHTML = data['message']
                                                                        $('#peringatan1').show();
                                                                        $('#peringatan2').hide();
                                                                        $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }else{
                                                                      
                                                                         document.getElementById('pesan_peringatan2').innerHTML = data['message']
                                                                         $('#peringatan2').show();
                                                                         $('#peringatan1').hide();
                                                                         $('#list-peminjaman').yiiGridView('update', {
                                                                            data: $(this).serialize()
                                                                        });
                                                                    }
                                                                }"
                                            ))
                                            ."
										}"
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
                        'itemsCssClass' => 'table table-striped table-hover data_table_kendaraan',
                        'cssFile' => false,
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
        $('.data_table_kendaraan').DataTable({
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

    /*function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }*/
</script>