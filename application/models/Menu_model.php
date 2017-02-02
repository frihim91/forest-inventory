    <?php

    Class Menu_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

     
    	
    	 public function get_all_title() {
            $this->db->select('pg_title.*');
            $this->db->from('pg_title');
    		$this->db->where('pg_title.PARENT_ID = ',0,TRUE);
            $this->db->order_by('pg_title.TITLE_NAME', 'ASC');
            return $this->db->get()->result();
        }


         public function get_all_menu() {
            $data=$this->db->query("SELECT TITLE_NAME,TITLE_ID,PG_URI FROM pg_title pt WHERE ACTIVE_STAT='Y' AND PARENT_ID=0 ORDER BY ORDER_NO ASC")->result();
            return $data;
        }
        public function get_chile_menu($id)
        {
            $data=$this->db->query("SELECT TITLE_NAME,TITLE_ID,PG_URI FROM pg_title pt WHERE PARENT_ID=$id ORDER BY ORDER_NO ASC")->result();
            return $data; 
        }


        

    }
