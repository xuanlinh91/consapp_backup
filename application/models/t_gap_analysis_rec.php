<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *T_Tracking
 *Description: model manage tracking summary
 * @author quanhm
 */
Class T_gap_analysis_rec extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 't_gap_analysis_rec';
    }

    function get_data_by_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_SURVEY = $id LIMIT 1");
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
        }
    }

    function update_data_by_id($data = array(), $id = null)
    {
        if (!is_null($data) && is_array($data)) {
            $this->db->where('ID_QUESTION', $id);
            return $this->db->update($this->table_name, $data);
        } else {
            return null;
        }
    }

    function update_data_by_survey($data = array())
    {
        if (!is_null($data) && is_array($data)) {
            $this->db->where('ID_SURVEY', $data['survey_id']);
            $this->db->where('ID_QUESTION', $data['question_id']);
            return $this->db->update($this->table_name, array($data['type'] => $data['text']));
        } else {
            return null;
        }
    }

    function get_data_by_survey_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_SURVEY = $id");
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
            return $query;
        } else {
            return null;
        }
    }

    function get_data_by_question_id($select = '*', $id = null)
    {
        //validate data
        if (!is_null($id) && is_numeric($id)) {
            $this->db->where("ID_QUESTION = $id LIMIT 1");
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

    function delete_data_by_survey_id($survey_id)
    {
        if (is_null($survey_id)) {
            return null;
        }

        $this->db->where('ID_SURVEY', $survey_id);
        $this->db->delete('t_gap_analysis_rec');
    }

    function get_matrix_by_id($id)
    {
        if (is_null($id)) {
            return null;
        }

        $this->db->select('g.*, g.IN_SCORE IN_POINT, g.ID_SURVEY ID, sq.NM_QUESTION, ns.S_SCORE');
        $this->db->from('t_survey_question sq');
        $this->db->join('t_gap_analysis_rec g', 'sq.ID_QUESTION = g.ID_QUESTION', 'left');
        $this->db->join('t_norm_scores ns', 'ns.ID_QUESTION = sq.ID_QUESTION', 'left');
        $this->db->where('g.ID_SURVEY', $id);
        $query = $this->db->get();
        $data = $query->result_array();
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }
}
