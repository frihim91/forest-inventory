 <?php 
          $post_cat= $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=1")->row();
  ?>

<?php 
$menus = $this->Menu_model->get_all_menu();

?>

 <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="fot-menu">
                <ul>

                  <?php 

                foreach($menus as $pm) {
                     $lang_ses = $this->session->userdata("site_lang");

                    $link=$this->Menu_model->get_chile_menu($pm->TITLE_ID);
                    $count=count($link);
                    if($count>0)
                    {
                        $className="dropdown";
                    }
                    else 
                    {
                        $className='';
                    }

                    ?>
                    
                    <li class="<?php echo $className; ?>">
                        <a href="<?php echo site_url('portal/details/'.$pm->TITLE_ID.'/'.$pm->PG_URI); ?>" class="dropdown-toggle" data-toggle="<?php echo $className; ?>" role="button" aria-haspopup="true" aria-expanded="false"> 
                           <?php 
                           if(!empty($pm->TITLE_NAME_BN))
                                {
                                    if ($lang_ses == "bangla") 
                                    {
                                        echo $pm->TITLE_NAME_BN;
                                    } 
                                    else
                                    {
                                        echo $pm->TITLE_NAME;
                                    }
                                }
                                else 
                                {
                                    echo $pm->TITLE_NAME;
                                }
                           ?> 
                            <?php if($count>0)
                            {
                                echo '<span class="caret"></span>';
                            }
                            ?>

                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($link as $links){
                                ?>
                                <li ><a href="<?php echo site_url('portal/details/'.$links->TITLE_ID.'/'.$links->PG_URI); ?>"> <?php
                                $lang_ses = $this->session->userdata("site_lang");
                                
                                if(!empty($links->TITLE_NAME_BN))
                                {
                                    if ($lang_ses == "bangla") 
                                    {
                                        echo $links->TITLE_NAME_BN;
                                    } 
                                    else
                                    {
                                        echo $links->TITLE_NAME;
                                    }
                                }
                                else 
                                {
                                     echo $links->TITLE_NAME;
                                }

                                ?> 
                                </a></li>
                                  <!--<li role="presentation" class="divider"></li>-->
                                <?php 
                            } ?>


                        </ul>
                    </li>

                    <?php 
                }
                ?>




                   <!-- <li><a href="<?php echo site_url('portal/index'); ?>">Home</a></li>
                   <li><a href="<?php echo site_url('accounts/userRegistration')?>">Registration</a></li> -->
               </ul>
           </div>
       </div>
       <div class="col-sm-6">
       <p class="copy">&copy; Copyright <?php echo date('Y') ?> Bangladesh Forest Department</p>
    </div>
</div>
</div>