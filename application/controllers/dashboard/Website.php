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

class Website extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->user_session) {
            redirect('dashboard/auth/index');
        }
        $this->load->library("form_validation");
        $this->load->model('utilities');
        $this->load->model('Menu_model');
        $this->load->library('upload');
        $this->load->library('csvimport');
        $this->load->helper(array(
            'html',
            
            'form'
        ));
        $this->load->model('setup_model');
    }
    
    /**
     * Show all pages in datatable
     
     
     */
    
    public function pageSetup()
    {
        
        $data["breadcrumbs"]       = array(
            "Page" => "dashboard/Website/pageSetup"
        );
        $data['pageTitle']         = "All Page List ";
        $sql                       = "SELECT t.*, b.*, i.*
            FROM pg_title t
            left JOIN pg_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN pg_images i ON b.BODY_ID = i.BODY_ID GROUP BY t.TITLE_ID;";
        $data['all_pages']         = $this->db->query($sql)->result();
        $data['content_view_page'] = 'setup/pages/all_page';
        $this->template->display($data);
    }
    
    
    /**
     * Show Create Page Form 
     * Create page  
     */
    
    
    function createPageLink()
    {
        $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"]       = array(
                "Page" => "dashboard/website/pageSetup",
                "Create Page " => "#"
            );
            $data['pageTitle']         = "Add Page";
            $data['content_view_page'] = 'setup/pages/create_page';
            $this->template->display($data);
        } else {
            
            if ($this->utilities->hasInformationByThisId('ati_module_links', array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink"))
            )) == FALSE) {
                
                $images = "";
                $files  = $_FILES;
                $cpt    = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = $fileName;
                }
                
                $count    = count($images);
                $parentId = $this->input->post('txtparentId');
                if ($parentId > 0) {
                    $pid = $parentId;
                } else {
                    $pid = 0;
                }
                $title          = $this->input->post("TITLE_NAME");
                $lower          = strtolower($title);
                $uri            = str_replace(" ", "-", $lower);
                $pagelink       = array(
                    'PARENT_ID' => $pid,
                    'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                    'TITLE_NAME_BN' => str_replace("'", "''", $this->input->post("TITLE_NAME_BN")),
                    'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                    'SUB_TITLE_BN' => str_replace("'", "''", $this->input->post("SUB_TITLE_BN")),
                    'PG_URI' => $uri,
                    
                    'ORDER_NO' => $this->input->post('ORDER_NO'),
                    'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                    'CRE_BY' => $this->user_session["USER_ID"]
                );
                $pageTitleIdmax = $this->db->insert('pg_title', $pagelink);
                
                if ($pageTitleIdmax != '') {
                    $pg_body = array(
                        'TITLE_ID' => $this->db->insert_id(),
                        'BODY_DESC' => $this->input->post('BODY_DESC')
                        
                    );
                    if ($pg_body != "") {
                        $pageBodyId     = $this->db->insert('pg_body', $pg_body);
                        $last_insert_id = $this->db->insert_id();
                        
                        for ($i = 0; $i < $count; $i++) {
                            $pg_images = array(
                                'BODY_ID' => $last_insert_id,
                                
                                "IMG_URL" => $images[$i]
                            );
                            if ($images[$i] != "") {
                                $pageImg = $this->utilities->insertData($pg_images, 'pg_images');
                            }
                            
                        }
                        
                        if ($pg_body == TRUE) {
                            $this->session->set_flashdata('Success', 'Page Added Successfully.');
                        }
                    } else {
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
    
    function updatePageLink($TITLE_ID)
    {
        $pageData       = $data['edit_menu'] = $this->db->query("SELECT * FROM pg_title as pt INNER JOIN pg_body as pd USING(TITLE_ID) WHERE pt.TITLE_ID=$TITLE_ID")->row();
        $bodyId         = $pageData->BODY_ID;
        $data['images'] = $this->db->query("SELECT * FROM pg_images WHERE BODY_ID=$bodyId")->result();
        $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"]       = array(
                "Page" => "dashboard/website/pageSetup",
                "Create Page " => "#"
            );
            $data['pageTitle']         = "Edit Page";
            $data['TITLE_ID']          = $TITLE_ID;
            //$data['sql'] = $sql;
            $data['content_view_page'] = 'setup/pages/update_page';
            $this->template->display($data);
        } else {
            
            
            if ($this->utilities->hasInformationByThisId('ati_module_links', array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink"))
            )) == FALSE) {
                
                $images = "";
                $files  = $_FILES;
                $cpt    = count($_FILES["userfile"]["name"]);
                
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = $fileName;
                    
                    $pg_images = array(
                        'BODY_ID' => $bodyId,
                        
                        "IMG_URL" => $fileName
                    );
                    
                    if ($fileName != '') {
                        $pageImg = $this->db->insert('pg_images', $pg_images);
                    }
                    
                }
                
                $count = count($images);
                
                $parentId = $this->input->post('txtparentId');
                if ($parentId > 0) {
                    $pid = $parentId;
                } else {
                    $pid = 0;
                }
                $title    = $this->input->post("TITLE_NAME");
                $lower    = strtolower($title);
                $uri      = str_replace(" ", "-", $lower);
                $pagelink = array(
                    'PARENT_ID' => $pid,
                    
                    'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                    'TITLE_NAME_BN' => str_replace("'", "''", $this->input->post("TITLE_NAME_BN")),
                    'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                    'SUB_TITLE_BN' => str_replace("'", "''", $this->input->post("SUB_TITLE_BN")),
                    'PG_URI' => $uri,
                    'ORDER_NO' => $this->input->post('ORDER_NO'),
                    'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                    'CRE_BY' => $this->user_session["USER_ID"]
                );
                
                $pageTitleIdmax = $this->db->update('pg_title', $pagelink, "TITLE_ID =$TITLE_ID");
                
                if ($pageTitleIdmax != '') {
                    $pg_body = array(
                        'BODY_DESC' => $this->input->post('BODY_DESC')
                    );
                    if ($pg_body != "") {
                        $pageBodyId = $this->db->update('pg_body', $pg_body, "BODY_ID =$bodyId");
                        $bodyId     = $pageData->BODY_ID;
                        $body_ID    = $this->db->query("SELECT * FROM pg_body as pb INNER JOIN pg_images as pi USING(BODY_ID) WHERE pb.BODY_ID= $bodyId")->row();
                        
                        if ($pageImg == TRUE) {
                            $this->session->set_flashdata('Success', 'Page updated Successfully.');
                        } elseif ($pageImg == False) {
                            $this->session->set_flashdata('Success', 'Page updated Successfully.');
                        } else {
                            $this->session->set_flashdata('Error', 'Sorry ! You Already updated this Page Name .');
                        }
                    }
                    
                }
                redirect('dashboard/Website/updatePageLink/' . $TITLE_ID);
            }
        }
        
    }
    
    function delete_images()
    {
        $id    = $this->input->post("IMG_ID");
        $query = $this->db->query("DELETE FROM pg_images WHERE IMG_ID= $id");
        
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }


 
    
    
    
    
    public function deletePage($id)
    {
        
        $attr = array(
            "TITLE_ID" => $id
        );
        // return $this->utilities->deleteRowByAttribute("pg_title", $attr);
        if ($this->utilities->deleteRowByAttribute("pg_title", $attr)) {
            $this->session->set_flashdata('Error', ' Page Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Page Not Deleted Successfull.');
        }
        
    }
    function set_upload_options()
    {
        $config                  = array();
        $config['upload_path']   = "./resources/images/page_pic";
        $config['allowed_types'] = "gif|jpg|png|jpeg";
        $config['overwrite']     = TRUE;
        $config['max_size']      = "2048000";
        $config['max_height']    = "3000";
        $config['max_width']     = "3000";
        return $config;
    }
    
    
    function set_upload_options_edit()
    {
        $config                  = array();
        $config['upload_path']   = "./resources/images/page_pic";
        $config['allowed_types'] = "gif|jpg|png|jpeg";
        $config['overwrite']     = TRUE;
        $config['max_size']      = "2048000";
        $config['max_height']    = "3000";
        $config['max_width']     = "3000";
        return $config;
    }
    
    
    
    /**
    
    * Show all post in datatable
    
    
    */
    
    public function postSetup()
    {
        
        $data["breadcrumbs"]       = array(
            "Post" => "dashboard/Website/postSetup"
        );
        $data['pageTitle']         = "All Post List ";
        $sql                       = "SELECT t.*,c.CAT_ID,c.CAT_NAME, b.*, i.*
            FROM post_title t
            left JOIN post_category c ON t.CAT_ID = c.CAT_ID
            left JOIN post_body b ON t.TITLE_ID = b.TITLE_ID
            left JOIN post_images i ON b.BODY_ID = i.BODY_ID GROUP BY t.TITLE_ID;";
        $data['all_posts']         = $this->db->query($sql)->result();
        $data['content_view_page'] = 'setup/posts/all_post';
        $this->template->display($data);
    }
    
    
    
    /**
     * Show Create Post Form 
     * Create post  
     */
    
    
    function createPostLink()
    {
        $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"]       = array(
                "Page" => "dashboard/website/postSetup",
                "Create Page " => "#"
            );
            $data['pageTitle']         = "Add Page";
            $data['content_view_page'] = 'setup/posts/create_post';
            $this->template->display($data);
        } else {
            
            if ($this->utilities->hasInformationByThisId('ati_module_links', array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink"))
            )) == FALSE) {
                
                $images = "";
                $files  = $_FILES;
                $cpt    = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $this->upload->initialize($this->set_upload_options_post());
                    $this->upload->do_upload();
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = $fileName;
                }
                
                $count = count($images);
                $catId = $this->input->post('txtcategoryId');
                if ($catId > 0) {
                    $pcatid = $catId;
                } else {
                    $pcatid = 0;
                }
                $title          = $this->input->post("TITLE_NAME");
                $lower          = strtolower($title);
                $uri            = str_replace(" ", "-", $lower);
                $postlink       = array(
                    'CAT_ID' => $pcatid,
                    'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                    'TITLE_NAME_BN' => str_replace("'", "''", $this->input->post("TITLE_NAME_BN")),
                    'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                    'SUB_TITLE_BN' => str_replace("'", "''", $this->input->post("SUB_TITLE_BN")),
                    'PG_URI' => $uri,
                    
                    'ORDER_NO' => $this->input->post('ORDER_NO'),
                    'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                    'CRE_DT' => date('Y-m-d H:i:s', time()),
                    'CRE_BY' => $this->user_session["USER_ID"]
                );
                $postTitleIdmax = $this->db->insert('post_title', $postlink);
                
                if ($postTitleIdmax != '') {
                    $post_body = array(
                        'TITLE_ID' => $this->db->insert_id(),
                        'BODY_DESC' => $this->input->post('BODY_DESC')
                        
                    );
                    if ($post_body != "") {
                        $postBodyId     = $this->db->insert('post_body', $post_body);
                        $last_insert_id = $this->db->insert_id();
                        
                        for ($i = 0; $i < $count; $i++) {
                            $post_images = array(
                                'BODY_ID' => $last_insert_id,
                                
                                "IMG_URL" => $images[$i]
                            );
                            
                            if ($images[$i] != "") {
                                $postImg = $this->utilities->insertData($post_images, 'post_images');
                            }
                            
                            
                        }
                        
                        if ($post_body == TRUE) {
                            $this->session->set_flashdata('Success', 'Post Added Successfully.');
                        }
                    } else {
                        $this->session->set_flashdata('Error', 'Sorry ! You Already Added this Post .');
                    }
                }
            }
            redirect('dashboard/Website/postSetup', 'refresh');
        }
    }
    
    
    
    
    function updatePostLink($TITLE_ID)
    {
        $postData       = $data['edit_menu'] = $this->db->query("SELECT * FROM post_title as pt INNER JOIN post_body as pd USING(TITLE_ID) WHERE pt.TITLE_ID=$TITLE_ID")->row();
        $bodyId         = $postData->BODY_ID;
        $data['images'] = $this->db->query("SELECT * FROM post_images WHERE BODY_ID=$bodyId")->result();
        $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"]       = array(
                "Post" => "dashboard/website/postSetup",
                "Create Page " => "#"
            );
            $data['pageTitle']         = "Edit Page";
            $data['TITLE_ID']          = $TITLE_ID;
            //$data['sql'] = $sql;
            $data['content_view_page'] = 'setup/posts/update_post';
            $this->template->display($data);
        } else {
            
            
            if ($this->utilities->hasInformationByThisId('ati_module_links', array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink"))
            )) == FALSE) {
                
                $images = "";
                $files  = $_FILES;
                $cpt    = count($_FILES["userfile"]["name"]);
                
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $this->upload->initialize($this->set_upload_options_post());
                    $this->upload->do_upload();
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = $fileName;
                    
                    $post_images = array(
                        'BODY_ID' => $bodyId,
                        
                        "IMG_URL" => $fileName
                    );
                    
                    if ($fileName != '') {
                        $postImg = $this->db->insert('post_images', $post_images);
                    }
                    
                }
                
                $count = count($images);
                
                $catId = $this->input->post('txtcategoryId');
                if ($catId > 0) {
                    $pcatid = $catId;
                } else {
                    $pcatid = 0;
                }
                $title    = $this->input->post("TITLE_NAME");
                $lower    = strtolower($title);
                $uri      = str_replace(" ", "-", $lower);
                $postlink = array(
                    'CAT_ID' => $pcatid,
                    
                    'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                    'TITLE_NAME_BN' => str_replace("'", "''", $this->input->post("TITLE_NAME_BN")),
                    'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                    'SUB_TITLE_BN' => str_replace("'", "''", $this->input->post("SUB_TITLE_BN")),
                    'PG_URI' => $uri,
                    'ORDER_NO' => $this->input->post('ORDER_NO'),
                    'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                    'CRE_DT' => date('Y-m-d H:i:s', time()),
                    'CRE_BY' => $this->user_session["USER_ID"]
                );
                
                $postTitleIdmax = $this->db->update('post_title', $postlink, "TITLE_ID =$TITLE_ID");
                
                if ($postTitleIdmax != '') {
                    $post_body = array(
                        'BODY_DESC' => $this->input->post('BODY_DESC')
                    );
                    if ($post_body != "") {
                        $postBodyId = $this->db->update('post_body', $post_body, "BODY_ID =$bodyId");
                        $bodyId     = $postData->BODY_ID;
                        $body_ID    = $this->db->query("SELECT * FROM post_body as pb INNER JOIN post_images as pi USING(BODY_ID) WHERE pb.BODY_ID= $bodyId")->row();
                        
                        if ($postImg == TRUE) {
                            $this->session->set_flashdata('Success', 'Post updated Successfully.');
                        } elseif ($postImg == False) {
                            $this->session->set_flashdata('Success', 'Post updated Successfully.');
                        } else {
                            $this->session->set_flashdata('Error', 'Sorry ! You Already updated this Post Name .');
                        }
                    }
                    
                }
                redirect('dashboard/Website/updatePostLink/' . $TITLE_ID);
            }
        }
        
    }
    
    
    
    function delete_images_post()
    {
        $id    = $this->input->post("IMG_ID");
        $query = $this->db->query("DELETE FROM post_images WHERE IMG_ID= $id");
        
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
    
    
    public function deletePost($id)
    {
        
        $attr = array(
            "TITLE_ID" => $id
        );
        // return $this->utilities->deleteRowByAttribute("post_title", $attr);
        if ($this->utilities->deleteRowByAttribute("post_title", $attr)) {
            $this->session->set_flashdata('Error', ' Post Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Post Not Deleted Successfull.');
        }
        
    }
    
    function set_upload_options_post()
    {
        $config                  = array();
        $config['upload_path']   = "./resources/images/post_pic";
        $config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
        $config['overwrite']     = False;
        $config['max_size']      = "2048000455555555";
        $config['max_height']    = "2048000455555555";
        $config['max_width']     = "2048000455555555";
        return $config;
    }
    
    
    
    
    function uploadForestDate1()
    {
        $this->form_validation->set_rules('TITLE_NAME', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"]       = array(
                "Upload Image Page" => "dashboard/website/uploadForestDate",
                "Upload Image " => "#"
            );
            $data['pageTitle']         = "Upload Forest Data";
            $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        } else {
            
            if ($this->utilities->hasInformationByThisId('ati_module_links', array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink"))
            )) == FALSE) {
                
                $images = "";
                $files  = $_FILES;
                $cpt    = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = $fileName;
                }
                
                $count    = count($images);
                $parentId = $this->input->post('txtparentId');
                if ($parentId > 0) {
                    $pid = $parentId;
                } else {
                    $pid = 0;
                }
                $title          = $this->input->post("TITLE_NAME");
                $lower          = strtolower($title);
                $uri            = str_replace(" ", "-", $lower);
                $pagelink       = array(
                    'PARENT_ID' => $pid,
                    'TITLE_NAME' => str_replace("'", "''", $this->input->post("TITLE_NAME")),
                    'SUB_TITLE' => str_replace("'", "''", $this->input->post("SUB_TITLE")),
                    'PG_URI' => $uri,
                    
                    'ORDER_NO' => $this->input->post('ORDER_NO'),
                    'ACTIVE_STAT' => (isset($_POST['ACTIVE_STAT'])) ? 1 : 0,
                    'CRE_BY' => $this->user_session["USER_ID"]
                );
                $pageTitleIdmax = $this->db->insert('pg_title', $pagelink);
                
                if ($pageTitleIdmax != '') {
                    $pg_body = array(
                        'TITLE_ID' => $this->db->insert_id(),
                        'BODY_DESC' => $this->input->post('BODY_DESC')
                        
                    );
                    if ($pg_body != "") {
                        $pageBodyId     = $this->db->insert('pg_body', $pg_body);
                        $last_insert_id = $this->db->insert_id();
                        
                        for ($i = 0; $i < $count; $i++) {
                            $pg_images = array(
                                'BODY_ID' => $last_insert_id,
                                
                                "IMG_URL" => $images[$i]
                            );
                            $pageImg   = $this->utilities->insertData($pg_images, 'pg_images');
                            
                        }
                        
                        if ($pageImg == TRUE) {
                            $this->session->set_flashdata('Success', 'Page Added Successfully.');
                        }
                    } else {
                        $this->session->set_flashdata('Error', 'Sorry ! You Already Added this Page .');
                    }
                }
            }
            redirect('dashboard/Website/pageSetup', 'refresh');
        }
    }
    
    
    
    
    function uploadForestData2()
    {
        
        $data["breadcrumbs"] = array(
            "Upload Image Page" => "dashboard/website/uploadForestDate",
            "Upload Image " => "#"
        );
        $data['pageTitle']   = "Upload Forest Data";
        
        //$data['addressbook'] = $this->csv_model->get_addressbook();
        $data['error'] = ''; //initialize image upload error array to empty
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = '1000';
        
        $this->load->library('upload', $config);
        
        
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            
            $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        } else {
            $file_data = $this->upload->data();
            $file_path = '.resources/uploads/' . $file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'plot_plot_id' => $row['plot_plot_id'],
                        'lf_lf_id' => $row['lf_lf_id'],
                        '_lf_photos_position' => $row['_lf_photos_position'],
                        'lf_photo' => $row['lf_photo'],
                        'pic_pos' => $row['pic_pos'],
                        'pic_pos_label' => $row['pic_pos_label']
                    );
                    $this->Menu_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url() . 'csv');
                //echo "<pre>"; print_r($insert_data);
            } else
                $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        }
        
    }
    
    
    function uploadForestData()
    {
        if ($_POST) {
            $sourcePath     = $_FILES['userfile']['tmp_name'];
            $tableName      = $this->input->post("table_name");
            $tableCoulmn    = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'")->result();
            $temporary      = explode(".", $_FILES["userfile"]["name"]);
            $file_extension = end($temporary);
            $targetPath     = "resources/uploads/" . $_FILES['userfile']['name'];
            $fileRename     = $this->fileRename();
            $succes         = move_uploaded_file($sourcePath, "resources/uploads/" . $fileRename . "." . $file_extension);
            if (!$succes) {
                
                if (!$_FILES['userfile']['tmp_name']):
                    $this->session->set_flashdata('Error', 'Csv Data not Imported Succesfully');
                    redirect('dashboard/Website/uploadForestData', 'refresh');
                    
                    $data['content_view_page'] = 'setup/forestData/upload_data';
                    $this->template->display($data);
                endif;
            } else {
                
                $filePath = "resources/uploads/" . $fileRename . "." . $file_extension;
                if ($this->csvimport->get_array($filePath)) {
                    $csv_array = $this->csvimport->get_array($filePath);
                    
                    foreach ($csv_array as $key => $row) {
                        $insert_data = array();
                        for ($i = 0; $i < sizeof($tableCoulmn); $i++) {
                            $col               = $tableCoulmn[$i]->COLUMN_NAME;
                            $data              = $row[$col];
                            $insert_data[$col] = $data;
                        }
                        
                        $this->Menu_model->insert_csv($insert_data, $tableName);
                        
                        
                    }
                    $this->session->set_flashdata('Success', 'Csv Data Imported Succesfully');
                    redirect('dashboard/Website/uploadForestData', 'refresh');
                } else
                    if (!$_FILES['userfile']['tmp_name']):
                        $data['error']             = "Error occured";
                        $data['content_view_page'] = 'setup/forestData/upload_data';
                        $this->template->display($data);
                    endif;
            }
        } else {
            $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        }
        
        
        
    }
    
    
    
    function uploadForestData1()
    {
        
        if ($_POST) {
            $sourcePath     = $_FILES['userfile']['tmp_name'];
            $tableName      = $this->input->post("table_name");
            $tableCoulmn    = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'")->result();
            $temporary      = explode(".", $_FILES["userfile"]["name"]);
            $file_extension = end($temporary);
            $targetPath     = "resources/uploads/" . $_FILES['userfile']['name'];
            $fileRename     = $this->fileRename();
            $succes         = move_uploaded_file($sourcePath, "resources/uploads/" . $fileRename . "." . $file_extension);
            if (!$succes) {
                
                if (!$_FILES['userfile']['tmp_name']):
                    $this->session->set_flashdata('Error', 'Csv Data not Imported Succesfully');
                    redirect('dashboard/Website/uploadForestData', 'refresh');
                    
                    $data['content_view_page'] = 'setup/forestData/upload_data';
                    $this->template->display($data);
                endif;
            } else {
                
                $filePath = "resources/uploads/" . $fileRename . "." . $file_extension;
                if ($this->csvimport->get_array($filePath)) {
                    $csv_array = $this->csvimport->get_array($filePath);
                    
                    foreach ($csv_array as $key => $row) {
                        $insert_data = array();
                        for ($i = 0; $i < sizeof($tableCoulmn); $i++) {
                            $col               = $tableCoulmn[$i]->COLUMN_NAME;
                            $data              = $row[$col];
                            $insert_data[$col] = $data;
                        }
                        
                        $this->Menu_model->insert_csv($insert_data, $tableName);
                        $this->session->set_flashdata('Success', 'Csv Data Imported Succesfully');
                        redirect('dashboard/Website/uploadForestData', 'refresh');
                    }
                } else
                    if (!$_FILES['userfile']['tmp_name']):
                        $data['error']             = "Error occured";
                        $data['content_view_page'] = 'setup/forestData/upload_data';
                        $this->template->display($data);
                    endif;
            }
        } else {
            $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        }
        
    }
    
    
    function fileRename()
    {
        $date = new DateTime();
        $name = $date->format('YmdHis');
        Return $name;
    }
    
    
    public function viewGalleryData()
    {
        $data['gallery']           = $this->db->query("SELECT * FROM home_page_gallery")->result();
        $data['content_view_page'] = 'setup/gallery/viewGalleryData';
        $this->template->display($data);
    }


      public function viewVideo()
    {
        $data['video']           = $this->db->query("SELECT * FROM video")->result();
        $data['content_view_page'] = 'setup/video/viewVideo';
        $this->template->display($data);
    }

    public function addVideo()
    {
       if (isset($_POST['Title'])) {
            $titleName = $this->input->post('Title');
            $urlVideo  = $this->input->post('url');
            $vDescript = $this->input->post('video_description');
           $data = array(
                'Title' => $titleName,
                'url' => $urlVideo,
                'video_description' => $vDescript
              
            );

            //$data['IMAGE_PATH'] = 'asdasdsad';

            $this->utilities->insertData($data, 'video');
            $this->session->set_flashdata('Success', 'Video Added Successfully.');
            redirect('dashboard/Website/viewVideo');
        }

        else {
            $data['content_view_page'] = 'setup/video/addVideo';
            $this->template->display($data);
        }
    }


      public function editVideo()
      {
            $ID = $this->uri->segment(4);
            $titleName = $this->input->post('Title');
            $urlVideo  = $this->input->post('url');
            $vDescript = $this->input->post('video_description');
                $data = array(
                'Title' => $titleName,
                'url' => $urlVideo,
                'video_description' => $vDescript
              
            );

              //$data['IMAGE_PATH'] = 'asdasdsad';

              //$this->utilities->insertData($data, 'home_page_slider');
               if($this->db->update('video', $data, array('ID' => $ID)))
               {
              $this->session->set_flashdata('Success', 'New Video Updated Successfully.');
              redirect('dashboard/website/viewVideo');
            }


          else {
              $data['content_view_page'] = 'setup/video/editVideo';
              $this->template->display($data);
          }
      }


    public function deleteVideo($ID)
    {

        $attr = array(
            "ID" => $ID
        );

        if ($this->utilities->deleteRowByAttribute("video", $attr)) {
            $this->session->set_flashdata('Error', ' Video Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Video Not Deleted Successfull.');
        }

    }


    public function updateVideo($ID)
    {
        $data['ID']          = $ID;
        //$data['images'] = $this->db->query("SELECT * FROM home_page_gallery WHERE ID=$ID")->result();
        $data['edit_video']           = $this->db->query("SELECT * FROM video WHERE video.ID=$ID")->row();
        $data['content_view_page'] = 'setup/video/editVideo';
        $this->template->display($data);
    }

    private function pr($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }

     public function addReferenceData()
    {
       if (isset($_POST['Reference'])) {

            //$titles = count($this->input->post('title'));
            $refName    = $this->input->post('Reference');
            $author = $this->input->post('Author');
            $year = $this->input->post('Year');
            $refTitle = $this->input->post('Title');
            $journal = $this->input->post('Journal');
            $volume = $this->input->post('Volume');
            $issue = $this->input->post('Issue');
            $page = $this->input->post('Page');
            $url = $this->input->post('URL');
            $pdf_label = $this->input->post('PDF_label');

            //echo "test";
            //exit;
            $config['upload_path']   = 'resources/pdf';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            //$config['max_width'] = '1600';
            //$config['max_height'] = '900';
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
                'Reference' => $refName,
                'Author' => $author,
                'Year' => $year,
                'Title' => $refTitle,
                'Journal' => $journal,
                'Volume' => $volume,
                'Issue' => $issue,
                'Page' => $page,
                'URL' => $url,
                'PDF_label' => $pdf_label
                //'IMAGE_PATH' => $picture
            );

            //$data['IMAGE_PATH'] = 'asdasdsad';

            $this->utilities->insertData($data, 'reference');
            $this->session->set_flashdata('Success', 'Reference Data Added Successfully.');
            redirect('dashboard/Website/viewReferenceData');
        }

        else {
            $data['content_view_page'] = 'setup/reference/addReferenceData';
            $this->template->display($data);
        }
    }



     public function editReferenceData()
      {
            $ID_Reference = $this->uri->segment(4);
            $refName    = $this->input->post('Reference');
            $author = $this->input->post('Author');
            $year = $this->input->post('Year');
            $refTitle = $this->input->post('Title');
            $journal = $this->input->post('Journal');
            $volume = $this->input->post('Volume');
            $issue = $this->input->post('Issue');
            $page = $this->input->post('Page');
            $url = $this->input->post('URL');
            $pdf_label = $this->input->post('PDF_label');

              $config['upload_path']   = 'resources/pdf/';
              $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
              //$config['max_width'] = '1600';
              //$config['max_height'] = '900';
              $config['file_name']     = $_FILES['main_image']['name'];

              //Load upload library and initialize configuration
              $this->load->library('upload', $config);
              $this->upload->initialize($config);

              if ($this->upload->do_upload('main_image')) {
                  $uploadData = $this->upload->data();
                  $picture    = $uploadData['file_name'];
                     $data = array(
                        'Reference' => $refName,
                        'Author' => $author,
                        'Year' => $year,
                        'Title' => $refTitle,
                        'Journal' => $journal,
                        'Volume' => $volume,
                        'Issue' => $issue,
                        'Page' => $page,
                        'URL' => $url,
                        'PDF_label' => $pdf_label
              );

              } else {
                     $data = array(
                        'Reference' => $refName,
                        'Author' => $author,
                        'Year' => $year,
                        'Title' => $refTitle,
                        'Journal' => $journal,
                        'Volume' => $volume,
                        'Issue' => $issue,
                        'Page' => $page,
                        'URL' => $url,
                        'PDF_label' => $pdf_label

              );

              }


              //$data['IMAGE_PATH'] = 'asdasdsad';

              //$this->utilities->insertData($data, 'home_page_slider');
               if($this->db->update('reference', $data, array('ID_Reference' => $ID_Reference)))
               {
              $this->session->set_flashdata('Success', 'New Reference Data Updated Successfully.');
              redirect('dashboard/Website/viewReferenceData');
            }


          else {
              $data['content_view_page'] = 'dashboard/Website/editReferenceData';
              $this->template->display($data);
          }
      }


      function delete_pdf()
    {
        $ID_Reference    = $this->input->post("ID_Reference");
        //echo $ID;exit();
        $query = $this->db->query("UPDATE reference SET PDF_label = NULL WHERE ID_Reference=$ID_Reference");

        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }


         public function deleteReference($ID_Reference)
    {

        $attr = array(
            "ID_Reference" => $ID_Reference
        );

        if ($this->utilities->deleteRowByAttribute("reference", $attr)) {
            $this->session->set_flashdata('Error', ' Reference Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Reference Not Deleted Successfull.');
        }

    }



         public function updateReferenceData($ID_Reference)
    {
        $data['ID_Reference']          = $ID_Reference;
        //$data['images'] = $this->db->query("SELECT * FROM home_page_gallery WHERE ID=$ID")->result();
        $data['edit_reference']           = $this->db->query("SELECT * FROM reference WHERE reference.ID_Reference=$ID_Reference")->row();
        $data['content_view_page'] = 'setup/reference/editReferenceData';
        $this->template->display($data);
    }


     public function viewReferenceData()
    {
        $data['reference']           = $this->db->query("SELECT * FROM reference ORDER BY  ID_Reference DESC")->result();
        $data['content_view_page'] = 'setup/reference/viewReferenceData';
        $this->template->display($data);
    }
    
    
    
    public function addImageinGallery()
    {
        if (isset($_POST['title'])) {
           // $this->pr($_POST);
            
            //$titles = count($this->input->post('title'));
            $title    = $this->input->post('title');
            $descript = $this->input->post('descript');
            
            
            //echo "test";
            //exit;
            
            $config['upload_path']   = 'resources/images/home_page_gallery/';
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
            $updData=array(
                'IS_FEAT'=>'N'
                );
        $this->db->update('home_page_gallery', $updData);
            
            $data = array(
                'GALLERY_TITLE' => $title,
                'GALLERY_DESC' => $descript,
                'IS_FEAT' => (isset($_POST['IS_FEAT'])) ? 'Y': 'N',
                'IMAGE_PATH' => $picture
            );
            
            //$data['IMAGE_PATH'] = 'asdasdsad';
            
            $this->utilities->insertData($data, 'home_page_gallery');
            $this->session->set_flashdata('Success', 'New Gallery Added Successfully.');
            redirect('dashboard/Website/viewGalleryData');
        }
        
        else {
            $data['content_view_page'] = 'setup/gallery/addImageinGallery';
            $this->template->display($data);
        }
    }




      public function editGallerySlider()
      {
              $gallery_id = $this->uri->segment(4);
              $title    = $this->input->post('title');
              $descript = $this->input->post('descript');
              $config['upload_path']   = 'resources/images/home_page_gallery/';
              $config['allowed_types'] = 'jpg|jpeg|png|gif';
              //$config['max_width'] = '1600';
              //$config['max_height'] = '900';
              $config['file_name']     = $_FILES['main_image']['name'];

              //Load upload library and initialize configuration
              $this->load->library('upload', $config);
              $this->upload->initialize($config);

              if ($this->upload->do_upload('main_image')) {
                  $uploadData = $this->upload->data();
                  $picture    = $uploadData['file_name'];
                $updData=array(
                'IS_FEAT'=>'N'
                );
                $this->db->update('home_page_gallery', $updData);
                   $data = array(
                  'GALLERY_TITLE' => $title,
                  'GALLERY_DESC' => $descript,
                  'IS_FEAT' => (isset($_POST['IS_FEAT'])) ? 'Y' : 'N',
                  'IMAGE_PATH' => $picture
              );

              } else {
                     $data = array(
                  'GALLERY_TITLE' => $title,
                  'GALLERY_DESC' => $descript,
                  'IS_FEAT' => (isset($_POST['IS_FEAT'])) ? 'Y' : 'N'

              );

              }


              //$data['IMAGE_PATH'] = 'asdasdsad';

              //$this->utilities->insertData($data, 'home_page_slider');
               if($this->db->update('home_page_gallery', $data, array('ID' => $gallery_id)))
               {
              $this->session->set_flashdata('Success', 'New Gallery Updated Successfully.');
              redirect('dashboard/Website/viewGalleryData');
            }


          else {
              $data['content_view_page'] = 'setup/gallery/editGalleryData';
              $this->template->display($data);
          }
      }

    
     /*
     * @methodName upload_file_page()
     * @access public
     * @param  none
     * @return Upload File in Page
     */
    
    
    public function upload_file_page()
    {
        //$config['upload_path'] = './uploads_file'; 
        
        $config['upload_path']   = 'uploads_file';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|pdf|doc|docx|csv|xls|xlsx';
        $config['file_name']     = $_FILES['main_image']['name'];
        // load upload library and initialize config file
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        
        if ($this->upload->do_upload('file')) {
            $image_data = $this->upload->data();
            
            $json = array(
                'filelink' => base_url("uploads_file/{$image_data['file_name']}")
            );
            echo stripslashes(json_encode($json));
        }
    }
    
    /*
     * @methodName upload_file_post()
     * @access public
     * @param  none
     * @return Upload File in Post
     */
    
    
    public function upload_file_post()
    {
        //$config['upload_path'] = './uploads_file'; 
        
        $config['upload_path']   = 'uploads_file';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|pdf|doc|docx|csv|xls|xlsx';
        $config['file_name']     = $_FILES['main_image']['name'];
        // load upload library and initialize config file
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        
        if ($this->upload->do_upload('file')) {
            $image_data = $this->upload->data();
            
            $json = array(
                'filelink' => base_url("uploads_file/{$image_data['file_name']}")
            );
            echo stripslashes(json_encode($json));
        }
    }



   /*
     * @methodName updateGalleryData()
     * @access public
     * @param  $id
     * @return edit Gallery 
     */
    

      public function updateGalleryData($ID)
    {
        $data['ID']          = $ID;
        $data['images'] = $this->db->query("SELECT * FROM home_page_gallery WHERE ID=$ID")->result();
        $data['edit_gallery']           = $this->db->query("SELECT * FROM home_page_gallery WHERE home_page_gallery.ID=$ID")->row();
        $data['content_view_page'] = 'setup/gallery/editGalleryData';
        $this->template->display($data);
    }


     /*
     * @methodName delete_edit_gallery_images()
     * @access public
     * @param  $id
     * @return delete edit Gallery Image
     */


    function delete_edit_gallery_images()
    {
        $ID    = $this->input->post("ID");
        //echo $ID;exit();
        $query = $this->db->query("UPDATE home_page_gallery SET IMAGE_PATH = NULL WHERE ID=$ID");

        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }


    
    
    
    
    /*
     * @methodName deleteImageGallery()
     * @access public
     * @param  $id
     * @return delete Gallery 
     */
    
    
    public function deleteImageGallery($id)
    {
        
        $attr = array(
            "ID" => $id
        );
        //return $this->utilities->deleteRowByAttribute("ef", $attr);
        if ($this->utilities->deleteRowByAttribute("home_page_gallery", $attr)) {
            $this->session->set_flashdata('Error', ' Gallery Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Gallery Not Deleted Successfull.');
        }
        
    }
    
    
    
    
    
    
    
    
}
