<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged_in')) {
            redirect('dashboard/auth/index', 'refresh');
        }
        $this->user_session = $this->session->userdata('user_logged_in');
    }

    function roundwiseproject() {
        $data["breadcrumbs"] = array(
            "Dashboard" => "dashboard/dashboard",
            "Round wise project" => 'dashboard/dashboard/roundwiseproject'
        );
        $data['pageTitle'] = "Round wise project";
        $data['content_view_page'] = 'dashboard/roundwiseproject';
        $this->template->display($data);
    }

    function roundwisecost() {
        $data["breadcrumbs"] = array(
            "Dashboard" => "dashboard/roundwisecost",
            "Round wise cost" => 'dashboard/dashboard/roundwisecost'
        );
        $data['pageTitle'] = "Round wise cost";
        //$data["sub_projects"] = $this->utilities->findAllFromView("sub_project_master");
        $data['content_view_page'] = 'dashboard/roundwisecost';
        $this->template->display($data);
    }

    public function profile() {
        $data["breadcrumbs"] = array(
            "Profile" => "dashboard/dashboard/profile",
            "User Profile" => '#'
        );
        $data['pageTitle'] = "Profile";
        $user_id = $this->user_session["USER_ID"];
        $data['user_details'] = $this->db->query("select a.USER_ID,a.FIRST_NAME, a.MIDDLE_NAME, a.LAST_NAME, a.FULL_NAME, a.EMAIL,a.GENDER, a.PROFILE_PIC_NAME, a.STATUS,
                                                 (select b.USERGRP_NAME from sa_user_group b where a.USERGRP_ID=b.USERGRP_ID)USERGRP_NAME,
                                                (select c.UGLEVE_NAME from sa_ug_level c where c.UG_LEVEL_ID=a.USERLVL_ID )UGLEVE_NAME,
                                                (select d.SUB_PROJECT_TITLE from pr_subproject d where d.SUB_PROJECT_NO=a.SUB_PROJ_ID)SUB_PROJECT_TITLE
                                                from sa_users a where a.USER_ID='$user_id'")->result();
        //echo '<pre>';print_r($user_details);exit;
        $data['content_view_page'] = 'dashboard/profile';
        $this->template->display($data);
    }

    public function profile_edit() {
        $data["breadcrumbs"] = array(
            "Profile" => "dashboard/dashboard/profile",
            "Profile Edit" => '#'
        );
        $data['pageTitle'] = "Profile Edit";
        $data['profile_data'] = $this->utilities->findAllByAttribute('sa_users', array('USER_ID' => $this->user_session["USER_ID"]));
        $data['content_view_page'] = 'dashboard/profile_edit';
        $this->template->display($data);
    }

    public function profile_data_edit() {
        $textUserId = $_POST['textUserId'];
        $profileData = array(
            'FIRST_NAME' => $this->input->post('textFirstName'),
            'MIDDLE_NAME' => $this->input->post('textMiddleName'),
            'LAST_NAME' => $this->input->post('textLastName'),
            'EMAIL' => $this->input->post('textEmail')
        );
        $this->utilities->updateData('sa_users', $profileData, array('USER_ID' => $textUserId));
        redirect('dashboard/dashboard/profile');
    }

    public function profile_image() {
        $data["breadcrumbs"] = array(
            "Profile" => "dashboard/dashboard/profile",
            "Profile Image" => '#'
        );
        $data['row'] = $this->utilities->findByAttribute('sa_users', array('USER_ID' => $this->user_session["USER_ID"]));
        $data['content_view_page'] = 'dashboard/profile_image';
        $this->template->display($data);
    }

    public function profile_image_insert() {
        $textUserId = $_POST['textUserId'];
        if ($_FILES['userfile']['error'] == 0) {
            if ($userInfo->PROFILE_PIC_NAME != '') {
                $pre_image_name = "resources/images/$userInfo->PROFILE_PIC_NAME";
                if (file_exists($pre_image_name)) {
                    unlink($pre_image_name);
                }
            }
            $configImage = array(
                'upload_path' => "./resources/images",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "768",
                'max_width' => "1024"
            );
            $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
            $configImage['file_name'] = date('Y_m_d_') . substr(md5(rand()), 0, 7) . '.' . $ext;
            $this->load->library('upload', $configImage);
            if ($this->upload->do_upload()) {
                $image_name = $this->upload->file_name;
                $this->utilities->updateData('sa_users', array('PROFILE_PIC_NAME' => $image_name), array('USER_ID' => $textUserId));
            }
        }
        $this->session->set_flashdata('Error', 'Profile Image Successfully Changed .');
        redirect('dashboard/dashboard/profile_image');
    }

    function change_password() {
        $USER_ID = $this->user_session["USER_ID"];
        if (empty($USER_ID) OR !is_numeric($USER_ID)) {
            $this->session->set_flashdata('Error', 'Sorry ! You Are Trying Invalid Way To Edit Personal Information.');
            redirect('dashboard/dashboard/profile', 'refresh');
        }
        $userInfo = $this->utilities->findByAttribute('sa_users', array('USER_ID' => $USER_ID));
        if (empty($userInfo)) {
            $this->session->set_flashdata('Error', 'Sorry ! You Are Trying To Edit Invalid Personal Information .');
            redirect('dashboard/dashboard/profile', 'refresh');
        }
        $data['pageTitle'] = 'Change Password';
        $data['previous_user_info'] = $userInfo;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('CURRENT_PW', 'Current Password', 'trim|required|min_length[6]|callback_current_password_check');
        //$this->form_validation->set_rules('UPW', 'Password', 'trim|required|min_length[6]|matches[CONFIRM_UPW]');
       // $this->form_validation->set_rules('CONFIRM_UPW', 'Confirm Password', 'trim|required|min_length[6]');
        if ($this->form_validation->run() == TRUE) {
            $password = ($this->input->post('UPW') == '') ? $userInfo->UPW : md5($this->input->post('UPW'));
            $updateDataArray = array(
                'USERPW' => $password,
                'UPDATE_BY' => $USER_ID
            );
            $this->utilities->updateData('sa_users', $updateDataArray, array('USER_ID' => $USER_ID));
            $USER_ID = $this->user_session["USER_ID"];
            $fullName = $this->utilities->get_field_value_by_attribute('sa_users', 'FULL_NAME', array('USER_ID' => $USER_ID));
            //echo '<pre>';print_r($fullName);
            $email = $this->utilities->get_field_value_by_attribute('sa_users', 'EMAIL', array('USER_ID' => $USER_ID));
            $password = $this->input->post('UPW');
            $msgBody = "<html><head></html><body>Dear $fullName,<br> 
                                Congratulations!<br/>
                                You have successfully change your password.  Please Keep this mail for further reference. Your new password information is below.<br><br><br>
                                <span style='color: #3366ff; font-weight: bold;'>New Password: </span><span style='color: #ff3333; font-weight: bold;'>$password</span><br><br><br><br><br><br><br><br><br>
                    Thanks and regards,<br>
                    HEQEP</body></html>";
            //echo '<pre>';print_r($msgBody);exit;
            require 'gmail_app/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = "cloud2.eicra.com";
            $mail->Port = "465";
            $mail->SMTPAuth = true;
            $mail->Username = "pmis@atilimited.net";
            $mail->Password = "@ti789#";
            $mail->SMTPSecure = 'ssl';
            $mail->From = "pmis@atilimited.net";
            $mail->FromName = "HEQEP";
            $mail->AddAddress($email);
            //$mail->AddReplyTo($email);
            $mail->IsHTML(TRUE);
            $mail->Subject = "HEQEP Change Password Confirmation";
            $mail->Body = $msgBody;
            if ($mail->Send()) {
                $this->session->set_flashdata('flashMessage', 'Password Changed  Successfully.');
                redirect('dashboard/dashboard/profile', 'refresh');
            }
            $this->session->set_flashdata('Success', 'Congratulations ! Password Changed Successfully .');
            redirect('dashboard/dashboard/profile', 'refresh');
        }
        $data["breadcrumbs"] = array(
            "Profile" => "dashboard/dashboard/profile",
            "Change Password" => '#'
        );
        $data['pageTitle'] = "Change Password";
        $data['content_view_page'] = 'dashboard/change_password';
        $this->template->display($data);
    }

    public function current_password_check($str) {
        $userInfo = $this->db->get_where('sa_users', array('USER_ID' => $this->user_session["USER_ID"]))->row();
        //echo '<pre>';print_r($userInfo);exit;
        //if ($userInfo->USERPW != md5($str)) {
        if ($userInfo->USERPW != md5($str)) {
            $this->form_validation->set_message('current_password_check', 'Sorry ! You Will Not Be Able To Change Password, Because %s Dose Not Matching .');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    

}
