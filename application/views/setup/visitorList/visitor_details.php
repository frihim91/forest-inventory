 <div>
 	<?php echo form_open('dashboard/Visitors/update_visitor'); ?>
 	<table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
 		<tr>
 			<th width="20%">Full Name</th>
 			<td><?php echo $visitor_info->FIRST_NAME." ".$visitor_info->LAST_NAME?></td>
 		</tr>
 		<tr>
 			<th width="20%">Tittle</th>
 			<td><?php echo $visitor_info->TITLE?></td>
 		</tr>
 		<tr>
 			<th>First Name</th>
 			<td><?php  echo $visitor_info->FIRST_NAME?></td>
 		</tr>
 		<tr>
 			<th>Last Name</th>
 			<td><?php  echo $visitor_info->LAST_NAME?></td>
 		</tr>
 		<tr>
 			<th>Email</th>
 			<td><?php echo $visitor_info->EMAIL?></td>
 		</tr>
 		<tr>
 			<th>Address</th>
 			<td><?php echo $visitor_info->ADDRESS?></td>
 		</tr>
 		<tr>
 			<th>Education</th>
 			<td><?php echo $visitor_info->EDUCATION_DEGREE_NAME?></td>
 		</tr>
 		<tr>
 			<th>Field Subject</th>
 			<td><?php echo $visitor_info->FIELD_SUBJECT?></td>
 		</tr>
 		<tr>
 			<th>Name of Institution</th>
 			<td><?php echo $visitor_info->INSTITUTE_NAME?></td>
 		</tr>
 		<tr>
 			<th>Purpose</th>
 			<td><?php echo $visitor_info->PURPOSE?></td>
 		</tr>
 
 		
 	
 	</table>
 	<div class="row">  
 		<div class="form-group">
 			<div class="col-md-6">
 				<label for="firstname" class="col-md-4 control-label">Active ?</label>
 				<div class="col-md-6">
 				<?php echo form_checkbox(array('name' => 'ACTIVE_FLAG', 'id' => 'ACTIVE_FLAG', 'value' => $visitor_info->ACTIVE_FLAG, 'checked' => ($visitor_info->ACTIVE_FLAG == 1) ? TRUE : FALSE)); ?>
 					<?php echo form_hidden('USER_ID', $visitor_info->USER_ID); ?>
 					<?php echo form_hidden('FIRST_NAME', $visitor_info->FIRST_NAME); ?>
 					<?php echo form_hidden('LAST_NAME', $visitor_info->LAST_NAME); ?>
 					<?php echo form_hidden('USER_MAIL', $visitor_info->EMAIL); ?>
 				</div>
 			</div>
 		</div> 
 		<div class="modal-footer">
 			<span class="modal_msg pull-left"></span>
 			<button type="submit" class="btn btn-sm btn-success" id="createVisitor">Save</button>
 		</div>
 	</div>
 	<?php echo form_close(); ?>
 </div>


