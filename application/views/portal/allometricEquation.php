

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
      <div style="float:right;">
         <form action='export/' id="export-form" method="POST">
         <input type='hidden' name='csrfmiddlewaretoken' value='EUSnAj1qQRRf6anXMDF1cWRSTLAwax2J' />
         <input type="hidden" name="query" id="export-query" />
         <input type="hidden" name="extension" id="export-extension" />
         <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
            <span class="glyphicon glyphicon-download"></span> Export Results <span class="caret"></span>
            </button>
            <?php 
               foreach($allometricEquationDatagrid as $row)
                {
                ?>
            <ul class="dropdown-menu" role="menu">
               <!--<li><a href="#" id="export-txt">Download TXT (Tab Delimited UTF-16)</a></li>-->
               <li><a href="<?php echo site_url('Portal/allometricEquationDataJson/'.$row->ID_Species); ?>" id="export-json">Download JSON</a></li>
               <!--<li><a href="#" id="export-xml">Download XML</a></li>-->
            </ul>
            <?php 
               }?>
         </div>
         <form>
      </div>
   </div>
   <div class="col-sm-12 bdy_des">
      <?php 
         foreach($allometricEquationDatagrid as $row)
         {
         ?>
      <div class="panel panel-default">
         <div class="panel-heading">Allometric Equation
            <a href="<?php echo site_url('Portal/allometricEquationDetails/'.$row->ID_Species); ?>" class="btn btn-default pull-right btn-xs">Detailed information<span class="glyphicon glyphicon-chevron-right"></span></a>
         </div>
         <div class="panel-body">
            <p style="padding-left:3px;"><b>Equation:<code style="color:#c7254e;font-size: 14px;"><?php echo $row->Equation;?></code></b></p>
            <p style="padding-left:3px;"><b>Output:</b></p>
            <p style="padding-left:3px;"><b>Reference:</b><?php echo $row->Reference;?></p>
            <p style="padding-left:3px;"><b>Reference Year:</b><?php echo $row->Year;?></p>
            <p style="padding-left:3px;"><b>FAO Biomes:</b><?php echo $row->FAOBiomes;?></p>
             <p style="padding-left:3px;"><b>Species:</b> <?php echo $row->Family.' '.$row->Species;?></p>
            <p style="padding-left:3px;"><b>Locations:</b><?php echo $row->District;?> (lat <?php echo $row->Latitude;?>,lon <?php echo $row->Longitude;?>)</p>
         </div>
      </div>
      <?php 
         }?>
           <p><?php echo $links; ?></p>
   </div>
</div>

