<?php

/**
 * I belong to a file
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged_in')) {
            redirect('dashboard/auth/index', 'refresh');
        }
    }
    /**
     * @methodName index()
     * @param  none
     * Show the admin dashboard page.
     * index function here.
     */


    public function index() {
             $data['total_family'] = $this->db->query("SELECT COUNT(f.ID_Family) as TOTAL_FAMILY FROM family f ")->row();
             $data['total_genus'] = $this->db->query("SELECT COUNT(g.ID_Genus) as TOTAL_GENUS FROM genus g ")->row();
              $data['total_species'] = $this->db->query("SELECT COUNT(s.ID_Species) as TOTAL_SPECIES FROM species s ")->row();
              $data['total_ef'] = $this->db->query("SELECT COUNT(e.ID_EF) as TOTAL_EF FROM ef e")->row();
            $data['content_view_page'] = 'template/blank.php';
            $this->template->display($data);

    }

    /**
     * @methodName dismiss_dashboard_alert()
     * @param  none
     * Show the dashboard dismiss alert.
     * dismiss_dashboard_alert function here.
     */


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
