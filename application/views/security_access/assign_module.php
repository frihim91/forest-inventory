<style type="text/css">
    .error_field{
        border-color: #B94A48 !important;
    }
    select{ padding: 5px;}
    .control-group{ margin: 0 0 10px 0;}
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
<div class="card">
    <div class="card-body">
        <div class="control-group" style="background: #F7F7F7; padding: 5px 15px; border-bottom: 1px solid #e3e3e3;">
            <div class="controls" style="margin-top: 2px;">
                <?php echo form_dropdown('cmbGroup', $groups, '', 'id="cmbGroup"'); ?>
                <span class="getLevel">
                    <select class="cmbLevel" id="cmbLevel" name="cmbLevel">
                        <option>Select A Level</option>
                    </select>
                </span>
                <?php //echo form_dropdown('cmbDepartment', $departments, '', 'id="cmbDepartment"'); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <ul id="tree_1" class="tree" style="padding: 5px;">
                            <li>
                                <a class="tree-toggle" href="#" data-role="branch" data-toggle="branch" data-value="Bootstrap_Tree" style="float: left;"> Modules </a>
                                <span class="loadingCon"></span>
                                <span style="float: right;">
                                    <span style="padding: 0 5px;">Create</span>
                                    <span style="padding: 0 5px;">Read</span>
                                    <span style="padding: 0 5px;">Update</span>
                                    <span style="padding: 0 5px;">Delete</span>
                                    <span style="padding: 0 5px;">Status</span>
                                </span>
                                <br clear="all" />
                                <ul class="branch in" id="modules" style="width: 98%; padding: 5px; margin-left: 15px;">
                                    <?php
                                    foreach ($org_modules as $org_module) {
                                        $org_module_links = $this->utilities->findAllByAttributeWithJoin("sa_org_mlinks", "ati_module_links", "LINK_ID", "LINK_ID", "LINK_NAME", array("SA_MODULE_ID" => $org_module->SA_MODULE_ID));
                                        ?>
                                        <li>
                                            <a id="nut3" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#" style="color: #4A8BC2;"><?php echo $org_module->SA_MODULE_NAME; ?></a>
                                            <ul class="branch in" style="padding-left: 5px; width: 96%;">
                                                <?php
                                                foreach ($org_module_links as $org_module_link):
                                                    ?>
                                                    <li style="border-bottom: 1px dashed #ccc; padding: 0 0 5px 0; background: #f2f2f2; padding-left: 5px;">
                                                        <span style="color: #333;"><i class="icon-file"></i> <?php echo $org_module_link->LINK_NAME; ?></span>
                                                        <span style="float: right;">
                                                            <span style="padding: 0 17px;">
                                                                <?php if ($org_module_link->CREATE == 1) { ?>
                                                                    <input type="checkbox" class="chkPage"  title="Create" value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'C'; ?>" />
                                                                <?php } else { ?>
                                                                    <input type="checkbox" title="Create" disabled="disabled"  />
                                                                <?php } ?>
                                                            </span>
                                                            <span style="padding: 0 17px;">
                                                                <?php if ($org_module_link->READ == 1) { ?>
                                                                    <input type="checkbox" class="chkPage" title="Read" value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'R'; ?>" />
                                                                <?php } else { ?>
                                                                    <input type="checkbox" title="Read" disabled="disabled" />
                                                                <?php } ?>
                                                            </span>
                                                            <span style="padding: 0 17px;">
                                                                <?php if ($org_module_link->UPDATE == 1) { ?>
                                                                    <input type="checkbox" class="chkPage" title="Update" value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'U'; ?>" />
                                                                <?php } else { ?>
                                                                    <input type="checkbox" title="Update" disabled="disabled" />
                                                                <?php } ?>
                                                            </span>
                                                            <span style="padding: 0 17px;">
                                                                <?php if ($org_module_link->DELETE == 1) { ?>
                                                                    <input type="checkbox" class="chkPage" title="Delete" value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'D'; ?>" />
                                                                <?php } else { ?>
                                                                    <input type="checkbox" title="Delete" disabled="disabled" />
                                                                <?php } ?>
                                                            </span>
                                                            <span style="padding: 0 17px;">
                                                                <?php if ($org_module_link->STATUS == 1) { ?>
                                                                    <input type="checkbox" class="chkPage" title="Delete" value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'S'; ?>" />
                                                                <?php } else { ?>
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
                    </div><!--end .card-body -->
                </div><!--end .card -->
            </div><!--end .col -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header ch-alt" style="padding: 11px;">
                        <h2>Users</h2>
                    </div>

                    <div class="card-body">
                        <?php echo form_open("", array("id" => "frmAssignModuleByGroup")); ?>
                        <table class="table">
                            <tbody  id="userList">
                                <?php
                                if (!empty($users)) {
                                    foreach ($users as $user) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $user->FULL_NAME; ?>&nbsp;
                                                <span class="loadingImg"></span>
                                            </td>
                                            <td><a href="#myModal" role="button" data-toggle="modal" data-link="<?php echo site_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID"); ?>"><span class="actionIcon dialogLink" data-original-title="Access Chart of <?php echo $user->FULL_NAME; ?>" title="Access Chart of <?php echo $user->FULL_NAME; ?>"  data-placement="top">
                                                        <img src="<?php echo base_url(); ?>resources/img/sitemap.png" />
                                                    </span></a></td>
                                            <td><span class="md-lock-open actionIcon assignUser" id="<?php echo $user->USER_ID; ?>" title="Change Access For This user Only" data-original-title="Change Access For This user Only" style="cursor: pointer;"></span></td>
                                            <td><a href="#myModal" role="button" data-toggle="modal" data-link="<?php echo site_url("cp/securityAccess/transferGroupUserModal/$user->USER_ID"); ?>"><span class="actionIcon dialogLink"  data-placement="top" data-original-title="Transfer <?php echo $user->FULL_NAME; ?> To Different Group" title="Transfer <?php echo $user->FULL_NAME; ?> To Different Group"><i class="md-exit-to-app"></i></span></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php echo form_close(); ?>
                    </div>
                </div>        
            </div><!--end .col -->
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/assets/bootstrap-tree/bootstrap-tree/css/bootstrap-tree.css" />
<script src="<?php echo base_url(); ?>resources/assets/bootstrap-tree/bootstrap-tree/js/bootstrap-tree.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/bootstrap-tree/bootstrap-tree/js/tree.js"></script>

<script type="text/javascript">
    $(document).ready(function(){        
        $(document).on("click",".actionIcon",function(){
            $(this).parents("tr").css({"backgroundColor":"rgba(116,183,73,.3)","color":"red"});
            $(this).parents("tr").siblings().css({"backgroundColor":"#fff","color":"#888888"});
        });
        $("#userList > tr:first td").css("borderTop","0");
        $("#modules > li a").first().removeClass("closed");
        $("#modules > li ul").first().addClass("in");
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
                    $("#modules,#userList").removeClass("loadingIMid");
                    $('.getLevel').html(result);
                }
            });
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getUsersByGroup'); ?>",
                data: {group:group_id},
                success: function(result1) {
                    $('#userList').html(result1);
                    $("#userList > tr:first td").css("borderTop","0");
                    $('.tooltips').tooltip();
                }
            });
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getModuleAcceesByGroup'); ?>",
                data: {group:group_id},
                beforeSend: function() {
                    $("#modules").addClass("loadingIMid");
                },
                success: function(result2) {
                    $('#modules').html(result2);
                    $("#modules > li ul").first().addClass("in");
                }
            });
        });
        
        $(document).on("change","#cmbLevel",function(){
            var group_id = $("#cmbGroup").val();
            var level_id = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getUsersByLevel'); ?>",
                data: {group:group_id,level:level_id},
                beforeSend: function() {
                    $("#userList").addClass("loadingIMid");
                },
                success: function(result1) {
                    $('#userList').html(result1).removeClass("loadingIMid");
                    $("#userList > tr:first td").css("borderTop","0");
                    $('.tooltips').tooltip();
                }
            });
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getModuleAcceesByGroupLevel'); ?>",
                data: {group:group_id,level:level_id},
                beforeSend: function() {
                    $("#modules").addClass("loadingIMid");
                },
                success: function(result2) {
                    $('#modules').html(result2).removeClass("loadingIMid");
                    $("#modules > li ul").first().addClass("in");
                }
            });
        });
        
        $(document).on("change","#cmbDepartment",function(){
            var dept_id = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getUsersByDepartment'); ?>",
                data: {department:dept_id},
                beforeSend: function() {
                    $("#userList").addClass("loadingIMid");
                },
                success: function(result1) {
                    $('#userList').html(result1).removeClass("loadingIMid");
                    $("#userList > tr:first td").css("borderTop","0");
                    $("#userList > tr:first td").css("borderTop","0");
                    $('.tooltips').tooltip();
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
        
        $(document).on("click",".chkPage",function(){
            //alert($(this).val());
            var group = $("#cmbGroup").val();
            var level = $("#cmbLevel").val();
            var department = $("#cmbDepartment").val();
            var value = $(this).val();
            var checked = ($($(this)).is(':checked'))? 1 : 0;
            if(group == ""){
                alert("Please Select Group");
                return false;
            }else if(level == ""){
                alert("Please Select Level");
                return false;
            }else{
                $.ajax({
                    type: "POST",
                    url:"<?php echo site_url('securityAccess/assignModuleToGroupAction'); ?>",
                    data: {group_id:group,level_id:level,department_id:department,values:value,is_checked:checked},
                    success: function(result) {
                    
                    }
                });
            }
        });
        
        $(document).on("click",".assignUser",function(){
            var user_id = $(this).attr("id");
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/getModuleAcceesByUser'); ?>",
                data: {user:user_id},
                beforeSend: function() {
                    $("#modules").addClass("loadingIMid");
                },
                success: function(result2) {
                    $('#modules').html(result2).removeClass("loadingIMid");
                    $("#modules > li ul").first().addClass("in");
                }
            });
        });
        
        $(document).on("click",".chkPageByUser",function(){
            var value = $(this).val();
            var group = $(this).attr("id");
            var sa_uglwm_link = $(this).attr("rel");
            var user_id = $(this).attr("user");
            var level_id = $(this).attr("level-id");
            var checked = ($($(this)).is(':checked'))? 1 : 0;
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/assignModuleAcceesByUser'); ?>",
                data: {values:value,is_checked:checked,group_id:group,sa_uglwm_link_id:sa_uglwm_link,user:user_id,level:level_id},
                success: function(result) {
                    //window.location.replace("<?php echo site_url("securityAccess/assignModuleToGroup"); ?>");
                }
            });
        });
        
        $(document).on("click","#chkAllUser",function(){
            var checked = $(this).is(':checked');
            if(checked){
                $(".chkUser").attr("checked","checked");
            }else{
                $(".chkUser").removeAttr("checked");
            }
            $.ajax({
                url:"<?php echo site_url('securityAccess/getModuleAcceesByUsers'); ?>",
                success: function(result2) {
                    $('#modules').html(result2);
                    $("#modules > li ul").first().addClass("in");
                }
            });
        });
        
        $(document).on("click",".chkPageByUsers",function(){
            var value = $(this).val();
            var users = $("#frmAssignModuleByGroup").serialize();
            var checked = ($($(this)).is(':checked'))? 1 : 0;
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('securityAccess/assignModuleAccessToUsers'); ?>",
                data: users + "&values=value&is_checked=checked",
                success: function(result2) {
                    $('#modules').html(result2);
                    $("#modules > li ul").first().addClass("in");
                }
            });
        });
    });
</script>