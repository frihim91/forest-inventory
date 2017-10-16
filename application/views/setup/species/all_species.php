<style>
   .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
   .help-head{color:#A82400;}
   .form-group:hover .help{ background: #e3e3e3;}
</style>
<div class="col-md-12">
   <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="widget-head">
               <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
             <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" ><i class="glyphicon glyphicon-plus"></i></a>
               <small style="margin-left: 10px;">All Family</small>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-xs-12">
                  <?php
                     if (!empty($all_family)) {
                         ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Family Name</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($all_family as $all_familys) {
                               ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                           <td><?php echo $all_familys->Family; ?></td>
                           <td>
                              <a class="label btn-danger btn-xs modalLink" href="<?php echo site_url('dashboard/ForestData/deleteFamily/'.$all_familys->ID_Family);?>">
                              <i class="glyphicon glyphicon-remove"></i>
                              </a>
                              <span title="Edit  Module Name"
                              href="http://localhost/forest-inventory/index.php/dashboard/securityAccess/edit_module/1"
                              class="label label-info modalLink" style="cursor: pointer">Edit</span>
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
      </div>
   </div>
   <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="widget-head">
               <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
                <a class="btn btn-sm btn-danger pull-right col-md-2 ModalGenus" ><i class="glyphicon glyphicon-plus"></i></a></a>
               <small style="margin-left: 10px;">All Genus</small>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-xs-12">
                  <?php
                     if (!empty($all_genus)) {
                         ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Genus Name</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($all_genus as $all_genuss) {
                               ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                           <td><?php echo $all_genuss->Genus; ?></td>
                           <td>
                               <a class="label btn-danger btn-xs deleteUrlG" href="<?php echo site_url('dashboard/ForestData/deleteGenus/'.$all_genuss->ID_Genus);?>">
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
      </div>
   </div>
</div>
<div class="col-md-12">
   <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="widget-head">
               <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->

               <a class="btn btn-sm btn-danger pull-right col-md-2 ModalSpecies" ><i class="glyphicon glyphicon-plus"></i></a></a>
               <small style="margin-left: 10px;">All Species</small>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-xs-12">
                  <?php
                     if (!empty($all_species)) {
                         ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Family</th>
                           <th>Genus</th>
                           <th>Speciess</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($all_species as $all_speciess) {
                               ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                           <td><?php echo $all_speciess->Family; ?></td>
                           <td><?php echo $all_speciess->Genus; ?></td>
                           <td><?php echo $all_speciess->Species; ?></td>
                           <td>
                              <a class="label btn-danger btn-xs deleteUrlS" href="<?php echo site_url('dashboard/ForestData/deleteSpecies/'.$all_speciess->ID_Species);?>">
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
      </div>
   </div>
    <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="widget-head">
               <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->

               <a class="btn btn-sm btn-danger pull-right col-md-2 ModalFAOBiomes" ><i class="glyphicon glyphicon-plus"></i></a></a>
               <small style="margin-left: 10px;">All FAOBiomes</small>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-xs-12">
                  <?php
                     if (!empty($all_faobiomes)) {
                         ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example3">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>FAO Biomes Name</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($all_faobiomes as $all_faobiomess) {
                               ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                           <td><?php echo $all_faobiomess->FAOBiomes; ?></td>
                           <td>
                              <a class="label btn-danger btn-xs deleteUrFao" href="<?php echo site_url('dashboard/ForestData/deleteFAOBiomes/'.$all_faobiomess->ID_FAOBiomes);?>">
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
      </div>
   </div>
</div>

   <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('dashboard/ForestData/createFamily'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Add Family Name</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Family Name</label>
                                <div class="col-md-8">
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Family Name', 'id' => 'Family', 'name' => 'Family', 'value' => set_value('Family'), 'required' => 'required')); ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Family Name</strong>
                                <hr>
                                <p class="muted">Please enter Family Name in english here.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="modal_msg pull-left"></span>
                    <button type="submit" class="btn btn-sm btn-success" id="createFamily">Save</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>


      <div class="modal fade" id="modalDefaultGenus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('dashboard/ForestData/createGenus'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Add Genus Name</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Family Name</label>
                                <div class="col-md-8">
                                   <?php
                                   $family = $this->Forestdata_model->get_all_family();
                                   $options = array('' => '--Select Family--');
                                   foreach ($family as $familys) {
                                   $options["$familys->ID_Family"] = $familys->Family;
                                   }
                                   $mId = set_value('ID_Family');
                                   echo form_dropdown('ID_Family', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Family..." required="required"');
                                 ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Family Name</strong>
                                <hr>
                                <p class="muted">Please enter Family Name in english here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Genus Name</label>
                                <div class="col-md-8">
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Genus Name', 'id' => 'Genus', 'name' => 'Genus', 'value' => set_value('Genus'), 'required' => 'required')); ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Genus Name</strong>
                                <hr>
                                <p class="muted">Please enter Genus Name in english here.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="modal_msg pull-left"></span>
                    <button type="submit" class="btn btn-sm btn-success" id="createGenus">Save</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

      <div class="modal fade" id="modalDefaultSpecies" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('dashboard/ForestData/createSpecies'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Add Species Name</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Family Name</label>
                                <div class="col-md-8">
                                   <?php
                                   $family = $this->Forestdata_model->get_all_family();
                                   $options = array('' => '--Select Family--');
                                   foreach ($family as $familys) {
                                   $options["$familys->ID_Family"] = $familys->Family;
                                   }
                                   $mId = set_value('ID_Family');
                                   echo form_dropdown('ID_Family', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Family..." required="required"');
                                 ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Family Name</strong>
                                <hr>
                                <p class="muted">Please enter Family Name in english here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Genus Name</label>
                                <div class="col-md-8">
                                   <?php
                                   $genus = $this->Forestdata_model->get_all_genus();
                                   $options = array('' => '--Select Genus--');
                                   foreach ($genus as $genuss) {
                                   $options["$genuss->ID_Genus"] = $genuss->Genus;
                                   }
                                   $mId = set_value('ID_Genus');
                                   echo form_dropdown('ID_Genus', $options, $mId, 'id="id" class="tag-select form-control" data-placeholder="Choose a Family..." required="required"');
                                 ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Genus Name</strong>
                                <hr>
                                <p class="muted">Please enter Genus Name in english here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">Species Name</label>
                                <div class="col-md-8">
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Species Name', 'id' => 'Species', 'name' => 'Species', 'value' => set_value('Species'), 'required' => 'required')); ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Species Name</strong>
                                <hr>
                                <p class="muted">Please enter Species Name in english here.</p>
                            </div>
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

       <div class="modal fade" id="modalDefaultFAOBiomes" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('dashboard/ForestData/createFAOBiomes'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Add FAO Biomes Name</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="firstname" class="col-md-4 control-label">FAO Biomes Name</label>
                                <div class="col-md-8">
                                    <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'FAO Biomes Name', 'id' => 'FAOBiomes', 'name' => 'FAOBiomes', 'value' => set_value('FAOBiomes'), 'required' => 'required')); ?>
                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>FAO Biomes Name</strong>
                                <hr>
                                <p class="muted">Please enter FAO Biomes Name in english here.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="modal_msg pull-left"></span>
                    <button type="submit" class="btn btn-sm btn-success" id="createFAOBiomes">Save</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<script type="text/javascript">
   $(document).on("click", "a.deleteUrl", function (e) {
        var result = confirm("Are you sure want to delete Family?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();

                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/ForestData/speciesSetup');?>";

                         }
                     });
        }
   e.preventDefault();
   });

   $(document).on("click", "a.deleteUrlG", function (e) {
        var result = confirm("Are you sure want to delete Genus?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();

                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/ForestData/speciesSetup');?>";

                         }
                     });
        }
   e.preventDefault();
   });

    $(document).on("click", "a.deleteUrlS", function (e) {
        var result = confirm("Are you sure want to delete Species?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();

                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/ForestData/speciesSetup');?>";

                         }
                     });
        }
   e.preventDefault();
   });

     $(document).on("click", "a.deleteUrFao", function (e) {
        var result = confirm("Are you sure want to delete FAO Biomes?");
        if(result == true){
         var url = $(this).attr('href');
          var removeRow = $(this).parent().parent();

                     $.ajax({
                         url: url,
                         type: 'POST',
                        // dataType: 'JSON',
                         success: function (data) {
                         window.location.href = "<?php echo site_url('dashboard/ForestData/speciesSetup');?>";

                         }
                     });
        }
   e.preventDefault();
   });


     $(document).on('click', '.Modal', function (e) {
        $("#modalDefault").modal('show');
        e.preventDefault();
    });

      $(document).on('click', '.ModalGenus', function (e) {
        $("#modalDefaultGenus").modal('show');
        e.preventDefault();
    });

        $(document).on('click', '.ModalSpecies', function (e) {
        $("#modalDefaultSpecies").modal('show');
        e.preventDefault();
    });

        $(document).on('click', '.ModalFAOBiomes', function (e) {
        $("#modalDefaultFAOBiomes").modal('show');
        e.preventDefault();
    });

</script>
