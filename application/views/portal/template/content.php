<div class="row">
                    <section class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class=" content">
                                        <h2><?php echo $post_cat->CAT_NAME;?></h2>
                                         <p style="text-align: justify;"><?php echo substr($post_description->BODY_DESC,0,710);?><a href="<?php echo site_url('Portal/post_details/'.$post_cat->TITLE_ID.'/'.$post_cat->PG_URI); ?>" class="btn btn-more pull-right"><?php echo $this->lang->line("view_details"); ?></a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>



                    <section class="slider">

                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                                        <!-- Loading Screen -->
                                        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
                                        </div>
                                        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">

                                         <?php foreach($sliders as $slider){?>
                                            <div data-p="137.50">
                                                <img data-u="image" src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>" />
                                            </div>
                                        <?php } ?> 
                                             
                                        </div>
                                        <!-- Bullet Navigator -->
                                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- Arrow Navigator -->
                                        <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                           <!--  <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                                            </svg> -->
                                        </div>
                                        <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                           <!--  <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                                            </svg> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="data-source">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="media">
                                        <h3><img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/icon-rec.png')?>" src="img/icon-rec.png">Media</h3>
                                        <div class="photo">
                                            <p>Photo</p>
                                            <div id="jssor_2" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                                                <!-- Loading Screen -->
                                                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/img/spin.svg" />
                                                </div>
                                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">

                                                 <?php foreach($gallery as $galleries){?>                                                    

                                                    <div data-p="150.00">
                                                        <img data-u="image" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" />
                                                        <img data-u="thumb" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" />
                                                    </div>


                                                     <?php } ?> 
                                                    
                                                    
                                                    
                                                </div>
                                                <!-- Thumbnail Navigator -->
                                                <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;background-color:#000;" data-autocenter="2" data-scale-left="0.75">
                                                    <div data-u="slides">
                                                        <div data-u="prototype" class="p" style="width:99px;height:66px;">
                                                            <div data-u="thumbnailtemplate" class="t"></div>
                                                            <svg viewbox="0 0 16000 16000" class="cv">
                                                                <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                                                                <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                                                                <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Arrow Navigator -->
                                                <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2">
                                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                        <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                                        <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                                        <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                                    </svg>
                                                </div>
                                                <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2">
                                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                        <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                                        <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                                        <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                                    </svg>
                                                </div>
                                            </div>
                                            <script type="text/javascript">jssor_2_slider_init();</script>
                                            
                                        </div>
                                        <div class="video">
                                            <p>Video</p>
                                            <iframe width="350" height="318"
                                            src="https://www.youtube.com/embed/HHRNqtLLLeI">

                                        </iframe>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-8">
                                <div class="data-source">
                                    <h3><img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/icon-rec.png')?>" src="img/icon-rec.png">Data Sources</h3>
                                    <div class="dta dta0 dtaz">
                                        <h4><span>Allometric Equation</span></h4>
                                        <p>The database will provide the allometric equationsavailable for the tree species of Bangladesh for biomass and volume calculation. It is compiled from the Forest management plans of Bangladesh Forest Department, Reports prepared by Bangladesh Forest Research Institute and scientific articles of different academics.</p>
                                    </div>
                                    <div class="dta dta1 dtaz">
                                        <h4><span>Raw Data</span></h4>
                                        <p>Raw data is unprocessed primary data that are collected from field by Bangladesh Forest Department, Bangladesh Forest Research Institute and Universities and laboratory sources (e.g. tree diameter at breast height, total height, merchantable height, volume, biomass etc.). Raw data provide the basis of developing allometric equations, moreover this data can be reused by other researchers also.</p>
                                    </div>
                                    <div class="dta dta2 dtaz">
                                        <h4><span>Wood densities</span></h4>
                                        <p>The Wood density database will contain the necessary information related to wood density based on the laboratory analysis conducted by Bangladesh Forest Research Institute andUniversities. Collected wood density information of all available species are viewed in list. </p>
                                    </div>
                                    <div class="dta dta3 dtaz">
                                        <h4><span>Emission factors</span></h4>
                                        <p>The emission factor database provides Bangladesh-specific emission factors obtained from the review of literature to estimate greenhouse gas emissions accurately and removals for the forestry sector of Bangladesh based on Tier 2 approach. </p>
                                    </div>
                                    <div class="dta dta4 dtaz">
                                        <h4><span>Species List</span></h4>
                                        <p>The database is presenting a species list of Bangladesh. The list is organized by family and under each family all available genus and species information available in Bangladesh of that family is incorporated. Information related with number of allometric equations, raw data, wood density and emission factor for that species are available for the species. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



            </div>