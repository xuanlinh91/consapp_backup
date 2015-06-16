<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Toolkit extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::__configure();
//        $this->load->model('mreport');
//        $this->load->model('t_company_info');
//        $this->load->model('t_company_profile');
//        $this->load->model('t_survey_response_dtl');
//        $this->load->model('t_gap_analysis_rec');
    }

    public  function download_zip(){
        $this->view('default', 'toolkit/download', '');
    }
}
