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
        $this->load->helper(array('html', 

'form'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
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
        $data['post_cat'] = $this->db->query("SELECT t.*, c.*,b.BODY_ID,b.BODY_DESC,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=1")->row();

        $data['post_cat_two'] = $this->db->query("SELECT t.*, c.*,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=2")->result();
        $data['post_cat_three'] = $this->db->query("SELECT t.*, c.*,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID
            where t.CAT_ID=3")->result();
         $data['post_cat_four'] = $this->db->query("SELECT t.*, c.*,b.BODY_ID,b.BODY_DESC,t.PG_URI,b.TITLE_ID,i.IMG_ID,i.IMG_URL,i.BODY_ID
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

        $data['title_name'] = $this->db->query("SELECT TITLE_NAME FROM pg_title WHERE TITLE_ID = $TITLE_ID")->row();
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
        $data['title_name'] = $this->db->query("SELECT TITLE_NAME FROM post_title WHERE TITLE_ID = $TITLE_ID")->row();
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

}
