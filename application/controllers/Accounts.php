<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounts extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('utilities');
        $this->load->model('Account_model');
        $this->load->model('Menu_model');
        $this->load->model('Forestdata_model');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library('session');
        //$this->load->library(array('session', 'form_validation', 'email');
        $this->load->library('upload');
        $this->load->helper('url');
    }
    
    /*
     * @methodName userRegistration()
     * @access public
     * @param  none
     * @return Fao portal User Registration Form page
     */

    public function userRegistration() 
    {
        $data['content_view_page'] = 'account/userRegistration';
        $this->template->display_portal($data);

    }
     /*
     * @methodName userRegistration()
     * @access public
     * @param  none
     * @return Fao portal User Registration Form page
     */


     public function userLogin() 
     {
        $data['content_view_page'] = 'account/userLogin';
        $this->template->display_portal($data);

    }

    private function pr($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }
    public function userActivition($id){
        $vinfo=$this->db->query("SELECT ACTIVE_FLAG FROM visitor_info WHERE USER_ID=$id")->row();
        if($vinfo->ACTIVE_FLAG==2)
        {
            $activeStatus = array(
                'ACTIVE_FLAG' => '1',
                );
            if ($this->utilities->updateData('visitor_info', $activeStatus, array('USER_ID' => $id))) {
                $this->session->set_flashdata('Success', 'Your activated successfully.');
                redirect('Accounts/userLogin');
            }
        }

        else 
        {
            $this->session->set_flashdata('Error', 'You are not Successfully activated!.');
            redirect('portal');
        }



    }
        /**
         * Show Create Registration Form 
         * Registration page  
         */


        function createRegistration() {
            $this->form_validation->set_rules('USERPW', 'Password', 'required|matches[password_conf]|min_length[4]|max_length[20]|md5');
            $this->form_validation->set_rules('password_conf', 'Confirm Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['pageTitle'] = "Add Page";
                $data['content_view_page'] = 'setup/pages/create_page';
                $this->template->display_portal($data);
            }else {

                $regInfo = array(
                    'EDUCATION_ID' => $this->input->post('EDUCATION_ID'),
                    'USERPW' => $this->input->post('USERPW'),
                    'TITLE' => str_replace("'", "''", $this->input->post("TITLE")),
                    'FIRST_NAME' => str_replace("'", "''", $this->input->post("FIRST_NAME")),
                    'LAST_NAME' => str_replace("'", "''", $this->input->post("LAST_NAME")),
                    'EMAIL' => $this->input->post('EMAIL'),
                    'ADDRESS' => $this->input->post('ADDRESS'),
                    'FIELD_SUBJECT' => $this->input->post('FIELD_SUBJECT')
                    );

                $regInfomax =$this->db->insert( 'visitor_info',$regInfo);

                if($regInfomax != ''){
                    $Institute = array(
                        'USER_ID' => $this->db->insert_id(),
                        'INSTITUTE_NAME' => $this->input->post('INSTITUTE_NAME'),
                        'INSTITUTE_ADDRESS' => $this->input->post('INSTITUTE_ADDRESS'),
                        'PHONE' => $this->input->post('PHONE'),
                        'FAX' => $this->input->post('FAX')
                        ); 
                    if($Institute != ""){
                      $InstituteInsert = $this->utilities->insertData($Institute, 'institution');
                      if ($InstituteInsert == TRUE) {
                       $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered!  <button data-dismiss="alert" class="close" type="button">×</button></div>');
                   }
               }
               else{
                $this->session->set_flashdata('Error', 'You are not Successfully Registered!.');
            } 
        }                      
    }

    redirect('accounts/userRegistration', 'refresh');
}
}


