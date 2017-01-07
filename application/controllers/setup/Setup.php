<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->session->userdata('user_logged_in')) {
            redirect('auth/index', 'refresh');
        }
        $this->load->model('Setup_model');
    }

    function academic_background_data() {
        $data["breadcrumbs"] = array(
            "Academic Background Data" => "setup/setup/academic_background_data"
        );
        $data['pageTitle'] = "Academic Background Data";
        //$data['win_acc'] = $this->utilities->findAllFromView('pr_win_acca_staff_stu');
        $this->load->model('Utilities');
        $data['win_acc'] = $this->Setup_model->get_subproject_type();

        $data['content_view_page'] = 'setup/acca_staff_stu/win_acca_staff_stu';
        $this->template->display($data);
    }

    function entry_win_acca_staff_stu() {

        $this->form_validation->set_rules('PR_WINDOW_NO', 'Window No', 'Required');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'PR_WINDOW_NO' => $_POST['PR_WINDOW_NO'],
                'ITEM_NAME' => $_POST['ITEM_NAME'],
                'ACADEMIC_LEVEL' => $_POST['graduation'],
                'PARENT_ITEM_NO' => $_POST['PARENT_ITEM_NO'],
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0);
            $this->db->insert('pr_win_acca_staff_stu', $data);
            $this->session->set_flashdata('Success', 'Academic Background Saved Successfully.');
            redirect('setup/setup/academic_background_data');
        }

        $data["breadcrumbs"] = array(
            "Academic Background Data" => "setup/setup/academic_background_data",
            "Add Academic Background Data" => '#'
        );
        $data['pageTitle'] = "Add Academic Background Data";
        $data["parentItem"] = $this->utilities->dropdownFromTable("pr_win_acca_staff_stu", "---Select---", "ITEM_NO", array("ITEM_NAME"), $condition = array("ACTIVE" => '1'), "ITEM_NAME");
        //echo '<pre>';print_r($data["parentItem"] );exit;
        $data["windows"] = $this->utilities->dropdownFromTable("pr_window", "---Select---", "PR_WINDOW_NO", array("WINDOW_NAME"), $condition = array("ACTIVE" => '1'), "WINDOW_NAME");

        $data['content_view_page'] = 'setup/acca_staff_stu/entry_win_acca_staff_stu';
        $this->template->display($data);
    }

    function edit_win_acca_staff_stu($ITEM_NO) {
        if (!empty($_POST['PR_WINDOW_NO'])) {
            $data = array(
                'PR_WINDOW_NO' => $_POST['PR_WINDOW_NO'],
                'ACADEMIC_LEVEL' => $_POST['graduation'],
                'ITEM_NAME' => $_POST['ITEM_NAME'],
                'PARENT_ITEM_NO' => $_POST['PARENT_ITEM_NO'],
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0
            );
            $this->db->update('pr_win_acca_staff_stu', $data, array('ITEM_NO' => $ITEM_NO));
            $this->session->set_flashdata('Success', 'Academic Background Update Successfully.');
            redirect('setup/setup/academic_background_data', 'refresh');
        }
        $data["breadcrumbs"] = array(
            "Academic Background Data" => "setup/setup/academic_background_data",
            "Edit Academic Background Data" => '#'
        );
        $data['pageTitle'] = "Edit Academic Background Data";
        $data["parentItem"] = $this->utilities->dropdownFromTable("pr_win_acca_staff_stu", "---Select---", "ITEM_NO", array("ITEM_NAME"), $condition = array("ACTIVE" => '1'), "ITEM_NAME");
        $data["windows"] = $this->utilities->dropdownFromTable("pr_window", "---Select---", "PR_WINDOW_NO", array("WINDOW_NAME"), $condition = array("ACTIVE" => '1'), "WINDOW_NAME");
        $data['win_acca_staff'] = $this->Setup_model->get_win_acca_staff_stu($ITEM_NO);
        $data['content_view_page'] = 'setup/acca_staff_stu/edit_win_acca_staff_stu';
        $this->template->display($data);
    }

    function institute_info() {
        $data["breadcrumbs"] = array(
            "Setup" => "project/index",
            "Institute Informatin" => '#'
        );
        $data['pageTitle'] = "Institute Informatin";
        $data['institute_type'] = $this->utilities->dropdownFromTableWithCondition('lv_institute_types', '', 'CHAR_LOOKUP', 'LOOKUP_DATA_NAME', array('ACTIVE_FLAG' => 1));
        $data["institute_info"] = $this->utilities->findAllFromView("pr_institute");
        $data['content_view_page'] = 'setup/institute/institute_info';
        $this->template->display($data);
    }

    public function institute_info_data_insert() {
        //echo '<pre>'; print_r($_POST);exit;
        $instituteInfoData = array(
            'SHORT_NAME' => $this->input->post('textShortName'),
            'INSTITUTE_NAME' => $this->input->post('textInstituteName'),
            'INSTITUTE_TYPE' => $this->input->post('cmbInstituteType'),
            'LOCATION_ADDR' => $this->input->post('textAddress'),
            'WEBSITE' => $this->input->post('textWebsite'),
            'EMAIL' => $this->input->post('textEmail')
        );
        $this->utilities->insertData($instituteInfoData, 'pr_institute');
        $this->session->set_flashdata('Success', 'New Institute Information Added Successfully.');
        redirect('setup/setup/institute_info');
    }

    public function institute_info_update() {
        $institute_no = $this->input->post('id');
        $data['institute_type'] = $this->utilities->dropdownFromTableWithCondition('lv_institute_types', '', 'CHAR_LOOKUP', 'LOOKUP_DATA_NAME', array('ACTIVE_FLAG' => 1));
        $data["row"] = $this->utilities->findByAttribute("pr_institute", array("INSTITUTE_NO" => $institute_no));
        $this->load->view('setup/institute/update_institute_info', $data);
    }

    public function editData_institute_info() {
        $institute_no = $_POST['textsubid'];
        $instituteInfoData = array(
            'SHORT_NAME' => $this->input->post('textShortName'),
            'INSTITUTE_NAME' => $this->input->post('textInstituteName'),
            'INSTITUTE_TYPE' => $this->input->post('cmbInstituteType'),
            'LOCATION_ADDR' => $this->input->post('textAddress'),
            'WEBSITE' => $this->input->post('textWebsite'),
            'EMAIL' => $this->input->post('textEmail')
        );
        $this->utilities->updateData('pr_institute', $instituteInfoData, array("INSTITUTE_NO" => $institute_no));
    }

    public function window_wise_package() {
        $data["breadcrumbs"] = array(
            "Setup" => "setup/setup/window_wise_package",
            "Window Wise Package" => '#'
        );
        $data['pageTitle'] = "Window Wise Package";
        $data['procurement_types'] = $this->utilities->dropdownFromTableWithCondition('lv_procurement_types', '', 'CHAR_LOOKUP', 'LOOKUP_DATA_NAME', array('ACTIVE_FLAG' => 1));
        $data["window_package"] = $this->utilities->findAllByAttributeWithJoin("fn_win_pro_package", "pr_window", "PR_WINDOW_NO", "PR_WINDOW_NO", "WINDOW_NAME", array("fn_win_pro_package.ACTIVE" => "1"));
        $data["windows"] = $this->utilities->dropdownFromTable("pr_window", "---Select---", "PR_WINDOW_NO", array("WINDOW_NAME"), $condition = array("ACTIVE" => '1'), "WINDOW_NAME");
        $data['content_view_page'] = 'setup/window/window_wise_package';
        $this->template->display($data);
    }

    public function window_wise_package_dataInsert() {
        $data['procurement_types'] = $this->utilities->dropdownFromTableWithCondition('lv_procurement_types', '', 'CHAR_LOOKUP', 'LOOKUP_DATA_NAME', array('ACTIVE_FLAG' => 1));
        $data["window_package"] = $this->utilities->findAllByAttributeWithJoin("fn_win_pro_package", "pr_window", "PR_WINDOW_NO", "PR_WINDOW_NO", "WINDOW_NAME", array("fn_win_pro_package.ACTIVE" => "1"));
        $data["windows"] = $this->utilities->dropdownFromTable("pr_window", "---Select---", "PR_WINDOW_NO", array("WINDOW_NAME"), $condition = array("ACTIVE" => '1'), "WINDOW_NAME");
        if (isset($_POST['submit'])):
            $package_name = $this->input->post('testUdPackageNo');
            $proc_type = $this->input->post('cmbprocurement_types');
            $win_name = $this->input->post('cmbWindowName');

            $sql = $this->db->query("SELECT `UD_PACKAGE_NO` FROM `fn_win_pro_package` WHERE  `UD_PACKAGE_NO` ='$package_name' and PR_WINDOW_NO='$win_name' and PROC_TYPE='$proc_type'")->row();
            if (!empty($sql)) {
                $this->session->set_flashdata('Error', 'Data already exist.');
                $data['content_view_page'] = 'setup/window/window_package_form';
                $this->template->display($data);
            } else {
                $windowPackageData = array(
                    "UD_PACKAGE_NO" => $this->input->post('testUdPackageNo'),
                    "PACKAGE_NAME" => $this->input->post('textPackageName'),
                    "PROC_TYPE" => $this->input->post('cmbprocurement_types'),
                    "PR_WINDOW_NO" => $this->input->post('cmbWindowName')
                );
                $query = $this->utilities->insertData($windowPackageData, 'fn_win_pro_package');
                if ($query) {
                    $this->session->set_flashdata('Success', 'Data Insert Successfully.');
                } else {
                    $this->session->set_flashdata('Error', 'Data Insert Successfully.');
                }
                redirect('setup/setup/window_wise_package', 'refresh');
            } else:
            $data["breadcrumbs"] = array(
                "Setup" => "setup/setup/window_wise_package",
                "Window Wise Package" => '#'
            );
            $data['pageTitle'] = "Window Wise Package Insert";
            $data['content_view_page'] = 'setup/window/window_package_form';
            $this->template->display($data);
        endif;
    }

    public function window_package_form() {
        $package_id = $_POST['id'];
        $data['procurement_types'] = $this->utilities->dropdownFromTableWithCondition('lv_procurement_types', '', 'CHAR_LOOKUP', 'LOOKUP_DATA_NAME', array('ACTIVE_FLAG' => 1));
        $data['windows'] = $this->utilities->dropdownFromTableWithCondition('pr_window', '', 'PR_WINDOW_NO', 'WINDOW_NAME', array('ACTIVE' => 1));
        $data['row'] = $this->utilities->findByAttribute('fn_win_pro_package', array('PROC_PACKAGE_NO' => $package_id));
        $this->load->view('setup/window/window_package_update', $data);
    }

    public function editData_window_package() {
        $package_id = $_POST['textWindowPackage'];
        $windowPackageData = array(
            "UD_PACKAGE_NO" => $this->input->post('textUdPackageNo'),
            "PROC_TYPE" => $this->input->post('cmbProcTypes'),
            "PR_WINDOW_NO" => $this->input->post('cmbProWindowName')
        );
        $this->utilities->updateData('fn_win_pro_package', $windowPackageData, array('PROC_PACKAGE_NO' => $package_id));
    }

    function check_ud_packageNO() {
        $win_val = $this->input->post('win_name');
        $pro_type = $this->input->post('pro_type');
        $id = $this->input->post("ud_package_id");
        $package_no = $this->input->post("package_no");
        $sql = $this->db->query("SELECT `UD_PACKAGE_NO` FROM `fn_win_pro_package` WHERE PROC_PACKAGE_NO != $package_no AND PR_WINDOW_NO = '$win_val' and PROC_TYPE = '$pro_type' and UD_PACKAGE_NO ='$id'")->row();
        if (!empty($sql)) {
            echo 'exist';
        } else {
            echo 'not exist';
        }
    }

    public function package_attributes() {
        $package_id = $_POST['id'];
        $data['packageNo'] = $this->utilities->findByAttribute('fn_win_pro_package', array('PROC_PACKAGE_NO' => $package_id));
        $data['row'] = $this->utilities->findByAttribute('fn_win_pro_package', array('PROC_PACKAGE_NO' => $package_id));
        $this->load->view('setup/window/package_attributes', $data);
    }

    public function insert_pack_attributes() {
        $textPackAttri = $_POST['textPackAttributes'];
        $attributes_name = $this->input->post('textPackAttri');
        $package_no = $this->input->post('proPackageNo');
        for ($i = 0; $i < count($attributes_name); $i++) {
            $packAttributes = array(
                'ELEMENT_NAME' => $attributes_name[$i],
                'PROC_PACKAGE_NO' => $package_no[$i]
            );
            //echo '<pre>';print_r($packAttributes);exit;
            $this->db->insert('fn_package_element', $packAttributes, array('PROC_PACKAGE_NO' => $textPackAttri));
        }
    }

    public function view_pack_attributes() {
        $package_id = $_POST['id'];
        $data['packageNo'] = $this->utilities->findByAttribute('fn_win_pro_package', array('PROC_PACKAGE_NO' => $package_id));
        $data['attributes'] = $this->utilities->findAllByAttribute('fn_package_element', array('PROC_PACKAGE_NO' => $package_id));
        $this->load->view('setup/window/view_pack_attributes', $data);
    }

    public function update_attributes() {
        $id = $_POST['id'];
        $data['pac_attributes'] = $this->utilities->findByAttribute('fn_package_element', array('PAC_ELEMENT_NO' => $id));

        $this->load->view('setup/window/update_attributes', $data);
    }

    public function update_attributes_data() {
        $id = $_POST['textElementNo'];
        $update = array(
            "ELEMENT_NAME" => $this->input->post('textAttributes'),
        );
        $up_query = $this->utilities->updateData('fn_package_element', $update, array('PAC_ELEMENT_NO' => $id));
        redirect('setup/setup/window_wise_package');
    }

    public function ajex_expenditure_src() {
        $exp_type = $_POST['val'];
        $expenditure_src = $this->utilities->dropdownFromTableWithCondition('fn_expenditure_item', '', 'PARENT_ITEM_NO', 'ITEM_NAME', array('ACTIVE' => 1, 'EXP_TYPE' => $exp_type));
        echo form_dropdown('PARENT_ITEM_NO', $expenditure_src);
    }

    function lookup_index() {
        $data["breadcrumbs"] = array(
            "Master Setup" => '#'
        );
        $data['pageTitle'] = "Group settings";
        $data["lkp_group"] = $this->utilities->findAllFromView("sa_lookup_grp");
        $data['content_view_page'] = 'setup/lookup_index';
        $this->template->display($data);
    }
    
    function delete_lookup_data(){
        $lookup_id = $this->input->post('lookup_id');
        $this->utilities->deleteRowByAttribute('sa_lookup_data', array('LOOKUP_DATA_ID' => $lookup_id));
    }

    function add_group() {
        $this->load->view('setup/add_group');
    }

    function save_group() {

        $group_data = array(
            'LOOKUP_GRP_NAME' => $this->input->post('LOOKUP_GRP_NAME'),
            'USE_CHAR_NUMB' => $this->input->post('USE_CHAR_NUMB')
        );
        $this->utilities->insertData($group_data, 'sa_lookup_grp');
        redirect('setup/setup/lookup_index');
    }

    function add_group_item($lkp_grp_id, $USE_CHAR_NUMB) {
        $data['lkp_grp_id'] = $lkp_grp_id;
        $data['USE_CHAR_NUMB'] = $USE_CHAR_NUMB;
        $this->load->view('setup/add_group_item', $data);
    }

    function save_group_item() {

        $LOOKUP_GRP_ID = $_POST['LOOKUP_GRP_ID'];
        $USE_CHAR_NUMB = $_POST['USE_CHAR_NUMB'];
        if ($USE_CHAR_NUMB == 'N') {
            $NUMB_LOOKUP = $_POST['NUMB_LOOKUP'];
            $CHAR_LOOKUP = '';
        } else {
            $NUMB_LOOKUP = '';
            $CHAR_LOOKUP = $_POST['CHAR_LOOKUP'];
        }
        $item_data = array(
            'LOOKUP_DATA_NAME' => $_POST['LOOKUP_DATA_NAME'],
            'CHAR_LOOKUP' => $CHAR_LOOKUP,
            'NUMB_LOOKUP' => $NUMB_LOOKUP,
            'LOOKUP_GRP_ID' => $LOOKUP_GRP_ID,
            'ACTIVE_FLAG' => $_POST['ACTIVE_FLAG']
        );

        $this->utilities->insertData($item_data, 'sa_lookup_data');
        $data['lookup_item_data'] = $this->db->query("select * from sa_lookup_data where LOOKUP_GRP_ID=$LOOKUP_GRP_ID")->result();
        $data['USE_CHAR_NUMB'] = $this->db->query("select USE_CHAR_NUMB  from sa_lookup_grp where LOOKUP_GRP_ID=$LOOKUP_GRP_ID")->row();
        $this->load->view('setup/ajax_lookup_data', $data);
    }

    function edit_group_item($lkp_id) {

        $data['item'] = $this->db->query("select *, grp.USE_CHAR_NUMB as USE_CHAR_NUMB  from sa_lookup_data 
                                                                        left join sa_lookup_grp as grp on grp.LOOKUP_GRP_ID = sa_lookup_data.LOOKUP_GRP_ID
                                                                        where LOOKUP_DATA_ID=$lkp_id")->row();

        // print_r($data);exit;
        $this->load->view('setup/edit_group_item', $data);
    }

    function update_group_item() {
        $LOOKUP_DATA_ID = $_POST['LOOKUP_DATA_ID'];
        $LOOKUP_GRP_ID = $_POST['LOOKUP_GRP_ID'];
        $USE_CHAR_NUMB = $_POST['USE_CHAR_NUMB'];

        if ($USE_CHAR_NUMB == 'N') {
            $NUMB_LOOKUP = $_POST['NUMB_LOOKUP'];
            $CHAR_LOOKUP = '';
        } else {
            $NUMB_LOOKUP = '';
            $CHAR_LOOKUP = $_POST['CHAR_LOOKUP'];
        }
        $ACTIVE_FLAG = $_POST['ACTIVE_FLAG'];
        $update_item_data = array(
            'LOOKUP_DATA_NAME' => $_POST['LOOKUP_DATA_NAME'],
            'NUMB_LOOKUP' => $NUMB_LOOKUP,
            'CHAR_LOOKUP' => $CHAR_LOOKUP,
            'ACTIVE_FLAG' => $ACTIVE_FLAG
        );
//       print_r($update_item_data);
//        exit;
        $this->utilities->updateData('sa_lookup_data', $update_item_data, array('LOOKUP_DATA_ID' => $LOOKUP_DATA_ID));
        $data['lookup_item_data'] = $this->db->query("select * from sa_lookup_data where LOOKUP_GRP_ID=$LOOKUP_GRP_ID")->result();
        $data['USE_CHAR_NUMB'] = $this->db->query("select USE_CHAR_NUMB  from sa_lookup_grp where LOOKUP_GRP_ID=$LOOKUP_GRP_ID")->row();
        $this->load->view('setup/ajax_lookup_data', $data);
    }

    public function fund_open1() {
        $data["breadcrumbs"] = array(
            "Monitor" => "project/index",
            "Open Fund" => '#'
        );
        $data['pageTitle'] = "Academic Innovation Fund";
        $data['content_view_page'] = 'aif/aif_open1';
        $this->template->display($data);
    }

    public function sub_project_checklist() {
        $data["breadcrumbs"] = array(
            "Setup" => "Setup/Setup/index",
            "Open Fund" => '#'
        );
        $data['pageTitle'] = "Sub Project Checklist";
        $data['checklist'] = $this->Setup_model->get_checklist();
        $data['content_view_page'] = 'setup/checklist/index';
        $this->template->display($data);
    }

    public function entry_sub_project_checklist() {
        $this->form_validation->set_rules('item_name', 'Item Name', 'required');
        if ($this->form_validation->RUN() == TRUE) {
            $data = array(
                'ITEM_NAME' => $_POST ['item_name'],
                'PARANT_NO' => $_POST ['PARANT_NO'],
            );
            $this->db->insert('pr_checklist', $data);
            $this->session->set_flashdata('Success', 'Sub Project Check List Save  Successfully');
            redirect('setup/setup/sub_project_checklist');
        }
        $data["breadcrumbs"] = array(
            "Setup" => "Setup/Setup/Entry Sub Project Checklist",
            "Open Fund" => '#'
        );
        $data['pageTitle'] = "Entry Sub Project Checklist";
        $this->load->model('Utilities');
        $data['checklist_list'] = $this->utilities->dropdownFromTableWithCondition("pr_checklist", "---Select---", "ITEM_NO", "ITEM_NAME", array("PARANT_NO =" => 0));
        $data['content_view_page'] = 'setup/checklist/entry_sub_project_checklist';
        $this->template->display($data);
    }

    public function update_sub_project_checklist($ITEM_NO) {

        if (!empty($_POST['item_name'])) {
            $data = array(
                'ITEM_NAME' => $_POST ['item_name'],
                'PARANT_NO' => $_POST ['PARANT_NO'],
            );
            $this->db->update('pr_checklist', $data, array('ITEM_NO' => $ITEM_NO));
            $this->session->set_flashdata('Success', 'Sub Project Check List Update  Successfully');
            redirect('setup/setup/sub_project_checklist');
        }
        $data["breadcrumbs"] = array(
            "Monitor" => "Setup/Setup/Update Sub Project Checklist",
            "Open Fund" => '#'
        );
        $data['pageTitle'] = "Update Sub Project Checklist";
        $data ['checklist_set'] = $this->db->query("SELECT * from pr_checklist WHERE ITEM_NO ='$ITEM_NO'")->row();
        $data['checklist_list'] = $this->utilities->dropdownFromTableWithCondition("pr_checklist", "---Select---", "ITEM_NO", "ITEM_NAME", array("PARANT_NO =" => 0));
        $data['content_view_page'] = 'setup/checklist/update_sub_project_checklist';
        $this->template->display($data);
    }

    public function create_new_user() {
        if ($_POST) {
            /* echo '<pre>';
              print_r($_POST);
              exit; */
            $userName = $this->input->post('textUserName');
            $password = $this->input->post('textPassword');
            $fullName = $this->input->post('textFirstName') . ' ' . $this->input->post('textMiddleName') . ' ' . $this->input->post('textLastName');
            $email = $this->input->post('textEmailName');
            $userdata = array(
                'USERGRP_ID' => $this->input->post('cmbGroupName'),
                'USERLVL_ID' => $this->input->post('selectLevelName'),
                'INSTITUTE_NO' => ($this->input->post('cmbGroupName') == 3) ? $this->input->post('cmbInstituteName') : '',
                'SUB_PROJ_ID' => ($this->input->post('cmbGroupName') == 3) ? $this->input->post('selectSubProject') : '',
                'FIRST_NAME' => $this->input->post('textFirstName'),
                'MIDDLE_NAME' => $this->input->post('textMiddleName'),
                'LAST_NAME' => $this->input->post('textLastName'),
                'FULL_NAME' => $fullName,
                'GENDER' => $this->input->post('GENDER'),
                'EMAIL' => $email,
                'USERNAME' => $userName,
                'USERPW' => ($password != '') ? md5($password) : '',
                'STATUS' => (isset($_POST['STATUS'])) ? 1 : 0,
                'ENTERED_BY' => $this->user_session["USER_ID"]
            );
            if ($_FILES['userfile']['error'] == 0) {
                $configImage = array(
                    'upload_path' => "./resources/images",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "2048000",
                    'max_height' => "768",
                    'max_width' => "1024"
                );
                $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                $configImage['file_name'] = date('Y_m_d_') . substr(md5(rand()), 0, 7) . '.' . $ext;
                $this->load->library('upload', $configImage);
                if ($this->upload->do_upload()) {
                    $image_name = $this->upload->file_name;
                    $userdata['PROFILE_PIC_NAME'] = $image_name;
                }
            }
            $this->utilities->insertData($userdata, 'sa_users');

            if ($email != '') {
                $msgBody = "<html><head></html><body>Dear $fullName,<br> 
                                Congratulations!<br/>
                                You have successfully registered for access to HEQEP.  Please Keep this mail for further reference. Your username and password information is below.<br />
                                <span style='color: #3366ff; font-weight: bold;'>User Name</span><span style='color: #ff3333; font-weight: bold;'> $userName</span><br>
                                <span style='color: #3366ff; font-weight: bold;'>Password: </span><span style='color: #ff3333; font-weight: bold;'>$password</span><br><br><br><br>
                    Thanks and regards,<br>
                    HEQEP</body></html>";

                require 'gmail_app/class.phpmailer.php';
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = "cloud2.eicra.com";
                $mail->Port = "465";
                $mail->SMTPAuth = true;
                $mail->Username = "pmis@atilimited.net";
                $mail->Password = "@ti789#";
                $mail->SMTPSecure = 'ssl';
                $mail->From = "pmis@atilimited.net";
                $mail->FromName = "HEQEP";
                $mail->AddAddress($email);
                //$mail->AddReplyTo($emp_info->EMPLOYEE);
                $mail->IsHTML(TRUE);
                $mail->Subject = "HEQEP New User Confirmation";
                $mail->Body = $msgBody;
                $mail->Send();
            }
            $this->session->set_flashdata('Success', 'Create User Successfully');
            redirect('setup/setup/user_list');
        }
        $data["breadcrumbs"] = array(
            "User List" => "Setup/Setup/user_list",
            "Create New User" => '#'
        );

        $data['pageTitle'] = "Create New User";
        $data['user_group'] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select Group", "USERGRP_ID", "USERGRP_NAME", array("ACTIVE_STATUS =" => 1));
        $data['institute'] = $this->utilities->dropdownFromTableWithCondition("pr_institute", "---Select---", "INSTITUTE_NO", "INSTITUTE_NAME", array("ACTIVE =" => 1));
        $data['genders'] = $this->utilities->dropdownFromTableWithCondition("lv_genders", "", "CHAR_LOOKUP", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));

        $data['content_view_page'] = 'setup/user/create';
        $this->template->display($data);
    }

    public function getUserLevel() {
        $group_id = $this->input->post("group_id");
        $user_levels = $this->utilities->dropdownFromTableWithCondition("sa_ug_level", "Select Level", "UG_LEVEL_ID", "UGLEVE_NAME", array("ACTIVE_STATUS =" => 1, "USERGRP_ID" => $group_id));
        echo form_dropdown('selectLevelName', $user_levels);
    }

    public function getSubProject() {
        $sub_id = $this->input->post("sub_id");
        $subProjectNames = $this->utilities->findAllByAttribute("pr_subproject", array("INSTITUTE_NO" => $sub_id, "ACTIVE" => '1'));
        echo "<option>Select Sub Project</option>";
        foreach ($subProjectNames as $row) {
            echo "<option value='" . $row->SUB_PROJECT_NO . "'>" . $row->CP_NO . ' - ' . $row->SUB_PROJECT_TITLE . "</option>";
        }
    }

    public function check_userName() {
        $attribute = array('USERNAME' => $_POST['username']);
        if (isset($_POST['USER_ID'])) {
            $attribute['USER_ID !='] = $_POST['USER_ID'];
        }
        if ($this->utilities->hasInformationByThisId("sa_users", $attribute)) {
            echo 'exist';
        } else {
            echo 'Not exists';
        }
    }

    public function user_list() {
        $data["sessionData"] = $this->session->userdata("user_logged_in");
        $data["breadcrumbs"] = array(
            "User List" => "setup/setup/user_list",
            "View User List" => '#'
        );
        $data['pageTitle'] = "User List";
        //$data['users'] = $this->utilities->findAllFromView('sa_users_v');
        $data['users'] = $this->db->query("SELECT u.*,(SELECT sp.CP_NO FROM pr_subproject sp WHERE sp.SUB_PROJECT_NO = u.SUB_PROJ_ID)CP_NO  FROM sa_users_v u")->result();
        $data['institute'] = $this->utilities->dropdownFromTableWithCondition("pr_institute", "---Select---", "INSTITUTE_NO", "INSTITUTE_NAME", array("ACTIVE =" => 1));

        $data["user_group"] = $this->utilities->findAllByAttributeWithJoin("sa_users", "sa_user_group", "USERGRP_ID", "USERGRP_ID", "USERGRP_NAME", array("sa_users.STATUS" => "1"));
        $data['content_view_page'] = 'setup/user/user_list';
        $this->template->display($data);
    }

    function change_user_status() {
        $ID = $this->uri->segment(4, 0);
        $changeStatus = $this->utilities->change_status_by_attribute('sa_users', array('USER_ID' => $ID), 'STATUS');
        if ($changeStatus === 'Invalid') {
            $this->session->set_flashdata('Error', "Sorry ! You Are Trying Invalid Way To Change Status .");
        } else {
            $this->session->set_flashdata('Success', "This User $changeStatus Successfully.");
        }
        redirect('setup/setup/user_list', 'refresh');
    }

    public function user_list_update() {
        $user_id = $this->uri->segment(4);
        $userInfo = $this->utilities->findByAttribute("sa_users", array('USER_ID' => $user_id));
        if ($_POST) {
            $userData = array(
                'USERGRP_ID' => $this->input->post('cmbGroupName'),
                'USERLVL_ID' => $this->input->post('selectLevelName'),
                'INSTITUTE_NO' => ($this->input->post('cmbGroupName') == 3) ? $this->input->post('cmbInstituteName') : '',
                'SUB_PROJ_ID' => ($this->input->post('cmbGroupName') == 3) ? $this->input->post('selectSubProject') : '',
                'FIRST_NAME' => $this->input->post('textFirstName'),
                'MIDDLE_NAME' => $this->input->post('textMiddleName'),
                'LAST_NAME' => $this->input->post('textLastName'),
                'FULL_NAME' => $this->input->post('textFirstName') . ' ' . $this->input->post('textMiddleName') . ' ' . $this->input->post('textLastName'),
                'GENDER' => $this->input->post('GENDER'),
                'EMAIL' => $this->input->post('textEmailName'),
                'USERNAME' => $this->input->post('textUserName'),
                'STATUS' => (isset($_POST['STATUS'])) ? 1 : 0,
                'UPDATE_BY' => $this->user_session["USER_ID"]
            );
            if ($this->input->post('textPassword') != '') {
                $userData['USERPW'] = md5($this->input->post('textPassword'));
            }
            if ($_FILES['userfile']['error'] == 0) {
                if ($userInfo->PROFILE_PIC_NAME != '') {
                    $pre_image_name = "resources/images/$userInfo->PROFILE_PIC_NAME";
                    if (file_exists($pre_image_name)) {
                        unlink($pre_image_name);
                    }
                }
                $configImage = array(
                    'upload_path' => "./resources/images",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "2048000",
                    'max_height' => "768",
                    'max_width' => "1024"
                );
                $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                $configImage['file_name'] = date('Y_m_d_') . substr(md5(rand()), 0, 7) . '.' . $ext;
                $this->load->library('upload', $configImage);
                if ($this->upload->do_upload()) {
                    $image_name = $this->upload->file_name;
                    $userData['PROFILE_PIC_NAME'] = $image_name;
                }
            }
            $this->utilities->updateData('sa_users', $userData, array('USER_ID' => $user_id));
            $this->session->set_flashdata('Success', 'User Information Updated Successfully');
            redirect('setup/setup/user_list');
        }
        $data["breadcrumbs"] = array(
            "User List" => "setup/setup/user_list",
            "User Information Update" => '#'
        );
        $data['pageTitle'] = "Update User Information";
        $data['institute'] = $this->utilities->dropdownFromTableWithCondition("pr_institute", "---Select---", "INSTITUTE_NO", "INSTITUTE_NAME", array("ACTIVE =" => 1));
        $subProjectArray = array();
        if ($userInfo->INSTITUTE_NO != '') {
            $subProjectArray = $this->utilities->dropdownArrayBySql("SELECT SUB_PROJECT_NO, CONCAT(CP_NO,' - ',SUB_PROJECT_TITLE)SUB_PROJECT_TITLE FROM pr_subproject WHERE ACTIVE = 1 AND INSTITUTE_NO = $userInfo->INSTITUTE_NO");
        }
        $data['subProjectArray'] = $subProjectArray;
        $data['user_group'] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select Group", "USERGRP_ID", "USERGRP_NAME", array("ACTIVE_STATUS =" => 1));
        $data['user_level'] = $this->utilities->dropdownFromTableWithCondition("sa_ug_level", "Select Level", "UG_LEVEL_ID", "UGLEVE_NAME", array("ACTIVE_STATUS =" => 1));
        $data['genders'] = $this->utilities->dropdownFromTableWithCondition("lv_genders", "", "CHAR_LOOKUP", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));
        $data['user'] = $userInfo;
        $data['content_view_page'] = 'setup/user/update_user_information';
        $this->template->display($data);
    }

    public function view_user_info() {
        $user_id = $_POST['user_id'];
        $data['row'] = $this->utilities->findByAttribute('sa_users_v', array('USER_ID' => $user_id));
        $this->load->view('setup/user/user_information', $data);
    }

    public function reports_parameter() {
        $data["breadcrumbs"] = array(
            "Reports Parameter" => "setup/setup/reports_parameter"
        );
        $data['pageTitle'] = "Reports Parameter";
        $data['content_view_page'] = 'setup/reports_parameter';
        $data["sub_projects"] = $this->utilities->findAllFromView("pr_reportmst");
        $this->template->display($data);
    }

    public function new_report_name() {
        if ($_POST) {
            /* echo '<pre>';
              print_r($_POST);
              exit; */
            $sessionInfo = $this->session->userdata('user_logged_in');
            $dataArray = array(
                'REPORT_MOD' => $this->input->post('REPORT_MOD'),
                'REPORT_CATEGORY' => $this->input->post('REPORT_CATEGORY'),
                'REPORT_SOURCE' => $this->input->post('REPORT_SOURCE'),
                'REPORT_NAME' => $this->input->post('REPORT_NAME'),
                'REPORT_DESC' => $this->input->post('REPORT_DESC'),
                'UD_SL_NO' => $this->input->post('UD_SL_NO'),
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0,
                'CRE_BY' => $sessionInfo['USER_ID']
            );
            $this->utilities->insertData($dataArray, 'pr_reportmst');
            $this->session->set_flashdata('Success', 'Congratulation ! New Report Name Added Successfully.');
            redirect('setup/setup/reports_parameter');
        }
        $data["breadcrumbs"] = array(
            "Reports Parameter" => "setup/setup/reports_parameter",
            "New Report Name" => '#'
        );
        $data['pageTitle'] = "New Report Name";
        $data['report_mod'] = $this->utilities->dropdownFromTableWithCondition("ati_modules", " Select ", "SHORT_NAME", "MODULE_NAME", array("ACTIVE_STATUS =" => 1));
        $data['report_category'] = $this->utilities->dropdownFromTableWithCondition("pr_module_reportcategory", " Select ", "SHORT_NAME", "CATEGORY_NAME", array("ACTIVE =" => 1));
        $data['content_view_page'] = 'setup/new_report_name';
        $this->template->display($data);
    }

    public function edit_report_name() {
        $REPORT_ID = $this->uri->segment(4, 0);
        if ($REPORT_ID < 1) {
            $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid way to Edit Report Name .');
            redirect('setup/setup/reports_parameter');
        }
        $report_info = $this->utilities->findByAttribute("pr_reportmst", array('REPORT_ID' => $REPORT_ID));
        if (empty($report_info)) {
            $this->session->set_flashdata('Error', 'Sorry ! You are Trying Invalid way to Edit Report Name .');
            redirect('setup/setup/reports_parameter');
        }
        if ($_POST) {
            /* echo '<pre>';
              print_r($_POST);
              exit; */
            $sessionInfo = $this->session->userdata('user_logged_in');
            $dataArray = array(
                'REPORT_MOD' => $this->input->post('REPORT_MOD'),
                'REPORT_CATEGORY' => $this->input->post('REPORT_CATEGORY'),
                'REPORT_SOURCE' => $this->input->post('REPORT_SOURCE'),
                'REPORT_NAME' => $this->input->post('REPORT_NAME'),
                'REPORT_DESC' => $this->input->post('REPORT_DESC'),
                'UD_SL_NO' => $this->input->post('UD_SL_NO'),
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0,
                'UPD_BY' => $sessionInfo['USER_ID']
            );
            $this->utilities->updateData('pr_reportmst', $dataArray, array('REPORT_ID' => $REPORT_ID));
            $this->session->set_flashdata('Success', 'Report Name Information Updated Successfully.');
            redirect('setup/setup/reports_parameter');
        }
        $data["breadcrumbs"] = array(
            "Reports Parameter" => "setup/setup/reports_parameter",
            "Edit Report Name" => '#'
        );
        $data['pageTitle'] = "Edit Report Name";
        $data['report_mod'] = $this->utilities->dropdownFromTableWithCondition("ati_modules", " Select ", "SHORT_NAME", "MODULE_NAME", array("ACTIVE_STATUS =" => 1));
        $data['report_category'] = $this->utilities->dropdownFromTableWithCondition("pr_module_reportcategory", " Select ", "SHORT_NAME", "CATEGORY_NAME", array("ACTIVE =" => 1));
        $data['content_view_page'] = 'setup/edit_report_name';
        $data["row"] = $report_info;
        $this->template->display($data);
    }

    public function parametersReportId() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $report_id = $_POST['report_id'];
        $data['report_id'] = $report_id;
        $data['reportchd_infos'] = $this->utilities->findAllByAttribute("pr_reportchd", array('REPORT_ID' => $report_id));
        $this->load->view('setup/ajax_parametrs_name', $data);
    }

    public function saveParameterName() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $returnVal = '';
        $sessionInfo = $this->session->userdata('user_logged_in');
        $SELECTED_REPORT_ID = $_POST['SELECTED_REPORT_ID'];
        $reportchd_infos = $this->utilities->findAllByAttribute("pr_reportchd", array('REPORT_ID' => $SELECTED_REPORT_ID));
        if (!empty($reportchd_infos)):
            $DB_REPORTCHD_IDS = array();
            foreach ($reportchd_infos as $reportchd_info):
                $DB_REPORTCHD_IDS[] = $reportchd_info->REPORTCHD_ID;
            endforeach;
            $REPORTCHD_IDS = (isset($_POST['REPORTCHD_IDS'])) ? $_POST['REPORTCHD_IDS'] : array();
            $deleteable_ids = array_diff($DB_REPORTCHD_IDS, $REPORTCHD_IDS);
            if (!empty($deleteable_ids)) {
                $this->db->where_in('REPORTCHD_ID', $deleteable_ids);
                $this->db->delete('pr_reportchd');
            }
            if (!empty($REPORTCHD_IDS)) {
                for ($i = 0; $i < count($REPORTCHD_IDS); $i++) {
                    $childUpdateArray = array(
                        'PARAMETER_LEVEL' => $_POST['PRE_PARAMETER_LEVEL'][$i],
                        'PARAMETER_NAME1' => $_POST['PRE_PARAMETER_NAME1'][$i],
                        //'PARAMETER_NAME2' => $_POST['PRE_PARAMETER_NAME2'][$i],
                        'DATA_TYPE' => $_POST['PRE_DATA_TYPE'][$i],
                        'PARAMETER_TYPE' => $_POST['PRE_PARAMETER_TYPE'][$i],
                        'LOV_SQL' => $_POST['PRE_LOV_SQL'][$i],
                        'MENDATORY_FLAG' => $_POST['PRE_MENDATORY_FLAG'][$i],
                        'STATIC_VALUE' => $_POST['PRE_STATIC_VALUE'][$i],
                        'PARAMETER_HINTS' => $_POST['PRE_PARAMETER_HINTS'][$i],
                        'UD_SL_NO' => $_POST['PRE_UD_SL_NO'][$i],
                        'ACTIVE' => $_POST['PRE_ACTIVE'][$i],
                        'UPD_BY' => $sessionInfo['USER_ID'],
                        'UPD_DT' => date('Y-m-d h:i:s A')
                    );
                    $this->utilities->updateData('pr_reportchd', $childUpdateArray, array('REPORTCHD_ID' => $REPORTCHD_IDS[$i]));
                }
                $returnVal = 'U';
            }
        endif;

        $PARAMETER_LEVEL = (isset($_POST['PARAMETER_LEVEL'])) ? $_POST['PARAMETER_LEVEL'] : array();
        if (!empty($PARAMETER_LEVEL)):
            for ($i = 0; $i < count($PARAMETER_LEVEL); $i++) {
                if ($this->utilities->hasInformationByThisId('pr_reportchd', array('REPORT_ID' => $SELECTED_REPORT_ID, 'PARAMETER_LEVEL' => $_POST['PARAMETER_LEVEL'][$i]))):
                    $subUpdateArray = array(
                        'PARAMETER_NAME1' => $_POST['PARAMETER_NAME1'][$i],
                        //'PARAMETER_NAME2' => $_POST['PARAMETER_NAME2'][$i],
                        'DATA_TYPE' => $_POST['DATA_TYPE'][$i],
                        'PARAMETER_TYPE' => $_POST['PARAMETER_TYPE'][$i],
                        'LOV_SQL' => $_POST['LOV_SQL'][$i],
                        'MENDATORY_FLAG' => $_POST['MENDATORY_FLAG'][$i],
                        'STATIC_VALUE' => $_POST['STATIC_VALUE'][$i],
                        'PARAMETER_HINTS' => $_POST['PARAMETER_HINTS'][$i],
                        'UD_SL_NO' => $_POST['UD_SL_NO'][$i],
                        'ACTIVE' => $_POST['ACTIVE'][$i],
                        'UPD_BY' => $sessionInfo['USER_ID'],
                        'UPD_DT' => date('Y-m-d h:i:s A')
                    );
                    $this->utilities->updateData('pr_reportchd', $subUpdateArray, array('REPORT_ID' => $SELECTED_REPORT_ID, 'PARAMETER_LEVEL' => $_POST['PARAMETER_LEVEL'][$i]));
                    $returnVal = 'U';
                else:
                    $subArray = array(
                        'REPORT_ID' => $SELECTED_REPORT_ID,
                        'PARAMETER_LEVEL' => $_POST['PARAMETER_LEVEL'][$i],
                        'PARAMETER_NAME1' => $_POST['PARAMETER_NAME1'][$i],
                        //'PARAMETER_NAME2' => $_POST['PARAMETER_NAME2'][$i],
                        'DATA_TYPE' => $_POST['DATA_TYPE'][$i],
                        'PARAMETER_TYPE' => $_POST['PARAMETER_TYPE'][$i],
                        'LOV_SQL' => $_POST['LOV_SQL'][$i],
                        'MENDATORY_FLAG' => $_POST['MENDATORY_FLAG'][$i],
                        'STATIC_VALUE' => $_POST['STATIC_VALUE'][$i],
                        'PARAMETER_HINTS' => $_POST['PARAMETER_HINTS'][$i],
                        'UD_SL_NO' => $_POST['UD_SL_NO'][$i],
                        'ACTIVE' => $_POST['ACTIVE'][$i],
                        'CRE_BY' => $sessionInfo['USER_ID']
                    );
                    $this->utilities->insertData($subArray, 'pr_reportchd');
                    $returnVal = 'I';
                endif;
            }
        endif;
        return $returnVal;
    }

    public function employee_info() {
        $data["breadcrumbs"] = array(
            "Employee Information" => "setup/setup/employee_info",
            "Employee Information" => '#'
        );
        $data['pageTitle'] = "Employee Information";
        $data['employeeInfo'] = $this->db->query("SELECT EMP_NO,CONCAT(FIRST_NAME,' ',MIDDLE_NAME,' ',LAST_NAME) EMP_NAME,EMP_TYPE,
                                                                                                    CASE WHEN EMP_TYPE='C' THEN 'Consultant' 
                                                                                                    WHEN EMP_TYPE='E' THEN 'Employee' 
                                                                                                    END EMP_TYPE,
                                                                                                    (SELECT LOOKUP_DATA_NAME FROM lv_employee_category WHERE LOOKUP_DATA_ID=JOB_CATEGORY) JOB_CATEGORY,
                                                                                                    (SELECT LOOKUP_DATA_NAME FROM lv_employee_designation WHERE LOOKUP_DATA_ID=DESIGNATION) DESIGNATION,
                                                                                                    (SELECT LOOKUP_DATA_NAME FROM lv_employee_department WHERE LOOKUP_DATA_ID=DEPARTMENT) DEPARTMENT,
                                                                                                    ADDRESS,MOBILE,EMAIL,ACTIVE
                                                                                                    FROM hr_employee ")->result();
        $data['lv_depart'] = $this->utilities->findAllFromView('lv_employee_department');
        $data['content_view_page'] = 'setup/employee_info';
        $this->template->display($data);
    }

    public function create_employee_info() {
        $cmbdepartment = $this->input->post('cmbdepartment');
        if ($_POST) {
            $dataInsert = array(
                'FIRST_NAME' => $this->input->post('textFirstName'),
                'MIDDLE_NAME' => $this->input->post('textMiddleName'),
                'LAST_NAME' => $this->input->post('textLastName'),
                'EMP_TYPE' => $this->input->post('EMP_TYPE'),
                'JOB_CATEGORY' => $this->input->post('jobCategory'),
                'DESIGNATION' => $this->input->post('cmbdesignation'),
                'DEPARTMENT' => $cmbdepartment,
                'FATHERS_NAME' => $this->input->post('fathersName'),
                'MOTHERS_NAME' => $this->input->post('motherName'),
                'DT_OF_BIRTH' => date("Y-m-d", strtotime($this->input->post('dateofBirth'))),
                'GENDER' => $this->input->post('gender'),
                'MARITAL_STATUS' => $this->input->post('Marital_Status'),
                'HIRE_DATE' => date("Y-m-d", strtotime($this->input->post('hireDate'))),
                'ADDRESS' => $this->input->post('address'),
                'PHONE' => $this->input->post('phone'),
                'MOBILE' => $this->input->post('mobile'),
                'EMAIL' => $this->input->post('email'),
                'NATIONAL_ID' => $this->input->post('nationalID'),
                'RELIGION' => $this->input->post('religion'),
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0
            );
            //echo '<pre>';print_r($dataInsert);exit;
            $this->db->insert('hr_employee', $dataInsert);
            $this->session->set_flashdata('Success', 'Employee Information Saved Successfully.');
            redirect('setup/setup/employee_info');
        }
        $data["breadcrumbs"] = array(
            "Creat Employee Information" => "setup/setup/create_employee_info",
            "Creat Employee Information" => '#'
        );
        $data['pageTitle'] = "Create Employee Information";
        //$data['designation'] = $this->utilities->dropdownFromTableWithCondition("lv_employee_designation", "---Select---", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));
        $data['job_catagory'] = $this->db->query("SELECT LOOKUP_DATA_ID,LOOKUP_DATA_NAME 
                                                                                        FROM lv_employee_category 
                                                                                        WHERE ACTIVE_FLAG=1
                                                                                        ORDER BY NUMB_LOOKUP")->result();
        $data['designation'] = $this->db->query("SELECT LOOKUP_DATA_ID,LOOKUP_DATA_NAME 
                                                                                        FROM lv_employee_designation 
                                                                                        WHERE ACTIVE_FLAG=1
                                                                                        ORDER BY NUMB_LOOKUP")->result();
        $data['department'] = $this->db->query("SELECT LOOKUP_DATA_ID AS DEPARTMENT,LOOKUP_DATA_NAME DEPARTMENT_NAME
                                                                                        FROM  lv_employee_department 
                                                                                        WHERE ACTIVE_FLAG=1
                                                                                        ORDER BY NUMB_LOOKUP")->result();
        // $data['department'] = $this->utilities->dropdownFromTableWithCondition("lv_employee_department ", "---Select---", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));
        $data['content_view_page'] = 'setup/create_employee_info';
        $this->template->display($data);
    }

    public function employee_info_update($EMP_NO) {
        $emp_id = $this->uri->segment(4);
        //echo '<pre>';print_r($emp_id);exit;
        if ($_POST) {
            $dataInsert = array(
                'FIRST_NAME' => $this->input->post('textFirstName'),
                'MIDDLE_NAME' => $this->input->post('textMiddleName'),
                'LAST_NAME' => $this->input->post('textLastName'),
                'EMP_TYPE' => $this->input->post('EMP_TYPE'),
                'JOB_CATEGORY' => $this->input->post('jobCategory'),
                'DESIGNATION' => $this->input->post('cmbdesignation'),
                'DEPARTMENT' => $this->input->post('cmbdepartment'),
                'FATHERS_NAME' => $this->input->post('fathersName'),
                'MOTHERS_NAME' => $this->input->post('motherName'),
                'DT_OF_BIRTH' => date("Y-m-d", strtotime($this->input->post('dateofBirth'))),
                'GENDER' => $this->input->post('gender'),
                'MARITAL_STATUS' => $this->input->post('Marital_Status'),
                'HIRE_DATE' => date("Y-m-d", strtotime($this->input->post('hireDate'))),
                'ADDRESS' => $this->input->post('address'),
                'PHONE' => $this->input->post('phone'),
                'MOBILE' => $this->input->post('mobile'),
                'EMAIL' => $this->input->post('email'),
                'NATIONAL_ID' => $this->input->post('nationalID'),
                'RELIGION' => $this->input->post('religion'),
                'ACTIVE' => (isset($_POST['ACTIVE'])) ? 1 : 0
            );
            //echo '<pre>';print_r($dataInsert);exit;
            $this->utilities->updateData('hr_employee', $dataInsert, array("EMP_NO" => $emp_id));
            $this->session->set_flashdata('Success', 'Update  Information Successfully.');
            redirect('setup/setup/employee_info');
        }
        $data["breadcrumbs"] = array(
            "Edit Employee Information" => "setup/setup/create_employee_info",
            "Edit Employee Information" => '#'
        );
        $data['pageTitle'] = "Edit Employee Information";
        $data['employeeInfo'] = $this->utilities->findByAttribute('hr_employee', array('EMP_NO' => $emp_id));
        $data['job_catagory'] = $this->utilities->dropdownFromTableWithCondition("lv_employee_category", "---Select---", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));
        $data['designationss'] = $this->utilities->dropdownFromTableWithCondition("lv_employee_designation", "---Select---", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));
        $data['designations'] = $this->db->query("SELECT LOOKUP_DATA_ID,LOOKUP_DATA_NAME 
                                                                                        FROM lv_employee_designation 
                                                                                        WHERE ACTIVE_FLAG=1
                                                                                        ORDER BY NUMB_LOOKUP")->result();
        $data['departments'] = $this->db->query("SELECT LOOKUP_DATA_ID AS DEPARTMENT,LOOKUP_DATA_NAME DEPARTMENT_NAME
                                                                                        FROM  lv_employee_department 
                                                                                        WHERE ACTIVE_FLAG=1
                                                                                        ORDER BY NUMB_LOOKUP")->result();
        $data['department'] = $this->utilities->dropdownFromTableWithCondition("lv_employee_department ", "---Select---", "LOOKUP_DATA_ID", "LOOKUP_DATA_NAME", array("ACTIVE_FLAG =" => 1));
        $data['content_view_page'] = 'setup/employee_info_update';
        $this->template->display($data);
    }

    public function employee_info_details() {
        $employee_id = $_POST['emp_id'];
        $data['lv_catagory'] = $this->utilities->findAllFromView('lv_employee_category');
        $data['row'] = $this->utilities->findByAttribute('hr_employee', array('EMP_NO' => $employee_id));
        $data['rowa'] = $this->utilities->findAllFromView('lv_employee_designation');
        $data['lv_depart'] = $this->utilities->findAllFromView('lv_employee_department');
        //echo '<pre>';print_r($data['rowa']);exit;
        $this->load->view('setup/employee_info_details', $data);
    }

}
