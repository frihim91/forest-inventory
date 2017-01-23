<div class="innerLR"> 
    <?php echo form_open('dashboard/securityAccess/update_report_module_cat', array('class' => 'orm-horizontal margin-none', 'id' => 'entryForm')); ?>
    <input type="hidden" name="CATEGORY_ID" value="<?php echo $cat_id; ?>" />
    <div class="widget">  
        <div class="widget-head">
            <h4 class="heading">Update Report Category Parameter</h4>
        </div> 
        <div class="widget-body">   
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="CATEGORY_NAME" class="col-md-4 control-label">Category Name <span class="requiredLevel">*</span></label>
                        <div class="col-md-6">  
                            <?php echo form_input(array('name' => 'CATEGORY_NAME', 'class' => 'form-control', 'style' => 'width: 100%', 'id' => 'CATEGORY_NAME', 'required' => 'required', 'value' => $cat_info->CATEGORY_NAME)); ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label class="col-md-4 control-label" for="SHORT_NAME">Short Name <span class="requiredLevel">*</span></label>
                        <div class="col-md-4">  
                            <?php echo form_input(array('name' => 'SHORT_NAME', 'class' => 'form-control', 'style' => 'width: 100%', 'id' => 'SHORT_NAME', 'required' => 'required', 'value' => $cat_info->SHORT_NAME)); ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label class="col-md-4 control-label">User Define Serial </label>
                        <div class="col-md-3"> 
                            <?php echo form_input(array('class' => 'form-control', 'id' => 'UD_SL_NO', 'name' => 'UD_SL_NO', 'value' => $cat_info->UD_SL_NO)); ?>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label class="col-md-4 control-label">Is Active ?</label>
                        <div class="col-md-8"> 
                            <?php echo form_checkbox('ACTIVE', 1, ($cat_info->ACTIVE == 1) ? TRUE : FALSE); ?>       
                        </div>
                    </div>
                </div> 
            </div>
            <div class="separator"></div>  
            <center>
                <div class="form-actions">
                    <input class="btn btn-success" type="submit" value="Update" />
                </div>
            </center> 
        </div>
        <br/>
    </div> 
    <?php echo form_close(); ?> 
</div>