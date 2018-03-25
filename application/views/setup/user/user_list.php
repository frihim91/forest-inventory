<span style=" margin-left:86%;">
    <a  class="btn btn-success" href="<?php echo site_url('setup/setup/create_new_user'); ?>">Create New User</a>
</span>
<div class=" col-md-12">
    <div class="widget widget-heading-simple widget-body-white" >
        <div class="widget-body">
            <?php if (!empty($users)) { ?>
                <table id="example" class="dynamicTable mTable table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User Group</th>
                            <th>User Level</th>
                            <th>Username</th>
                            <th>CP No</th>
                            <th>Full Name</th>
                            <th>Institute Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row->USERGRP_NAME; ?></td>
                                <td><?php echo $row->UGLEVE_NAME; ?></td>
                                <td><?php echo $row->USERNAME; ?></td>
                                <td><?php echo $row->CP_NO; ?></td>
                                <td><?php echo $row->FULL_NAME; ?></td>
                                <td><?php echo $row->INSTITUTE_NAME; ?></td>
                                <td><?php echo $row->EMAIL; ?></td>
                                <td><a title="Change Status" href="<?php echo site_url("setup/setup/change_user_status/$row->USER_ID"); ?>"><?php echo ($row->STATUS == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?></a></td>
                                <td>
                                    <a class=" " href="<?php echo site_url("setup/setup/user_list_update/$row->USER_ID"); ?>"><i class="fa fa-edit"></i></a>
                                    <a title="View User Information." href="#user_list_Modal"  data-toggle="modal" user_id="<?php echo $row->USER_ID; ?>" class=" view_user_list"><i class="fa fa-eye"></i></a>           
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>User Group</th>
                            <th>User Level</th>
                            <th>Username</th>
                            <th>CP No</th>
                            <th>Full Name</th>
                            <th>Institute Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            <?php } ?>
        </div>
    </div>
</div>

<div  class="modal fade" id="user_list_Modal">
    <div class="modal-dialog" style=" width: 65%; margin-top: 4%; margin-left: 12%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="heading">User Information</h4>
            </div>
            <div class="modal-body" id="user_info" >
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.view_user_list', function () {
        var user_id = $(this).attr('user_id');
        //alert(user_id);
        $.ajax({
            type: 'post',
            data: {user_id: user_id},
            url: '<?php echo site_url('setup/setup/view_user_info'); ?>',
            success: function (data) {
                $('#user_info').html(data);
            }
        });
    });
</script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/lib/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/components/modules/admin/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/datatables.init.js"></script>

