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

<?php 
foreach($allometricEquationDetails as $row)
{
 ?>
 
 <?php 
}?>

<div class="col-md-12 page_content">
  <div class="col-md-12">
    <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Allometric Equation</h2>
    
  </div>



  <div class="col-sm-12 bdy_des">
    
    <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Allometric</h3>
    
    <div class="row">     
      <div class="col-md-12">
       <br>
       <table class="table">
        
        <tr><th style="width:210px">Equation: </th><td> <b><code style="color:#c7254e;font-size: 14px;">
          <?php echo $row->Equation_VarNames;?>
        </code></b></td></tr>
        <tr><th> Sample size: </th><td><?php echo $row->Sample_size;?></td></tr>
        <tr><th> R<sup>2</sup>: </th><td><?php echo $row->R2;?></td></tr>
        <tr><th style="width:210px"> Population: </th><td><?php echo $row->Population;?></td></tr>
      </table>
      
      

    </div>
  </div>



  <div class="row">     
    <div class="col-md-12">
      <br>
      <h3>Input/Output</h3>
      <table class="table">
        <tr><th style="width:340px"> X: </th><td><?php echo $row->X;?> </td></tr>
        <tr><th> Unit X: </th><td> <?php echo $row->Unit_X;?></td></tr>
        <tr><th> Z: </th><td> <?php echo $row->Z;?> </td></tr>
        <tr><th> Unit Z: </th><td><?php echo $row->Unit_Z;?> </td></tr>
        <tr><th> W: </th><td><?php echo $row->W;?></td></tr>
        <tr><th> Unit_W: </th><td><?php echo $row->Unit_W;?></td></tr>
        <tr><th> U: </th><td> <?php echo $row->U;?></td></tr>
        <tr><th> Unit_U: </th><td><?php echo $row->Unit_U;?></td></tr>
        <tr><th> V: </th><td><?php echo $row->V;?></td></tr>
        <tr><th> Unit V: </th><td><?php echo $row->Unit_V;?></td></tr>
        <tr><th> Min X: </th><td> <?php echo $row->Min_X;?></td></tr>
        <tr><th> Max X: </th><td><?php echo $row->Max_X;?></td></tr>
        <tr><th> Min Z: </th><td><?php echo $row->Min_Z;?></td></tr>
        <tr><th> Max Z: </th><td> <?php echo $row->Max_Z;?>   </td></tr>
        <tr><th> Output: </th><td><?php echo $row->Output;?> </td></tr>
        <tr><th> Output TR: </th><td><?php echo $row->Output_TR;?> </td></tr>
        <tr><th> Age: </th><td> <?php echo $row->Max_age;?></td></tr>
        <!--   <tr><th> Veg component: </th><td> <?php echo $row->Veg_Component;?> </td></tr> -->
      </table>
    </div>
  </div>



  <div class="row">     
    <div class="col-md-12">
      <br>
      <h3 class="section-header">Idendification</h3>       
      <table class="table">
        <tr><th> Tree type: </th><td><?php echo $row->Tree_type;?> </td></tr>
        <tr><th> Vegetation type: </th><td> <?php echo $row->Vegetation_type;?> </td></tr>
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
     foreach ($allometricEquationDetails_tax as $row) {
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
         foreach($allometricEquationDetails as $row)
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
foreach($allometricEquationDetails as $row)
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
      <tr><th style="width:210px">Dataset:</th><td>AE </td></tr>
    </table>
    <?php 
  }?>
  
</div>
</div>



</div>







</div>


</div>