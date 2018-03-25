<style type="text/css">
    .veryStrong{  color:#CDFFCD; margin-left: 17%; width: 33%; border-width: 55%;background: #48B448;  font-size: 16px; margin-right:46%; }
    .strongstrong{color:#000000; margin-left: 17%; width: 33%; border-width: 55%;background: #79F079;  font-size: 16px; margin-right:46%;}
    .good{color:#000000; margin-left: 17%; width: 33%; border-width: 55%; background: #79F079; font-size: 16px; margin-right:46%;}
    .stillWieek{color: #000000;  margin-left: 17%; width: 33%; border-width: 55%;background: #79F079; font-size: 16px; margin-right:46%;}
    .veryWeek{ margin-left: 17%; width: 33%; border-width: 55%;background: #79F079; color:#000000; font-size: 16px; margin-right:46%;}
    .noMatch{ margin-left: 17%; width: 33%; border-width: 55%;background: #79F079; color:#000000;  font-size: 16px; margin-right:46%;}
    .match{ margin-left: 17%; width: 33%; border-width: 55%; background: #48B448; color:#CDFFCD; font-size: 16px; margin-right:46%;}
</style>

<div class="widget widget-body-white">
    <div class=" widget-body">
        <form  name="myForm" onsubmit="return(validate());"  action="<?php echo site_url('setup/setup/user_data_update/' . $user->USER_ID); ?>" method="post" enctype="multipart/form-data">
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="cmbGroupName" class="col-md-3 control-label">User Group</label>
                        <div class="col-md-4"> 
                            <?php echo form_dropdown('cmbGroupName', $user_group, $user->USERGRP_ID, 'id="cmbGroupName" class="dropdown-option " required="required"  style="width: 100%;" '); ?>
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>User Group Type</strong>
                        <hr>
                        <p class="muted">Please Select User Group here.</p>
                    </div> 
                </div> 
            </div>  
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="cmbLevelName" class="col-md-3 control-label">User Level</label>
                        <div class="col-md-3">                             
                            <?php echo form_dropdown('cmbLevelName', $user_level, $user->USERLVL_ID, 'id="selectLevelName" class="form-control"  '); ?>
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>User Level</strong>
                        <hr>
                        <p class="muted">Please Select User Level here.</p>
                    </div> 
                </div> 
            </div> 
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="cmbInstituteName" class="col-md-3 control-label">Institute</label>
                        <div class="col-md-5"> 
                            <?php //echo form_dropdown('cmbInstituteName', $institute, '', 'id="cmbInstituteName" class="dropdown-option col-md-12"  '); ?>
                            <select  name="cmbSubProject" id="cmbInstituteName" class="dropdown-option" style="width: 100%;">
                                <option value=""> Select One</option>
                                <?php foreach ($institutes as $institute): ?>
                                    <option <?php echo ($user->ORG_ID == $institute->INSTITUTE_NO) ? 'selected' : ''; ?> value="<?php echo $institute->INSTITUTE_NO; ?>"><?php echo $institute->INSTITUTE_NAME; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>Institute</strong>
                        <hr>
                        <p class="muted">Please Select Institute here.</p>
                    </div> 
                </div> 
            </div> 
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="cmbSubProject" class="col-md-3 control-label">Sub Project</label>
                        <div class="col-md-9"> 
                            <?php //echo form_dropdown('cmbSubProject', $sup_project, $user->SUB_PROJ_ID, 'id="cmbSubProject" class="dropdown-option "  '); ?>
                            <select  name="cmbSubProject" id="selectSubProject" class="form-control" style="width: 100%;">
                                <option value=""> Select One</option>
                                <?php foreach ($subProjectNames as $subproject): ?>
                                    <option <?php echo ($user->SUB_PROJ_ID == $subproject->SUB_PROJECT_NO) ? 'selected' : ''; ?> value="<?php echo $subproject->SUB_PROJECT_NO; ?>"><?php echo $subproject->CP_NO . ' - ' . $subproject->SUB_PROJECT_TITLE; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                        <label for="textFirstName" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-4"> 
                            <input type="text" class="form-control" value="<?php echo $user->FIRST_NAME; ?>"  name="textFirstName"  id="textFirstName" required="required"/>    
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
                        <div class="col-md-7"> 
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
                        <label for="textLastName" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-5"> 
                            <input type="text" class="form-control" value="<?php echo $user->LAST_NAME; ?>"  name="textLastName" id="textLastName"  required="required"/>    
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
                        <label for="textEmailName" id="checkEmail"class="col-md-3 control-label ">Email Address</label>
                        <div class="col-md-6"> 
                            <input type="text" class="form-control checkEmail" value="<?php echo $user->EMAIL; ?>"  name="textEmailName"  id="textEmailName" /> 
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
                        <label for="textUserName" class="col-md-3 control-label">User  Name</label>
                        <div class="col-md-6"> 
                            <input type="text" class="form-control" value="<?php echo $user->USERNAME; ?>" name="textUserName" id="textUserName" required="required" />    
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
                        <div class="col-md-6"> 
                            <input type="password" id="password1" value="<?php echo $user->USERPW; ?>" class="form-control" name="textPassword" id="textPassword" required="required"/>    
                        </div>
                    </div>
                    <div class="col-md-4 help">
                        <strong><span  class="help-head">Help: </span>Password Name</strong>
                        <hr>
                        <p class="muted">Please enter Password  here.</p>
                    </div> 
                </div> 
            </div>                      
            <div id="pass-info"></div>
            <div id="divCheckPasswordMatch"></div>
            <div class="row">  
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="image" class="col-md-3 control-label">Image Upload</label>
                        <div class="col-md-6"> 
                            <?php echo "<input type='file' name='userfile' size='20'  "; ?>
                        </div>
                    </div>                    
                </div> 
            </div>
            <div class="separator"></div>  
            <center>
                <div class="form-group">
                    <div class="col-xs-5 col-xs-offset-3">
                        <button type="submit"  class="btn btn-success "><i class="fa fa-check-circle"></i>Update</button>
                    </div>
                </div>
            </center>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).on("change", "#cmbGroupName", function () {
        var user_id = $(this).val();
        $.ajax({
            type: 'POST',
            data: {user_id: user_id},
            url: "<?php echo site_url('setup/setup/getUserLevel'); ?>",
            success: function (data) {
                $('#selectLevelName').html(data);
            }
        });
    });

    $(document).on("change", "#cmbInstituteName", function () {
        var sub_id = $(this).val();
        //alert(sub_id);
        $.ajax({
            type: 'POST',
            data: {sub_id: sub_id},
            url: "<?php echo site_url('setup/setup/getSubProject'); ?>",
            success: function (data) {
                $('#selectSubProject').html(data);
            }
        });
    });

    $('#textUserName').keyup(function () {
        var username = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('setup/setup/check_userName'); ?>",
            data: {username: username},
            success: function (data)
            {
                if (data == 'exist')
                {
                    $('#user_name').html('<p style="color: red;font-size: 14px;">User Name Already Exist</p>');
                }
                else
                {
                    $('#user_name').html('<p style="color: green;font-size: 14px;">Valid User Name  </p>');
                }
            }
        });
    });
    $(document).on('keyup', '.checkEmail', function () {
        var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
        if (valid) {
            $('#valid').html('<p style="color:Green;"> Email Address Valid</p>');
        } else {
            $('#valid').html('<p style="color:red;">Email Address Invalid </P>');
        }
    });
</script>

<script>
    $(document).ready(function () {
        var password1 = $('#password1');
        var password2 = $('#password2');
        var passwordsInfo = $('#pass-info');
        passwordStrengthCheck(password1, password2, passwordsInfo);
    });
    function passwordStrengthCheck(password1, password2, passwordsInfo)
    {
        var WeakPass = /(?=.{8,}).*/;
        var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
        var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
        var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/;
        $(password1).on('keyup', function (e) {
            if (VryStrongPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="veryStrong" >Very Strong! ( please don\'t forget your password)</p>');
            }
            else if (StrongPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="strongstrong">Strong! (Enter special chars to make even stronger)</p>');
            }
            else if (MediumPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="good">Good! (Enter uppercase letter to make strong)</p>');
            }
            else if (WeakPass.test(password1.val()))
            {
                passwordsInfo.removeClass().html('<p class="stillWieek">Still Weak! (Enter digits to make good password)</p>');
            }
            else
            {
                passwordsInfo.removeClass().html('<p class="veryWeek ">Very Weak! (Must be 8 or more chars)</p>');
            }
        });

        $(password2).on('keyup', function (e) {

            if (password1.val() !== password2.val())
            {
                passwordsInfo.removeClass().html('<p class="noMatch ">Passwords do not match!</p>');
            } else {
                passwordsInfo.removeClass().html('<p class="match ">Passwords match!</p>');
            }

        });
    }
</script>

<script>
    //function validate()

    //    {      
    //        var WeakPass = /(?=.{8,}).*/; 
    //        var validPass=WeakPass>=8;
    //        if( document.myForm.password1.value == validPass )
    //        {
    //        }else{
    //            alert( "Password do no valid!" );
    //            document.myForm.password1.focus() ;
    //            return false;
    //        }  
    //        
    //    }
</script>