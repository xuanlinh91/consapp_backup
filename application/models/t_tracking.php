<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_Tracking
 *Description: model manage tracking summary
 * @author HiepNT
 */
Class T_tracking extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_tracking';
    }

    function get_data_by_id($select = '*', $id = null)
    {
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_SURVEY = $id LIMIT 1");
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
        }

        return null;
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

    function get_data_for_ajax($select = '*', $id = null)
    {
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_SURVEY = $id LIMIT 1");
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
        }

        return null;
    }

    public function get_list_profile_view_report($offset = null, $start = null, $id_company_info)
    {
        $sql = "select a.ID_AI, a.ID_COMPANY, b.ID_SURVEY, b.DT_END , b.DT_START, a.NM_COMPANY, b.ID_PROFILE
                from t_company_profile as a
                join t_tracking as b on a.ID_AI = b.ID_PROFILE
                join t_company_info as c on c.ID_COMPANY = a.ID_COMPANY
                where a.ID_STATUS = '0' and  c.ID_COMPANY_AI = '" . $id_company_info . "' and (b.DT_END IS NOT NULL and b.DT_END > '0000-00-00 00:00:00')";

        if ($offset != null && $start != null) {
            $sql .= ' limit '. $start . ', ' . $offset;
        } elseif($offset != null) {
            $sql .= ' limit '. $offset;
        }

        $result = $this->db->query($sql);
        $profile_list = $result->result_array();

        return $profile_list;
    }

    function update_data_by_id($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }

        $this->db->where('ID_TRACKING', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {

            return true;
        }

        return false;
    }

    function update_data_by_property($data = array(), $where = array())
    {
        // validate data
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
        }

        return false;
    }

    function update_data_by_id_company($data = array(), $id)
    {
        if (is_null($data) || !is_array($data)) {
            return null;
        }

        $this->db->where('ID_COMPANY', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Update stage by Company ID
     * @var $step Tracking summary step
     * @var $id Company ID (Varchar)
     * @return boolean
     */
    function update_stage_by_id($step = STAGE_1, $id, $id_ai = null)
    {
        if (is_null($step)) {
            return null;
        }

        if ($step <= $this->get_stage_by_id($id)) {
            return null;
        }
        $stage_list = array('STAGE_1', 'STAGE_2', 'STAGE_3', 'STAGE_4', 'STAGE_5', 'STAGE_6', 'STAGE_7');
        $stage = 'STAGE_' . $step;
        $stage_update = array();
        foreach ($stage_list as $value) {
            if ($value < $stage) {
                $stage_update[$value] = TRACKING_COMPLETED;
            } else if ($value == $stage) {
                $stage_update[$value] = TRACKING_IN_PROGRESS;
            } else {
                // $stage_update[$value] = TRACKING_NOT_COMPLETED;
            }
        }

        if ($stage == 'STAGE_6') {
            $stage_update['STAGE_7'] = TRACKING_IN_PROGRESS;
        }

        $tracking = $this->getActiveTracking($id_ai);
        if(sizeof($tracking) > 0) {
            $this->update_data_by_id($stage_update,$tracking[0]['ID_TRACKING']);
            return true;
        }
        return false;
    }

    public function updateStageByCompanyID($company_id,$data)
    {
        if (is_array($data) && sizeof($data) > 0 && !is_null($company_id)) {
            $tracking = $this->getActiveTracking($company_id);
            if(sizeof($tracking) > 0) {
                $this->update_data_by_id($data,$tracking[0]['ID_TRACKING']);
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    public function getStageStatus($company_id,$stage)
    {
        if (!is_null($stage) && !is_null($company_id)) {
            $tracking = $this->getActiveTracking($company_id);
            if(sizeof($tracking) > 0) {
                return $tracking['0'][$stage];
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function checkActiveBeforeGoToSurvey($company_id)
    {
        if (!is_null($company_id)) {
            $this->db->select($this->table_name . '.*');
            $this->db->join('t_company_info', 't_company_info.ID_COMPANY = t_tracking.ID_COMPANY');
            $this->db->join('t_company_profile', 't_company_profile.ID_AI = t_tracking.ID_PROFILE');
            $this->db->where('t_company_info.ID_COMPANY_AI', $company_id)
                ->where('t_company_profile.ID_STATUS', 0)
                ->where('STAGE_1', TRACKING_COMPLETED)
                ->where('STAGE_2', TRACKING_COMPLETED)
                ->where('STAGE_3', TRACKING_COMPLETED)
                ->where('DT_END', '0000-00-00 00:00:00');
            $query = $this->db->get($this->table_name)->result_array();
            if (sizeof($query) > 0) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    function get_stage_by_id_profile($data)
    {
        $this->db->join('t_company_profile', 't_company_profile.ID_AI = t_tracking.ID_PROFILE');
        $this->db->where('t_tracking.ID_PROFILE', $data)
            ->where('t_company_profile.ID_STATUS', 0);
        $query = $this->db->get($this->table_name);
        $query = $query->result_array();
        if (count($query) > 0 && $query[0]['ID_STATUS'] == 0) {
            $stage_list = array('STAGE_1', 'STAGE_2', 'STAGE_3', 'STAGE_4', 'STAGE_5', 'STAGE_6', 'STAGE_7');
            $stage = '';
            foreach ($stage_list as $value) {
                if ($query[0][$value] != '0') {
                    $stage = $value;
                }
            }

            if ($stage != '') {
                $result = explode('_', $stage);
                return $result[1];
            } else {
                return '0';
            }
        }

        return false;
    }

    function get_stage_by_id($data)
    {
        $sql = "select * from t_tracking  join t_company_profile on t_company_profile.ID_AI = t_tracking.ID_PROFILE where t_tracking.`ID_COMPANY` ='" . $data . "' and t_company_profile.`ID_STATUS` = '0'
                and `DT_END` = '0000-00-00 00:00:00'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        if (count($result) > 0) {
            $stage_list = array('STAGE_1', 'STAGE_2', 'STAGE_3', 'STAGE_4', 'STAGE_5', 'STAGE_6', 'STAGE_7');
            $stage = '';
            foreach ($stage_list as $value) {
                if (($result[0][$value] != '0') && ($result[0][$value] != '3')) {
                    $stage = $value;
                }
            }

            if ($stage != '') {
                $result = explode('_', $stage);
                if ($result[1] == 7) {
                    return 6;
                }
                return $result[1];
            } else {
                return '0';
            }
        }

        return false;
    }

    /**
     * Get active tracking summary by Company ID
     */
    public function getActiveTracking($company_id = NULL)
    {
        if ($company_id != NULL) {
            $this->db->select($this->table_name . '.*, t_company_profile.ID_GS1, t_company_profile.NM_SCOPE');
            $this->db->join('t_company_info', 't_company_info.ID_COMPANY = t_tracking.ID_COMPANY');
            $this->db->join('t_company_profile', 't_company_profile.ID_AI = t_tracking.ID_PROFILE');
            $this->db->where('t_company_info.ID_COMPANY_AI', $company_id)
                ->where('t_company_profile.ID_STATUS', 0)
                ->where('DT_END', '0000-00-00 00:00:00');
            $query = $this->db->get($this->table_name)->result_array();
            return $query;
        }

        return null;
    }

    function get_data_by_property($select, $where = array())
    {
        // validate data
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

    public function get_active_profile($id_company_info)
    {
        $this->db->select('*');
        $this->db->where('t_company_info.ID_COMPANY_AI', $id_company_info);
        $this->db->join('t_company_info', 't_company_info.ID_COMPANY = t_tracking.ID_COMPANY');
        $this->db->join('t_company_profile', 't_company_profile.ID_AI = t_tracking.ID_PROFILE');
        $query = $this->db->get($this->table_name)->result_array();
        foreach ($query as $key => $value) {
            if ($value['ID_STATUS'] != 1 && $value['DT_END'] == '0000-00-00 00:00:00') {
                return $value['ID_PROFILE'];
            }
        }

        return false;
    }

    public function get_newest_profile($id_company_info)
    {
        $sql = "SELECT a.ID_COMPANY, a.ID_PROFILE, a.DT_START, b.NM_INDUSTRY, b.ID_AI
                FROM t_tracking a
                JOIN t_company_profile b ON a.ID_PROFILE = b.ID_AI
                WHERE a.ID_COMPANY = '$id_company_info'
                AND b.NM_INDUSTRY IS NOT NULL
                ORDER BY a.DT_START DESC
                LIMIT 1";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }


    public function check_closed_survey($id_company_info, $current = false)
    {
        $this->db->select('t_tracking.ID_TRACKING');
        $this->db->join('t_company_info', 't_company_info.ID_COMPANY = t_tracking.ID_COMPANY');
        $this->db->join('t_company_profile', 't_company_profile.ID_AI = t_tracking.ID_PROFILE');
        $this->db->where('t_company_info.ID_COMPANY', $id_company_info);
        $this->db->where('t_company_profile.ID_STATUS', 0);
        if ($current) {
            $this->db->where('t_tracking.DT_END', '0000-00-00 00:00:00');
        } else {
            $this->db->where('t_tracking.DT_END !=', '0000-00-00 00:00:00');
        }

        $query = $this->db->get($this->table_name)->result_array();
        if (sizeof($query) >= 1) {
            return true;
        }

        return false;
    }

    /**
     * Get active tracking summary by Company ID
     */
    public function getActiveTrackingBySurvey($survey_id = NULL)
    {
        if ($survey_id != NULL) {
            $data = $this->db->select('tt.*, tc.ID_COMPANY_AI, tp.ID_GS1, tp.NM_SCOPE')
                ->from($this->table_name . ' tt')
                ->join('t_company_profile tp', 'tp.ID_AI = tt.ID_PROFILE', 'left')
                ->join('t_company_info tc', 'tc.ID_COMPANY = tp.ID_COMPANY', 'left')
                ->where('tt.ID_SURVEY', $survey_id)
                ->where('tp.ID_STATUS', 0)
                ->where('tt.DT_END', '0000-00-00 00:00:00')
                ->limit(1, 0)
                ->get()
                ->result_array();
            return $data;
        }

        return null;
    }

    /**
     * Get active tracking summary by Company ID
     */
    public function getActiveSurveyByCompany($company_id = NULL)
    {
        if ($company_id != NULL) {
            $data = $this->db->select('tt.id_survey, ts.tx_status
                , tc.nm_company, tc.id_company, ts.consultant_id
                , tp.TX_NOTES_1, tp.TX_NOTES_2, tp.TX_NOTES_3, ts.TX_FREE, tt.ID_PROFILE')
                ->from($this->table_name . ' tt')
                ->join('t_company_profile tp', 'tp.ID_AI = tt.ID_PROFILE', 'left')
                ->join('t_company_info tc', 'tc.ID_COMPANY = tp.ID_COMPANY', 'left')
                ->join('t_survey_response_hdr ts', 'tt.ID_SURVEY = ts.ID_SURVEY', 'left')
                ->where('tc.ID_COMPANY_AI', $company_id)
                ->where('tp.ID_STATUS', 0)
                ->where('tt.DT_END', '0000-00-00 00:00:00')
                ->limit(1, 0)
                ->get()
                ->result_array();
            return $data;
        }

        return null;
    }
}
