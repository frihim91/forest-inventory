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
   #search-submit-holder, #tree-equation-footer {
   height: 45px;
   padding: 5px;
   background-color: #f4f4f4;
   border-top: 1px solid #d9d9d9;
   border-radius: 0px 0px 4px 4px;
   }
</style>
  

   
<?php

   $lang_ses = $this->session->userdata("site_lang");
   ?>
<div class="col-sm-12 breadcump img-responsive">
   <div class="row">
      <div class="breadcump-wrapper">
         <div class="wrapper">
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("allometric_equations"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("allometric_equations"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 page_content">
   <h3>Allometric Equation Search</h3>
   <div class="col-sm-12">
      <ul class="nav nav-tabs">
         <li class="active"><a data-toggle="tab" href="#home">Keyword</a></li>
         <li><a data-toggle="tab" href="#menu1">Taxonomy</a></li>
         <li><a data-toggle="tab" href="#menu2">Location</a></li>
         <li><a data-toggle="tab" href="#menu3">Reference</a></li>
      </ul>
      <div class="tab-content">
         <div id="home" class="tab-pane fade in active">
            <p> Search allometric equations by keyword. 
               This searches accross several text fields. 
               <br>
               Example searches: <a href="#">Acacia</a>,
               <a href="#">Zambia</a>,
               <a href="#">Bellefontaine</a>, 
               <a href="#">Glutinosum</a>,
               <a href="#">rainforest</a>
            </p>
            <p>
            </p>
            <form action="<?php echo site_url('portal/search_allometricequation_key');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Keyword<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name = "keyword" maxlength="64" placeholder="Keyword" /><br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu1" class="tab-pane fade">
            <p> Search allometric equations by family, genus or species.
               Example searches
               <br>
               Example searches: <a href="#">Genus</a>,
               <a href="#">Gmelina</a>,
               <a href="#">Species</a>, 
               <a href="#">schweinfurthii</a>,
            </p>
            <form action="<?php echo site_url('portal/search_allometricequation_tax');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Genus<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="Genus" maxlength="64" placeholder="Genus" />
                  </div>
                  <div class="form-group">
                     <label>Species<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="Species" maxlength="64" placeholder="Species" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu2" class="tab-pane fade">
            <p> Search allometric equations by tree location and biome.Example searches
               <br>
               Example searches: <a href="#">Biome (FAO):</a>,
               <a href="#">Tropical dry forest</a>,
               <a href="#">Country: Benin</a>, 
            </p>
            <form action="<?php echo site_url('portal/search_allometricequation_loc');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <h3>Country</h3>
                     <label>District<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="District" maxlength="64" placeholder="District" />
                  </div>
                  <div class="form-group">
                     <h3>Ecological Zone</h3>
                     <label>FAO Global Ecological Zone <span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="FAOBiomes" maxlength="64" placeholder="FAO Global Ecological Zone" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu3" class="tab-pane fade">
            <p> Search allometric equations by author, year, and reference.
               Example searches
               <br>
               Example searches: <a href="#"> Author: Henry M</a>,
               <a href="#">Reference: Pieper</a>,
               <a href="#"> Y. & Laumans,</a>, 
               <a href="#"> Year: 2004</a>, 
            </p>
            <form action="<?php echo site_url('portal/search_allometricequation_ref');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Reference <span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="Reference" maxlength="200" placeholder="Reference" />
                  </div>
                  <div class="form-group">
                     <label>Author  <span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="Author" maxlength="64" placeholder="Author" />
                  </div>
                  <div class="form-group">
                     <label>Year  <span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="Year" maxlength="64" placeholder="Year" />
                     <br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> 
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-sm-12 bdy_des">
      <ul class="nav nav-tabs">
         <li class="active"><a data-toggle="tab" href="#results-list"><span class="glyphicon glyphicon-list"></span> Results List</a></li>
         <li><a data-toggle="tab" class="results-map" href="#results-map"><span class="glyphicon glyphicon-globe"></span> Map View</a></li>
      </ul>
      <div class="tab-content">
         <div id="results-list" class="tab-pane fade in active">
            <?php 
               foreach($allometricEquationView as $row)
               {
               ?>
            <div class="panel panel-default">
               <div class="panel-heading">Allometric Equation
                  <a href="<?php echo site_url('Portal/allometricEquationDetails/'.$row->ID_Species); ?>" class="btn btn-default pull-right btn-xs">Detailed information<span class="glyphicon glyphicon-chevron-right"></span></a>
               </div>
               <div class="panel-body">
                  <p style="padding-left:3px;"><b>Equation:<code style="color:#c7254e;font-size: 14px;"><?php echo $row->Equation;?></code> </b></p>
                  <p style="padding-left:3px;"><b>Output:</b></p>
                  <p style="padding-left:3px;"><b>Reference:</b><?php echo $row->Reference;?></p>
                  <p style="padding-left:3px;"><b>Reference Year:</b><?php echo $row->Year;?></p>
                  <p style="padding-left:3px;"><b>FAO Biomes:</b><?php echo $row->FAOBiomes;?></p>
                  <p style="padding-left:3px;"><b>Species:</b> <?php echo $row->Family.' '.$row->Species;?></p>
                  <p style="padding-left:3px;"><b>Locations:</b><?php echo $row->District;?> (lat <?php echo $row->LatDD;?>,lon <?php echo $row->LongDD;?>)</p>
               </div>
            </div>
            <?php 
               }?>
            <p><?php echo $links; ?></p>
         </div>
         <div id="results-map" class="tab-pane fade">
		 <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
  <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
  <style>
    #map{ height: 100% }
  </style>
  <div class="row">
 
    <div class="col-md-12" style="height:500px!important; overflow:hidden">
       <div id="map"></div>

  <script>

  // initialize the map
var map = new L.Map('map', {center: new L.LatLng(23.8101, 90.4312), zoom: 7});
     var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
     map.addLayer(osm);
   
   
    $.getJSON("http://192.168.0.21/forest-inventory/resources/map.json",function(data){
    var ratIcon = L.icon({
      iconUrl: 'http://192.168.0.21/forest-inventory/resources/final.png',
      iconSize: [60,50]
    });
    L.geoJson(data,{
      pointToLayer: function(feature,latlng){
     var marker = L.marker(latlng,{icon: ratIcon});
  
   marker.bindPopup('<b>District : </b>'+feature.properties.ID_District );
  
  return marker;
      }
    }).addTo(map);
  });
 

  </script>

    </div>
  </div>
         </div>
      </div>
   </div>
</div>
