<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Interview extends MY_Controller
{
    var $sort;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();

        $this->load->library(array('form_validation'));
        $this->load->model('t_company_profile');
        $this->load->model('t_company_info');
        $this->load->model('t_tracking');

        $this->load->model("t_user");
        $this->load->model('t_survey_response_hdr');
        $this->load->helper('form');
        $this->load->library(array('form_validation'));
        $this->load->file(APPPATH . 'models/form_validation/interview_rules.php', false);
        $this->sort = 'asc';
    }

    /**
     * create interview
     * @param $id
     */
    public function create($id)
    {
        $company_profile = $this->t_tracking->get_active_profile($id);
        $session_id = $this->session->userdata('session_id');
        if (is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== true && is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== false) {
            unlock_company($company_profile, $session_id, LOCK_COMPANY_PROFILE);
        }

        $this->set_page_title("Create interview");
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        $session_key = $this->session->userdata(USER_SESSION_KEY);
        $user_id = $session_key['ID_USER'];
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
                    $this->noti('You are not allowed to edit this interview note!');
                    redirect('home');
                }
            } else {
                $this->noti('You are not allowed to edit this company profile!');
                redirect('home');
            }
        }
        if ($this->session->userdata('CREATE_INTERVIEW')) {
            $this->session->userdata('CREATE_INTERVIEW');
            foreach ($this->session->userdata('CREATE_INTERVIEW') as $key => $value) {
                $this->data[$key] = $value;
            }

            $tmp = $this->session->userdata('CREATE_INTERVIEW');
            $this->session->unset_userdata('CREATE_INTERVIEW');
            $this->data['interview_1'] = $tmp['interview_1'];
            $this->data['interview_2'] = $tmp['interview_2'];
            $this->data['interview_3'] = $tmp['interview_3'];

        } else {
            $company_profile = $this->t_company_profile->getActiveCompanyProfile($id);
            if (sizeof($company_profile) > 0) {
                $this->data['company_profile'] = $company_profile['0'];
            } else {
                $this->noti('This profile is not existed!');
                $this->redirect(array('home'));
            }

            $company_info = $this->t_company_info->get_data_by_id('*', $id);

            $this->data['company_info'] = $company_info;
            // $this->t_tracking->update_stage_by_id(STAGE_2, $company_info['ID_COMPANY']);
        }

        $this->data['validate_error'] = true;
        $tracking = $this->t_tracking->getActiveTracking($id);
        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $id;
        } else {
            $this->data['tracking_record']['company_id'] = $id;
        }
        $this->view('default', 'interview_note/create', $this->data, true);
    }

    /**
     * save data
     */
    public function submit_interview()
    {
        $record = $this->input->post();
        $this->form_validation->set_rules(Interview_rules::interview_create_rules());
        if ($this->form_validation->run() == TRUE) {
            unset($record['key_page']);
            $data_interview = array(
                'TX_NOTES_1' => $record['interview_1'],
                'TX_NOTES_2' => $record['interview_2'],
                'TX_NOTES_3' => $record['interview_3']
            );

            $this->t_company_profile->update_data_by_property($data_interview, array('ID_COMPANY' => $record['company_id'], 'NM_COMPANY' => $record['company_name']));

            if ($record['submit'] == 'Save') {
                $stage_status = $this->t_tracking->getStageStatus($record['id_ai'], 'STAGE_2');
                if ($stage_status && $stage_status != TRACKING_COMPLETED) {
                    $this->t_tracking->updateStageByCompanyID($record['id_ai'], array('STAGE_2' => TRACKING_IN_PROGRESS));
                }
                $this->noti('Save interview notes success!', 'success');
                $segment = array('interview', 'create', $record['id_ai']);
                $this->redirect($segment);
            } elseif ($record['submit'] == 'Submit') {
                $segment = array('questionnaires', 'create_step_1', $record['id_ai']);
                $this->t_tracking->updateStageByCompanyID($record['id_ai'], array('STAGE_2' => TRACKING_COMPLETED));
                $this->redirect($segment);
            }
            if ($this->t_tracking->checkActiveBeforeGoToSurvey($record['id_ai'])) {
                $survey_stage = $this->t_tracking->getStageStatus($record['id_ai'],'STAGE_4');
                if ($survey_stage == '0') {
                    $this->t_tracking->updateStageByCompanyID($record['id_ai'], array('STAGE_4' => TRACKING_AVAILABLE));
                }
                $segment = array('questionnaires', 'create_step_1', $record['id_ai']);
                $this->redirect($segment);
            }


        } else {
            $this->noti('Can not create Interview.');
            $list_of_errors = validate_load(Interview_rules::interview_create_rules());
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));

            $this->session->set_userdata('CREATE_INTERVIEW', $this->input->post());
            if ($this->session->userdata('CREATE_INTERVIEW')) {
                $segment = array($this->router->class, 'create');
            }

            $this->redirect($segment);
        }
    }
}