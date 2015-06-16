<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_User
 *Description: model manage t_company_info
 * @author quanhm
 */
Class T_company_profile extends MY_Model
{

    function __construct()
    {
        parent::__construct();

        $this->table_name = 't_company_profile';
    }


    function get_data_by_id($select = '*', $id = null)
    {
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_AI = $id LIMIT 1");
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

    /**
     * @param array $where
     * @param $total_revenue
     * @param $total_hr_team_size
     * @param null $id_user
     * @return mixed
     */
    function get_company_profile_more_than_two_survey($where = array(), $total_revenue, $total_hr_team_size, $id_user = null)
    {
        $sql = "SELECT COUNT(ID_AI) AS size, cp.ID_COMPANY
                FROM t_company_profile cp
                JOIN t_tracking tt ON tt.ID_PROFILE = cp.ID_AI
                JOIN t_company_info b ON cp.ID_COMPANY = b.ID_COMPANY
                JOIN t_survey_response_hdr hdr ON hdr.ID_SURVEY = tt.ID_SURVEY";

        if (isset($where['NM_COMPANY']) && $where['NM_COMPANY'] != null) {
            $sql = $sql . " WHERE cp.NM_COMPANY LIKE '%" . $this->db->escape_like_str($where['NM_COMPANY']) . "%'";
        }

        if (isset($where['ID_MS2']) && $where['ID_MS2'] != null) {
            $sql .= " AND cp.ID_MS2 = " . $where['ID_MS2'];
        }

        if (isset($where['NM_INDUSTRY']) && $where['NM_INDUSTRY'] != null) {
            $sql .= " AND cp.NM_INDUSTRY = '" . $where['NM_INDUSTRY'] . "'";
        }

        if (isset($where['ID_LC3']) && $where['ID_LC3'] != null) {
            $sql .= " AND cp.ID_LC3 = " . $where['ID_LC3'];
        }

        if (isset($where['NM_SCOPE']) && $where['NM_SCOPE'] != null) {
            $sql .= " AND cp.NM_SCOPE = '" . $where['NM_SCOPE'] . "'";
        }

        if (isset($where['NM_TYPE']) && $where['NM_TYPE'] != null) {
            $sql .= " AND cp.NM_TYPE = '" . $where['NM_TYPE'] . "'";
        }
        if (isset($where['DT_START']) && $where['DT_START'] != null) {
            $sql .= " AND tt.DT_END BETWEEN '"
                . date_time($where['DT_START']) . "' AND '" . date_time($where['DT_END'], 1) . "'";
        }
        if (!is_null($total_revenue)) {
            $sql .= $total_revenue;
        }
        if (!is_null($total_hr_team_size)) {
            $sql .= $total_hr_team_size;
        }

        if ($id_user != null) {
            $sql .= " AND (b.ID_COMPANY_AI IN (
            SELECT ID_COMPANY
            FROM t_company_assignment
            WHERE ID_CONSULTANT IN (
            SELECT ID_USER
            FROM t_user
            WHERE NM_ORGANISATION IN (
            SELECT NM_ROOT_ORG
            FROM t_org_mapping
            WHERE NM_AGENCY = (
            SELECT NM_ORGANISATION
            FROM t_user
            WHERE ID_USER = " . $id_user . ")))) OR b.ID_COMPANY_AI IN (
            SELECT ID_COMPANY
            FROM t_company_assignment
            WHERE ID_CONSULTANT = " . $id_user . "
            ))";
        }
        $sql .= "GROUP BY cp.ID_COMPANY HAVING count(cp.ID_COMPANY) >= 2";
        return $this->db->query($sql)->result_array();

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
            $t_company_profile = $this->get_data_by_id('*', $id_last);
            return $t_company_profile;

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
        return true;

    }

    function update_data_by_id($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {

            return null;
        }

        $this->db->where('ID_AI', $id);
        $this->db->update($this->table_name, $data);
        return true;
    }

    public function getActiveCompanyProfile($company_id = NULL)
    {
        if ($company_id != NULL) {
            $data = $this->db->select('tp.*')
                ->from($this->table_name . ' tp')
                ->join('t_company_info tc', 'tc.ID_COMPANY = tp.ID_COMPANY', 'left')
                ->join('t_tracking tt', 'tt.ID_PROFILE = tp.ID_AI', 'left')
                ->where('tc.ID_COMPANY_AI', $company_id)
                ->where('tp.ID_STATUS', 0)
                ->where('tt.DT_END', '0000-00-00 00:00:00')
                ->limit(1, 0)
                ->get()
                ->result_array();
            return $data;
        } else {
            return null;
        }
    }

    public function report_search_company($offset = null, $start = null, $condition = array())
    {
        if (count($condition) > 0) {
            $this->db->select('*');
            $this->db->join('t_tracking', 't_tracking.ID_PROFILE = t_company_profile.ID_AI');
            foreach ($condition as $key => $value) {
                if ($value != null && $value != '') {
                    if ($key == 'NM_COMPANY') {
                        $this->db->like($key, $value);
                    } else {
                        $this->db->where(array($key => $value));
                    }
                }
            }

            $results = $this->db->get($this->table_name);
            $results = $results->result_array();

            return $results;
        }

        return false;
    }

    /**
     * @param array $where
     * @param null $total_revenue
     * @param null $total_hr_team_size
     * @param null $id_user
     * @return mixed
     */
    public function export_company_search($where = array(),$total_revenue = null, $total_hr_team_size = null,
                                          $id_user = null)
    {
        $sql = "SELECT `tt`.`ID_SURVEY`, `tt`.`ID_COMPANY`, `cp`.`NM_COMPANY`, `tt`.`DT_START`, `cp`.`NM_CEO`,
                `cp`.`NM_DESIGNATION1`, `cp`.`N_HP1`, `cp`.`N_EMAIL1`, `cp`.`NM_HR`, `cp`.`NM_DESIGNATION2`,
                `cp`.`N_HP2`, `cp`.`N_EMAIL2`, `cp`.`NM_INDUSTRY`, `cp`.`NM_TYPE`, `cp`.`NM_SCOPE`, `cp`.`N_L_REVENUE`,
                `cp`.`N_O_REVENUE`, (cp.N_L_REVENUE + cp.N_O_REVENUE) AS Total_Revenue, `cp`.`N_GROSS`,
                `cp`.`N_LOCAL_STAFF`,`cp`.`N_UNI`, `cp`.`N_POLY`, `cp`.`N_ITE`, `cp`.`N_PARTTIME`, `cp`.`N_L_HR`,
                `cp`.`N_OVERSEAS_HR`,`cp`.`N_OVERSEAS_STAFF`,(cp.N_LOCAL_STAFF + cp.N_OVERSEAS_STAFF) AS Total_Staff_Size,
                (cp.N_L_HR + cp.N_OVERSEAS_HR) AS Total_HR_Size,`cp`.`N_L_RETENTION`, `cp`.`N_O_RETENTION`,
                `cp`.`N_L_TURNOVER`, `cp`.`N_O_TURNOVER`, `cp`.`N_TRAINING_COST`, `cp`.`N_TRAINING_PARTICIPATION`,
                `gs1`.`VALUE_TYPE` ID_GS1, `gs2`.`VALUE_TYPE` ID_MS2, `gs3`.`VALUE_TYPE` ID_LC3, `hdr`.`INT_CAT1`,
                `hdr`.`INT_CAT2`, `hdr`.`INT_CAT3`, `hdr`.`INT_CAT4`, `hdr`.`INT_CAT5`, `hdr`.`INT_CAT6`,
                `hdr`.`INT_CAT7`, `hdr`.`INT_CAT8`, `hdr`.`INT_CAT9`, `hdr`.`INT_CAT10`, `hdr`.`INT_CAT11`,
                 FLOOR(hdr.INT_PT), `tt`.`DT_END`
                FROM (`t_company_profile` cp)
                JOIN `t_tracking` tt ON `tt`.`ID_PROFILE` = `cp`.`ID_AI`
                JOIN `t_survey_response_hdr` hdr ON `hdr`.`ID_SURVEY` = `tt`.`ID_SURVEY`
                JOIN t_company_info b ON cp.ID_COMPANY = b.ID_COMPANY
                JOIN `t_growth_stage` gs1 ON `cp`.`ID_GS1` = `gs1`.`ID_GS`
                JOIN `t_growth_stage` gs2 ON `cp`.`ID_MS2` = `gs2`.`ID_GS`
                JOIN `t_growth_stage` gs3 ON `cp`.`ID_LC3` = `gs3`.`ID_GS`
                WHERE `cp`.`ID_STATUS` = '0' AND `tt`.`DT_END` IS NOT NULL";

        if (isset($where['NM_COMPANY']) && $where['NM_COMPANY'] != null) {
            $sql = $sql . " AND cp.NM_COMPANY LIKE '%" . $this->db->escape_like_str($where['NM_COMPANY']) . "%'";
        }

        if (isset($where['ID_GS1']) && $where['ID_GS1'] != null) {
            $sql .= " AND cp.ID_GS1 = " . $where['ID_GS1'];
        }

        if (isset($where['ID_MS2']) && $where['ID_MS2'] != null) {
            $sql .= " AND cp.ID_MS2 = " . $where['ID_MS2'];
        }

        if (isset($where['ID_LC3']) && $where['ID_LC3'] != null) {
            $sql .= " AND cp.ID_LC3 = " . $where['ID_LC3'];
        }

        if (isset($where['NM_INDUSTRY']) && $where['NM_INDUSTRY'] != null) {
            $sql .= " AND cp.NM_INDUSTRY = '" . $where['NM_INDUSTRY'] . "'";
        }

        if (isset($where['NM_SCOPE']) && $where['NM_SCOPE'] != null) {
            $sql .= " AND cp.NM_SCOPE = '" . $where['NM_SCOPE'] . "'";
        }

        if (isset($where['NM_TYPE']) && $where['NM_TYPE'] != null) {
            $sql .= " AND cp.NM_TYPE = '" . $where['NM_TYPE'] . "'";
        }

        if (isset($where['DT_START']) && $where['DT_START'] != null) {
            $sql .= " AND tt.DT_START BETWEEN '"
                . date_time($where['DT_START']) . "' AND '" . date_time($where['DT_END'], 1) . "'";
        }

        if (!is_null($total_revenue)) {
            $sql .= $total_revenue;
        }

        if (!is_null($total_hr_team_size)) {
            $sql .= $total_hr_team_size;
        }
        if ($id_user != null) {
            $sql .= " AND (b.ID_COMPANY_AI IN (
            SELECT ID_COMPANY
            FROM t_company_assignment
            WHERE ID_CONSULTANT IN (
            SELECT ID_USER
            FROM t_user
            WHERE NM_ORGANISATION IN (
            SELECT NM_ROOT_ORG
            FROM t_org_mapping
            WHERE NM_AGENCY = (
            SELECT NM_ORGANISATION
            FROM t_user
            WHERE ID_USER = " . $id_user . ")))) OR b.ID_COMPANY_AI IN (
            SELECT ID_COMPANY
            FROM t_company_assignment
            WHERE ID_CONSULTANT = " . $id_user . "
            ))";
        }
        return $this->db->query($sql)->result_array();
    }

    public function get_data_sheet_index_0($where = array(),$total_revenue, $total_hr_team_size)
    {
        $sql = "SELECT *
                FROM (`t_company_profile` cp)
                JOIN `t_tracking` tt ON `tt`.`ID_PROFILE` = `cp`.`ID_AI`
                JOIN `t_survey_response_hdr` hdr ON `hdr`.`ID_SURVEY` = `tt`.`ID_SURVEY`
                WHERE `cp`.`ID_STATUS` != '1' AND `tt`.`DT_END` != '0000-00-00 00:00:00' AND `tt`.`DT_END` IS NOT NULL";

        if (isset($where['NM_COMPANY']) && $where['NM_COMPANY'] != null) {
            $sql = $sql . " AND cp.NM_COMPANY LIKE '%" . $this->db->escape_like_str($where['NM_COMPANY']) . "%'";
        }

        if (isset($where['ID_GS1']) && $where['ID_GS1'] != null) {
            $sql .= " AND cp.ID_GS1 = " . $where['ID_GS1'];
        }

        if (isset($where['ID_MS2']) && $where['ID_MS2'] != null) {
            $sql .= " AND cp.ID_MS2 = " . $where['ID_MS2'];
        }

        if (isset($where['ID_LC3']) && $where['ID_LC3'] != null) {
            $sql .= " AND cp.ID_LC3 = " . $where['ID_LC3'];
        }

        if (isset($where['NM_INDUSTRY']) && $where['NM_INDUSTRY'] != null) {
            $sql .= " AND cp.NM_INDUSTRY = '" . $where['NM_INDUSTRY'] . "'";
        }

        if (isset($where['NM_SCOPE']) && $where['NM_SCOPE'] != null) {
            $sql .= " AND cp.NM_SCOPE = '" . $where['NM_SCOPE'] . "'";
        }

        if (isset($where['NM_TYPE']) && $where['NM_TYPE'] != null) {
            $sql .= " AND cp.NM_TYPE = '" . $where['NM_TYPE'] . "'";
        }

        if (isset($where['DT_START']) && $where['DT_START'] != null) {
            $sql .= " AND tt.DT_START BETWEEN '"
                . date_time($where['DT_START']) . "' AND '" . date_time($where['DT_END'], 1) . "'";
        }

        if (!is_null($total_revenue)) {
            $sql .= $total_revenue;
        }

        if (!is_null($total_hr_team_size)) {
            $sql .= $total_hr_team_size;
        }

        return $this->db->query($sql)->result_array();
    }

    public function report_get_company($select = '*', $where = array(), $id_user = null)
    {
        $sql = "SELECT " . $select . " FROM t_company_profile a
                JOIN t_company_info b ON a.ID_COMPANY = b.ID_COMPANY
                JOIN t_tracking c ON c.ID_PROFILE = a.ID_AI";
        if (!isset($where['total_company_create'])) {
            $sql .= " JOIN t_survey_response_hdr e ON e.ID_SURVEY = c.ID_SURVEY";
        }
        $sql .= " JOIN t_company_assignment f ON f.ID_COMPANY = b.ID_COMPANY_AI
                JOIN t_user g ON g.ID_USER = f.ID_CONSULTANT
                 WHERE a.ID_STATUS = 0 AND f.ID_PRIMARY = 1 AND c.STAGE_1 != 3 AND c.STAGE_1 != 0";

        if (isset($where['NM_COMPANY']) && $where['NM_COMPANY'] != null) {
            $sql = $sql . " AND a.NM_COMPANY LIKE '%" . $this->db->escape_like_str($where['NM_COMPANY']) . "%'";
        }

        if (isset($where['ID_MS2']) && $where['ID_MS2'] != null) {
            $sql .= " AND a.ID_MS2 = " . $where['ID_MS2'];
        }
        if (isset($where['ID_GS1']) && $where['ID_GS1'] != null) {
            $sql .= " AND a.ID_GS1 = " . $where['ID_GS1'];
        }

        if (isset($where['NM_INDUSTRY']) && $where['NM_INDUSTRY'] != null) {
            $sql .= " AND a.NM_INDUSTRY = '" . $where['NM_INDUSTRY'] . "'";
        }

        if (isset($where['ID_LC3']) && $where['ID_LC3'] != null) {
            $sql .= " AND a.ID_LC3 = " . $where['ID_LC3'];
        }

        if (isset($where['NM_SCOPE']) && $where['NM_SCOPE'] != null) {
            $sql .= " AND a.NM_SCOPE = '" . $where['NM_SCOPE'] . "'";
        }

        if (isset($where['officer_1']) && $where['officer_1'] != null) {
            $sql .= " AND g.ID_USER IN (SELECT DISTINCT ID_CONSULTANT FROM t_company_assignment
                WHERE ID_PRIMARY = '1')";
        }
        if (isset($where['officer_2']) && $where['officer_2'] != null) {
            $sql .= " AND g.ID_USER IN (SELECT DISTINCT ID_CONSULTANT FROM t_company_assignment
                WHERE ID_PRIMARY != '1')";
        }

        if (isset($where['REVENUE']) && $where['REVENUE'] != null) {
            $sql .= " AND " . $this->revenue_count($where['REVENUE'], '(a.N_L_REVENUE + a.N_O_REVENUE)');
        }
        if (isset($where['N_L_REVENUE']) && $where['N_L_REVENUE'] != null) {
            $sql .= " AND " . $this->revenue_count($where['N_L_REVENUE'], 'a.N_L_REVENUE');
        }
        if (isset($where['N_O_REVENUE']) && $where['N_O_REVENUE'] != null) {
            $sql .= " AND " . $this->revenue_count($where['N_O_REVENUE'], 'a.N_O_REVENUE');
        }

        if (isset($where['NM_TYPE']) && $where['NM_TYPE'] != null) {
            $sql .= " AND a.NM_TYPE = '" . $where['NM_TYPE'] . "'";
        }

        if (isset($where['N_L_HR']) && $where['N_L_HR'] != null) {
            $sql .= " AND " . $this->hr_count($where['N_L_HR'], '(N_L_HR + N_OVERSEAS_HR)');
        }

        if ($where['DT_START'] != null && $where['DT_END'] != null) {
            if (!isset($where['open_survey']) || $where['open_survey'] == null) {
                $sql .= " AND c.DT_END BETWEEN '" . date_time($where['DT_START'])
                    . "' AND '" . date_time($where['DT_END'], 1) . "'";
            } else {
                $sql .= " AND c.DT_START BETWEEN '" . date_time($where['DT_START'])
                    . "' AND '" . date_time($where['DT_END'], 1) . "'";
            }

        }

        if ($where['officer_1'] != null && $where['officer_2'] != null) {
            $sql .= " AND (g.ID_USER = '" . $where['officer_1']
                . "' OR g.ID_USER = '" . $where['officer_2'] . "' )";
        } elseif ($where['officer_1'] != null) {
            $sql .= " AND g.ID_USER = '" . $where['officer_1'] . "'";
        } elseif ($where['officer_2'] != null) {
            $sql .= " AND g.ID_USER = '" . $where['officer_2'] . "'";
        }

        if (!isset($where['open_survey']) || $where['open_survey'] == null) {
            $sql .= " AND c.DT_END != '0000-00-00 00:00:00' AND c.DT_END IS NOT NULL";
        } elseif(isset($where['open_survey']) && $where['open_survey'] != null){
            $sql .= " AND (c.DT_END = '0000-00-00 00:00:00' OR c.DT_END IS NULL)";
        }

        if (isset($where['EMPLOYEE']) && $where['EMPLOYEE'] != null) {
            $sql .= " AND " . $where['EMPLOYEE'];
        }
        if (isset($where['LEVEL']) && $where['LEVEL'] != null) {
            $sql .= " AND FLOOR(e.INT_PT) = '" . $where['LEVEL'] . "'";
        }

        if ($id_user != null) {
            $sql .= " AND (b.ID_COMPANY_AI IN (
            SELECT ID_COMPANY
            FROM t_company_assignment
            WHERE ID_CONSULTANT IN (
            SELECT ID_USER
            FROM t_user
            WHERE NM_ORGANISATION IN (
            SELECT NM_ROOT_ORG
            FROM t_org_mapping
            WHERE NM_AGENCY = (
            SELECT NM_ORGANISATION
            FROM t_user
            WHERE ID_USER = " . $id_user . ")))) OR b.ID_COMPANY_AI IN (
            SELECT ID_COMPANY
            FROM t_company_assignment
            WHERE ID_CONSULTANT = " . $id_user . "
            ))";
        }

        return $this->db->query($sql)->result_array();
    }

    public function hr_count($value, $field)
    {
        if ($value == '1 to 2') {
            return $field . ' >=1 AND ' . $field . ' <= 2';
        } elseif ($value == '3 to 5') {
            return $field . ' >= 3 AND ' . $field . ' <= 5';
        } elseif ($value == '6 to 10') {
            return $field . ' >= 6 AND ' . $field . ' <= 10';
        } elseif ($value == 'More than 10') {
            return $field . ' > 10';
        } elseif ($value == 'No dedicated HR Function') {
            return $field . ' = 0';
        } elseif ($value == 'HR Function is outsourced') {
            return $field . ' = 0';
        }
    }

    public function revenue_count($value, $field)
    {
        switch ($value) {
            case '$100M and above':
                $text = $field . " >= 100000000";
                return $text;
                break;
            case '$80M to < $100M':
                $text = $field . " >= 80000000 AND " . $field . " < 100000000";
                return $text;
                break;
            case '$50M to < $80M':
                $text = $field . " >= 50000000 AND " . $field . " < 80000000";
                return $text;
                break;
            case '$30M to < $50M':
                $text = $field . " >= 30000000 AND " . $field . " < 50000000";
                return $text;
                break;
            case '$10M to < $30M':
                $text = $field . " >= 10000000 AND " . $field . " < 30000000";
                return $text;
                break;
            case '$5M to < $10M':
                $text = $field . " >= 5000000 AND " . $field . " < 10000000";
                return $text;
                break;
            case '$1M to < $5M':
                $text = $field . " >= 1000000 AND " . $field . " < 5000000";
                return $text;
                break;
            default:
                $text = $field . " < 1000000";
                return $text;
                break;
        }
    }


}
