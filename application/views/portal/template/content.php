    <style>
        .img_sister_con {
            margin-right: 43px;
        }
        .tender_item .widget-inner {
            padding-top: 10px;
            padding-bottom: 0px;
        }
        ul.widget-inner-list li{
          display: block ! important;
        }
      .widget-inner-list>li>a{
       /* display: block !important;*/
      }
      .widget-inner-list>li>p{
        display: block;
    font-size: 11px;
    color: #000;
    padding-left: 8px;
    margin: 0px;
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
                
                                    <img class="slider_img img-responsive" style="width: 100% !important; height: auto ! important;"src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>"/>

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
                       <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("media"); ?></h4>
                        </div>

                        <ul class="nav nav-tabs">
 <!--  <li class="active"><a data-toggle="tab" href="#home">News</a></li> -->
  <li class="active"><a data-toggle="tab" href="#menu1">Photo</a></li>
  <li><a data-toggle="tab" href="#menu2">Video</a></li>
</ul>

<div class="tab-content">

  <div id="menu1" class="tab-pane fade in active">
    
     <ul class="widget-inner-list">
                         <!-- <h4>Photo</h4> -->
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
                           <!-- <h4>Video</h4> -->
                           <iframe width="340" height="150" src="https://www.youtube.com/embed/HHRNqtLLLeI" frameborder="0" allowfullscreen></iframe>
                        
                           
                        
                            </ul>
  </div>
</div>
                        

                        
                       
                       <!--  <a href="#" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a> --><br><br>
                    </div>
                </div>




                     <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="widget-main">
                        <div class="widget-main-title info_header_style">
                            <h4 class="widget-title"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $this->lang->line("quick_link"); ?></h4>
                        </div>
                        <ul class="widget-inner-list">
                        <li ><a href="<?php echo site_url('data/allometricEquationView'); ?>"><?php echo $this->lang->line("allometric_equations"); ?></a>
                          
                          <p style="text-align: justify;">The database will provide the allometric equationsavailable for the tree species of Bangladesh for biomass and volume calculation. It is compiled from the Forest management plans of Bangladesh Forest Department, Reports prepared by Bangladesh Forest Research Institute and scientific articles of different academics. </p>
                           </li>
                             <li>
                                <a href="<?php echo site_url('data/rawDataView'); ?>"><?php echo $this->lang->line("raw_data"); ?></a>
                                  <p style="text-align: justify;">Raw data is unprocessed primary data that are collected from field by Bangladesh Forest Department, Bangladesh Forest Research Institute and Universities and laboratory sources (e.g. tree diameter at breast height, total height, merchantable height, volume, biomass etc.). Raw data provide the basis of developing allometric equations, moreover this data can be reused by other researchers also.</p>
                           </li>
                            <li >
                                <a href="<?php echo site_url('data/woodDensitiesView'); ?>"><?php echo $this->lang->line("Wood_densities"); ?></a>
                                <p style="text-align: justify;">The Wood density database will contain the necessary information related to wood density based on the laboratory analysis conducted by Bangladesh Forest Research Institute andUniversities. Collected wood density information of all available species are viewed in list. </p>
                           </li>
                             <li >
                                <a href="<?php echo site_url('data/biomassExpansionFacView'); ?>"><?php echo $this->lang->line("biomass_expansion_factor"); ?></a>
                                <p style="text-align: justify;">The emission factor database provides Bangladesh-specific emission factors obtained from the review of literature to estimate greenhouse gas emissions accurately and removals for the forestry sector of Bangladesh based on Tier 2 approach. </p>
                           </li>
                          <li >
                                <a href="<?php echo site_url('data/speciesData'); ?>"><?php echo $this->lang->line("species_list"); ?></a>
                                <p style="text-align: justify;">The database is presenting a species list of Bangladesh. The list is organized by family and under each family all available genus and species information available in Bangladesh of that family is incorporated. Information related with number of allometric equations, raw data, wood density and emission factor for that species are available for the species.</p>
                           </li>
                            
                           </ul>
                        <!--   <a href="" class="btn btn-more pull-right"><?php echo $this->lang->line("more"); ?></a> --><br><br>
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
               
