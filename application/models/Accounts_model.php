<?php

Class Accounts_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_subProjectQuartlyExp() {
        $sql = "SELECT a.SUB_PROJECT_NO,
                            (SELECT c.INSTITUTE_NAME
                               FROM pr_institute c, pr_subproject d
                              WHERE     c.INSTITUTE_NO = d.INSTITUTE_NO
                                    AND d.SUB_PROJECT_NO = a.SUB_PROJECT_NO)
                               INSTITUTE_NAME,
                            (SELECT d.SUB_PROJECT_TITLE
                               FROM pr_institute c, pr_subproject d
                              WHERE     c.INSTITUTE_NO = d.INSTITUTE_NO
                                    AND d.SUB_PROJECT_NO = a.SUB_PROJECT_NO)
                               sub_project_title,
                            QUARTER_NO,
                            a.FY_NO,
                            sum(EXP_AMT) AS quarter_exp,
                            fnc_subprojectfinexp(a.SUB_PROJECT_NO, a.FY_NO) AS financial_exp,
                            fnc_subprojectcumexp(a.SUB_PROJECT_NO) AS cumulative_exp
                       FROM fn_ac_expenditure_mst a, fn_ac_expenditure b
                      WHERE a.MST_EXP_NO = b.MST_EXP_NO AND QUARTER_NO = 6
                     GROUP BY SUB_PROJECT_NO,
                              INSTITUTE_NAME,
                              SUB_PROJECT_TITLE,
                              QUARTER_NO,
                              FY_NO";
        return $this->db->query($sql)->result();
    }

    public function get_projectInfo($subproject_no) {
        $sql = "SELECT a.SUB_PROJECT_NO,
                                    (SELECT c.INSTITUTE_NAME
                                       FROM pr_institute c
                                      WHERE c.INSTITUTE_NO = a.INSTITUTE_NO)
                                       institute_name,
                                    (SELECT c.INSTITUTE_TYPE
                                       FROM pr_institute c
                                      WHERE c.INSTITUTE_NO = a.INSTITUTE_NO)
                                       institute_type,
                                    (SELECT WINDOW_NAME
                                       FROM pr_window
                                      WHERE PR_WINDOW_NO = a.PR_WINDOW_NO)
                                       window_name,
                                    (SELECT WINDOW_TITLE
                                       FROM pr_window
                                      WHERE PR_WINDOW_NO = a.PR_WINDOW_NO)
                                       window_title,
                                    (SELECT CONCAT(FIRST_NAME,
                                                   ' ',
                                                   MIDDLE_NAME,
                                                   ' ',
                                                   LAST_NAME)
                                       FROM pr_sub_project_staff
                                      WHERE IS_MANAGER = 1 AND SUB_PROJECT_NO = a.SUB_PROJECT_NO
                                      LIMIT 1)
                                       MANAGER_NAME,
                                    PR_WINDOW_NO,
                                    ROUND_NO,
                                    a.CP_NO,
                                    a.SUB_PROJECT_TITLE,
                                    (SELECT LOOKUP_DATA_NAME
                                       FROM lv_impliment_units
                                      WHERE LOOKUP_DATA_ID = a.IMPLEMENT_UNIT_NO)
                                       implement_unit,
                                    a.CONTRACT_NO,
                                    a.CONTRACT_DT,
                                    START_DT,
                                    END_DT,
                                    ROUND_NO,
                                    TOTAL_COST_TK,
                                    TOTAL_COST_US,
                                    ACCOUNT_NO,
                                    ACCOUNT_NAME,
                                    BANK_NAME,
                                    BRANCH_NAME,
                                    BRANCH_ADDRESS
                               FROM pr_subproject a
                              WHERE a.SUB_PROJECT_NO = $subproject_no
                              LIMIT 1";
        return $this->db->query($sql)->row();
    }

    public function get_quarterInfo($quarter_no) {
        $data = $this->db->query("SELECT QUARTER_NO,QUARTER_NAME,QUARTER_FROM_DT,QUARTER_TO_DT,LAST_DT_PRE_QUARTER,LAST_DT_PRE_FY,b.FY_NO,START_DT FY_START_DT,END_DT FY_END_DT 
                                    FROM fn_quarter_setup a,fn_fin_year b
                                    WHERE a.FY_NO=b.FY_NO AND a.QUARTER_NO=$quarter_no");
        return $data->row();
    }

    public function get_useOfFundByActivity($subproject_no, $quarter_no) {
        $data = $this->db->query("SELECT a.SUB_PROJECT_NO,
                                    QUARTER_NO,a.FY_NO,EXP_ITEM_NO,
                                    (SELECT  ECONOMIC_CODE
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) economic_code,
                                    (SELECT  ITEM_NAME
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) item_name,
                                    SUM(EXP_AMT) AS quarter_exp,
                                    fnc_projectitemfinexp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO,a.FY_NO) AS financial_exp,
                                    fnc_projectitemcumexp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO) AS cumulative_exp,
                                    fnc_projectItemAppExp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO) AS approved_exp
                                    FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
                                    WHERE a.MST_EXP_NO=b.MST_EXP_NO
                                    AND a.SUB_PROJECT_NO=$subproject_no AND a.QUARTER_NO=$quarter_no
                                    GROUP BY SUB_PROJECT_NO,QUARTER_NO,FY_NO,EXP_ITEM_NO
                                    ORDER BY ECONOMIC_CODE");
        return $data->result();
    }

    /*
      public function get_useOfFundByParentItem($subproject_no, $quarter_no) {
      $data = $this->db->query("  SELECT ex.sub_project_no,
      ex.quarter_no,ex.fy_no,
      (SELECT  economic_code
      FROM fn_expenditure_item
      WHERE exp_item_no =ex.parent_exp_item_no) economic_code,
      (SELECT  item_name
      FROM fn_expenditure_item
      WHERE exp_item_no =ex.parent_exp_item_no) item_name,
      ex.parent_exp_item_no,
      SUM(exp_amt) AS quarter_exp,
      SUM(financial_exp) AS financial_exp,
      SUM(cumulative_exp) AS cumulative_exp,
      SUM(approved_exp) AS approved_exp
      FROM (SELECT a.sub_project_no,
      quarter_no,a.fy_no,exp_item_no,
      (SELECT  exp_item_no2
      FROM fn_expenditure_item
      WHERE exp_item_no =b.exp_item_no) parent_exp_item_no,
      exp_amt,
      fnc_projectitemfinexp(a.sub_project_no,b.exp_item_no,a.fy_no) AS financial_exp,
      fnc_projectitemcumexp(a.sub_project_no,b.exp_item_no) AS cumulative_exp,
      fnc_projectItemAppExp(a.sub_project_no,b.exp_item_no) AS approved_exp
      FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
      WHERE a.mst_exp_no=b.mst_exp_no
      AND a.sub_project_no=$subproject_no AND a.quarter_no=$quarter_no) AS ex
      GROUP BY sub_project_no,quarter_no,fy_no,parent_exp_item_no
      ORDER BY economic_code");
      return $data->result();
      }
     */
