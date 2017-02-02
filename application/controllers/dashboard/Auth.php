    <?php
    /**
     
     * @package Admin Panel
     * @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @copyright  2017 ATI Limited Development Group
     
     */
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /**
     * Auth Class
     *
     * Parses URIs and determines routing
     *
     * @package     Admin Panel
     * @subpackage  Admin Panel
     * @category    Admin Panel
     * @author      Rokibuzzaman <rokibuzzaman@atilimited.net>
     *
     */

    class Auth extends CI_Controller {
        /**
         * CI_Controller class object
         *
         * @var object
         */

        function __construct() {
        /**
         * Class constructor
         *
         * Runs the auth function.
         * Create a new authentication controller instance.
         * @return  void
         */
            parent::__construct();
            $this->load->helper(array('form'));
            $this->load->library('form_validation');
            $this->load->model("auth_model");
            $this->load->model('Menu_model');
        }
    /**
     * @methodName index()
     * @param  none
     * Show the Login page.
     * index function here.
     */

        function index() {

            if ($this->session->userdata('user_logged_in')) {
                redirect('apps/index', 'refresh');
            }
            $data['pageTitle'] = "Login";
            $this->form_validation->set_rules('txtUserName', 'Username', 'trim|required');
            $this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|callback_check_database');

            if ($this->form_validation->run() == FALSE) {
                $data['content_view_page'] = 'login_template';
                $this->login_template->display($data);
            } else {
                redirect('apps/index', 'refresh');
            }
        }


    /**
      *Admin login operation
      * @param  array 
      * @param  string  $password     A particular marked point
      * @return  string  Calculated elapsed time on success,
         
     */

      public function check_database($password) {
            $username = $this->input->post('txtUserName');
            $result = $this->auth_model->login($username, $password);
            if ($result) {
                $sess_array = array(
                    'USER_ID' => $result->USER_ID,
                    'USERNAME' => $result->USERNAME,
                    'SUB_PROJ_ID' => $result->SUB_PROJ_ID,
                    'SES_ORG_ID' => $result->ORG_ID,
                    'USERGRP_ID' => $result->USERGRP_ID,
                    'USERLVL_ID' => $result->USERLVL_ID,
                    'FULL_NAME' => $result->FULL_NAME,
                    'EMAIL' => $result->EMAIL,
                    'IS_ADMIN' => $result->IS_ADMIN,
                    'PROFILE_PIC_NAME' => $result->PROFILE_PIC_NAME,
                    'GENDER' => $result->GENDER
                );
                //echo '<pre>';print_r($sess_array);exit;
                $this->session->set_userdata('user_logged_in', $sess_array);
                return TRUE;
            } else {
                $this->form_validation->set_message('check_database', 'Invalid username or password');
                return false;
            }
        }

     /**
     *logout function here
     *End session for active user.
     */


        public function logout() {
            $this->session->unset_userdata('user_logged_in');
            redirect('dashboard/auth/index', 'refresh');
        }


    /**
     * forgot_password function here
     */

       public function forgot_password() {
            $this->load->view('forgot_password');
        }

    /**
     * endmail_forgot_password function here
     * Send mail for password reset.
    
     */

        public function sendmail_forgot_password() {
            $this->load->helper('string');
            if ($_POST) {
                $UserName = $this->input->post('txtUserName');
                $fullName = $this->utilities->get_field_value_by_attribute('sa_users', 'FULL_NAME', array('USERNAME' => $UserName));
                $showemail = $this->utilities->get_field_value_by_attribute('sa_users', 'EMAIL', array('USERNAME' => $UserName));
                //echo '<pre>';print_r($showemail);//exit;
                $user_id = $this->utilities->get_field_value_by_attribute('sa_users', 'USER_ID', array('USERNAME' => $UserName));
                // echo '<pre>';print_r($user_id);//exit;
                $random_id = random_string('alnum', 25);
                // echo '<pre>';print_r($random_id);//exit;
                $data = array(
                    'USER_ID' => $user_id,
                    'REQUESTED_CODE' => $random_id
                );
                //echo '<pre>';print_r($data);exit;
                $this->utilities->insertData($data, 'sa_forget_pass_request');
                $msgBody = "<html><head></html><body>Dear $fullName,<br> <br><br>
            Hi!<br/>
            I have some good news!<br/>
            You're one step away from regaining access to your HEQEP account, <br/>
            $showemail. Just click below to reset your password:<br/>
            <a  href='" . site_url() . "dashboard/auth/generate_password/$random_id'><button class='btn btn-success' style='background: #10b7e8; height:6%; margin-left:24%;'>Reset Password</button></a> <br/>
            If you the link don't use, simply <a  href='" . site_url() . "dashboard/auth/forgot_password'>request a new link.</a> If you didn't initiate this request,<br/>
            don't worry; you don't need to take any action and you can disregard this email.<br/>
            We're glad to have you back!<br/>
                    <br/><br/.<br/>
                        Thanks and regards,<br>
                        HEQEP<br/><br/>        
            </body></html>";
                //echo '<pre>';print_r($msgBody);exit;
                $email = $this->utilities->get_field_value_by_attribute('sa_users', 'EMAIL', array('USERNAME' => $UserName));
                $user = $this->utilities->get_field_value_by_attribute('sa_users', 'USERNAME', array('USERNAME' => $UserName));
                if ($user == $UserName) {
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
                    //$mail->AddReplyTo($emp_info->EMPLOYEE);
                    $mail->IsHTML(TRUE);
                    $mail->Subject = "HEQEP New Password Confirmation";
                    $mail->Body = $msgBody;
                    if ($mail->Send()) {
                        //echo '<p style="color:red; margin-left: 38%;">Mail send  successfully please check your mail. </p>';
                        $this->session->set_flashdata('flashMessage', 'Mail send  successfully please check mail.');
                        redirect('dashboard/auth/email_send_messages', 'refresh');
                    }
                } else {
                    echo '<p style="color:red; margin-top:6%; margin-left: 38%; font-size:112%;">Please enter valid user name.</p>';
                    //  redirect('auth/forgot_passworddddd');
                }
            }
            $this->load->view('forgot_password');
        }

    /**
     * email_send_messages function here
     * Create a new password send mail View Page.
     
     */


        public function email_send_messages() {
            $this->load->view('send_emai_messages');
        }


    /**
     * generate_password function here
     * Create a new password controller instance.
    
     */


        public function generate_password() {
            $random_code = $this->uri->segment(3, '');
            if ($random_code == '') {
                $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid Way to Reset Password.');
                redirect('dashboard/auth/index', 'refresh');
            }
            $requestInfo = $this->utilities->findByAttribute('sa_forget_pass_request', array('REQUESTED_CODE' => $random_code));
            if (empty($requestInfo)) {
                $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid Way to Reset Password.');
                redirect('dashboard/auth/index', 'refresh');
            } else {
                if ($requestInfo->IS_USED == 0) {
                    $this->load->view('generate_new_password');
                } else {
                    $this->load->view('errorMessages');
                }
            }
        }


    /**
     * generate_new_password function here
     * generate a new password controller instance.
     */


        public function generate_new_password() {
            $random_id = $this->input->post('randomCode');
            $requestInfo = $this->utilities->findByAttribute('sa_forget_pass_request', array('REQUESTED_CODE' => $random_id));
            if ($requestInfo !== 1) {
                $db_insert = array(
                    'USERPW' => md5($this->input->post('textPassword'))
                );
                $data = array(
                    'IS_USED' => 1
                );
                $this->utilities->updateData('sa_users', $db_insert, array('USER_ID' => $requestInfo->USER_ID));
                $this->utilities->updateData('sa_forget_pass_request', $data, array('USER_ID' => $requestInfo->USER_ID));
                redirect('dashboard/auth/reset_passwordMessages', 'refresh');
            }
        }


     /**
     *reset_passwordMessages function here
     *Reset Password Message view
     */


        public function reset_passwordMessages() {
            $this->load->view('reset_passwordMessages');
        }


    /**
     *find_username function here
     */


        public function find_username() {
            $txtEmail = $this->input->post('txtEmail');
            $email = $this->utilities->get_field_value_by_attribute('sa_users', 'EMAIL', array('EMAIL' => $txtEmail));
            $userName = $this->utilities->get_field_value_by_attribute('sa_users', 'USERNAME', array('EMAIL' => $txtEmail));
            $fullName = $this->utilities->get_field_value_by_attribute('sa_users', 'FULL_NAME', array('EMAIL' => $txtEmail));
            $user_id = $this->utilities->get_field_value_by_attribute('sa_users', 'USER_ID', array('USERNAME' => $txtEmail));
            $msgBody = "<html><head></html><body>Dear $fullName,<br> <br>
                                             Your user name is <b style='color: green; font-size:125%;'>$userName</b><br/><br/>
                        Thanks and regards,<br>
                        HEQEP<br/><br/>        
            </body></html>";
            $user = $this->utilities->get_field_value_by_attribute('sa_users', 'EMAIL', array('EMAIL' => $txtEmail));
            if ($user == $txtEmail) {
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
                //$mail->AddReplyTo($emp_info->EMPLOYEE);
                $mail->IsHTML(TRUE);
                $mail->Subject = "HEQEP User Name Information";
                $mail->Body = $msgBody;
                if ($mail->Send()) {
                    $this->session->set_flashdata('flashMessage', 'Mail send  successfully please check mail.');
                    redirect('dashboard/auth/email_send_messages', 'refresh');
                }
            } else {
                echo '<p style="color:red; margin-top:6%; margin-left: 38%; font-size:112%;">Please enter valid email address.</p>';
            }
            $this->load->view('forgot_password');
        }

    }
