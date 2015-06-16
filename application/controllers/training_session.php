<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Training_session extends MY_Controller
{
    var $sort;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();
        $this->load->model('t_training_session');
        $this->load->model('t_participants_info');
        $this->load->model('t_trainer');
        $this->load->model('t_venue');
        $this->load->helper('form');
        $this->load->library(array('form_validation'));
        $this->load->file(APPPATH . 'models/form_validation/training_session_rules.php', false);
        $this->sort = 'asc';
    }

    /**
     *
     */
    public function index()
    {
        if ($this->is_login()) {
            $this->delete_session_rubish();
            $segment = array($this->router->class, 'filters');
            $this->redirect($segment);
        } else {
            $this->require_login();
        }
    }

    public function filters($offset = 0, $sort = 'ascsort_1')
    {
        $this->check_role(array(1), 0);
        $this->set_page_title("Manage training session");
        if ($this->input->post('action') != 'Search' && $offset === 0) {
            $this->session->unset_userdata('SESSION_SEARCH');
        }
        if ($this->input->post('filter')) {
            $filter = $this->input->post('filter');
            $this->session->set_userdata('FILTER', $filter);
        } else {
            $filter = $this->session->userdata('FILTER');
        }
        if ($this->input->post('action')) {
            $txt_search = $this->input->post('ID_SESSION');
            $this->session->set_userdata('SESSION_SEARCH', $txt_search);
        } else {
            $txt_search = $this->session->userdata('SESSION_SEARCH');
        }
        $total_record = $this->data['result_search'] = $this->t_training_session->get_data_training_session(null , null, $txt_search, $filter);
        $total_rows = count($total_record);
        $this->load->library('pagination');
        $config['per_page'] = PER_IN_PAGE;
        $config['num_links'] = NUM_LINK_PAGINATION;
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
        $config['total_rows'] = $total_rows;
        $config['base_url'] = site_url('/training_session/filters/');
        $config['uri_segment'] = 3;
        $config['sort'] = $sort;
        $this->sort = $sort;
        $config['$txt_search'] = $txt_search;
        $config['base_url'] = site_url('/training_session/filters/');
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment(3) == 0) ? 0 : $this->uri->segment(3);
        $this->data['pagination'] = $pagination;
        $this->data['result_search'] = $this->t_training_session->get_data_training_session($config['per_page'], $offset, $txt_search, $filter);
        $this->data['txt_search'] = $txt_search;
        $this->data['data_search'] = $txt_search;
        $this->data['filter'] = $filter;
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
        $data['userdata'] = $this->session->userdata(USER_SESSION_KEY);
        $this->view('default', 'training_session/filters', $this->data);
    }

    public function create()
    {
        $this->check_role(array(1), 0);
        $this->set_page_title("Create training session");
        $this->load->model('t_training_session');
        $this->load->model('t_trainer');
        $this->load->model('t_venue');
        if ($this->input->post('action') == 'Create') {
            $record = $this->input->post();
            $this->form_validation->set_rules(Training_session_rules::create_training_session_rules());

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('t_training_session');
                $record['DT_START'] = $record['DT_START'] . ' 00:00:00';
                $record['DT_END'] = $record['DT_END'] . ' 00:00:00';
                $record['NM_SESSION_NAME'] = multi_number($record['ID_SESSION_HIDDEN'], 3);
                $record['ID_TRAINER'] = $this->check_exist_and_add_trainer($record['NM_TRAINER']);
                $record['ID_VENUE'] = $this->check_exist_and_add_venue($record['NM_VENUE']);
                unset($record['ID_SESSION_HIDDEN']);
                unset($record['ID_SESSION']);
                unset($record['action']);
                unset($record['NM_TRAINER']);
                unset($record['NM_VENUE']);
                $this->t_training_session->set_data($record);
                $this->noti('Training sesssion created successfully!', 'success');
                foreach ($this->input->post() as $key) {
                    unset($key);
                }

                $segment = array($this->router->class, 'filters');
                $this->redirect($segment);

            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 0);
                $list_of_errors = array();
                $list_of_errors = validate_load(Training_session_rules::create_training_session_rules());
                $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                $this->session->set_userdata('error_mess_code', validation_errors());
                $this->session->set_userdata('CREATE_SESSION', $this->input->post());
                $temp = $this->session->userdata['CREATE_SESSION'];
                $segment = array($this->router->class, 'create');
                $this->redirect($segment);
            }

        }

        $data = array();
        $option = array('0' => 'Open', '1' => 'Closed', '2' => 'Deleted');
        $data['status_info'] = $option;
        $temp_id = $this->t_training_session->get_max_id('t_training_session');
        $data['session_info'][0]['ID_SESSION_HIDDEN'] = $temp_id;
        $temp_id = multi_number($temp_id, 3);
        $data['session_info'][0]['ID_SESSION'] = ID_PREFIX . $temp_id;
        if ($this->session->userdata('CREATE_SESSION')) {
            foreach ($this->session->userdata('CREATE_SESSION') as $key => $value) {
                $data['session_info'][0][$key] = $value;
            }

            unset($this->session->userdata['CREATE_SESSION']);
        }

        $data['userdata'] = $this->session->userdata(USER_SESSION_KEY);
        $this->view('default', 'training_session/create', $data);
    }

    public function edit($tid = null)
    {
        $this->check_role(array(1), 0);
        $this->set_page_title("Update training session");
        $this->load->model('t_training_session');
        $this->load->model('t_trainer');
        $this->load->model('t_venue');
        if ($this->input->post('action') == 'Update') {
            $record = $this->input->post();
            $join = array();
            $join['a'] = array('table' => 't_trainer_list', 'condition' => 't_trainer_list.ID_TRAINER = t_training_session.ID_TRAINER');
            $join['b'] = array('table' => 't_venue_list', 'condition' => 't_venue_list.ID_VENUE = t_training_session.ID_VENUE');
            $result = $this->t_training_session->get_data_by_property_join('*', array('ID_SESSION' => $record['ID_SESSION_HIDDEN']), $join);
            if (count($result) == 0) {
                $this->noti('Session does not exist!');
                $segment = array($this->router->class, 'filters');
                $this->redirect($segment);

            } else {
                $data['session_info'] = $result;
            }

            $this->form_validation->set_rules(Training_session_rules::update_training_session_rule());

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('t_training_session');
                $record['DT_START'] = $record['DT_START'] . ' 00:00:00';
                $record['DT_END'] = $record['DT_END'] . ' 00:00:00';
                $id_session = $record['ID_SESSION_HIDDEN'];
                $record['ID_TRAINER'] = $this->check_exist_and_add_trainer($record['NM_TRAINER']);
                $record['ID_VENUE'] = $this->check_exist_and_add_venue($record['NM_VENUE']);
                unset($record['ID_SESSION']);
                unset($record['ID_SESSION_HIDDEN']);
                unset($record['action']);
                unset($record['submit']);
                unset($record['NM_TRAINER']);
                unset($record['NM_VENUE']);
                $result = $this->t_training_session->update_data_by_id($record, $id_session);
                if ($record['ID_STATUS'] == 2) {
                    $this->t_participants_info->update_data_by_property(array('DELETED' => 1), array('ID_SESSION' => $id_session));
                }
                $this->noti('Training sesssion updated successfully!', 'success');

                foreach ($this->input->post() as $key) {
                    unset($key);
                }

                $segment = array($this->router->class, 'filters');
                $this->redirect($segment);

            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 0);
                $list_of_errors = array();
                $list_of_errors = validate_load(Training_session_rules::update_training_session_rule());
                $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                $this->session->set_userdata('error_mess_code', validation_errors());
                $this->session->set_userdata('UPDATE_SESSION', $this->input->post());
                $temp = $this->session->userdata['UPDATE_SESSION'];
                $segment = array($this->router->class, 'edit', $temp['ID_SESSION_HIDDEN']);
                $this->redirect($segment);
            }
        } elseif (isset($tid) && $tid != null) {
            $data = array();
            $option = array('0' => 'Open', '1' => 'Closed', '2' => 'Deleted');
            $data['status_info'] = $option;
            if (isset($tid) && $tid != null) {
                if ($this->session->userdata('UPDATE_SESSION')) {
                    foreach ($this->session->userdata('UPDATE_SESSION') as $key => $value) {
                        $data['session_info'][0][$key] = $value;
                    }
                    $data['session_info'][0]['ID_SESSION'] = ID_PREFIX . $data['session_info'][0]['ID_SESSION_HIDDEN'];
                    unset($this->session->userdata['UPDATE_SESSION']);
                } else {
                    $join = array();
                    $join['a'] = array('table' => 't_trainer_list', 'condition' => 't_trainer_list.ID_TRAINER = t_training_session.ID_TRAINER');
                    $join['b'] = array('table' => 't_venue_list', 'condition' => 't_venue_list.ID_VENUE = t_training_session.ID_VENUE');
                    $result = $this->t_training_session->get_data_by_property_join('*', array('ID_SESSION' => $tid), $join);
                    if (count($result) == 0) {
                        $this->noti('Session does not exist!');
                        $segment = array($this->router->class, 'filters');
                        $this->redirect($segment);

                    } else {
                        $data['session_info'] = $result;
                    }
                    $data['session_info']['0']['DT_START'] = date('Y/m/d', strtotime($result[0]['DT_START']));
                    $data['session_info']['0']['DT_END'] = date('Y/m/d', strtotime($result[0]['DT_END']));
                    $temp_id = $data['session_info']['0']['ID_SESSION'];
                    $temp_id_clone = $data['session_info']['0']['NM_SESSION_NAME'];
                    $data['session_info']['0']['ID_SESSION'] = ID_PREFIX . $temp_id_clone;
                    $data['session_info']['0']['ID_SESSION_HIDDEN'] = $temp_id;
                }
            }
            $data['userdata'] = $this->session->userdata(USER_SESSION_KEY);
            $this->view('default', 'training_session/update', $data);
        }

    }

    function validate_name_session($str)
    {
        if (preg_match('/^([a-z0-9 ])+$/i', $str)) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }

        return $result;
    }

    function check_exist_and_add_trainer($value)
    {
        $result = $this->t_trainer->get_data_by_property('*', array('NM_TRAINER' => $value));
        if (count($result) > 0) {
            return $result[0]['ID_TRAINER'];
        } else {
            $query = $this->t_trainer->core_set_data(array('NM_TRAINER' => $value), 't_trainer_list');
            return $query;
        }
    }
    function check_exist_and_add_venue($value)
    {
        $result = $this->t_venue->get_data_by_property('*', array('NM_VENUE' => $value));
        if (count($result) > 0) {
            return $result[0]['ID_VENUE'];
        } else {
            $query = $this->t_trainer->core_set_data(array('NM_VENUE' => $value), 't_venue_list');
            return $query;
        }
    }
}