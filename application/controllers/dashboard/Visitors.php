<?php

    /**
     
     * @package Admin Panel
     * @author     Reazul Islam <reazul@atilimited.net>
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
     * @author      Reazul Islam <reazul@atilimited.net>
     *
     */

 }

 class Visitors extends CI_Controller {

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
        $this->load->library('csvimport');
        $this->load->helper(array('html', 

            'form'));
        $this->load->model('setup_model');
    }

    /**
      * Show all pages in datatable
      
      
     */


    public function visitorList() {

        $data["breadcrumbs"] = array(
            "Page" => "dashboard/Visitors/visitorList",
            );
        $data['pageTitle'] = "All Visitor List ";
        $sql = "SELECT v.*, e.EDUCATION_DEGREE_NAME,i.INSTITUTE_NAME,i.INSTITUTE_ADDRESS,i.PHONE,i.FAX  FROM visitor_info v
        left JOIN education e ON v.EDUCATION_ID = e.EDUCATION_ID
        left JOIN institution i ON v.USER_ID = i.USER_ID  ORDER BY  v.USER_ID DESC
        ;";
        $data['all_visitors'] = $this->db->query($sql)->result();
            //echo"<pre>";print_r( $data['all_visitors']);exit;
        $data['content_view_page'] = 'setup/visitorList/all_visitor';
        $this->template->display($data);
    }


    function visitor_detail($USER_ID) {
        $data['visitor_info'] = $this->db->query("SELECT v.*, e.EDUCATION_DEGREE_NAME,i.INSTITUTE_NAME,i.INSTITUTE_ADDRESS,i.PHONE,i.FAX  FROM visitor_info v
         left JOIN education e ON v.EDUCATION_ID = e.EDUCATION_ID
         left JOIN institution i ON v.USER_ID = i.USER_ID 
         WHERE v.USER_ID= $USER_ID ORDER BY i.USER_ID")->row();
        //echo "<pre>";print_r($data['visitor_info']);exit;
        $this->load->view('setup/visitorList/visitor_details', $data);

    }


    /**
     * Edit ACTIVE_FLAG 
     */

    public function update_visitor() {
        $USER_ID = $this->input->post('USER_ID');
        $FIRST_NAME = $this->input->post('FIRST_NAME');
        $LAST_NAME = $this->input->post('LAST_NAME');
        $USER_MAIL = $this->input->post('USER_MAIL');
        $message = "Dear<br>$FIRST_NAME $LAST_NAME,<br>Congratulation! You have been Successfully registered.  <br> To activate the account please click the following link<br>" . base_url("index.php/Accounts/userActivition/$USER_ID") . " <br>Your login details.<br />Email:<b> " . $USER_MAIL . '</b><br>Thanks <br> FAO';

        $subject = "FAO Applicant Login Info";

             //echo $message;exit;
        require 'gmail_app/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "mail.harnest.com";
        $mail->Port = "465";
        $mail->SMTPAuth = true;
        $mail->Username = "support@harnest.com";
        $mail->Password = "Ati@2017";
        $mail->SMTPSecure = 'ssl';
        $mail->From = "support@harnest.com";
        $mail->FromName = "FAO";
        $mail->AddAddress($USER_MAIL);
             //$mail->AddReplyTo($emp_info->EMPLOYEE);
        $mail->IsHTML(TRUE);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if ($mail->Send()){
            echo "Success";
        }
        else {
            echo "Faild";
        }
        $activeStatus = array(
            'ACTIVE_FLAG' => isset($_POST['ACTIVE_FLAG']) ? 2 : 0,
            );
        if ($this->utilities->updateData('visitor_info', $activeStatus, array('USER_ID' => $USER_ID))) {
            $this->session->set_flashdata('Success', 'Mail send successfully.');
            redirect('dashboard/Visitors/visitorList');
        }
        else{
                $this->session->set_flashdata('Error', 'Mail send failed!.');
            }
    }
   public function generatePassword() {

        $random_code = $this->uri->segment(3, '');
        if ($random_code == '') {
            $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid Way to Reset Password.');
            redirect('auth/index', 'refresh');
        }
        $data['requestinfo'] = $this->utilities->findByAttribute('sa_forget_pass_request', array('REQUESTED_CODE' => $random_code));
        if (empty($data['requestinfo'])) {
            $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid Way to Reset Password.');
            redirect('auth/index', 'refresh');
        } else {
            if ($data['requestinfo']->IS_USED != 0) {

                $data['content_view_page'] = 'auth/errorMessage';
                $this->template_auth->display($data);
            } else {

                $data['content_view_page'] = 'auth/generateNewPasswordPage';
                $this->template_auth->display($data);
            }
        }
    }



    public function deleteVisitor($id)
    {

        $attr = array(
            "USER_ID" => $id
            );
        return $this->utilities->deleteRowByAttribute("visitor_info", $attr);


    }
    
}
