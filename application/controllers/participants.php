<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Participants extends MY_Controller
{
    var $sort;
    var $id_session;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();
        $this->load->model('t_participants_info');
        $this->load->model('t_training_session');
        $this->load->model('t_organisation');
        $this->load->model('t_org_mapping');
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'session'));
        $this->load->file(APPPATH . 'models/form_validation/participant_rules.php', false);
        $this->sort = 'asc';
    }

    /**
     * Display view.
     */
    public function index()
    {
        if ($this->is_login()) {
            $this->delete_session_rubish();
            $this->view('default', 'participants/filters', $this->data);
        } else {
            $this->require_login();
        }
    }

    public function filters($id_session = 1, $offset = 1)
    {
        $this->check_role(array(1), 0);
        $this->set_page_title("Manage participants");
        $total_rows = $this->t_participants_info->get_count_participants($id_session);
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
        $config['base_url'] = site_url('/participants/filters/'.$id_session);
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $option = array();
        foreach ($this->t_org_mapping->get_data() as $org) {
            $val = $org['NM_AGENCY'];
            $option[$val] = $org['NM_AGENCY'];
        }
        $this->data['sort'] = 'asc';
        $this->data['offset'] = $offset;
        $this->data['org_info'] = $option;
        $this->data['pagination'] = $pagination;
        $join = array();
        $this->data['result_search'] = $this->t_participants_info->get_data_participants_join($config['per_page'], $offset, $id_session);
        $this->data['session_info'] = $this->t_training_session->get_data_by_id('*', $id_session);
        $this->data['id_session'] = $id_session;


        if ($this->session->userdata('ADD_PARTICIPANT')) {
            foreach ($this->session->userdata('ADD_PARTICIPANT') as $key => $value) {
                $this->data[$key] = $value;
            }
            $this->session->unset_userdata('ADD_PARTICIPANT');
        }
        $this->view('default', 'participants/filters', $this->data);
    }

    public function add_participant()
    {
        $this->check_role(array(1), 0);
        $this->form_validation->set_rules(Participant_rules::create_participant_rules());
        $this->form_validation->set_rules('NM_EMAIL', 'Email', 'trim|required|valid_email|max_length[50]|callback_edit_unique_part[t_training_participants.NM_EMAIL.' . '' . ']');
        $record = array('NM_PARTICIPANT' => $this->input->post('NM_PARTICIPANT'),
            'NM_EMAIL' => $this->input->post('NM_EMAIL'),
            'NM_ORGANISATION' => $this->input->post('NM_ORGANISATION'),
            'ID_SESSION' => $this->input->post('value'));
        if ($this->form_validation->run() == TRUE) {
            $this->t_participants_info->set_data($record);
            $segments = array($this->router->class, 'filters',$this->input->post('value'), $this->input->post('id_offset'));
            $this->redirect($segments);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $list_of_errors = validate_load(Participant_rules::create_participant_rules());
            $ext_field = array(
                array(
                    'field' => 'NM_EMAIL',
                    'label' => 'Email'
                )
            );

            $list_of_errors = array_merge($list_of_errors, validate_load($ext_field));
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('error_mess_code', validation_errors());
            unset($this->session->userdata['ADD_PARTICIPANT']);
            $this->session->set_userdata('ADD_PARTICIPANT', $this->input->post());
            $segments = array($this->router->class, 'filters', $this->input->post('value'), $this->input->post('id_offset'));
            $this->redirect($segments);
        }
    }

    public function remove()
    {
        $this->check_role(array(1), 0);
        $id_string = $this->input->post('data');
        $id_array = explode(',', $id_string);
        foreach ($id_array as $id) {
            $result = $this->t_participants_info->update_data_by_id(array('DELETED' => '1'), $id);
            if ($result == 0) {
                $this->noti('Cannot delete some participants, please try again later.');
            }
        }
    }

    public function edit()
    {
        $this->check_role(array(1), 0);
        $record = $this->input->post();
        $id = $this->input->post('id');
        $this->form_validation->set_rules(Participant_rules::update_participant_rule());
        $this->form_validation->set_rules('NM_EMAIL', 'Email', 'trim|required|valid_email|max_length[50]|callback_edit_unique_part[t_training_participants.NM_EMAIL.' . $record['id'] . ']');

        if ($this->form_validation->run() == TRUE) {
            $this->t_participants_info->update_data_by_id($record, $id);
            $result = $this->t_participants_info->get_data_by_id('ID, NM_PARTICIPANT, NM_EMAIL, NM_ORGANISATION', $id);

            if (count($result) > 0) {
                echo json_encode($result);
            } else echo 'false';

        } else {
            $list_of_errors = validate_load(Participant_rules::update_participant_rule());
            $ext_field = array(
                array(
                    'field' => 'NM_EMAIL',
                    'label' => 'Email'
                )
            );
            $list_of_errors = array_merge($list_of_errors, validate_load($ext_field));
            echo(json_encode($list_of_errors));
        }
    }

    public function edit_unique_part($value, $params)
    {
        $this->form_validation->set_message('edit_unique_part', 'The %s is already being used by another account.');
        list($table, $field, $id) = explode(".", $params, 3);

        $query = $this->db->select($field)
            ->from($table)
            ->join('t_training_session', 't_training_participants.ID_SESSION = t_training_session.ID_SESSION')
            ->where($field, $value)->where('ID !=', $id)->where('t_training_participants.DELETED', '0')->where('t_training_session.ID_SESSION !=', '2')
            ->limit(1)
            ->get();
        if ($query->row()) {
            return false;
        }

        return true;
    }
}