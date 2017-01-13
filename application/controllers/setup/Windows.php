<?php

class Windows extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->user_session) {
            redirect('dashboard/auth/index');
        }
    }

    public function index() {
        $data['pageTitle'] = "Window";
        $data["breadcrumbs"] = array(
            "Windows" => "setup/windows/index"
        );
        $data['query'] = $this->db->get('pr_window')->result();
        $data['content_view_page'] = 'setup/window/index';
        $this->template->display($data);
    }

    public function addNew() {
        $this->form_validation->set_rules('WINDOW_NAME', 'Window Name', 'required|callback_window_exists');
        if ($this->form_validation->run() == FALSE) {
            $data['pageTitle'] = "Window";
            $data["breadcrumbs"] = array(
                "Windows" => "setup/windows/index",
                "Add New Windows" => '#'
            );
            $data['content_view_page'] = 'setup/window/window';
            $this->template->display($data);
        } else {
            $udwindono = $this->input->post('UD_WINDOW_NO');
            $name = $this->input->post('WINDOW_NAME');
            $windowFor = $this->input->post('WINDOW_FOR');
            $title = $this->input->post('WINDOW_TITLE');
            $shortTitle = $this->input->post('SHORT_TITLE');
            $db_insert = array(
                'UD_WINDOW_NO' => $udwindono,
                'WINDOW_NAME' => $name,
                'WINDOW_FOR' => $windowFor,
                'WINDOW_TITLE' => $title,
                'SHORT_TITLE' => $shortTitle,
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0
            );
            $this->db->insert('pr_window', $db_insert);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', "Successfully Saved");
            } else {
                $this->session->set_flashdata('Error', "Failed to Add New Window.");
            }
            redirect('setup/windows');
        }
    }

    public function update($id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('WINDOW_NAME', 'Window Name', 'required');
        $data['udwinno'] = $this->utilities->dropdownFromTableWithCondition('pr_window', 'Select Window', 'UD_WINDOW_NO', 'UD_WINDOW_NO', array('ACTIVE' => 1));
        //$this->utilities->dropdownFromTable('pr_window', 'Select', array('ACTIVE' => 1), 'UD_WINDOW_NO');
        $data['previousData'] = $this->utilities->findByAttribute('pr_window', array('PR_WINDOW_NO' => $id));
        //var_dump($data['query6']);exit;
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"] = array(
                "Windows" => "setup/windows/index",
                "Edit Windows Information" => '#'
            );
            $data['content_view_page'] = 'setup/window/window_update';
            $this->template->display($data);
            //$this->load->view('window/window_update', $data);
        } else {
            $udwidowno = $this->input->post('UD_WINDOW_NO');
            $name = $this->input->post('WINDOW_NAME');
            $windowFor = $this->input->post('WINDOW_FOR');
            $title = $this->input->post('WINDOW_TITLE');
            $shortTitle = $this->input->post('SHORT_TITLE');
            $pr_window = array(
                'UD_WINDOW_NO' => $udwidowno,
                'WINDOW_NAME' => $name,
                'WINDOW_FOR' => $windowFor,
                'WINDOW_TITLE' => $title,
                'SHORT_TITLE' => $shortTitle,
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0
            );
            $this->db->update('pr_window', $pr_window, array('PR_WINDOW_NO' => $id));
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', "Windows Information Updated Successfully");
                redirect('setup/windows/index');
            } else {
                $this->session->set_flashdata('Error', "Failed to Updated Windows Successfully.");
                redirect("setup/windows/update/$id");
            }
        }
    }

    public function window_exists($str) {

        $query = $this->db->get_where('pr_window', array('WINDOW_NAME' => $str), 1);

        if ($query->num_rows() == 1) {
            $this->form_validation->set_message('window_exists', "This Window Name Already exist.");
            return false;
        } else {

            return true;
        }
    }

    public function facilities_view() {
        $data['pageTitle'] = "Window Facilities";
        $data["breadcrumbs"] = array(
            "Windows" => "setup/windows/facilities_view"
        );

        $data['query'] = $this->db->query('SELECT m.FACILITIES_NO, m.FACILITIES_NAME, m.PR_WINDOW_NO,
                                    (SELECT WINDOW_NAME FROM pr_window WHERE PR_WINDOW_NO =m.PR_WINDOW_NO )WINDOW_NAME,
                                    m.SELECTION_METHOD,
                                    (SELECT LOOKUP_DATA_NAME FROM lv_selection_methods WHERE NUMB_LOOKUP =m.SELECTION_METHOD )SELECTION_METHOD_NAME,
                                    m.ACTIVE, m.CRE_BY, m.CRE_DT, m.UPD_BY, m.UPD_DT, m.ORG_ID
                                    FROM pr_win_facilities_res m')->result();

        $data['content_view_page'] = 'setup/window/facilities_view';
        $this->template->display($data);
    }

    public function addFacilities() {
        $this->form_validation->set_rules('FACILITIES_NAME', 'Facilites Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['pageTitle'] = "Facilities";
            $data["breadcrumbs"] = array(
                "Facilities" => "setup/windows/facilities_view",
                "Add New Facilities" => '#'
            );
            $data['content_view_page'] = 'setup/window/window_facilities';
            $data['windows'] = $this->utilities->dropdownFromTableWithCondition('pr_window', 'Select Window', 'PR_WINDOW_NO', 'WINDOW_NAME', array('ACTIVE' => 1));
            $data['method'] = $this->utilities->dropdownFromTableWithCondition('lv_selection_methods', 'Select Method', 'NUMB_LOOKUP', 'LOOKUP_DATA_NAME');

            $this->template->display($data);
        } else {
            $db_insert = array(
                'FACILITIES_NAME' => $this->input->post('FACILITIES_NAME'),
                'PR_WINDOW_NO' => $this->input->post('PR_WINDOW_NO'),
                'SELECTION_METHOD' => $this->input->post('SELECTION_METHOD'),
                'ACTIVE' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0
            );
            $this->db->insert('pr_win_facilities_res', $db_insert);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', "Successfully Saved");
            } else {
                $this->session->set_flashdata('Error', "Failed to Add New Facilities.");
            }
            redirect('setup/windows/facilities_view');
        }
    }

    public function update_facilities($id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('FACILITIES_NAME', 'Facilities Name', 'required');
        $data['previousData'] = $this->utilities->findByAttribute('pr_win_facilities_res', array('FACILITIES_NO' => $id));
        //var_dump($data['previousData']);exit;

        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"] = array(
                "Facilities" => "setup/windows/facilities_view",
                "Edit Facilities Information" => '#'
            );
            $data['content_view_page'] = 'setup/window/facilities_update';
            $data['windows'] = $this->utilities->dropdownFromTableWithCondition('pr_window', 'Select Window', 'PR_WINDOW_NO', 'WINDOW_NAME', array('ACTIVE' => 1));
            //var_dump($data['windows']);exit;
            $data['method'] = $this->utilities->dropdownFromTableWithCondition('lv_selection_methods', 'Select Method', 'NUMB_LOOKUP', 'LOOKUP_DATA_NAME');
            $this->template->display($data);
            //$this->load->view('window/window_update', $data);
        } else {
            $pr_facilities = array(
                'FACILITIES_NAME' => $this->input->post('FACILITIES_NAME'),
                'PR_WINDOW_NO' => $this->input->post('PR_WINDOW_NO'),
                'SELECTION_METHOD' => $this->input->post('SELECTION_METHOD'),
                'ACTIVE' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0
            );
            $this->db->update('pr_win_facilities_res', $pr_facilities, array('FACILITIES_NO' => $id));
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', "Facilities Information Updated Successfully");
                redirect('setup/windows/facilities_view');
            } else {
                $this->session->set_flashdata('Error', "Failed to Updated Facilities Successfully.");
                redirect("setup/windows/facilities_update/$id");
            }
        }
    }

}
