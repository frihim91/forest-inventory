

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
    <a href="<?php echo site_url('dashboard/Website/viewReferenceData')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >View Reference Data</a>
    <small style="margin-left: 10px;">Add New Reference Data</small> 
  </div> 

  <div class="widget-body">
   <?php
   $attribute = array('class' => 'form-horizontal', 'id' => '', 'role' => 'form');
   echo form_open_multipart('dashboard/website/editReferenceData/'.$ID_Reference, $attribute);
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
      <label for="firstname">Reference Name </label>
      <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Reference Name ', 'id' => 'Reference', 'name' => 'Reference', 'value' =>$edit_reference->Reference, 'required' => 'required')); ?>      
    </div>
  </div>
  <div class="col-md-4 help">
   <strong><span  class="help-head">Help: </span>Reference Name</strong>
   <hr>
   <p class="muted">Please enter Reference Name in english here.</p>
 </div>
</div>
</div>


<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Author</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Author', 'id' => 'Author', 'name' => 'Author', 'value' => $edit_reference->Author, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Author</strong>
 <hr>
 <p class="muted">Please enter Author in english here.</p>
</div>
</div>
</div>


<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Year</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Year', 'id' => 'Year', 'name' => 'Year', 'value' => $edit_reference->Year, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Year</strong>
 <hr>
 <p class="muted">Please enter Year in english here.</p>
</div>
</div>
</div>


<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Reference Title</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Reference Title', 'id' => 'Title', 'name' => 'Title', 'value' => $edit_reference->Title, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Reference Title</strong>
 <hr>
 <p class="muted">Please enter Reference Title in english here.</p>
</div>
</div>
</div>

<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Journal</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Journal', 'id' => 'Journal', 'name' => 'Journal', 'value' => $edit_reference->Journal,)); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Journal</strong>
 <hr>
 <p class="muted">Please enter Journal in english here.</p>
</div>
</div>
</div>

<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Volume</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Volume', 'id' => 'Volume', 'name' => 'Volume', 'value' => $edit_reference->Volume, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Volume</strong>
 <hr>
 <p class="muted">Please enter Volume in english here.</p>
</div>
</div>
</div>


<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Issue</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Issue', 'id' => 'Issue', 'name' => 'Issue', 'value' => $edit_reference->Issue, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Issue</strong>
 <hr>
 <p class="muted">Please enter Issue in english here.</p>
</div>
</div>
</div>

<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">Page</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Page', 'id' => 'Page', 'name' => 'Page', 'value' => $edit_reference->Page, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Page</strong>
 <hr>
 <p class="muted">Please enter Page in english here.</p>
</div>
</div>
</div>

<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">URL</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'URL', 'id' => 'URL', 'name' => 'URL', 'value' =>$edit_reference->URL,)); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>Page</strong>
 <hr>
 <p class="muted">Please enter URL in english here.</p>
</div>
</div>
</div>


<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12"> 
    <label for="firstname">PDF Label</label>
    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'PDF_label', 'id' => 'PDF_label', 'name' => 'PDF_label', 'value' => $edit_reference->PDF_label, 'required' => 'required')); ?>      
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>PDF Label</strong>
 <hr>
 <p class="muted">Please enter PDF Label in english here.</p>
</div>
</div>
</div>
<div class="row">
 <div class="form-group">
  <div class="col-md-8">
   <div class="col-md-12">
    
                          
    <label for="firstname">Upload PDF</label><br>
     <span id="images_<?php echo $edit_reference->ID_Reference?>"> 
     <a href="<?php echo base_url();?>resources/pdf/<?php echo $edit_reference->PDF_label; ?>"  style="width:130px;height:100px;margin-left:1px;font-size: 15px"/><?php echo $edit_reference->PDF_label; ?></a>
                           
                           <a href="javascript:;" imgid="<?php echo $edit_reference->ID_Reference?>" class="remove_doc_record fa fa-times removeImage"></a>
                           </span>
    <input type="file" name="main_image" id="file"  class="form-control">
    <p style="color:red;font-size:16px;padding-top:10px;">(N.B:PDF Label and Uploaded PDF File name must be same)</p>
  </div>
</div>
<div class="col-md-4 help">
 <strong><span  class="help-head">Help: </span>PDF</strong>
 <hr>
 <p class="muted">Please Upload PDF here.</p>
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

<script type="text/javascript">
 var _URL = window.URL || window.webkitURL;

 $("#file").change(function(e) {

  var image, file;


  if ((file = this.files[0])) {

    image = new Image();

    image.onload = function() {
      var widthImg=this.width;
      var heightImg=this.height;
          //alert(heightImg);
          if(widthImg<400 && heightImg<250)
          {
            alert("Image Is So Small.Minimum Size is Height:400 Width:250");
            $("#file").val("");
          }
          else if(widthImg>887 && heightImg>335)
          {
            alert("Image Is So Large.Maximum Size is Height:887 Width:335");
            $("#file").val("");
          }
          //alert(widthImg);

            //alert("The image width is " +this.width + " and image height is " + this.height);
          };

          image.src = _URL.createObjectURL(file);


        }

      });
    </script>


    <script type="text/javascript">
      function Upload() {
    //Get reference of FileUpload.
    var fileUpload = document.getElementById("fileUpload");

//or however you get a handle to the IMG
var width = img.clientWidth;
var height = img.clientHeight;
if (height > 100 || width > 100) {
  alert("Height and Width must not exceed 100px.");
  return false;
}

}
</script>
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
      var ID_Reference = $(this).attr("ID_Reference");
      var string = 'ID_Reference='+ ID_Reference ;

      $.ajax({
       type: "POST",
       url: "dashboard/website/delete_pdf",
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
            var ID_Reference = $(this).attr('imgid');
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('dashboard/website/delete_pdf'); ?>",
                  data: {ID_Reference:ID_Reference},
                  dataType: "html",
                  success: function(data){
                      $('#images_'+ID_Reference).remove();
                  }
            });
        }});
    </script>