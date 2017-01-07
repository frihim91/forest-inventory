<?php

class Utilities extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_max_value($tableName, $fieldName) {
        return $this->db->select_max($fieldName)->get($tableName)->row()->{$fieldName};
    }

    function get_max_value_by_attribute($tableName, $fieldName, $attribute) {
        return $this->db->select_max($fieldName)->where($attribute)->get($tableName)->row()->{$fieldName};
    }

    function get_field_value_by_attribute($tableName, $fieldName, $attribute) {
        $result = $this->db->get_where($tableName, $attribute)->row();
        if (!empty($result)):
            return $result->{$fieldName};
        else:
            return false;
        endif;
    }

    function dropdownFromTable($tableName, $selectText, $key, $labels) {
        $query = $this->db->get($tableName);
        $lookupInfo = array();

        if ($query->num_rows() > 0) {
            $lookupInfo = array(
                '' => $selectText
            );
            foreach ($query->result() as $row) {
                $labelText = '';
                for ($i = 0; $i < sizeof($labels); $i++) {
                    $labelText = $labelText . ' ' . $row->{$labels[$i]};
                }
                $lookupInfo[$row->{$key}] = $labelText;
            }
        }
        return $lookupInfo;
    }

    function dropdownFromTableWithCondition($tableName, $selectText, $key, $value, $condition = '', $orderByField = '', $orderBy = 'ASC') {
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        if ($orderByField == '') {
            $this->db->order_by("$value", "$orderBy");
        } else {
            $this->db->order_by("$orderByField", "$orderBy");
        }
        $query = $this->db->get($tableName);

        if (empty($selectText)) {
            $selectText = '--- Select ---';
        }

        if ($selectText == 'none') {
            $lookupInfo = array();
        } else {
            $lookupInfo = array('' => $selectText);
        }
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if (!empty($row->{$value})) {
                    $lookupInfo[$row->{$key}] = $row->{$value};
                }
            }
        }
        return $lookupInfo;
    }

    function dropdownArrayBySql($sql) {
        $result = $this->db->query($sql)->result();
        $returnArray = array('' => 'Select');
        if (!empty($result)) {
            foreach ($result as $row) {
                $rowArray = array_values((Array) $row);
                if ((isset($rowArray[1])) && ($rowArray[1] != '')) {
                    $returnArray[$rowArray[0]] = $rowArray[1];
                }
            }
        }
        return $returnArray;
    }

    public function hasInformationByThisId($tableName, $attribute) {
        $query = $this->db->get_where($tableName, $attribute);
        $no_of_row = 0;
        if (!empty($query)) {
            $no_of_row = $query->num_rows();
        }
        return ($no_of_row > 0) ? TRUE : FALSE;
    }

    public function countRowByAttribute($tableName, $attribute) {
        return $this->db->get_where($tableName, $attribute)->num_rows();
    }

    function insertData($post, $tableName) {
        $this->db->trans_start();
        $this->db->insert($tableName, $post);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function insertDataWithReturn($tableName, $data) {
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    function updateData($tableName, $data, $condition) {
        $this->db->trans_start();
        $this->db->update($tableName, $data, $condition);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteRowByAttribute($tableName, $attribute) {
        $this->db->trans_start();
        $this->db->delete($tableName, $attribute);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function findByAttribute($tableName, $attribute) {
        return $this->db->get_where($tableName, $attribute)->row();
    }

    function rowCountByAttribute($tableName, $attribute) {
        return $this->db->get_where($tableName, $attribute)->num_rows();
    }

    function change_status_by_attribute($table_name, $attribute, $statusColumn = 'ACTIVE') {
        $rowInfo = $this->findByAttribute($table_name, $attribute);
        if (empty($rowInfo)) {
            $returnValue = 'Invalid';
        } else {
            if ($rowInfo->{$statusColumn} == 1) {
                $returnValue = 'Inactivated';
            } else {
                $returnValue = 'Activated';
            }
            $this->{$statusColumn} = ($rowInfo->{$statusColumn} == 1) ? 0 : 1;
            $this->db->update($table_name, $this, $attribute);
        }
        return $returnValue;
    }

    function change_new_table_status_by_attribute($table_name, $attribute) {
        $rowInfo = $this->findByAttribute($table_name, $attribute);
        if (empty($rowInfo)) {
            $returnValue = 'Invalid';
        } else {
            if ($rowInfo->STA_FG == 1) {
                $returnValue = 'Inactivated';
            } else {
                $returnValue = 'Activated';
            }
            $this->STA_FG = ($rowInfo->STA_FG == 1) ? 0 : 1;
            $this->db->update($table_name, $this, $attribute);
        }
        return $returnValue;
    }

    function lookupTypesByLookupNo($lookupNo, $selectedText = '--- Select ---') {
        $query = $this->db->get_where('CM_LOOKUP_DTL', array('LOOKUP_NO' => $lookupNo, 'ACTIVE_STAT' => 'Y'));
        $docType = array();
        if ($query->num_rows() > 0) {
            $docType = array(
                '' => $selectedText
            );
            foreach ($query->result() as $row) {
                $docType[$row->LOOKUPDTL_NO] = $row->DTL_NAME;
            }
        }
        return $docType;
    }

    function attributeArrayByGroupId($group_id, $selectedText = '--- Select ---') {
        $query = $this->db->get_where('A00_ATRB', array('GRP_ID' => $group_id, 'STA_FG' => 1));
        $returnArray = array();
        if ($query->num_rows() > 0) {
            $returnArray = array(
                '' => $selectedText
            );
            foreach ($query->result() as $row) {
                $returnArray[$row->ATRB_ID] = $row->ATRB_NAME;
            }
        }
        return $returnArray;
    }

    function findAllFromView($viewName) {
        return $this->db->get($viewName)->result();
    }

    function findAllByAttributeWithLike($tableName, $attribute, $like) {
        if (!empty($like)) {
            $this->db->like($like);
        }
        if (!empty($attribute)) {
            $this->db->where($attribute);
        }
        return $this->db->get($tableName)->result();
    }

    function findAllByAttribute($tableName, $attribute) {
        return $this->db->get_where($tableName, $attribute)->result();
    }

    public function countRow($tableName, $attribute = array()) {
        if (!empty($attribute)) {
            $this->db->where($attribute);
        }
        return $this->db->get($tableName)->num_rows();
    }

    function findByLimit($tableName, $limit = 20, $row = 0, $order_by_field_name = '', $order_by = 'ASC', $attribute = array()) {
        if (!empty($attribute)) {
            $this->db->where($attribute);
        }
        if ($order_by_field_name != '') {
            $this->db->order_by("$order_by_field_name", "$order_by");
        }
        $query = $this->db->get($tableName, $limit, $row);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function findAllByAttributeWithOrderBy($tableName, $attribute, $order_by_field_name, $order_by = 'ASC') {
        return $this->db->order_by("$order_by_field_name", "$order_by")->get_where($tableName, $attribute)->result();
    }

    function getIdByName($tableName, $name, $returnFieldName) {
        return $this->db->query("SELECT $returnFieldName  FROM $tableName WHERE (FIRST_NAME||' '||LAST_NAME)='$name'")->row()->{$returnFieldName};
    }

    function findByAttributeWithJoin($mainTableName, $joinTableName, $joinByFieldName, $joinWithFieldName, $joinFieldName, $attribute, $joinType = 'left') {
        $this->db->select("$mainTableName.*, $joinTableName.$joinFieldName");
        $this->db->from($mainTableName);
        $this->db->join($joinTableName, "$mainTableName.$joinByFieldName = $joinTableName.$joinWithFieldName", $joinType);
        $this->db->where($attribute);
        return $this->db->get()->row();
    }

    function findAllByAttributeWithJoin($mainTableName, $joinTableName, $joinByFieldName, $joinWithFieldName, $joinFieldName, $attribute = '', $joinType = 'left') {
        $this->db->select("$mainTableName.*, $joinTableName.$joinFieldName");
        $this->db->from($mainTableName);
        $this->db->join($joinTableName, "$mainTableName.$joinByFieldName = $joinTableName.$joinWithFieldName", $joinType);
        if (!empty($attribute)) {
            $this->db->where($attribute);
        }
        return $this->db->get()->result();
    }

    function findByAttributeWithJoinMF($mainTableName, $joinTableName, $joinByFieldName, $joinWithFieldName, $returnValue, $attribute = '', $joinType = 'left') {
        $this->db->select($returnValue);
        $this->db->from($mainTableName);
        $this->db->join($joinTableName, "$mainTableName.$joinByFieldName = $joinTableName.$joinWithFieldName", $joinType);
        if (!empty($attribute)) {
            $this->db->where($attribute);
        }
        return $this->db->get()->row();
    }

    function findAllByAttributeWithJoinMF($mainTableName, $joinTableName, $joinByFieldName, $joinWithFieldName, $returnValue, $attribute = '', $joinType = 'left') {
        $this->db->select($returnValue);
        $this->db->from($mainTableName);
        $this->db->join($joinTableName, "$mainTableName.$joinByFieldName = $joinTableName.$joinWithFieldName", $joinType);
        if (!empty($attribute)) {
            $this->db->where($attribute);
        }
        return $this->db->get()->result();
    }

    function is_it_checked_or_not($role_id, $form_id) {
        $role_permission_info = $this->db->get_where('SM_ROLE_FORMS', array('ROLE_ID' => $role_id, 'FORM_ID' => $form_id))->row();
        if (empty($role_permission_info)) {
            return FALSE;
        } else {
            if ($role_permission_info->ACTIVE_STAT == 'Y') {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function change_access_forms_by_ajax($role_id, $form_id, $status) {
        $role_form_info = $this->db->get_where('SM_ROLE_FORMS', array('ROLE_ID' => $role_id, 'FORM_ID' => $form_id))->row();
        $session_info = $this->session->userdata('logged_in');
        if (empty($role_form_info)) {
            $this->ROLE_FORMS_ID = $this->get_max_value('SM_ROLE_FORMS', 'ROLE_FORMS_ID') + 1;
            $this->ROLE_ID = $role_id;
            $this->FORM_ID = $form_id;
            $this->ACTIVE_STAT = $status;
            $this->CRE_BY = $session_info['USER_ID'];
            $this->db->insert('SM_ROLE_FORMS', $this);
        } else {
            $this->ACTIVE_STAT = $status;
            $this->UPD_BY = $session_info['USER_ID'];
            $this->UPD_DT = date('d-M-Y h:i:s A');
            $this->db->update('SM_ROLE_FORMS', $this, array('ROLE_FORMS_ID' => $role_form_info->ROLE_FORMS_ID));
        }
    }

    function SPEL_OUT_AMOUNT($amount) {
        return $this->db->query("SELECT SPEL_OUT ($amount) AS IN_WORD  FROM dual")->row()->IN_WORD;
    }

    function remove_case_doc_by_id($id) {
        if (is_numeric($id) && $id > 0) {
            $row = $this->findByAttribute('CM_CASE_DOC', array('CASE_DOC_ID' => $id));
            $file_name = $row->FILE_NAME;
            if (!empty($file_name)) {
                $path = APPPATH . '../resources/docStore/' . $file_name;
                if (file_exists($path)) {
                    unlink($path) or die('failed deleting: ' . $path);
                }
            }
            $this->db->where('CASE_DOC_ID', $id);
            $this->db->delete('CM_CASE_DOC');
            return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        } else {
            return FALSE;
        }
    }

    function getPreviousArrayByAttribute($tableName, $returnFieldName, $attribute) {
        $preRecords = $this->db->select($returnFieldName)->get_where($tableName, $attribute)->result();
        $singleArray = array();
        if (!empty($preRecords)) {
            foreach ($preRecords as $preRecord) {
                $singleArray[] = $preRecord->{$returnFieldName};
            }
        }
        return $singleArray;
    }

    function getRowArrayByAttribute($tableName, $attribute) {
        $preRecords = $this->db->select('*')->get_where($tableName, $attribute)->result();
        $singleArray = array();
        if (!empty($preRecords)) {
            foreach ($preRecords as $preRecord) {
                $singleArray[] = $preRecord;
            }
        }
        return $singleArray;
    }

    public function get_php_date_format($string) {
        list($date, $time, $ampm) = explode(' ', $string);
        list($hour, $minute, $second) = explode('.', $time);
        $second = substr($second, 0, 2);
        $time = $hour . '.' . $minute . '.' . $second . '' . $ampm;
        return date('F d, Y h:i:s a', strtotime($date . ' ' . $time));
    }

    function bn2enNumber($number) {
        $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $en_number = str_replace($search_array, $replace_array, $number);
        return $en_number;
    }

    function en2bnNumber($number) {
        $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en_number = str_replace($search_array, $replace_array, $number);
        return $en_number;
    }

    function formatDate($format, $dateStr) {
        if (trim($dateStr) == '' || substr($dateStr, 0, 10) == '0000-00-00') {
            return '';
        }
        $ts = strtotime($dateStr);
        if ($ts === false) {
            return '';
        }
        return date($format, $ts);
    }

    public function get_all_modules() {
        $this->db->select('ATI_MODULES.*, ATI_MODULE_LINKS.URL_URI, ATI_MODULE_LINKS.LINK_NAME, ATI_MODULE_LINKS.ACTIVE_STATUS as STATUS, ATI_MODULE_LINKS.LINK_ID');
        $this->db->from('ATI_MODULES');
        $this->db->join('ATI_MODULE_LINKS', 'ATI_MODULES.MODULE_ID = ATI_MODULE_LINKS.MODULE_ID', 'left');
        $this->db->order_by('ATI_MODULES.MODULE_NAME', 'ASC');
        //$this->db->where_in('SA_ORGANIZATIONS.ORG_TYPE', array('0', '1'));      
        return $this->db->get()->result();
    }

    public function moduleLinks() {
        return $this->db->query("SELECT l.MODULE_ID,(SELECT m.MODULE_NAME FROM ati_modules m WHERE m.MODULE_ID = l.MODULE_ID)MODULE_NAME, 
                                            l.LINK_ID, l.LINK_NAME, l.URL_URI, l.`CREATE`, l.`READ`, l.`UPDATE`, l.`DELETE`, l.STATUS, l.ACTIVE_STATUS
                                            FROM ati_module_links l")->result();
    }

    function getMonths() {
        $calInfo = cal_info(0);
        return $calInfo['months'];
    }

    function summaty_of_major_items($id, $type = 'RE') {
        return $this->db->query("SELECT EX.SUB_PROJECT_NO,
                                                        EXP_TYPE,
                                                        (SELECT ECONOMIC_CODE
                                                           FROM fn_expenditure_item
                                                          WHERE EXP_ITEM_NO = EX.PARENT_EXP_ITEM_NO)
                                                           ECONOMIC_CODE,
                                                        (SELECT ITEM_NAME
                                                           FROM fn_expenditure_item
                                                          WHERE EXP_ITEM_NO = EX.PARENT_EXP_ITEM_NO)
                                                           ITEM_NAME,
                                                        EX.PARENT_EXP_ITEM_NO,
                                                        SUM(ESTIMATED_COST) AS ESTIMATED_COST,
                                                        SUM(PERCENT_COST) AS PERCENT_COST
                                                   FROM (SELECT A.SUB_PROJECT_NO,
                                                                A.EXP_ITEM_NO,
                                                                A.EXP_TYPE,
                                                                (SELECT EXP_ITEM_NO1
                                                                   FROM fn_expenditure_item
                                                                  WHERE EXP_ITEM_NO = A.EXP_ITEM_NO)
                                                                   PARENT_EXP_ITEM_NO,
                                                                A.ESTIMATED_COST,
                                                                A.PERCENT_COST
                                                           FROM fn_sub_project_budget A
                                                          WHERE A.SUB_PROJECT_NO = $id) AS EX
                                                  WHERE EX.EXP_TYPE = '$type'
                                                 GROUP BY SUB_PROJECT_NO, PARENT_EXP_ITEM_NO, EXP_TYPE
                                                 ORDER BY ECONOMIC_CODE")->result();
    }

    function summaty_of_major_item_re($id) {
        return $this->db->query("SELECT ex.sub_project_no,exp_type,
                                    (SELECT  economic_code
                                    FROM fn_expenditure_item
                                    WHERE exp_item_no =ex.parent_exp_item_no) economic_code,
                                    (SELECT  item_name
                                    FROM fn_expenditure_item
                                    WHERE exp_item_no =ex.parent_exp_item_no) item_name,
                                   ex.parent_exp_item_no,
                                    SUM(estimated_cost) AS estimated_cost
      FROM (SELECT a.sub_project_no,a.exp_item_no,exp_type,
         (SELECT  exp_item_no1
          FROM fn_expenditure_item
          WHERE exp_item_no =a.exp_item_no) parent_exp_item_no,
          estimated_cost
          FROM fn_sub_project_budget a
          WHERE a.sub_project_no=$id) AS ex
                where ex.EXP_TYPE = 'RE'
                                    GROUP BY sub_project_no,parent_exp_item_no,exp_type
                                    ORDER BY economic_code")->result();
    }

    function summaty_of_major_item_ce($id) {
        return $this->db->query("SELECT ex.sub_project_no,exp_type,
                                    (SELECT  economic_code
                                    FROM fn_expenditure_item
                                    WHERE exp_item_no =ex.parent_exp_item_no) economic_code,
                                    (SELECT  item_name
                                    FROM fn_expenditure_item
                                    WHERE exp_item_no =ex.parent_exp_item_no) item_name,
                                   ex.parent_exp_item_no,
                                    SUM(estimated_cost) AS estimated_cost
      FROM (SELECT a.sub_project_no,a.exp_item_no,exp_type,
         (SELECT  exp_item_no1
          FROM fn_expenditure_item
          WHERE exp_item_no =a.exp_item_no) parent_exp_item_no,
          estimated_cost
          FROM fn_sub_project_budget a
          WHERE a.sub_project_no=$id) AS ex
                where ex.EXP_TYPE = 'CE'
                                    GROUP BY sub_project_no,parent_exp_item_no,exp_type
                                    ORDER BY economic_code")->result();
    }

    function summaty_of_major_item_oe($id) {
        return $this->db->query("SELECT ex.sub_project_no,exp_type,
                                    (SELECT  economic_code
                                    FROM fn_expenditure_item
                                    WHERE exp_item_no =ex.parent_exp_item_no) economic_code,
                                    (SELECT  item_name
                                    FROM fn_expenditure_item
                                    WHERE exp_item_no =ex.parent_exp_item_no) item_name,
                                   ex.parent_exp_item_no,
                                    SUM(estimated_cost) AS estimated_cost
      FROM (SELECT a.sub_project_no,a.exp_item_no,exp_type,
         (SELECT  exp_item_no1
          FROM fn_expenditure_item
          WHERE exp_item_no =a.exp_item_no) parent_exp_item_no,
          estimated_cost
          FROM fn_sub_project_budget a
          WHERE a.sub_project_no=$id) AS ex
                where ex.EXP_TYPE = 'OE'
                                    GROUP BY sub_project_no,parent_exp_item_no,exp_type
                                    ORDER BY economic_code")->result();
    }

    function findPreviousReportInfo($tableName, $sub_project_no, $custom_key) {
        $max_period_no = $this->utilities->get_max_value_by_attribute($tableName, 'REP_PERIOD_NO', array('SUB_PROJECT_NO' => $sub_project_no));
        $results = $this->db->get_where($tableName, array('SUB_PROJECT_NO' => $sub_project_no, 'REP_PERIOD_NO' => $max_period_no))->result();
        $returnArray = array();
        if (!empty($results)):
            foreach ($results as $row):
                $returnArray[$row->{$custom_key}] = $row;
            endforeach;
        endif;
        return $returnArray;
    }

    function findPreviousMonitoringInfo($sub_project_no, $custom_filed_name) {
        $max_period_no = $this->utilities->get_max_value_by_attribute('me_sub_project_monitoring', 'REP_PERIOD_NO', array('SUB_PROJECT_NO' => $sub_project_no));
        $result = $this->db->select($custom_filed_name)->get_where('me_sub_project_monitoring', array('SUB_PROJECT_NO' => $sub_project_no, 'REP_PERIOD_NO' => $max_period_no))->row();
        $returnValue = '';
        if (!empty($result)):
            if ($result->{$custom_filed_name} != '') {
                $returnValue = $result->{$custom_filed_name};
            } else {
                $resultAnother = $this->db->select($custom_filed_name)->get_where('me_sub_project_monitoring', array('SUB_PROJECT_NO' => $sub_project_no, 'REP_PERIOD_NO' => $max_period_no - 1))->row();
                if (!empty($resultAnother)):
                    if ($resultAnother->{$custom_filed_name} != '') {
                        $returnValue = $resultAnother->{$custom_filed_name};
                    }
                endif;
            }
        endif;
        return $returnValue;
    }

    function spell_out_number($number) {
        if (($number < 0) || ($number > 999999999999)) {
            throw new Exception("Number is out of range");
        }

        $Gn = floor($number / 1000000);
        /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);
        /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);
        /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);
        /* Tens (deca) */
        $n = $number % 10;
        /* Ones */

        $res = "";

        if ($Gn) {
            $res .= $this->spell_out_number($Gn) . " Million";
        }

        if ($kn) {
            $res .= (empty($res) ? "" : " ") . $this->spell_out_number($kn) . " Thousand";
        }

        if ($Hn) {
            $res .= (empty($res) ? "" : " ") . $this->spell_out_number($Hn) . " Hundred";
        }

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }

            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];

                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res)) {
            $res = "zero";
        }

        return $res;
    }

    function drpchange($val, $drp = 'u', $rtn = 'l') {
        switch ($drp) {
            case 'u':
                $unit = ($val * 1);
                $hun = ($val / 100);
                $tho = ($val / 1000);
                $lak = ($val / 100000);
                $mil = ($val / 1000000);
                $cro = ($val / 10000000);
                break;
            case 'h':
                $unit = ($val * 100);
                $hun = ($val * 1);
                $tho = ($val / 10);
                $lak = ($val / 1000);
                $mil = ($val / 10000);
                $cro = ($val / 100000);
                break;
            case 't':
                $unit = ($val * 1000);
                $hun = ($val * 10);
                $tho = ($val * 1);
                $lak = ($val / 100);
                $mil = ($val / 1000);
                $cro = ($val / 10000);
                break;
            case 'l':
                $unit = ($val * 100000);
                $hun = ($val * 1000);
                $tho = ($val * 10);
                $lak = ($val * 1);
                $mil = ($val / 10);
                $cro = ($val / 100);
                break;
            case 'm':
                $unit = ($val * 1000000);
                $hun = ($val * 10000);
                $tho = ($val * 1000);
                $lak = ($val * 10);
                $mil = ($val * 1);
                $cro = ($val / 10);
                break;
            case 'c':
                $unit = ($val * 10000000);
                $hun = ($val * 100000);
                $tho = ($val * 10000);
                $lak = ($val * 100);
                $mil = ($val * 10);
                $cro = ($val * 1);
                break;
            default:
                exit(1);
                break;
        }
        $returnArray = array(
            'u' => $unit,
            'h' => $hun,
            't' => $tho,
            'l' => $lak,
            'm' => $mil,
            'c' => $cro
        );
        return $returnArray[$rtn];
    }

    function filterAccountBalance($amount) {
        $amt_prefix = '';
        $amt_postfix = '';
        if ($amount < 0) {
            $amt_prefix = '(';
            $amount = $amount * (-1);
            $amt_postfix = ')';
        }
        return $amt_prefix . number_format($amount, 2) . $amt_postfix;
    }
    
     function signFormat($amount,$precision=2) {
        $amt_prefix = '';
        $amt_postfix = '';
        if ($amount < 0) {
            $amt_prefix = '(';
            $amount = $amount * (-1);
            $amt_postfix = ')';
        }
        return $amt_prefix .number_format($amount, $precision)  . $amt_postfix;
    }

}

?>