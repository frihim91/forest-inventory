<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
    .slider_img{ height: 80px; width: 80px; }
</style> 
<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Comment?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/Visitors/commentList');?>";
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>
<div class="widget">  
    <div class="widget-head"> 
       <!--  <a href="<?php echo site_url('dashboard/Visitors/addPurpose')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Add New Purpose</a> -->
        <small style="margin-left: 10px;">All the system Comment Show Here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
           
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                             <th>Title</th>
                            <th>Author Name</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        $i = 1;
                        foreach ($comment as $comments) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $comments->title;?></a></td>
                                 <td><?php echo $comments->FIRST_NAME . " " .$comments->LAST_NAME;?></a></td>
                                <td><?php echo $comments->comment;?></a></td>
                              
                                 <td>
                            <!--     <a  title="Edit Page Name"  href="<?php echo site_url('dashboard/Visitors/deleteComment/'.$comments->id);?>" class="label label-info" style="cursor: pointer"><i class="glyphicon glyphicon-eye"></i></a>  -->
                              <a class="label btn-danger btn-xs deleteUrl" href="<?php echo site_url('dashboard/Visitors/deleteComment/'.$comments->id);?>">
                              <i class="glyphicon glyphicon-remove"></i>
                              </a>  
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
    </div>