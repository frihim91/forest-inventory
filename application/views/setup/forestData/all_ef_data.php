<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 

<div class="widget">  
    <div class="widget-head"> 
       <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create EF Data</a>
         
        <small style="margin-left: 10px;">All EF Data Create, Edit, Inactivate and Delete from here</small> 
    </div> 
    <div class="widget-body">    
        <div class="table-responsive">
            <?php
            if (!empty($all_ef_data)) {
                ?>
                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Emission Factor</th> 
                            <th>Species</th>
                            <th>Equation</th>
                            <th>HeightRange</th>
                            <th>FAO Biomes</th>
                            <th>Locations</th>
                            <th>Zone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($all_ef_data as $all_ef_datas) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_ef_datas->EmissionFactor; ?></td>
                                <td><?php echo $all_ef_datas->Family.' '.$all_ef_datas->Species;?> </td>
                                <td><?php echo $all_ef_datas->Equation;?></td>
                                <td><?php echo $all_ef_datas->HeightRange; ?></td>
                                <td><?php echo $all_ef_datas->FAOBiomes;?></td>
                                <td><?php echo $all_ef_datas->District;?></td>
                                <td><?php echo $all_ef_datas->Zones;?></td>
                                    
                                <td>
                                    <a class="label btn-danger btn-xs deleteUrl" href="<?php echo site_url('dashboard/ForestData/deleteEfData/'.$all_ef_datas->ID_EF);?>">
                              <i class="glyphicon glyphicon-remove"></i>
                              </a>  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
            }
            ?>
        </div>
    </div>
    </div>
  <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <?php echo form_open('dashboard/ForestData/createEFData'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Add FE Data</h4>
                </div>
                <div class="modal-body">
                    <div class="row">  
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="firstname">Emission Factor</label>
                                 
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Emission Factor', 'id' => 'EmissionFactor', 'name' => 'EmissionFactor', 'value' => set_value('EmissionFactor'), 'required' => 'required')); ?>      
                               
                            </div>

                                <div class="col-md-4">
                                <label for="firstname">LandCover Name</label>
                                
                                   <?php
                                   $landcover = $this->Forestdata_model->get_all_landcover();
                                   $options = array('' => '--Select LandCover--');
                                   foreach ($landcover as $landcovers) {
                                   $options["$landcovers->ID_LandCover"] = $landcovers->LandCover;
                                   }
                                   $mId = set_value('ID_LandCover');
                                   echo form_dropdown('ID_LandCover', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a LandCover..." required="required"');
                                 ?>     
                               
                            </div>

                              <div class="col-md-4">
                                <label for="firstname">Species Name</label>
                                
                                   <?php
                                   $species = $this->Forestdata_model->get_all_species();
                                   $options = array('' => '--Select Species--');
                                   foreach ($species as $speciess) {
                                   $options["$speciess->ID_Species"] =$speciess->Family . " " .$speciess->Species;
                                   }
                                   $mId = set_value('ID_Species');
                                   echo form_dropdown('ID_Species', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Species..." required="required"');
                                 ?>     
                               
                            </div>
                           
                        </div> 
                    </div>

            
                   

                    <div class="row">  
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="firstname">AgeRange(yr)</label>
                                
                                   <?php
                                   $agerange = $this->Forestdata_model->get_all_agerange();
                                   $options = array('' => '--Select AgeRange--');
                                   foreach ($agerange as $ageranges) {
                                   $options["$ageranges->ID_AgeRange,$ageranges->AgeRange"] = $ageranges->AgeRange;
                                   }
                                   $mId = set_value('ID_AgeRange');
                                   echo form_dropdown('ID_AgeRange', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a AgeRange..." required="required"');
                                 ?>     
                               
                            </div>

                            <div class="col-md-4">
                                <label for="firstname">Height Range</label>
                               
                                   <?php
                                   $heightrange = $this->Forestdata_model->get_all_heightrange();
                                   $options = array('' => '--Select Height Range--');
                                   foreach ($heightrange as $heightranges) {
                                   $options["$heightranges->ID_HeightRange,$heightranges->HeightRange"] = $heightranges->HeightRange;
                                   }
                                   $mId = set_value('ID_HeightRange');
                                   echo form_dropdown('ID_HeightRange', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Height Range..." required="required"');
                                 ?>     
                               
                            </div>

                             <div class="col-md-4">
                                <label for="firstname">Volume Range</label>
                                 
                                   <?php
                                   $volumerange = $this->Forestdata_model->get_all_volumerange();
                                   $options = array('' => '--Select Volume Range--');
                                   foreach ($volumerange as $volumeranges) {
                                   $options["$volumeranges->ID_VolumeRange,$volumeranges->VolumeRange"] = $volumeranges->VolumeRange;
                                   }
                                   $mId = set_value('ID_VolumeRange');
                                   echo form_dropdown('ID_VolumeRange', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Volume Range..." required="required"');
                                 ?>     
                               
                            </div>
                         
                        </div> 
                    </div>
                    <div class="row">  
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="firstname">Basal Range</label>
                               
                                   <?php
                                   $basalrange = $this->Forestdata_model->get_all_basalrange();
                                   $options = array('' => '--Select Basal Range--');
                                   foreach ($basalrange as $basalranges) {
                                   $options["$basalranges->ID_BasalRange,$basalranges->BasalRange"] = $basalranges->BasalRange;
                                   }
                                   $mId = set_value('ID_BasalRange');
                                   echo form_dropdown('ID_BasalRange', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Basal Range..." required="required"');
                                 ?>     
                                </div>

                                <div class="col-md-4">
                                <label for="firstname">Value</label>
                               
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Value', 'id' => 'Value', 'name' => 'Value', 'value' => set_value('Value'), 'required' => 'required')); ?>  
                               
                                </div>

                                <div class="col-md-4">
                                <label for="firstname">Unit</label>
                                
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Unit', 'id' => 'Unit', 'name' => 'Unit', 'value' => set_value('Unit'), 'required' => 'required')); ?>      
                               
                            </div>
                            </div>
                           
                        </div> 
                   

                     <div class="row">  
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="firstname">Equation</label>
                              
                                   <?php
                                   $ID_EF_IPCC = $this->Forestdata_model->get_all_equation();
                                   $options = array('' => '--Select Equation--');
                                   foreach ($ID_EF_IPCC as $ID_EF_IPCCs) {
                                   $options["$ID_EF_IPCCs->ID_EF_IPCC"] = $ID_EF_IPCCs->Equation;
                                   }
                                   $mId = set_value('ID_EF_IPCC');
                                   echo form_dropdown('ID_EF_IPCC', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Equation..." required="required"');
                                 ?>     
                               
                            </div>
                             <div class="col-md-4">
                                <label for="firstname">Reference</label>
                              
                                   <?php
                                   $ID_Reference = $this->Forestdata_model->get_all_reference();
                                   $options = array('' => '--Select Author--');
                                   foreach ($ID_Reference as $ID_References) {
                                   $options["$ID_References->ID_Reference"] = $ID_References->    Author;
                                   }
                                   $mId = set_value('ID_Reference');
                                   echo form_dropdown('ID_Reference', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Reference..." required="required"');
                                 ?>     
                                
                            </div>

                              <div class="col-md-4">
                                <label for="firstname">Lower Confidence Limit</label>
                               
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Lower Confidence Limit Name', 'id' => '  Lower_Confidence_Limit', 'name' => 'Lower_Confidence_Limit', 'value' => set_value('Lower_Confidence_Limit'), 'required' => 'required')); ?>      
                               
                            </div>
                             
                        </div> 
                    </div>


                   


                    <div class="row">  
                        <div class="form-group">
                           
                             <div class="col-md-4">
                                <label for="firstname">Upper Confidence Limit</label>
                               
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Upper Confidence Limit', 'id' => 'Upper_Confidence_Limit', 'name' => 'Upper_Confidence_Limit', 'value' => set_value('Upper_Confidence_Limit'), 'required' => 'required')); ?>      
                               
                            </div>

                            <div class="col-md-4">
                                <label for="firstname">Type of Parameter</label>
                                
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Type of Parameter Name', 'id' => '  Type_of_Parameter', 'name' => 'Type_of_Parameter', 'value' => set_value('Type_of_Parameter'), 'required' => 'required')); ?>      
                                
                            </div>

                              <div class="col-md-4">
                                <label for="firstname">New Species Name</label>
                                
                                   <?php
                                   $species = $this->Forestdata_model->get_all_species();
                                   $options = array('' => '--Select Species--');
                                   foreach ($species as $speciess) {
                                   $options["$speciess->ID_Species"] =$speciess->Family . " " .$speciess->Species;
                                   }
                                   $mId = set_value('ID_Species');
                                   echo form_dropdown('ID_Species', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Species..." required="required"');
                                 ?>     
                               
                            </div>
                            
                        </div> 
                    </div>


                          <div class="row">  
                        <div class="form-group">
                           
                          
                               <div class="col-md-4">
                                <label for="firstname">Location</label>
                                 
                                   <?php
                                   $ID_Location = $this->Forestdata_model->get_all_location();
                                   $options = array('' => '--Select Location--');
                                   foreach ($ID_Location as $ID_Locations) {
                                   $options["$ID_Locations->ID_Location"] = $ID_Locations->    District;
                                   }
                                   $mId = set_value('ID_Location');
                                   echo form_dropdown('ID_Location', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Reference..." required="required"');
                                 ?>     
                               
                            </div>
                            
                        </div> 
                    </div>
                

             
                   
                <div class="modal-footer">
                    <span class="modal_msg pull-left"></span>
                    <button type="submit" class="btn btn-sm btn-success" id="createSpecies">Save</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
 <script type="text/javascript">
  $(document).on("click", "a.deleteUrl", function (e) {
       var result = confirm("Are you sure want to delete EF Data?");
       if(result == true){
        var url = $(this).attr('href');
         var removeRow = $(this).parent().parent();

                    $.ajax({
                        url: url,
                        type: 'POST',
                       // dataType: 'JSON',
                        success: function (data) {
                        window.location.href = "<?php echo site_url('dashboard/ForestData/all_ef_data');?>";
                           
                        }
                    });
       }
e.preventDefault();
});
      $(document).on('click', '.Modal', function (e) {
        $("#modalDefault").modal('show');
        e.preventDefault();
    });
</script>


