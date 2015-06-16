<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_company_info
 * @author quanhm
 */
Class T_company_info extends MY_Model
{

    function __construct()
    {
        parent::__construct();

        $this->table_name = 't_company_info';
    }

    function get_data_by_id_join($select = '*', $id = null, $join = array())
    {
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_COMPANY_AI = $id LIMIT 1");
        } else {

            return null;
        }
        if (isset($join) && $join != null) {
            $this->db->join($join['table'], $join['condition']);
        }

        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }

        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query[0];

        } else {

            return null;
        }

    }

    function get_data_by_nm_company($select = '*', $id = null)
    {
        $this->db->where("NM_COMPANY = '" . $id . "' LIMIT 1");
        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }

        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query[0];

        } else {

            return null;
        }

    }

    function get_data_by_id($select = '*', $id = null)
    {
        if (!is_null($id)) {
            $this->db->where('ID_COMPANY_AI', $id);
        } else {
            return null;
        }
        $this->db->select($select);
        $this->db->limit(1);
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();

        if (count($query)) {

            return $query[0];

        } else {

            return null;
        }


    }

    function super_admin_get_company()
    {
        $this->db->select('t_company_info.NM_COMPANY as value, t_company_info.ID_COMPANY as data');
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;
        } else {

            return null;
        }
    }

    function get_company_json($select = '*', $id_consultant)
    {

        if ($id_consultant != null) {
            $sql = "select " . $select . " from t_company_info where ID_COMPANY_AI IN (
                  select ID_COMPANY from t_company_assignment where ID_CONSULTANT = '" . $id_consultant . "'
            )";
        } else {
            $sql = "select " . $select . " from t_company_info";
        }
        $result = $this->db->query($sql);
        return $result->result_array();;


    }

    function get_all_data($select = '*')
    {
        $this->db->select($select);
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;
        } else {

            return null;
        }
    }

    function get_data($select = '*', $id = '')
    {
        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {

            $this->db->select($select);
        }
        if ($id != null) {
            $this->db->where('ID_CONSULTANT', $id);
        }
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;
        } else {

            return null;
        }
    }

    function count_get_data_like($offset = 0, $start = 0, $data = null)
    {
        $this->db->select('t_company_info.ID_COMPANY_AI,t_company_info.ID_COMPANY,t_company_info.NM_COMPANY');
        //$this->db->where('t_company_info.ID_STATUS', 0);
        if ($data != '') {
            $this->db->like('t_company_info.NM_COMPANY', $data);
            $this->db->or_like('t_company_info.ID_COMPANY', $data);
        }
        if ($offset != null && $start != null) {
            $this->db->limit($offset, $start);
        }

        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return count($query);
        } else {

            return null;
        }
    }

    function get_data_like($offset = 0, $start = 0, $data = null)
    {
        $this->db->select('t_company_info.ID_COMPANY_AI,t_company_info.ID_COMPANY,t_company_info.NM_COMPANY');
        if ($data != '') {
            $this->db->like('t_company_info.NM_COMPANY', $data);
            $this->db->or_like('t_company_info.ID_COMPANY', $data);
        }
        if ($offset != null && $start != null) {
            $this->db->limit($offset, $start);
        } elseif($offset != null) {
            $this->db->limit($offset, $start);
        }
        $this->db->order_by('t_company_info.ID_COMPANY', 'asc');
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;
        } else {

            return null;
        }
    }

    function get_data_like_restricted($offset = null, $start = null, $id, $data = null)
    {
        $this->db->select('t_company_info.ID_COMPANY_AI,t_company_info.ID_COMPANY,t_company_info.NM_COMPANY');
        $this->db->where('t_company_assignment.ID_CONSULTANT', $id);
        if ($data != null) {
            $this->db->like('(t_company_info.NM_COMPANY', $data);
            $this->db->or_like("t_company_info.ID_COMPANY LIKE " . "'" . "%" . $this->db->escape_like_str($data) . "%" . "'" . ")--");
        }

        $this->db->join('t_company_assignment', 't_company_assignment.ID_COMPANY = t_company_info.ID_COMPANY_AI');
        if ($offset != null && $start != null) {
            $this->db->limit($offset, $start);
        } elseif($offset != null) {
            $this->db->limit($offset);
        }
        $this->db->order_by('t_company_info.ID_COMPANY', 'asc');
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;
        } else {

            return null;
        }
    }

    function agency_get_mapped_company($id = null)
    {
        if ($id != null) {
            $sql = "select ID_COMPANY_AI, ID_COMPANY, NM_COMPANY from t_company_info where ID_COMPANY_AI in (select ID_COMPANY from t_company_assignment where
            ID_CONSULTANT in (select ID_USER from t_user where NM_ORGANISATION IN (select NM_ROOT_ORG from t_org_mapping where NM_AGENCY = (select NM_ORGANISATION from t_user where
                ID_USER =" . $id . " )) ) )";
        }

        $result = $this->db->query($sql);
        return $result->result_array();
    }


    function user_get_company_external($id)
    {
        if ($id != null) {
            //$sql = "select ID_COMPANY_AI, ID_COMPANY, NM_COMPANY from t_company_info where ID_COMPANY_AI in (select ID_COMPANY from t_company_assignment where ID_CONSULTANT = " . $id . " ) and ID_STATUS = 0";
            $sql = "select ID_COMPANY_AI, ID_COMPANY, NM_COMPANY from t_company_info where ID_COMPANY_AI in (select ID_COMPANY from t_company_assignment where ID_CONSULTANT = " . $id . " )";

        }

        $result = $this->db->query($sql);

        return $result->result_array();
    }

    function restricted_get_company_suggess($id)
    {
        if ($id != null) {
            $sql = "select ID_COMPANY value, NM_COMPANY data from t_company_info where ID_COMPANY_AI in (select ID_COMPANY from t_company_assignment where ID_CONSULTANT = " . $id . " )";
        }
        $result = $this->db->query($sql);

        return $result->result_array();
    }

    function restricted_get_company($id)
    {
        if ($id != null) {
            $sql = "select ID_COMPANY, ID_COMPANY_AI, NM_COMPANY from t_company_info where ID_COMPANY_AI in (select ID_COMPANY from t_company_assignment where ID_CONSULTANT = " . $id . " )";
        }
        $result = $this->db->query($sql);

        return $result->result_array();
    }

    function get_company_consultant($offset = null, $start = null, $id)
    {

        $this->db->select('t_company_assignment.ID_CONSULTANT, t_company_info.ID_COMPANY_AI, t_company_info.ID_COMPANY,
        t_company_info.NM_COMPANY');
        $this->db->where('t_company_assignment.ID_CONSULTANT', $id);
        $this->db->join('t_company_assignment', 't_company_assignment.ID_COMPANY = t_company_info.ID_COMPANY_AI');
        if ($offset != null && $start != null) {
            $this->db->limit($offset, $start);
        }

        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;
        } else {

            return null;
        }
    }

    function get_data_by_property($select, $where = array())
    {
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
        } else {

            return null;
        }

        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }

        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query[0];

        } else {

            return null;
        }

    }
    function get_data_by_property_for_engage($select, $where = array())
    {
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
        } else {

            return null;
        }

        if (strcmp($select, '*') != 0) {
            $this->db->select($select);
        } else {
            $this->db->select();
        }

        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query)) {

            return $query;

        } else {

            return null;
        }

    }


    function set_data($data = array(), $result = 0)
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }

        $this->db->insert($this->table_name, $data);
        $id_last = $this->db->insert_id();
        if ($result == 0) {

            return $id_last;

        } else {
            $t_company_info = $this->get_data_by_id('*', $id_last);

            return $t_company_info;
        }
    }

    function update_data_by_id($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }

        $this->db->where('id_company', $id);
        $this->db->update($this->table_name, $data);

        return true;
    }

    function update_data_by_property($data = array(), $where = array())
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }

        if (is_null($where) || !is_array($where)) {

            return null;
        }

        $this->db->where($where);
        $this->db->update($this->table_name, $data);

        return true;

    }

    public function get_data_by_id_login($offset = null, $start = null, $search, $group = null)
    {
        $this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
        $this->db->from($this->table_name);
        $this->db->join('t_survey_response_hdr', "$this->table_name.nm_company = t_survey_response_hdr.id_company", 'left');
        if ($group != null) {
            $this->db->where(array('NM_COMPANY LIKE' => '%' . $search . '%', 'ID_CONSULTANT_ORG' => $group, 'TX_STATUS' => 'Completed'));
        } else {
            $this->db->where(array('NM_COMPANY LIKE' => '%' . $search . '%', 'TX_STATUS' => 'Completed'));
        }

        if ($offset != null) {
            $this->db->limit($offset, $start);
        }

        $st = explode('sort_', $this->sort);
        if ($st[1] == 1) {
            $st[1] = '`t_company_info`.`ID_COMPANY`';
        } elseif ($st[1] == 2) {
            $st[1] = '`t_company_info`.`NM_COMPANY`';
        } elseif ($st[1] == 3) {
            $st[1] = '`t_company_info`.`NM_DESIGNATION`';
        } elseif ($st[1] == 4) {
            $st[1] = '`t_company_info`.`N_REVENUE`';
        } elseif ($st[1] == 5) {
            $st[1] = '`t_company_info`.`N_STAFF_SIZE`';
        } elseif ($st[1] == 6) {
            $st[1] = '`t_company_info`.`N_HR_SIZE`';
        } elseif ($st[1] == 7) {
            $st[1] = '`t_company_info`.`NM_INDUSTRY`';
        } elseif ($st[1] == 8) {
            $st[1] = '`t_survey_response_hdr`.`INT_PT`';
        } elseif ($st[1] == 9) {
            $st[1] = '`t_survey_response_hdr`.`DT_SURVEY_COMPLETE`';
        } elseif ($st[1] == 10) {
            $st[1] = '`t_company_info`.`ID_CONSULTANT`';
        } else {
            $st[1] = '`t_company_info`.`NM_COMPANY`';
        }

        $this->db->order_by($st[1], $st[0]);
        $query = $this->db->get();
        $query = $query->result_array();
        if (count($query) > 0) {

            return $query;
        } else {

            return null;
        }
    }

    public function get_survey_by_id_login($id_login = '')
    {
        $this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
        $this->db->from($this->table_name);
        $this->db->join('t_survey_response_hdr', "$this->table_name.nm_company = t_survey_response_hdr.id_company", 'left');
        $this->db->where(array('NM_COMPANY' => $id_login));
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_data_to_update_survey($nm_company = '', $id_company = '')
    {
        if (!empty($nm_company) && !empty($id_company)) {
            $this->db->select('*');
            $this->db->from($this->table_name);
            $this->db->where("nm_company = '$nm_company'");
            $query = $this->db->get();
            $query = $query->result_array();
            $array['T_COMPANY'] = $query;
            // GET MATURITY
            $this->db->select('INT_PT,DT_SURVEY_COMPLETE,TX_STATUS');
            $this->db->from('t_survey_response_hdr');
            $this->db->where(array('id_company' => $nm_company));
            $query = $this->db->get();
            $query = $query->result_array();
            $array['T_SURVEY_RESPONSE_HDR'] = $query;
            //GET DROPDOWN
            $this->db->select('*');
            $this->db->from('t_dropdown');
            $this->db->where("t_dropdown.ID_DROPDOWN IN
				(SELECT NM_INDUSTRY  FROM  t_company_info WHERE t_company_info.ID_COMPANY = $id_company ) 
				 OR t_dropdown.ID_DROPDOWN IN 
				 (SELECT NM_TYPE  FROM  t_company_info WHERE t_company_info.ID_COMPANY = $id_company ) 
				 OR t_dropdown.ID_DROPDOWN IN 
				 (SELECT N_REVENUE  FROM  t_company_info WHERE t_company_info.ID_COMPANY = $id_company )
				  OR t_dropdown.ID_DROPDOWN IN 
				 (SELECT N_STAFF_SIZE  FROM  t_company_info WHERE t_company_info.ID_COMPANY = $id_company )
				 OR t_dropdown.ID_DROPDOWN IN 
				 (SELECT N_HR_SIZE  FROM  t_company_info WHERE t_company_info.ID_COMPANY = $id_company )
				 ");

            $query = $this->db->get();
            $query = $query->result_array();
            $array['T_DROPDOWN'] = $query;

            return $array;
        } else {
            return null;
        }
    }

    public function get_data_company_info()
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->limit(10);
        $query = $this->db->get();
        $query = $query->result_array();
        if (count($query) > 0) {

            return $query;
        } else {

            return null;
        }
    }

    public function get_data_by_id_login_start($search = null, $group = '')
    {
        $this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
        $this->db->from($this->table_name);
        $this->db->join('t_survey_response_hdr', "$this->table_name.nm_company = t_survey_response_hdr.id_company", 'left');
        if ($group) {
            $this->db->where(array('ID_CONSULTANT_ORG' => $group));
        }

        $this->db->limit(10);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_data_start($org = '')
    {
        $this->db->select('*');
        $this->db->from('t_company_info');
        if (!empty($org)) {
            $this->db->where(array('ID_CONSULTANT_ORG' => $org));
        }

        $this->db->limit(10);
        $query = $this->db->get();
        $query = $query->result_array();
        if (count($query) > 0) {

            return $query;
        } else {

            return null;
        }
    }

    public function get_data_start_update_survey($group = null)
    {
        $this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
        $this->table_name = "t_company_info";
        $this->db->from($this->table_name);
        $this->db->join('t_survey_response_hdr', "$this->table_name.nm_company = t_survey_response_hdr.id_company", 'left');
        if ($group) {
            $this->db->where(array('ID_CONSULTANT_ORG' => $group));
        }

        $this->db->limit(10);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_count_company($key_search = null, $org = null)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        if ($org != null) {
            $this->db->where('ID_CONSULTANT', $org);
        }

//        $this->db->where('ID_STATUS', '0');
        if ($key_search != null) {
            $this->db->like('NM_COMPANY', $key_search);
        }
        $query = $this->db->get()->result_array();
        echo $this->db->last_query();exit;
        return count($query);
    }


    public function get_assigned_company($offset = null, $start = null, $key_search = null, $org = null)
    {
        $last_query = "select * from t_company_info where ID_COMPANY_AI IN (
                  select ID_COMPANY from t_company_assignment where ID_CONSULTANT = '" . $org . "'
        )";

        if ($key_search != null) {
            $last_query = $last_query . " AND (ID_COMPANY LIKE '%" . mysql_real_escape_string($key_search) . "%' OR NM_COMPANY LIKE '%" . mysql_real_escape_string($key_search) . "%')";
        }

        if ($start != null && $start != 0 && !is_null($offset)) {
            $last_query = $last_query . "ORDER BY `DATE_CREATION` desc LIMIT " . $offset . ", " . $start;
        } elseif($offset != null) {
            $last_query = $last_query . "ORDER BY `DATE_CREATION` desc LIMIT ".$offset;
        }

        $result = $this->db->query($last_query);

        return $result->result_array();
    }

    public function get_assigned_company_info($org = null)
    {
        $last_query = "select * from t_company_info where ID_COMPANY_AI IN (
                  select ID_COMPANY from t_company_assignment where ID_CONSULTANT = '" . $org . "'
        )";

        $result = $this->db->query($last_query);

        return $result->result_array();
    }

    public function get_data_company($offset = null, $start = null , $key_search = null)
    {
        $last_query = "select * from t_company_info ";
        if ($key_search != null) {
            $last_query = $last_query . " WHERE ID_COMPANY LIKE '%" . mysql_real_escape_string($key_search) . "%' OR NM_COMPANY LIKE '%" . mysql_real_escape_string($key_search) . "%'";

            if ($start != null && $offset != null) {
                $last_query = $last_query . " ORDER BY DATE_CREATION desc LIMIT " . $start . ", " . $offset;
            } elseif($offset != null) {
                $last_query = $last_query . " ORDER BY DATE_CREATION desc LIMIT " . $offset;
            }
        } elseif($start != null && $offset != null) {

            $last_query = $last_query . " ORDER BY DATE_CREATION desc LIMIT " . $start . "," . $offset;
        } elseif ($offset != null) {

            $last_query = $last_query . " ORDER BY DATE_CREATION desc LIMIT " . $offset;
        }

        $query = $this->db->query($last_query);

        return ($query->result_array());
    }

    public function get_survey_to_take($offset = null, $start = null, $key_search = null, $org = null)
    {
        $this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
        $this->db->from('t_company_info');
        $this->db->join('t_survey_response_hdr', "t_company_info.nm_company = t_survey_response_hdr.id_company", 'left');

        if ($org != null) {
            $this->db->where('ID_CONSULTANT_ORG', $org);
        }

        if ($key_search != null) {
            $this->db->like('NM_COMPANY', $key_search);
        }

        $this->db->limit($offset, $start);
        $st = explode('sort_', $this->sort);

        if ($st[1] == 1) {
            $st[1] = 'ID_COMPANY';
        } elseif ($st[1] == 2) {
            $st[1] = 'NM_COMPANY';

        } elseif ($st[1] == 3) {
            $st[1] = '`t_survey_response_hdr`.`TX_STATUS`';
        } else {
            $st[1] = 'NM_COMPANY';
        }

        $this->db->order_by($st[1], $st[0]);
        $query = $this->db->get();
        $query = $query->result_array();
        if (count($query) > 0) {

            return $query;
        } else {

            return null;
        }
    }

    public function remove($id)
    {
        $this->db->delete($this->table_name, array('ID_COMPANY' => $id));
    }

    /**
     * @param $user_id
     * @param $company_id
     */
    public function insert_data()
    {
        $date = date("Y-m-d H:i:s");
        for($i = 0; $i <5000; $i++){

            $sql = "INSERT INTO t_company_info (`ID_COMPANY`, `NM_COMPANY`, `NM_RESPONDENT`, `NM_DESIGNATION`,
            `ID_CONSULTANT`, `ID_CONSULTANT_ORG`, `DATE_CREATION`) VALUES ('ID_COMPANY_".$i."', 'NM_COMPANY_".$i."',
            'NM_RESPONDENT_".$i."', 'NM_DESIGNATION_".$i."', 'ADMINISTRATOR', 'Organisation B', '".$date."')";
            $this->db->query($sql);
        }

        return true;
    }


}
