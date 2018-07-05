
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
                        <h3><?php echo $post_cat->TITLE_NAME;?></h3>
                        <p><?php echo $post_description->BODY_DESC;?></p>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="slider">

      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div id="wrap">
              
             <ul id="carouel1">
               
              <?php foreach($sliders as $slider){?>
              <li>
                <div class="front">
                 <img src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>" />
               </div>
               <div class="back">
                 <img src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>" />
               </div>
             </li>
             <?php } ?>

             <div class="arrowButton">
              <div class="prevArrow"></div><div class="nextArrow"></div>      
            </div>
          </ul> 
        </div>


        
      </div>

    </div>
  </div>
</section>


                    <section class="data-source">
                              <div class="container">
                                  <div class="row">
                                     <h3 align="center" style="font-family: ahronbd;font-size: 22px">Data Sources</h3>
                                     <div class="col-sm-6">
                                          <div class="panel panel-default" style="background-color:#ACC697; border-color:#8FB07A">
                                            <!-- <div class="panel-body" style="max-height:600px;overflow-y: scroll;"> -->
                                              <div class="panel-body" style="height:220px;border: 5">
                                                <div class="dta dta0 dtaz">
                                                 <h4><span><a href="<?php echo site_url('data/allometricEquationView'); ?>" style="color: inherit;text-decoration: none;"><?php echo $post_cat_alometric->TITLE_NAME;?></a></span></h4>
                                                 <p><?php echo $post_cat_alometric->BODY_DESC;?> </p>
                                              </div>
                                            </div>
                                          </div>
                                     </div>
                                     <div class="col-sm-6">
                                       <div class="panel panel-default" style="background-color:#ACC697; border-color:#8FB07A">
                                            <div class="panel-body" style="height:220px;border: 5">
                                                   <div class="dta dta0 dtaz">
                                                      <h4><span><a href="<?php echo site_url('data/rawDataView'); ?>" style="color: inherit;text-decoration: none;"><?php echo $post_cat_raw_data->TITLE_NAME;?></a></span></h4>
                                                  <p><?php echo $post_cat_raw_data->BODY_DESC;?></p>
                                                </div>
                                            </div>
                                          </div>
                                     </div>

                                  </div>

                                    <div class="row">
                                    
                                     <div class="col-sm-6">
                                          <div class="panel panel-default" style="background-color:#ACC697; border-color:#8FB07A;">
                                            <div class="panel-body" style="height:240px;border: 5">
                                                <div class="dta dta0 dtaz">
                                                   <h4><span><a href="<?php echo site_url('data/woodDensitiesView'); ?>" style="color: inherit;text-decoration: none;"><?php echo $post_cat_wd_data->TITLE_NAME;?></a></span></h4>
                                                     <p><?php echo $post_cat_wd_data->BODY_DESC;?></p>
                                               </div>
                                            </div>
                                          </div>
                                     </div>
                                     <div class="col-sm-6">
                                       <div class="panel panel-default" style="background-color:#ACC697;border-color:#8FB07A;">
                                            <div class="panel-body" style="height:240px;border: 5">
                                                  <div class="dta dta0 dtaz">
                                                    <h4><span><a href="<?php echo site_url('data/biomassExpansionFacView'); ?>" style="color: inherit;text-decoration: none;"><?php echo $post_cat_ef_data->TITLE_NAME;?></a></span></h4>
                                                   <p><?php echo $post_cat_ef_data->BODY_DESC;?></p>
                                                 </div>
                                            </div>
                                          </div>
                                     </div>

                                  </div>

                                   <div class="row">
                                       <div class="col-sm-12">
                                          <div class="panel panel-default" style="background-color:#ACC697;border-color:#8FB07A;">
                                            <div class="panel-body" style="border: 5">
                                                     <div class="dta dta0 dtaz">
                                                        <h4><span><a href="<?php echo site_url('data/dataSpecies'); ?>" style="color: inherit;text-decoration: none;"><?php echo $post_cat_species_data->TITLE_NAME;?></a></span></h4>
                                                       <p><?php echo $post_cat_species_data->BODY_DESC;?></p>
                                                   </div>
                                            </div>
                                          </div>
                                     </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-sm-12">
                                          <div class="panel panel-default" style="background-color:#ACC697;border-color:#8FB07A;">
                                            <div class="panel-body" style="border: 5">
                                                      <div class="dta dta0 dtaz">
                                                         <h4><span><a href="<?php echo base_url('resources/images/post_pic/'.$post_cat_acronyms_data->IMG_URL)?>" target="_blank" style="color: inherit;text-decoration: none;"><?php echo $post_cat_acronyms_data->TITLE_NAME;?></a></span></h4>

                                    
                                                </div>
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
