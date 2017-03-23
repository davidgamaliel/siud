
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!-- <i class="fa fa-laptop modal-icon"></i> -->
                <h4 class="modal-title">Beri Status Permohonan</h4>
                <!-- <small class="font-bold">Beri atau ubah status permohonan peminjam. Harap sertakan alasan</small> -->
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="col-sm-2 control-label text-left">Status</label>

                    <div class="col-sm-10">
                        <?php echo CHtml::dropDownList('listStatus', $status, $dropdownStatus, array('class'=>'form-control m-b')); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2">Alasan</label> 
                    <div class="col-md-10">
                        <!-- <textarea class="form-control textarea" rows="3" name="Message" id="Message" placeholder="Message"></textarea> -->    
                        <?php echo CHtml::dropDownList('pesan', $pesan, array('class'=>'form-control textarea', 'rows'=>3)); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <p style="color:transparent">
                    
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                <?php echo CHtml::submitButton('Simpan', array('class'=>'btn btn-primary')); ?> 
            </div>
        </div>
    </div>
