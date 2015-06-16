<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    var $page_title;
    var $data;
    var $admin_role;

    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
        $this->data = array();
        if ($this->router->method != 'load_view_step') {
            $this->data = array();
        }

        include_once("application/core/MY_Output.php");
        $this->output->nocache();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->helper('script');
        $this->load->model('t_survey_response_hdr');
        $this->load->model('t_org_mapping');
        $this->load->model('t_company_assignment');
        $this->load->model('t_company_info');
        $this->load->model('t_company_profile');
        $this->load->model('t_tracking');

        $CI->lang->load('en', 'english');
        $CI->load->library('session');
        if ($this->session->userdata(USER_SESSION_KEY)) {
            $this->load->model('t_user');
            $user = $this->session->userdata(USER_SESSION_KEY);
            $w = array('ID_LOGIN' => $user['ID_LOGIN']);
            $user_data = $this->t_user->get_data_by_property('*', $w);
            if (count($user_data) > 0) {
                $this->data['userdata'] = $user_data[0];
            }
        }
    }

    /**
     * [__configure description]
     * @return [type] [description]
     */
    protected function __configure()
    {
        // Write total config here
    }

    /**
     * [__unset unset session or other things]
     */
    protected function _unset()
    {
        if ($this->router->method != 'create') {
            $this->session->unset_userdata('data_step_1');
            $this->session->unset_userdata('data_step_2');
            $this->session->unset_userdata('data_step_3');
        }

        if ($this->router->method != 'edit') {
            $this->session->unset_userdata('edit_step_1');
            $this->session->unset_userdata('edit_step_2');
            $this->session->unset_userdata('edit_step_3');
            $this->session->unset_userdata('id_company');
            $this->session->unset_userdata('is_admin');
            $this->session->unset_userdata('nm_company');
        }

        if ($this->router->method != 'take_survey') {
            $this->session->unset_userdata('take_survey');
            $this->session->unset_userdata('time_take_survey');
            $this->session->unset_userdata('time_flag');
            $this->session->unset_userdata('survey_data_answer');
            $this->session->unset_userdata('id_company');
        }

        if ($this->router->method != 'update_survey') {
            $this->session->unset_userdata('update_survey');
            $this->session->unset_userdata('time_take_survey_update');
            $this->session->unset_userdata('time_flag_update');
            $this->session->unset_userdata('survey_data_update');
        }
    }

    public function set_page_title($title = '')
    {
        if (!empty($title)) {
            $this->page_title = $title . PREFIX_SUB_PAGE . SUB_PAGE;
        } else {
            $title = "Home page";
            $this->page_title = $title . PREFIX_SUB_PAGE . SUB_PAGE;
        }
    }

    /**
     * [view description]
     * @param  string $template [dir of template]
     * @param  [type] $dir         [dir of view]
     * @param  [type] $layout_data [data parse]
     * @return [interface]              [interface]
     */
    protected function view($template = 'default', $dir, $layout_data, $is_tracking = false)
    {
        if (strlen($dir) > 0) {
            $dir_explode = explode('/', $dir);
            if (count($dir_explode) > 1) {
                $dir = null;
                for ($i = 0; $i < count($dir_explode); $i++) {
                    if ($i == (count($dir_explode) - 2)) {
                        $dir .= $dir_explode[$i];
                        break;
                    } else {
                        $dir .= $dir_explode[$i] . '/';
                    }
                }

                $content = $this->load->view($dir . '/' . $dir_explode[count($dir_explode) - 1], $layout_data, true);
            } else {
                $content = $this->load->view($dir, $this->data, true);
            }

            $layout_data['template_name'] = $template;
            $layout_data['content'] = $content;
            $layout_data['tracking_data'] = $layout_data;
            if ($is_tracking) {
                $layout_data['is_tracking'] = true;
            }

            $this->load->view("shared/main", $layout_data);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', "Cant not load file $dir");
        }
    }

    /**
     * [redirect description]
     * @param  [array] $segments [config controller name, method, param]
     * @return [interface]           [interface follow url parse from $segments]
     */
    protected function redirect($segments = null)
    {
        $url = site_url();
        if (!empty($segments) && (count($segments) > 0)) {
            foreach ($segments as $key => $value) {
                if ($value != null) {
                    $url .= '/' . $value;
                }
            }
        }

        redirect($url);
    }

    /**
     * [is_login description]
     * @return boolean [check user login]
     */
    public function is_login()
    {
        if ($this->session->userdata(USER_SESSION_KEY)) {
            return true;
        }

        return false;
    }

    /**
     * [require_login description]
     * @return [type] [Required user login before access a method]
     */
    public function require_login()
    {
        $segments = array('users', 'login');
        $this->redirect($segments);
    }

    /**
     * [display_error description]
     * @param  array $data [array data setting]
     * @return [interface]       [error page notify]
     */
    public function display_error($data = array())
    {
        if (!isset($data['message']) || empty($data['message'])) {
            $data['message'] = 'Access! Deny';
        }

        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
        $this->session->set_userdata('error_flag_code', 1);
        $this->session->set_userdata('error_mess_code', $data['message']);
        $segments = array('home', 'index');
        $this->redirect($segments);
    }

    public function get_user_role()
    {
        $user = $this->session->userdata(USER_SESSION_KEY);
        $user_property = $this->t_user->get_data_by_id('*', $user['ID_USER']);
        $role = '';
        switch ($user_property['USER_ROLE']) {
            case 1:
                $role = ROLE_ADMIN;
                break;
            case 2:
                $role = ROLE_AGENCY;
                break;
            case 3:
                $role = ROLE_NORMAL;
                break;
            case 4:
                $role = ROLE_RESTRICTED;
                break;
            default:
                $role = null;
                break;
        }

        return $role;
    }

    /**
     * [is_manage check user is manage account]
     * @return boolean [true|false]
     * @author PhuTv
     */
    public function is_manage()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            // $role_manage = array(IN_ADMIN, IN_CONSULTANT);
            $this->load->model('t_user');
            $user_property = $this->t_user->get_data_by_id('*', $user['ID_USER']);
            if ($user_property['USER_ROLE'] == 2 || $user_property['USER_ROLE'] == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * [is_admin check user is admin account]
     * @return boolean [true|false]
     * @author PhuTv
     */
    public function is_super_admin()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($user['USER_ROLE'] == ROLE_ADMIN) {
                return true;
            }
        }

        return false;
    }

    public function is_admin()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($user['USER_ROLE'] == ROLE_ADMIN || $user['USER_ROLE'] == ROLE_AGENCY) {
                return true;
            }
        }

        return false;
    }

    public function is_agency_admin()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($user['USER_ROLE'] == ROLE_AGENCY) {
                return true;
            }
        }

        return false;
    }

    /**
     * [is_consultant check user is consultant account]
     * @return boolean [true|false]
     * @author PhuTv
     */
    public function is_consultant()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($user['USER_ROLE'] == ROLE_NORMAL || $user['USER_ROLE'] == ROLE_RESTRICTED) {
                return true;
            }
        }

        return false;
    }

    /**
     * [is_user check user mormal]
     * @return boolean [true|false]
     * @author PhuTv
     */
    public function is_user()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($user['USER_ROLE'] == ROLE_NORMAL) {
                return true;
            }
        }

        return false;
    }

    public function is_restrict_user()
    {
        if ($this->is_login()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($user['USER_ROLE'] == ROLE_RESTRICTED) {
                return true;
            }
        }

        return false;
    }

    public function  check_role($role = array(), $is)
    {
        if (!$this->is_login()) {
            $this->require_login();
        }
        $result = true;
        if ($is == 0) {
            foreach ($role as $role_value) {
                if ($role_value == ROLE_ADMIN) {
                    if (!$this->is_super_admin()) {
                        $result = false;
                        continue;
                    } else {
                        $result = true;
                        break;
                    }
                }

                if ($role_value == ROLE_AGENCY) {
                    if (!$this->is_agency_admin()) {
                        $result = false;
                        continue;
                    } else {
                        $result = true;
                        break;
                    }
                }

                if ($role_value == ROLE_NORMAL) {
                    if (!$this->is_user()) {
                        $result = false;
                        continue;
                    } else {
                        $result = true;
                        break;
                    }
                }

                if ($role_value == ROLE_RESTRICTED) {
                    if (!$this->is_restrict_user()) {
                        $result = false;
                        continue;
                    } else {
                        $result = true;
                        break;
                    }
                }
            }
        } else if ($is == 1) {
            foreach ($role as $role_value) {
                if ($role_value == ROLE_ADMIN) {
                    if ($this->is_super_admin()) {
                        $result = false;
                        break;
                    } else {
                        $result = true;
                        continue;
                    }
                }

                if ($role_value == ROLE_AGENCY) {
                    if ($this->is_agency_admin()) {
                        $result = false;
                        break;
                    } else {
                        $result = true;
                        continue;
                    }
                }

                if ($role_value == ROLE_NORMAL) {
                    if ($this->is_user()) {
                        $result = false;
                        break;
                    } else {
                        $result = true;
                        continue;
                    }
                }

                if ($role_value == ROLE_RESTRICTED) {
                    if ($this->is_restrict_user()) {
                        $result = false;
                        break;
                    } else {
                        $result = true;
                        continue;
                    }
                }
            }
        }
        if ($result == false) {
            $this->noti('You can\'t access this system.');
            $this->redirect(site_url());
        }
    }

    /**
     * [create_token description]
     * @return string [description]
     * format same : {16B0815F-589B-4F28-7A29-0B5A53DBD402}
     */
    public function create_token()
    {
        mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = substr($charid, 0, 8)
            . substr($charid, 8, 4)
            . substr($charid, 12, 4)
            . substr($charid, 16, 4)
            . substr($charid, 20, 12);
        return $uuid; // return example : {16B0815F-589B-4F28-7A29-0B5A53DBD402}
    }

    public function delete_session_rubish()
    {
        // $this->session->unset_userdata('data_search_take_survey');
        // $this->session->unset_userdata('survey');
        // $this->session->unset_userdata('data_search_update_survey');
        // $this->session->unset_userdata('data_search_report');
        // $this->session->unset_userdata('result_search');
    }

    public function noti($text, $result = 'error', $flagCode = 1)
    {
        if ($result == 'success') {
            $this->session->set_userdata('type_mess_code', SUCCESS_CLASS);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
        }

        $this->session->set_userdata('error_flag_code', $flagCode);
        $this->session->set_userdata('error_mess_code', $text);
    }

    public function company_control($id_company){
        if ($this->session->userdata(USER_SESSION_KEY)) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $user_id = $user['ID_USER'];
            if($this->is_super_admin()){
                return true;
            } elseif ($this->is_agency_admin()){
                $array_company_agency = $this->t_company_info->agency_get_mapped_company($user_id);
                $agency_assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
                $pos = (isset($array_company_agency) && count($array_company_agency) > 0) ? array_search($id_company, array_comlumnfx($array_company_agency, 'ID_COMPANY_AI')) : false;
                $pos_ass = (isset($agency_assigned_company) && count($agency_assigned_company) > 0) ? array_search($id_company, array_comlumnfx($agency_assigned_company, 'ID_COMPANY_AI')) : false;
                if ($pos !== false || $pos_ass !== false) {
                    return true;
                } else {
                    return false;
                }

            } elseif ($this->is_consultant()){
                $array_company_user = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
                $pos = (isset($array_company_user) && count($array_company_user) > 0) ? array_search($id_company, array_comlumnfx($array_company_user, 'ID_COMPANY_AI')) : false;
                if ($pos !== false) {
                    return true;
                } else {
                    return true;
                }
            }
        } else {
            $this->require_login();
        }
    }
}