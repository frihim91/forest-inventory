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
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("comunity"); ?>
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
           <!--  <input type="hidden" name="user_id" value="<?php echo $id; ?>"/> -->
              <p><?php echo $viewDetailCommunityPage->description;?></p>
              Comment:

            <?php
              
               foreach($community_comment as $row)
                 
               {
                 ?>
                 <p><?php echo $row->comment;?>
                   By <?php echo $row->LAST_NAME;?>
                   
                    <?php echo date('l,F j,Y- H:i:s', strtotime($row->date)); ?>
                    </p>
      
           
            <?php
               }?>
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
                  <?php echo form_textarea(array('name' => 'comment', "class" => "redactor form-control", 'placeholder' => 'Add details', 'rows' => '50')); ?>  
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

