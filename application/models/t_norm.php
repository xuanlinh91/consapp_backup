<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_company_info
 * @author quanhm
 */
Class T_norm extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_norm_scores';
    }

    function compute_norm_score($date_start, $date_end)
    {
        $this->delete_data();
        $sql = "SELECT a.ID_QUESTION, ROUND(AVG(b.IN_POINT),1) S_SCORE
                FROM t_survey_response_dtl a
                LEFT JOIN t_survey_option b ON a.ID_QUESTION = b.ID_QUESTION AND a.ID_ANSWER = b.ID_ANSWER
                LEFT JOIN t_tracking c ON a.ID_SURVEY = c.ID_SURVEY
                LEFT JOIN t_company_profile d ON d.ID_AI = c.ID_PROFILE
                WHERE c.DT_END != '0000-00-00 00:00:00' AND c.DT_END IS NOT NULL
                AND d.ID_STATUS = '0' AND d.ID_STATUS IS NOT NULL AND c.DT_START BETWEEN '".date_time($date_start)."' AND '".date_time($date_end, 1)."'
                GROUP BY a.ID_QUESTION";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }

    function set_data($data = array())
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        $result = $this->db->insert($this->table_name, $data);
        return $result;
    }

    function get_first_data()
    {
        $sql = 'SELECT * from t_norm_scores limit 1';

        $result = $this->db->query($sql);
        return $result->result_array();

    }


    function get_norm_score($question_id)
    {
        $this->db->select('S_SCORE');
        $this->db->where('ID_QUESTION', $question_id);
        $query = $this->db->get($this->table_name)->result_array();
        $norm = (sizeof($query) > 0 ? $query['0']['S_SCORE'] : 'N/A');
        return $norm;
    }

    function delete_data()
    {
        $this->db->empty_table($this->table_name);
    }

}