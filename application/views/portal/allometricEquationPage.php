<?php 
  // echo "<pre>";
  // print_r($allometricEquationView);
  // exit;
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/datatable/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatable/jqueryDataTable.min.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatable/dataTableBootstrap.min.js">
</script>
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
#search-submit-holder, #tree-equation-footer {
  height: 45px;
  padding: 5px;
  background-color: #f4f4f4;
  border-top: 1px solid #d9d9d9;
  border-radius: 0px 0px 4px 4px;
}
#easyPaginate {width:800px;}
#easyPaginate img {display:block;margin-bottom:10px;}
.easyPaginateNav a {padding:5px;}
.easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/pagination/jquery.snippet.min.css" rel="stylesheet" media="screen"/>
<!-- <link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/pagination/styles.css" rel="stylesheet" media="screen"/> -->





<script type="text/javascript">
$('.selectpicker').selectpicker({
  // style: 'btn-info',
  size: 4
});

</script>

<?php
$lang_ses = $this->session->userdata("site_lang");

?>
<div class="col-sm-12 breadcump img-responsive">
  <div class="row">
    <div class="breadcump-wrapper">
      <div class="wrapper">
        <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("allometric_equations"); ?>
        </div>
        <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("allometric_equations"); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 page_content">
  <h3>Allometric Equation Search</h3>

  <div class="col-sm-12">
    <ul class="nav nav-tabs">
      <li class="<?php if(!isset($searchType)){ echo 'active'; } ?>"  > <a data-toggle="tab" href="#home">Keyword</a></li>
      <li class="
      <?php if(isset($searchType)){
        if($searchType==2)
        {
          echo 'active';
        }
        else {
          echo '';
        }
      }  ?>
      "> <a data-toggle="tab" href="#menu1">Taxonomy</a>
    </li>
    <li
    class="
    <?php if(isset($searchType)){
      if($searchType==3)
      {
        echo 'active';
      }
      else {
        echo '';
      }
    }  ?>
    "
    ><a data-toggle="tab" href="#menu2">Location</a></li>
    <li class="
    <?php if(isset($searchType)){
      if($searchType==4)
      {
        echo 'active';
      }
      else {
        echo '';
      }
    }  ?>
    "
    ><a data-toggle="tab" href="#menu3">Reference</a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade
    <?php if(!isset($searchType)){ echo 'in active'; } ?>
    ">
    <p> Search allometric equations by keyword.
      This searches accross several text fields.
      <br>
      Example searches:Acanthaceae, Myrsinaceae,Aegiceras,Aegiceras corniculatum,Tropical moist forest
    </p>
    <p>
    </p>
    <!-- <form action="<?php echo site_url('data/search_allometricequation_key');?>" method = "post"> -->
    <form action="<?php echo site_url('portal/searchAllometricEquationAll');?>" method = "get">
      <div class="col-md-6">
      <!--   <div class="form-group">
          <label>Allometric Equation No<span style="color:red;"></span></label>
          <input type="text" class="form-control input-sm f" name ="ID_AE" value = "<?php echo (isset($ID_AE))?$ID_AE:'';?>"  class ="ID_AE" maxlength="64" placeholder="Allometric Equation" />
        </div> -->

        <div class="form-group">
          <label>Allometric Equation <span style="color:red;"></span></label>
          <input type="text" class="form-control input-sm" name ="Equation" value = "<?php echo (isset($Equation))?$Equation:'';?>" class ="Equation" maxlength="200" placeholder="Allometric Equation " />
        </div>
        <div class="form-group">
          <label>Keyword<span style="color:red;">*</span></label>
          <input type="text" class="form-control input-sm" name = "keyword" value = "<?php echo (isset($keyword))?$keyword:'';?>"  maxlength="64" placeholder="Keyword" /><br>
          <!-- <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> -->
        </div>
      </div>

    </div>
    <div id="menu1" class="tab-pane fade">

      <p> Search allometric equations by family, genus or species.
        Example searches
        <br>
        Example searches:Genus,Myrsinaceae,Aegiceras,Aegiceras corniculatum
      </p>

      <div class="col-md-6">

        <div class="form-group">
          <label>Family<span style="color:red;"></span></label>
          <p><?php
          $Family = $this->Forestdata_model->get_all_family();
          $options = array('' => '--Select Family--');
          foreach ($Family as $Family) {
            $options["$Family->Family"] = $Family->Family;
          }
          $Family = set_value('Family');
          echo form_dropdown('Family', $options, $Family, 'id="Family" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Select Family" ');
          ?></p>


          <!--  <input type="text" class="form-control input-sm f" name ="Family" value = "<?php echo (isset($Family))?$Family:'';?>"  class ="Family" maxlength="64" placeholder="Family" /> -->
        </div>
        <div class="form-group">
          <label>Genus<span style="color:red;"></span></label>
          <!-- <input type="text" class="form-control input-sm g" name ="Genus" value = "<?php echo (isset($Genus))?$Genus:'';?>"  class ="Genus" maxlength="64" placeholder="Genus" /> -->
          <p><?php
          $Genus = $this->Forestdata_model->get_all_genus();
          $options = array('' => '--Select Genus--');
          foreach ($Genus as $Genus) {
            $options["$Genus->Genus"] = $Genus->Genus;
          }
          $Genus = set_value('Genus');
          echo form_dropdown('Genus', $options, $Genus, 'id="Genus" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Select Genus" ');
          ?></p>
        </div>
        <div class="form-group">
          <label>Species<span style="color:red;"></span></label>
          <!--  <input type="text" class="form-control input-sm s" name ="Species" value = "<?php echo (isset($Species))?$Species:'';?>" maxlength="64"  class ="Species" placeholder="Species" /> -->
          <p><?php
          $Species = $this->Forestdata_model->get_all_species();
          $options = array('' => '--Select Species--');
          foreach ($Species as $Species) {
            $options["$Species->Species"] = $Species->Species;
          }
          $Species = set_value('Species');
          echo form_dropdown('Species', $options, $Species, 'id="Species" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Select Species" ');
          ?></p>
          <br>
          <!--     <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> -->
        </div>
      </div>

    </div>
    <div id="menu2" class="tab-pane fade">
      <p> Search allometric equations by tree location and biome.Example searches
        <br>
        Example searches:Biome (FAO):,Tropical moist forest,Country: Bangladesh
      </p>
     <div class="col-md-12">
      <div class="col-md-6">
        <div class="form-group">
          <label>Division<span style="color:red;"></span></label>
          <!--   <input type="text" class="form-control input-sm" name ="Division"  id="division" value = "<?php echo (isset($Division))?$Division:'';?>" class ="division" maxlength="64" placeholder="Division" /> -->
          <p><?php
          $ID_Divisions = $this->Forestdata_model->get_all_division();
          $options = array('' => '--Select Division--');
          foreach ($ID_Divisions as $ID_Division) {
            $options["$ID_Division->Division"] = $ID_Division->Division;
          }
          $ID_Division = set_value('Division');
          echo form_dropdown('Division', $options, $ID_Division, 'id="ID_Division" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Choose a Division..." ');
          ?></p>
        </div>
        </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>District<span style="color:red;"></span></label>

          <p><select class="form-control singleSelectExample" id="ID_District" style="width:560px;"  name="District">
            <option value="">Select District</option></p>
          </select>
        </div>
        </div>
        </div>
