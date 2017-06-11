

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

<div class="col-md-12 page_content">
   <div class="col-md-12">
      <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Biomass Expansion Factor</h2>
   </div>
   <div class="col-sm-12 bdy_des">
       <?php 
               foreach($biomassExpansionFacDetails as $row)
               {
               ?>

               <?php 
               }?>
    
      <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Record Details</h3>
      <div class="row">
    
         <div class="col-md-12">
            <br>
            <table class="table">
               <tr>
                  <th style="width:210px"> Biomass Expansion Factor: </th>
                  <td> <b>
                     <?php echo $row->Value;?>
                     </b>
                  </td>
               </tr>
               <tr>
                  <th> Growing Stock: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Aboveground Biomass: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Net Annual Increment: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Stand Density: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Age: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Input: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Output: </th>
                  <td></td>
               </tr>
               <tr>
                  <th>Interval Validity: </th>
                  <td></td>
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
                  <th> Tree type: </th>
                  <td><?php echo $row->Tree_type;?> </td>
               </tr>
               <tr>
                  <th> Vegetation type: </th>
                  <td> <?php echo $row->Vegetation_type;?> </td>
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
               <tr>
               <td >
                  <?php echo $row->Family;?>
               </td>
               <td>
                  <?php echo $row->Genus;?>
               </td>
               <td>
                  <?php echo $row->Species;?>
               </td>
               <td > <?php echo $row->Subspecies;?></td>
               <td >None</td>
               <td >
               </td>
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
                           </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Region/Province: </th>
                           <td  class="pdf-record-td">  </td>
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
                           <td class="pdf-record-td"> 
                              <?php echo $row->latitude;?>
                           </td>
                        </tr>
                        <tr>
                           <th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Longitude: </th>
                           <td  class="pdf-record-td">
                              <?php echo $row->longitude;?>
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
                           <td class="pdf-record-td"><?php echo $row->Ecoregion_WWF;?>  </td>
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
                  <th> Reference: </th>
                  <td> 
                     <?php echo $row->Reference;?>
                  </td>
               </tr>
               <tr>
                  <th> Author: </th>
                  <td>
                     <?php echo $row->Author;?>
                  </td>
               </tr>
               <tr>
                  <th> Year: </th>
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
                  <td>EF </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>
</div>

