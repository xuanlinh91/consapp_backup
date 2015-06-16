<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for User Model
 */
class Manage_report_rules
{
    function __construct()
    {
    }

    /**
     * [get_create_account_rules description]
     * @return [array] [settings rules for register]
     */
    public static function manage_report_rule()
    {
        $rules['manage_report_rule'] = array(
            array(
                'field' => 'NM_COMPANY',
                'label' => 'Company Name',
                'rules' => 'trim'
            ),
            array(
                'field' => 'DT_START',
                'label' => 'Start Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'DT_END',
                'label' => 'End Date',
                'rules' => 'trim|required'
            )
        );
        return $rules['manage_report_rule'];
    }
    public static function training_report_rule()
    {
        $rules['training_report_rule'] = array(
            array(
                'field' => 'DT_START',
                'label' => 'Start Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'DT_END',
                'label' => 'End Date',
                'rules' => 'trim|required'
            )
        );
        return $rules['training_report_rule'];
    }

}
