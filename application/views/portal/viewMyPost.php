<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/datatable/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatable/jqueryDataTable.min.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatable/dataTableBootstrap.min.js">
</script>
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
  /* background-color: #000000 !important;*/
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

     blockquote h4 {
    font-style: italic !important;
    font-size: 15px !important;
    color: #080808 !important;
    line-height: 20px !important;
    background-color: #f6f6f6 !important;
    padding: 18px 20px !important;
    border-left: 6px solid #e67272 !important;
}

.body-text {

    font-family: "Lato", sans-serif;
    font-size: 15px;
    color: #080808;
    line-height: 20px;
   /* letter-spacing: .5px;*/
  }
  blockquote h4 span {

    font-size: 15px;
    font-style: normal;
    display: block;
    margin-top: 10px;
    color: #000000;

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
   $(document).on('keypress', '#title2', function () {
   
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

<div class="col-md-12 page_content">

   
      <div class="col-sm-12 bdy_des">
      <div class="col-md-6">
    <?php
    $session_info = $this->session->userdata("user_logged");
                          //echo '<pre>';print_r($session_info);exit;
    ?>
        <?php

    if($this->session->userdata('user_logged')){
      ?>

         <h5> <a href="<?php echo site_url('portal/viewCommunityPage'); ?>" class="btn btn-info" style="background-color:#396C15;border-color:#396C15;" role="button">View Post List</a></h5>
                    <?php 
         }else{ ?>

         <?php 
        }

        ?>
  </div>
     
      <div class="col-sm-12">
       <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <td><center>My Post List</center></td>
                </tr>
              </thead>
       
            
            <?php
              
               foreach($my_post as $row)
                 
               {
                 ?>
                 <tr>
                   <td>
           <h4 style=" font-style: italic !important;font-size: 22px !important;"><a href="<?php echo site_url('Portal/viewDetailCommunityPage/'.$row->id); ?>"><?php echo $row->title;?></a></h4>
              <blockquote><h4 class="body-text"><?php echo substr($row->description,0,135);?><a href="<?php echo site_url('Portal/viewDetailCommunityPage/'.$row->id); ?>">..Read More</a><br>
             Written by <b><?php echo $row->LAST_NAME;?></b> | <?php echo date('F j,Y', strtotime($row->post_date)); ?></h4></blockquote>
            </td>
                    </tr>
            <?php
               }?>
                </table>

   </div>
          
      
           <script>
                $(document).ready(function() {
                  $('#example').dataTable( {
                    "searching": false,
                    "bLengthChange": false,
                    "pageLength":10,
                    "bSort" : false
                    

                  } );
                } );
                </script>
         
          
         </div>
      </div>
   </div>
</div>




