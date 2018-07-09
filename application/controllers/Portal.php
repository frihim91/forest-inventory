<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* @category   FrontPortal
* @package    Portal
* @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
* @copyright  2017 ATI Limited Development Group
*/

class Portal extends CI_Controller
{

  function __construct()
  {

    parent::__construct();
       /*if (!isset($_SESSION['user_loggeed'])) {
       redirect('/');
     }*/
     $this->load->model('utilities');
     $this->load->model('setup_model');
     $this->load->model('Menu_model');
     $this->load->model('Forestdata_model');
     $this->load->helper(array(
      'html',

      'form'
    ));
     $this->load->library('form_validation');
     $this->load->library('upload');
     $this->load->helper('url');
     $this->load->library("pagination");
   }


  /*
* @methodName searchAttributeString()
* @access private
* @param  none
* @return search string
*/
// private function searchAttributeString($searchFields)
// {
//   $n=count($searchFields);
//   $string='';
//   $i=0;
//   $fromVal='';
//   $toVal='';
//   $from2val='';
//   $to2Val='';
//   $strHm='';
//   foreach ($searchFields as $key => $value) {
//     if(!empty($value))
//     {
//       if($key!='from' AND $key!='to' AND $key!='from2' and $key!='to2')
//       {
//          if($i==0)
//       {
//         $string=$string.$key." like '%$value%'";
//       }
//       else
//       {
//         $string=$string.' OR '.$key." like '%$value%'";
//       }
//       $i++;
//       }

//     }
//     if($key='from')
//     {
//       $fromVal=$value;
//     }
//     if($key='to')
//     {
//       $to=$value;
//     }
//     if($key='from2')
//     {
//       $from2Val=$value;
//     }
//     if($key='to2')
//     {
//       $to2Val=$value;
//     }


//   }
//   $betweenStr='';
//       if($fromVal!='' AND $toVal!='')
//           {
//              $strHm="H_m BETWEEN $fromVal and $toVal";
//           }
//           if($from2Val!='' AND $to2Val!='')
//           {
//              $volStr="Volume_m3 BETWEEN $from2Val and $to2Val";
//           }
//           if($strHm!='' AND $volStr!='')
//           {
//             $betweenStr=" ($strHm) OR ($volStr)";
//           }
//           else if($strHm!='' AND $volStr=='')
//           {
//             $betweenStr=" ($strHm)";
//           }
//            else if($strHm=='' AND $volStr!='')
//           {
//             $betweenStr=" ($volStr)";
//           }
//           if($string!='')
//           {
//             return $string.' OR '. $betweenStr;
//           }
//           else 
//           {
//             return $betweenStr;
//           }

// }

private function searchAttributeStringR($searchFields)
{
  $n=count($searchFields);
  $string='';
  $i=0;
  $betweenStr='';
  $addStringVol='';
  $addStringHm='';
  //$this->pr($searchFields);
  foreach ($searchFields as $key => $value) {
    //echo $key."<br>";
     $pieces = explode("_",$key);
     $prefix=$pieces[0];
    if(!empty($value))
    {
     


      if($prefix!='r.th')
      {
        if($i==0)
        {
          $string=$string.$key." like '%$value%'";
        }
        else
        {
          $string=$string.' AND '.$key." like '%$value%'";
        }
        $i++;
      }


      
    }
    if($prefix=='r.th') 
      {
        if($value=='')
        {
          $value=0;
        }
        $betweenStr.=$value.'_';
      }
   
       

  }


   $betweenString= explode("_",$betweenStr);
      $dbhfrom=$betweenString[0];
      $dbhTo=$betweenString[1];
      $volFrom=$betweenString[2];
      $volTo=$betweenString[3];
      if($dbhTo==0)
      {
        $dbhTo=100000000; 
      }
      if($volTo==0)
      {
        $volTo=100000000;
      }
      if($i>0)
      {
        
        $addStringHm= " AND (H_m Between $dbhfrom AND  $dbhTo)";
      }
      else 
      {
        $i++;
        $addStringHm= " (H_m Between $dbhfrom AND  $dbhTo)";
      }
      if($i>0)
      {

        $addStringVol= " AND (Volume_m3 Between $volFrom AND  $volTo)";
      }
      else 
      {
        $i++;
        $addStringVol= " (Volume_m3 Between $volFrom AND  $volTo)";
      }
  return $string.$addStringHm.$addStringVol;
}


private function searchAttributeString($searchFields)
{
  $n=count($searchFields);
  $string='';
  $i=0;
  foreach ($searchFields as $key => $value) {
    if(!empty($value))
    {
      if($i==0)
      {
        $string=$string.$key." like '%$value%'";
      }
      else
      {
        $string=$string.' AND '.$key." like '%$value%'";
      }
      $i++;
    }

  }
  return $string;
}



private function searchAttributeStringW($searchFields)
{
  $n=count($searchFields);
  $string='';
  $i=0;
  $betweenStr='';
  $addStringW='';
  //$this->pr($searchFields);
  foreach ($searchFields as $key => $value) {
    //echo $key."<br>";
     $pieces = explode("_",$key);
     $prefix=$pieces[0];
    if(!empty($value))
    {
     


      if($prefix!='w.w')
      {
        if($i==0)
        {
          $string=$string.$key." like '%$value%'";
        }
        else
        {
          $string=$string.' AND '.$key." like '%$value%'";
        }
        $i++;
      }

      
      
    }
    if($prefix=='w.w') 
      {
        if($value=='')
        {
          $value=0;
        }
        $betweenStr.=$value.'_';
      }
   
       

  }


   $betweenString= explode("_",$betweenStr);
      $dbhfrom=$betweenString[0];
      $dbhTo=$betweenString[1];
      
      if($dbhTo==0)
      {
        $dbhTo=100000000; 
      }
    
      if($i>0)
      {
        
        $addStringW= " AND (Density_ovendry Between $dbhfrom AND  $dbhTo)";
      }
      else 
      {
        $i++;
        $addStringW= " (Density_ovendry Between $dbhfrom AND  $dbhTo)";
      }
 
  return $string.$addStringW;
}

private function searchAttributeKeywordString($searchFields)
{
  $n=count($searchFields);
  $string='';
  $i=0;
  foreach ($searchFields as $key => $value) {
    if(!empty($value))
    {
      if($i==0)
      {
        $string=$string.$key." like '%$value%'";
      }
      else
      {
        $string=$string.' OR '.$key." like '%$value%'";
      }
      $i++;
    }

  }
  return $string;
}
private function getDtByAttrAe($attr)
{
    //$this->pr($attr);

  $returnArray=array();
  switch ($attr) {
    case "Family":
    $returnArray[]='Family';
    $returnArray[]='a.';
    break;
    case "Genus":
    $returnArray[]='Genus';
    $returnArray[]='a.';
    break;
    case "Species":
    $returnArray[]='Species';
    $returnArray[]='a.';
    break;
    case "Equation_VarNames":
    $returnArray[]='Equation_VarNames';
    $returnArray[]='a.';
    break;
    case "Division":
    $returnArray[]='Division';
    $returnArray[]='a.';
    break;
    case "District":
    $returnArray[]='District';
    $returnArray[]='a.';
    break;
    case "FAOBiomes":
    $returnArray[]='FAO Biomes';
    $returnArray[]='a.';
    break;
    case "AEZ_NAME":
    $returnArray[]='Bangladesh Agroecological Zone';
    $returnArray[]='a.';
    break;
    case "Zones":
    $returnArray[]='BFI Zone';
    $returnArray[]='a.';
    break;
    case "Reference":
    $returnArray[]='Reference';
    $returnArray[]='a.';
    break;
    case "Author":
    $returnArray[]='Author';
    $returnArray[]='a.';
    break;
    case "Year":
    $returnArray[]='Year';
    $returnArray[]='a.';
    break;
    default:
    $returnArray[]='';
    $returnArray[]='';
  }
   // $this->pr($returnArray);
  return $returnArray;
}

public function searchAllometricEquationAll()
{
    //  $r=$this->getDtByAttrAe('Author');
    //$this->pr($_GET);
  if(!empty($_GET)){
    $searchFieldArray=$_GET;
    if(!isset($searchFieldArray['keyword']))
    {
      $searchFieldArray['keyword']='';
    }
    if($searchFieldArray['keyword']!='')
    {
       // $this->pr($searchFieldArray);
      foreach($searchFieldArray as $key=>$value)
      {
        if($key!='keyword')
        {
          $r=$this->getDtByAttrAe($key);
             // $this->pr($r);
          $validSearchKey[$r[1].$key]=$searchFieldArray['keyword'];
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$searchFieldArray['keyword'];
        }
      }
    } 
    else
    {
      foreach($searchFieldArray as $key=>$value)
      {
        if($value!='')
        {
          $r=$this->getDtByAttrAe($key);
          $validSearchKey[$r[1].$key]=$value;
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$value;
        }
      }
    }
    //  $this->pr($filedNameValue);
    if(!isset($filedNameValue))
    {
      redirect('data/allometricEquationView');
    }
    else
    {
      $data['fieldNameValue']=$filedNameValue;
    }

    if($searchFieldArray['keyword']!='')
    {
      $string=$this->searchAttributeKeywordString($validSearchKey);
    }
    else
    {
      $string=$this->searchAttributeString($validSearchKey);
    }


      //$string=$this->searchAttributeString($validSearchKey);
// echo $string;
// exit;
    $k=$data['allometricEquationView'] = $this->db->query("SELECT * from __view_allometric_eqn_search_tbl a where $string
      ")->result();
      //$this->pr($k);

    $data['allometricEquationView_count'] = $this->db->query("SELECT * from __view_allometric_eqn_search_tbl a where $string
     ")->result();

       // $data["links"]                  = $this->pagination->create_links();

    if($searchFieldArray['keyword']!='')
    {
      $subUrl='';
      $i=0;
      $n=count($searchFieldArray);
      foreach($searchFieldArray as $row=> $val)
      {
        if($i<$n-1)
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'].'&';
        }
        else
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'];
        }
        $i++;

      }
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $pieces = explode("?", $url);
      $urlTail=$pieces[1];
      $url=str_ireplace($urlTail,$subUrl,$url);
      $keyWord=$searchFieldArray['keyword'];
      $removeString="keyword=$keyWord&";
      $data['actualUrl']=str_replace($removeString,'',$url);
    }
    else
    {
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $data['actualUrl']=$url;
    }
  }
  else
  {
    redirect('data/allometricEquationView');
  }
     //  $jsonQuery="SELECT l.latDD y,l.longDD x,GROUP_CONCAT(DISTINCT(a.output)) OUTPUT,d.Division,dis.District,f.Family,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome,COUNT(FAOBiomes)total_species,a.location_name,a.LatDD,a.LongDD,fnc_ae_species_data(l.LatDD,l.LongDD) species_desc FROM location l
     //  LEFT JOIN group_location lg ON l.ID_Location=lg.location_id
     //  LEFT JOIN ae a ON lg.group_id=a.location_group
     //  LEFT JOIN species_group sr ON a.Species=sr.Speciesgroup_ID
     //  LEFT JOIN species s ON sr.ID_Species=s.ID_Species
     //  LEFT JOIN family f ON s.ID_Family=f.ID_Family
     //  LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     //  LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     //  LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
     //  LEFT JOIN division d ON l.ID_Division=d.ID_Division
     //  LEFT JOIN district dis ON l.ID_District =dis.ID_District
     //  LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
     //  LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
     //  WHERE $string and a.ID_AE IS NOT NULL  
     //  GROUP BY LatDD,LongDD";
     // echo $jsonQuery;
     // exit;

  $jsonQuery="SELECT * from __view_allometric_equ_search_map a where $string";
     //echo $jsonQuery;
     //exit;
  $jsonQueryEncode=base64_encode($jsonQuery);
  $data['jsonQuery']=$jsonQueryEncode;
  $data['content_view_page']      = 'portal/allometricEquationPage';
  $str=$string;
  $string=base64_encode($string);
  $string= str_replace("=","abyz",$string);
  $data['string']=$string;
  $data['strs']=$string;
       //$data["searchType"]=2;
       //$data["searchType"]=3;
       //$data["searchType"]=4;
  $this->template->display_portal($data);
}





private function getDtByAttrRaw($attr)
{
  $returnArray=array();
  switch ($attr) {
    case "th_from":
    $returnArray[]='H_m';
    $returnArray[]='r.';
    break;
    case "th_to":
    $returnArray[]='H_m';
    $returnArray[]='r.';
    break;
    case "th_from2":
    $returnArray[]='Volume_m3';
    $returnArray[]='r.';
    break;
    case "th_to2":
    $returnArray[]='Volume_m3';
    $returnArray[]='r.';
    break;
    case "DBH_cm":
    $returnArray[]='Tree Diameter (DBH_cm)';
    $returnArray[]='r.';
    break;
    case "Family":
    $returnArray[]='Family';
    $returnArray[]='r.';
    break;
    case "Genus":
    $returnArray[]='Genus';
    $returnArray[]='r.';
    break;
    case "Species":
    $returnArray[]='Species';
    $returnArray[]='r.';
    break;
    case "Division":
    $returnArray[]='Division';
    $returnArray[]='r.';
    break;
    case "District":
    $returnArray[]='District';
    $returnArray[]='r.';
    break;
    case "FAOBiomes":
    $returnArray[]='FAO Biomes';
    $returnArray[]='r.';
    break;
    case "AEZ_NAME":
    $returnArray[]='Bangladesh Agroecological Zone';
    $returnArray[]='r.';
    break;
    case "Zones":
    $returnArray[]='BFI Zone';
    $returnArray[]='r.';
    break;
    case "Reference":
    $returnArray[]='Reference';
    $returnArray[]='r.';
    break;
    case "Author":
    $returnArray[]='Author';
    $returnArray[]='r.';
    break;

    case "Year":
    $returnArray[]='Year';
    $returnArray[]='r.';
    break;
    default:
    $returnArray[]='';
    $returnArray[]='';
  }
  return $returnArray;
}

public function searchRawEquationAll()
{
    //  $r=$this->getDtByAttrAe('Author');
    //$this->pr($_GET);

  if(!empty($_GET)){
    $searchFieldArray=$_GET;
      // echo "<pre>";
      // print_r($searchFieldArray);
      // exit;
    if(!isset($searchFieldArray['keyword']))
    {
      $searchFieldArray['keyword']='';
    }
    if($searchFieldArray['keyword']!='')
    {
      foreach($searchFieldArray as $key=>$value)
      {
        $pieces = explode("_", $key);
        $prefix=$pieces[0];

        if($key!='keyword' AND $prefix!='th')
        {
          $r=$this->getDtByAttrRaw($key);
          $validSearchKey[$r[1].$key]=$searchFieldArray['keyword'];
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$searchFieldArray['keyword'];
        }
      }
    }


    else
    {
      foreach($searchFieldArray as $key=>$value)
      {
        $pieces = explode("_", $key);
        $prefix=$pieces[0];
            //exit;
        if($value!='' AND $prefix!='th')
        {
          $r=$this->getDtByAttrRaw($key);
          $validSearchKey[$r[1].$key]=$value;
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$value;
        }
      }
    }
    foreach($searchFieldArray as $key=>$value)
    {
      $pieces = explode("_", $key);
      $prefix=$pieces[0];
            //exit;
      if($prefix=='th')
      {
        $r=$this->getDtByAttrRaw($key);
        $validSearchKey[$r[1].$key]=$value;
        $fieldName[]=$r[0];
        $filedNameValue[$r[0].'/'.$key]=$value;
      }
    }
      //$data['prefix']=$prefix;



    if(!isset($filedNameValue))
    {
      redirect('data/rawDataView');
    }
    else
    {
      $data['fieldNameValue']=$filedNameValue;
    }

    if($searchFieldArray['keyword']!='')
    {
      $string=$this->searchAttributeKeywordString($validSearchKey);
    }
    else
    {
      $string=$this->searchAttributeStringR($validSearchKey);
    }
  

    

    //  echo $string=$this->searchAttributeString($validSearchKey).' '.$betweenStr;

    $k=$data['rawDataView'] = $this->db->query("SELECT * from __view_raw_data_search_tbl r where $string  
      ")->result();
    $data['rawDataView_count'] = $this->db->query("SELECT * from __view_raw_data_search_tbl r where $string
      ")->result();
       // $data["links"]                  = $this->pagination->create_links();

    if($searchFieldArray['keyword']!='')
    {
      $subUrl='';
      $i=0;
      $n=count($searchFieldArray);
      foreach($searchFieldArray as $row=> $val)
      {
        if($i<$n-1)
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'].'&';
        }
        else
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'];
        }
        $i++;

      }
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $pieces = explode("?", $url);
      $urlTail=$pieces[1];
      $url=str_ireplace($urlTail,$subUrl,$url);
      $keyWord=$searchFieldArray['keyword'];
      $removeString="keyword=$keyWord&";
      $data['actualUrl']=str_replace($removeString,'',$url);
    }
    else
    {
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $data['actualUrl']=$url;
    }
  }
  else
  {
    redirect('data/rawDataView');
  }
      // $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,a.location_name,a.LatDD,a.LongDD,
      // fnc_rd_species_data(a.LatDD,a.LongDD) species_desc FROM location a
      // LEFT JOIN group_location b ON a.ID_Location=b.location_id
      // LEFT JOIN rd r ON b.group_id=r.location_group
      // LEFT JOIN species_group sr ON r.Speciesgroup_ID=sr.Speciesgroup_ID
      // LEFT JOIN species s ON sr.ID_Species=s.ID_Species
      // LEFT JOIN family f ON s.ID_Family=f.ID_Family
      // LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
      // LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
      // LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
      // LEFT JOIN division d ON a.ID_Division=d.ID_Division
      // LEFT JOIN district dis ON a.ID_District =dis.ID_District
      // LEFT JOIN zones zon ON a.ID_Zones =zon.ID_Zones
      // LEFT JOIN bd_aez1988 eco ON a.ID_1988EcoZones =eco.MAJOR_AEZ
      // WHERE r.ID IS NOT NULL
      // and $string
      // GROUP BY LatDD,LongDD";
      // //echo $jsonQuery;
      // //exit;
  $jsonQuery="SELECT * from __view_raw_data_search_map  r where $string";
  $jsonQueryEncode=base64_encode($jsonQuery);
  $data['jsonQuery']=$jsonQueryEncode;
  $data['content_view_page']      = 'portal/rawDataView';
  $str=$string;
  $string=base64_encode($string);
  $string= str_replace("=","abyz",$string);
  $data['string']=$string;
  $data['strs']=$string;
      //echo $data['strs']=$string;exit();
  $this->template->display_portal($data);
}


public function getMapJsonData($query)
{
  $query1=base64_decode($query);

  $conn = new PDO('mysql:host=192.168.0.106;dbname=faobd_db_v2','maruf','maruf');
  $sql =$query1;
  if (isset($_GET['bbox']) || isset($_POST['bbox'])) {
    $bbox = explode(',', $_GET['bbox']);
    $sql = $sql . ' WHERE x <= ' . $bbox[2] . ' AND x >= ' . $bbox[0] . ' AND y <= ' . $bbox[3] . ' AND y >= ' . $bbox[1];
  }
  $rs = $conn->query($sql);
  if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
  }
  $geojson = array(
    'type'      => 'FeatureCollection',
    'features'  => array()
  );

