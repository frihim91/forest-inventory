<style type="text/css">
    .veryStrong{  color:#CDFFCD; margin-left: 17%; width: 23%; border-width: 55%;background: #48B448;  font-size: 16px; margin-right:46%; }
    .strongstrong{color:#000000; margin-left: 17%; width: 26%; border-width: 55%;background: #79F079;  font-size: 16px; margin-right:46%;}
    .good{color:#000000; margin-left: 17%; width: 23%; border-width: 55%; background: #79F079; font-size: 16px; margin-right:46%;}
    .stillWieek{color: #000000;  margin-left: 17%; width: 22%; border-width: 55%;background: #79F079; font-size: 16px; margin-right:46%;}
    .veryWeek{ margin-left: 17%; width: 15%; border-width: 25%;background: #79F079; color:#000000; font-size: 16px; margin-right:46%;}
    .noMatch{ margin-left: 17%; width: 18%; border-width: 55%;background: #79F079; color:#000000;  font-size: 16px; margin-right:46%;}
    .match{ margin-left: 17%; width: 18%; border-width: 55%; background: #48B448; color:#CDFFCD; font-size: 16px; margin-right:46%;}
    .subProjectArea{display: none;}

    .error_field{border: 1px solid red;}
</style>
<div class="innerLR"> 
    <?php echo form_open('', array('class' => 'orm-horizontal margin-none', 'id' => 'changePasswordForm')); ?>
    <div class="msg">
        <?php
        if (validation_errors() != false) {
            echo "<div class='alert alert-danger'>";
            echo '<button class="close" data-dismiss="alert" type="button">×</button>';
            echo validation_errors();
            echo "</div>";
        }
        ?>
    </div>
    <div class="widget">  
        <div class="widget-head">
            <h4 class="heading">Change Password</h4>
        </div> 
        <div class="widget-body">   
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label class="col-md-3 control-label">Current Password</label>
                        <div class="col-md-3"> 
                            <?php echo form_password(array('name' => 'CURRENT_PW', 'value' => set_value('CURRENT_PW'), 'class' => 'form-control required_field')); ?>
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>Current Password</strong>
                        <hr>
                        <p class="muted">Please enter Current Password here.</p>
                    </div> 
                </div> 
            </div>
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label class="col-md-3 control-label">New Password</label>
                        <div class="col-md-3"> 
                            <?php echo form_password(array('name' => 'UPW', 'id' => 'password1', 'value' => set_value('UPW'), 'class' => 'form-control required_field')); ?>
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>New Password</strong>
                        <hr>
                        <p class="muted">Please enter New Password here.</p>
                    </div> 
                </div> 
            </div>
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label class="col-md-3 control-label">Confirm New Password</label>
                        <div class="col-md-3"> 
                            <?php echo form_password(array('name' => 'CONFIRM_UPW', 'id' => 'password2', 'value' => set_value('CONFIRM_UPW'), 'class' => 'form-control required_field')); ?>
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>Confirm New Password</strong>
                        <hr>
                        <p class="muted">Please enter Confirm New Password here.</p>
                    </div> 
                </div> 
                <div class="row">  
                    <div id="pass-info"></div>
                    <div id="divCheckPasswordMatch"></div>
                </div><br/>
            </div>
            <div class="separator"></div>  
            <center>
                <div class="form-actions">
                    <button id="changePasswordBtn" class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Change Now</button>
                </div>
            </center> 
        </div>
        <br/>
    </div> 
    <?php echo form_close(); ?> 
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#changePasswordBtn").click(function (e) {
            var isSubmitForm = 'Yes';
            $('.required_field').removeClass('error_field');
            $('.required_field').each(function () {
                if ($(this).val() == '') {
                    $(this).addClass('error_field');
                    isSubmitForm = 'No';
                }
            });
            if(isSubmitForm=='Yes'){
                if(($('#password1').val()) .length<6){
                    notyfy({
                        text: 'New Password must be at least 6 characters long!',
                        type: 'error',
                        timeout: 5000
                    });
                } else if (($('#password1').val()) != ($('#password2').val())) {
                    notyfy({
                        text: 'Password do not match !',
                        type: 'error',
                        timeout: 5000
                    });   
                }else{
            
                    //if (isSubmitForm == 'Yes') {
                    $('#changePasswordForm').submit();
                }
            }
            e.preventDefault();
        });
    })
    
    
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
    
    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
</script>