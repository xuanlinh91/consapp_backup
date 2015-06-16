<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_company_assignment
 *Description: model manage company assignment
 * @author huytv
 */
Class T_company_assignment extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_company_assignment';
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
            $t_company_assignment = $this->get_data_by_id('*', $id_last);
            return $t_company_assignment;
        }
    }

    function get_list_dropdown($id_company, $id_user)
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->join('t_user','t_company_assignment.ID_CONSULTANT = t_user.ID_USER');
        if ($id_user == '') {
            $this->db->where('ID_COMPANY', $id_company);
        } else {
            $array = array('ID_COMPANY' => $id_company, 'ID_CONSULTANT' => $id_user);
            $this->db->where($array);
        }
        $this->db->order_by('ID_PRIMARY', "desc");
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();

        if (count($query)) {
            return $query;
        } else {

            return null;
        }
    }

    function get_lead_officer($id_company = null)
    {
        if ($id_company != null) {
            $this->db->select('*');
            $this->db->where('ID_COMPANY', $id_company);
            $this->db->where('ID_PRIMARY', 1);
            $this->db->join('t_user', 't_company_assignment.ID_CONSULTANT = t_user.ID_USER');
            $result = $this->db->get($this->table_name);
            $result = $result->result_array();
            if (count($result) > 0) {
                return $result[0];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_data_by_id($select = '*', $id = null)
    {
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_COMPANY = $id");
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

    function get_data_to_generate($id = null, $officer1 = null, $officer2 = null)
    {
        $sql = "select u.USER_NAME, u.NM_ORGANISATION, asm.ID_PRIMARY
                FROM t_company_assignment asm
                JOIN t_user u ON u.ID_USER = asm.ID_CONSULTANT
                JOIN t_company_info info ON info.ID_COMPANY_AI = asm.ID_COMPANY
                where info.ID_COMPANY = '$id' AND asm.ID_PRIMARY = '1'";

        if ($officer1 != '') {
            if ($officer2 != '') {
                $sql .= " AND (u.USER_NAME like '%" . $officer1 . "%' OR u.USER_NAME like '%" . $officer2 . "%')";
            } else {
                $sql .= " AND u.USER_NAME like '%" . $officer1 . "%'";
            }
        } else {
            if ($officer2 != '') {
                $sql .= " AND u.USER_NAME like '%" . $officer2 . "%'";
            }
        }

        $officer_check = $this->db->query($sql)->result_array();

        // check whether company $id has officer or not
        if (count($officer_check) > 0) {
            $sql_all = "select u.USER_NAME, u.NM_ORGANISATION, asm.ID_PRIMARY
                FROM t_company_assignment asm
                JOIN t_user u ON u.ID_USER = asm.ID_CONSULTANT
                JOIN t_company_info info ON info.ID_COMPANY_AI = asm.ID_COMPANY
                where info.ID_COMPANY = '$id'
                ORDER BY asm.ID_PRIMARY DESC";

            return $this->db->query($sql_all)->result_array();
        } else {
            return FALSE;
        }

    }

    function check_leader($id = null, $officer1 = null, $officer2 = null)
    {
        $temp = "select u.USER_NAME, u.NM_ORGANISATION, asm.ID_PRIMARY
                FROM t_company_assignment asm
                JOIN t_user u ON u.ID_USER = asm.ID_CONSULTANT
                JOIN t_company_info info ON info.ID_COMPANY_AI = asm.ID_COMPANY
                where info.ID_COMPANY = '$id'";

        if ($officer1 == '') {
            if ($officer2 == '') {
                $sql = $temp . " ORDER BY ID_PRIMARY DESC ";
            } else {
                $sql = $temp . " AND u.ID_USER = '$officer2' AND asm.ID_PRIMARY != 1";
                $query = $this->db->query($sql)->result_array();
                if (count($query) > 0) {
                    $sql = $temp . " ORDER BY ID_PRIMARY DESC ";
                } else
                    $sql = '';
            }
        } else {
            if ($officer2 == '') {
                $sql = $temp . " AND u.ID_USER = '$officer1' AND asm.ID_PRIMARY = 1 ";
                $query = $this->db->query($sql)->result_array();
                if (count($query) > 0) {
                    $sql = $temp . " ORDER BY ID_PRIMARY DESC ";
                } else
                    $sql = '';
            } else {
                $sql = $temp . " AND u.ID_USER = '$officer1' AND asm.ID_PRIMARY = 1 ";
                $query = $this->db->query($sql)->result_array();
                if (count($query) > 0) {
                    $sql = $temp . " AND u.ID_USER = '$officer2' AND asm.ID_PRIMARY != 1 ";
                    $query = $this->db->query($sql)->result_array();
                    if (count($query) > 0) {
                        $sql = $temp . " ORDER BY ID_PRIMARY DESC ";
                    } else
                        $sql = '';
                } else
                    $sql = '';
            }
        }
        if ($sql == '') {
            return FALSE;
        } else {
            return $this->db->query($sql)->result_array();
        }
    }



    function get_data_to_filter($id = null)
    {
        $sql = "select u.USER_NAME, u.NM_ORGANISATION
                FROM t_company_assignment asm
                JOIN t_user u ON u.ID_USER = asm.ID_CONSULTANT
                JOIN t_company_info info ON info.ID_COMPANY_AI = asm.ID_COMPANY
                where info.ID_COMPANY = '$id' ORDER BY asm.ID_PRIMARY DESC LIMIT 0,2";

        return $this->db->query($sql)->result_array();
    }

    function get_data_by_property($select = '*', $where = array())
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

    public function get_count_company($key_search = null, $org = null)
    {
        $last_query = "select * from t_company_info ";
        if ($key_search != null) {
            $last_query = $last_query . " WHERE (ID_COMPANY LIKE '%" . mysql_real_escape_string($key_search) . "%' OR NM_COMPANY LIKE
                '%" . mysql_real_escape_string($key_search) . "%') AND ID_CONSULTANT = " . $org;
        } else {
            $last_query = $last_query . " WHERE ID_CONSULTANT = " . $org;
        }
        $query = $this->db->query($last_query);

        $query->result_array();
        return count($query);

    }

    public function get_data_company($offset = null, $start = null, $key_search = null, $org = null)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        if ($org != null) {
            $this->db->where('ID_CONSULTANT', $org);
        }

        if ($key_search != null) {
            $this->db->like('(ID_COMPANY', $key_search);
            if ($start != null && $start != 0) {
                $this->db->or_like("NM_COMPANY LIKE '%" . $this->db->escape_like_str($key_search) . "%') ORDER BY `NM_COMPANY` asc LIMIT " . $offset . ", " . $start . " --");
            } else {
                $this->db->or_like("NM_COMPANY LIKE '" . $this->db->escape_like_str($key_search) . "') ORDER BY `NM_COMPANY` asc LIMIT " . $offset . " --");
            }
        } else {
            $this->db->limit($offset, $start);
        }

        $query = $this->db->get()->result_array();

        return ($query);
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

    function update_data_by_id($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }

        $this->db->where('ID_COMPANY', $id);
        $this->db->update($this->table_name, $data);

        return true;
    }

    public function remove($id = null)
    {
        if ($id != null) {
            $this->db->delete($this->table_name, array('ID_COMPANY' => $id));
        }
    }
}