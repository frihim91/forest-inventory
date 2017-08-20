

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
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("library"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("library"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<div class="col-md-12 page_content">
   <h3>Documents Search</h3>
   <div class="col-sm-12">
      <div class="col-sm-12 bdy_des">
         <div class="row" style="background-color:#eee;border:1px solid #ddd;border-radius:4px;margin:0px 1px 20px 1px;">
            <div class="col-lg-6">
               <h4>Result count: <span id="summary-results-total">
                  <?php
                     if(isset($reference_count)){
                      ?>
                  <?php echo count($reference_count); ?>
                  <?php 
                     }else{ ?>
                  <?php echo $this->db->count_all_results('reference');?>
                  <?php 
                     }
                     
                     ?>
                  </span> 
               </h4>
               <br><br>
            </div>
            <div class="col-lg-6">
               <h4> Search criteria</h4>
               <p> <?php
                  if(isset($reference_count)){
                   ?>
                  <?php echo (isset($Title))?$Title:'';?>
                  <?php echo (isset($Author))?$Author:'';?>
                  <?php echo (isset($Keywords))?$Keywords:'';?>
                   <?php echo (isset($Year))?$Year:'';?>
                  <?php 
                     }
                     else{ ?>
                  No criteria - All results are shown
                  <?php 
                     }
                     
                     ?>
               </p>
            </div>
         </div>
         <div class="">
            <h4>Library</h4>
            <?php
               $pdf_values=".pdf";
               foreach($reference as $row)
                 
               {
                 ?>
            <h4><?php echo $row->Title;?></h4>
            <p><a href="<?php echo base_url('resources/pdf/'.$row->PDF_label.$pdf_values);?>"><img src="<?php echo base_url('resources/images/pdf.gif')?>" alt="logo"/> Download <?php echo $row->Title;?></a>
               <br>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row->Author;?>
            </p>
            <?php
               }?>
            <p><?php echo $links; ?></p>
            <!-- <h4>Scientific articles</h4>
               <p>Here you can find links to articles providing information about GlobAllomeTree and associated tools.</p>
               <p><a href=""> <?php
                  $i=1;
                  foreach ($reference_author as  $row){
                  if($i==1){
                  echo "$row->Author";
                  }else{
                  echo ",$row->Author";
                  }
                  $i++;
                  }
                      
                  ?>
                  </a>
               
                  iForest (early view) - doi: 10.3832/ifor0901-006
               <p> -->
         </div>
      </div>
   </div>
</div>

