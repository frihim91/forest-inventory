<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged_in')) {
            redirect('auth/index', 'refresh');
        }
    }

    public function index() {
            $data['content_view_page'] = 'template/blank.php';
            $this->template->display($data);

    }

    public function dismiss_dashboard_alert() {
        $sessionInfo = $this->session->userdata('user_logged_in');
        $alert_no = $this->input->post('al_no');
        $updData = array(
            'ACTIVE' => 0,
            'UPD_BY' => $sessionInfo['USER_ID']
        );
        //print_r($updData); exit;
        $this->utilities->updateData('me_sub_project_report_alert', $updData, array('ALERT_NO' => $alert_no));
    }

}
