

 <style>
   .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
   .help-head{color:#A82400;} 
   .form-group:hover .help{ background: #e3e3e3;}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/redactor/redactor.css" />
<script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.min.js"></script>
<script>
   $(document).ready(function () {
       $('.redactor').redactor();
       $('.dropdown-option').select2();
   
       var warning = true;
       $('form input:text, form input:checkbox, form input:radio, form textarea, form select').on('change', function() {
           window.onbeforeunload = function() { 
               if (warning){
                    return 1;
               }
           }
       });
   
       $('form').submit(function() {
           window.onbeforeunload = null;
       });
   
   });
</script>
  <div class="widget">  
    <div class="widget-head"> 
        <a href="<?php echo site_url('dashboard/Website/viewGalleryData')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >View Sliders Images</a>
        <small style="margin-left: 10px;">Add New Image in Home Gallery</small> 
    </div> 

 <div class="widget-body">
         <?php
            $attribute = array('class' => 'form-horizontal', 'id' => '', 'role' => 'form');
            echo form_open_multipart('dashboard/Website/editGallerySlider/'.$ID, $attribute);
            ?>

            <div class="msg">
                <?php
                if (validation_errors() != false) {
                    ?>
                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
  
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12"> 
                  <label for="firstname">Image Title </label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Gallery Title ', 'id' => 'title', 'name' => 'title', 'value' => $edit_gallery->GALLERY_TITLE, 'required' => 'required')); ?>      
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Gallery Title Name</strong>
               <hr>
               <p class="muted">Please enter Gallery Title Name in english here.</p>
            </div>
         </div>
      </div>
     
     
      
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12">
                  <label for="firstname">Image Description</label> 
                  <?php echo form_textarea(array('name' => 'descript', "class" => "redactor form-control", 'placeholder' => 'Slider Description', 'rows' => '50','value' => $edit_gallery->GALLERY_DESC)); ?>  
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Gallery Description</strong>
               <hr>
               <p class="muted">Please enter Gallery Description here.</p>
            </div>
         </div>
      </div>
  <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12">
                  <label for="firstname">Image</label> 
             
                    <?php 
                       foreach($images as $image) {
                           ?>
                           <span id="images_<?php echo $image->ID?>">
                           <img src="<?php echo base_url();?>resources/images/home_page_gallery/<?php echo $image->IMAGE_PATH; ?>" class="img-thumbnail" id="img-thumbnail_id" style="width:130px;height:100px;margin-left:1px;"/>
                           
                           <a href="javascript:;" imgid="<?php echo $image->ID?>" class="remove_doc_record fa fa-times removeImage"></a>
                           </span>
                       <?php }?> 
               <input type="file" name="main_image" id="file" class="form-control">
             <!--    <p style="color:red;font-size:16px;padding-top:10px;">(Maximum Image size:887*335)</p> -->

               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Image</strong>
               <hr>
               <p class="muted">Please Upload image here.</p>
            </div>
         </div>
      </div>
        <div class="row">
      <div class="form-group"> 
          <div class="col-md-8">

              <div class="col-md-12"> 
                  <label>Is Feature Image ?</label><br>
                  <?php echo form_checkbox('IS_FEAT','N', false); ?>
              </div>
          </div>
          <div class="col-md-4 help">
              <strong><span  class="help-head">Help: </span>Is Active ?</strong>
              <hr>
              <p class="muted">If Feature Image checked checkbox, else uncheck .</p>
          </div>  
      </div>
  </div>
     
      <div class="separator"></div>
      <center>
         <div class="form-actions">
            <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Save</button>
         </div>
      </center>
      <?php echo form_close(); ?>
   </div>
  </div>

 <script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/fuelux-checkbox/fuelux-checkbox.init.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
       $('body').on('keyup', '.numericOnly', function () {
           var val = $(this).val();
           $(this).val(val.replace(/[^\d]/g, ''));
       });
   });
</script>

// <script type="text/javascript">
//    var _URL = window.URL || window.webkitURL;

// $("#file").change(function(e) {
    
//     var image, file;


//     if ((file = this.files[0])) {
       
//         image = new Image();
        
//         image.onload = function() {
//           var widthImg=this.width;
//           var heightImg=this.height;
//           //alert(heightImg);
//            if(widthImg<400 && heightImg<250)
//            {
//             alert("Image Is So Small.Minimum Size is Height:400 Width:250");
//             $("#file").val("");
//            }
//            else if(widthImg>887 && heightImg>335)
//            {
//             alert("Image Is So Large.Maximum Size is Height:887 Width:335");
//             $("#file").val("");
//            }
//           //alert(widthImg);
              
//             //alert("The image width is " +this.width + " and image height is " + this.height);
//         };
  
//         image.src = _URL.createObjectURL(file);


//     }

// });
// </script>


//  <script type="text/javascript">
// function Upload() {
//     //Get reference of FileUpload.
// var fileUpload = document.getElementById("fileUpload");

// //or however you get a handle to the IMG
// var width = img.clientWidth;
// var height = img.clientHeight;
//    if (height > 100 || width > 100) {
//                         alert("Height and Width must not exceed 100px.");
//                         return false;
//                     }
                   
// }
// </script>
<script>
   $(document).ready(function() {
       $(document).on("click", ".editVisitor", function() {
           var visitor_id = $(this).attr("id");
           $.ajax({
               type: "POST",
               data: {visitor_id: visitor_id},
               url: "<?php echo site_url('setup/org/editVisitor'); ?>",
               success: function(data) {
                   $('#editVisitor').html(data);
               }
           });
       });
       var i = 1;
       $(document).on("click", "#addFileId", function() {
           $('#moreFile').append('<span class="appeend_data"><div class="col-md-8" id="file_' + i + '"><input type="file" name="userfile[]" size="20" /></div><div class="col-md-4"><a href="#" class="btn btn-danger btn-xs removeclass">X</a></div></span>');
           
       });
       $(document).on('click', '.removeclass', function() {
           $(this).closest('span').remove();
           $('.imgFile').attr('id', 'moreFile');
           return false;
       });
   
   });
</script>

    <script type="text/javascript">
    $(document).ready(function() {
    $('#load').hide();
    });

    $(function() {
    $(".remove_doc_record fa fa-times").click(function() {
    $('#load').fadeIn();
    var commentContainer = $(this).parent();
    var ID = $(this).attr("ID");
    var string = 'ID='+ ID ;
        
    $.ajax({
       type: "POST",
       url: "dashboard/Website/delete_edit_gallery_images",
       data: string,
       cache: false,
       success: function(){
        commentContainer.slideUp('slow', function() {$(this).remove();});
        $('#load').fadeOut();
      }
       
     });

    return false;
        });
    });


    </script>

   <script>
        $(document).on('click', '.removeImage', function() {
            if (confirm('Are you sure you want to delete this?')) {
            var ID = $(this).attr('imgid');
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('dashboard/Website/delete_edit_gallery_images'); ?>",
                  data: {ID:ID},
                  dataType: "html",
                  success: function(data){
                      $('#images_'+ID).remove();
                  }
            });
        }});
    </script>