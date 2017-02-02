<link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/plugins/select2/select2.min.css" rel="stylesheet"/>
<style type="text/css">
    .sub-header {
        color: #FF4F57;
        font-size: 16px;
    }
    .navbar-default .navbar-nav > li > a {
        color: #000;
    }
    .dropdown-menu li, .dropdown-menu a {
        font-size: 12px;
    }
    .dropdown-menu li {
        color: #333 !important;
        padding: 0px 5px 0px 8px;
    }
    .dropdown-menu a {
        color: #443266 !important;
    }
    .dropdown-menu li ul li:hover {
        background-color: #428BCA;
    }


</style>
<div class="navbar navbar-default yamm">
    <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle">
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <?php $menus = $this->Menu_model->get_all_menu();

        ?>
        <div id="navbar-collapse-grid" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php foreach($menus as $pm) {
                    $link=$this->Menu_model->get_chile_menu($pm->TITLE_ID);
                    $count=count($link);

                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $pm->TITLE_NAME; ?>
                            <?php if($count>0)
                            {
                                echo '<span class="caret"></span>';
                            }
                            ?>

                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($link as $links){
                                ?>
                                <li ><a href="" ><?php echo $links->TITLE_NAME; ?></a></li>
                                 <li role="presentation" class="divider"></li>
                                <?php 
                            } ?>


                        </ul>
                    </li>

                    <?php 
                }
                ?>
            </ul>



        </div>
    </div>

    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>