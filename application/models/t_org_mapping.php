<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage user
 * @author quanhm
 */
Class T_org_mapping extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_org_mapping';
    }

    function get_data_by_id($select = '*', $id = null)
    {
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("id = $id LIMIT 1");
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
        if (count($query) > 0) {

            return $query[0];
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

        return $query->result_array();
    }

    function set_data($data = array(), $result = 0)
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }
        $this->db->insert($this->table_name, $data);
        $id_user = $this->db->insert_id();
        if ($result == 0) {

            return $id_user;
        } else {
            $user = $this->get_data_by_id('*', $id_user);

            return $user;
        }
    }

    function get_data()
    {
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query) > 0) {

            return $query;
        } else {

            return false;
        }
    }

    function update_data_by_id($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {

            return true;
        } else {

            return false;
        }
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
        if ($this->db->affected_rows() > 0) {

            return true;
        } else {

            return false;
        }
    }
}
