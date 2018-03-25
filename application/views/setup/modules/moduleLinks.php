<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 
<div class="widget">  
    <div class="widget-head"> 
        <a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/securityAccess/createModuleLink"); ?>">Add New Link</a>
        <small style="margin-left: 10px;">All Module Links</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
            <?php
            if (!empty($moduleLinks)) {
                ?>
                <table class="dynamicTable colVis table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Module Name</th>
                            <th>Link Name</th>
                            <!--<th>Link Name Bangla</th>-->
                            <th>URI</th>
                            <th>Access</th>
                            <th>S/N</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($moduleLinks as $row) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->MODULE_NAME; ?></td>
                                <td><?php echo $row->LINK_NAME; ?></td>
                                <!--<td><?php //echo $row->LINK_NAME_BN; ?></td>-->
                                <td><?php echo $row->URL_URI; ?></td>
                                <td><?php echo $row->ATI_MLINK_PAGES; ?></td>
                                <td><?php echo $row->SL_NO; ?></td>
                                <td><?php echo ($row->ACTIVE_STATUS == 1) ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>
                                <td>
                                    <a  title="Edit  Module Link"  href="<?php echo site_url("dashboard/securityAccess/editModuleLink/" . $row->LINK_ID); ?>" class="label label-info" style="cursor: pointer">Edit</a> 
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
</div>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/lib/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/components/modules/admin/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/datatables.init.js"></script>