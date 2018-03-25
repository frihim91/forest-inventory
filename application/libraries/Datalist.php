<?php

class Datalist {

    protected $_ci;

    function __construct() {

        $this->_ci = &get_instance();
    }
    function allometricEquationList($input,$collection)
    {
      $sl=0;
      $data   = array();
        if ($collection) {
            foreach ($collection['data'] as $key => $item) {
              $row=array();
              $url=site_url();
              $html=" <div class='panel panel-default'>

                      <div class='panel-heading'>Allometric Equation  $item->ID_AE
                        <a href='$url/Portal/allometricEquationDetails/$item->ID_AE' class='btn btn-default pull-right btn-xs'>Detailed information<span class='glyphicon glyphicon-chevron-right'></span></a>
                      </div>
                      <div class='panel-body'>
                        <dl class='dl-horizontal'>
                          <dt style='font-size:15px'><small>Equation</small></dt> <dd style='font-size:15px'><code> $item->Equation</code></dd>
                          <dt style='font-size:15px'><small>Output</small></dt> <dd style='font-size:15px'><small> $item->Output</small></dd>
                          <dt style='font-size:15px'><small>Reference</small></dt> <dd style='font-size:15px'><small> $item->Author. $item->Reference</small></dd>
                          <dt style='font-size:15px'><small>Reference Year</small></dt> <dd style='font-size:15px'><small> $item->Year</small></dd>
                          <dt style='font-size:15px'><small>Biomass</small></dt> <dd style='font-size:15px'><small> $item->FAOBiomes</small></dd>
                          <dt style='font-size:15px'><small>Family</small></dt> <dd style='font-size:15px'><small> $item->Family</small></dd>
                          <dt style='font-size:15px'><small>Species</small></dt> <dd style='font-size:15px'><small> $item->Species</small></dd>
                          <dt style='font-size:15px'><small>Locations</small></dt> <dd style='font-size:15px'><small> $item->District (lat  $item->Latitude,lon  $item->Longitude)</small></dd>
                          <!--  <p style='padding-left:3px'><b>Equation: <code style='color:#c7254efont-size: 14px'> $item->Equation</code></b></p>
                          <p style='padding-left:3px'><b>Output: </b> $item->Output</p>
                          <p style='padding-left:3px'><b>Reference: </b> $item->Reference</p>
                          <p style='padding-left:3px'><b>Reference Year: </b> $item->Year</p>
                          <p style='padding-left:3px'><b>Biomass: </b> $item->FAOBiomes</p>
                          <p style='padding-left:3px'><b>Family: </b> $item->Family</p>
                          <p style='padding-left:3px'><b>Species: </b>  $item->Species</p>
                          <p style='padding-left:3px'><b>Locations: </b> $item->District (lat  $item->Latitude,lon  $item->Longitude)</p> -->
                          <dl>
                          </div>

                        </div>";
                        $row[]  = $html;//$item->ID_RD;
                      
              $data[] = $row;
               $sl++;
            }
          }
            $output=array(
            'draw'              => $input['draw'],
            'recordsTotal'      => $collection['total'],
            'recordsFiltered'   =>$collection['filtered'],
            'data'              => $data
        );
        return $output;
    }



        function rawDataList($input,$collection)
    {
      $sl=0;
      $data   = array();
        if ($collection) {
            foreach ($collection['data'] as $key => $item) {
              $row=array();
              $url=site_url();
              $html=" <div class='panel panel-default'>
                      <div class='panel-heading'>Raw Data  $item->ID
                        <a href='$url/Portal/rawDataDetails/$item->ID' class='btn btn-default pull-right btn-xs'>Detailed information<span class='glyphicon glyphicon-chevron-right'></span></a>
                      </div>
               <div class='panel-body'>
                <dl class='dl-horizontal'>
                  <dt style='font-size:15px'><small>Tree Height (m)</small></dt> <dd style='font-size:15px'><small> $item->H_m</small></dd> 
                  <dt style='font-size:15px'><small>Tree Diameter (cm)</small></dt> <dd style='font-size:15px'><small>$item->DBH_cm</small></dd>
                  <dt style='font-size:15px'><small>Total Volume</small></dt> <dd style='font-size:15px'><small>$item->Volume_m3</small></dd>
                  <dt style='font-size:15px'><small>Reference</small></dt> <dd style='font-size:15px'><small> $item->Author.$item->Reference</small></dd>
                  <dt style='font-size:15px'><small>Reference Year</small></dt> <dd style='font-size:15px'><small> $item->Year</small></dd>  
                  <dt style='font-size:15px'><small>Biomass</small></dt> <dd style='font-size:15px'><small> $item->FAOBiomes</small></dd> 
                  <dt style='font-size:15px'><small>Family</small></dt> <dd style='font-size:15px'><small> $item->Family</small></dd> 
                  <dt style='font-size:15px'><small>Species</small></dt> <dd style='font-size:15px'><small> $item->Species</small></dd>
                  <dt style='font-size:15px'><small>Locations</small></dt> <dd style='font-size:15px'><small> $item->District (lat  $item->Latitude,lon  $item->Longitude)</small></dd> 
                 

                   <dl> 
               </div>
            </div>";
              $row[]  = $html;//$item->ID_RD;
                      
              $data[] = $row;
               $sl++;
            }
          }
            $output=array(
            'draw'              => $input['draw'],
            'recordsTotal'      => $collection['total'],
            'recordsFiltered'   =>$collection['filtered'],
            'data'              => $data
        );
        return $output;
    }




