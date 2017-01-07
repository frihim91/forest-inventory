<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 
<div class="widget">  
    <div class="widget-head">   
        <h4 class="heading">Create Module Link</h4>
    </div> 
    <div class="widget-body">    
        <?php echo form_open(); ?>
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
                    <label class="col-md-4 control-label">Modules</label>
                    <div class="col-md-4"> 
                        <?php
                        $modules = $this->security_model->get_all_modules();
                        $options = array('' => 'Select Module');
                        foreach ($modules as $module) {
                            $options["$module->MODULE_ID"] = $module->MODULE_NAME;
                        }
                        $mId = set_value('txtmoduleId');
                        echo form_dropdown('txtmoduleId', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Country..." required="required"');
                        ?>   
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Modules</strong>
                    <hr>
                    <p class="muted">Please select any Module.</p>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Link Name</label>
                    <div class="col-md-8"> 
                        <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtLinkName', 'name' => 'txtLinkName', 'value' => set_value('txtLinkName'), 'required' => 'required')); ?>      
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Link Name</strong>
                    <hr>
                    <p class="muted">Please enter  Module Link Name in English here.</p>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Link Name BN</label>
                    <div class="col-md-8"> 
                        <?php echo form_input(array('class' => 'form-control', 'id' => 'txtLinkNameBn', 'name' => 'txtLinkNameBn', 'value' => set_value('txtLinkNameBn'))); ?>      
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Link Name BN</strong>
                    <hr>
                    <p class="muted">Please enter  Module Link Name in Bangla here.</p>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">URI</label>
                    <div class="col-md-8"> 
                        <?php echo form_input(array('class' => 'form-control', 'id' => 'txtModLink', 'name' => 'txtModLink', 'value' => set_value('txtModLink'), 'required' => 'required')); ?>      
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>URI</strong>
                    <hr>
                    <p class="muted">Please enter  URI of Link here.</p>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="form-group"> 
                <div class="col-md-8">
                    <label class="col-md-4 control-label">Action Pages</label>
                    <div class="col-md-8"> 
                        <?php
                        $chkCreate = array(
                            'name' => 'chkpages[]',
                            'id' => 'chkInsert',
                            'value' => 'I',
                            'style' => 'margin-right:5px',
                        );
                        echo form_checkbox($chkCreate) . "Create &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $chkView = array(
                            'name' => 'chkpages[]',
                            'id' => 'chkView',
                            'value' => 'V',
                            'style' => 'margin-right:5px',
                        );
                        echo form_checkbox($chkView) . "View &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $chkUpdate = array(
                            'name' => 'chkpages[]',
                            'id' => 'chkUpdate',
                            'value' => 'U',
                            'style' => 'margin-right:5px',
                        );
                        echo form_checkbox($chkUpdate) . "Update &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $chkDelete = array(
                            'name' => 'chkpages[]',
                            'id' => 'chkDelete',
                            'value' => 'D',
                            'style' => 'margin-right:5px',
                        );
                        echo form_checkbox($chkDelete) . "Delete &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $chkStatus = array(
                            'name' => 'chkpages[]',
                            'id' => 'chkStatus',
                            'value' => 'S',
                            'style' => 'margin-right:5px',
                        );
                        echo form_checkbox($chkStatus) . "Status";
                        ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Action Pages</strong>
                    <hr>
                    <p class="muted">Please checked here accessible area of Pages .</p>
                </div>  
            </div>
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="SL_NO" class="col-md-4 control-label">Serial No</label>
                    <div class="col-md-1">
                        <?php echo form_input(array('class' => 'form-control numericOnly', 'id' => 'SL_NO', 'name' => 'SL_NO', 'value' => set_value('SL_NO'), 'maxlength' => 2)); ?>      
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
                    <label class="col-md-4 control-label">Is Active ?</label>
                    <div class="col-md-8"> 
                        <?php echo form_checkbox('ACTIVE_STATUS', 1, TRUE); ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Is Active ?</strong>
                    <hr>
                    <p class="muted">If active checked checkbox, else uncheck .</p>
                </div>  
            </div>
        </div>
        <div class="separator"></div>  
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
    $(document).ready(function () {
        $('body').on('keyup', '.numericOnly', function () {
            var val = $(this).val();
            $(this).val(val.replace(/[^\d]/g, ''));
        });
    });
</script>