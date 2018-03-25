<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 

<div class="widget">  
    <div class="widget-head"> 
       <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
         <!-- <a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/website/createPostLink"); ?>">Add New Post</a> -->
        <small style="margin-left: 10px;">All Posts Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
            <?php
            if (!empty($all_posts)) {
                ?>
                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Post Title Name</th>
                            <th>Subtitle Name</th>
                            <th>Post Url</th>
                            <th>Serial</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($all_posts as $all_post) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_post->CAT_NAME; ?></td>
                                <td><?php echo $all_post->TITLE_NAME; ?></td>
                                <td><?php echo $all_post->SUB_TITLE;?></td>
                                <td><?php echo $all_post->PG_URI; ?></td>
                                <td><?php echo $all_post->ORDER_NO;?></td>
                                <td><?php echo ($all_post->ACTIVE_STAT == "Y") ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>
                                <td>

                                <a  title="Edit Post Name"  href="<?php echo site_url("dashboard/website/updatePostLink/" . $all_post->TITLE_ID); ?>" class="label label-info" style="cursor: pointer">Edit</a> 
                                

                                    <span  title="Delete Post Name"   href="<?php echo site_url('dashboard/website/deletePost/'.$all_post->TITLE_ID);?>" class="label label-info deleteUrl" style="cursor: pointer">Delete</span>  
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

 <script type="text/javascript">
  $(document).on("click", "span.deleteUrl", function (e) {
       var result = confirm("Are you sure want to delete it?");
       if(result == true){
        var url = $(this).attr('href');
         var removeRow = $(this).parent().parent();

                    $.ajax({
                        url: url,
                        type: 'POST',
                       // dataType: 'JSON',
                        success: function (data) {
                        window.location.href = "<?php echo site_url('dashboard/website/postSetup');?>";
                           
                        }
                    });
       }
e.preventDefault();
});
</script>


