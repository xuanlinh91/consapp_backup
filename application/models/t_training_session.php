<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_company_info
 * @author quanhm
 */
Class T_training_session extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_training_session';
    }

    function get_data_by_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_SESSION = $id LIMIT 1");
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

    function update_data_by_id($data = array(), $id)
    {
        //validate data
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        //get data by id
        $this->db->where('ID_SESSION', $id);
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

        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    function get_data_by_property_join($select, $where = array(), $join = array())
    {
        //validate data
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
            $this->db->where('ID_STATUS !=', '2,');
            if (isset($join) && $join != null) {
                foreach ($join as $key => $value) {
                    $this->db->join($value['table'], $value['condition']);
                }
//                $this->db->join($join['table'], $join['condition']);
            }
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

    /**
     * Count total training session records
     * @param type $filter
     * @return type
     */
    public function get_count_training_session($filter = 1, $key_search = '')
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        if ($key_search != '') {
            $this->db->like('NM_SESSION', $key_search);
        }
        if ($filter == 2) {
            $this->db->where('ID_STATUS != ', '2');
        } else {
            $this->db->where('ID_STATUS', '0');
        }
        $query = $this->db->get()->result_array();
        return count($query);
    }

    public function get_data_training_session($offset = null, $start = null, $key_search = null, $filter = 1)
    {
        $sql = "select * from t_training_session where";
        $this->db->select("*");
        $this->db->from($this->table_name);
        if ($filter == 2) {
            $sql = $sql . " ID_STATUS != 2";
        } else {
            $sql = $sql . " ID_STATUS = 0";
        }
        if ($key_search != null) {
            $sql = $sql . " and (NM_SESSION like '%".$this->db->escape_like_str($key_search)."%'
                or NM_SESSION_NAME like '%".$this->db->escape_like_str($key_search)."%') ORDER BY `ID_SESSION` asc";
            if ($start != null && $start != 0) {
                $sql = $sql . " limit " . $start . ", " . $offset;

            } elseif($offset != null) {
                $sql = $sql . " limit " . $offset ;
            }
        } else {
            if ($offset != null && $start != null) {
                $sql = $sql . " limit " . $start . ", " . $offset;
            } elseif($offset != null) {
                $sql = $sql . " limit " . $offset ;
            }
        }

        $query = $this->db->query($sql)->result_array();
        return ($query);
    }

    public function get_data()
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
//        $this->db->order_by();
        $query = $this->db->get()->result_array();
        return ($query);
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
}
