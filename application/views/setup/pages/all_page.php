<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/redactor/redactor.css" />
<script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.min.js"></script>

<script>
    $('.redactor').redactor();
</script>
<div class="widget">  
    <div class="widget-head"> 
       <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
         <a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/website/createPageLink"); ?>">Create New Page</a>
        <small style="margin-left: 10px;">All the system Modules Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
            <?php
            if (!empty($all_pages)) {
                ?>
               <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Page Title Name</th>
                            <th>Subtitle Name</th>
                            <th>Page Url</th>
                            <th>Serial</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($all_pages as $all_page) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_page->TITLE_NAME; ?></td>
                                <td><?php echo $all_page->SUB_TITLE;?></td>
                                <td><?php echo $all_page->PG_URI; ?></td>
                                <td><?php echo $all_page->ORDER_NO; ?></td>
                                <td><?php echo ($all_page->ACTIVE_STAT == "Y") ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>
                                <td>
                                    <span  title="Edit Page Name"  data-remote="<?php echo site_url("dashboard/Website/edit_module/" . $all_page->TITLE_ID); ?>" class="label label-info editModal" style="cursor: pointer">Edit</span> 
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