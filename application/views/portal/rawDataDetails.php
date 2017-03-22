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
        <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("raw_data"); ?>
    </div>
        <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("raw_data"); ?>
        
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 page_content">
    <div class="col-md-12">
                <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Raw Data</h2>
                
            </div>

  <div class="col-sm-12 bdy_des">
  <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Record Details</h3>
  
  <div class="row">     
    <div class="col-md-12">
         <br>
   <table class="table">
        
            <tr><th style="width:210px"> DBH (cm): </th><td> <b>
            </b></td></tr>
            <tr><th> Total Tree Height (m): </th><td>
            <?php 
            foreach($rawDataDetails as $row)
            {
            ?><?php echo $row->HeightRange;?>
            <?php 
            }?>

            </td></tr>
            
              <tr><th style="width:210px"> Crown Diameter (m): </th><td></td></tr>
              <tr><th style="width:210px"> Fresh Bole Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Fresh Branch Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Fresh Foliage Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Fresh Stump Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Fresh Buttress Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Fresh Roots Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Total Tree Volume (m3): </th><td>
              <?php 
              foreach($rawDataDetails as $row)
              {
              ?><?php echo $row->VolumeRange;?>
              <?php 
              }?>
              </td></tr>
              <tr><th style="width:210px"> Bole Volume (m3): </th><td></td></tr>
              <tr><th style="width:210px"> Tree Wood Density Avg (g/cm3): </th><td></td></tr>
              <tr><th style="width:210px"> Dry Bole Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Dry Branch Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Dry Foliage Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Dry Stump Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Dry Buttress Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Dry Roots Weight (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Total Aboveground Mass (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Total Belowground Mass (kg): </th><td></td></tr>
              <tr><th style="width:210px"> TTotal Biomass (kg): </th><td></td></tr>
              <tr><th style="width:210px"> Remark: </th><td></td></tr>
              <tr><th style="width:210px"> Contact: </th><td></td></tr>
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
        <h3>Input/Output</h3>
        <table class="table">
            <tr><th style="width:340px"> X: </th><td> </td></tr>
            <tr><th> Unit X: </th><td> </td></tr>
            <tr><th> Z: </th><td>  </td></tr>
            <tr><th> Unit Z: </th><td> </td></tr>
            <tr><th> W: </th><td></td></tr>
            <tr><th> Unit_W: </th><td></td></tr>
            <tr><th> U: </th><td> </td></tr>
            <tr><th> Unit_U: </th><td></td></tr>
            <tr><th> V: </th><td></td></tr>
            <tr><th> Unit V: </td></tr>
            <tr><th> Min X: </th><td> </td></tr>
            <tr><th> Max X: </th><td></td></tr>
            <tr><th> Min Z: </th><td></td></tr>
            <tr><th> Max Z: </th><td>    </td></tr>
            <tr><th> Output: </th><td> </td></tr>
            <tr><th> Output TR: </th><td> </td></tr>
            <tr><th> Age: </th><td> </td></tr>
            <tr><th> Veg component: </th><td>  </td></tr>
        </table>
    </div>
</div>


<div class="row">     
    <div class="col-md-12">
        <br>
        <h3 class="section-header">Idendification</h3>       
        <table class="table">
            <tr><th> Tree type: </th><td> </td></tr>
            <tr><th> Vegetation type: </th><td>  </td></tr>
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
                        <?php 
                        foreach($rawDataDetails as $row){
                         ?>
                         <?php echo $row->Family;?>
                         <?php 
                          }?></td>
                        <td>
                         <?php 
                         foreach($rawDataDetails as $row){
                         ?>
                         <?php echo $row->Genus;?>
                         <?php 
                         }?>
                          
                        </td>
                        <td>
                         <?php 
                         foreach($rawDataDetails as $row){
                         ?>
                         <?php echo $row->Species;?>
                         <?php 
                         }?>
                          
                        </td>
                        <td >None</td>
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
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Location Name: </th><td  class="pdf-record-td">
                             <?php 
                             foreach($rawDataDetails as $row){
                             ?><?php echo $row->District;?>
                             <?php 
                             }?>
                            </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Region/Province: </th><td  class="pdf-record-td">  </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Country: </th><td  class="pdf-record-td">  </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Continent: </th><td  class="pdf-record-td">  </td></tr>
                             <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Latitude: </th><td  class="pdf-record-td"> 
                             <?php 
                             foreach($rawDataDetails as $row){
                             ?><?php echo $row->LatDD;?>
                            <?php 
                             }?>

                             </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Longitude: </th><td  class="pdf-record-td">
                             <?php 
                             foreach($rawDataDetails as $row){
                             ?><?php echo $row->LongDD;?>
                             <?php 
                             }?>
                            </td></tr>
                        </table>
                    </td>
                    <td style="width:60%">
                        <table>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> FAO Global Ecological Zone: </th><td class="pdf-record-td">
                            <?php 
                             foreach($rawDataDetails as $row){
                             ?><?php echo $row->FAOBiomes;?>
                             <?php 
                             }?> 
                             </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Udvardy Ecoregion: </th><td  class="pdf-record-td">  </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> WWF Terrestrial Ecoregion: </th><td class="pdf-record-td">  </td></tr>
                            <tr><th style="padding:2px 10px 2px 2px" class="pdf-record-th"> Division Bailey: </th><td class="pdf-record-td"> </td></tr>
                            <tr><th class="pdf-record-th"> Holdridge Life Zone:</th><td  class="pdf-record-td"> 
                             <?php 
                             foreach($rawDataDetails as $row){
                             ?><?php echo $row->Zones;?>
                             <?php 
                             }?> 
                             </td></tr>

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
                <tr><th> Reference: </th><td> 
            <?php 
            foreach($rawDataDetails as $row)
            {
            ?><?php echo $row->Reference;?>
            <?php 
            }?></td></tr>
                <tr><th> Author: </th><td>
            <?php 
            foreach($rawDataDetails as $row)
            {
            ?><?php echo $row->Author;?>
            <?php 
            }?>
                </td></tr>
                <tr><th> Year: </th><td> 

            <?php 
            foreach($rawDataDetails as $row)
            {
            ?><?php echo $row->Year;?>
            <?php 
            }?>
                </td></tr>
            </table>
        
    </div>
</div>

    <div class="row">     
    <div class="col-md-12">
        <br>
        <h3 class="section-header">Contributor</h3>
        
            <table class="table">
                <tr><th style="width:210px">Contributor:</th><td></td></tr>
            </table>
            
        
  </div>
</div>

    <div class="row">     
    <div class="col-md-12">
        <br>
        <h3 class="section-header">Dataset</h3>

         
            <table class="table">
                <tr><th style="width:210px">Dataset:</th><td> </td></tr>
            </table>
        
    </div>
</div>

    

  </div>





   
    
  </div>


  </div>