<div class="frmMsg"></div>
<div class="row-fluid">
    <div class="span12">
        <div class="widget green">
            <div class="widget-title">
                <h4><i class="icon-reorder"></i> User Transfer Form </h4>
            </div>
            <div class="widget-body">
                <?php echo form_open("", array("class" => "form-horizontal", "id" => "frmTransferGroup")); ?>
                <input type="hidden" name="txtUserId" id="txtUserId" value="<?php echo $user_id; ?>" />
                <div class="control-group">
                    <label class="control-label" for="cmbGroup">Group Name</label>
                    <div class="controls">
                        <?php echo form_dropdown('cmbGroup', $groups, $user_info->USERGRP_ID, 'id="cmbGroup" aria-required="true"'); ?>
                    </div>
                </div>                                        
                <div class="form-actions">
                    <button type="button" class="btn btn-success" id="btnTransfer">Submit</button>
                    <button type="reset" class="btn">Cancel</button>
                    <span class="spinner">&nbsp;</span>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click', '#btnTransfer', function() {       
            var gName = $("#cmbGroup");            
            var errors = [];
            
            if(gName.val() == "") {
                errors[errors.length] = "Please Select A LGroup";
            }          
            
            if(!errors.length > 0) {
                var transfer_infos = $("#frmTransferGroup").serialize();
                $.ajax({
                    async:true,
                    type: "POST",
                    url: "<?php echo site_url('cp/securityAccess/transferGroup'); ?>",
                    data: transfer_infos,
                    beforeSend: function() {
                        $(".spinner").text(" Please Wait...");
                    },
                    success: function(data) {
                        gName.val("");
                        $(".alert").hide();
                        $(".spinner").text(" ");
                        $(".frmMsg").html("<div class='alert alert-success'>Congratulations! Level Created Successfully.</div>");
                    }
                });
            }else{
                var msg = "Please Enter Valid Data...<br />";
                for (var i = 0; i<errors.length; i++) {
                    var numError = i + 1;
                    msg += "<br />" + numError + ". " + errors[i];
                }
                $(".frmMsg").html("<div class='alert alert-danger'>" + msg + "</div>");
            }  
        });
    });
</script>