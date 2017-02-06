<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 
<div class="widget">  
    <div class="widget-head"> 
        <a href="<?php echo site_url('portal/addImageinSlider')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Add New Image</a>
        <small style="margin-left: 10px;">All the system Modules Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
           
                <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Slider Image Title</th>
                            <th>Slider Image Description</th>
                            <th>Slider Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
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
                    </tbody> -->
                </table>
              
        </div>
    </div>
    </div>