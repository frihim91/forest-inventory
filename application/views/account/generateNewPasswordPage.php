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
<style type="text/css">

    .modal-dialog{
        width: 400px !important;
    }

</style>
<?php
$randomCode = $this->uri->segment(3); // for get the random code
?>
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
                </div>
            </div>
            <div class="col-sm-5">
              <?php echo form_open('accounts/generateNewPassword', 'id="changePasswordForm"', array('class' => 'form-horizontal', 'method' => 'post')); ?>
              <div class="form-group">
                <label for="txtUserName" class="control-label">New Password</label>
                <input type="hidden" name="randomCode" id="randomCode" value="<?php echo $randomCode ?>"/>
                <input type="password" class="form-control" value="" id="password1" name="password1"
                title="Please enter you username" placeholder="Password" required="required">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="txtPassword" class="control-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password2" 
                name="password2"  title="Please enter your password" value="" placeholder="Confirm Password" required="required">
                <span class="help-block"></span>
            </div>
            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
            <button class="btn btn-primary btn-block" id="submit" name="submit" type="submit" onclick="return Validate()">Change Password</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</div>
</div>


<script type="text/javascript">
    $( document ).ready(function() {
        $('#generate_new_password').formValidation({.

            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            addOns: {
                mandatoryIcon: {
                    icon: 'glyphicon glyphicon-asterisk'
                }
            }
        });

    });
</script>


<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password1").value;
        var confirmPassword = document.getElementById("password2").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            $("#password2").focus();
            return false;
        }
    }
</script>









