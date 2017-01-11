<?php

class Subproject extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_fund() {
        $data = $this->db->query("SELECT m.FORECAST_NO, m.SUB_PROJECT_NO, sp.INSTITUTE_NAME,sp.CP_NO,
                                                        sp.SUB_PROJECT_TITLE, m.REQUEST_NO, m.REQ_DT,
                                                        (SELECT QUARTER_NAME FROM fn_quarter_setup WHERE QUARTER_NO = m.REQ_QUARTER)QUARTER_NAME,
                                                        (SELECT SUM(b.QUARTER1_AMT)
                                                           FROM fn_cash_forecast b
                                                          WHERE b.FORECAST_NO = m.FORECAST_NO)
                                                           quarter1_total,
                                                        (SELECT SUM(b.QUARTER2_AMT)
                                                           FROM fn_cash_forecast b
                                                          WHERE b.FORECAST_NO = m.FORECAST_NO)
                                                           quarter2_total
                                                   FROM fn_cash_forecast_mst m
                                                        LEFT JOIN pr_subproject_v sp ON m.SUB_PROJECT_NO = sp.SUB_PROJECT_NO
                                                  WHERE m.COST_CATEGORY = 'SP' AND m.APPROVED_STATUS = 'RQ'");
        return $data->result();
    }

