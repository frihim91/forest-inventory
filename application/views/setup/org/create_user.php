 
<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 
<div class="widget">  
    <div class="widget-head">   
        <h4 class="heading">Edit Module Link</h4>
    </div> 
    <div class="widget-body">    
        <?php echo form_open('securityAccess/addUserBySubproject'); ?>
        <div class="msg">
            <?php
            if (validation_errors() != false) {
                ?>
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo validation_errors(); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Groups Name</label>
                    <div class="col-md-8"> 
                        <?php echo form_dropdown('cmbGroupName', $groups, "", 'id="cmbGroup" aria-required="true" class="form-control" style="min-width:200px;" required="required"'); ?>  
                    <input type="hidden" name="txtOrgId"  value="<?php echo $hid; ?>" />
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Groups Name</strong>
                    <hr>
                    <p class="muted">Please Select Groups Name.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Groups Level</label>
                    <div class="col-md-8"> 
                        <span class="getLevel">
                            <select class="cmbLevel form-control" id="cmbLevel"   name="cmbLevel">
                                <option>Select A Level</option>
                            </select>
                        </span>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Groups Name</strong>
                    <hr>
                    <p class="muted">Please Select Groups Name.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Sub Project</label>
                    <div class="col-md-8"> 
                        <?php echo form_dropdown('subproject', $subproject, "", 'id="subproject" aria-required="true" class="form-control" style="min-width:200px;" required="required"'); ?>  

                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Sub Project</strong>
                    <hr>
                    <p class="muted">Please Select Sub Project.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">User Name</label>
                    <div class="col-md-8"> 
                        <input type="text"  class="form-control" name="txtFirstName" value="<?php echo set_value('txtFirstName'); ?>" placeholder="Enter  Name" required="required"  />

                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>User Name</strong>
                    <hr>
                    <p class="muted">Please Select User Name.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">User Email</label>
                    <div class="col-md-8"> 
                        <input type="text"  class="form-control"  name="txtEmail" value="<?php echo set_value('txtEmail'); ?>" placeholder="Enter Email" required="required"  />
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>User Email</strong>
                    <hr>
                    <p class="muted">Please Select User Name.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Login Name</label>
                    <div class="col-md-8"> 
                        <input type="text"  class="form-control"  name="txtLoginName" value="" placeholder="Enter Login Name" required="required"  />
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Login Name</strong>
                    <hr>
                    <p class="muted">Please Select User Name.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Login Password</label>
                    <div class="col-md-8"> 
                        <input type="password"  class="form-control"  name="txtPassword" value="" placeholder="Enter Password" required="required"  />
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Login Password</strong>
                    <hr>
                    <p class="muted">Please Select User Name.</p>
                </div>  
            </div>
        </div> 
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Is Admin</label>
                    <div class="col-md-8"> 
                        <input type="checkbox" name="IS_ADMIN"/>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Is Admin</strong>
                    <hr>
                    <p class="muted">Please check if admin .</p>
                </div>  
            </div>
        </div> 
        <center>
            <div class="form-actions">
                <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Save</button>
            </div>
        </center>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/fuelux-checkbox/fuelux-checkbox.init.js"></script>
<script type="text/javascript">
    $(document).ready(function(){    
        $(document).on("change","#cmbGroup",function(){
            var group_id = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getLevelsByGroup'); ?>",
                data: {group:group_id},
                beforeSend: function() {
                    $("#modules,#userList").addClass("loadingIMid");
                },
                success: function(result) { 
                    $('.getLevel').html(result);
                }
            });
              
        });
    });
</script>