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
                  <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("species_list"); ?>
          </div>
                  <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("species_list"); ?>
                  
                  </div>
              </div>
          </div>
      </div>
  </div>
    <div class="col-md-12 page_content">
       <div class="col-md-12">
                <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Species List</h2>
                <p>Click on a family in the list below for more information on the species in that family.</p>

            </div>

  <div class="col-sm-12 bdy_des">
   <div class="row">
     <div class="panel-group" id="accordion">

        <?php 
        $i=0;
        foreach($family_details as $row)
        {
        ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" style="font-family:Tahoma, Verdana, Segoe, sans-serif; font-weight: 400;font-size:20px;color:inherit;" data-parent="#accordion" href="#collapse<?php echo $i; ?>" >
                        <?php echo $row->Family;?> </a> (<?php echo $row->GENUSCOUNT;?> Genus, <?php echo $row->SPECIESCOUNT;?> Species)
                    </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                      <?php 
                      $species = $this->Forestdata_model->get_family_species_genus($row->ID_Family);

                      ?>
                      <div class="panel-group" id="accord<?php echo $i; ?>">
                      <?php 
                      $j=0;
                      foreach($species as $species_list){
                      ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" style="font-family:Tahoma, Verdana, Segoe, sans-serif; font-weight: 400;font-size:17px;color:#555;" data-parent="#accord<?php echo $i; ?>" href="#collap<?php echo $i.$j; ?>">
                                    <?php echo $species_list->NAME;?></a>
                                </h4>
                            </div>
                          <div id="collap<?php echo $i.$j; ?>" class="panel-collapse collapse">
                            
                                  
                          <div class="panel-body">
                                <?php 
                                   $speciesId = $this->Forestdata_model->get_location_data_type($species_list->ID_Species);

                                    ?>
                                   
                                   
                         <!--            <p style="padding-left:3px;">
                                       <b>Wood Density : 
                                       <?php 
                                        $totalNumberC = sizeof($speciesId) - 1 ;
                                        foreach($speciesId as $key => $speciesIds){ ?>
                                        <?php echo $speciesIds->WoodDensity;?>  
                                        <?php 
                                          if($totalNumberC != $key)
                                            echo ", ";
                                         }
                                         ?>
                                           
                                         </b>
                                         </p>

                                    <p style="padding-left:3px;">
                                       <b>Description: 
                                       <?php 
                                        $totalNumberC = sizeof($speciesId) - 1 ;
                                        foreach($speciesId as $key => $speciesIds){ ?>
                                        <?php echo $speciesIds->Description;?>  
                                        <?php 
                                          if($totalNumberC != $key)
                                            echo ", ";
                                         }
                                         ?>
                                           
                                         </b>
                                         </p> -->
               
                                       <p><b>Data in FAO Biomes :
                                        <?php 
                                        $totalNumber = sizeof($speciesId) - 1 ;
                                        foreach($speciesId as $key => $speciesIds){ 
                                          ?><?php echo $speciesIds->FAOBiomes;?> 
                                          <?php 
                                          if($totalNumber != $key)
                                            echo ", ";
                                          }
                                        ?>
                                          
                                        </b>
                                        </p>
                                     <p style="padding-left:41px;">
                                     <b>Types of data : <a href="<?php echo site_url('Portal/allometricEquationData/'.$species_list->ID_Species); ?>" style="color:#147A00;">Alometric Equation</a>
                                     <?php 
                                     $species_type_data = $this->Forestdata_model->get_data_type($speciesIds->ID_Species);
                                     ?> <?php 
                                         foreach($species_type_data as $row)
                                        {
                                        ?>
                                        (<?php echo $row->TOTAL_EQN;?>)

                                         <?php 
                                       }?>
                                     </b></p>
                                  <br>

                                    
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




