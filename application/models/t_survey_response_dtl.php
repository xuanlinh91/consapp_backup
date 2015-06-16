<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage T_survey_response_dtl
 * @author quanhm
 */
Class T_survey_response_dtl extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_survey_response_dtl';
    }

    /**
     *function get_data_by_id
     *
     *Get data by id
     * @param:
     *    param 1 : field list need get
     *    param 2 : id
     * @return array|null
     * @author quanhm
     *
     **/
    function get_data_by_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("id = $id LIMIT 1");
        } else {
            return null;
        }
        //select data
        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }
        //query db
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        //return result
        return $query[0];
    }

    function get_id_answer($id = null)
    {
        //validate data
        $sql = "SELECT IN_POINT
                FROM t_survey_option WHERE ID_ANSWER IN ( SELECT ID_ANSWER FROM t_survey_response_dtl WHERE ID_SURVEY = $id)
                ORDER BY ID_QUESTION";
        return $this->db->query($sql)->result_array();
    }

    /**
     *function get_data_by_property
     *
     *Get data by property
     * @param:
     *    param 1 : field list to take
     *    param 2 : condition
     *    param 3 : order by field
     * @return array|null
     * @author quanhm
     *
     **/
    function get_data_by_property($select, $where = array(), $order_by = '')
    {
        //validate data
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
        } else {
            return null;
        }
        //select data
        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        //query
        $query = $this->db->get($this->table_name);
        //return result
        return $query->result_array();
    }

    /**
     *function set_data
     *
     *Set data t_dropdown
     * @param:
     *    param 1 : array data t_dropdown
     *    param 2 : result return condition
     * @return id_t_dropdown|object t_dropdown|null
     * @author quanhm
     *
     **/
    function set_data($data = array(), $result = 0)
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }

        //insert data
        $this->db->insert($this->table_name, $data);
        //get last id
        $id_last = $this->db->insert_id();
        //return result
        if ($result == 0) {
            return $id_last;
        } else {
            $t_dropdown = $this->get_data_by_id('*', $id_last);
            return $t_dropdown;
        }
    }

    /**
     *function update_data_by_id
     *
     *Update data t_dropdown by id
     * @param:
     *    param 1 : array data t_dropdown
     *    param 2 : id t_dropdown
     * @return true|false
     * @author quanhm
     *
     **/
    function update_data_by_id($data = array(), $id)
    {
        //validate data
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        //get data by id
        $this->db->where('id', $id);
        //update
        $this->db->update($this->table_name, $data);

        //return result
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *function update_data_by_property
     *
     *Update data t_dropdown by property
     * @param:
     *    param 1 : array data t_dropdown
     *    param 2 : condition
     * @return true|false
     * @author quanhm
     *
     **/
    function update_data_by_property($data = array(), $where = array())
    {
        //validate data
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        if (is_null($where) || !is_array($where)) {
            return null;
        }
        //get data by condition where
        $this->db->where($where);
        //update data
        $this->db->update($this->table_name, $data);
        //return result
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_matrix_by_id($id,$stage)
    {
        if (is_null($id)) {
            return null;
        }
        $this->db->select('t_survey_response_dtl.ID_SURVEY ID, t_survey_response_dtl.ID_SURVEY, t_survey_response_dtl.ID_QUESTION, t_survey_response_dtl.ID_ANSWER, t_survey_question.NM_QUESTION, ns.S_SCORE, t_survey_question.NM_CATEGORY AS ID_CATEGORY, t_survey_option.IN_POINT, t_gap_analysis_matrix.TX_DEFAULT, t_gap_analysis_matrix.TX_DEFAULT TX_RECOMMENDATION');
        $this->db->from('t_survey_question');
        $this->db->join('t_survey_response_dtl', 't_survey_question.ID_QUESTION = t_survey_response_dtl.ID_QUESTION', 'left');
        $this->db->join('t_survey_option', 't_survey_option.ID_ANSWER = t_survey_response_dtl.ID_ANSWER', 'left');
        $this->db->join('t_gap_analysis_matrix', 't_gap_analysis_matrix.IN_SCORE = t_survey_option.IN_POINT AND t_gap_analysis_matrix.ID_QUESTION = t_survey_question.ID_QUESTION ', 'left');
        $this->db->join('t_norm_scores ns', 'ns.ID_QUESTION = t_survey_question.ID_QUESTION', 'left');
        $this->db->where('t_survey_response_dtl.ID_SURVEY', $id);
        $this->db->order_by('t_survey_response_dtl.ID_QUESTION', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    function getRecommendation($question_id, $as_is, $to_be)
    {
        $this->db->select('TX_DEFAULT');
        $this->db->from('t_gap_analysis_matrix');
        $this->db->where('ID_QUESTION', $question_id);
        $this->db->where('IN_SCORE', $as_is);
        $this->db->where('TO_BE_SCORE', $to_be);
        $query = $this->db->get();
        $data = $query->result_array();
        if (count($data) > 0) {
            return $data[0]['TX_DEFAULT'];
        } else {
            return null;
        }
    }

    /**
     * Get benchmark point by Level
     * @var $level_id
     * @return Mix
     */
    public function getBenchmarkPointByLevel($level_id = 1)
    {
        if ($level_id != '5') {
            $level_id = (int) $level_id + 1;
        }
        $this->db->select('tb.ID_QUESTION,ts.IN_POINT');
        $this->db->from('t_survey_benchmark_dtl tb');
        $this->db->join('t_survey_option ts', 'tb.ID_QUESTION = ts.ID_QUESTION AND tb.ID_ANSWER = ts.ID_ANSWER', 'inner');
        $this->db->where('tb.ID_MATURITY', $level_id);
        $this->db->order_by('tb.ID_QUESTION', 'asc');
        $data = $this->db->get()->result_array();
        if (sizeof($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }
    /**
     * Get survey answer by Level
     * @var $level_id
     * @return Mix
     */
    public function getQuestionAnswerBySurvey($survey_id)
    {
        $this->db->select('tb.ID_QUESTION, ts.IN_POINT');
        $this->db->from($this->table_name.' tb');
        $this->db->join('t_survey_option ts', 'tb.ID_QUESTION = ts.ID_QUESTION AND tb.ID_ANSWER = ts.ID_ANSWER', 'inner');
        $this->db->where('ID_SURVEY', $survey_id);
        $this->db->order_by('ID_QUESTION', 'asc');
        $data = $this->db->get()->result_array();
        if (sizeof($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }
    /**
     * Compute AVG Score by Survey
     * @var $surver_id
     * @return $survey_data
     */
    public function computeAvgScoreBySurvey($survey_id)
    {
        $this->load->model('t_tracking');
        $tracking = $this->t_tracking->getActiveTrackingBySurvey($survey_id);
        $is_overseas = false;
        if (sizeof($tracking) > 0) {
            if ($tracking[0]['NM_SCOPE'] == 'Local Market') {
                $is_overseas = true;
            }
        }
        $sql = "SELECT ROUND(AVG(o.IN_POINT),1) AS AVG_CATE
                FROM t_survey_response_dtl t
                LEFT JOIN t_survey_option o ON o.ID_ANSWER = t.ID_ANSWER AND o.ID_QUESTION = t.ID_QUESTION
                WHERE t.ID_SURVEY = '$survey_id'";
        if ($is_overseas) {
                     $sql .= " AND o.ID_QUESTION NOT IN (32, 33, 34)";
                 }         
        $sql .= "GROUP BY t.NM_CATEGORY
                 ORDER BY t.ID_QUESTION ASC";
        $data = $this->db->query($sql)->result_array();
        if (sizeof($data) > 0) {
            $survey_data = array();
            foreach ($data as $key => $value) {
                $survey_data['INT_CAT'.($key + 1)] = $value['AVG_CATE'];
            }
            $total = array_sum($survey_data);
            $total_avg = round($total / sizeof($survey_data), 1, PHP_ROUND_HALF_DOWN);
            $survey_data['INT_PT'] = $total_avg;
            return $survey_data;
        } else {
            return null;
        }
    }
    public function getNoteForCategory($cate_name, $id_survey)
    {
        $this->db->select('TX_RECOMMENDATION, TX_NOTES, IN_SCORE');
        $this->db->from('t_gap_analysis_rec');
        $this->db->where('ID_CATEGORY', $cate_name);
        $this->db->where('ID_SURVEY', $id_survey);
        $this->db->order_by('ID_QUESTION', 'asc');
        $data = $this->db->get()->result_array();
        if (sizeof($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }
    function getNormScoreByCategory($cate_name)
    {
        $sql = "SELECT AVG(a.S_SCORE) CATE_NORM, b.NM_CATEGORY
                FROM t_norm_scores a
                LEFT JOIN t_survey_question b ON a.ID_QUESTION = b.ID_QUESTION
                WHERE b.NM_CATEGORY = '$cate_name'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function getListSurvey($select, $where = array(), $order_by = '')
    {
        //validate data
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
            $this->db->where_not_in('ID_ANSWER', array(137, 138, 139));
        } else {
            return null;
        }
        //select data
        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        //query
        $query = $this->db->get($this->table_name);
        //return result
        return $query->result_array();
    }
}
