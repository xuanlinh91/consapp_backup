<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for User Model
 */
class Participant_rules
{
    function __construct()
    {
    }

    /**
     * [get_create_account_rules description]
     * @return [array] [settings rules for register]
     */
    public static function update_participant_rule()
    {
        $rules['update_participant_rule'] = array(
            array(
                'field' => 'NM_PARTICIPANT',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]|custom_validate_name_user'
            )
        );
        return $rules['update_participant_rule'];
    }

    public static function create_participant_rules()
    {
        $rules['create_participant_rules'] = array(
            array(
                'field' => 'NM_PARTICIPANT',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]|custom_validate_name_user'
            )
        );
        return $rules['create_participant_rules'];
    }
}
