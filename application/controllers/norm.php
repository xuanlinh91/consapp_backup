<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company controller.
 *
 */
class Norm extends MY_Controller
{
    var $sort;
    var $id_session;

    function __construct()
    {
        parent::__construct();
        parent::__configure();
        parent::_unset();
        $this->load->model('t_tracking');
        $this->load->model('t_survey_response_hdr');
        $this->load->model('t_survey_response_dtl');
        $this->load->model('t_survey_option');
        $this->load->model('t_norm');
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'session'));
        $this->load->file(APPPATH . 'models/form_validation/norm_rules.php', false);
    }

    /**
     * Display view.
     */
    public function index()
    {
        $this->check_role(array(1), 0);
        $this->set_page_title("Compute Norm Score");
        if ($this->input->post('action') == 'Process Norm Score') {
            $this->form_validation->set_rules(Norm_rules::compute_norm_rule());
            if ($this->form_validation->run() == TRUE) {
                $start_date = $this->input->post('DT_START');
                $end_date = $this->input->post('DT_END');
                $result = $this->t_norm->compute_norm_score($start_date, $end_date);
                if (count($result) > 0 && $result[0]['ID_QUESTION'] != null) {
                    foreach ($result as $key => $value) {
                        $this->t_norm->set_data(array('DT_START' => $start_date . ' 00:00:00',
                            'DT_END' => $end_date . ' 00:00:00', 'ID_QUESTION' => $value['ID_QUESTION'], 'S_SCORE' => $value['S_SCORE']));
                    }
                } else {
                    for ($i = 1; $i < 35; $i++) {
                        $this->t_norm->set_data(array('DT_START' => $start_date . ' 00:00:00',
                            'DT_END' => $end_date . ' 00:00:00', 'ID_QUESTION' => $i, 'S_SCORE' => '-'));
                    }
                }

                $this->noti('Norm Score Saved!', 'success');
                $segment = array('norm/index');
                $this->redirect($segment);
            } else {
                $list_of_errors = validate_load(Norm_rules::compute_norm_rule());
                $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                $this->session->set_userdata('error_mess_code', validation_errors());
                $temp = $this->input->post();
                unset($temp['action']);
                $this->session->set_userdata('COMPUTE_NORM', $temp);
                $segment = array($this->router->class, 'index');
                $this->redirect($segment);
            }
        }

        if ($this->session->userdata('COMPUTE_NORM')) {
            foreach ($this->session->userdata('COMPUTE_NORM') as $key => $value) {
                $data[$key] = $value;
            }
            $this->session->unset_userdata('COMPUTE_NORM');
        } else {
            $result = $this->t_norm->get_first_data();
            if (count($result)) {
                $temp_start = $result['0'];
                $temp_end = $result['0'];
                $temp_start = strtotime($temp_start['DT_START']);
                $temp_end = strtotime($temp_end['DT_END']);
                $data['DT_START'] = date('Y/m/d', $temp_start);
                $data['DT_END'] = date('Y/m/d', $temp_end);
            }
        }

        $data['userdata'] = $this->session->userdata(USER_SESSION_KEY);
        $this->view('default', 'norm/index', $data);

    }
}