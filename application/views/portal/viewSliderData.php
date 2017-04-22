<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
    .slider_img{ height: 80px; width: 80px; }
</style> 
<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Slider?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('portal/viewSliderData');?>";
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>
<div class="widget">  
    <div class="widget-head"> 
        <a href="<?php echo site_url('portal/addImageinSlider')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Add New Image</a>
        <small style="margin-left: 10px;">All the system Modules Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
           
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Slider Image Title</th>
                            <th>Slider Image Description</th>
                            <th>Slider Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        $i = 1;
                        foreach ($sliders as $slider) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $slider->IMAGE_TITLE?></a></td>
                                <td><?php echo $slider->IMAGE_DESC?></td>
                                <td><img class="slider_img" src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>"/></td>
                             
                                <td>
                                   <a class="label btn-danger btn-xs deleteUrl" href="<?php echo site_url('portal/deleteImage/'.$slider->ID)?>">
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