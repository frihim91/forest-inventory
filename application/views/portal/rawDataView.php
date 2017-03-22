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
  <div class="col-sm-12">
    
  </div>

  <div class="col-sm-12 bdy_des">
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
  <p style="padding-left:3px;"><b>Tree Diameter (DBH_cm:</b></p>
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
  


  </div>
