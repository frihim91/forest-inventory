<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
    .slider_img{ height: 80px; width: 80px; }
</style> 

<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Reference Data?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/Website/viewReferenceData');?>";
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>
<div class="widget">  
    <div class="widget-head"> 
        <a href="<?php echo site_url('dashboard/Website/addReferenceData')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Add New Reference</a>
        <small style="margin-left: 10px;">All the Reference Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
           
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Reference</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Journal</th>
                            <th>PDF Label</th>
                            <th width="60px">Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        $i = 1;
                        foreach ($reference as $references) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $references->Reference?></a></td>
                                <td><?php echo $references->Author?></td>
                                <td><?php echo $references->Year?></td>
                                <td><?php echo $references->Title?></td>
                                <td><?php echo $references->Journal?></td>
                                <td><?php echo $references->PDF_label?></td>
                                <td width="70px">
                      <a class="label btn-danger btn-xs " href="<?php echo site_url("dashboard/Website/updateReferenceData/" . $references->ID_Reference); ?>">
                              <i class="glyphicon glyphicon-edit"></i>
                              </a>&nbsp; 
                               <a class="label btn-danger btn-xs deleteUrl" href="<?php echo site_url('dashboard/Website/deleteReference/'.$references->ID_Reference)?>">
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