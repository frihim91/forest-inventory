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
	.breadcump_row a{
		color: white;
	}

</style>
<div class="col-sm-12 breadcump img-responsive">
	<div class="row">
		<div class="breadcump-wrapper">
			<div class="wrapper">
				<div style="font-size:25px;" class="breadcump_row"><?php echo $title_name->TITLE_NAME?></div>
				<div class="breadcump_row"><a href="<?php echo base_url() ?>">Home</a> > <?php echo $title_name->TITLE_NAME?></div>
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
		<div class="col-sm-5">
			<div class="main-slideshow">
				<div class="flexslider">
					<ul class="slides">
					<?php foreach($body_images as $body_image) {
						$image = "resources/images/".$body_image->IMG_URL;
						?>
						<li>
							<img src="<?php echo base_url($image); ?>">
							</li>
							<?php } ?>
					</ul>
					<!-- /.slides -->
				</div>
				<!-- /.flexslider -->
			</div>
		</div>
		<div class="col-sm-7"><h4>DESCRIPTION</h4>
			<?php echo $page_description->BODY_DESC;?></div>
		</div>


	</div>