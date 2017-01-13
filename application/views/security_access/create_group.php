 <?php echo form_open("dashboard/securityAccess/addNewGroup"); ?>
<div class="modal-header">
    <h4 class="modal-title">Create group</h4>
</div>
<div class="modal-body">   
    <div class="row">  
        <div class="form-group">
            <div class="col-md-8">
                <label for="firstname" class="col-md-4 control-label">Group Name</label>
                <div class="col-md-8"> 
                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtGroupName', 'name' => 'txtGroupName', 'required' => 'required')); ?>      
                    <?php echo form_hidden('txtOrgId', $hid); ?>       
                </div>
            </div>
            <div class="col-md-4 help">
                <strong><span  class="help-head">Help: </span>Group Name</strong>
                <hr>
                <p class="muted">Please enter  Group Name  here.</p>
            </div> 
        </div> 
    </div>  
    <div class="row">  
        <div class="form-group">
            <div class="col-md-8">
                <label for="firstname" class="col-md-4 control-label">Active ?</label>
                <div class="col-md-8"> 
                    <?php echo form_checkbox(array('name' => 'ACTIVE_STATUS', 'id' => 'ACTIVE_STATUS','value'=>1, 'checked'=>'checked')); ?>
                </div>
            </div>
            <div class="col-md-4 help">
                <strong><span  class="help-head">Help: </span>Active status</strong>
                <hr>
                <p class="muted">Using checkbox a Group Name can active or inactive.</p>
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