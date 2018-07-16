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

               <small style="margin-left: 10px;">All Group Location</small>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-xs-12">
                  <?php
                     if (!empty($all_group_location)) {
                         ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example-loc-group">
                     <thead>
                        <tr>
                           <th>Group Location ID</th>
                           <th>Location Name</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($all_group_location as $all_group_locations) {
                               ?>
                        <tr>
                          
                           <td align="center"><?php echo $all_group_locations->group_id; ?></td>
                           <td><?php echo $all_group_locations->location_name; ?></td>
                       
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
            
                <a class="btn btn-sm btn-danger pull-right col-md-2 ModalGenus" ><i class="glyphicon glyphicon-plus"></i></a></a>
               <small style="margin-left: 10px;">All Species Group</small>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-xs-12">
                  <?php
                     if (!empty($all_species_group)) {
                         ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example-group-species">
                     <thead>
                        <tr>
                           <th>Species Group ID</th>
                           <th>Species Name</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($all_species_group as $all_species_groups) {
                               ?>
                        <tr>
                           <td align="center"><?php echo $all_species_groups->Speciesgroup_ID; ?></td>
                           <td><?php echo $all_species_groups->Species; ?></td>
                          
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
