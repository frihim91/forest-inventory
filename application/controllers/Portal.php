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

            $this->user_session = $this->session->userdata('user_logged_in');
            if (!$this->user_session) {
                redirect('dashboard/auth/index');
            }
            $this->load->model('setup_model');
            $this->load->model('Menu_model');
            $this->load->helper(array('html', 'form'));
            $this->load->library('form_validation');
        }

    /*
     * @methodName index()
     * @access public
     * @param  none
     * @return Fao portal home page
     */

    public function index()
    {
        $this->template->display_portal();
    }


}
