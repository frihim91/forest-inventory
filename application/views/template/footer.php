 <?php 
          $post_cat= $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=1")->row();
    ?>
<div class="copy">&copy; <a href="#"> <span style="color: blue;"><?php echo $post_cat->TITLE_NAME;?></span></a> - All Rights Reserved.
   <!--  <span style="float:right;margin-right: 20px">Design &amp; Developed By 
        <a target="_blank" href="http://atilimited.net/">
            <img width="50px;" src="<?php echo base_url(); ?>resources/images/ati_logo.jpg" alt="ATI Logo" />
            <span style="color:red;font-weight: bold;">ATI</span> <span style="color:green;font-weight: bold;">Limited</span>
        </a>
    </span>  -->
</div>
