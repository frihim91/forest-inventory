<style>
	.help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
	.help-head{color:#A82400;} 
	.form-group:hover .help{ background: #e3e3e3;}
</style> 

<div class="widget">  
	<div class="widget-head"> 
		<!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
		<a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/website/createPostLink"); ?>">Create New Visitor</a>
		<small style="margin-left: 10px;">All Visitor Create, Details, Inactivate and Delete from here</small> 
	</div> 
	<div class="widget-body">    
		<div class="table-responsive">
			<?php
			if (!empty($all_visitors)) {
				?>
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Education</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($all_visitors as $all_visitor) {
							?>
							<tr> 
								<td><?php echo $i; ?></td>
								<td><?php echo $all_visitor->FIRST_NAME.' '.$all_visitor->LAST_NAME; ?></td>
								<td><?php echo $all_visitor->EMAIL; ?></td>
								<td><?php echo $all_visitor->ADDRESS;?></td>
								<td><?php echo $all_visitor->EDUCATION_DEGREE_NAME; ?></td>
								<td><?php echo ($all_visitor->ACTIVE_FLAG == 1) ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>
								<td>
									<span  title="Visitor Details"  href="<?php echo site_url("dashboard/Visitors/visitor_detail/" . $all_visitor->USER_ID); ?>" class="label label-success  Modal modalLink" style="cursor: pointer">Details</span> 

									<span  title="Delete Visitor Name"   href="<?php echo site_url('dashboard/Visitors/deleteVisitor/'.$all_visitor->USER_ID);?>" class="label btn-danger deleteUrl" style="cursor: pointer">Delete</span>  
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
				echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp	;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
			}
			?>
		</div>
	</div>
</div>
 <script type="text/javascript">
  $(document).on("click", "span.deleteUrl", function (e) {
       var result = confirm("Are you sure want to delete it?");
       if(result == true){
        var url = $(this).attr('href');
         var removeRow = $(this).parent().parent();

                    $.ajax({
                        url: url,
                        type: 'POST',
                       // dataType: 'JSON',
                        success: function (data) {
                        window.location.href = "<?php echo site_url('dashboard/Visitors/visitorList');?>";
                           
                        }
                    });
       }
e.preventDefault();
});
</script>