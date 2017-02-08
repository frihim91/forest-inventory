  <style type="text/css">
  	.img{
  		margin-top: 10px !important;
  	}
  	.btn-danger{ margin-left: 20px;}
  	.button-submit{
  		margin-top: 15px;
  	}
  	.widget-body{
  		height: 140px !important;
  	}
  </style>
  <div class="widget">  
  	<div class="widget-head"> 
  		<a href="<?php echo site_url('Portal/viewSliderData')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >View Sliders Images</a>
  		<small style="margin-left: 10px;">Add New Image in Home Slider</small> 
  	</div> 
  	<div class="widget-body">  
  		<!-- <div class="col-md-12"><button class="pull-right btn btn-primary add-btn">Add More</button></div> -->
  		<?php

$attributes = array('class' => 'form-inline', 'id' => 'dgdpMainForm', 'method' => 'post', 'enctype' => 'multipart/form-data');
echo form_open('portal/addImageinSlider', $attributes);
?>
  		
  		<div style="clear: both;" class="col-md-12">
  			<div class="origin">
  				<div class="form-group">
  					<label for="email">Image Title:</label>
  					<input type="text" required="required" name="title" class="form-control" id="email" placeholder="Title">
  				</div>
  				<div class="form-group">
  					<label for="pwd">Image Description:</label>
  					<input type="text" name="descript" required="required" class="form-control" id="email" placeholder="Description">

  				</div>
  				<div class="form-group">
  					<label for="pwd">Image:</label>
  					<!-- <input type="file" class="form-control" required="required" name="asdasdsa" id="pwd" placeholder="Enter password"> -->
  					<input type="file" name="main_image" required="required" class="form-control">
  					</div>
  				</div>
  				<button type="submit" class="button-submit btn btn-primary">Submit</button>
  		<?php echo form_close();?>
  	</div>
  </div>

 <!--  <script type="text/javascript">
  	$(document).on("click", ".add-btn", function () {
  		$('.origin').append('<div class="col-md-12 img"><div class="form-group"><label for="email">Image Title:</label><input type="text" required="required" name="title[]" class="form-control" id="text" placeholder="Title"></div><div class="form-group"><label for="pwd">Image Description:</label><input type="text" name="descript[]" class="form-control" id="email" placeholder="Description" required="required"></div><div class="form-group"><label for="pwd">Image:</label><input type="file" name="sliderImg[]" class="form-control" id="pwd" placeholder="" required="required"></div><button class="btn btn-danger del-row"><i class="glyphicon glyphicon-trash"></i></button></div>');
  	})

  	$(document).on("click", "button.del-row", function(){
  		$(this).parent().remove();
  			//alert("oooo");
  	})
  </script> -->









  <!-- <div class="row pbFirst" id="pbFirst">
    <div class="form-group origin">
        <div class="col-md-2">
            <input type="text" name="COLOR_NO[]" class="form-control colorNo" placeholder="Enter Color Code" required="required">
        </div>
      
     
        <div class="col-md-3">
          <input type="text" name="COLOR_NO[]" class="form-control colorNo" placeholder="Enter Color Code" required="required">
        </div>
        <div class="col-md-1">
           <button type="button" class="btn btn-danger btn-md delete-btn"><i class="glyphicon glyphicon-remove"></i></button>
        </div>
        <div class="col-md-12 existMsg" style="display: none">
            <p style="color:red">Item Already Exist</p>
        </div>
    </div>
</div> -->