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

<div class="col-md-12 page_content">
    <div class="col-md-12">
                <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Raw Data</h2>
                
            </div>

  <div class="col-sm-12 bdy_des">
    <?php 
               foreach($rawDataDetails as $row)
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
            <table class="table" >
               <tr>
                  <th style="width:210px"> Components: </th>
                  <td >
                     <strong><em>
                     </em></strong>
                  </td>
               </tr>
            </table>
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
               <tr>
                  <th>Family:</th>
                  <th>Genus:</th>
                  <th>Species:</th>
                  <th>Subspecies:</th>
                  <th>Author:</th>
                  <th>Local Names:</th>
               </tr>
               <tr>
               <td align="center">
                  <?php echo $row->Family;?>
               </td>
               <td align="center">
                  <?php echo $row->Genus;?>
               </td>
               <td align="center">
                  <?php echo $row->Species;?>
               </td>
               <td align="center">NA</td>
               <td >None</td>
               <td align="center"><?php if($row->local_name!='') { ?>
                                   
               <?php echo $row->local_name;?>
                                   
                <?php } else { ?>
                <p>NA</p>
                                        
               <?php  } ?>
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
      <thead>
        <tr>
         <?php 
         foreach($rawDataDetails as $row)
         {
           ?>
           <th>FAO Biome:</th>
           <td><?php echo $row->FAOBiomes;?></td>
           <th>BFI Zone:</th>
           <td><?php echo $row->Zones;?></td>
           <th>Bangladesh Agroecological Zone:</th>
           <td><?php echo $row->AEZ_NAME;?></td>


         </tr>
         <?php 
       }?>
       <br>
       <tr class="bg-success">
        <th>Division</th>
        <th>District</th>
        <th>Upazila</th>
        <th>Union</th>
        <th>Latitute</th>
        <th>Longitute</th>
      </tr>
    </thead>
    <tbody>

     <?php
     $i = 1;
     foreach ($location as $row) {
       ?>
       <tr>
        <td align="center"><?php echo $row->Division;?></td>
        <td align="center"><?php echo $row->District;?></td>
        <td align="center"><?php echo $row->THANAME;?></td>
        <td align="center"><?php echo $row->UNINAME;?></td>
        <td align="center"><?php echo $row->LatDD;?></td>
        <td align="center"><?php echo $row->LongDD;?></td>
      </tr>
      <?php
      $i++;
    }
    ?>
  </tbody>

</table>
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
                  <td>RD </td>
               </tr>
                 <?php 
             }?>

            </table>
         </div>
      </div>
   </div>
</div>
</div>

