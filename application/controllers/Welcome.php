<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->load->view('welcome_message');
    }

    public function about() {
        $data['pageTitle'] = "About";
        $data['content_view_page'] = 'about_us';
        $data['content_title'] = 'About List';
        $this->template->display($data);
    }

}
