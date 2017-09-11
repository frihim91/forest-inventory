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
	.submit_block {
		/* text-align: right; */
		padding: 10px;
		clear: both;
	}

	#blah{
		display: none;
		width: 130px;
		height: 130px;
		margin-top: -45px;
	}
		
	}

</style>

<?php
$lang_ses = $this->session->userdata("site_lang");
?>
<div class="col-sm-12 breadcump img-responsive">
	<div class="row">
		<div class="breadcump-wrapper">
			<div class="wrapper">
				<div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("register"); ?>
				</div>
				<div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("register"); ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12 page_content">
	<div class="col-sm-12">
		
	</div>

	<div class="col-sm-12 bdy_des">

		<div class="row">
			<div class="col-md-7">
				<h2>Register</h2>
				<h4>Register to access Forest Inventory:</h4>
				<ol>
					<li>Fill in the form below. Fields marked with an asterisk (*) are obligatory.</li>	
					<li>Your registration will be reviewed by the foreast Inventory team.</li>
					<li>You will be notified by email when your account has been approved.</li>
				</ol>
			</div>
			<div class="col-md-5">
				<h2>Already have an <br> account?</h2>
				<p>If you already have an account:<br>
					<a href="<?php echo site_url('accounts/userLogin')?>" class="btn btn-link" style="color: #147A00;text-decoration: none;"><?php echo $this->lang->line("login"); ?>&gt;&gt;</a></p>
					<p>If you have lost your password:<br>
						<a href="<?php echo site_url('accounts/forgot_password')?>" class="btn btn-link" style="color: #147A00;text-decoration: none;">Reset your password&gt;&gt;</a></p>
					</div>
				</div>
				<?php echo form_open_multipart('accounts/createRegistration', "class='form-vertical'"); ?>
				
				<div class="row">
					<div class="col-md-6">
						<legend>Account Details</legend>
						<?php echo $this->session->flashdata('msg'); ?>
						<?php echo $this->session->flashdata('Error'); ?>
						
						<div class="form-group">
							<label>Email<span style="color:red;">*</span></label>
							<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'EMAIL', 'id' => 'EMAIL', 'name' => 'EMAIL','type' => 'email', 'value' => set_value('EMAIL'), 'required' => 'required')); ?> 
							<div id="checkUsermail"></div>
							<label>Password<span style="color:red;">*</span></label>
							<?php echo form_input(array('class' => 'minLength USERPW form-control', 'placeholder' => 'Password', 'id' => 'USERPW', 'name' => 'USERPW','type' => 'password', 'value' => set_value('USERPW'), 'required' => 'required')); ?>
							<label>Confirm Password<span style="color:red;">*</span></label>
							<?php echo form_input(array('class' => 'password_conf form-control', 'placeholder' => 'Confirm Password', 'id' => 'password_conf','type' => 'password', 'name' => 'password_conf', 'value' => set_value('password_conf'), 'required' => 'required')); ?>
						</div><br>
						<legend>Institution</legend>
						<div class="form-group">
							<label>Name of Institution</label>
							<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Name of Institution', 'id' => 'INSTITUTE_NAME', 'name' => 'INSTITUTE_NAME', 'value' => set_value('INSTITUTE_NAME'))); ?> 
			
						</div>
					</div>
					<div class="col-md-6">
						<legend>Your Information</legend>
						<div class="row">
							<div class="form-group">
								<label>Title<span style="color:red;">*</span></label>
								<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'TITLE', 'id' => 'TITLE', 'name' => 'TITLE', 'value' => set_value('TITLE'), 'required' => 'required')); ?> 
								<label>First name<span style="color:red;">*</span></label>
								<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'First name', 'id' => 'FIRST_NAME', 'name' => 'FIRST_NAME', 'value' => set_value('FIRST_NAME'), 'required' => 'required')); ?> 
								<label>Last name<span style="color:red;">*</span></label>
								<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Last name', 'id' => 'LAST_NAME', 'name' => 'LAST_NAME', 'value' => set_value('LAST_NAME'), 'required' => 'required')); ?> 
								<label>Address<span style="color:red;">*</span></label>
								<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Address', 'id' => 'ADDRESS', 'name' => 'ADDRESS', 'value' => set_value('ADDRESS'), 'required' => 'required')); ?> 
								<label>Education<span style="color:red;">*</span></label>
								<?php
								$education = $this->Account_model->get_education_degree();
								$options = array('' => '--Select-- ');
								foreach ($education as $educations) {
									$options["$educations->EDUCATION_ID"] = $educations->EDUCATION_DEGREE_NAME;
								}
								$EDUCATION_ID = set_value('EDUCATION_ID');
								echo form_dropdown('EDUCATION_ID', $options, $EDUCATION_ID, 'id="id" class="tag-select form-control" data-placeholder="Choose a Education Institute..." ');
								?>    
								<label>Field Subject<span style="color:red;">*</span></label>
								<?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Field Subject', 'id' => 'FIELD_SUBJECT', 'name' => 'FIELD_SUBJECT', 'value' => set_value('	FIELD_SUBJECT'), 'required' => 'required')); ?>
								<label>Purpose Of using the website<span style="color:red;">*</span></label>
								<?php
								$purpose = $this->Forestdata_model->get_purpose();
								$options = array('' => '--Select-- ');
								foreach ($purpose as $purposes) {
									$options["$purposes->PURPOSE_ID"] = $purposes->PURPOSE_NAME;
								}
								$PURPOSE_ID = set_value('PURPOSE_ID');
								echo form_dropdown('PURPOSE_ID', $options, $PURPOSE_ID, 'id="id" class="tag-select form-control" data-placeholder="Choose a Education Institute..." ');
								?>
								<label>Do you want to get notification of event?<span style="color:red;">*</span></label> <?php echo form_checkbox('NOTIFICATION', 1, False); ?><br>
								
                                 
								
								<label>User Image</label>
								 <?php echo form_input(array('type' => 'file', 'name' => 'user_img', 'id' => 'PROFILE_IMG')); ?>
							 
								<div class="submit_block" align="right">
									<input type="submit" value="Register" class="btn-success btn"/>
								</div>
								<div>
								<img id="blah"  class=""  src=""/>
								</div>
								<?php echo form_close(); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- author reazul@atilimited.net -->
 <script type="text/javascript">
    $(function () {
    	 $("#password_conf").on('blur', function(){
            var password = $(".USERPW").val();
            var confirmPassword = $(".password_conf").val();
            if (password != confirmPassword) {
                alert("These passwords miss match.");
                $(".USERPW").val('');
                $(".password_conf").val('');
                return false;
            }
            return true;
        });
    });
</script>
<script type="text/javascript">
	$('.minLength').on('blur', function(){
    if($(this).val().length < 6){
      alert('You have to enter at least 6 digit!');
       $(".USERPW").val('');
    }
});
</script>
<script type="text/javascript">
	$(document).on("blur", "#EMAIL", function() {
	    var EMAIL = $(this).val();
	    var url = '<?php echo site_url('accounts/checkUserEmail') ?>';
	    $.ajax({
	        type: "POST",
	        url: url,
	        dataType : 'html',
	        data: {EMAIL: EMAIL},
	        success: function(data1) {
	        	//console.log(data1);
	        	if(data1 == 1){
	        		$('#EMAIL').val('');
	        		$('#checkUsermail').html("<span style='color:red'>This Email Already Exist</span>");
	        	}else{
	        	$('#checkUsermail').html('');
	        	}
	        	
	        }
	    });
	});	
</script>
 

<script type="text/javascript">
	function readURL(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$("#blah").show();
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("input#PROFILE_IMG").change(function(){
		readURL(this);
	});
</script>

