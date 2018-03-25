<?php echo form_open('dashboard/securityAccess/update_module'); ?>
<div class="modal-header">
    <h4 class="modal-title">Edit Module Name</h4>
</div>
<div class="modal-body">   
    <div class="row">  
        <div class="form-group">
            <div class="col-md-8">
                <label for="firstname" class="col-md-4 control-label">Module Name</label>
                <div class="col-md-8"> 
                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtModuleName', 'name' => 'txtModuleName', 'value' => $module_details->MODULE_NAME, 'required' => 'required')); ?>      
                    <?php echo form_hidden('MODULE_ID', $module_details->MODULE_ID); ?>      
                </div>
            </div>
            <div class="col-md-4 help">
                <strong><span  class="help-head">Help: </span>Module Name</strong>
                <hr>
                <p class="muted">Please enter  Module Name in english here.</p>
            </div> 
        </div> 
    </div>
    <div class="row">  
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="txtModuleShortName" class="col-md-4 control-label">Short Name</label>
                                <div class="col-md-4"> 
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtModuleShortName', 'name' => 'txtModuleShortName', 'value' => $module_details->SHORT_NAME)); ?>      
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Short Name</strong>
                                <hr>
                                <p class="muted">Please enter  Module Short Name here.</p>
                            </div> 
                        </div> 
                    </div>
    <div class="row">  
        <div class="form-group">
            <div class="col-md-8">
                <label for="firstname" class="col-md-4 control-label">Module Name Bangla</label>
                <div class="col-md-8"> 
                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtModuleNameBn', 'name' => 'txtModuleNameBn', 'value' => $module_details->MODULE_NAME_BN)); ?>      
                </div>
            </div>
            <div class="col-md-4 help">
                <strong><span  class="help-head">Help: </span>Module Name Bangla</strong>
                <hr>
                <p class="muted">Please enter  Module Name in bangla  here.</p>
            </div> 
        </div> 
    </div>
    <div class="row">  
        <div class="form-group">
            <div class="col-md-8">
                <label for="SL_NO" class="col-md-4 control-label">Serial No</label>
                <div class="col-md-2"> 
                    <?php echo form_input(array('class' => 'form-control numericOnly', 'id' => 'SL_NO', 'name' => 'SL_NO', 'value' => $module_details->SL_NO, 'maxlength' => 2)); ?>      
                </div>
            </div>
            <div class="col-md-4 help">
                <strong><span  class="help-head">Help: </span>Serial No</strong>
                <hr>
                <p class="muted">Please enter  Serial No here.</p>
            </div> 
        </div> 
    </div>
    <div class="row">  
        <div class="form-group">
            <div class="col-md-8">
                <label for="firstname" class="col-md-4 control-label">Active ?</label>
                <div class="col-md-8"> 
                    <?php echo form_checkbox(array('name' => 'ACTIVE_STATUS', 'id' => 'ACTIVE_STATUS', 'value' => $module_details->ACTIVE_STATUS, 'checked' => ($module_details->ACTIVE_STATUS == 1) ? TRUE : FALSE)); ?>
                </div>
            </div>
            <div class="col-md-4 help">
                <strong><span  class="help-head">Help: </span>Active status</strong>
                <hr>
                <p class="muted">Using checkbox a module can active or inactive.</p>
            </div> 
        </div> 
    </div>
</div>
<div class="modal-footer">
    <span class="modal_msg pull-left"></span>
    <button type="submit" class="btn btn-sm btn-success" id="createModule">Save</button>
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
</div>
<?php echo form_close(); ?>