


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/favIcon.png">

    
     <title>.: Allometry & Emission Factor Database || Allometry & Emission Factor Database:. Login Panel</title>

        <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo base_url(); ?>resources/shared/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/less/pages/serveStyles_62.css" />
        <script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery-migrate.min.js"></script>
        <script src="<?php echo base_url(); ?>resources/shared/components/library/modernizr/modernizr.js"></script>

    <!-- Bootstrap Core CSS -->
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" />

    <!-- MetisMenu CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/shared/components/modules/admin/metisMenu/metisMenu.min.css" />

    <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/sb-admin-2.css" />
    <!-- Custom Fonts -->
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                 <h1 style="padding: 0;" align="center"><a href="<?php echo site_url(); ?>"><img style="height: 100px;" src="<?php echo base_url('resources/resource_potal/assets/portal/images/logo.png'); ?>" alt="HEQEP" /></a></h1>
                    <div class="panel-heading">

                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">

                    <?php echo form_open(); ?>
                            <?php if (validation_errors()): ?>
                                <div class="row">
                                    <div class="alert alert-danger">
                                        <?php echo validation_errors(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="msg">
                                <?php
                                if ($this->session->flashdata('Success') != false) {
                                    echo '<div class="alert alert-success">';
                                    //echo '<button data-dismiss="alert" class="close" type="button">×</button>';
                                    echo '<p>' . $this->session->flashdata('Success') . '</p>';
                                    echo '</div>';
                                } elseif ($this->session->flashdata('Error') != false) {
                                    echo '<div class="alert alert-danger">';
                                    //echo '<button data-dismiss="alert" class="close" type="button">×</button>';
                                    echo '<p>' . $this->session->flashdata('Error') . '</p>';
                                    echo '</div>';
                                } elseif ($this->session->flashdata('Warning') != false) {
                                    echo '<div class="alert alert-warning">';
                                    //echo '<button data-dismiss="alert" class="close" type="button">×</button>';
                                    echo '<p>' . $this->session->flashdata('Warning') . '</p>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    
                                     <input type="text" name="txtUserName" class="form-control" required="required" value="<?php echo set_value('txtUserName'); ?>" placeholder="Your Username"/> 
                                </div>
                                <div class="form-group">
                                    <input type="password" name="txtPassword" class="form-control" required="required" placeholder="Your Password" />
                                <a style=" text-decoration: none;" class="password" href="<?php echo site_url('dashboard/auth/forgot_password'); ?>">Can't access your account?</a>
                                
                                </div>
                             

                                 <div class="checkbox">
                                    <div class="uniformjs"><label class="checkbox"><input type="checkbox" value="remember-me">Remember me</label></div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                               <!--   <button class="btn btn-block btn-inverse" type="submit">Sign in</button> -->
                               <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
                                <?php echo form_close(); ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url(); ?>resources/js/sb-admin-2.js"></script>
   <script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/uniform/assets/lib/js/jquery.uniform.min.js"></script>
            <script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/uniform/assets/custom/js/uniform.init.js"></script>

</body>

</html>