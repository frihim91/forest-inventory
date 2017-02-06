  <div class="widget">  
  	<div class="widget-head"> 
  		<a href="<?php echo site_url('portal/addImageinSlider')?>" class="btn btn-sm btn-danger pull-right col-md-2 Modal" >View Sliders Images</a>
  		<small style="margin-left: 10px;">Add New Image in Home Slider</small> 
  	</div> 
  	<div class="widget-body">  
  	<div class="col-md-12"><button class="pull-right btn btn-primary add-btn">Add More</button></div><form class="form-inline">  
  	<div class="col-md-12">
  	<div class="origin">
  			<div class="form-group">
  				<label for="email">Image Title:</label>
  				<input type="email" class="form-control" id="email" placeholder="Title">
  			</div>
  			<div class="form-group">
  				<label for="pwd">Image Description:</label>
  				<input type="email" class="form-control" id="email" placeholder="Description">

  			</div>
  			<div class="form-group">
  				<label for="pwd">Image:</label>
  				<input type="file" class="form-control" id="pwd" placeholder="Enter password">
  			</div>
  			<button type="submit" class="btn btn-default">Submit</button>
  			</div>
  		</form>
  		
  	</div>
  </div>

  <script type="text/javascript">
  	$(document).on("click", ".add-btn", function () {
  	$('.origin').append('<div class="form-group"><label for="email">Image Title:</label><input type="email" class="form-control" id="email" placeholder="Title"></div><div class="form-group"><label for="pwd">Image Description:</label><input type="email" class="form-control" id="email" placeholder="Description"></div><div class="form-group"><label for="pwd">Image:</label><input type="file" class="form-control" id="pwd" placeholder="Enter password"></div><button type="submit" class="btn btn-default">Submit</button>');
})
  </script>









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