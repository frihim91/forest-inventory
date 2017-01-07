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

    public function get_win_acca_staff_stu($ITEM_NO) {
        $win_acc_staff = $this->db->get_where('pr_win_acca_staff_stu', array('ITEM_NO' => $ITEM_NO));
        return $win_acc_staff->row();
    }

    public function get_subproject_type() {
        $data = $this->db->query('SELECT a.ITEM_NAME,a.ITEM_NO,(SELECT WINDOW_NAME 
                                                                                    FROM pr_window
                                                                                    WHERE PR_WINDOW_NO = a.PR_WINDOW_NO
                                                                                    ) WINDOW_NAME,
                                                                                    CASE WHEN a.ACADEMIC_LEVEL = "PD" THEN 
                                                                                    "Post Graduation" 
                                                                                    WHEN a.ACADEMIC_LEVEL = "UD" THEN
                                                                                    "Under Graduate"
                                                                                    ELSE 
                                                                                    "Not Defaine"
                                                                                    END GRADIATE,a.ACTIVE,b.item_name AS parent_item_name		
                                                                                    FROM pr_win_acca_staff_stu a LEFT JOIN pr_win_acca_staff_stu b ON (a.parent_item_no=b.item_No)
                                                                                    ');
        return $data->result();
    }

    public function get_expenditure_item($EXP_ITEM_NO) {
        $expenditure_item = $this->db->get_where('fn_expenditure_item', array('EXP_ITEM_NO' => $EXP_ITEM_NO));
        return $expenditure_item->row();
    }

    public function get_expenditure_item_all() {
        $data = $this->db->query('SELECT a.EXP_ITEM_NO,a.ITEM_NAME,a.ECONOMIC_CODE,
			CASE WHEN a.EXP_TYPE = "RE" THEN 
                                                "Revenue Expenditure" 
                                                WHEN a.EXP_TYPE = "CE" THEN
                                                "Capital Expenditure"
                                                WHEN a.EXP_TYPE = "OE" THEN
                                                "Operational Expenditure"
                                                ELSE 
                                                "Not Define"
                                                END EXP_TYPE,
			CASE WHEN a.EXP_LEVEL = "1" THEN 
                                                "Main Expenditure Head" 
                                                WHEN a.EXP_LEVEL = "2" THEN
                                                "Expenditure Head"
                                                WHEN a.EXP_LEVEL = "3" THEN
                                                "Sub Expenditure Head"
                                                WHEN a.EXP_LEVEL = "4" THEN
                                                "Detail Expenditure Head"
                                                ELSE 
                                                "Not Define"
                                                END EXP_LEVEL,
                                                (SELECT B.ITEM_NAME 
												FROM fn_expenditure_item B
												WHERE B.EXP_ITEM_NO = a.PARENT_ITEM_NO) UNDER_ITEM,
                                                a.ACTIVE			
                                FROM fn_expenditure_item a');
        return $data->result();
    }

    public function get_win_facilities_res() {
        $data = $this->db->query('SELECT a.FACILITIES_NO,a.FACILITIES_NAME,(SELECT WINDOW_NAME 
                                        FROM pr_window
                                        WHERE PR_WINDOW_NO = a.PR_WINDOW_NO
                                        ) WINDOW_NAME,
                                        CASE WHEN a.SELECTION_METHOD = "1" THEN 
                                                "Physical,Biological and Earth Science" 
                                                WHEN a.SELECTION_METHOD = "2" THEN
                                                "Medical,Health & Nutritional"
                                                WHEN a.SELECTION_METHOD = "3" THEN
                                                "Engineering & Technological"
                                                WHEN a.SELECTION_METHOD = "4" THEN
                                                "Agriculture (Crops,Livestock,Vetenary,Poultry,Fisheries and Horticulture)"
                                                WHEN a.SELECTION_METHOD = "5" THEN
                                                "Arts, Hunanities & Social Sciences"
                                                WHEN a.SELECTION_METHOD = "6" THEN
                                                "Business & Law"
                                                ELSE 
                                                "Not Defaine"
                                                END SELECTION_METHOD,a.ACTIVE			
                                FROM pr_win_facilities_res a');
        return $data->result();
    }

    public function get_checklist() {
        $data = $this->db->query('SELECT a.ITEM_NO,a.ITEM_NAME , 
								(SELECT ITEM_NAME 							
								FROM pr_checklist
								WHERE ITEM_NO = a.PARANT_NO) PARANT_NO
								FROM pr_checklist a');
        return $data->result();
    }

    public function get_subProjectQuartlyReport() {
        $data = $this->db->query('SELECT DISTINCT 
									a.SUB_PROJECT_NO,b.QUARTER_NAME,b.QUARTER_FROM_DT,b.QUARTER_TO_DT,
									(SELECT  c.INSTITUTE_NAME
									FROM pr_institute c ,pr_subproject d
									WHERE c.INSTITUTE_NO = d.INSTITUTE_NO
									AND d.SUB_PROJECT_NO =a.SUB_PROJECT_NO) INSTITUTE_NAME,
									(SELECT  d.SUB_PROJECT_TITLE
									FROM pr_institute c ,pr_subproject d
									WHERE c.INSTITUTE_NO = d.INSTITUTE_NO
									AND d.SUB_PROJECT_NO =a.SUB_PROJECT_NO) SUB_PROJECT_TITLE
								FROM fn_ac_expenditure_mst a,fn_quarter_setup b
								WHERE a.QUARTER_NO = b.QUARTER_NO');
        return $data->result();
    }

    public function get_quarter_year() {
        $data = $this->db->query('SELECT a.QUARTER_NO,a.QUARTER_NAME,a.QUARTER_FROM_DT,a.QUARTER_TO_DT,a.LAST_DT_PRE_QUARTER,a.ACTIVE,
									(SELECT FY_NAME 
									FROM fn_fin_year
									WHERE FY_NO = a.FY_NO) FY_NAME 
								FROM fn_quarter_setup a');
        return $data->result();
    }

}