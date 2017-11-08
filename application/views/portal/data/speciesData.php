<style media="screen">
.panel-group{
  width: 100%!important;
}
.speciesImg{
  width:250px!important;
  height:auto!important;
  float: left!important;
  margin-right:10px!important
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
                        $alometricUrl=site_url('Portal/allometricEquationViewSpeciesData/'.$species_list->ID_Species);
                        $efUrl=site_url('Portal/biomassExpansionFacSpeciesView/'.$species_list->ID_Species);
                        $wdUrl=site_url('Portal/woodDensitiesSpeciesView/'.$species_list->ID_Species);
                        $rdUrl=site_url('Portal/rawDataSpeciesView/'.$species_list->ID_Species);

                        $aeData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_AE,'Allometric Equation (AE)',$alometricUrl);
                        $efData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_EF,'Emission Factors (EF)',$efUrl);
                        $wdData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_WD,'Wood Density (WD)',$wdUrl);
                        $rdData=noDataReturn($species_list->ID_Species,$availableData->TOTAL_RD,'Raw Data (RD)',$rdUrl);
                        $localNameData=noDataReturn($species_list->ID_Species,$availableData->name_bangla,'Local Name','None');
                        ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion<?php echo $i;?>" href="#my<?php echo $i.$j; ?>">
                                <?php echo $species_list->Species;  ?></a>
                              </h4>
                            </div>
                            <div id="my<?php echo $i.$j; ?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-12">
                                  <table class="table table-bordered table-sm table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th colspan=""><center> Types of Data</center></th>
                                        <th colspan=""><center> Value</center></th>
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
                                      <tr>
                                        <th><?php echo $localNameData[0]; ?></th>
                                        <th><?php echo $localNameData[1]; ?></th>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <img src="<?php echo base_url('asset/Tree_images_metadata')?>/<?php echo $availableData->species.'.jpg'; ?>" class="speciesImg">: </b><?php echo $availableData->description;?>

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
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