        function wdDataList($input,$collection)
    {
      $sl=0;
      $data   = array();
        if ($collection) {
            foreach ($collection['data'] as $key => $item) {
              $row=array();
              $url=site_url();
              $html=" <div class='panel panel-default'>
                      <div class='panel-heading'>Wood Densities $item->ID_WD
                        <a href='$url/Portal/woodDensitiesDetails/$item->ID_WD' class='btn btn-default pull-right btn-xs'>Detailed information<span class='glyphicon glyphicon-chevron-right'></span></a>
                      </div>
               <div class='panel-body'>
                  <dl class='dl-horizontal'>
                  <dt style='font-size:15px'><small>Green Density g/cm3</small></dt> <dd style='font-size:15px'><small> $item->Density_green</small></dd> 
                  <dt style='font-size:15px'><small>Airdry Density g/cm3</small></dt> <dd style='font-size:15px'><small> $item->Density_airdry</small></dd> 
                  <dt style='font-size:15px'><small>Ovendry Density g/cm3</small></dt> <dd style='font-size:15px'><small>$item->Density_ovendry</small></dd> 
                  <dt style='font-size:15px'><small>Reference</small></dt> <dd style='font-size:15px'><small>$item->Author.$item->Reference</small></dd> 
                  <dt style='font-size:15px'><small>Reference Year</small></dt> <dd style='font-size:15px'><small> $item->Year</small></dd> 
                  <dt style='font-size:15px'><small>Family</small></dt> <dd style='font-size:15px'><small> $item->Family</small></dd>
                  <dt style='font-size:15px'><small>Species</small></dt> <dd style='font-size:15px'><small> $item->Species</small></dd>
                  <dt style='font-size:15px'><small>Locations</small></dt> <dd style='font-size:15px'><small>lat  $item->Latitude,lon  $item->Longitude</small></dd> 
                  

                  <dl>  
               </div>
            </div>";
              $row[]  = $html;//$item->ID_RD;
                      
              $data[] = $row;
               $sl++;
            }
          }
            $output=array(
            'draw'              => $input['draw'],
            'recordsTotal'      => $collection['total'],
            'recordsFiltered'   =>$collection['filtered'],
            'data'              => $data
        );
        return $output;
    }


       function efDataList($input,$collection)
    {
      $sl=0;
      $data   = array();
        if ($collection) {
            foreach ($collection['data'] as $key => $item) {
              $row=array();
              $url=site_url();
              $html=" <div class='panel panel-default'>
                      <div class='panel-heading'>Emission Factors  $item->ID_EF
                        <a href='$url/Portal/biomassExpansionFacDetails/$item->ID_EF' class='btn btn-default pull-right btn-xs'>Detailed information<span class='glyphicon glyphicon-chevron-right'></span></a>
                      </div>
               <div class='panel-body'>
                <dl class='dl-horizontal'>
                 <dt style='font-size:15px'><small>Emission Factor</small></dt> <dd style='font-size:15px'><small> $item->EmissionFactor</small></dd> 
                  <dt style='font-size:15px'><small>Units</small></dt> <dd style='font-size:15px'><small> $item->Unit</small></dd>
                  <dt style='font-size:15px'><small>Value</small></dt> <dd style='font-size:15px'><small> $item->Value</small></dd>
                  <dt style='font-size:15px'><small>Reference</small></dt> <dd style='font-size:15px'><small>$item->Author. $item->Reference</small></dd>
                  <dt style='font-size:15px'><small>Reference Year</small></dt> <dd style='font-size:15px'><small> $item->Year</small></dd> 
                  <dt style='font-size:15px'><small>Biomass</small></dt> <dd style='font-size:15px'><small> $item->FAOBiomes</small></dd>
                  <dt style='font-size:15px'><small>Family</small></dt> <dd style='font-size:15px'><small>$item->Family</small></dd>
                  <dt style='font-size:15px'><small>Species</small></dt> <dd style='font-size:15px'><small> $item->Species</small></dd>
                  <dt style='font-size:15px'><small>Locations</small></dt> <dd style='font-size:15px'><small> $item->District (lat  $item->latitude,lon  $item->longitude)</small></dd>  
                  

                  <dl>  
               </div>
            </div>";
              $row[]  = $html;//$item->ID_RD;
                      
              $data[] = $row;
               $sl++;
            }
          }
            $output=array(
            'draw'              => $input['draw'],
            'recordsTotal'      => $collection['total'],
            'recordsFiltered'   =>$collection['filtered'],
            'data'              => $data
        );
        return $output;
    }






}

?>
