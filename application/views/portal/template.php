    <!DOCTYPE html>
    <html class="no-js" lang="en"> <!--<![endif]-->
        <head>
            <title>.: FAO || Food and Agriculture Organization of the United Nations:.</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta name="description" content=" Food and Agriculture Organization of the United Nations"/>
            <meta name="author" content="ATI Limited"/>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <link rel="shortcut icon" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/logo.jpg">
            <!-- CSS Bootstrap & Custom -->
            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/bootstrap.min.css" rel="stylesheet">
            <!-- portal.css -->
            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/portal.css" rel="stylesheet">
            <!-- end portal.css -->
            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/megamenu/yamm.css" rel="stylesheet">
            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/megamenu/demo.css" rel="stylesheet">

            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/css/font-awesome.min.css" rel="stylesheet" media="screen"/>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/css/animate.css" rel="stylesheet" media="screen"/>
            <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/style.css" rel="stylesheet" media="screen"/>

            <!-- JavaScripts -->
            <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/jquery-2.1.1.js"></script>
            <script src="<?php echo base_url();?>resources/resource_potal/assets/Angular/js/angular/angular.min.js"></script>
       
        </head>
        <body>
        <?php $this->load->view('portal/template/responsive_menu'); ?>
        <!-- /responsive_navigation -->
        <div class="container">
            <div class="row">
                          <header class="site-header header_top_style">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-6 col-sm-4">
                                    <a href="<?php echo site_url(); ?>" title="Home" rel="home">
                                        
                                         <img width="70" src="<?php echo base_url('resources/resource_potal/assets/portal/images/forest.jpg')?>" alt="logo"/>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-sm-4" style="text-align:center;">
                                    
                                   <!-- <a href="<?php echo site_url(); ?>" ><img width="70" src="<?php echo base_url('resources/resource_potal/assets/portal/images/logo.png')?>" alt="logo"/></a> -->
                                </div>
                                <div class="col-xs-6 col-sm-4">

                                 <p align="right">
                                 <a title="English" href="<?php echo site_url('langSwitch/switchLanguage/english'); ?>"><img src="<?php echo base_url('resources/resource_potal/assets/portal/images/flag_eng.gif')?>" alt="flag"/></a>

                                 &nbsp;&nbsp;<a title="Bangla" href="<?php echo site_url('langSwitch/switchLanguage/bangla'); ?>"><img src="<?php echo base_url('resources/resource_potal/assets/portal/images/bangla.gif')?>" alt="flag"/></a>

                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('dashboard/auth/index')?>" target="_blank" class="btn btn-link" style="color: green;text-decoration: underline;font-size: 16px;font-weight: 900;font-style: italic;"><?php echo $this->lang->line("login"); ?></a></p>
                                <form action="<?php echo site_url('portal/search_keyword');?>" method = "post">
                                   <p><input type="text" class="form-control input-sm" name = "keyword" maxlength="64" placeholder="<?php echo $this->lang->line("search"); ?>" />
                                   </p>
                                </form>

                                  
                             <!--     <button type="submit" class="btn btn-primary btn-sm">Search</button> -->
                                </div>
                            </div>
                        </div>
                    </header>
                <?php $this->load->view('portal/template/header'); ?>
            </div>
        </div>
        <!-- /.site-header -->

        <!-- Being Page Title -->
        <?php if (!empty($breadcrumbs)): ?>
            <div class="container body_contents">
                <div class="page-title clearfix">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            foreach ($breadcrumbs as $key => $value):
                                if ($value != '#'):
                                    ?>
                                    <h6><a href="<?php echo site_url("$value"); ?>"><?php echo $key; ?></a></h6>
                                <?php else: ?>
                                    <h6><span class="page-active"><?php echo $key; ?></span></h6>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="container body_contents">
            <div class="row">
                <?php echo $_content; ?>
            </div>
        </div>

        <!-- begin The Footer -->
        <footer class="site-footer">
            <?php $this->load->view('portal/template/footer'); ?>
        </footer>
        <!-- /.site-footer -->
        <script type="text/javascript">
            var baseUrl = "<?php echo base_url(); ?>";
        </script>
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/js/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/js/custom.js"></script>
            
        </body>
    </html>