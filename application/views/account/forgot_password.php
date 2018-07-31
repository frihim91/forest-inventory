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

</style>
<style type="text/css">
	#exist_email, #exist_email_2{
		display:none;
		color: red;
	}
	#link_sent, #link_sent_2{
		display:none;
		color: green;
	}
	#for_password, #for_username{
		display: none;
	}
	.pull-right{
		margin-bottom: 5px;
		margin-top: -8px;
	}
	#loading, #loading2{
		display: none;
		color: blue;
	}
	.not_registered{
		color:red;
	}
	.modal-dialog{
		width: 420px !important;
	}

	.lead{
		text-align: center;
		margin-bottom: -5px;
	}
	.close_btn{
		margin-top: 22px;
	}
	.control-label{
		font-weight: 100;
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
	<div class="col-sm-12 bdy_des">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<h2>Reset your password</h2>
					<h4>Please enter your email address to reset your password. A mail will be sent to your email account with instructions on how to reset your<br> password.</h4>
					<?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'frmUserInfo')); ?>
					<?php if (validation_errors()): ?>
						<div class="row"><button data-dismiss="alert" class="close" type="button">×</button>
							<div class="alert alert-danger">
								<?php echo validation_errors(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-sm-5">
					<form role="form">
						<div class="form-group">
							<label>Email<span style="color:red;">*</span></label>
							<?php echo form_input(array('class' => 'checkUserEmail form-control', 'placeholder' => 'Enter Your Email', 'id' => 'EMAIL', 'name' => 'EMAIL','type' => 'email', 'value' => set_value('EMAIL'), 'required' => 'required')); ?> 
							<div id="checkUsermail"></div>
							<div id="exist_email"> Please Enter a Valid Email Address</div> 
							<div id="loading">Please wait......</div>
							<div id ="not_registered"></div> 
							<div class="submit_block" align="left">
								<a class="btn btn-success" id="get_password">Submit</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on("keyup", "#EMAIL", function() {
		var EMAIL = $(this).val();
		var url = '<?php echo site_url('accounts/checkUserVaildEmail') ?>';
		$.ajax({
			type: "POST",
			url: url,
			dataType : 'html',
			data: {EMAIL: EMAIL},
			success: function(data) {
	        	//console.log(data);
	        	if(data == 'emailNotExit'){
	        		$('#checkUsermail').html("<span style='color:red'>Your Inaild Email!</span>");	  		
	        	}
	        	else{
	        		$('#checkUsermail').html('');
	        	}
	        }
	    });
	});	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#recovey_password").click(function(){
            // $( "#recovery_username" ).prop( "checked", false );
            $("#for_password").slideToggle("slow");
            $("#for_username").slideUp();
            //$('.close_close').hide();
        });
		
		$("#recovery_username").click(function(){
            // $("#recovey_password").prop( "checked", false );
            $("#for_username").slideToggle("slow");
            $("#for_password").slideUp();
            //$('.close_close').hide();
        });
		
        // forget password
        $(document).on("click","#get_password",function(){
        	var username_email = $("#EMAIL").val();
            //alert(username_email);
            if(username_email == null || username_email == ""){
            	$("#username_email").focus();
            }
            else{
            	$("#not_registered").hide();
            	$("#loading").show();
            	
            	$.ajax({
            		type: "POST",
            		url:"<?php echo site_url('accounts/forgetPassword'); ?>",
            		data: {username_email:username_email},
            		success: function(result) {
            			$("#loading").hide();
            			$("#not_registered").html(result);
            			$("#not_registered").show();
                        //$("#loading").hide();
                        //$("#messeage").html(result);
                    }
                });
            }
        });
        

        $(document).on("click","#getUsername",function(){
        	var email = $("#email_2").val();
        	
        	if(email == null || email == ""){
        		$("#email_2").focus();
        	}
        	else{
        		$("#not_registered").hide();
        		$("#loading2").show();
        		$.ajax({
        			type: "POST",
        			url:"<?php echo site_url('auth/forgrtUsername'); ?>",
        			data: {email:email},
        			success: function(result) {
        				
        				$("#loading2").hide();
        				$("#messeage").html(result);
        			}
        		});
        	}
        	
        	
        });
    });
</script>
