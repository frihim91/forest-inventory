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
    <div class="col-md-12">
                <h2 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Allometric Equation</h2>
                
            </div>

  <div class="col-sm-12 bdy_des">
  <h3 style="font-family:Tahoma, Verdana, Segoe, sans-serif;">Allometric</h3>
  
  <div class="row">     
    <div class="col-md-12">
         <br>
        <h3>Allometry</h3>
        <?php 
        foreach($allometricEquationDetails as $row)
        {
        ?>
        <table class="table">
            <tr><th style="width:210px"> Equation: </th><td> <code><?php echo $row->Equation;?> </code> </td></tr>
            <tr><th> Sample size: </th><td> 9 </td></tr>
            <tr><th> R<sup>2</sup>: </th><td> 0.97 </td></tr>
              <tr><th style="width:210px"> Population: </th><td> Individual </td></tr>
        </table>
    </div>
</div>


 <?php 
  }?>

   
    
  </div>


  </div>