<style type="text/css">
    .important{ color:  red;}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/less/pages/serveStyles_62.css" />
<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/modernizr/modernizr.js"></script>
<title>.: BFD || Bangladesh Forest Department :. Forgot Password Panel</title>
<body class="login ">
    <div id="login" >
        <div class="container" style=" font-size: ">
            <div class="wrapper">                   
                <div class="widget widget-heading-simple widget-body-gray">
                    <div class="widget-body">

                        <?php if (validation_errors()): ?>
                            <div class="row">
                                <div class="alert alert-danger">
                                    <?php echo validation_errors(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div style=" color:#3333ff; font-size: 16px;"><a href="<?php echo site_url(); ?>"><img style="height: 65px; margin-left: 0%;" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="BFD" /></a><hr></div>
                        <div><b> <span class="important">*&nbsp;&nbsp;</span>If you forget your user name or password   select  &nbsp;&nbsp;&nbsp;&nbsp;any option below and inter valid  user name or &nbsp;&nbsp;&nbsp;&nbsp;password then send.<br/>
                                <span class="important">*&nbsp;&nbsp;</span>After successfully send check your email.</b></div><br>
                        <label><input id="forgotPassword" type="radio" name="toggler" value="1" /><b>&nbsp;&nbsp;I don't know my password</b></label>
                        <div id="blk-1" class="toHide" style="display:none">
                            <?php echo form_open('dashboard/auth/sendmail_forgot_password'); ?>
                            Please inter your user name
                            <input type="text" name="txtUserName" id="txtUserName" class="form-control " required="required" placeholder="Enter Your Username"/>
                            <button style=" width: 20%; margin-left: 33%;" class="btn btn-xs  btn-success" type="submit">Send</button>
                            <?php echo form_close(); ?>
                        </div> 
                        <label><input id="fondUsernaem" type="radio" name="toggler" value="2" /><b>&nbsp;&nbsp;I don't know my username</b></label>
                        <div id="blk-2" class="toHide" style="display:none">
                            <?php echo form_open('dashboard/auth/find_username'); ?>
                            Please inter your email address
                            <input type="text" name="txtEmail" id="txtEmail" class="form-control " required="required" placeholder="Enter Your Email"/> 
                            <button style="width: 20%; margin-left: 33%" class="btn btn-xs  btn-success" type="submit">Send</button>
                            <?php echo form_close(); ?>
                        </div><br/><br/>
                        <a href="<?php echo site_url('dashboard/auth/index'); ?>" style="width: 20%; margin-left: 33%" class="btn btn-xs  btn-success close_close" type="submit">Close</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/uniform/assets/lib/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/uniform/assets/custom/js/uniform.init.js"></script>

<script>    
    $(function() {
        $("[name=toggler]").click(function(){
            $('.toHide').hide();
            $("#blk-"+$(this).val()).show('slow');
        });
    });
    $(document).on('click','#forgotPassword',function(){
        $('.close_close').hide();
    })
    $(document).on('click','#fondUsernaem',function(){
        $('.close_close').hide();
    })
</script>