<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for Company Model
 */
class Company_rules
{
    function __construct()
    {
        # code...
    }

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public function get_company_rules_step_1()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'nm_company',
                'label' => 'UEN',
                'rules' => 'trim|required|min_length[1]|alpha_numeric|max_length[50]|is_unique[t_company_info.nm_company]'
            ),
            array(
                'field' => 'id_family_owned',
                'label' => 'Family Owned',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'n_revenue',
                'label' => 'Revenue Size',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'n_staff_size',
                'label' => 'Total staff size',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'n_hr_size',
                'label' => 'HR staff size',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nm_industry',
                'label' => 'Company industry',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nm_type',
                'label' => 'Company type',
                'rules' => 'trim|required'
            )
        );
        return $rules['register_rule'];
    }

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public function get_company_rules_step_2()
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

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public static function get_company_rules_step_3()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'step',
                'label' => 'Step',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'ID_GS2',
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
    public function get_edit_company_rules_step_1()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'nm_company',
                'label' => 'Company Name',
                'rules' => 'trim|required|alpha_numeric|max_length[255]'
            ),

            array(
                'field' => 'id_family_owned',
                'label' => 'Family Owned',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'n_revenue',
                'label' => 'Revenue Size',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'n_staff_size',
                'label' => 'Total staff size',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'n_hr_size',
                'label' => 'HR staff size',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nm_industry',
                'label' => 'Company industry',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nm_type',
                'label' => 'Company type',
                'rules' => 'trim|required'
            )
        );
        return $rules['register_rule'];
    }

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public function get_edit_company_rules_step_2()
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

    /**
     * [get_name_company_rules description]
     * @return [array] [settings rules for register]
     */
    public static function get_edit_company_rules_step_3()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'step',
                'label' => 'Step',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'ID_GS2',
                'label' => 'Answer',
                'rules' => 'trim|required|numeric'
            )
        );
        return $rules['register_rule'];
    }

    public static function get_company_update_info_rules()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'company_id',
                'label' => 'UEN',
                'rules' => 'trim|required|max_length[50]'
            ),
            array(
                'field' => 'company_name',
                'label' => 'Company Name',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            ),
            array(
                'field' => 'respondent_name',
                'label' => 'Respondent Name',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            ),
            array(
                'field' => 'designation',
                'label' => 'Designation',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            )
        );

        return $rules['register_rule'];
    }

    public static function get_company_create_info_rules()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'company_id',
                'label' => 'UEN',
                'rules' => 'trim|required|max_length[50]|validate_name_part|is_unique[t_company_info.ID_COMPANY]'
            ),
            array(
                'field' => 'company_name',
                'label' => 'Company Name',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            ),
            array(
                'field' => 'respondent_name',
                'label' => 'Respondent Name',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            ),
            array(
                'field' => 'designation',
                'label' => 'Designation',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            )
        );

        return $rules['register_rule'];
    }

    public static function company_profile_rules()
    {
        $rules['register_rule'] = array(

            array(
                'field' => 'ceo_name',
                'label' => 'CEO Name',
                'rules' => 'trim|required|max_length[50]'
            ),
            array(
                'field' => 'designation1',
                'label' => 'Designation',
                'rules' => 'trim|required|max_length[50]|validate_name_part'
            ),
            array(
                'field' => 'phone1',
                'label' => 'Phone',
                'rules' => 'trim|required|numeric|max_length[20]|validate_name_part'
            ),
            array(
                'field' => 'email1',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'hr_rep_name',
                'label' => 'HR Rep Name',
                'rules' => 'trim|required|max_length[30]|validate_name_part'
            ),
            array(
                'field' => 'designation2',
                'label' => 'Designation',
                'rules' => 'trim|required|max_length[30]|validate_name_part'
            ),
            array(
                'field' => 'phone2',
                'label' => 'Phone',
                'rules' => 'trim|required|numeric|max_length[20]|validate_name_part'
            ),
            array(
                'field' => 'email2',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'local_revenue',
                'label' => 'Local revenue',
                'rules' => 'trim|required|integer|max_length[20]'
            ),
            array(
                'field' => 'overseas_revenue',
                'label' => 'Overseas revenue',
                'rules' => 'trim|required|integer|max_length[20]'
            ),
            array(
                'field' => 'gross_profit',
                'label' => 'Gross profit',
                'rules' => 'trim|required|integer|max_length[20]'
            ),
            array(
                'field' => 'total_local_staff',
                'label' => 'Total Staff in Singapore',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'local_staff_part_time',
                'label' => 'Total Part-time Staff in Singapore',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'local_hr_team',
                'label' => 'HR Team Size in Singapore',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'total_overseas_staff',
                'label' => 'Total overseas staff',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'overseas_hr_team_size',
                'label' => 'Overseas Hr team size',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'local_staff_retention',
                'label' => 'Retention of Staff in Singapore',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'overseas_staff_retention',
                'label' => 'Overseas staff retention',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'local_staff_turnover',
                'label' => 'Turnover of Staff in Singapore',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'overseas_staff_turnover',
                'label' => 'Overseas staff turnover',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'training_cost',
                'label' => 'Training Cost',
                'rules' => 'trim|required|is_natural|max_length[20]'
            ),
            array(
                'field' => 'training_participation',
                'label' => 'Training participation',
                'rules' => 'trim|required|is_natural|max_length[20]'
            )
        );

        return $rules['register_rule'];
    }

    public static function question_step_1()
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

    public static function question_step_2()
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

    public static function question_step_3()
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
}
