

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
      <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Emission factors</h2>
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
                  <th style="width:210px"> Emission Factor: </th>
                  <td> <b>
                     <?php echo $row->EmissionFactor;?>
                     </b>
                  </td>
               </tr>
               <tr>
                  <th> Value: </th>
                  <td> <?php echo $row->Value;?></td>
               </tr>
               <tr>
                  <th>Units: </th>
                  <td><?php echo $row->Unit;?></td>
               </tr>
               <tr>
                  <th>Lower confidence limit: </th>
                  <td><?php echo $row->Lower_Confidence_Limit;?></td>
               </tr>
               <tr>
                  <th>Upper confidence limit: </th>
                  <td><?php echo $row->Upper_Confidence_Limit;?></td>
               </tr>
              <tr>
                  <th>Type of parameter: </th>
                  <td><?php echo $row->Type_of_Parameter;?></td>
               </tr>
               <tr>
                  <th>Age Range: </th>
                  <td><?php echo $row->Age_yr;?></td>
               </tr>
               <tr>
                  <th>Height Range: </th>
                  <td><?php echo $row->Height_m;?></td>
               </tr>
               <tr>
                  <th>Volume Range: </th>
                  <td><?php echo $row->Volume_m3_ha;?></td>
               </tr>
                <tr>
                  <th>Basal Area: </th>
                  <td><?php echo $row->Basal_m2_ha;?></td>
               </tr>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <br>
            <h3 class="section-header">Idendification</h3>
            <table class="table">
             <!--   <tr>
                  <th> Tree type: </th>
                  <td><?php echo $row->Tree_type;?> </td>
               </tr> -->
               <tr>
                  <th>Land Cover: </th>
                  <td> <?php echo $row->LandCover;?> </td>
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
     foreach ($biomassExpansionFacDetails_tax as $row) {
       ?>
       <tr>
        <td align="center"><?php echo $row->family;?></td>
        <td align="center"><?php echo $row->genus;?></td>
        <td align="center"><?php echo $row->species;?></td>
        <td align="center">NA</td>
        <td align="center"><?php if($row->localname!='') { ?>
                                   
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
      <thead>
        <tr>
         <?php 
         foreach($biomassExpansionFacDetails as $row)
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
        <th>Location Name</th>
        <th>Division</th>
        <th>District</th>
        <th>Upazila</th>
        <th>Union</th>
        <th>Latitude</th>
        <th>Longitude</th>
      </tr>
    </thead>
    <tbody>

     <?php
     $i = 1;
     foreach ($location as $row) {
       ?>
       <tr>
        <td align="center"><?php echo $row->location_name;?></td>
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
foreach($biomassExpansionFacDetails as $row)
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
                  <td>EF </td>
               </tr>
                 <?php 
             }?>

            </table>
         </div>
      </div>
   </div>
</div>
</div>

