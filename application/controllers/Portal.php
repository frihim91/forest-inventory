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

    function __construct() {
        parent::__construct();
        $this->load->model('utilities');
        $this->load->model('setup_model');
        $this->load->model('Menu_model');
        $this->load->model('Forestdata_model');
        $this->load->helper(array('html', 

'form'));
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
        $data['post_cat'] = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=1")->row();

        $data['post_cat_two'] = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
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
         $data['post_cat_four'] = $this->db->query("SELECT t.*, c.CAT_ID,c.CAT_NAME,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=4")->result();
        $data['sliders'] = $this->db->query("SELECT * FROM home_page_slider")->result();
        $this->template->display_portal($data);
    }

    public function adasdds($TITLE_ID)
    {
        
    }

    public function details($TITLE_ID, $PG_URI)
    {

        $data['title_name'] = $this->db->query("SELECT TITLE_NAME,TITLE_NAME_BN FROM pg_title WHERE TITLE_ID = $TITLE_ID")->row();
        $data['page_description'] = $this->db->query("SELECT BODY_ID, BODY_DESC FROM pg_body WHERE TITLE_ID = $TITLE_ID")->row();
        $body_id = $data['page_description']->BODY_ID;
        //echo $body_id;exit;
        $data['body_images'] =$this->db->query("SELECT IMG_URL FROM pg_images WHERE BODY_ID = $body_id")->result();
        $data['content_view_page'] = 'portal/pageContent';
        $this->template->display_portal($data);
    }




     /**
     
      * Show all homepage post
      
      
     */

      public function post_details($TITLE_ID ,$PG_URI)
    {
        $data['title_name'] = $this->db->query("SELECT TITLE_NAME,TITLE_NAME_BN FROM post_title WHERE TITLE_ID = $TITLE_ID")->row();
        $data['post_description'] = $this->db->query("SELECT BODY_ID, BODY_DESC FROM post_body WHERE TITLE_ID = $TITLE_ID")->row();
        $body_id = $data['post_description']->BODY_ID;
        //echo $body_id;exit;
        $data['body_images'] =$this->db->query("SELECT IMG_URL FROM post_images WHERE BODY_ID = $body_id")->result();
        $data['content_view_page'] = 'portal/postContent';
        $this->template->display_portal($data);
    }


    public function viewSliderData()
    {
        $data['sliders'] = $this->db->query("SELECT * FROM home_page_slider")->result();
        $data['content_view_page'] = 'portal/viewSliderData';
        $this->template->display($data);
    }

    public function addImageinSlider()
    {
        if(isset($_POST['title']))
        {

            //$titles = count($this->input->post('title'));
            $title = $this->input->post('title');
            $descript = $this->input->post('descript');

         
                //echo "test";
                //exit;

                $config['upload_path'] = 'resources/images/home_page_slider/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['main_image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('main_image')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
                
                $data = array(
                    'IMAGE_TITLE' => $title,
                    'IMAGE_DESC' => $descript,
                    'IMAGE_PATH' => $picture
                );

                //$data['IMAGE_PATH'] = 'asdasdsad';

                $this->utilities->insertData($data,'home_page_slider');
                redirect('portal/addImageinSlider');
               }
        
           else
           {
            $data['content_view_page'] = 'portal/addImageinSlider';
            $this->template->display($data);
           }
}  

            public function deleteImage($id)
            {


                //$this->db->query("DELETE FROM home_page_slider WHERE ID = $id");
                $this->utilities->deleteRowByAttribute('home_page_slider', array('ID' => $id));
                redirect('portal/viewSliderData');
            }

   

    /*
     * @methodName search_keyword()
     * @access public
     * @param  none
     * @return Search view page
     */
         public function search_keyword()
         {
                    $keyword = $this->input->post('keyword');
                    $data['results'] = $this->Menu_model->search($keyword);
                    $data['content_view_page'] = 'portal/search_view';
                    $this->template->display_portal($data);
         }


            /*
     * @methodName search_allometricequation()
     * @access public
     * @param  none
     * @return Allometric Equation Search view page
     */
        public function search_allometricequation()
        {
                    $keyword = $this->input->post('keyword');
                    $data['results'] = $this->Forestdata_model->search_allometricequation($keyword);
                    $data['content_view_page'] = 'portal/allometricEquationPage';
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
        $data['family_details'] = $this->db->query("select f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
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
        $data['content_view_page'] = 'portal/allometricEquation';
        $this->template->display_portal($data);
        }


    /*
     * @methodName allometricEquationView()
     * @access public
     * @param  none
     * @return Allometric Equation Menu page
     */

        public function allometricEquationView1()
        {
        $data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_list();
        $data['content_view_page'] = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
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
        $config = array();
        $config["base_url"] = base_url() . "index.php/portal/allometricEquationView";
        $total_ef= $this->db->count_all("ef");

        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;

        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $limit = $config["per_page"] = 20;
        //pagination style start
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        //pagination style end
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['allometricEquationView'] = $this->db->query("SELECT ip.*, e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
         LEFT JOIN species s ON e.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
         LEFT JOIN location l ON e.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         GROUP BY e.ID_Species LIMIT $limit OFFSET $page
        ")->result();
        $data["links"] = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
    }


    /*
     * @methodName allometricEquationDetails()
     * @access public
     * @param  none
     * @return Allometric Equation Details page
     */

        public function allometricEquationDetails($ID_Species)
        {
        $data['allometricEquationDetails'] = $this->Forestdata_model->get_allometric_equation_details($ID_Species);
        $data['content_view_page'] = 'portal/allometricEquationDetails';
        $this->template->display_portal($data);
        }


          /*
     * @methodName rawDataView()
     * @access public
     * @param  none
     * @return Raw Data Menu page
     */

        public function rawDataView1()
        {
        $data['rawDataView'] = $this->Forestdata_model->get_raw_data_list();
        $data['content_view_page'] = 'portal/rawDataView';
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
        
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "index.php/portal/rawDataView";
        $total_rawData = $this->db->count_all("ef");

        $config["total_rows"] = $total_rawData;
        // $config["total_rows"] = 800;

        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $limit = $config["per_page"] = 20;
        //pagination style start
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        //pagination style end
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['rawDataView'] = $this->db->query("SELECT  e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e 
         LEFT JOIN species s ON e.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
         LEFT JOIN location l ON e.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         GROUP BY e.ID_Species LIMIT $limit OFFSET $page
        ")->result();
        $data["links"] = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/rawDataView';
        $this->template->display_portal($data);
    }


    /*
     * @methodName allometricEquationDetails()
     * @access public
     * @param  none
     * @return Allometric Equation Details page
     */

        public function rawDataDetails($ID_Species)
        {
        $data['rawDataDetails'] = $this->Forestdata_model->get_raw_data_details($ID_Species);
        $data['content_view_page'] = 'portal/rawDataDetails';
        $this->template->display_portal($data);
        }




}
