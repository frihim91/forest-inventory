<style type="text/css">
    .veryStrong{  color:#CDFFCD; margin-left: 17%; width: 100%; border-width: 55%;background: #48B448;  font-size: 16px; margin-right:46%; }
    .strongstrong{color:#000000; margin-left: 17%; width: 100%; border-width: 55%;background: #79F079;  font-size: 16px; margin-right:46%;}
    .good{color:#000000; margin-left: 17%; width: 100%; border-width: 55%; background: #79F079; font-size: 16px; margin-right:46%;}
    .stillWieek{color: #000000;  margin-left: 17%; width: 100%; border-width: 55%;background: #79F079; font-size: 16px; margin-right:46%;}
    .veryWeek{ margin-left: 17%; width: 83%; border-width: 55%;background: #79F079; color:#000000; font-size: 16px; margin-right:46%;}
    .noMatch{ margin-left: 17%; width: 83%; border-width: 55%;background: #79F079; color:#000000;  font-size: 16px; margin-right:46%;}
    .match{ margin-left: 17%; width: 83%; border-width: 55%; background: #48B448; color:#CDFFCD; font-size: 16px; margin-right:46%;}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/less/pages/serveStyles_62.css" />
<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/modernizr/modernizr.js"></script>
<title>.: PMIS || Project Management Information System :. Generate New  Password Panel</title>
<?php $random_code = $this->uri->segment(3); ?>
<body class="login">
    <div id="login">
        <div class="container">
            <div class="wrapper">
                <div class="widget widget-heading-simple widget-body-gray ">
                    <div class="widget-body">
                        <!-- Form -->
                        <form method="post" action="<?php echo site_url('auth/generate_new_password'); ?>" onSubmit="return  confirmPassword(this)"/>
                        <?php //echo form_open('auth/generate_new_password_datainsert'); ?>
                        <?php if (validation_errors()): ?>
                            <div class="row">
                                <div class="alert alert-danger">
                                    <?php echo validation_errors(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div><h3 style="margin-left:0%;"><a href="<?php echo site_url(); ?>"><img style="height: 65px; margin-left: 0%;" src="<?php echo base_url('resources/images/HEQEPLogoPng.png'); ?>" alt="HEQEP" /></a></h3></div><br/>
                        <div><h4><b>Reset your password</b></h4></div><br/>
                        <div>Please choose a new password to finish signing in. </div><br/>
                        <input type="hidden" name="randomCode" id="randomCode" value="<?php echo $random_code ?>"/>
                        <input type="password" placeholder="New Password" class="form-control " required="required" id="password1" name="textPassword"/>
                        <input type="password"  placeholder="Re-entry New Password" id="password2" class="form-control" required="required" name="textReTypePassword"/>                             
                        <div class="separator bottom clearfix"></div>
                        <div id="pass-info"></div>
                        <div id="divCheckPasswordMatch"></div><br/>
                        <div class="row">
                            <div class="col-md-4 center">
                                <button   name="submit" id="submit" class="btn btn-success" type="submit">Change Password</button>
                            </div>
                        </div>                           
                        <?php //echo form_close(); ?>
                        </form>
                        <!-- // Form END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/uniform/assets/lib/js/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/uniform/assets/custom/js/uniform.init.js"></script>
</body>

<script type="text/javascript">
    function confirmPassword(form) {
        var password1 = document.getElementById("password1").value;
        var password2 = document.getElementById("password2").value;
        // var ok = true;
        //var length=6;
        if (password1.length<6) {
            alert('Your password must be at least 6 characters long.');
            form.password1.focus();
            return false;            
        }else if (password1 !== password2) {
            alert("Your Password and Re-entry Password  do not  Match.");
            form.password2.focus();
            return false;
        }
        else {          
            
        }       
    }

    $(document).ready(function () {
        var password1 = $('#password1');
        var password2 = $('#password2');
        var passwordsInfo = $('#pass-info');
        passwordStrengthCheck(password1, password2, passwordsInfo);
    });
    function passwordStrengthCheck(password1, password2, passwordsInfo)
    {
        var WeakPass = /(?=.{6,}).*/;
        var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{6,}$/;
        var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{6,}$/;
        var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{6,}$/;
        $(password1).on('keyup', function (e) {
            if (VryStrongPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="veryStrong" > Please don\'t forget your password</p>');
            }
            else if (StrongPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="strongstrong">Enter special chars to make even stronger</p>');
            }
            else if (MediumPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="good">Enter uppercase letter to make strong</p>');
            }
            else if (WeakPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="stillWieek">Enter digits to make good password</p>');
            }
            else
            {
                passwordsInfo.removeClass().html('<p class="veryWeek ">Must be 6 or more chars</p>');
            }
        });

        $(password2).on('keyup', function (e) {

            if (password1.val() !== password2.val())
            {
                passwordsInfo.removeClass().html('<p class="noMatch ">Passwords do not match!</p>');
            } else  {
                passwordsInfo.removeClass().html('<p class="match ">Passwords match!</p>');
            }

        });
    }
</script>