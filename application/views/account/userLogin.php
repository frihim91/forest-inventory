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
	<div class="col-md-6">
  <?php echo $this->session->flashdata('msg'); ?>
		<h2>Login</h2>
		<h4>Please log in to access the Foreast Inventory site</h4>
         <?php echo form_open('dashboard/auth/registerLogin', "class='form-vertical'"); ?>
                            <?php if (validation_errors()): ?>
                                <div class="row"><button data-dismiss="alert" class="close" type="button">×</button>
                                    <div class="alert alert-danger">
                                        <?php echo validation_errors(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                             <form role="form">
		      <div class="form-group">
					<label>Username<span style="color:red;">*</span></label>
					<input type="text" name="email" class="form-control" required="required" value="<?php echo set_value('email'); ?>" placeholder="Your Username"/> 
					<label>Password<span style="color:red;">*</span></label>
					 <input type="password" name="txtPassword" class="form-control" required="required" placeholder="Your Password" />
					<p><a href="#">Lost your password?</a></p>
					<div class="submit_block" align="left">
		                <input type="submit" value="Login" class="btn-success btn"/>
                     <?php echo form_close(); ?>
	                    </div>
				</div>
        </form>
		
	</div>
	<div class="col-md-6">
		<h2>Register for a new account</h2>
		<p>Registration is simple and lets you:<br>
		<ul>
		<li>Submit your own allometric equations</li>
		<li>Download datasets of tree allometric data</li>
	    </ul>
			<a href="<?php echo site_url('accounts/userRegistration')?>" class="btn btn-link" style="color: #147A00;text-decoration: none;">Register Now>></a></p>
			
			</div>
 </div>
  </div>


  </div>
