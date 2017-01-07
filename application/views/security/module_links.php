<div class="col-md-4">
    <div class="widget">
        <div class="widget-body">
            <?php echo form_open(); ?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="txtmoduleId">Module</label>
                <div class="col-md-9">
                    <?php
                    $modules = $this->utilities->get_all_modules();
                    $options = array('' => 'Select Module');
                    foreach ($modules as $module) {
                        $options["$module->MODULE_ID"] = $module->MODULE_NAME;
                    }
                    $mId = set_value('txtmoduleId');
                    echo form_dropdown('txtmoduleId', $options, $mId, 'id="txtmoduleId" aria-required="true" class="form-control" style="min-width:200px;"');
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="txtmoduleId">Link Name</label>
                <div class="col-md-9">
                    <input type="text" name="txtLinkName" value="<?php echo set_value('txtLinkName'); ?>" class="form-control" placeholder="Enter Link Name"  />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="txtmoduleId">URL</label>
                <div class="col-md-9">
                    <input type="text" name="txtModLink" value="<?php echo set_value('txtModLink'); ?>" class="form-control" placeholder="Enter Module Link"  />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="txtmoduleId">Pages</label>
                <div class="col-md-9">                    
                    <?php
                    echo "<div>";
                    $chkCreate = array(
                        'name' => 'chkpages[]',
                        'id' => 'chkInsert',
                        'value' => 'I',
                        'style' => 'margin-right:5px',
                    );
                    echo form_checkbox($chkCreate) . "<label for='chkInsert'>Create</label></div><div>";
                    $chkView = array(
                        'name' => 'chkpages[]',
                        'id' => 'chkView',
                        'value' => 'V',
                        'style' => 'margin-right:5px',
                    );
                    echo form_checkbox($chkView) . "<label for='chkView'>View</label></div><div>";
                    $chkUpdate = array(
                        'name' => 'chkpages[]',
                        'id' => 'chkUpdate',
                        'value' => 'U',
                        'style' => 'margin-right:5px',
                    );
                    echo form_checkbox($chkUpdate) . "<label for='chkUpdate'>Update</label></div><div>";
                    $chkDelete = array(
                        'name' => 'chkpages[]',
                        'id' => 'chkDelete',
                        'value' => 'D',
                        'style' => 'margin-right:5px',
                    );
                    echo form_checkbox($chkDelete) . "<label for='chkDelete'>Delete</label></div><div>";
                    $chkStatus = array(
                        'name' => 'chkpages[]',
                        'id' => 'chkStatus',
                        'value' => 'S',
                        'style' => 'margin-right:5px',
                    );
                    echo form_checkbox($chkStatus) . "<label for='chkStatus'>Status</label></div>";
                    ?>
                </div>
            </div>
            <hr />
            <div class="form-actions">
                <input type="submit" name="moduleLink" class="btn btn-primary formSubmit" value="Submit" />
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Cancel</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="widget widget-heading-simple widget-body-gray">
        <div class="widget-body">
            <table id="example" class="dynamicTable tableTools table table-bordered table-striped" style="background: #fff;">
                <thead>
                    <tr>
                        <th>Module Name</th>
                        <th>Module Link Name</th>
                        <th>Module Links</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($all_modules)) {
                        foreach ($all_modules as $all_mod) {
                            ?>
                            <tr>
                                <td><?php echo $all_mod->MODULE_NAME; ?></td>
                                <td><?php echo $all_mod->LINK_NAME; ?></td>
                                <td><?php echo $all_mod->URL_URI; ?></td>
                                <td class="center">
                                    <?php if ($all_mod->ACTIVE_STATUS == '1') { ?>
                                        <span width="10" data-linkId="<?php echo $all_mod->MODULE_ID; ?>" status="<?php echo $all_mod->ACTIVE_STATUS; ?>" class="statusType btn btn-success btn-xs" title="Active">Active</span> 
                                    <?php } else { ?>
                                        <span width="10" data-linkId="<?php echo $all_mod->MODULE_ID; ?>" status="<?php echo $all_mod->ACTIVE_STATUS; ?>" class="statusType btn btn-danger btn-xs" title="Inactive">Inactive</span> 
                                    <?php } ?>
                                    <span  id="<?php echo $all_mod->LINK_ID; ?>"  class="editModule btn btn-info btn-xs" title="Edit">Edit</span>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>/resources/shared/components/common/tables/datatables/assets/lib/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/resources/shared/components/common/tables/datatables/assets/custom/js/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/resources/shared/components/common/tables/datatables/assets/custom/js/datatables.init.js"></script>
<script src="<?php echo base_url(); ?>/resources/shared/components/common/tables/classic/assets/js/tables-classic.init.js"></script>