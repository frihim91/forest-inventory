<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>
<div id="content">
    <?php $this->load->view('template/top_nav'); ?>
    <ul class="breadcrumb">
        <li>You are here</li>
        <li><a href="#" class="glyphicons dashboard"><i></i> <?php echo $this->uri->segment(1); ?></a></li>
        <li class="divider"></li>
        <li><?php echo $pageTitle; ?></li>
        <li class="pull-right hidden-phone"><a href="#" class="glyphicons shield">Get Help<i></i></a></li>
        <li class="pull-right hidden-phone divider"></li>
        <li class="pull-right hidden-phone"><a href="#" class="glyphicons adjust_alt">Filter<i></i></a></li>
    </ul>
    <div class="innerLR">
        <div class="innerB">
            <h4 class="heading-arrow strong">
                <?php echo $content_title; ?>
            </h4>
            <div class="clearfix"></div>                            
        </div>
        <?php echo $_content; ?>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>
