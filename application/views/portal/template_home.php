<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>.: Allometry & Emission Factor Database || Allometry & Emission Factor Database:.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/custom.css">
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/jssor.slider-27.1.0.min.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
    jssor_2_slider_init = function() {

        var jssor_2_SlideshowTransitions = [
        {$Duration:1200,$Zoom:1,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2},
        {$Duration:1000,$Zoom:11,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
        {$Duration:1200,$Zoom:1,$Rotate:1,$During:{$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
        {$Duration:1000,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InQuint,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
        {$Duration:1200,x:0.5,$Cols:2,$Zoom:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
        {$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
        {$Duration:1200,x:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Opacity:2,$Round:{$Rotate:0.5}},
        {$Duration:1000,x:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
        {$Duration:1200,x:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Opacity:2,$Round:{$Rotate:0.5}},
        {$Duration:1000,x:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
        {$Duration:1200,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
        {$Duration:1000,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}},
        {$Duration:1200,x:-4,y:2,$Rows:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
        {$Duration:1200,x:1,y:2,$Cols:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:19},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.8}}
        ];

        var jssor_2_options = {
          $AutoPlay: 1,
          $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: jssor_2_SlideshowTransitions,
            $TransitionsOrder: 1
        },
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
        },
        $ThumbnailNavigatorOptions: {
            $Class: $JssorThumbnailNavigator$,
            $Rows: 2,
            $SpacingX: 14,
            $SpacingY: 12,
            $Orientation: 2,
            $Align: 156
        }
    };

    var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 960;

    function ScaleSlider() {
        var containerElement = jssor_2_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {

            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

            jssor_2_slider.$ScaleWidth(expectedWidth);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }

    ScaleSlider();

    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    /*#endregion responsive code end*/
};
</script>
<style>
/*jssor slider loading skin spin css*/
.jssorl-009-spin img {
    animation-name: jssorl-009-spin;
    animation-duration: 1.6s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes jssorl-009-spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/*jssor slider arrow skin 093 css*/
.jssora093 {display:block;position:absolute;cursor:pointer;}
.jssora093 .c {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
.jssora093 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
.jssora093:hover {opacity:.8;}
.jssora093.jssora093dn {opacity:.6;}
.jssora093.jssora093ds {opacity:.3;pointer-events:none;}

/*jssor slider thumbnail skin 101 css*/
.jssort101 .p {position: absolute;top:0;left:0;box-sizing:border-box;background:#000;}
.jssort101 .p .cv {position:relative;top:0;left:0;width:100%;height:100%;border:2px solid #000;box-sizing:border-box;z-index:1;}
.jssort101 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;visibility:hidden;}
.jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {border:none;border-color:transparent;}
.jssort101 .p:hover{padding:2px;}
.jssort101 .p:hover .cv {background-color:rgba(0,0,0,6);opacity:.35;}
.jssort101 .p:hover.pdn{padding:0;}
.jssort101 .p:hover.pdn .cv {border:2px solid #fff;background:none;opacity:.35;}
.jssort101 .pav .cv {border-color:#fff;opacity:.35;}
.jssort101 .pav .a, .jssort101 .p:hover .a {visibility:visible;}
.jssort101 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.6;}
.jssort101 .pav .t, .jssort101 .p:hover .t{opacity:1;}
</style>
<body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



        <header class="header">
            <div class="lgo-area">
                <div class="container">
                    <div class="row header-bg">
                        <div class="col-sm-2">
                            <img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/gov-logo.png')?>" class="img-responsive"/>
                        </div>
                        <div class="col-sm-8">
                            <h1>Allometry &amp; Emission Factor Database</h1>
                        </div>
                        <div class="col-sm-2 lg2">
                            <img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/forest-logo.png')?>" class="img-responsive"/></div>
                    </div>

                </div>
            </div>

        </header>
        <div class="main-menu">
            <nav class="navbar navbar-default fao-menu">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                    <?php 
                    $menus = $this->Menu_model->get_all_menu();

                    ?>
                          <ul class="nav navbar-nav">
             <li class="">
                        <a href="<?php echo site_url(); ?>" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("home"); ?>
                        </a>
                       
                    </li>
                     <?php
                     $session_info = $this->session->userdata("user_logged");
                          //echo '<pre>';print_r($session_info);exit;
                     ?>

                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("data"); ?><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('data/allometricEquationView'); ?>"><?php echo $this->lang->line("allometric_equations"); ?></a></li>
            <li><a href="<?php echo site_url('data/rawDataView'); ?>"><?php echo $this->lang->line("raw_data"); ?></a></li>
            <li> <a href="<?php echo site_url('data/woodDensitiesView'); ?>"><?php echo $this->lang->line("Wood_densities"); ?></a></li>
            <li><a href="<?php echo site_url('data/biomassExpansionFacView'); ?>"><?php echo $this->lang->line("biomass_expansion_factor"); ?></a></li>
            <li><a href="<?php echo site_url('data/dataSpecies'); ?>"><?php echo $this->lang->line("species_list"); ?></a></li>
       
                             
                        </ul>
                    </li>

                   <li class="">
                        <a href="<?php echo site_url('portal/viewLibraryPage'); ?>" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("library"); ?>
                        </a>
                       
                    </li>

                     <li class="">
                        <a href="<?php echo site_url('portal/viewCommunityPage'); ?>" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line("community"); ?>
                        </a>
                       
                    </li>
                <?php 

                foreach($menus as $pm) {
                     $lang_ses = $this->session->userdata("site_lang");

                    $link=$this->Menu_model->get_chile_menu($pm->TITLE_ID);
                    $count=count($link);
                    if($count>0)
                    {
                        $className="dropdown";
                    }
                    else 
                    {
                        $className='';
                    }

                    ?>
                    
                    <li class="<?php echo $className; ?>">
                        <a href="<?php echo site_url('portal/details/'.$pm->TITLE_ID.'/'.$pm->PG_URI); ?>" class="dropdown-toggle" data-toggle="<?php echo $className; ?>" role="button" aria-haspopup="true" aria-expanded="false"> 
                           <?php 
                           if(!empty($pm->TITLE_NAME_BN))
                                {
                                    if ($lang_ses == "bangla") 
                                    {
                                        echo $pm->TITLE_NAME_BN;
                                    } 
                                    else
                                    {
                                        echo $pm->TITLE_NAME;
                                    }
                                }
                                else 
                                {
                                    echo $pm->TITLE_NAME;
                                }
                           ?> 
                            <?php if($count>0)
                            {
                                echo '<span class="caret"></span>';
                            }
                            ?>

                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($link as $links){
                                ?>
                                <li ><a href="<?php echo site_url('portal/details/'.$links->TITLE_ID.'/'.$links->PG_URI); ?>"> <?php
                                $lang_ses = $this->session->userdata("site_lang");
                                
                                if(!empty($links->TITLE_NAME_BN))
                                {
                                    if ($lang_ses == "bangla") 
                                    {
                                        echo $links->TITLE_NAME_BN;
                                    } 
                                    else
                                    {
                                        echo $links->TITLE_NAME;
                                    }
                                }
                                else 
                                {
                                     echo $links->TITLE_NAME;
                                }

                                ?> 
                                </a></li>
                                  <!--<li role="presentation" class="divider"></li>-->
                                <?php 
                            } ?>


                        </ul>
                    </li>

                    <?php 
                }
                ?>




            </ul>
                        <ul class="nav navbar-nav navbar-right">
                         <?php
                           $session_info = $this->session->userdata("user_logged");
                          //echo '<pre>';print_r($session_info);exit;
                           ?>
                        <?php
                        
                           if(!$this->session->userdata('user_logged')){
                            ?>
                            <li> <a href="<?php echo site_url("accounts/userLogin"); ?>"  class="btn btn-link" ><?php echo $this->lang->line("login"); ?></a></li>
                             <li><a href="<?php echo site_url('accounts/userRegistration')?>"  class="btn btn-link" ><?php echo $this->lang->line("register"); ?></a></li>

                             <?php 
                            }else{ ?>
                             <li><a href="<?php echo site_url("visitorInfo/userProfileInfo"); ?>"     class="btn btn-link" style="color: green;font-size: 14px;font-weight: 900;font-style: italic;"><?php echo $session_info["FIRST_NAME"]." ".$session_info["LAST_NAME"];?> </a><li><li> <a href="<?php echo site_url("dashboard/auth/registerLogout"); ?>" class="btn btn-link" style="color: green;text-decoration: underline;font-size: 14px;font-weight: 900;font-style: italic;"><?php echo $this->lang->line("logout"); ?></a></li>
                                  <?php 
                            }
                            
                           ?>
                           
                            
                        </ul>
                    </div><!--/.nav-collapse -->

                </div>
            </nav>
        </div>
        <main>
            <div class="container home-bg">
                <div class="row">
                    <section class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class=" content">
                                        <h2><?php echo $post_cat->CAT_NAME;?></h2>
                                         <p style="text-align: justify;"><?php echo substr($post_description->BODY_DESC,0,710);?><a href="<?php echo site_url('Portal/post_details/'.$post_cat->TITLE_ID.'/'.$post_cat->PG_URI); ?>" class="btn btn-more pull-right"><?php echo $this->lang->line("view_details"); ?></a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="slider">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                                        <!-- Loading Screen -->
                                        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
                                        </div>
                                        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">

                                         <?php foreach($sliders as $slider){?>
                                            <div data-p="137.50">
                                                <img data-u="image" src="<?php echo base_url('resources/images/home_page_slider/'.$slider->IMAGE_PATH); ?>" />
                                            </div>
                                        <?php } ?> 
                                             
                                        </div>
                                        <!-- Bullet Navigator -->
                                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- Arrow Navigator -->
                                        <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                                            </svg>
                                        </div>
                                        <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="data-source">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="media">
                                        <h3><img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/icon-rec.png')?>" src="img/icon-rec.png">Media</h3>
                                        <div class="photo">
                                            <p>Photo</p>
                                            <div id="jssor_2" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                                                <!-- Loading Screen -->
                                                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/img/spin.svg" />
                                                </div>
                                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">

                                                 <?php foreach($gallery as $galleries){?>                                                    

                                                    <div data-p="150.00">
                                                        <img data-u="image" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" />
                                                        <img data-u="thumb" src="<?php echo base_url('resources/images/home_page_gallery/'.$galleries->IMAGE_PATH); ?>" />
                                                    </div>


                                                     <?php } ?> 
                                                    
                                                    
                                                    
                                                </div>
                                                <!-- Thumbnail Navigator -->
                                                <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;background-color:#000;" data-autocenter="2" data-scale-left="0.75">
                                                    <div data-u="slides">
                                                        <div data-u="prototype" class="p" style="width:99px;height:66px;">
                                                            <div data-u="thumbnailtemplate" class="t"></div>
                                                            <svg viewbox="0 0 16000 16000" class="cv">
                                                                <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                                                                <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                                                                <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Arrow Navigator -->
                                                <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2">
                                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                        <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                                        <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                                        <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                                    </svg>
                                                </div>
                                                <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2">
                                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                        <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                                        <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                                        <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                                    </svg>
                                                </div>
                                            </div>
                                            <script type="text/javascript">jssor_2_slider_init();</script>
                                            
                                        </div>
                                        <div class="video">
                                            <p>Video</p>
                                            <iframe width="350" height="318"
                                            src="https://www.youtube.com/embed/HHRNqtLLLeI">

                                        </iframe>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-8">
                                <div class="data-source">
                                    <h3><img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/icon-rec.png')?>" src="img/icon-rec.png">Data Sources</h3>
                                    <div class="dta dta0 dtaz">
                                        <h4><span>Allometric Equation</span></h4>
                                        <p>The database will provide the allometric equationsavailable for the tree species of Bangladesh for biomass and volume calculation. It is compiled from the Forest management plans of Bangladesh Forest Department, Reports prepared by Bangladesh Forest Research Institute and scientific articles of different academics.</p>
                                    </div>
                                    <div class="dta dta1 dtaz">
                                        <h4><span>Raw Data</span></h4>
                                        <p>Raw data is unprocessed primary data that are collected from field by Bangladesh Forest Department, Bangladesh Forest Research Institute and Universities and laboratory sources (e.g. tree diameter at breast height, total height, merchantable height, volume, biomass etc.). Raw data provide the basis of developing allometric equations, moreover this data can be reused by other researchers also.</p>
                                    </div>
                                    <div class="dta dta2 dtaz">
                                        <h4><span>Wood densities</span></h4>
                                        <p>The Wood density database will contain the necessary information related to wood density based on the laboratory analysis conducted by Bangladesh Forest Research Institute andUniversities. Collected wood density information of all available species are viewed in list. </p>
                                    </div>
                                    <div class="dta dta3 dtaz">
                                        <h4><span>Emission factors</span></h4>
                                        <p>The emission factor database provides Bangladesh-specific emission factors obtained from the review of literature to estimate greenhouse gas emissions accurately and removals for the forestry sector of Bangladesh based on Tier 2 approach. </p>
                                    </div>
                                    <div class="dta dta4 dtaz">
                                        <h4><span>Species List</span></h4>
                                        <p>The database is presenting a species list of Bangladesh. The list is organized by family and under each family all available genus and species information available in Bangladesh of that family is incorporated. Information related with number of allometric equations, raw data, wood density and emission factor for that species are available for the species. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



            </div>
        </div>


         <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="fot-menu">
                            <ul>
                                 <li><a href="<?php echo site_url('portal/index'); ?>">Home</a></li>
                                 <li><a href="<?php echo site_url('dashboard/auth/index')?>">Admin Login</a></li>
                                 <li><a href="<?php echo site_url('accounts/userRegistration')?>">Registration</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <p class="copy">&copy; Copyright <?php echo date('Y') ?>. Allometry & Emission Factor Database, Designed &amp; developed by <a target="_blank" href="http://atilimited.net"><span style="color:#B50D0D">ATI</span><span style="color:#0D4524"> Limited.</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </main> 
     <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/jssor.slider-27.0.3.min.js"></script>

    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
</body>
</html>
