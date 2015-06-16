<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User controller.
 * @author GiamPQ
 *
 */
class Survey extends MY_Controller
{
    var $sort;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();
        $this->load->library('session');
        $this->load->model('t_survey_question');
        $this->load->model('t_survey_option');
        $this->load->model('t_survey_response');
        $this->load->model('t_survey_response_dtl');
        $this->load->model('t_survey_response_hdr');
        $this->load->model('t_tracking');
        $this->load->model('mreport');
        $this->load->model('t_company_info');
        $this->load->model('t_dropdown');
        $this->load->model('t_user');
        $this->load->model('t_gap_analysis_rec');
        $this->load->helper('form');
        $this->load->file("application/controllers/email.php", false);
        $this->load->file("application/controllers/parse.php", false);
        $this->load->file("application/controllers/report.php", false);
        $this->load->library(array('form_validation'));
        $this->load->file(APPPATH . 'models/form_validation/survey_rules.php', false);
        $this->sort = 'ascsort_2';
    }

    /**
     * [index load view page survey with user role]
     * @return [none] []
     * @author [DEV] GIAMPQ  [Member PHP Team]
     */
    public function index()
    {
        $this->check_role(array(1, 2), 0);
        $this->delete_session_rubish();
        $this->view('default', 'survey/manage_survey_view', $this->data);
    }

    /**
     * [FunctionName description]
     * @param string $value [description]
     */
    public function take_search($offset = 0, $sort = 'ascsort_2', $key_search = null)
    {
        if (!$this->is_login()) {
            $this->require_login();
        }
        if (!$this->is_manage()) {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'Access is denied. You have not permission to access!');
            $segment = array('home', 'index');
            $this->redirect($segment);
        }
        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        $org = $sess_key['NM_ORGANISATION'];
        if ($this->is_admin()) {
            $org = null;
        }
        if ($this->input->post()) {
            $key_search = $this->input->post('NM_COMPANY');
        }
        $query = null;
        $total_rows = $this->t_company_info->get_count_company($key_search, $org);
        $this->load->library('pagination');
        $config['per_page'] = PER_IN_PAGE;
        $config['next_link'] = 'Next »';
        $config['prev_link'] = '« Prev';
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        $config['num_links'] = NUM_LINK_PAGINATION;
        $config['cur_tag_open'] = '<a class="currentpage">';
        $config['cur_tag_close'] = '</a>';
        $config['total_rows'] = $total_rows;
        $config['base_url'] = site_url('/survey/take_search/');
        $config['uri_segment'] = 3;
        $config['sort'] = $sort;
        $this->sort = $sort;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment(3) == 0) ? 0 : $this->uri->segment(3);
        $this->data['pagination'] = $pagination;
        $this->data['result_search'] = $this->t_company_info->get_survey_to_take($config['per_page'], $offset, $key_search, $org);
        $this->data['txt_search'] = $key_search;
        $this->data['data_search'] = $key_search;
        $this->data['per_in_page'] = PER_IN_PAGE;
        $st = explode('sort_', $sort);
        $this->data['sort'] = $st[0];
        if ($offset == 0) {
            $page = 1;
        } else {
            $page = $offset / PER_IN_PAGE + 1;
        }

        if ($st[0] == 'asc') {
            $offset = $offset;
        } else {
            $offset = $total_rows - $offset;
        }
        $this->data['offset'] = $offset;
        $this->data['actor'] = $config['base_url'];
        $this->view('default', 'survey/take_survey_view_step_1', $this->data);
    }

    public function update_search($offset = 0, $sort = 'ascsort_2', $key_search = null)
    {
        $this->sort = $sort;
        if (!$this->is_login()) {
            $this->require_login();
        }
        if (!$this->is_manage()) {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'Access is denied. You have not permission to access!');
            $segment = array('home', 'index');
            $this->redirect($segment);
        }

        $sess_key = $this->session->userdata(USER_SESSION_KEY);
        if ($this->input->post()) {
            $key_search = $this->input->post('NM_COMPANY');
        }

        $config['per_page'] = PER_IN_PAGE;
        $query = null;
        $total_rows = count($this->t_company_info->get_data_by_id_login(null, null, $key_search));
        $st = explode('sort_', $sort);
        $this->data['sort'] = $st[0];
        $query = $this->t_company_info->get_data_by_id_login($config['per_page'], $offset, $key_search);
        $this->load->library('pagination');
        $config['per_page'] = PER_IN_PAGE;
        $config['next_link'] = 'Next »';
        $config['prev_link'] = '« Prev';
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
        $config['num_links'] = NUM_LINK_PAGINATION;
        $config['total_rows'] = $total_rows;
        $config['base_url'] = site_url('/survey/update_search/');
        $config['uri_segment'] = 3;
        $config['sort'] = $sort;
        if (count($query) > 0) {
            $this->pagination->initialize($config);
            $pagination = $this->pagination->create_links();
            $offset = ($this->uri->segment(3) == 0) ? 0 : $this->uri->segment(3);
            $this->data['pagination'] = $pagination;
            $this->data['txt_search'] = $key_search;
            $this->data['data_search'] = $key_search;
            $array_data = array();
            foreach ($query as $key => $value) {
                $query_full = $this->t_company_info->get_data_to_update_survey($query[$key]['nm_company'], $query[$key]['id_company']);
                if (count($query_full) > 0) {
                    if ($query_full['T_COMPANY'][0]) {
                        $array_data[$key]['NM_COMPANY'] = $query_full['T_COMPANY'][0]['NM_COMPANY'];
                        $array_data[$key]['NM_DESIGNATION'] = $query_full['T_COMPANY'][0]['NM_DESIGNATION'];
                        $array_data[$key]['ID_CONSULTANT'] = $query_full['T_COMPANY'][0]['ID_CONSULTANT'];
                        $point = $query_full['T_SURVEY_RESPONSE_HDR'][0]['INT_PT'];
                        if ($point < 1.9) {
                            $array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL I';
                        } else if ($point <= 2.9) {
                            $array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL II';
                        } else if ($point <= 3.9) {
                            $array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL III';
                        } else {
                            $array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL IV';
                        }
                        $array_data[$key]['DT_SURVEY_COMPLETE'] = $query_full['T_SURVEY_RESPONSE_HDR'][0]['DT_SURVEY_COMPLETE'];
                        $array_data[$key]['TX_STATUS'] = $query_full['T_SURVEY_RESPONSE_HDR'][0]['TX_STATUS'];
                        $array_data[$key]['INDUSTRY'] = $query_full['T_DROPDOWN'][0]['VALUE'];
                        $array_data[$key]['TYPE'] = $query_full['T_DROPDOWN'][1]['VALUE'];
                        $array_data[$key]['REVENUE'] = $query_full['T_DROPDOWN'][2]['VALUE'];
                        $array_data[$key]['TOTAL_STAFF'] = $query_full['T_DROPDOWN'][3]['VALUE'];
                        $array_data[$key]['HR_STAFF'] = $query_full['T_DROPDOWN'][4]['VALUE'];
                    }
                }
                $temp_data_ss = $this->session->userdata(USER_SESSION_KEY);
                foreach ($query as $key => $value) {
                    if (!$value['consultant_id'] || !$value['tx_status']) {
                        $query[$key]['consultant_id'] = $temp_data_ss['ID_USER'];
                        $query[$key]['tx_status'] = 'Not Completed';
                        $array = array('ID_COMPANY' => $value['nm_company'], 'CONSULTANT_ID' => $temp_data_ss['ID_USER']);
                        $query = $this->t_survey_response_hdr->set_data($array);
                    }
                }
            }

            $this->data['result_search'] = $array_data;
        } else {
            $this->data['txt_search'] = $key_search;
            $this->data['data_search'] = $key_search;
        }

        $this->data['per_in_page'] = PER_IN_PAGE;
        if ($offset == 0) {
            $page = 1;
        } else {
            $page = $offset / PER_IN_PAGE + 1;
        }

        if ($st[0] == 'asc') {
            $offset = $offset;
        } else {
            $offset = $total_rows - $offset;
        }

        $this->data['offset'] = $offset;
        $this->data['offset_ie'] = $offset;
        $this->data['actor'] = $config['base_url'];
        $this->view('default', 'survey/update_survey_view_step_1', $this->data);
    }

    /**
     * [take_survey Load view firt page  start take survey ]
     * @param  [string] $nm_company [name of company]
     * @return [none]
     * @author [DEV] GIAMPQ  [Member PHP Team]
     */
    public function take_survey($nm_company = null, $offset = 0, $key_search = null)
    {
        $company_profile = $this->t_tracking->get_active_profile($nm_company);
        $session_id = $this->session->userdata('session_id');
        if (is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== true && is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== false) {
            unlock_company($company_profile, $session_id, LOCK_COMPANY_PROFILE);
        }

        if ($this->is_login()) {
            if (isset($nm_company) && !empty($nm_company)) {
                $nm_company = urldecode($nm_company);
                $this->load->model('t_tracking');
                $query_company = $this->t_tracking->getActiveSurveyByCompany($nm_company);
                $tracking = $this->t_tracking->getActiveTracking($nm_company);
                $answer_id = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY'=>$query_company[0]['id_survey']),'ID_QUESTION');
                $this->data['last_answer'] = 0;
                if (sizeof($answer_id) > 0) {
                    $last_answer = end($answer_id);
                    $this->data['last_answer'] = $last_answer['ID_QUESTION'];
                }
                if (sizeof($tracking) > 0) {
                    $this->data['tracking_record'] = $tracking[0];
                    $this->data['tracking_record']['company_id'] = $nm_company;
                } else {
                    $this->data['tracking_record']['company_id'] = $nm_company;
                }
                $this->data['is_overseas'] = false;
                if ($tracking[0]['NM_SCOPE'] == 'Local Market') {
                    $this->data['is_overseas'] = true;
                }
                $this->data['id_company'] = $nm_company;
                if (sizeof($query_company) > 0) {
                    $tracking_record = $this->t_tracking->update_stage_by_id(STAGE_4, $query_company[0]['id_company'], $nm_company);
                    if (!$tracking_record) {
                        // add code here
                    }
                    $child_query_company = $query_company[0];
                    $id_survey = $child_query_company['id_survey'];
                    $this->session->set_userdata('survey', $child_query_company);
                    $query = $this->t_survey_response_dtl->getListSurvey('ID_QUESTION', 
                      array( 'ID_SURVEY' => $id_survey), 'ID_QUESTION');
                    if ($this->session->userdata('survey')) {
                        $temp_data = $this->session->userdata('survey');
                        if (count($temp_data)) {
                            $status = $temp_data['tx_status'];
                        } else {
                            $this->data['title'] = 'Error access!';
                            $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                            $this->display_error($this->data);
                            return;
                        }
                    } else {
                        $this->data['title'] = 'Error access!';
                        $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                        $this->display_error($this->data);
                        return;
                    }
                    if ($query) {
                        // get current step in survey
                        $survey_count = array();
                        foreach ($query as $item) {
                            array_push($survey_count, $item['ID_QUESTION']);
                        }

                        $current_step = max($survey_count) + 1;
                        if ($this->session->userdata('data_search_take_survey')) {
                            $this->data['data_search']['NM_COMPANY'] = $this->session->userdata('data_search_take_survey');
                        }
                        if ($this->data['is_overseas'] && $current_step > 31) {
                            $this->data['nm_company'] = $temp_data['nm_company'];
                            $id_question = 31;
                            $id_survey = $temp_data['id_survey'];
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question));
                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $this->data['step'] = 31;
                            $this->get_question_by_step($this->data['step']);
                            $this->data['id_survey'] = $temp_data['id_survey'];
                            $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                            return;
                        }
                        if ($current_step > 34) {
                            // if ($status == 'Not Completed') {
                            $this->data['nm_company'] = $temp_data['nm_company'];
                            $id_question = 34;
                            $id_survey = $temp_data['id_survey'];
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question));
                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $this->data['step'] = 34;
                            $this->get_question_by_step($this->data['step']);
                            $this->data['id_survey'] = $temp_data['id_survey'];
                            $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                            return;
                            // }
                            // else {
                            //     $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            //     $this->session->set_userdata('error_flag_code', 1);
                            //     $this->session->set_userdata('error_mess_code', 'The company has complete survey. Please choose other company!');
                            //     //$this->view('default', 'survey/take_survey_view_step_1', $this->data);
                            //     if ($this->session->userdata('result_search')) {
                            //         $this->data['result_search'] = $this->session->userdata('result_search');
                            //     }
                            //     $segment = array($this->router->class, 'take_search', $offset, $key_search);
                            //     $this->redirect($segment);
                            // }
                        }
                        if ($current_step < 34) {
                            if ($this->session->userdata('survey')) {
                                $temp_data = $this->session->userdata('survey');
                                if (count($temp_data)) {
                                    $status = $temp_data['tx_status'];
                                } else {
                                    $this->data['title'] = 'Error access!';
                                    $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                                    $this->display_error($this->data);
                                    return;
                                }
                            } else {
                                $this->data['title'] = 'Error access!';
                                $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                                $this->display_error($this->data);
                                return;
                            }
                            // [ REMOVE ]-REMOVE IT WILL Go TO QUESTION NOT COMPLETE
                            // $i = 1;
                            // $id_question = 1;
                            // $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question ) );
                            // if(!empty($answer_old))
                            // {
                            // 	$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            // }
                            // [ REMOVE ]-REMOVE IT WILL Go TO QUESTION NOT COMPLETE
                            $this->data['nm_company'] = $temp_data['nm_company'];
                            $this->data['step'] = $current_step;
                            $this->data['id_survey'] = $temp_data['id_survey'];

                            // get checking summary data
                            // $this->load->model('t_tracking');
                            // $tracking_record = $this->t_tracking->get_data_by_id('*', $temp_data['id_survey']);
                            // $this->data['tracking_record'] = $tracking_record;
                            $this->data['tracking_record']['COMPANY_NAME'] = $nm_company;
                            $this->data['tracking_record']['OFFSET'] = $offset;

                            $this->get_question_by_step($current_step);
                            $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                            return;
                        } else {
                            if ($this->session->userdata('survey')) {
                                $temp_data_ss = $this->session->userdata('survey');
                            } else {
                                $this->data['title'] = 'Error access!';
                                $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                                $this->display_error($this->data);
                                return;
                            }
                            if ($query_company[0]['tx_status'] == 'Completed') {
                                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                $this->session->set_userdata('error_flag_code', 1);
                                $this->session->set_userdata('error_mess_code', 'The company has complete survey. Please choose other company!');
                                if ($this->session->userdata('data_search_take_survey')) {
                                    $this->data['data_search']['NM_COMPANY'] = $this->session->userdata('data_search_take_survey');
                                }
                                //$this->view('default', 'survey/take_survey_view_step_1', $this->data);
                                $segment = array($this->router->class, 'take_search', $offset, $key_search);
                                $this->redirect($segment);
                            } else {
                                $this->data['nm_company'] = $temp_data_ss['nm_company'];
                                $this->data['step'] = $current_step;
                                $this->data['id_survey'] = $temp_data_ss['id_survey'];
                                $this->data['tracking_record']['COMPANY_NAME'] = $nm_company;
                                $this->data['tracking_record']['OFFSET'] = $offset;

                                $this->get_question_by_step($current_step);
                                $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                            }
                        }
                    } else {
                        // UPDATE TIME START TAKE SURVEY FOR FIRST LOAD
                        if ($this->session->userdata('survey')) {
                            $temp_data_ss = $this->session->userdata('survey');
                        } else {
                            $this->data['title'] = 'Error access!';
                            $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                            $this->display_error($this->data);
                            return;
                        }
                        $time_take_survey = date("Y-m-d H:i:s");
                        $this->t_survey_response_hdr->update_data_by_id(array("DT_SURVEY_START" => $time_take_survey), $temp_data_ss['id_survey']);
                        $step = 1;
                        $this->data['nm_company'] = $temp_data_ss['nm_company'];
                        $this->data['step'] = $step;
                        $this->data['id_survey'] = $temp_data_ss['id_survey'];

                        //get checking summary data
                        // $this->load->model('t_tracking');
                        // $tracking_record = $this->t_tracking->get_data_by_id('*', $temp_data['id_survey']);
                        // $this->data['tracking_record'] = $tracking_record;
                        $this->data['tracking_record']['COMPANY_NAME'] = $nm_company;
                        $this->data['tracking_record']['OFFSET'] = $offset;

                        $this->get_question_by_step($step);
                        $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                    }
                } else {
                    if ($this->session->userdata('data_search_take_survey')) {
                        $this->data['data_search']['NM_COMPANY'] = $this->session->userdata('data_search_take_survey');
                    }
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', 'The Company Not Found');
                    $segment = array('users', 'login');
                    $this->redirect($segment);
                }
            } else {
                if ($this->session->userdata('result_search')) {
                    $this->data = $this->session->userdata('result_search');
                    $this->view('default', 'survey/update_survey_view_step_1', $this->data);
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', 'Access is denied!');
                    $segment = array($this->router->class, 'index');
                    $this->redirect($segment);
                }
            }
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'Access is denied!');
            $segment = array('users', 'login');
            $this->redirect($segment);
        }
    }

    /**
     * [processing_take_survey description]
     * @return [type] [description]
     */
    public function processing_take_survey()
    {
        if ($this->is_login()) {
            $this->set_page_title("Take survey");
            if ($this->input->post()) {
                $this->load->model('t_tracking');
                $id_survey = $this->input->post('submit_id_survey');
                $tracking = $this->t_tracking->getActiveTrackingBySurvey($id_survey);

                if (sizeof($tracking) > 0) {
                    $this->data['tracking_record'] = $tracking[0];
                    $this->data['tracking_record']['company_id'] = $tracking[0]['ID_COMPANY_AI'];
                } else {
                    $this->noti('This profile is not existed!');
                    redirect(site_url());
                }
                $this->data['is_overseas'] = false;
                if ($tracking[0]['NM_SCOPE'] == 'Local Market') {
                    $this->data['is_overseas'] = true;
                }
                $this->data['id_company'] = $tracking[0]['ID_COMPANY_AI'];
                $answer_id = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY'=>$id_survey),'ID_QUESTION');
                $this->data['last_answer'] = 0;
                if (sizeof($answer_id) > 0) {
                    $last_answer = end($answer_id);
                    $this->data['last_answer'] = $last_answer['ID_QUESTION'];
                }
                $this->form_validation->set_rules(Survey_rules::get_survey_rules_update());
                // Run validate with Rules
                if ($this->form_validation->run() == TRUE) {
                    $step_current = $this->input->post('submit_step');
                    // $this->load->model('t_tracking');
                    // $tracking_record = $this->t_tracking->update_stage_by_id(STAGE_6, $tracking[0]['ID_COMPANY']);

                    if ($this->input->post('id_answer')) {
                        $temp = $this->input->post('id_answer');
                        if (is_numeric($temp) && $temp > 0) {
                            $id_answer = $temp;
                        } else {
                            $id_answer = 0;
                        }
                    } else {
                        $id_answer = 0;
                    }
                    if ($this->session->userdata('survey')) {
                        $sess_survey = $this->session->userdata('survey');
                    } else {
                        $this->data['title'] = 'Error access!';
                        $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                        $this->display_error($this->data);
                        return;
                    }
                    if (!isset($sess_survey['nm_company']) || empty($sess_survey['nm_company'])) {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                        $segment = array($this->router->class, 'index');
                        $this->redirect($segment);
                        return;
                    }
                    $nm_category = $this->input->post('nm_category');
                    $id_question = $this->input->post('id_question');
                    $nm_company = $sess_survey['nm_company'];
                    $this->data['nm_company'] = $sess_survey['nm_company'];
                    if ($this->input->post('submit') == 'Next') {
                        $txt = $this->t_survey_response_hdr->get_data_by_property('TX_STATUS', array('ID_SURVEY' => $id_survey));
                        $array_data = array(
                            'ID_SURVEY' => $id_survey,
                            'NM_CATEGORY' => $nm_category,
                            'ID_QUESTION' => $id_question,
                            'ID_ANSWER' => $id_answer
                        );
                        $array_where = array(
                            'ID_SURVEY' => $id_survey,
                            'NM_CATEGORY' => $nm_category,
                            'ID_QUESTION' => $id_question
                        );

                        if ($id_answer > 0) {

                            if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                                $this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);
                                $step_current += 1;
                            } else {
                                if ($this->t_survey_response_dtl->set_data($array_data)) {
                                    $step_current += 1;
                                } else {
                                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                    $this->session->set_userdata('error_flag_code', 1);
                                    $this->session->set_userdata('error_mess_code', 'Save False!');
                                }
                            }
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1));

                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $answer_id = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY'=>$id_survey),'ID_QUESTION');
                            if (sizeof($answer_id) > 0) {
                                $last_answer = end($answer_id);
                                $this->data['last_answer'] = $last_answer['ID_QUESTION'];
                            }
                            $this->data['step'] = $step_current;
                            $this->get_question_by_step($this->data['step']);
                            $this->data['id_survey'] = $sess_survey['id_survey'];
                            $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                        } else {
                            //$step_current += 1;
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question));

                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $this->data['step'] = $step_current;

                            $this->get_question_by_step($this->data['step']);
                            $this->data['id_survey'] = $sess_survey['id_survey'];
                            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            $this->session->set_userdata('error_flag_code', 1);
                            $this->session->set_userdata('error_mess_code', 'Please select answer');
                            $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                        }
                    } else if ($this->input->post('submit') == 'Previous') {
                        $txt = $this->t_survey_response_hdr->get_data_by_property('TX_STATUS', array('ID_SURVEY' => $id_survey));
                        $array_data = array(
                            'ID_SURVEY' => $id_survey,
                            'NM_CATEGORY' => $nm_category,
                            'ID_QUESTION' => $id_question,
                            'ID_ANSWER' => $id_answer
                        );
                        $array_where = array(
                            'ID_SURVEY' => $id_survey,
                            'NM_CATEGORY' => $nm_category,
                            'ID_QUESTION' => $id_question
                        );
                        if ($id_answer > 0) {
                            if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                                $this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);

                                $step_current -= 1;
                            } else {
                                if ($this->t_survey_response_dtl->set_data($array_data)) {
                                    $step_current -= 1;

                                } else {
                                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                    $this->session->set_userdata('error_flag_code', 1);
                                    $this->session->set_userdata('error_mess_code', 'Save False!');
                                }
                            }
                        } else {
                            $step_current -= 1;
                        }
                        $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1));

                        if (!empty($answer_old)) {
                            $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                        }
                        $this->data['step'] = $step_current;
                        $this->data['tracking_record']['COMPANY_NAME'] = $nm_company;
                        $this->get_question_by_step($this->data['step']);
                        $this->data['id_survey'] = $sess_survey['id_survey'];
                        $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                    } else if ($this->input->post('submit') == 'Save') {
                        if ($step_current == 34 || ($step_current == 31 && $this->data['is_overseas'])) {
                            $txt = $this->t_survey_response_hdr->get_data_by_property('TX_STATUS', array('ID_SURVEY' => $id_survey));
                            $array_data = array(
                                'ID_SURVEY' => $id_survey,
                                'NM_CATEGORY' => $nm_category,
                                'ID_QUESTION' => $id_question,
                                'ID_ANSWER' => $id_answer
                            );
                            $array_where = array(
                                'ID_SURVEY' => $id_survey,
                                'NM_CATEGORY' => $nm_category,
                                'ID_QUESTION' => $id_question
                            );
                            $last_process_name = 'INTERNATIONALIZATION';
                            $last_process_array = array(
                            	array(32, 137), array(33, 138), array(34, 139)
                            	);
                            if ($id_answer > 0) {

                            	if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                            		$this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);
                            		if ($step_current == 31) {
                            			foreach ($last_process_array as $key => $value) {
                            				$array_data = array(
                            					'ID_SURVEY' => $id_survey,
                            					'NM_CATEGORY' => $last_process_name,
                            					'ID_QUESTION' => $value[0],
                            					'ID_ANSWER' => $value[1]
                            					);
                            				$array_where = array(
                            					'ID_SURVEY' => $id_survey,
                            					'NM_CATEGORY' => $last_process_name,
                            					'ID_QUESTION' => $value[0]
                            					);
                            				if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                            					$this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);
                            				}
                            				else {
                            					$this->t_survey_response_dtl->set_data($array_data);
                            				}
                            			}
                            		}
                            		$step_current += 1;
                            	} else {
                            		if ($this->t_survey_response_dtl->set_data($array_data)) {
                            			if ($step_current == 31) {
                            				foreach ($last_process_array as $key => $value) {
                            					$array_data = array(
                            						'ID_SURVEY' => $id_survey,
                            						'NM_CATEGORY' => $last_process_name,
                            						'ID_QUESTION' => $value[0],
                            						'ID_ANSWER' => $value[1]
                            						);
                            					$array_where = array(
                            						'ID_SURVEY' => $id_survey,
                            						'NM_CATEGORY' => $last_process_name,
                            						'ID_QUESTION' => $value[0]
                            						);
                            					if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                            						$this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);
                            					}
                            					else {
                            						$this->t_survey_response_dtl->set_data($array_data);
                            					}
                            				}
                            			}
                            			$step_current += 1;
                            		} else {
                            			$this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            			$this->session->set_userdata('error_flag_code', 1);
                            			$this->session->set_userdata('error_mess_code', 'Save False!');
                            			return;
                            		}
                            	}

                                $this->t_tracking->updateStageByCompanyID($tracking[0]['ID_COMPANY_AI'], array('STAGE_4' => TRACKING_COMPLETED));
                                $this->t_tracking->updateStageByCompanyID($tracking[0]['ID_COMPANY_AI'], array('STAGE_5' => TRACKING_IN_PROGRESS));
                                $this->save_survey($id_survey, $nm_company);
                                $segment = array('survey', 'generate_gap_recommendation/' . $id_survey);
                                $this->redirect($segment);
                            } else {
                                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                $this->session->set_userdata('error_flag_code', 1);
                                $this->session->set_userdata('error_mess_code', 'Please Select Answer!');
                                $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1));

                                if (!empty($answer_old)) {
                                    $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                                }
                                $this->data['step'] = 34;
                                if ($step_current == 31) {
                                  $this->data['step'] = 31;
                                }
                                $this->get_question_by_step($this->data['step']);
                                $this->data['id_survey'] = $sess_survey['id_survey'];
                                $this->view('default', 'survey/take_survey_view_step_2', $this->data, true);
                                return;
                            }

                            if ($step_current > 34) {
                                $query = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY' => $id_survey), 'ID_QUESTION');
                                if (count($query) == 34) {
                                    $this->save_survey($id_survey, $nm_company);
                                } else {
                                    $this->take_survey($nm_company);
                                }
                            } else {
                                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                $this->session->set_userdata('error_flag_code', 1);
                                $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                                $segment = array($this->router->class, 'index');
                                $this->redirect($segment);
                            }
                        } else {
                            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            $this->session->set_userdata('error_flag_code', 1);
                            $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                            $segment = array($this->router->class, 'index');
                            $this->redirect($segment);
                        }
                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                        $segment = array($this->router->class, 'index');
                        $this->redirect($segment);
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', validation_errors());
                    $segment = array($this->router->class, 'index');
                    $this->redirect($segment);
                }
            } else {
                if ($this->session->userdata('survey')) {
                    $temp_data = $this->session->userdata('survey');
                } else {
                    $this->data['title'] = 'Error access!';
                    $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                    $this->display_error($this->data);
                    return;
                }
                if (isset($temp_data['nm_company'])) {
                    $this->take_survey($temp_data['nm_company']);
                } else {
                    $this->data['message'] = 'Page not found. You can not access this url!';
                    $this->display_error($this->data);
                }
            }
        } else {
            $this->require_login();
        }
    }

    /**
     * [save_survey save data survey processing]
     * @param  [integer] $id_survey  [id of survey]
     * @author [DEV] GIAMPQ  [Member PHP Team]
     * @param  [string] $nm_company [name of company]
     * @return [none]
     */
    public function save_survey($id_survey = null, $nm_company = null, $manual = false)
    {
        if ($this->is_login()) {
            $this->session->set_userdata('send_mail_complete', true);

            if (!is_null($id_survey) && !is_null($nm_company) && !empty($id_survey) && !empty($nm_company)) {
                $query = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY' => $id_survey), 'ID_QUESTION');
                if ($this->session->userdata('survey')) {
                    $sess_sur = $this->session->userdata('survey');
                } else {

                    $this->data['title'] = 'Error access!';
                    $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                    $this->display_error($this->data);
                    return;
                }

                if (count($query) == 34 || count($query) == 31) {
                    $time_take_survey = date("Y-m-d H:i:s");
                    $this->t_survey_response_hdr->update_data_by_id(array("DT_SURVEY_COMPLETE" => $time_take_survey, "TX_STATUS" => 'Completed'), $sess_sur['id_survey']);

                    // CALCULATE SCORE
                    // $category_temp = $this->mreport->get_category();

                    // $i = 0;
                    // $category = array();
                    // foreach ($category_temp as $key => $value)
                    //     array_push($category, $value['NM_CATEGORY']);
                    // //$category = array('Recruitment', 'HR Management', 'Manpower Planning', 'Training & Development', 'Performance Management', 'Compensation & Benefits', 'Talent Management & Succession Planning', 'Organization Culture & Core Values', 'Employee Engagement & Communications', 'Employee Value Proposition (EVP)', 'International Mobility');

                    // $int_pt = 0;
                    // foreach ($category as $key => $value) {
                    //     // get id question
                    //     $id_question = $this->t_survey_question->get_data_by_property('id_question', array('nm_category' => $value));
                    //     $number = count($id_question);
                    //     $sum = 0;
                    //     $sum = $this->t_survey_option->get_sum_point($id_survey, $id_question);
                    //     $sum = round($sum[0]['sum'] / $number, 1, PHP_ROUND_HALF_DOWN);
                    //     $key += 1;
                    //     $this->t_survey_response_hdr->update_data_by_id(array('INT_CAT' . $key => $sum), $id_survey);
                    //     $int_pt += $sum;
                    // }

                    // $int_pt = round($int_pt / count($category), 1, PHP_ROUND_HALF_DOWN);
                    // $this->t_survey_response_hdr->update_data_by_id(array('INT_PT' => $int_pt), $id_survey);
                    $query_get_id = $this->t_company_info->get_data_by_property('ID_COMPANY', array('ID_COMPANY' => $nm_company));
                    if (count($query_get_id) > 0) {
                        $id_company = $query_get_id[0]['ID_COMPANY'];
                        $this->session->set_userdata('number_of_survey', $id_survey);
                    }
                    // UPDATE STATUS
                    if (!$manual) {
                        $segment = array('survey', 'generate_gap_recommendation/' . $id_survey);
                        $this->redirect($segment);
                    }
//					$this->generate_gap_recommendation($id_survey);
                } else {
                    $this->data['title'] = 'Error access!';
                    $this->data['message'] = 'The company not complete survey!';
                    $this->display_error($this->data);
                }
            } else {
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'Page not found. You can not access this url!';
                $this->display_error($this->data);
            }
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Page not found. You can not access this url!';
            $this->display_error($this->data);
        }
    }

    public function get_question_by_step($step = 0)
    {
        $step -= 1;
        $question = $this->t_survey_question->get_data_order_by_id($step);
        if (count($question)) {
            $this->data['question'] = $question;
            $query = $this->t_survey_option->get_data_by_property('*', array('id_question' => $question['id_question']));
            $this->data['option'] = $query;
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
            $this->display_error($this->data);
            return;
        }
        if ($this->data['step'] == 1 || $this->data['step'] == 2 || $this->data['step'] == 3) {
            $this->data['$question']['color'] = '#333333';
        }
    }

    public function update_survey($nm_company = '')
    {
        if ($this->is_login()) {
            if ($this->is_admin()) {
                $nm_company = urldecode($nm_company);
                $query_company = $this->t_company_info->get_survey_by_id_login($nm_company);
                if (count($query_company)) {
                    $id_survey = $query_company[0]['id_survey'];
                    $this->session->set_userdata('survey', $query_company[0]);
                    $query = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY' => $id_survey), 'ID_QUESTION');
                    if ($this->session->userdata('survey')) {
                        $sess_sur = $this->session->userdata('survey');
                    } else {
                        $this->data['title'] = 'Error access!';
                        $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                        $this->display_error($this->data);
                        return;
                    }

                    if ($query) {
                        $i = 1;
                        while (isset($query[$i - 1]['ID_QUESTION'])) {
                            if ($i == $query[$i - 1]['ID_QUESTION']) {
                                $i++;
                            } else {
                                break;
                            }
                        }

                        // Get number answer not complete first
                        $this->data['nm_company'] = $sess_sur['nm_company'];
                        if ($i > 34) {
                            // load question 1 and message
                            $step_current = 1;
                            $id_question = 0;
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1));

                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $this->data['step'] = $step_current;
                            $this->get_question_by_step($this->data['step']);
                            $this->data['id_survey'] = $sess_sur['id_survey'];
                            $this->view('default', 'survey/update_survey_view_step_2', $this->data);
                        }
                        if ($i <= 34) {
                            // [ REMOVE ]-REMOVE IT WILL Go TO QUESTION NOT COMPLETE
                            // $i = 1;
                            // $id_question = 1;
                            // $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question ) );
                            // if(!empty($answer_old))
                            // {
                            // 	$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            // }
                            // [ REMOVE ]-REMOVE IT WILL Go TO QUESTION NOT COMPLETE
                            $this->data['nm_company'] = $sess_sur['nm_company'];
                            $this->data['step'] = $i;
                            $this->data['id_survey'] = $sess_sur['id_survey'];

                            $this->get_question_by_step($i);
                            $this->view('default', 'survey/update_survey_view_step_2', $this->data);
                        }
                    } else {
                        // UPDATE TIME START TAKE SURVEY FOR FIRST LOAD

                        if ($this->session->userdata('survey')) {
                            $temp_sess = $this->session->userdata('survey');
                        } else {
                            $this->data['title'] = 'Error access!';
                            $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                            $this->display_error($this->data);
                            return;
                        }
                        $time_take_survey = date("Y-m-d H:i:s");
                        $this->t_survey_response_hdr->update_data_by_id(array("DT_SURVEY_START" => $time_take_survey), $temp_sess['id_survey']);
                        $step = 1;

                        $this->data['nm_company'] = $temp_sess['nm_company'];
                        $this->data['step'] = $step;
                        $this->data['id_survey'] = $temp_sess['id_survey'];

                        $this->get_question_by_step($step);
                        $this->view('default', 'survey/update_survey_view_step_2', $this->data);
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', 'The Company Not Found');
                    $segment = array('users', 'login');
                    $this->redirect($segment);
                }
            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 1);
                $this->session->set_userdata('error_mess_code', 'Access is denied!');
                $segment = array('users', 'login');
                $this->redirect($segment);
            }
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'Access is denied!');
            $segment = array('users', 'login');
            $this->redirect($segment);
        }
    }

    public function processing_update_survey()
    {
        if ($this->is_login()) {
            if ($this->is_admin()) {
                if ($this->session->userdata('survey')) {
                    $sur_sess = $this->session->userdata('survey');
                } else {
                    $this->data['title'] = 'Error access!';
                    $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                    $this->display_error($this->data);
                    return;
                }
                if ($this->input->post()) {
                    $this->form_validation->set_rules(Survey_rules::get_survey_rules_update());
                    // Run validate with Rules
                    if ($this->form_validation->run() == TRUE) {
                        $step_current = $this->input->post('submit_step');
                        $id_survey = $this->input->post('submit_id_survey');
                        if ($this->session->userdata('survey')) {
                            $sess_sur = $this->session->userdata('survey');
                        } else {
                            $this->data['title'] = 'Error access!';
                            $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                            $this->display_error($this->data);
                            return;
                        }
                        if ($this->input->post('id_answer')) {
                            $temp = $this->input->post('id_answer');
                            if (is_numeric($temp) && $temp > 0) {
                                $id_answer = $temp;
                            } else {
                                $id_answer = 0;
                            }
                        } else {
                            $id_answer = 0;
                        }
                        $nm_category = $this->input->post('nm_category');
                        $id_question = $this->input->post('id_question');
                        if (isset($sess_sur['nm_company'])) {
                            $nm_company = $sess_sur['nm_company'];
                        }
                        if (isset($sess_sur['nm_company'])) {
                            $this->data['nm_company'] = $sess_sur['nm_company'];
                        }
                        if ($this->input->post('submit') == 'Next') {
                            // $array_data = array(
                            // 	'ID_SURVEY' => $id_survey,
                            // 	'NM_CATEGORY' => $nm_category,
                            // 	'ID_QUESTION' => $id_question,
                            // 	'ID_ANSWER' => $id_answer
                            // 	 );
                            // $array_where = array(
                            // 	'ID_SURVEY' => $id_survey,
                            // 	'NM_CATEGORY' => $nm_category,
                            // 	'ID_QUESTION' => $id_question
                            // 	 );
                            // if($id_answer > 0 )
                            // {

                            // 	if($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
                            // 	{
                            // 		$this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);

                            // 		$step_current += 1;
                            // 	}
                            // 	else
                            // 	{
                            // 		if ($this->t_survey_response_dtl->set_data($array_data)) {
                            // 			$step_current += 1;

                            // 		} else {
                            // 			$this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            // 			$this->session->set_userdata('error_flag_code', 1);
                            // 			$this->session->set_userdata('error_mess_code', 'Save False!');

                            // 		}

                            // 	}
                            // 	$answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );

                            // 	if(!empty($answer_old))
                            // 	{
                            // 		$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            // 	}
                            // 	$this->data['step'] = $step_current;
                            // 	$this->get_question_by_step($this->data['step']);
                            // 	$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
                            // 	$this->view('default', 'survey/update_survey_view_step_2', $this->data);
                            // }
                            // else
                            // {
                            // 	$step_current += 1;
                            // 	$answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
                            // 	if(!empty($answer_old))
                            // 	{
                            // 		$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            // 	}
                            // 	$this->data['step'] = $step_current;
                            // 	$this->get_question_by_step($this->data['step']);
                            // 	$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
                            // 	$this->view('default', 'survey/update_survey_view_step_2', $this->data);
                            // }
                            // BEGIN -  DON'T SAVE
                            $step_current += 1;
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1));
                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $this->data['step'] = $step_current;
                            $this->get_question_by_step($this->data['step']);
                            if (isset($sess_sur['id_survey'])) {
                                $this->data['id_survey'] = $sess_sur['id_survey'];
                            }
                            $this->view('default', 'survey/update_survey_view_step_2', $this->data);
                            // END -  DON'T SAVE
                        } else if ($this->input->post('submit') == 'Previous') {
                            // $array_data = array(
                            // 	'ID_SURVEY' => $id_survey,
                            // 	'NM_CATEGORY' => $nm_category,
                            // 	'ID_QUESTION' => $id_question,
                            // 	'ID_ANSWER' => $id_answer
                            // 	 );
                            // $array_where = array(
                            // 	'ID_SURVEY' => $id_survey,
                            // 	'NM_CATEGORY' => $nm_category,
                            // 	'ID_QUESTION' => $id_question
                            // 	 );
                            // if($id_answer > 0 )
                            // {
                            // 	if($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
                            // 	{
                            // 		$this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);

                            // 		$step_current -= 1;
                            // 	}
                            // 	else
                            // 	{
                            // 		if ($this->t_survey_response_dtl->set_data($array_data)) {
                            // 			$step_current -= 1;

                            // 		} else {
                            // 			$this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            // 			$this->session->set_userdata('error_flag_code', 1);
                            // 			$this->session->set_userdata('error_mess_code', 'Save False!');
                            // 			return;

                            // 		}

                            // 	}
                            // }
                            // else
                            // {
                            // 	$step_current -= 1;
                            // }
                            // $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1) );

                            // if(!empty($answer_old))
                            // {
                            // 	$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            // }
                            // $this->data['step'] = $step_current;
                            // $this->get_question_by_step($this->data['step']);
                            // $this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
                            // $this->view('default', 'survey/update_survey_view_step_2', $this->data);

                            // BEGIN -  DON'T SAVE
                            $step_current -= 1;
                            $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1));
                            if (!empty($answer_old)) {
                                $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                            }
                            $this->data['step'] = $step_current;
                            $this->get_question_by_step($this->data['step']);
                            $this->data['id_survey'] = $sess_sur['id_survey'];
                            $this->view('default', 'survey/update_survey_view_step_2', $this->data);
                            // END -  DON'T SAVE
                        } else if ($this->input->post('submit') == 'Save') {

                            if ($step_current == 34) {
                                $array_data = array(
                                    'ID_SURVEY' => $id_survey,
                                    'NM_CATEGORY' => $nm_category,
                                    'ID_QUESTION' => $id_question,
                                    'ID_ANSWER' => $id_answer
                                );
                                $array_where = array(
                                    'ID_SURVEY' => $id_survey,
                                    'NM_CATEGORY' => $nm_category,
                                    'ID_QUESTION' => $id_question
                                );
                                if ($id_answer > 0) {
                                    if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                                        $this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);
                                        $step_current += 1;
                                    } else {
                                        if ($this->t_survey_response_dtl->set_data($array_data)) {
                                            $step_current += 1;
                                        } else {
                                            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                            $this->session->set_userdata('error_flag_code', 1);
                                            $this->session->set_userdata('error_mess_code', 'Save False!');
                                        }
                                    }
                                } else {
                                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                    $this->session->set_userdata('error_flag_code', 1);
                                    $this->session->set_userdata('error_mess_code', 'Please Select Answer!');
                                    $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1));

                                    if (!empty($answer_old)) {
                                        $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                                    }
                                    $this->data['step'] = 34;
                                    $this->get_question_by_step($this->data['step']);
                                    $this->data['id_survey'] = $sess_sur['id_survey'];
                                    $this->view('default', 'survey/update_survey_view_step_2', $this->data);

                                }
                                if ($step_current > 34) {
                                    $query = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', array('ID_SURVEY' => $id_survey), 'ID_QUESTION');
                                    if (count($query) == 34) {
                                        $this->save_survey($id_survey, $nm_company); // EDIT HERE
                                        //$this->view('default', 'survey/thankyou_take_survey_view', null);

                                    } else {
                                        $this->update_survey($nm_company);
                                    }
                                } else {
                                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                    $this->session->set_userdata('error_flag_code', 1);
                                    $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                                    $segment = array($this->router->class, 'index');
                                    $this->redirect($segment);
                                }
                            } else {
                                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                $this->session->set_userdata('error_flag_code', 1);
                                $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                                $segment = array($this->router->class, 'index');
                                $this->redirect($segment);
                            }
                        } else if ($this->input->post('submit') == 'Save_Current') {
                            $array_data = array(
                                'ID_SURVEY' => $id_survey,
                                'NM_CATEGORY' => $nm_category,
                                'ID_QUESTION' => $id_question,
                                'ID_ANSWER' => $id_answer
                            );
                            $array_where = array(
                                'ID_SURVEY' => $id_survey,
                                'NM_CATEGORY' => $nm_category,
                                'ID_QUESTION' => $id_question
                            );
                            if ($id_answer > 0) {
                                if ($this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $array_where)) {
                                    $this->t_survey_response_dtl->update_data_by_property($array_data, $array_where);
                                    $step_current += 1;
                                } else {
                                    if ($this->t_survey_response_dtl->set_data($array_data)) {
                                        $step_current += 1;
                                    } else {
                                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                        $this->session->set_userdata('error_flag_code', 1);
                                        $this->session->set_userdata('error_mess_code', 'Save False!');
                                    }
                                }
                                $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1));

                                if (count($answer_old)) {
                                    $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                                }
                                $this->data['step'] = $step_current;
                                $this->get_question_by_step($this->data['step']);
                                $this->data['id_survey'] = $id_survey;
                                $this->view('default', 'survey/update_survey_view_step_2', $this->data);
                            } else {
                                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                $this->session->set_userdata('error_flag_code', 1);
                                $this->session->set_userdata('error_mess_code', 'Please Select Answer!');
                                $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1));

                                if (!empty($answer_old)) {
                                    $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                                }
                                $this->data['step'] = $step_current;
                                $this->get_question_by_step($this->data['step']);
                                $this->data['id_survey'] = $sess_sur['id_survey'];
                                $this->view('default', 'survey/update_survey_view_step_2', $this->data);

                            }
                        } else {
                            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            $this->session->set_userdata('error_flag_code', 1);
                            $this->session->set_userdata('error_mess_code', 'Access is denied. Please try again!');
                            $segment = array($this->router->class, 'index');
                            $this->redirect($segment);
                        }
                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', validation_errors());
                        $segment = array($this->router->class, 'index');
                        $this->redirect($segment);
                    }
                } else {
                    if (isset($sur_sess['nm_company'])) {
                        $this->update_survey($sur_sess['nm_company']);
                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', 'Access is denied!');
                        $segment = array($this->router->class, 'index');
                        $this->redirect($segment);
                    }
                }
            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 1);
                $this->session->set_userdata('error_mess_code', 'Access is denied!');
                $segment = array($this->router->class, 'index');
                $this->redirect($segment);
            }
        } else {
            $this->require_login();
        }
    }

    public function goto_survey($nm_company = '', $step = '')
    {
        if ($this->is_login()) {
            if ($this->input->post()) {
                $post_data = $this->input->post();
                $search_data = array(
                    'ID_SURVEY'=>$post_data['go_to_id_survey']
                );
                $answer_id = $this->t_survey_response_dtl->get_data_by_property('ID_QUESTION', $search_data,'ID_QUESTION');
                $this->data['last_answer'] = 0;
                if (sizeof($answer_id) > 0) {
                    $last_answer = end($answer_id);
                    $this->data['last_answer'] = $last_answer['ID_QUESTION'];
                }
                $query_company = $this->t_tracking->getActiveSurveyByCompany($nm_company);
                $tracking = $this->t_tracking->getActiveTracking($nm_company);
                if(sizeof($tracking) > 0) {
                    $this->data['tracking_record'] = $tracking[0];
                    $this->data['tracking_record']['company_id'] = $nm_company;
                }
                else {
                    $this->data['tracking_record']['company_id'] = $nm_company;
                }
                $this->data['id_company'] = $nm_company;
                $this->data['is_overseas'] = false;
                if ($tracking[0]['NM_SCOPE'] == 'Local Market') {
                    $this->data['is_overseas'] = true;
                }
                $this->form_validation->set_rules(Survey_rules::get_goto_rules());
                if ($this->form_validation->run() == TRUE) {
                    if ($this->session->userdata('survey')) {
                        $sur_sess = $this->session->userdata('survey');
                    } else {
                        $this->data['title'] = 'Error access!';
                        $this->data['message'] = 'Sorry! The Server Has Error! Please Try Again';
                        $this->display_error($this->data);
                        return;
                    }
                    $question_number = $this->input->post('no_question');
                    $key_valid = $this->input->post('submit');
                    $id_survey_get = $this->t_survey_response_hdr->get_data_by_property('ID_SURVEY', array('ID_COMPANY' => $nm_company));
                    if (count($id_survey_get) && !empty($id_survey_get[0]['ID_SURVEY'])) {
                        $id_survey = $id_survey_get[0]['ID_SURVEY'];
                    } else {
                        if (isset($sur_sess['id_survey'])) {
                            $id_survey = $sur_sess['id_survey'];
                        } else {
                            $this->data['title'] = 'Sorry!';
                            $this->data['message'] = 'Servers have problems decoding the data! Please perform the operation again!';
                            $this->display_error($this->data);
                            return;
                        }
                    }
                    $this->data['nm_company'] = $nm_company;
                    if ($key_valid == 'Search') {
                        $step_current = $question_number;
                        $answer_old = $this->t_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $question_number));
                        if (!empty($answer_old)) {
                            $this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
                        }
                        $this->data['step'] = $step_current;
                        $this->get_question_by_step($this->data['step']);
                        $temp_data = $this->session->userdata('survey');
                        if ($temp_data) {
                            $this->data['id_survey'] = $temp_data['id_survey'];
                        } else {
                            $this->data['id_survey'] = null;
                        }
                        $this->view('default', 'survey/take_survey_view_step_2', $this->data,true);
                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', 'Request invalid!');
                        $segment = array('home');
                        $this->redirect($segment);
                    }

                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', validation_errors());
                    $segment = array($this->router->class, 'processing_take_survey');
                    $this->redirect($segment);
                }

            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 1);
                $this->session->set_userdata('error_mess_code', 'Request invalid!');
                $segment = array('home');
                $this->redirect($segment);
            }

        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'Request invalid!');
            $segment = array('home');
            $this->redirect($segment);
        }
    }

    public function weekly_notification()
    {
        /** Include PHPExcel */
        require_once 'Classes/PHPExcel.php';
        // Create new PHPExcel object

        $objPHPExcel = new PHPExcel();
        // Set document properties

        $objPHPExcel->getProperties()->setCreator("Online survey application")
            ->setLastModifiedBy("Online survey application")
            ->setTitle("Report")
            ->setSubject("Excel Document")
            ->setDescription("•	This weekly report will be generated and exported to Excel on every Monday for the previous week ")
            ->setKeywords("SurveyOnline");

         $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
        // Add some data

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'S/No')
            ->setCellValue('B1', 'Company ID')
            ->setCellValue('C1', 'Designation')
            ->setCellValue('D1', 'Revenue size')
            ->setCellValue('E1', 'Total staff size')
            ->setCellValue('F1', 'HR staff size')
            ->setCellValue('G1', 'Company industry')
            ->setCellValue('H1', 'Overall HRMM Maturity Level points')
            ->setCellValue('I1', 'Survey completion date')
            ->setCellValue('J1', 'Consultant ID');
        $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);;
        $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'C4C4C4')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $name_file = $today = date("Ymd");
        $company_report = $this->t_survey_response_hdr->get_data_report_weekly();
