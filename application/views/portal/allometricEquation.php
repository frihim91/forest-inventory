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
        <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("allometric_equation"); ?>
    </div>
        <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("allometric_equation"); ?>
        
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
  foreach($allometricEquationData as $row)
  {
  ?>
  <div class="panel panel-default">
  <div class="panel-heading">Allometric Equation</div>
  <div class="panel-body">
  <p style="padding-left:3px;"><b>Equation: <?php echo $row->Equation;?> </b></p>
  <p style="padding-left:3px;"><b>Output:</b></p>
  <p style="padding-left:3px;"><b>Reference:<?php echo $row->Reference;?></b></p>
   <p style="padding-left:3px;"><b>Reference Year:<?php echo $row->Year;?></b></p>
  <p style="padding-left:3px;"><b>FAO Biomes:<?php echo $row->FAOBiomes;?></b></p>
  <p style="padding-left:3px;"><b>Species: <?php 
                                        $totalNumberC = sizeof($allometricEquationData) - 1 ;
                                        foreach($allometricEquationData as $key => $row){ ?>
                                        <?php echo $row->Species;?>  
                                        <?php 
                                          if($totalNumberC != $key)
                                            echo ", ";
                                         }
                                         ?></b></p>
  <p style="padding-left:3px;"><b>Locations:<?php echo $row->District;?></b></p>
               
    

  </div>
</div>
 <?php 
  }?>

   
    
  </div>


  </div>