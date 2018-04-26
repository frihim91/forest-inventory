

<style type="text/css">
   .page_content{
   padding: 15px;
   background-color: white;
   margin-top: 15px;
   }
   .page_des_big_image{
   width: 100%;
   height: 300px;
   }
   .bdy_des{
   margin-top: 25px;
   }
   .breadcump{
   background-image: url("<?php echo base_url("resources/images/breadcump_image.jpg")?>");
   height: 103px;
   }
   .breadcump-wrapper{
  /* background-color: #000000 !important;*/
   opacity: 0.7;
   width: 100%;
   height:100%;
   }
   .wrapper{
   padding:30px !important;
   color: #FFFFFF;
   font-weight: bold;
   }
   .breadcump_row a{
   color: white;
   }
</style>
<?php
   $lang_ses = $this->session->userdata("site_lang");
   ?>
<div class="col-sm-12 breadcump img-responsive">
   <div class="row">
      <div class="breadcump-wrapper">
         <div class="wrapper">
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("Wood_densities"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("Wood_densities"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 page_content">
   <h3>Wood Density Search</h3>
   <div class="col-sm-12">
      <ul class="nav nav-tabs">
         <li class="<?php if(!isset($searchType)){ echo 'active'; } ?>"><a data-toggle="tab" href="#home">Keyword</a></li>
         <li class="
            <?php if(isset($searchType)){
               if($searchType==2)
               {
                 echo 'active';
               }
               else {
                 echo '';
               }
               }  ?>
            "
         ><a data-toggle="tab" href="#menu4">Wood Density</a></li>
         <li class="
            <?php if(isset($searchType)){
               if($searchType==3)
               {
                 echo 'active';
               }
               else {
                 echo '';
               }
               }  ?>
            "><a data-toggle="tab" href="#menu1">Taxonomy</a></li>
         <li class="
            <?php if(isset($searchType)){
               if($searchType==4)
               {
                 echo 'active';
               }
               else {
                 echo '';
               }
               }  ?>
            "><a data-toggle="tab" href="#menu2">Location</a></li>
         <li class="
            <?php if(isset($searchType)){
               if($searchType==5)
               {
                 echo 'active';
               }
               else {
                 echo '';
               }
               }  ?>
            "><a data-toggle="tab" href="#menu3">Reference</a></li>
      </ul>
      <div class="tab-content">
         <div id="home" class="tab-pane fade 
            <?php if(!isset($searchType)){ echo 'in active'; } ?>
            ">
            <p> Search Wood Density by keyword. 
               This searches accross several text fields. 
               <br>
               Example searches: <a href="#">Leguminosae</a>,
               <a href="#">Leguminosae</a>,
               <a href="#">Pongamia</a>, 
               <a href="#">Pongamia pinnata</a>,
               <a href="#">Bangladesh</a>
            </p>
            <p>
            </p>
            <form action="<?php echo site_url('portal/search_woodDensities_key');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Keyword<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name = "keyword" value = "<?php echo (isset($keyword))?$keyword:'';?>" maxlength="64" placeholder="Keyword" /><br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu4" class="tab-pane fade
         <?php if(isset($searchType)){
               if($searchType==2)
               {
                 echo 'in active';
               }
               else {
                 echo '';
               }
               }  ?>">
            <p>Search by tree height, diameter, and volume.</p>
            <form action="<?php echo site_url('portal/search_woodDensities_raw');?>" method = "post">
            <div class="row">
               <h4>Height</h4>
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Average Height <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="H_tree_avg" value = "<?php echo (isset($H_tree_avg))?$H_tree_avg:'';?>"  class ="h_tree_avg" maxlength="64" placeholder="Tree Height (m)" />
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                     <label>Minimum Height<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="H_tree_min" value = "<?php echo (isset($H_tree_min))?$H_tree_min:'';?>"  class ="h_tree_min" maxlength="64" placeholder="Volume (m3)" />
                     
                  </div>
               </div>

                 <div class="col-md-3">
                  <div class="form-group">
                     <label>Maximum Height<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="H_tree_max" value = "<?php echo (isset($H_tree_max))?$H_tree_max:'';?>" maxlength="64"  class ="h_tree_max" placeholder="Volume (m3)" />
                     
                  </div>
               </div>


               </div>

                        <div class="row">
               <h4>DBH</h4>
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Average DBH <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="DBH_tree_avg" value = "<?php echo (isset($DBH_tree_avg))?$DBH_tree_avg:'';?>" class ="dbh_tree_avg" maxlength="64" placeholder="Tree Height (m)" />
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                     <label>Minimum DBH<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="DBH_tree_min" value = "<?php echo (isset($DBH_tree_min))?$DBH_tree_min:'';?>" maxlength="64"  class ="dbh_tree_min" placeholder="Volume (m3)" />
                     
                  </div>
               </div>
                 <div class="col-md-3">
                  <div class="form-group">
                     <label>Maximum DBH<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="DBH_tree_max" value = "<?php echo (isset($DBH_tree_max))?$DBH_tree_max:'';?>" maxlength="64"  class ="dbh_tree_max" placeholder="Volume (m3)" />
                     
                  </div>
               </div>
                <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">


               </div>


            </form>
         </div>
         <div id="menu1" class="tab-pane fade
         <?php if(isset($searchType)){
               if($searchType==3)
               {
                 echo 'in active';
               }
               else {
                 echo '';
               }
               }  ?>">
            <p> Search allometric equations by family, genus or species.
               Example searches
               <br>
               Example searches: <a href="#">Genus</a>,
               <a href="#">Meliaceae</a>,
               <a href="#">Xylocarpus</a>, 
               <a href="#">moluccensis</a>,
            </p>
            <form action="<?php echo site_url('portal/search_woodDensities_tax');?>" method = "post">
               <div class="col-md-6">
                <div class="form-group">
              <label>Family<span style="color:red;"></span></label>
              <input type="text" class="form-control input-sm" name ="Family" value = "<?php echo (isset($Family))?$Family:'';?>" class ="Family" maxlength="64" placeholder="Family" />
               </div>
                  <div class="form-group">
                     <label>Genus<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Genus" value = "<?php echo (isset($Genus))?$Genus:'';?>" class ="Genus" maxlength="64" placeholder="Genus" />
                  </div>
                  <div class="form-group">
                     <label>Species<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Species" value = "<?php echo (isset($Species))?$Species:'';?>" class ="Species" maxlength="64" placeholder="Species" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu2" class="tab-pane fade
          <?php if(isset($searchType)){
               if($searchType==4)
               {
                 echo 'in active';
               }
               else {
                 echo '';
               }
               }  ?>">
            <p> Search allometric equations by tree location and biome.Example searches
               <br>
               Example searches: <a href="#">Biome (FAO):</a>,
               <a href="#">Tropical moist forest</a>,
               <a href="#">Country: Bangladesh</a>, 
            </p>
            <form action="<?php echo site_url('portal/search_woodDensities_loc');?>" method = "post">
               <div class="col-md-6">

               <div class="form-group">
                     
                     <label>Division<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Division" value = "<?php echo (isset($Division))?$Division:'';?>"  class ="division" maxlength="64" placeholder="Division" />
                  </div>
                  <div class="form-group">
                     
                     <label>District<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="District" value = "<?php echo (isset($District))?$District:'';?>"  class ="District" maxlength="64" placeholder="District" />
                  </div>
                  <div class="form-group">
                     <h3>Ecological Zone</h3>
                     <label>FAO Global Ecological Zone <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="EcoZones" value = "<?php echo (isset($EcoZones))?$EcoZones:'';?>"  class ="fao_biome" maxlength="64" placeholder="FAO Global Ecological Zone" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu3" class="tab-pane fade
         <?php if(isset($searchType)){
               if($searchType==5)
               {
                 echo 'in active';
               }
               else {
                 echo '';
               }
               }  ?>">
            <p> Search allometric equations by author, year, and reference.
               Example searches
               <br>
               Example searches: <a href="#"> Author: Sattar, MA /a>,
               <a href="#">Reference: Sattar MA 1981</a>,
               <a href="#">Sattar, MA</a>, 
               <a href="#"> Year: 1981</a>, 
            </p>
            <form action="<?php echo site_url('portal/search_woodDensities_ref');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Reference <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Reference" value = "<?php echo (isset($Reference))?$Reference:'';?>"  class ="reference" maxlength="200" placeholder="Reference" />
                  </div>
                  <div class="form-group">
                     <label>Author  <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Author" value = "<?php echo (isset($Author))?$Author:'';?>" class ="author" maxlength="64" placeholder="Author" />
                  </div>
                  <div class="form-group">
                     <label>Year  <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Year" value = "<?php echo (isset($Year))?$Year:'';?>" class ="year" maxlength="64" placeholder="Year" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> 
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-sm-12 bdy_des">
       <div class="row" style="background-color:#eee;border:1px solid #ddd;border-radius:4px;margin:0px 1px 20px 1px;">
 
    <div class="col-lg-6">
     
     <h4>Result count: <span id="summary-results-total">
    
       <?php
                           if(isset($woodDensitiesView_count)){
                            ?>
                            <?php echo count($woodDensitiesView_count); ?>
                            

                             <?php 
                            }else{ ?>
                             <?php echo $this->db->count_all_results('wd');?>


                           
                                  <?php 
                            }
                            
                           ?>
    
     </span> </h4>
     <br><br>
    
    </div>

    <div class="col-lg-6">
      
      <h4> Search criteria</h4>
      
        <p> <?php
                           if(isset($woodDensitiesView_count)){
                            ?>
                             <?php echo (isset($keyword))?$keyword:'';?>
                             <?php echo (isset($H_tree_avg))?$H_tree_avg:'';?>
                             <?php echo (isset($H_tree_min))?$H_tree_min:'';?>
                             <?php echo (isset($H_tree_max))?$H_tree_max:'';?>
                             <?php echo (isset($DBH_tree_avg))?$DBH_tree_avg:'';?>
                             <?php echo (isset($DBH_tree_min))?$DBH_tree_min:'';?>
                             <?php echo (isset($DBH_tree_max))?$DBH_tree_max:'';?>
                             <?php echo (isset($Family))?$Family:'';?>
                            <?php echo (isset($Genus))?$Genus:'';?>
                            <?php echo (isset($Species))?$Species:'';?>
                            <?php echo (isset($District))?$District:'';?>
                             <?php echo (isset($Division))?$Division:'';?>
                            <?php echo (isset($EcoZones))?$EcoZones:'';?>
                            <?php echo (isset($Reference))?$Reference:'';?>
                            <?php echo (isset($Author))?$Author:'';?>
                            <?php echo (isset($Year))?$Year:'';?>
                          
                            

                             <?php 
                            }
                            else{ ?>
                             No criteria - All results are shown


                           
                                  <?php 
                            }
                            
                           ?></p>
      
    </div>

</div>
      <ul class="nav nav-tabs">
         <li class="active"><a data-toggle="tab" href="#results-list"  class="resultList"><span class="glyphicon glyphicon-list"></span> Results List</a></li>
         <li><a data-toggle="tab" href="#results-map" class="results-map"><span class="glyphicon glyphicon-globe"></span> Map View</a></li>
         <div style="float:right;">
            <form action='export/' id="export-form" method="POST">
            <input type='hidden' name='csrfmiddlewaretoken' value='EUSnAj1qQRRf6anXMDF1cWRSTLAwax2J' />
            <input type="hidden" name="query" id="export-query" />
            <input type="hidden" name="extension" id="export-extension" />
            <div class="btn-group">
               <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
               <span class="glyphicon glyphicon-download"></span> Export Results <span class="caret"></span>
               </button>
               <ul class="dropdown-menu" role="menu">
                  <!--  <li><a href="#" id="export-txt">Download TXT (Tab Delimited UTF-16)</a></li> -->
                   <li><a href="<?php echo site_url('Portal/woodDensityViewcsv/'); ?>" id="export-json">Download CSV</a></li>
                  <li><a href="<?php echo site_url('Portal/woodDensityViewjson/'); ?>" id="export-json">Download JSON</a></li>
                  <!-- <li><a href="#" id="export-xml">Download XML</a></li> -->
               </ul>
            </div>
            <form>
         </div>
      </ul>
      <div class="tab-content">
         <div id="results-list" class="tab-pane fade in active">
            <?php 
               foreach($woodDensitiesView as $row)
               {
               ?>
            <div class="panel panel-default">
               <div class="panel-heading">Wood densities
                  <a href="<?php echo site_url('Portal/woodDensitiesDetails/'.$row->ID_WD); ?>" class="btn btn-default pull-right btn-xs">Detailed information<span class="glyphicon glyphicon-chevron-right"></span></a>
               </div>
               <div class="panel-body">
                  <dl class="dl-horizontal">
                  <dt style="font-size:15px;"><small>Density g/cm3</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Density_green;?></small></dd> 
                  <dt style="font-size:15px;"><small>Reference</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Author;?>.<?php echo $row->Reference;?></small></dd> 
                  <dt style="font-size:15px;"><small>Reference Year</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Year;?></small></dd> 
                  <dt style="font-size:15px;"><small>Family</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Family;?></small></dd>
                  <dt style="font-size:15px;"><small>Species</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Species;?></small></dd>
                  <dt style="font-size:15px;"><small>Locations</small></dt> <dd style="font-size:15px;"><small>lat <?php echo $row->Latitude;?>,lon <?php echo $row->Longitude;?></small></dd> 
                  <!-- <p style="padding-left:3px;"><b>Density g/cm3: </b><?php echo $row->Density_green;?></p>
                  <p style="padding-left:3px;"><b>Reference: </b><?php echo $row->Reference;?></p>
                  <p style="padding-left:3px;"><b>Reference Year: </b><?php echo $row->Year;?></p>
                  <p style="padding-left:3px;"><b>Family: </b> <?php echo $row->Family;?></p>
                  <p style="padding-left:3px;"><b>Species: </b> <?php echo $row->Species;?></p>
                  <p style="padding-left:3px;"><b>Locations: </b>lat <?php echo $row->Latitude;?>,lon <?php echo $row->Longitude;?></p> -->

                  <dl> 
               </div>
            </div>
            <?php 
               }?>
            <p><?php echo $links; ?></p>
         </div>
         <div id="results-map" class="tab-pane fade">
            <link rel="stylesheet" href="<?php echo base_url(); ?>resources/js/leaflet/leaflet.css" />
            <script src="<?php echo base_url(); ?>resources/js/leaflet/leaflet.js"></script>
            <style type="text/css">
               #map{ height: 100% }
            </style>
            </div>
      
      </div>
   </div>
</div>
</div>

<div class="row mapBlock" style="display:none">
      <div class="col-md-12" style="height:500px!important;width:100%">
        <div id="map"></div>
        <script>
        // initialize the map


        </script>
      </div>
    </div>

            <script type="text/javascript">
     $(document).on('keypress', '#Genus', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_genus'); ?>",
                select: function (event, ui) {
                    $("#Genus" + id).val(ui.item.id);
                }
            });
        });
      $(document).on('keypress', '#Species', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_species'); ?>",
                select: function (event, ui) {
                    $("#Species" + id).val(ui.item.id);
                }
            });
        });

      $(document).on('keypress', '#District', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_district'); ?>",
                select: function (event, ui) {
                    $("#District" + id).val(ui.item.id);
                }
            });
        });


       $(document).on('keypress', '#division', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_division'); ?>",
                select: function (event, ui) {
                    $("#division" + id).val(ui.item.id);
                }
            });
        });


            $(document).on('keypress', '#ecoZones', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_ecological_zones'); ?>",
                select: function (event, ui) {
                    $("#ecoZones" + id).val(ui.item.id);
                }
            });
        });

             $(document).on('keypress', '#reference', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_reference'); ?>",
                select: function (event, ui) {
                    $("#reference" + id).val(ui.item.id);
                }
            });
        });


               $(document).on('keypress', '#author', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_author'); ?>",
                select: function (event, ui) {
                    $("#author" + id).val(ui.item.id);
                }
            });
        });


                       $(document).on('keypress', '#year', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_year'); ?>",
                select: function (event, ui) {
                    $("#year" + id).val(ui.item.id);
                }
            });
        });

            $(document).on('keypress', '#fao_biome', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_fao_biome'); ?>",
                select: function (event, ui) {
                    $("#fao_biome" + id).val(ui.item.id);
                }
            });
        });



              $(document).on('keypress', '#h_tree_avg', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_h_tree_avg'); ?>",
                select: function (event, ui) {
                    $("#h_tree_avg" + id).val(ui.item.id);
                }
            });
        });


            $(document).on('keypress', '#h_tree_min', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_h_tree_min'); ?>",
                select: function (event, ui) {
                    $("#h_tree_min" + id).val(ui.item.id);
                }
            });
        });


               $(document).on('keypress', '#h_tree_max', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_h_tree_max'); ?>",
                select: function (event, ui) {
                    $("#h_tree_max" + id).val(ui.item.id);
                }
            });
        });



          $(document).on('keypress', '#dbh_tree_avg', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_dbh_tree_avg'); ?>",
                select: function (event, ui) {
                    $("#dbh_tree_avg" + id).val(ui.item.id);
                }
            });
        });


           $(document).on('keypress', '#dbh_tree_min', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_dbh_tree_min'); ?>",
                select: function (event, ui) {
                    $("#dbh_tree_min" + id).val(ui.item.id);
                }
            });
        });


            $(document).on('keypress', '#dbh_tree_max', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_dbh_tree_max'); ?>",
                select: function (event, ui) {
                    $("#dbh_tree_max" + id).val(ui.item.id);
                }
            });
        });








</script>
<script type="text/javascript">
$(document).ready(function(){
  $("a.results-map").click(function(){
   //alert("find");
    $("div.mapBlock").show();
    var map = new L.Map('map', {center: new L.LatLng(23.8101, 90.4312), zoom: 7});
    var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(osm);


    $.getJSON("<?php echo base_url(); ?>resources/mapWddata.php",function(data){
      var ratIcon = L.icon({
        iconUrl: '<?php echo base_url(); ?>resources/final.png',
        iconSize: [19,30]
      });
      L.geoJson(data,{
        pointToLayer: function(feature,latlng){
          var marker = L.marker(latlng,{icon: ratIcon});

          marker.bindPopup('<b>WD: </b>'+feature.properties.ID_WD);

          return marker;
        }
      }).addTo(map);
    });

  });
});
$("a.resultList").click(function(){
  $("div.mapBlock").hide();
});
</script>



