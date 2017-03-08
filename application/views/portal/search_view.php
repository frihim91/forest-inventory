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
<?php
$lang_ses = $this->session->userdata("site_lang");
?>
<div class="col-sm-12 breadcump img-responsive">
	<div class="row">
		<div class="breadcump-wrapper">
			<div class="wrapper">
				<div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("search"); ?>
		</div>
				<div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("search"); ?>
				
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12 page_content">
	<div class="col-sm-12">
		
	</div>

	<div class="col-sm-12 bdy_des">

		<div class="col-sm-5">
			
		</div>
	
		<div class=""><h4>
		

		</h4>
	<table>
	 <?php foreach($results as $row){ ?>
	    <tr>
	        <td><a href="<?php echo site_url('Portal/details/'.$row->TITLE_ID.'/'.$row->PG_URI); ?>">
	        <?php echo $row->TITLE_NAME;?></a>
	        </td>
	        
	    </tr>
	<?php } ?>
	</table>
	</div>
		
	</div>


	</div>