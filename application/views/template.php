<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top"><!-- <![endif]-->
<head>
   <title>.: Emission Factor ||Emission Factor:. Login Panel</title>
 
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
<div class="modal fade" id="showDetaildModal" data-backdrop="static">
  <div id="modalSize" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        <h3 class="modal-title" id="showDetaildModalTile"></h3>
      </div>
      <div class="modal-body" id="showDetaildModalBody"></div>
      <div class="modal-footer">
        <a data-dismiss="modal" class="btn btn-default" href="#">Close</a>
      </div>
    </div>
  </div>
</div>
<script>
   $(document).ready(function(){
   $(document).on("click", ".modalLink", function (e) {
    var modal_size = $(this).attr('data-modal-size');
    if ( modal_size!=='' && typeof modal_size !== typeof undefined && modal_size !== false ) {
      $("#modalSize").addClass(modal_size);
    }
    else{
      $("#modalSize").addClass('modal-lg');
    }
    var title = $(this).attr('title');
    $("#showDetaildModalTile").text(title);
    var data_title = $(this).attr('data-original-title');
    $("#showDetaildModalTile").text(data_title);
    $('div.ajaxLoader').show();
    $.ajax({
      type: "GET",
      url: $(this).attr('href'),
      success: function (data) {
        $("#showDetaildModalBody").html(data);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').hide();
      }

    });
  });
 });

</script>
</body>
</html>
