<?php

Class Auth_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function login($username, $password) {
        $this->db->from('sa_users');
        $this->db->where('USERNAME', "$username");
        $this->db->where('USERPW', md5($password));
        $this->db->where('STATUS', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

       public function registerlogin($username, $password) {
        $this->db->from('visitor_info');
        $this->db->where('EMAIL', "$username");
        $this->db->where('USERPW', md5($password));
        $this->db->where('ACTIVE_FLAG', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

  public function getUsersData($username_email) {
        return $this->db->query("select a.* from visitor_info a where EMAIL = '$username_email'")->row();
    }
    public function getPassRequestData($user_id){
        return $this->db->query("select a.* from sa_forget_pass_request a where USER_ID = '$user_id'")->row();
    }

}