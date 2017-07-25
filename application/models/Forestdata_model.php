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
		$data=$this->db->query("SELECT s.*, e.*,eco.*,b.*,d.*,dis.*,zon.* from  species s
			LEFT JOIN ef e ON s.ID_Species=e.Species
			
		 LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
		 LEFT JOIN division d ON e.Division=d.ID_Division
		 LEFT JOIN district dis ON e.District =dis.ID_District
		 LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
      LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
			WHERE s.ID_Species=$specis_id GROUP BY b.ID_FAOBiomes;")->result();
		return $data; 
	}


      function get_books($limit, $start, $keyword = NULL)
    {
        if ($keyword == "NIL") $keyword = "";
        $sql = "SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Family   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
         LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         where dis.District LIKE '%$keyword%' OR a.Equation LIKE '%$keyword%' OR ref.Reference LIKE '%$keyword%'
         OR b.FAOBiomes LIKE '%$keyword%' OR s.Species  LIKE '%$keyword%'
         OR f.Family LIKE '%$keyword%' OR g.Genus LIKE '%$keyword%'
         OR ref.Year LIKE '%$keyword%'
         group by a.Equation order by a.ID_AE desc limit " . $start . ", " . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_books_count($keyword = NULL)
    {
        if ($keyword == "NIL") $keyword = "";
        $sql = "SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Family   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
         LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         where dis.District LIKE '%$keyword%' OR a.Equation LIKE '%$keyword%' OR ref.Reference LIKE '%$keyword%'
         OR b.FAOBiomes LIKE '%$keyword%' OR s.Species  LIKE '%$keyword%'
         OR f.Family LIKE '%$keyword%' OR g.Genus LIKE '%$keyword%'
         OR ref.Year LIKE '%$keyword%'group by a.Equation order by a.ID_AE desc";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    


	public function get_data_type($specisId)
	{
		$data=$this->db->query("SELECT COUNT(m.ID_AE) AS TOTAL_EQN FROM (SELECT distinct(ID_AE) FROM ae WHERE Species='$specisId') m;")->result();
		return $data; 
	}


    public function get_data_type_ef($specisId)
  {
    $data=$this->db->query("SELECT COUNT(m.ID_EF) AS TOTAL_EQN FROM (SELECT distinct(ID_EF) FROM ef WHERE Species='$specisId') m;")->result();
    return $data; 
  }


    public function get_data_type_wd($specisId)
  {
    $data=$this->db->query("SELECT COUNT(m.ID_WD) AS TOTAL_EQN FROM (SELECT distinct(ID_WD) FROM wd WHERE ID_species='$specisId') m;")->result();
    return $data; 
  }


    public function get_data_type_rd($specisId)
  {
    $data=$this->db->query("SELECT COUNT(m.ID) AS TOTAL_EQN FROM (SELECT distinct(ID) FROM rd WHERE Species_ID='$specisId') m;")->result();
    return $data; 
  }



    public function get_data_type_backup($specisId)
  {
    $data=$this->db->query("SELECT COUNT(m.ID_EF_IPCC) AS TOTAL_EQN FROM (SELECT distinct(ID_EF_IPCC) FROM ef WHERE Species='$specisId') m;")->result();
    return $data; 
  }





	public function get_allometric_equation_backup($specis_id)
	{
		$data=$this->db->query("SELECT s.*, e.*,b.*,eco.*,d.*,dis.*,zon.*,ip.*,r.* from ef e
		 LEFT JOIN species s ON e.Species=s.ID_Species
		 LEFT JOIN ef_ipcc ip ON e.ID_EF_IPCC=ip.ID_EF_IPCC
		 LEFT JOIN reference r ON e.Reference=r.ID_Reference
		 LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
		 LEFT JOIN division d ON e.Division=d.ID_Division
		 LEFT JOIN district dis ON e.District =dis.ID_District
		 LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
		 WHERE e.Species=$specis_id GROUP BY e.ID_EF_IPCC")->result();
		 return $data; 
	}


	public function get_allometric_equation($specis_id)
	{
		$data=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Family   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
		     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
		    WHERE a.Species=$specis_id group by a.ID_AE order by a.ID_AE desc")->result();
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




	public function get_allometric_equation_details_backup_for_emission_factor_view_details($ID_Species)
	{
		$data=$this->db->query("SELECT ip.*, e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
		 LEFT JOIN species s ON e.Species=s.ID_Species
		 LEFT JOIN family f ON s.ID_Family=f.ID_Family
		 LEFT JOIN genus g ON f.ID_Family=g.ID_Family	
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
		 LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
		 LEFT JOIN division d ON e.Division=d.ID_Division
		 LEFT JOIN district dis ON e.District =dis.ID_District
		 LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
		 where e.Species=$ID_Species
		 GROUP BY e.Species")->result();
		 return $data; 
	}


	public function get_allometric_equation_details($ID_AE)
	{
		$data=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.ID_Species,s.Species,s.ID_Genus,s.ID_Family,r.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Genus 
         LEFT JOIN rd r ON a.ID_RD=r.ID   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
		     LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         where a.ID_AE=$ID_AE
		     order by a.ID_AE desc")->result();
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


	public function get_raw_data_details($ID)
	{
		$data=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         where r.ID=$ID order by r.ID desc
		 ")->result();
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


	  public function get_all_division() 
      {
            $this->db->select('division.*');
            $this->db->from('division');
            $this->db->order_by('division.ID_Division', 'ASC');
            return $this->db->get()->result();
      }


       public function get_all_district() 
      {
            $this->db->select('district.*');
            $this->db->from('district');
            $this->db->order_by('district.ID_District', 'ASC');
            return $this->db->get()->result();
      }

         public function get_all_faobiomes() 
      {
            $this->db->select('faobiomes.*');
            $this->db->from('faobiomes');
            $this->db->order_by('faobiomes.ID_FAOBiomes', 'ASC');
            return $this->db->get()->result();
      }

          public function get_all_ecological_zones() 
      {
            $this->db->select('ecological_zones.*');
            $this->db->from('ecological_zones');
            $this->db->order_by('ecological_zones.ID_1988EcoZones', 'ASC');
            return $this->db->get()->result();
      }


           public function get_all_zones() 
      {
            $this->db->select('zones.*');
            $this->db->from('zones');
            $this->db->order_by('zones.ID_Zones', 'ASC');
            return $this->db->get()->result();
      }






	 public function get_allometric_equation_grid($limit,$page)
	{
		$data=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.ID_Species,s.Species,s.ID_Genus,s.ID_Family,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Genus   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
         LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         order by a.ID_AE desc LIMIT $limit OFFSET $page")->result();
		 return $data; 
	}



     public function get_allometric_equation_grid_Speciesdata($specis_id,$limit,$page)
  {
    $data=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.ID_Species,s.Species,s.ID_Genus,s.ID_Family,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Family   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
         LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         where a.Species=$specis_id
         order by a.ID_AE desc LIMIT  $limit OFFSET $page")->result();

    //print($this->db->last_query());exit;
     return $data; 
  }



	 public function get_allometric_equation_grid_backup_for_Biomass_expansion_factors_menu()
	{
		$data=$this->db->query("SELECT ip.*, e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef_ipcc ip
         LEFT JOIN ef e ON ip.ID_EF_IPCC=e.ID_EF_IPCC
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         GROUP BY e.Species order by e.ID_EF desc
		")->result();
		 return $data; 
	}



     public function get_biomas_expension_factor($limit,$page)
  {
    $data=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         order by e.ID_EF desc LIMIT $limit OFFSET $page
    ")->result();
     return $data; 
  }




     public function get_biomas_expension_factor_species($specis_id,$limit,$page)
  {
    $data=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         where e.Species=$specis_id
         GROUP BY e.ID_EF order by e.ID_EF desc LIMIT $limit OFFSET $page
    ")->result();
     return $data; 
  }




    public function get_biomas_expension_factor_details($ID)
  {
    $data=$this->db->query("SELECT e.*,eco.*,b.*,d.*,rda.Species_ID,rda.Tree_type,rda.Vegetation_type,
     rda.Ecoregion_Udvardy,rda.Ecoregion_WWF,rda.Division_Bailey,rda.Zone_Holdridge,rda.Contributor,rda.Subspecies,
      dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family  
         LEFT JOIN rd rda ON e.Species=rda.Species_ID  
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
         
         where e.ID_EF=$ID
         order by e.ID_EF desc")->result();
     return $data; 
  }





	 public function get_allometric_equation_json()
	{
		$data=$this->db->query("SELECT a.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.*,eco.*,zon.* from ae a
         LEFT JOIN species s ON a.Species=s.ID_Species
         LEFT JOIN family f ON a.Family=f.ID_Family
         LEFT JOIN genus g ON a.Genus=g.ID_Genus   
         LEFT JOIN reference ref ON a.Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON a.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON a.Division=d.ID_Division
         LEFT JOIN district dis ON a.District =dis.ID_District
         LEFT JOIN zones zon ON a.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON a.WWF_Eco_zone =eco.ID_1988EcoZones
         order by a.ID_AE ASC
		");
		 //return $data; 
		 //echo "<pre>";
		 header('Content-disposition: attachment; filename=Allometric_Equation.json');
         header('Content-type: application/json');
		 echo json_encode($data->result()),'<br />';
	}


     public function get_biomass_expansion_factor_json()
  {
    $data=$this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* from ef e
         
         LEFT JOIN species s ON e.Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON s.ID_Genus=g.ID_Genus   
         LEFT JOIN reference r ON e.Reference=r.ID_Reference
         LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
         LEFT JOIN division d ON e.Division=d.ID_Division
         LEFT JOIN district dis ON e.District =dis.ID_District
         LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
          order by e.ID_EF desc
    ");
     //return $data; 
     //echo "<pre>";
     header('Content-disposition: attachment; filename=Biomass_Expansion_Factor.json');
         header('Content-type: application/json');
     echo json_encode($data->result()),'<br />';
  }




	 public function get_raw_data_grid($limit,$page)
	{
		$data=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         order by r.ID desc LIMIT $limit OFFSET $page
		")->result();
		 return $data; 
	}



   public function get_raw_data_grid_species($specis_id,$limit,$page)
  {
    $data=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Family   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         where r.Species_ID=$specis_id
         group by r.ID order by r.ID desc LIMIT $limit OFFSET $page
    ")->result();
     return $data; 
  }


	 public function get_wood_densities_grid_backup()
	{
		$data=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
         LEFT JOIN species s ON w.ID_Species=s.ID_Species
         LEFT JOIN family f ON s.ID_Family=f.ID_Family
         LEFT JOIN genus g ON f.ID_Family=g.ID_Family   
         LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
         LEFT JOIN location l ON w.ID_Location=l.ID_Location
		     LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		     LEFT JOIN division d ON l.ID_Division=d.ID_Division
		     LEFT JOIN district dis ON l.ID_District =dis.ID_District
		     LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones  GROUP BY w.ID_Species
         order by w.ID_WD desc
		")->result();
		 return $data; 
	}


	 public function get_wood_densities_grid($limit,$page)
	{
		$data=$this->db->query("SELECT m.*,s.Species,f.Family,wd.Density_green,r.Reference,r.Year FROM (SELECT ID_WD,ID_Species FROM wd w) m
        LEFT JOIN wd  ON m.ID_WD=wd.ID_WD
        LEFT JOIN reference r ON wd.ID_Reference = r.ID_Reference
        LEFT JOIN species s ON m.ID_Species=s.ID_Species
        left join family f ON wd.ID_family=f.ID_Family
        order by wd.ID_WD desc LIMIT $limit OFFSET $page
		")->result();
		 return $data; 
	}



   public function get_wood_densities_grid_species($specis_id,$limit,$page)
  {
    $data=$this->db->query("SELECT m.*,CONCAT(f.Family,' ',s.Species) Species,wd.Density_green,r.Reference,r.Year FROM (SELECT ID_WD,ID_Species FROM wd w) m
        LEFT JOIN wd  ON m.ID_WD=wd.ID_WD
        LEFT JOIN reference r ON wd.ID_Reference = r.ID_Reference
        LEFT JOIN species s ON m.ID_Species=s.ID_Species
        left join family f ON s.ID_Family=f.ID_Family
        where wd.ID_species=$specis_id
        order by wd.ID_WD desc LIMIT $limit OFFSET $page
    ")->result();
     return $data; 
  }

	public function get_wood_densities_details($ID)
	{
		$data=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.ID_Family,f.Family,g.* ,l.* from wd w
     LEFT JOIN species s ON w.ID_species=s.ID_Species
     LEFT JOIN family f ON w.ID_family=f.ID_Family
     LEFT JOIN genus g ON w.ID_genus=g.ID_Genus   
     LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
     LEFT JOIN location l ON w.ID_Location=l.ID_Location
		 LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
		 LEFT JOIN division d ON l.ID_Division=d.ID_Division
		 LEFT JOIN district dis ON l.ID_District =dis.ID_District
		 LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
     LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones  
		 where w.ID_WD=$ID
		 order by w.ID_WD desc")->result();
		 return $data; 
	}





	 public function get_raw_data_grid_json()
	{
		$data=$this->db->query("SELECT r.*,b.*,d.*,dis.*,s.*,ref.*,f.*,g.* from rd r
         LEFT JOIN species s ON r.Species_ID=s.ID_Species
         LEFT JOIN family f ON r.Family_ID=f.ID_Family
         LEFT JOIN genus g ON r.Genus_ID=g.ID_Genus   
         LEFT JOIN reference ref ON r.ID_Reference=ref.ID_Reference
         LEFT JOIN faobiomes b ON r.ID_FAO_Biomes=b.ID_FAOBiomes
         LEFT JOIN division d ON r.Division=d.ID_Division
         LEFT JOIN district dis ON r.District =dis.ID_District
         order by r.ID ASC
		");
		 header('Content-disposition: attachment; filename=Raw_Data.json');
         header('Content-type: application/json');
		 echo json_encode($data->result()),'<br />';
	}




   public function get_wood_density_grid_json()
  {
    $data=$this->db->query("SELECT w.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.* ,l.* from wd w
         LEFT JOIN species s ON w.ID_species=s.ID_Species
         LEFT JOIN family f ON w.ID_family=f.ID_Family
         LEFT JOIN genus g ON w.ID_genus=g.ID_Family   
         LEFT JOIN reference r ON w.ID_reference=r.ID_Reference
         LEFT JOIN location l ON w.ID_Location=l.ID_Location
         LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
         LEFT JOIN division d ON l.ID_Division=d.ID_Division
         LEFT JOIN district dis ON l.ID_District =dis.ID_District
         LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
         LEFT JOIN ecological_zones eco ON l.ID_1988EcoZones =eco.ID_1988EcoZones  
         order by w.ID_WD ASC
    ");
     header('Content-disposition: attachment; filename=Wood_Density.json');
         header('Content-type: application/json');
     echo json_encode($data->result()),'<br />';
  }




     public function get_species_list_json()
  {
    $data=$this->db->query("SELECT * FROM (SELECT CONCAT(f.Family,' ',s.Species) NAME,s.ID_Species FROM species s
      LEFT JOIN family f ON s.ID_Family=f.ID_Family order by s.ID_Species ASC
     ) m
    ");
     header('Content-disposition: attachment; filename=Species_List.json');
         header('Content-type: application/json');
     echo json_encode($data->result()),'<br />';
  }




    public function get_botanical_description($specis_id)
   {
    $data=$this->db->query("SELECT bd.*,s.* from botanical_descriptions bd
         LEFT JOIN species s ON bd.species_id=s.ID_Species
         WHERE bd.species_id=$specis_id ")->result();
     return $data; 
    }















}