      # Loop through rows to build feature arrays
  while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
        # Remove x and y fields from properties (optional)
    unset($properties['x']);
    unset($properties['y']);
    $feature = array(
      'type' => 'Feature',
      'geometry' => array(
        'type' => 'Point',
        'coordinates' => array(
          $row['x'],
          $row['y']
        )
      ),
      'properties' => $properties
    );
        # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
  }
    //  return $geojson;
  header('Content-type: application/json');
  echo json_encode($geojson, JSON_NUMERIC_CHECK);
  $conn = NULL;
      //return $returnJson;
}



private function getDtByAttrEmission($attr)
{
  $returnArray=array();
  switch ($attr) {

    case "Family":
    $returnArray[]='Family';
    $returnArray[]='e.';
    break;
    case "Genus":
    $returnArray[]='Genus';
    $returnArray[]='e.';
    break;
    case "Species":
    $returnArray[]='Species';
    $returnArray[]='e.';
    break;
    case "Division":
    $returnArray[]='Division';
    $returnArray[]='e.';
    break;
    case "District":
    $returnArray[]='District';
    $returnArray[]='e.';
    break;
    case "FAOBiomes":
    $returnArray[]='FAO Biomes';
    $returnArray[]='e.';
    break;
    case "AEZ_NAME":
    $returnArray[]='Bangladesh Agroecological Zone';
    $returnArray[]='e.';
    break;
    case "Zones":
    $returnArray[]='BFI Zone';
    $returnArray[]='e.';
    break;
    case "Reference":
    $returnArray[]='Reference';
    $returnArray[]='e.';
    break;
    case "Author":
    $returnArray[]='Author';
    $returnArray[]='e.';
    break;
    case "Year":
    $returnArray[]='Year';
    $returnArray[]='e.';
    break;
    default:
    $returnArray[]='';
    $returnArray[]='';
  }
  return $returnArray;
}

public function searchEmissionFactorAll()
{
    //  $r=$this->getDtByAttrAe('Author');
    //$this->pr($_GET);
  if(!empty($_GET)){
    $searchFieldArray=$_GET;
    if(!isset($searchFieldArray['keyword']))
    {
      $searchFieldArray['keyword']='';
    }
    if($searchFieldArray['keyword']!='')
    {
      foreach($searchFieldArray as $key=>$value)
      {
        if($key!='keyword')
        {
          $r=$this->getDtByAttrEmission($key);
          $validSearchKey[$r[1].$key]=$searchFieldArray['keyword'];
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$searchFieldArray['keyword'];
        }
      }
    }
    else
    {
      foreach($searchFieldArray as $key=>$value)
      {
        if($value!='')
        {
          $r=$this->getDtByAttrEmission($key);
          $validSearchKey[$r[1].$key]=$value;
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$value;
        }
      }
    }
    //  $this->pr($filedNameValue);
    if(!isset($filedNameValue))
    {
      redirect('data/biomassExpansionFacView');
    }
    else
    {
      $data['fieldNameValue']=$filedNameValue;
    }

    //$string=$this->searchAttributeString($validSearchKey);

    if($searchFieldArray['keyword']!='')
    {
      $string=$this->searchAttributeKeywordString($validSearchKey);
    }
    else
    {
      $string=$this->searchAttributeString($validSearchKey);
    }

    $k=$data['biomassExpansionFacView'] = $this->db->query("SELECT * from __view_emission_fac_search_tbl e where $string
      ")->result();

    $data['biomassExpansionFacView_count'] = $this->db->query("SELECT * from __view_emission_fac_search_tbl e where $string
      ")->result();
       // $data["links"]                  = $this->pagination->create_links();

    if($searchFieldArray['keyword']!='')
    {
      $subUrl='';
      $i=0;
      $n=count($searchFieldArray);
      foreach($searchFieldArray as $row=> $val)
      {
        if($i<$n-1)
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'].'&';
        }
        else
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'];
        }
        $i++;

      }
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $pieces = explode("?", $url);
      $urlTail=$pieces[1];
      $url=str_ireplace($urlTail,$subUrl,$url);
      $keyWord=$searchFieldArray['keyword'];
      $removeString="keyword=$keyWord&";
      $data['actualUrl']=str_replace($removeString,'',$url);
    }
    else
    {
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $data['actualUrl']=$url;
    }
  }
  else
  {
    redirect('data/biomassExpansionFacView');
  }

      // $jsonQuery="SELECT l.latDD y,l.longDD x,d.Division,dis.District,f.Family,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
      // fnc_ef_species_data(l.LatDD,l.LongDD) species_desc FROM location l
      // LEFT JOIN group_location lg ON l.ID_Location=lg.location_id
      // LEFT JOIN ef e ON lg.group_id=e.group_location
      // LEFT JOIN species s ON e.Species=s.ID_Species
      // LEFT JOIN family f ON s.ID_Family=f.ID_Family
      // LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
      // LEFT JOIN reference ref ON e.Reference=ref.ID_Reference
      // LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      // LEFT JOIN division d ON l.ID_Division=d.ID_Division
      // LEFT JOIN district dis ON l.ID_District =dis.ID_District
      // LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      // LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
      // WHERE e.ID_EF IS NOT NULL and $string
      // GROUP BY LatDD,LongDD
      // ";
      //echo $jsonQuery;
      //exit;
  $jsonQuery="SELECT * from __view_emission_fac_search_map  e where $string";
  $jsonQueryEncode=base64_encode($jsonQuery);
  $data['jsonQuery']=$jsonQueryEncode;
  $data['content_view_page']      = 'portal/biomassExpansionFacView';
  $str=$string;
  $string=base64_encode($string);
  $string= str_replace("=","abyz",$string);
  $data['string']=$string;
  $data['strs']=$string;
  $this->template->display_portal($data);
}




private function getDtByAttrWd($attr)
{
  $returnArray=array();
  switch ($attr) {
    case "w_from":
    $returnArray[]='Density_ovendry';
    $returnArray[]='w.';
    break;
    case "w_to":
    $returnArray[]='Density_ovendry';
    $returnArray[]='w.';
    break;
    case "Family":
    $returnArray[]='Family';
    $returnArray[]='f.';
    break;
    case "Genus":
    $returnArray[]='Genus';
    $returnArray[]='g.';
    break;
    case "Species":
    $returnArray[]='Species';
    $returnArray[]='s.';
    break;

    case "Division":
    $returnArray[]='Division';
    $returnArray[]='d.';
    break;
    case "District":
    $returnArray[]='District';
    $returnArray[]='dis.';
    break;
    case "FAOBiomes":
    $returnArray[]='FAO Biomes';
    $returnArray[]='b.';
    break;
    case "AEZ_NAME":
    $returnArray[]='Bangladesh Agroecological Zone';
    $returnArray[]='eco.';
    break;
    case "Zones":
    $returnArray[]='BFI Zone';
    $returnArray[]='zon.';
    break;
    case "H_tree_avg":
    $returnArray[]='Average Height';
    $returnArray[]='w.';
    break;
    case "H_tree_max":
    $returnArray[]='Maximum Height';
    $returnArray[]='w.';
    break;
    case "H_tree_min":
    $returnArray[]='Minimum Height';
    $returnArray[]='w.';
    break;
    case "DBH_tree_avg":
    $returnArray[]='Average DBH';
    $returnArray[]='w.';
    break;
    case "DBH_tree_min":
    $returnArray[]='Minimum DBH';
    $returnArray[]='w.';
    break;
    case "DBH_tree_max":
    $returnArray[]='Maximum DBH';
    $returnArray[]='w.';
    break;
    case "FAOBiomes":
    $returnArray[]='FAO Biomes';
    $returnArray[]='b.';
    break;
    case "Reference":
    $returnArray[]='Reference';
    $returnArray[]='ref.';
    break;
    case "Author":
    $returnArray[]='Author';
    $returnArray[]='ref.';
    break;
    case "Year":
    $returnArray[]='Year';
    $returnArray[]='ref.';
    break;
    default:
    $returnArray[]='';
    $returnArray[]='';
  }
  return $returnArray;
}

public function searchWdAll()
{
    //  $r=$this->getDtByAttrAe('Author');
    //$this->pr($_GET);
  if(!empty($_GET)){
    $searchFieldArray=$_GET;
    if(!isset($searchFieldArray['keyword']))
    {
      $searchFieldArray['keyword']='';
    }
    if($searchFieldArray['keyword']!='')
    {
      foreach($searchFieldArray as $key=>$value)
      {
        $pieces = explode("_", $key);
        $prefix=$pieces[0];

        if($key!='keyword' AND $prefix!='w')
        {
          $r=$this->getDtByAttrWd($key);
          $validSearchKey[$r[1].$key]=$searchFieldArray['keyword'];
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$searchFieldArray['keyword'];
        }
      }
    }
    else
    {
      foreach($searchFieldArray as $key=>$value)
      {
        $pieces = explode("_", $key);
        $prefix=$pieces[0];
        if($value!='' AND $prefix!='w')
        {
          $r=$this->getDtByAttrWd($key);
          $validSearchKey[$r[1].$key]=$value;
          $fieldName[]=$r[0];
          $filedNameValue[$r[0].'/'.$key]=$value;
        }
      }
    }

      foreach($searchFieldArray as $key=>$value)
    {
      $pieces = explode("_", $key);
      $prefix=$pieces[0];
            //exit;
      if($prefix=='w')
      {
        $r=$this->getDtByAttrWd($key);
        $validSearchKey[$r[1].$key]=$value;
        $fieldName[]=$r[0];
        $filedNameValue[$r[0].'/'.$key]=$value;
      }
    }

    //  $this->pr($filedNameValue);
    if(!isset($filedNameValue))
    {
      redirect('data/woodDensitiesView');
    }
    else
    {
      $data['fieldNameValue']=$filedNameValue;
    }
     if($searchFieldArray['keyword']!='')
    {
      $string=$this->searchAttributeKeywordString($validSearchKey);
    }
    else
    {
      $string=$this->searchAttributeStringW($validSearchKey);
    }

    //$string=$this->searchAttributeStringW($validSearchKey);

    $k=$data['woodDensitiesView']= $this->db->query("SELECT w.H_tree_max,w.DBH_tree_avg,w.H_tree_min,w.DBH_tree_min,w.DBH_tree_max, w.ID_WD,w.Density_green,w.Density_airdry,w.Density_ovendry,w.H_tree_avg,ref.Author,ref.Reference,ref.Year,d.Division,dis.District,l.location_name,GROUP_CONCAT(lg.location_id),s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones from wd w
     LEFT JOIN species s ON w.ID_species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
     LEFT JOIN group_location lg ON w.location_group=lg.group_id
     LEFT JOIN location l ON lg.location_id=l.ID_Location
     LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
     LEFT JOIN division d ON l.ID_Division=d.ID_Division
     LEFT JOIN district dis ON l.ID_District =dis.ID_District
     LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
     LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
     where $string  GROUP BY w.ID_WD
     order by w.ID_WD ASC
     ")->result();
    $data['woodDensitiesView_count']= $this->db->query("SELECT w.H_tree_max,w.DBH_tree_avg,w.H_tree_min,w.DBH_tree_min,w.DBH_tree_max, w.ID_WD,w.Density_green,w.Density_airdry,w.Density_ovendry,w.H_tree_avg,ref.Author,ref.Reference,ref.Year,d.Division,dis.District,l.location_name,GROUP_CONCAT(lg.location_id),s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones from wd w
     LEFT JOIN species s ON w.ID_species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
     LEFT JOIN group_location lg ON w.location_group=lg.group_id
     LEFT JOIN location l ON lg.location_id=l.ID_Location
     LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
     LEFT JOIN division d ON l.ID_Division=d.ID_Division
     LEFT JOIN district dis ON l.ID_District =dis.ID_District
     LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
     LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
     where  $string  GROUP BY w.ID_WD
     order by w.ID_WD ASC
     ")->result();

       // $data["links"]                  = $this->pagination->create_links();

    if($searchFieldArray['keyword']!='')
    {
      $subUrl='';
      $i=0;
      $n=count($searchFieldArray);
      foreach($searchFieldArray as $row=> $val)
      {
        if($i<$n-1)
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'].'&';
        }
        else
        {
          $subUrl.=$row.'='.$searchFieldArray['keyword'];
        }
        $i++;

      }
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $pieces = explode("?", $url);
      $urlTail=$pieces[1];
      $url=str_ireplace($urlTail,$subUrl,$url);
      $keyWord=$searchFieldArray['keyword'];
      $removeString="keyword=$keyWord&";
      $data['actualUrl']=str_replace($removeString,'',$url);
    }
    else
    {
      $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $data['actualUrl']=$url;
    }
  }
  else
  {
    redirect('data/woodDensitiesView');
  }
  $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
  fnc_wd_species_data(a.LatDD,a.LongDD) species_desc FROM location a
  LEFT JOIN group_location b ON a.ID_Location=b.location_id
  LEFT JOIN wd w ON b.group_id=w.location_group
  LEFT JOIN species s ON w.ID_species=s.ID_Species
  LEFT JOIN family f ON s.ID_Family=f.ID_Family
  LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
  LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
  LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
  LEFT JOIN division d ON a.ID_Division=d.ID_Division
  LEFT JOIN district dis ON a.ID_District =dis.ID_District
  LEFT JOIN zones zon ON a.ID_Zones =zon.ID_Zones
  LEFT JOIN bd_aez1988 eco ON a.ID_1988EcoZones =eco.MAJOR_AEZ
  WHERE w.ID_WD IS NOT NULL and $string
  GROUP BY LatDD,LongDD
  ";
      //echo $jsonQuery;
     // exit;
  $jsonQueryEncode=base64_encode($jsonQuery);
  $data['jsonQuery']=$jsonQueryEncode;
  $data['content_view_page']      = 'portal/woodDensitiesView';
  $str=$string;
  $string=base64_encode($string);
  $string= str_replace("=","abyz",$string);
  $data['string']=$string;
  $data['strs']=$string;
  $this->template->display_portal($data);
}





  /*
   * @methodName index()
   * @access public
   * @param  none
   * @return Fao portal home page
   */

  public function index()
  {
    $data['post_description'] = $this->db->query("SELECT BODY_ID, BODY_DESC FROM post_body WHERE TITLE_ID = 1")->row();
    $data['post_cat']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=1")->row();

    $data['post_cat_two']   = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=2 ORDER BY b.TITLE_ID LIMIT 2")->result();
    $data['post_cat_three_latest'] = $this->db->query("SELECT t.*,c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=3 ORDER BY b.TITLE_ID DESC LIMIT 1")->result();
    $data['post_cat_three_upcoming'] = $this->db->query("SELECT t.*,c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=3 ORDER BY b.TITLE_ID ASC LIMIT 1")->result();
    $data['post_cat_four']  = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=4")->result();
     $data['post_cat_alometric']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=5")->row();
      $data['post_cat_raw_data']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=6")->row();
      $data['post_cat_wd_data']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=7")->row();
      $data['post_cat_ef_data']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=8")->row();
       $data['post_cat_species_data']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=9")->row();

      $data['post_cat_acronyms_data']         = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
      FROM post_title t
      left JOIN post_category c ON t.CAT_ID = c.CAT_ID
      left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
      left JOIN post_images i ON b.BODY_ID = i.BODY_ID
      where t.CAT_ID=10 ORDER BY i.IMG_ID DESC LIMIT 1 ")->row();
    $data['sliders']        = $this->db->query("SELECT * FROM home_page_slider")->result();
    $data['video']        = $this->db->query("SELECT * FROM video limit 1")->result();
    $data['gallery']           = $this->db->query("SELECT * FROM home_page_gallery")->result();
    $data['feature_image'] = $this->db->query("SELECT * FROM home_page_gallery f
     WHERE f.IS_FEAT= 'Y'")->row();

    $this->template->display_portal_home($data);
  }



  public function adasdds($TITLE_ID)
  {

  }

  public function details($TITLE_ID, $PG_URI)
  {

    $data['title_name']        = $this->db->query("SELECT TITLE_NAME,TITLE_NAME_BN FROM pg_title WHERE TITLE_ID = $TITLE_ID")->row();
    $data['page_description']  = $this->db->query("SELECT BODY_ID, BODY_DESC FROM pg_body WHERE TITLE_ID = $TITLE_ID")->row();
    $body_id                   = $data['page_description']->BODY_ID;
      //echo $body_id;exit;
    $data['body_images']       = $this->db->query("SELECT IMG_URL FROM pg_images WHERE BODY_ID = $body_id")->result();
    $data['content_view_page'] = 'portal/pageContent';
    $this->template->display_portal($data);
  }




  /**

  * Show all homepage post


  */

  public function post_details($TITLE_ID, $PG_URI)
  {
    $data['title_name']        = $this->db->query("SELECT TITLE_NAME,TITLE_NAME_BN FROM post_title WHERE TITLE_ID = $TITLE_ID")->row();
    $data['post_description']  = $this->db->query("SELECT BODY_ID, BODY_DESC FROM post_body WHERE TITLE_ID = $TITLE_ID")->row();
    $body_id                   = $data['post_description']->BODY_ID;
      //echo $body_id;exit;
    $data['body_images']       = $this->db->query("SELECT IMG_URL FROM post_images WHERE BODY_ID = $body_id")->result();
    $data['content_view_page'] = 'portal/postContent';
    $this->template->display_portal($data);
  }


  public function viewSliderData()
  {
    $data['sliders']           = $this->db->query("SELECT * FROM home_page_slider")->result();
    $data['content_view_page'] = 'portal/viewSliderData';
    $this->template->display($data);
  }


  public function updateSliderData($ID)
  {
    $data['ID']          = $ID;
    $data['images'] = $this->db->query("SELECT * FROM home_page_slider WHERE ID=$ID")->result();
    $data['edit_sliders']           = $this->db->query("SELECT * FROM home_page_slider WHERE home_page_slider.ID=$ID")->row();
    $data['content_view_page'] = 'portal/editSliderData';
    $this->template->display($data);
  }


  function delete_images()
  {
    $ID    = $this->input->post("ID");
      //echo $ID;exit();
    $query = $this->db->query("UPDATE home_page_slider SET IMAGE_PATH = NULL WHERE ID=$ID");

    if ($query) {
      return 1;
    } else {
      return 0;
    }
  }

  


  public function addImageinSlider()
  {
    if (isset($_POST['title'])) {

          //$titles = count($this->input->post('title'));
      $title    = $this->input->post('title');
      $descript = $this->input->post('descript');


          //echo "test";
          //exit;
      $config['upload_path']   = 'resources/images/home_page_slider';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_width'] = '1600';
      $config['max_height'] = '900';
      $config['file_name']     = $_FILES['main_image']['name'];

          //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('main_image')) {
        $uploadData = $this->upload->data();
        $picture    = $uploadData['file_name'];
      } else {
        $picture = '';
      }

      $data = array(
        'IMAGE_TITLE' => $title,
        'IMAGE_DESC' => $descript,
        'IMAGE_PATH' => $picture
      );

          //$data['IMAGE_PATH'] = 'asdasdsad';

      $this->utilities->insertData($data, 'home_page_slider');
      $this->session->set_flashdata('Success', 'New Slider Added Successfully.');
      redirect('portal/viewSliderData');
    }

    else {
      $data['content_view_page'] = 'portal/addImageinSlider';
      $this->template->display($data);
    }
  }


  public function editImageinSlider()
  {
    $slider_id = $this->uri->segment(3);
    $title    = $this->input->post('title');
    $descript = $this->input->post('descript');
    $config['upload_path']   = 'resources/images/home_page_slider/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_width'] = '1600';
    $config['max_height'] = '900';
    $config['file_name']     = $_FILES['main_image']['name'];

            //Load upload library and initialize configuration
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload('main_image')) {
      $uploadData = $this->upload->data();
      $picture    = $uploadData['file_name'];
      $data = array(
        'IMAGE_TITLE' => $title,
        'IMAGE_DESC' => $descript,
        'IMAGE_PATH' => $picture
      );

    } else {
     $data = array(
      'IMAGE_TITLE' => $title,
      'IMAGE_DESC' => $descript

    );

   }


            //$data['IMAGE_PATH'] = 'asdasdsad';

            //$this->utilities->insertData($data, 'home_page_slider');
   if($this->db->update('home_page_slider', $data, array('ID' => $slider_id)))
   {
    $this->session->set_flashdata('Success', 'New Slider Updated Successfully.');
    redirect('portal/viewSliderData');
  }


  else {
    $data['content_view_page'] = 'portal/editImageinSlider';
    $this->template->display($data);
  }
}




