<style>
    #multi-select{ overflow: auto; border: 1px solid #ccc;}
    #multi-select h1{ margin:0; font-size: 11px; border-right: 1px solid #ccc; background: -moz-linear-gradient(center top , #F7F7F7 0%, #E6E6E6 100%) repeat scroll 0 0 rgba(0, 0, 0, 0); padding: 5px;}
    #selectable .ui-selecting { background: #FECA40; }
    #selectable .ui-selected { background: #F39814; color: white; }
    #selectable,#selectable-target { list-style-type: none; margin: 0; padding: 0; height: 300px; overflow: auto; background: #fff; border-right: 1px solid #ccc;}
    #selectable li,#selectable-target li { padding: 0.4em; font-size: 11px; border-bottom: 1px solid #e3e3e3;}
    .ui-widget-content{ box-shadow: none;}
    #selectable .ui-selected,#selectable .ui-selecting,#selectable-target .ui-selected,#selectable-target .ui-selecting{ background: #5899C4; color: #fff;}
    #selectable-target{ border-radius: 3px; height: 300px;border-left: 1px solid #ccc; border-right: 0;}
    #multi-select-btn{ margin-top: 70px;}
    #multi-select-btn .iconb{ font-size: 14px; width:30px; margin-bottom: 5px;}
    table thead tr th:first-child{ width: 50px !important;}
</style>
<?php if ($previlages->READ == 1) { ?>
<div class="card">
    <div class="card-header">
        <h2>All Users
            <?php if ($previlages->CREATE == 1) { ?>
                <a class="btn btn-success pull-right" id="create_user" data-toggle="modal" href="#modal_window" ><span class="md md-add"></span> Create New User</a>
            <?php } ?>
        </h2>
    </div>
    <div class="card-body">
        <table id="data-table-basic" class="table table-striped">
            <thead>
                <tr>
                    <th data-column-id="id" data-type="numeric" style="width: 50px;">#</th>
                    <th data-column-id="name"><?php echo $this->lang->line("msg_user_name"); ?></th>
                    <th data-column-id="group" ><?php echo $this->lang->line("msg_user_group"); ?></th>
                    <th data-column-id="label"><?php echo $this->lang->line("msg_user_label"); ?></th>
                    <th data-column-id="department"><?php echo $this->lang->line("msg_user_department"); ?></th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false"><?php echo $this->lang->line("msg_user_action"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($users as $user) {
                    $userGroup = $this->utilities->findByAttribute("sa_user_group", array("USERGRP_ID" => $user->USERGRP_ID));
                    $userGroupLevel = $this->utilities->findByAttribute("sa_ug_level", array("UG_LEVEL_ID" => $user->USERLVL_ID));
                    $userDept = $this->utilities->findByAttribute("hr_dept", array("DEPT_NO" => $user->DEPT_ID));
                    ?>
                    <tr>
                        <td style="width: 20px;"><?php echo $i . '.'; ?></td>
                        <td><?php echo $user->FIRST_NAME . " " . $user->MIDDLE_NAME . " " . $user->LAST_NAME . " "; ?></td>                        
                        <td class="center"><?php echo $userGroup->USERGRP_NAME; ?></td>
                        <td class="center"><?php echo $userGroupLevel->UGLEVE_NAME; ?></td>
                        <td class="center"><?php echo $userDept->DEPT_NAME; ?></td>
                        <td class="center">
                            <a class="btn btn-danger addLink" data-toggle="modal" href="#modal_window" data-hid="<?php echo $user->ORG_ID; ?>">Add Pages</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table> 
    </div>
</div>
<?php 
}else{
   echo "<div class='alert alert-danger'>You Don't Have Privilege To View This Page</div>"; 
} 
?>
<div class="clear"></div> 
<!-- Content ends -->
<script type="text/javascript">
    $(document).ready(function(){
        var grid =$("#data-table-basic").bootgrid({
            css: {
                icon: 'md icon',
                iconColumns: 'md-view-module',
                iconDown: 'md-expand-more',
                iconRefresh: 'md-refresh',
                iconUp: 'md-expand-less'
            },
            formatters: {
                "commands": function(column, row) {
                    var btn_edit = "<button data-target-color='green' data-toggle='modal' title='Edit  User' class=\"btn btn-primary btn-xs command-view\" data-row-id=\"" + row.id + "\"><span class=\"md md-create\"></span> edit</button>";
                    var btn_delete = "<a target='_blank' href='<?php echo site_url('applicant/e_DP'); ?>/"+ row.id +"'><button  title='Delete User' class=\"btn btn-danger btn-xs waves-float\" data-row-id=\"" + row.id + "\"><span class=\"md md-clear\"></span> delete</button></a>";
                    return "<?php if ($previlages->UPDATE == 1) { ?>" + btn_edit +" <?php } ?>"+
                        " <?php if ($previlages->DELETE == 1) { ?>" + btn_delete +" <?php } ?>";
                }
            }
        });
        $(document).on('click', '#create_user', function() {
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('setup/createUserModal'); ?>",
                beforeSend:function(){
                    $('#modal_window .modal-body').html("Loading...");
                },
                success: function(result) {
                    $('#modal_window .modal-body').html(result);
                }
            });
        });
        $(document).on('change', '#cmbGroupName', function() {
            var group_id = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('setup/getLabelByGroup'); ?>",
                data:{group_id:group_id},
                success: function(result) {
                    $('#cmbLabelName').html(result);
                }
            });
        });
    });

</script>