<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* @category   FrontData
* @package    data
* @author     Md.Reazul Islam <reazul@atilimited.net>
* @copyright  2017 ATI Limited Development Group
*/

class Data extends CI_Controller
{

  function __construct()
  {

    parent::__construct();
    //echo "<pre>"; print_r($_SESSION);exit();
    /*
    if(!isset($_SESSION['user_logged']))
    {
    redirect('/');
  }
  */
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


/*
* @methodName speciesData()
* @access public
* @param  none
* @return Species List page
*/

public function speciesData()
{
  $data['family_details']    = $this->db->query("select f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
  FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT,(SELECT count(ID) FROM rd as rd WHERE rd.Family_ID=f.ID_Family)
  as RDCOUNT,(SELECT count(ID_AE) FROM ae as ae WHERE ae.Family=f.ID_Family)
  as AECOUNT,(SELECT count(ID_WD) FROM wd as wd WHERE wd.ID_family=f.ID_Family)
  as WDCOUNT,(SELECT COUNT(e.ID_EF) FROM ef e left join species s ON e.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family) EFCOUNT
  from family as f ORDER BY f.Family
  ")->result();
  $data['total_genus_species']    = $this->db->query("select count(*) total_family,(select count(*)  from species) total_species,(select count(*)  from genus) total_genus from family
  ")->row();
  $data['content_view_page'] = 'portal/speciesData';
  $this->template->display_portal($data);
}
private function pr($data)
{
  echo "<pre>";
  print_r($data);
  exit;
}
public function dataSpecies_backup()
{
  $n=$data['family_details']    = $this->db->query("SELECT f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
  FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT,(SELECT count(rd.ID) FROM rd as rd LEFT JOIN species_group sr ON rd.Speciesgroup_ID=sr.Speciesgroup_ID
  LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as RDCOUNT,(SELECT count(ID_AE) FROM ae as ae  LEFT JOIN species s ON ae.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as AECOUNT,(SELECT count(ID_WD) FROM wd as wd LEFT JOIN species s ON wd.ID_species=s.ID_Species  WHERE s.ID_family=f.ID_Family)
  as WDCOUNT,(SELECT COUNT(e.ID_EF) FROM ef e left join species s ON e.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family) EFCOUNT
  from family as f ORDER BY f.Family
  ")->result();
  //  $this->pr($n);
  $k= $data['total_genus_species']    = $this->db->query("select count(*) total_family,(select count(*)  from species) total_species,(select count(*)  from genus) total_genus from family
  ")->row();
  //  $this->pr($k);
  $data['content_view_page'] = 'portal/data/speciesData';
  $this->template->display_portal($data);
}

public function dataSpecies()
{
  $this->load->library('pagination');
  $config             = array();
  $config["base_url"] = base_url() .  "index.php/data/dataSpecies";
  $total_ef=$this->db->query("SELECT f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
    FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT,(SELECT count(rd.ID) FROM rd as rd LEFT JOIN species_group sr ON rd.Speciesgroup_ID=sr.Speciesgroup_ID
    LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as RDCOUNT,(SELECT count(ID_AE) FROM ae as ae  LEFT JOIN species s ON ae.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as AECOUNT,(SELECT count(ID_WD) FROM wd as wd LEFT JOIN species s ON wd.ID_species=s.ID_Species  WHERE s.ID_family=f.ID_Family)
  as WDCOUNT,(SELECT COUNT(e.ID_EF) FROM ef e left join species s ON e.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family) EFCOUNT1
  from family as f ORDER BY f.Family
  ")->num_rows();
        // print_r($this->db->last_query());exit;
        // echo $total_ae;exit;


  $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;

  $config["per_page"]        = 10;
        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
  $limit                     = $config["per_page"] = 10;
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
  $data['family_details'] = $this->db->query("SELECT f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
    FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT,(SELECT count(rd.ID) FROM rd as rd LEFT JOIN species_group sr ON rd.Speciesgroup_ID=sr.Speciesgroup_ID
    LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as RDCOUNT,(SELECT count(ID_AE) FROM ae as ae LEFT JOIN species_group sr ON ae.Species=sr.Speciesgroup_ID LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as AECOUNT,(SELECT count(ID_WD) FROM wd as wd LEFT JOIN species s ON wd.ID_species=s.ID_Species  WHERE s.ID_family=f.ID_Family)
  as WDCOUNT,(SELECT COUNT(e.ID_EF) FROM ef e left join species s ON e.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family) EFCOUNT1,(SELECT count(ID_EF) FROM ef as ef LEFT JOIN species_group sr ON ef.Species=sr.Speciesgroup_ID LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
          as EFCOUNT
  from family as f ORDER BY f.Family LIMIT $limit OFFSET $page
  ")->result();

  $data['family_details_count'] = $this->db->query("SELECT f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
    FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT,(SELECT count(rd.ID) FROM rd as rd LEFT JOIN species_group sr ON rd.Speciesgroup_ID=sr.Speciesgroup_ID
    LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as RDCOUNT,(SELECT count(ID_AE) FROM ae as ae  LEFT JOIN species s ON ae.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family)
  as AECOUNT,(SELECT count(ID_WD) FROM wd as wd LEFT JOIN species s ON wd.ID_species=s.ID_Species  WHERE s.ID_family=f.ID_Family)
  as WDCOUNT,(SELECT COUNT(e.ID_EF) FROM ef e left join species s ON e.Species=s.ID_Species WHERE s.ID_Family=f.ID_Family) EFCOUNT
  from family as f ORDER BY f.Family

  ")->result();
  $k= $data['total_genus_species']    = $this->db->query("select count(*) total_family,(select count(*)  from species) total_species,(select count(*)  from genus) total_genus from family
    ")->row();
  $data["links"]                  = $this->pagination->create_links();

  $data['content_view_page']      = 'portal/data/speciesData';
  $this->template->display_portal($data);
}
public function allometricEqnAjaxData($str)
{

  $input      = $_GET;
  $collection = $this->Forestdata_model->get_allometric_ajax($_GET,$str);
  //$output     = Setuplist :: moduleList($input, $collection);
  $output=$this->datalist->allometricEquationList($input,$collection);
  echo  json_encode($output);
}
public function rawDataAjaxData($str)
{


  $input      = $_GET;
  $collection = $this->Forestdata_model->get_rawdata_ajax($_GET,$str);

  //$output     = Setuplist :: moduleList($input, $collection);
  $output=$this->datalist->rawDataList($input,$collection);
  echo  json_encode($output);
  //$this->pr($collection);

  //$data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid();

}


public function wdAjaxData($str)
{

  $input      = $_GET;
  $collection = $this->Forestdata_model->get_wd_ajax($_GET,$str);
  //$output     = Setuplist :: moduleList($input, $collection);
  $output=$this->datalist->wdDataList($input,$collection);
  echo  json_encode($output);
  //$this->pr($collection);

  //$data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid();

}



public function efAjaxData($str)
{

  $input      = $_GET;
  $collection = $this->Forestdata_model->get_ef_ajax($_GET,$str);
  //$output     = Setuplist :: moduleList($input, $collection);
  $output=$this->datalist->efDataList($input,$collection);
  echo  json_encode($output);
  //$this->pr($collection);

  //$data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid();

}


public function wdAjaxDataSpecies($str,$specis_id)
{

  $input      = $_GET;
  // $total_woodDensities=$this->db->query("SELECT m.*,s.Species,f.Family,wd.Density_green,wd.Latitude,wd.Longitude,r.Reference,r.Year,r.Author FROM (SELECT ID_WD,ID_Species FROM wd w) m
  //      LEFT JOIN wd  ON m.ID_WD=wd.ID_WD
  //      LEFT JOIN reference r ON wd.ID_Reference = r.ID_Reference
  //      LEFT JOIN species s ON m.ID_Species=s.ID_Species
  //      left join family f ON wd.ID_family=f.ID_Family
  //      where wd.ID_species=$specis_id
  //      order by wd.ID_WD desc
  //        ")->num_rows();
  $data['ID_Species'] = $specis_id;
  $collection = $this->Forestdata_model->get_wd_species_ajax($_GET,$str,$specis_id);
  //$output     = Setuplist :: moduleList($input, $collection);
  $output=$this->datalist->wdDataList($input,$collection);
  echo  json_encode($output);
  //$this->pr($collection);

  //$data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid();

}










public function allometricEquationViews()
{


  $data['content_view_page']      = 'portal/page';
  $this->template->display_portal($data);
}




public function search_allometricequation_key()
{
  $ID_AE   = $this->input->post('ID_AE');
  $keyword = $this->input->post('keyword');
  $searchFields=array(
    's.Species'=>$keyword,
    'dis.District'=>$keyword,
    'a.Equation'=>$keyword,
    'a.ID_AE'=>$ID_AE,
    'ref.Reference'=>$keyword,
    'ref.Author'=>$keyword,
    'b.FAOBiomes'=>$keyword,
    'f.Family'=>$keyword,
    'g.Genus'=>$keyword,
    'ref.Year'=>$keyword,
    'a.Latitude'=>$keyword,
    'a.Longitude'=>$keyword,
    'd.Division'=>$keyword

  );

  if(!empty($ID_AE))
  {
    $string="a.ID_AE=$ID_AE";
  }
  else
  {
    $string=$this->searchAttributeString($searchFields);
  }


  //$string=$this->searchAttributeString($searchFields);
  if(!empty($string))
  {
    $this->session->set_userdata('aekeySearchString', $string);
  }
  else
  {
    $string=$this->session->userdata('aekeySearchString');
  }

  if(!empty($keyword)||!empty($ID_AE))
  {
    $this->session->set_userdata('aeSearchStringKeyword', $keyword);
    $this->session->set_userdata('aeSearchStringAE', $ID_AE);

  }

  else
  {
    $keyword=$this->session->userdata('aeSearchStringKeyword');
    $Species=$this->session->userdata('aeSearchStringAE');


  }

  $this->load->library('pagination');
  $config             = array();
  $config["base_url"] = base_url() . "index.php/data/search_allometricequation_key";

  //$config["base_url"] = base_url() . "index.php/portal/search_allometricequation_tax/".$Genus.$Species.$Family;
  // $total_ef           = 50;
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
    where $string")->num_rows();
    //echo $total_ae->total_ae;exit;
    $config["total_rows"] = $total_ae;
    // $total_ef           = $this->db->count_all("ae");

    //$config["total_rows"] = $total_ef;
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


        ")->result();
        $data['keyword']=$keyword;
        $data['ID_AE']=$ID_AE;

        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);

      }





      function search_allometricequation_key55()
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

        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/allometricEquationPage';
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


        $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor();
        // $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,a.location_name,a.LatDD,a.LongDD,
        // fnc_ef_species_data(a.LatDD,a.LongDD) species_desc FROM location a
        // LEFT JOIN group_location b ON a.ID_Location=b.location_id
        // LEFT JOIN ef c ON b.group_id=c.group_location
        // -- LEFT JOIN species d ON c.Species=d.ID_Species
        // LEFT JOIN species_group sr ON c.Species=sr.Speciesgroup_ID
        // LEFT JOIN species d ON sr.ID_Species=d.ID_Species
        // LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
        // WHERE c.ID_EF IS NOT NULL
        // GROUP BY LatDD,LongDD";
        $jsonQuery="SELECT * from __view_emission_fac_search_map e";
        $jsonQueryEncode=base64_encode($jsonQuery);
        $data['jsonQuery']=$jsonQueryEncode;
        $data['content_view_page']      = 'portal/biomassExpansionFacView';
        $this->template->display_portal($data);
      }

      /*
      * @methodName rawDataView()
      * @access public
      * @param  none
      * @return Raw Data Menu page
      */

      public function rawDataView()
      {

        $data['rawDataView'] = $this->Forestdata_model->get_raw_data_grid();
        // $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,a.location_name,a.LatDD,a.LongDD,
        // fnc_rd_species_data(a.LatDD,a.LongDD) species_desc FROM location a
        // LEFT JOIN group_location b ON a.ID_Location=b.location_id
        // LEFT JOIN rd r ON b.group_id=r.location_group
        // LEFT JOIN species_group sr ON r.Speciesgroup_ID=sr.Speciesgroup_ID
        // LEFT JOIN species s ON sr.ID_Species=s.ID_Species
        // LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
        // WHERE r.ID IS NOT NULL
        // GROUP BY LatDD,LongDD";

        $jsonQuery="SELECT * from __view_raw_data_search_map r";
        $jsonQueryEncode=base64_encode($jsonQuery);
        $data['jsonQuery']=$jsonQueryEncode;
        // echo json_encode($data['jsonData']);
        // $this->pr($data['jsonData']);
        $data['content_view_page'] = 'portal/rawDataView';
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


        $data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid();
        $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,a.location_name,a.LatDD,a.LongDD,
        fnc_wd_species_data(a.LatDD,a.LongDD) species_desc FROM location a
        LEFT JOIN group_location b ON a.ID_Location=b.location_id
        LEFT JOIN wd w ON b.group_id=w.location_group
        LEFT JOIN species d ON w.ID_species=d.ID_Species
        LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
        WHERE w.ID_WD IS NOT NULL
        GROUP BY LatDD,LongDD";
        $jsonQueryEncode=base64_encode($jsonQuery);
        $data['jsonQuery']=$jsonQueryEncode;
        $data['content_view_page'] = 'portal/woodDensitiesView';
        $this->template->display_portal($data);
      }
      public function allometricEquationViewtrr()
      {
        $data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid($limit,$page);
        //$data['ID_1988EcoZone'] =  $this->Forestdata_model->get_all_ecological_zones();
        $data['EcoZones'] = $this->Forestdata_model->get_all_ecological_zones();
        $data['Zones'] = $this->Forestdata_model->get_all_zones();
        //print_r($data['Zones']);exit;
        $data['Division'] = $this->Forestdata_model->get_all_division();
        $data['links'] = $this->pagination->create_links();

        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
      }
      public function allometricEquationView()
      {
        //$string=$this->searchAttributeString($validSearchKey);
        $data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid();
        $data['Zones'] = $this->Forestdata_model->get_all_zones();
        //print_r($data['Zones']);exit;
        $data['Division'] = $this->Forestdata_model->get_all_division();
        // $jsonQuery="SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(c.output)) OUTPUT,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,a.location_name,a.LatDD,a.LongDD,
        // fnc_ae_species_data(a.LatDD,a.LongDD) species_desc FROM location a
        // LEFT JOIN group_location b ON a.ID_Location=b.location_id
        // LEFT JOIN ae c ON b.group_id=c.location_group
        // -- LEFT JOIN species d ON c.Species=d.ID_Species
        //  LEFT JOIN species_group sr ON c.Species=sr.Speciesgroup_ID
        // LEFT JOIN species d ON sr.ID_Species=d.ID_Species
        
        // LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
        // WHERE c.ID_AE IS NOT NULL
        // GROUP BY LatDD,LongDD";
        $jsonQuery="SELECT * from __view_allometric_equ_search_map a";
        $jsonQueryEncode=base64_encode($jsonQuery);
        $data['jsonQuery']=$jsonQueryEncode;
        // echo json_encode($data['jsonData']);
        // $this->pr($data['jsonData']);
        $data['content_view_page']      = 'portal/allometricEquationPage';

        $this->template->display_portal($data);
      }

      public function getMapJsonData($query)
      {
        $query1=base64_decode($query);
        
        $conn = new PDO('mysql:host=192.168.0.201;dbname=faobd_db_v2','maruf','maruf');
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
      public function downloadDataFormat($tableName)
      {
          $dbName= $this->db->database;
           $tableCoulmn    = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE
             TABLE_NAME = '$tableName' AND  TABLE_SCHEMA='$dbName'")->result();
           //$this->pr($tableCoulmn);
          $fp = fopen('file.csv', 'w');
          $file = fopen('php://output', 'w');
            $filename = $tableName.'.csv'; 
             header("Content-Description: File Transfer"); 
             header("Content-Disposition: attachment; filename=$filename"); 
             header("Content-Type: application/csv; ");
           $headArray=array();
           foreach($tableCoulmn as $row)
           {
              $headArray[]=$row->COLUMN_NAME;
           }
        $header =$headArray;//array("Username","Name","Gender","Email"); 
          fputcsv($file, $header);
          fclose($file); 
          exit; 

      }

    }
