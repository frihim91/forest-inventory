

<style>
   .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
   .help-head{color:#A82400;} 
   .form-group:hover .help{ background: #e3e3e3;}
</style>
<div class="widget">
   <div class="widget-head"> 
      <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create Emission Factor</a>
      <small style="margin-left: 10px;">All Emission Factor Create, Edit, Inactivate and Delete from here</small> 
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
                  <label for="firstname">Latitude</label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Latitude', 'id' => 'latitude', 'name' => 'latitude', 'value' => set_value('latitude'), 'required' => 'required')); ?>  
               </div>
            </div>
         </div>
         <div class="row">
            <div class="form-group">
               <div class="col-md-4">
                  <label for="firstname">Longitude</label>
                  <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Longitude', 'id' => 'longitude', 'name' => 'longitude', 'value' => set_value('longitude'), 'required' => 'required')); ?>      
               </div>
               <div class="col-md-4">
                  <label for="firstname">Division</label>
                  <?php
                     $ID_Divisions = $this->Forestdata_model->get_all_division();
                     $options = array('' => '--Select Division--');
                     foreach ($ID_Divisions as $ID_Division) {
                     $options["$ID_Division->ID_Division,$ID_Division->Division"] = $ID_Division->Division;
                     }
                     $ID_Division = set_value('ID_Division');
                     echo form_dropdown('ID_Division', $options, $ID_Division, 'id="ID_Division" class="tag-select form-control" data-placeholder="Choose a Reference..." required="required"');
                     ?>     
               </div>
               <div class="col-md-4">
                  <label for="firstname">District</label>
                  <select class="form-control" id="ID_District" name="ID_District">
                     <option value="">Select District</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="form-group">
               <div class="col-md-4">
                  <label for="firstname">Upazila</label>
                  <select class="form-control" id="THANA_ID" name="UPZ_CODE_1">
                     <option value="">Select Upazila</option>
                  </select>
               </div>
               <div class="col-md-4">
                  <label for="firstname">Union</label>
                  <select class="form-control" id="union_id" name="UNI_CODE_1">
                     <option value="">Select District</option>
                  </select>
               </div>
               <div class="col-md-4">
                  <label for="firstname">Faobiomes</label>
                  <?php
                     $ID_FAOBiomes = $this->Forestdata_model->get_all_faobiomes();
                     $options = array('' => '--Select FAOBiomes--');
                     foreach ($ID_FAOBiomes as $ID_FAOBiomes) {
                     $options["$ID_FAOBiomes->ID_FAOBiomes"] = $ID_FAOBiomes->FAOBiomes;
                     }
                     $mId = set_value('ID_FAOBiomes');
                     echo form_dropdown('ID_FAOBiomes', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Reference..." required="required"');
                     ?>     
               </div>
            </div>
         </div>
         <div class="row">
            <div class="form-group">
               <div class="col-md-4">
                  <label for="firstname">Ecological Zones</label>
                  <?php
                     $ID_1988EcoZones = $this->Forestdata_model->get_all_ecological_zones();
                     $options = array('' => '--Select Ecological Zones--');
                     foreach ($ID_1988EcoZones as $ID_1988EcoZones) {
                     $options["$ID_1988EcoZones->ID_1988EcoZones"] = $ID_1988EcoZones->EcoZones;
                     } 
                     $mId = set_value('ID_1988EcoZones');
                     echo form_dropdown('ID_1988EcoZones', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Reference..." required="required"');
                     ?>     
               </div>
               <div class="col-md-4">
                  <label for="firstname">Zones</label>
                  <?php
                     $ID_Zones = $this->Forestdata_model->get_all_zones();
                     $options = array('' => '--Select Zones--');
                     foreach ($ID_Zones as $ID_Zones) {
                     $options["$ID_Zones->ID_Zones"] = $ID_Zones->Zones;
                     }
                     $mId = set_value('ID_Zones');
                     echo form_dropdown('ID_Zones', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Reference..." required="required"');
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
<script type="text/javascript">
   $(document).ready(function() {
       $('#ID_Division').change(function() {
           var Division = $(this).val();
           //var ID_Division = $(this).val();
           //alert(Division);
           var url = '<?php echo site_url('dashboard/ForestData/ajax_get_division') ?>';
           $.ajax({
               type: "POST",
               url: url,
               data: {Division:Division},
               dataType: 'html',
               success: function(data) {
                   $('#ID_District').html(data);
               }
           });
       });
   });
   
   
    $(document).ready(function() {
       $('#ID_District').change(function() {
           var District = $(this).val();
           //alert(District);
           var url = '<?php echo site_url('dashboard/ForestData/up_thana_by_dis_id') ?>';
           $.ajax({
               type: "POST",
               url: url,
               data: {District:District},
               dataType: 'html',
               success: function(data) {
                   $('#THANA_ID').html(data);
               }
           });
       });
   });
   
   
       $(document).ready(function() {
       $('#THANA_ID').change(function() {
           var THANAME = $(this).val();
           //alert(District);
           var url = '<?php echo site_url('dashboard/ForestData/up_union_by_dis_id') ?>';
           $.ajax({
               type: "POST",
               url: url,
               data: {THANAME:THANAME},
               dataType: 'html',
               success: function(data) {
                   $('#union_id').html(data);
               }
           });
       });
   });
   
   
   
   
</script>

