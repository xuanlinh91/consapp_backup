<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home controller.
 * @author PhuTv
 *
 */
class Home extends MY_Controller
{

    function __construct()
    {

        parent::__construct();
        parent::__configure();
        $this->load->model('t_survey_response_hdr');
        $this->load->model('t_org_mapping');
        $this->load->model('t_company_assignment');
        $this->load->model('t_company_info');
        $this->load->model('t_company_profile');
        $this->load->model('t_trainer');
        $this->load->model('t_tracking');
        $this->load->model('mreport');
        $this->load->file("application/controllers/parse.php", false);
        $this->load->file("application/controllers/mpdf.php", false);
        $this->load->file("application/controllers/email.php", false);
        $this->sort = 'asc';
    }

    public function index($offset = 0, $sort = 'ascsort_2')
    {
        $user = $this->session->userdata(USER_SESSION_KEY);
        $id = $user['ID_USER'];
        $method = $this->input->post('submit');
        $this->set_page_title("HRMD Web App");
        $this->check_role(array(ROLE_ADMIN, ROLE_AGENCY, ROLE_NORMAL, ROLE_RESTRICTED), 0);
        if ($method != 'Search' && $offset === 0) {
            $this->session->unset_userdata('HOME_SEARCH');
        }

        $user = $this->session->userdata(USER_SESSION_KEY);
        if ($this->is_admin() || $this->is_user()) {
            $id = null;
            $result = $this->t_company_info->super_admin_get_company($id);
        } elseif ($this->is_restrict_user()) {
            $id = $user['ID_USER'];
            $result = $this->t_company_info->restricted_get_company_suggess($id);
        }

        $company_list = $result;
        $company_list_add = $company_list;
        if (count($company_list_add) > 0) {
            foreach ($company_list_add as $value) {
                $temp = $value['value'];
                $value['value'] = $value['data'];
                $value['data'] = $temp;
                array_push($company_list, $value);
            }
        }

        $this->data['company_info'] = json_encode($company_list);
        if ($this->input->post('submit')) {
            $txt_search = $this->input->post('NM_COMPANY');
            $this->session->set_userdata('HOME_SEARCH', $txt_search);
        } else {
            $txt_search = $this->session->userdata('HOME_SEARCH');
        }

        $this->data['txt_search'] = $txt_search;
        $st = explode('sort_', $sort);
        $this->data['sort'] = $st[0];
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
        $config['base_url'] = site_url('/home/index');
        $config['uri_segment'] = 3;
        $config['sort'] = $sort;
        $this->sort = $sort;
        $this->session->set_userdata('sort', $sort);
        $offset = ($this->uri->segment(3) == '') ? null : $this->uri->segment(3);
        if (isset($txt_search) && $txt_search != '') {

            $user = $this->session->userdata(USER_SESSION_KEY);
            if ($this->is_user()) {
                $total_rows = count($this->t_company_info->get_data_like(null, null, $txt_search));
                $this->data['result_search'] = $this->t_company_info->get_data_like($config['per_page'], $offset, $txt_search);
                $array_company_user = $this->t_company_info->restricted_get_company($user['ID_USER']);
            } elseif ($this->is_super_admin()) {
                $total_rows = count($this->t_company_info->get_data_like(null, null, $txt_search));
                $this->data['result_search'] = $this->t_company_info->get_data_like($config['per_page'], $offset, $txt_search);
            } elseif ($this->is_agency_admin()) {
                $total_rows = count($this->t_company_info->get_data_like(null, null, $txt_search));
                $this->data['result_search'] = $this->t_company_info->get_data_like($config['per_page'], $offset, $txt_search);
                $array_company_agency = $this->t_company_info->agency_get_mapped_company($user['ID_USER']);
                $agency_assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user['ID_USER']);
            } elseif ($this->is_restrict_user()) {
                $total_rows = count($this->t_company_info->get_data_like_restricted(null, null, $user['ID_USER'], $txt_search));
                $this->data['result_search'] = $this->t_company_info->get_data_like_restricted($config['per_page'], $offset, $user['ID_USER'], $txt_search);
                $array_company_restricted = $this->t_company_info->restricted_get_company($user['ID_USER']);
            }

        } elseif ($this->is_user()) {
            if ($method !== 'Search') {
                $method = 'Search';
                $auto = 1;
            }

            $user = $this->session->userdata(USER_SESSION_KEY);
            $total_rows = count($this->t_company_info->get_all_data('*'));
            $this->data['result_search'] = $this->t_company_info->get_data_like($config['per_page'], $offset, $txt_search);
            $array_company_user = $this->t_company_info->restricted_get_company($user['ID_USER']);
        } elseif ($this->is_restrict_user()) {
            if ($method !== 'Search') {
                $method = 'Search';
                $auto = 1;
            }

            $user = $this->session->userdata(USER_SESSION_KEY);
            $total_rows = count($this->t_company_info->get_company_consultant(null, null, $user['ID_USER']));
            $this->data['result_search'] = $this->t_company_info->get_data_like_restricted($config['per_page'], $offset, $user['ID_USER'], $txt_search);
            $array_company_restricted = $this->t_company_info->restricted_get_company($user['ID_USER']);
        } elseif ($this->is_admin()) {
            if ((isset($offset) && $offset != null) || $method == 'Search') {
                $total_rows = count($this->t_company_info->get_all_data('*'));
                $this->data['result_search'] = $this->t_company_info->get_data_like($config['per_page'], $offset, $txt_search);
                if ($this->is_agency_admin()) {
                    $array_company_agency = $this->t_company_info->agency_get_mapped_company($user['ID_USER']);
                    $agency_assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user['ID_USER']);
                }
            }
        }
        if (isset($this->data['result_search']) && count($this->data['result_search']) > 0 && ($method == 'Search' || isset($offset))) {
            $config['total_rows'] = $total_rows;
            $this->pagination->initialize($config);
            $pagination = $this->pagination->create_links();
            $this->data['pagination'] = $pagination;
            $this->load->model('t_tracking');
            foreach ($this->data['result_search'] as &$value) {
                $stage = $this->t_tracking->get_stage_by_id($value['ID_COMPANY']);
                $closed = $this->t_tracking->check_closed_survey($value['ID_COMPANY'], true);
                $hasClosed = $this->t_tracking->check_closed_survey($value['ID_COMPANY']);
                $value['STAGE'] = $stage;
                if ($hasClosed) {
                    switch ($stage) {
                        case STAGE_1:
                            $value['RESUME_LINK'] = site_url('company_profile/edit/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_2:
                            $value['RESUME_LINK'] = site_url('interview/create/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_3:
                            $value['RESUME_LINK'] = site_url('questionnaires/take/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_4:
                            $value['RESUME_LINK'] = site_url('survey/take_survey/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_5:
                            $value['RESUME_LINK'] = site_url('survey/take_gap/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_6:
                            $value['RESUME_LINK'] = site_url('survey/generate_report/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_7:
                            $value['RESUME_LINK'] = site_url('survey/generate_report/' . $value['ID_COMPANY_AI']);
                            break;
                        default:
                            $value['RESUME_LINK'] = site_url('#');
                            break;
                    }

                    if ($this->is_restrict_user()) {
                        $pos = (isset($array_company_restricted) && count($array_company_restricted) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_restricted, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false) {
                            $value['ACTION'] = 'View Report';
                            if ($closed && ($stage != '0' && $stage)) {
                                $value['RESUME'] = 'Continue Survey';
                            } else {
                                unset($value['STAGE']);
                                $value['RESUME'] = 'Start';
                                $value['RESUME_LINK'] = site_url('company_profile/start/' . $value['ID_COMPANY_AI']);
                            }
                        }

                    } elseif ($this->is_user()) {
                        $value['ACTION'] = 'View Report';
                        $pos = (isset($array_company_user) && count($array_company_user) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_user, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false) {
                            if ($closed && ($stage != '0' && $stage)) {
                                $value['RESUME'] = 'Continue Survey';
                            } else {
                                unset($value['STAGE']);
                                $value['RESUME'] = 'Start';
                                $value['RESUME_LINK'] = site_url('company_profile/start/' . $value['ID_COMPANY_AI']);
                            }
                        }

                    } elseif ($this->is_agency_admin()) {
                        $pos = (isset($array_company_agency) && count($array_company_agency) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_agency, 'ID_COMPANY_AI')) : false;
                        $pos_ass = (isset($agency_assigned_company) && count($agency_assigned_company) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($agency_assigned_company, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false || $pos_ass !== false) {
                            $value['ACTION'] = 'View Report';
                            if ($closed && ($stage != '0' && $stage) && $pos_ass !== false) {
                                $value['RESUME'] = 'Continue Survey';
                            } elseif($pos_ass !== false) {
                                unset($value['STAGE']);
                                $value['RESUME'] = 'Start';
                                $value['RESUME_LINK'] = site_url('company_profile/start/' . $value['ID_COMPANY_AI']);
                            }
                        }

                    } elseif ($this->is_super_admin()) {
                        $value['ACTION'] = 'View Report';
                        if ($closed && ($stage != '0' && $stage)) {
                            $value['RESUME'] = 'Continue Survey';
                        } else {
                            unset($value['STAGE']);
                            $value['RESUME'] = 'Start';
                            $value['RESUME_LINK'] = site_url('company_profile/start/' . $value['ID_COMPANY_AI']);
                        }
                    }

                    $value['ACTION_LINK'] = site_url('home/view_report/' . $value['ID_COMPANY_AI']);
                } elseif ($value['STAGE'] == false || $value['STAGE'] == 0) {
                    if ($this->is_user()) {
                        $pos = (isset($array_company_user) && count($array_company_user) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_user, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false) {
                            $value['ACTION'] = 'Start';
                        }

                    } elseif ($this->is_restrict_user()) {
                        $pos = (isset($array_company_restricted) && count($array_company_restricted) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_restricted, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false) {
                            $value['ACTION'] = 'Start';
                        }

                    } elseif ($this->is_super_admin()) {
                        $value['ACTION'] = 'Start';

                    } elseif ($this->is_agency_admin()) {
                        $pos_ass = (isset($agency_assigned_company) && count($agency_assigned_company) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($agency_assigned_company, 'ID_COMPANY_AI')) : false;
                        if ($pos_ass !== false) {
                            $value['ACTION'] = 'Start';
                        }
                    }

                    $value['ACTION_LINK'] = site_url('company_profile/start/' . $value['ID_COMPANY_AI']);
                } else {
                    if ($this->is_user()) {
                        $pos = (isset($array_company_user) && count($array_company_user) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_user, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false) {
                            $value['ACTION'] = 'Continue Survey';
                        }

                    } elseif ($this->is_restrict_user()) {
                        $pos = (isset($array_company_restricted) && count($array_company_restricted) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($array_company_restricted, 'ID_COMPANY_AI')) : false;
                        if ($pos !== false) {
                            $value['ACTION'] = 'Continue Survey';
                        }

                    } elseif ($this->is_super_admin()) {
                        $value['ACTION'] = 'Continue Survey';
                    } elseif ($this->is_agency_admin()) {
                        $pos_ass = (isset($agency_assigned_company) && count($agency_assigned_company) > 0) ? array_search($value['ID_COMPANY_AI'],
                            array_comlumnfx($agency_assigned_company, 'ID_COMPANY_AI')) : false;
                        if ($pos_ass !== false) {
                            $value['ACTION'] = 'Continue Survey';
                        }

                    }
                    switch ($stage) {
                        case STAGE_1:
                            $value['ACTION_LINK'] = site_url('company_profile/edit/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_2:
                            $value['ACTION_LINK'] = site_url('interview/create/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_3:
                            $value['ACTION_LINK'] = site_url('questionnaires/take/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_4:
                            $value['ACTION_LINK'] = site_url('survey/take_survey/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_5:
                            $value['ACTION_LINK'] = site_url('survey/take_gap/' . $value['ID_COMPANY_AI']);
                            break;
                        case STAGE_6:
                            $value['ACTION_LINK'] = site_url('survey/generate_report/' . $value['ID_COMPANY_AI']);
                            break;
                        default:
                            $value['ACTION_LINK'] = site_url('#');
                            break;
                    }
                }
            }

        } elseif (!isset($auto) || $auto != 1) {
            if (($this->is_consultant() || $method == 'Search' || isset($offset))) {
                if ($method == 'Search') {
                    $this->noti('Company profile not found!');
                    $this->session->set_userdata('ERROR_NOT_FOUND', '1');
                }

                $segment = array($this->router->class, 'index');
                $this->redirect($segment);
            }

        }

        if ($st[0] !== 'asc') {
            $offset = $total_rows - $offset;
        }

        $this->data['offset'] = $offset;
        $this->data['offset_ie'] = $offset;
        $this->data['per_in_page'] = 10;
        $st = explode('sort_', $sort);
        $this->data['sort'] = $st[0];
        $this->data['actor'] = $config['base_url'];
        if ($this->session->userdata('ERROR_NOT_FOUND') && $this->session->userdata('ERROR_NOT_FOUND') == 1) {
            unset($this->data['result_search']);
            unset($config['total_rows']);
            unset($this->data['pagination']);
            $this->session->unset_userdata('ERROR_NOT_FOUND');
        }

        $this->view('default', 'home/index', $this->data);
    }

    public function view_report($id_company = null, $offset = 0, $sort = 'ascsort_1')
    {
        $temp = $this->t_company_info->get_data_by_id('*', $id_company);
        if (count($temp) == 0) {
            $this->noti('Company does not exist!');
            $segment = array($this->router->class, 'index');
            $this->redirect($segment);
        }

        $id_company_char = $temp['ID_COMPANY'];
        $nm_company = $temp['NM_COMPANY'];
        $user = $this->session->userdata(USER_SESSION_KEY);
        if ($this->is_user()) {
            $array_company_user = $this->t_company_info->restricted_get_company($user['ID_USER']);
        } elseif ($this->is_restrict_user()) {
            $array_company_restricted = $this->t_company_info->restricted_get_company($user['ID_USER']);
        } elseif ($this->is_agency_admin()) {
            $array_company_agency = $this->t_company_info->agency_get_mapped_company($user['ID_USER']);
            $agency_assigned_company = $this->t_company_info->get_assigned_company(null, null, null, $user['ID_USER']);
        }

        if ($this->is_super_admin()) {
            $type_report = REPORT_VIEW_ALL;
        } elseif ($this->is_agency_admin()) {
            $pos = (isset($array_company_agency) && count($array_company_agency) > 0) ? array_search($id_company, array_comlumnfx($array_company_agency, 'ID_COMPANY_AI')) : false;
            $pos_ass = (isset($agency_assigned_company) && count($agency_assigned_company) > 0) ? array_search($id_company, array_comlumnfx($agency_assigned_company, 'ID_COMPANY_AI')) : false;

            if ($pos !== false || $pos_ass !== false) {
                $type_report = REPORT_VIEW_ALL;
            } else {
                $this->noti('You cannot view this company report!');
                $segment = array($this->router->class, 'index');
                $this->redirect($segment);
            }

        } elseif ($this->is_user()) {
            $pos = (isset($array_company_user) && count($array_company_user) > 0) ? array_search($id_company, array_comlumnfx($array_company_user, 'ID_COMPANY_AI')) : false;
            if ($pos !== false) {
                $type_report = REPORT_VIEW_ALL;
            } else {
                $type_report = REPORT_VIEW_EXTERNAL;
            }

        } elseif ($this->is_restrict_user()) {
            $pos = (isset($array_company_restricted) && count($array_company_restricted) > 0) ? array_search($id_company, array_comlumnfx($array_company_restricted, 'ID_COMPANY_AI')) : false;
            if ($pos !== false) {
                $type_report = REPORT_VIEW_ALL;
            } else {
                $this->noti('You cannot view this company report!');
                $segment = array($this->router->class, 'index');
                $this->redirect($segment);
            }

        }

        $result = $this->t_tracking->get_list_profile_view_report(null, null, $id_company);

        $total_rows = count($result);
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
        $config['base_url'] = site_url('/home/view_report/'.$id_company.'/');
        $config['uri_segment'] = 4;
        $config['sort'] = $sort;
        $this->sort = $sort;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment(4) == 0) ? 0 : $this->uri->segment(4);
        $data['pagination'] = $pagination;
        $data['result_search'] = $this->t_tracking->get_list_profile_view_report($config['per_page'], $offset, $id_company);
        $data['txt_search'] = '';
        $data['data_search'] = '';
        $st = explode('sort_', $sort);
        $data['sort'] = $st[0];
        if ($st[0] != 'asc') {
            $offset = $total_rows - $offset;
        }
        $data['userdata'] = $this->session->userdata(USER_SESSION_KEY);
        $data['ID_COMPANY'] = $id_company_char;
        $data['ID_COMPANY_AI'] = $id_company;
        $data['NM_COMPANY'] = $nm_company;
        $temp = $this->t_tracking->get_newest_profile($id_company_char);
        $data['NM_INDUSTRY'] = $temp[0]['NM_INDUSTRY'];

        if (count($data['result_search'])) {
            foreach ($data['result_search'] as $key => &$value) {
                $temp = explode('-', $value['DT_START']);
                $value['year'] = $temp[0];
                $value['type_report'] = $type_report;
                $value['officer'] = 'N/A';
                $value['agency'] = 'N/A';
                $temp = $this->t_company_assignment->get_lead_officer($id_company);
                if ($temp) {
                    $value['officer'] = $temp['USER_NAME'];
                    $value['agency'] = $temp['NM_ORGANISATION'];
                }
            }

            $data['result'] = $data['result_search'];
        }
        $this->view('default', 'home/view_report', $data);
    }

}