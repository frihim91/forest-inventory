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
				<div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("library"); ?>
		</div>
				<div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("library"); ?>
        </div>
	
				</div>
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

	

		<div class=""><h4>Library</h4>

         <?php
            $pdf_values=".pdf";
            foreach($reference as $row)
            	
            {
              ?>
              <h4><?php echo $row->Title;?></h4>
              <p><a href="<?php echo base_url('resources/pdf/'.$row->PDF_label.$pdf_values);?>"><img src="<?php echo base_url('resources/images/pdf.gif')?>" alt="logo"/>Download <?php echo $row->Title;?></a></p>


                <?php
            }?>

		<h4>Scientific articles</h4>
		<p>Here you can find links to articles providing information about GlobAllomeTree and associated tools.</p>
		 <p><a href=""> <?php
            $i=1;
           foreach ($reference as  $row){
          if($i==1){
          echo "$row->Author";
           }else{
          echo ",$row->Author";
         }
         $i++;
          }
                
         ?>
         </a>
         iForest (early view) - doi: 10.3832/ifor0901-006
         <p>
		
		</div>
		
		</div>


	</div>