<?php

     /**
     
     * @package Admin Panel
     * @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @copyright  2017 ATI Limited Development Group
     
    */
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

     /**
     * SecuritySetup Class
     *
     * Parses URIs and determines routing
     *
     * @package     Admin Panel
     * @subpackage  Admin Panel
     * @category    Admin Panel
     * @author      Rokibuzzaman <rokibuzzaman@atilimited.net>
     *
     */


    class SecuritySetup extends CI_Controller {

        function __construct() {
            parent::__construct();

            $this->user_session = $this->session->userdata('user_logged_in');
            if (!$this->user_session) {
                redirect('dashboard/auth/index');
            }
            $this->load->model('setup_model');
            $this->load->helper(array('html', 'form'));
            $this->load->library('form_validation');
        }


    /**
     * I belong to a file
     */

        public function checkPrevilege() {
            $controller = $this->uri->segment(1, 'dashboard');
            $action = $this->uri->segment(2, 'index');
            $link = "$controller/$action";
            return $this->security_model->get_all_checked_module_links_by_user($link, $this->user_session['USERGRP_ID'], $this->user_session['USERLVL_ID'], $this->user_session['USER_ID']);
        }


    /**
     * I belong to a file
     */

        function index() {
            $session_info = $this->session->userdata('logged_in');
            $adminId = $session_info['id'];
            $data['admin_info'] = $this->setup_model->get_admin_info($adminId);
            $data['pageTitle'] = '.: Dashboard :: Healthline :.';
            $data['content_view_page'] = 'admin_template/home';
            $this->template->display($data);
        }



    /**
     * I belong to a file
     */


       public function moduleSetup() {
            $data['pageTitle'] = 'Modules';
            $data['all_modules'] = $this->utilities->findAllFromView("ati_modules");
            $data['content_view_page'] = 'setup/modules/all_module';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */


        public function createModule() {
            $module = array(
                'MODULE_NAME' => $this->input->post('mod_name'),
                'MODULE_NAME_BN' => $this->input->post('mod_name_bn'),
                'ENTERED_BY' => $this->user_session["USER_ID"]
            );
            if ($this->utilities->insertData($module, 'ati_modules')) {
                echo "Module Created";
            }
        }

    /**
     * I belong to a file
     */


        public function get_last_id($row, $table) {
            $this->db->select_max($row);
            return $this->db->get($table)->row();
        }


    /**
     * I belong to a file
     */


        public function createModuleLink() {
            $this->form_validation->set_rules('txtmoduleId', 'Module', 'required');
            $this->form_validation->set_rules('txtLinkName', 'Module Link Name', 'required');
            $this->form_validation->set_rules('txtModLink', 'Module URL', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['content_view_page'] = 'setup/modules/create_module_link';
                $this->template->display($data);
            } else {
                $pages = implode(",", $this->input->post('chkpages'));
                $page = $this->input->post('chkpages');
                $modulelink = array(
                    'MODULE_ID' => $this->input->post('txtmoduleId'),
                    'LINK_NAME' => str_replace("'", "''", $this->input->post("txtLinkName")),
                    'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")),
                    'ATI_MLINK_PAGES' => "$pages",
                    'CREATE' => (array_key_exists(0, $page)) ? 1 : 0,
                    'READ' => (array_key_exists(1, $page)) ? 1 : 0,
                    'UPDATE' => (array_key_exists(2, $page)) ? 1 : 0,
                    'DELETE' => (array_key_exists(3, $page)) ? 1 : 0,
                    'STATUS' => (array_key_exists(4, $page)) ? 1 : 0,
                    'ENTERED_BY' => 1
                );
                $query2 = $this->utilities->insertData($modulelink, 'ati_module_links');
                if ($query2 == TRUE) {
                    $this->session->set_flashdata('Success', 'New Module Link Added Successfully.');
                    redirect('setup/createModuleLink', 'refresh');
                }
            }
        }

    /**
     * I belong to a file
     */


        public function editModuleLink() {
            $link_id = $this->input->post('link');
            $data["link_details"] = $this->global_model->findAllByAttribute("ati_module_links", array("LINK_ID" => $link_id));
            echo $this->load->view("admin_profile/setup/modules/update_module_link", $data, true);
        }


    /**
     * I belong to a file
     */

        public function careProviderType() {
            $lookupId = array(
                'LOOKUP_ID' => '1'
            );
            $data['all_cptypes'] = $this->global_model->findAllByAttributeOrder('SA_LOOKUP_DATA', $lookupId, 'LOOKUP_DATA_NAME', 'ASC');
            $data['content_view_page'] = 'admin_profile/setup/care-provider/all_care_provider';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */

        public function changeModuleStatus() {
            $linkid = $this->input->post('linkid');
            $status = $this->input->post('status');
            if ($status == '1') {
                $att = array(
                    'ACTIVE_STATUS' => '0'
                );
            } else {
                $att = array(
                    'ACTIVE_STATUS' => '1'
                );
            }
            $this->global_model->updateRow('ati_modules', $att, 'MODULE_ID = ' . $linkid);
        }


    /**
     * I belong to a file
     */

        public function changeCpTypeStatus() {
            $cpid = $this->input->post('cpTypid');
            $status = $this->input->post('status');

            if ($status == '1') {
                $att = array(
                    'ACTIVE_FLAG' => '0'
                );
            } else {
                $att = array(
                    'ACTIVE_FLAG' => '1'
                );
            }
            $this->global_model->updateRow('SA_LOOKUP_DATA', $att, 'LOOKUP_DATA_ID = ' . $cpid);
        }


    /**
     * I belong to a file
     */

        public function changeTemplateStatus() {
            $hid = $this->input->post('hid');
            $status = $this->input->post('st');

            if ($status == '1') {
                $att = array(
                    'ACTIVE_STATUS' => '0'
                );
            } else {
                $att = array(
                    'ACTIVE_STATUS' => '1'
                );
            }
            $this->global_model->updateRow('ATI_HEALTHCARE', $att, 'HEALTHCARE_ID = ' . $hid);
        }



    /**
     * I belong to a file
     */

        public function CareProviderTemplateList() {
            $data['all_template_lists'] = $this->global_model->findAllByAttributeWithJoinByOrder("ATI_HEALTHCARE", "SA_LOOKUP_DATA", "ORG_TYPE_ID", "LOOKUP_DATA_ID", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", "", "left", "HEALTHCARE_ID");
            $data['content_view_page'] = 'admin_profile/setup/care-provider/list_all_care_provider_template';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */

        public function addCareProviderTemplate() {
            $data['pageTitle'] = 'Add Care Provider Template';
            $data['notification'] = "Add Care Provider Template";
            $attr = array("LOOKUP_ID" => 1);
            $data["cp_type"] = $this->global_model->dropdownFromTableWithCondition("SA_LOOKUP_DATA", "Select A Care Provider Type", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", $attr);

            $this->form_validation->set_rules('txtCpTypeName', 'Care Provider Type Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['content_view_page'] = 'admin_profile/setup/care-provider/add_cp_template';
                $this->template->display($data);
            } else {
                $last_id = $this->get_last_id('HEALTHCARE_ID', 'ATI_HEALTHCARE');
                $ldataId = ($last_id->HEALTHCARE_ID + 1);
                $cpType = array(
                    'HEALTHCARE_ID' => $ldataId,
                    'ORG_TYPE_ID' => $this->input->post('txtCpTypeName'),
                    'HC_NAME' => $this->input->post('txtTemplateName'),
                    'HC_PROSPECTUS' => $this->input->post('txtBrochure'),
                    'ACTIVE_STATUS' => '1'
                );
                $query = $this->global_model->insertRow('ATI_HEALTHCARE', $cpType);
                if ($query == TRUE) {
                    redirect('admin/setup/addCareProviderTemplate', 'refresh');
                }
            }
        }

    /**
     * I belong to a file
     */

        public function moduleModal() {
            $data["hid"] = $this->input->post('hid');
            $data["modules"] = $this->utilities->findAllByAttribute("ATI_MODULES", array("ACTIVE_STATUS" => 1));
            $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
            echo $this->load->view("setup/org/add_module_to_cp", $data, true);
        }


    /**
     * I belong to a file
     */

        public function moduleModalLink() {
            $data["hid"] = $this->input->post('hid');
            $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
            echo $this->load->view("setup/org/module_list", $data, true);
        }


    /**
     * I belong to a file
     */


        public function getModules() {
            $modules = $this->utilities->findAllByAttribute("ATI_MODULES", array("ACTIVE_STATUS" => 1));
            //$data["active_modules"] = $this->global_model->findAllByAttribute("ATI_HC_MODULES", array("HEALTHCARE_ID" => $data["hid"]));
            foreach ($modules as $module) {
                echo '<li class="ui-widget-content" id="' . $module->MODULE_ID . '" title="' . $module->MODULE_NAME . '">' . $module->MODULE_NAME . '</li>';
            }
        }


    /**
     * I belong to a file
     */


        public function addModules() {
            $hid = $this->input->post('hid');
            $module_ids = $this->input->post('add_selected_single_id');
            $module_names = $this->input->post('add_selected_single_name');
            $modules = $this->input->post('add_selected_single_id');
            for ($i = 0; $i < sizeof($module_ids); $i++) {
                $attr = array(
                    "SA_MODULE_NAME" => $module_names[$i],
                    "MODULE_IDS" => $modules[$i],
                    "ORG_ID" => $hid
                );
                $this->utilities->insertData($attr, "sa_org_modules");
            }
            $selected_modules = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $hid));
            foreach ($selected_modules as $selected_module) {
                echo '<li class="ui-widget-content rename-module" id="' . $selected_module->SA_MODULE_ID . '" title="' . $selected_module->SA_MODULE_NAME . '">
                    <span class="module-name">' . $selected_module->SA_MODULE_NAME . '</span>
                        <span class="module-name-input hidden">
                                <input type="text" id="txtModuleName" data-hc-module-id="' . $selected_module->SA_MODULE_ID . '" class="txtModuleName" value="' . $selected_module->SA_MODULE_NAME . '" style="width:90%; margin: 1px; float: left;" />
                                <span class="iconb rht icon-red remove-module-input" style="font-size: 7px; margin: 8px 6px 0 0;">x</span>
                            </span>
                        <span class="iconb rht icon-red remove-module" data-icon="&#xe05e;"></span></li>';
            }
        }


    /**
     * I belong to a file
     */


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


    /**
     * I belong to a file
     */


        public function removeHcModule() {
            $module_id = $this->input->post('m_id');
            $attr = array(
                "SA_MODULE_ID" => $module_id
            );
            return $this->utilities->deleteRowByAttribute("sa_org_modules", $attr);
        }



    /**
     * I belong to a file
     */


        public function assignModuleToHcTemplate() {
            $hid = $this->input->post('txtHcTemplateId');
            $check_id = $this->global_model->countRowByCon("ATI_HC_MODULES", "HEALTHCARE_ID", $hid);
            if ($check_id == TRUE) {
                $attr = array(
                    "HC_MODULE_NAME" => $this->input->post('txtModuleName'),
                    "MODULE_IDS" => implode(",", $this->input->post('module'))
                );
                $rs = $this->global_model->updateRow("ATI_HC_MODULES", $attr, array("HEALTHCARE_ID" => $hid));
                if ($rs == TRUE) {
                    echo "Updated";
                } else {
                    echo "Failled";
                }
            } else {
                $last_id = $this->global_model->getLastId("ATI_HC_MODULES", "HC_MODULE_ID");
                $attr = array(
                    "HC_MODULE_ID" => $last_id->HC_MODULE_ID + 1,
                    "HEALTHCARE_ID" => $hid,
                    "HC_MODULE_NAME" => $this->input->post('txtModuleName'),
                    "MODULE_IDS" => implode(",", $this->input->post('module'))
                );
                $rs = $this->global_model->insertRow("ATI_HC_MODULES", $attr);
                if ($rs == TRUE) {
                    echo "Added";
                } else {
                    echo "Add Failled";
                }
            }
        }


    /**
     * I belong to a file
     */


        public function assignPageTemplate() {
            $data['pageTitle'] = 'assignPageTemplate';
            $data['notification'] = "assignPageTemplate";
            $data["modules"] = $this->global_model->findAllByAttribute("ATI_MODULES", array("ACTIVE_STATUS" => 1));
            $data['content_view_page'] = 'admin_profile/setup/care-provider/assign_page_template';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */


        public function addLinkToTemplateModule() {
            $module_id = $this->input->post("module");
            $link_id = $this->input->post("link");
            $check_id = $this->global_model->findByAttribute("ATI_HC_MLINKS", array("HC_MODULE_ID" => $module_id, "LINK_ID" => $link_id));
            if (!empty($check_id)) {
                $attr = array(
                    "SHOW_FLAG" => ($check_id->SHOW_FLAG == 1) ? 0 : 1
                );
                $rs = $this->global_model->updateRow("ATI_HC_MLINKS", $attr, array("HC_MODULE_ID" => $module_id, "LINK_ID" => $link_id));
                if ($rs == TRUE) {
                    echo "green";
                }
            } else {
                $last_id = $this->global_model->getLastId("ATI_HC_MLINKS", "HC_MLINKS_ID");
                $attr = array(
                    "HC_MLINKS_ID" => $last_id->HC_MLINKS_ID + 1,
                    "HC_MODULE_ID" => $module_id,
                    "LINK_ID" => $link_id,
                    "SHOW_FLAG" => 1
                );
                $rs = $this->global_model->insertRow("ATI_HC_MLINKS", $attr);
                if ($rs == TRUE) {
                    echo "green";
                }
            }
        }


    /**
     * I belong to a file
     */


        public public function careProviderRequests() {
            $data['pageTitle'] = 'assignPageTemplate';
            $data['notification'] = "assignPageTemplate";
            $data["modules"] = $this->global_model->findAllByAttribute("ATI_MODULES", array("ACTIVE_STATUS" => 1));
            $data['content_view_page'] = 'admin_profile/care_providers/requests';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */


        public function createInsructionHeader() {
            $attr = array("LOOKUP_ID" => 1);
            $data["cp_type"] = $this->global_model->dropdownFromTableWithCondition("SA_LOOKUP_DATA", "Select A Care Provider Type", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", $attr);
            $data['content_view_page'] = 'admin_profile/setup/care-provider/add_ins_template';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */


        public function orgModuleSetup() {
            $data['pageTitle'] = 'Organization List';
            $data["careProviders"] = $this->utilities->findAllByAttribute("sa_organizations", array("STATUS" => 1));
            $data['content_view_page'] = 'setup/org/index';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */


        public function changeOrgStatus() {
            $hid = $this->input->post('hid');
            $status = $this->input->post('st');

            if ($status == '1') {
                $att = array(
                    'ACTIVE_STATUS' => '0'
                );
            } else {
                $att = array(
                    'ACTIVE_STATUS' => '1'
                );
            }
            $this->global_model->updateRow('sa_organizations', $att, 'ORG_ID = ' . $hid);
        }

    /**
     * I belong to a file
     */


        public function groupModal() {
            $data["hid"] = $this->input->post('hid');
            $data["modules"] = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
            $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
            echo $this->load->view("setup/org/create_group", $data, true);
        }

    /**
     * I belong to a file
     */


        public function addNewGroup() {
            $session_info = $this->session->userdata('logged_in');
            $h_id = $this->input->post("txtOrgId");
            $group_name = $this->input->post("txtGroupName");
            $attr = array(
                "ORG_ID" => $h_id,
                "USERGRP_NAME" => $group_name,
                "ENTERED_BY" => $session_info["USER_ID"],
            );
            $rs = $this->utilities->insertData($attr, "sa_user_group");
            if ($rs == TRUE) {
                $this->session->set_flashdata('flashMessage', array('Success', 'User Created Successfully.'));
                redirect('setup/orgModuleSetup', 'refresh');
            }
        }


     /**
     * I belong to a file
     */


        public function userAssignToGroupModal() {
            $data["hid"] = $this->input->post('hid');
            $data["groups"] = $this->global_model->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => $data["hid"]));
            echo $this->load->view("admin_profile/care_providers/create_user", $data, true);
        }

    /**
     * I belong to a file
     */


        function assignModulePage() {
            $session_info = $this->session->userdata('logged_in');
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
                    'UPDATE_BY' => $session_info["USER_ID"],
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
                    'ENTERED_BY' => $session_info["USER_ID"]
                );
                $this->utilities->insertData($insertData, 'sa_org_mlinks');
                echo "inserted";
            }
        }


    /**
     * I belong to a file
     */


        public function manageUser() { // - by jahid
            $data["previlages"] = $this->checkPrevilege();
            $data['pageTitle'] = 'User List';
            $data["users"] = $this->utilities->findAllFromView("sa_users");
            $data['content_view_page'] = 'setup/user/index';
            $this->template->display($data);
        }


    /**
     * I belong to a file
     */


        public function createUserModal() {
            $data["departments"] = $this->utilities->dropdownFromTableWithCondition("hr_dept", "Select A Departments", "DEPT_NO", "DEPT_NAME", array("ORG_ID" => $this->user_session["SES_ORG_ID"], "ACTIVE_FLAG" => "Y"));
            $data["designations"] = $this->utilities->dropdownFromTableWithCondition("hr_designation", "Select A Designations", "DESIG_ID", "DESIG_NAME", array("ACTIVE_FLAG" => 1));
            $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => $this->user_session["SES_ORG_ID"]));
            $data["labels"] = $this->utilities->dropdownFromTableWithCondition("sa_ug_level", "Select A label", "UG_LEVEL_ID", "UGLEVE_NAME", array("ORG_ID" => $this->user_session["SES_ORG_ID"]));
            echo $this->load->view("setup/user/create", $data, true);
        }

    /**
     * I belong to a file
     */


        public function createNewUser() {
            $attr = array(
                "ORG_ID" => $this->user_session["SES_ORG_ID"],
                "USERGRP_ID" => $this->input->post("cmbGroupName"),
                "USERLVL_ID" => $this->input->post("cmbLabelName"),
                "DEPT_ID" => $this->input->post("cmbDepartment"),
                "DESIG_ID" => $this->input->post("cmbDesignation"),
                "FIRST_NAME" => $this->input->post("txtFirstName"),
                "MIDDLE_NAME" => $this->input->post("txtMiddleName"),
                "LAST_NAME" => $this->input->post("txtLastName"),
                "FULL_NAME" => $this->input->post("txtFirstName") . " " . $this->input->post("txtMiddleName") . " " . $this->input->post("txtLastName"),
                "EMAIL" => $this->input->post("txtEmail"),
                "USERNAME" => $this->input->post("txtLoginName"),
                "USERPW" => md5($this->input->post("txtPassword"))
            );
            $rs = $this->utilities->insertData($attr, "sa_users");
            if ($rs == TRUE) {
                $this->session->set_flashdata('flashMessage', array('Success', 'User Created Successfully.'));
                redirect('setup/manageUser', 'refresh');
            }
        }


    /**
     * I belong to a file
     */


        public function getLabelByGroup() {
            $group_id = $this->input->post("group_id");
            $labels = $this->utilities->findAllByAttribute("sa_ug_level", array("USERGRP_ID" => $group_id));
            if (!empty($labels)) {
                foreach ($labels as $label) {
                    echo "<option value='" . $label->UG_LEVEL_ID . "'>" . $label->UGLEVE_NAME . "</option>";
                }
            } else {
                echo "<option'>Select Label</option>";
            }
        }


    /**
     * I belong to a file
     */


        public function siteInfo() {
            $data['pageTitle'] = 'Site Information Setup';
            $data["site_info"] = $this->utilities->findAllFromView("site_info");
            $this->form_validation->set_rules('txtInfoTitle', 'Title', 'required');
            $this->form_validation->set_rules('txtInfoTitle', 'Title', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['content_view_page'] = 'setup/site/site_info';
            } else {
                $siteArray = array(
                    "S_INFO_TITLE" => $this->input->post("txtInfoTitle"),
                    "S_INFO_DESC" => $this->input->post("txtInfoDesc"),
                );
                if ($this->utilities->insertData($siteArray, 'site_info')) {
                    $this->session->set_flashdata('Success', 'New Site Information Created Successfully');
                    redirect('setup/siteInfo', 'refresh');
                } else {
                    $this->session->set_flashdata('Error', 'Site Information Create Failled');
                    redirect('setup/siteInfo', 'refresh');
                }
            }
            $this->template->display($data);
        }

    /**
     * I belong to a file
     */


        public function updateSiteInfoModal() {
            $info_id = $this->input->post('info_id');
            $data["site_info"] = $this->utilities->findByAttribute("site_info", array("S_INFO_ID" => $info_id));
            echo $this->load->view("setup/site/edit", $data, true);
        }


    /**
     * I belong to a file
     */


        public function updateSiteInfo() {
            $siteArray = array(
                "S_INFO_TITLE" => $this->input->post("site_title"),
                "S_INFO_DESC" => $this->input->post("desc"),
            );
            $rs = $this->utilities->updateData("site_info", $siteArray, array("S_INFO_ID" => $this->input->post("site_id")));
            if ($rs == TRUE) {
                echo "<span style='color:green; margin-top:3px; font-weight:bold'>Successfully Updated</span>";
            } else {
                echo "<span style='color:red'>Update Failled</span>";
            }
        }

    /**
     * I belong to a file
     */


        public function viewInfoModal() {
            echo $id = $_POST['id'];
            exit;
            $data['site_info'] = $this->utilities->findByAttribute("site_info", array("S_INFO_ID" => $id));
            echo $this->load->view("setup/site/info_details", $data, TRUE);
        }

    }
