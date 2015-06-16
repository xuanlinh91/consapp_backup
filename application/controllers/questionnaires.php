<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Questionnaires extends MY_Controller
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
     * Take questionaire by step
     * @var $id Company Info ID Auto
     * @return Redirect
     */
    public function take($id)
    {
        $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
        if (sizeof($company_profile) > 0) {
            $action_url = 'create_step_1';
            if ($company_profile['0']['ID_MS2'] != '') {
                $action_url = 'create_step_2';
            }
            if ($company_profile['0']['ID_LC3'] != '') {
                $action_url = 'create_step_3';
            }
            $segment = array($this->router->class, $action_url, $id);
            $this->redirect($segment);
        } else {
            $this->noti('This profile is not existed!');
            $this->redirect(array('home'));
        }
    }

    /**
     * view check question 1
     * @param $id
     */
    public function create_step_1($id)
    {
        $company_profile = $this->t_tracking->get_active_profile($id);
        $session_id = $this->session->userdata('session_id');
        if (is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== true && is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== false) {
            unlock_company($company_profile, $session_id, LOCK_COMPANY_PROFILE);
        }
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        $this->set_page_title("Question 1");
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
        $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
        if (sizeof($company_profile) > 0) {
            $this->data['company_profile'] = $company_profile['0'];
            // $this->t_tracking->update_stage_by_id(STAGE_3, $company_profile['0']['ID_COMPANY']);
        } else {
            $this->noti('This profile is not existed!');
            $this->redirect(array('home'));
        }
        $query = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_1'));
        // Check data
        if ($query) {
            $this->data['question_1'] = $query;
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'The question not found.');
            $segment = array($this->router->class, 'create', $this->data);
            $this->redirect($segment);
        }

        if (isset($this->session->userdata['STEP_1'])) {
            if (count($this->session->userdata['STEP_1'])) {
                $data_sess_step_1 = $this->session->userdata('STEP_1');
                $this->data['ID_GS1'] = $data_sess_step_1['ID_GS1'];
            }
        }
        $tracking = $this->t_tracking->getActiveTracking($id);
        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $id;
        } else {
            $this->data['tracking_record']['company_id'] = $id;
        }
        $this->view('default', 'questionnaire/question_1', $this->data, true);
    }

    /**
     * view check question 2
     * @param $id
     */
    public function create_step_2($id)
    {
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        $this->set_page_title("Question 2");
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
        $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
        if (sizeof($company_profile) > 0) {
            $this->data['company_profile'] = $company_profile['0'];
        } else {
            $this->noti('This profile is not existed!');
            $this->redirect(array('home'));
        }
        $query = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_2'));
        // Check data
        if ($query) {
            $this->data['question_2'] = $query;
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'The question not found');
            $segment = array($this->router->class, 'create', $this->data);
            $this->redirect($segment);
        }

        if (isset($this->session->userdata['STEP_1'])) {
            if (count($this->session->userdata['STEP_2'])) {
                $data_sess_step_2 = $this->session->userdata('STEP_2');
                $this->data['ID_MS2'] = $data_sess_step_2['ID_MS2'];
            }
        }
        $tracking = $this->t_tracking->getActiveTracking($id);
        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $id;
        } else {
            $this->data['tracking_record']['company_id'] = $id;
        }
        $this->view('default', 'questionnaire/question_2', $this->data, true);
    }

    /**
     * view check question 3
     * @param $id
     */
    public function create_step_3($id)
    {
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        $this->set_page_title("Question 3");
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

        $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
        if (sizeof($company_profile) > 0) {
            $this->data['company_profile'] = $company_profile['0'];
        } else {
            $this->noti('This profile is not existed!');
            $this->redirect(array('home'));
        }
        $query = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_3'));
        // Check data
        if ($query) {
            $this->data['question_3'] = $query;
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'The question not found');
            $segment = array($this->router->class, 'create', $this->data);
            $this->redirect($segment);
        }
        $tracking = $this->t_tracking->getActiveTracking($id);
        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $id;
        } else {
            $this->data['tracking_record']['company_id'] = $id;
        }
        $this->view('default', 'questionnaire/question_3', $this->data, true);
    }

    /**
     * submit question 1
     */
    public function submit_question_1()
    {
        $record = $this->input->post();
        $company_info = $this->t_company_info->get_data_by_property('*', array('ID_COMPANY' => $record['id_company']));
        $this->form_validation->set_rules(Company_rules::question_step_1());
        if ($record['submit'] == 'BACK') {
            $segment = array('interview', 'create', $company_info['ID_COMPANY_AI']);
        } else {
            if ($this->form_validation->run() && $record['submit'] == 'NEXT') {
                $data = array(
                    'ID_GS1' => $record['ID_GS1']
                );
                $this->t_company_profile->update_data_by_property($data, array('ID_COMPANY' => $record['id_company']));
                $stage_status = $this->t_tracking->getStageStatus($company_info['ID_COMPANY_AI'], 'STAGE_3');
                if ($stage_status && $stage_status != TRACKING_COMPLETED) {
                    $this->t_tracking->updateStageByCompanyID($company_info['ID_COMPANY_AI'], array('STAGE_3' => TRACKING_IN_PROGRESS));
                }
                $segment = array('questionnaires', 'create_step_2', $company_info['ID_COMPANY_AI']);
            } else {
                $this->noti('Please choice an answer!');
                $segment = array('questionnaires', 'create_step_1', $company_info['ID_COMPANY_AI']);
            }
        }

        $this->redirect($segment);
    }

    /**
     * submit question 2
     */
    public function submit_question_2()
    {
        $record = $this->input->post();
        $company_info = $this->t_company_info->get_data_by_property('*', array('ID_COMPANY' => $record['id_company']));
        $this->form_validation->set_rules(Company_rules::question_step_2());
        if ($record['submit'] == 'BACK') {
            $segment = array('questionnaires', 'create_step_1', $company_info['ID_COMPANY_AI']);
        } else {
            if ($this->form_validation->run() && $record['submit'] == 'NEXT') {
                $company_info = $this->t_company_info->get_data_by_property('*', array('ID_COMPANY' => $record['id_company']));
                $data = array(
                    'ID_MS2' => $record['ID_MS2']
                );
                $this->t_company_profile->update_data_by_property($data, array('ID_COMPANY' => $record['id_company']));
                $segment = array('questionnaires', 'create_step_3', $company_info['ID_COMPANY_AI']);
            } else {
                $this->noti('Please choice an answer!');
                $segment = array('questionnaires', 'create_step_2', $company_info['ID_COMPANY_AI']);
            }
        }

        $this->redirect($segment);
    }

    /**
     * submit question 3
     */
    public function submit_question_3()
    {
        $record = $this->input->post();
        $company_info = $this->t_company_info->get_data_by_property('*', array('ID_COMPANY' => $record['id_company']));
        $this->form_validation->set_rules(Company_rules::question_step_3());
        if ($record['submit'] == 'BACK') {
            $segment = array('questionnaires', 'create_step_2', $company_info['ID_COMPANY_AI']);
        } else {
            if ($this->form_validation->run() && $record['submit'] == 'SAVE') {
                $data = array(
                    'ID_LC3' => $record['ID_LC3']
                );
                $this->t_company_profile->update_data_by_property($data, array('ID_COMPANY' => $record['id_company']));
                $tracking_data = $this->t_tracking->getActiveTracking($company_info['ID_COMPANY_AI']);
                if (sizeof($tracking_data) > 0) {
                    if ($tracking_data[0]['ID_SURVEY'] == '0' || $tracking_data[0]['ID_SURVEY'] == null) {
                        $array = array('ID_COMPANY' => $company_info['ID_COMPANY'], 'CONSULTANT_ID' => $this->session->userdata['uid']['ID_USER']);
                        $survey_query = $this->t_survey_response_hdr->set_data($array);
                        $this->t_tracking->update_data_by_id(array('ID_SURVEY' => $survey_query), $tracking_data[0]['ID_TRACKING']);
                    }
                }
                $this->t_tracking->updateStageByCompanyID($company_info['ID_COMPANY_AI'], array('STAGE_3' => TRACKING_COMPLETED));
                if ($this->t_tracking->checkActiveBeforeGoToSurvey($company_info['ID_COMPANY_AI'])) {
                    $survey_stage = $this->t_tracking->getStageStatus($company_info['ID_COMPANY_AI'],'STAGE_4');
                    if ($survey_stage == '0') {
                        $this->t_tracking->updateStageByCompanyID($company_info['ID_COMPANY_AI'], array('STAGE_4' => TRACKING_AVAILABLE));
                    }
                    $segment = array('survey', 'take_survey', $company_info['ID_COMPANY_AI']);
                }
                else {
                    $this->noti('You completed questionnaires, to enter next Stage you need to complete all previous stages!', 'success');
                    $segment = array('questionnaires', 'create_step_3', $company_info['ID_COMPANY_AI']);
                }
            } else {
                $this->noti('Please choice an answer!');
                $segment = array('questionnaires', 'create_step_3', $company_info['ID_COMPANY_AI']);
            }
        }

        $this->redirect($segment);
    }
}