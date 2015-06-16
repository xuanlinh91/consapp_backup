<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_survey_benchmark_dtl
 * @author quanhm
 */
Class MReport extends MY_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_category()
    {
        $this->db->distinct();
        $this->db->select('NM_CATEGORY');
        $this->table_name = "t_survey_question";
        $this->db->order_by("ID_QUESTION", "asc");
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        return $query;

    }

    public function get_point_blue($id_survey = 0)
    {
        $this->db->select('*');
        $this->table_name = "t_survey_response_dtl";

        $this->db->where("ID_SURVEY = $id_survey");
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {
            return $query;
        }
        return null;

    }

    public function get_point_red($id_gs1 = 0)
    {
        if ($id_gs1 == 0) {
            return null;
        }
        if($id_gs1 != '5') {
            $id_gs1 += 1;
        }
        $this->db->select('*');
        $this->table_name = "t_survey_benchmark_dtl INNER JOIN t_survey_option ON t_survey_benchmark_dtl.ID_ANSWER = t_survey_option.ID_ANSWER AND  t_survey_benchmark_dtl.ID_QUESTION = t_survey_option.ID_QUESTION";

        $this->db->where("t_survey_benchmark_dtl.ID_MATURITY = $id_gs1");
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();

        if (count($query)) {
            return $query;
        }
        return null;
    }

    function get_data_by_id($id_company = null, $id_survey = null)
    {
        if (is_null($id_company) || is_null($id_survey)) {
            return null;
        } else {
            // GET 34 ANSWER
            // IMPORTAN 'IN_POINT'

            $this->db->select('*');
            $this->table_name = "t_survey_response_dtl INNER JOIN t_survey_option ON t_survey_response_dtl.ID_ANSWER = t_survey_option.ID_ANSWER ";

            $this->db->where("t_survey_response_dtl.ID_SURVEY = $id_survey");
            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['DRAW_ANSWER'] = $query;

            // GET COMPANY_INFO

            $this->db->select('*');
            $this->table_name = "t_company_profile tp";
            $this->db->join('t_company_info', 't_company_info.ID_COMPANY = tp.ID_COMPANY');
            $this->db->where('t_company_info.ID_COMPANY_AI', $id_company);
            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['COMPANY_INFO'] = $query;
            $id_gs1 = $query[0]['ID_GS1'];

            // GET VALUE FOR INDUSTRY
            $this->db->select('tp.NM_INDUSTRY, tp.NM_TYPE, tp.N_L_REVENUE AS N_REVENUE, tp.N_LOCAL_STAFF AS N_STAFF_SIZE, tp.N_L_HR AS N_HR_SIZE');
            $this->table_name = "t_company_profile tp";
            $this->db->where('t_company_info.ID_COMPANY_AI', $id_company);
            $this->db->join('t_company_info', 't_company_info.ID_COMPANY = tp.ID_COMPANY');
            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['T_DROPDOWN'] = $query;

            // GET 34 BENCHMARK
            // IMPORTAN 'IN_POINT'
            // DEPEND ON 'ID_MATURITY' ( TERMS JOIN )  T_COMPANY_INFO.'ID_GS1'
            $next_level = $id_gs1;
            if ($id_gs1 != '5') {
                $next_level = (int) $id_gs1 + 1;
            }
            $this->db->select('*');
            $this->table_name = "t_survey_benchmark_dtl INNER JOIN t_survey_option ON t_survey_benchmark_dtl.ID_ANSWER = t_survey_option.ID_ANSWER AND  t_survey_benchmark_dtl.ID_QUESTION = t_survey_option.ID_QUESTION";

            $this->db->where("t_survey_benchmark_dtl.ID_MATURITY = '$next_level'");
            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['DRAW_BENCHMARK'] = $query;
            // GET TABLE T_SURVEY_RESPONSE_HDR

            $this->db->select('INT_PT');
            $this->table_name = "t_survey_response_hdr";
            $this->db->where("ID_SURVEY = $id_survey");
            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $id_gs1 = (float)$query[0]['INT_PT'];
            if ($id_gs1 < 2) {
                $level = 1;
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("INT_PT < 2");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $array['TOTAL_CURRENT'] = $query;
            } else if ($id_gs1 < 3) {
                $level = 2;
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("INT_PT < 3 AND INT_PT >= 2");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $array['TOTAL_CURRENT'] = $query;
            } else if ($id_gs1 < 4) {
                $level = 3;
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("INT_PT < 4 AND INT_PT >= 3");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $array['TOTAL_CURRENT'] = $query;
            } else {
                $level = 4;
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("INT_PT >= 4");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $array['TOTAL_CURRENT'] = $query;
            }
            $this->db->select('SUM(INT_PT) , DT_SURVEY_COMPLETE, DT_SURVEY_START ');
            $this->db->where("ID_SURVEY = $id_survey");
            $this->table_name = "t_survey_response_hdr";

            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['TOTAL'] = $query;
            $array['HRMM_LEVEL'] = $level;

            // GET INT_CAT

            $this->db->select('INT_CAT1,INT_CAT2,INT_CAT3,INT_CAT4,INT_CAT5,INT_CAT6,INT_CAT7,INT_CAT8,INT_CAT9,INT_CAT10,INT_CAT11,INT_PT');
            $this->table_name = "t_survey_response_hdr";
            $this->db->where("ID_SURVEY = $id_survey");

            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['POINT'] = $query;

            /* GET GAP RECOMMENDATION */

            $this->db->select('gr.ID_QUESTION, gr.TX_RECOMMENDATION, sq.NM_QUESTION, gr.TX_NOTES, gr.ID_CATEGORY');
            $this->table_name = "t_gap_analysis_rec gr";
            $this->db->where('gr.ID_SURVEY', $id_survey);
            $this->db->join('t_survey_question sq', 'sq.ID_QUESTION = gr.ID_QUESTION');
            $query = $this->db->get($this->table_name);
            $query = $query->result_array();
            $array['GAP_RECOMMENDATION'] = $query;

            return $array;
        }
    }

    public function get_data_pie_char($id_survey = '', $id_company = '')
    {
        if (!empty($id_survey) && !empty($id_company)) {
            $this->db->select('SUM(INT_PT)');
            $this->table_name = "t_survey_response_hdr";
            $this->db->where("TX_STATUS = 'Completed'");
            $query = $this->db->get($this->table_name);
            $data['ALL'] = $query->result_array();
            $this->db->select('INT_PT');
            $this->table_name = "t_survey_response_hdr";
            $this->db->where("ID_SURVEY = $id_survey AND ID_COMPANY = '$id_company' AND TX_STATUS = 'Completed'");
            $query = $this->db->get($this->table_name);
            $data['CURRENT'] = $query->result_array();
            if ($data['CURRENT'][0]['INT_PT'] <= 1.9) {
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT <= 1.9 ");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT <= 2.9 AND INT_PT >= 2 ");
                $query_next = $this->db->get($this->table_name);
                $query_next = $query_next->result_array();

            } elseif ($data['CURRENT'][0]['INT_PT'] <= 2.9) {

                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT <= 2.9 AND INT_PT >= 2  ");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT <= 3.9 AND INT_PT >= 3  ");
                $query_next = $this->db->get($this->table_name);
                $query_next = $query_next->result_array();
            } elseif ($data['CURRENT'][0]['INT_PT'] <= 3.9) {

                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT <= 3.9 AND INT_PT >= 3  ");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT = 4  ");
                $query_next = $this->db->get($this->table_name);
                $query_next = $query_next->result_array();
            } else {

                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT = 4  ");
                $query = $this->db->get($this->table_name);
                $query = $query->result_array();
                $this->db->select('SUM(INT_PT)');
                $this->table_name = "t_survey_response_hdr";

                $this->db->where("TX_STATUS = 'Completed' AND INT_PT > 4  ");
                $query_next = $this->db->get($this->table_name);
                $query_next = $query_next->result_array();
            }

            if (empty($query_next[0]['SUM(INT_PT)'])) {
                $query_next[0]['SUM(INT_PT)'] = 0;
            }
            $data['ALL_CURRENT'] = $query[0]['SUM(INT_PT)'];
            $data['ALL_NEXT'] = $query_next[0]['SUM(INT_PT)'];
            if (count($data)) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_full_question()
    {
        $this->db->select('NM_QUESTION');
        $this->db->from('t_survey_question');
        $this->db->order_by("ID_QUESTION", "asc");
        $query = $this->db->get();
        $query = $query->result_array();
        if (count($query) > 0) {
            return $query;
        } else {
            return null;
        }
    }
    // public function get_data_pie_char_new($id_survey = null, $id_company = null)
    // {
    // 	if($id_survey == null || $id_company == null)
    // 	{
    // 		return null;
    // 	}
    // 	$this->db->select('COUNT(INT_PT)');
    // 	$this->table_name = "t_survey_response_hdr";
    // 	$this->db->from('t_survey_response_hdr');
    // 	$this->db->where(array('TX_STATUS' => 'Completed' , 'ID_SURVEY'=> $id_survey));
    // 	$query= $this->db->get();
    // 	$query = $query->result_array();
    // 	$data['ALL'] = $query[0];
    // 	$this->db->select('COUNT(INT_PT)');
    // 	$this->table_name = "t_survey_response_hdr";
    // 	$this->db->where('INT_PT < 2 AND TX_STATUS = "Completed"');
    // 	$this->db->from('t_survey_response_hdr');
    // 	$query= $this->db->get();
    // 	$query = $query->result_array();
    // 	$data['LVI'] = $query[0];
    // 	$this->db->select('COUNT(INT_PT)');
    // 	$this->table_name = "t_survey_response_hdr";
    // 	$this->db->where('INT_PT >= 2 AND INT_PT < 3 AND TX_STATUS = "Completed"');
    // 	$this->db->from('t_survey_response_hdr');
    // 	$query= $this->db->get();
    // 	$query = $query->result_array();
    // 	$data['LVII'] = $query[0];
    // 	$this->db->select('COUNT(INT_PT)');
    // 	$this->table_name = "t_survey_response_hdr";
    // 	$this->db->where('INT_PT >= 3 AND INT_PT < 4 AND TX_STATUS = "Completed"');
    // 	$this->db->from('t_survey_response_hdr');
    // 	$query= $this->db->get();
    // 	$query = $query->result_array();
    // 	$data['LVIII'] = $query[0];
    // 	$this->db->select('COUNT(INT_PT)');
    // 	$this->table_name = "t_survey_response_hdr";
    // 	$this->db->where('INT_PT = 4 AND TX_STATUS = "Completed"');
    // 	$this->db->from('t_survey_response_hdr');
    // 	$query= $this->db->get();
    // 	$query = $query->result_array();
    // 	$data['LVIV'] = $query[0];
    // 	if($data['ALL']['COUNT(INT_PT)'] == null)
    // 	{
    // 		$data['ALL']['COUNT(INT_PT)'] = 0;
    // 	}
    // 	if($data['LVI']['COUNT(INT_PT)'] == null)
    // 	{
    // 		$data['LVI']['COUNT(INT_PT)'] = 0;
    // 	}
    // 	if($data['LVII']['COUNT(INT_PT)'] == null)
    // 	{
    // 		$data['LVII']['COUNT(INT_PT)'] = 0;
    // 	}
    // 	if($data['LVIII']['COUNT(INT_PT)'] == null)
    // 	{
    // 		$data['LVIII']['COUNT(INT_PT)'] = 0;
    // 	}
    // 	if($data['LVIV']['COUNT(INT_PT)'] == null)
    // 	{
    // 		$data['LVIV']['COUNT(INT_PT)'] = 0;
    // 	}
    // 	return $data;
    // }
    public function get_data_pie_char_new($id_survey = null, $id_company = null)
    {
        if ($id_survey == null || $id_company == null) {
            return null;
        }
        $data['ALL'] = 11;
        $this->db->select('*');
        $this->table_name = "t_survey_response_hdr";
        $this->db->where("ID_SURVEY = $id_survey AND TX_STATUS = 'Completed'");
        $this->db->from('t_survey_response_hdr');
        $query = $this->db->get();
        $query = $query->result_array();
        $data['DATA'] = $query[0];
        $lv_1 = $lv_2 = $lv_3 = $lv_4 = 0;
        for ($i = 1; $i <= 11; $i++) {
            if ($data['DATA']["INT_CAT$i"] < 2) {
                $lv_1 += 1;
            } else if ($data['DATA']["INT_CAT$i"] < 3) {
                $lv_2 += 1;
            } else if ($data['DATA']["INT_CAT$i"] < 4) {
                $lv_3 += 1;
            } else {
                $lv_4 += 1;
            }
        }
        $data['DATA_1'] = $lv_1;
        $data['DATA_2'] = $lv_2;
        $data['DATA_3'] = $lv_3;
        $data['DATA_4'] = $lv_4;
        return $data;
    }
}
