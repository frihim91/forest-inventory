  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class VisitorInfo extends CI_Controller {
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

      /* @author  Reazul Islam  reazul@atilimited.net
       * @methodName userProfileInfo()
       * @access public
       * @param  none
       * @return Fao portal User profileInfo Form page
       */


      function registerLogin() {

      	if ($this->session->userdata('user_logged')) {
      		redirect('portal/index', 'refresh');
      	}
      	$data['pageTitle'] = "Login";
      	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      	$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|callback_register_check_database');

      	if ($this->form_validation->run() == FALSE) {
      		$data['content_view_page'] = 'account/userLogin';
      		$this->template->display_portal($data);
      	} else {
      		redirect('portal/index', 'refresh');
      	}
      }
      public function register_check_database($password) {
      	$username = $this->input->post('email');
      	$result = $this->auth_model->registerlogin($username, $password);
      	if ($result) {
      		$sess_array = array(
      			'USER_ID' => $result->USER_ID,
      			'EMAIL' => $result->EMAIL,
      			'FIRST_NAME' => $result->FIRST_NAME,
      			'LAST_NAME' => $result->LAST_NAME

      			);
		                //echo '<pre>';print_r($sess_array);exit;
      		$this->session->set_userdata('user_logged', $sess_array);
      		return TRUE;
      	} else {
      		$this->form_validation->set_message('register_check_database', 'Invalid username or password');
      		return false;
      	}
      }


      public function userProfileInfo() 
      {
        //echo "<pre>"; print_r($_SESSION);exit();
        if(!isset($_SESSION['user_logged']))
        {
          redirect('/');
        }
      	$visitorId=$_SESSION['user_logged']['USER_ID'];
      	$data['visitor_info'] = $this->db->query("SELECT v.*, e.EDUCATION_DEGREE_NAME,i.INSTITUTE_NAME,i.INSTITUTE_ADDRESS,i.PHONE,i.FAX, z.Zones  FROM visitor_info v
      		left JOIN education e ON v.EDUCATION_ID = e.EDUCATION_ID
      		left JOIN institution i ON v.USER_ID = i.USER_ID 
      		left JOIN zones z ON v.ID_Zones = z.ID_Zones
      		WHERE v.USER_ID= $visitorId")->row();
      
       //echo "<pre>";print_r($data['visitor_info']);exit;
      	$data['content_view_page'] = 'account/userProfileInfo';
      	$this->template->display_portal($data);

      }


      

    /**
     *Register logout function here
     *End session for active user.
     */


    public function userRegistrationLogout() {
    	$this->session->unset_userdata('user_logged');
    	redirect('portal/index', 'refresh');
    }

    private function pr($data)
    {
    	echo "<pre>";
    	print_r($data);
    	exit;
    }

}


