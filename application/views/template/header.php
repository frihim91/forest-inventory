<!-- Meta -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="ATI Limited, PMIS, UGC, HEQEP, GOB, AIF, ANSI, Project Management Information System, University Grant Commission, Higher Education Quality Enhancement Project " content="yes">
<meta name="ATI Limited, PMIS, UGC, HEQEP, GOB, AIF, ANSI, Project Management Information System, University Grant Commission, Higher Education Quality Enhancement Project" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/favIcon.png">
<!-- 
**********************************************************
In development, use the LESS files and the less.js compiler
instead of the minified CSS loaded by default.
**********************************************************
-->

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/less/pages/serveStyles.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/redactor/redactor.css" />
<link href="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/css/dataTables.bootstrap.css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/css/dataTables.bootstrap.css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/css/dataTables.responsive.css" rel="stylesheet"/>

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/shared/components/modules/admin/metisMenu/metisMenu.min.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/shared/components/modules/admin/morrisjs/morris.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/shared/components/modules/admin/font-awesome/css/font-awesome.min.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/sb-admin-2.css" />



<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="<?php echo base_url(); ?>resources/js/html5shiv.js"></script>
  <script src="<?php echo base_url(); ?>resources/js/respond.min.js"></script>
<![endif]-->
<script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.min.js"></script>


<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/modernizr/modernizr.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/plugins/less-js/less.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/metisMenu/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/sb-admin-2.js"></script>

<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/lib/excanvas.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/tables/datatables/assets/custom/js/dataTables.responsive.js"></script>

<!-- <script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/morrisjs/morris.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/morrisjs/morris-data.js"></script> -->

<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/raphael/raphael.min.js"></script>

<script src="<?php echo base_url(); ?>resources/shared/components/plugins/browser/ie/ie.prototype.polyfill.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/library/jquery-ui/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- Global -->
<script>
    var basePath = '',
    commonPath = '../resources/assets/',
    rootPath = '../resources/',
    DEV = false,
    componentsPath = '../resources/assets/components/';

    var primaryColor = '#4a8bc2',
    dangerColor = '#b55151',
    infoColor = '#74a6d0',
    successColor = '#609450',
    warningColor = '#ab7a4b',
    inverseColor = '#45484d';

    var themerPrimaryColor = primaryColor;
</script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example2').DataTable({
            responsive: true
        });
    });
     $(document).ready(function() {
        $('#dataTables-example3').DataTable({
            responsive: true
        });
    });
    </script>



<script src="<?php echo base_url(); ?>resources/shared/components/library/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/plugins/slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/plugins/breakpoints/breakpoints.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/select2/assets/lib/js/select2.js"></script>

<script>
    $(document).ready(function () {
      
        $('.dropdown-option').select2();

        var warning = true;
        $('form input:text, form input:checkbox, form input:radio, form textarea, form select').on('change', function() {
            window.onbeforeunload = function() { 
                if (warning){
                     return 1;
                }
            }
        });

        $('form').submit(function() {
            window.onbeforeunload = null;
        });

    });
</script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js"></script>