<div class="col-md-12">
   <div class="col-md-6">
        <div class="form-group">

          <label>Bangladesh Agroecological Zone  <span style="color:red;"></span></label><br>

          <!--     <input type="text" class="form-control" name ="EcoZones" id="ecoZones" value = "<?php echo (isset($EcoZones))?$EcoZones:'';?>" maxlength="64" class ="ecoZones" placeholder="FAO Global Ecological Zone" /> -->

          <p><?php
          $AEZ_NAMES = $this->Forestdata_model->get_all_agroecological_zones();
          $options = array('' => '--Select Agroecological Zone--');
          foreach ($AEZ_NAMES as $AEZ_NAME) {
            $options["$AEZ_NAME->AEZ_NAME"] = $AEZ_NAME->AEZ_NAME;
          }
          $AEZ_NAME = set_value('AEZ_NAME');
          echo form_dropdown('AEZ_NAME', $options, $AEZ_NAME, 'id="AEZ_NAME" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Choose a  Agroecological Zone..." ');
          ?></p>
          </div>
          </div>
         <div class="col-md-6">
          <label>FAO Biomes   <span style="color:red;"></span></label><br>

          <!--     <input type="text" class="form-control" name ="EcoZones" id="ecoZones" value = "<?php echo (isset($EcoZones))?$EcoZones:'';?>" maxlength="64" class ="ecoZones" placeholder="FAO Global Ecological Zone" /> -->

          <p><?php
          $FAOBiomess = $this->Forestdata_model->get_all_faobiomes();
          $options = array('' => '--Select FAO Biomes --');
          foreach ($FAOBiomess as $FAOBiomes) {
            $options["$FAOBiomes->FAOBiomes"] = $FAOBiomes->FAOBiomes;
          }
          $FAOBiomes = set_value('FAOBiomes');
          echo form_dropdown('FAOBiomes', $options, $FAOBiomes, 'id="FAOBiomes" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Choose a  FAO Biomes..." ');
          ?></p>
          </div>
    </div>

    <div class="col-md-12">
       <div class="col-md-6">
          <label>BFI Zone <span style="color:red;"></span></label><br>

          <!--     <input type="text" class="form-control" name ="EcoZones" id="ecoZones" value = "<?php echo (isset($EcoZones))?$EcoZones:'';?>" maxlength="64" class ="ecoZones" placeholder="FAO Global Ecological Zone" /> -->

          <p><?php
          $Zoness = $this->Forestdata_model->get_all_zones();
          $options = array('' => '--Select BFI Zone--');
          foreach ($Zoness as $Zones) {
            $options["$Zones->Zones"] = $Zones->Zones;
          }
          $Zones = set_value('Zones');
          echo form_dropdown('Zones', $options, $Zones, 'id="Zones" style="width:560px;" class="form-control singleSelectExample" data-placeholder="Choose a  BFI Zone..." ');
          ?></p>
          <br><br>
          <!--  <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> -->
        </div>
      </div>
    </div>

    <div id="menu3" class="tab-pane fade">
      <p> Search allometric equations by author, year, and reference.
        Example searches
        <br>
        Example searches:Author: Mahmood, H,Reference:Tree volume tables for Baen,Latif, M.A,Year: 2004
      </p>
      <!--  <form action="<?php echo site_url('portal/search_allometricequation_ref');?>" method = "post"> -->
      <div class="col-md-6">
        <div class="form-group">
          <label>Reference <span style="color:red;"></span></label>
          <input type="text" class="form-control input-sm" name ="Reference" value = "<?php echo (isset($Reference))?$Reference:'';?>" class ="reference" maxlength="200" placeholder="Reference" />
        </div>
        <div class="form-group">
          <label>Author  <span style="color:red;"></span></label>
          <input type="text" class="form-control input-sm" name ="Author" value = "<?php echo (isset($Author))?$Author:'';?>" class ="author" maxlength="64" placeholder="Author" />
        </div>
        <div class="form-group">
          <label>Year  <span style="color:red;"></span></label>
          <input type="text" class="form-control input-sm" name ="Year" value = "<?php echo (isset($Year))?$Year:'';?>" maxlength="64"  class ="year" placeholder="Year" />
          <br>
          <!-- <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> -->
        </div>
      </div>
      <!-- <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search"> -->


    </div>
  </div>
