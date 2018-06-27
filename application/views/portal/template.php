<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
     <?php 
          $post_cat= $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=1")->row();
         ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>.: <?php echo $post_cat->TITLE_NAME;?> || <?php echo $post_cat->TITLE_NAME;?>:.</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/favIcon.png">
    <meta name="description" content=" Food and Agriculture Organization of the United Nations"/>
    <meta name="author" content="ATI Limited"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/css/custom.css">
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/resource_potal/assets/portal_home/js/jssor.slider-27.1.0.min.js" type="text/javascript"></script>

  >
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

    var MAX_WIDTH = 324;

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
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

           var jssor_slider1 = new $JssorSlider$("slider1_container", options);

//responsive code begin
//you can remove responsive code if you don't want the slider scales while window resizes
function ScaleSlider() {
    var bodyWidth = document.body.clientWidth;
    if (bodyWidth)
        jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
    else
        window.setTimeout(ScaleSlider, 30);
}
ScaleSlider();

$(window).bind("load", ScaleSlider);
$(window).bind("resize", ScaleSlider);
$(window).bind("orientationchange", ScaleSlider);
//responsive code end
also, you can scale the slider to width of parent element,

var jssor_slider1 = new $JssorSlider$("slider1_container", options);

//responsive code begin
//you can remove responsive code if you don't want the slider scales while window resizes
function ScaleSlider() {
    var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
    if (parentWidth)
        jssor_slider1.$ScaleWidth(Math.min(parentWidth, 1920));
    else
        window.setTimeout(ScaleSlider, 30);
}
ScaleSlider();

$(window).bind("load", ScaleSlider);
$(window).bind("resize", ScaleSlider);
$(window).bind("orientationchange", ScaleSlider);
        });
    </script>
<style>
 

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

    /*jssor slider bullet skin 051 css*/
    .jssorb051 .i {position:absolute;cursor:pointer;}
    .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;}
    .jssorb051 .i:hover .b {fill-opacity:.7;}
    .jssorb051 .iav .b {fill-opacity: 1;}
    .jssorb051 .i.idn {opacity:.3;}

    /*jssor slider arrow skin 051 css*/
    .jssora051 {display:block;position:absolute;cursor:pointer;}
    .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
    .jssora051:hover {opacity:.8;}
    .jssora051.jssora051dn {opacity:.5;}
    .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    .jssorb051{
        left: -580px!important;
    }

    


   /* #jssor_1{
        width:100% ;
    }
*/



#jssor_1{
    width:1150px !important;
}
#jssor_1>div{
    width:100% !important;
}
#jssor_1>div>div{
     width:100% !important;
 }
#jssor_1>div>div>div{
      width:100% !important;
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
                                 <h1 style="font-family:Century;font-weight:bold;font-size:36px;"><?php echo $post_cat->TITLE_NAME;?></h1>
                            </div>
                            <div class="col-sm-2 lg2">
                                <img src="<?php echo base_url('resources/resource_potal/assets/portal_home/img/forest-logo.png')?>" class="img-responsive"/></div>
                            </div>

                        </div>
                    </div>

                </header>
                <?php $this->load->view('portal/template/header'); ?>
                <main>
                    <div class="container home-bg">
                        <?php echo $_content; ?>
                        
                    </div>


                    <footer class="footer">
                     <?php $this->load->view('portal/template/footer'); ?>
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
