<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounts extends CI_Controller {
function __construct() {
        parent::__construct();
        $this->load->model('utilities');
        $this->load->model('Account_model');
        $this->load->model('Menu_model');
        $this->load->model('Forestdata_model');
        $this->load->helper(array('html','form'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
    }
    


    public function userRegistration() {
        $data['content_view_page'] = 'account/userRegistration';
        $this->template->display_portal($data);

    }

}
