  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Accounts extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->model('utilities');
      $this->load->model('Account_model');
      $this->load->model('auth_model');
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
          if ($statusUpdate=$this->utilities->updateData('visitor_info', $activeStatus, array('USER_ID' => $id))) {
           if ($statusUpdate == TRUE) {
             $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your activition has been successfully<button data-dismiss="alert" class="close" type="button">×</button></div>');
           }
           redirect('Accounts/userLogin');
         }
       }

       else 
       {
         if ($statusUpdate == FALSE) {
           $this->session->set_flashdata('error','<div class="alert alert-danger text-center">You are not Successfully Activited!  <button data-dismiss="alert" class="close" type="button">×</button></div>');
         }
         redirect('portal');
       }

     }

  /*User duplicate email check
      @author  Reazul Islam <reazul@atilimited.net>
      */

      public function checkUserEmail() {
        $email = $_POST['EMAIL'];
        //$check_userEmail = $this->utilities->findByAttribute("visitor_info", array("EMAIL" => "$EMAIL"));
        //print_r($check_userEmail);
        //exit;
       $result = $this->utilities->countRow("visitor_info", array("EMAIL" =>"$email"));
        echo $result;
      }

    /*forgot_password function here
      @author  Reazul Islam <reazul@atilimited.net>
      */

      public function forgot_password() {
       $data['content_view_page'] = 'account/forgot_password';
       $this->template->display_portal($data);

     }

     public function forgetPassword() {
      $this->load->helper('string');
      $username_email = $this->input->post('username_email');
      $number = $result = $this->auth_model->getUsersData($username_email);
      if (!empty($number)) {
        echo '<div style="color:green;">We sent a Reset Link To your Email Address.</div>';
        $user_id = $number->USER_ID;
        $useremail = $number->EMAIL;
        $userFname = $number->FIRST_NAME;
        $userLname = $number->LAST_NAME;
        $random_id = random_string('alnum', 25);
        $data = array(
          'USER_ID' => $user_id,
          'REQUESTED_CODE' => $random_id
          );
        $this->utilities->insertData($data, 'sa_forget_pass_request');
        $msgBody = "<html><head></html><body>Dear<br> $userFname $userLname,<br><br>
        You're one step away from regaining access to your FAO account. 
        Just click below to reset your password:<br/>
        <a style='margin-top:10px; color:white;' href='" . site_url() . "/accounts/generatePassword/$random_id'><button class='btn btn-primary' style='margin-left:24%; background-color:#556a2f; padding:5px;'>Reset Password</button></a> <br/>

        <br/>Thanks<br>
        FAO<br/><br/>        
      </body></html>";

      if ($useremail == $username_email or $username == $username_email) {
        require 'gmail_app/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "mail.harnest.com";
        $mail->Port = "465";
        $mail->SMTPAuth = true;
        $mail->Username = "dev@atilimited.net";
        $mail->Password = "@ti321$#";
        $mail->SMTPSecure = 'ssl';
        $mail->From = "support@harnest.com";
        $mail->FromName = "FAO";
        $mail->AddAddress($useremail);
               //$mail->AddReplyTo($emp_info->EMPLOYEE);
        $mail->IsHTML(TRUE);
        $mail->Subject = "Forest Inventory : Password Reset Request";
        $mail->Body = $msgBody;
        if ($mail->Send()) {
                      //echo '<p style="color:red; margin-left: 38%;">Mail send  successfully please check your mail. </p>';
          $this->session->set_flashdata('flashMessage', 'Mail send successfully please check mail.');
          redirect('accounts/userRegistration', 'refresh');
        }
      } else {
        echo '<p style="color:red;">Please enter valid Username / Email.</p>';
      }
    } else {
      echo '<div style="color:red;">Sorry, Your Address are not registered.</div>';
    }
  }

  public function generatePassword() {
    $random_code = $this->uri->segment(3, '');
    if ($random_code == '') {
      $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid Way to Reset Password.');
      redirect('accounts/userRegistration', 'refresh');
    }
    $data['requestinfo'] = $this->utilities->findByAttribute('sa_forget_pass_request', array('REQUESTED_CODE' => $random_code));
    if (empty($data['requestinfo'])) {
      $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid Way to Reset Password.');
      redirect('accounts/userRegistration', 'refresh');
    } else {
      if ($data['requestinfo']->IS_USED != 0) {
       $data['content_view_page'] = 'account/errorMessage';
       $this->template->display_portal($data);
     } else {
       $data['content_view_page'] = 'account/generateNewPasswordPage';
       $this->template->display_portal($data);

     }
   }
  }
  public function generateNewPasswordPage() {
    $data['content_view_page'] = 'auth/forgotUsername';
    $this->template_auth->display($data);
  }



  public function generateNewPassword() {
    $random_id = $this->input->post('randomCode');
    $requestInfo = $this->utilities->findByAttribute('sa_forget_pass_request', array('REQUESTED_CODE' => $random_id));
    if ($requestInfo !== 1) {
      $new_pass = array(
        'USERPW' => md5($this->input->post('password1'))
        );
      $is_used = array(
        'IS_USED' => 1,
        'UPD_DT' => date("Y-m-d:H-i-s")
        );
      $this->utilities->updateData('visitor_info', $new_pass, array('USER_ID' => $requestInfo->USER_ID));
      $this->utilities->updateData('sa_forget_pass_request', $is_used, array('USER_ID' => $requestInfo->USER_ID));
      redirect('accounts/resetPasswordMessages', 'refresh');
    }
  }

  public function resetPasswordMessages() {
    $data['content_view_page'] = 'account/resetPasswordMessages';
    $this->template->display_portal($data);

  }


  public function checkUserVaildEmail() {
    $EMAIL = $this->input->post("EMAIL");
    $check_userEmail = $this->utilities->findByAttribute("visitor_info", array("EMAIL" => "$EMAIL"));
    if (empty($check_userEmail)) {
      echo "emailNotExit";
    } else {
      echo "emailExit";
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
                 $imgUrl='';
   
  

           /*start image upload*/

            $imgFile = $_FILES['user_img']['name'];
            $tmp_dir = $_FILES['user_img']['tmp_name'];
            $imgSize = $_FILES['user_img']['size'];

            $upload_dir = 'uploads_file/PROFILE_IMG/'; // upload directory
            $saveImg = $imgFile;

            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

               // valid image extensions
               $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

               // rename uploading image
               //$userpic = rand(1000,1000000).".".$imgExt;

               // allow valid image file formats
               if(in_array($imgExt, $valid_extensions)){
                // Check file size '5MB'
                if($imgSize < 5000000)    {
                 move_uploaded_file($tmp_dir,$upload_dir.$imgFile);
               }
               else{
                 $errMSG = "Sorry, your file is too large.";
               }
             }
             else{
              $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
            /*end image upload*/

              $regInfo = array(
                'EDUCATION_ID' => $this->input->post('EDUCATION_ID'),
                'USERPW' => $this->input->post('USERPW'),
                'TITLE' => str_replace("'", "''", $this->input->post("TITLE")),
                'FIRST_NAME' => str_replace("'", "''", $this->input->post("FIRST_NAME")),
                'LAST_NAME' => str_replace("'", "''", $this->input->post("LAST_NAME")),
                'EMAIL' => $this->input->post('EMAIL'),
                'ADDRESS' => $this->input->post('ADDRESS'),
                'FIELD_SUBJECT' => $this->input->post('FIELD_SUBJECT'),
                'ID_Zones' => $this->input->post('ID_Zones'),
                'PROFILE_IMG' =>   $saveImg
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
                   $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your Registration has been successfully.<button data-dismiss="alert" class="close" type="button">×</button></div>');
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


