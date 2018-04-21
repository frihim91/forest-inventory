<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><b>National Emission Factor</b></a>

    </div>
    <?php
    $session_info = $this->session->userdata("user_logged_in");
    //echo '<pre>';print_r($session_info);exit;
    ?>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">

        <!-- /.dropdown -->

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $session_info["FULL_NAME"]; ?></a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url("dashboard/auth/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
 <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
         
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </li>

                <?php
                $session_info = $this->session->userdata("user_logged_in");
    //echo '<pre>';print_r($session_info);exit;
                ?>
                 <li>
                    <a href="<?php echo site_url("dashboard/auth/index"); ?>"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                </li>
                   <?php
                    $dtls = $this->security_model->getOrgModules();
                    foreach ($dtls as $dtl) {
                        $links = array();
                        $modid = $dtl->SA_MODULE_ID;
                        $session_info = $this->session->userdata('user_logged_in');
                        if ($session_info["USERGRP_ID"] != "") {
                            $links = $this->security_model->get_all_module_links($modid);
                        } else {
                            //$links_user = $this->careProvider_model->get_all_module_links_from_user($modid);
                        }
                        if (!empty($links)) {
                            $lang_ses = $this->session->userdata("site_lang");
                            ?>
                <li>
              
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $dtl->SA_MODULE_NAME; ?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php foreach ($links as $link) : ?>
                                <li><?php echo anchor($link->URL_URI, $link->LINK_NAME); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php
                    }
                }
                ?>
                <!-- /.nav-second-level -->
            </li>
<!-- 
             <li>
               <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Settings<span class="fa arrow"></span></a>
               <ul class="nav nav-second-level">
               <li><a href="<?php echo site_url('Portal/viewSliderData'); ?>"> Sliders</a> </li>

            </ul>
        </li>  -->
 </ul>
</div>
<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>