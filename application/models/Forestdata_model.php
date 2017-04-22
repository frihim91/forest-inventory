<?php

Class Forestdata_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


	function insert_csv($data, $table) {
		$this->db->insert($table, $data);
	}



	public function get_family_species_genus1($family_id)
	{
		$data=$this->db->query("SELECT * FROM (SELECT CONCAT(f.Family,' ',s.Species) NAME,e.*,l.  ID_FAOBiomes,b.FAOBiomes FROM species s
			LEFT JOIN family f ON s.ID_Family=f.ID_Family
			LEFT JOIN ef e ON s.ID_Species=e.ID_Species
			LEFT JOIN location l ON e.ID_Location=l.ID_Location
			LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
			WHERE s.ID_Family=$family_id) m")->result();
		return $data; 
	}






	public function get_family_species_genus($family_id)
	{
		$data=$this->db->query("SELECT * FROM (SELECT CONCAT(f.Family,' ',s.Species) NAME,s.ID_Species FROM species s
			LEFT JOIN family f ON s.ID_Family=f.ID_Family
			WHERE s.ID_Family=$family_id) m")->result();
		return $data; 
	}


	public function get_location_data_type($specis_id)
	{
		$data=$this->db->query("SELECT s.*, e.*,l.*,b.*,d.*,dis.*,zon.* from  species s
			LEFT JOIN ef e ON s.ID_Species=e.ID_Species
			LEFT JOIN location l ON e.ID_Location=l.ID_Location
			LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
			LEFT JOIN division d ON l.ID_Division=d.ID_Division
			LEFT JOIN district dis ON l.ID_District =dis.ID_District
			LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
			WHERE s.ID_Species=$specis_id GROUP BY b.ID_FAOBiomes;")->result();
		return $data; 
	}


	public function get_data_type($specisId)
	{
		$data=$this->db->query("SELECT COUNT(m.ID_EF_IPCC) AS TOTAL_EQN FROM (SELECT distinct(ID_EF_IPCC) FROM ef WHERE ID_Species='$specisId') m;")->result();
		return $data; 
	}



	public function get_allometric_equation($specis_id)
	{
		$data=$this->db->query("SELECT s.*, e.*,l.*,b.*,d.*,dis.*,zon.*,ip.*,r.* from ef e
		 LEFT JOIN species s ON e.ID_Species=s.ID_Species
		 LEFT JOIN ef_ipcc ip ON e.ID_EF_IPCC=ip.ID_EF_IPCC
		 LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
		 LEFT JOIN location l ON e.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
		 WHERE e.ID_Species=$specis_id GROUP BY e.ID_EF_IPCC")->result();
		 return $data; 
	}


		public function get_allometric_equation_list_json($specis_id)
	{
		$data=$this->db->query("SELECT s.*, e.*,l.*,b.*,d.*,dis.*,zon.*,ip.*,r.* from ef e
		 LEFT JOIN species s ON e.ID_Species=s.ID_Species
		 LEFT JOIN ef_ipcc ip ON e.ID_EF_IPCC=ip.ID_EF_IPCC
		 LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
		 LEFT JOIN location l ON e.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
		 WHERE e.ID_Species=$specis_id GROUP BY e.ID_EF_IPCC");
		  //return $data; 
		 //echo "<pre>";
		 header('Content-disposition: attachment; filename=Species_list.json');
         header('Content-type: application/json');
		 echo json_encode($data->result()),'<br />';
	}




	public function get_allometric_equation_list()
	{
		$data=$this->db->query("SELECT ip.*, e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
		 LEFT JOIN species s ON e.ID_Species=s.ID_Species
		 LEFT JOIN family f ON s.ID_Family=f.ID_Family
		 LEFT JOIN genus g ON f.ID_Family=g.ID_Family	
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
		 LEFT JOIN location l ON e.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
		 GROUP BY e.ID_Species order by e.ID_Species desc")->result();
		 return $data; 
	}




	public function get_allometric_equation_details($ID_Species)
	{
		$data=$this->db->query("SELECT ip.*, e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
		 LEFT JOIN species s ON e.ID_Species=s.ID_Species
		 LEFT JOIN family f ON s.ID_Family=f.ID_Family
		 LEFT JOIN genus g ON f.ID_Family=g.ID_Family	
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
		 LEFT JOIN location l ON e.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
		 where e.ID_Species=$ID_Species
		 GROUP BY e.ID_Species")->result();
		 return $data; 
	}




		public function get_raw_data_list()
	{
		$data=$this->db->query("SELECT  e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
		 LEFT JOIN species s ON e.ID_Species=s.ID_Species
		 LEFT JOIN family f ON s.ID_Family=f.ID_Family
		 LEFT JOIN genus g ON f.ID_Family=g.ID_Family	
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
		 LEFT JOIN location l ON e.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
	     GROUP BY e.ID_Species")->result();
		 return $data; 
	}


	public function get_raw_data_details($ID_Species)
	{
		$data=$this->db->query("SELECT  e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
		 LEFT JOIN species s ON e.ID_Species=s.ID_Species
		 LEFT JOIN family f ON s.ID_Family=f.ID_Family
		 LEFT JOIN genus g ON f.ID_Family=g.ID_Family	
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
		 LEFT JOIN location l ON e.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
		 where e.ID_Species=$ID_Species
		 GROUP BY e.ID_Species")->result();
		 return $data; 
	}

	  public function get_all_family() 
      {
            $this->db->select('family.*');
            $this->db->from('family');
            $this->db->order_by('family.ID_Family', 'ASC');
            return $this->db->get()->result();
       }
        public function get_all_landcover() 
      {
            $this->db->select('landcover.*');
            $this->db->from('landcover');
            $this->db->order_by('landcover.ID_LandCover ', 'ASC');
            return $this->db->get()->result();
       }

      public function get_all_species11() 
      {
            $this->db->select('species.*');
            $this->db->from('species');
            $this->db->order_by('species.ID_Species	', 'ASC');
            return $this->db->get()->result();
       }


       public function get_all_species()
	{
		$data=$this->db->query("SELECT s.*,g.*,f.* from species s
            LEFT JOIN genus g ON s.ID_Genus =g.ID_Genus
            LEFT JOIN family f ON s.ID_Family =f.ID_Family
            order by s.ID_Species ASC
		")->result();
		 return $data; 
	}


      public function get_all_heightrange() 
      {
            $this->db->select('heightrange.*');
            $this->db->from('heightrange');
            $this->db->order_by('heightrange.ID_HeightRange', 'ASC');
            return $this->db->get()->result();
       }


       public function get_all_volumerange() 
      {
            $this->db->select('volumerange.*');
            $this->db->from('volumerange');
            $this->db->order_by('volumerange.ID_VolumeRange', 'ASC');
            return $this->db->get()->result();
       }


         public function get_all_basalrange() 
      {
            $this->db->select('basalrange.*');
            $this->db->from('basalrange');
            $this->db->order_by('basalrange.ID_BasalRange', 'ASC');
            return $this->db->get()->result();
       }

       public function get_all_equation() 
      {
            $this->db->select('ef_ipcc.*');
            $this->db->from('ef_ipcc');
            $this->db->order_by('ef_ipcc.ID_EF_IPCC', 'ASC');
            return $this->db->get()->result();
       }

       public function get_all_reference() 
      {
            $this->db->select('reference.*');
            $this->db->from('reference');
            $this->db->order_by('reference.ID_Reference', 'ASC');
            return $this->db->get()->result();
       }

        public function get_all_agerange() 
      {
            $this->db->select('agerange.*');
            $this->db->from('agerange');
            $this->db->order_by('agerange.ID_AgeRange', 'ASC');
            return $this->db->get()->result();
       }



       public function get_all_genus() 
      {
            $this->db->select('genus.*');
            $this->db->from('genus');
            $this->db->order_by('genus.ID_Genus', 'ASC');
            return $this->db->get()->result();
      }


    public function get_all_location()
	{
		$data=$this->db->query("SELECT l.*,dis.* from location l
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         group by l.ID_District
		")->result();
		 return $data; 
	}


	 public function get_allometric_equation_grid()
	{
		$data=$this->db->query("SELECT ip.*, e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
         LEFT JOIN species s ON e.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
         LEFT JOIN location l ON e.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         GROUP BY e.ID_Species order by e.ID_EF desc
		")->result();
		 return $data; 
	}


	 public function get_allometric_equation_json()
	{
		$data=$this->db->query("SELECT ip.*, e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
         LEFT JOIN species s ON e.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
         LEFT JOIN location l ON e.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         GROUP BY e.ID_Species order by e.ID_EF desc
		");
		 //return $data; 
		 //echo "<pre>";
		 header('Content-disposition: attachment; filename=Allometric_Equation.json');
         header('Content-type: application/json');
		 echo json_encode($data->result()),'<br />';
	}



	 public function get_raw_data_grid()
	{
		$data=$this->db->query("SELECT  e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e 
         LEFT JOIN species s ON e.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
         LEFT JOIN location l ON e.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         GROUP BY e.ID_Species order by e.ID_EF desc
		")->result();
		 return $data; 
	}


	 public function get_raw_data_grid_json()
	{
		$data=$this->db->query("SELECT  e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e 
         LEFT JOIN species s ON e.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
         LEFT JOIN location l ON e.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         GROUP BY e.ID_Species order by e.ID_EF desc
		");
		 header('Content-disposition: attachment; filename=Raw_Data.json');
         header('Content-type: application/json');
		 echo json_encode($data->result()),'<br />';
	}








}
