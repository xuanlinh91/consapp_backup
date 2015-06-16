<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for User Model
 */
class Norm_rules
{
    function __construct()
    {
    }

    /**
     * [get_create_account_rules description]
     * @return [array] [settings rules for register]
     */
    public static function compute_norm_rule()
    {
        $rules['compute_norm_rule'] = array(
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
        return $rules['compute_norm_rule'];
    }

}
