<?php

Class Datamodel extends CI_Model {

	function __construct() {
		parent::__construct();
	}
  public function getSpeciesList($familyId)
  {
    $result=$this->db->query("select * from species where ID_Family=$familyId order by Species ASC")->result();
    return $result;

  }
  public function getAvailableData($speciesId)
  {
    $result=$this->db->query("SELECT s.ID_Species,(SELECT COUNT(*) FROM ae where species=s.ID_species ) TOTAL_AE,
                              (SELECT COUNT(*) FROM ef WHERE species=s.ID_Species) TOTAL_EF,
                              (SELECT COUNT(*) FROM rd as rd LEFT JOIN species_group sr ON rd.Speciesgroup_ID=sr.Speciesgroup_ID
                              LEFT JOIN species s ON sr.ID_Species=s.ID_Species WHERE sr.ID_Species=$speciesId) TOTAL_RD,
                              (SELECT COUNT(*) FROM wd WHERE ID_species=s.ID_Species) TOTAL_WD,
                              bd.description,s.Species,sl.local_name,si.image_name
                              FROM species s
                              LEFT JOIN botanical_description bd ON s.ID_Species=bd.species
                              LEFT JOIN species_localname sl ON bd.botanical_id=sl.botanical_id
                              LEFT JOIN species_image si ON bd.botanical_id=si.botanical_id
                              where s.ID_Species=$speciesId limit 1")->row();
    return $result;
  }
}
  ?>
