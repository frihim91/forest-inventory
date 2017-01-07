<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top"><!-- <![endif]-->
<head>
   <title>.: FAO || Food and Agriculture Organization of the United Nations:. Login Panel</title>
   <?php $this->load->view('template/header'); ?>
</head>
<body class="">
    <!-- Main Container Fluid -->
    <div class="container-fluid fluid menu-left">
        <!-- Sidebar menu & content wrapper -->
                <!--<div id="menu" class="hidden-xs hidden-print">
                    <a href="<?php echo base_url(); ?>" class="appbrand">PMIS</a>
                    <?php //$this->load->view('template/sidebar'); ?> 
                </div>-->
                    <div id="wrapper">
                        <?php $this->load->view('template/sidebar'); ?>
                        <div id="page-wrapper">
                    <?php if (!empty($breadcrumbs)): ?>
                        <ul class="breadcrumb">
                            <li>You are here</li>
                            <?php
                            foreach ($breadcrumbs as $key => $value):
                                if ($value != '#'):
                                    ?>
                                <li><a href="<?php echo site_url("$value"); ?>"><?php echo $key; ?></a></li>
                                <li class="divider"></li>
                            <?php else: ?>
                                <li><?php echo $key; ?></li>
                                <?php
                                endif;
                                endforeach;
                                ?>
                            </ul>
                        <?php endif; ?>
                        <?php $this->load->view('template/breadCump'); ?>
                        <div class="row">

                            <div class="row" >
                                <?php echo $_content; ?>
                            </div>

                            <!-- /.col-lg-12 -->
                        </div>
                        </div>
                    </div>
             

        <div class="clearfix"></div>
        <div id="footer" class="hidden-print">
            <?php $this->load->view('template/footer'); ?>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>resources/assets/components/core/js/core.init.js"></script>
</body>
</html>
