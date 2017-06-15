

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
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("species_list"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("species_list"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 page_content">
   <div class="col-md-12">
      <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Species List</h2>
      <p>Click on a family in the list below for more information on the species in that family.</p>
   </div>
   <div class="col-sm-12 bdy_des">
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
               <li><a href="<?php echo site_url('Portal/speciesListViewjson/'); ?>" id="export-json">Download JSON</a></li>
               <!-- <li><a href="#" id="export-xml">Download XML</a></li> -->
            </ul>
         </div>
         <form>
      </div>
      <div class="row">
         <div class="panel-group" id="accordion">
            <?php 
               $i=0;
               foreach($family_details as $row)
               {
               ?>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="panel-title">
                     <a data-toggle="collapse" style="font-family:Tahoma, Verdana, Segoe, sans-serif; font-weight: 400;font-size:20px;color:inherit;" data-parent="#accordion" href="#collapse<?php echo $i; ?>" >
                     <?php echo $row->Family;?> </a> (<?php echo $row->GENUSCOUNT;?> Genus, <?php echo $row->SPECIESCOUNT;?> Species)
                  </h4>
               </div>
               <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                     <?php 
                        $species = $this->Forestdata_model->get_family_species_genus($row->ID_Family);
                        
                        ?>
                     <div class="panel-group" id="accord<?php echo $i; ?>">
                        <?php 
                           $j=0;
                           foreach($species as $species_list){
                           ?>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" style="font-family:Tahoma, Verdana, Segoe, sans-serif; font-weight: 400;font-size:17px;color:#555;" data-parent="#accord<?php echo $i; ?>" href="#collap<?php echo $i.$j; ?>">
                                 <?php echo $species_list->NAME;?></a>
                              </h4>
                           </div>
                           <div id="collap<?php echo $i.$j; ?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php 
                                    $speciesId = $this->Forestdata_model->get_location_data_type($species_list->ID_Species);
                                    
                                     ?>
                                 <!--            <p style="padding-left:3px;">
                                    <b>Wood Density : 
                                    <?php 
                                       $totalNumberC = sizeof($speciesId) - 1 ;
                                       foreach($speciesId as $key => $speciesIds){ ?>
                                     <?php echo $speciesIds->WoodDensity;?>  
                                     <?php 
                                       if($totalNumberC != $key)
                                         echo ", ";
                                       }
                                       ?>
                                        
                                      </b>
                                      </p>
                                    
                                    <p style="padding-left:3px;">
                                    <b>Description: 
                                    <?php 
                                       $totalNumberC = sizeof($speciesId) - 1 ;
                                       foreach($speciesId as $key => $speciesIds){ ?>
                                     <?php echo $speciesIds->Description;?>  
                                     <?php 
                                       if($totalNumberC != $key)
                                         echo ", ";
                                       }
                                       ?>
                                        
                                      </b>
                                      </p> -->
                                 <p><b>Data in FAO Biomes :
                                    <?php 
                                       $totalNumber = sizeof($speciesId) - 1 ;
                                       foreach($speciesId as $key => $speciesIds){ 
                                         ?><?php echo $speciesIds->FAOBiomes;?> 
                                    <?php 
                                       if($totalNumber != $key)
                                         echo ", ";
                                       }
                                       ?>
                                    </b>
                                 </p>
                                 <p style="padding-left:41px;">
                                    <b>Types of data : <a href="<?php echo site_url('Portal/allometricEquationViewSpeciesData/'.$species_list->ID_Species); ?>" style="color:#147A00;">Allometric Equations</a>
                                    <?php 
                                       $species_type_data = $this->Forestdata_model->get_data_type($speciesIds->ID_Species);
                                       ?> <?php 
                                       foreach($species_type_data as $row)
                                       {
                                       ?>
                                    (<?php echo $row->TOTAL_EQN;?>)
                                    <?php 
                                       }?>
                                    </b><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <b><a href="<?php echo site_url('Portal/biomassExpansionFacSpeciesView/'.$species_list->ID_Species); ?>" style="color:#147A00;">Emission Factors (EF)</a>
                                    <?php 
                                       $species_type_data_ef = $this->Forestdata_model->get_data_type_ef($speciesIds->ID_Species);
                                       ?> <?php 
                                       foreach($species_type_data_ef as $row)
                                       {
                                       ?>
                                    (<?php echo $row->TOTAL_EQN;?>)
                                    <?php 
                                       }?>
                                    </b>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <b><a href="<?php echo site_url('Portal/woodDensitiesSpeciesView/'.$species_list->ID_Species); ?>" style="color:#147A00;">Wood Density (WD) </a>
                                    <?php 
                                       $species_type_data_wd = $this->Forestdata_model->get_data_type_wd($speciesIds->ID_Species);
                                       ?> <?php 
                                       foreach($species_type_data_wd as $row)
                                       {
                                       ?>
                                    (<?php echo $row->TOTAL_EQN;?>)
                                    <?php 
                                       }?>
                                    </b>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <b><a href="<?php echo site_url('Portal/rawDataSpeciesView/'.$species_list->ID_Species); ?>" style="color:#147A00;">Raw Data</a>
                                    <?php 
                                       $species_type_data_rd = $this->Forestdata_model->get_data_type_rd($speciesIds->ID_Species);
                                       ?> <?php 
                                       foreach($species_type_data_rd as $row)
                                       {
                                       ?>
                                    (<?php echo $row->TOTAL_EQN;?>)
                                    <?php 
                                       }?>
                                    </b>
                                   
                                    <p style="text-align: justify;width: 980px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Description:</b>
                                     <?php 
                                       $botanical_description = $this->Forestdata_model->get_botanical_description($speciesIds->ID_Species);
                                       ?> <?php 
                                       foreach($botanical_description as $row)
                                       {
                                       ?>
                                    <?php echo $row->description;?>
                                    <?php 
                                       }?>
                                     </p>
                                 </p>
                                 <br>
                              </div>
                           </div>
                        </div>
                        <?php 
                           $j++;
                           }
                           ?>
                     </div>
                  </div>
               </div>
            </div>
            <?php 
               $i++;
               }
               ?>
         </div>
      </div>
   </div>
</div>

