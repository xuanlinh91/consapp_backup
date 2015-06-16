<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * T_User
 * Description: model manage t_company_info
 * @author quanhm
 */
Class T_participants_info extends MY_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_training_participants';
    }

    function get_data_by_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID = $id LIMIT 1");
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
        if (count($query)) {
            return $query[0];
        } else {

            return null;
        }
    }

    function get_data_by_id_join($select = '*', $id)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("t_training_participants.ID = $id LIMIT 1");
            $this->db->join('t_organisation t', 't.id = t_training_participants.ID_ORGANISATION');
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
        if (count($query)) {
            return $query[0];
        } else {
            return null;
        }
    }

    public function get_data_join($id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('t_training_participants.ID', $id);
        $query = $this->db->get();
//        return $query;
        return $this->db->last_query();
    }

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

    function update_data_by_id($data = array(), $id)
    {
        //validate data
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        //get data by id
        $this->db->where('ID', $id);
        //update
        $this->db->update($this->table_name, $data);
        //return result
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

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

    public function get_count_participants($id_session = null)
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where('DELETED', '0');

        if ($id_session != null) {
            $this->db->where('ID_SESSION', $id_session);
        }

        $query = $this->db->get()->result_array();
        return count($query);
    }

    function set_data($data = array(), $result = 0)
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        //insert data
        $this->db->insert($this->table_name, $data);
        //get last id
        $id_user = $this->db->insert_id();
        //return result
        if ($result == 0) {
            return $id_user;
        } else {
            $user = $this->get_data_by_id('*', $id_user);
            return $user;
        }
    }

    public function get_data_participants($offset = null, $start = null, $key_search = null, $training_id = 1)
    {
        $this->db->select("*");
        $this->db->from($this->table_name);

        if ($key_search != null) {
            $this->db->where('ID', $key_search);
            $this->db->where('ID_SESSION = ', $training_id);
        }
        if ($key_search != null) {
            $this->db->like('ID', $key_search);
        }
        if ($key_search == null) {
            $this->db->where('ID_SESSION = ', $training_id);
        }
        $this->db->limit($offset, $start);

        $this->db->order_by('ID', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function get_data_participants_join($offset = null, $start = null, $training_id = 1, $join = array())
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where('ID_SESSION = ', $training_id);
        $this->db->where('DELETED = ', '0');
        if (isset($join) && $join != null) {
            foreach ($join as $key => $value) {
                $this->db->join($value['table'], $value['condition']);
            }
        }
        $this->db->limit($offset, $start);

        $this->db->order_by('t_training_participants.ID', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function filter_participants($offset = null, $start = null, $agency = null, $start_date = null, $end_date = null, $txt_search = null)
    {
        $sql = "SELECT a.ID, a.NM_EMAIL, a.NM_PARTICIPANT, a.NM_ORGANISATION, DATE_FORMAT(DT_START, '%d.%m.%Y')  as DT_START, c.TX_USEREMAIL, c.ID_LOGIN
            FROM t_training_participants as a JOIN t_training_session as b ON a.ID_SESSION = b.ID_SESSION
            LEFT JOIN t_user as c ON a.NM_EMAIL = c.TX_USEREMAIL WHERE a.DELETED = 0 AND b.ID_STATUS != 2 AND (c.DT_DELETED IS NULL OR c.DT_DELETED = '0000-00-00 0000:00:00')";

        if ($agency != null) {
            $sql .= " AND a.NM_ORGANISATION = '".$agency."'";
        }

        if ($txt_search != null) {
            $sql .= " AND a.NM_PARTICIPANT LIKE '%" . $this->db->escape_like_str($txt_search) . "%'";
        }
        if ($start_date != null && $end_date != null) {
            $sql .= " AND DT_END BETWEEN '" . date_time($start_date) . "' AND '" . date_time($end_date, 1)."'";
        }

        if ($offset != null && $start != null) {
            $sql .= "LIMIT " . $start . ', ' . $offset;
        } elseif ($offset != null) {
            $sql .= "LIMIT " . $offset;
        }
        $query = $this->db->query($sql)->result_array();
        return $query;

    }


}
