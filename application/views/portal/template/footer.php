 <?php 
          $post_cat= $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=1")->row();
  ?>

 <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="fot-menu">
                <ul>
                   <li><a href="<?php echo site_url('portal/index'); ?>">Home</a></li>
                   <!--  <li><a href="<?php echo site_url('dashboard/auth/index')?>">Admin Login</a></li> -->
                   <li><a href="<?php echo site_url('accounts/userRegistration')?>">Registration</a></li>
               </ul>
           </div>
       </div>
       <div class="col-sm-6">
       <p class="copy">&copy; Copyright <?php echo date('Y') ?> Bangladesh Forest Department</p>
    </div>
</div>
</div>