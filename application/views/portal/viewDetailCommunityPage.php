<style type="text/css">
   .page_content{
   padding: 15px;
   background-color: white;
   margin-top: 15px;
   }
   .page_des_big_image{
   width: 100%;
   height: 300px;
   }
   .bdy_des{
   margin-top: 25px;
   }
   .breadcump{
   background-image: url("<?php echo base_url("resources/images/breadcump_image.jpg")?>");
   height: 103px;
   }
   .breadcump-wrapper{
   background-color: #000000 !important;
   opacity: 0.7;
   width: 100%;
   height:100%;
   }
   .wrapper{
   padding:30px !important;
   color: #FFFFFF;
   font-weight: bold;
   }
   .breadcump_row a{
   color: white;
   }

   .tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}

.tip-up {
  top: -25px; /* Same as body margin top + border */
  left: 10px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-top-color: transparent;
}

.tip-down {
  bottom: -25px;
  left: 10px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}

.tip-left {
  top: 10px;
  left: -25px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}

.tip-right {
  top: 10px;
  right: -25px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;  
}

.dialogbox .body {
  position: relative;
  max-width: 600px;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #DADADA;
  border-radius: 3px;
  border: 5px solid #ccc;
}

.body .message {
  min-height: 30px;
  border-radius: 3px;
  font-family: Arial;
  font-size: 14px;
  line-height: 1.5;
  color: #797979;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/redactor/redactor2.css" />
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
<script type="text/javascript">
   $(document).on('keypress', '#title', function () {
   
   var pattern = /[0-9]+/g;
   var id = $(this).attr('id').match(pattern);
   $(this).autocomplete({
      source: "<?php echo site_url('Portal/get_title'); ?>",
      select: function (event, ui) {
          $("#title" + id).val(ui.item.id);
      }
   });
   });
   
   
     $(document).on('keypress', '#author', function () {
   
   var pattern = /[0-9]+/g;
   var id = $(this).attr('id').match(pattern);
   $(this).autocomplete({
      source: "<?php echo site_url('Portal/get_author'); ?>",
      select: function (event, ui) {
          $("#author" + id).val(ui.item.id);
      }
   });
   });
   
   
   $(document).on('keypress', '#keyword', function () {
   
   var pattern = /[0-9]+/g;
   var id = $(this).attr('id').match(pattern);
   $(this).autocomplete({
      source: "<?php echo site_url('Portal/get_keyword'); ?>",
      select: function (event, ui) {
          $("#keyword" + id).val(ui.item.id);
      }
   });
   });
   
   
   
   
   
   
</script>
<?php
   $lang_ses = $this->session->userdata("site_lang");
   ?>
<div class="col-sm-12 breadcump img-responsive">
   <div class="row">
      <div class="breadcump-wrapper">
         <div class="wrapper">
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("community"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("community"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<div class="col-md-12 page_content">
   
   <div class="col-sm-12">
   <h3>Post Detail</h3>
   
      <div class="col-sm-12 bdy_des">
      
         <div class="">
         <h3><?php echo $viewDetailCommunityPage->title;?></h3>
           <!--  <input type="hidden" name="user_id" value="<?php echo $id; ?>"/> -->
              <p><?php echo $viewDetailCommunityPage->description;?></p>
             <h3> Comment:</h3>
             <div class="container">
                <?php
              
               foreach($community_comment as $row)
                 
               {
                 ?>
  <div class="dialogbox">
    <div class="body">
      <span class="tip tip-up"></span>
      <div class="message">
        <span>
                 <p><?php echo $row->comment;?>
                   By <?php echo $row->LAST_NAME;?>

                    <?php echo date('l,F j,Y- H:i:s', strtotime($row->date)); ?>
                    </p>
      
           
            </span>
      </div>
    </div>
  </div>
  <?php
               }?>
  
 

  

</div>

         
             <!--  <p><?php echo $viewDetailCommunityPage->comment;?>
              By <?php echo $viewDetailCommunityPage->LAST_NAME;?> 
              <?php echo date('l,F j,Y- H:i:s', strtotime($viewDetailCommunityPage->date)); ?></p> -->
               
         </div>
           <?php echo form_open_multipart('Portal/addComment', "class='form-vertical'"); ?>
            
            <div class="row">
               <div class="col-md-6">
                 
                  <?php echo $this->session->flashdata('msg'); ?>
                  <?php echo $this->session->flashdata('Error'); ?>
                  <input type="hidden" value="<?php echo $coummunity_id;?>" name="COMMINITY_ID">
                  
                  <div class="form-group">
 
                     <label>Comment<span style="color:red;">*</span></label>
                  <?php echo form_textarea(array('name' => 'comment', "class" => "redactor form-control", 'placeholder' => 'Add details', 'rows' => '50', 'required' => 'required')); ?>  
                  </div><br>
                  <div class="submit_block" align="right">
                           <input type="submit" value="Post Comment" class="btn-success btn"/>
                        </div>
                        <?php echo form_close(); ?>
               </div>
            
   
            </div>
      </div>
   </div>
</div>
