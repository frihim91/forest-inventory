

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
      <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Wood Density</h2>
   </div>
   <div class="col-sm-12 bdy_des">
     <?php 
               foreach($woodDensitiesDetails as $row)
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
                  <th style="width:210px">Green Density (g/cm3): </th>
                  <td>  <?php echo $row->Density_green;?>
                  </td>
               </tr>

               <tr>
                  <th style="width:210px">Airdry Density (g/cm3): </th>
                  <td>  <?php echo $row->Density_airdry;?>
                  </td>
               </tr>
               <tr>
                  <th style="width:210px">Ovendry Density (g/cm3): </th>
                  <td>  <?php echo $row->Density_ovendry;?>
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
                  <th style="width:210px"> Methodology Green: </th>
                  <td><?php echo $row->Methodology_Green;?></td>
               </tr>

               <tr>
                  <th style="width:210px">Methodology Airdrie: </th>
                  <td><?php echo $row->Methodology_Airdry;?></td>
               </tr>
                 <tr>
                  <th style="width:210px">Methodology Ovendry: </th>
                  <td><?php echo $row->Methodology_Ovendry;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Bark: </th>
                  <td><?php echo $row->Bark;?></td>
               </tr>
               <tr>
                  <th style="width:210px"> Moisture Content Density: </th>
                  <td><?php echo $row->MC_Density;?></td>
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
       <!--    <th>Author:</th> -->
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
       <td align="center"> NA</td>
      <!--  <td align="center">None</td> -->
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
         foreach($woodDensitiesDetails as $row)
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
foreach($woodDensitiesDetails as $row)
{
 ?>

 <div class="row">     
  <div class="col-md-12">
    <br>
    <h3 class="section-header">Reference</h3>

    <table class="table">
      <tr><th> Reference: </th><td> 
       <?php echo $row->Reference;?>
     </td></tr>
     <tr><th> Author: </th><td>
       <?php echo $row->Author;?>
     </td></tr>
     <tr><th> Year: </th><td> 

       <?php echo $row->Year;?>

     </td></tr>
   </table>

 </div>
</div>


<div class="row">     
  <div class="col-md-12">
    <br>
    <h3 class="section-header">Contributor</h3>

    <table class="table">
      <tr><th style="width:210px">Contributor:</th><td> <?php echo $row->Contributor_name;?></td></tr>
    </table>


  </div>
</div>

<div class="row">     
  <div class="col-md-12">
    <br>
    <h3 class="section-header">Dataset</h3>


    <table class="table">
      <tr><th style="width:210px">Dataset:</th><td>WD </td></tr>
    </table>
    <?php 
  }?>

</div>
</div>



</div>

</div>


</div>