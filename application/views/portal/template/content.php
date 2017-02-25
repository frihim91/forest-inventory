    <style>
        .img_sister_con {
            margin-right: 43px;
        }
        .tender_item .widget-inner {
            padding-top: 10px;
            padding-bottom: 0px;
        }
		.slider_img{
			width:760px !important;
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
								
                                    <img class="slider_img" src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>"/>

                                    <div class="slider-caption">
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
                        
                     
                      <?php echo $post_description->BODY_DESC;?><a href="<?php echo site_url('Portal/post_details/'.$post_cat->TITLE_ID.'/'.$post_cat->PG_URI); ?>" class="btn btn-more pull-right"><?php echo $this->lang->line("view_details"); ?></a> 
                       
                       <!--  <a href="#" class="btn btn-more pull-right">View Details</a> -->
                    </div>


         


        </div> 

    </div>
          <div class="row contents_row">
          <br><br>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("news"); ?></h4>
                        </div>
                        <ul class="widget-inner-list">
                         <?php foreach ($post_cat_two as $post_cat_twos){?>
                            <li>
                               <a href="<?php echo site_url('Portal/post_details/'.$post_cat_twos->TITLE_ID.'/'.$post_cat_twos->PG_URI); ?>" <?php echo $post_cat_twos->BODY_DESC; ?></a>
                            </li>
                             <p class="blog-list-meta small-text">
                                                <span><a href="#"><?php echo date('d-m-Y - H:i:s', strtotime($post_cat_twos->CRE_DT)); ?></a></span>
                                            </p>
                                             <?php } ?>
                           
                        
                        </ul>
                        <a href="#" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a><br><br>
                    </div>
                </div>


                      <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("events"); ?></h4>
                        </div>

                        <ul class="widget-inner-list">
                        <?php foreach ($post_cat_three as $post_cat_threes){?>
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
                         <?php foreach ($post_cat_four as $post_cat_fours){?>
                    
                            <li>
                                <a href="<?php echo site_url('Portal/post_details/'.$post_cat_fours->TITLE_ID.'/'.$post_cat_fours->PG_URI); ?>"><?php echo $post_cat_fours->BODY_DESC; ?></a>
                            </li>
                             <?php } ?>
                            
                           </ul>
                        <a href="" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a><br><br>
                    </div>
                </div>


             
                
                </div>

    <br><div class="row contents_row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="widget-main" style="padding-top: 15px;">
                        <div class="widget-main-title">
                            <h4 class="widget-title"><?php echo $this->lang->line("gallery"); ?></h4>
                        </div>
                        <div class="widget-inner">
                            <div class="gallery-small-thumbs clearfix">
                                
                                    <div class="thumb-small-gallery">
                                        <a class="fancybox" rel="gallery1" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/gallery/1.jpg" title="Forest">
                                            <img src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/gallery/1-small.jpg" alt=""/>

                                        </a>

                                    </div>


                                    <div class="thumb-small-gallery">
                                        <a class="fancybox" rel="gallery1" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/gallery/2.jpg" title="Forest">
                                            <img src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/gallery/2-small.jpg" alt=""/>
                                        </a>

                                    </div>

                                    <div class="thumb-small-gallery">
                                        <a class="fancybox" rel="gallery1" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/gallery/3.jpg" title="Forest">
                                            <img src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/gallery/3-small.jpg" alt=""/>
                                        </a>
                                    </div>
                               
                            </div>


                       
                        </div>
                    </div>
                    </div>
               
