<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("video");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    
</script>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
// $(document).ready(function(){
//     $("#hide").click(function(){
//         $("video").hide();
//     });
//     $("#show").click(function(){
//         $("video").show();
//     });
// });
// </script>
<style type="text/css">

    .clickable{
        cursor: pointer;   
    }

    .panel-heading span {
        margin-top: -20px;
        font-size: 15px;
    }

    @import url('//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');

    .panel-success > .panel-heading-custom {
        background: #B2D497; color: #396C15;
    }

    .panel-success > .panel-heading-custom-gallery {
        background: #B2D497; color: #000000;
    }





    
</style>

<script type="text/javascript">
    $(document).on('click', '.panel-heading span.clickable_gallery', function(e){
        var $this = $(this);
        if(!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('#gallery_slider_thumbail').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('#gallery_slider_thumbail').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    })
    
</script>
<script type="text/javascript">
   $(document).ready(function() {
    $('.clickable_gallery').click(function() {

       $('#gallery_slider_thumbail').toggle("fade");

           //$("div.gallery_slider_large").hide();
       });
});

</script>

<script>
// $(document).ready(function(){
//     $(".clickable_gallery").click(function(){
//         $("div.gallery_slider_large").hide();
//     });
//     $(".clickable_gallery").click(function(){
//         $("div.gallery_slider_thumbail").show();
//     });
// });
// </script>
<div class="row">
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content" style="height: 300px; overflow-y: scroll;">
                        <h3 style="text-align: center;font-family:Century;font-weight:bold;"><?php echo $post_cat->TITLE_NAME;?></h3>
                        <p style="text-align:justify;font-family:Century;font-weight:580;"><?php echo $post_description->BODY_DESC;?></p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="slider">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;margin-top: -10px !important;">
                        <!-- Loading Screen -->
                        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
                        </div>
                        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">

                           <?php foreach($sliders as $slider){?>
                           <div data-p="137.50">
                            <img data-u="image" src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>" class="img-responsive"/>
                            <div class="caption" align="center" style="background-color: rgba(0, 0, 0, 0.6);width:750px; height:50px;position:absolute;bottom:0px;right:0px">
                              <p  style="color:white;font-size:20px;" align="center"><b><?php echo $slider->IMAGE_TITLE;?></b></p>
                          </div>
                          <!--  <div class="caption" style="position: absolute; top: 0; left:0px; width:400px; height:100px;" u="caption" ><p>Caption text</p></div> -->
                      </div>
                      <?php } ?> 
                      
                  </div>
                  <!-- Bullet Navigator -->
                <!--   <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                        </svg>
                    </div>
                </div> -->
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
                                            <h3 style="font-family:Century;font-weight:bold;"><img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/icon-rec.png')?>" src="img/icon-rec.png">Media</h3>
                                            <div class="photo">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading  panel-heading-custom-gallery">
                                                        <h4 class="panel-title" align="center" style="font-family:Century;font-weight:bold;"><b>Photo</b></h4>
                                                        <span class="pull-right clickable_gallery"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                                    </div>
                                                    
                                                    <div class="panel-body">

                                                       <div class="row">
                                                           <div class="col-sm-8">
                                                           <?php 
                                                           $i = 0;
                                                           foreach($gallery as $galleries)
                                                            if ($i == 3) { break; }
                                                            {?>
                                                                                                                 

                                                                <img  width ="240px" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>"  />
                                                                
                                                                <?php 
                                                                $i++;
                                                                } ?> 
                                                            <!--  <img width ="240px" src="<?php echo base_url('resources/images/home_page_gallery/1.jpg'); ?>" /> -->
                                                         </div>


                                                         <div class="col-sm-4">
                                                             <div id="gallery_slider_thumbail">
                                                                <?php foreach($gallery as $galleries){?>                                                    

                                                                <img  width ="40px" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>"  />

                                                                <?php } ?> 
                                                            </div>
                                                        </div>


                                                    </div>

                                                  <!--   <div id="gallery_slider">
                                                     <img data-u="image" src="<?php echo base_url('resources/images/home_page_gallery/1.jpg'); ?>" />
                                                        
                                                    </div>
                                                    <div class="gallery_slider_thumbail" style="display: none;">
                                                        <?php foreach($gallery as $galleries){?>                                                    

                                                          <img data-u="thumb" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" />
                                                    


                                                        <?php } ?> 
                                                        
                                                    </div> -->
                                                </div>
                                            </div>



                                        </div>
                                        <!--   <button onclick="myFunction()">Try it</button> -->
                                        <div class="video" style="margin-bottom: 10px;">
                                         <div class="panel panel-success" style="margin-top: 20px;">
                                            <div class="panel-heading  panel-heading-custom">
                                                <h4 class="panel-title" align="center" style="font-family:Century;font-weight:bold;"><b>Video</b></h4>
                                                <!-- <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span> -->
                                            </div>
                                            <div class="panel-body">
                                                <div class="embed-responsive embed-responsive-4by3">
                                                    <iframe src="http://www.youtube.com/embed/?listType=user_uploads&list=arfancu" 
                                                        width="320" height="318"></iframe>  
                                            </div></div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-8">
                                <div class="data-source">
                                    <h3><img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/icon-rec.png')?>" src="img/icon-rec.png">Data Sources</h3>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/allometricEquationView'); ?>" style="color: inherit;text-decoration: none;">Allometric Equation</a></span></h4>
                                        <p>The database will provide the allometric equationsavailable for the tree species of Bangladesh for biomass and volume calculation. It is compiled from the Forest management plans of Bangladesh Forest Department, Reports prepared by Bangladesh Forest Research Institute and scientific articles of different academics.</p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/rawDataView'); ?>" style="color: inherit;text-decoration: none;">Raw Data</a></span></h4>
                                        <p>Raw data is unprocessed primary data that are collected from field by Bangladesh Forest Department, Bangladesh Forest Research Institute and Universities and laboratory sources (e.g. tree diameter at breast height, total height, merchantable height, volume, biomass etc.). Raw data provide the basis of developing allometric equations, moreover this data can be reused by other researchers also.</p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/woodDensitiesView'); ?>" style="color: inherit;text-decoration: none;">Wood densities</a></span></h4>
                                        <p>The Wood density database will contain the necessary information related to wood density based on the laboratory analysis conducted by Bangladesh Forest Research Institute andUniversities. Collected wood density information of all available species are viewed in list. </p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/biomassExpansionFacView'); ?>" style="color: inherit;text-decoration: none;">Emission factors</a></span></h4>
                                        <p>The emission factor database provides Bangladesh-specific emission factors obtained from the review of literature to estimate greenhouse gas emissions accurately and removals for the forestry sector of Bangladesh based on Tier 2 approach. </p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/dataSpecies'); ?>" style="color: inherit;text-decoration: none;">Species List</a></span></h4>
                                        <p>The database is presenting a species list of Bangladesh. The list is organized by family and under each family all available genus and species information available in Bangladesh of that family is incorporated. Information related with number of allometric equations, raw data, wood density and emission factor for that species are available for the species. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>