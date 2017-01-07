<?php

Class Setup_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_admin_info($adminId) {
        $this->db->select('SA_USERS.*, SA_ORGANIZATIONS.ORG_NAME');
        $this->db->from('SA_USERS');
        $this->db->join('SA_ORGANIZATIONS', 'SA_USERS.ORG_ID = SA_ORGANIZATIONS.ORG_ID', 'left');
        $this->db->where('SA_USERS.USER_ID', $adminId);
        return $this->db->get()->row();
    }

    public function get_all_modules() {
        $this->db->select('ATI_MODULES.*, ATI_MODULE_LINKS.URL_URI, ATI_MODULE_LINKS.LINK_NAME, ATI_MODULE_LINKS.ACTIVE_STATUS as STATUS, ATI_MODULE_LINKS.LINK_ID');
        $this->db->from('ATI_MODULES');
        $this->db->join('ATI_MODULE_LINKS', 'ATI_MODULES.MODULE_ID = ATI_MODULE_LINKS.MODULE_ID', 'left');
        $this->db->order_by('ATI_MODULES.MODULE_NAME', 'ASC');
        return $this->db->get()->result();
    }

    public function get_last_id($row, $table) {
        $this->db->select_max($row);
        return $this->db->get($table)->row();
    }

    public function addModule($id, $mname, $mids) {
        $this->HEALTHCARE_ID = $id;
        $this->HC_MODULE_NAME = $mname;
        $this->MODULE_IDS = $mids;
        $this->db->insert('ATI_HC_MODULES', $this);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function updateModule($id, $mname, $mids) {
        $this->HEALTHCARE_ID = $id;
        $this->HC_MODULE_NAME = $mname;
        $this->MODULE_IDS = $mids;
        $this->db->update('ATI_HC_MODULES', $this, array('HEALTHCARE_ID' => $id));

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function getModuleLinks($ids) {
        $this->db->where_in('MODULE_ID', $ids);
        return $this->db->get('ATI_MODULE_LINKS')->result();
    }

    public function getActiveLinks($hc_id) {
        $this->db->select("ATI_HC_MLINKS.*");
        $this->db->from("ATI_HC_MLINKS");
        $this->db->join("ATI_HC_MODULES", "ATI_HC_MLINKS.HC_MODULE_ID=ATI_HC_MODULES.HC_MODULE_ID", "left");
        $this->db->where("ATI_HC_MODULES.HEALTHCARE_ID", $hc_id);
        $query = $this->db->get()->result();
        $a = array();
        foreach ($query as $q) {
            $a[] = $q->LINK_ID;
        }
        return $a;
    }

    public function getSelectedModules($id) {
        $this->db->select("HC_MODULE_ID,HC_MODULE_NAME,HEALTHCARE_ID");
        $this->db->from("ATI_HC_MODULES");
        $this->db->where("HEALTHCARE_ID", $id);
        return $this->db->get()->result();
    }

    public function getActiveLinksForCP($hc_id) {
        $this->db->select("sa_org_mlinks.*");
        $this->db->from("sa_org_mlinks");
        $this->db->join("sa_org_modules", "sa_org_mlinks.SA_MODULE_ID=sa_org_modules.SA_MODULE_ID", "left");
        $this->db->where("sa_org_modules.ORG_ID", $hc_id);
        $query = $this->db->get()->result();
        $a = array();
        foreach ($query as $q) {
            $a[] = $q->LINK_ID;
        }
        return $a;
    }
	
	
}