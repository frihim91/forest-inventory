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

}
