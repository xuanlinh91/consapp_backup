<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for Company Model
 */
class Interview_rules
{
    function __construct()
    {

    }

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public static function interview_create_rules()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'interview_1',
                'label' => 'Interview',
                'rules' => 'max_length[4900]'
            ),
            array(
                'field' => 'interview_2',
                'label' => 'Interview',
                'rules' => 'max_length[4900]'
            ),
            array(
                'field' => 'interview_3',
                'label' => 'Interview',
                'rules' => 'max_length[4900]'
            )
        );
        return $rules['register_rule'];
    }
}
