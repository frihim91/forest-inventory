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
                              (SELECT COUNT(*) FROM rd WHERE Species_ID=s.ID_Species) TOTAL_RD,
                              (SELECT COUNT(*) FROM wd WHERE ID_Species=s.ID_Species) TOTAL_WD,
                              bd.description,bd.name_bangla,s.species
                              FROM species s
                              LEFT JOIN botanical_descriptions bd ON s.ID_Species=bd.species_id
                               where s.ID_Species=$speciesId limit 1")->row();
    return $result;
  }
}
  ?>