    public function get_report_quater($quarter_id) {
        $condition = '';
        if ($quarter_id != '') {
            $condition = "AND m.REQ_QUARTER = $quarter_id";
        }
        $data = $this->db->query("SELECT m.FORECAST_NO, m.SUB_PROJECT_NO, sp.INSTITUTE_NAME,sp.CP_NO,
                                                        sp.SUB_PROJECT_TITLE, m.REQUEST_NO, m.REQ_DT,
                                                        (SELECT SUM(b.QUARTER1_AMT)
                                                           FROM fn_cash_forecast b
                                                          WHERE b.FORECAST_NO = m.FORECAST_NO)
                                                           quarter1_total,
                                                        (SELECT SUM(b.QUARTER2_AMT)
                                                           FROM fn_cash_forecast b
                                                          WHERE b.FORECAST_NO = m.FORECAST_NO)
                                                           quarter2_total
                                                   FROM fn_cash_forecast_mst m
                                                        LEFT JOIN pr_subproject_v sp ON m.SUB_PROJECT_NO = sp.SUB_PROJECT_NO
                                                  WHERE m.COST_CATEGORY = 'SP' AND m.APPROVED_STATUS = 'RQ' $condition");
        /* $data = $this->db->query('select a.FORECAST_NO, a.SUB_PROJECT_NO, a.REQUEST_NO, a.REQ_DT, a.ACTIVE,
          (select b.INSTITUTE_NAME from pr_institute b, pr_subproject c where b.INSTITUTE_NO = c.INSTITUTE_NO and c.SUB_PROJECT_NO = a.SUB_PROJECT_NO)INSTITUTE_NAME,
          (select d.SUB_PROJECT_TITLE from pr_subproject d, pr_institute e where d.INSTITUTE_NO = e.INSTITUTE_NO and d.SUB_PROJECT_NO = a.SUB_PROJECT_NO)SUB_PROJECT_TITLE,
          (select sum(b.QUARTER1_AMT) as quarter1_total from fn_cash_forecast b where b.FORECAST_NO = a.FORECAST_NO)quarter1_total,
          (SELECT sum(b.QUARTER2_AMT) AS quarter2_total  FROM fn_cash_forecast b  WHERE b.FORECAST_NO = a.FORECAST_NO) quarter2_total
          from fn_cash_forecast_mst a where REQ_QUARTER=' . $quarter_id); */
        return $data->result();
    }

    public function get_req_fundno($SUB_REQ_NO) {
        $data = $this->db->query('SELECT SUB_REQ_NO,CP_NO,QTR_NO,(SELECT QUARTER_NAME FROM fn_quarter_setup WHERE QUARTER_NO=F.QTR_NO) QUARTER_NAME,
                                 SUB_PROJECT_NO,(SELECT INSTITUTE_NAME FROM pr_institute WHERE INSTITUTE_NO=(SELECT INSTITUTE_NO 
                                                                                                             FROM PR_SUBPROJECT 
                                                                                                             WHERE SUB_PROJECT_NO= F.SUB_PROJECT_NO)) PROJECT_NAME,
                                  BANK_SLNO,BANK_ID,(SELECT BANK_NAME FROM FN_BANK WHERE BANK_ID=F.BANK_ID) BANK_NAME,
                                  ACCOUNT_NO,REQ_AMT,REQ_DT,FROM_DT,TO_DT,REMARKS_SUB,REMARKS_HEQ,ACTIVE,
                                  STATUS_FLAG,ORG_ID
                                  FROM fn_request_fund F where SUB_REQ_NO=' . $SUB_REQ_NO);
        return $data->row();
    }

    public function list_of_institute() {
        $data = $this->db->query('SELECT MONITORING_NO,CP_NO,SUB_PROJECT_NO,
                                    (SELECT INSTITUTE_NAME FROM pr_institute WHERE INSTITUTE_NO=(SELECT INSTITUTE_NO 
                                                                                                FROM PR_SUBPROJECT 
                                                                                                WHERE SUB_PROJECT_NO= F.SUB_PROJECT_NO)) INSTITUTE_NAME,
                                    F.REP_PERIOD_NO REP_PERIOD_NO,P.PERIOD_NAME PERIOD_NAME,P.REPORT_FROM_DT REPORT_FROM_DT,P.REPORT_TO_DT EPORT_TO_DT,
                                    ACTIVITIES_SUMMARY,PROGRESS_DESC,OVERALL_PROGRESS,ACTIVITIES_PLAN_SIX,
                                    ACHIEVEMENTS,COMMENTS,DECLARATION, F.ORG_ID ORG_ID,F.ACTIVE ACTIVE
                                    FROM me_sub_project_monitoring F, me_sub_reporting_period P
                                    WHERE F.REP_PERIOD_NO=P.REP_PERIOD_NO');
        return $data->result();
    }

    public function no_of_internal_staff($id) {
        $data = $this->db->query("SELECT count(p.STAFF_TYPE) as STAFF_TYPE
                                    FROM pr_sub_project_staff AS p
                                    WHERE p.SUB_PROJECT_NO = $id AND p.STAFF_TYPE = 'I'");
        return $data->row();
    }

    public function no_of_student($id) {
        $data = $this->db->query("SELECT count(p.STAFF_TYPE) as STAFF_TYPE
                                    FROM pr_sub_project_staff AS p
                                    WHERE p.SUB_PROJECT_NO =$id AND p.STAFF_TYPE = 'S'");
        return $data->row();
    }

    public function no_of_consultants($id) {
        $data = $this->db->query("SELECT count(p.STAFF_TYPE) as STAFF_TYPE
                                    FROM pr_sub_project_staff AS p
                                    WHERE p.SUB_PROJECT_NO = $id AND p.STAFF_TYPE = 'C'");
        return $data->row();
    }

    public function no_staff_full_time($id) {
        $data = $this->db->query("SELECT count(p.CONTRACT_TYPE) as CONTRACT_TYPE
                                    FROM pr_sub_project_staff AS p
                                    WHERE p.SUB_PROJECT_NO = $id AND p.CONTRACT_TYPE =1");
        return $data->row();
    }

    public function no_staff_part_time($id) {
        $data = $this->db->query("SELECT count(p.CONTRACT_TYPE) as CONTRACT_TYPE
                                    FROM pr_sub_project_staff AS p
                                    WHERE p.SUB_PROJECT_NO = $id AND p.CONTRACT_TYPE =2");
        return $data->row();
    }

    public function no_staff_provisinal_time($id) {
        $data = $this->db->query("SELECT count(p.CONTRACT_TYPE) as CONTRACT_TYPE
                                    FROM pr_sub_project_staff AS p
                                    WHERE p.SUB_PROJECT_NO = $id AND p.CONTRACT_TYPE =3");
        return $data->row();
    }

    public function subproject_stuff_info($id) {
        $data = $this->db->query("SELECT p.*,d.LOOKUP_DATA_NAME as designation
                                    FROM pr_sub_project_staff AS p
                                    left join lv_staff_designation as d on p.DESIGNATION_NO=d.LOOKUP_DATA_ID
                                    WHERE p.SUB_PROJECT_NO = $id");
        return $data->result();
    }

    public function get_all_event_info($sp_no, $event_id) {
        return $this->db->query("SELECT (SELECT LOOKUP_DATA_NAME
                                                                    FROM lv_event_type
                                                                    WHERE LOOKUP_DATA_ID = ex.EVENT_NAME)
                                                                    AC_EVENT,
                                                                ex.NO_PARTICIPANTS AC_PARTICIPANTS,
                                                                ex.DURATION AS AC_DURATION,
                                                                (SELECT LOOKUP_DATA_NAME
                                                                    FROM lv_event_type
                                                                    WHERE LOOKUP_DATA_ID = ptt.TRAINING_TYPE)
                                                                    CP_EVENT,
                                                                ptt.PARTICIPANTS CP_PARTICIPANTS,
                                                                ptt.TRAINING_SUBJECT,
                                                                ptt.DURATION AS CP_DURATION
                                                            FROM me_event_experience ex
                                                                LEFT JOIN pr_training_tour ptt
                                                                    ON (    ptt.TRAINING_TYPE = ex.EVENT_NAME
                                                                        AND ptt.SUB_PROJECT_NO = ex.SUB_PROJECT_NO)
                                                            WHERE ex.SUB_PROJECT_NO = $sp_no AND ex.EVENT_NAME = $event_id")->result();
    }

}
