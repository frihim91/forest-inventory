

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
   background-color: #000000 !important;
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
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("raw_data"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("raw_data"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 page_content">
   <h3>Raw Data Search</h3>
   <div class="col-sm-12">
      <ul class="nav nav-tabs">
         <li class="<?php if(!isset($searchType)){ echo 'active'; } ?>" ><a data-toggle="tab" href="#home">Keyword</a></li>
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
            "><a data-toggle="tab" href="#menu4">Raw Data</a></li>
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
            <p> Search allometric equations by keyword. 
               This searches accross several text fields. 
               <br>
               Example searches: <a href="#">Euphorbiaceae</a>,
               <a href="#">Euphorbiaceae</a>,
               <a href="#">Excoecaria </a>, 
               <a href="#">Excoecaria agallocha</a>,
               <a href="#">Tropical moist forest</a>
            </p>
            <p>
            </p>
            <form action="<?php echo site_url('portal/search_rawequation_key');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Keyword<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name = "keyword" value ="<?php echo (isset($keyword))?$keyword:'';?>" class ="keyword" maxlength="64" placeholder="Keyword" /><br>
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
               }  ?>
         ">
            <p>Search by tree height and volume.</p>
            <form action="<?php echo site_url('portal/search_rawequation_raw');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Tree Height (m)<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="H_m" value = "<?php echo (isset($H_m))?$H_m:'';?>"   class ="h_m" maxlength="64" placeholder="Tree Height (m)" />
                  </div>
                  <div class="form-group">
                     <label>Volume (m3)<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Volume_m3" value = "<?php echo (isset($Volume_m3))?$Volume_m3:'';?>"  class ="volume_m3" maxlength="64" placeholder="Volume (m3)" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
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
               <a href="#">Euphorbiaceae</a>,
               <a href="#">Excoecaria</a>, 
               <a href="#">Excoecaria agallocha</a>,
            </p>
            <form action="<?php echo site_url('portal/search_rawequation_tax');?>" method = "post">
               <div class="col-md-6">
               <div class="form-group">
              <label>Family<span style="color:red;"></span></label>
              <input type="text" class="form-control input-sm" name ="Family" value = "<?php echo (isset($Family))?$Family:'';?>"  class ="Family" maxlength="64" placeholder="Family" />
               </div>
                  <div class="form-group">
                     <label>Genus<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Genus" value = "<?php echo (isset($Genus))?$Genus:'';?>"  class ="Genus" maxlength="64" placeholder="Genus" />
                  </div>
                  <div class="form-group">
                     <label>Species<span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Species" value = "<?php echo (isset($Species))?$Species:'';?>"  maxlength="64"  class ="Species" placeholder="Species" />
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
               <a href="#">Tropical dry forest</a>,
               <a href="#">Country: Benin</a>, 
            </p>
            <form action="<?php echo site_url('portal/search_rawequation_loc');?>" method = "post">
               <div class="col-md-6">
                <div class="form-group">
                   
                     <label>Division<span style="color:red;"></span></label>
                    <!--  <input type="text" class="form-control input-sm" name ="Division" value = "<?php echo (isset($Division))?$Division:'';?>"  class ="division" maxlength="64" placeholder="Division" /> -->
                      <?php
                     $ID_Divisions = $this->Forestdata_model->get_all_division();
                     $options = array('' => '--Select Division--');
                     foreach ($ID_Divisions as $ID_Division) {
                     $options["$ID_Division->Division"] = $ID_Division->Division;
                     }
                     $ID_Division = set_value('Division');
                     echo form_dropdown('Division', $options, $ID_Division, 'id="ID_Division" style="width:620px;" class="form-control singleSelectExample" data-placeholder="Choose a Division..." ');
                     ?>   
                  </div>
                  <div class="form-group">
                   
                     <label>District<span style="color:red;"></span></label>
                    <!--  <input type="text" class="form-control input-sm" name ="District" value = "<?php echo (isset($District))?$District:'';?>" maxlength="64"  class ="District" placeholder="District" /> -->
                     <select class="form-control singleSelectExample" id="ID_District" style="width:620px;"  name="District">
                     <option value="">Select District</option>
                  </select>
                  </div>
                  <div class="form-group">
                     <h3>Ecological Zone</h3>
                     <label>FAO Global Ecological Zone <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="FAOBiomes" value = "<?php echo (isset($FAOBiomes))?$FAOBiomes:'';?>"  class ="fao_biome" maxlength="64" placeholder="FAO Global Ecological Zone" />
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
               Example searches: <a href="#"> Author: Khan, M.N.I. </a>,
               <a href="#">Reference:Allometric relationships</a>,
               <a href="#">Faruque, O.</a>, 
               <a href="#"> Year: 2010</a>, 
            </p>
            <form action="<?php echo site_url('portal/search_rawequation_ref');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Reference <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Reference" value = "<?php echo (isset($Reference))?$Reference:'';?>"  class ="reference" maxlength="200" placeholder="Reference" />
                  </div>
                  <div class="form-group">
                     <label>Author  <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Author" value ="<?php echo (isset($Author))?$Author:'';?>"  class ="author" maxlength="64" placeholder="Author" />
                  </div>
                  <div class="form-group">
                     <label>Year  <span style="color:red;"></span></label>
                     <input type="text" class="form-control input-sm" name ="Year" value ="<?php echo (isset($Year))?$Year:'';?>" maxlength="64" class ="year" placeholder="Year" />
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
                           if(isset($rawDataView_count)){
                            ?>
                            <?php echo count($rawDataView_count); ?>
                            

                             <?php 
                            }else{ ?>
                             <?php echo $this->db->count_all_results('rd');?>


                           
                                  <?php 
                            }
                            
                           ?>
    
     </span> </h4>
     <br><br>
    
    </div>

    <div class="col-lg-6">
      
      <h4> Search criteria</h4>
      
        <p> <?php
                           if(isset($rawDataView_count)){
                            ?>
                            <?php echo (isset($keyword))?$keyword:'';?>
                            
                            <?php echo (isset($Family))?$Family:'';?>
                            <?php echo (isset($Genus))?$Genus:'';?>
                            <?php echo (isset($Species))?$Species:'';?>
                            <?php echo (isset($District))?$District:'';?>
                             <?php echo (isset($Division))?$Division:'';?>
                             <?php echo (isset($FAOBiomes))?$FAOBiomes:'';?>
                             <?php echo (isset($Reference))?$Reference:'';?>
                            <?php echo (isset($Author))?$Author:'';?>
                            <?php echo (isset($Year))?$Year:'';?>
                            <?php echo (isset($H_m))?$H_m:'';?>
                           <?php echo (isset($Volume_m3))?$Volume_m3:'';?>
                            

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
         <li class="active"><a data-toggle="tab" href="#results-list" class="resultList"><span class="glyphicon glyphicon-list"></span> Results List</a></li>
         <li><a data-toggle="tab" href="#results-map" class="results-map"><span class="glyphicon glyphicon-globe "></span> Map View</a></li>
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
                            <li><a href="<?php echo site_url('Portal/rawDataViewcsv/'); ?>" id="export-json">Download CSV</a></li>
                            <li><a href="<?php echo site_url('Portal/rawDataViewjson/'); ?>" id="export-json">Download JSON</a></li>

                            <!-- <li><a href="#" id="export-xml">Download XML</a></li> -->
                          </ul>
                        </div>
                    <form>
                </div>
      </ul>
      <div class="tab-content">
         <div id="results-list" class="tab-pane fade in active">
            <?php 
               foreach($rawDataView as $row)
               {
               ?>
            <div class="panel panel-default">
               <div class="panel-heading">Raw Data
                  <a href="<?php echo site_url('Portal/rawDataDetails/'.$row->ID); ?>" class="btn btn-default pull-right btn-xs">Detailed information<span class="glyphicon glyphicon-chevron-right"></span></a>
               </div>
               <div class="panel-body">
                  <p style="padding-left:3px;"><b>Tree Height (H_m): </b><?php echo $row->H_m;?></p>
                  <p style="padding-left:3px;"><b>Tree Diameter (DBH_cm): </b><?php echo $row->DBH_cm;?></p>
                  <p style="padding-left:3px;"><b>Total Volume (Volume_m3): </b><?php echo $row->Volume_m3;?></p>
                  <p style="padding-left:3px;"><b>Reference: </b><?php echo $row->Reference;?></p>
                  <p style="padding-left:3px;"><b>Reference Year: </b><?php echo $row->Year;?></p>
                  <p style="padding-left:3px;"><b>Biomass: </b><?php echo $row->FAOBiomes;?></p>
                   <p style="padding-left:3px;"><b>Family: </b><?php echo $row->Family;?></p>
                  <p style="padding-left:3px;"><b>Species: </b><?php echo $row->Species;?></p>
                  <p style="padding-left:3px;"><b>Locations: </b><?php echo $row->District;?> (lat <?php echo $row->Latitude;?>,lon <?php echo $row->Longitude;?>)</p>
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

        $(document).on('keypress', '#Family', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_family'); ?>",
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



            $(document).on('keypress', '#h_m', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_h_m'); ?>",
                select: function (event, ui) {
                    $("#h_m" + id).val(ui.item.id);
                }
            });
        });

            $(document).on('keypress', '#volume_m3', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_volume_m3'); ?>",
                select: function (event, ui) {
                    $("#volume_m3" + id).val(ui.item.id);
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


              $(document).on('keypress', '#keyword', function () {
      
            var pattern = /[0-9]+/g;
            var id = $(this).attr('id').match(pattern);
            $(this).autocomplete({
                source: "<?php echo site_url('Portal/get_keyword_all'); ?>",
                select: function (event, ui) {
                    $("#keyword" + id).val(ui.item.id);
                }
            });
        });




</script>
<script>
// Setting default configuration here or you can set through configuration object as seen below
$.fn.select2.defaults = $.extend($.fn.select2.defaults, {
    allowClear: true, // Adds X image to clear select
    closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
    placeholder: 'Select...',
    minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
});

$(document).ready(

function () {

    // Single select example if using params obj or configuration seen above
    var configParamsObj = {
        placeholder: 'Select an option...', // Place holder text to place in the select
        minimumResultsForSearch: 3 // Overrides default of 15 set above
    };
    $(".singleSelectExample").select2(configParamsObj);
});
</script>
<script type="text/javascript">
   $(document).ready(function() {
       $('#ID_Division').change(function() {
           var Division = $(this).val();
           //var ID_Division = $(this).val();
           //alert(Division);
           var url = '<?php echo site_url('Portal/ajax_get_division') ?>';
           $.ajax({
               type: "POST",
               url: url,
               data: {Division:Division},
               dataType: 'html',
               success: function(data) {
                   $('#ID_District').html(data);
               }
           });
       });
   });
   
   
    $(document).ready(function() {
       $('#ID_District').change(function() {
           var District = $(this).val();
           //alert(District);
           var url = '<?php echo site_url('Portal/up_thana_by_dis_id') ?>';
           $.ajax({
               type: "POST",
               url: url,
               data: {District:District},
               dataType: 'html',
               success: function(data) {
                   $('#THANA_ID').html(data);
               }
           });
       });
   });
   
   
       $(document).ready(function() {
       $('#THANA_ID').change(function() {
           var THANAME = $(this).val();
           //alert(District);
           var url = '<?php echo site_url('Portal/up_union_by_dis_id') ?>';
           $.ajax({
               type: "POST",
               url: url,
               data: {THANAME:THANAME},
               dataType: 'html',
               success: function(data) {
                   $('#union_id').html(data);
               }
           });
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


    $.getJSON("<?php echo base_url(); ?>resources/mapRawdata.php",function(data){
      var ratIcon = L.icon({
        iconUrl: '<?php echo base_url(); ?>resources/final.png',
        iconSize: [19,30]
      });
      L.geoJson(data,{
        pointToLayer: function(feature,latlng){
          var marker = L.marker(latlng,{icon: ratIcon});

          marker.bindPopup('<b>RD: </b>'+feature.properties.ID);

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

