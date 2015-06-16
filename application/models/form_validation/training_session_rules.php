<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for User Model
 */
class Training_session_rules
{
    function __construct()
    {
    }

    public function create_training_session_rules()
    {
        $rules['create_training_session_rules'] = array(
            array(
                'field' => 'NM_SESSION',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]|callback_validate_name_session'
            ),
            array(
                'field' => 'DT_START',
                'label' => 'Start Date',
                'rules' => 'trim|required|max_length[50]'
            ),
            array(
                'field' => 'DT_END',
                'label' => 'End Date',
                'rules' => 'trim|required|max_length[100]'
            )
        );
        return $rules['create_training_session_rules'];
    }

    public static function update_training_session_rule()
    {
        $rules['update_training_session_rule'] = array(
            array(
                'field' => 'NM_SESSION',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]|callback_validate_name_session'
            ),
            array(
                'field' => 'DT_START',
                'label' => 'Start Date',
                'rules' => 'trim|required|max_length[50]'
            ),
            array(
                'field' => 'DT_END',
                'label' => 'End Date',
                'rules' => 'trim|required|max_length[100]|'
            )
        );
        return $rules['update_training_session_rule'];
    }
}
