    <?php

    /**
     
     * @package Admin Panel
     * @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @copyright  2017 ATI Limited Development Group
     
    */

    if (!defined('BASEPATH')) {
        exit('No direct script access allowed');


     /**
     * Website Class
     *
     * Parses URIs and determines routing
     *
     * @package     Admin Panel
     * @subpackage  Admin Panel
     * @category    Admin Panel
     * @author      Rokibuzzaman <rokibuzzaman@atilimited.net>
     *
     */

 }

 class Website extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->user_session) {
            redirect('dashboard/auth/index');
        }
        $this->load->library("form_validation");
        $this->load->model('utilities');
        $this->load->model('Menu_model');
        $this->load->library('upload');
    }

    /**
      * Show all pages in datatable
      * Module Create Form
      
     */

        public function pageSetup() {

            $data["breadcrumbs"] = array(
                "Page" => "dashboard/Website/pageSetup",
                );
            $data['pageTitle'] = "All Page List ";
            $sql = "SELECT t.*, b.*, i.*
            FROM pg_title t
            left JOIN pg_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN pg_images i ON b.BODY_ID = i.BODY_ID GROUP BY t.TITLE_ID;";
            $data['all_pages'] = $this->db->query($sql)->result();
            $data['content_view_page'] = 'setup/pages/all_page';
            $this->template->display($data);
        }


        /**
         * Show Create Page Form 
         * Create page  
         */


            function createPageLink() {
                $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $data["breadcrumbs"] = array(
                        "Page" => "dashboard/website/pageSetup",
                        "Create Page " => "#",
                        );
                    $data['pageTitle'] = "Add Page";
                    $data['content_view_page'] = 'setup/pages/create_page';
                    $this->template->display($data);
                } else {
                        
                          if ($this->utilities->hasInformationByThisId('ati_module_links', array('MODULE_ID' => $this->input->post('txtmoduleId'), 'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")))) == FALSE) {

                           $images = "";
                           $files = $_FILES;
                           $cpt = count($_FILES['userfile']['name']);
                           for ($i = 0; $i < $cpt; $i++) {
                            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                            $this->upload->initialize($this->set_upload_options());
                            $this->upload->do_upload();
                            $fileName = $_FILES['userfile']['name'];
                            $images[] = $fileName;
                        }

                        $count = count($images);
                        $parentId=$this->input->post('txtparentId');
                        if($parentId>0)
                        {
                            $pid=$parentId;
                        }
                        else 
                        {
                            $pid=0;
                        }
                        $title=$this->input->post("TITLE_NAME");
                        $lower=strtolower($title);
                        $uri=str_replace(" ", "-", $lower);
                        $pagelink = array(
                            'PARENT_ID' =>$pid,
                            'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                            'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                            'PG_URI' =>$uri,
                            
                            'ORDER_NO' => $this->input->post('ORDER_NO'),
                            'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                            'CRE_BY' => $this->user_session["USER_ID"]
                            );
                        $pageTitleIdmax =$this->db->insert( 'pg_title',$pagelink);
                        
                        if($pageTitleIdmax != ''){
                            $pg_body = array(
                                'TITLE_ID' => $this->db->insert_id(),
                                'BODY_DESC' => $this->input->post('BODY_DESC')
                                
                                ); 
                            if($pg_body != ""){
                                $pageBodyId =$this->db->insert('pg_body', $pg_body);
                                $last_insert_id = $this->db->insert_id();
                                
                                for ($i=0; $i < $count; $i++) { 
                                    $pg_images = array(
                                        'BODY_ID' => $last_insert_id,
                                        
                                        "IMG_URL" => $images[$i]
                                        );
                                    $pageImg = $this->utilities->insertData($pg_images, 'pg_images');
                   
                                }

                                if ($pageImg == TRUE) {
                                    $this->session->set_flashdata('Success', 'Page Added Successfully.');
                                }
                            }else{
                                $this->session->set_flashdata('Error', 'Sorry ! You Already Added this Page .');
                            }                       
                        }
                    } 
                    redirect('dashboard/Website/pageSetup', 'refresh');
                }
            }

            // public function pr($data)
            // {
            //     echo "<pre>";
            //     print_r($data);
            //     exit;
            // }

        /**
         * Show Edit Page Form 
         * Edit page  
         */

            function updatePageLink($TITLE_ID) {
               $pageData=$data['edit_menu']  = $this->db->query("SELECT * FROM pg_title as pt INNER JOIN pg_body as pd USING(TITLE_ID) WHERE pt.TITLE_ID=$TITLE_ID")->row();
               $bodyId=$pageData->BODY_ID;
               $data['images']  = $this->db->query("SELECT * FROM pg_images WHERE BODY_ID=$bodyId")->result();
               $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
               if ($this->form_validation->run() == FALSE) {
                $data["breadcrumbs"] = array(
                    "Page" => "dashboard/website/pageSetup",
                    "Create Page " => "#",
                    );
                $data['pageTitle'] = "Edit Page";
                $data['TITLE_ID'] = $TITLE_ID;
                            //$data['sql'] = $sql;
                $data['content_view_page'] = 'setup/pages/update_page';
                $this->template->display($data);
                  } else {
                            

                         if ($this->utilities->hasInformationByThisId('ati_module_links', array('MODULE_ID' => $this->input->post('txtmoduleId'), 'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")))) == FALSE) {

                                 $images = "";
                                 $files = $_FILES;
                                 $cpt = count($_FILES["userfile"]["name"]);

                                 for ($i = 0; $i < $cpt; $i++) {
                                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                                    $this->upload->initialize($this->set_upload_options());
                                    $this->upload->do_upload();
                                    $fileName = $_FILES['userfile']['name'];
                                    $images[] = $fileName;
                                    
                                    $pg_images = array(
                                        'BODY_ID' =>$bodyId,

                                        "IMG_URL" => $fileName
                                        );
                                  
                                   if ($fileName != ''){
                                    $pageImg = $this->db->insert('pg_images',$pg_images);
                                }
                       
                                }

                                $count = count($images);

                                $parentId=$this->input->post('txtparentId');
                                if($parentId>0)
                                {
                                    $pid=$parentId;
                                }
                                else 
                                {
                                    $pid=0;
                                }
                                $title=$this->input->post("TITLE_NAME");
                                $lower=strtolower($title);
                                $uri=str_replace(" ", "-", $lower);
                                $pagelink = array(
                                    'PARENT_ID' =>$pid,

                                    'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                                    'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                                    'PG_URI' =>$uri,
                                    'ORDER_NO' => $this->input->post('ORDER_NO'),
                                    'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                                    'CRE_BY' => $this->user_session["USER_ID"]
                                    );

                                $pageTitleIdmax=$this->db->update('pg_title', $pagelink, "TITLE_ID =$TITLE_ID");

                                if($pageTitleIdmax != ''){
                                    $pg_body = array(
                                       'BODY_DESC' => $this->input->post('BODY_DESC')
                                       ); 
                                    if($pg_body != ""){
                                        $pageBodyId =$this->db->update('pg_body', $pg_body,"BODY_ID =$bodyId");
                                        $bodyId=$pageData->BODY_ID;
                                        $body_ID=$this->db->query("SELECT * FROM pg_body as pb INNER JOIN pg_images as pi USING(BODY_ID) WHERE pb.BODY_ID= $bodyId")->row();

                                        if ($pageImg == TRUE) {
                                            $this->session->set_flashdata('Success', 'Page updated Successfully.');
                                        } 
                                         elseif ($pageImg==False) {
                                            $this->session->set_flashdata('Success', 'Page updated Successfully.');
                                        }    
                                        else{
                                            $this->session->set_flashdata('Error', 'Sorry ! You Already updated this Page Name .');
                                        }                   
                                    }
                                    
                                } 
                                redirect('dashboard/Website/updatePageLink/'.$TITLE_ID);
                            }
                        }

                    }

                    function delete_images()
                    {
                        $id = $this->input->post("IMG_ID");
                        $query = $this->db->query("DELETE FROM pg_images WHERE IMG_ID= $id");
          
                        if($query)
                        {
                            return 1;
                        }
                        else
                        {
                            return 0;
                        }
                    }




                    public function deletePage($id)
                    {
                     
                        $attr = array(
                            "TITLE_ID" => $id
                            );
                        return $this->utilities->deleteRowByAttribute("pg_title", $attr);
                        
                    }

                    function set_upload_options() {
                        $config = array();
                        $config['upload_path'] = "./resources/images/page_pic";
                        $config['allowed_types'] = "gif|jpg|png|jpeg";
                        $config['overwrite'] = TRUE;
                        $config['max_size'] = "2048000";
                        $config['max_height'] = "3000";
                        $config['max_width'] = "3000";
                        return $config;
                    }


                    function set_upload_options_edit() {
                        $config = array();
                        $config['upload_path'] = "./resources/images/page_pic";
                        $config['allowed_types'] = "gif|jpg|png|jpeg";
                        $config['overwrite'] = TRUE;
                        $config['max_size'] = "2048000";
                        $config['max_height'] = "3000";
                        $config['max_width'] = "3000";
                        return $config;
                    }



            }
