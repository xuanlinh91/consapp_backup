<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for Company Model
 */
class Questions_rules
{
    function __construct()
    {
        # code...
    }

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public function question_step_1()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'step',
                'label' => 'Step',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'ID_GS1',
                'label' => 'Answer',
                'rules' => 'trim|required|numeric'
            )
        );
        return $rules['register_rule'];
    }

    public function question_step_2()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'step',
                'label' => 'Step',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'ID_MS2',
                'label' => 'Answer',
                'rules' => 'trim|required|numeric'
            )
        );
        return $rules['register_rule'];
    }

    public function question_step_3()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'step',
                'label' => 'Step',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'ID_LC3',
                'label' => 'Answer',
                'rules' => 'trim|required|numeric'
            )
        );
        return $rules['register_rule'];
    }


    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */

}
