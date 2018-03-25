<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top sidebar sidebar-full"><!-- <![endif]-->
    <head>
        <title>Login</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <!-- 
        **********************************************************
        In development, use the LESS files and the less.js compiler
        instead of the minified CSS loaded by default.
        **********************************************************
        <link rel="stylesheet/less" href="../assets/less/admin/module.admin.page.login.less" />
        -->

        <!--[if lt IE 9]><link rel="stylesheet" href="http://preview.mosaicpro.biz/shared/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/less/pages/serveStyles_62.css" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->	

    </head>
    <body class="login ">

        <!-- Wrapper -->
        <div id="login">

            <div class="container">

                <div class="wrapper">

                    <h1 class="glyphicons lock">Quick Admin <i></i></h1>

                    <!-- Box -->
                    <div class="widget widget-heading-simple widget-body-gray">

                        <div class="widget-body">

                            <!-- Form -->
                            <form method="post" action="index_2.html">
                                <label>Username or Email</label>
                                <input type="text" class="form-control" placeholder="Your Username or Email address"/> 
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Your Password" />
                                <a class="password" href="login.html">forgot the password?</a>
                                <div class="separator bottom clearfix"></div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="uniformjs"><label class="checkbox"><input type="checkbox" value="remember-me">Remember me</label></div>
                                    </div>
                                    <div class="col-md-4 center">
                                        <button class="btn btn-block btn-inverse" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </form>
                            <!-- // Form END -->

                        </div>
                        <div class="widget-footer">
                            <p class="glyphicons restart"><i></i>Please enter your username and password ...</p>
                        </div>
                    </div>
                    <!-- // Box END -->

                    <div class="innerT center">
                        <a href="signup.html" class="btn btn-icon-stacked btn-block btn-success glyphicons user_add"><i></i><span>Don't have an account?</span><span class="strong">Sign up</span></a>
                    </div>

                </div>
            </div>

        </div>
        <!-- // Wrapper END -->




        <!-- Global -->

    </body>
</html>