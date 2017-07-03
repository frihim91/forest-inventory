<?php

Class Account_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	     public function get_education_degree() 
	     {
	        $data=$this->db->query("SELECT * FROM education edu ORDER BY edu.	EDUCATION_ID ASC")->result();
	        return $data;
	     }
	     
	     public function get_zone() 
	     {
	        $data=$this->db->query("SELECT * FROM zones z ORDER BY z.	ID_Zones ASC")->result();
	        return $data;
	     }


}
