<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_survey_response_hdr
 * @author quanhm
 */
Class T_survey_response_hdr extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_survey_response_hdr';
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

            $this->db->where("id_survey = $id ");
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

    function get_data($select = '*')
    {
        $this->db->select($select);
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        return $query;
    }

    /**
     *function get_data_by_property
     *
     *Get data by property
     * @param:
     *    param 1 : field list to take
     *    param 2 : condition
     * @return array|null
     * @author quanhm
     *
     **/
    function get_data_by_property($select, $where = array())
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

        //query
        $query = $this->db->get($this->table_name);
        //return result
        return $query->result_array();
    }

    function get_data_by_property_in_array($select, $where = array())
    {
        //validate data
        if (!is_null($where) && is_array($where)) {
            $this->db->where_in('ID_COMPANY',$where);
        } else {
            return null;
        }
        //select data
        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }
        $this->db->order_by('DT_SURVEY_COMPLETE','desc');
        //query
        $query = $this->db->get($this->table_name);
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
        $this->db->where('ID_SURVEY', $id);
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

    public function get_data_report_weekly()
    {
        $sql = "select `t_survey_response_hdr`.`int_pt`, `t_survey_response_hdr`.`dt_survey_complete`,
            `t_survey_response_hdr`.`consultant_id`, b.`nm_company`, b.`nm_designation1`, b.`n_l_revenue`,
            b.`n_local_staff`, b.`N_L_HR`, b.`N_OVERSEAS_HR`, b.`nm_industry` from `t_survey_response_hdr` join `t_company_profile` b
            on `t_survey_response_hdr`.`id_company` = b.`id_company`
             where `t_survey_response_hdr`.`tx_status` = 'Completed' and `t_survey_response_hdr`.`dt_survey_complete` between
             DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ORDER BY b.`id_company`";
        $query = $this->db->query($sql);
        if ($query->result_array()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_survey_completed($id_company = '')
    {
        $query = $this->db->query('select * from `t_survey_response_hdr` inner join `t_company_info` on `t_survey_response_hdr`.`id_company` = `t_company_info`.`nm_company` where `t_survey_response_hdr`.`tx_status` = "Completed" and `t_survey_response_hdr`.`id_company` LIKE \'%' . $id_company . '%\'');
        if ($query->result_array()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_survey_completed_limit_10($offset = null, $start = null, $name = null)
    {
        $this->db->select('*');
        $this->db->from('t_survey_response_hdr');
        $this->db->join('t_company_info', 't_survey_response_hdr.id_company = t_company_info.nm_company');
        $this->db->where('t_survey_response_hdr.tx_status', 'Completed');
        $this->db->limit($offset, $start);
        if ($name != null) {
            $this->db->like('nm_company', $name);
        }
        $st = explode('sort_', $this->sort);
        if ($st[1] == 1) {
            $st[1] = 't_company_info.ID_COMPANY';
        } elseif ($st[1] == 2) {
            $st[1] = 'NM_COMPANY';
        } else {
            $st[1] = 'NM_COMPANY';
        }
        $this->db->order_by($st[1], $st[0]);
        $this->db->order_by("t_company_info.NM_COMPANY", $this->sort);
        $query = $this->db->get();

        $data = $query->result_array();
        if (count($data) > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function get_survey_completed_limit_10_count($name = null)
    {
        $this->db->select('*');
        $this->db->from('t_survey_response_hdr');
        $this->db->join('t_company_info', 't_survey_response_hdr.id_company = t_company_info.nm_company');
        $this->db->where('t_survey_response_hdr.tx_status', 'Completed');
        if ($name != null) {
            $this->db->like('nm_company', $name);

        }
        $query = $this->db->get();
        $data = $query->result_array();
        if (count($data) > 0) {
            return count($data);
        } else {
            return 0;
        }
    }

    function count_report($data = null)
    {
        $this->db->select('t_company_info.ID_COMPANY,t_company_info.NM_COMPANY, t_survey_response_hdr.TX_STATUS, t_survey_response_hdr.ID_SURVEY');
        $this->db->where('t_company_info.ID_STATUS', 0);
        if ($data != null) {
            $this->db->like('t_company_info.NM_COMPANY', $data);
            $this->db->or_like('t_company_info.ID_COMPANY', $data);
        }
        $this->db->join('t_company_info', 't_survey_response_hdr.ID_COMPANY = t_company_info.NM_COMPANY');
        $query = $this->db->get($this->table_name);
        $data = $query->result_array();
        //return result
        if (count($data)) {
            return count($data);
        } else {
            return 0;
        }
    }

    function delete_record_by_id($id)
    {
        //validate data
        if (is_null($id)) {
            return null;
        }
        //get data by id
        $this->db->where('id_survey', $id);
        $data = array('IS_DELETED' => 1);
        //update
        $this->db->update($this->table_name, $data);
        //return result
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAVGScoreBySurvey($id_survey)
    {
        if (is_null($id_survey) || empty($id_survey)) {
            return false;
        }
        $this->load->model('t_survey_response_dtl');
        $survey_data = $this->t_survey_response_dtl->computeAvgScoreBySurvey($id_survey);
        $this->update_data_by_id($survey_data,$id_survey);
        return $survey_data;
    }
}
