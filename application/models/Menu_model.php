<?php

Class Menu_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_modules() {
        $this->db->select('ati_modules.*, ati_module_links.URL_URI, ati_module_links.LINK_NAME, ati_module_links.ACTIVE_STATUS as STATUS, ati_module_links.LINK_ID');
        $this->db->from('ati_modules');
        $this->db->join('ati_module_links', 'ati_modules.MODULE_ID = ati_module_links.MODULE_ID', 'left');
        $this->db->order_by('ati_modules.MODULE_NAME', 'ASC');
        //$this->db->where_in('SA_ORGANIZATIONS.ORG_TYPE', array('0', '1'));      
        return $this->db->get()->result();
    }
	
	
	 public function get_all_title() {
        $this->db->select('pg_title.*');
        $this->db->from('pg_title');
		$this->db->where('pg_title.PARENT_ID = ',0,TRUE);
       
        $this->db->order_by('pg_title.TITLE_NAME', 'ASC');
        //$this->db->where_in('SA_ORGANIZATIONS.ORG_TYPE', array('0', '1'));      
        return $this->db->get()->result();
    }

    public function get_modules_links() {
        $session_info = $this->session->userdata('carePro_logged_in');
        $orgId = $session_info['org_id'];
        $this->db->select('ATI_HC_MODULES.HC_MODULE_NAME, ATI_HC_MODULES.HC_MODULE_ID');
        $this->db->from('SA_ORGANIZATIONS');
        $this->db->join('ATI_HEALTHCARE', 'SA_ORGANIZATIONS.ORG_TYPE = ATI_HEALTHCARE.ORG_TYPE_ID', 'left');
        $this->db->join('ATI_HC_MODULES', 'ATI_HEALTHCARE.HEALTHCARE_ID = ATI_HC_MODULES.HEALTHCARE_ID', 'left');
        //$this->db->order_by('ATI_MODULES.MODULE_NAME', 'ASC');
        $this->db->where('SA_ORGANIZATIONS.ORG_ID', $orgId);
        return $this->db->get()->result();
    }

    public function getOrgModules() {
        $session_info = $this->session->userdata('user_logged_in');
        $org = $session_info['SES_ORG_ID'];
        $org_group = $session_info['USERGRP_ID'];
        $org_group_level = $session_info['USERLVL_ID'];
        $user = $session_info['USER_ID'];
        $this->db->distinct();
        $this->db->select('sa_org_modules.SA_MODULE_NAME,ati_modules.MODULE_NAME_BN, sa_org_modules.SA_MODULE_ID, ati_modules.CATEGORY');
        $this->db->from('sa_uglw_mlink');
        $this->db->join('sa_org_modules', 'sa_uglw_mlink.SA_MODULE_ID = sa_org_modules.SA_MODULE_ID', 'left');
        $this->db->join('ati_modules', 'sa_org_modules.MODULE_IDS = ati_modules.MODULE_ID', 'left');
        $this->db->where('sa_uglw_mlink.USERGRP_ID', $org_group);
        $this->db->where('sa_uglw_mlink.UG_LEVEL_ID', $org_group_level);
        $this->db->or_where('sa_uglw_mlink.USER_ID', $user);
        $this->db->where('sa_uglw_mlink.ORG_ID', $org);
        $this->db->or_where('sa_uglw_mlink.CREATE', "1");
        $this->db->or_where('sa_uglw_mlink.READ', "1");
        $this->db->or_where('sa_uglw_mlink.UPDATE', "1");
        $this->db->or_where('sa_uglw_mlink.DELETE', "1");
        $this->db->or_where('sa_uglw_mlink.STATUS', "1");
        $this->db->order_by('ati_modules.SL_NO', "ASC");
        return $this->db->get()->result();
    }

    public function get_all_module_links($modid) {
        $session_info = $this->session->userdata('user_logged_in');
        $org = $session_info['SES_ORG_ID'];
        $user = $session_info['USER_ID'];
        $org_group = $session_info['USERGRP_ID'];
        $org_group_level = $session_info['USERLVL_ID'];
        return $this->db->query("
                SELECT `ati_module_links`.`LINK_ID`,`ati_module_links`.`LINK_NAME`,`ati_module_links`.`LINK_NAME_BN`,`ati_module_links`.`URL_URI`,`sa_uglw_mlink`.`SA_MLINKS_ID`
                FROM `sa_uglw_mlink`  ,`sa_org_mlinks` ,`ati_module_links`
                WHERE  `sa_uglw_mlink`.`SA_MLINKS_ID` = `sa_org_mlinks`.`SA_MLINKS_ID`
                AND `sa_org_mlinks`.`LINK_ID` = `ati_module_links`.`LINK_ID`    
                AND `ati_module_links`.`ACTIVE_STATUS` = 1
                AND ((`sa_uglw_mlink`.`ORG_ID` = '$org' 
                AND `sa_uglw_mlink`.`USERGRP_ID` = '$org_group'
                AND `sa_uglw_mlink`.`UG_LEVEL_ID` = '$org_group_level')            
                OR  `sa_uglw_mlink`.`USER_ID` = $user)
                AND `sa_uglw_mlink`.`SA_MODULE_ID` = '$modid'
                AND (`sa_uglw_mlink`.`CREATE` = 1 OR `sa_uglw_mlink`.`READ` = 1 OR `sa_uglw_mlink`.`UPDATE` = 1 OR `sa_uglw_mlink`.`DELETE` = 1 OR `sa_uglw_mlink`.`STATUS` = 1)
                ORDER BY `ati_module_links`.`SL_NO` ASC")->result();
    }

    public function getOrgModulesByUser($user) {
        $user_info = $this->findByAttribute("sa_users", array("USER_ID" => $user));
        $this->db->distinct();
        $this->db->select('sa_org_modules.SA_MODULE_NAME, sa_org_modules.SA_MODULE_ID');
        $this->db->from('sa_uglw_mlink');
        $this->db->join('sa_org_modules', 'sa_uglw_mlink.SA_MODULE_ID = sa_org_modules.SA_MODULE_ID', 'left');
        if ($user_info->USERGRP_ID != "") {
            $this->db->where('sa_uglw_mlink.USERGRP_ID', $user_info->USERGRP_ID);
        }
        if ($user_info->USERLVL_ID != "") {
            $this->db->where('sa_uglw_mlink.UG_LEVEL_ID', $user_info->USERLVL_ID);
        }
        $this->db->or_where('sa_uglw_mlink.USER_ID', $user);
        $this->db->where('sa_uglw_mlink.ORG_ID', $user_info->ORG_ID);
        $this->db->or_where('sa_uglw_mlink.CREATE', "1");
        $this->db->or_where('sa_uglw_mlink.READ', "1");
        $this->db->or_where('sa_uglw_mlink.UPDATE', "1");
        $this->db->or_where('sa_uglw_mlink.DELETE', "1");
        $this->db->or_where('sa_uglw_mlink.STATUS', "1");
        return $this->db->get()->result();
    }

    public function get_all_module_linksByUser($user, $modid) {
        $user_info = $this->findByAttribute("sa_users", array("USER_ID" => $user));
        return $this->db->query("
                SELECT `ati_module_links`.`LINK_ID`,`ati_module_links`.`LINK_NAME`,`ati_module_links`.`URL_URI`,`sa_uglw_mlink`.`SA_MLINKS_ID`
            FROM `sa_uglw_mlink`  ,`sa_org_mlinks` ,`ati_module_links`
            WHERE  `sa_uglw_mlink`.`SA_MLINKS_ID` = `sa_org_mlinks`.`SA_MLINKS_ID`
                AND `sa_org_mlinks`.`LINK_ID` = `ati_module_links`.`LINK_ID`
                
               AND ((`sa_uglw_mlink`.`ORG_ID` = '$user_info->ORG_ID' 
            AND `sa_uglw_mlink`.`USERGRP_ID` = '$user_info->USERGRP_ID'
            AND `sa_uglw_mlink`.`UG_LEVEL_ID` = '$user_info->UG_LEVEL_ID')
            
            OR  `sa_uglw_mlink`.`USER_ID` = $user
            )
            AND `sa_uglw_mlink`.`SA_MODULE_ID` = '$modid'
            AND (`sa_uglw_mlink`.`CREATE` = 1 OR `sa_uglw_mlink`.`READ` = 1 OR `sa_uglw_mlink`.`UPDATE` = 1 OR `sa_uglw_mlink`.`DELETE` = 1 OR `sa_uglw_mlink`.`STATUS` = 1)
                ")->result();
    }

    public function get_all_module_links_from_user($modid, $link) {
        $session_info = $this->session->userdata('user_logged_in');
        $org = $session_info['SES_ORG_ID'];
        $org_group = $session_info['USERGRP_ID'];
        $org_group_level = $session_info['USERLVL_ID'];
        $this->db->select('sa_user_mlink.SA_MLINKS_ID,ati_module_links.LINK_ID, ati_module_links.LINK_NAME, ati_module_links.URL_URI,sa_user_mlink.SA_UGLWM_LINK');
        $this->db->from('sa_user_mlink');
        $this->db->join('sa_org_mlinks', 'sa_user_mlink.SA_MLINKS_ID = sa_org_mlinks.SA_MLINKS_ID', 'left');
        $this->db->join('ati_module_links', 'sa_org_mlinks.LINK_ID = ati_module_links.LINK_ID', 'left');
        $this->db->where('sa_user_mlink.ORG_ID', $org);
        $this->db->where('sa_user_mlink.SA_MODULE_ID', $modid);
        $this->db->where('sa_user_mlink.SA_MLINKS_ID', $link);
        $this->db->where('sa_user_mlink.USER_ID', $session_info['USER_ID']);
        return $this->db->get()->result();
    }

    public function get_all_checked_module_links_by_user1($modid, $link_id, $org_group, $org_group_level, $user) {
        $session_info = $this->session->userdata('user_logged_in');
        $org = $session_info['SES_ORG_ID'];
        return $this->db->query("
            SELECT `sa_user_mlink`.`SA_UGLWM_LINK`,`sa_user_mlink`.`SA_MLINKS_ID`,`sa_user_mlink`.`CREATE`,`sa_user_mlink`.`READ`,`sa_user_mlink`.`UPDATE`,`sa_user_mlink`.`DELETE`,`sa_user_mlink`.`STATUS`,`sa_user_mlink`.`USERGRP_ID`,`sa_user_mlink`.`UG_LEVEL_ID`
            FROM `sa_user_mlink` 
            WHERE `sa_user_mlink`.`ORG_ID` = '$org' 
            AND `sa_user_mlink`.`USERGRP_ID` = '$org_group'
            AND `sa_user_mlink`.`UG_LEVEL_ID` = '$org_group_level'
            AND `sa_user_mlink`.`USER_ID` = $user
            AND `sa_user_mlink`.`SA_MODULE_ID` = '$modid'
            AND `sa_user_mlink`.`SA_MLINKS_ID` = '$link_id'
            UNION 
            SELECT `sa_uglw_mlink`.`SA_UGLWM_LINK`,`sa_uglw_mlink`.`SA_MLINKS_ID`,`sa_uglw_mlink`.`CREATE`,`sa_uglw_mlink`.`READ`,`sa_uglw_mlink`.`UPDATE`,`sa_uglw_mlink`.`DELETE`,`sa_uglw_mlink`.`STATUS`,`sa_uglw_mlink`.`USERGRP_ID`,`sa_uglw_mlink`.`UG_LEVEL_ID`
            FROM `sa_uglw_mlink` 
            WHERE `sa_uglw_mlink`.`ORG_ID` = '$org' 
            AND `sa_uglw_mlink`.`USERGRP_ID` = '$org_group'
            AND `sa_uglw_mlink`.`UG_LEVEL_ID` = '$org_group_level'
            AND `sa_uglw_mlink`.`SA_MODULE_ID` = '$modid'
            AND `sa_uglw_mlink`.`SA_MLINKS_ID` = '$link_id'               
        ")->row();
    }

    public function get_all_checked_module_links_by_user($urlUri, $org_group, $org_group_level, $user) {
        $session_info = $this->session->userdata('user_logged_in');
        $org = $session_info['SES_ORG_ID'];
        return $this->db->query("
                    SELECT p.`CREATE`, p.`READ`, p.`UPDATE`, p.`DELETE`, p.STATUS
                    FROM sa_uglw_mlink p
                    LEFT JOIN sa_org_mlinks ol ON ol.SA_MLINKS_ID = p.SA_MLINKS_ID
                    LEFT JOIN ati_module_links l ON ol.LINK_ID = l.LINK_ID
                    WHERE  ((p.`ORG_ID` = $org AND p.`USERGRP_ID` = $org_group AND p.`UG_LEVEL_ID` = $org_group_level )OR  p.`USER_ID` = $user) AND l.URL_URI = '$urlUri' ")->row();
        /* return $this->db->query("
          SELECT `sa_uglw_mlink`.`SA_UGLWM_LINK`,`sa_uglw_mlink`.`SA_MLINKS_ID`,`sa_uglw_mlink`.`CREATE`,`sa_uglw_mlink`.`READ`,`sa_uglw_mlink`.`UPDATE`,`sa_uglw_mlink`.`DELETE`,`sa_uglw_mlink`.`STATUS`,`sa_uglw_mlink`.`USERGRP_ID`,`sa_uglw_mlink`.`UG_LEVEL_ID`
          FROM `sa_uglw_mlink`
          WHERE ((`sa_uglw_mlink`.`ORG_ID` = '$org'
          AND `sa_uglw_mlink`.`USERGRP_ID` = '$org_group'
          AND `sa_uglw_mlink`.`UG_LEVEL_ID` = '$org_group_level')
          OR  `sa_uglw_mlink`.`USER_ID` = $user
          )
          AND `sa_uglw_mlink`.`SA_MODULE_ID` = '$modid'
          AND `sa_uglw_mlink`.`SA_MLINKS_I` = '$link_id'
          ")->row(); */
    }

    // -----------------------------Added By Jahid--------------------------------
    public function ajax_permission_change($gr_id, $page, $mid, $link, $status) {
        $session_info = $this->session->userdata('user_logged_in');
        $role_permission_info = $this->db->get_where('sa_ugw_mlink', array('USERGRP_ID' => $gr_id, 'SA_MLINKS_ID' => $page))->row();
        if (empty($role_permission_info)) {
            $this->USERGRP_ID = $gr_id;
            $this->SA_MLINKS_ID = $page;
            $this->LINK_ID = $link;
            $this->SA_MODULE_ID = $mid;
            $this->ORG_ID = $session_info["SES_ORG_ID"];
            $this->ACTIVE_STATUS = $status;
            $this->CREATED_BY = $session_info["USER_ID"];
            $this->db->insert('sa_ugw_mlink', $this);
        } else {
            $this->ACTIVE_STATUS = $status;
            $this->db->update('sa_ugw_mlink', $this, array('SA_UGWM_LINK' => $role_permission_info->SA_UGWM_LINK));
        }
    }

    public function ajax_permission_change_level($gr_level_id, $page, $mid, $gr_id, $status) {
        $session_info = $this->session->userdata('user_logged_in');
        $role_permission_info = $this->db->get_where('sa_uglw_mlink', array('UG_LEVEL_ID' => $gr_level_id, 'SA_MLINKS_ID' => $page))->row();
        if (empty($role_permission_info)) {
            $this->UG_LEVEL_ID = $gr_level_id;
            $this->SA_MLINKS_ID = $page;
            $this->SA_MODULE_ID = $mid;
            $this->USERGRP_ID = $gr_id;
            $this->ORG_ID = $session_info["SES_ORG_ID"];
            $this->ACTIVE_STATUS = $status;
            $this->CREATED_BY = $session_info["USER_ID"];
            $this->db->insert('sa_uglw_mlink', $this);
        } else {
            $this->ACTIVE_STATUS = $status;
            $this->db->update('sa_uglw_mlink', $this, array('SA_UGLWM_LINK' => $role_permission_info->SA_UGLWM_LINK));
        }
    }

    public function getLevelModules($gr_id) {
        $this->db->distinct();
        $this->db->select("sa_org_modules.SA_MODULE_ID,sa_org_modules.SA_MODULE_NAME");
        $this->db->from("sa_ugw_mlink");
        $this->db->join("sa_org_modules", "sa_ugw_mlink.SA_MODULE_ID=sa_org_modules.SA_MODULE_ID", "left");
        $this->db->where("sa_ugw_mlink.USERGRP_ID", $gr_id);
        $this->db->where("sa_ugw_mlink.ACTIVE_STATUS", 1);
        return $this->db->get()->result();
    }

    public function getModuleAccessByUser($u_id) {
        return $this->db->query("
            SELECT a.SA_UGLWM_LINK,
                COALESCE (a.`CREATE`, b.`CREATE`) AS `CREATE`,
                COALESCE (a.`READ`, b.`READ`) AS `READ`,
                COALESCE (a.`UPDATE`, b.`UPDATE`) AS `UPDATE`,
                COALESCE (a.`DELETE`, b.`DELETE`) AS `DELETE`
                FROM sa_user_mlink a
                LEFT JOIN  sa_uglw_mlink b ON a.SA_UGLWM_LINK=b.SA_UGLWM_LINK
                WHERE a.USER_ID = $u_id")->row();
    }

}
