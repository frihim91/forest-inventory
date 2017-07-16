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
            where t.CAT_ID=2")->result();
        $data['post_cat_three'] = $this->db->query("SELECT t.*,c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=3")->result();
        $data['post_cat_four']  = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=4")->result();
        $data['sliders']        = $this->db->query("SELECT * FROM home_page_slider")->result();
         $data['gallery']           = $this->db->query("SELECT * FROM home_page_gallery")->result();
        $this->template->display_portal($data);
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
    
    public function addImageinSlider()
    {
        if (isset($_POST['title'])) {
            
            //$titles = count($this->input->post('title'));
            $title    = $this->input->post('title');
            $descript = $this->input->post('descript');
            
            
            //echo "test";
            //exit;
            
            $config['upload_path']   = 'resources/images/home_page_slider/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
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
    public function search_allometricequation_key()
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_document";
        $total_ef           = $this->db->count_all("reference");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
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
         where r.Title LIKE '%$Title%' OR r.Author LIKE '%$Author%' OR r.Keywords LIKE '%$Keywords%' order by r.Title desc LIMIT $limit OFFSET $page
         
         ")->result();
         $data["links"]                  = $this->pagination->create_links();
         $data['content_view_page']      = 'portal/viewLibraryPage';
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
        $Genus   = $this->input->post('Genus');
        $Species = $this->input->post('Species');
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_tax";
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
         where g.Genus LIKE '%$Genus%' or s.Species LIKE '%$Species%'
         group by a.ID_AE order by a.ID_AE desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
        
    }
    
    
    
    /*
     * @methodName search_allometricequation_loc()
     * @access public
     * @param  none
     * @return Allometric Equation location wise Search view page
     */
    public function search_allometricequation_loc()
    {
        $District  = $this->input->post('District');
        $EcoZones = $this->input->post('EcoZones');
        $Division = $this->input->post('Division');
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_loc";
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
         where dis.District LIKE '%$District%' or eco.EcoZones LIKE '%$EcoZones%'or d.Division LIKE '%$Division%'
        group by a.ID_AE order by a.ID_AE desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
        
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_allometricequation_ref";
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
         where ref.Reference LIKE '%$Reference%' or ref.Author LIKE '%$Author%'
         or ref.Year LIKE '%$Year%'
         group by a.ID_AE order by a.ID_AE desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
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
        $data['family_details']    = $this->db->query("select f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
            FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT from family as f ORDER BY f.Family 
            ")->result();
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
    
    public function allometricEquationViewjson()
    {
        $data['allometricEquationViewJson'] = $this->Forestdata_model->get_allometric_equation_json();
        //$data['content_view_page']      = 'portal/allometricEquationPage';
        //$this->template->display_portal($data);
    }


          /*
     * @methodName allometricEquationViewcsv()
     * @access public
     * @param  none
     * @return Allometric Equation CSV Menu page
     */


 public function allometricEquationViewcsv()
 {
 $allometricEquationViewcsv=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Family   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
         LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         group by a.ID_AE order by a.ID_AE asc")->result_array();
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


 public function biomassExpansionFacViewcsv()
 {
 $biomassExpansionFacView=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         GROUP BY e.ID_EF order by e.ID_EF asc")->result_array();
 //$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
 header("Content-type: application/csv");
 header("Content-Disposition: attachment; filename=\"Biomass Expansion Factor".".csv\"");
 header("Pragma: no-cache");
 header("Expires: 0");
 $handle = fopen('php://output', 'w');
 fputcsv($handle, array('ID_EF',' ID_LandCover', 'Species', 'AgeRange','ID_AgeRange','HeightRange','ID_HeightRange','VolumeRange',' ID_VolumeRange','BasalRange'
  ,'ID_BasalArea','Value','Unit','ID_EF_IPCC','Reference','Lower_Confidence_Limit','Upper_Confidence_Limit ','Type_of_Parameter','latitude  '
  ,'longitude  ','Country  ','Division  ',' District  ',' Upazila',' Union',' FAO_biome',' WWF_Eco_zone',' BFI_zone'));
                    $i = 1;
                    foreach ($biomassExpansionFacView as $data) {
                        fputcsv($handle, array($data["ID_EF"], $data["ID_LandCover"], $data["Species"], $data["AgeRange"], $data["ID_AgeRange"], $data["HeightRange"], $data["ID_HeightRange"]
                          , $data["VolumeRange"], $data["ID_VolumeRange"], $data["BasalRange"], $data["ID_BasalArea"], $data["Value"], $data["Unit"], $data["ID_EF_IPCC"], $data["Reference"]
                          , $data["Lower_Confidence_Limit"], $data["Upper_Confidence_Limit"], $data["Type_of_Parameter"], $data["latitude"], $data["longitude"], $data["Country"], $data["Division"], $data["District"], 
                          $data["Upazila"], $data["Union"], $data["FAO_biome"], $data["WWF_Eco_zone"], $data["BFI_zone"]));
                        $i++;
                    }
                        fclose($handle);
                    exit;
 }
    
    public function biomassExpansionFacViewjson()
    {
        $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomass_expansion_factor_json();
        //$data['content_view_page']      = 'portal/allometricEquationPage';
        //$this->template->display_portal($data);
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
    
    
    public function allometricEquationViewSpeciesData($specis_id)
    {
        $this->load->library('pagination');
      //  $specis_id = $this->input->post('Species');
        
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/allometricEquationViewSpeciesData/".$specis_id;
        $total_ef           = $this->db->count_all("ae");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $limit                     = $config["per_page"];
        $config["uri_segment"] = 4;
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
        $data['allometricEquationDatagrid'] = $this->Forestdata_model->get_allometric_equation_grid_Speciesdata($specis_id,$limit,$page);
        //print_r($data['allometricEquationDatagrid']);exit();
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/allometricEquation';
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
    
    
    public function biomassExpansionFacSpeciesView($specis_id)
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/biomassExpansionFacSpeciesView/".$specis_id;
        $total_ef           = $this->db->count_all("ef");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $limit                     = $config["per_page"];
        $config["uri_segment"] = 4;
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        // ")->result();
         $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor_species($specis_id,$limit,$page);
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/biomassExpansionFacView';
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


        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_key";
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
        // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
         $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         where dis.District LIKE '%$keyword%' OR e.Value LIKE '%$keyword%' OR r.Reference LIKE '%$keyword%'
         OR b.FAOBiomes LIKE '%$keyword%' OR s.Species  LIKE '%$keyword%'
         OR f.Family LIKE '%$keyword%' OR g.Genus LIKE '%$keyword%'
         OR r.Year LIKE '%$keyword%'
          GROUP BY e.ID_EF order by e.ID_EF desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
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
        $Species = $this->input->post('Species');
        
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_tax";
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
        // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
         $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         where g.Genus LIKE '%$Genus%' or s.Species LIKE '%$Species%'
         GROUP BY e.ID_EF order by e.ID_EF desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
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
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_tax";
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
        // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
         $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         where dis.District LIKE '%$District%' or eco.EcoZones LIKE '%$EcoZones%' or d.Division LIKE '%$Division%'
         GROUP BY e.ID_EF order by e.ID_EF desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
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
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/search_biomas_expansion_tax";
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
        // $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
         $data['biomassExpansionFacView'] = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         where r.Reference LIKE '%$Reference%' or r.Author LIKE '%$Author%'
         or r.Year LIKE '%$Year%'
         GROUP BY e.ID_EF order by e.ID_EF desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/biomassExpansionFacView';
        $this->template->display_portal($data);
    }








     /*
     * @methodName biomassExpansionFacDetails()
     * @access public
     * @param  none
     * @return Biomass Expension Factor Details page
     */
    
    public function biomassExpansionFacDetails($ID_Species)
    {
        $data['biomassExpansionFacDetails'] = $this->Forestdata_model->get_biomas_expension_factor_details($ID_Species);
        $data['content_view_page']         = 'portal/biomassExpansionFacDetails';
        $this->template->display_portal($data);
    }
    
    
    
    /*
     * @methodName allometricEquationDetails()
     * @access public
     * @param  none
     * @return Allometric Equation Details page
     */
    
    public function allometricEquationDetails($ID_Species,$ID_AE)
    {
        $data['allometricEquationDetails'] = $this->Forestdata_model->get_allometric_equation_details($ID_Species,$ID_AE);
        $data['content_view_page']         = 'portal/allometricEquationDetails';
        $this->template->display_portal($data);
    }


    /*
     * @methodName allometricEquationDetailsPdf()
     * @access public
     * @param  none
     * @return Allometric Equation Details PDF page
     */


     public function allometricEquationDetailsPdf($ID_Species,$ID_AE) 
     {
        $data['allometricEquationDetails'] = $this->Forestdata_model->get_allometric_equation_details($ID_Species,$ID_AE);
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
    



    public function rawDataViewjson()
    {
        $data['rawDataViewjson']       = $this->Forestdata_model->get_raw_data_grid_json();
       
    }



          /*
     * @methodName rawDataViewcsv()
     * @access public
     * @param  none
     * @return Raw Data CSV Menu page
     */


 public function rawDataViewcsv()
 {
 $rawDataViewcsv=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Family   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         group by r.ID order by r.ID asc")->result_array();
 //$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
 header("Content-type: application/csv");
 header("Content-Disposition: attachment; filename=\"Raw Data".".csv\"");
 header("Pragma: no-cache");
 header("Expires: 0");
 $handle = fopen('php://output', 'w');
 fputcsv($handle, array('ID','ID_RD', 'ID_tree', 'Tree_type','Vegetation_type','Division','District','Upazila','Union','Latitude'
  ,'Longitude','Zone_FAO',' ID_FAO_Biomes','Ecoregion_Udvardy','Ecoregion_WWF','Division_Bailey','Zone_Holdridge',' Bioecological_zones_Bangladesh_IUCN ','Family_ID'
  ,'Genus_ID','Species_ID','Subspecies','DBH_cm','H_m','Collar_girth','CD_m',' Veg_Component','B','Bd','Bg','Bt',' L','Rb','Rf','Rm','S','T','F','F_Bole_kg','F_Branch_kg','F_Foliage_kg','F_Foliage_and_twigs_kg','F_Bark_kg'
  ,'F_Fruit_kg','F_Stump_kg','F_Buttress_kg','F_Roots_kg','Volume_m3','Volume_bole_m3','WD_AVG_gcm3','D_Bole_kg','D_Branch_kg','D_Foliage_g','  D_Foliage_kg',' D_Branch_g',' Field61'
  ,'D_Bark_g','D_Bark_kg',' D_Stem_with_Bark_g','D_Stem_without_Bark_g',' D_Stem_without_Bark_kg',' D_Stump_kg',' D_Buttress_kg','D_Roots_kg',' ABG_g','ABG_kg',' BGB_kg','ID_Reference','Contributor',' Operator','Remark'
  ,'Contact'));
                    $i = 1;
                    foreach ($rawDataViewcsv as $data) {
                        fputcsv($handle, array($data["ID"], $data["ID_RD"], $data["ID_tree"], $data["Tree_type"], $data["Vegetation_type"], $data["Division"], $data["District"]
                          , $data["Upazila"], $data["Union"], $data["Latitude"], $data["Longitude"], $data["Zone_FAO"], $data["ID_FAO_Biomes"], $data["Ecoregion_Udvardy"], $data["Ecoregion_WWF"]
                          , $data["Division_Bailey"], $data["Zone_Holdridge"], $data["Bioecological_zones_Bangladesh_IUCN"], $data["Family_ID"], $data["Genus_ID"], $data["Species_ID"], $data["Subspecies"], $data["DBH_cm"], 
                          $data["H_m"], $data["Collar_girth"], $data["CD_m"], $data["Veg_Component"],$data["B"],$data["Bd"],$data["Bg"],$data["Bt"],$data["L"],$data["Rb"]
                          ,$data["Rf"],$data["S"],$data["T"],$data["F"],$data["F_Bole_kg"],$data["F_Branch_kg"],$data["F_Foliage_kg"],$data["F_Foliage_and_twigs_kg"],$data["F_Bark_kg"],$data["F_Fruit_kg"],$data["F_Stump_kg"],$data["F_Buttress_kg"],$data["F_Roots_kg"],$data["Volume_m3"],$data["Volume_bole_m3"]
                          ,$data["WD_AVG_gcm3"],$data["D_Bole_kg"],$data["D_Branch_kg"],$data["D_Foliage_g"],$data["D_Foliage_kg"],$data["D_Branch_g"],$data["Field61"],$data["D_Bark_g"],$data["D_Bark_kg"],$data["D_Stem_with_Bark_g"] ,$data["D_Stem_without_Bark_g"],$data["D_Stem_without_Bark_kg"],$data["D_Stump_kg"],$data["D_Buttress_kg"],$data["D_Roots_kg"],$data["ABG_g"],$data["ABG_kg"],$data["BGB_kg"],$data["ID_Reference"],
                          $data["Contributor"],$data["Operator"],$data["Remark"] ,$data["Contact"]));
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
    



    public function woodDensityViewjson()
    {
        $data['woodDensityViewjson']       = $this->Forestdata_model->get_wood_density_grid_json();
       
    }




           /*
     * @methodName woodDensityViewcsv()
     * @access public
     * @param  none
     * @return Wood Density CSV Menu page
     */


 public function woodDensityViewcsv()
 {
 $woodDensityViewcsv=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
         LEFT JOIN species s ON w.ID_Species=s.ID_Species
         LEFT JOIN family f ON w.ID_Family=f.ID_Family
         LEFT JOIN genus g ON w.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
         LEFT JOIN location l ON w.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones  
         order by w.ID_WD asc")->result_array();
 //$biomassExpansionFacView= $this->Forestdata_model->get_biomass_expansion_factor_json();
 header("Content-type: application/csv");
 header("Content-Disposition: attachment; filename=\"Wood Densities".".csv\"");
 header("Pragma: no-cache");
 header("Expires: 0");
 $handle = fopen('php://output', 'w');
 fputcsv($handle, array('ID_WD',' Tree_type', 'Vegetation_type', 'Region','ID_Location_group','ID_Location','Group_Location','Location','Longitude','Latitude'
  ,'Zone_FAO','Ecoregion_Udvardy','Ecoregion_WWF','Division_Bailey','Zone_Holdridge','ID_family','ID_genus','ID_species','Subspecies'
  ,'Species_local_name_iso','ID_reference','ID_RD','H_tree_avg','H_tree_max','DBH_tree_avg','DBH_tree_min','DBH_tree_max',' m_WD','MC_m',' MC_V','CR','FSP','Methodology_Green','Methodology_Airdry','Bark','Methodology_Ovendry'
  ,'Density_green','Density_airdry','Density_ovendry','MC_Density','Data_origin','Data_type','Samples_per_tree','Number_of_trees','SD','Min','Max','H_measure','Bark_distance','CV','Convert_BD','Contributor','Operator','Remark','Contact'));
                    $i = 1;
                    foreach ($woodDensityViewcsv as $data) {
                        fputcsv($handle, array($data["ID_WD"], $data["Tree_type"], $data["Vegetation_type"], $data["Region"], $data["ID_Location_group"], $data["ID_Location"], $data["Group_Location"]
                          , $data["Location"], $data["Longitude"], $data["Latitude"], $data["Zone_FAO"], $data["Ecoregion_Udvardy"], $data["Ecoregion_WWF"], $data["Division_Bailey"], $data["Zone_Holdridge"]
                          , $data["ID_family"], $data["ID_genus"], $data["ID_species"], $data["Subspecies"], $data["Species_local_name_iso"], $data["ID_reference"],$data["ID_RD"], $data["H_tree_avg"], 
                           $data["H_tree_min"],$data["H_tree_max"],$data["DBH_tree_avg"], $data["DBH_tree_min"],$data["DBH_tree_max"],$data["m_WD"],$data["MC_m"],$data["V_WD"],$data["MC_V"],$data["CR"],$data["FSP"]
                          ,$data["Methodology_Green"],$data["Methodology_Airdry"],$data["Bark"],$data["Methodology_Ovendry"],$data["Density_green"],$data["Density_airdry"],$data["Density_ovendry"],$data["MC_Density"],$data["Data_origin"],$data["Data_type"],$data["Samples_per_tree"],$data["Number_of_trees"]
                          ,$data["SD"],$data["Min"],$data["Max"],$data["H_measure"],$data["Bark_distance"],$data["CV"],$data["Convert_BD"],$data["Contributor"],$data["Operator"],$data["Remark"],$data["Contact"]
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
    
    public function rawDataSpeciesView($specis_id)
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/rawDataSpeciesView/".$specis_id;
        $total_rawData      = $this->db->count_all("rd");
        
        $config["total_rows"] = $total_rawData;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        $config["uri_segment"]     = 4;
        $limit                     = $config["per_page"];
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['rawDataView'] = $this->Forestdata_model->get_raw_data_grid_species($specis_id,$limit,$page);
        $data["links"]             = $this->pagination->create_links();
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
        
     
        $data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid_species($specis_id,$limit,$page);
        //print_r( $data['woodDensitiesView']);exit();
        $data["links"]             = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/woodDensitiesView';
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_rawequation_key";
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
        
        $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
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
         group by r.ID order by r.ID desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]             = $this->pagination->create_links();
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
        $Species = $this->input->post('Species');
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_rawequation_tax";
        $total_rawData      = $this->db->count_all("ef");
        
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
        
        $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Family   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         where g.Genus LIKE '%$Genus%' or s.Species LIKE '%$Species%'
         group by r.ID order by r.ID desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_rawequation_loc";
        $total_rawData      = $this->db->count_all("ef");
        
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
        
        $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Family   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         where dis.District LIKE '%$District%' or b.FAOBiomes LIKE '%$FAOBiomes%' or d.Division LIKE '%$Division%'
         group by r.ID order by r.ID desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_rawequation_ref";
        $total_rawData      = $this->db->count_all("ef");
        
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
        
        $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Family   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         where ref.Reference LIKE '%$Reference%' or ref.Author LIKE '%$Author%'
         or ref.Year LIKE '%$Year%'
         group by r.ID order by r.ID desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_rawequation_raw";
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
        
        $data['rawDataView']       = $this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Family   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         where r.H_m LIKE '%$H_m%' or r.Volume_m3 LIKE '%$Volume_m3%'
         group by r.ID order by r.ID desc LIMIT $limit OFFSET $page
        ")->result();
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_key";
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
        $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
        LEFT JOIN species s ON w.ID_Species=s.ID_Species
        LEFT JOIN family f ON w.ID_Family=f.ID_Family
        LEFT JOIN genus g ON w.ID_Family=g.ID_Family   
        LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
        LEFT JOIN location l ON w.ID_Location=l.ID_Location
        LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
        LEFT JOIN division d ON l.ID_Division=d.ID_Division
        LEFT JOIN district dis ON l.ID_District =dis.ID_District
        LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
        LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones 
        where dis.District LIKE '%$keyword%' OR w.Density_green LIKE '%$keyword%' OR r.Reference LIKE '%$keyword%'
        OR b.FAOBiomes LIKE '%$keyword%' OR s.Species  LIKE '%$keyword%'
        OR f.Family LIKE '%$keyword%' OR g.Genus LIKE '%$keyword%'
        OR r.Year LIKE '%$keyword%'
        order by w.ID_WD desc LIMIT $limit OFFSET $page
        ")->result();
     
        //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_raw";
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
        $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
        LEFT JOIN species s ON w.ID_Species=s.ID_Species
        LEFT JOIN family f ON w.ID_Family=f.ID_Family
        LEFT JOIN genus g ON w.ID_Family=g.ID_Family   
        LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
        LEFT JOIN location l ON w.ID_Location=l.ID_Location
        LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
        LEFT JOIN division d ON l.ID_Division=d.ID_Division
        LEFT JOIN district dis ON l.ID_District =dis.ID_District
        LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
        LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones 
        where w.H_tree_avg LIKE '%$H_tree_avg%' or w.H_tree_min LIKE '%$H_tree_min%'or w.H_tree_max LIKE '%$H_tree_max%'
        or w.DBH_tree_avg LIKE '%$DBH_tree_avg%'or w.DBH_tree_min LIKE '%$DBH_tree_min%' or w.DBH_tree_max LIKE '%$DBH_tree_max%'
        order by w.ID_WD desc LIMIT $limit OFFSET $page
        ")->result();
     
        //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_tax";
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
        $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
        LEFT JOIN species s ON w.ID_Species=s.ID_Species
        LEFT JOIN family f ON w.ID_Family=f.ID_Family
        LEFT JOIN genus g ON w.ID_Family=g.ID_Family   
        LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
        LEFT JOIN location l ON w.ID_Location=l.ID_Location
        LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
        LEFT JOIN division d ON l.ID_Division=d.ID_Division
        LEFT JOIN district dis ON l.ID_District =dis.ID_District
        LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
        LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones 
        where g.Genus LIKE '%$Genus%' or s.Species LIKE '%$Species%'
        order by w.ID_WD desc LIMIT $limit OFFSET $page
        ")->result();
     
        //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_loc";
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
        $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
        LEFT JOIN species s ON w.ID_Species=s.ID_Species
        LEFT JOIN family f ON w.ID_Family=f.ID_Family
        LEFT JOIN genus g ON w.ID_Family=g.ID_Family   
        LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
        LEFT JOIN location l ON w.ID_Location=l.ID_Location
        LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
        LEFT JOIN division d ON l.ID_Division=d.ID_Division
        LEFT JOIN district dis ON l.ID_District =dis.ID_District
        LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
        LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones 
        where dis.District LIKE '%$District%' or eco.EcoZones LIKE '%$EcoZones%'
        or d.Division LIKE '%$Division%'
        order by w.ID_WD desc LIMIT $limit OFFSET $page
        ")->result();
     
        //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/search_woodDensities_ref";
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
        $data['woodDensitiesView']       = $this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
        LEFT JOIN species s ON w.ID_Species=s.ID_Species
        LEFT JOIN family f ON w.ID_Family=f.ID_Family
        LEFT JOIN genus g ON w.ID_Family=g.ID_Family   
        LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
        LEFT JOIN location l ON w.ID_Location=l.ID_Location
        LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
        LEFT JOIN division d ON l.ID_Division=d.ID_Division
        LEFT JOIN district dis ON l.ID_District =dis.ID_District
        LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
        LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones 
        where r.Reference LIKE '%$Reference%' or r.Author LIKE '%$Author%'
         or r.Year LIKE '%$Year%'
        order by w.ID_WD desc LIMIT $limit OFFSET $page
        ")->result();
     
        //$data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/woodDensitiesViewSearch';
        $this->template->display_portal($data);
    }
    
    
    
    
    
    
    
    
    
    /*
     * @methodName rawDataDetails()
     * @access public
     * @param  none
     * @return Raw Data Details page
     */
    
    public function rawDataDetails($ID_Species)
    {
        $data['rawDataDetails']    = $this->Forestdata_model->get_raw_data_details($ID_Species);
        $data['content_view_page'] = 'portal/rawDataDetails';
        $this->template->display_portal($data);
    }



      /*
     * @methodName woodDensitiesDetails()
     * @access public
     * @param  none
     * @return Wood Densities Details page
     */
    
    public function woodDensitiesDetails($ID_Species)
    {
        $data['woodDensitiesDetails']    = $this->Forestdata_model->get_wood_densities_details($ID_Species);
        $data['content_view_page'] = 'portal/woodDensitiesDetails';
        $this->template->display_portal($data);
    }



     /*
     * @methodName rawDataDetailsPdf()
     * @access public
     * @param  none
     * @return Raw Data Details PDF page
     */


     public function rawDataDetailsPdf($ID_Species) 
     {
        $data['rawDataDetails']    = $this->Forestdata_model->get_raw_data_details($ID_Species);
        include('mpdf/mpdf.php');
        $mpdf = new mPDF('utf-8', 'A4', '', '', 20, 20, 25, 47, 10, 10);
        $mpdf->SetTitle('Raw Data Details');
        $mpdf->mirrorMargins = 1;
        $report = $this->load->view('portal/rawDataDetailsPdf', $data, TRUE);
        $mpdf->WriteHTML($report);
        $mpdf->Output();
     }


       /*
     * @methodName rawDataDetailsPdf()
     * @access public
     * @param  none
     * @return Raw Data Details PDF page
     */


     public function woodDensitiesPdf($ID_Species) 
     {
        $data['woodDensitiesDetails']    = $this->Forestdata_model->get_wood_densities_details($ID_Species);
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


     public function biomassExpansionFacPdf($ID_Species) 
     {
         $data['biomassExpansionFacDetails'] = $this->Forestdata_model->get_biomas_expension_factor_details($ID_Species);
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
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/viewLibraryPage";
        $total_ef           = $this->db->count_all("reference");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
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
        $data['reference']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc LIMIT $limit OFFSET $page")->result();
        $data['reference_author']           = $this->db->query("SELECT * FROM reference order by ID_Reference asc")->result();
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/viewLibraryPage';
        $this->template->display_portal($data);
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









    
    
    
    
    
    
    
    




    
    
    
    
}
