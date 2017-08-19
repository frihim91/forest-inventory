
<?php //echo "<pre>"; print_r($visitor_info);exit(); ?>
<style type="text/css">
 .table td {
    padding: 4px 20px !important;
    border: none !important;
  }
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
	.submit_block {
		/* text-align: right; */
		padding: 10px;
		clear: both;
		
	}
        table.detailsTbl tr td.heading{
          width:22%!important;
          padding-left: 5px!important;
        }

        img.img-circled{
          max-width: 150px;
          height: auto;
          vertical-align: left;
            }
          </style>
<div class="col-sm-12 breadcump img-responsive">
	<div class="row">
		<div class="breadcump-wrapper">
			<div class="wrapper">
				<div style="font-size:25px;" class="breadcump_row">User Profile
				</div>
				<div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> >UserProfile
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12 page_content">
	<div class="col-sm-12">	
	</div>
 <table id="" border="1" rules="all" class="table table-striped table-bordered table-hover printable table-sm no-footer centered" cellspacing="0" width="100%" role="grid">
              <thead>
                <tr>
                  <th colspan="4"><center>
                    <h2> <b> <?php echo $visitor_info->FIRST_NAME." ".$visitor_info->LAST_NAME;?></b> </h2>
                  </center></th>
                </tr>
                <tr>
                  <th style="width:15%">
                    <?php if($visitor_info->PROFILE_IMG != ""){
                      $user_img = "uploads_file/PROFILE_IMG/".$visitor_info->PROFILE_IMG;
                      ?>
                      <center>
                      	<img class="img-circled"  src="<?php echo base_url($user_img) ?>" alt="User Photo" />
                      </center>
                      <?php } else {?>
                      <img class="img-circled" src="<?php echo base_url(); ?>asset/avatar.png" alt="User Photo"/>
                      <?php } ?> <br>
                      <center>
                        <?php echo $visitor_info->FIRST_NAME." ".$visitor_info->LAST_NAME;?><br>
                      </center>

                    </th>
                    <th>
                      <table border="0"   rules="all" class="table table-striped table-bordered table-hover printable detailsTbl  table-sm centered no-footer" cellspacing="0" width="100%"  role="grid">
                        <tr>
                          <th colspan="2" style="width:45%">BASIC INFORMATION</th>
                          <th colspan="2"  style="width:45%">CONTACT INFORMATION</th>
                        </tr>
                        <tr>
                          <td class="heading"><b>First Name : </b></th>
                            <td><?php echo $visitor_info->FIRST_NAME;?></td>
                            <td class="heading"><b>Phone :</b></th>
                              <td><?php echo $visitor_info->PHONE;?></td>
                            </tr>
                            <tr>
                              <td class="heading"><b>Last Name : </b></th>
                               <td><?php echo $visitor_info->LAST_NAME;?></td>
                                <td class="heading"><b>Email :</b></th>
                                 <?php
                           		$session_info = $this->session->userdata("user_logged");
                          	//echo '<pre>';print_r($session_info);exit;
                          		 ?>
                                  <td><?php echo  $session_info["EMAIL"];?></td>
                                </tr>
                                <tr>
                                   <td class="heading"><b>Education : </b></th>
                                    <td><?php echo $visitor_info->EDUCATION_DEGREE_NAME;?></td>
                                         <td class="heading"><b>Fax : </b></th>
                                        <td><?php echo $visitor_info->FAX;?></td>
                                      </tr>
                                    <tr>
                                     <td class="heading"><b>Subject :</b></th>
                                     		 <td><?php echo $visitor_info->FIELD_SUBJECT;?></td>
                                        <th colspan="2">
                                              ADDRESS INFORMATION
                                         </th>
                                      	</tr>
                                        <tr>
                                         <td class="heading"><b>Institution Name : </b></th>
                                        <td><?php echo $visitor_info->INSTITUTE_NAME;?></td>
                                           <td class="heading"><b>Address :</b></td>
                                              <td><?php echo $visitor_info->ADDRESS;?></td>
                                          </tr>
                                         <tr>
                                              <td class="heading"><b>Institution Address : </b></th>
                                          <td><?php echo $visitor_info->INSTITUTE_ADDRESS;?></td>
                                             <td class="heading"><b>Zone :</b></td>
                                            	<td> <?php echo $visitor_info->Zones; ?></td>
                                            </tr>
                                                </table>
                                              </th>
                                            </tr>
                                          </thead>
                                        </table>
										</div>





