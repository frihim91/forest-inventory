<?php

    Class Forestdata_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

     
    	function insert_csv($data, $table) {
           $this->db->insert($table, $data);
         }


        

    }
