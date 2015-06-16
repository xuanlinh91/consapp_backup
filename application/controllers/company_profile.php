<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Company_profile extends MY_Controller
{
    var $sort;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();

        $this->load->library(array('form_validation'));
        $this->load->model('t_company_profile');
        $this->load->model('t_tracking');
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
     * Start create company profile
     * @var $id Company Info ID Auto Increment
     * */
    public function start($id)
    {
        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $user_id = $sess_key['ID_USER'];
        if (!$this->is_super_admin()) {
            $assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user_id);

            if ($assigned_company != null && sizeof($assigned_company) >= 1) {
                foreach ($assigned_company as $key => $value) {
                    if ($value['ID_COMPANY_AI'] == $id) {
                        $check = 1;
                        break;
                    }
                }
                if (!isset($check) || $check != 1) {
                    $this->noti('You are not allowed to edit this company profile!');
                    redirect('home');
                }
            }
        }

        if ($id != null) {
            $company_info = $this->t_company_info->get_data_by_id('*', $id);
            $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
            if (sizeof($company_profile) <= 0) {
                // @todo : Check user permission
                $data_frofile = array(
                'ID_COMPANY' => $company_info['ID_COMPANY'],
                'NM_COMPANY' => $company_info['NM_COMPANY']
                );
                $new_compnay_profile = $this->t_company_profile->set_data($data_frofile);
                $data = array(
                'ID_COMPANY' => $company_info['ID_COMPANY'],
                'ID_SURVEY' => '0',
                'ID_PROFILE' => $new_compnay_profile,
                'ID_CONSULTANT' => $this->data['userdata']['ID_USER'],
                'ID_CONSULTANT_ORG' => $this->data['userdata']['ID_USER'],
                'DT_START' => date('Y-m-d H:i:s'),
                'STAGE_1' => TRACKING_AVAILABLE,
                'STAGE_2' => TRACKING_AVAILABLE,
                'STAGE_3' => TRACKING_AVAILABLE,
                'STAGE_4' => '0',
                'STAGE_5' => '0',
                'STAGE_6' => '0',
                'STAGE_7' => '0');
                $this->load->model('t_tracking');
                $this->t_tracking->set_data($data);
            }
            $this->redirect(array('company_profile', 'create', $id));
        }
    }

    /**
     * create company profile
     * @param $id
     */
    public function create($id)
    {
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        $this->set_page_title("Create company profile");
        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $user_id = $sess_key['ID_USER'];

        if (!$this->is_super_admin()) {
            $assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
            if ($assigned_company != null && sizeof($assigned_company) >= 1) {
                foreach ($assigned_company as $key => $value) {
                    if ($value['ID_COMPANY_AI'] == $id) {
                        $check = 1;
                        break;
                    }
                }
                if (!isset($check) || $check != 1) {
                    $this->noti('You are not allowed to edit this company profile!');
                    redirect('home');
                }
            } else {
                $this->noti('You are not allowed to edit this company profile!');
                redirect('home');
            }
        }

        if ($id != null) {
            $this->data['id_ai'] = $id;
            $company_info = $this->t_company_info->get_data_by_id('*', $id);
            $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
            if (sizeof($company_profile) <= 0) {
                $this->noti('Invalid request for creating Company profile!');
                redirect('home');
            }
            $this->data['company_profile'] = $company_info;
            $id_checked = $company_info['ID_COMPANY'];
            $this->data['id_selected'] = $id_checked;
            $nm_checked = $company_info['NM_COMPANY'];
            $this->data['nm_selected'] = $nm_checked;
            // $this->t_tracking->update_stage_by_id(STAGE_1, $company_info['ID_COMPANY']);
        }

        $industry_list = $this->t_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Industry'));
        if (count($industry_list) > 0) {
            $this->data['industry_list'] = $industry_list;
        }

        $company_industry = array();
        foreach ($industry_list as $key => $value) {
            $val = $value['VALUE'];
            $company_industry[$val] = $value['VALUE'];
        }

        $this->data['industry_info'] = $company_industry;
        $type_list = $this->t_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Type'));
        if (count($type_list) > 0) {
            $this->data['type_list'] = $type_list;
        }

        $company_type = array();
        foreach ($type_list as $key => $value) {
            $val = $value['VALUE'];
            $company_type[$val] = $value['VALUE'];
        }

        $this->data['type_info'] = $company_type;
        $scope_list = $this->t_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Scope_Of_Operation'));
        if (count($scope_list) > 0) {
            $this->data['scope_list'] = $scope_list;
        }

        $company_scope = array();
        foreach ($scope_list as $key => $value) {
            $val = $value['VALUE'];
            $company_scope[$val] = $value['VALUE'];
        }

        $this->data['scope_info'] = $company_scope;
        if ($this->session->userdata('CREATE_PROFILE')) {
            $this->session->userdata('CREATE_PROFILE');
            foreach ($this->session->userdata('CREATE_PROFILE') as $key => $value) {
                $this->data[$key] = $value;
            }
            $this->data['company_id'] = $this->data['company_id_hidden'];
            $this->data['company_name'] = $this->data['company_name_hidden'];
            $tmp = $this->session->userdata('CREATE_PROFILE');
            $this->session->unset_userdata('CREATE_PROFILE');
            $industry_checked = $tmp['nm_industry'];
            $type_checked = $tmp['nm_type'];
            $scope_checked = $tmp['nm_scope'];
            $this->data['industry_selected'] = $industry_checked;
            $this->data['type_selected'] = $type_checked;
            $this->data['scope_selected'] = $scope_checked;
        }

        $this->data['validate_error'] = true;
        $tracking = $this->t_tracking->getActiveTracking($id);

        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $id;
        } else {
            $this->data['tracking_record']['company_id'] = $id;
        }
        $this->view('default', 'company_profile/create', $this->data, true);


    }

    /**
     * edit company profile
     * @param $id
     */
    public function edit($id)
    {
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        $this->set_page_title("Edit company profile");
        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $user_id = $sess_key['ID_USER'];
        $session_id = $this->session->userdata('session_id');
        $temp = $this->t_tracking->get_active_profile($id);
        if($temp != null){
            if (is_company_locked($temp , $session_id, LOCK_COMPANY_PROFILE) === true) {
                $this->noti('This profile is locking, you cannot edit!');
                $segment = array('home');
                $this->redirect($segment);
            } else {
                lock_company($temp, $session_id, LOCK_COMPANY_PROFILE);
            }
        }

        if (!$this->is_super_admin()) {
            $assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
            if ($assigned_company != null && sizeof($assigned_company) >= 1) {
                foreach ($assigned_company as $key => $value) {
                    if ($value['ID_COMPANY_AI'] == $id) {
                        $check = 1;
                        break;
                    }
                }
                if (!isset($check) || $check != 1) {
                    $this->noti('You are not allowed to edit this company profile!');
                    redirect('home');
                }
            } else {
                $this->noti('You are not allowed to edit this company profile!');
                redirect('home');
            }
        }

        if ($id != null) {
            $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
            if (sizeof($company_profile) <= '0') {
                // @todo : Check user permission
                $this->noti('This profile is not existed!');
                $this->redirect(site_url());
            }
            elseif ($company_profile[0]['NM_CEO'] == '' || is_null($company_profile[0]['NM_CEO'])) {
                $this->redirect(array('company_profile', 'create', $id));
            }
            $company_profile = $company_profile[0];
            $this->data['company_profile'] = $company_profile;
            $id_checked = $company_profile['ID_COMPANY'];
            $this->data['id_selected'] = $id_checked;
            $nm_checked = $company_profile['NM_COMPANY'];
            $this->data['nm_selected'] = $nm_checked;
            $industry_checked = $company_profile['NM_INDUSTRY'];
            $this->data['industry_selected'] = $industry_checked;
            $type_checked = $company_profile['NM_TYPE'];
            $this->data['type_selected'] = $type_checked;
            $scope_checked = $company_profile['NM_SCOPE'];
            $this->data['scope_selected'] = $scope_checked;
            $status = $company_profile['ID_STATUS'];
            $this->data['status'] = $status;
        }

        $industry_list = $this->t_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Industry'));
        if (count($industry_list) > 0) {
            $this->data['industry_list'] = $industry_list;
        }

        $company_industry = array();
        foreach ($industry_list as $key => $value) {
            $val = $value['VALUE'];
            $company_industry[$val] = $value['VALUE'];
        }

        $this->data['industry_info'] = $company_industry;

        $type_list = $this->t_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Type'));
        if (count($type_list) > 0) {
            $this->data['type_list'] = $type_list;
        }

        $company_type = array();
        foreach ($type_list as $key => $value) {
            $val = $value['VALUE'];
            $company_type[$val] = $value['VALUE'];
        }

        $this->data['type_info'] = $company_type;

        $scope_list = $this->t_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Scope_Of_Operation'));

        if (count($scope_list) > 0) {
            $this->data['scope_list'] = $scope_list;
        }

        $company_scope = array();
        foreach ($scope_list as $key => $value) {
            $val = $value['VALUE'];
            $company_scope[$val] = $value['VALUE'];
        }

        $this->data['scope_info'] = $company_scope;
        if ($this->session->userdata('UPDATE_PROFILE')) {
            $this->session->userdata('UPDATE_PROFILE');
            foreach ($this->session->userdata('UPDATE_PROFILE') as $key => $value) {
                $this->data[$key] = $value;
            }

            $this->data['company_id'] = $this->data['company_id_hidden'];
            $this->data['company_name'] = $this->data['company_name_hidden'];
            $tmp = $this->session->userdata('UPDATE_PROFILE');
            $this->session->unset_userdata('UPDATE_PROFILE');
            $industry_checked = $tmp['nm_industry'];
            $type_checked = $tmp['nm_type'];
            $scope_checked = $tmp['nm_scope'];
            $this->data['industry_selected'] = $industry_checked;
            $this->data['type_selected'] = $type_checked;
            $this->data['scope_selected'] = $scope_checked;
            $this->data['status'] = $tmp['nm_status'];
        }
        $this->data['validate_error'] = true;
        $tracking = $this->t_tracking->getActiveTracking($id);

        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $id;
        } else {
            $this->data['tracking_record']['company_id'] = $id;
        }
        $this->data['company_id_ai'] = $id;
        $this->view('default', 'company_profile/edit', $this->data, true);
    }

    /**
     * save data
     */
    public function save()
    {
        $record = $this->input->post();
        $this->form_validation->set_rules(Company_rules::company_profile_rules());
        if ($this->form_validation->run() == TRUE) {
            $data_profile = array(
                'NM_CEO' => $record['ceo_name'],
                'NM_DESIGNATION1' => $record['designation1'],
                'N_HP1' => $record['phone1'],
                'N_EMAIL1' => $record['email1'],
                'NM_HR' => $record['hr_rep_name'],
                'NM_DESIGNATION2' => $record['designation2'],
                'N_HP2' => $record['phone2'],
                'N_EMAIL2' => $record['email2'],
                'NM_INDUSTRY' => $record['nm_industry'],
                'NM_TYPE' => $record['nm_type'],
                'NM_SCOPE' => $record['nm_scope'],
                'N_L_REVENUE' => $record['local_revenue'],
                'N_O_REVENUE' => $record['overseas_revenue'],
                'N_GROSS' => $record['gross_profit'],
                'N_LOCAL_STAFF' => $record['total_local_staff'],
                'N_UNI' => $record['university_graduate'],
                'N_POLY' => $record['poly_graduate'],
                'N_ITE' => $record['ite_graduate'],
                'N_PARTTIME' => $record['local_staff_part_time'],
                'N_L_HR' => $record['local_hr_team'],
                'N_OVERSEAS_STAFF' => $record['total_overseas_staff'],
                'N_OVERSEAS_HR' => $record['overseas_hr_team_size'],
                'N_L_RETENTION' => $record['local_staff_retention'],
                'N_O_RETENTION' => $record['overseas_staff_retention'],
                'N_L_TURNOVER' => $record['local_staff_turnover'],
                'N_O_TURNOVER' => $record['overseas_staff_turnover'],
                'N_TRAINING_COST' => $record['training_cost'],
                'N_TRAINING_PARTICIPATION' => $record['training_participation'],
            );
            $company_profile_active = $this->t_company_profile->getActiveCompanyProfile($record['id_ai']);
            $id_profile = $company_profile_active[0]['ID_AI'];

            // Update stage for tracking summary
            $stage_1 = 0;
            $segment = array();
            if ($record['submit'] == 'Save') {
                $this->t_company_profile->update_data_by_id($data_profile,$id_profile);
                $this->noti('Save company profile success!', 'success');
                $stage_1 = TRACKING_IN_PROGRESS;
                $segment = array('company_profile', 'edit', $record['id_ai']);

            } elseif ($record['submit'] == 'Submit') {
                $this->t_company_profile->update_data_by_id($data_profile,$id_profile);
                $stage_1 = TRACKING_COMPLETED;
                $segment = array('interview', 'create', $record['id_ai']);
            }
            $this->t_tracking->updateStageByCompanyID($record['id_ai'],array('STAGE_1'=>$stage_1));
            if ($this->t_tracking->checkActiveBeforeGoToSurvey($record['id_ai'])) {
                $survey_stage = $this->t_tracking->getStageStatus($record['id_ai'],'STAGE_4');
                if ($survey_stage == '0') {
                    $this->t_tracking->updateStageByCompanyID($record['id_ai'], array('STAGE_4' => TRACKING_AVAILABLE));
                }
                $segment = array('interview', 'create', $record['id_ai']);
            }
            $this->redirect($segment);

        } else {
            $list_of_errors = validate_load(Company_rules::company_profile_rules());
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('CREATE_PROFILE', $this->input->post());
            if ($this->session->userdata('CREATE_PROFILE')) {
                $this->session->userdata('CREATE_PROFILE');
                $segment = array($this->router->class, 'create', $record['id_ai']);
            }

            $this->redirect($segment);
        }
    }

    /**
     * update data
     */
    public function update()
    {
        $record = $this->input->post();
        $session_id = $this->session->userdata('session_id');
        if (is_company_locked($record['id_ai'], $session_id, LOCK_COMPANY_PROFILE) === true) {
            $this->noti('This profile is locking, you cannot edit!');
            $segment = array('home');
            $this->redirect($segment);
        } else {
            lock_company($record['id_ai'], $session_id, LOCK_COMPANY_PROFILE);
        }
        $this->form_validation->set_rules(Company_rules::company_profile_rules());
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'NM_CEO' => $record['ceo_name'],
                'NM_DESIGNATION1' => $record['designation1'],
                'N_HP1' => $record['phone1'],
                'N_EMAIL1' => $record['email1'],
                'NM_HR' => $record['hr_rep_name'],
                'NM_DESIGNATION2' => $record['designation2'],
                'N_HP2' => $record['phone2'],
                'N_EMAIL2' => $record['email2'],
                'NM_INDUSTRY' => $record['nm_industry'],
                'NM_TYPE' => $record['nm_type'],
                'NM_SCOPE' => $record['nm_scope'],
                'N_L_REVENUE' => $record['local_revenue'],
                'N_O_REVENUE' => $record['overseas_revenue'],
                'N_GROSS' => $record['gross_profit'],
                'N_LOCAL_STAFF' => $record['total_local_staff'],
                'N_UNI' => $record['university_graduate'],
                'N_POLY' => $record['poly_graduate'],
                'N_ITE' => $record['ite_graduate'],
                'N_PARTTIME' => $record['local_staff_part_time'],
                'N_L_HR' => $record['local_hr_team'],
                'N_OVERSEAS_STAFF' => $record['total_overseas_staff'],
                'N_OVERSEAS_HR' => $record['overseas_hr_team_size'],
                'N_L_RETENTION' => $record['local_staff_retention'],
                'N_O_RETENTION' => $record['overseas_staff_retention'],
                'N_L_TURNOVER' => $record['local_staff_turnover'],
                'N_O_TURNOVER' => $record['overseas_staff_turnover'],
                'N_TRAINING_COST' => $record['training_cost'],
                'N_TRAINING_PARTICIPATION' => $record['training_participation'],
                'ID_STATUS' => $record['nm_status']
            );

            $company_profile_active = $this->t_company_profile->getActiveCompanyProfile($record['company_id_ai']);
            $id_profile = $company_profile_active[0]['ID_AI'];

            if ($record['nm_status'] == 1) {
                $this->noti('Delete company profile success!', 'success');
                unlock_company($record['id_ai'], $session_id, 2);
                $this->t_company_profile->update_data_by_id($data,$id_profile);
                $segment = array('home', 'index');
                $this->redirect($segment);
            }

            if ($record['submit'] == 'Save') {
                unlock_company($record['id_ai'], $session_id, 2);
                $this->t_company_profile->update_data_by_id($data,$id_profile);
                $this->noti('Save company profile success!', 'success');
                $segment = array('company_profile', 'edit', $record['company_id_ai']);
                $this->redirect($segment);
            } elseif ($record['submit'] == 'Submit') {
                unlock_company($record['id_ai'], $session_id, LOCK_COMPANY_PROFILE);
                $this->t_company_profile->update_data_by_id($data,$id_profile);
                $this->t_tracking->updateStageByCompanyID($record['company_id_ai'],array('STAGE_1'=>TRACKING_COMPLETED));
                if ($this->t_tracking->checkActiveBeforeGoToSurvey($record['company_id_ai'])) {
                    $survey_stage = $this->t_tracking->getStageStatus($record['company_id_ai'],'STAGE_4');
                    if ($survey_stage == '0') {
                        $this->t_tracking->updateStageByCompanyID($record['company_id_ai'], array('STAGE_4' => TRACKING_AVAILABLE));
                    }
                }
                $segment = array('interview', 'create', $record['company_id_ai']);
                $this->redirect($segment);
            }

        } else {
            $list_of_errors = validate_load(Company_rules::company_profile_rules());
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('UPDATE_PROFILE', $this->input->post());
            if ($this->session->userdata('UPDATE_PROFILE')) {
                $segment = array($this->router->class, 'edit', $record['company_id_ai']);
            }

            $this->redirect($segment);
        }
    }

    /**delete company profile
     * @param $id_ai
     * @param $id_info
     */
    public function delete_profile($id_ai, $id_info)
    {
        $this->t_company_profile->update_data_by_id(array('ID_STATUS' => '2'), $id_ai);
        $this->noti('Survey deleted successfully!', 'success');
        $segment = array('home', 'view_report', $id_info);
        $this->redirect($segment);
    }
}