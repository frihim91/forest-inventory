<style type="text/css">
    .veryStrong{  color:#CDFFCD; margin-left: 17%; width: 23%; border-width: 55%;background: #48B448;  font-size: 16px; margin-right:46%; }
    .strongstrong{color:#000000; margin-left: 17%; width: 26%; border-width: 55%;background: #79F079;  font-size: 16px; margin-right:46%;}
    .good{color:#000000; margin-left: 17%; width: 23%; border-width: 55%; background: #79F079; font-size: 16px; margin-right:46%;}
    .stillWieek{color: #000000;  margin-left: 17%; width: 22%; border-width: 55%;background: #79F079; font-size: 16px; margin-right:46%;}
    .veryWeek{ margin-left: 17%; width: 15%; border-width: 25%;background: #79F079; color:#000000; font-size: 16px; margin-right:46%;}
    .noMatch{ margin-left: 17%; width: 18%; border-width: 55%;background: #79F079; color:#000000;  font-size: 16px; margin-right:46%;}
    .match{ margin-left: 17%; width: 18%; border-width: 55%; background: #48B448; color:#CDFFCD; font-size: 16px; margin-right:46%;}
    .subProjectArea{display: none;}
</style>
<div class="widget widget-body-white">
    <div class=" widget-body">
        <?php echo form_open_multipart('', array('id' => 'frmUserInfo')); ?>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="cmbGroupName" class="col-md-3 control-label">User Group <span class="requiredLevel">*</span></label>
                    <div class="col-md-4"> 
                        <?php echo form_dropdown('cmbGroupName', $user_group, $user->USERGRP_ID, 'id="cmbGroupName" class="dropdown-option required_field" style="width: 100%;" '); ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>User Group</strong>
                    <hr>
                    <p class="muted">Please Select User Group here.</p>
                </div> 
            </div> 
        </div>  
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="selectLevelName" class="col-md-3 control-label">User Level </label>
                    <div class="col-md-3">                             
                        <?php echo form_dropdown('selectLevelName', $user_level, $user->USERLVL_ID, 'id="selectLevelName" class="form-control"  '); ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>User Level</strong>
                    <hr>
                    <p class="muted">Please Select User Level here.</p>
                </div> 
            </div> 
        </div> 
        <div class="row subProjectArea">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="cmbInstituteName" class="col-md-3 control-label">Institute <span class="requiredLevel">*</span></label>
                    <div class="col-md-5">
                        <?php echo form_dropdown('cmbInstituteName', $institute, $user->INSTITUTE_NO, 'id="cmbInstituteName" class="dropdown-option col-md-12"  '); ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Institute</strong>
                    <hr>
                    <p class="muted">Please Select Institute here.</p>
                </div> 
            </div> 
        </div> 
        <div class="row subProjectArea">
            <div class="form-group">
                <div class="col-md-8">
                    <label for="cmbSubProject" class="col-md-3 control-label">Sub Project <span class="requiredLevel">*</span></label>
                    <div class="col-md-9">
                        <?php echo form_dropdown('selectSubProject', $subProjectArray, $user->SUB_PROJ_ID, 'id="selectSubProject" class="dropdown-option col-md-12"  '); ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Sub Project</strong>
                    <hr>
                    <p class="muted">Please Select Sub Project here.</p>
                </div> 
            </div> 
        </div>  
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="textFirstName" class="col-md-3 control-label">First Name <span class="requiredLevel">*</span></label>
                    <div class="col-md-5"> 
                        <input type="text" class="form-control required_field" value="<?php echo $user->FIRST_NAME; ?>"  name="textFirstName"  id="textFirstName"/>    
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>First Name</strong>
                    <hr>
                    <p class="muted">Please enter First Name here.</p>
                </div> 
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="textMiddleName" class="col-md-3 control-label">Middle  Name</label>
                    <div class="col-md-5"> 
                        <input type="text" class="form-control"  value="<?php echo $user->MIDDLE_NAME; ?>" name="textMiddleName" id="textMiddleName"/>                      
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Middle Name</strong>
                    <hr>
                    <p class="muted">Please enter Middle Name here.</p>
                </div> 
            </div> 
        </div>  
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="textLastName" class="col-md-3 control-label">Last Name <span class="requiredLevel">*</span></label>
                    <div class="col-md-5"> 
                        <input type="text" class="form-control required_field" value="<?php echo $user->LAST_NAME; ?>"  name="textLastName" id="textLastName" />    
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Last Name</strong>
                    <hr>
                    <p class="muted">Please enter Last  Name here.</p>
                </div> 
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="GENDER" class="col-md-3 control-label">Gender <span class="requiredLevel">*</span></label>
                    <div class="col-md-5">
                        <?php echo form_dropdown('GENDER', $genders, $user->GENDER, 'id="GENDER" class="dropdown-option col-md-6 required_field"  '); ?>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Gender</strong>
                    <hr>
                    <p class="muted">Please Select Gender here.</p>
                </div> 
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="textEmailName" id="checkEmail"class="col-md-3 control-label ">Email Address <span class="requiredLevel">*</span></label>
                    <div class="col-md-5"> 
                        <input type="text" class="form-control checkEmail required_field" value="<?php echo $user->EMAIL; ?>"  name="textEmailName"  id="textEmailName" /> 
                        <span id="valid" ></span>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Email Address</strong>
                    <hr>
                    <p class="muted">Please enter Email Address  here.</p>
                </div>
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="textUserName" class="col-md-3 control-label">User  Name <span class="requiredLevel">*</span></label>
                    <div class="col-md-5">
                        <input type="hidden" id="USER_ID" name="USER_ID" value="<?php echo $user->USER_ID; ?>"/>
                        <input type="text" class="form-control required_field" value="<?php echo $user->USERNAME; ?>" name="textUserName" id="textUserName"/>    
                        <span id="user_name" ></span>
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>User Name</strong>
                    <hr>
                    <p class="muted">Please enter User  Name here.</p>
                </div> 
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="firstname" class="col-md-3 control-label">Password</label>
                    <div class="col-md-5"> 
                        <input type="password" id="password1" class="form-control" name="textPassword" /> 
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Password</strong>
                    <hr>
                    <p class="muted">Please enter Password  here.</p>
                </div> 
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="textReTypePassword" class="col-md-3 control-label">Re Type Password</label>
                    <div class="col-md-5"> 
                        <input type="password" id="password2" class="form-control" name="textReTypePassword"/>    
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Re Type Password Name</strong>
                    <hr>
                    <p class="muted">Please enter Re Type Password  here.</p>
                </div> 
            </div> 
        </div>        
        <div class="row">  
            <div id="pass-info"></div>
            <div id="divCheckPasswordMatch"></div>
        </div><br/>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="userfile" class="col-md-3 control-label">Profile Picture</label>
                    <div class="col-md-8"> 
                        <input type="file" name="userfile" size="20" />
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Profile Picture</strong>
                    <hr>
                    <p class="muted">Please Select you Profile Picture.</p>
                </div> 
            </div> 
        </div>
        <div class="row">  
            <div class="form-group">
                <div class="col-md-8">
                    <label for="STATUS" class="col-md-3 control-label">Is Active ?</label>
                    <div class="col-md-8"> 
                        <?php echo form_checkbox('STATUS', 1, ($user->STATUS == 1) ? TRUE : FALSE); ?>       
                    </div>
                </div>
                <div class="col-md-4 help">
                    <strong><span  class="help-head">Help: </span>Is Active ?</strong>
                    <hr>
                    <p class="muted">If active checked checkbox, else uncheck .</p>
                </div> 
            </div> 
        </div>
        <div class="separator"></div>  
        <center>
            <div class="form-group">
                <div class="col-xs-3 col-xs-offset-3">
                    <button type="submit" id="saveUserInfo"  class="btn btn-success "><i class="fa fa-check-circle"></i>Update Now</button>
                    <a href="<?php echo site_url('setup/setup/user_list'); ?>" <button type="button"  class="btn btn-danger" id=""><i class="fa fa-times"></i>Close </button></a>
                </div>
            </div>
        </center>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var user_grp_id = '<?php echo $user->USERGRP_ID; ?>';
        if (user_grp_id == '3') {
            $('.subProjectArea .dropdown-option').addClass('required_field');
            $('.subProjectArea').show();
        } else {
            $('.subProjectArea .dropdown-option').removeClass('required_field');
            $('.subProjectArea').hide();
        }
        $(document).on("change", "#cmbGroupName", function () {
            var group_id = $(this).val();
            if (group_id == 3) {
                $('.subProjectArea .dropdown-option').addClass('required_field');
                $('.subProjectArea').show();
            } else {
                $('.subProjectArea .dropdown-option').removeClass('required_field');
                $('.subProjectArea').hide();
            }
            $.ajax({
                type: 'POST',
                data: {group_id: group_id},
                url: "<?php echo site_url('setup/setup/getUserLevel'); ?>",
                success: function (data) {
                    $('#selectLevelName').html(data);
                }
            });
        });

        $(document).on("change", "#cmbInstituteName", function () {
            var sub_id = $(this).val();
            $.ajax({
                type: 'POST',
                data: {sub_id: sub_id},
                url: "<?php echo site_url('setup/setup/getSubProject'); ?>",
                success: function (data) {
                    $('#selectSubProject').html(data).change();
                }
            });
        });

        $('#textUserName').keyup(function () {
            var USER_ID = $('#USER_ID').val();
            var username = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('setup/setup/check_userName'); ?>",
                data: {username: username, USER_ID: USER_ID},
                success: function (data)
                {
                    if (data == 'exist') {
                        $('#user_name').addClass('exist').html('<p style="color: red;font-size: 14px;">User Name Already Exist</p>');
                        return false;
                    } else {
                        $('#user_name').removeClass('exist').html('<p style="color: green;font-size: 14px;">Valid User Name  </p>');
                    }
                }
            });
        });
        $(document).on('keyup', '.checkEmail', function () {
            var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
            var emailAddress=document.getElementById("textEmailName").value;
            if (valid) {
                $('#valid').html('<p style="color:Green;"> Email Address Valid</p>');
            } else {
                $('#valid').html('<p style="color:red;">Email Address Invalid </P>');
            }
        });

        $(document).on("click", "#saveUserInfo", function (e) {
            var isSubmit = 'Yes';
            $('.required_field').each(function () {
                if ($(this).val() == "") {
                    $(this).css("border", "1px solid red");
                    if (!$(this).hasClass("select2-container")) {
                        isSubmit = 'No';
                    }
                } else {
                    $(this).css("border", "");
                    if ($(this).hasClass("dropdown-option")) {
                        $('#s2id_' + ($(this).attr('id'))).css("border", "");
                    }
                }
            });
            if (isSubmit == 'Yes') {
                //var password=document.getElementById("password1").value.length;
                 var emailAddress=document.getElementById("textEmailName").value;
                if (!validateEmail(emailAddress)) {
                    notyfy({
                        text: 'Enter a valid email address!',
                        type: 'error',
                        timeout: 5000
                    });
                }else if (($('#password1').val()) != ($('#password2').val())) {
                    notyfy({
                        text: 'Password do not match !',
                        type: 'error',
                        timeout: 5000
                    });
                } else {
                    if ($('#user_name').hasClass('exist')) {
                        notyfy({
                            text: 'Sorry ! This Username Already Exist, Please use another One .',
                            type: 'error',
                            timeout: 5000
                        });
                    } else {
                        $('#frmUserInfo').submit();
                    }
                }
            }
            e.preventDefault();
        });
    });

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

