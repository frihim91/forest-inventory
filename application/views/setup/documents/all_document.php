<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
    .slider_img{ height: 80px; width: 80px; }
</style> 
<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Document?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/ForestData/documentList');?>";
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>
<div class="widget">  
    <div class="widget-head"> 
        <a href="<?php echo site_url('dashboard/ForestData/addDocuments')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Add New Document</a>
        <small style="margin-left: 10px;">All the system Documents Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
           
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                             <th>Title</th>
                            <th>Reference Name</th>
                            <th>Author</th>
                             <th>Year</th>
                            
                             <th>PDF Label</th>
                                
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        $i = 1;
                        foreach ($document as $documents) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $documents->Title?></td>
                                <td><?php echo $documents->Reference?></td>
                                <td><?php echo $documents->Author?></td>
                                <td><?php echo $documents->Year?></td>
                                <td><?php echo $documents->PDF_label?></td>
                              
                                 <td>
                              <a class="label btn-danger btn-xs deleteUrl" href="<?php echo site_url('dashboard/ForestData/deleteDocuments/'.$documents->ID_Reference);?>">
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