<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Rules for User Model
 */
class User_rules
{
    function __construct()
    {
    }

    /**
     * [get_create_account_rules description]
     * @return [array] [settings rules for register]
     */
    public function get_register_rules()
    {
        $rules['register_rule'] = array(
            array(
                'field' => 'ID_LOGIN',
                'label' => 'Username',
                'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[50]|is_unique[t_user.ID_LOGIN]'
            ),
            array(
                'field' => 'EN_PASSWORD',
                'label' => 'Password',
                'rules' => 'trim|required|max_length[50]|xss_clean'
            ),
            array(
                'field' => 'NM_ORGANISATION',
                'label' => 'Organisation name',
                'rules' => 'trim|required|max_length[255]'
            ),
            array(
                'field' => 'NM_USER',
                'label' => 'Name',
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'TX_USEREMAIL',
                'label' => 'Email Address',
                'rules' => 'trim|required|max_length[100]|valid_email|xss_clean|is_unique[t_user.TX_USEREMAIL]'
            )
        );
        return $rules['register_rule'];
    }

    public function get_change_password_rules()
    {
        $rules['change_password_rule'] = array(
            array(
                'field' => 'ID_LOGIN',
                'label' => 'Username',
                'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[50]'
            ),
            array(
                'field' => 'TX_SECURITY_CODE',
                'label' => 'Security Code',
                'rules' => 'trim|required|alpha_numeric|min_length[9]|max_length[9]|xss_clean'
            ),
            array(
                'field' => 'NEW_PASSWORD',
                'label' => 'New password',
                'rules' => 'trim|required|min_length[6]|max_length[50]|xss_clean'
            ),
            array(
                'field' => 'CONFIRM_NEW_PASSWORD',
                'label' => 'Confirm new password',
                'rules' => 'trim|required|min_length[6]|max_length[50]|xss_clean|matches[NEW_PASSWORD]'
            )
        );
        return $rules['change_password_rule'];
    }

    public function get_login_rules()
    {
        $rules['login_rule'] = array(
            array(
                'field' => 'EN_PASSWORD',
                'label' => 'Password',
                'rules' => 'required|min_length[6]|max_length[50]|xss_clean'
            )
        );
        return $rules['login_rule'];
    }

    public function get_id_login_rules()
    {
        $rules['id_login_rule'] = array(
            array(
                'field' => 'ID_LOGIN',
                'label' => 'Username',
                'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[50]'
            )
        );
        return $rules['id_login_rule'];
    }

    public function get_email_rules()
    {
        $rules['email_rule'] = array(
            array(
                'field' => 'TX_USEREMAIL',
                'label' => 'Email Address',
                'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
            )
        );
        return $rules['email_rule'];
    }

    public static function create_user_rules()
    {
        $rules['create_user_rules'] = array(
            array(
                'field' => 'user_name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]|custom_validate_name_user'
            ),
            array(
                'field' => 'user_role',
                'label' => 'Role',
                'rules' => 'required'
            ),
            array(
                    'field' => 'phone_number',
                    'label' => 'Phone number',
                    'rules' => 'required'
            )
        );
        return $rules['create_user_rules'];
    }

    public static function update_user_rule()
    {
        $rules['update_user_rule'] = array(
            array(
                'field' => 'user_name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[50]|custom_validate_name_user'
            ),
            array(
                'field' => 'user_role',
                'label' => 'Role',
                'rules' => 'required'
            )
        );
        return $rules['update_user_rule'];
    }

    public function update_training_session_rule()
    {
        $rules['update_training_session_rule'] = array(
            array(
                'field' => 'NM_SESSION',
                'label' => 'Name',
                'rules' => 'trim|required|min_length[6]|max_length[50]'
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

    public function create_training_session_rules()
    {
        $rules['create_training_session_rules'] = array(
            array(
                'field' => 'NM_SESSION',
                'label' => 'Name',
                'rules' => 'trim|required|min_length[6]|max_length[50]'
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
}
