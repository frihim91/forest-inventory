

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
            <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("raw_data"); ?>
            </div>
            <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("raw_data"); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 page_content">
<a href="<?php echo site_url('data/rawDataView'); ?>" style="background-color:#396C15;border-color:#396C15;" class="btn btn-info" role="button"><< Back</a>
   <div class="col-md-12">
      <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Raw Data</h2>
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
               foreach($rawDataDetails as $row)
               {
               ?>
            <ul class="dropdown-menu" role="menu">
               <!--  <li><a href="#" id="export-txt">Download TXT (Tab Delimited UTF-16)</a></li> -->
               <li><a href="<?php echo site_url('Portal/rawDataDetailsPdf/'.$row->ID); ?>" target="_blank" id="export-json">Download PDF</a></li>
               <!-- <li><a href="#" id="export-xml">Download XML</a></li> -->
            </ul>
            <?php 
               }?>
         </div>
         </form>
      </div>
      <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Record Details</h3>
      <div class="row">
         <div class="col-md-12">
            <br>
            <table class="table">
               <tr>
                  <th style="width:210px"> DBH (cm): </th>
                  <td> <b> <?php echo $row->DBH_cm;?>
                     </b>
                  </td>
               </tr>
               <tr>
                  <th> Total Tree Height (m): </th>
                  <td>
                     <?php echo $row->H_m;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px"> Crown Diameter (m): </th>
                  <td> <?php echo $row->CD_m;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fresh Bole Weight (kg): </th>
                  <td><?php echo $row->F_Bole_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fresh Branch Weight (kg): </th>
                  <td><?php echo $row->F_Branch_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fresh Foliage Weight (kg): </th>
                  <td><?php echo $row->F_Foliage_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fresh Stump Weight (kg): </th>
                  <td><?php echo $row->F_Stump_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fresh Buttress Weight (kg): </th>
                  <td><?php echo $row->F_Buttress_kg;?></td>
               </tr>
                <tr>
                  <th style="width:210px"> Fresh Fruit Weight (kg): </th>
                  <td><?php echo $row->F_Fruit_kg;?></td>
               </tr>
                <tr>
                  <th style="width:210px"> Fresh Bark Weight (kg): </th>
                  <td><?php echo $row->F_Bark_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Fresh Roots Weight (kg): </th>
                  <td><?php echo $row->F_Roots_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Total Tree Volume (m3): </th>
                  <td><?php echo $row->Volume_m3;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px"> Bole Volume (m3): </th>
                  <td><?php echo $row->Volume_bole_m3;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Tree Wood Density Avg (g/cm3): </th>
                  <td><?php echo $row->WD_AVG_gcm3;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Dry Bole Weight (kg): </th>
                  <td><?php echo $row->D_Bole_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Dry Branch Weight (kg): </th>
                  <td><?php echo $row->D_Branch_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Dry Foliage Weight (kg): </th>
                  <td><?php echo $row->D_Foliage_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Dry Stump Weight (kg): </th>
                  <td><?php echo $row->D_Stump_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Dry Buttress Weight (kg): </th>
                  <td><?php echo $row->D_Buttress_kg;?></td>
               </tr>
                <tr>
                  <th style="width:210px"> Dry Bark Weight (kg): </th>
                  <td><?php echo $row->D_Bark_kg;?></td>
               </tr>

                <tr>
                  <th style="width:210px"> Dry Stem with Bark Weight (g): </th>
                  <td><?php echo $row->D_Stem_with_Bark_g;?></td>
               </tr>
                <tr>
                  <th style="width:210px"> Dry Stem without Bark Weight (g): </th>
                  <td><?php echo $row->D_Stem_without_Bark_g;?></td>
               </tr>
                 <tr>
                  <th style="width:210px"> Dry Stem without Bark Weight (kg): </th>
                  <td><?php echo $row->D_Stem_without_Bark_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Dry Roots Weight (kg): </th>
                  <td><?php echo $row->D_Roots_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Total Aboveground Mass (kg): </th>
                  <td><?php echo $row->ABG_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Total Belowground Mass (kg): </th>
                  <td><?php echo $row->BGB_kg;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Total Biomass (kg): </th>
                  <td><?php echo $row->Volume_bole_m3;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Remark: </th>
                  <td><?php echo $row->Remark;?></td>
               </tr>
             <!--   <tr>
                  <th style="width:210px"> Contact: </th>
                  <td><?php echo $row->Contact;?></td>
               </tr> -->
            </table>
         </div>
      </div>
   <div class="row">    
    <div class="col-md-12">
        <br>
        <h3 class="section-header">Components</h3>
        <table class="table">
            <tbody><tr>
             
                <td>
                
                </td>
            </tr>
        </tbody></table> 
        <img src="<?php echo base_url('resources/images/component.png')?>" class="img-responsive" width="300">
        <br><br>
    </div>
