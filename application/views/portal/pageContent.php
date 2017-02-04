<style type="text/css">
	.page_content{
		padding: 15px;
		background-color: white;
		margin-top: 15px;
	}
	.page_des_big_image{
		width: 100%;
		height: 300px;
	}
	.bdy_des{
		margin-top: 25px;
	}
	.breadcump{
		background-image: url("<?php echo base_url("resources/images/breadcump_image.jpg")?>");
		height: 103px;
	}
	.breadcump-wrapper{
		background-color: #000000 !important;
		opacity: 0.7;
		width: 100%;
		height:100%;
	}
	.wrapper{
		padding:30px !important;
		color: #FFFFFF;
		font-weight: bold;
	}
</style>
<div class="col-sm-12 breadcump img-responsive">
	<div class="row">
		<div class="breadcump-wrapper">
			<div class="wrapper">
				<div style="font-size:25px;" class="breadcump_row">Forest Inventory</div>
				<div class="breadcump_row">Home > Forest Inventory</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12 page_content">
	<div class="col-sm-12">
		<!-- <?php if(!empty($body_images->IMG_URL)){?>
		<img class="page_des_big_image" src="<?php echo base_url("resources/images")."/".$body_images->IMG_URL;?>">
		<?php } ?> -->
	</div>
	<div class="col-sm-12 bdy_des">
		<div class="col-sm-6">
			<div class="main-slideshow">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/banner/banner-1.jpg"/>


						</li>
						<li>
							<img src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/banner/banner-2.jpg"/>


						</li>
						<li>
							<img src="<?php echo base_url(); ?>resources/resource_potal/assets/portal/images/banner/banner-3.jpg"/>


						</li>
					</ul>
					<!-- /.slides -->
				</div>
				<!-- /.flexslider -->
			</div>
		</div>
		<div class="col-sm-6"><h4>Description</h4>
			<?php echo $page_description->BODY_DESC;?></div>
		</div>


	</div>