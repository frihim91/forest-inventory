    <style>
        .img_sister_con {
            margin-right: 43px;
        }
        .tender_item .widget-inner {
            padding-top: 10px;
            padding-bottom: 0px;
        }
		.slider_img{
			width:887px !important;
			height:335px !important;
		}
    </style>
    <div class="row contents_row">
       
        <div class="col-md-8 col-sm-8 col-xs-12 xs_contents">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="main-slideshow">
                        <div class="flexslider">
                            <ul class="slides">
							<?php foreach($sliders as $slider){?>
                                <li>
								
                                    <img class="slider_img img-responsive" src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>"/>

                                    <div class="slider-caption" style="width: 100%;">
                                        <h2><a href="#"><?php echo $slider->IMAGE_TITLE?></a></h2>
                                        <p><?php echo $slider->IMAGE_DESC?></p>
                                    </div>
                                </li>
							<?php } ?> 
                              
                            </ul>
                            <!-- /.slides -->
                        </div>
                        <!-- /.flexslider -->
                    </div>
                </div>
          
           
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 tender_item xs_contents">
          
                
                    <div class="widget-main-up" style="padding:10px 10px 8px 10px;text-align: justify;">
                        
                            <h4> <?php echo $post_cat->CAT_NAME;?></h4>
                           
                        
                     
                      <?php echo substr($post_description->BODY_DESC,0,710);?><a href="<?php echo site_url('Portal/post_details/'.$post_cat->TITLE_ID.'/'.$post_cat->PG_URI); ?>" class="btn btn-more pull-right"><?php echo $this->lang->line("view_details"); ?></a> 
                       
                       <!--  <a href="#" class="btn btn-more pull-right">View Details</a> -->
                    </div>


         


        </div> 

    </div>
          <div class="row contents_row">
          <br><br>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("media"); ?></h4>
                        </div>

                        <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">News</a></li>
  <li><a data-toggle="tab" href="#menu1">Photo</a></li>
  <li><a data-toggle="tab" href="#menu2">Video</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    
    <ul class="widget-inner-list">
                         <h4>News</h4>
                         <?php foreach ($post_cat_two as $post_cat_twos){?>
                            <li>
                               <a href="<?php echo site_url('Portal/post_details/'.$post_cat_twos->TITLE_ID.'/'.$post_cat_twos->PG_URI); ?>" <?php echo $post_cat_twos->BODY_DESC; ?></a>
                            </li>
                             <p class="blog-list-meta small-text">
                                                <span><a href="#"><?php echo date('d-m-Y - H:i:s', strtotime($post_cat_twos->CRE_DT)); ?></a></span>
                                            </p>
                                             <?php } ?>
                           
                        
                        </ul>

  </div>
  <div id="menu1" class="tab-pane fade">
    
     <ul class="widget-inner-list">
                         <h4>Photo</h4>
                             <div class="widget-inner" >
                            <div class="gallery-small-thumbs clearfix">
                                 <?php foreach($gallery as $galleries){?>
                                    <div class="thumb-small-gallery">
                                        <a class="fancybox" rel="gallery1" href="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" title="Forest">
                                            <img src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>"/>

                                        </a>

                                    </div>
                                    <?php } ?>  
                            </div>


                       
                        </div>
                           
                        
                        </ul>

  </div>
  <div id="menu2" class="tab-pane fade">
   
        <ul class="widget-inner-list">
                           <h4>Video</h4>
                           <iframe width="340" height="150" src="https://www.youtube.com/embed/HHRNqtLLLeI" frameborder="0" allowfullscreen></iframe>
                        
                           
                        
                            </ul>
  </div>