</div>
<div class="col-lg-6">
  <input id="searchButton" style="float:right" class="btn btn-success" type="submit" value="Search">
</div>
</form>

<div class="col-sm-12 bdy_des">
  <div class="row" style="background-color:#eee;border:1px solid #ddd;border-radius:4px;margin:0px 1px 20px 1px;">

    <div class="col-lg-6">

      <h4>Result count: <span id="summary-results-total">

   

                       <?php
                           if(isset($allometricEquationView_count))
                           {
                         
                            echo count($allometricEquationView_count); 
                            }
                            else if(isset($allometricEquationDatagrid))
                            {
                              echo count($allometricEquationDatagrid);
                            }
                            else 
                            { 
                             echo $this->db->count_all_results('ae');


                    
                            }
                            
                           ?>

      </span> </h4>
      <br><br>

    </div>

    <div class="col-lg-6">

      <h4> Search criteria</h4>
      <p>  <?php
      // echo "<pre>";
      // print_r($fieldNameValue);
      if(!empty($fieldNameValue)){
        $n=count($fieldNameValue);
        $i=0;
        foreach($fieldNameValue as $key=>$value)
        {
          $pieces = explode("/", $key);
          $fieldName= $pieces[0]; // piece1
          $keyWord= $pieces[1]; // piece2
          if($i<$n-1)
          {
            $substitute="$keyWord=$value&";
          }
          else {
            $substitute="$keyWord=$value";
          }
          $sub=str_replace(' ','+',$substitute);
          //echo $actualUrl;
          $newUrl=str_replace($sub,'',$actualUrl);
          // $url=str_replace('','',$actualUrl);
          $i++;
          echo "<b> $fieldName </b> : $value "."<a href='$newUrl'>Remove Filter</a> <br>";
        }

      }
      else{
        echo "No criteria - All results are shown";
      }
      ?></p>

    </div>

  </div>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" class="resultList" href="#results-list"><span class="glyphicon glyphicon-list"></span> Results List</a></li>
    <li><a data-toggle="tab" class="results-map" href="#results-map"><span class="glyphicon glyphicon-globe"></span> Map View</a></li>
    <div style="float:right;">
      <form action='export/' id="export-form" method="POST">
        <input type='hidden' name='csrfmiddlewaretoken' value='EUSnAj1qQRRf6anXMDF1cWRSTLAwax2J' />
        <input type="hidden" name="query" id="export-query" />
        <input type="hidden" name="extension" id="export-extension" />
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
            <span class="glyphicon glyphicon-download"></span> Export Results <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
          <?php 
            if(!isset($string))
            {
              $string=1;
            }
          ?>
            <!--  <li><a href="#" id="export-txt">Download TXT (Tab Delimited UTF-16)</a></li> -->
            <li><a href="<?php echo site_url('Portal/allometricEquationViewcsv/'.$string); ?>">Download CSV</a></li>
            <li><a href="<?php echo site_url('Portal/allometricEquationViewjson/'.$string); ?>" id="export-json">Download JSON</a></li>
            <!-- <li><a href="#" id="export-xml">Download XML</a></li> -->
          </ul>
        </div>
        <form>
        </div>
      </ul>
      <div class="tab-content">

        <div id="results-list" class="tab-pane fade in active ">
          <div id="paginationClass">

            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td><center>List Of Allometric Equations</center></td>
                </tr>
              </thead>
              <?php
              foreach($allometricEquationView as $row)
              {
                ?>
                <tr>
                  <td>
                    <div class="panel panel-default">

                      <div class="panel-heading">Allometric Equation <?php echo $row->ID_AE; ?>
                        <a href="<?php echo site_url('Portal/allometricEquationDetails/'.$row->ID_AE); ?>" class="btn btn-default pull-right btn-xs">Detailed information<span class="glyphicon glyphicon-chevron-right"></span></a>
                      </div>
                      <div class="panel-body">
                        <dl class="dl-horizontal">
                          <dt style="font-size:15px;"><small>Equation</small></dt> <dd style="font-size:15px;"><code><?php echo $row->Equation;?></code></dd>
                          <dt style="font-size:15px;"><small>Output</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Output;?></small></dd>
                          <dt style="font-size:15px;"><small>Reference</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Author;?>.<?php echo $row->Reference;?></small></dd>
                          <dt style="font-size:15px;"><small>Reference Year</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Year;?></small></dd>
                          <dt style="font-size:15px;"><small>Biomass</small></dt> <dd style="font-size:15px;"><small><?php echo $row->FAOBiomes;?></small></dd>
                          <dt style="font-size:15px;"><small>Family</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Family;?></small></dd>
                          <dt style="font-size:15px;"><small>Species</small></dt> <dd style="font-size:15px;"><small><?php echo $row->Species;?></small></dd>
                          <dt style="font-size:15px;"><small>Locations</small></dt> <dd style="font-size:15px;"><small><?php echo $row->District;?> (lat <?php echo $row->Latitude;?>,lon <?php echo $row->Longitude;?>)</small></dd>
                          <!--  <p style="padding-left:3px;"><b>Equation: <code style="color:#c7254e;font-size: 14px;"><?php echo $row->Equation;?></code></b></p>
                          <p style="padding-left:3px;"><b>Output: </b><?php echo $row->Output;?></p>
                          <p style="padding-left:3px;"><b>Reference: </b><?php echo $row->Reference;?></p>
                          <p style="padding-left:3px;"><b>Reference Year: </b><?php echo $row->Year;?></p>
                          <p style="padding-left:3px;"><b>Biomass: </b><?php echo $row->FAOBiomes;?></p>
                          <p style="padding-left:3px;"><b>Family: </b><?php echo $row->Family;?></p>
                          <p style="padding-left:3px;"><b>Species: </b> <?php echo $row->Species;?></p>
                          <p style="padding-left:3px;"><b>Locations: </b><?php echo $row->District;?> (lat <?php echo $row->Latitude;?>,lon <?php echo $row->Longitude;?>)</p> -->
                          <dl>
                          </div>

                        </div>
                      </td>
                    </tr>

                    <?php
                  }?>
                </table>
                <script>
                $(document).ready(function() {
                  $('#example').dataTable( {
                    "searching": false,
                    "bLengthChange": false,
                    "pageLength": 20,
                    "bSort" : false
                    

                  } );
                } );
                </script>

              </div>
            </div>

            <div id="results-map" class="tab-pane fade">
              <link rel="stylesheet" href="<?php echo base_url(); ?>resources/js/leaflet/leaflet.css" />
              <script src="<?php echo base_url(); ?>resources/js/leaflet/leaflet.js"></script>
              <style type="text/css">
              #map{ height: 100% }
              </style>
            </div>
          </div>
        </div>
      </div>

      <div class="row mapBlock" style="display:none">
        <div class="col-md-12" style="height:500px!important;width:100%">
          <div id="map"></div>
          <script>
          // initialize the map


          </script>
        </div>
      </div>
      <script type="text/javascript">
      $(document).on('keypress', '#Genus', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_genus'); ?>",
          select: function (event, ui) {
            $("#Genus" + id).val(ui.item.id);
          }
        });
      });

      $(document).on('keypress', '#Family', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_family'); ?>",
          select: function (event, ui) {
            $("#Genus" + id).val(ui.item.id);
          }
        });
      });
      $(document).on('keypress', '#Species', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_species'); ?>",
          select: function (event, ui) {
            $("#Species" + id).val(ui.item.id);
          }
        });
      });

      $(document).on('keypress', '#District', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_district'); ?>",
          select: function (event, ui) {
            $("#District" + id).val(ui.item.id);
          }
        });
      });

      $(document).on('click', '.btn_remove_class', function () {
        var id = $(this).attr('id');
        alert(id);
        $('.'+id).remove();
        $(this).remove();
      });


      $(document).on('keypress', '#division', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_division'); ?>",
          select: function (event, ui) {
            $("#division" + id).val(ui.item.id);
          }
        });
      });


      $(document).on('keypress', '#ecoZones', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_ecological_zones'); ?>",
          select: function (event, ui) {
            $("#ecoZones" + id).val(ui.item.id);
          }
        });
      });

      $(document).on('keypress', '#reference', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_reference'); ?>",
          select: function (event, ui) {
            $("#reference" + id).val(ui.item.id);
          }
        });
      });


      $(document).on('keypress', '#author', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_author'); ?>",
          select: function (event, ui) {
            $("#author" + id).val(ui.item.id);
          }
        });
      });


      $(document).on('keypress', '#year', function () {

        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $(this).autocomplete({
          source: "<?php echo site_url('Portal/get_year'); ?>",
          select: function (event, ui) {
            $("#year" + id).val(ui.item.id);
          }
        });
      });



      </script>
      <script type="text/javascript">
      $('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');})
        </script>
        <script type="text/javascript">
        $(document).ready(function(){
          $("a.results-map").click(function(){
            $("div.mapBlock").show();
            var map = new L.Map('map', {center: new L.LatLng(23.8101, 90.4312), zoom: 7});
            var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
            map.addLayer(osm);


            $.getJSON("<?php echo base_url(); ?>resources/mapdata.php",function(data){
              var ratIcon = L.icon({
                iconUrl: '<?php echo base_url(); ?>resources/final.png',
                iconSize: [19,30]
              });
              L.geoJson(data,{
                pointToLayer: function(feature,latlng){
                  var marker = L.marker(latlng,{icon: ratIcon});
                  marker.bindPopup('<h4><b>Allometric Equations : </b>'+feature.properties.total_species+'</h4><h5>Species Represented</h5>'+feature.properties.species_desc+'<h5>FAO Biomes </h5>'+feature.properties.FAOBiomes+'<h5>Output </h5>'+feature.properties.output);
                  return marker;
                }
              }).addTo(map);
            });

          });
        });
        $("a.resultList").click(function(){
          $("div.mapBlock").hide();
        });




        </script>


        <script type="text/javascript">
        $(document).on("click", "input.searchButton", function () {
          var sp=$('input.s').val();
          var ge=$('input.g').val();
          var fa=$('input.f').val();

          if(sp!='')
          {
            var Url='{{url("/view_Demand_Filter/")}}'+'/'+sp;
          }
          if(ge!='')
          {
            var Url='{{url("$roleName/view_Demand_Filter/")}}'+'/'+ge;
          }
          if(fa!='')
          {
            var Url='{{url("$roleName/view_Demand_Filter/")}}'+'/'+fa;
          }
          // $.ajax({
          //     type: "GET",
          //     url: destination,
          //     success: function (data) {
          //          $("div.dmndTbl").html(data);
          //     }
          //  });
          alert(Url);
        });
        <<<<<<< HEAD

        </script>
        <script>
        // Setting default configuration here or you can set through configuration object as seen below
        $.fn.select2.defaults = $.extend($.fn.select2.defaults, {
          allowClear: true, // Adds X image to clear select
          closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
          placeholder: 'Select...',
          minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
        });

        $(document).ready(

          function () {

            // Single select example if using params obj or configuration seen above
            var configParamsObj = {
              placeholder: 'Select an option...', // Place holder text to place in the select
              minimumResultsForSearch: 3 // Overrides default of 15 set above
            };
            $(".singleSelectExample").select2(configParamsObj);
          });
          </script>

          <script type="text/javascript">
          $(document).ready(function() {
            $('#ID_Division').change(function() {
              var Division = $(this).val();
              //var ID_Division = $(this).val();
              //alert(Division);
              var url = '<?php echo site_url('Portal/ajax_get_division') ?>';
              $.ajax({
                type: "POST",
                url: url,
                data: {Division:Division},
                dataType: 'html',
                success: function(data) {
                  $('#ID_District').html(data);
                }
              });
            });
          });


          $(document).ready(function() {
            $('#ID_District').change(function() {
              var District = $(this).val();
              //alert(District);
              var url = '<?php echo site_url('Portal/up_thana_by_dis_id') ?>';
              $.ajax({
                type: "POST",
                url: url,
                data: {District:District},
                dataType: 'html',
                success: function(data) {
                  $('#THANA_ID').html(data);
                }
              });
            });
          });


          $(document).ready(function() {
            $('#THANA_ID').change(function() {
              var THANAME = $(this).val();
              //alert(District);
              var url = '<?php echo site_url('Portal/up_union_by_dis_id') ?>';
              $.ajax({
                type: "POST",
                url: url,
                data: {THANAME:THANAME},
                dataType: 'html',
                success: function(data) {
                  $('#union_id').html(data);
                }
              });
            });
          });




          </script>

          <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
          <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/jquery.snippet.min.js"></script>
          <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/jquery.easyPaginate.js"></script>
          <script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/scripts.js"></script>
