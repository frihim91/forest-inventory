
<style media="screen">
.fullWidth,.videoDiv{
padding: 5px!important;
}
.sideDiv{
padding: 0px!important;
margin-top: 5px;
}
img.thumbImg{
margin-bottom: 2px!important;
}
.fake-link {
color: blue;
text-decoration: underline;
cursor: pointer;
}

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

#myImg {
border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
}

/* Caption of Modal Image */
#caption {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
text-align: center;
color: #ccc;
padding: 10px 0;
height: 150px;
}

/* Add Animation */
.modal-content, #caption {
-webkit-animation-name: zoom;
-webkit-animation-duration: 0.6s;
animation-name: zoom;
animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
from {-webkit-transform:scale(0)}
to {-webkit-transform:scale(1)}
}

@keyframes zoom {
from {transform:scale(0)}
to {transform:scale(1)}
}

/* The Close Button */
.close {
position: absolute;
top: 15px;
right: 35px;
color: #f1f1f1;
font-size: 40px;
font-weight: bold;
transition: 0.3s;
}

.close:hover,
.close:focus {
color: #bbb;
text-decoration: none;
cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
.modal-content {
    width: 100%;
}
}


</style>
<style type="text/css">
.btn-primary,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:visited,
.btn-primary:focus {
    background: #CCE5B9;
    border-color: #CCE5B9;
}</style>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

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
                                                         <div class="col-sm-12 fullWidth ">


                                                           <?php if(!empty($feature_image)){

                                                              ?>

                                                              <img id="myImg"  width ="100%" class="img-responsive imgBody" alt="<?php echo $feature_image->GALLERY_TITLE?>" src="<?php echo base_url('resources/images/home_page_gallery/'.$feature_image->IMAGE_PATH); ?>"  />

                                                              <?php } else {?>
                                                              <img width ="100%" class="img-responsive" src="<?php echo base_url(); ?>asset/forest_demo.jpg" alt="User Photo"/>
                                                              <?php } ?>
                                                              <!-- The Modal -->



                                                          </div>




                                                          <div class="col-sm-3 sideDiv" style="display:none">
                                                           <div id="gallery_slider_thumbail">
                                                            <?php foreach($gallery as $galleries){?>

                                                            <a  class="fake-link" imgId="<?php echo $galleries->ID?>">  <img id="myImg" width ="40px" alt="<?php echo $galleries->GALLERY_TITLE?>"  class="thumbImg" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>"  /></a>

                                                            <?php } ?>
                                                        </div>
                                                    </div>



                                                </div>


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
                                        <div class="panel-body videoDiv">

                                            <div class="embed-responsive embed-responsive-4by3 ">
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
                                        <p>The database will provide the allometric equations available for the tree species of Bangladesh for biomass and volume calculation. It is compiled from the Forest management plans of Bangladesh Forest Department, Reports prepared by Bangladesh Forest Research Institute and scientific articles of different academics.</p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/rawDataView'); ?>" style="color: inherit;text-decoration: none;">Raw Data</a></span></h4>
                                        <p>Raw data is unprocessed primary data that are collected from field by Bangladesh Forest Department, Bangladesh Forest Research Institute and Universities and laboratory sources (e.g. tree diameter at breast height, total height, merchantable height, volume, biomass etc.). Raw data provide the basis of developing allometric equations, moreover this data can be reused by other researchers also.</p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/woodDensitiesView'); ?>" style="color: inherit;text-decoration: none;">Wood densities</a></span></h4>
                                        <p>The Wood density database will contain the necessary information related to wood density based on the laboratory analysis conducted by Bangladesh Forest Research Institute and Universities. Collected wood density information of all available species are viewed in list. </p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/biomassExpansionFacView'); ?>" style="color: inherit;text-decoration: none;">Emission factors</a></span></h4>
                                        <p>The emission factor database provides Bangladesh-specific emission factors obtained from the review of literature to estimate greenhouse gas emissions accurately and removals for the forestry sector of Bangladesh based on Tier 2 approach. </p>
                                    </div>
                                    <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo site_url('data/dataSpecies'); ?>" style="color: inherit;text-decoration: none;">Species List</a></span></h4>
                                        <p>The database is presenting a species list of Bangladesh. The list is organized by family and under each family all available genus and species information available in Bangladesh of that family is incorporated. Information related with number of allometric equations, raw data, wood density and emission factor for that species are available for the species. </p>
                                    </div>

                                      <div class="dta dta0 dtaz">
                                        <h4><span><a href="<?php echo base_url('resources/resource_potal/document/acronyms.pdf')?>" target="_blank" style="color: inherit;text-decoration: none;"><button type="button" style="width: 550px;text-align: left;color: black"  class="btn btn-primary">Documentation on definitions of acronyms</button></a></span></h4>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>
<script type="text/javascript">
    var count = 0;
    $(document).on('click', '.panel-heading span.clickable_gallery', function(e){
    //var $this = $(this);
    count+= 1;
    if(count%2==0)
    {
      $("div.sideDiv").hide();
      $("div.fullWidth").removeClass("col-md-9");
      $("div.fullWidth").addClass("col-md-12");
      $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');

  }
  else
  {
      $("div.sideDiv").show();
      $("div.fullWidth").removeClass("col-md-12");
      $("div.fullWidth").addClass("col-md-9");
      $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  }
})
     $(document).on('click', 'a.fake-link', function(e){
       var imageId=$(this).attr("imgId");
       var destination='<?php echo site_url("portal/getImageForSlider") ?>'+'/'+imageId;
  //alert(destination);
  $.ajax({
      type: "GET",
      url: destination,
      success: function (data) {
        $("div.fullWidth").html(data);
        //$("div.myImg").html(data);
        //  $("div.ajaxLoad").fadeIn(1500);
        //  $('div.ajaxLoader').hide();
    }
});
});
    var modal = document.getElementById('myModal');
    $(document).on('click', 'img.imgBody', function(e){
        var imgId=$(this).attr('id');
        var alterText=$(this).attr("alt");
        var img = document.getElementById(imgId);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        //console.log(img);
        // alert(img);
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = alterText;
        var span = document.getElementsByClassName("close")[0];

       // When the user clicks on <span> (x), close the modal
        span.onclick = function(e) {
          var keyCode=e.keyCode;
        modal.style.display = "none";
        }


    });
    $(document).keyup(function(e) {
      var keyCode=e.keyCode;
      //alert(keyCode);
     if (e.keyCode == 27) { // escape key maps to keycode `27`
        modal.style.display = "none";  // <DO YOUR WORK HERE>
    }
    });

</script>
