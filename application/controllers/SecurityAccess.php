<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SecurityAccess extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->user_session) {
            redirect('auth/index');
        }
        $this->load->library("form_validation");
    }

    function moduleSetup() {

        $data["breadcrumbs"] = array(
            "Module" => "securityAccess/moduleSetup",
        );
        $data['pageTitle'] = "All Module List ";
        $data['all_modules'] = $this->utilities->findAllFromView("ati_modules");
        $data['content_view_page'] = 'setup/modules/all_module';
      
        //$this->load->view('setup/modules/all_module',$data);
        $this->template->display($data);
    }

    function createModule() {
        $module = array(
            'MODULE_NAME' => $this->input->post('txtModuleName'),
            'SHORT_NAME' => $this->input->post('txtModuleShortName'),
            'MODULE_NAME_BN' => $this->input->post('txtModuleNameBn'),
            'SL_NO' => $this->input->post('SL_NO'),
            'ACTIVE_STATUS' => isset($_POST['ACTIVE_STATUS']) ? 1 : 0,
            'ENTERED_BY' => $this->user_session["USER_ID"],
        );
        if ($this->utilities->insertData($module, 'ati_modules')) {
            $this->session->set_flashdata('Success', 'New Module Added Successfully.');
            redirect('securityAccess/moduleSetup');
        }
    }

    function edit_module($module_id) {
        $data['module_details'] = $this->utilities->findByAttribute('ati_modules', array('MODULE_ID' => $module_id));
        $this->load->view('setup/modules/edit_module', $data);
    }

    function update_module() {
        $MODULE_ID = $this->input->post('MODULE_ID');
        $module = array(
            'MODULE_NAME' => $this->input->post('txtModuleName'),
            'SHORT_NAME' => $this->input->post('txtModuleShortName'),
            'MODULE_NAME_BN' => $this->input->post('txtModuleNameBn'),
            'SL_NO' => $this->input->post('SL_NO'),
            'ACTIVE_STATUS' => isset($_POST['ACTIVE_STATUS']) ? 1 : 0,
            'ENTERED_BY' => $this->user_session["USER_ID"],
        );
        if ($this->utilities->updateData('ati_modules', $module, array('MODULE_ID' => $MODULE_ID))) {
            $this->session->set_flashdata('Success', 'Module information  updated Successfully.');
            redirect('securityAccess/moduleSetup');
        }
    }

    function moduleLinks() {
        $data["breadcrumbs"] = array(
            "Module Links" => "securityAccess/moduleLinks",
        );
        $data['pageTitle'] = "All Module Links ";
        $sql = "SELECT m.LINK_ID, m.LINK_NAME, m.LINK_NAME_BN, m.ATI_MLINK_PAGES, m.MODULE_ID,
                    (SELECT MODULE_NAME FROM ati_modules WHERE MODULE_ID = m.MODULE_ID)MODULE_NAME,
                    m.URL_URI, m.LINK_DESC,  m.SL_NO, m.`CREATE`, m.`READ`, m.`UPDATE`, m.`DELETE`, m.STATUS, m.ACTIVE_STATUS
                    FROM ati_module_links m";
        $data['moduleLinks'] = $this->db->query($sql)->result();
        $data['content_view_page'] = 'setup/modules/moduleLinks';
        $this->template->display($data);
    }

    function createModuleLink() {
        $this->form_validation->set_rules('txtmoduleId', 'Module', 'required');
        $this->form_validation->set_rules('txtLinkName', 'Module Link Name', 'required');
        $this->form_validation->set_rules('txtModLink', 'Module URL', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"] = array(
                "Module Links" => "securityAccess/moduleLinks",
                "Create Module Link" => "#",
            );
            $data['pageTitle'] = "Add Module Link";
            $data['content_view_page'] = 'setup/modules/create_module_link';
            $this->template->display($data);
        } else {
            /* echo '<pre>';
              print_r($_POST);
              exit; */
            if ($this->utilities->hasInformationByThisId('ati_module_links', array('MODULE_ID' => $this->input->post('txtmoduleId'), 'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")))) == FALSE) {
                $pages = implode(",", $this->input->post('chkpages'));
                $page = $this->input->post('chkpages');
                $modulelink = array(
                    'MODULE_ID' => $this->input->post('txtmoduleId'),
                    'LINK_NAME' => str_replace("'", "''", $this->input->post("txtLinkName")),
                    'LINK_NAME_BN' => str_replace("'", "''", $this->input->post("txtLinkNameBn")),
                    'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")),
                    'ATI_MLINK_PAGES' => "$pages",
                    'CREATE' => (array_key_exists(0, $page)) ? 1 : 0,
                    'READ' => (array_key_exists(1, $page)) ? 1 : 0,
                    'UPDATE' => (array_key_exists(2, $page)) ? 1 : 0,
                    'DELETE' => (array_key_exists(3, $page)) ? 1 : 0,
                    'STATUS' => (array_key_exists(4, $page)) ? 1 : 0,
                    'SL_NO' => $this->input->post('SL_NO'),
                    'ACTIVE_STATUS' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
                    'ENTERED_BY' => $this->user_session["USER_ID"]
                );
                $query2 = $this->utilities->insertData($modulelink, 'ati_module_links');
                if ($query2 == TRUE) {
                    $this->session->set_flashdata('Success', 'New Module Link Added Successfully.');
                }
            } else {
                $this->session->set_flashdata('Error', 'Sorry ! You Already Added this Link Name .');
            }
            redirect('securityAccess/moduleLinks', 'refresh');
        }
    }

    function editModuleLink($LINK_ID) {
        $previousInfo = $this->utilities->findByAttribute('ati_module_links', array('LINK_ID' => $LINK_ID));
        $this->form_validation->set_rules('txtmoduleId', 'Module', 'required');
        $this->form_validation->set_rules('txtLinkName', 'Module Link Name', 'required');
        $this->form_validation->set_rules('txtModLink', 'Module URL', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"] = array(
                "Module Links" => "securityAccess/moduleLinks",
                "Create Module Link" => "#",
            );
            $data['pageTitle'] = "Edit Module Link";
            $data['content_view_page'] = 'setup/modules/edit_module_link';
            $data['previousInfo'] = $previousInfo;
            $this->template->display($data);
        } else {
            /* echo '<pre>';
              print_r($_POST);
              exit; */
            $pages = implode(",", $this->input->post('chkpages'));
            $page = $this->input->post('chkpages');
            $dataArray = array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'LINK_NAME' => str_replace("'", "''", $this->input->post("txtLinkName")),
                'LINK_NAME_BN' => str_replace("'", "''", $this->input->post("txtLinkNameBn")),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")),
                'ATI_MLINK_PAGES' => "$pages",
                'CREATE' => (array_key_exists(0, $page)) ? 1 : 0,
                'READ' => (array_key_exists(1, $page)) ? 1 : 0,
                'UPDATE' => (array_key_exists(2, $page)) ? 1 : 0,
                'DELETE' => (array_key_exists(3, $page)) ? 1 : 0,
                'STATUS' => (array_key_exists(4, $page)) ? 1 : 0,
                'SL_NO' => $this->input->post('SL_NO'),
                'ACTIVE_STATUS' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
                'UPDATE_BY' => $this->user_session["USER_ID"]
            );
            if ($this->utilities->updateData('ati_module_links', $dataArray, array('LINK_ID' => $LINK_ID))) {
                if ($previousInfo->MODULE_ID != $this->input->post('txtmoduleId')) {
                    $PRE_SA_MODULE_ID = $this->utilities->get_max_value_by_attribute('sa_org_modules', 'SA_MODULE_ID', array('MODULE_IDS' => $previousInfo->MODULE_ID));
                    $SA_MODULE_ID = $this->utilities->get_max_value_by_attribute('sa_org_modules', 'SA_MODULE_ID', array('MODULE_IDS' => $this->input->post('txtmoduleId')));
                    $this->db->query("UPDATE sa_uglw_mlink m LEFT JOIN sa_org_mlinks o ON m.SA_MLINKS_ID = o.SA_MLINKS_ID SET  m.SA_MODULE_ID = $SA_MODULE_ID WHERE m.SA_MODULE_ID = $PRE_SA_MODULE_ID AND o.LINK_ID = $LINK_ID");
                    $this->utilities->updateData('sa_org_mlinks', array('SA_MODULE_ID' => $SA_MODULE_ID), array('SA_MODULE_ID' => $PRE_SA_MODULE_ID, 'LINK_ID' => $LINK_ID));
                }
                $this->session->set_flashdata('Success', 'Module Link Information Updated Successfully.');
            } else {
                $this->session->set_flashdata('Error', 'Failed To Updated Module Link Information .');
            }
            redirect('securityAccess/moduleLinks', 'refresh');
        }
    }

    public function orgModuleSetup() {
        $data["breadcrumbs"] = array(
            "Organizations" => "orgModuleSetup",
        );
        $data['pageTitle'] = "Organization List";
        $data["careProviders"] = $this->utilities->findAllByAttribute("sa_organizations", array("STATUS" => 1));

        // print_r($data);exit;
        $data['content_view_page'] = 'setup/org/index';
        $this->template->display($data);
    }

    public function createUser() {
        // $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "","USERGRP_ID","USERGRP_NAME",array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        $data['hid'] = $this->input->post('hid');
        $data['groups'] = $this->utilities->dropdownFromTableWithCondition('sa_user_group', '', 'USERGRP_ID', 'USERGRP_NAME', array('ACTIVE_STATUS' => 1));
        //$data['subproject'] = $this->utilities->dropdownFromTableWithCondition('pr_subproject', '', 'SUB_PROJECT_NO', 'SUB_PROJECT_TITLE', array('ACTIVE' => 1));

        echo $this->load->view('setup/org/create_user', $data, true);
    }

    public function moduleModalLink() {
        $data["hid"] = $this->input->post('hid');
        $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
        echo $this->load->view("setup/org/module_list", $data, true);
    }

    public function moduleModal() {
        $data["hid"] = $this->input->post('hid');
        $data["modules"] = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
        $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
        //echo "<pre>"; print_r($data);exit;
        echo $this->load->view("setup/org/add_module_to_cp", $data, true);
    }

    public function getModules() {
        $modules = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
        //$data["active_modules"] = $this->global_model->findAllByAttribute("ATI_HC_MODULES", array("HEALTHCARE_ID" => $data["hid"]));
        foreach ($modules as $module) {
            echo '<li class="ui-widget-content" id="' . $module->MODULE_ID . '" title="' . $module->MODULE_NAME . '">' . $module->MODULE_NAME . '</li>';
        }
    }

    public function addModules() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $hid = $this->input->post('hid');
        $module_ids = $this->input->post('add_selected_single_id');
        $module_names = $this->input->post('add_selected_single_name');
        for ($i = 0; $i < sizeof($module_ids); $i++) {
            if ($this->utilities->hasInformationByThisId('sa_org_modules', array("MODULE_IDS" => $module_ids[$i], "ORG_ID" => $hid)) == FALSE) {
                $attr = array(
                    "SA_MODULE_NAME" => $module_names[$i],
                    "MODULE_IDS" => $module_ids[$i],
                    "ORG_ID" => $hid
                );
                $this->utilities->insertData($attr, "sa_org_modules");
            }
        }
        $selected_modules = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $hid));
        $rtnSelectedModules = '';
        foreach ($selected_modules as $selected_module) {
            $rtnSelectedModules .= '<li title="' . $selected_module->SA_MODULE_NAME . '" id="' . $selected_module->SA_MODULE_ID . '" style="overflow: auto;" class="rename-module">
                                                        <span class="module-name">' . $selected_module->SA_MODULE_NAME . '</span>
                                                        <span class="module-name-input hidden">
                                                            <input type="text" style="width:90%; margin: 1px; float: left;" value="' . $selected_module->SA_MODULE_NAME . '" class="txtModuleName" data-hc-module-id="' . $selected_module->SA_MODULE_ID . '" id="txtModuleName">
                                                            <span class="remove-module-input pull-right fa fa-times pointer" title="Delete Module" style="font-size: 16px; color: red;"><span class="md-backspace"></span></span>
                                                        </span>
                                                        <span data-hc-module-id="' . $selected_module->SA_MODULE_ID . '" style="font-size: 16px; color: red;" title="Delete Module" class="remove-module pull-right fa fa-times pointer">
                                                            <span class="md-backspace"></span>
                                                        </span>
                                                    </li>';
        }
        echo $rtnSelectedModules;
    }

    public function removeHcModule() {
        $module_id = $this->input->post('m_id');
        $attr = array(
            "SA_MODULE_ID" => $module_id
        );
        return $this->utilities->deleteRowByAttribute("sa_org_modules", $attr);
    }

    public function updateModule() {
        $module_id = $this->input->post('m_id');
        $module_name = $this->input->post('m_name');
        $attr = array(
            "SA_MODULE_NAME" => $module_name
        );
        $rs = $this->utilities->updateData("sa_org_modules", $attr, array("SA_MODULE_ID" => $module_id));
        if ($rs == TRUE) {
            echo "green";
        }
    }

    function assignModulePage() {
        $values = explode(",", $this->input->post("values"));
        //print_r($values); exit;
        $module_id = $values[0];
        $link_id = $values[1];
        $page_type = $values[2];
        $org_id = $values[3];
        $is_checked = $this->input->post("is_checked");
        $check_existance = $this->utilities->findByAttribute("sa_org_mlinks", array("SA_MODULE_ID" => $module_id, "LINK_ID" => $link_id, "ORG_ID" => $org_id));
        if (!empty($check_existance)) {
            $updateData = array(
                'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance->CREATE,
                'READ' => ($page_type == 'R') ? $is_checked : $check_existance->READ,
                'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance->UPDATE,
                'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance->DELETE,
                'STATUS' => ($page_type == 'S') ? $is_checked : $check_existance->STATUS,
                'UPDATE_BY' => $this->user_session["USER_ID"],
                'UPDATED_TIMESTAMP' => date("Y-m-d H:i:s")
            );
            $this->utilities->updateData('sa_org_mlinks', $updateData, array("SA_MLINKS_ID" => $check_existance->SA_MLINKS_ID));
            echo "updated";
        } else {
            $insertData = array(
                'LINK_ID' => $link_id,
                'ORG_ID' => $org_id,
                'SA_MODULE_ID' => $module_id,
                'CREATE' => ($page_type == 'C') ? 1 : 0,
                'READ' => ($page_type == 'R') ? 1 : 0,
                'UPDATE' => ($page_type == 'U') ? 1 : 0,
                'DELETE' => ($page_type == 'D') ? 1 : 0,
                'STATUS' => ($page_type == 'S') ? 1 : 0,
                'ENTERED_BY' => $this->user_session["USER_ID"]
            );
            $this->utilities->insertData($insertData, 'sa_org_mlinks');
            echo "inserted";
        }
    }

    public function allGroup() {
        $data['pageTitle'] = 'View All Groups';
        $data['breadcrumbs'] = array(
            'Security and access' => '#',
            'Groups' => '#'
        );
        $data["groups"] = $this->utilities->findAllByAttribute("sa_user_group", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        $data['content_view_page'] = 'security_access/all_groups';
        $this->template->display($data);
    }

    public function update_user_group_lavel() {

        $level_id = $this->input->post("levelid");
        $level_data = $this->input->post("leveldata");

        if (!empty($level_data)) {
            $updateData = array(
                'UGLEVE_NAME' => $level_data,
                'UPDATE_BY' => $this->user_session["USER_ID"],
                'UPDATED_TIMESTAMP' => date("Y-m-d H:i:s")
            );
            if ($this->utilities->updateData('sa_ug_level', $updateData, array("UG_LEVEL_ID" => $level_id))) {
                echo "updated";
            } else {
                echo "failed";
            }
        }
    }

    public function groupModal() {
        $data["hid"] = $this->user_session["SES_ORG_ID"];
        $data["modules"] = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
        // $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
        echo $this->load->view("security_access/create_group", $data, true);
    }

    public function addNewGroup() {
        $h_id = $this->input->post("txtOrgId");
        $group_name = $this->input->post("txtGroupName");
        $attr = array(
            "ORG_ID" => $h_id,
            "USERGRP_NAME" => $group_name,
            "ACTIVE_STATUS" => isset($_POST['ACTIVE_STATUS']) ? 1 : 0,
            "ENTERED_BY" => $this->user_session["USER_ID"],
        );
        $rs = $this->utilities->insertData($attr, "sa_user_group");
        if ($rs == TRUE) {
            $this->session->set_flashdata('Success', 'User Group Created Successfully.');
            redirect('securityAccess/allGroup', 'refresh');
        } else {
            $this->session->set_flashdata('Error', 'User Group Create Failled.');
            redirect('securityAccess/allGroup', 'refresh');
        }
    }

    public function addUserBySubproject() {
        $h_id = $this->input->post("txtOrgId");
        $attr = array(
            "ORG_ID" => $h_id,
            "USERNAME" => $this->input->post("txtLoginName"),
            "USERPW" =>md5($this->input->post("txtPassword")),
            "SUB_PROJ_ID" => $this->input->post("subproject"),
            "USERGRP_ID" => $this->input->post("cmbGroupName"),
            "USERLVL_ID" => $this->input->post("cmbLevel"),
            "FULL_NAME" => $this->input->post("txtFirstName"),
            "EMAIL" => $this->input->post("txtEmail"),
            "IS_ADMIN" => isset($_POST['IS_ADMIN']) ? 1 : 0,
            "STATUS" => 1,
            "ENTERED_BY" => $this->user_session["USER_ID"]
        );
        //echo "<pre>";print_r($attr);exit;
        $rs = $this->utilities->insertData($attr, "sa_users");
        if ($rs == TRUE) {
            $this->session->set_flashdata('Success', 'User  Created Successfully.');
            redirect('securityAccess/orgModuleSetup', 'refresh');
        } else {
            $this->session->set_flashdata('Error', 'User Group Create Failled.');
            redirect('securityAccess/orgModuleSetup', 'refresh');
        }
    }

    public function assignModuleToLevelModal($user_group_id) {
        $data["user_group_id"] = $user_group_id;
        $data['pageTitle'] = 'Create Level';
        $data["levels"] = $this->utilities->findAllByAttribute("sa_ug_level", array("USERGRP_ID" => $user_group_id, "ACTIVE_STATUS" => 1));
        $data["group_modules"] = $this->utilities->getLevelModules($user_group_id);
        echo $this->load->view("security_access/assign_module_to_level", $data, true);
    }

    public function createLevelModal() {
        $data["user_group_id"] = $this->input->post("group_id");
        $data['pageTitle'] = 'Create Level';
        echo $this->load->view("security_access/create_level", $data, true);
    }

    public function viewAccessChartModal($user_id) {
        $data["user_id"] = $user_id;
        $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $data["user_id"], "STATUS" => 1));
        $data['pageTitle'] = 'User Access Chart';
        echo $this->load->view("security_access/view_access_chart", $data, true);
    }

    public function transferGroupUserModal($user_id) {
        $data["user_id"] = $user_id;
        $data['pageTitle'] = 'Transfer User To Another Group';
        $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $data["user_id"], "STATUS" => 1));
        $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/transfer_group_user", $data, true);
    }

    public function createLevel() {
        $insertdata = array(
            'UGLEVE_NAME' => $this->input->post('txtLevelName'),
            'ORG_ID' => $this->user_session["SES_ORG_ID"],
            'ACTIVE_STATUS' => isset($_POST['ACTIVE_STATUS']) ? 1 : 0,
            'USERGRP_ID' => $this->input->post('txtGroupId'),
            'ENTERED_BY' => $this->user_session["USER_ID"]
        );
        //print_r($insertdata);exit;
        if ($this->utilities->insertData($insertdata, 'sa_ug_level')) {
            $this->session->set_flashdata('Success', 'User Group Created Successfully.');
            redirect('securityAccess/allGroup', 'refresh');
        } else {
            $this->session->set_flashdata('Error', 'User Group Create Failled.');
            redirect('securityAccess/allGroup', 'refresh');
        }
    }

    public function transferGroup() {
        $updatedata = array(
            'USERGRP_ID' => $this->input->post('cmbGroup'),
            'UPDATED_BY' => $this->user_session["USER_ID"]
        );
        $this->utilities->updateData("sa_users", $updatedata, array("USER_ID" => $this->input->post('txtUserId')));
    }

    public function assignModuleToGroup() {
        $data['pageTitle'] = 'Assign Link To Group';
        $data['breadcrumbs'] = array(
            'Assign Link To Group' => '#'
        );

        // $data["departments"] = $this->utilities->dropdownFromTableWithCondition("hr_dept", "Select A Departments", "DEPT_NO", "DEPT_NAME", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_FLAG" => 1));
        $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        //$data["users"] = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        // $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $user_id, "ACTIVE_STATUS" => 1));
        $data['content_view_page'] = 'security_access/assign_module_to_group';
        $this->template->display($data);
    }

    public function assignModuleToGroupAction() {

        $group = $this->input->post('group_id');
        $level = $this->input->post('level_id');
        $values = explode(',', $this->input->post('values'));
        $module_id = $values[0];
        $link_id = $values[1];
        $page_type = $values[2];
        $is_checked = $this->input->post("is_checked");
        $check_existance = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MLINKS_ID" => $link_id, "USERGRP_ID" => $group, "UG_LEVEL_ID" => $level, "ORG_ID" => $this->user_session["SES_ORG_ID"]));

        if (!empty($check_existance)) {
            $updateData = array(
                'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance->CREATE,
                'READ' => ($page_type == 'R') ? $is_checked : $check_existance->READ,
                'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance->UPDATE,
                'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance->DELETE,
                'STATUS' => ($page_type == 'S') ? $is_checked : $check_existance->DELETE,
                'CREATED_BY' => $this->user_session["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->updateData('sa_uglw_mlink', $updateData, array("SA_MLINKS_ID" => $link_id, "USERGRP_ID" => $group, "UG_LEVEL_ID" => $level, "ORG_ID" => $this->user_session["SES_ORG_ID"]));
        } else {
            $insertData = array(
                'SA_MLINKS_ID' => $link_id,
                'USERGRP_ID' => $group,
                'UG_LEVEL_ID' => $level,
                'SA_MODULE_ID' => $module_id,
                'CREATE' => ($page_type == 'C') ? 1 : 0,
                'READ' => ($page_type == 'R') ? 1 : 0,
                'UPDATE' => ($page_type == 'U') ? 1 : 0,
                'DELETE' => ($page_type == 'D') ? 1 : 0,
                'STATUS' => ($page_type == 'S') ? 1 : 0,
                'ORG_ID' => $this->user_session["SES_ORG_ID"],
                'UPDATED_BY' => $this->user_session["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->insertData($insertData, 'sa_uglw_mlink');
        }
    }

    function ajax_permission_change() {
        $positionArray = explode(',', $_POST['position_value']);
        $user_group_id = $positionArray[0];
        $page_id = $positionArray[1];
        $module_id = $_POST['module_id'];
        $link_id = $_POST['link_id'];
        $status = $_POST['status'];
        $this->utilities->ajax_permission_change($user_group_id, $page_id, $module_id, $link_id, $status);
    }

    function ajax_permission_change_level() {
        $positionArray = explode(',', $_POST['position_value']);
        $user_level_id = $positionArray[0];
        $page_id = $positionArray[1];
        $module_id = $_POST['module_id'];
        $gr_id = $_POST['group_id'];
        $status = $_POST['status'];
        $this->utilities->ajax_permission_change_level($user_level_id, $page_id, $module_id, $gr_id, $status);
    }

    function getLevelsByGroup() {
        $group = $this->input->post("group");
        $levels = $this->utilities->dropdownFromTableWithCondition('sa_ug_level', 'Select Level -', 'UG_LEVEL_ID', 'UGLEVE_NAME', array('USERGRP_ID' => $group));
        if (!empty($levels)) {
            echo form_dropdown('cmbLevel', $levels, '', 'id="cmbLevel" class=""');
        } else {
            return FALSE;
        }
    }

    function getUsersByGroup() {
        $group = $this->input->post("group");

        $users = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "USERGRP_ID" => $group, "STATUS" => 1));
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->FULL_NAME . "</td>";
                echo '<td><a title="Access Chart of ' . $user->FULL_NAME . '" href="#myModal" role="button" data-toggle="modal" data-link="' . base_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID") . '"><span class="actionIcon dialogLink tooltips"  data-placement="top"><i class="icon-sitemap"></i></span></a></td>';
                echo '<td><span class="icon-unlock-alt tooltips actionIcon assignUser" id="' . $user->USER_ID . '" title="Change Access For This user Only" style="cursor: pointer;"></span></td>';
                echo '<td><span class="icon-signout tooltips actionIcon" title="Transfer To Different Group" style="cursor: pointer;"></span></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No User Found</td>";
            echo "</tr>";
        }
    }

    function getUsersByLevel() {
        $group = $this->input->post("group");
        $level = $this->input->post("level");

        $users = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "USERGRP_ID" => $group, "USERLVL_ID" => $level, "STATUS" => 1));
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->FULL_NAME . "</td>";
                echo '<td><a title="Access Chart of ' . $user->FULL_NAME . '" href="#myModal" role="button" data-toggle="modal" data-link="' . base_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID") . '"><span class="actionIcon dialogLink tooltips"  data-placement="top"><i class="icon-sitemap"></i></span></a></td>';
                echo '<td><span class="icon-unlock-alt tooltips actionIcon assignUser" id="' . $user->USER_ID . '" title="Change Access For This user Only" style="cursor: pointer;"></span></td>';
                echo '<td><span class="icon-signout tooltips actionIcon" id="' . $user->USER_ID . '" title="Transfer To Different Group" style="cursor: pointer;"></span></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No User Found</td>";
            echo "</tr>";
        }
    }

    function getUsersByDepartment() {
        $department = $this->input->post("department");

        $users = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "DEPT_ID" => $department, "STATUS" => 1));
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->FULL_NAME . "</td>";
                echo '<td><a title="Access Chart of ' . $user->FULL_NAME . '" href="#myModal" role="button" data-toggle="modal" data-link="' . base_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID") . '"><span class="actionIcon dialogLink tooltips"  data-placement="top"><i class="icon-sitemap"></i></span></a></td>';
                echo '<td><span class="icon-unlock-alt tooltips actionIcon assignUser" id="' . $user->USER_ID . '" title="Change Access For This user Only" style="cursor: pointer;"></span></td>';
                echo '<td><span class="icon-signout tooltips actionIcon" id="' . $user->USER_ID . '" title="Transfer To Different Group" style="cursor: pointer;"></span></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No User Found</td>";
            echo "</tr>";
        }
    }

    function getModuleAcceesByGroup() {

        $data["group"] = $this->input->post("group");
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_group_id", $data, true);
    }

    function getModuleAcceesByGroupLevel() {

        $data["group"] = $this->input->post("group");
        $data["level"] = $this->input->post("level");
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_group_level", $data, true);
    }

    function getModuleAcceesByUser() {

        $user_id = $this->input->post("user");
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $user_id, "STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_user", $data, true);
    }

    function getModuleAcceesByUsers() {

        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_users", $data, true);
    }

    function assignModuleAccessToUsers() {
        $users = $this->input->post("chkUser");
        for ($i = 0; $i < sizeof($users); $i++) {
            $group = $this->input->post('group_id');
            $level = $this->input->post('level');
            $sa_uglwm_link = $this->input->post('sa_uglwm_link_id');

            $values = explode(',', $this->input->post('values'));
            $module_id = $values[0];
            $link_id = $values[1];
            $page_type = $values[2];
            $is_checked = $this->input->post("is_checked");
            $check_existance_in_user = $this->utilities->findByAttribute("sa_user_mlink", array("SA_UGLWM_LINK" => $sa_uglwm_link, "SA_MLINKS_ID" => $link_id, "USER_ID" => $users[$i]));

            if (!empty($check_existance_in_user)) {
                $updateExistingUserAccessData = array(
                    'SA_MLINKS_ID' => $link_id,
                    'USER_ID' => $users[$i],
                    'USERGRP_ID' => $group,
                    'UG_LEVEL_ID' => $level,
                    'SA_UGLWM_LINK' => $check_existance_in_user->SA_UGLWM_LINK,
                    'SA_MODULE_ID' => $module_id,
                    'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance_in_user->CREATE,
                    'READ' => ($page_type == 'R') ? $is_checked : $check_existance_in_user->READ,
                    'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance_in_user->UPDATE,
                    'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance_in_user->DELETE,
                    'UPDATED_BY' => $this->user_session["USER_ID"],
                    'UPDATE_DATE' => date("Y-m-d H:i:s")
                );
                $this->utilities->updateData('sa_user_mlink', $updateExistingUserAccessData, array("SA_UGLWM_LINK" => $sa_uglwm_link, "USER_ID" => $users[$i]));
                $updateExistingGroupAccessData = array(
                    'USER_ID' => $users[$i],
                    'UPDATED_BY' => $this->user_session["USER_ID"],
                    'UPDATE_DATE' => date("Y-m-d H:i:s")
                );
                $this->utilities->updateData('sa_uglw_mlink', $updateExistingGroupAccessData, array("SA_UGLWM_LINK" => $sa_uglwm_link));
            } else {
                $check_existance_in_group = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MLINKS_ID" => $link_id, "ORG_ID" => $this->user_session["SES_ORG_ID"], "USERGRP_ID" => $group, "UG_LEVEL_ID" => $level, "SA_MODULE_ID" => $module_id));
                if (!empty($check_existance_in_group)) {
                    $insertData = array(
                        'SA_MLINKS_ID' => $link_id,
                        'USER_ID' => $users[$i],
                        'USERGRP_ID' => $group,
                        'UG_LEVEL_ID' => $level,
                        'SA_UGLWM_LINK' => $check_existance_in_group->SA_UGLWM_LINK,
                        'SA_MODULE_ID' => $module_id,
                        'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance_in_group->CREATE,
                        'READ' => ($page_type == 'R') ? $is_checked : $check_existance_in_group->READ,
                        'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance_in_group->UPDATE,
                        'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance_in_group->DELETE,
                        'ORG_ID' => $this->user_session["SES_ORG_ID"],
                        'CREATED_BY' => $this->user_session["USER_ID"]
                    );
                    $this->utilities->insertData($insertData, 'sa_user_mlink');
                } else {
                    $insertGroupAccessData = array(
                        'SA_MLINKS_ID' => $link_id,
                        'USER_ID' => $users[$i],
                        'USERGRP_ID' => $group,
                        'UG_LEVEL_ID' => $level,
                        'SA_MODULE_ID' => $module_id,
                        'CREATE' => 0,
                        'READ' => 0,
                        'UPDATE' => 0,
                        'DELETE' => 0,
                        'ORG_ID' => $this->user_session["SES_ORG_ID"],
                        'CREATED_BY' => $this->user_session["USER_ID"]
                    );
                    $this->utilities->insertData($insertGroupAccessData, 'sa_uglw_mlink');
                    $max_group_access_id = $this->utilities->get_max_value("sa_uglw_mlink", "SA_UGLWM_LINK");
                    $insertUserAccess = array(
                        'SA_MLINKS_ID' => $link_id,
                        'USER_ID' => $users[$i],
                        'USERGRP_ID' => $group,
                        'UG_LEVEL_ID' => $level,
                        'SA_UGLWM_LINK' => $max_group_access_id,
                        'SA_MODULE_ID' => $module_id,
                        'CREATE' => ($page_type == 'C') ? $is_checked : 0,
                        'READ' => ($page_type == 'R') ? $is_checked : 0,
                        'UPDATE' => ($page_type == 'U') ? $is_checked : 0,
                        'DELETE' => ($page_type == 'D') ? $is_checked : 0,
                        'STATUS' => ($page_type == 'S') ? $is_checked : 0,
                        'ORG_ID' => $this->user_session["SES_ORG_ID"],
                        'CREATED_BY' => $this->user_session["USER_ID"]
                    );
                    $this->utilities->insertData($insertUserAccess, 'sa_user_mlink');
                }
            }
        }
    }

    public function assignModuleAcceesByUser() {

        $group = $this->input->post('group_id');
        $level = $this->input->post('level');
        $user = $this->input->post('user');
        $values = explode(',', $this->input->post('values'));
        $module_id = $values[0];
        $link_id = $values[1];
        $page_type = $values[2];
        $is_checked = $this->input->post("is_checked");
        $check_user_existance = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MODULE_ID" => $module_id, "SA_MLINKS_ID" => $link_id, "ORG_ID" => $this->user_session["SES_ORG_ID"], "USER_ID" => $user));
        //$check_user_existance = $this->utilities->findByAttribute("sa_user_mlink", array("SA_UGLWM_LINK" => $sa_uglwm_link, "SA_MLINKS_ID" => $link_id, "USER_ID" => $users[$i]));

        if (!empty($check_user_existance)) {
            $updateExistingUserAccessData = array(
                'CREATE' => ($page_type == 'C') ? $is_checked : $check_user_existance->CREATE,
                'READ' => ($page_type == 'R') ? $is_checked : $check_user_existance->READ,
                'UPDATE' => ($page_type == 'U') ? $is_checked : $check_user_existance->UPDATE,
                'DELETE' => ($page_type == 'D') ? $is_checked : $check_user_existance->DELETE,
                'STATUS' => ($page_type == 'S') ? $is_checked : $check_user_existance->STATUS,
                'UPDATED_BY' => $this->user_session["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->updateData('sa_uglw_mlink', $updateExistingUserAccessData, array("SA_UGLWM_LINK" => $check_user_existance->SA_UGLWM_LINK));
        } else {
            $insertUserAccessData = array(
                'SA_MLINKS_ID' => $link_id,
                'USER_ID' => $user,
                'SA_MODULE_ID' => $module_id,
                'ORG_ID' => $this->user_session["SES_ORG_ID"],
                'CREATE' => ($page_type == 'C') ? $is_checked : 0,
                'READ' => ($page_type == 'R') ? $is_checked : 0,
                'UPDATE' => ($page_type == 'U') ? $is_checked : 0,
                'DELETE' => ($page_type == 'D') ? $is_checked : 0,
                'STATUS' => ($page_type == 'S') ? $is_checked : 0,
                'CREATED_BY' => $this->user_session["USER_ID"],
                'CREATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->insertData($insertUserAccessData, 'sa_uglw_mlink');
        }
    }

    public function module_report_category() {

        $data['report_mod'] = $this->utilities->dropdownFromTableWithCondition("ati_modules", " Select ", "MODULE_ID", "MODULE_NAME", array("ACTIVE_STATUS =" => 1));
        $data['content_view_page'] = 'setup/modules/module_report_category';
        $this->template->display($data);
    }

    public function add_parameters_by_report_module() {
        $data['re_mod'] = $this->input->post('report_id');
        $this->load->view('setup/modules/module_re_add_parameters', $data);
    }

    public function add_new_report_module_cat() {
        if ($_POST) {
            $insertData = array(
                'CATEGORY_NAME' => $this->input->post('CATEGORY_NAME'),
                'SHORT_NAME' => $this->input->post('SHORT_NAME'),
                'MODULE_ID' => $this->input->post('MODULE_ID'),
                'UD_SL_NO' => $this->input->post('UD_SL_NO'),
                'ACTIVE' => isset($_POST['ACTIVE']) ? 1 : 0,
                'CRE_BY' => $this->user_session["USER_ID"],
            );
            if ($this->utilities->insertData($insertData, 'pr_module_reportcategory')) {
                redirect('securityAccess/module_report_category', 'refresh');
            }
        }
    }

    public function get_parameters_by_report_module() {
        $re_mod = $this->input->post('report_id');
        $data['parameters'] = $this->utilities->findAllByAttribute('pr_module_reportcategory', array('MODULE_ID' => $re_mod));
        $this->load->view('setup/modules/view_parameters_by_report_module', $data);
    }

    public function edit_report_module_cat() {
        $cat_id = $data['cat_id'] = $this->input->post('cat_id');
        $data['cat_info'] = $this->utilities->findByAttribute('pr_module_reportcategory', array('CATEGORY_ID' => $cat_id));
        $this->load->view('setup/modules/edit_module_parameters', $data);
    }

    public function update_report_module_cat() {
        if ($_POST) {
            $cat_id = $this->input->post('CATEGORY_ID');
            $updateData = array(
                'CATEGORY_NAME' => $this->input->post('CATEGORY_NAME'),
                'SHORT_NAME' => $this->input->post('SHORT_NAME'),
                'UD_SL_NO' => $this->input->post('UD_SL_NO'),
                'ACTIVE' => isset($_POST['ACTIVE']) ? 1 : 0,
                'UPD_BY' => $this->user_session["USER_ID"],
            );

            if ($this->utilities->updateData('pr_module_reportcategory', $updateData, array('CATEGORY_ID' => $cat_id))) {
                $this->session->set_flashdata('Success', 'Updated Successfully.');
                redirect('securityAccess/module_report_category', 'refresh');
            }
        }
    }

}
