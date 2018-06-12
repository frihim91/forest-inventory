<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
    .slider_img{ height: 80px; width: 80px; }
</style> 

<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Gallery?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/Website/viewGalleryData');?>";
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>
<div class="widget">  
    <div class="widget-head"> 
        <a href="<?php echo site_url('dashboard/Website/addVideo')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Add New Video</a>
        <small style="margin-left: 10px;">All the Video Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
           
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Video Title</th>
                            <th>Video Description</th>
                            <th>Video</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        $i = 1;
                        foreach ($video as $videos) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $videos->Title?></a></td>
                                <td><?php echo $videos->video_description?></td>
                                <td align="center" width="2%" ><?php echo $videos->url?></td>
                             
                                <td>
                                <a class="label btn-danger btn-xs " href="<?php echo site_url("dashboard/Website/updateVideo/" . $videos->ID); ?>">
                              <i class="glyphicon glyphicon-edit"></i>
                              </a>&nbsp;
                                  

                                   <a class="label btn-danger btn-xs deleteUrl" href="<?php echo site_url('dashboard/Website/deleteVideo/'.$videos->ID)?>">
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