</div>
                        

                        
                       
                        <a href="#" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a><br><br>
                    </div>
                </div>


                      <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("events"); ?></h4>
                        </div>
                        


                        <ul class="widget-inner-list">
                        <h4>Latest event</h4>
                        <?php foreach ($post_cat_three_latest as $post_cat_threes){?>
                        <p class="blog-list-meta small-text">
                                                <span><a href="#"><?php echo date('l,F j,Y', strtotime($post_cat_threes->CRE_DT)); ?></a></span>
                                            </p>
                            <li>
                                <a href="<?php echo site_url('Portal/post_details/'.$post_cat_threes->TITLE_ID.'/'.$post_cat_threes->PG_URI); ?>"><?php echo $post_cat_threes->BODY_DESC; ?></a>
                            </li>

                              <?php } ?>
                       </ul>

                         <ul class="widget-inner-list">
                        <h4>Upcoming event</h4>
                        <?php foreach ($post_cat_three_upcoming as $post_cat_threes){?>
                        <p class="blog-list-meta small-text">
                                                <span><a href="#"><?php echo date('l,F j,Y', strtotime($post_cat_threes->CRE_DT)); ?></a></span>
                                            </p>
                            <li>
                                <a href="<?php echo site_url('Portal/post_details/'.$post_cat_threes->TITLE_ID.'/'.$post_cat_threes->PG_URI); ?>"><?php echo $post_cat_threes->BODY_DESC; ?></a>
                            </li>

                              <?php } ?>
                       </ul>


                        <a href="#" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a><br><br>
                    </div>
                </div>


                     <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("quick_link"); ?></h4>
                        </div>
                        <ul class="widget-inner-list">
                        <li ><?php
                           if(!$this->session->userdata('user_logged')){
                            ?><a href="<?php echo site_url('accounts/userLogin'); ?>"><?php echo $this->lang->line("allometric_equations"); ?></a>
                                <?php 
                            }else{ ?>
                                <a href="<?php echo site_url('data/allometricEquationView'); ?>"><?php echo $this->lang->line("allometric_equations"); ?></a>
                                  <?php 
                            }
                            
                           ?>
                           </li>
                             <li ><?php
                           if(!$this->session->userdata('user_logged')){
                            ?><a href="<?php echo site_url('accounts/userLogin'); ?>"><?php echo $this->lang->line("raw_data"); ?></a>
                                <?php 
                            }else{ ?>
                                <a href="<?php echo site_url('data/rawDataView'); ?>"><?php echo $this->lang->line("raw_data"); ?></a>
                                  <?php 
                            }
                            
                           ?>
                           </li>
                            <li ><?php
                           if(!$this->session->userdata('user_logged')){
                            ?><a href="<?php echo site_url('accounts/userLogin'); ?>"><?php echo $this->lang->line("Wood_densities"); ?></a>
                                <?php 
                            }else{ ?>
                                <a href="<?php echo site_url('data/woodDensitiesView'); ?>"><?php echo $this->lang->line("Wood_densities"); ?></a>
                                  <?php 
                            }
                            
                           ?>
                           </li>
                             <li ><?php
                           if(!$this->session->userdata('user_logged')){
                            ?><a href="<?php echo site_url('accounts/userLogin'); ?>"><?php echo $this->lang->line("biomass_expansion_factor"); ?></a>
                                <?php 
                            }else{ ?>
                                <a href="<?php echo site_url('data/biomassExpansionFacView'); ?>"><?php echo $this->lang->line("biomass_expansion_factor"); ?></a>
                                  <?php 
                            }
                            
                           ?>
                           </li>
                          <li ><?php
                           if(!$this->session->userdata('user_logged')){
                            ?><a href="<?php echo site_url('accounts/userLogin'); ?>"><?php echo $this->lang->line("species_list"); ?></a>
                                <?php 
                            }else{ ?>
                                <a href="<?php echo site_url('data/speciesData'); ?>"><?php echo $this->lang->line("species_list"); ?></a>
                                  <?php 
                            }
                            
                           ?>
                           </li>
                            
                           </ul>
                        <a href="" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a><br><br>
                    </div>
                </div>


             
                
                </div>

    <br><div class="row contents_row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- <div class="widget-main" style="padding-top: 15px;">
                        <div class="widget-main-title">
                            <h4 class="widget-title"><?php echo $this->lang->line("gallery"); ?></h4>
                        </div>
                        <div class="widget-inner">
                            <div class="gallery-small-thumbs clearfix">
                                 <?php foreach($gallery as $galleries){?>
                                    <div class="thumb-small-gallery">
                                        <a class="fancybox" rel="gallery1" href="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" title="Forest">
                                            <img src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>"/>

                                        </a>

                                    </div>
                                    <?php } ?>  
                            </div>


                       
                        </div>
                    </div> -->
                    </div>
                    </div>
               
