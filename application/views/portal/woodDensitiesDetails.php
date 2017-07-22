

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
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("Wood_densities"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("Wood_densities"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 page_content">
   <div class="col-md-12">
      <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Wood Density</h2>
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
            <?php 
               foreach($woodDensitiesDetails as $row)
               {
               ?>
            <ul class="dropdown-menu" role="menu">
               <!--  <li><a href="#" id="export-txt">Download TXT (Tab Delimited UTF-16)</a></li> -->
               <li><a href="<?php echo site_url('Portal/woodDensitiesPdf/'.$row->ID_WD); ?>" id="export-json">Download PDF</a></li>
               <!-- <li><a href="#" id="export-xml">Download XML</a></li> -->
            </ul>
            <?php 
               }?>
         </div>
         <form>
      </div>
      <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Record Details</h3>
      <div class="row">
         <div class="col-md-12">
            <br>
         
            <table class="table">
               <tr>
                  <th style="width:210px"> Density (g/cm3): </th>
                  <td>  <?php echo $row->Density_green;?>
                  </td>
               </tr>
               <tr>
                  <th> Tree height avg: </th>
                  <td><?php echo $row->H_tree_avg;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px"> Tree height min: </th>
                  <td><?php echo $row->H_tree_min;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Tree height max: </th>
                  <td><?php echo $row->H_tree_max;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Tree DBH avg: </th>
                  <td><?php echo $row->DBH_tree_avg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Tree DBH min: </th>
                  <td><?php echo $row->DBH_tree_min;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Tree DBH max: </th>
                  <td><?php echo $row->DBH_tree_max;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Wood mass: </th>
                  <td><?php echo $row->m_WD;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Mass Moisture Content: </th>
                  <td><?php echo $row->MC_m;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Wood volume: </th>
                  <td><?php echo $row->V_WD;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px"> Volume Moisture Content: </th>
                  <td><?php echo $row->MC_V;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Coefficient of Retraction: </th>
                  <td><?php echo $row->CR;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fiber Saturation Point (%): </th>
                  <td><?php echo $row->FSP;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Methodology: </th>
                  <td><?php echo $row->Methodology_Green;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Bark: </th>
                  <td><?php echo $row->Bark;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Moisture Content Density: </th>
                  <td><?php echo $row->Methodology_Ovendry;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Data origin: </th>
                  <td><?php echo $row->Data_origin;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Data type: </th>
                  <td><?php echo $row->Data_type;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Samples per tree: </th>
                  <td><?php echo $row->Samples_per_tree;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Number of trees: </th>
                  <td><?php echo $row->Number_of_trees;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Standard Deviation: </th>
                  <td><?php echo $row->SD;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Min of Wood Density: </th>
                  <td><?php echo $row->Min;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Max of Wood Density: </th>
                  <td><?php echo $row->Max;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Height sample collected: </th>
                  <td><?php echo $row->H_measure;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Bark distance: </th>
                  <td><?php echo $row->Bark_distance;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Convert BD: </th>
                  <td><?php echo $row->Convert_BD;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> CV: </th>
                  <td><?php echo $row->CV;?></td>
               </tr>
            </table>
          
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">Idendification</h3>
            
            <table class="table">
               <tr>
                  <th style="width:210px"> Tree type: </th>
                  <td> <?php echo $row->Tree_type;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Vegetation type: </th>
                  <td><?php echo $row->Vegetation_type;?></td>
               </tr>
            </table>
          
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">
               Taxonomy
               <span style="color:#999;font-size:11px;font-weight:normal;">
               &nbsp;&nbsp;&nbsp;&nbsp;
               </span>
            </h3>
          
            <table class="table">
               <tr>
                  <th>Family:</th>
                  <th>Genus:</th>
                  <th>Species:</th>
                  <th>Subspecies:</th>
                  <th>Author:</th>
                  <th>Local Names:</th>
               </tr>
               <td >
                  <?php echo $row->Family;?>
               </td>
               <td>
                  <?php echo $row->Genus;?>
               </td>
               <td>
                  <?php echo $row->Species;?>
               </td>
               <td ><?php echo $row->Subspecies;?></td>
               <td><?php echo $row->Author;?>
               </td>
               <td>None</td>
               </tr>
            </table>
            
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">
               Locations
               <span style="color:#999;font-size:11px;font-weight:normal;">
               &nbsp;&nbsp;&nbsp;&nbsp;
               </span>
            </h3>
         
            <table class="table">
               <tr>
                  <td style="width:40%">
                     <table>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Location Name: </th>
                           <td  class="pdf-record-td">
                              <?php echo $row->District;?>
                           </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Region/Province: </th>
                           <td  class="pdf-record-td"> <?php echo $row->Region;?> </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Country: </th>
                           <td  class="pdf-record-td"> Bangladesh </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Continent: </th>
                           <td  class="pdf-record-td">  </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Latitude: </th>
                           <td  class="pdf-record-td"> 
                              <?php echo $row->Latitude;?>
                           </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Longitude: </th>
                           <td  class="pdf-record-td">
                              <?php echo $row->Longitude;?>
                           </td>
                        </tr>
                     </table>
                  </td>
                  <td style="width:60%">
                     <table>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> FAO Global Ecological Zone: </th>
                           <td class="pdf-record-td">
                              <?php echo $row->FAOBiomes;?>
                           </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Udvardy Ecoregion: </th>
                           <td  class="pdf-record-td"> <?php echo $row->Ecoregion_Udvardy;?> </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> WWF Terrestrial Ecoregion: </th>
                           <td class="pdf-record-td"> <?php echo $row->Ecoregion_WWF;?> </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Division Bailey: </th>
                           <td class="pdf-record-td"><?php echo $row->Division_Bailey;?>  </td>
                        </tr>
                        <tr>
                           <th class="pdf-record-th"> Holdridge Life Zone:</th>
                           <td  class="pdf-record-td"> 
                              <?php echo $row->Zone_Holdridge;?>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
          
            <br>
            <div id="point_map_canvas"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">Reference</h3>
          
            <table class="table">
               <tr>
                  <th style="width:210px"> Reference: </th>
                  <td> 
                     <?php echo $row->Reference;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px"> Author: </th>
                  <td>
                     <?php echo $row->Author;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px"> Year: </th>
                  <td> 
                     <?php echo $row->Year;?>
                  </td>
               </tr>
            </table>
           
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">Contributor</h3>
      
            <table class="table">
               <tr>
                  <th style="width:210px">Contributor:</th>
                  <td> <?php echo $row->Contributor;?></td>
               </tr>
            </table>
          
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">Dataset</h3>
            <table class="table">
               <tr>
                  <th style="width:210px">Dataset:</th>
                  <td>wd</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>
</div>