public function deleteImage($id)
{

  $attr = array(
    "ID" => $id
  );

  if ($this->utilities->deleteRowByAttribute("home_page_slider", $attr)) {
    $this->session->set_flashdata('Error', ' Slider Deleted Successfully.');
  } else {
    $this->session->set_flashdata('Error', 'Slider Not Deleted Successfull.');
  }

}




  /*
   * @methodName search_keyword()
   * @access public
   * @param  none
   * @return Search view page
   */
  public function search_keyword()
  {
    $keyword                   = $this->input->post('keyword');
    $data['results']           = $this->Menu_model->search($keyword);
    $data['content_view_page'] = 'portal/search_view';
    $this->template->display_portal($data);
  }


  /*
   * @methodName search_allometricequation_key()
   * @access public
   * @param  none
   * @return Allometric Equation key wise Search view page
   */



  public function search_allometricequation_key1111()
  {
    $keyword = $this->input->post('keyword');
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_key";
    $total_ef           = $this->db->count_all("ae");

    $config["total_rows"] = $total_ef;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['allometricEquationView'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Family
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
     where dis.District LIKE '%$keyword%' OR a.Equation LIKE '%$keyword%' OR ref.Reference LIKE '%$keyword%'
     OR b.FAOBiomes LIKE '%$keyword%' OR s.Species  LIKE '%$keyword%'
     OR f.Family LIKE '%$keyword%' OR g.Genus LIKE '%$keyword%'
     OR ref.Year LIKE '%$keyword%'
     group by a.ID_AE order by a.ID_AE desc LIMIT $limit OFFSET $page
     ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data['content_view_page']      = 'portal/allometricEquationPage';
    $this->template->display_portal($data);

  }




  function search_allometricequation_keydg()
  {
      // get search string
    $this->load->library('pagination');
    $keyword = ($this->input->post("keyword"))? $this->input->post("keyword") : "NIL";


    $keyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;

      // pagination settings
    $config = array();
    $config['base_url'] = site_url("portal/search_allometricequation_key/$keyword");
    $config['total_rows'] = $this->Forestdata_model->get_books_count($keyword);
    $config['per_page'] = "5";
    $config["uri_segment"] = 4;
    $choice = $config["total_rows"]/$config["per_page"];
    $config["num_links"] = floor($choice);

      // integrate bootstrap pagination
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = 'Prev';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);

    $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      // get books list
    $data['allometricEquationView'] = $this->Forestdata_model->get_books($config['per_page'], $data['page'], $keyword);

    $data['pagination'] = $this->pagination->create_links();

      //load view
    $data['content_view_page']      = 'portal/allometricEquationPage';
    $this->template->display_portal($data);
  }





    /*
   * @methodName search_document_key()
   * @access public
   * @param  none
   * @return Documents Search view page
   */
    public function search_document()
    {
      $Title = $this->input->post('Title');
      $Author = $this->input->post('Author');
      $Keywords = $this->input->post('Keywords');
      $Year = $this->input->post('Year');
      $searchFields=array(
        'r.Title'=>$Title,
        'r.Author'=>$Author,
        'r.Year'=>$Year,
        'r.Keywords'=>$Keywords
      );

      $string=$this->searchAttributeString($searchFields);
      if(!empty($string))
      {
        $this->session->set_userdata('liRefSearchString', $string);
      }
      else
      {
        $string=$this->session->userdata('liRefSearchString');
      }
      if(!empty($Title) || !empty($Author) || !empty($Keywords) || !empty($Year))
      {
        $this->session->set_userdata('libSearchStringTitle', $Title);
        $this->session->set_userdata('libSearchStringAuth', $Author);
        $this->session->set_userdata('libSearchStringYear', $Year);
        $this->session->set_userdata('libSearchStringKey', $Keywords);

      }

      else
      {
        $Title=$this->session->userdata('libSearchStringTitle');
        $Author=$this->session->userdata('libSearchStringAuth');
        $Year=$this->session->userdata('libSearchStringYear');
        $Keywords=$this->session->userdata('libSearchStringKey');

      }
      $this->load->library('pagination');
      $config             = array();
      $config["base_url"] = base_url() . "index.php/portal/search_document";

      $total_ae=$this->db->query("SELECT r.* from reference r
       where $string order by r.Title desc
       ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
      $config["total_rows"] =$total_ae;

      // $config["total_rows"] = 800;

      $config["per_page"]        = 10;
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $limit                     = $config["per_page"];
      $config["uri_segment"] = 3;
      //pagination style start
      $config['full_tag_open']   = '<ul class="pagination">';
      $config['full_tag_close']  = '</ul>';
      $config['prev_link']       = '&lt;';
      $config['prev_tag_open']   = '<li>';
      $config['prev_tag_close']  = '</li>';
      $config['next_link']       = '&gt;';
      $config['next_tag_open']   = '<li>';
      $config['next_tag_close']  = '</li>';
      $config['cur_tag_open']    = '<li class="current"><a href="#">';
      $config['cur_tag_close']   = '</a></li>';
      $config['num_tag_open']    = '<li>';
      $config['num_tag_close']   = '</li>';
      $config['first_tag_open']  = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open']   = '<li>';
      $config['last_tag_close']  = '</li>';
      $config['first_link']      = 'First';
      $config['last_link']       = 'Last';
      //pagination style end
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $data['reference_author']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc")->result();
      $data['reference'] = $this->db->query("SELECT r.* from reference r
       where $string order by r.Title desc LIMIT $limit OFFSET $page

       ")->result();
      $data['reference_count'] = $this->db->query("SELECT r.* from reference r
       where $string order by r.Title desc
       ")->result();
      $data["links"]                  = $this->pagination->create_links();
      $data["Title"]=$Title;
      $data["Author"]=$Author;
      $data["Keywords"]=$Keywords;
      $data["Year"]=$Year;
      $data['content_view_page']      = 'portal/viewLibraryPageSearch';
      $this->template->display_portal($data);

    }



    private function getDtByAttrSd($attr)
    {
      $returnArray=array();
      switch ($attr) {
        case "Title":
        $returnArray[]='Title';
        $returnArray[]='r.';
        break;
        case "Author":
        $returnArray[]='Author';
        $returnArray[]='r.';
        break;
      // case "Keywords":
      // $returnArray[]='Keywords';
      // $returnArray[]='r.';
      // break;
        case "Year":
        $returnArray[]='Year';
        $returnArray[]='r.';
        break;

        default:
        $returnArray[]='';
        $returnArray[]='';
      }
      return $returnArray;
    }

    public function searchSearchdocumentAll()
    {
    //  $r=$this->getDtByAttrAe('Author');
    //$this->pr($_GET);
      if(!empty($_GET)){
        $searchFieldArray=$_GET;
        if(!isset($searchFieldArray['keyword']))
        {
          $searchFieldArray['keyword']='';
        }
        if($searchFieldArray['keyword']!='')
        {
          foreach($searchFieldArray as $key=>$value)
          {
            if($key!='keyword')
            {
              $r=$this->getDtByAttrSd($key);
              $validSearchKey[$r[1].$key]=$searchFieldArray['keyword'];
              $fieldName[]=$r[0];
              $filedNameValue[$r[0].'/'.$key]=$searchFieldArray['keyword'];
            }
          }
        }
        else
        {
          foreach($searchFieldArray as $key=>$value)
          {
            if($value!='')
            {
              $r=$this->getDtByAttrSd($key);
              $validSearchKey[$r[1].$key]=$value;
              $fieldName[]=$r[0];
              $filedNameValue[$r[0].'/'.$key]=$value;
            }
          }
        }
    //  $this->pr($filedNameValue);
        if(!isset($filedNameValue))
        {
          redirect('portal/viewLibraryPage');
        }
        else
        {
          $data['fieldNameValue']=$filedNameValue;
        }

        $string=$this->searchAttributeString($validSearchKey);

        $data['reference_author']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc")->result();
        $data['reference'] = $this->db->query("SELECT r.* from reference r
         where $string order by r.Title desc

         ")->result();
        $data['reference_count'] = $this->db->query("SELECT r.* from reference r
         where $string order by r.Title desc
         ")->result();
       // $data["links"]                  = $this->pagination->create_links();

        if($searchFieldArray['keyword']!='')
        {
          $subUrl='';
          $i=0;
          $n=count($searchFieldArray);
          foreach($searchFieldArray as $row=> $val)
          {
            if($i<$n-1)
            {
              $subUrl.=$row.'='.$searchFieldArray['keyword'].'&';
            }
            else
            {
              $subUrl.=$row.'='.$searchFieldArray['keyword'];
            }
            $i++;

          }
          $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          $pieces = explode("?", $url);
          $urlTail=$pieces[1];
          $url=str_ireplace($urlTail,$subUrl,$url);
          $keyWord=$searchFieldArray['keyword'];
          $removeString="keyword=$keyWord&";
          $data['actualUrl']=str_replace($removeString,'',$url);
        }
        else
        {
          $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          $data['actualUrl']=$url;
        }
      }
      else
      {
        redirect('portal/viewLibraryPage');
      }
      $data['content_view_page']      = 'portal/viewLibraryPage';
      $string=base64_encode($string);
      $string= str_replace("=","abyz",$string);
      $data['string']=$string;
       //$data["searchType"]=2;
       //$data["searchType"]=3;
       //$data["searchType"]=4;
      $this->template->display_portal($data);
    }







  /*
   * @methodName search_allometricequation_tax()
   * @access public
   * @param  none
   * @return Allometric Equation taxonomy wise Search view page
   */
  public function search_allometricequation_tax()
  {

//var_dump($_POST);//exit;

    $Genus   = $this->input->post('Genus');
    $Family   = $this->input->post('Family');
    $Species   = $this->input->post('Species');




     //  $Family = $this->input->post('Family');
    $searchFields=array(
      'f.Family'=>$Family,

      'g.Genus'=>$Genus,
      's.Species'=>$Species
    );



      // echo "<pre>";
      // print_r($searchFields);
      // $where='';
      // if($Family !=''){
      //     $where .=" f.Family LIKE '%$Family%' ";
      // }else if($Species !=''){
      //     $where .=" s.Species LIKE '%$Species%' ";
      // }
      // else if($Genus !=''){
      //     $where .=" g.Genus LIKE '%$Genus%' ";
      // }
    if(!empty($ID_AE))
    {
      $string="a.ID_AE=$ID_AE";
    }
    else
    {
      $string=$this->searchAttributeString($searchFields);
    }



    if(!empty($string))
    {
      $this->session->set_userdata('aeSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('aeSearchString');
    }

    if(!empty($Species) || !empty($Family) || !empty($Genus))
    {
      $this->session->set_userdata('aeSearchStringSpecies', $Species);

      $this->session->set_userdata('aeSearchStringFamily', $Family);
      $this->session->set_userdata('aeSearchStringGenus', $Genus);

    }

    else
    {
      $Species=$this->session->userdata('aeSearchStringSpecies');

      $Family=$this->session->userdata('aeSearchStringFamily');
      $Genus=$this->session->userdata('aeSearchStringGenus');

    }


    $this->load->library('pagination');
    $config             = array();
      // $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_tax/".$string;
    $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_tax";
      //$total_ef           = $this->db->count_all("ae");

      //$config["total_rows"] = $total_ef;
    $total_ae=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Genus
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     order by a.ID_AE desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_ae;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
    $config['last_link']       = 'Last';
    $config['uri_protocol'] = 'AUTO';
    $config['url_suffix'] = '.html';
      // 'suffix' => '?' . http_build_query($_GET, '', "&")
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['allometricEquationView'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Genus
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     order by a.ID_AE desc LIMIT $limit OFFSET $page
     ")->result();


    $data['allometricEquationView_count'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Genus
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     order by a.ID_AE desc
     ")->result();

     // $viewdata['search_result_count'] = count($data['allometricEquationView'] );
    $data["links"]                  = $this->pagination->create_links();
    $data["searchType"]=2;

    $data['Species']=$Species;
    $data['Family']=$Family;
    $data['Genus']=$Genus;
    $data['content_view_page']      = 'portal/allometricEquationPage';
    $this->template->display_portal($data);

  }


  public function search_allometricequation_all($url = NULL,$removedAttr=NULL)
  {

   if($url==NULL)
   {
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $data['currentUrl']=$currentUrl;
  }


//var_dump($_POST);//exit;

  $Genus   = $this->input->get('Genus');
  $Family   = $this->input->get('Family');
  $Species   = $this->input->get('Species');
  $District  = $this->input->get('District');
  $EcoZones = $this->input->get('EcoZones');
  $Division = $this->input->get('Division');
  $Zones = $this->input->get('Zones');
  $Reference = $this->input->get('Reference');
  $Author    = $this->input->get('Author');
  $Year      = $this->input->get('Year');
  $ID_AE   = $this->input->get('ID_AE');
  $keyword = $this->input->get('keyword');

  $searchFields=array(
    'f.Family'=>$Family,
    'g.Genus'=>$Genus,
    's.Species'=>$Species,
    'dis.District'=>$District,
    'eco.EcoZones'=>$EcoZones,
    'zon.Zones'=>$Zones,
    'd.Division'=>$Division,
    'ref.Reference'=>$Reference,
    'ref.Author'=>$Author,
    'ref.Year'=>$Year,
    'a.ID_AE'=>$ID_AE

  );




  if(!empty($ID_AE))
  {
    $string="a.ID_AE=$ID_AE";
  }
  else
  {
    $string=$this->searchAttributeString($searchFields);
  }



  if(!empty($string))
  {
    $this->session->set_userdata('aeAllSearchString', $string);
  }
  else
  {
    $string=$this->session->userdata('aeAllSearchString');
  }

  if(!empty($keyword)||!empty($ID_AE)|| !empty($Species) || !empty($Family) || !empty($Genus) || !empty($District) ||
    !empty($EcoZones) || !empty($Division) || !empty($Zones)
    ||!empty($Reference) || !empty($Author) || !empty($Year) )
  {
    $this->session->set_userdata('aeSearchStringSpecies', $Species);
    $this->session->set_userdata('aeSearchStringFamily', $Family);
    $this->session->set_userdata('aeSearchStringGenus', $Genus);
    $this->session->set_userdata('aeSearchStringDis', $District);
    $this->session->set_userdata('aeSearchStringEco', $EcoZones);
    $this->session->set_userdata('aeSearchStringZone', $Zones);
    $this->session->set_userdata('aeSearchStringDiv', $Division);
    $this->session->set_userdata('aeSearchStringRef', $Reference);
    $this->session->set_userdata('aeSearchStringAuth', $Author);
    $this->session->set_userdata('aeSearchStringYear', $Year);
    $this->session->set_userdata('aeSearchStringKeyword', $keyword);
    $this->session->set_userdata('aeSearchStringAE', $ID_AE);

  }

  else
  {
    $Species=$this->session->userdata('aeSearchStringSpecies');
    $Family=$this->session->userdata('aeSearchStringFamily');
    $Genus=$this->session->userdata('aeSearchStringGenus');
    $District=$this->session->userdata('aeSearchStringDis');
    $EcoZones=$this->session->userdata('aeSearchStringEco');
    $Zones=$this->session->userdata('aeSearchStringZone');
    $Division=$this->session->userdata('aeSearchStringDiv');
    $Reference=$this->session->userdata('aeSearchStringRef');
    $Author=$this->session->userdata('aeSearchStringAuth');
    $Year=$this->session->userdata('aeSearchStringYear');
    $keyword=$this->session->userdata('aeSearchStringKeyword');
    $Species=$this->session->userdata('aeSearchStringAE');

  }


  $this->load->library('pagination');
  $config             = array();
      // $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_tax/".$string;
  $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_all";
      //$total_ef           = $this->db->count_all("ae");

      //$config["total_rows"] = $total_ef;
  $total_ae=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
   LEFT JOIN species s ON a.Species=s.ID_Species
   LEFT JOIN family f ON a.Family=f.ID_Family
   LEFT JOIN genus g ON a.Genus=g.ID_Genus
   LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
   LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
   LEFT JOIN division d ON a.Division=d.ID_Division
   LEFT JOIN district dis ON a.District =dis.ID_District
   LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
   LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
   where $string
   order by a.ID_AE desc
   ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
  $config["total_rows"] =$total_ae;
      // $config["total_rows"] = 800;

  $config["per_page"]        = 20;
  $config["uri_segment"]     = 3;
  $limit                     = $config["per_page"] = 20;
      //pagination style start
  $config['full_tag_open']   = '<ul class="pagination">';
  $config['full_tag_close']  = '</ul>';
  $config['prev_link']       = '&lt;';
  $config['prev_tag_open']   = '<li>';
  $config['prev_tag_close']  = '</li>';
  $config['next_link']       = '&gt;';
  $config['next_tag_open']   = '<li>';
  $config['next_tag_close']  = '</li>';
  $config['cur_tag_open']    = '<li class="current"><a href="#">';
  $config['cur_tag_close']   = '</a></li>';
  $config['num_tag_open']    = '<li>';
  $config['num_tag_close']   = '</li>';
  $config['first_tag_open']  = '<li>';
  $config['first_tag_close'] = '</li>';
  $config['last_tag_open']   = '<li>';
  $config['last_tag_close']  = '</li>';
  $config['first_link']      = 'First';
  $config['last_link']       = 'Last';
  $config['last_link']       = 'Last';
  $config['uri_protocol'] = 'AUTO';
  $config['url_suffix'] = '.html';
      // 'suffix' => '?' . http_build_query($_GET, '', "&")
      //pagination style end
  $this->pagination->initialize($config);
  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

  $data['allometricEquationView'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
   LEFT JOIN species s ON a.Species=s.ID_Species
   LEFT JOIN family f ON a.Family=f.ID_Family
   LEFT JOIN genus g ON a.Genus=g.ID_Genus
   LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
   LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
   LEFT JOIN division d ON a.Division=d.ID_Division
   LEFT JOIN district dis ON a.District =dis.ID_District
   LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
   LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
   where $string
   order by a.ID_AE desc LIMIT $limit OFFSET $page
   ")->result();


  $data['allometricEquationView_count'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
   LEFT JOIN species s ON a.Species=s.ID_Species
   LEFT JOIN family f ON a.Family=f.ID_Family
   LEFT JOIN genus g ON a.Genus=g.ID_Genus
   LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
   LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
   LEFT JOIN division d ON a.Division=d.ID_Division
   LEFT JOIN district dis ON a.District =dis.ID_District
   LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
   LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
   where $string
   order by a.ID_AE desc
   ")->result();

     // $viewdata['search_result_count'] = count($data['allometricEquationView'] );
  $data["links"]                  = $this->pagination->create_links();
      // $data["searchType"]=2;
      // $data["searchType"]=3;
      // $data["searchType"]=4;
  $data['keyField'] = $searchFields;
  $data['Species']=$Species;
  $data['Family']=$Family;
  $data['Genus']=$Genus;
  $data['District']=$District;
  $data['Division']=$Division;
  $data['EcoZones']=$EcoZones;
  $data["Reference"]=$Reference;
  $data["Author"]=$Author;
  $data["Year"]=$Year;
  $data['keyword']=$keyword;
  $str = $this->uri->segment(5);
  $data['ID_AE']=$ID_AE;
  $data['content_view_page']      = 'portal/allometricEquationPage';
  $this->template->display_portal($data);

}

public function remove_family()
{
  $prefix = '&Family=Myrsinaceae';
  $str = $this->uri->segment(5);

  if (substr($str, 0, strlen($prefix)) == $prefix) {
   $str = substr($str, strlen($prefix));
 }
      //  $data['content_view_page']      = 'portal/allometricEquationPage';
      // $this->template->display_portal($data);

      //echo $str;exit();
}



public function search_allometricequation_loc()
{
  $District  = $this->input->post('District');
  $EcoZones = $this->input->post('EcoZones');
  $Division = $this->input->post('Division');
  $Zones = $this->input->post('Zones');
  $searchFields=array(
    'dis.District'=>$District,
    'eco.EcoZones'=>$EcoZones,
    'zon.Zones'=>$Zones,
    'd.Division'=>$Division
  );
  $string=$this->searchAttributeString($searchFields);

  if(!empty($string))
  {
    $this->session->set_userdata('aeLocSearchString', $string);
  }
  else
  {
    $string=$this->session->userdata('aeLocSearchString');
  }

  if(!empty($District) || !empty($EcoZones) || !empty($Division) || !empty($Zones))
  {
    $this->session->set_userdata('aeSearchStringDis', $District);
    $this->session->set_userdata('aeSearchStringEco', $EcoZones);
    $this->session->set_userdata('aeSearchStringZone', $Zones);
    $this->session->set_userdata('aeSearchStringDiv', $Division);

  }

  else
  {
    $District=$this->session->userdata('aeSearchStringDis');
    $EcoZones=$this->session->userdata('aeSearchStringEco');
    $Zones=$this->session->userdata('aeSearchStringZone');
    $Division=$this->session->userdata('aeSearchStringDiv');


  }


  $this->load->library('pagination');
  $config             = array();
  $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_loc";
  $total_ae=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
   LEFT JOIN species s ON a.Species=s.ID_Species
   LEFT JOIN family f ON a.Family=f.ID_Family
   LEFT JOIN genus g ON a.Genus=g.ID_Genus
   LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
   LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
   LEFT JOIN division d ON a.Division=d.ID_Division
   LEFT JOIN district dis ON a.District =dis.ID_District
   LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
   LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
   where $string
   order by a.ID_AE desc
   ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
  $config["total_rows"] =$total_ae;
      // $config["total_rows"] = 800;

  $config["per_page"]        = 20;
  $config["uri_segment"]     = 3;
  $limit                     = $config["per_page"] = 20;
      //pagination style start
  $config['full_tag_open']   = '<ul class="pagination">';
  $config['full_tag_close']  = '</ul>';
  $config['prev_link']       = '&lt;';
  $config['prev_tag_open']   = '<li>';
  $config['prev_tag_close']  = '</li>';
  $config['next_link']       = '&gt;';
  $config['next_tag_open']   = '<li>';
  $config['next_tag_close']  = '</li>';
  $config['cur_tag_open']    = '<li class="current"><a href="#">';
  $config['cur_tag_close']   = '</a></li>';
  $config['num_tag_open']    = '<li>';
  $config['num_tag_close']   = '</li>';
  $config['first_tag_open']  = '<li>';
  $config['first_tag_close'] = '</li>';
  $config['last_tag_open']   = '<li>';
  $config['last_tag_close']  = '</li>';
  $config['first_link']      = 'First';
  $config['last_link']       = 'Last';
      //pagination style end
  $this->pagination->initialize($config);
  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

  $data['allometricEquationView'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
   LEFT JOIN species s ON a.Species=s.ID_Species
   LEFT JOIN family f ON a.Family=f.ID_Family
   LEFT JOIN genus g ON a.Genus=g.ID_Genus
   LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
   LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
   LEFT JOIN division d ON a.Division=d.ID_Division
   LEFT JOIN district dis ON a.District =dis.ID_District
   LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
   LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
   where  $string
   order by a.ID_AE desc LIMIT $limit OFFSET $page
   ")->result();


  $data['allometricEquationView_count'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
   LEFT JOIN species s ON a.Species=s.ID_Species
   LEFT JOIN family f ON a.Family=f.ID_Family
   LEFT JOIN genus g ON a.Genus=g.ID_Genus
   LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
   LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
   LEFT JOIN division d ON a.Division=d.ID_Division
   LEFT JOIN district dis ON a.District =dis.ID_District
   LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
   LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
   where  $string

   ")->result();
      // echo "<pre>";
      // print_r($k);
      // exit;
  $data["links"]                  = $this->pagination->create_links();
  $data["searchType"]=3;
  $data['District']=$District;
  $data['Division']=$Division;
  $data['EcoZones']=$EcoZones;

      //$this->pr($m)
  $data['Zones'] = $Zones;
     // $data['Zones'] = $this->Forestdata_model->get_all_zones();
      //print_r($data['Zones']);exit;
  $data['content_view_page']      = 'portal/allometricEquationPage';
  $this->template->display_portal($data);

}



function ajax_get_division() {
      //$ID_Division = $_POST['Division'];
 $ID_Division = $this->input->post('Division');
 $query = $this->db->query("SELECT a.ID_District,a.District FROM District a,division b
   WHERE a.DIVISION=b.ID_Division AND b.DIVISION='$ID_Division'")->result();
       // $query = $this->utilities->findAllByAttribute('district', array("DIVISION" => $ID_Division));
 $returnVal = '<option value = "">Select one</option>';
 if (!empty($query)) {
  foreach ($query as $row) {
    $returnVal .= '<option value = "' .$row->District . '">' . $row->District . '</option>';
  }
}
echo $returnVal;
}

function up_thana_by_dis_id() {
  $DISTNAME = $_POST['District'];
  $divi             = explode(",", $DISTNAME);
  $second_value_divi   = $divi[1];
  $query = $this->utilities->findAllByAttribute('upazilla', array("DISTNAME" => $second_value_divi));
      //var_dump($query);exit;
  $returnVal = '<option value = "">Select one</option>';
  if (!empty($query)) {
    foreach ($query as $row) {
      $returnVal .= '<option value = "' .$row->UPZ_CODE_1. ','. $row->THANAME . '">' . $row->THANAME . '</option>';
    }
  }
  echo $returnVal;
}


function up_union_by_dis_id() {
  $THANAME = $_POST['THANAME'];
  $divi             = explode(",", $THANAME);
  $second_value_divi   = $divi[1];

  $query = $this->utilities->findAllByAttribute('union', array("THANAME" => $second_value_divi));
  $returnVal = '<option value = "">Select one</option>';
  if (!empty($query)) {
    foreach ($query as $row) {
      $returnVal .= '<option value = "' . $row->UNI_CODE_1 . '">' . $row->UNINAME . '</option>';
    }
  }
  echo $returnVal;
}




  /*
   * @methodName search_allometricequation_ref()
   * @access public
   * @param  none
   * @return Allometric Equation Reference wise Search view page
   */
  public function search_allometricequation_ref()
  {
    $Reference = $this->input->post('Reference');
    $Author    = $this->input->post('Author');
    $Year      = $this->input->post('Year');
    $searchFields=array(
      'ref.Reference'=>$Reference,
      'ref.Author'=>$Author,
      'ref.Year'=>$Year
    );
    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('aeRefSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('aeRefSearchString');
    }
    if(!empty($Reference) || !empty($Author) || !empty($Year))
    {
      $this->session->set_userdata('aeSearchStringRef', $Reference);
      $this->session->set_userdata('aeSearchStringAuth', $Author);
      $this->session->set_userdata('aeSearchStringYear', $Year);

    }

    else
    {
      $Reference=$this->session->userdata('aeSearchStringRef');
      $Author=$this->session->userdata('aeSearchStringAuth');
      $Year=$this->session->userdata('aeSearchStringYear');

    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_ref";
    $total_ae=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Genus
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN bd_aez1988 eco ON e.WWF_Eco_zone =eco.MAJOR_AEZ
     where $string
     order by a.ID_AE desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_ae;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['allometricEquationView'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Genus
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by a.ID_AE desc LIMIT $limit OFFSET $page
     ")->result();

    $data['allometricEquationView_count'] = $this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
     LEFT JOIN species s ON a.Species=s.ID_Species
     LEFT JOIN family f ON a.Family=f.ID_Family
     LEFT JOIN genus g ON a.Genus=g.ID_Genus
     LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON a.Division=d.ID_Division
     LEFT JOIN district dis ON a.District =dis.ID_District
     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data["searchType"]=4;
    $data["Reference"]=$Reference;
    $data["Author"]=$Author;
    $data["Year"]=$Year;
    $data['content_view_page']      = 'portal/allometricEquationPage';
    $this->template->display_portal($data);

  }



  /*
   * @methodName speciesData()
   * @access public
   * @param  none
   * @return Species List page
   */

  public function speciesData()
  {
    $data['family_details']    = $this->db->query("SELECT f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
      FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT,(SELECT count(ID) FROM rd as rd WHERE rd.Family_ID=f.ID_Family)
      as RDCOUNT,(SELECT count(ID_AE) FROM ae as ae LEFT JOIN species_group sr ON ae.species=sr.Speciesgroup_ID LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
      as AECOUNT,(SELECT count(ID_WD) FROM wd as wd WHERE wd.ID_family=f.ID_Family)
      as WDCOUNT,(SELECT COUNT(e.ID_EF) FROM ef e left join species s ON e.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family) EFCOUNT1,(SELECT count(ID_EF) FROM ef as ef LEFT JOIN species_group sr ON ef.Species=sr.Speciesgroup_ID LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
      as EFCOUNT1
      from family as f ORDER BY f.Family
      ")->result();

    $data['total_genus_species']    = $this->db->query("select count(*) total_family,(select count(*)  from species) total_species,(select count(*)  from genus) total_genus from family
      ")->row();
    $data['content_view_page'] = 'portal/speciesData';
    $this->template->display_portal($data);
  }




  /*
   * @methodName allometricEquationData()
   * @access public
   * @param  none
   * @return Allometric EquationData List page
   */

  public function allometricEquationData($specis_id)
  {
    $data['allometricEquationData'] = $this->Forestdata_model->get_allometric_equation($specis_id);
    $data['content_view_page']      = 'portal/allometricEquation';
    $this->template->display_portal($data);
  }


  public function allometricEquationDataJson($specis_id)
  {
    $data['allometricEquationDataJson'] = $this->Forestdata_model->get_allometric_equation_list_json($specis_id);

  }


  /*
   * @methodName allometricEquationView()
   * @access public
   * @param  none
   * @return Allometric Equation Menu page
   */

  public function allometricEquationViewjson1()
  {
    $data['allometricEquationViewJson'] = $this->Forestdata_model->get_allometric_equation_json();
      //$data['content_view_page']      = 'portal/allometricEquationPage';
      //$this->template->display_portal($data);
  }

  public function allometricEquationViewjson($string)
  {
    if($string==1)
    {
      $allometricEquationViewJson=$this->db->query("SELECT * from __view_allometric_equ_csv_data a where $string");
    }
    else
    {
      $string= str_replace("abyz","=",$string);
      $string=base64_decode($string);

      $allometricEquationViewJson=$this->db->query("SELECT * from __view_allometric_equ_csv_data a
       where $string");
    }


    header('Content-disposition: attachment; filename=Allometric_Equation.json');
    header('Content-type: application/json');
  // echo json_encode($allometricEquationViewJson->result()),'<br />';
    echo json_encode($allometricEquationViewJson->result(), JSON_PRETTY_PRINT);
  }



        /*
   * @methodName allometricEquationViewcsv()
   * @access public
   * @param  none
   * @return Allometric Equation CSV Menu page
   */


        public function allometricEquationViewcsv($string)
        {
          if($string==1)
          {
            $allometricEquationViewcsv=$this->db->query("SELECT * from __view_allometric_equ_csv_data a where $string")->result_array();
          }
          else
          {
            $string= str_replace("abyz","=",$string);
            $string=base64_decode($string);
            $allometricEquationViewcsv=$this->db->query("SELECT * from __view_allometric_equ_csv_data a
             where $string")->result_array();
          }


//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
          header("Content-type: application/csv");
          header("Content-Disposition: attachment; filename=\"Allometric Equation".".csv\"");
          header("Pragma: no-cache");
          header("Expires: 0");
          $handle = fopen('php://output', 'w');
          fputcsv($handle, array('ID_AE','ID_RD', 'Population', 'Tree_type','Vegetation_type','X','Unit_X','Z'
            ,'Unit_Z','W','Unit_W','U ','Unit_U',' V','Unit_V',' Mean_X',' Min_X',' Max_X',' Mean_Z','Min_Z','Max_Z','Mean_W','Min_W','Max_W','Output'
            ,'Output_TR','Unit_Y','Min_age','Max_age',' Av_age','B','Bd','Bg','Bt',' L','Rb','Rf','Rm','S','T','F','Equation','Equation_VarNames','Sample_size','Top_dob','Top_girth_over_bark',' Stump_height','Reference','Author','Year','Title','Journal','Volume','Issue','Page','URL','PDF_label','Species','Family','Genus','location_name','LatDD','LongDD','Division','District','THANAME','UNINAME','FAOBiomes','AEZ_NAME',  'Zones','R2','R2_Adjusted','Corrected_for_bias',' MSE','RMSE'
            ,'SEY','SEE','AIC','FI','Bias_correction',' Ratio_equation','Segmented_equation','Contributor_name','Operator_name','email_contact','Remark','Verified'));
          $i = 1;
          foreach ($allometricEquationViewcsv as $data) {
            fputcsv($handle, array($data["ID_AE"], $data["ID_RD"], $data["Population"], $data["Tree_type"], $data["Vegetation_type"],$data["X"],$data["Unit_X"], $data["Z"], $data["Unit_Z"], $data["W"], $data["Unit_W"], $data["U"],
             $data["Unit_U"], $data["V"], $data["Unit_V"], $data["Mean_X"],$data["Min_X"],$data["Max_X"],$data["Mean_Z"],$data["Min_Z"],$data["Max_Z"],$data["Mean_W"],$data["Min_W"]
             ,$data["Max_W"],$data["Output"],$data["Output_TR"],$data["Unit_Y"],$data["Min_age"],$data["Max_age"],$data["Av_age"],$data["B"],$data["Bd"],$data["Bg"],$data["Bt"],$data["L"],$data["Rb"]
             ,$data["Rf"],$data["Rm"],$data["S"],$data["T"],$data["F"],$data["Equation"],$data["Equation_VarNames"],$data["Sample_size"],$data["Top_dob"],$data["Top_girth_over_bark"],$data["Stump_height"]
             ,$data["Reference"],$data["Author"],$data["Year"],$data["Title"],$data["Journal"],$data["Volume"],$data["Issue"],$data["Page"],$data["URL"],$data["PDF_label"],$data["Species"],$data["Family"],$data["Genus"],$data["location_name"],$data["LatDD"],$data["LongDD"],$data["Division"],$data["District"],$data["THANAME"],$data["UNINAME"],$data["FAOBiomes"],$data["AEZ_NAME"],$data["Zones"],$data["R2"],$data["R2_Adjusted"],$data["Corrected_for_bias"],$data["MSE"],$data["RMSE"],$data["SEY"],$data["SEE"],$data["AIC"] ,$data["FI"],$data["Bias_correction"],$data["Ratio_equation"],$data["Segmented_equation"],$data["Contributor_name"],$data["Operator_name"],$data["email_contact"],$data["Remark"],$data["Verified"]));
            $i++;
          }
          fclose($handle);
          exit;
        }


        public function allometricEquationViewcsv1()
        {
          $allometricEquationViewcsv=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
           LEFT JOIN species s ON a.Species=s.ID_Species
           LEFT JOIN family f ON a.Family=f.ID_Family
           LEFT JOIN genus g ON a.Genus=g.ID_Genus
           LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
           LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
           LEFT JOIN division d ON a.Division=d.ID_Division
           LEFT JOIN district dis ON a.District =dis.ID_District
           LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
           LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
           order by a.ID_AE asc")->result_array();
//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
          header("Content-type: application/csv");
          header("Content-Disposition: attachment; filename=\"Allometric Equation".".csv\"");
          header("Pragma: no-cache");
          header("Expires: 0");
          $handle = fopen('php://output', 'w');
          fputcsv($handle, array('ID_AE','ID_RD', 'Population', 'Tree_type','Vegetation_type','Country','Division','District','Upazila','Union'
            ,'location_notes','Latitude','Longitude','BFI_zone','FAO_biome','WWF_Eco_zone','X','Unit_X','Z'
            ,'Unit_Z','W','Unit_W','U ','Unit_U',' V','Unit_V',' Mean_X',' Min_X',' Max_X',' Mean_Z','Min_Z','Max_Z','Mean_W','Min_W','Max_W','Output'
            ,'Output_TR','Unit_Y','Min_age','Max_age',' Av_age','B','Bd','Bg','Bt',' L','Rb','Rf','Rm','S','T','F','Family','Genus','Species','Subspecies','Species_local_name_latin'
            ,'Species_local_name_iso','Equation','Sample_size','Top_dob','Top_girth_over_bark',' Stump_height','Reference','Label','R2','R2_Adjusted','Corrected_for_bias',' MSE','RMSE'
            ,'SEY','SEE','AIC','FI','Bias_correction',' Ratio_equation','Segmented_equation','Contributor','Operator','Remark','Contact','  Verified'));
          $i = 1;
          foreach ($allometricEquationViewcsv as $data) {
            fputcsv($handle, array($data["ID_AE"], $data["ID_RD"], $data["Population"], $data["Tree_type"], $data["Vegetation_type"], $data["Country"], $data["Division"]
              , $data["District"], $data["Upazila"], $data["Union"], $data["location_notes"], $data["Latitude"], $data["Longitude"], $data["BFI_zone"], $data["FAO_biome"]
              , $data["WWF_Eco_zone"], $data["X"], $data["Unit_X"], $data["Z"], $data["Unit_Z"], $data["W"], $data["Unit_W"], $data["U"],
              $data["Unit_U"], $data["V"], $data["Unit_V"], $data["Mean_X"],$data["Min_X"],$data["Max_X"],$data["Mean_Z"],$data["Min_Z"],$data["Max_Z"],$data["Mean_W"],$data["Min_W"]
              ,$data["Max_W"],$data["Output"],$data["Output_TR"],$data["Unit_Y"],$data["Min_age"],$data["Max_age"],$data["Av_age"],$data["B"],$data["Bd"],$data["Bg"],$data["Bt"],$data["L"],$data["Rb"]
              ,$data["Rf"],$data["S"],$data["T"],$data["F"],$data["Family"],$data["Genus"],$data["Species"],$data["Subspecies"],$data["Species_local_name_latin"],$data["Species_local_name_iso"],$data["Equation"],$data["Sample_size"],$data["Top_dob"],$data["Top_girth_over_bark"],$data["Stump_height"]
              ,$data["Reference"],$data["Label"],$data["R2"],$data["R2_Adjusted"],$data["Corrected_for_bias"],$data["MSE"],$data["RMSE"],$data["SEY"],$data["SEE"],$data["AIC"] ,$data["FI"],$data["Bias_correction"],$data["Ratio_equation"],$data["Segmented_equation"],$data["Contributor"],$data["Operator"],$data["Remark"],$data["Contact"],$data["Verified"]));
            $i++;
          }
          fclose($handle);
          exit;
        }


        /*
   * @methodName speciesListViewcsv()
   * @access public
   * @param  none
   * @return Species List CSV Menu page
   */


        public function speciesListViewcsv()
        {
          $speciesListViewcsv=$this->db->query("SELECT * FROM (SELECT CONCAT(f.Family,' ',s.Species) NAME,s.ID_Species FROM species s
            LEFT JOIN family f ON s.ID_Family=f.ID_Family order by s.ID_Species ASC
          ) m")->result_array();
//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
          header("Content-type: application/csv");
          header("Content-Disposition: attachment; filename=\"Species List".".csv\"");
          header("Pragma: no-cache");
          header("Expires: 0");
          $handle = fopen('php://output', 'w');
          fputcsv($handle, array('ID_Species',' NAME'));
          $i = 1;
          foreach ($speciesListViewcsv as $data) {
            fputcsv($handle, array($data["ID_Species"], $data["NAME"]));
            $i++;
          }
          fclose($handle);
          exit;
        }




    /*
   * @methodName biomassExpansionFacViewcsv()
   * @access public
   * @param  none
   * @return Biomass Expansion Factor CSV Menu page
   */


    public function biomassExpansionFacViewcsv($string)
    {

      if($string==1)
      {
        $biomassExpansionFacView=$this->db->query("SELECT * from __view_ef_data_csv_data w where $string")->result_array();
      }
      else
      {
        $string= str_replace("abyz","=",$string);
        $string=base64_decode($string);

        $biomassExpansionFacView=$this->db->query("SELECT * from __view_ef_data_csv_data w where $string")->result_array();
      }

//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
      header("Content-type: application/csv");
      header("Content-Disposition: attachment; filename=\"EmissionFactor".".csv\"");
      header("Pragma: no-cache");
      header("Expires: 0");
      $handle = fopen('php://output', 'w');
      fputcsv($handle, array('ID_EF',' EmissionFactor','Age_yr','Height_m','Volume_m3_ha','Basal_m2_ha',' Value','Unit'
        ,'ID_EF_IPCC','Reference','Lower_Confidence_Limit','Upper_Confidence_Limit','Type_of_Parameter','group_location','location_name','LatDD','LongDD','Division  ',' District  ',' THANAME',' UNINAME',' FAOBiomes',' Reference',' Author',' Year',' Title',' Journal',' Volume',' Issue',' Page',' URL',' PDF_label',' Family',' Genus',' Species',' AEZ_NAME',' Zones','Contributor_name ','Operator_name ','email_contact '));
      $i = 1;
      foreach ($biomassExpansionFacView as $data) {
        fputcsv($handle, array($data["ID_EF"], $data["EmissionFactor"],$data["Age_yr"], $data["Height_m"], $data["Volume_m3_ha"]
          , $data["Basal_m2_ha"], $data["Value"], $data["Unit"], $data["ID_EF_IPCC"], $data["Reference"], $data["Lower_Confidence_Limit"], $data["Upper_Confidence_Limit"], $data["Type_of_Parameter"]
          , $data["group_location"], $data["location_name"],$data["LatDD"],$data["LongDD"],$data["Division"], $data["District"], $data["THANAME"], $data["UNINAME"], $data["FAOBiomes"],$data["Reference"],$data["Author"],$data["Year"],$data["Title"],$data["Journal"],$data["Volume"],$data["Issue"],$data["Page"],$data["URL"],$data["PDF_label"], $data["Family"],
          $data["Genus"],$data["Species"], $data["AEZ_NAME"], $data["Zones"],$data["Contributor_name"],$data["Operator_name"],$data["email_contact"]));
        $i++;
      }
      fclose($handle);
      exit;
    }

    public function biomassExpansionFacViewjson1()
    {
      $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomass_expansion_factor_json();
      //$data['content_view_page']      = 'portal/allometricEquationPage';
      //$this->template->display_portal($data);
    }



    public function biomassExpansionFacViewjson($string)
    {

      if($string==1)
      {
        $biomassExpansionFacView=$this->db->query("SELECT * from __view_ef_data_csv_data w where $string");
      }
      else
      {
        $string= str_replace("abyz","=",$string);
        $string=base64_decode($string);

        $biomassExpansionFacView=$this->db->query("SELECT * from __view_ef_data_csv_data w where $string");
      }

//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
      header('Content-disposition: attachment; filename=EmissionFactor.json');
      header('Content-type: application/json');
   //echo json_encode($biomassExpansionFacView->result()),'<br />';
      echo json_encode($biomassExpansionFacView->result(), JSON_PRETTY_PRINT);
    }







  /*
   * @methodName allometricEquationView()
   * @access public
   * @param  none
   * @return Allometric Equation Menu page
   */


  public function allometricEquationView()
  {

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() .  "index.php/portal/allometricEquationView";
    $total_ef           = $this->db->count_all("ae");

    $config["total_rows"] = $total_ef;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $limit                     = $config["per_page"];
    $config["uri_segment"] = 3;
      //$config["num_links"] = round($total_ef );
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      // //pagination style end
    $this->pagination->initialize($config);
    $data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid($limit,$page);
    $data["links"]                  = $this->pagination->create_links();
    $data['content_view_page']      = 'portal/allometricEquationPage';
    $this->template->display_portal($data);
  }




      /*
   * @methodName allometricEquationViewSpeciesData()
   * @access public
   * @param  none
   * @return Allometric Equation Menu page
   */


      public function allometricEquationViewSpeciesData($speciesNameEncode)
      {   $specis_id='';
      $speciesNameDecode=base64_decode($speciesNameEncode);
      $this->load->library('pagination');
      $config             = array();
      $config["base_url"] = base_url() .  "index.php/portal/allometricEquationViewSpeciesData/".$specis_id;

      $total_ae=$this->db->query("SELECT * FROM __view_allometric_eqn_search_tbl 
        ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
      $config["total_rows"] =$total_ae;
      // $config["total_rows"] = 800;

      $config["per_page"]        = 20;
      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $limit                     = $config["per_page"];
      $config["uri_segment"] = 4;

      $this->pagination->initialize($config);
      $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(c.output)) OUTPUT,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
      fnc_ae_species_data(a.LatDD,a.LongDD) species_desc FROM location a
      LEFT JOIN group_location b ON a.ID_Location=b.location_id
      LEFT JOIN ae c ON b.group_id=c.location_group
      LEFT JOIN species d ON c.Species=d.ID_Species
      LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
      WHERE c.ID_AE IS NOT NULL
      GROUP BY LatDD,LongDD";
      $jsonQueryEncode=base64_encode($jsonQuery);
      $data['jsonQuery']=$jsonQueryEncode;
      $data['allometricEquationDatagrid'] = $this->Forestdata_model->get_allometric_equation_grid_Speciesdata($speciesNameDecode,$limit,$page);
      //print_r($data['allometricEquationDatagrid']);exit();
      $data["links"]                  = $this->pagination->create_links();
      $data['content_view_page']      = 'portal/allometricEquationPage';
      $string="Species like '%$speciesNameDecode%'";
      $string=base64_encode($string);
      $string= str_replace("=","abyz",$string);
      $data['string']=$string;
      $data['strs']=$string;
      $data['allometricEquationView_count'] = $this->db->query("SELECT * from __view_allometric_eqn_search_tbl a where Species like '%$speciesNameDecode%'
        ")->result();
      $this->template->display_portal($data);
    }



    /*
   * @methodName biomassExpansionFacView()
   * @access public
   * @param  none
   * @return Biomass Expension Factor Menu page
   */


    public function biomassExpansionFacView()
    {

      $this->load->library('pagination');
      $config             = array();
      $config["base_url"] = base_url() .  "index.php/portal/biomassExpansionFacView";
      $total_ef           = $this->db->count_all("ef");

      $config["total_rows"] = $total_ef;
      // $config["total_rows"] = 800;

      $config["per_page"]        = 20;
      //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $limit                     = $config["per_page"] = 20;
      $config["uri_segment"] = 3;
      //$config["num_links"] = round($total_ef );
      //pagination style start
      $config['full_tag_open']   = '<ul class="pagination">';
      $config['full_tag_close']  = '</ul>';
      $config['prev_link']       = '&lt;';
      $config['prev_tag_open']   = '<li>';
      $config['prev_tag_close']  = '</li>';
      $config['next_link']       = '&gt;';
      $config['next_tag_open']   = '<li>';
      $config['next_tag_close']  = '</li>';
      $config['cur_tag_open']    = '<li class="current"><a href="#">';
      $config['cur_tag_close']   = '</a></li>';
      $config['num_tag_open']    = '<li>';
      $config['num_tag_close']   = '</li>';
      $config['first_tag_open']  = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open']   = '<li>';
      $config['last_tag_close']  = '</li>';
      $config['first_link']      = 'First';
      $config['last_link']       = 'Last';
      // //pagination style end
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      // ")->result();
      $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
      $data["links"]                  = $this->pagination->create_links();
      $data['content_view_page']      = 'portal/biomassExpansionFacView';
      $this->template->display_portal($data);
    }





   /*
   * @methodName biomassExpansionFacSpeciesView()
   * @access public
   * @param  none
   * @return Biomass Expension Factor Menu page
   */


   public function biomassExpansionFacSpeciesView($speciesNameEncode)
   {
    $specis_id='';
    $speciesNameDecode=base64_decode($speciesNameEncode);
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() .  "index.php/portal/biomassExpansionFacSpeciesView/".$specis_id;
    $total_ef=$this->db->query("SELECT * FROM __view_emission_fac_search_tbl  
      ")->num_rows();
      // print_r($this->db->last_query());exit;
      //echo $total_ef;exit;
    $config["total_rows"] =$total_ef;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;

    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $limit                     = $config["per_page"];
    $config["uri_segment"] = 4;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
    fnc_ef_species_data(a.LatDD,a.LongDD) species_desc FROM location a
    LEFT JOIN group_location b ON a.ID_Location=b.location_id
    LEFT JOIN ef c ON b.group_id=c.group_location
    LEFT JOIN species d ON c.Species=d.ID_Species
    LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
    WHERE c.ID_EF IS NOT NULL
    GROUP BY LatDD,LongDD";
    $jsonQueryEncode=base64_encode($jsonQuery);
    $data['jsonQuery']=$jsonQueryEncode;

      // ")->result();

    $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor_species($speciesNameDecode,$limit,$page);
    $data["links"]                  = $this->pagination->create_links();
    $data['content_view_page']      = 'portal/biomassExpansionFacView';

    $string="Species like '%$speciesNameDecode%'";
    $string=base64_encode($string);
    $string= str_replace("=","abyz",$string);
    $data['string']=$string;
    $data['strs']=$string;
    $data['biomassExpansionFacView_count'] = $this->db->query("SELECT * from __view_emission_fac_search_tbl e where Species like '%$speciesNameDecode%'
      ")->result();
    $this->template->display_portal($data);
  }




  /*
   * @methodName search_biomas_expansion_key()
   * @access public
   * @param  none
   * @return Biomass Expension Factor search key
   */


  public function search_biomas_expansion_key()
  {
    $keyword = $this->input->post('keyword');

    $searchFields=array(
      's.Species'=>$keyword,
      'dis.District'=>$keyword,
      'e.Value'=>$keyword,
      'e.EmissionFactor'=>$keyword,
      'e.latitude'=>$keyword,
      'e.longitude'=>$keyword,
      'r.Reference'=>$keyword,
      'r.Author'=>$keyword,
      'b.FAOBiomes'=>$keyword,
      'f.Family'=>$keyword,
      'g.Genus'=>$keyword,
      'r.Year'=>$keyword,
      'd.Division'=>$keyword

    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {

      $this->session->set_userdata('efkeySearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('efkeySearchString');
    }

    if(!empty($keyword))
    {
      $this->session->set_userdata('efSearchStringKeyword', $keyword);

    }

    else
    {
      $keyword=$this->session->userdata('efSearchStringKeyword');


    }




    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_key";
    $total_ef=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     order by e.ID_EF desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;


    $config["total_rows"] = $total_ef;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
      //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $limit                     = $config["per_page"] = 20;
    $config["uri_segment"] = 3;
      //$config["num_links"] = round($total_ef );
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      // //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      // ")->result();
      // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
    $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     order by e.ID_EF desc LIMIT $limit OFFSET $page
     ")->result();

    $data['biomassExpansionFacView_count'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     order by e.ID_EF desc

     ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data['keyword']=$keyword;
    $data['content_view_page']      = 'portal/biomassExpansionFacView';
    $this->template->display_portal($data);
  }




   /*
   * @methodName search_biomas_expansion_tax()
   * @access public
   * @param  none
   * @return Biomass Expension Factor search taxonomy
   */


   public function search_biomas_expansion_tax()
   {

    $Genus   = $this->input->post('Genus');
    $Family   = $this->input->post('Family');
    $Species = $this->input->post('Species');
    $searchFields=array(
      'f.Family'=>$Family,
      'g.Genus'=>$Genus,
      's.Species'=>$Species
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('efTaxSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('efTaxSearchString');
    }

    if(!empty($Species) || !empty($Family) || !empty($Genus))
    {
      $this->session->set_userdata('efSearchStringSpecies', $Species);
      $this->session->set_userdata('efSearchStringFamily', $Family);
      $this->session->set_userdata('efSearchStringGenus', $Genus);

    }

    else
    {
      $Species=$this->session->userdata('efSearchStringSpecies');
      $Family=$this->session->userdata('efSearchStringFamily');
      $Genus=$this->session->userdata('efSearchStringGenus');

    }


    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_tax";
    $total_ef=$this->db->query("SELECT e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by e.ID_EF desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_ef;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
      //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $limit                     = $config["per_page"] = 20;
    $config["uri_segment"] = 3;
      //$config["num_links"] = round($total_ef );
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      // //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      // ")->result();
      // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
    $data['biomassExpansionFacView'] = $this->db->query("SELECT e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by e.ID_EF desc LIMIT $limit OFFSET $page
     ")->result();

    $data['biomassExpansionFacView_count'] = $this->db->query("SELECT e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data["searchType"]=2;
    $data['Species']=$Species;
    $data['Family']=$Family;
    $data['Genus']=$Genus;
    $data['content_view_page']      = 'portal/biomassExpansionFacView';
    $this->template->display_portal($data);
  }




   /*
   * @methodName search_biomas_expansion_loc()
   * @access public
   * @param  none
   * @return Biomass Expension Factor search location
   */


   public function search_biomas_expansion_loc()
   {
    $Division  = $this->input->post('Division');
    $District  = $this->input->post('District');
    $EcoZones = $this->input->post('EcoZones');
    $Zones = $this->input->post('Zones');
    $FAOBiomes = $this->input->post('FAOBiomes');
    $searchFields=array(
      'dis.District'=>$District,
      'd.Division'=>$Division,
      'zon.Zones'=>$Zones,
      'b.FAOBiomes'=>$FAOBiomes,
      'eco.EcoZones'=>$EcoZones
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('eflocSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('eflocSearchString');
    }
    if(!empty($District) || !empty($EcoZones) || !empty($Division) || !empty($Zones)|| !empty($FAOBiomes))
    {
      $this->session->set_userdata('efSearchStringDis', $District);
      $this->session->set_userdata('efSearchStringEco', $EcoZones);
      $this->session->set_userdata('efSearchStringDiv', $Division);
      $this->session->set_userdata('efSearchStringzone', $Zones);
      $this->session->set_userdata('efSearchStringfao',$FAOBiomes);

    }

    else
    {
      $District=$this->session->userdata('efSearchStringDis');
      $EcoZones=$this->session->userdata('efSearchStringEco');
      $Division=$this->session->userdata('efSearchStringDiv');
      $Zones=$this->session->userdata('efSearchStringzone');
      $FAOBiomes=$this->session->userdata('efSearchStringfao');

    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_loc";
    $total_ef=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by e.ID_EF desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_ef;

    $config["per_page"]        = 20;
      //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $limit                     = $config["per_page"] = 20;
    $config["uri_segment"] = 3;
      //$config["num_links"] = round($total_ef );
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      // //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      // ")->result();
      // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
    $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by e.ID_EF desc LIMIT $limit OFFSET $page
     ")->result();

    $data['biomassExpansionFacView_count'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data["searchType"]=3;
    $data['District']=$District;
    $data['Division']=$Division;
    $data['EcoZones']=$EcoZones;
    $data['Zones']=$Zones;
    $data['FAOBiomes']=$FAOBiomes;
    $data['content_view_page']      = 'portal/biomassExpansionFacView';
    $this->template->display_portal($data);
  }








   /*
   * @methodName search_biomas_expansion_ref()
   * @access public
   * @param  none
   * @return Biomass Expension Factor search reference
   */


   public function search_biomas_expansion_ref()
   {

    $Reference = $this->input->post('Reference');
    $Author    = $this->input->post('Author');
    $Year      = $this->input->post('Year');
    $searchFields=array(
      'r.Reference'=>$Reference,
      'r.Author'=>$Author,
      'r.Year'=>$Year
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('efRefSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('efRefSearchString');
    }

    if(!empty($Reference) || !empty($Author) || !empty($Year))
    {
      $this->session->set_userdata('efSearchStringRef', $Reference);
      $this->session->set_userdata('efSearchStringAuth', $Author);
      $this->session->set_userdata('efSearchStringYear', $Year);

    }

    else
    {
      $Reference=$this->session->userdata('efSearchStringRef');
      $Author=$this->session->userdata('efSearchStringAuth');
      $Year=$this->session->userdata('efSearchStringYear');

    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_ref";
    $total_ef=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by e.ID_EF desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_ef;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
      //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $limit                     = $config["per_page"] = 20;
    $config["uri_segment"] = 3;
      //$config["num_links"] = round($total_ef );
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      // //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      // ")->result();
      // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
    $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string order by e.ID_EF desc LIMIT $limit OFFSET $page
     ")->result();

    $data['biomassExpansionFacView_count'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e

     LEFT JOIN species s ON e.Species=s.ID_Species
     LEFT JOIN family f ON s.ID_Family=f.ID_Family
     LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
     LEFT JOIN reference r ON e.Reference=r.ID_Reference
     LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
     LEFT JOIN division d ON e.Division=d.ID_Division
     LEFT JOIN district dis ON e.District =dis.ID_District
     LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
     where $string
     ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data["searchType"]=4;
    $data["Reference"]=$Reference;
    $data["Author"]=$Author;
    $data["Year"]=$Year;
    $data['content_view_page']      = 'portal/biomassExpansionFacView';
    $this->template->display_portal($data);
  }








   /*
   * @methodName biomassExpansionFacDetails()
   * @access public
   * @param  none
   * @return Biomass Expension Factor Details page
   */

   public function biomassExpansionFacDetails($ID)
   {
     $data['biomassExpansionFacDetails'] = $this->Forestdata_model->get_biomas_expension_factor_details($ID);
     $data['biomassExpansionFacDetails_tax'] = $this->Forestdata_model->get_emission_factor_details_tax($ID);
     $data['location'] = $this->Forestdata_model->get_emission_factor_details_loc($ID);
     $data['content_view_page']         = 'portal/biomassExpansionFacDetails';
     $this->template->display_portal($data);
   }



  /*
   * @methodName allometricEquationDetails()
   * @access public
   * @param  none
   * @return Allometric Equation Details page
   */

  public function allometricEquationDetails($ID_AE)
  {
    $data['allometricEquationDetails'] = $this->Forestdata_model->get_allometric_equation_details($ID_AE);
    $data['allometricEquationDetails_tax'] = $this->Forestdata_model->get_allometric_equation_details_tax($ID_AE);
    $data['location'] = $this->Forestdata_model->get_allometric_equation_details_loc($ID_AE);
    $data['content_view_page']         = 'portal/allometricEquationDetails';
    $this->template->display_portal($data);
  }


  /*
   * @methodName allometricEquationDetailsPdf()
   * @access public
   * @param  none
   * @return Allometric Equation Details PDF page
   */


  public function allometricEquationDetailsPdf($ID_AE)
  {
    $data['allometricEquationDetails'] = $this->Forestdata_model->get_allometric_equation_details($ID_AE);
    $data['location'] = $this->Forestdata_model->get_allometric_equation_details_loc($ID_AE);
    $data['allometricEquationDetails_tax'] = $this->Forestdata_model->get_allometric_equation_details_tax($ID_AE);
    include('mpdf/mpdf.php');
    $mpdf = new mPDF('utf-8', 'A4', '', '', 20, 20, 25, 47, 10, 10);
    $mpdf->SetTitle('Allometric Equation Details');
    $mpdf->mirrorMargins = 1;
    $report = $this->load->view('portal/allometricEquationDetailsPdf', $data, TRUE);
    $mpdf->WriteHTML($report);
    $mpdf->Output();
  }



  /*
   * @methodName rawDataView()
   * @access public
   * @param  none
   * @return Raw Data Menu page
   */

  public function rawDataView1()
  {
    $data['rawDataView']       = $this->Forestdata_model->get_raw_data_list();
    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }


  /*
   * @methodName rawDataViewjson()
   * @access public
   * @param  none
   * @return Raw Data json
   */




  public function rawDataViewjson1()
  {
    $data['rawDataViewjson']       = $this->Forestdata_model->get_raw_data_grid_json();

  }


  public function rawDataViewjson($string)
  {

    if($string==1)
    {
      $rawDataViewjson=$this->db->query("SELECT * from __view_raw_data_csv_data r
        where $string ");
    }
    else
    {
      $string= str_replace("abyz","=",$string);
      $string=base64_decode($string);

      $rawDataViewjson=$this->db->query("SELECT * from __view_raw_data_csv_data r
        where $string");
    }

    header('Content-disposition: attachment; filename=Raw_Data.json');
    header('Content-type: application/json');
   //echo json_encode($rawDataViewjson->result()),'<br />';
    echo json_encode($rawDataViewjson->result(), JSON_PRETTY_PRINT);
  }



        /*
   * @methodName rawDataViewcsv()
   * @access public
   * @param  none
   * @return Raw Data CSV Menu page
   */


        public function rawDataViewcsv($string)
        {

          if($string==1)
          {
            $rawDataViewcsv=$this->db->query("SELECT * from __view_raw_data_csv_data r
        where $string")->result_array();
          }
          else
          {
            $string= str_replace("abyz","=",$string);
            $string=base64_decode($string);

            $rawDataViewcsv=$this->db->query("SELECT * from __view_raw_data_csv_data r
            where $string")->result_array();
          }


//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
          header("Content-type: application/csv");
          header("Content-Disposition: attachment; filename=\"Raw Data".".csv\"");
          header("Pragma: no-cache");
          header("Expires: 0");
          $handle = fopen('php://output', 'w');
          fputcsv($handle, array('ID','ID_RD', 'Tree_type','Vegetation_type','location_name','Division','District','THANAME','UNINAME','LatDD'
            ,'LongDD',' FAOBiomes','Ecoregion_Udvardy','Ecoregion_WWF','Division_Bailey','Zone_Holdridge',' Bioecological_zones_Bangladesh_IUCN ','Family'
            ,'Genus','Species','DBH_cm','H_m','Collar_girth','CD_m',' Veg_Component','B','Bd','Bg','Bt',' L','Rb','Rf','Rm','S','T','F','F_Bole_kg','F_Branch_kg','F_Foliage_kg','F_Foliage_and_twigs_kg','F_Bark_kg'
            ,'F_Fruit_kg','F_Stump_kg','F_Buttress_kg','F_Roots_kg','Volume_m3','Volume_bole_m3','WD_AVG_gcm3','D_Bole_kg','D_Branch_kg','D_Foliage_g','  D_Foliage_kg',' D_Branch_g'
            ,'D_Bark_g','D_Bark_kg',' D_Stem_with_Bark_g','D_Stem_without_Bark_g',' D_Stem_without_Bark_kg',' D_Stump_kg',' D_Buttress_kg','D_Roots_kg',' ABG_g','ABG_kg','BGB_kg','Reference','Author','Year','Title','Journal','Volume','Issue','Page','URL','PDF_label','Contributor_name','Operator_name','email_contact','Remark'
          ));
          $i = 1;
          foreach ($rawDataViewcsv as $data) {
            fputcsv($handle, array($data["ID"], $data["ID_RD"], $data["Tree_type"], $data["Vegetation_type"],$data["location_name"], $data["Division"], $data["District"]
              , $data["THANAME"], $data["UNINAME"], $data["LatDD"], $data["LongDD"], $data["FAOBiomes"], $data["Ecoregion_Udvardy"], $data["Ecoregion_WWF"]
              , $data["Division_Bailey"], $data["Zone_Holdridge"], $data["Bioecological_zones_Bangladesh_IUCN"], $data["Family"], $data["Genus"], $data["Species"], $data["DBH_cm"],
              $data["H_m"], $data["Collar_girth"], $data["CD_m"], $data["Veg_Component"],$data["B"],$data["Bd"],$data["Bg"],$data["Bt"],$data["L"],$data["Rb"]
              ,$data["Rf"],$data["Rm"],$data["S"],$data["T"],$data["F"],$data["F_Bole_kg"],$data["F_Branch_kg"],$data["F_Foliage_kg"],$data["F_Foliage_and_twigs_kg"],$data["F_Bark_kg"],$data["F_Fruit_kg"],$data["F_Stump_kg"],$data["F_Buttress_kg"],$data["F_Roots_kg"],$data["Volume_m3"],$data["Volume_bole_m3"]
              ,$data["WD_AVG_gcm3"],$data["D_Bole_kg"],$data["D_Branch_kg"],$data["D_Foliage_g"],$data["D_Foliage_kg"],$data["D_Branch_g"],$data["D_Bark_g"],$data["D_Bark_kg"],$data["D_Stem_with_Bark_g"] ,$data["D_Stem_without_Bark_g"],$data["D_Stem_without_Bark_kg"],$data["D_Stump_kg"],$data["D_Buttress_kg"],$data["D_Roots_kg"],$data["ABG_g"],$data["ABG_kg"],$data["BGB_kg"],$data["Reference"],$data["Author"],$data["Year"],$data["Title"],$data["Journal"],$data["Volume"],$data["Issue"],$data["Page"],$data["URL"],$data["PDF_label"],$data["Contributor_name"],$data["Operator_name"],$data["email_contact"],$data["Remark"] ));
            $i++;
          }
          fclose($handle);
          exit;
        }





   /*
   * @methodName woodDensityViewjson()
   * @access public
   * @param  none
   * @return Wood Density Data json
   */




   public function woodDensityViewjson1()
   {
    $data['woodDensityViewjson']       = $this->Forestdata_model->get_wood_density_grid_json();

  }





  public function woodDensityViewjson($string)
  {
    if($string==1)
    {
      $woodDensityViewjson=$this->db->query("SELECT w.*,sl.local_name,u.THANAME,un.UNINAME,d.Division,dis.District,l.*,GROUP_CONCAT(l.location_name) location_name,s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones,ci.*,ref.* from wd w
       LEFT JOIN species s ON w.ID_species=s.ID_Species
       LEFT JOIN species_localname sl ON s.ID_Species=sl.Species_ID
       LEFT JOIN family f ON s.ID_Family=f.ID_Family
       LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
       LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
       LEFT JOIN group_location lg ON w.location_group=lg.group_id
       LEFT JOIN location l ON lg.location_id=l.ID_Location
       LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
       LEFT JOIN division d ON l.ID_Division=d.ID_Division
       LEFT JOIN district dis ON l.ID_District =dis.ID_District
       LEFT JOIN upazilla u ON l.Upzila =u.UPZ_CODE_1
       LEFT JOIN `union` un ON l.Union =un.UNI_CODE_1
       LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
       LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
       LEFT JOIN contributor_info ci ON w.Contributor =ci.Contributor_ID
       where $string  GROUP BY w.ID_WD
       order by w.ID_WD ASC");
    }
    else
    {
      $string= str_replace("abyz","=",$string);
      $string=base64_decode($string);

      $woodDensityViewjson=$this->db->query("SELECT w.*,sl.local_name,u.THANAME,un.UNINAME,d.Division,dis.District,l.*,GROUP_CONCAT(l.location_name) location_name,s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones,ci.*,ref.* from wd w
       LEFT JOIN species s ON w.ID_species=s.ID_Species
       LEFT JOIN species_localname sl ON s.ID_Species=sl.Species_ID
       LEFT JOIN family f ON s.ID_Family=f.ID_Family
       LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
       LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
       LEFT JOIN group_location lg ON w.location_group=lg.group_id
       LEFT JOIN location l ON lg.location_id=l.ID_Location
       LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
       LEFT JOIN division d ON l.ID_Division=d.ID_Division
       LEFT JOIN district dis ON l.ID_District =dis.ID_District
       LEFT JOIN upazilla u ON l.Upzila =u.UPZ_CODE_1
       LEFT JOIN `union` un ON l.Union =un.UNI_CODE_1
       LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
       LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
       LEFT JOIN contributor_info ci ON w.Contributor =ci.Contributor_ID
       where $string  GROUP BY w.ID_WD
       order by w.ID_WD ASC");
    }
    header('Content-disposition: attachment; filename=Wood_Density.json');
    header('Content-type: application/json');
   //echo json_encode($woodDensityViewjson->result()),'<br />';
    echo json_encode($woodDensityViewjson->result(), JSON_PRETTY_PRINT);
  }




         /*
   * @methodName woodDensityViewcsv()
   * @access public
   * @param  none
   * @return Wood Density CSV Menu page
   */



         public function woodDensityViewcsv($string)
         {
          if($string==1)
          {
            $woodDensityViewcsv=$this->db->query("SELECT w.*,sl.local_name,u.THANAME,un.UNINAME,d.Division,dis.District,l.*,GROUP_CONCAT(l.location_name) location_name,s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones,ci.*,ref.* from wd w
             LEFT JOIN species s ON w.ID_species=s.ID_Species
             LEFT JOIN species_localname sl ON s.ID_Species=sl.Species_ID
             LEFT JOIN family f ON s.ID_Family=f.ID_Family
             LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
             LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
             LEFT JOIN group_location lg ON w.location_group=lg.group_id
             LEFT JOIN location l ON lg.location_id=l.ID_Location
             LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
             LEFT JOIN division d ON l.ID_Division=d.ID_Division
             LEFT JOIN district dis ON l.ID_District =dis.ID_District
             LEFT JOIN upazilla u ON l.Upzila =u.UPZ_CODE_1
             LEFT JOIN `union` un ON l.Union =un.UNI_CODE_1
             LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
             LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
             LEFT JOIN contributor_info ci ON w.Contributor =ci.Contributor_ID
             where $string  GROUP BY w.ID_WD
             order by w.ID_WD ASC
             ")->result_array();
          }
          else
          {
            $string= str_replace("abyz","=",$string);
            $string=base64_decode($string);

            $woodDensityViewcsv=$this->db->query("SELECT w.*,sl.local_name,u.THANAME,un.UNINAME,d.Division,dis.District,l.*,GROUP_CONCAT(l.location_name) location_name,s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones,ci.*,ref.* from wd w
             LEFT JOIN species s ON w.ID_species=s.ID_Species
             LEFT JOIN species_localname sl ON s.ID_Species=sl.Species_ID
             LEFT JOIN family f ON s.ID_Family=f.ID_Family
             LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
             LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
             LEFT JOIN group_location lg ON w.location_group=lg.group_id
             LEFT JOIN location l ON lg.location_id=l.ID_Location
             LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
             LEFT JOIN division d ON l.ID_Division=d.ID_Division
             LEFT JOIN district dis ON l.ID_District =dis.ID_District
             LEFT JOIN upazilla u ON l.Upzila =u.UPZ_CODE_1
             LEFT JOIN `union` un ON l.Union =un.UNI_CODE_1
             LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
             LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
             LEFT JOIN contributor_info ci ON w.Contributor =ci.Contributor_ID
             where $string  GROUP BY w.ID_WD
             order by w.ID_WD ASC")->result_array();
          }

//$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
          header("Content-type: application/csv");
          header("Content-Disposition: attachment; filename=\"Wood Densities".".csv\"");
          header("Pragma: no-cache");
          header("Expires: 0");
          $handle = fopen('php://output', 'w');
          fputcsv($handle, array('ID_WD',' Tree_type', 'Vegetation_type', 'Region','location_group','Ecoregion_Udvardy','Ecoregion_WWF','Division_Bailey',
            'Zone_Holdridge','ID_species','Family','Genus','Species','local_name','FAOBiomes','location_name','LatDD','LongDD','THANAME','UNINAME','Zones','Reference','Author','Year','Title','Journal','Volume','Issue','Page','URL','PDF_label',
            'ID_reference','ID_RD','H_tree_avg','H_tree_min','H_tree_max','DBH_tree_avg','DBH_tree_min','DBH_tree_max','m_WD'
            ,'MC_m','V_WD','MC_V','CR','FSP','Methodology_Green','Methodology_Airdry','Bark',' Methodology_Ovendry','Density_green',' Density_airdry','Density_ovendry','MC_Density','Data_origin','Data_type','Samples_per_tree','Number_of_trees'
            ,'SD','Min','Max','H_measure','Bark_distance','CV','Convert_BD','Contributor','Contributor_name','Operator_name','email_contact','Remark'));
          $i = 1;
          foreach ($woodDensityViewcsv as $data) {
           fputcsv($handle, array($data["ID_WD"], $data["Tree_type"], $data["Vegetation_type"], $data["Region"], $data["location_group"], $data["Ecoregion_Udvardy"], $data["Ecoregion_WWF"]
            , $data["Division_Bailey"], $data["Zone_Holdridge"], $data["ID_species"], $data["Family"], $data["Genus"], $data["Species"],$data["local_name"], $data["FAOBiomes"],$data["location_name"],$data["LatDD"], $data["LongDD"], $data["THANAME"], $data["UNINAME"], $data["Zones"]
            , $data["Reference"], $data["Author"], $data["Year"],$data["Title"],$data["Journal"],$data["Volume"],$data["Issue"],$data["Page"],$data["URL"],$data["PDF_label"],$data["ID_reference"], $data["ID_RD"], $data["H_tree_avg"],
            $data["H_tree_min"],$data["H_tree_max"],$data["DBH_tree_avg"], $data["DBH_tree_min"],$data["DBH_tree_max"],$data["m_WD"],$data["MC_m"],$data["V_WD"],$data["MC_V"],$data["CR"],$data["FSP"]
            ,$data["Methodology_Green"],$data["Methodology_Airdry"],$data["Bark"],$data["Methodology_Ovendry"],$data["Density_green"],$data["Density_airdry"],$data["Density_ovendry"],$data["MC_Density"],$data["Data_origin"],$data["Data_type"],$data["Samples_per_tree"],$data["Number_of_trees"]
            ,$data["SD"],$data["Min"],$data["Max"],$data["H_measure"],$data["Bark_distance"],$data["CV"],$data["Convert_BD"],$data["Contributor"],$data["Contributor_name"],$data["Operator_name"],$data["email_contact"],$data["Remark"]
          ));
           $i++;
         }
         fclose($handle);
         exit;
       }




  /*
   * @methodName rawDataView()
   * @access public
   * @param  none
   * @return Raw Data Menu page
   */

  public function rawDataView()
  {

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/rawDataView";
    $total_rawData      = $this->db->count_all("rd");

    $config["total_rows"] = $total_rawData;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['rawDataView'] = $this->Forestdata_model->get_raw_data_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }






  /*
   * @methodName rawDataSpeciesView()
   * @access public
   * @param  none
   * @return Raw Data Menu page
   */

  public function rawDataSpeciesView($speciesNameEncode)
  {
    $specis_id='';
    $speciesNameDecode=base64_decode($speciesNameEncode);
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/rawDataSpeciesView/".$specis_id;
    $total_rawData=$this->db->query("SELECT * FROM __view_raw_data_search_tbl  
      ")->num_rows();

    $config["total_rows"] = $total_rawData;
    
    $data['rawDataView_count'] = $this->db->query("SELECT * from __view_raw_data_search_tbl r where Species like '%$speciesNameDecode%'
      ")->result();

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 4;
    $limit                     = $config["per_page"];
    
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
    fnc_rd_species_data(a.LatDD,a.LongDD) species_desc FROM location a
    LEFT JOIN group_location b ON a.ID_Location=b.location_id
    LEFT JOIN rd r ON b.group_id=r.location_group
    LEFT JOIN species_group sr ON r.Speciesgroup_ID=sr.Speciesgroup_ID
    LEFT JOIN species s ON sr.ID_Species=s.ID_Species
    LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
    WHERE r.ID IS NOT NULL
    GROUP BY LatDD,LongDD";
    $jsonQueryEncode=base64_encode($jsonQuery);
    $data['jsonQuery']=$jsonQueryEncode;
    $data['rawDataView'] = $this->Forestdata_model->get_raw_data_grid_species($speciesNameDecode,$limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data['content_view_page'] = 'portal/rawDataView';
    $string="Species like '%$speciesNameDecode%'";
    $string=base64_encode($string);
    $string= str_replace("=","abyz",$string);
    $data['string']=$string;
    $data['strs']=$string;
    $this->template->display_portal($data);
  }



  /*
   * @methodName woodDensitiesView()
   * @access public
   * @param  none
   * @return wood densities Menu page
   */

  public function woodDensitiesView()
  {

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/woodDensitiesView";
    $total_woodDensities      = $this->db->count_all("wd");

    $config["total_rows"] = $total_woodDensities;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data['content_view_page'] = 'portal/woodDensitiesView';
    $this->template->display_portal($data);
  }



      /*
   * @methodName woodDensitiesSpeciesView()
   * @access public
   * @param  none
   * @return wood densities Menu page
   */

      public function woodDensitiesSpeciesView($specis_id)
      {

        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/woodDensitiesSpeciesView/".$specis_id;
        $total_woodDensities      = $this->db->count_all("wd");

        $config["total_rows"] = $total_woodDensities;

        $total_woodDensities=$this->db->query("SELECT w.ID_WD,w.Density_green,w.Density_airdry,w.Density_ovendry,ref.Author,ref.Reference,ref.Year,d.Division,dis.District,l.location_name,GROUP_CONCAT(lg.location_id),s.Species,g.Genus,f.Family,b.FAOBiomes,eco.AEZ_NAME,zon.Zones from wd w
         LEFT JOIN species s ON w.ID_species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus
         LEFT JOIN reference ref ON w.ID_reference=ref.ID_Reference
         LEFT JOIN group_location lg ON w.location_group=lg.group_id
         LEFT JOIN location l ON lg.location_id=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         LEFT JOIN bd_aez1988 eco ON l.ID_1988EcoZones =eco.MAJOR_AEZ
         where w.ID_species=$specis_id
         GROUP BY w.ID_WD
         order by w.ID_WD desc
         ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
        $config["total_rows"] =$total_woodDensities;
      // $config["total_rows"] = 800;

        $config["per_page"]        = 20;
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $limit                     = $config["per_page"];
        $config["uri_segment"] = 4;
      //pagination style start
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['prev_link']       = '&lt;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&gt;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="current"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
      //pagination style end
        $this->pagination->initialize($config);
        $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
        fnc_wd_species_data(a.LatDD,a.LongDD) species_desc FROM location a
        LEFT JOIN group_location b ON a.ID_Location=b.location_id
        LEFT JOIN wd w ON b.group_id=w.location_group
        LEFT JOIN species d ON w.ID_species=d.ID_Species
        LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
        WHERE w.ID_WD IS NOT NULL
        GROUP BY LatDD,LongDD";
        $jsonQueryEncode=base64_encode($jsonQuery);
        $data['jsonQuery']=$jsonQueryEncode;

        $data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid_species($specis_id,$limit,$page);
      //print_r( $data['woodDensitiesView']);exit();
        $data["links"]             = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/woodDensitiesView';
        $string="w.ID_Species=$specis_id";
        $string=base64_encode($string);
        $string= str_replace("=","abyz",$string);
        $data['string']=$string;
        $data['strs']=$string;
        $this->template->display_portal($data);
      }






  /*
   * @methodName search_rawequation_key()
   * @access public
   * @param  none
   * @return Raw Data key wise Search view page
   */

  public function search_rawequation_key()
  {
    $keyword = $this->input->post('keyword');
    $searchFields=array(
      's.Species'=>$keyword,
      'dis.District'=>$keyword,
      'r.Volume_m3'=>$keyword,
      'r.DBH_cm'=>$keyword,
      'r.H_m'=>$keyword,
      'ref.Reference'=>$keyword,
      'b.FAOBiomes'=>$keyword,
      'f.Family'=>$keyword,
      'g.Genus'=>$keyword,
      'ref.Year'=>$keyword,
      'ref.Author'=>$keyword,
      'r.Latitude'=>$keyword,
      'r.Longitude'=>$keyword,
      'd.Division'=>$keyword

    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('rdkeySearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('rdkeySearchString');
    }


    if(!empty($keyword))
    {
      $this->session->set_userdata('rdSearchStringKeyword', $keyword);

    }

    else
    {
      $keyword=$this->session->userdata('rdSearchStringKeyword');


    }
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_rawequation_key";
    $total_rawData=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     order by r.ID desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_rawData;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     order by r.ID desc LIMIT $limit OFFSET $page
     ")->result();

    $data['rawDataView_count']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     order by r.ID desc

     ")->result();
    $data["links"]             = $this->pagination->create_links();
    $data['keyword']=$keyword;

    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }



  /*
   * @methodName search_rawequation_tax()
   * @access public
   * @param  none
   * @return Raw Data taxonomy wise Search view page
   */

  public function search_rawequation_tax()
  {
    $Genus   = $this->input->post('Genus');
    $Family   = $this->input->post('Family');
    $Species = $this->input->post('Species');
    $searchFields=array(
      'f.Family'=>$Family,
      'g.Genus'=>$Genus,
      's.Species'=>$Species
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('rdtaxSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('rdtaxSearchString');
    }
    if(!empty($Species) || !empty($Family) || !empty($Genus))
    {
      $this->session->set_userdata('rdSearchStringSpecies', $Species);
      $this->session->set_userdata('rdSearchStringFamily', $Family);
      $this->session->set_userdata('rdSearchStringGenus', $Genus);

    }

    else
    {
      $Species=$this->session->userdata('rdSearchStringSpecies');
      $Family=$this->session->userdata('rdSearchStringFamily');
      $Genus=$this->session->userdata('rdSearchStringGenus');

    }
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_rawequation_tax";
    $total_rawData=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_rawData;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc LIMIT $limit OFFSET $page
     ")->result();

    $data['rawDataView_count']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     ")->result();
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=3;
    $data['Species']=$Species;
    $data['Family']=$Family;
    $data['Genus']=$Genus;
    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }


  /*
   * @methodName search_rawequation_loc()
   * @access public
   * @param  none
   * @return Raw Data location wise Search view page
   */

  public function search_rawequation_loc()
  {
    $District  = $this->input->post('District');
    $FAOBiomes = $this->input->post('FAOBiomes');
    $Division = $this->input->post('Division');
    $searchFields=array(
      'dis.District'=>$District,
      'd.Division'=>$Division,
      'b.FAOBiomes'=>$FAOBiomes
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('rdlocSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('rdlocSearchString');
    }

    if(!empty($District) || !empty($FAOBiomes) || !empty($Division))
    {
      $this->session->set_userdata('rdSearchStringDis', $District);
      $this->session->set_userdata('rdSearchStringFao', $FAOBiomes);
      $this->session->set_userdata('rdSearchStringDiv', $Division);

    }

    else
    {
      $District=$this->session->userdata('rdSearchStringDis');
      $EcoZones=$this->session->userdata('rdSearchStringFao');
      $Division=$this->session->userdata('rdSearchStringDiv');

    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_rawequation_loc";
    $total_rawData=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_rawData;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc LIMIT $limit OFFSET $page
     ")->result();

    $data['rawDataView_count']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     ")->result();
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=4;
    $data['District']=$District;
    $data['FAOBiomes']=$FAOBiomes;
    $data['Division']=$Division;
    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }

  /*
   * @methodName search_rawequation_ref()
   * @access public
   * @param  none
   * @return Raw Data Reference wise Search view page
   */

  public function search_rawequation_ref()
  {
    $Reference = $this->input->post('Reference');
    $Author    = $this->input->post('Author');
    $Year      = $this->input->post('Year');
    $searchFields=array(
      'ref.Reference'=>$Reference,
      'ref.Author'=>$Author,
      'ref.Year'=>$Year
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('rdRefSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('rdRefSearchString');
    }

    if(!empty($Reference) || !empty($Author) || !empty($Year))
    {
      $this->session->set_userdata('rdSearchStringRef', $Reference);
      $this->session->set_userdata('rdSearchStringAuth', $Author);
      $this->session->set_userdata('rdSearchStringYear', $Year);

    }

    else
    {
      $Reference=$this->session->userdata('rdSearchStringRef');
      $Author=$this->session->userdata('rdSearchStringAuth');
      $Year=$this->session->userdata('rdSearchStringYear');

    }


    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_rawequation_ref";
    $total_rawData=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_rawData;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc LIMIT $limit OFFSET $page
     ")->result();

    $data['rawDataView_count']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     ")->result();
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=5;
    $data["Reference"]=$Reference;
    $data["Author"]=$Author;
    $data["Year"]=$Year;
    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }


  /*
   * @methodName search_rawequation_raw()
   * @access public
   * @param  none
   * @return Raw Data raw data wise Search view page
   */

  public function search_rawequation_raw()
  {
    $H_m = $this->input->post('H_m');
    $Volume_m3 = $this->input->post('Volume_m3');
    $searchFields=array(
      'r.H_m'=>$H_m,
      'r.Volume_m3'=>$Volume_m3
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('rdraSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('rdraSearchString');
    }
    if(!empty($H_m) || !empty($Volume_m3))
    {
      $this->session->set_userdata('rdSearchStringhm', $H_m);
      $this->session->set_userdata('rdSearchStringvm', $Volume_m3);


    }

    else
    {
      $H_m=$this->session->userdata('rdSearchStringhm');
      $Volume_m3=$this->session->userdata('rdSearchStringvm');


    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_rawequation_raw";
    $total_rawData=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_rawData;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = $config["per_page"] = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string order by r.ID desc LIMIT $limit OFFSET $page
     ")->result();

    $data['rawDataView_count'] = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
     LEFT JOIN species s ON r.Species_ID=s.ID_Species
     LEFT JOIN family f ON r.Family_ID=f.ID_Family
     LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus
     LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
     LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
     LEFT JOIN division d ON r.Division=d.ID_Division
     LEFT JOIN district dis ON r.District =dis.ID_District
     where $string
     ")->result();
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=2;
    $data['H_m']=$H_m;
    $data['Volume_m3']=$Volume_m3;
    $data['content_view_page'] = 'portal/rawDataView';
    $this->template->display_portal($data);
  }



  /*
   * @methodName search_woodDensities_key()
   * @access public
   * @param  none
   * @return wood densities key Search
   */

  public function search_woodDensities_key()
  {
    $keyword = $this->input->post('keyword');
    $searchFields=array(
      's.Species'=>$keyword,
      'dis.District'=>$keyword,
      'w.Density_green'=>$keyword,
      'w.H_tree_avg'=>$keyword,
      'w.H_tree_min'=>$keyword,
      'w.H_tree_max'=>$keyword,
      'w.DBH_tree_avg'=>$keyword,
      'w.DBH_tree_min'=>$keyword,
      'w.DBH_tree_max'=>$keyword,
      'r.Author'=>$keyword,
      'r.Reference'=>$keyword,
      'b.FAOBiomes'=>$keyword,
      'f.Family'=>$keyword,
      'g.Genus'=>$keyword,
      'r.Year'=>$keyword,
      'w.Latitude'=>$keyword,
      'w.Longitude'=>$keyword,
      'd.Division'=>$keyword

    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('wdkeySearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('wdkeySearchString');
    }
    if(!empty($keyword))
    {
      $this->session->set_userdata('wdSearchStringKeyword', $keyword);

    }

    else
    {
      $keyword=$this->session->userdata('wdSearchStringKeyword');


    }
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_key";
    $total_woodDensities=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc
      ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_woodDensities;


      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc LIMIT $limit OFFSET $page
      ")->result();

    $data['woodDensitiesView_count']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc

      ")->result();

      //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data['keyword']=$keyword;
    $data['content_view_page'] = 'portal/woodDensitiesViewSearch';
    $this->template->display_portal($data);
  }




  /*
   * @methodName search_woodDensities_raw()
   * @access public
   * @param  none
   * @return wood densities raw Search
   */

  public function search_woodDensities_raw()
  {
    $H_tree_avg = $this->input->post('H_tree_avg');
    $H_tree_min = $this->input->post('H_tree_min');
    $H_tree_max = $this->input->post('H_tree_max');
    $DBH_tree_avg = $this->input->post('DBH_tree_avg');
    $DBH_tree_min = $this->input->post('DBH_tree_min');
    $DBH_tree_max = $this->input->post('DBH_tree_max');
    $searchFields=array(
      'w.H_tree_avg'=>$H_tree_avg,
      'w.H_tree_min'=>$H_tree_min,
      'w.H_tree_max'=>$H_tree_max,
      'w.DBH_tree_avg'=>$DBH_tree_avg,
      'w.DBH_tree_min'=>$DBH_tree_min,
      'w.DBH_tree_max'=>$DBH_tree_max
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('wdRawSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('wdRawSearchString');
    }

    if(!empty($H_tree_avg) || !empty($H_tree_min) || !empty($H_tree_max) || !empty($DBH_tree_avg) || !empty($DBH_tree_min) || !empty($DBH_tree_max))
    {
      $this->session->set_userdata('wdSearchStringHTreeAv', $H_tree_avg);
      $this->session->set_userdata('wdSearchStringHTreeMin', $H_tree_min);
      $this->session->set_userdata('wdSearchStringHTreeMax', $H_tree_max);
      $this->session->set_userdata('wdSearchStringDbTreeAv', $DBH_tree_avg);
      $this->session->set_userdata('wdSearchStringDbTreeMin', $DBH_tree_min);
      $this->session->set_userdata('wdSearchStringDbTreeMax', $DBH_tree_max);

    }

    else
    {
      $H_tree_avg=$this->session->userdata('wdSearchStringHTreeAv');
      $H_tree_min=$this->session->userdata('wdSearchStringHTreeMin');
      $H_tree_max=$this->session->userdata('wdSearchStringHTreeMax');
      $DBH_tree_avg=$this->session->userdata('wdSearchStringDbTreeAv');
      $DBH_tree_min=$this->session->userdata('wdSearchStringDbTreeMin');
      $DBH_tree_max=$this->session->userdata('wdSearchStringDbTreeMax');
    }
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_raw";
    $total_woodDensities=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc
      ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_woodDensities;

      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc LIMIT $limit OFFSET $page
      ")->result();
    $data['woodDensitiesView_count']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string

      ")->result();

      //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=2;
    $data['H_tree_avg']=$H_tree_avg;
    $data['H_tree_min']=$H_tree_min;
    $data['H_tree_max']=$H_tree_max;
    $data['DBH_tree_avg']=$DBH_tree_avg;
    $data['DBH_tree_min']=$DBH_tree_min;
    $data['DBH_tree_max']=$DBH_tree_max;
    $data['content_view_page'] = 'portal/woodDensitiesViewSearch';
    $this->template->display_portal($data);
  }




  /*
   * @methodName search_woodDensities_raw()
   * @access public
   * @param  none
   * @return wood densities raw Search
   */

  public function search_woodDensities_tax()
  {
    $Genus   = $this->input->post('Genus');
    $Species = $this->input->post('Species');
    $Family   = $this->input->post('Family');
    $searchFields=array(
      'f.Family'=>$Family,
      'g.Genus'=>$Genus,
      's.Species'=>$Species
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('wdTaxSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('wdTaxSearchString');
    }

    if(!empty($Species) || !empty($Family) || !empty($Genus))
    {
      $this->session->set_userdata('wdSearchStringSpecies', $Species);
      $this->session->set_userdata('wdSearchStringFamily', $Family);
      $this->session->set_userdata('wdSearchStringGenus', $Genus);

    }

    else
    {
      $Species=$this->session->userdata('wdSearchStringSpecies');
      $Family=$this->session->userdata('wdSearchStringFamily');
      $Genus=$this->session->userdata('wdSearchStringGenus');

    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_tax";
    $total_woodDensities=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc
      ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_woodDensities;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc LIMIT $limit OFFSET $page
      ")->result();

    $data['woodDensitiesView_count']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string

      ")->result();


      //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=3;
    $data['Species']=$Species;
    $data['Family']=$Family;
    $data['Genus']=$Genus;
    $data['content_view_page'] = 'portal/woodDensitiesViewSearch';
    $this->template->display_portal($data);
  }





  /*
   * @methodName search_woodDensities_loc()
   * @access public
   * @param  none
   * @return wood densities location Search
   */

  public function search_woodDensities_loc()
  {
    $District  = $this->input->post('District');
    $EcoZones = $this->input->post('EcoZones');
    $Division = $this->input->post('Division');
    $searchFields=array(
      'dis.District'=>$District,
      'd.Division'=>$Division,
      'eco.EcoZones'=>$EcoZones
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('wdLocSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('wdLocSearchString');
    }

    if(!empty($District) || !empty($EcoZones) || !empty($Division))
    {
      $this->session->set_userdata('wdSearchStringDis', $District);
      $this->session->set_userdata('wdSearchStringEco', $EcoZones);
      $this->session->set_userdata('wdSearchStringDiv', $Division);

    }

    else
    {
      $District=$this->session->userdata('wdSearchStringDis');
      $EcoZones=$this->session->userdata('wdSearchStringEco');
      $Division=$this->session->userdata('wdSearchStringDiv');

    }
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_loc";
    $total_woodDensities=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc
      ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_woodDensities;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc LIMIT $limit OFFSET $page
      ")->result();

    $data['woodDensitiesView_count']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      ")->result();

      //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=4;
    $data['District']=$District;
    $data['Division']=$Division;
    $data['EcoZones']=$EcoZones;
    $data['content_view_page'] = 'portal/woodDensitiesViewSearch';
    $this->template->display_portal($data);
  }




   /*
   * @methodName search_woodDensities_loc()
   * @access public
   * @param  none
   * @return wood densities location Search
   */

   public function search_woodDensities_ref()
   {
    $Reference = $this->input->post('Reference');
    $Author    = $this->input->post('Author');
    $Year      = $this->input->post('Year');
    $searchFields=array(
      'r.Reference'=>$Reference,
      'r.Author'=>$Author,
      'r.Year'=>$Year
    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('wdRefSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('wdRefSearchString');
    }
    if(!empty($Reference) || !empty($Author) || !empty($Year))
    {
      $this->session->set_userdata('wdSearchStringRef', $Reference);
      $this->session->set_userdata('wdSearchStringAuth', $Author);
      $this->session->set_userdata('wdSearchStringYear', $Year);

    }

    else
    {
      $Reference=$this->session->userdata('wdSearchStringRef');
      $Author=$this->session->userdata('wdSearchStringAuth');
      $Year=$this->session->userdata('wdSearchStringYear');

    }

    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_ref";
    $total_woodDensities=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc
      ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_woodDensities;
      // $config["total_rows"] = 800;

    $config["per_page"]        = 20;
    $config["uri_segment"]     = 3;
    $limit                     = 20;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string
      order by w.ID_WD desc LIMIT $limit OFFSET $page
      ")->result();

    $data['woodDensitiesView_count']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
      LEFT JOIN species s ON w.ID_Species=s.ID_Species
      LEFT JOIN family f ON w.ID_Family=f.ID_Family
      LEFT JOIN genus g ON w.ID_genus=g.ID_Genus
      LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
      LEFT JOIN location l ON w.ID_Location=l.ID_Location
      LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
      LEFT JOIN division d ON l.ID_Division=d.ID_Division
      LEFT JOIN district dis ON l.ID_District =dis.ID_District
      LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones
      where $string

      ")->result();

      //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
    $data["links"]             = $this->pagination->create_links();
    $data["searchType"]=5;
    $data["Reference"]=$Reference;
    $data["Author"]=$Author;
    $data["Year"]=$Year;
    $data['content_view_page'] = 'portal/woodDensitiesViewSearch';
    $this->template->display_portal($data);
  }



  /*
   * @methodName rawDataDetails()
   * @access public
   * @param  none
   * @return Raw Data Details page
   */

  public function rawDataDetails($ID)
  {
    $data['rawDataDetails']    = $this->Forestdata_model->get_raw_data_details($ID);
    $data['rawDataDetails_tax'] = $this->Forestdata_model->get_raw_data_details_tax($ID);
    $data['location'] = $this->Forestdata_model->get_raw_data_equation_details_loc($ID);
    $data['content_view_page'] = 'portal/rawDataDetails';
    $this->template->display_portal($data);
  }



    /*
   * @methodName woodDensitiesDetails()
   * @access public
   * @param  none
   * @return Wood Densities Details page
   */

    public function woodDensitiesDetails($ID)
    {
      $data['woodDensitiesDetails']    = $this->Forestdata_model->get_wood_densities_details($ID);
      $data['location'] = $this->Forestdata_model->get_woodDensities_details_loc($ID);
      $data['content_view_page'] = 'portal/woodDensitiesDetails';
      $this->template->display_portal($data);
    }



   /*
   * @methodName rawDataDetailsPdf()
   * @access public
   * @param  none
   * @return Raw Data Details PDF page
   */


   public function rawDataDetailsPdf($ID)
   {
    $data['rawDataDetails']    = $this->Forestdata_model->get_raw_data_details($ID);
    $data['rawDataDetails_tax'] = $this->Forestdata_model->get_raw_data_details_tax($ID);
    $data['location'] = $this->Forestdata_model->get_raw_data_equation_details_loc($ID);
    include('mpdf/mpdf.php');
    $mpdf = new mPDF('utf-8', 'A4', '', '', 20, 20, 25, 47, 10, 10);
    $mpdf->SetTitle('Raw Data Details');
    $mpdf->mirrorMargins = 1;
    $report = $this->load->view('portal/rawDataDetailsPdf', $data, TRUE);
    $mpdf->WriteHTML($report);
    $mpdf->Output();
  }


     /*
   * @methodName woodDensitiesPdf()
   * @access public
   * @param  none
   * @return Wood Densities Details PDF page
   */


     public function woodDensitiesPdf($ID)
     {
      $data['woodDensitiesDetails']    = $this->Forestdata_model->get_wood_densities_details($ID);
      $data['location'] = $this->Forestdata_model->get_woodDensities_details_loc($ID);
      include('mpdf/mpdf.php');
      $mpdf = new mPDF('utf-8', 'A4', '', '', 20, 20, 25, 47, 10, 10);
      $mpdf->SetTitle('Wood Densities Details PDF');
      $mpdf->mirrorMargins = 1;
      $report = $this->load->view('portal/woodDensitiesPdf', $data, TRUE);
      $mpdf->WriteHTML($report);
      $mpdf->Output();
    }


  /*
   * @methodName biomassExpansionFacPdf()
   * @access public
   * @param  none
   * @return Allometric Equation Details PDF page
   */


  public function biomassExpansionFacPdf($ID)
  {
    $data['biomassExpansionFacDetails'] = $this->Forestdata_model->get_biomas_expension_factor_details($ID);
    $data['biomassExpansionFacDetails_tax'] = $this->Forestdata_model->get_emission_factor_details_tax($ID);
    $data['location'] = $this->Forestdata_model->get_emission_factor_details_loc($ID);
    include('mpdf/mpdf.php');
    $mpdf = new mPDF('utf-8', 'A4', '', '', 20, 20, 25, 47, 10, 10);
    $mpdf->SetTitle('Biomass Expension Factor PDF');
    $mpdf->mirrorMargins = 1;
    $report = $this->load->view('portal/biomassExpansionFacPdf', $data, TRUE);
    $mpdf->WriteHTML($report);
    $mpdf->Output();
  }



     /*
   * @methodName speciesListViewjson()
   * @access public
   * @param  none
   * @return Species List Json data show
   */

     public function speciesListViewjson()
     {
      $data['speciesListViewjson'] = $this->Forestdata_model->get_species_list_json();

    }

  /*
   * @methodName viewLibraryPage()
   * @access public
   * @param  none
   * @return Library View Page
   */

  public function viewLibraryPage()
  {

    $data['reference']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc")->result();
    $data['reference_author']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc")->result();
    $data['content_view_page'] = 'portal/viewLibraryPage';
    $this->template->display_portal($data);

  }


  private function pr($data)
  {

    echo "<pre>";
    print_r($data);
  }
  public function viewCommunityPage_backup()
  {
    $userSession=$this->session->userdata("user_logged");
    if(empty($userSession))
    {
      redirect('accounts/userLogin');
    }
    else
    {
      $id=$userSession['USER_ID'];
      $data['community']           = $this->db->query("SELECT c.*,v.USER_ID,v.LAST_NAME from community c
        LEFT JOIN visitor_info v ON c.user_id=v.USER_ID order by c.id desc ")->result();
      //$data["links"]                  = $this->pagination->create_links();
      $data['content_view_page'] = 'portal/viewCommunityPage';
      $this->template->display_portal($data);
    }
  }


  public function viewCommunityPage()
  {

    $data['community']           = $this->db->query("SELECT c.*,v.USER_ID,v.LAST_NAME from community c
      LEFT JOIN visitor_info v ON c.user_id=v.USER_ID order by c.id desc ")->result();
      //$data["links"]                  = $this->pagination->create_links();
    $data['content_view_page'] = 'portal/viewCommunityPage';
    $this->template->display_portal($data);

  }



  public function search_community_backup()
  {
    $title = $this->input->post('title');

    $searchFields=array(
      'c.title'=>$title

    );

    $string=$this->searchAttributeString($searchFields);
    if(!empty($string))
    {
      $this->session->set_userdata('ComfSearchString', $string);
    }
    else
    {
      $string=$this->session->userdata('ComfSearchString');
    }
    if(!empty($title))
    {
      $this->session->set_userdata('comSearchStringTitle', $title);


    }

    else
    {
      $title=$this->session->userdata('comSearchStringTitle');


    }
    $this->load->library('pagination');
    $config             = array();
    $config["base_url"] = base_url() . "index.php/portal/search_community";

    $total_ae=$this->db->query("SELECT c.* from community c
     where $string order by c.title desc
     ")->num_rows();
      // print_r($this->db->last_query());exit;
      // echo $total_ae;exit;
    $config["total_rows"] =$total_ae;

      // $config["total_rows"] = 800;

    $config["per_page"]        = 10;
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $limit                     = $config["per_page"];
    $config["uri_segment"] = 3;
      //pagination style start
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['prev_link']       = '&lt;';
    $config['prev_tag_open']   = '<li>';
    $config['prev_tag_close']  = '</li>';
    $config['next_link']       = '&gt;';
    $config['next_tag_open']   = '<li>';
    $config['next_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="current"><a href="#">';
    $config['cur_tag_close']   = '</a></li>';
    $config['num_tag_open']    = '<li>';
    $config['num_tag_close']   = '</li>';
    $config['first_tag_open']  = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li>';
    $config['last_tag_close']  = '</li>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
      //pagination style end
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // $data['reference_author']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc")->result();
    $data['community'] = $this->db->query("SELECT c.*,v.USER_ID,v.LAST_NAME from community c
      LEFT JOIN visitor_info v ON c.user_id=v.USER_ID where $string order by c.id desc LIMIT $limit OFFSET $page

      ")->result();
    $data['community_count'] = $this->db->query("SELECT c.*,v.USER_ID,v.LAST_NAME from community c
      LEFT JOIN visitor_info v ON c.user_id=v.USER_ID where $string order by c.id desc
      ")->result();
    $data["links"]                  = $this->pagination->create_links();
    $data["title"]=$title;

    $data['content_view_page']      = 'portal/viewCommunitySearchPage';
    $this->template->display_portal($data);

  }


  private function getDtByAttrCommunity($attr)
  {
    $returnArray=array();
    switch ($attr) {
      case "Title":
      $returnArray[]='title';
      $returnArray[]='c.';
      break;
      default:
      $returnArray[]='';
      $returnArray[]='';
    }
    return $returnArray;
  }

  public function search_community()
  {
    //  $r=$this->getDtByAttrAe('Author');
    //$this->pr($_GET);
    if(!empty($_GET)){
      $searchFieldArray=$_GET;
      if(!isset($searchFieldArray['keyword']))
      {
        $searchFieldArray['keyword']='';
      }
      if($searchFieldArray['keyword']!='')
      {
        foreach($searchFieldArray as $key=>$value)
        {
          if($key!='keyword')
          {
            $r=$this->getDtByAttrCommunity($key);
            $validSearchKey[$r[1].$key]=$searchFieldArray['keyword'];
            $fieldName[]=$r[0];
            $filedNameValue[$r[0].'/'.$key]=$searchFieldArray['keyword'];
          }
        }
      }
      else
      {
        foreach($searchFieldArray as $key=>$value)
        {
          if($value!='')
          {
            $r=$this->getDtByAttrCommunity($key);
            $validSearchKey[$r[1].$key]=$value;
            $fieldName[]=$r[0];
            $filedNameValue[$r[0].'/'.$key]=$value;
          }
        }
      }
    //  $this->pr($filedNameValue);
      if(!isset($filedNameValue))
      {
        redirect('portal/viewCommunityPage');
      }
      else
      {
        $data['fieldNameValue']=$filedNameValue;
      }

      $string=$this->searchAttributeString($validSearchKey);

      $data['community'] = $this->db->query("SELECT c.title,c.id,c.user_id,v.USER_ID,v.LAST_NAME from community c
        LEFT JOIN visitor_info v ON c.user_id=v.USER_ID where $string order by c.title desc

        ")->result();
      $data['community_count'] = $this->db->query("SELECT c.title,c.id,c.user_id,v.USER_ID,v.LAST_NAME from community c
        LEFT JOIN visitor_info v ON c.user_id=v.USER_ID where $string order by c.title desc
        ")->result();
       // $data["links"]                  = $this->pagination->create_links();

      if($searchFieldArray['keyword']!='')
      {
        $subUrl='';
        $i=0;
        $n=count($searchFieldArray);
        foreach($searchFieldArray as $row=> $val)
        {
          if($i<$n-1)
          {
            $subUrl.=$row.'='.$searchFieldArray['keyword'].'&';
          }
          else
          {
            $subUrl.=$row.'='.$searchFieldArray['keyword'];
          }
          $i++;

        }
        $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $pieces = explode("?", $url);
        $urlTail=$pieces[1];
        $url=str_ireplace($urlTail,$subUrl,$url);
        $keyWord=$searchFieldArray['keyword'];
        $removeString="keyword=$keyWord&";
        $data['actualUrl']=str_replace($removeString,'',$url);
      }
      else
      {
        $url=$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['actualUrl']=$url;
      }
    }
    else
    {
      redirect('portal/viewCommunityPage');
    }
    $data['content_view_page']      = 'portal/viewCommunityPage';
    $string=base64_encode($string);
    $string= str_replace("=","abyz",$string);
    $data['string']=$string;
       //$data["searchType"]=2;
       //$data["searchType"]=3;
       //$data["searchType"]=4;
    $this->template->display_portal($data);
  }




  public function viewAddCommunityPage()
  {

    $data['content_view_page'] = 'portal/viewAddCommunityPage';
    $this->template->display_portal($data);
  }


  public function viewDetailCommunityPage($id)
  {
    $data['viewDetailCommunityPage'] = $this->Forestdata_model->get_community_details($id);
    $m=$data['community_comment']       = $this->db->query("select cc.*,vi.LAST_NAME ,vi.PROFILE_IMG from community_comment cc
      left join visitor_info vi on cc.user_id=vi.USER_ID
      where community_id=$id")->result();

    $data['coummunity_id'] = $id;
    $data['content_view_page'] = 'portal/viewDetailCommunityPage';
    $this->template->display_portal($data);
  }




  public function addPost()
  {


    if (isset($_POST['title'])) {


          //$titles = count($this->input->post('title'));
      $title    = $this->input->post('title');
      $description    = $this->input->post('description');
      $Author    = $this->input->post('Author');
      $Year    = $this->input->post('Year');
      $session = $this->user_session = $this->session->userdata('user_logged');
      $userid =  $session["USER_ID"];




      $data = array(
        'title' => $title,
        'description' => $description,
        'post_date' => date('Y-m-d H:i:s', time()),
        'user_id' =>$userid


      );

          //$data['IMAGE_PATH'] = 'asdasdsad';

      $this->utilities->insertData($data, 'community');
      $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Post Added successfully.<button data-dismiss="alert" class="close" type="button">×</button></div>');
      redirect('Portal/addPost');
    }

    else {
      $data['content_view_page'] = 'portal/viewAddCommunityPage';
      $this->template->display_portal($data);
    }
  }




  public function addComment()
  {


    if (isset($_POST['comment'])) {
      $comment    = $this->input->post('comment');
          //$id = $this->input->post('user_id');
      $session = $this->user_session = $this->session->userdata('user_logged');
      $userid =  $session["USER_ID"];
      $data = array(
        'comment' => $comment,
        'community_id' => $this->input->post('COMMINITY_ID'),
        'date' => date('Y-m-d H:i:s', time()),
        'user_id' =>$userid


      );

          //$data['IMAGE_PATH'] = 'asdasdsad';

      $this->utilities->insertData($data, 'community_comment');
      $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Comment Posted successfully.<button data-dismiss="alert" class="close" type="button">×</button></div>');
      redirect('Portal/viewDetailCommunityPage/'.$this->input->post('COMMINITY_ID'));
    }

    else {
      $data['content_view_page'] = 'portal/viewDetailCommunityPage';
      $this->template->display_portal($data);
    }
  }



  public function get_genus()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Genus FROM genus WHERE Genus LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Genus);
          $new_row['value'] = stripslashes($row->Genus);
          $new_row['id'] = stripslashes($row->Genus);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }

  public function get_family()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Family FROM family WHERE Family LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Family);
          $new_row['value'] = stripslashes($row->Family);
          $new_row['id'] = stripslashes($row->Family);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }

  public function get_species()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Species FROM species WHERE Species LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Species);
          $new_row['value'] = stripslashes($row->Species);
          $new_row['id'] = stripslashes($row->Species);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }


  public function get_district()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT District FROM district WHERE District LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->District);
          $new_row['value'] = stripslashes($row->District);
          $new_row['id'] = stripslashes($row->District);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }



  public function get_division()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Division FROM division WHERE Division LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Division);
          $new_row['value'] = stripslashes($row->Division);
          $new_row['id'] = stripslashes($row->Division);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }


  public function get_ecological_zones()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT EcoZones FROM ecological_zones WHERE EcoZones LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->EcoZones);
          $new_row['value'] = stripslashes($row->EcoZones);
          $new_row['id'] = stripslashes($row->EcoZones);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }




  public function get_reference()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Reference FROM reference WHERE Reference LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Reference);
          $new_row['value'] = stripslashes($row->Reference);
          $new_row['id'] = stripslashes($row->Reference);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }



  public function get_author()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Author FROM reference WHERE Author LIKE '%$q%' limit 15  ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Author);
          $new_row['value'] = stripslashes($row->Author);
          $new_row['id'] = stripslashes($row->Author);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }


  public function get_year()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Year FROM reference WHERE Year LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Year);
          $new_row['value'] = stripslashes($row->Year);
          $new_row['id'] = stripslashes($row->Year);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }





  public function get_h_m()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT H_m FROM rd WHERE H_m LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->H_m);
          $new_row['value'] = stripslashes($row->H_m);
          $new_row['id'] = stripslashes($row->H_m);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }

  public function get_volume_m3()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Volume_m3 FROM rd WHERE Volume_m3 LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Volume_m3);
          $new_row['value'] = stripslashes($row->Volume_m3);
          $new_row['id'] = stripslashes($row->Volume_m3);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }


  public function get_fao_biome()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT FAOBiomes FROM faobiomes WHERE FAOBiomes LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->FAOBiomes);
          $new_row['value'] = stripslashes($row->FAOBiomes);
          $new_row['id'] = stripslashes($row->FAOBiomes);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }



  public function get_title()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Title FROM reference WHERE Title LIKE '%$q%' limit 15 ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Title);
          $new_row['value'] = stripslashes($row->Title);
          $new_row['id'] = stripslashes($row->Title);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }



  public function get_keyword()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT Keywords FROM reference WHERE Keywords LIKE '%$q%' limit 15 ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Keywords);
          $new_row['value'] = stripslashes($row->Keywords);
          $new_row['id'] = stripslashes($row->Keywords);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }



  public function get_keyword_all()
  {
    if (isset($_GET['term'])) {
      $keyword = strtolower($_GET['term']);
      $result = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
       LEFT JOIN species s ON r.Species_ID=s.ID_Species
       LEFT JOIN family f ON r.Family_ID=f.ID_Family
       LEFT JOIN genus g ON r.Genus_ID=g.ID_Family
       LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
       LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
       LEFT JOIN division d ON r.Division=d.ID_Division
       LEFT JOIN district dis ON r.District =dis.ID_District
       where dis.District LIKE '%$keyword%' OR r.H_m LIKE '%$keyword%' OR ref.Reference LIKE '%$keyword%'
       OR b.FAOBiomes LIKE '%$keyword%' OR s.Species  LIKE '%$keyword%'
       OR f.Family LIKE '%$keyword%' OR g.Genus LIKE '%$keyword%'
       OR ref.Year LIKE '%$keyword%' OR r.Volume_m3 LIKE '%$keyword%' OR r.DBH_cm LIKE '%$keyword%'
       group by r.ID order by r.ID desc ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->Species);
          $new_row['value'] = stripslashes($row->Species);
          $new_row['id'] = stripslashes($row->Species);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }




  public function get_h_tree_avg()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT H_tree_avg FROM wd WHERE H_tree_avg LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->H_tree_avg);
          $new_row['value'] = stripslashes($row->H_tree_avg);
          $new_row['id'] = stripslashes($row->H_tree_avg);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }



  public function get_h_tree_min()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT  H_tree_min FROM wd WHERE H_tree_min LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->H_tree_min);
          $new_row['value'] = stripslashes($row->H_tree_min);
          $new_row['id'] = stripslashes($row->H_tree_min);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }


  public function get_h_tree_max()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT  H_tree_max FROM wd WHERE H_tree_max LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->H_tree_max);
          $new_row['value'] = stripslashes($row->H_tree_max);
          $new_row['id'] = stripslashes($row->H_tree_max);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }




  public function get_dbh_tree_avg()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT DBH_tree_avg FROM wd WHERE DBH_tree_avg LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->DBH_tree_avg);
          $new_row['value'] = stripslashes($row->DBH_tree_avg);
          $new_row['id'] = stripslashes($row->DBH_tree_avg);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }




  public function get_dbh_tree_min()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT DBH_tree_min FROM wd WHERE DBH_tree_min LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->DBH_tree_min);
          $new_row['value'] = stripslashes($row->DBH_tree_min);
          $new_row['id'] = stripslashes($row->DBH_tree_min);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }


  public function get_dbh_tree_max()
  {
    if (isset($_GET['term'])) {
      $q = strtolower($_GET['term']);
      $result = $this->db->query("SELECT DBH_tree_max FROM wd WHERE DBH_tree_max LIKE '%$q%' ")->result();
      $row_set = array();
      if (!empty($result)) {
        foreach ($result as $row) {
          $new_row['label'] = stripslashes($row->DBH_tree_max);
          $new_row['value'] = stripslashes($row->DBH_tree_max);
          $new_row['id'] = stripslashes($row->DBH_tree_max);
          $row_set[] = $new_row;
        }
      }
      echo json_encode($row_set);
    }
  }
  public function getImageForSlider($id)
  {
    $img=$this->db->query("SELECT IMAGE_PATH,GALLERY_TITLE FROM home_page_gallery WHERE ID=$id")->row();
    $path=base_url("resources/images/home_page_gallery/".$img->IMAGE_PATH);
    echo "<img src='$path' id='myIm$id' alt='$img->GALLERY_TITLE' style='cursor: pointer;' class='img-responsive imgBody'>";
  }
}
