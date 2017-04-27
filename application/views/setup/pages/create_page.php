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
       $('.redactor').redactor({
        fileUpload: '<?php echo site_url('dashboard/Website/upload_file_page')?>',
          //dragFileUpload: true
    });
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
      <h4 class="heading">Create Page</h4>
   </div>
   <div class="widget-body">
      <?php echo form_open_multipart('dashboard/Website/createPageLink', "class='form-horizontal margin-none'"); ?>
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
                  <label for="firstname">Parent Title </label>
                  <?php
                     $parents = $this->Menu_model->get_all_title();
                     $options = array('' => 'Select Parent Title');
                     foreach ($parents as $parent) {
                         $options["$parent->TITLE_ID"] = $parent->TITLE_NAME;
                     }
                     $mId = set_value('txtparentId');
                     echo form_dropdown('txtparentId', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Parent..." ');
                     ?>     
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Parent Title Name</strong>
               <hr>
               <p class="muted">Please enter  Parent Title Name in english here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12"> 
                  <label for="firstname">Title </label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'TITLE_NAME', 'name' => 'TITLE_NAME', 'value' => set_value('TITLE_NAME'), 'required' => 'required')); ?>      
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Page Title Name</strong>
               <hr>
               <p class="muted">Please enter  Page Title Name in english here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12"> 
                  <label for="firstname">Title Bangla</label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'TITLE_NAME_BN', 'name' => 'TITLE_NAME_BN', 'value' => set_value('TITLE_NAME_BN'))); ?>      
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Page Title Bangla Name</strong>
               <hr>
               <p class="muted">Please enter Page Title Name in bangla here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12"> 
                  <label for="firstname" >Subtitle</label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'SUB_TITLE', 'name' => 'SUB_TITLE', 'value' => set_value('SUB_TITLE'), )); ?>      
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Subtitle Name</strong>
               <hr>
               <p class="muted">Please enter  Subtitle in english here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12"> 
                  <label for="firstname" >Subtitle Bangla</label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => '', 'id' => 'SUB_TITLE_BN', 'name' => 'SUB_TITLE_BN', 'value' => set_value('SUB_TITLE_BN'), )); ?>      
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Subtitle Bangla Name</strong>
               <hr>
               <p class="muted">Please enter  Subtitle in bangla here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12">
                  <label for="firstname">Description</label> 
                  <?php echo form_textarea(array('name' => 'BODY_DESC', "class" => "redactor form-control", 'placeholder' => 'Body Description', 'rows' => '50')); ?>  
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Body Description</strong>
               <hr>
               <p class="muted">Please enter Body Description here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-8">
                  <div class="col-md-6"> 
                     <label>Image</label>
                     <input type="file" name="userfile[]" size="20" /> 
                  </div>
                  <br>
                  <div class="col-md-4">
                     <span class="btn btn-success btn-sm" id="addFileId"><i class="fa fa-plus">Add More</i></span>
                  </div>
                  <br/><br/>
                  <span id="moreFile" class="imgFile">
                  </span>   
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Image</strong>
               <hr>
               <p class="muted">Please Upload Image here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-2">
                  <label for="ORDER_NO">Serial No</label>
                  <select class="tag-select form-control" name="ORDER_NO" id="ORDER_NO">
                     <option value="">Select</option>
                     <?php
                        $numbers= array('' => 'Select');
                        foreach(range(1,20) as $number) {
                                array_push($numbers, $number);?>
                     <option value="<?php echo $number?>"><?php echo $number?></option>
                     <?php }
                        ?>
                  </select>
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Serial No</strong>
               <hr>
               <p class="muted">Please enter  Serial No here.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <div class="col-md-8">
               <div class="col-md-12"> 
                  <label>Is Active ?</label><br>
                  <?php echo form_checkbox('ACTIVE_STAT', 1, TRUE); ?>
               </div>
            </div>
            <div class="col-md-4 help">
               <strong><span  class="help-head">Help: </span>Is Active ?</strong>
               <hr>
               <p class="muted">If active checked checkbox, else uncheck .</p>
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