//        echo '<pre>';
//        var_dump($company_report);
//        exit;
        if ($company_report) {
            foreach ($company_report as $key => $value) {
                $key += 2;
                $n_revenue = $this->t_dropdown->get_data_by_id('VALUE', $value['n_l_revenue']);
                $n_staff_size = $this->t_dropdown->get_data_by_id('VALUE', $value['n_local_staff']);
                $n_hr_size = $this->t_dropdown->get_data_by_id('VALUE', $value['N_L_HR']);
                $nm_consultant = $this->t_user->get_data_by_id('id_login', $value['consultant_id']);
                // border Cell
                $objPHPExcel->getActiveSheet()->getStyle('A' . $key . ':J' . $key)->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A' . $key . ':J' . $key)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $key, $key - 1)
                    ->setCellValue('B' . $key, $value['nm_company'])
                    ->setCellValue('C' . $key, $value['nm_designation1'])
                    ->setCellValue('D' . $key, $value['n_l_revenue'])
                    ->setCellValue('E' . $key, $value['n_local_staff'])
                    ->setCellValue('F' . $key, $value['N_L_HR'] + $value['N_L_HR'])
                    ->setCellValue('G' . $key, $value['nm_industry'])
                    ->setCellValue('H' . $key, $value['int_pt'])
                    ->setCellValue('I' . $key, $value['dt_survey_complete'])
                    ->setCellValue('J' . $key, $nm_consultant['id_login']);
            }
        }
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Weekly Notification');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("temp/survey" . "$name_file.xls");
        //$path = str_replace('.php', "$name_file.xls", __FILE__);
        // echo 'Files have been created in ' , getcwd() .'<br>';
        $get_link = "temp/survey" . $name_file . ".xls";
        $att['link'] = $get_link;
        $att['name'] = 'survey' . $name_file . '.xls';
        $mail = new Email();
        $get_parse_email = new ParserCompany();
        $today_create = date("j / n / Y");
        $data = array("HOME_PAGE" => "#", "ID_LOGIN" => 'Admin user', "ALT_BODY" => ALT_BODY_WEEKLY_NOTIFICATION, "DT_CREATE" => $today_create, "LINK_DOWN" => site_url() . "/survey/download_survey/$name_file");
        $get_parse_email->send_weekly($data);
        $parse_email = $get_parse_email->public_template['template'];
        $parse_subject = $get_parse_email->public_template['subject'];
        if (!empty($parse_subject) && !empty($parse_email)) {
            $admin = $this->t_user->get_data_by_property('*', array('USER_ROLE' => 1));
            $type = "weekly_notification";
            if (count($admin) > 0) {
                foreach ($admin as $key => $value) {
                    $item_admin_mail = array('SUBJECT' => $parse_subject,
                        'TO' => $value['TX_USEREMAIL'],
                        'BODY' => $parse_email
                    );

                    try {
                        $mail->send_mail($item_admin_mail, $att, $type);
                    } catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }
                }
                return true;
            } else {
                return false;
            }
            // $arraymail = array('SUBJECT' => $parse_subject,
            // 	'TO' => ADMIN_MAIL,
            // 	'BODY' => $parse_email
            // );
            // if($mail->send_mail($arraymail,$att,$type)) {
            // 	echo 'Send weekly notification successful'; exit();

            // }
            // else
            // {
            // 	return false;
            // }
        } else {
            return false;
        }
    }

    public function download_survey($name_file = '')
    {
        if (empty($name_file)) {
            return false;
        }
        ini_set('memory_limit', '-1');
        $get_link = base_url() . "temp/survey" . $name_file . ".xls";
        if (file_exists("temp/survey" . $name_file . ".xls")) {
            $file = file_get_contents($get_link);
            $name = "$name_file" . ".xls";
            $this->load->helper('download');
            force_download($name, $file);

        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'File not found. You can not download it!';
            $this->display_error($this->data);
        }
    }

    public function send_mail_when_complete_survey($id_survey = null)
    {
        if (!empty($id_survey) || !is_null($id_survey)) {
            $query = $this->t_survey_response_hdr->get_data_by_id('*', $id_survey);

            if (count($query)) {
                if ($this->session->userdata('send_mail_complete')) {
                    $sendemail = new Email();
                    $name_company = $query['ID_COMPANY'];
                    $date_complete = $query['DT_SURVEY_COMPLETE'];
                    $consultant_id = $query['CONSULTANT_ID'];
                    $get_name = $this->t_user->get_data_by_id('ID_LOGIN', $consultant_id);
                    if (count($get_name)) {
                        $consultant_id = $get_name['ID_LOGIN'];
                    }
                    $parse_email = "
					<html>
					Please be informed that the following survey has been completed.<br />
					<ul type='square'>
			            <li>   Company ID : <strong> $name_company  </strong></li>
			            <li>   Survey Completion :<strong> $date_complete</strong></li>
			            <li>   Consultant ID : <strong> $consultant_id</strong></li>
				    </ul>
					</html>
					";
                    $admin = $this->t_user->get_data_by_property('*', array('IN_ADMIN' => 1, 'NM_USER' => ADMINISTRATOR_KEY));
                    $att = null;

                    $type = "complete_when_finish_survey";
                    if (count($admin) > 0) {
                        foreach ($admin as $key => $value) {
                            $item_admin_mail = array('SUBJECT' => 'Completion of Survey Notification',
                                'TO' => $value['TX_USEREMAIL'],
                                'BODY' => $parse_email
                            );

                            try {
                                $sendemail->send_mail($item_admin_mail, $att, $type);
                            } catch (Exception $e) {
                                echo 'Caught exception: ', $e->getMessage(), "\n";
                            }
                        }
                        return true;
                    } else {
                        return false;

                    }
                    // $arraymail = array('SUBJECT' => 'Completion of Survey Notification',
                    // 						'TO' => ADMIN_MAIL,
                    // 						'BODY' => $parse_email
                    // 						);
                    // if($sendemail->send_mail($arraymail,null,$type)) {
                    // 	$this->session->set_userdata('send_mail_complete','true');
                    // }
                    // else
                    // {
                    // 	return;
                    // }
                }

            } else {
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'Page not found. You can not access this url!';
                $this->display_error($this->data);
            }
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Page not found. You can not access this url!';
            $this->display_error($this->data);
        }
    }

    public function complete()
    {

        if ($this->is_login()) {
            if ($this->session->userdata('number_of_survey')) {
                $temp = $this->session->userdata('number_of_survey');
                $this->send_mail_when_complete_survey($temp);
            } else {
                $this->session->unset_userdata('send_mail_complete');
            }
            $this->session->unset_userdata('number_of_survey');
            $this->view('default', 'survey/thankyou_take_survey_view', null);
        } else {
            $this->require_login();

        }
    }

    public function save_survey_complete($id_survey = '', $id_company = '')
    {
        if (is_numeric($id_survey) && is_numeric($id_company)) {
            if ($id_survey * $id_company != 0) {

                $link = site_url() . "/report/load_gap_char/$id_company/$id_survey";
                // echo ("<script type="text/javascript">var w = window.open (\"$link\",\"123_blank\");
                // if(typeof w == \"undefined\") {
                // 	var ww = window.open (\"$link\",\"_blank\", \"height=100, width=100\");
                // 	if(typeof ww == \"undefined\") {
                // 		alert('Your browser do not support open pop-up! we cannot create report from result survey');
                // 	}
                // }
                // </script>");
                //create_report_complete_and_close
                echo "sfsf";
                echo '<!DOCTYPE html>
						<html>
						<head>
						    <meta charset="utf-8">
						    <title>Generate Report</title>
							<script src="' . base_url('js/jquery-1.11.2.js') . '" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function(){
									window.location.href="' . $link . '";
									$(window).load(function() {
										window.location.href="' . $link . '";
									});
								});
							</script>
						</head>
				<body>
					<div tabindex="10000" id="float_view" style="width: 80%; margin: 0 auto; height: auto; display: block; color: #fff;">
							<p id="text_report">Initializing report ...</p>
							<div style="margin: 0 auto;width:128px;">
						        <img src="' . base_url('/img/processing.gif');
                '." alt="Loading" width="128" height="128">
						    </div>
							<p id="text_report_des">Please waiting a few minute<br />The window will automatically close when the process of generating report has finishing</p>
							<a href="' . $link . '" class="btn btn-facebook generatereport">Generate Report</a>
						</div>
						<div id="container" style="width: 100%; height:100%; display: none; "></div>
				</body>
				</html>';
                // echo ("<script type="text/javascript">window.close();</script>");
                // Report::load_gap_char($id_company,$id_survey);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function take_survey_progress($id_company = null, $id_step = 1)
    {
        if ($id_company == null) {
            // Access is denied

            return;
        }
        if ($id_step < 0) {
            // Access is denied
        } else if ($id_step > 0 && $id_step < 35) {
            $data_company = $this->t_company_info->get_data_by_id('*', $id_company);
            if (count($data_company) > 0) {
                $name_company = $data_company['NM_COMPANY'];
                $org = $data_company['ID_CONSULTANT_ORG'];
                $survey = $this->t_survey_response_hdr->get_data_by_property("*", array('ID_COMPANY' => $name_company));
                // if(count($survey))
            } else {
                // COMPANY NOT FOUND
            }
        } else {
            // Access is denied
        }
    }

    public function generate_gap_recommendation($survey_id)
    {
        $tracking = $this->t_tracking->getActiveTrackingBySurvey($survey_id);
        if (sizeof($tracking) > 0) {
            $this->t_survey_response_hdr->updateAVGScoreBySurvey($tracking[0]['ID_SURVEY']);
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $tracking[0]['ID_COMPANY_AI'];
        } else {
            $this->noti('This profile is not existed!');
            redirect(site_url());
        }
        $company_profile = $this->t_tracking->get_active_profile($tracking[0]['ID_COMPANY_AI']);
        $session_id = $this->session->userdata('session_id');
        if (is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== true && is_company_locked($company_profile, $session_id, LOCK_COMPANY_PROFILE) !== false) {
            unlock_company($company_profile, $session_id, LOCK_COMPANY_PROFILE);
        }

        if (!$this->is_login()) { 
            $this->noti('Please login to continue survey!');
            redirect('home');
        }
        if (is_null($survey_id)) {
            return null;
        }
        $this->t_tracking->update_stage_by_id(STAGE_5, $tracking[0]['ID_COMPANY'], $tracking[0]['ID_COMPANY_AI']);
        $old_gap = $this->t_gap_analysis_rec->get_data_by_survey_id('*', $survey_id);
        /* Delete recommendation record */
        // $this->t_gap_analysis_rec->delete_data_by_survey_id($survey_id);
        // $this->data['gap_data'] = $this->t_survey_response_dtl->get_matrix_by_id($survey_id,$tracking[0]['ID_GS1']);
        $question_data = $this->t_survey_question->get_data_by_property('*');
        $this->data['id_company_ai'] = $tracking[0]['ID_COMPANY_AI'];
        $this->data['is_overseas'] = false;
        if ($tracking[0]['NM_SCOPE'] == 'Local Market') {
            $this->data['is_overseas'] = true;
        }
        $survey_data = $this->t_survey_response_dtl->getQuestionAnswerBySurvey($survey_id);
        $benchmark_data = $this->t_survey_response_dtl->getBenchmarkPointByLevel($tracking[0]['ID_GS1']);
        // log_message('error',print_r($survey_data));
        // $recommendation_text = $this->t_survey_response_dtl->getRecommendation(2, 2, 3);
        if (sizeof($old_gap) == 0) {
            foreach ($question_data as $key => $value) {
                $recommendation_text = $this->t_survey_response_dtl->getRecommendation($value['ID_QUESTION'], $survey_data[$key]['IN_POINT'], $benchmark_data[$key]['IN_POINT']);
                $item = array(
                    'ID_SURVEY' => $survey_id,
                    'ID_CATEGORY' => $value['NM_CATEGORY'],
                    'ID_QUESTION' => $value['ID_QUESTION'],
                    'IN_SCORE' => ((int)$survey_data[$key]['IN_POINT']) - ((int)$benchmark_data[$key]['IN_POINT']),
                    'TX_DEFAULT' => is_null($recommendation_text) ? '' : $recommendation_text,
                    'TX_RECOMMENDATION' => is_null($recommendation_text) ? '' : $recommendation_text,
                    'TX_NOTES' => '',
                    'DT_LAST_UPDATED' => date('Y-n-j G-i-s'));

                /* Insert recommendation record */
               $this->t_gap_analysis_rec->set_data($item);
            }
        } else {
            foreach ($question_data as $key => $value) {
                $recommendation_text = $this->t_survey_response_dtl->getRecommendation($value['ID_QUESTION'], $survey_data[$key]['IN_POINT'], $benchmark_data[$key]['IN_POINT']);
                $item = array(
                    'survey_id' => $survey_id,
                    'question_id' => $value['ID_QUESTION'],
                    'type' => 'IN_SCORE',
                    'text' => ((int)$survey_data[$key]['IN_POINT']) - ((int)$benchmark_data[$key]['IN_POINT'])
                );
                $this->t_gap_analysis_rec->update_data_by_survey($item);
                /* Insert recommendation record */
                if ($old_gap[$key]['TX_DEFAULT'] == $old_gap[$key]['TX_RECOMMENDATION']) {
                    $item = array(
                        'survey_id' => $survey_id,
                        'question_id' => $value['ID_QUESTION'],
                        'type' => 'TX_RECOMMENDATION',
                        'text' => is_null($recommendation_text) ? '' : $recommendation_text
                    );
                    /* Insert recommendation record */
                    $this->t_gap_analysis_rec->update_data_by_survey($item);
                }

                $item = array(
                    'survey_id' => $survey_id,
                    'question_id' => $value['ID_QUESTION'],
                    'type' => 'TX_DEFAULT',
                    'text' => is_null($recommendation_text) ? '' : $recommendation_text
                );
                /* Insert recommendation record */
                $this->t_gap_analysis_rec->update_data_by_survey($item);
            }
        }
        $this->data['gap_data'] = $this->t_gap_analysis_rec->get_matrix_by_id($survey_id);
        $free_text = $this->t_survey_response_hdr->get_data_by_property('TX_FREE', array('ID_SURVEY' => $survey_id));
        $this->data['free_text'] = $free_text[0]['TX_FREE'];
        $this->data['id_company'] = $tracking[0]['ID_COMPANY'];
        if ($this->data['gap_data'] != null) {
            $this->view('default', 'survey/gap_recommendation_view', $this->data, true);
        }
    }

    public function close_survey($id_survey = null)
    {
        $this->load->model('t_tracking');
        $data = array('DT_END' => date('Y-n-j G-i-s'));
        if ($id_survey != null) {
            $result = $this->t_tracking->update_data_by_id($data, $id_survey);
        }

        if ($result) {
            $segment = array('survey', 'take_search');
            $this->redirect($segment);
        } else {
            // CANNOT CLOSE
        }
    }

    public function reset_gap_recommendation()
    {
        $question_id = (int)$_POST['question_id'];

        $question_default_data = $this->t_gap_analysis_rec->get_data_by_question_id('*', $question_id);

        if (!is_null($question_default_data)) {
            echo json_encode($question_default_data);
        }
    }

    public function save_new_gap_recommendation()
    {
        $gap_info = $_POST['gap_info'];
        $result = $this->t_gap_analysis_rec->update_data_by_survey($gap_info);
        if ($result) {
            echo json_encode(array('status' => 1, 'message' => 'Successful'));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Unsuccessful'));
        }
    }

    public function save_all_recommendation()
    {
        if ($this->input->post()) {
            $free_text = $this->input->post('free_text');
            $id_question = $this->input->post('id_survey');
            $id_company = $this->input->post('id_company');
            $id_company_ai = $this->input->post('id_company_ai');
            $type = $this->input->post('submit');
        }
        $segment = array('survey', 'generate_gap_recommendation/' . $id_question);
        if($type == 'Save') {
            $stage_status = $this->t_tracking->getStageStatus($id_company_ai, 'STAGE_5');
            if ($stage_status && $stage_status != TRACKING_COMPLETED) {
                $this->t_tracking->updateStageByCompanyID($id_company_ai, array('STAGE_5' => TRACKING_IN_PROGRESS));
            }
            $this->noti('Save GAP analysis successfully!', 'success');
        }
        else {
            $this->t_tracking->updateStageByCompanyID($id_company_ai, array('STAGE_5' => TRACKING_COMPLETED, 'STAGE_6' => TRACKING_IN_PROGRESS, 'STAGE_7' => TRACKING_AVAILABLE));
            $segment = array('survey', 'take_report', $id_company_ai);
        }
        $this->t_survey_response_hdr->update_data_by_id(array('TX_FREE' => $free_text), $id_question);
        $this->redirect($segment);
    }

    public function take_gap($company_id = '')
    {
        $this->load->model('t_tracking');
        $tracking = $this->t_tracking->getActiveTracking($company_id);
        if (sizeof($tracking) > 0) {
            if ($tracking[0]['ID_SURVEY'] != 0) {
                $segment = array('survey', 'generate_gap_recommendation/' . $tracking[0]['ID_SURVEY']);
                $this->redirect($segment);
            } else {
                $this->noti('This Survey is not existed!');
                redirect(site_url());
            }
        } else {
            $this->noti('This profile is not existed!');
            redirect(site_url());
        }
    }

    public function close($id)
    {
        $company_info = $this->t_company_info->get_data_by_id('*', $id);
        $data = array(
            'DT_END' => date('Y-m-d H:i:s')
        );
        $tracking = $this->t_tracking->getActiveTracking($id);
        if (sizeof($tracking) > 0) {
            $this->t_survey_response_hdr->updateAVGScoreBySurvey($tracking[0]['ID_SURVEY']);
        }
        $active_profile = $this->t_tracking->get_active_profile($id);
        $result = $this->t_tracking->update_data_by_property($data, array('ID_COMPANY' => $company_info['ID_COMPANY'], 'ID_PROFILE' => $active_profile));
        if ($result) {
            $this->noti('Survey closed successfully!', 'success');
            redirect(site_url());
        }
    }

    public function take_report($company_id)
    {
        if (!$this->is_login()) {
            $this->noti('Please login to continue survey!');
            redirect('home');
        }
        if (is_null($company_id)) {
            return null;
        }
        $tracking = $this->t_tracking->getActiveTracking($company_id);
        if (sizeof($tracking) > 0) {
            $this->t_survey_response_hdr->updateAVGScoreBySurvey($tracking[0]['ID_SURVEY']);
            $this->data['tracking_record'] = $tracking[0];
            $this->redirect(array('report', 'load_gap_char', $company_id , $tracking[0]['ID_SURVEY']));
        } else {
            $this->noti('Invalid survey data!');
            redirect('home');
        }
    }

    public function generate_report($company_id)
    {
        if (!$this->is_login()) {
            $this->noti('Please login to continue survey!');
            redirect('home');
        }
        if (is_null($company_id)) {
            return null;
        }
        $tracking = $this->t_tracking->getActiveTracking($company_id);
        if (sizeof($tracking) > 0) {
            $this->data['tracking_record'] = $tracking[0];
            $this->data['tracking_record']['company_id'] = $company_id;
        } else {
            $this->data['tracking_record']['company_id'] = $company_id;
        }
        $this->data['ID_COMPANY'] = $tracking[0]['ID_COMPANY'];
        $this->data['ID_SURVEY'] = $tracking[0]['ID_SURVEY'];

        $this->view('default', 'survey/generate_report', $this->data, true);
    }
}