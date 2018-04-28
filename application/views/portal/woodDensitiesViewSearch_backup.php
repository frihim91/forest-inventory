

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
   /*background-color: #000000 !important;*/
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
         <li class="active"><a data-toggle="tab" href="#home">Keyword</a></li>
         <li><a data-toggle="tab" href="#menu4">Wood Density</a></li>
         <li><a data-toggle="tab" href="#menu1">Taxonomy</a></li>
         <li><a data-toggle="tab" href="#menu2">Location</a></li>
         <li><a data-toggle="tab" href="#menu3">Reference</a></li>
      </ul>
      <div class="tab-content">
         <div id="home" class="tab-pane fade in active">
            <p> Search Wood Density by keyword. 
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
            <form action="<?php echo site_url('portal/search_woodDensities_key');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Keyword<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name = "keyword" maxlength="64" placeholder="Keyword" /><br>
                     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
                  </div>
               </div>
            </form>
         </div>
         <div id="menu4" class="tab-pane fade">
            <p>Search by tree height, diameter, and volume.</p>
            <form action="<?php echo site_url('portal/search_rawequation_raw');?>" method = "post">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Tree Height (m)<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="HeightRange" maxlength="64" placeholder="Tree Height (m)" />
                  </div>
                  <div class="form-group">
                     <label>Volume (m3)<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="VolumeRange" maxlength="64" placeholder="Volume (m3)" />
                     <br>
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
               <a href="#"> Species</a>, 
               <a href="#">schweinfurthii</a>,
            </p>
            <form action="<?php echo site_url('portal/search_rawequation_tax');?>" method = "post">
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
            <form action="<?php echo site_url('portal/search_rawequation_tax');?>" method = "post">
               <div class="col-md-6">
                 <div class="form-group">
                     
                     <label>Division<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="Division" maxlength="64" placeholder="Division" />
                  </div>
                  <div class="form-group">
                    
                     <label>District<span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="District" maxlength="64" placeholder="District" />
                  </div>
                  <div class="form-group">
                     <h3>Ecological Zone</h3>
                     <label>FAO Global Ecological Zone <span style="color:red;">*</span></label>
                     <input type="text" class="form-control input-sm" name ="EcoZones" maxlength="64" placeholder="FAO Global Ecological Zone" />
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
            <form action="<?php echo site_url('portal/search_rawequation_ref');?>" method = "post">
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
         <li><a data-toggle="tab" href="#results-map"><span class="glyphicon glyphicon-globe"></span> Map View</a></li>
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
                  <p style="padding-left:3px;"><b>Density g/cm3:</b><?php echo $row->Density_green;?></p>
                  <p style="padding-left:3px;"><b>Reference:</b><?php echo $row->Reference;?></p>
                  <p style="padding-left:3px;"><b>Reference Year:</b><?php echo $row->Year;?></p>
                  <p style="padding-left:3px;"><b>Family:</b><?php echo $row->Family;?></p>
                  <p style="padding-left:3px;"><b>Species:</b> <?php echo $row->Species;?></p>
                  <p style="padding-left:3px;"><b>Locations:</b>Bangladesh</p>
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
            <div class="row">
               <div class="col-md-12" style="height:500px!important; overflow:hidden">
                  <div id="map"></div>
                  <script>
                     // initialize the map
                     var map = new L.Map('map', {center: new L.LatLng(23.8101, 90.4312), zoom: 7});
                        var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                        map.addLayer(osm);
                      
                      
                       $.getJSON("<?php echo base_url(); ?>resources/map.json",function(data){
                       var ratIcon = L.icon({
                         iconUrl: '<?php echo base_url(); ?>resources/final.png',
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

