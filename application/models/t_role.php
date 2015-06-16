<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_company_info
 * @author quanhm
 */
Class T_role extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_role';
    }

    function get_data_by_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_VENUE = $id LIMIT 1");
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
        $this->db->where('ID_VENUE', $id);
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

    function get_data_by_property_join($select, $where = array(), $join = array())
    {
        //validate data
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
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

    public function get_count()
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $query = $this->db->get()->result_array();
        return count($query);
    }

    public function get_data()
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
//        $this->db->order_by();
        $query = $this->db->get()->result_array();
        return ($query);
    }
}
