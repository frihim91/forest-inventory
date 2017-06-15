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
         where dis.District LIKE '%$District%' or eco.EcoZones LIKE '%$EcoZones%'
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
            FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT from family as f
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
     * @methodName biomassExpansionFacViewjson()
     * @access public
     * @param  none
     * @return Biomass Expansion Factor json Menu page
     */
    
    public function biomassExpansionFacViewjson()
    {
        $data['biomassExpansionFacViewjson'] = $this->Forestdata_model->get_biomass_expansion_factor_json();
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
        where dis.District LIKE '%$District%' or eco.EcoZones LIKE '%$EcoZones%'
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
         where dis.District LIKE '%$District%' or b.FAOBiomes LIKE '%$FAOBiomes%'
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
        $data['reference']           = $this->db->query("SELECT * FROM reference")->result();
        $data['content_view_page'] = 'portal/viewLibraryPage';
        $this->template->display_portal($data);
    }
    




    
    
    
    
}
