<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage user
 * @author quanhm
 */
Class T_user extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_user';
    }

    /**
     *function get_data_by_id
     *
     *Get data by id
     * @param:
     *    param 1 : field list need get
     *    param 2 : id user
     * @return array|null
     * @author quanhm
     *
     **/
    function get_data_by_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where('DT_DELETED is NULL', null, false);
            $this->db->where("id_user = $id LIMIT 1");
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
        if (count($query) > 0) {
            return $query[0];
        } else {
            return null;
        }
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
        if (!is_null($where) && is_array($where)) {
            $this->db->where($where);
            $this->db->where('DT_DELETED is NULL', null, false);
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
    function get_all_data()
    {
        $sql = "SELECT *
                FROM t_user
                WHERE
                DT_DELETED = '0000-00-00 00:00:00' OR DT_DELETED IS NULL";
        return $this->db->query($sql)->result_array();
    }

    function get_list_user_by_role()
    {
        $user_data = $this->session->userdata;
        if ($user_data) {
            $sql = "SELECT DISTINCT * FROM t_user WHERE DT_DELETED IS NULL
                    AND USER_ROLE != 1";
            if ($user_data['uid']['USER_ROLE'] == ROLE_NORMAL) {
                $sql .= " AND ID_USER = '".$user_data['uid']['ID_USER']."'" ;
            } elseif ($user_data['uid']['USER_ROLE'] == ROLE_AGENCY){
                $sql .= " AND (NM_ORGANISATION IN (
                        SELECT b.NM_AGENCY
                        FROM t_user a
                        JOIN t_org_mapping b ON a.NM_ORGANISATION = b.NM_ROOT_ORG
                        WHERE a.ID_USER = '".$user_data['uid']['ID_USER']."')
                        OR NM_ORGANISATION IN (
                        SELECT b.NM_AGENCY
                        FROM t_user a
                        JOIN t_org_mapping b ON a.NM_ORGANISATION = b.NM_AGENCY
                        WHERE a.ID_USER = '".$user_data['uid']['ID_USER']."'))";
            }

            return $this->db->query($sql)->result_array();
        } else {
            return false;
        }
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
        }
    }

    function is_deleted($uid = null)
    {
        if (!is_null($uid) && is_numeric($uid)) {
            $this->db->where("id_user = $uid LIMIT 1");
        } else {

            return null;
        }
        $this->db->select("*");
        $query = $this->db->get($this->table_name);
        $result = $query->result_array();
        $result = $result[0];
        if (count($result) > 0 && ($result['DT_DELETED'] == '' || $result['DT_DELETED'] == '0000-00-00 00:00:00')) {

            return false;
        } else {

            return true;
        }
    }

    function update_data_by_id($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }
        $this->db->where('ID_USER', $id);
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

    public function get_count_user($key_search = null)
    {
        $sql = "select * from t_user where (ID_LOGIN like '%".$this->db->escape_like_str($key_search)."%' or USER_NAME
            like '%".$this->db->escape_like_str($key_search)."%') and (DT_DELETED is NULL or DT_DELETED = '0000-00-00 00:00:00')";

        $result = $this->db->query($sql);
        $result = $result->result_array();
        return count($result);
    }

    public function get_data_user($offset = null, $start = null, $key_search = null, $type = 'ID_LOGIN', $join = array())
    {
        $this->db->select("*");
        $this->db->from("t_user");
        if (isset($join) && $join != null) {
            $this->db->join($join['table'], $join['condition']);
        }
        if ($key_search != null) {
            $this->db->like('ID_LOGIN', $key_search);
            $this->db->where('DT_DELETED is NULL', null, false);
        }
        $this->db->limit($offset, $start);
        $query = $this->db->get()->result_array();

        return ($query);
    }

    public function get_data_user_not_delete($offset = null, $start = null, $key_search = null)
    {
        $sql = "SELECT * FROM t_user WHERE (DT_DELETED IS NULL OR DT_DELETED ='0000-00-00 0000:00:00')";
        if ($key_search != null) {
            $sql = $sql . " AND (ID_LOGIN LIKE '%". $this->db->escape_like_str($key_search) ."%'
                OR USER_NAME LIKE '%". $this->db->escape_like_str($key_search) ."%') ORDER BY `ID_LOGIN` asc";
            if ($start != null && $start != null) {
                $sql = $sql . " LIMIT ". $start .", ".$offset;
            } elseif($offset != null) {
                $sql = $sql . " LIMIT ". $offset;
            }

        } else {
            $sql = $sql . " LIMIT ". $start .", ".$offset;
        }

        $query = $this->db->query($sql)->result_array();

        return ($query);

    }
}
