<style type="text/css">
    .error_field{
        border-color: #B94A48 !important;
    }
</style>
<div class="msg">
    <?php
    if (validation_errors() != false) {
        echo '<div class="alert alert-block alert-error fade in">';
        echo '<button data-dismiss="alert" class="close icon-remove" type="button"></button>';
        echo validation_errors();
        echo '</div>';
    }
    ?>
</div>
<?php
echo form_open("", array("id" => "frmAssignModuleByGroup"));
?>
<div class="control-group">
    <div class="controls" style="padding-left: 1%; background: #f2f2f2; border-top:1px solid #e3e3e3; border-bottom:1px solid #e3e3e3;">
        <?php echo form_dropdown('cmbGroup', $groups, '', 'id="cmbGroup" aria-required="true" class="span2 chzn-select" tabindex="1"'); ?>
        <span class="getLevel"><select class="span2 chzn-select cmbLevel" id="cmbLevel" name="cmbLevel" data-placeholder="Choose a Level" tabindex="1"><option>Select A Level</option></select></span>
        <?php echo form_dropdown('cmbDepartment', $departments, '', 'id="cmbDepartment" aria-required="true" class="span2 chzn-select" tabindex="1"'); ?>
        <input type="submit" class="btn btn-danger" value="Save" style="float: right; margin: 5px 10px 0 0;" />
    </div>
</div>

<span class="span8" style="border: 1px solid #74B749; min-height: 200px; margin-bottom: 10px;">
    <?php
//    echo "<pre>";
//    print_r($org_modules);
    ?>
    <ul id="tree_1" class="tree" style="margin-left: 7px;">
        <li>
            <a class="tree-toggle" href="#" data-role="branch" data-toggle="branch" data-value="Bootstrap_Tree"> Modules </a>
            <span style="float: right;">
                <span style="padding: 0 5px;">Create</span>
                <span style="padding: 0 5px;">Read</span>
                <span style="padding: 0 5px;">Update</span>
                <span style="padding: 0 5px;">Delete</span>
            </span>
            <ul class="branch in" id="modules" style="width: 98%;">
                <?php
                foreach ($org_modules as $org_module) {
                    $org_module_links = $this->utilities->findAllByAttributeWithJoin("sa_org_mlinks", "ati_module_links", "LINK_ID", "LINK_ID", "LINK_NAME", array("SA_MODULE_ID" => $org_module->SA_MODULE_ID));
                    ?>
                    <li>
                        <a id="nut3" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#" style="color: #4A8BC2;"><?php echo $org_module->SA_MODULE_NAME; ?></a>
                        <ul class="branch">
                            <?php foreach ($org_module_links as $org_module_link): ?>
                                <li style="border-bottom: 1px dashed #ccc; padding: 0 0 5px 0; background: #f2f2f2; padding-left: 5px;">
                                    <a data-role="leaf" href="#">
                                        <i class="icon-file"></i> <?php echo $org_module_link->LINK_NAME; ?>
                                        <input type="hidden" name="txtLinkId[]" value="<?php echo $org_module_link->LINK_ID; ?>" />
                                        <input type="hidden" name="txtModuleId[]" value="<?php echo $org_module->SA_MODULE_ID; ?>" />
                                    </a>
                                    <span style="float: right;">
                                        <span style="padding: 0 17px;">
                                            <?php if ($org_module_link->CREATE == 1) { ?>
                                                <input type="checkbox" name="chkCreate[]" title="Create" value="1" />
                                            <?php } else { ?>
                                                <input type="hidden" name="chkCreate[]" value="0" />
                                                <input type="checkbox" title="Create"  />
                                            <?php } ?>
                                        </span>
                                        <span style="padding: 0 17px;">
                                            <?php if ($org_module_link->READ == 1) { ?>
                                                <input type="checkbox" name="chkRead[]" title="Read" value="1" />
                                            <?php } else { ?>
                                                <input type="hidden" name="chkRead[]" value="0" />
                                                <input type="checkbox" title="Read" disabled="disabled" />
                                            <?php } ?>
                                        </span>
                                        <span style="padding: 0 17px;">
                                            <?php if ($org_module_link->UPDATE == 1) { ?>
                                                <input type="checkbox" name="chkUpdate[]" title="Update" value="1" />
                                            <?php } else { ?>
                                                <input type="hidden" name="chkUpdate[]" value="0" />
                                                <input type="checkbox" title="Update" disabled="disabled" />
                                            <?php } ?>
                                        </span>
                                        <span style="padding: 0 17px;">
                                            <?php if ($org_module_link->DELETE == 1) { ?>
                                                <input type="checkbox" name="chkDelete[]" title="Delete" value="1" />
                                            <?php } else { ?>
                                                <input type="hidden" name="chkDelete[]" value="0" />
                                                <input type="checkbox" title="Delete" disabled="disabled" />
                                            <?php } ?>
                                        </span>
                                    </span>
                                    <br clear="all" />
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
    </ul>
</span>
<span class="span4">
    <div class="widget widget-tabs green">
        <div class="widget-title">
            <h4><i class="icon-reorder"></i> Users</h4>
        </div>
        <div class="widget-body">
            <table class="table">
                <tbody  id="userList">
                    <?php
                    if (!empty($users)) {
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="chkUser" value="<?php echo $user->USER_ID; ?>" style="float: left;" />&nbsp;&nbsp;
                                    <?php echo $user->FULL_NAME; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>        
    </div>
</span>
<?php echo form_close(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/assets/bootstrap-tree/bootstrap-tree/css/bootstrap-tree.css" />
<script src="<?php echo base_url(); ?>resources/assets/bootstrap-tree/bootstrap-tree/js/bootstrap-tree.js"></script>
<script src="<?php echo base_url(); ?>resources/js/tree.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#userList > tr td").first().css("borderTop","0");
        $("#modules > li a").first().removeClass("closed");
        $("#modules > li ul").first().addClass("in");
        $(document).on("change","#cmbGroup",function(){
            var group_id = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('cp/securityAccess/getLevelsByGroup'); ?>",
                data: {group:group_id},
                success: function(result) {
                    $('.getLevel').html(result);
                    $(".chzn-select").chosen(); 
                }
            });
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('cp/securityAccess/getUsersByGroup'); ?>",
                data: {group:group_id},
                success: function(result1) {
                    $('#userList').html(result1);
                    $("#userList > tr td").first().css("borderTop","0");
                }
            });
        });
        $("#btnAssignModuleByGroup").click(function() {
            if(confirm("Are You Sure?")) {
                $( "#frmAssignModuleByGroup" ).submit();
            }
            else{
                return false;
            }            
        });
    });
</script>