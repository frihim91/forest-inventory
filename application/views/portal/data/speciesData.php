<style media="screen">
.panel-group{
  width: 100%!important;
}
.speciesImg{
  width:190px!important;
  height:180px!important;
  float: left!important;
  margin-right:10px!important
}

/*.speciesImg{
  width:180px!important;
  height:auto!important;
  float: left!important;
  margin-right:10px!important
}*/

dl {
    margin-top: 0;
    margin-bottom: 1px;
}
</style>
<?php
function noDataReturn($speciesId,$value,$head,$url)
{
  if($value>0)
  {
    $returnValue="<a href='$url'>$value</a>";;
    $heading="<a href='$url'>$head</a>";
  }
  else
  {
    $returnValue='No Data';
    $heading=$head;
  }
  $returnArray=array($heading,$returnValue);
  return $returnArray;
}
$ci =&get_instance();
$ci->load->model('datamodel');
//$species=$ci->datamodel->getSpeciesList();

?>

<div class="row">
  <div class="container">
    <div class="col-md-8">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panel-title">
            Species List
          </h4>

        </div>
        <div class="panel-body">
          <p>Click on a family in the list below for more information on the species  that family.</p>
          <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">  Family: <?php echo $total_genus_species->total_family;?>
            Genus: <?php echo $total_genus_species->total_genus;?>  Species: <?php echo $total_genus_species->total_species;?></h3>
            <div class="panel-group" id="accordion">
              <?php
              $i=0;
              foreach($family_details as $row)
              {
                $species=$ci->datamodel->getSpeciesList($row->ID_Family);
                ?>
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                        <?php echo $row->Family;?>
                       (<?php echo $row->GENUSCOUNT;?> Genus, <?php echo $row->SPECIESCOUNT;?> Species, <?php echo $row->AECOUNT;?> AE, <?php echo $row->RDCOUNT;?> RD
                       , <?php echo $row->WDCOUNT;?> WD, <?php echo $row->EFCOUNT;?> EF)
                      </a>
                      </h4>
                    </div>
                    <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-group" id="accordion<?php echo $i;?>">
                          <?php
                      $j=1;
                      foreach($species as $species_list)
                      {
                        $availableData=$ci->datamodel->getAvailableData($species_list->ID_Species);
                        $availableDataSpeciesCharacter=$ci->datamodel->getAvailableDataSpeciesCharacter($species_list->ID_Species);
                        $availableDataImage=$ci->datamodel->getAvailableDataImage($species_list->ID_Species);
                        $alometricUrl=site_url('Portal/allometricEquationViewSpeciesData/'.$species_list->ID_Species);
                        $efUrl=site_url('Portal/biomassExpansionFacSpeciesView/'.$species_list->ID_Species);
                        $wdUrl=site_url('Portal/woodDensitiesSpeciesView/'.$species_list->ID_Species);
                        $rdUrl=site_url('Portal/rawDataSpeciesView/'.$species_list->ID_Species);

                        $aeData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_AE,'Allometric Equation (AE)',$alometricUrl);
                        $efData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_EF,'Emission Factors (EF)',$efUrl);
                        $wdData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_WD,'Wood Density (WD)',$wdUrl);
                        $rdData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_RD,'Raw Data (RD)',$rdUrl);
                        $localNameData=noDataReturn($species_list->ID_Species,$availableData->local_name,'Local Name','None');
                        ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion<?php echo $i;?>" href="#my<?php echo $i.$j; ?>">
                                <?php echo $species_list->Species;  ?><br><?php echo $localNameData[0]; ?> : <?php echo $localNameData[1]; ?></a>
                                
                              </h4>

                            </div>
                            <div id="my<?php echo $i.$j; ?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-12">
                                  <table class="table table-bordered table-sm table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th colspan=""><center> Types of Data</center></th>
                                        <th colspan=""><center>Number of the Value</center></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th><?php echo $aeData[0]; ?></th>
                                        <th><?php echo $aeData[1]; ?></th>
                                      </tr>
                                      <tr>
                                        <th><?php echo $efData[0]; ?></th>
                                        <th><?php echo $efData[1]; ?></th>
                                      </tr>
                                      <tr>
                                        <th><?php echo $wdData[0]; ?></th>
                                        <th><?php echo $wdData[1]; ?></th>
                                      </tr>
                                      <tr>
                                        <th><?php echo $rdData[0]; ?></th>
                                        <th><?php echo $rdData[1]; ?></th>
                                      </tr>
                                   <!--    <tr>
                                        <th><?php echo $localNameData[0]; ?></th>
                                        <th><?php echo $localNameData[1]; ?></th>
                                      </tr> -->
                                    </tbody>
                                  </table>
                                  <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;" align="center">Tree Species Details </h3>
                                   <dl class='dl-horizontal' style="margin-bottom: 5px;">
                                  <dt style='font-size:15px'><small>Family Name:</small></dt> <dd style='font-size:15px'><small> <?php echo $row->Family;?></small></dd> 
                                  <dt style='font-size:15px'><small>Genus:</small></dt> <dd style='font-size:15px'><small> <?php echo $availableData->Genus;  ?></small></dd> 
                                  <dt style='font-size:15px'><small>Species:</small></dt> <dd style='font-size:15px'><small><?php echo $availableData->Species;  ?></small></dd> 
                                  <dt style='font-size:15px'><small>Author Name:</small></dt> <dd style='font-size:15px'><small> <?php echo $availableData->author;  ?></small></dd> 
                                  <dt style='font-size:15px'><small>synonyms:</small></dt> <dd style='font-size:15px'><small><?php echo $availableData->synonyms;  ?></small></dd> 
                                  <dt style='font-size:15px'><small>Fruits & Flowering :<br> Period</small></dt> <dd style='font-size:15px'><small> <?php echo $availableData->flowering_period;  ?></small></dd>
                                  <dt style='font-size:15px'><small>Habitat:</small></dt> <dd style='font-size:15px'><small><?php echo $availableData->habit;  ?></small></dd> 
                                  <dt style='font-size:15px'><small>Distribution:</small></dt> <dd style='font-size:15px'><small><?php echo $availableData->distribution;  ?></small></dd> 
                                  <dt style='font-size:15px'><small>Uses:</small></dt> <dd style='font-size:15px'><small><?php echo $availableData->uses;  ?></small></dd>
                                   <dt style='font-size:15px'><small>Description:</small></dt> <dd style='font-size:15px'><small> <p style="text-align: justify;"><?php echo $availableData->description;  ?></p></small></dd>
                                  <?php if(!empty($availableDataImage)){
                                                                  
                                   ?>
                                   <p><b>Photographs:</b></p>
                                   <?php foreach($availableDataImage as $availableDataImages){?>

                                   <?php if($availableDataImages->image_name!='') {
                                   //print_r($availableDataImages); ?>
                                  
                                   
                                      <div class="col-md-4"><img src="<?php echo base_url('asset/Tree_images_metadata')?>/<?php echo $availableDataImages->image_name; ?>" class="speciesImg"> </b></div>
                                   
                                    <?php } else { ?>
                                        
                                    <?php  } ?> 


                                    <?php } ?>
                                     <?php } else {?>
                               
                                   <?php } ?>


                                  </dl>

                                      <?php if(!empty($availableDataImage)){
                                                                  
                                   ?>
                                   <div class="col-md-12"> <h3>Key character:</h3></div>
                                   <?php foreach($availableDataSpeciesCharacter as $availableDataSpeciesCharacters){?>

                                   <?php if($availableDataSpeciesCharacters->root_character!='') {
                                   //print_r($availableDataImages); ?>
                                  
                                   
                                     <dl class='dl-horizontal'><dt style='font-size:15px'><small><?php echo $availableDataSpeciesCharacters->root_character;  ?>:</small></dt><dd style='font-size:15px'><small><?php echo $availableDataSpeciesCharacters->character_sub1;  ?></small></dd></dl>
                                   
                                    <?php } else { ?>
                                        
                                    <?php  } ?> 


                                    <?php } ?>
                                     <?php } else {?>
                                 
                               
                                   <?php } ?>

                                  
                               
                                 
                                </div>
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
                <div class="col-md-12">
                  <span class="pull-right"><?php echo $links; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
