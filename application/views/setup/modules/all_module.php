<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 
<div class="widget">  
    <div class="widget-head"> 
        <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Module</a>
        <small style="margin-left: 10px;">All the system Modules Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
            <?php
            if (!empty($all_modules)) {
                ?>
                <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Module Name</th>
                            <th>Short Name</th>
                            <th>Module Name Bangla</th>
                            <th>S/N</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($all_modules as $all_mod) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_mod->MODULE_NAME; ?></td>
                                <td><?php echo $all_mod->SHORT_NAME; ?></td>
                                <td><?php echo $all_mod->MODULE_NAME_BN; ?></td>
                                <td><?php echo $all_mod->SL_NO; ?></td>
                                <td><?php echo ($all_mod->ACTIVE_STATUS == 1) ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>
                                <td>
                                    <span  title="Edit  Module Name"  data-remote="<?php echo site_url("dashboard/securityAccess/edit_module/" . $all_mod->MODULE_ID); ?>" class="label label-info editModal" style="cursor: pointer">Edit</span> 
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
            }
            ?>
        </div>
    </div>
    <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('dashboard/securityAccess/createModule'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Create Module</h4>
                </div>
                <div class="modal-body">
                    <div class="row">  
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Module Name</label>
                                <div class="col-md-8"> 
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtModuleName', 'name' => 'txtModuleName', 'value' => set_value('txtModuleName'), 'required' => 'required')); ?>      
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
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtModuleShortName', 'name' => 'txtModuleShortName', 'value' => set_value('txtModuleShortName'))); ?>      
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
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'txtModuleNameBn', 'name' => 'txtModuleNameBn', 'value' => set_value('txtModuleName'))); ?>      
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
                                <label for="firstname" class="col-md-4 control-label">Active ?</label>
                                <div class="col-md-8"> 
                                    <?php echo form_checkbox(array('name' => 'ACTIVE_STATUS', 'id' => 'ACTIVE_STATUS', 'value' => 1, 'checked' => TRUE)); ?>
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModuleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('keyup', '.numericOnly', function () {
            var val = $(this).val();
            $(this).val(val.replace(/[^\d]/g, ''));
        });

        $(document).on("click", ".statusType", function () {
            var status = $(this).attr('status');
            var linkId = $(this).attr('data-linkId');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/setup/changeModuleStatus'); ?>",
                data: {linkid: linkId, status: status},
                success: function (result) {
                    window.location.reload(true);
                }
            });
        });
    });

    $(document).on('click', '.editModal', function (e) {
        var title = $(this).attr('title');
        var url = $(this).attr('data-remote');
        $("#editModuleModal").modal('show');
        $.ajax({
            type: "POST",
            url: url,
            success: function (data) {
                $(".modal-title").text(title);
                $(".modal-content").html(data);
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.Modal', function (e) {
        $("#modalDefault").modal('show');
        e.preventDefault();
    });

</script>