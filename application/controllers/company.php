<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Company extends MY_Controller
{
    var $sort;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();
        $this->load->library(array('form_validation'));
        $this->load->model('t_company_assignment');
        $this->load->model('t_company_info');
        $this->load->model("t_growth_stage");
        $this->load->model("t_dropdown");
        $this->load->model("t_user");
        $this->load->model('t_survey_response_hdr');
        $this->load->helper('form');
        $this->load->library(array('form_validation'));
        $this->load->file(APPPATH . 'models/form_validation/company_rules.php', false);
        $this->sort = 'asc';
    }

    /**
     * Display view.
     */
    public function index()
    {
        $this->set_page_title("Company info");
        $this->check_role(array(4), 1);
        $this->delete_session_rubish();
        $this->view('default', 'company/menu', $this->data);
    }

    /**
     * filter data and paging
     * @param int $offset
     * @param string $sort
     * @param null $txt_search
     */
    public function filters($offset = 0, $sort = 'ascsort_2', $txt_search = null)
    {
        $this->check_role(array(ROLE_RESTRICTED), 1);
        $this->set_page_title("Search company info");
        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $org = $sess_key['ID_USER'];
        if ($this->is_admin()) {
            $org = null;
        }
        if ($this->input->post('action') != 'Search' && $offset === 0) {
            $this->session->unset_userdata('COMPANY_SEARCH');
        }
        $company_list = $this->t_company_info->get_company_json('NM_COMPANY as value,ID_COMPANY as data', $org);
        $company_list_both = $this->t_company_info->get_company_json('ID_COMPANY as value,NM_COMPANY as data', $org);
        if (count($company_list_both) > 0) {
            foreach ($company_list_both as $value) {
                array_push($company_list, $value);
            }
        }

        $this->data['company_ac'] = json_encode($company_list);

        if ($this->input->post('action')) {
            $txt_search = $this->input->post('NM_COMPANY');
            $this->session->set_userdata('COMPANY_SEARCH', $txt_search);
        } else {
            $txt_search = $this->session->userdata('COMPANY_SEARCH');
        }

        if ($this->is_user()) {
            $total_rows = $this->t_company_assignment->get_count_company($txt_search, $org);

        } else {
            $total_rows = count($this->t_company_info->get_data_company(null, null, $txt_search));
        }

        $this->load->library('pagination');
        $config['per_page'] = PER_IN_PAGE;
        $config['next_link'] = 'Next »';
        $config['prev_link'] = '« Prev';
        $config['num_links'] = NUM_LINK_PAGINATION;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['total_rows'] = $total_rows;
        $config['base_url'] = site_url('/company/filters/');
        $config['uri_segment'] = 3;
        $config['sort'] = $sort;
        $this->sort = $sort;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment(3) == 0) ? 0 : $this->uri->segment(3);
        $this->data['pagination'] = $pagination;
        if ($this->is_user()) {
            $this->data['result_search'] = $this->t_company_info->get_assigned_company($config['per_page'], $offset, $txt_search, $org);
        } else {
            $this->data['result_search'] = $this->t_company_info->get_data_company($config['per_page'], $offset, $txt_search);
        }

        $this->data['txt_search'] = $txt_search;
        $this->data['data_search'] = $txt_search;
        $st = explode('sort_', $sort);
        $this->data['sort'] = $st[0];

        if ($st[0] == 'asc') {
            $offset = $offset;
        } else {
            $offset = $total_rows - $offset;
        }
        $this->data['offset'] = $offset;
        $this->data['per_in_page'] = PER_IN_PAGE;
        $this->data['actor'] = $config['base_url'];
        $this->view('default', 'company/filters', $this->data);
    }

    /**
     * create company info
     */
    public function create()
    {
        $this->check_role(array(ROLE_RESTRICTED), 1);
        $this->set_page_title("Create Company Info");
        $user_list = $this->t_user->get_list_user_by_role();

        if (count($user_list) > 0) {
            $this->data['user_list'] = $user_list;
        }

        if ($this->session->userdata('COMPANY_CREATE')) {

            foreach ($this->session->userdata('COMPANY_CREATE') as $key => $value) {
                $this->data[$key] = $value;
            }
            $ses_userdata = $this->session->userdata('COMPANY_CREATE');

            $list_officer_reselected = array();
            if (isset($ses_userdata['assigned_officer'])) {
                foreach ($ses_userdata['assigned_officer'] as $key => $value) {
                    $user_name = $this->t_user->get_data_by_id('USER_NAME', $value);
                    $list_officer_reselected[$value] = $user_name['USER_NAME'];
                }
            }
            $this->data['target'] = $list_officer_reselected;
            $this->session->unset_userdata('COMPANY_CREATE');
        }
        $this->data['validate_error'] = true;

        $this->view('default', 'company/create', $this->data);
    }

    /**
     * save data
     */
    public function save()
    {
        $record = $this->input->post();
        $target['assigned_officer'] = $record['assigned_officer'];
        $arr_select = $target['assigned_officer'];
        $is_duplicated = implode('.', $arr_select);
        $this->form_validation->set_rules(Company_rules::get_company_create_info_rules());
        $this->form_validation->set_rules('assigned_officer[]', 'Assigned officer', 'required|xss_clean|callback_duplicate_officer['.$is_duplicated.']');

        if ($this->form_validation->run()) {

            $company_id = $record['company_id'];
            $company_respondent = $record['respondent_name'];
            $company_designation = $record['designation'];
            $this->data['company_id'] = $company_id;
            $this->data['submit'] = $record['submit'];
            $company_name = $record['company_name'];
            $data2 = array(
                'ID_COMPANY' => $company_id,
                'NM_COMPANY' => $company_name,
                'NM_RESPONDENT' => $company_respondent,
                'ID_CONSULTANT' => $this->data['userdata']['ID_USER'],
                'ID_CONSULTANT_ORG' => $this->data['userdata']['NM_ORGANISATION'],
                'NM_DESIGNATION' => $company_designation,
                'DATE_CREATION' => date("Y-m-d H:i:s")
            );

            $new_company_info = $this->t_company_info->set_data($data2);
            foreach ($arr_select as $key => $value) {
                $id_consultant_org = $this->t_user->get_data_by_id('*', $value);
                $data1['ID_COMPANY'] = $new_company_info;
                $data1['ID_CONSULTANT'] = $value;
                $data1['ID_CONSULTANT_ORG'] = $id_consultant_org['USER_ORG'];
                $data1['ID_PRIMARY'] = IS_NOT_PRIMARY;
                if ($key == '0') {
                    $data1['ID_PRIMARY'] = IS_PRIMARY;
                }
                $this->t_company_assignment->set_data($data1);
            }
            $this->noti('New company info has created', 'success');
            redirect('company/filters/');

        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $ext_field = array(
                array(
                    'field' => 'assigned_officer[]',
                    'label' => 'Officer'
                )
            );
            $list_of_errors = validate_load(Company_rules::get_company_create_info_rules());
            $list_ext = validate_load($ext_field);
            array_push($list_of_errors, $list_ext[0]);
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('COMPANY_CREATE', $this->input->post());
            if ($this->session->userdata('COMPANY_CREATE')) {
                $segment = array($this->router->class, 'create');
            }

            $this->redirect($segment);
        }
    }

    /**
     * edit company info
     * @param $id
     */
    public function edit($id)
    {
        $this->check_role(array(ROLE_RESTRICTED), 1);
        $this->set_page_title("Edit company info");
        $user_list = $this->t_user->get_list_user_by_role();
        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $user_id = $sess_key['ID_USER'];
        $session_id = $this->session->userdata('session_id');

        if (is_company_locked($id, $session_id) === true) {
            $this->noti('This company is locking, you cannot edit!');
            $segment = array($this->router->class, 'filters');
            $this->redirect($segment);
        } else {
            lock_company($id, $session_id);
        }

        if (!$this->is_super_admin() && !$this->is_agency_admin()) {
            $assigned_company = $this->t_company_info->get_assigned_company_info($user_id);
            if ($assigned_company != null && sizeof($assigned_company) >= 1) {
                foreach ($assigned_company as $key => $value) {
                    if ($value['ID_COMPANY_AI'] == $id) {
                        $check = 1;
                        break;
                    }
                }
                if (!isset($check) || $check != 1) {
                    $this->noti('You are not allowed to edit this company info!');
                    $segment = array($this->router->class, 'filters');
                    $this->redirect($segment);
                }
            }
        }

        if (count($user_list) > 0) {
            $this->data['user_list'] = $user_list;
        }

        $company_info = $this->t_company_info->get_data_by_id('*', $id);
        $this->data['company_list'] = $company_info;
        if($this->is_super_admin() || $this->is_agency_admin()){
            $list_officer_selected = $this->t_company_assignment->get_list_dropdown($id,'');
        } else {
            $leader_officer = $this->t_company_assignment->get_lead_officer($id);
            $this->data['leader_officer'] = $leader_officer;
            $list_officer_selected = $this->t_company_assignment->get_list_dropdown($id,$user_id);
        }

        $this->data['list_officer_selected'] = $list_officer_selected;

        if ($this->session->userdata('COMPANY_UPDATE')) {
            foreach ($this->session->userdata('COMPANY_UPDATE') as $key => $value) {
                $this->data[$key] = $value;
            }
            $ses_userdata = $this->session->userdata('COMPANY_UPDATE');
            $this->data['ses_userdata'] = $ses_userdata;
            $list_officer_reselected = array();
            if (isset($ses_userdata['assigned_officer'])) {
                foreach ($ses_userdata['assigned_officer'] as $key => $value) {
                    $user_name = $this->t_user->get_data_by_id('USER_NAME', $value);
                    $list_officer_reselected[$value] = $user_name['USER_NAME'];
                }
            }
            if($this->is_user()){
                $leader_officer = $this->t_company_assignment->get_lead_officer($id);
                $this->data['leader_officer'] = $leader_officer;
            }
            $this->data['target'] = $list_officer_reselected;
        }

        $this->data['id'] = $id;
        $this->session->unset_userdata('COMPANY_UPDATE');
        $this->view('default', 'company/edit', $this->data);
    }

    /**
     * update data
     */
    public function update()
    {
        $record = $this->input->post();
        if($this->is_admin()){
            $target['assigned_officer'] = $record['assigned_officer'];
            $arr_select = $target['assigned_officer'];
            $is_duplicated = implode('.', $arr_select);
        }

        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $user_id = $sess_key['ID_USER'];
        $session_id = $this->session->userdata('session_id');
        if (isset($record['id_company_ai']) && $record['id_company_ai'] != '') {
            $this->form_validation->set_rules(Company_rules::get_company_update_info_rules());
            if($this->is_admin()){
                $this->form_validation->set_rules('assigned_officer[]', 'Assigned officer', 'required|callback_duplicate_officer['.$is_duplicated.']');
            }

            if (is_company_locked($record['id_company_ai'] === true, $session_id)) {
                $this->noti('This company is locking, you cannot edit!');
                $segment = array($this->router->class, 'filters');
                $this->redirect($segment);
            } else {
                lock_company($record['id_company_ai'], $session_id);
            }
        }

        if (!$this->is_admin()) {
            $assigned_company = $this->t_company_info->get_assigned_company_info($user_id);
            if ($assigned_company != null && sizeof($assigned_company) >= 1) {
                foreach ($assigned_company as $key => $value) {
                    if ($value['ID_COMPANY_AI'] == $record['id_company_ai']) {
                        $check = 1;
                        break;
                    }
                }
                if (!isset($check) || $check != 1) {
                    $this->noti('You are not allowed to edit this company info!');
                    $this->redirect('home');
                }
            }
        }

        if ($this->form_validation->run()) {
            if($this->is_admin()){
                $target['assigned_officer'] = $record['assigned_officer'];
                $arr_select = $target['assigned_officer'];
            }
            $company_id = $record['company_id'];
            $this->data['company_id'] = $company_id;
            // update t_company_info table
            $data_info = array(
                'ID_COMPANY' => $company_id,
                'NM_COMPANY' => $record['company_name'],
                'NM_RESPONDENT' => $record['respondent_name'],
                'ID_CONSULTANT' => $this->data['userdata']['NM_USER'],
                'ID_CONSULTANT_ORG' => $this->data['userdata']['NM_ORGANISATION'],
                'NM_DESIGNATION' => $record['designation']
            );
            $this->t_company_info->update_data_by_property($data_info, array('ID_COMPANY' => $company_id));
            // update t_company_profile table
            $data_profile = array(
                'NM_COMPANY' => $record['company_name']
            );
            $this->t_company_profile->update_data_by_property($data_profile, array('ID_COMPANY' => $company_id));
            unlock_company($record['id_company_ai'], $session_id);
            // update t_company_assignment table
            if($this->is_admin()){
                $this->t_company_assignment->remove($record['id_company_ai']);
                if(isset($record['leader_officer'])){
                    array_unshift($arr_select, $record['leader_officer']);
                }
                foreach ($arr_select as $key => $value) {
                    $id_consultant_org = $this->t_user->get_data_by_id('*', $value);
                    $data_assigned['ID_COMPANY'] = $record['id_company_ai'];
                    $data_assigned['ID_CONSULTANT'] = $value;
                    $data_assigned['ID_CONSULTANT_ORG'] = $id_consultant_org['USER_ORG'];
                    $data_assigned['ID_PRIMARY'] = IS_NOT_PRIMARY;
                    if ($key == '0') {
                        $data_assigned['ID_PRIMARY'] = IS_PRIMARY;
                    }
                    $this->t_company_assignment->set_data($data_assigned);
                }
            }
            $this->noti('Company info has updated','success');
            $segment = array($this->router->class, 'filters');
            $this->redirect($segment);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $ext_field = array(
                array(
                    'field' => 'assigned_officer[]',
                    'label' => 'Officer'
                )
            );
            $list_of_errors = validate_load(Company_rules::get_company_update_info_rules());
            array_push($list_of_errors, validate_load($ext_field));
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('error_mess_code', validation_errors());
            $this->session->set_userdata('COMPANY_UPDATE', $this->input->post());

            if ($this->session->userdata('COMPANY_UPDATE')) {
                $segment = array($this->router->class, 'edit', $record['id_company_ai']);
            }

            $this->redirect($segment);
        }
    }

    /**
     * check duplicate officer
     * @param $value
     * @param $params
     * @return bool
     */
    function duplicate_officer($value , $params){
        $arr = explode('.', $params);
        $this->form_validation->set_message('duplicate_officer', 'The %s field can not be duplicated');
        if(count(array_unique($arr))<count($arr)){
            return false;
        } else {
            return true;
        }
    }
}