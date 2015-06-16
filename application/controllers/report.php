<?php
/**
 * User controller.
 *
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller
{
    var $sort;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();
        $this->load->model('t_survey_response_hdr');
        $this->load->model('t_company_assignment');
        $this->load->model('t_company_info');
        $this->load->model('t_company_profile');
        $this->load->model('t_participants_info');
        $this->load->model('t_tracking');
        $this->load->model('t_training_session');
        $this->load->model('t_user');
        $this->load->model('t_survey_response_dtl');
        $this->load->model('t_org_mapping');
        $this->load->model('t_dropdown');
        $this->load->model('t_growth_stage');
        $this->load->model('mreport');
        $this->load->library(array('form_validation'));
        $this->load->file("application/controllers/parse.php", false);
        $this->load->file("application/controllers/mpdf.php", false);
        $this->load->file("application/controllers/email.php", false);
        $this->load->file(APPPATH . 'models/form_validation/manage_report_rules.php', false);
        $this->sort = 'asc';
    }

    public function index()
    {
        if ($this->is_login() && $this->is_admin()) {
            $this->delete_session_rubish();
            $segment = array('report/search');
            $this->redirect($segment);
        } else {
            $this->require_login();
        }
    }

    public function search($offset = null, $sort = 'ascsort_1')
    {
        $this->check_role(array(1, 2), 0);
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }
        $this->set_page_title("Management Reports");
        $user_list = $this->t_user->get_list_user_by_role();
        $User_list = array('' => DEFAULT_BLANK_SELECT);
        foreach ($user_list as $key => $value) {
            $User_list[$value['ID_USER']] = $value['USER_NAME'];
        }
        $dropdown = $this->t_dropdown->core_get_all_data('t_dropdown');
        $Company_Industry = $Company_Type = $Revenue = $Total_Staff = $HR_Staff = $Scope_Of_Operation = array(
            '' => DEFAULT_BLANK_SELECT
        );
        foreach ($dropdown as $key => $value) {
            $val = $value['NM_TYPE'];
            switch ($val) {
                case 'Company_Industry':
                    $Company_Industry[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Company_Type':
                    $Company_Type[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Revenue':
                    $Revenue[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Total_Staff':
                    $Total_Staff[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'HR_Staff':
                    $HR_Staff[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Scope_Of_Operation':
                    $Scope_Of_Operation[$value['VALUE']] = $value['VALUE'];
                    break;
            }
        }

        $dropdown = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_1'));
        $Growth_Stage = array('' => DEFAULT_BLANK_SELECT);
        foreach ($dropdown as $key => $value) {
            $Growth_Stage[$value['ID_GS']] = $value['VALUE_TYPE'];
        }

        $dropdown = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_2'));
        $Management_Style = array('' => DEFAULT_BLANK_SELECT);
        foreach ($dropdown as $key => $value) {
            $Management_Style[$value['ID_GS']] = $value['VALUE_TYPE'];
        }

        $dropdown = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_3'));
        $Leader_Ship = array('' => DEFAULT_BLANK_SELECT);
        foreach ($dropdown as $key => $value) {
            $Leader_Ship[$value['ID_GS']] = $value['VALUE_TYPE'];
        }

        $result['Company_Industry'] = $Company_Industry;
        $result['Company_Type'] = $Company_Type;
        $result['Revenue'] = $Revenue;
        $result['Total_Staff'] = $Total_Staff;
        $result['HR_Staff'] = $HR_Staff;
        $result['Scope_Of_Operation'] = $Scope_Of_Operation;
        $result['Growth_Stage'] = $Growth_Stage;
        $result['Management_Style'] = $Management_Style;
        $result['Leader_Ship'] = $Leader_Ship;
        $result['User_List'] = $User_list;

        if($this->input->post('action') != ''){
            $record = $this->input->post();
        } else {
            // validation errors
            if(isset($this->session->userdata['SEARCH_INPUT'])) {
                $record = $this->session->userdata['SEARCH_INPUT'];
                $this->session->unset_userdata('SEARCH_INPUT');
            } else {
                $record = null;
            }
        }
        $session_backup = $record;
        if (isset($record)) {
            $result['NM_COMPANY_SELECT'] = $record['NM_COMPANY'];
            $result['ID_MS2_SELECT'] = $record['ID_MS2'];
            $result['NM_INDUSTRY_SELECT'] = $record['NM_INDUSTRY'];
            $result['ID_LC3_SELECT'] = $record['ID_LC3'];
            $result['NM_SCOPE_SELECT'] = $record['NM_SCOPE'];
            $result['REVENUE_SELECT'] = $record['REVENUE'];
            $result['NM_TYPE_SELECT'] = $record['NM_TYPE'];
            $result['N_L_HR_SELECT'] = $record['N_L_HR'];
            $result['ID_GS1_SELECT'] = $record['ID_GS1'];
            $result['officer_1_SELECT'] = $record['officer_1'];
            $result['officer_2_SELECT'] = $record['officer_2'];
            $result['DT_START_SELECT'] = $record['DT_START'];
            $result['DT_END_SELECT'] = $record['DT_END'];
            unset($record['action']);
            unset($result['action']);
        }

        if (($this->input->post() && $this->input->post('action') == 'Search') || $offset != null) {
            $this->form_validation->set_rules(Manage_report_rules::manage_report_rule());
            if ($offset == null) {
                $record = $this->input->post();
            } else {
                $record = $session_backup;
            }

            if ($this->form_validation->run() == TRUE || $offset != null) {
                $this->session->set_userdata('SEARCH_INPUT', $record);
                unset($record['action']);
                $condition = $record;
                if ($record['DT_START'] != null) {
                    $condition['t_tracking.DT_START > '] = $record['DT_START'];
                    $condition['t_tracking.DT_START < '] = $record['DT_END'];
                }

                $result['DT_START'] = $record['DT_START'];
                $result['DT_END'] = $record['DT_END'];
                $start_date = date("Y-m-d", strtotime($result['DT_START']));
                $end_date = date("Y-m-d", strtotime($result['DT_END']));
                $total_revenue = $this->get_total_revenue($condition['REVENUE']);
                $total_hr_team_size = $this->get_total_hr_size($condition['N_L_HR']);
                $filter_data = array(
                    'DT_START' => $start_date,
                    'DT_END' => $end_date,
                    'NM_COMPANY' => $record['NM_COMPANY'],
                    'NM_INDUSTRY' => $record['NM_INDUSTRY'],
                    'NM_TYPE' => $record['NM_TYPE'],
                    'NM_SCOPE' => $record['NM_SCOPE'],
                    'ID_GS1' => $record['ID_GS1'],
                    'ID_MS2' => $record['ID_MS2'],
                    'ID_LC3' => $record['ID_LC3']
                );

                $data = $this
                    ->t_company_profile
                    ->export_company_search($filter_data , $total_revenue, $total_hr_team_size, $id_user);
                $data = $this->fetch_officer($data, $condition['officer_1'], $condition['officer_2']);
                $result['result_search'] = array();
                if (count($data) > 0) {
                    $total_rows = count($data);
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
                    $config['base_url'] = site_url('/report/search/');
                    $config['uri_segment'] = 3;
                    $config['sort'] = $sort;
                    $this->sort = $sort;
                    $this->pagination->initialize($config);
                    $pagination = $this->pagination->create_links();
                    $offset = ($this->uri->segment(3) == null) ? 0 : $this->uri->segment(3);
                    $data = $this->custom_limit($data, $config['per_page'], $offset);
                    $result['pagination'] = $pagination;
                    foreach ($data as $key_ => $value_) {
                        array_push($result['result_search'], $data[$key_]);
                    }
                }

                $result['title_col'] = $this->extract_get_name_col();
                $result['userdata'] = $this->session->userdata(USER_SESSION_KEY);
                $this->view('default', 'report/search', $result);
            } else {
                $list_of_errors = validate_load(Manage_report_rules::manage_report_rule());
                $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                $this->session->set_userdata('error_mess_code', validation_errors());
                unset($record['action']);
                $this->session->set_userdata('SEARCH_INPUT', $record);
                $segment = array($this->router->class, 'search');
                $this->redirect($segment);
            }

        } elseif ($this->input->post() && $this->input->post('action') == 'Export') {
            $record = $this->input->post();
            $this->generate_extract_report($record);
        } else {
            $result['userdata'] = $this->session->userdata(USER_SESSION_KEY);
            $this->view('default', 'report/search', $result);
        }
    }

    public function training($offset = false, $sort = 'ascsort_1')
    {
        $this->session->unset_userdata('SEARCH_INPUT');
        $this->check_role(array(1, 2), 0);
        $this->set_page_title("Management Reports");
        $option = array('' => DEFAULT_BLANK_SELECT);
        foreach ($this->t_org_mapping->get_data() as $org) {
            $val = $org['NM_AGENCY'];
            $option[$val] = $org['NM_AGENCY'];
        }

        if ($offset === false) {
            $this->session->unset_userdata('TRAINING_REPORT');
        }

        if ($this->input->post('action') && $this->input->post('action') == 'Search') {
            $this->session->set_userdata('TRAINING_REPORT', $this->input->post());
            $this->form_validation->set_rules(Manage_report_rules::training_report_rule());
            if ($this->form_validation->run() == TRUE) {
                $agency = $this->input->post('organisation');
                $start_date = $this->input->post('DT_START');
                $end_date = $this->input->post('DT_END');
                $txt_search = $this->input->post('manage-report-training-txt-search');
            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 0);
                $list_of_errors = validate_load(Manage_report_rules::training_report_rule());
                $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                $this->session->set_userdata('error_mess_code', validation_errors());
                $this->session->set_userdata('MANAGE_REPORT', $this->input->post());
                $segment = array($this->router->class, 'training');
                $this->redirect($segment);
            }

        } elseif ($this->input->post('action') == 'Export') {
            if ($this->session->userdata['TRAINING_REPORT']) {
                $dat = $this->session->userdata['TRAINING_REPORT'];
                $agency = $dat['organisation'];
                $start_date = $dat['DT_START'];
                $end_date = $dat['DT_END'];
                $txt_search = $dat['manage-report-training-txt-search'];
            } else {
                $agency = $this->input->post('organisation');
                $start_date = $this->input->post('DT_START');
                $end_date = $this->input->post('DT_END');
                $txt_search = $this->input->post('manage-report-training-txt-search');
            }

            $result = $this->t_participants_info->filter_participants(null, null, $agency, $start_date, $end_date, $txt_search);
            if (count($result) > 0) {

                require_once 'Classes/PHPExcel/IOFactory.php';
                $arrayData = array(
                    array('System Date: ' . date("d.m.y H:i:s"), null),
                    array('Training Participant Extract', null),
                    array('Total Count: ', count($result))
                );
                $today = date("Ymd");
                $name_file = 'TrainingReport' . $today;
                $file_name = REPORT_TEMPLATE . "/TrainingReport.xls";
                $objReader = new PHPExcel_Reader_Excel5();
                $objPHPExcel = $objReader->load($file_name);

                $objPHPExcel->setActiveSheetIndex(0)->fromArray($arrayData, null, 'A1');
                if ($result) {
                    foreach ($result as $key => $value) {
                        $key += 6;
                        $date = explode(' ', $value['DT_START']);
                        $arrayData = array(isset($value['NM_EMAIL']) ? $value['NM_EMAIL'] : null, isset($value['NM_PARTICIPANT']) ? $value['NM_PARTICIPANT'] : null,
                            isset($value['NM_ORGANISATION']) ? $value['NM_ORGANISATION'] : null, isset($date[0]) ? $date[0] : null,
                            isset($value['ID_LOGIN']) ? $value['ID_LOGIN'] : null, isset($value['ID_LOGIN']) ? 'X' : null);
                        $objPHPExcel->setActiveSheetIndex(0)->fromArray($arrayData, null, 'A' . $key);
                    }
                }

                $objPHPExcel->getActiveSheet()->setTitle('Training Report');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $name_file . '.xls"');
                header('Cache-Control: max-age=0');

                $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
                try {
                    $objWriter->save("php://output");
                    $objWriter->save("temp/" . $name_file . ".xls");
                    return;
                } catch (Exception $e) {
                    $this->noti($e->getMessage());
                    $segment = array($this->router->class, 'training');
                    $this->redirect($segment);
                }
            } else {
                $this->noti('There was nothing to export!');
                $segment = array($this->router->class, 'training');
                $this->redirect($segment);
            }

        } elseif ($this->session->userdata('TRAINING_REPORT')) {
            $dat = $this->session->userdata['TRAINING_REPORT'];
            $agency = $dat['organisation'];
            $start_date = $dat['DT_START'];
            $end_date = $dat['DT_END'];
            $txt_search = $dat['manage-report-training-txt-search'];
        }
        if ($this->session->userdata('MANAGE_REPORT')) {
            foreach ($this->session->userdata('MANAGE_REPORT') as $key => $value) {
                $result[$key] = $value;
            }
            $result['data_search'] = $result['manage-report-training-txt-search'];
            $this->session->unset_userdata('MANAGE_REPORT');
            $result['org_info'] = $option;
        } elseif ($this->input->post() || isset($this->session->userdata['TRAINING_REPORT'])) {
            $total_rows = count($this->t_participants_info->filter_participants(null, null, $agency, $start_date, $end_date, $txt_search));
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
            $config['base_url'] = site_url('/report/training/');
            $config['uri_segment'] = 3;
            $config['sort'] = $sort;
            $this->sort = $sort;
            $this->pagination->initialize($config);
            $pagination = $this->pagination->create_links();
            $offset = ($this->uri->segment(3) == 0) ? 0 : $this->uri->segment(3);
            $result_search = $this->t_participants_info->filter_participants($config['per_page'], $offset, $agency, $start_date, $end_date, $txt_search);
            if (count($result_search) == 0) {
                $result['result_search'] = array();
            } else {
                $result['result_search'] = $result_search;
            }
            $result['data_search'] = $txt_search;
            $result['pagination'] = $pagination;
            $result['organisation'] = $agency;
            $result['DT_START'] = $start_date;
            $result['DT_END'] = $end_date;

        }

        $result['org_info'] = $option;
        $result['userdata'] = $this->session->userdata(USER_SESSION_KEY);
        $this->view('default', 'report/training', $result);

    }

    public function reports()
    {
        $this->session->unset_userdata('SEARCH_INPUT');
        $this->check_role(array(1, 2), 0);
        $this->set_page_title("Management Reports");
        if (isset($this->session->userdata['REPORT_INPUT'])) {
            $input = $this->session->userdata['REPORT_INPUT'];
            $this->session->unset_userdata('REPORT_INPUT');
        } else {
            $input = null;
        }

        $dropdown = $this->t_dropdown->core_get_all_data('t_dropdown');
        $Company_Industry = $Company_Type = $Revenue = $Total_Staff = $HR_Staff =
        $Scope_Of_Operation = $Growth_Stage = $Management_Style = $Leader_Ship = $officer_1 = $officer_2 = array('' => DEFAULT_BLANK_SELECT);

        foreach ($dropdown as $key => $value) {
            $val = $value['NM_TYPE'];
            switch ($val) {
                case 'Company_Industry':
                    $Company_Industry[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Company_Type':
                    $Company_Type[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Revenue':
                    $Revenue[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Total_Staff':
                    $Total_Staff[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'HR_Staff':
                    $HR_Staff[$value['VALUE']] = $value['VALUE'];
                    break;
                case 'Scope_Of_Operation':
                    $Scope_Of_Operation[$value['VALUE']] = $value['VALUE'];
                    break;
            }
        }

        $dropdown = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_1'));
        foreach ($dropdown as $key => $value) {
            $Growth_Stage[$value['ID_GS']] = $value['VALUE_TYPE'];
        }

        $dropdown = $this->t_user->get_all_data();
        foreach ($dropdown as $key => $value) {
            $officer_1[$value['ID_USER']] = $value['USER_NAME'];
        }

        $officer_2 = $officer_1;

        $dropdown = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_2'));
        foreach ($dropdown as $key => $value) {
            $Management_Style[$value['ID_GS']] = $value['VALUE_TYPE'];
        }

        $dropdown = $this->t_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_3'));
        foreach ($dropdown as $key => $value) {
            $Leader_Ship[$value['ID_GS']] = $value['VALUE_TYPE'];
        }

        $result['Company_Industry'] = $Company_Industry;
        $result['Company_Type'] = $Company_Type;
        $result['Revenue'] = $Revenue;
        $result['Total_Staff'] = $Total_Staff;
        $result['HR_Staff'] = $HR_Staff;
        $result['Scope_Of_Operation'] = $Scope_Of_Operation;
        $result['Growth_Stage'] = $Growth_Stage;
        $result['Management_Style'] = $Management_Style;
        $result['Leader_Ship'] = $Leader_Ship;
        $result['officer_1'] = $officer_1;
        $result['officer_2'] = $officer_2;

        if (isset($input['action']) && $input['action'] == 'Select') {
            $record = $input;
            $result['NM_COMPANY_SELECT'] = $input['NM_COMPANY'];
            $result['ID_MS2_SELECT'] = $input['ID_MS2'];
            $result['NM_INDUSTRY_SELECT'] = $input['NM_INDUSTRY'];
            $result['ID_LC3_SELECT'] = $input['ID_LC3'];
            $result['NM_SCOPE_SELECT'] = $input['NM_SCOPE'];
            $result['REVENUE_SELECT'] = $input['REVENUE'];
            $result['NM_TYPE_SELECT'] = $input['NM_TYPE'];
            $result['N_L_HR_SELECT'] = $input['N_L_HR'];
            $result['ID_GS1_SELECT'] = $input['ID_GS1'];
            $result['officer_1_SELECT'] = $input['officer_1'];
            $result['officer_2_SELECT'] = $input['officer_2'];
            $result['DT_START_SELECT'] = $input['DT_START'];
            $result['DT_END_SELECT'] = $input['DT_END'];

            unset($record['action']);
            unset($record['officer_1']);
            unset($record['officer_2']);
            unset($record['REVENUE']);
            unset($record['engage_status']);
            unset($record['REVENUE']);
            $this->session->unset_userdata('REPORT_INPUT');
            $condition = $record;
            if ($record['DT_START'] != null) {
                $condition['t_tracking.DT_START > '] = $record['DT_START'];
                $condition['t_tracking.DT_END < '] = $record['DT_END'];
            }

            $result['DT_START'] = $record['DT_START'];
            $result['DT_END'] = $record['DT_END'];
            unset($record['DT_START']);
            unset($record['DT_END']);
            unset($record['maturity_report_name']);
            unset($record['analysis_report_name']);
            unset($record['trending_analysis']);
            unset($record['profile_report']);
            unset($condition['DT_START']);
            unset($condition['DT_END']);

            if ($this->is_agency_admin()) {
                $user = $this->session->userdata(USER_SESSION_KEY);
                $id_user = $user['ID_USER'];
            } else {
                $id_user = null;
            }

            $result_query = $this->t_company_profile->report_get_company('*', $input, $id_user);
            if (count($result_query) == 0) {
                $result['not_found'] = 1;
            }

            foreach ($result_query as $key_ => $value_) {
                foreach ($record as $key => $value) {
                    $result['result_search'][$key_][$key] = $result_query[$key_][$key];
                }
            }

            $result['userdata'] = $this->session->userdata(USER_SESSION_KEY);
            $this->view('default', 'report/report', $result);
        } elseif ($input != null) {
            $result['NM_COMPANY_SELECT'] = $input['NM_COMPANY'];
            $result['ID_MS2_SELECT'] = $input['ID_MS2'];
            $result['NM_INDUSTRY_SELECT'] = $input['NM_INDUSTRY'];
            $result['ID_LC3_SELECT'] = $input['ID_LC3'];
            $result['NM_SCOPE_SELECT'] = $input['NM_SCOPE'];
            $result['REVENUE_SELECT'] = $input['REVENUE'];
            $result['NM_TYPE_SELECT'] = $input['NM_TYPE'];
            $result['N_L_HR_SELECT'] = $input['N_L_HR'];
            $result['ID_GS1_SELECT'] = $input['ID_GS1'];
            $result['officer_1_SELECT'] = $input['officer_1'];
            $result['officer_2_SELECT'] = $input['officer_2'];
            $result['DT_START_SELECT'] = $input['DT_START'];
            $result['DT_END_SELECT'] = $input['DT_END'];
            $result['userdata'] = $this->session->userdata(USER_SESSION_KEY);
            $this->session->unset_userdata('REPORT_INPUT');
            $this->view('default', 'report/report', $result);
        } else {
            $result['userdata'] = $this->session->userdata(USER_SESSION_KEY);
            $this->view('default', 'report/report', $result);
        }
    }

    public function generate_report($id_company = '', $index = '')
    {
        if (is_null($id_company)) {
            $this->noti('Invalid company info!');
            redirect('home');
        }

        $this->redirect(array('pdf', 'create', 'internal', $id_company));
    }

    // exporting gap chart when finish survey
    public function load_gap_char($id_company = '', $id_survey = '')
    {
        $tracking = $this->t_tracking->getActiveTracking($id_company);
        if ($id_survey == 'exporting') {
            $temp_post = $this->input->post();
            $temp_post['filename'] = "COM_$id_company" . '_' . $tracking[0]['ID_SURVEY'];
            $temp_post['id_company'] = $id_company;
            $this->exporting_not_create($temp_post);

            return;
        }
        $query_com = $this->t_company_info->get_data_by_id('ID_COMPANY', $id_company);
        $this->data['is_overseas'] = false;
        if ($tracking[0]['NM_SCOPE'] == 'Local Market') {
            $this->data['is_overseas'] = true;
        }

        if (count($query_com) == 1) {
            $query_sur = $this
                ->t_survey_response_hdr
                ->get_data_by_property('*', array('ID_SURVEY' => $id_survey, 'ID_COMPANY' => $query_com['ID_COMPANY']));
            if (count($query_sur) > 0) {
                if ($query_sur[0]['TX_STATUS'] == 'Completed') {
                    $query = $this->mreport->get_category();
                    $this->data['LIST'] = $query;
                    $query = $this->t_survey_response_hdr->get_data_by_property('*', array('ID_SURVEY' => $id_survey));
                    $line_blue_get = $query[0];
                    $line_blue = array();
                    $line_blue['INT_CAT1'] = (float)round($line_blue_get['INT_CAT1'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT2'] = (float)round($line_blue_get['INT_CAT2'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT3'] = (float)round($line_blue_get['INT_CAT3'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT4'] = (float)round($line_blue_get['INT_CAT4'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT5'] = (float)round($line_blue_get['INT_CAT5'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT6'] = (float)round($line_blue_get['INT_CAT6'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT7'] = (float)round($line_blue_get['INT_CAT7'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT8'] = (float)round($line_blue_get['INT_CAT8'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT9'] = (float)round($line_blue_get['INT_CAT9'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT10'] = (float)round($line_blue_get['INT_CAT10'], 2, PHP_ROUND_HALF_DOWN);
                    $line_blue['INT_CAT11'] = (float)round($line_blue_get['INT_CAT11'], 2, PHP_ROUND_HALF_DOWN);
                    $this->data['BLUE'] = $line_blue;
                    $company_query = $this->t_company_info->get_data_by_id('*', $id_company);
                    $query = $this
                        ->t_company_profile
                        ->get_data_by_property('*', array('ID_COMPANY' => $company_query['ID_COMPANY']));
                    $id_gs1 = $query['ID_GS1'];
                    $name_company = $query['ID_COMPANY'];
                    $this->data['NAME'] = $name_company;
                    $query = $this->mreport->get_point_red($id_gs1);
                    $line_red_get = $query;
                    $line_red = array();
                    $line_red['INT_CAT1'] = (float)round(($line_red_get[0]['IN_POINT']
                            + $line_red_get[1]['IN_POINT']
                            + $line_red_get[2]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT2'] = (float)round(($line_red_get[3]['IN_POINT']
                            + $line_red_get[4]['IN_POINT']
                            + $line_red_get[5]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT3'] = (float)round(($line_red_get[6]['IN_POINT']
                            + $line_red_get[7]['IN_POINT']
                            + $line_red_get[8]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT4'] = (float)round(($line_red_get[9]['IN_POINT']
                            + $line_red_get[10]['IN_POINT'] + $line_red_get[11]['IN_POINT']
                            + $line_red_get[12]['IN_POINT']) / 4, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT5'] = (float)round(($line_red_get[13]['IN_POINT']
                            + $line_red_get[14]['IN_POINT'] + $line_red_get[15]['IN_POINT']
                            + $line_red_get[16]['IN_POINT']) / 4, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT6'] = (float)round(($line_red_get[17]['IN_POINT']
                            + $line_red_get[18]['IN_POINT']
                            + $line_red_get[19]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT7'] = (float)round(($line_red_get[20]['IN_POINT']
                            + $line_red_get[21]['IN_POINT']
                            + $line_red_get[22]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT8'] = (float)round(($line_red_get[23]['IN_POINT']
                            + $line_red_get[24]['IN_POINT']
                            + $line_red_get[25]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT9'] = (float)round(($line_red_get[26]['IN_POINT']
                            + $line_red_get[27]['IN_POINT']) / 2, 0, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT10'] = (float)round(($line_red_get[28]['IN_POINT']
                            + $line_red_get[29]['IN_POINT']
                            + $line_red_get[30]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $line_red['INT_CAT11'] = (float)round(($line_red_get[31]['IN_POINT']
                            + $line_red_get[32]['IN_POINT']
                            + $line_red_get[33]['IN_POINT']) / 3, 2, PHP_ROUND_HALF_DOWN);
                    $this->data['RED'] = $line_red;
                    $this->load->view('report/report_general_gap_chart', $this->data);
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', 'Data error! Company Not Completed Survey');
                    $segment = array('home', 'index');
                    $this->redirect($segment);
                }

            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 1);
                $this->session->set_userdata('error_mess_code', 'Data error! Cannot Create Report! Try Again');
                $segment = array('home', 'index');
                $this->redirect($segment);
            }

        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', 'Data error! Cannot Create Report');
            $segment = array('home', 'index');
            $this->redirect($segment);
        }
    }

    public function load_pie_char($id_survey = '', $nm_company = '')
    {
        $query = $this->mreport->get_data_pie_char_new($id_survey, $nm_company);
        if (!is_null($query) && count($query) > 0) {
            $data['ALL'] = $query['ALL'];
            $data['DATA_1'] = $query['DATA_1'];
            $data['DATA_2'] = $query['DATA_2'];
            $data['DATA_3'] = $query['DATA_3'];
            $data['DATA_4'] = $query['DATA_4'];
            $data['COLOR_1'] = CHART_1_COLOR;
            $data['COLOR_2'] = CHART_2_COLOR;
            $data['COLOR_3'] = CHART_3_COLOR;
            $data['COLOR_4'] = CHART_4_COLOR;
            if ($data['DATA_1'] == 0) {
                $data['COLOR_1'] = 'white';
            }

            if ($data['DATA_2'] == 0) {
                $data['COLOR_2'] = 'white';
            }

            if ($data['DATA_3'] == 0) {
                $data['COLOR_3'] = 'white';
            }

            if ($data['DATA_4'] == 0) {
                $data['COLOR_4'] = 'white';
            }

            $this->data = $data;
            $this->load->view('report/report_general_pie_chart', $this->data);
            $this->session->set_userdata('PIE_NM', $nm_company);
            $this->session->set_userdata('PIE_IDS', $id_survey);
        } else {
            if (isset($_POST['id_survey'])) {
                $_POST['filename'] = $_POST['id_survey'];
                $_POST['id_survey'] = $id_survey;
                $nm_company = $this->session->userdata('PIE_NM');
                $name = $this->t_company_info->get_data_by_property('ID_COMPANY', array('NM_COMPANY' => $nm_company));
                if (!empty($name)) {
                    $id_company = $name[0]['ID_COMPANY'];
                } else {

                    return false;
                }
                $_POST['id_company'] = $id_company;
                $this->exporting($_POST);
                exit();
            } else {

                return false;
            }

        }
    }

    public function create_report_company($id_company = null, $id_survey = null)
    {
        if ($id_company == null || $id_survey == null) {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Data Not Valid';
            $this->display_error($this->data);

            return false;
        }
        $name_company = $this->t_company_info->get_data_by_property('NM_COMPANY', array('ID_COMPANY' => $id_company));
        if (count($name_company) > 0) {
            $nm_company = $name_company[0]['NM_COMPANY'];
        }

        $query = $this
            ->t_survey_response_hdr
            ->get_data_by_property('*', array('ID_COMPANY' => $nm_company, 'ID_SURVEY' => $id_survey));
        if (count($query) > 0) {
            $mpdf = new Create_pdf();
            $mpdf->create($id_company, $id_survey);
            $get_name = $this->t_company_info->get_data_by_id('NM_COMPANY', $id_company);
            if (count($get_name)) {
                $this->send_mail_with_report($get_name['NM_COMPANY']);
            } else {
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'The Company not found! Cannot create report';
                $this->display_error($this->data);
                return false;
            }

            return;
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Data Not Valid';
            $this->display_error($this->data);

            return false;
        }
    }

    public function exporting_not_create($temp_post = null)
    {
        if (!isset($temp_post['type'])) {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Deny Access!';
            $this->display_error($this->data);

            return;
        }
        ini_set('magic_quotes_gpc', 'off');
        $type = $temp_post['type'];
        $svg = (string)$temp_post['svg'];
        // remove border
        $befor = "visibility=\"visible\"></rect>";
        $after = "visibility=\"hidden\"></rect>";
        $svg = str_replace($befor, $after, $svg);
        //font-size:13px
        $befor = "font-size:13px";
        $after = "font-size:11px";
        $svg = str_replace($befor, $after, $svg);
        $befor = "#666;";
        $after = "#000;";
        $svg = str_replace($befor, $after, $svg);
        $befor = "<rect visibility=\"visible\"";
        $after = "<rect visibility=\"hidden\"";
        $svg = str_replace($befor, $after, $svg);
        $befor = "x=\"300\" y=\"61";
        $after = "x=\"300\" y=\"50";
        $svg = str_replace($befor, $after, $svg);
        $befor = ": verdana";
        $after = ": Century Gothic";
        $svg = str_replace($befor, $after, $svg);
        $befor = ": sans-serif";
        $after = ": Century Gothic";
        $svg = str_replace($befor, $after, $svg);
        $befor = ": sans-serif";
        $after = ": Century Gothic";
        $svg = str_replace($befor, $after, $svg);
        $filename = (string)$temp_post['filename'];
        // prepare variables
        if (!$filename or !preg_match('/^[A-Za-z0-9\-_ ]+$/', $filename)) {
            $filename = 'chart';
        }
        if (get_magic_quotes_gpc()) {
            $svg = stripslashes($svg);
        }
        // check for malicious attack in SVG
        if (strpos($svg, "<!ENTITY") !== false || strpos($svg, "<!DOCTYPE") !== false) {
            exit("Execution is topped, the posted SVG could contain code for a malicious attack");
        }
        $tempName = $filename;
        // allow no other than predefined types
        if ($type == 'image/png') {
            $typeString = '-m image/png';
            $ext = 'png';

        } elseif ($type == 'image/jpeg') {
            $typeString = '-m image/jpeg';
            $ext = 'jpg';
        } elseif ($type == 'application/pdf') {
            $typeString = '-m application/pdf';
            $ext = 'pdf';
        } elseif ($type == 'image/svg+xml') {
            $ext = 'svg';
        } else { // prevent fallthrough from global variables
            $ext = 'txt';
        }
        $outfile = "temp/$tempName.$ext";
        if (isset($typeString)) {

            // size
            $width = '';
            if ($temp_post['width']) {
                $width = (int)$temp_post['width'];
                if ($width) $width = "-w $width";
            }
            if (!file_exists('temp')) {
                mkdir('temp', 0777, true);
            }
            // generate the temporary file
            if (!file_put_contents("temp/$tempName.svg", $svg)) {
                die("Couldn't create temporary file. Check that the directory permissions for
					the /temp directory are set to 777.");
            }

            define ('BATIK_PATH', 'batik-rasterizer.jar');
            // do the conversion
            $output = shell_exec("java -jar " . BATIK_PATH . " $typeString -d $outfile $width temp/$tempName.svg");

            // catch error
            if (!is_file($outfile) || filesize($outfile) < 10) {

            } // stream it
            else {
                header("Content-Disposition: attachment; filename=\"$filename.$ext\"");
                header("Content-Type: $type");
            }

            // $this->view('default', 'survey/thankyou_take_survey_view', null);
            if (is_numeric($temp_post['id_company'])) {
                // not send mail
                $id_company = $temp_post['id_company'];
                $link = site_url() . "report/generate_report/$id_company";
                // echo ("<script type="text/javascript">var w = window.open (\"$link\",\"_blank\");
                // if(typeof w == \"undefined\") {
                // 	var ww = window.open (\"$link\",\"_blank\", \"height=100, width=100\");
                // 	if(typeof ww == \"undefined\") {
                // 		alert('Your browser do not support open pop-up! we cannot create report from result survey');
                // 	}
                // }
                // </script>");
                //echo ("<script type="text/javascript">window.close();</script>");
                $segment = array($this->router->class, 'generate_report', $id_company);
                $this->redirect($segment);

            } else {
                // khong the tao report! vui long thu lai
            }

        } else if ($ext == 'svg') {
            header("Content-Disposition: attachment; filename=\"$filename.$ext\"");
            header("Content-Type: $type");
            echo $svg;

        } else {
            echo "Invalid type";
        }
        return;
    }

    public function send_mail_with_report($nm_company = '')
    {
        if (!empty($nm_company)) {
            if ($this->session->userdata(USER_SESSION_KEY)) {
                $ses_tem = $this->session->userdata(USER_SESSION_KEY);
                $to = $ses_tem['TX_USEREMAIL'];
                $sendemail = new Email();
                $file_name = $nm_company;
                $link_down = site_url() . "/report/download_report/$file_name";
                $parse_email = "
				<html>
				<p>The report has been created by you require<p><br />
				<br />
				<p>Please Click <a href=\"$link_down\"><em> Here </em></a> to download report</p>
				</html>
				";
                $get_link = "temp/" . $file_name . ".pdf";
                $att['link'] = $get_link;
                $att['name'] = $file_name . '.pdf';
                $arraymail = array('SUBJECT' => 'Completion Create Report For Company : ' . strtoupper($nm_company),
                    'TO' => $to,
                    'BODY' => $parse_email
                );
                $type = "complete_when_finish_report";
                // set $att = null -> not attachment
                if ($sendemail->send_mail($arraymail, null, $type)) {
                    // $this->session->set_userdata('type_mess_code', SUCCESS_CLASS);
                    // $this->session->set_userdata('error_flag_code', 1);
                    // $this->session->set_userdata('error_mess_code', 'This report  create  complete! a email will be sent to your mailbox');
                    $segment = array($this->router->class, 'create_report_complete_and_close');
                    $this->redirect($segment);
                }
            } else {
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'System cannot find your mail! Please Login Again!';
                $this->display_error($this->data);
                unset($this->session->userdata);
                $this->require_login();
            }
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Page not found. You can not access this url!';
            $this->display_error($this->data);
        }
    }

    public function create_report_complete_and_close()
    {
        echo('<script type="text/javascript">window.close();</script>');
    }

    public function download_report($id_company, $id_survey, $type_report = 1)
    {
        if ($this->session->userdata(USER_SESSION_KEY)) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $user_id = $user['ID_USER'];
            if ($this->is_user()) {
                if ($type_report == 1) {
                    $array_company_user = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
                    $pos = (isset($array_company_user) && count($array_company_user) > 0)
                        ? array_search($id_company, array_comlumnfx($array_company_user, 'ID_COMPANY')) : false;
                    if ($pos === false) {
                        $this->noti('You are not allowed to view this report!');
                        $segment = array('home', 'index');
                        $this->redirect($segment);
                    }
                }

            } elseif ($this->is_restrict_user()) {
                $array_company_user = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
                $pos = (isset($array_company_user) && count($array_company_user) > 0)
                    ? array_search($id_company, array_comlumnfx($array_company_user, 'ID_COMPANY')) : false;
                if ($pos === false) {
                    $this->noti('You are not allowed to view this report!');
                    $segment = array('home', 'index');
                    $this->redirect($segment);
                }

            } elseif ($this->is_agency_admin()) {
                $array_company_agency = $this->t_company_info->agency_get_mapped_company($user_id);
                $agency_assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user_id);
                $pos = (isset($array_company_agency) && count($array_company_agency) > 0)
                    ? array_search($id_company, array_comlumnfx($array_company_agency, 'ID_COMPANY')) : false;
                $pos_ass = (isset($agency_assigned_company) && count($agency_assigned_company) > 0)
                    ? array_search($id_company, array_comlumnfx($agency_assigned_company, 'ID_COMPANY')) : false;
                if ($pos === false && $pos_ass === false) {
                    $this->noti('You are not allowed to view this report!');
                    $segment = array('home', 'index');
                    $this->redirect($segment);
                }
            }

            if (empty($id_company) || empty($id_survey)) {
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'File not found. You can not download it!';
                $this->display_error($this->data);
                return false;
            } else {
                if ($type_report == 2) {
                    $name_file = 'external_' . $id_company . '_' . $id_survey;
                } else {
                    $name_file = 'internal_' . $id_company . '_' . $id_survey;
                }

                ini_set('memory_limit', '-1');
                $get_link = base_url() . "reports/" . $name_file . ".pdf";
                if (file_exists("reports/" . urldecode($name_file) . ".pdf")) {
                    $file = file_get_contents($get_link);
                    if ($type_report == 2) {
                        $name = 'External HRMD Report Of ' . $id_company . '.pdf';
                    } else {
                        $name = 'Internal HRMD Report Of ' . $id_company . '.pdf';
                    }

                    $this->load->helper('download');
                    force_download($name, $file);
                } else {
                    $this->data['title'] = 'Error access!';
                    $this->data['message'] = 'File not found. You can not download it!';
                    $this->display_error($this->data);
                }
            }
        }
    }

    public function generate_engagement($input)
    {
        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name_input = $input['engage_status'];

        if ($file_name_input == null) {
            $file_name_input = 'HRMD Engagement Status Report';
        }

        if ($input['DT_START'] != null) {
            $time = strtotime($input['DT_START']);
            $new_start_date = date('d.m.Y', $time);
        }

        if ($input['DT_END'] != null) {
            $time = strtotime($input['DT_END']);
            $new_end_date = date('d.m.Y', $time);
        }

        $data = $this->get_data_engage($input);
        $file_name = REPORT_TEMPLATE . "/engagement_status_report.xls";
        $objReader = new PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file_name);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'System Date: ' . date("d.m.Y H:i:s"))
            ->setCellValue('B3', $new_start_date)
            ->setCellValue('D3', $new_end_date)
            ->setCellValue('B5', $data['total_company_create']  != null ? $data['total_company_create'] : 0)
            ->setCellValue('B7', $data['total_open_survey']  != null ? $data['total_open_survey'] : 0)
            ->setCellValue('B8', $data['total_close_survey']  != null ? $data['total_close_survey'] : 0)
            ->setCellValue('B9', '=SUM(B7:B8)')
            ->setCellValue('B11', $data['total_open_session']  != null ? $data['total_open_session'] : 0)
            ->setCellValue('B12', $data['total_close_session']  != null ? $data['total_close_session'] : 0)
            ->setCellValue('B13', '=SUM(B11:B12)')
            ->setCellValue('B15', $data['total_user_create']  != null ? $data['total_user_create'] : 0);

        $objPHPExcel->getActiveSheet()->setTitle('Training Report');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name_input . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        try {
            $objWriter->save("php://output");
            $objWriter->save("temp/" . $file_name_input . ".xls");
        } catch (Exception $e) {
            $this->noti($e->getMessage());
            $segment = array($this->router->class, 'reports');
            $this->redirect($segment);
        }

    }

    public function generate_company_profile($input)
    {
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }

        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name_input = $input['profile_report'];
        if ($file_name_input == null) {
            $file_name_input = 'Company Profile Report';
        }

        if ($input['DT_START'] != null) {
            $time = strtotime($input['DT_START']);
            $start_date = date('d.m.Y', $time);
        }

        if ($input['DT_END'] != null) {
            $time = strtotime($input['DT_END']);
            $end_date = date('d.m.Y', $time);
        }

//Excel header
        $headerData = array(
            array('System Date: ' . date("d.m.y H:i:s"), null, null, null),
            array(null, null, null, null),
            array(null, $start_date, null, $end_date)
        );
        $total_companies = $temp = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
        $total_companies = $total_companies[0]['count'];
        $where = $input;

        $where['NM_SCOPE'] = 'Local Market';
        $array_temp = array();
        $temp = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);

        if ($input['NM_SCOPE'] == 'Local and Overseas Markets') {
            array_push($array_temp, array(0));
        } else {
            array_push($array_temp, array($temp[0]['count']));
        }

        $where['NM_SCOPE'] = 'Local and Overseas Markets';
        $temp = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
        if ($input['NM_SCOPE'] == 'Local Market') {
            array_push($array_temp, array(0));
        } else {
            array_push($array_temp, array($temp[0]['count']));
        }

        $sheet_start_cell = array(
            'B8',
            'B11',
            'B11',
            'B11',
            'B11',
            'B10',
            'B9',
            'B9'
            );
//get data to array
        $result = $this->company_type_get_data($input, $id_user);
        $arrayData[0] = $result;

        $result = $this->scope_sheet_get_data($input, $id_user);
        $arrayData[1] = $result;

        $result = $this->workforce_sheet_get_data($input, $id_user);
        $arrayData[2] = $result;

        $result = $this->financials_sheet_get_data($input, $id_user);
        $arrayData[3] = $result;

        $result = $this->metric_sheet_get_data($input, $id_user);
        $arrayData[4] = $result;

        $result = $this->growth_stage_sheet_get_data($input, $id_user);
        $arrayData[5] = $result;

        $result = $this->management_style_sheet_get_data($input, $id_user);
        $arrayData[6] = $result;

        $result = $this->leadership_commitment_sheet_get_data($input, $id_user);
        $arrayData[7] = $result;
//open file
        $file_name = REPORT_TEMPLATE . "/Company_profile_report.xls";
        $objReader = new PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file_name);
//write array data
        for ($i=0;$i<8;$i++) {
            $objPHPExcel->setActiveSheetIndex($i)->fromArray($headerData, null, 'A1');
            if (in_array($i, array(2,3,4))) {
                $objPHPExcel->setActiveSheetIndex($i)->fromArray($array_temp, null, 'B4');
            }
            if (in_array($i, array(0,5,6,7))) {
                $objPHPExcel->setActiveSheetIndex($i)->setCellValue('B4', $total_companies);
            }
            if (isset($arrayData[$i])) {
                $objPHPExcel->setActiveSheetIndex($i)->fromArray($arrayData[$i], null, $sheet_start_cell[$i]);
            }
        }

//save file
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name_input . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        try {
            $objWriter->save("php://output");
            $objWriter->save("temp/" . $file_name_input . ".xls");
        } catch (Exception $e) {
            $this->noti($e->getMessage());
            $segment = array($this->router->class, 'reports');
            $this->redirect($segment);
        }

    }

    /**
     * @param $input
     * @throws PHPExcel_Exception
     * generate trending report
     */
    public function generate_trending($input)
    {
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }
        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name_input = $input['trending_analysis'];
        if ($file_name_input == null) {
            $file_name_input = 'Company Trending Analysis Report';
        }

        if ($input['DT_START'] != null) {
            $start_date = date("Y-m-d", strtotime($input['DT_START']));
        } else {
            $start_date = null;
        }

        if ($input['DT_END'] != null) {
            $end_date = date("Y-m-d", strtotime($input['DT_END']));
        } else {
            $end_date = null;
        }

        $filter_data = array(
            'DT_START' => $start_date,
            'DT_END' => $end_date,
            'NM_COMPANY' => $input['NM_COMPANY'],
            'NM_INDUSTRY' => $input['NM_INDUSTRY'],
            'NM_TYPE' => $input['NM_TYPE'],
            'NM_SCOPE' => $input['NM_SCOPE'],
            'ID_GS1' => $input['ID_GS1'],
            'ID_MS2' => $input['ID_MS2'],
            'ID_LC3' => $input['ID_LC3']
        );

        $total_revenue = $this->get_total_revenue($input['REVENUE']);
        $total_hr_team_size = $this->get_total_hr_size($input['N_L_HR']);
        $id_profile_more_than_two_survey = $this
            ->t_company_profile
            ->get_company_profile_more_than_two_survey($filter_data, $total_revenue, $total_hr_team_size, $id_user);
        $arr = array();
        $total_companies = count($id_profile_more_than_two_survey);
        if(count($id_profile_more_than_two_survey > 0)){
            foreach ($id_profile_more_than_two_survey as $key => $value) {
                if ($value['size'] >= 2) {
                    $arr[] = $value['ID_COMPANY'];
                }
            }
        }
        if (count($arr) <= 0) {
            $this->noti('Can not find company profile');
            $segment = array($this->router->class, 'reports');
            $this->redirect($segment);
        } else {
            $cell = $this->t_survey_response_hdr->get_data_by_property_in_array('*', $arr);
            if (!is_null($cell)) {
                $file_name = REPORT_TEMPLATE . "/trending_analysis_report.xls";
                $objReader = new PHPExcel_Reader_Excel5();
                $objPHPExcel = $objReader->load($file_name);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'System Date: ' . date("d.m.y H:i:s"))
                    ->setCellValue('B3', date("d.m.y", strtotime($start_date)))
                    ->setCellValue('D3', date("d.m.y", strtotime($end_date)))
                    ->setCellValue('B4', $total_companies);
                $array_temp = array();
                for ($i = 1; $i < 12 ; $i++) {
                    $array_temp2 = array();
                    array_push($array_temp2, $cell[SECOND_LATEST_SURVEY]['INT_CAT'.$i]);
                    array_push($array_temp2, $cell[LATEST_SURVEY]['INT_CAT'.$i]);
                    array_push($array_temp, $array_temp2);
                }

                $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_temp, null, 'B7');
                $objPHPExcel->getActiveSheet()->setTitle('Trending Analysis Report');
                $objPHPExcel->setActiveSheetIndex(0);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $file_name_input . '.xls"');
                header('Cache-Control: max-age=0');

                $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
                try {
                    $objWriter->save("php://output");
                } catch (Exception $e) {
                    $this->noti('Failed to create Excel file: ' . $e->getMessage() . '.');
                    $segment = array($this->router->class, 'reports');
                    $this->redirect($segment);
                }

            } else {
                $this->noti('Can not find company profile');
                $segment = array($this->router->class, 'reports');
                $this->redirect($segment);
            }
        }
    }

    /**
     * @param $input
     * @throws PHPExcel_Exception
     * generate extract report
     */
    public function generate_extract_report($input)
    {
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }
        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name_output = 'System Extract Report';

        if ($input['DT_START'] != null) {
            $start_date = date("Y-m-d", strtotime($input['DT_START']));

        }

        if ($input['DT_END'] != null) {
            $end_date = date("Y-m-d", strtotime($input['DT_END']));
        }

        $filter_data = array(
            'DT_START' => $start_date,
            'DT_END' => $end_date,
            'NM_COMPANY' => $input['NM_COMPANY'],
            'NM_INDUSTRY' => $input['NM_INDUSTRY'],
            'NM_TYPE' => $input['NM_TYPE'],
            'NM_SCOPE' => $input['NM_SCOPE'],
            'ID_GS1' => $input['ID_GS1'],
            'ID_MS2' => $input['ID_MS2'],
            'ID_LC3' => $input['ID_LC3']
        );
        $total_revenue = $this->get_total_revenue($input['REVENUE']);
        $total_hr_team_size = $this->get_total_hr_size($input['N_L_HR']);
        //columns generate excell
        $range = range('A', 'Z');
        $column_range = $range;
        foreach ($range as $value) {
            array_push($column_range, 'A' . $value);
        }
        foreach ($range as $value) {
            array_push($column_range, 'B' . $value);
        }
        foreach ($range as $value) {
            array_push($column_range, 'C' . $value);
            if ($value == 'K') {
                break;
            }
        }

        $data = $this
            ->t_company_profile
            ->export_company_search($filter_data, $total_revenue, $total_hr_team_size, $id_user);
        $data = $this->fetch_officer($data, $input['officer_1'], $input['officer_2']);
        if (!is_null($data)) {
            $file_name = REPORT_TEMPLATE . "/system_extract.xls";
            $objReader = new PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_name);
            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->setTitle('System Extract');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'System Date: ' . date("d.m.y H:i:s"));
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B3', count($data));
            $total_survey = count($data);

            for ($j = 6; $j < $total_survey + 6; $j++) {
                $tmp = $data[$j - 6];
                $key_array = array_keys($tmp);
                foreach ($column_range as $key => $value) {
                    if ($value == 'J' || $value == 'N') {
                        $objPHPExcel
                            ->setActiveSheetIndex(0)
                            ->setCellValueExplicit($value . $j, $tmp[$key_array[$key]],
                                PHPExcel_Cell_DataType::TYPE_STRING);
                    } else {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($value . $j, $tmp[$key_array[$key]]);
                    }
                }
            }
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $file_name_output . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
            try {
                $objWriter->save("php://output");
            } catch (Exception $e) {
                $this->noti('Failed to create Excel file: ' . $e->getMessage() . '.');
                $segment = array($this->router->class, 'reports');
                $this->redirect($segment);
            }

        } else {
            $this->noti('Can not find company profile to extract');
            $segment = array($this->router->class, 'search');
            $this->redirect($segment);
        }

    }

    public function report_submit()
    {
        $this->check_role(array(1, 2), 0);
        $record = $this->input->post();
        $this->session->set_userdata('REPORT_INPUT', $record);
        $this->form_validation->set_rules(Manage_report_rules::manage_report_rule());
        if ($this->form_validation->run() == TRUE) {
            if (isset($record['generate5']) && $record['generate5'] == 'Generate') {
                $this->generate_engagement($record);
            } elseif (isset($record['generate4']) && $record['generate4'] == 'Generate') {
                $this->generate_trending($record);
            } elseif (isset($record['generate2']) && $record['generate2'] == 'Generate') {
                $this->generate_maturity($record);
            } elseif (isset($record['generate3']) && $record['generate3'] == 'Generate') {
                $this->generate_analysis($record);
            } elseif (isset($record['generate1']) && $record['generate1'] == 'Generate') {
                $this->generate_company_profile($record);
            } else {
                $segment = array($this->router->class, 'reports');
                $this->redirect($segment);
            }

        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $list_of_errors = validate_load(Manage_report_rules::manage_report_rule());
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('error_mess_code', validation_errors());
            unset($record['action']);
            $this->session->set_userdata('REPORT_INPUT', $record);
            $segment = array($this->router->class, 'reports');
            $this->redirect($segment);

        }

    }

    public function get_data_maturity($input, $row = 7)
    {
        $where = $input;
        $where['close_survey'] = 1;

        $revenue[1] = '$100M and above';
        $revenue[2] = '$80M to < $100M';
        $revenue[3] = '$50M to < $80M';
        $revenue[4] = '$30M to < $50M';
        $revenue[5] = '$10M to < $30M';
        $revenue[6] = '$5M to < $10M';
        $revenue[7] = '$1M to < $5M';
        $revenue[8] = '< $1M';

        $level[1] = '1';
        $level[2] = '2';
        $level[3] = '3';
        $level[4] = '4';
        unset($where['engage_status']);
        unset($where['generate5']);
        $array_revenue = array();
        $array_total = array();
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }
        if (isset($where['REVENUE']) && $where['REVENUE'] != null) {
            $revenue_search = true;
            $start = array_search($where['REVENUE'], $revenue);
        } else {
            $revenue_search = false;
            $start = 1;
        }
        for ($i = 1; $i < 9; $i++) {
            if ($revenue_search == false) {
                $where['REVENUE'] = $revenue[$i];
            }

            $array_level = array();
            for ($j = 1; $j < 5; $j++) {
                if (isset($revenue_search) && $revenue_search == true && $i != $start) {
                    array_push($array_level, 0);
                    continue;
                }
                $where['LEVEL'] = $level[$j];
                $count_company_revenu_vs_level = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
                array_push($array_level, $count_company_revenu_vs_level[0]['count']);

            }

            for ($j = 1; $j < 12; $j++) {
                if (isset($revenue_search) && $revenue_search == true && $i != $start) {
                    array_push($array_level, 0);
                    continue;
                }

                unset($where['LEVEL']);
                if ($j == 11) {
                    $scope_backup = $where['NM_SCOPE'];
                    $where['NM_SCOPE'] = 'Local and Overseas Markets';
                }
                $avg_cat = $this
                    ->t_company_profile
                    ->report_get_company('AVG(e.INT_CAT' . $j . ') as avg_cat', $where, $id_user);
                $temp = $avg_cat[0]['avg_cat'];
                if ($j == 11) {
                    if ($scope_backup != null) {
                        $where['NM_SCOPE'] = $scope_backup;
                    } else {
                        $where['NM_SCOPE'] = null;
                    }
                }
                if ($temp > 0) {
                    $temp += 0.001;
                    $temp = '=ROUNDDOWN(' . $temp . ', 1)';
                }
                array_push($array_level, $temp);
            }

            $avg_level = $this->t_company_profile->report_get_company('AVG(e.INT_PT) as avg_level', $where, $id_user);
            $temp = $avg_level[0]['avg_level'];
            if ($temp > 0) {
                $temp += 0.001;
                $temp = '=ROUNDDOWN(' . $temp . ', 1)';
            }
            if (isset($revenue_search) && $revenue_search == true && $i != $start) {
                array_push($array_level, 0);
            } else {
                array_push($array_level, $temp);
            }

            array_push($array_revenue, $array_level);
        }

        $range = range('B', 'E');
        foreach ($range as $key) {
            array_push($array_total, '=SUM(' . $key . ($row + 5) . ':' . $key . ($row + 12) . ')');
        }

        array_push($array_revenue, $array_total);
        $employee[5] = $this->maturity_employee_condition('< 50', '(a.N_LOCAL_STAFF + a.N_OVERSEAS_STAFF)');
        $employee[4] = $this->maturity_employee_condition('50 to < 100', '(a.N_LOCAL_STAFF + a.N_OVERSEAS_STAFF)');
        $employee[3] = $this->maturity_employee_condition('100 to <  150', '(a.N_LOCAL_STAFF + a.N_OVERSEAS_STAFF)');
        $employee[2] = $this->maturity_employee_condition('150 to < 200', '(a.N_LOCAL_STAFF + a.N_OVERSEAS_STAFF)');
        $employee[1] = $this->maturity_employee_condition('> 200', '(a.N_LOCAL_STAFF + a.N_OVERSEAS_STAFF)');
        $level[1] = '1';
        $level[2] = '2';
        $level[3] = '3';
        $level[4] = '4';
        $array_employee = array();
        $array_total = array();

        if ($revenue_search === false) {
            unset($where['REVENUE']);
        }
        for ($i = 1; $i < 6; $i++) {
            $array_level = array();
            $where['EMPLOYEE'] = $employee[$i];
            for ($j = 1; $j < 5; $j++) {
                $where['LEVEL'] = $level[$j];
                $count_company_employee_vs_level = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
                array_push($array_level, $count_company_employee_vs_level[0]['count']);
            }

            for ($j = 1; $j < 12; $j++) {
                unset($where['LEVEL']);
                if ($j == 11) {
                    $scope_backup = $where['NM_SCOPE'];
                    $where['NM_SCOPE'] = 'Local and Overseas Markets';
                }
                $avg_cat = $this
                    ->t_company_profile
                    ->report_get_company('AVG(e.INT_CAT' . $j . ') as avg_cat', $where, $id_user);
                $temp = $avg_cat[0]['avg_cat'];
                if ($j == 11) {
                    if ($scope_backup != null) {
                        $where['NM_SCOPE'] = $scope_backup;
                    } else {
                        $where['NM_SCOPE'] = null;
                    }
                }

                if ($temp > 0) {
                    $temp += 0.001;
                    $temp = '=ROUNDDOWN(' . $temp . ', 1)';
                }

                array_push($array_level, $temp);
            }

            $avg_level = $this
                ->t_company_profile
                ->report_get_company('AVG(e.INT_PT) as avg_level', $where, $id_user);
            $temp = $avg_level[0]['avg_level'];
            if ($temp > 0) {
                $temp += 0.001;
                $temp = '=ROUNDDOWN(' . $temp . ', 1)';
            }

            array_push($array_level, $temp);
            array_push($array_employee, $array_level);
        }

        $range = range('B', 'E');
        foreach ($range as $key) {
            array_push($array_total, '=SUM(' . $key . ($row + 15) . ':' . $key . ($row + 19) . ')');
        }
        array_push($array_employee, $array_total);
        $result = array();
        array_push($result, $array_revenue);
        array_push($result, $array_employee);

        return $result;
    }

    public function get_data_engage($input)
    {
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }
        $where = $input;
        unset($where['engage_status']);
        unset($where['generate5']);
        $data = array();
        $where['total_company_create'] = 1;
        $data['total_company_create'] = $this
            ->t_company_profile
            ->report_get_company('COUNT(DISTINCT(b.ID_COMPANY)) as total', $where, $id_user);
        $where['open_survey'] = 1;
        $data['total_open_survey'] = $this
            ->t_company_profile
            ->report_get_company('count(*) as total', $where, $id_user);
        unset($where['open_survey']);
        $where['close_survey'] = 1;
        $data['total_close_survey'] = $this
            ->t_company_profile
            ->report_get_company('count(*) as total', $where, $id_user);
        $data['total_open_session'] = $this
            ->t_training_session
            ->get_data_by_property('count(*) as total',
            array("ID_STATUS = 0 AND DT_START BETWEEN '" . $input['DT_START'] . "' AND '" . $input['DT_END'] . "'" => null));
        $data['total_close_session'] = $this->t_training_session->get_data_by_property('count(*) as total',
            array("ID_STATUS = 1 AND DT_START BETWEEN '" . $input['DT_START'] . "' AND '" . $input['DT_END'] . "'" => null));
        $data['total_user_create'] = $this->t_user->get_data_by_property('count(*) as total',
            array("(DT_DELETED = '0000-00-00 00:00:00' OR DT_DELETED IS NULL) AND DT_CREATED BETWEEN '"
            . $input['DT_START'] . "' AND '" . $input['DT_END'] . "'" => null));
        foreach ($data as $key => $value) {
            if (count($value) > 0) {
                $data_[$key] = $value[0]['total'];
            } else {
                $data_[$key] = 0;
            }
        }
        return $data_;
    }

    public function generate_analysis($input)
    {
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }

        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name_input = $input['analysis_report_name'];
        if ($file_name_input == null) {
            $file_name_input = 'Sector Analysis Report';
        }

        if ($input['DT_START'] != null) {
            $time = strtotime($input['DT_START']);
            $start_date = date('d.m.Y', $time);
        }

        if ($input['DT_END'] != null) {
            $time = strtotime($input['DT_END']);
            $end_date = date('d.m.Y', $time);
        }

        $arrayData = array(
            array('System Date: ' . date("d.m.y H:i:s"), null, null, null, null, null),
            array(null, null, null, null, null, null,),
            array(null, $start_date, null, null, null, $end_date),
        );

        $input['NM_SCOPE'] = 'Local Market';
        $total_local_operation = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
        $input['NM_SCOPE'] = 'Local and Overseas Markets';
        $total_local_and_overseas_operation = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
        $input['NM_SCOPE'] = '';
        $file_name = REPORT_TEMPLATE . "/Sector_analysis.xls";
        $objReader = new PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file_name);
        if ($input['NM_INDUSTRY'] != null) {
            $row = 8;
            $array_b = $this->get_data_maturity($input, $row);
            $objPHPExcel->setActiveSheetIndex(0)->fromArray($arrayData, null, 'A1');
            $objPHPExcel->setActiveSheetIndex(0)->fromArray($total_local_operation[0], null, 'B4');
            $objPHPExcel->setActiveSheetIndex(0)->fromArray($total_local_and_overseas_operation[0], null, 'B5');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row, $input['NM_INDUSTRY']);
            $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_b[0], null, 'B13');
            $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_b[1], null, 'B23');
            $range = range('F', 'Q');
            foreach ($range as $key) {
                $array_cat = $objPHPExcel
                    ->setActiveSheetIndex(0)
                    ->rangeToArray($key . ($row + 5) . ':' . $key . ($row + 13));
                $avg = $this->average_if($array_cat);
                if ($key == 'Q') {
                    $objPHPExcel
                        ->setActiveSheetIndex(0)
                        ->setCellValue($key . ($row + 13), '=ROUNDDOWN(' . $avg . ', 1)');
                } else {
                    $objPHPExcel
                        ->setActiveSheetIndex(0)
                        ->setCellValue($key . ($row + 13), '=ROUNDDOWN(' . $avg . ', 1)');
                }
            }

            $range = range('F', 'Q');
            foreach ($range as $key) {
                $array_cat = $objPHPExcel
                    ->setActiveSheetIndex(0)
                    ->rangeToArray($key . ($row + 15) . ':' . $key . ($row + 19));
                $avg = $this->average_if($array_cat);
                if ($key == 'Q') {
                    $objPHPExcel
                        ->setActiveSheetIndex(0)
                        ->setCellValue($key . ($row + 20), '=ROUNDDOWN(' . $avg . ', 1)');
                } else {
                    $objPHPExcel
                        ->setActiveSheetIndex(0)
                        ->setCellValue($key . ($row + 20), '=ROUNDDOWN(' . $avg . ', 1)');
                }
            }

            $objPHPExcel->setActiveSheetIndex(0)->removeRow(28, 500);
        } else {
            $array_industry = $this
                ->t_dropdown
                ->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));
            foreach ($array_industry as $key => $value) {
                $row = 23 * $key + 8;
                $input['NM_INDUSTRY'] = $value['VALUE'];
                $array_b = $this->get_data_maturity($input, $row);
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($arrayData, null, 'A1');
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($total_local_operation[0], null, 'B4');
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($total_local_and_overseas_operation[0], null, 'B5');
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_b[0], null, 'B' . ($row + 5));
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_b[1], null, 'B' . ($row + 15));
                $range = range('F', 'Q');
                foreach ($range as $key) {
                    $array_cat = $objPHPExcel
                        ->setActiveSheetIndex(0)
                        ->rangeToArray($key . ($row + 5) . ':' . $key . ($row + 13));
                    $avg = $this->average_if($array_cat);
                    if ($key == 'Q') {
                        $objPHPExcel
                            ->setActiveSheetIndex(0)
                            ->setCellValue($key . ($row + 13), '=ROUNDDOWN(' . $avg . ', 1)');
                    } else {
                        $objPHPExcel
                            ->setActiveSheetIndex(0)
                            ->setCellValue($key . ($row + 13), '=ROUNDDOWN(' . $avg . ', 1)');
                    }
                }

                $range = range('F', 'Q');
                foreach ($range as $key) {
                    $array_cat = $objPHPExcel
                        ->setActiveSheetIndex(0)
                        ->rangeToArray($key . ($row + 15) . ':' . $key . ($row + 19));
                    $avg = $this->average_if($array_cat);
                    if ($key == 'Q') {
                        $objPHPExcel
                            ->setActiveSheetIndex(0)
                            ->setCellValue($key . ($row + 20), '=ROUNDDOWN(' . $avg . ', 1)');
                    } else {
                        $objPHPExcel
                            ->setActiveSheetIndex(0)
                            ->setCellValue($key . ($row + 20), '=ROUNDDOWN(' . $avg . ', 1)');
                    }
                }

            }
        }

        $objPHPExcel->getActiveSheet()->setTitle('Sector Analysis Report');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name_input . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        try {
            $objWriter->save("php://output");
            $objWriter->save("temp/" . $file_name_input . ".xls");
        } catch (Exception $e) {
            $this->noti($e->getMessage());
            $segment = array($this->router->class, 'reports');
            $this->redirect($segment);
        }


    }

    public function generate_maturity($input)
    {
        if ($this->is_agency_admin()) {
            $user = $this->session->userdata(USER_SESSION_KEY);
            $id_user = $user['ID_USER'];
        } else {
            $id_user = null;
        }

        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name_input = $input['maturity_report_name'];
        $row = 7;
        if ($file_name_input == null) {
            $file_name_input = 'HR Maturity Profile Report';
        }

        if ($input['DT_START'] != null) {
            $time = strtotime($input['DT_START']);
            $start_date = date('d.m.Y', $time);
        }

        if ($input['DT_END'] != null) {
            $time = strtotime($input['DT_END']);
            $end_date = date('d.m.Y', $time);
        }
        $arrayData = array(
            array('System Date: ' . date("d.m.y H:i:s"), null, null, null, null, null),
            array(null, null, null, null, null, null,),
            array(null, $start_date, null, null, null, $end_date),
        );

        $where = $input;
        $where['NM_SCOPE'] = 'Local Market';
        $array_temp = array();
        $temp = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
        if ($input['NM_SCOPE'] == 'Local and Overseas Markets') {
            array_push($array_temp, array('0'));
        } else {
            array_push($array_temp, array($temp[0]['count']));
        }

        $where['NM_SCOPE'] = 'Local and Overseas Markets';

        $temp2 = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
        if ($input['NM_SCOPE'] == 'Local Market') {
            array_push($array_temp, array('0'));
        } else {
            array_push($array_temp, array($temp2[0]['count']));
        }

        $array_b = $this->get_data_maturity($input);

        $input['NM_SCOPE'] = 'Local Market';
        $total_local_operation = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);

        $input['NM_SCOPE'] = 'Local and Overseas Markets';
        $total_local_and_overseas_operation = $this
            ->t_company_profile
            ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);

        $file_name = REPORT_TEMPLATE . "/Maturity.xls";
        $objReader = new PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file_name);
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($arrayData, null, 'A1');
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_temp[0], null, 'B4');
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_temp[1], null, 'B5');
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_b[0], null, 'B' . ($row + 5));
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($array_b[1], null, 'B' . ($row + 15));

        $range = range('F', 'Q');
        foreach ($range as $key) {

            $array_cat = $objPHPExcel
                ->setActiveSheetIndex(0)
                ->rangeToArray($key . ($row + 5) . ':' . $key . ($row + 13));
            $avg = $this->average_if($array_cat);
            if ($avg == 0) {
                continue;
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key . ($row + 13), '=ROUNDDOWN(' . $avg . ', 1)');
        }

        $range = range('F', 'Q');
        foreach ($range as $key) {
            $array_cat = $objPHPExcel
                ->setActiveSheetIndex(0)
                ->rangeToArray($key . ($row + 15) . ':' . $key . ($row + 19));
            $avg = $this->average_if($array_cat);
            if ($avg == 0) {
                continue;
            }

            $objPHPExcel
                ->setActiveSheetIndex(0)
                ->setCellValue($key . ($row + 20), '=ROUNDDOWN(' . $avg . ', 1)');
        }

        $objPHPExcel->getActiveSheet()->setTitle('Maturiry Profile Report');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name_input . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        try {
            $objWriter->save("php://output");
            $objWriter->save("temp/" . $file_name_input . ".xls");
        } catch (Exception $e) {
            $this->noti($e->getMessage());
            $segment = array($this->router->class, 'reports');
            $this->redirect($segment);
        }

    }

    public function maturity_revenue_condition($value, $field){
        switch ($value) {
            case '$100M and above':
                return $field . " >= 100000000";
                break;
            case '$80M to < $100M':
                return $field. " >= 80000000 AND ".$field." < 100000000";
                break;
            case '$50M to < $80M':
                return $field. " >= 50000000 AND ".$field." < 80000000";
                break;
            case '$30M to < $50M':
                return $field. " >= 30000000 AND ".$field." < 50000000";
                break;
            case '$10M to < $30M':
                return $field. " >= 10000000 AND ".$field." < 30000000";
                break;
            case '$5M to < $10M':
                return $field. " >= 5000000 AND ".$field." < 10000000";
                break;
            case '$1M to < $5M':
                return $field. " >= 1000000 AND ".$field." < 5000000";
                break;
            default:
                return $field." < 1000000";
                break;
        }
    }
    public function maturity_employee_condition($value, $field){
        if ($value == "< 50") {
            return $field. " < 50";
        } elseif ($value == '50 to < 100'){
            return $field. " >= 50 AND ".$field." < 100";
        } elseif ($value == '100 to <  150'){
            return $field. " >= 100 AND ".$field." < 150";
        } elseif ($value == '150 to < 200'){
            return $field. " >= 150 AND ".$field." < 200";
        } elseif ($value == '> 200'){
            return $field. " >= 200";
        }
    }

    public function average_if($range = array())
    {

        $sum = 0;
        $count = 0;
        foreach ($range as $key => $value) {
            if ($value[0] != 0) {
                $sum += $value[0];
                $count++;
            }
        }
        if ($sum != 0) {

            return $sum / $count;
        } else {

            return 0;
        }
    }

    public function extract_get_name_col()
    {
        require_once 'Classes/PHPExcel/IOFactory.php';
        $file_name = REPORT_TEMPLATE . "/system_extract.xls";
        $objReader = new PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file_name);
        $array_col = $objPHPExcel->setActiveSheetIndex(0)->rangeToArray('A5:CK5');
        return $array_col[0];
    }

    /**
     * @param $revenue
     * @return string
     */
    public function get_total_revenue($revenue)
    {
        $total_revenue = "";
        if ($revenue == '$100M and above') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) >= ".M100;
        } elseif ($revenue == '$80M to < $100M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) BETWEEN  ".M80.
                " AND ".M100;
        } elseif ($revenue == '$50M to < $80M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) BETWEEN  ".M50.
            " AND ".M80;
        } elseif ($revenue == '$30M to < $50M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) BETWEEN " .M30.
            " AND " .M50;
        } elseif ($revenue == '$10M to < $30M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) BETWEEN " .M10.
            " AND ".M30;
        } elseif ($revenue == '$5M to < $10M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) BETWEEN " .M5.
            " AND ".M10;
        } elseif ($revenue == '$1M to < $5M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) BETWEEN ".M1.
            " AND ".M5;
        } elseif ($revenue == '< $1M') {
            $total_revenue = " AND (cp.N_L_REVENUE + cp.N_O_REVENUE) < ".M1;
        }
        return $total_revenue;
    }

    public function get_total_hr_size($team_size)
    {
        $total_hr_team_size = "";
        if ($team_size == 'More than 10') {
            $total_hr_team_size = " AND (cp.N_L_HR + cp.N_OVERSEAS_HR) > '10'";
        } elseif ($team_size == '6 to 10') {
            $total_hr_team_size = " AND (cp.N_L_HR + cp.N_OVERSEAS_HR) BETWEEN '6'
            AND '10'";
        } elseif ($team_size == '3 to 5') {
            $total_hr_team_size = " AND (cp.N_L_HR + cp.N_OVERSEAS_HR) BETWEEN '3'
            AND '5'";
        } elseif ($team_size == '1 to 2') {
            $total_hr_team_size = " AND (cp.N_L_HR + cp.N_OVERSEAS_HR) BETWEEN '1'
            AND '2'";
        } elseif ($team_size == 'No dedicated HR Function') {
            $total_hr_team_size = " AND (cp.N_L_HR + cp.N_OVERSEAS_HR) = '0' ";
        } elseif ($team_size == 'HR Function is outsourced') {
            $total_hr_team_size = " AND (cp.N_L_HR + cp.N_OVERSEAS_HR) = '0' ";
        }
        return $total_hr_team_size;
    }

    public function custom_limit($array_input = array(), $start = 0, $offset = null){
        $result = $array_input;
        if (is_array($array_input) && count($array_input) > 0) {
            if ($offset !== null) {
                $array_result = array();
                $max = count($array_input) > ($start + $offset) ? ($start + $offset) : count($array_input);
                for ($i = $offset; $i < $max; $i++) {
                    array_push($array_result, $array_input[$i]);
                }
                if (count($array_result) > 0) {
                    $result =  $array_result;
                }
            } else {
                $result = $array_input;
            }
        } else {
            $result = $array_input;
        }

        return $result;
    }

    /**
     * @param $data
     * @param $officer_1
     * @param $officer_2
     * @return array
     */
    private function fetch_officer($data, $officer_1, $officer_2)
    {
        if (count($data) > 0) {
            $matched_officer = array();
            foreach ($data as $key => $value) {
                $list_officer_all = null;
                $list_officer_all = $this
                    ->t_company_assignment
                    ->check_leader($value['ID_COMPANY'], $officer_1, $officer_2);

                $officer_data = array(
                    'OFFICER_1' => '',
                    'OFFICER_2' => '',
                    'AGENCY' => ''
                );

                if ($list_officer_all != FALSE && count($list_officer_all) > 0) {
                    $officer_data['OFFICER_1'] = $list_officer_all[0]['USER_NAME'];
                    $officer_data['AGENCY'] = $list_officer_all[0]['NM_ORGANISATION'];

                    if (count($list_officer_all) > 1) {
                        $officer_data['OFFICER_2'] = $list_officer_all[1]['USER_NAME'];
                    }

                    $data[$key] = array_merge(
                        array_slice($data[$key], 0, 3), $officer_data, array_slice($data[$key], 3)
                    );
                    $answer = $this->t_survey_response_dtl->get_id_answer($value['ID_SURVEY']);
                    $list_question = array();

                    for ($i = 1; $i < 35; $i++) {
                        $list_question['Question_' . $i] = isset($answer[$i - 1]) ? $answer[$i - 1]['IN_POINT'] : 0;
                    }
                    $data[$key] = array_merge(
                        array_slice($data[$key], 0, 52), $list_question, array_slice($data[$key], 52)
                    );
                    $data[$key]['STATUS'] = 'Opened';
                    if ($data[$key]['DT_END'] != '0000-00-00 00:00:00' && !is_null($data[$key]['DT_END'])) {
                        $data[$key]['STATUS'] = 'Closed';
                        $data[$key]['DT_END'] = date("d.m.y", strtotime($data[$key]['DT_END']));
                    } else {
                        $data[$key]['DT_END'] = '';
                    }

                    $data[$key]['DT_START'] = date("d.m.y", strtotime($data[$key]['DT_START']));

                    $matched_officer[] = $data[$key];
                }
            }
            return $matched_officer;
        }

        return $data;
    }

    /**
     * get data company type to generate sheet company type
     * in company profile report
     * @param $input
     * @param $id_user
     * @return array
     */
    public function company_type_get_data($input, $id_user){
        if ($input['NM_INDUSTRY'] != null) {
            $industry_selected = $input['NM_INDUSTRY'];
        } else {
            $industry_selected = null;
        }
        if ($input['NM_TYPE'] != null) {
            $type_selected = $input['NM_TYPE'];
        } else {
            $type_selected = null;
        }
        $array_type = array(
            'Listed Company',
            'Private Company',
            'Private Company,planning to list(within 2 years)',
            'Family Run Business'
        );
        $array_data = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));
        $total = array();
        $total[0] =  0;
        $total[1] =  0;
        $total[2] =  0;
        $total[3] =  0;
        $total[4] =  0;
        foreach ($array_industry as $key => $value) {
            $array_temp2 = array();
            $temp = 0;
            if ($industry_selected != null) {
                if ($industry_selected != $value['VALUE']) {
                    $array_zero = $this->sheet_count_percent(array(0, 0, 0, 0, 0));
                    array_push($array_data, $array_zero);
                    continue;
                }
            }

            $input['NM_INDUSTRY'] = $value['VALUE'];
            foreach ($array_type as $key_) {
                if ($type_selected != null) {
                    if ($type_selected != $key_) {
                        array_push($array_temp2, 0);
                        continue;
                    }
                }

                $input['NM_TYPE'] = $key_;
                $total_operation = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
                $temp = $temp + $total_operation[0]['count'];
                array_push($array_temp2, $total_operation[0]['count']);
            }

            array_push($array_temp2, $temp);
            $total[0] +=  $array_temp2[0];
            $total[1] +=  $array_temp2[1];
            $total[2] +=  $array_temp2[2];
            $total[3] +=  $array_temp2[3];
            $total[4] +=  $array_temp2[4];
            $array_temp = $this->sheet_count_percent($array_temp2);
            array_push($array_data, $array_temp);

        }
        $total = $this->sheet_count_percent($total);
        array_push($array_data, $total);
        return $array_data;
    }

    public function scope_sheet_get_data($input, $id_user){
        if ($input['NM_INDUSTRY'] != null) {
            $industry_selsect = $input['NM_INDUSTRY'];
        } else {
            $industry_selsect = null;
        }
        if ($input['NM_SCOPE'] != null) {
            $scope_selsect = $input['NM_SCOPE'];
        } else {
            $scope_selsect = null;
        }

        $array_scope = array(
            'Local Market',
            'Local and Overseas Markets'
        );

        $array_data = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));

        $total = array();
        $total[0] =  0;
        $total[1] =  0;
        $total[2] =  0;
        foreach ($array_industry as $key => $value) {
            $array_temp2 = array();
            $temp = 0;
            if ($industry_selsect != null) {
                if ($industry_selsect != $value['VALUE']) {
                    $array_zero = $this->sheet_count_percent(array(0, 0, 0));
                    array_push($array_data, $array_zero);
                    continue;
                }
            }

            $input['NM_INDUSTRY'] = $value['VALUE'];
            foreach ($array_scope as $key_) {
                if ($scope_selsect != null) {
                    if ($scope_selsect != $key_) {
                        array_push($array_temp2, 0);
                        continue;
                    }
                }

                $input['NM_SCOPE'] = $key_;
                $total_operation = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
                $temp = $temp + $total_operation[0]['count'];
                array_push($array_temp2, $total_operation[0]['count']);
            }

            array_push($array_temp2, $temp);
            $total[0] +=  $array_temp2[0];
            $total[1] +=  $array_temp2[1];
            $total[2] +=  $array_temp2[2];
            $array_temp = $this->sheet_count_percent($array_temp2);
            array_push($array_data, $array_temp);

        }

        $total = $this->sheet_count_percent($total);
        array_push($array_data, $total);
        return $array_data;
    }

    public function workforce_sheet_get_data($input, $id_user){
        $array_output = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));

        foreach ($array_industry as $key => $value) {
            $array_temp = array();
            $input['NM_INDUSTRY'] = $value['VALUE'];
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_LOCAL_STAFF) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_OVERSEAS_STAFF) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_LOCAL_STAFF+a.N_OVERSEAS_STAFF) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_L_HR) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_OVERSEAS_HR) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_L_HR+a.N_OVERSEAS_HR) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_UNI) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_POLY) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_ITE) as result', $input, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            array_push($array_output, $array_temp);
        }

        return $array_output;
    }
    public function financials_sheet_get_data($input, $id_user){
        $where = $input;
        $array_output = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));
        $local_revenue = array(
            '$100M and above',
            '$80M to < $100M',
            '$50M to < $80M',
            '$30M to < $50M',
            '$10M to < $30M',
            '$5M to < $10M',
            '$1M to < $5M',
            '< $1M'
        );

        $overseas_revenue = $local_revenue;
        $total_array = array(0,0,0,0,0,0,0,0);
        $total_array2 = array(0,0,0,0,0,0,0,0);
        $sum_gross = 0;
        foreach ($array_industry as $key => $value) {
            if ($input['NM_INDUSTRY'] != null) {
                if ($value['VALUE'] != $input['NM_INDUSTRY']) {
                    $null_array = array();
                    for ($k = 0; $k < 17; $k++) {
                        array_push($null_array, '0(0.%)');
                    }

                    array_push($array_output, $null_array);
                    continue;
                }
            }

            $array_temp = $array_temp2 = array();
            $where['NM_INDUSTRY'] = $value['VALUE'];
            foreach ($local_revenue as $key) {
                $where['N_L_REVENUE'] = $key;
                $where['N_O_REVENUE'] = null;
                $temp = $this->t_company_profile->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
                array_push($array_temp, $temp[0]['count']);
            }

            if (count($array_temp) > 0) {
                for ($i = 0; $i < count($array_temp); $i++) {
                    $total_array[$i] += $array_temp[$i];
                }
            }

            $array_temp = $this->sheet_count_percent($array_temp);

            foreach ($overseas_revenue as $key) {
                $where['N_L_REVENUE'] = null;
                $where['N_O_REVENUE'] = $key;
                $temp = $this->t_company_profile->report_get_company('COUNT(a.ID_AI) as count', $where, $id_user);
                array_push($array_temp2, $temp[0]['count']);
            }

            for ($i = 0; $i < count($array_temp2); $i++) {
                $total_array2[$i] += $array_temp2[$i];
            }
            $array_temp2 = $this->sheet_count_percent($array_temp2);

            for($i = 0; $i < count($array_temp2); $i++) {
                    array_push($array_temp, $array_temp2[$i]);
            }

            $average_gross = $this->t_company_profile->report_get_company('AVG(a.N_GROSS) as result', $where, $id_user);
            $average_gross = $average_gross[0]['result'];
            $sum_gross += $average_gross;

            if (is_null($average_gross)) {
                $average_gross = '0%';
            } else {
                $average_gross .= '%';
            }

            array_push($array_temp, $average_gross);
            array_push($array_output, $array_temp);
        }

        $total_array = $this->sheet_count_percent($total_array);
        $total_array2 = $this->sheet_count_percent($total_array2);

        for ($i = 0; $i < count($total_array2); $i++) {
            array_push($total_array, $total_array2[$i]);
        }

        if (is_null($sum_gross)) {
            $sum_gross = '0%';
        } else {
            $sum_gross .= '%';
        }

        array_push($total_array, $sum_gross);
        array_push($array_output, $total_array);

        return $array_output;
    }

    /**
     * get growth stage data sheet for generate company profile report
     * @param $input
     * @param $id_user
     * @return array
     */
    private function growth_stage_sheet_get_data($input, $id_user){
        if ($input['NM_INDUSTRY'] != null) {
            $industry_selected = $input['NM_INDUSTRY'];
        } else {
            $industry_selected = null;
        }
        if ($input['ID_GS1'] != null) {
            $growth_stage_selected = $input['ID_GS1'];
        } else {
            $growth_stage_selected = null;
        }
        $array_growth_stage = array(
            '1',
            '2',
            '3',
            '4',
            '5'
        );
        $array_data = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));
        $total = array();
        $total[0] =  0;
        $total[1] =  0;
        $total[2] =  0;
        $total[3] =  0;
        $total[4] =  0;
        $total[5] =  0;
        foreach ($array_industry as $key => $value) {
            $array_temp2 = array();
            $temp = 0;
            if ($industry_selected != null) {
                if ($industry_selected != $value['VALUE']) {
                    $array_zero = $this->sheet_count_percent(array(0, 0, 0, 0, 0, 0));
                    array_push($array_data, $array_zero);
                    continue;
                }
            }
            $input['NM_INDUSTRY'] = $value['VALUE'];
            foreach ($array_growth_stage as $key_) {
                if ($growth_stage_selected != null) {
                    if ($growth_stage_selected != $key_) {
                        array_push($array_temp2, 0);
                        continue;
                    }
                }
                $input['ID_GS1'] = $key_;
                $total_operation = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
                $temp = $temp + $total_operation[0]['count'];
                array_push($array_temp2, $total_operation[0]['count']);
            }

            array_push($array_temp2, $temp);
            $total[0] +=  $array_temp2[0];
            $total[1] +=  $array_temp2[1];
            $total[2] +=  $array_temp2[2];
            $total[3] +=  $array_temp2[3];
            $total[4] +=  $array_temp2[4];
            $total[5] +=  $array_temp2[5];
            $array_temp = $this->sheet_count_percent($array_temp2);
            array_push($array_data, $array_temp);

        }
        $total = $this->sheet_count_percent($total);
        array_push($array_data, $total);
        return $array_data;
    }

    /**
     * get management style data sheet for generate company profile report
     * @param $input
     * @param $id_user
     * @return array
     */
    private function management_style_sheet_get_data($input, $id_user){
        if ($input['NM_INDUSTRY'] != null) {
            $industry_selected = $input['NM_INDUSTRY'];
        } else {
            $industry_selected = null;
        }
        if ($input['ID_MS2'] != null) {
            $ms_selected = $input['ID_GS1'];
        } else {
            $ms_selected = null;
        }
        $array_ms = array(
            '6',
            '7',
            '8',
            '9',
            '10'
        );
        $array_data = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));
        $total = array();
        $total[0] =  0;
        $total[1] =  0;
        $total[2] =  0;
        $total[3] =  0;
        $total[4] =  0;
        $total[5] =  0;
        foreach ($array_industry as $key => $value) {
            $array_temp2 = array();
            $temp = 0;
            if ($industry_selected != null) {
                if ($industry_selected != $value['VALUE']) {
                    $array_zero = $this->sheet_count_percent(array(0, 0, 0, 0, 0, 0));
                    array_push($array_data, $array_zero);
                    continue;
                }
            }
            $input['NM_INDUSTRY'] = $value['VALUE'];
            foreach ($array_ms as $key_) {
                if ($ms_selected != null) {
                    if ($ms_selected != $key_) {
                        array_push($array_temp2, 0);
                        continue;
                    }
                }
                $input['ID_MS2'] = $key_;
                $total_operation = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
                $temp = $temp + $total_operation[0]['count'];
                array_push($array_temp2, $total_operation[0]['count']);
            }

            array_push($array_temp2, $temp);
            $total[0] +=  $array_temp2[0];
            $total[1] +=  $array_temp2[1];
            $total[2] +=  $array_temp2[2];
            $total[3] +=  $array_temp2[3];
            $total[4] +=  $array_temp2[4];
            $total[5] +=  $array_temp2[5];
            $array_temp = $this->sheet_count_percent($array_temp2);
            array_push($array_data, $array_temp);

        }
        $total = $this->sheet_count_percent($total);
        array_push($array_data, $total);
        return $array_data;
    }

    /**
     * get leadership commitment data sheet for generate company profile report
     * @param $input
     * @param $id_user
     * @return array
     */
    private function leadership_commitment_sheet_get_data($input, $id_user){
        if ($input['NM_INDUSTRY'] != null) {
            $industry_selected = $input['NM_INDUSTRY'];
        } else {
            $industry_selected = null;
        }
        if ($input['ID_LC3'] != null) {
            $lc_selected = $input['ID_LC3'];
        } else {
            $lc_selected = null;
        }
        $array_lc = array(
            '11',
            '12',
            '13',
            '14',
            '15'
        );
        $array_data = array();
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));
        $total = array();
        $total[0] =  0;
        $total[1] =  0;
        $total[2] =  0;
        $total[3] =  0;
        $total[4] =  0;
        $total[5] =  0;
        foreach ($array_industry as $key => $value) {
            $array_temp2 = array();
            $temp = 0;
            if ($industry_selected != null) {
                if ($industry_selected != $value['VALUE']) {
                    $array_zero = $this->sheet_count_percent(array(0, 0, 0, 0, 0, 0));
                    array_push($array_data, $array_zero);
                    continue;
                }
            }
            $input['NM_INDUSTRY'] = $value['VALUE'];
            foreach ($array_lc as $key_) {
                if ($lc_selected != null) {
                    if ($lc_selected != $key_) {
                        array_push($array_temp2, 0);
                        continue;
                    }
                }
                $input['ID_LC3'] = $key_;
                $total_operation = $this
                    ->t_company_profile
                    ->report_get_company('COUNT(a.ID_AI) as count', $input, $id_user);
                $temp = $temp + $total_operation[0]['count'];
                array_push($array_temp2, $total_operation[0]['count']);
            }

            array_push($array_temp2, $temp);
            $total[0] +=  $array_temp2[0];
            $total[1] +=  $array_temp2[1];
            $total[2] +=  $array_temp2[2];
            $total[3] +=  $array_temp2[3];
            $total[4] +=  $array_temp2[4];
            $total[5] +=  $array_temp2[5];
            $array_temp = $this->sheet_count_percent($array_temp2);
            array_push($array_data, $array_temp);

        }
        $total = $this->sheet_count_percent($total);
        array_push($array_data, $total);
        return $array_data;
    }

    private function metric_sheet_get_data($input, $id_user){
        $array_output = array();
        $where = $input;
        $array_industry = $this->t_dropdown->get_data_by_property('VALUE', array('NM_TYPE' => 'Company_Industry'));

        foreach ($array_industry as $key => $value) {
            if ($input['NM_INDUSTRY'] != null) {
                if ($value['VALUE'] != $input['NM_INDUSTRY']) {
                    $null_array = array();
                    for ($k = 0; $k < 6; $k++) {
                        array_push($null_array, '0');
                    }

                    array_push($array_output, $null_array);
                    continue;
                }
            }

            $array_temp = array();
            $where['NM_INDUSTRY'] = $value['VALUE'];
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_L_RETENTION) as result', $where, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_O_RETENTION) as result', $where, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_L_TURNOVER) as result', $where, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_O_TURNOVER) as result', $where, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_TRAINING_COST) as result', $where, $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            $temp = $this->t_company_profile->report_get_company('AVG(a.N_TRAINING_PARTICIPATION) as result', $where,
                $id_user);
            array_push($array_temp, $temp[0]['result'] === null ? '0' : '=ROUNDDOWN('.$temp[0]['result'].', 1)');
            array_push($array_output, $array_temp);
        }

        return $array_output;
    }

    public function sheet_count_percent($array = array()){
        if (count($array) == 3) {
            $output = array();
            $local = $array[0];
            $local_overseas = $array[1];
            $total = $array[2];
            if ($total == 0) {
                $output[0] = $local . '(.%)';
                $output[1] = $local_overseas . '(.%)';
                $output[2] = $total . '(.%)';
            } else {
                if($local == 0){
                    $output[0] = $local . '(.%)';
                } else {
                    $output[0] = $local.'('.round(($local/$total)*100, 1).'%)';
                }
                if($local_overseas == 0){
                    $output[1] = $local_overseas . '(.%)';
                } else {
                    $output[1] = $local_overseas.'('.round(($local_overseas/$total)*100, 1).'%)';
                }
                $output[2] = $total.'(100%)';
            }

            return $output;
        } elseif(count($array) == 5){
            $output = array();
            $one = $array[0];
            $two = $array[1];
            $three = $array[2];
            $four = $array[3];
            $total = $array[4];
            if ($total == 0) {
                $output[0] = $one . '(.%)';
                $output[1] = $two . '(.%)';
                $output[2] = $three . '(.%)';
                $output[3] = $four . '(.%)';
                $output[4] = $total . '(.%)';
            } else {
                if($one == 0){
                    $output[0] = $one . '(.%)';
                } else {
                    $output[0] = $one.'('.round(($one/$total)*100, 1).'%)';
                }

                if($two == 0){
                    $output[1] = $two . '(.%)';
                } else {
                    $output[1] = $two.'('.round(($two/$total)*100, 1).'%)';
                }

                if($three == 0){
                    $output[2] = $three . '(.%)';
                } else {
                    $output[2] = $three.'('.round(($three/$total)*100, 1).'%)';
                }

                if($four == 0){
                    $output[3] = $four . '(.%)';
                } else {
                    $output[3] = $four.'('.round(($four/$total)*100, 1).'%)';
                }

                $output[4] = $total.'(100%)';
            }

            return $output;
        } elseif(count($array) == 6) {
            $output = array();
            $one = $array[0];
            $two = $array[1];
            $three = $array[2];
            $four = $array[3];
            $five = $array[4];
            $total = $array[5];
            if ($total == 0) {
                $output[0] = $one . '(.%)';
                $output[1] = $two . '(.%)';
                $output[2] = $three . '(.%)';
                $output[3] = $four . '(.%)';
                $output[4] = $five . '(.%)';
                $output[5] = $total . '(.%)';
            } else {
                if($one == 0){
                    $output[0] = $one . '(.%)';
                } else {
                    $output[0] = $one.'('.round(($one/$total)*100, 1).'%)';
                }

                if($two == 0){
                    $output[1] = $two . '(.%)';
                } else {
                    $output[1] = $two.'('.round(($two/$total)*100, 1).'%)';
                }

                if($three == 0){
                    $output[2] = $three . '(.%)';
                } else {
                    $output[2] = $three.'('.round(($three/$total)*100, 1).'%)';
                }

                if($four == 0){
                    $output[3] = $four . '(.%)';
                } else {
                    $output[3] = $four.'('.round(($four/$total)*100, 1).'%)';
                }

                if($five == 0){
                    $output[4] = $five . '(.%)';
                } else {
                    $output[4] = $five.'('.round(($five/$total)*100, 1).'%)';
                }

                $output[5] = $total.'(100%)';
            }

            return $output;
        } else {
            $output = array();
            $input = $array;
            $total = array_sum($input);
            if ($total == 0) {
                foreach ($array as $key => $value) {
                    $output[$key] = $value.'(0.%)';
                }
            } else {
                foreach ($input as $key => $value) {
                    $output[$key] = $value.'('.round(($value/$total)*100, 1).'.%)';
                }
            }

            return $output;
        }
    }

        public function insert_data(){
        require_once 'Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = PHPExcel_IOFactory::load("temp/a.xls");

            for ($i = 2;$i < 546; $i++) {

                $temp_cate = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
                if ($temp_cate != '' && $temp_cate != NULL) {
                    $record['ID_CATEGORY'] = strtoupper(trim($temp_cate));
                }
                $temp_id = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
                if ($temp_id != '' && $temp_id != NULL) {
                    $record['ID_QUESTION'] = trim($temp_id);
                }
                $temp_score = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue();
                $record['IN_SCORE'] = trim($temp_score);

                $temp = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getValue();
                $record['TO_BE_SCORE'] = trim($temp);

                $temp =  $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue();
                $record['TX_DEFAULT'] = trim($temp);
               $this->t_tracking->core_set_data($record, 't_gap_analysis_matrix');
            }
    }
    public function insert_data2(){
        require_once 'Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = PHPExcel_IOFactory::load("temp/b.xls");
        $objPHPExcel->getWorksheetIterator;
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
        for ($j = 1;$j < 6; $j++) {
            for ($i = 3;$i < 36; $i++) {

                $temp_cate = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
                if ($temp_cate != '' && $temp_cate != NULL) {
                    $record['ID_CATEGORY'] = strtoupper($temp_cate);
                }
                $temp_id = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
                if ($temp_id != '' && $temp_id != NULL) {
                    $record['ID_QUESTION'] = $temp_id;
                }
                $record['IN_STAGE'] = $j;
                switch ($j) {
                    case 1:
                        $column = 'D';
                        break;
                    case 2:
                        $column = 'E';
                        break;
                    case 3:
                        $column = 'F';
                        break;
                    case 4:
                        $column = 'G';
                        break;
                    case 5:
                        $column = 'H';
                        break;

                }

                $temp = $objPHPExcel->getActiveSheet()->getCell($column.$i)->getValue();
                $record['IN_TO_BE_SCORE'] = $temp;

                $record['TX_DEFAULT'] = '';

                $this->t_tracking->core_set_data($record, 't_gap_ideal_matrix');
            }
        }
        return;
    }

    public function cls(){
        echo "<script type='text/javascript'>\n";
        echo "document.body.innerHTML = ''";
        echo "</script>";
    }
}