</div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">Idendification</h3>
            <table class="table">
               <tr>
                  <th> Tree type: </th>
                  <td><?php echo $row->Tree_type;?></td>
               </tr>
               <tr>
                  <th> Vegetation type: </th>
                  <td> <?php echo $row->Vegetation_type;?></td>
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
      <thead>
        
       <tr class="bg-success">
           <th>Family:</th>
          <th>Genus:</th>
          <th>Species:</th>
          <th>Subspecies:</th>
          <!-- <th>Author:</th> -->
          <th>Local Names:</th>
      </tr>
    </thead>
    <tbody>

     <?php
     $i = 1;
     foreach ($rawDataDetails_tax as $row) {
       ?>
       <tr>
        <td ><?php echo $row->family;?></td>
        <td ><?php echo $row->genus;?></td>
        <td><?php echo $row->species;?></td>
        <td>NA</td>
        <td ><?php if($row->localname!='') { ?>
                                   
              <?php echo $row->localname;?>
                                   
                <?php } else { ?>
                <p>NA</p>
                                        
          <?php  } ?></td>

      </tr>
      <?php
      $i++;
    }
    ?>
  </tbody>

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
                <tbody><tr>
                     <?php 
                     foreach($location as $row)
                     {
                     ?>
                    <td style="width:40%">
                        <table>
                            <tbody><tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Location Name: </th><td class="pdf-record-td"> <?php echo $row->location_name;?> </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th">Division: </th><td class="pdf-record-td"> <?php echo $row->Division;?> </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> District: </th><td class="pdf-record-td"> <?php echo $row->District;?> </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Upazila: </th><td class="pdf-record-td"> <?php echo $row->THANAME;?> </td></tr>
                             <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Union: </th><td class="pdf-record-td"> <?php echo $row->UNINAME;?> </td></tr>
                             <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Latitude: </th><td class="pdf-record-td"> <?php echo $row->LatDD;?> </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Longitude: </th><td class="pdf-record-td"> <?php echo $row->LongDD;?> </td></tr>
                        </tbody></table>
                    </td>
                    <td style="width:60%">
                        <table>
                            <tbody><tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th">FAO Biome: </th><td class="pdf-record-td"> <?php echo $row->FAOBiomes;?> </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> BFI Zone: </th><td class="pdf-record-td"> <?php echo $row->Zones;?> </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Bangladesh Agroecological Zone: </th><td class="pdf-record-td"> <?php echo $row->AEZ_NAME;?> </td></tr>
                        

                        </tbody></table>
                    </td>
                </tr>
              <?php 
          }?>
            </tbody></table>

<br>

<div id="point_map_canvas"></div>


</div>
</div>
<?php 
foreach($rawDataDetails as $row)
{
 ?>
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
                  <td><?php echo $row->Contributor_name;?></td>
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
                  <td>Raw Data </td>
               </tr>
                 <?php 
             }?>

            </table>
         </div>
      </div>
   </div>
</div>
</div>

