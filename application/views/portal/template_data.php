    <!DOCTYPE html>
    <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <title>.: National Emission Factor || National Emission Factor:.</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/favIcon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content=" Food and Agriculture Organization of the United Nations"/>
        <meta name="author" content="ATI Limited"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      
        <!-- CSS Bootstrap & Custom -->
        <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- portal.css -->
        <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/portal.css" rel="stylesheet">
        <!-- end portal.css -->
        <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/megamenu/yamm.css" rel="stylesheet">
      <!--   <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/megamenu/demo.css" rel="stylesheet"> -->

        <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/css/font-awesome.min.css" rel="stylesheet" media="screen"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/css/animate.css" rel="stylesheet" media="screen"/>
   <!--      <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/style.css" rel="stylesheet" media="screen"/> -->

          <link href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/main.css" rel="stylesheet" media="screen"/>
        <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/plugins/select2/select2.min.css" rel="stylesheet" media="screen"/>

        <!-- JavaScripts -->
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url();?>resources/resource_potal/assets/Angular/js/angular/angular.min.js"></script>
        <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/select2/select2.full.min.js"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/main_data.css">
      </head>

        <style type="text/css">
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
            color: #555;
            cursor: default;
            border: 4px solid #a5a4a4;
            border-bottom-color: transparent;
            font-weight: normal !important;
            font-family: 'Lato',!sans-serif important;
            background-color: #396C15;
            color: white;
            font-size: 14px !important;
        }

      /*  body {
          font: 13px/23px Helvetica, Arial, sans-serif;
          -webkit-font-smoothing: antialiased;
          word-wrap: break-word;
        }*/
        </style>
         

     

 
    <body>
        <header class="header">
            <div class="lgo-area">
                <div class="container">
                    <div class="row header-bg">
                        <div class="col-sm-2">
                            <img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/gov-logo.png')?>" class="img-responsive"/>
                        </div>
                        <div class="col-sm-8">
                            <h1>National Emission Factor</h1>
                        </div>
                        <div class="col-sm-2 lg2">
                            <img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/forest-logo.png')?>" class="img-responsive"/></div>
                    </div>

                </div>
            </div>

        </header>
        <?php $this->load->view('portal/template/header'); ?>
        <main>
            <div class="container home-bg" style="background-attachment: fixed;background-repeat: center no-repeat;position: relative;">
            <?php echo $_content; ?>
                
            </div><br><br><br>


         <footer class="footer">
           <?php $this->load->view('portal/template/footer'); ?>
        </footer>
    </main>
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