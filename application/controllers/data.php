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
        if(!isset($_SESSION['user_logged']))
        {
          redirect('/');
        }
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
    
    
    
    public function allometricEquationViewtrr()
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/data/allometricEquationView";
        $total_ef           = $this->db->count_all("ae");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 5;
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
        
        $data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid();
         //$data['ID_1988EcoZone'] =  $this->Forestdata_model->get_all_ecological_zones();
        $data['EcoZones'] = $this->Forestdata_model->get_all_ecological_zones();
        $data['Zones'] = $this->Forestdata_model->get_all_zones();
        //print_r($data['Zones']);exit;
        $data['Division'] = $this->Forestdata_model->get_all_division();
        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
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




    





      public function allometricEquationViewddd()
    {
        //pagination settings
        $config['base_url'] = site_url('data/allometricEquationView');
        $config['total_rows'] = $this->db->count_all('ae');
        $config['per_page'] = "20";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // get books list
        $data['allometricEquationView'] = $this->Forestdata_model->get_books($config["per_page"], $data['page'], NULL);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
    }






    function search_allometricequation_key_backup()
    {
        // get search string
        $this->load->library('pagination');
        $keyword = ($this->input->post("keyword"))? $this->input->post("keyword") : "NIL";


        $keyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("data/search_allometricequation_key/$keyword");
        $config['total_rows'] = $this->Forestdata_model->get_books_count($keyword);
        $config['per_page'] = "20";
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
        $data['content_view_page'] = 'portal/woodDensitiesView';
        $this->template->display_portal($data);
    }






    
    
    
    
    
    
    
    




    
    
    
    
}
