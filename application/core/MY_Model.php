<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    var $table_name;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get max value by field name (eg: integer field).
     * @param unknown $field
     */
    function get_max_id($table)
    {

//        $r = $this->db->select('max(' . $field . ') as ' . $field)->from($this->table_name)->get()->row();
        $this->db->select('AUTO_INCREMENT');
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table);
        $query = $this->db->get("INFORMATION_SCHEMA.TABLES");
        $query = $query->result_array();

        return $query[0]['AUTO_INCREMENT'];
    }
    function core_get_all_data($table, $order = null)
    {
        $sql = "select * from ".$table;
        if ($order != null) {
            $sql = $sql." order by ".$order;
        }
        $query = $this->db->query($sql);
        $query = $query->result_array();
        return $query;
    }
    function core_set_data($data = array(), $table)
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }
        $this->db->insert($table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

}