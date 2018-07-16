
<?php 
//echo 'sdff'.$lang_ses = $this->session->userdata("site_lang");
?>
<link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/plugins/select2/select2.min.css" rel="stylesheet"/>

<div class="main-menu">
  <nav class="navbar navbar-default fao-menu">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <?php 
        $menus = $this->Menu_model->get_all_menu();

        ?>
        <ul class="nav navbar-nav">
         <li class="">
          <a href="<?php echo site_url(); ?>" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("home"); ?>
          </a>

        </li>
        <?php
        $session_info = $this->session->userdata("user_logged");
                          //echo '<pre>';print_r($session_info);exit;
        ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("data"); ?><span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('data/allometricEquationView'); ?>"><?php echo $this->lang->line("allometric_equations"); ?></a></li>
            <li><a href="<?php echo site_url('data/rawDataView'); ?>"><?php echo $this->lang->line("raw_data"); ?></a></li>
            <li> <a href="<?php echo site_url('data/woodDensitiesView'); ?>"><?php echo $this->lang->line("Wood_densities"); ?></a></li>
            <li><a href="<?php echo site_url('data/biomassExpansionFacView'); ?>"><?php echo $this->lang->line("biomass_expansion_factor"); ?></a></li>
            <li><a href="<?php echo site_url('data/dataSpecies'); ?>"><?php echo $this->lang->line("species_list"); ?></a></li>


          </ul>
        </li>

        <li class="">
          <a href="<?php echo site_url('portal/viewLibraryPage'); ?>" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("library"); ?>
          </a>

        </li>

        <li class="">
          <a href="<?php echo site_url('portal/viewCommunityPage'); ?>" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("community"); ?>
          </a>

        </li>
 <!--        <?php 

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
          
           <?php 
         } ?>


       </ul>
     </li>

     <?php 
   }
   ?>
 -->



 </ul>
 <ul class="nav navbar-nav navbar-right">
   <?php
   $session_info = $this->session->userdata("user_logged");
                          //echo '<pre>';print_r($session_info);exit;
   ?>
   <?php

   if(!$this->session->userdata('user_logged')){
    ?>
    <li> <a href="<?php echo site_url("accounts/userLogin"); ?>"  class="btn btn-link" ><?php echo $this->lang->line("login"); ?></a></li>
    <li><a href="<?php echo site_url('accounts/userRegistration')?>"  class="btn btn-link" ><?php echo $this->lang->line("register"); ?></a></li>

    <?php 
  }else{ ?>
  <li><a href="<?php echo site_url("visitorInfo/userProfileInfo"); ?>"     class="btn btn-link" style="color: white;font-size: 14px;font-weight: 900;font-style: italic;"><?php echo $session_info["FIRST_NAME"]." ".$session_info["LAST_NAME"];?> </a><li><li> <a href="<?php echo site_url("dashboard/auth/registerLogout"); ?>" class="btn btn-link" style="color: white;text-decoration: underline;font-size: 14px;font-weight: 900;font-style: italic;"><?php echo $this->lang->line("logout"); ?></a></li>
  <?php 
}

?>


</ul>
</div><!--/.nav-collapse -->

</div>
</nav>
</div>

<script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>