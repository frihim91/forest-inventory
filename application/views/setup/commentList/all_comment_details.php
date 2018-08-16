<input type="hidden" name="" class="commId" value="<?php echo $coummunity_id; ?>">
<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
    .slider_img{ height: 80px; width: 80px; }
</style> 
<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Comment?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/Visitors/commentList');?>";
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>


<script type="text/javascript">
   $(document).on("click", "a.deleteUrlDetails", function (e) {
        var result = confirm("Are you sure want to delete Comment?");
        if(result == true){
           var commId=$("input.commId").val();
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();
   
                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                            window.location.href = "<?php echo site_url('dashboard/Visitors/commentDetails');?>"+"/"+commId;
                       
                            
                         }
                     });
        }
   e.preventDefault();
   });
</script>
 <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>


    <div class="col-sm-12">
      <?php
      if(isset($comment)){
      ?><h4><small>Comment List</small></h4>
      <hr>
      <h2><?php  echo $comment->title;?></h2>
      <h5><span class="glyphicon glyphicon-time"></span> <span class="label label-danger"><?php echo $comment->LAST_NAME;?></span> ,<?php echo date('F j,Y', strtotime($comment->post_date)); ?></h5>
   
      <p><?php  echo $comment->description;?></p><?php echo $this->lang->line("allometric_equations"); ?></a>
        <?php 
         }else{ ?>
                              
          <?php 
           }
                            
          ?>
 

      <br><br>
      
   
 <?php echo form_open_multipart('dashboard/Visitors/addReplyByAdmin', "class='form-vertical'"); ?>
      <h4>Leave a Comment:</h4>
      <?php echo $this->session->flashdata('msg'); ?>
        <?php echo $this->session->flashdata('Error'); ?>
         <input type="hidden" value="<?php echo $coummunity_id;?>" name="COMMINITY_ID">
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3" required name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
      <br><br>
        <?php echo form_close(); ?>
      <div class="row">
                <div class="table-responsive">
           
               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                             <th>#</th>
                             <th>Title</th>
                             <th>Comment</th>
                             <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php
                        $i = 1;
                        foreach ($comment_details as $row) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php if($row->LAST_NAME!= ''){ ?>
                                   <?php echo $row->LAST_NAME;?>
                                    <?php } else {?>
                                    Admin
                                 
                                    <?php } ?> <br><small><?php echo date('F j,Y h:i:sa', strtotime($row->date)); ?></small></a></td>
                                <td><?php echo $row->comment;?></a></td>
                                
                               <!--  <td><?php echo $comments->comment;?></a></td> -->
                              
                                 <td>
                       
                              <a class="label btn-danger btn-xs deleteUrlDetails" href="<?php echo site_url('dashboard/Visitors/deleteCommentDetails/'.$row->id);?>">
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
       
<!--      <?php
     $i = 1;
     foreach ($comment_details as $row) {
       ?>
        <div class="col-sm-12">
          <h4><?php if($row->LAST_NAME!= ''){
                     
                      ?>
                     <?php echo $row->LAST_NAME;?>
                      <?php } else {?>
                      Admin
                   
                      <?php } ?> <small><?php echo date('F j,Y h:i:sa', strtotime($row->date)); ?></small></h4>
          <p><?php echo $row->comment;?></p>
          <br>
        </div>
         <?php
      $i++;
    }
    ?>
        -->
      </div>