/*
    public function get_useOfFundBySubProject($quarter_no) {
        $data = $this->db->query("SELECT a.SUB_PROJECT_NO,fnc_varsityType(a.SUB_PROJECT_NO) varsity_type,fnc_subProjectCpno(a.SUB_PROJECT_NO) subProjectCpno, 
                                                                        fnc_subProjectVarsity(a.SUB_PROJECT_NO) varsity,
                                                                         fnc_subProjectTitle(a.SUB_PROJECT_NO) subProjectTitle, 
                                                                         fnc_subProjectQtrCumApp(a.SUB_PROJECT_NO,$quarter_no) subProjectFund,
                                                                         fnc_subProjectCummQtrExp(a.SUB_PROJECT_NO,$quarter_no-1) subProjectCummPreQtrExp,
                                                                         fnc_subProjectQtrExp(a.SUB_PROJECT_NO,$quarter_no) subProjectQtrExp,
                                                                         fnc_subProjectCummQtrExp(a.SUB_PROJECT_NO,$quarter_no) subProjectCummQtrExp,
                                                                         fnc_subProjectClosingBalance(a.SUB_PROJECT_NO,$quarter_no) subProjectClosingBal,
                                                                         SUM(EXP_AMT) exp_amt
                                                                         FROM fn_ac_expenditure_mst a,fn_ac_expenditure b 
                                                                        WHERE a.MST_EXP_NO=b.MST_EXP_NO 
                                                                        AND a.QUARTER_NO<=$quarter_no
                                                                        AND a.SUB_PROJECT_NO IS NOT NULL 
                                                                        GROUP BY SUB_PROJECT_NO");
        return $data->result();
    }*/

    public function get_receiptOfFundBySource($subproject_no, $quarter_no) {
        $data = $this->db->query(" SELECT fnc_subProjectQtrApp($subproject_no, $quarter_no) AS quarter_app,
                fnc_subProjectQtrFinApp($subproject_no, $quarter_no)AS financial_app,fnc_subProjectCumApp($subproject_no) cumulitive_app ");
        return $data->row();
    }

    public function get_cumulativeAdvance($subproject_no, $quarter_no) {
        $data = $this->db->query("select fnc_subProjectOpeningBalance($subproject_no,$quarter_no) as cumAdvance_amt");
        return $data->row();
    }

    public function get_CumulativeExp($subproject_no, $quarter_no) {
        $data = $this->db->query("select sum(EXP_AMT) as cumExp_amt 
                                         from fn_ac_expenditure_mst a,fn_ac_expenditure b
			                 where a.MST_EXP_NO=b.MST_EXP_NO
                                        and SUB_PROJECT_NO=$subproject_no and QUARTER_NO<=$quarter_no");
        return $data->row();
    }

    public function get_openingBalance($subproject_no, $quarter_no) {
        $data = $this->db->query("SELECT fnc_subProjectOpeningBalance($subproject_no,$quarter_no) as opening_amt");
        return $data->row();
    }

    public function get_expClosingBalance($subproject_no, $quarter_no) {
        $data = $this->db->query("SELECT SUM(EXP_AMT) quarter_exp,fnc_subProjectClosingBalance($subproject_no,$quarter_no) closing_balance
	FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
	WHERE a.MST_EXP_NO=b.MST_EXP_NO
	AND QUARTER_NO=$quarter_no AND SUB_PROJECT_NO=$subproject_no");
        return $data->row();
    }

    public function get_parentItemOfExp($revexp) {
        $data = $this->db->query("SELECT EXP_ITEM_NO,ECONOMIC_CODE,ITEM_NAME 
                                  FROM fn_expenditure_item a
                                  WHERE a.EXP_TYPE=$revexp AND a.EXP_LEVEL=2
                                  AND a.ACTIVE=1 AND a.SP_ACTIVE=1
                                  ORDER BY ECONOMIC_CODE");
        return $data->result();
    }

    public function get_useOfFundByRev($subproject_no, $quarter_no, $revexp) {
        $data = $this->db->query("SELECT a.SUB_PROJECT_NO,
                                    QUARTER_NO,a.FY_NO,EXP_ITEM_NO,EXP_TYPE,
                                    (SELECT  ECONOMIC_CODE
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) economic_code,
                                    (SELECT  ITEM_NAME
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) item_name,
                                    (SELECT  EXP_ITEM_NO2
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) parent_exp_item_no,
                                    SUM(EXP_AMT) AS quarter_exp,
                                    fnc_projectitemfinexp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO,a.FY_NO) AS financial_exp,
                                    fnc_projectitemcumexp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO) AS cumulative_exp,
                                    fnc_subprojectItemWiseBudget(a.SUB_PROJECT_NO,b.EXP_ITEM_NO) AS approved_exp
                                    FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
                                    WHERE a.MST_EXP_NO=b.MST_EXP_NO
                                    AND a.SUB_PROJECT_NO=$subproject_no AND a.QUARTER_NO=$quarter_no AND EXP_TYPE=$revexp
                                    GROUP BY SUB_PROJECT_NO,QUARTER_NO,FY_NO,EXP_ITEM_NO,EXP_TYPE
                                    ORDER BY ECONOMIC_COD");
        return $data->result();
    }

    public function get_useOfFundByOperation($subproject_no, $quarter_no, $revexp) {
        $data = $this->db->query("SELECT a.SUB_PROJECT_NO,
                                    QUARTER_NO,a.FY_NO,EXP_TYPE,
                                    SUM(EXP_AMT) AS quarter_exp,
                                    fnc_projectitemfinexp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO,a.FY_NO) AS financial_exp,
                                    fnc_projectitemcumexp(a.SUB_PROJECT_NO,b.EXP_ITEM_NO) AS cumulative_exp,
                                    fnc_subprojectItemWiseBudget(a.SUB_PROJECT_NO,b.EXP_ITEM_NO) AS approved_exp
                                    FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
                                    WHERE a.MST_EXP_NO=b.MST_EXP_NO
                                    AND a.SUB_PROJECT_NO=$subproject_no AND a.QUARTER_NO=$quarter_no AND EXP_TYPE=$revexp
                                    GROUP BY SUB_PROJECT_NO,QUARTER_NO,FY_NO,EXP_TYPE");
        return $data->row();
    }

  

    public function get_reqOfFundByCategory($QUARTER_NO, $AC_TYPE_NO) {
        //$QUARTER_NO = $this->uri->segment(4, 0);

        $data = $this->db->query("SELECT REQ_QUARTER,COST_CATEGORY,
                                    CASE WHEN COST_CATEGORY='SP' THEN 'Sub Project AIF Grants'
                                    WHEN COST_CATEGORY='WK' THEN 'Works'
                                    WHEN COST_CATEGORY='GD' THEN 'Goods'
                                    WHEN COST_CATEGORY='CS' THEN 'Consulting services'
                                    WHEN COST_CATEGORY='NCS' THEN 'Non Consulting services'
                                    END category,
                                    CASE WHEN COST_CATEGORY='SP' THEN '1'
                                    WHEN COST_CATEGORY='WK' THEN '2'
                                    WHEN COST_CATEGORY='GD' THEN '3'
                                    WHEN COST_CATEGORY='CS' THEN '4'
                                    WHEN COST_CATEGORY='NCS' THEN '5'
                                    END category_sl,
                                    SUM(QUARTER1_AMT) AS quarter1_amt,SUM(QUARTER2_AMT) AS quarter2_amt,
                                    SUM(NULLIF(QUARTER1_AMT,0)+NULLIF(QUARTER2_AMT,0)) total_fund
                                    FROM fn_cash_forecast_mst a,fn_cash_forecast b
                                    WHERE a.FORECAST_NO=b.FORECAST_NO
                                    AND a.REQ_QUARTER= '$QUARTER_NO' AND a.AC_TYPE_NO = NULLIF($AC_TYPE_NO,0)
                                    GROUP BY COST_CATEGORY
                                    ORDER BY CATEGORY_SL");
        return $data->result();
    }

    public function get_CashForecastStatements($QUARTER_NO, $AC_TYPE_NO) {
        //$QUARTER_NO = $this->uri->segment(4, 0);

        $data = $this->db->query("SELECT REQ_QUARTER,COST_CATEGORY,
                                    CASE WHEN COST_CATEGORY='SP' THEN 'Sub Project AIF Grants'
                                    WHEN COST_CATEGORY='WK' THEN 'Works'
                                    WHEN COST_CATEGORY='GD' THEN 'Goods'
                                    WHEN COST_CATEGORY='CS' THEN 'Consulting services'
                                    WHEN COST_CATEGORY='NCS' THEN 'Non Consulting services'
                                    END category,
                                    CASE WHEN COST_CATEGORY='SP' THEN '1'
                                    WHEN COST_CATEGORY='WK' THEN '2'
                                    WHEN COST_CATEGORY='GD' THEN '3'
                                    WHEN COST_CATEGORY='CS' THEN '4'
                                    WHEN COST_CATEGORY='NCS' THEN '5'
                                    END category_sl,
                                    (SELECT ITEM_NAME FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO=b.EXP_ITEM_NO) item_name,
                                    EXP_ITEM_NO,QUARTER1_AMT,QUARTER2_AMT,
                                    NULLIF(QUARTER1_AMT,0)+NULLIF(QUARTER2_AMT,0) total_fund,
                                    (SELECT ROUND_NO FROM pr_subproject
                                    WHERE SUB_PROJECT_NO=a.SUB_PROJECT_NO) round_no
                                    FROM fn_cash_forecast_mst a,fn_cash_forecast b
                                    WHERE a.FORECAST_NO=b.FORECAST_NO
                                    and COST_CATEGORY <> 'SP'
                                    AND a.REQ_QUARTER= '$QUARTER_NO' 
                                    AND a.AC_TYPE_NO = NULLIF($AC_TYPE_NO,0)
                                    ORDER BY category_sl");
        return $data->result();
    }

    public function get_useOfFundByNarration($subproject_no, $quarter_no) {
        $data = $this->db->query("SELECT a.SUB_PROJECT_NO,
                                    QUARTER_NO,a.FY_NO,EXP_ITEM_NO,
                                    (SELECT  ECONOMIC_CODE
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) economic_code,
                                    (SELECT  ITEM_NAME
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) item_name,
                                    REMARKS,EXP_AMT
                                    FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
                                    WHERE a.MST_EXP_NO=b.MST_EXP_NO
                                    and ifnull(PACKAGE_NO,'0')='0'   
                                    AND a.SUB_PROJECT_NO=$subproject_no AND a.QUARTER_NO=$quarter_no
                                   ORDER BY economic_code");
        return $data->result();
    }

    public function get_useOfFundByPackage($subproject_no, $quarter_no) {
        $data = $this->db->query("SELECT a.SUB_PROJECT_NO,
                                    QUARTER_NO,a.FY_NO,EXP_ITEM_NO,
                                    (SELECT  ITEM_NAME
                                    FROM fn_expenditure_item
                                    WHERE EXP_ITEM_NO =b.EXP_ITEM_NO) item_name,
                                    CONTRACT_NO,CONTRACT_DT,PROC_PACKAGE_NO,SELECTION_METHOD,CONTRACTOR_NAME,
                                    CONTRACT_CURR,CONTRACT_VALUE,EXP_AMT AS invoiced_amount,INVOICE_NO,INVOICE_DT,CONTRACT_BALANCE
                                    FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
                                    WHERE a.MST_EXP_NO=b.MST_EXP_NO
                                    AND ifnull(PACKAGE_NO,'0')!='0'
                                    AND a.SUB_PROJECT_NO=$subproject_no AND a.QUARTER_NO=$quarter_no");
        return $data->result();
    }

    public function get_sumUseOfFund($subproject_no, $quarter_no) {
        $data = $this->db->query("SELECT package,description,quarter_exp,
                       fnc_subprojectfinpackageexp(qtrexp.SUB_PROJECT_NO,qtrexp.FY_NO,qtrexp.package) as financial_exp,
                       fnc_subprojectcumpackageexp(qtrexp.SUB_PROJECT_NO,qtrexp.package) as cumulative_exp
                          from (
                                   SELECT a.SUB_PROJECT_NO,QUARTER_NO,a.FY_NO,
                                    CASE WHEN ifnull(PACKAGE_NO,'0')='0' THEN
                                     0
                                    ELSE
                                     1
                                    END package,
                                    CASE WHEN PACKAGE_NO!='0' THEN
                                     'Statement of Expenditures (SOE): Not Subject to prior Review (Form 2C )'
                                    ELSE
                                     'Statement of Expenditures (SOE): Subject to prior Review (Form 2B )'
                                    END description,
                                    SUM(EXP_AMT) AS quarter_exp
                                    FROM fn_ac_expenditure_mst a,fn_ac_expenditure b
                                    WHERE a.MST_EXP_NO=b.MST_EXP_NO
                                    AND a.SUB_PROJECT_NO=$subproject_no AND a.QUARTER_NO=$quarter_no
                                   GROUP BY SUB_PROJECT_NO,QUARTER_NO,FY_NO,description) qtrexp
                                    ORDER BY package");
        return $data->result();
    }

    public function get_accounthead_info() {
        $data = $this->db->query("SELECT b.AC_NO,b.UD_AC_NO,b.ECONOMIC_CODE,b.AC_NAME,b.HEAD,
			(SELECT AC_NAME
			FROM fn_achead
			WHERE AC_NO = b.PARANT_AC_NO) Under_AC,AC_LEVEL,
					CASE 
						WHEN b.COST_CATEGORY = 'SP' THEN
						'Sub Project Grant'
						WHEN b.COST_CATEGORY = 'WK' THEN
						'Works'
						WHEN b.COST_CATEGORY = 'GD' THEN
						'Goods'
						WHEN b.COST_CATEGORY = 'CS' THEN
						'Consulting services'
						WHEN b.COST_CATEGORY = 'NCS' THEN
						'Non Consulting services'
						WHEN b.COST_CATEGORY = 'OC' THEN
						'Operating Cost'
						ELSE
						NULL
					END COST_CATEGORY,
						CASE 
						WHEN b.POSTING_FLAG = 0 THEN
						'No'
						WHEN b.POSTING_FLAG = 1 THEN
						'Yes'
						ELSE
						NULL
						END POSTING_FLAG ,
					b.SUB_PROJECT_NO,
					
					CASE 
						WHEN b.ACTIVE = 0 THEN
						'No'
						WHEN b.ACTIVE = 1 THEN
						'Yes'
						ELSE
						NULL
					END ACTIVE																	
					FROM fn_achead b");
        return $data->result();
    }
     public function get_accounthead_info_sub() {
        $data = $this->db->query("SELECT b.AC_NO,b.UD_AC_NO,b.ECONOMIC_CODE,b.AC_NAME,b.HEAD,
			(SELECT AC_NAME
			FROM fn_sp_achead
			WHERE AC_NO = b.PARANT_AC_NO) Under_AC,AC_LEVEL,
					CASE 
						WHEN b.COST_CATEGORY = 'SP' THEN
						'Sub Project Grant'
						WHEN b.COST_CATEGORY = 'WK' THEN
						'Works'
						WHEN b.COST_CATEGORY = 'GD' THEN
						'Goods'
						WHEN b.COST_CATEGORY = 'CS' THEN
						'Consulting services'
						WHEN b.COST_CATEGORY = 'NCS' THEN
						'Non Consulting services'
						WHEN b.COST_CATEGORY = 'OC' THEN
						'Operating Cost'
						ELSE
						NULL
					END COST_CATEGORY,
						CASE 
						WHEN b.POSTING_FLAG = 0 THEN
						'No'
						WHEN b.POSTING_FLAG = 1 THEN
						'Yes'
						ELSE
						NULL
						END POSTING_FLAG ,
					b.SUB_PROJECT_NO,
					
					CASE 
						WHEN b.ACTIVE = 0 THEN
						'No'
						WHEN b.ACTIVE = 1 THEN
						'Yes'
						ELSE
						NULL
					END ACTIVE																	
					FROM fn_sp_achead b");
        return $data->result();
    }

    public function get_view_achead_data() {
        $ac_no = $this->input->post('ac_id');
        $data = $this->db->query("SELECT b.AC_NO,b.UD_AC_NO,b.ECONOMIC_CODE,b.AC_NAME,b.HEAD,(SELECT AC_NAME
						FROM fn_achead
						WHERE AC_NO = b.PARANT_AC_NO) PARANT_AC_NO,AC_LEVEL,
								CASE 
									WHEN b.COST_CATEGORY = 'SP' THEN
									'Sub Project Grant'
									WHEN b.COST_CATEGORY = 'WK' THEN
									'Works'
									WHEN b.COST_CATEGORY = 'GD' THEN
									'Goods'
									WHEN b.COST_CATEGORY = 'CS' THEN
									'Consulting services'
									WHEN b.COST_CATEGORY = 'NCS' THEN
									'Non Consulting services'
									WHEN b.COST_CATEGORY = 'OC' THEN
									'Operating Cost'
									ELSE
									NULL
								END COST_CATEGORY,
									CASE 
									WHEN b.POSTING_FLAG = 0 THEN
									'No'
									WHEN b.POSTING_FLAG = 1 THEN
									'Yes'
									ELSE
									NULL
									END POSTING_FLAG ,
								b.SUB_PROJECT_NO,
								
								CASE 
									WHEN b.ACTIVE = 0 THEN
									'No'
									WHEN b.ACTIVE = 1 THEN
									'Yes'
									ELSE
									NULL
								END ACTIVE,
								(SELECT SUB_PROJECT_TITLE
								FROM pr_subproject
								WHERE SUB_PROJECT_NO = b.SUB_PROJECT_NO) SUB_PROJECT_TITLE	
								FROM fn_achead b
								where AC_NO = '$ac_no' ");
        return $data->row();
    }
    
     public function get_view_achead_data_sub() {
        $ac_no = $this->input->post('ac_id');
        $data = $this->db->query("SELECT b.AC_NO,b.UD_AC_NO,b.ECONOMIC_CODE,b.AC_NAME,b.HEAD,(SELECT AC_NAME
						FROM fn_sp_achead
						WHERE AC_NO = b.PARANT_AC_NO) PARANT_AC_NO,AC_LEVEL,
								CASE 
									WHEN b.COST_CATEGORY = 'SP' THEN
									'Sub Project Grant'
									WHEN b.COST_CATEGORY = 'WK' THEN
									'Works'
									WHEN b.COST_CATEGORY = 'GD' THEN
									'Goods'
									WHEN b.COST_CATEGORY = 'CS' THEN
									'Consulting services'
									WHEN b.COST_CATEGORY = 'NCS' THEN
									'Non Consulting services'
									WHEN b.COST_CATEGORY = 'OC' THEN
									'Operating Cost'
									ELSE
									NULL
								END COST_CATEGORY,
									CASE 
									WHEN b.POSTING_FLAG = 0 THEN
									'No'
									WHEN b.POSTING_FLAG = 1 THEN
									'Yes'
									ELSE
									NULL
									END POSTING_FLAG ,
								b.SUB_PROJECT_NO,
								
								CASE 
									WHEN b.ACTIVE = 0 THEN
									'No'
									WHEN b.ACTIVE = 1 THEN
									'Yes'
									ELSE
									NULL
								END ACTIVE,
								(SELECT SUB_PROJECT_TITLE
								FROM pr_subproject
								WHERE SUB_PROJECT_NO = b.SUB_PROJECT_NO) SUB_PROJECT_TITLE	
								FROM fn_sp_achead b
								where AC_NO = '$ac_no' ");
        return $data->row();
    }

    public function get_DAExpenditureGoods($QUARTER_NO, $AC_TYPE_NO) {
        //$QUARTER_NO = $this->uri->segment(4,0);

        $data = $this->db->query("SELECT b.COST_CATEGORY,CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN 'Goods'
							   WHEN 'CS' THEN 'Consultant Services (Include Training)'
							   WHEN 'NCS' THEN 'Non Consultant Services(Include Training)'
							   WHEN 'WK' THEN 'Works'
							   WHEN 'SP' THEN 'Sub Project grant'
							   END AS PROC_TYPE_NAME,
								CONCAT(a.CONTRACT_NO,' & ',a.CONTRACT_DT) contact_no_dt,a.SELECTION_METHOD,a.CONTRACTOR_NAME,a.CONTRACT_CURR,
								a.CONTRACT_VALUE,a.AMOUNT_INVOICED,CONCAT('Inv.No. ',a.UD_VOUCHER_NO,' dt. ',a.VOUCHER_DT) invoice_no_dt,a.NARRATION,
								b.AMOUNT,(SELECT QUARTER_NAME
									FROM fn_quarter_setup
									WHERE a.QUARTER_NO = QUARTER_NO) QUARTER_NAME,
								a.QUARTER_NO,a.PACKAGE_NO
								FROM fn_accvouchermst a,fn_accvoucherchd b
								WHERE a.acvoucher_no=b.acvoucher_no
								AND b.COST_CATEGORY IS NOT NULL
								AND b.COST_CATEGORY = 'GD'
								AND b.TRX_CODE='DR'
								AND a.PACKAGE_NO <> '0'
								AND  a.PACKAGE_NO <> ''								
								AND a.AC_TYPE_NO = $AC_TYPE_NO
								AND a.QUARTER_NO = '$QUARTER_NO' ");
        return $data->result();
    }

    public function get_DAExpenditureWorks() {
        //$QUARTER_NO = $this->uri->segment(4,0);
        $QUARTER_NO = $_POST['QUARTER_NO'];
        $AC_TYPE_NO = $_POST['AC_TYPE_NO'];
        $data = $this->db->query("SELECT b.COST_CATEGORY,CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN 'Goods'
							   WHEN 'CS' THEN 'Consultant Services (Include Training)'
							   WHEN 'NCS' THEN 'Non Consultant Services(Include Training)'
							   WHEN 'WK' THEN 'Works'
							   WHEN 'SP' THEN 'Sub Project grant'
							   END AS PROC_TYPE_NAME,
								CONCAT(a.CONTRACT_NO,' & ',a.CONTRACT_DT) contact_no_dt,a.SELECTION_METHOD,a.CONTRACTOR_NAME,a.CONTRACT_CURR,
								a.CONTRACT_VALUE,a.AMOUNT_INVOICED,CONCAT('Inv.No. ',a.UD_VOUCHER_NO,' dt. ',a.VOUCHER_DT) invoice_no_dt,a.NARRATION,
								b.AMOUNT,(SELECT QUARTER_NAME
									FROM fn_quarter_setup
									WHERE a.QUARTER_NO = QUARTER_NO) QUARTER_NAME,
								a.QUARTER_NO,a.PACKAGE_NO
								FROM fn_accvouchermst a,fn_accvoucherchd b
								WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
								AND b.COST_CATEGORY IS NOT NULL
								AND b.COST_CATEGORY = 'WK'
								AND b.TRX_CODE='DR'
								AND a.PACKAGE_NO <> '0'
								AND  a.PACKAGE_NO <> ''								
								AND a.AC_TYPE_NO = $AC_TYPE_NO
								AND a.QUARTER_NO = '$QUARTER_NO' ");
        return $data->result();
    }

    public function get_DAExpenditureConsulting($QUARTER_NO, $AC_TYPE_NO) {
        //$QUARTER_NO = $this->uri->segment(4,0);
        $data = $this->db->query("SELECT b.COST_CATEGORY,CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN 'Goods'
							   WHEN 'CS' THEN 'Consultant Services (Include Training)'
							   WHEN 'NCS' THEN 'Non Consultant Services(Include Training)'
							   WHEN 'WK' THEN 'Works'
							   WHEN 'SP' THEN 'Sub Project grant'
							   END AS PROC_TYPE_NAME,
								CONCAT(a.CONTRACT_NO,' & ',a.CONTRACT_DT) contact_no_dt,a.SELECTION_METHOD,a.CONTRACTOR_NAME,a.CONTRACT_CURR,
								a.CONTRACT_VALUE,a.AMOUNT_INVOICED,CONCAT('Inv.No. ',a.UD_VOUCHER_NO,' dt. ',a.VOUCHER_DT) invoice_no_dt,a.NARRATION,
								b.AMOUNT,(SELECT QUARTER_NAME
									FROM fn_quarter_setup
									WHERE a.QUARTER_NO = QUARTER_NO) QUARTER_NAME,
								a.QUARTER_NO,a.PACKAGE_NO
								FROM fn_accvouchermst a,fn_accvoucherchd b
                                                                                                      WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
								AND b.COST_CATEGORY IS NOT NULL
								AND b.COST_CATEGORY = 'CS'
								AND b.TRX_CODE='DR'
								AND a.PACKAGE_NO <> '0'
								AND  a.PACKAGE_NO <> ''								
								AND a.AC_TYPE_NO = $AC_TYPE_NO
								AND a.QUARTER_NO = '$QUARTER_NO' ");
        return $data->result();
    }
/*
    public function get_summaryOfDesignatedAccount() {
        //$QUARTER_NO = $this->uri->segment(4,0);
        $QUARTER_NO = $_POST['QUARTER_NO'];
        $AC_TYPE_NO = $_POST['AC_TYPE_NO'];
        $data = $this->db->query("SELECT b.COST_CATEGORY, SUM(b.AMOUNT) AMOUNT,
                                                                CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN 'Goods'
                                                                WHEN 'CS' THEN 'Consultant Services (Include Training)'
                                                                WHEN 'NCS' THEN 'Non Consultant Services(Include Training)'
                                                                WHEN 'WK' THEN 'Works'
                                                                WHEN 'SP' THEN 'Sub Project grant'
                                                                WHEN 'OC' THEN 'Operating Cost'
                                                                END AS PROC_TYPE_NAME,
                                                                CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN ' Annex 2A: 1'
                                                                WHEN 'CS' THEN ' Annex 2A: 2'
                                                                WHEN 'NCS' THEN ' Annex 2A: 3'
                                                                WHEN 'WK' THEN ' Annex 2A: 4'
                                                                WHEN 'SP' THEN ' Annex 2A: 5'
                                                                WHEN 'OC' THEN ' Annex 2A: 6'
                                                                END AS Contractor_Name,
                                                                CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN '1'
                                                                WHEN 'CS' THEN '2'
                                                                WHEN 'NCS' THEN '3'
                                                                WHEN 'WK' THEN '4'
                                                                WHEN 'SP' THEN '5'
                                                                WHEN 'OC' THEN '6'
                                                                END AS sl
                                                                FROM fn_accvouchermst a,fn_accvoucherchd b
                                                                WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
                                                                AND b.COST_CATEGORY IS NOT NULL
                                                                AND b.TRX_CODE='DR'
                                                                AND a.PACKAGE_NO <> '0'
                                                                AND  a.PACKAGE_NO <> ''										
                                                                AND a.AC_TYPE_NO = $AC_TYPE_NO
                                                                AND a.QUARTER_NO = IFNULL('$QUARTER_NO','0') 
                                                                GROUP BY b.COST_CATEGORY
                                                                ORDER BY sl ");
        return $data->result();
    }
 * */
 

    public function get_usesOfFundByProjectComponents($quarter_no, $ac_type_no) {
        $data = $this->db->query("SELECT AC_NO2,AC_NAME,SUM(IDA_AMOUNT) ida,SUM(GOB_AMOUNT) gob,SUM(TOTAL_AMOUNT) tatal,fnc_ComponentWiseYearExp($ac_type_no,$quarter_no,AC_NO2) year_todate,fnc_ComponentWiseCumExp($ac_type_no,$quarter_no,AC_NO2) cum_todate
			 FROM
			 (SELECT c.AC_NO2,
						(SELECT AC_NAME FROM fn_achead  WHERE AC_NO=c.AC_NO2) ac_name,
						SUM(b.AMOUNT) ida_amount,0 GOB_AMOUNT,SUM(b.AMOUNT) total_amount
						 FROM fn_accvouchermst a,fn_accvoucherchd b, fn_achead c
					WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
					AND b.AC_NO=c.AC_NO
					AND c.AC_NO1=16    -- Here ac_no2 17 mean all ac_no under  Project WIP
					AND b.TRX_CODE='DR'
					AND a.AC_TYPE_NO=$ac_type_no
					AND NULLIF(a.QUARTER_NO,0)=$quarter_no  -- fund approve before this quarter   
					AND EXISTS (SELECT 1 FROM fn_accvoucherchd d
								WHERE b.ACVOUCHER_NO=d.ACVOUCHER_NO
								AND d.AC_NO IN (5) AND d.TRX_CODE='CR')  -- Here  all DR amount against AC_NO 5= CONTASA (STD-475),6=  Operating Account GOB(CA 3893)
						  GROUP BY c.AC_NO2
			UNION
			 SELECT c.AC_NO2,
						(SELECT AC_NAME FROM fn_achead  WHERE AC_NO=c.AC_NO2) ac_name,
						0 IDA_AMOUNT,SUM(b.AMOUNT) gob_amount,SUM(b.AMOUNT) total_amount
						 FROM fn_accvouchermst a,fn_accvoucherchd b, fn_achead c
					WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
					AND b.AC_NO=c.AC_NO
					AND c.AC_NO1=16    -- Here ac_no2 17 mean all ac_no under  Project WIP
					AND b.TRX_CODE='DR'
					AND a.AC_TYPE_NO=$ac_type_no
					AND NULLIF(a.QUARTER_NO,0)=$quarter_no  -- fund approve before this quarter   
					AND EXISTS (SELECT 1 FROM fn_accvoucherchd d
								WHERE b.ACVOUCHER_NO=d.ACVOUCHER_NO
								AND d.AC_NO IN (6) AND d.TRX_CODE='CR')  -- Here  all DR amount against AC_NO 5= CONTASA (STD-475),6=  Operating Account GOB(CA 3893)
						  GROUP BY c.AC_NO2
				 ) a     
			   GROUP BY AC_NO2");
        return $data->result();
    }

    public function get_projectCashWithdrawals($quarter_no, $ac_type_no) {
        $data = $this->db->query("SELECT b.COST_CATEGORY,
           CASE 
            WHEN b.COST_CATEGORY='SP' THEN '1'
            WHEN b.COST_CATEGORY='WK' THEN '2'
            WHEN b.COST_CATEGORY='GD' THEN '3'
            WHEN b.COST_CATEGORY='CS' THEN '4'
            WHEN b.COST_CATEGORY='NCS' THEN '5'
            WHEN b.COST_CATEGORY='OC' THEN '6'
            END cost_category_sl,            
            CASE 	
            WHEN b.COST_CATEGORY='SP' THEN 'Sub Project AIF Grant'
            WHEN b.COST_CATEGORY='WK' THEN 'Works'
            WHEN b.COST_CATEGORY='GD' THEN 'Goods'
            WHEN b.COST_CATEGORY='CS' THEN 'Consultaion services'
            WHEN b.COST_CATEGORY='NCS' THEN 'Non Consultaion services'
            WHEN b.COST_CATEGORY='OC' THEN 'Operating Cost'
            END cost_category_name,
         
            SUM(b.AMOUNT) qtr_amount,fnc_costCategoryQtrCumExp(a.AC_TYPE_NO,b.COST_CATEGORY,a.QUARTER_NO) AS cum_amount
            FROM fn_accvouchermst a,fn_accvoucherchd b
            WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
            AND b.TRX_CODE='DR'
            AND b.COST_CATEGORY !='0'
             AND a.QUARTER_NO=$quarter_no
	    AND a.AC_TYPE_NO = $ac_type_no
           GROUP BY b.COST_CATEGORY
           ORDER BY cost_category_sl
    ");
        return $data->result();
    }

    public function get_designatedAccountExpenditure() {
        $QUARTER_NO = $_POST['QUARTER_NO'];
        $AC_TYPE_NO = $_POST['AC_TYPE_NO'];

        $data = $this->db->query("SELECT b.COST_CATEGORY, SUM(b.AMOUNT) AMOUNT,
					CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN 'Goods'
					WHEN 'CS' THEN 'Consultant Services (Include Training)'
					WHEN 'NCS' THEN 'Non Consultant Services(Include Training)'
					WHEN 'WK' THEN 'Works'
					WHEN 'SP' THEN 'Sub Project grant'
					WHEN 'OC' THEN 'Operating Cost'
					END AS proc_type_name,
					
					CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN ' Annex 2A: 2'
					WHEN 'CS' THEN ' Annex 2A: 3'
					WHEN 'NCS' THEN ' Annex 2A: 4'
					WHEN 'WK' THEN ' Annex 2A: 5'
					WHEN 'SP' THEN ' Annex 2A: 1'
					WHEN 'OC' THEN ' Annex 2A: 6'
					END AS contractor_name,
					CASE UPPER(b.COST_CATEGORY) WHEN 'GD' THEN '2'
					WHEN 'CS' THEN '3'
					WHEN 'NCS' THEN '4'
					WHEN 'WK' THEN '5'
					WHEN 'SP' THEN '1'
					WHEN 'OC' THEN '6'
					END AS sl,
					
					CASE WHEN (SELECT fnc_varsityType(SUB_PROJECT_NO)
					FROM fn_achead
					WHERE AC_NO=b.AC_NO) = 'PB' THEN 'Public University'
					WHEN (SELECT fnc_varsityType(SUB_PROJECT_NO)
					FROM fn_achead
					WHERE AC_NO=b.AC_NO) = 'PR' THEN 'Private University'
					WHEN (SELECT fnc_varsityType(SUB_PROJECT_NO)
					FROM fn_achead
					WHERE AC_NO=b.AC_NO) = 'IN' THEN 'International'
					END university_type
					
					FROM fn_accvouchermst a,fn_accvoucherchd b
					WHERE a.ACVOUCHER_NO=b.ACVOUCHER_NO
					AND b.COST_CATEGORY IS NOT NULL
					AND b.TRX_CODE='DR'
					AND a.PACKAGE_NO = '0'
					AND COST_CATEGORY <> '0'
					AND a.AC_TYPE_NO = $AC_TYPE_NO
					AND a.QUARTER_NO = $QUARTER_NO
					GROUP BY b.COST_CATEGORY
					ORDER BY sl ");

        return $data->result();
    }

}
