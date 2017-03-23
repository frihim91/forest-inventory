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
        <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("raw_data"); ?>
    </div>
        <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("raw_data"); ?>
        
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 page_content">
 <h3>Allometric Equation Search</h3>


    <div class="col-sm-12">
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Keyword</a></li>
    <li><a data-toggle="tab" href="#menu1">Taxonomy</a></li>
    <li><a data-toggle="tab" href="#menu2">Location</a></li>
    <li><a data-toggle="tab" href="#menu3">Reference</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <p> Search allometric equations by keyword. 
                      This searches accross several text fields. 
                      <br>
                      Example searches: <a href="#">Acacia</a>,
                         <a href="#">Zambia</a>,
                         <a href="#">Bellefontaine</a>, 
                         <a href="#">Glutinosum</a>,
                         <a href="#">rainforest</a>
                  </p>
                    
                               <p>
                               </p>
          <form action="<?php echo site_url('portal/search_keyword');?>" method = "post">                
         <div class="col-md-6">
                <div class="form-group">
            <label>Keyword<span style="color:red;">*</span></label>
            <input type="text" class="form-control input-sm" name = "keyword" maxlength="64" placeholder="Keyword" />
           <!--   <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Keyword', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?>  -->
             </div>
          </div> 
           </form>
            
    </div>
    <div id="menu1" class="tab-pane fade">
      <p> Search allometric equations by family, genus or species.
  Example searches
                      <br>
                      Example searches: <a href="#">Genus</a>,
                         <a href="#">Gmelina</a>,
                         <a href="#"> Species</a>, 
                         <a href="#">schweinfurthii</a>,
                       
                  </p>
         <div class="col-md-6">
                <div class="form-group">
            <label>Genus<span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Genus', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>
             <div class="form-group">
            <label>Species<span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Species', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>
          </div> 
    </div>
    <div id="menu2" class="tab-pane fade">
      
      <p> Search allometric equations by tree location and biome.Example searches
                      <br>
                      Example searches: <a href="#">Biome (FAO):</a>,
                         <a href="#">Tropical dry forest</a>,
                         <a href="#">Country: Benin</a>, 
                         
                       
                  </p>

        <div class="col-md-6">
              <div class="form-group">
              <h3>Country</h3>
              <label>District<span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'District', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>
             <div class="form-group">
             <h3>Ecological Zone</h3>
            <label>FAO Global Ecological Zone <span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'FAO Global Ecological Zone', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>
        </div> 
    </div>
    <div id="menu3" class="tab-pane fade">
        <p> Search allometric equations by author, year, and reference.
  Example searches
                      <br>
                      Example searches: <a href="#"> Author: Henry M</a>,
                         <a href="#">Reference: Pieper</a>,
                         <a href="#"> Y. & Laumans,</a>, 
                         <a href="#"> Year: 2004</a>, 
                         
                       
                  </p>

                   <div class="col-md-6">
              <div class="form-group">
              
              <label>Reference <span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Reference ', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>
             <div class="form-group">
             <label>Author  <span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Author', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>

             <div class="form-group">
             <label>Year  <span style="color:red;">*</span></label>
             <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Year', 'id' => 'USERNAME', 'name' => 'USERNAME', 'value' => set_value('USERNAME'), 'required' => 'required')); ?> 
             </div>
        </div> 
    </div>


  </div>
  </div>
  <div id="search-submit-holder">
              <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
          </div>


  <div class="col-sm-12 bdy_des">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#results-list"><span class="glyphicon glyphicon-list"></span> Results List</a></li>
    <li><a data-toggle="tab" href="#results-map"><span class="glyphicon glyphicon-globe"></span> Map View</a></li>
    
  </ul>
  <div class="tab-content">
   <div id="results-list" class="tab-pane fade in active">
  <?php 
  foreach($rawDataView as $row)
  {
  ?>
  <div class="panel panel-default">
  <div class="panel-heading">Raw Data
  <a href="<?php echo site_url('Portal/rawDataDetails/'.$row->ID_Species); ?>" class="btn btn-default pull-right btn-xs">Detailed information<span class="glyphicon glyphicon-chevron-right"></span></a>
  </div>
  <div class="panel-body">
  <p style="padding-left:3px;"><b>Tree Height (H_m):</b><?php echo $row->HeightRange;?></p>
  <p style="padding-left:3px;"><b>Tree Diameter (DBH_cm):</b></p>
    <p style="padding-left:3px;"><b>Total Volume (Volume_m3):</b><?php echo $row->VolumeRange;?></p>
  <p style="padding-left:3px;"><b>Reference:</b><?php echo $row->Reference;?></p>
  <p style="padding-left:3px;"><b>Reference Year:</b><?php echo $row->Year;?></p>
  <p style="padding-left:3px;"><b>FAO Biomes:</b><?php echo $row->FAOBiomes;?></p>
  <p style="padding-left:3px;"><b>Species:</b> <?php echo $row->Family.' '.$row->Species;?></p>
  <p style="padding-left:3px;"><b>Locations:</b><?php echo $row->District;?> (lat <?php echo $row->LatDD;?>,lon <?php echo $row->LongDD;?>)</p>
               
    

  </div>
</div>
 <?php 
  }?>
  <p><?php echo $links; ?></p>

   
  </div>
       <div id="results-map" class="tab-pane fade">
           <p align="center"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.6260039988224!2d90.38117511445805!3d23.867410790214326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c43ca7f68407%3A0x3f083770ea2fa274!2sATI+Limited!5e0!3m2!1sen!2sbd!4v1490249056352" width="1054" height="601" frameborder="0" style="border:0" allowfullscreen></iframe></p>
          </div>
        </div>
     </div>
   </div>