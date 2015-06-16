<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Create_pdf controller.
 *
 */
class Create_pdf extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mreport');
        $this->load->model('t_company_info');
    }

    public function Header()
    {
        // Logo
        $image_file = base_url() . '/assets/tcpdf/img_report/header.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('centurygothic', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function create($id_company = 0, $id_survey = 0)
    {
        // if($this->is_login())
        // {
        //    $this->require_login();
        // }
        // if(!$this->is_admin())
        // {
        //   $this->session->set_userdata('type_mess_code', ERROR_CLASS);
        //   $this->session->set_userdata('error_flag_code', 1);
        //   $this->session->set_userdata('error_mess_code', 'Deny Access! You are not admin');
        //   $segment = array('home', 'index');
        //   $this->redirect($segment);
        // }
        $full_question = $this->mreport->get_full_question();
        if (count($full_question) < 1) {
            // LOST DATA
        }
        $query = $this->mreport->get_data_by_id($id_company, $id_survey);
        $get_name_company = $this->t_company_info->get_data_by_id('NM_COMPANY', $id_company);
        if (count($get_name_company)) {
            $nm_company = $get_name_company['NM_COMPANY'];
        } else {
            // LOST DATA
        }
        $data_pie_chart = $this->mreport->get_data_pie_char_new($id_survey, $nm_company);
        $phtr_lv1 = round((($data_pie_chart['DATA_1'] / 11) * 100), 2);
        $phtr_lv2 = round((($data_pie_chart['DATA_2'] / 11) * 100), 2);
        $phtr_lv3 = round((($data_pie_chart['DATA_3'] / 11) * 100), 2);
        $phtr_lv4 = round((($data_pie_chart['DATA_4'] / 11) * 100), 2);
        $pie_char = $this->mreport->get_data_pie_char($id_survey, $nm_company);
        $all_current_pie = $pie_char['ALL_CURRENT'];
        $all_next_pie = $pie_char['ALL_NEXT'];
        $total_pie = $pie_char['ALL'][0]['SUM(INT_PT)'];
        $left_pie = ($all_current_pie / $total_pie) * 100;
        $left_pie = round($left_pie, 2);
        $right_pie = ($all_next_pie / $total_pie) * 100;
        $right_pie = round($right_pie, 2);
        if (count($query) < 1) {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Data not found. You can not access this url!';
            $this->display_error($this->data);
            return;
        }
        $category = $this->mreport->get_category();
        if (count($category) < 1) {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Category not found. You can not access this url!';
            $this->display_error($this->data);
            return;
        }
        $this->load->library('Mtcpdf');
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // PAGE 1 //
        $pdf->AddPage();
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);

        //ob_clean();	

        $tcpdf_content_logo = '';
        if (@file_exists(dirname(__FILE__) . '/img_report/logo_left.jpg')) {
            $tcpdf_content_logo = '/img_report/p1_logo_left.jpg';
        }
        $x = 117;
        $y = 27;
        $w = 80;
        $h = 56;
        $id_company_footer = $query['COMPANY_INFO'][0]['NM_COMPANY'];
        $pdf->set_ft_id_co($id_company_footer);
        $ft_dt_create = substr($query['TOTAL'][0]['DT_SURVEY_START'], 0, 10);
        // $day = substr($query['TOTAL'][0]['DT_SURVEY_START'], 8, 2);
        // $month =  substr($query['TOTAL'][0]['DT_SURVEY_START'], 5, 2);
        // $year =  substr($query['TOTAL'][0]['DT_SURVEY_START'], 0, 4);

        // $date_start = $month.'.'.$day.'.'.$year;
        $date_start = date("d.m.Y");
        $pdf->set_ft_dt_create($date_start);
        $day = substr($query['TOTAL'][0]['DT_SURVEY_COMPLETE'], 8, 2);
        $month = substr($query['TOTAL'][0]['DT_SURVEY_COMPLETE'], 5, 2);
        $year = substr($query['TOTAL'][0]['DT_SURVEY_COMPLETE'], 0, 4);

        $date_complete = $day . '.' . $month . '.' . $year;
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p1_logo_left.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->Ln(0);
        $html = "<table width=\"340\" class=\"info\" style=\"margin-left: -181px; float: left; margin-top: 25px;\">
          <tr>
            <td style=\"font-size: 15px; font-weight: bold; text-align:right\">Company ID:  </td>
            <td style=\"font-size: 15px; text-align:left; padding-left: 25px;\">" . $id_company_footer . "</td>
          </tr>
          <tr>
            <td style=\"font-size: 15px; font-weight: bold; text-align:right\">Report Date:  </td>
            <td style=\"font-size: 15px text-align:left;  padding-left: 25px;\">" . $date_start . "</td>
          </tr>
          <tr>
            <td style=\"font-size: 15px;  font-weight: bold; text-align:right\">Date Completed:  </td>
            <td style=\"font-size: 15px; text-align:left;padding-left: 25px;\">" . $date_complete . "</td>
          </tr>
          <tr>
            <td style=\"font-size: 15px; font-weight: bold;  text-align:right\">HRMM Version:  </td>
            <td style=\"font-size: 15px; text-align:left; padding-left: 25px;\">2.0</td>
          </tr>
        </table>";

        $pdf->SetXY(80, 90);
        $pdf->writeHTML($html, false, 0, false, 0);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->Ln(0);
        $pdf->SetXY(27, 223);
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->Cell(20, 7, "Demographics", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->Ln(0);
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->SetXY(27, 225);
        $pdf->Ln(0);
        $pdf->Ln(0);
        $html = "<table style=\"width:900px\">
        <tr>
          <td style=\"font-size: 15px; font-weight: bold;text-align:right;width:200px;\">  Industry: </td>
          <td style=\"font-size: 15px; text-align:left;padding-left: 25px;\">&nbsp;&nbsp;" . $query['T_DROPDOWN'][0]['VALUE'] . "</td>
        </tr>
        <tr>
          <td style=\"font-size: 15px; font-weight: bold;text-align:right;width:200px;\"> Company Type: </td>
          <td style=\"font-size: 15px; text-align:left;padding-left: 25px;\">&nbsp;&nbsp;" . $query['T_DROPDOWN'][1]['VALUE'] . "</td>
        </tr>
        <tr>
          <td style=\"font-size: 15px; font-weight: bold;text-align:right;width:200px;\"> Revenue Size: </td>
          <td style=\"font-size: 15px; text-align:left;padding-left: 25px;\">&nbsp;&nbsp;" . $query['T_DROPDOWN'][2]['VALUE'] . "</td>
        </tr>
        <tr>
          <td style=\"font-size: 15px; font-weight: bold;text-align:right;width:200px;\"> Staff Size: </td>
          <td style=\"font-size: 15px; text-align:left;padding-left: 25px;\">&nbsp;&nbsp;" . $query['T_DROPDOWN'][3]['VALUE'] . "</td>
        </tr>
        <tr>
          <td style=\"font-size: 15px; font-weight: bold;text-align:right;width:200px;\"> HR Team Size: </td>
          <td style=\"font-size: 15px; text-align:left;padding-left: 25px;\">&nbsp;&nbsp;" . $query['T_DROPDOWN'][4]['VALUE'] . "</td>
        </tr>
      </table>";
        $pdf->writeHTMLCell(200, 0, 12, 232, $html);
        $pdf->lastPage();
        // PAGE 2 //

        $pdf->AddPage();
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

        $pdf->Line(15, 26, 198, 26, $style);

        $html = "<div class=\"content\" style=\"width:960px;float: left;\"> 
  		<h1 style=\"font-weight: normal;font-size: 35px;color: #0070C0;\">Introduction to HRMM</h1>
          <p style=\" font-size: 14px;margin:0px;width:960px;text-align: justify;\">The single greatest asset for any company is its people and the culture they uphold. It is the people in an organization that innovate, market, produce and deliver the products and services that satisfy customer expectations and build relationships. Yet assembling and retaining a motivated, high performance team is often left to chance. In addition, many underestimate the time and relentless effort required to engage each member to get the best out of the team in an ongoing basis. </p>
          <p style=\"font-size: 14px;margin: 20px 0 0 0;width:960px;text-align: justify;\">The best run companies in the world systematically invest in their people and the systems and policies that enable their teams. The good news is that companies of all sizes, including SMEs, can benefit from the same focus and attention to building up their organizational capability. </p></div>";

        $pdf->Ln(3);

        $pdf->SetXY(0, 7, true);
        //$pdf->writeHTML($html, true, 0, true, 0);
        $pdf->writeHTMLCell(180, 0, 15, 10, $html);

        $html = " <div class=\"content\" style=\"width:960px;float: left;\"> 
  	<h1 style=\"font-weight: normal;font-size: 35px;color: #0070C0;\">Cracking the HR code</h1>
  	        <p  style=\"font-size: 14px;margin:0px;text-align: justify;\">The HR Maturity Model (HRMM) is a growth framework which outlines the progression of organizational capabilities, spelling out the key pathways companies can take to greater HR maturity. It was developed by Hay Group in 2013 to respond to the pressing needs of SMEs in Singapore. </p>
  	        <p style=\"font-size: 14px;margin: 20px 0 0 0;text-align: justify;\">Hay Group is a global management consultancy famed for its deep organizational research and more than 70 years of consulting experience with a variety of organizations – from large Fortune500 companies to Not-for-profit entities, including engagements with local SMEs here in Singapore.</p>
  	        <p style=\"font-size: 14px;margin: 20px 0 0 0;text-align: justify;\">The HRMM comes with a simple self-assessment survey tool to help companies quickly assess their. 1. current state of maturity. This is then mapped to the <b>appropriate growth stage</b> of the SME to provide an 2. ideal maturity state required for the company to succeed in that stage. The resulting 3. gap analysis then provides the benefit of helping SMEs focus limited resources on areas that truly matter to the broader business objectives. </p>
  	        <p style=\"font-size: 14px;margin: 20px 0 0 0;text-align: justify;\">The HRMM model comprises of 4 levels. The results are best validated with a trained consultant who can help interpret the results in conversation with business leaders ready to bring about a transformation in their organization.</p>
  	        <p style=\"font-size: 14px;margin: 20px 0 0 0;text-align: justify;\">By incorporating the business leader’s specific organizational priorities to the results, a tailored HR <b>roadmap of activities</b> can then be generated to help the company bridge the gaps indentified to successfully meet the challenges of their current or even future growth stages.</p></div>";

        $pdf->writeHTMLCell(180, 0, 15, 88, $html);
        $pdf->lastPage();
        // PAGE 3 //

        $pdf->AddPage();
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);
        $pdf->SetXY(15, 30);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 30);
        $pdf->Cell(20, 7, "Contents", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->Ln(0);
        $html = "<table width=\"100\" style=\"background-color: #F2F2F2;border-collapse:collapse;\">
            <tr>
              <td width=\"150\" height=\"69\" style=\"color:#0070C0;font-size: 16px;vertical-align:top;padding-left: 10px;border:solid 1px #FFFFFF;border-right:solid 1px #FFFFFF;border:solid 1px #FFFFFF;\">Overall <br />
                Maturity</td>
              <td width=\"410\" style=\"font-size: 16px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;padding-left: 10px;
  vertical-align: top;\">Provides the organization’s overall HRMM rating and a short description of each level in the model.</td>
              <td width=\"90\" style=\"font-size: 32px;text-align: center;border:solid 1px #FFFFFF;color:#808080;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">04</td>
            </tr>
            <tr>
              <td height=\"63\" style=\"border:solid 1px #FFFFFF;color:#0070C0;font-size: 16px;vertical-align:top;padding-left: 10px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">Gap Analysis</td>
              <td style=\"font-size: 16px;border-top:solid 1px #FFFFFF;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;padding-left: 10px;
  vertical-align: top;\">A visual representation of the current score against the ideal score for a particular business growth stage by process areas.</td>
              <td style=\"border:solid 1px #FFFFFF;font-size:32px;color:#808080;text-align: center;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">05</td>
            </tr>
            <tr>
              <td height=\"85\" style=\"border:solid 1px #FFFFFF;color:#0070C0;font-size: 16px;vertical-align:top;padding-left: 10px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">Managerment<br />
                Style</td>
              <td style=\"font-size: 16px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;padding-left: 10px;
  vertical-align: top;\"><p>Lorem ipsum dolor sit amet, consectetur.</p></td>
              <td style=\"border:solid 1px #FFFFFF;font-size:32px;color:#808080;text-align: center;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">06</td>
            </tr>
            <tr>
              <td height=\"85\" style=\"border:solid 1px #FFFFFF;color:#0070C0;font-size: 16px;vertical-align:top;padding-left: 10px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">Next Steps</td>
              <td style=\"font-size: 16px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;padding-left: 10px;
  vertical-align: top;\">Recommended next steps.</td>
              <td style=\"border:solid 1px #FFFFFF;font-size:32px;color:#808080;text-align: center;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">07</td>
            </tr>
            <tr>
              <td height=\"85\" style=\"border:solid 1px #FFFFFF;color:#0070C0;font-size: 16px;vertical-align:top;padding-left: 10px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">Appendix - <br />
                Process Area Details</td>
              <td style=\"font-size: 16px;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF;padding-left: 10px;
  vertical-align: top;\">A detailed scoring of the individual process areas. Shows current state as declared by the company, the ideal score for a particular business growth stage, and the gap between the two values.</td>
              <td style=\"border:solid 1px #FFFFFF;font-size:32px;color:#808080;text-align: center;border:solid 1px #FFFFFF;border:solid 1px #FFFFFF\">09</td>
            </tr>
          </table>";
        $pdf->SetXY(15, 45);
        $pdf->writeHTML($html, true, 0, true, 0);
        $pdf->lastPage();
        // PAGE 4 //
        // 
        $pdf->AddPage();
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);
        $pdf->SetXY(15, 30);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 25);
        $pdf->Cell(20, 7, "Overall Maturity", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->Ln(0);
        $pdf->SetXY(15, 40);
        $pdf->SetFont('centurygothic', 'N', 12);
        $hrmm_level = $query['HRMM_LEVEL'];
        $pdf->writeHTMLCell(90, 0, 15, 40, "Your organization is currently declared to be at");
        $cur_pie = '';
        $next_pie = '';
        if ($hrmm_level == 1) {

            $html = "HRMM LEVEL I";
            $cur_pie = "HRMM LEVEL I";
            $next_pie = "HRMM LEVEL II";


            $html_text_top = "An HRMM Level I organization likely only meeting the most basic requirements of the business and satisfied with attaining regulatory compliance. Processes are inconsistent or ritualistic, often driven by legal mandates. Performance and rewards are typically discretionary in nature.";

            $html_text_bottom = "A move up to HRMM Level II requires a change in focus and management mindset to begin accepting Human Capital issues as the responsibility of management, beginning first with the standardization and setting up of repeatable processes to exercise more control over the organizational needs of the business.";

        } else if ($hrmm_level == 2) {

            $html = "HRMM LEVEL II";
            $cur_pie = "HRMM LEVEL II";
            $next_pie = "HRMM LEVEL III";

            $html_text_top = "An HRMM Level II organization has likely achieved a good level of standardization and compliance. Managers are beginning to take ownership of people management responsibilities.";

            $html_text_bottom = "A move up to HRMM Level III requires a change in focus and management mindset to the behavioral change required including greater employee engagement and the creation of a professional HR function.";

        } else if ($hrmm_level == 3) {

            $html = "HRMM LEVEL III";
            $cur_pie = "HRMM LEVEL III";
            $next_pie = "HRMM LEVEL IV";

            $html_text_top = "An HRMM Level III organization has likely established strong people management good HR practices. Formal processes are in place, with the capability to manage skills and performance at the unit level. Deliberate workforce engagement and development is practiced. Well done but don’t allow for complacency or risk slipping back one level!";

            $html_text_bottom = "Continue reaching forward: HRMM Level IV requires a change in focus and management mindset to deploying Human Capital as a strategic resource. It seeks to achieve Organizational level integration of Strategy, Culture, People Management and HR Practices. This is where the real gains are.";
        } else if ($hrmm_level == 4) {

            $html = "HRMM LEVEL IV";
            $cur_pie = "HRMM LEVEL IV";
            $next_pie = "HRMM LEVEL V";

            $html_text_top = "An HRMM Level IV views Human Capital as a strategic resource that requires deep investment to power the business with an eye on developing capabilities for the future. This change in focus and management mindset is a significant achievement in addition to the attainment of Organizational level integration of Strategy, Culture, People Management and HR Practices. Very well done.";

            $html_text_bottom = "A move up to HRMM Level V is to build an organization where Human Capital is managed like any other key business unit and an inseparable part of the competitive advantage of the enterprise. It has continuous capability improvement, deep integration with business by flexibly self configuring to changing needs  (smart differentiation choices). Change management is part of the daily business routine.";
        } else {

            $html = "HRMM LEVEL V";
            $cur_pie = "HRMM LEVEL V";
            $next_pie = "";

            $html_text_top = "An HRMM Level V is the most mature state a company can achieve. This organization is one where Human Capital is managed like any other key business unit which contributes to the competitive advantage of the enterprise. It has the ability to Balance standardization and differentiation to create optimal ‘Fit for Purpose’ HR for strategic advantage. Beyond following “best practice”, it is adaptive, knowing when to increase and decrease investment in certain areas. Change management is part of the daily business routine and combined with achieving a state of self-learning, it is therefore the only truly sustainable HR Maturity level.";

            $html_text_bottom = "";
        }
        if ($hrmm_level > 0 && $hrmm_level < 6) {
            $img_url = base_url() . "assets/tcpdf/img_report/p4_table_bottom_$hrmm_level.jpg";
        } else {
            $img_url = base_url() . "assets/tcpdf/img_report/p4_table_bottom.jpg";
        }

        $pdf->Ln(0);
        //$pdf->ImageSVG($file=base_url().'assets/tcpdf/img_report/chart.svg', $x=86, $y=50, $w=0, $h=0, $link='', $align='', $palign='', $border=0, $fitonpage=false);
        $pdf->SetXY(167, 80, true);
        // import pie chart
        // $pdf->Image(base_url()."temp/SUR_$id_survey".".png", $x=100, $y=30, $w=130, $h=130, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        $pdf->ImageSVG($file = base_url() . "temp/SUR_$id_survey" . ".svg", $x = 100, $y = 15, $w = 130, $h = 130, $link = '', $align = '', $palign = '', $border = 0, $fitonpage = false);
        if ((int)$phtr_lv1 == 100 || (int)$phtr_lv2 == 100 || (int)$phtr_lv3 == 100 || (int)$phtr_lv4 == 100) {
            $pdf->Image($file = base_url() . "assets/tcpdf/img_report/0.jpg", 163, 59.5, 5, 5, 'JPG');
        }
        $pdf->Image($file = base_url() . "assets/tcpdf/img_report/p4_note_pie_chart.jpg", 130, 115, 16, 32, 'JPG');
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 150;
        $y = 116;
        $pdf->writeHTMLCell(70, 0, $x, $y, 'HRMM LEVEL I' . ' : ' . $phtr_lv1 . ' %');
        $pdf->writeHTMLCell(70, 0, $x, $y + 8, 'HRMM LEVEL II' . ' : ' . $phtr_lv2 . ' %');
        $pdf->writeHTMLCell(70, 0, $x, $y + 16, 'HRMM LEVEL III' . ' : ' . $phtr_lv3 . ' %');
        $pdf->writeHTMLCell(70, 0, $x, $y + 24, 'HRMM LEVEL IV' . ' : ' . $phtr_lv4 . ' %');
        // distance
        // $style = array('width' => 5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        // $pdf->Line(128, 90, 201.125, 90, $style);

        // R = 73.125 !IMPORTANT

        // DRAW NEXT LEVER
        $hrmm_level = $hrmm_level + 1;
        $pdf->SetFont('centurygothic', 'B', 14);
        $pdf->writeHTMLCell(0, 0, 30, 45, $html);
        $pdf->SetXY(15, 56, true);
        $pdf->SetFont('centurygothic', 'N', 12);
        $pdf->Ln(0);
        if (empty($html_text_bottom)) {
            $pdf->writeHTMLCell(110, 0, 15, 55, $html_text_top);
        } else {
            $pdf->writeHTMLCell(110, 60, 15, 55, $html_text_top);
        }
        if ($hrmm_level == 3) {
            $pdf->writeHTMLCell(110, 60, 15, 85, $html_text_bottom);
        } else {
            $pdf->writeHTMLCell(110, 60, 15, 100, $html_text_bottom);
        }
        $pdf->Ln(0);
        // $pdf->writeHTMLCell(110,60,15,100,$html_text_bottom);
        $pdf->Ln(0);
        $pdf->Image($img_url, $x = 15, $y = 160, $w = 180, $h = 180, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->Ln(0);

        // $pdf->SetFont('centurygothic', 'N', 12);

        // $pdf->writeHTMLCell(40,15,133,65,$cur_pie);
        // $pdf->writeHTMLCell(25,15,140,70,$left_pie." %");
        // if(!empty($next_pie))
        // {
        //   $pdf->writeHTMLCell(40,15,172,65,$next_pie);
        //   $pdf->writeHTMLCell(25,15,180,70,$right_pie." %");
        // }
        $pdf->SetFont('centurygothic', 'B', 11);
        $text_on_pie = "Overview of Process Area Levels";
        $pdf->writeHTMLCell(100, 0, 134, 45, $text_on_pie);
        $pdf->lastPage();
        // PAGE 5 //
        // 
        $pdf->AddPage();
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);
        $pdf->SetXY(15, 28);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 25);
        $pdf->Cell(20, 7, "Gap Analysis", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->Ln(0);
        $pdf->ImageSVG($file = base_url() . "temp/COM_$id_company" . ".svg", $x = 20, $y = 36, $w = 0, $h = 0, $link = '', $align = '', $palign = '', $border = 0, $fitonpage = false);
        //$pdf->Image(base_url().'assets/tcpdf/img_report/p5_gap_spider.jpg', $x=20, $y=36, $w=0, $h=0, 'JPG', '', '', false, 300, '', false, false, 0,' ', false, false);
        //

        // ADD CATEGORY 5 & 6
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 9);
        $category_5 = $category[5]['NM_CATEGORY'];
        $category_6 = $category[6]['NM_CATEGORY'];
        $pdf->writeHTMLCell(60, 60, 39, 125, $category_5);
        $pdf->writeHTMLCell(60, 60, 114, 125, $category_6);
        // END - ADD CATEGORY 5 & 6
        $id_gs1 = $query['COMPANY_INFO'][0]['ID_GS1'];
        $pdf->Image(base_url() . "assets/tcpdf/img_report/p5_table_gap_$id_gs1.jpg", $x = 15, $y = 165, $w = 183, $h = 145, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->Ln(0);
        // ADD NUMBER 4

        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 8.7);
        $pdf->writeHTMLCell(0, 0, 101, 56, '4');

        $pdf->lastPage();
        // PAGE 6 //

        $pdf->AddPage();
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);
        $pdf->SetXY(15, 28);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 25);
        $pdf->Cell(20, 7, "Management Style", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 11);
        $pdf->Ln(0);
        $html = '<p>As the owner grows its business, there is a clear trade-off between the owner\'s ability to execute versus his ability to delegate. The more complex and the larger the business, the greater the need</p>';
        $html2 = '<p>for the owner to focus on more strategic issues and rely on building up or brining in professionals to help him manage the needs of a more diversified company.</p>';
        $html1 = "<p>There is an optimal style for each Growth Stage and the owner needs to recognize the criticality of relinquishing and delegating responsibilities to ensure the company's continued growth.</p>";
        $pdf->setFontSpacing(-0.01);
        $pdf->writeHTMLCell(187, 60, 14, 37, $html);
        $pdf->setFontSpacing(-0.025);
        $pdf->writeHTMLCell(186, 60, 14, 47, $html2);
        $pdf->setFontSpacing(0);
        $pdf->writeHTMLCell(185, 60, 14, 62, $html1);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/page_6_chart.jpg', $x = 35, $y = 88, $w = 140, $h = 145, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);

        $pdf->SetTextColorArray(array(8, 112, 189));
        $pdf->SetFont('centurygothic', 'N', 5);
        $html = "<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
      Growth</h2>";
        $pdf->writeHTMLCell(40, 60, 12, 179, $html);
        $html = "<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
      Stage</h2>";
        $pdf->writeHTMLCell(40, 60, 12, 182.5, $html);
        $html = "<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
      Management</h2>";
        $pdf->writeHTMLCell(40, 60, 12, 186, $html);
        $html = "<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
      Style</h2>";
        $pdf->writeHTMLCell(40, 60, 12, 189.5, $html);
        $pdf->SetFont('centurygothic', 'N', 12);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->Image(base_url() . "assets/tcpdf/img_report/p6_table_$id_gs1.jpg", $x = 45, $y = 178, $w = 140, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // remove old design
        // $html="<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
        // Ideal Style
        // </h2>";
        // $pdf->SetFont('centurygothic', 'N', 9);
        // $pdf->writeHTMLCell(40,0,12,249,$html);
        // $pdf->SetFont('centurygothic', 'N', 12);
        // $html="<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
        //       Current Style
        //       </h2>";
        // $pdf->SetFont('centurygothic', 'N', 9);
        // $pdf->writeHTMLCell(40,0,12,255,$html);
        // $pdf->SetFont('centurygothic', 'N', 12);
        // $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        // $pdf->Line(45, 251, 187, 251, $style);
        // $pdf->Line(45, 258, 187, 258, $style);
        $html = "<h2 style=\"float:left;font-weight:normal;color:#0070C0;\">
            Current Style
            </h2>";
        $pdf->SetFont('centurygothic', 'N', 5);
        $pdf->writeHTMLCell(40, 0, 12, 249, $html);
        $pdf->SetFont('centurygothic', 'N', 5);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(45, 251, 187, 251, $style);
        $hrmm_level = $hrmm_level - 1;
        $id_gs2 = $query['COMPANY_INFO'][0]['ID_GS2'];
        if ($id_gs2 == 6) {
            $pdf->Image(base_url() . 'assets/tcpdf/img_report/p6_red.png', $x = 57, $y = 247.25, $w = 4, $h = 4, 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        } else if ($id_gs2 == 7) {
            $pdf->Image(base_url() . 'assets/tcpdf/img_report/p6_red.png', $x = 85, $y = 247.25, $w = 4, $h = 4, 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        } else if ($id_gs2 == 8) {
            $pdf->Image(base_url() . 'assets/tcpdf/img_report/p6_red.png', $x = 113, $y = 247.25, $w = 4, $h = 4, 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        } else if ($id_gs2 == 9) {
            $pdf->Image(base_url() . 'assets/tcpdf/img_report/p6_red.png', $x = 141, $y = 247.25, $w = 4, $h = 4, 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        } else if ($id_gs2 == 10) {
            $pdf->Image(base_url() . 'assets/tcpdf/img_report/p6_red.png', $x = 168, $y = 247.25, $w = 4, $h = 4, 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        } else {
        }
        // if($hrmm_level == 1)
        // {
        //     $pdf->Image(base_url().'assets/tcpdf/img_report/p6_red.png', $x=85, $y=254, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else if($hrmm_level == 2)
        // {
        //     $pdf->Image(base_url().'assets/tcpdf/img_report/p6_red.png', $x=113, $y=254, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else if($hrmm_level == 3)
        // {
        //     $pdf->Image(base_url().'assets/tcpdf/img_report/p6_red.png', $x=141, $y=254, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else if($hrmm_level ==4 )
        // {
        //     $pdf->Image(base_url().'assets/tcpdf/img_report/p6_red.png', $x=168, $y=254, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else
        // {
        // }
        // if($id_gs1 == 1)
        // {
        //   $pdf->Image(base_url().'assets/tcpdf/img_report/p6_black.png', $x=85, $y=247, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else if($id_gs1 == 2)
        // {
        //   $pdf->Image(base_url().'assets/tcpdf/img_report/p6_black.png', $x=113, $y=247, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else if($id_gs1 == 3)
        // {
        //   $pdf->Image(base_url().'assets/tcpdf/img_report/p6_black.png', $x=113, $y=247, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else if ($id_gs1 ==4 ) {
        //    $pdf->Image(base_url().'assets/tcpdf/img_report/p6_black.png', $x=141, $y=247, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        // else
        // {
        //   $pdf->Image(base_url().'assets/tcpdf/img_report/p6_black.png', $x=168, $y=247, $w=4, $h=4, 'PNG', '', '', false, 300, '', false, false, 0,' ', false, false);
        // }
        $pdf->lastPage();
        // PAGE 7 //   

        $pdf->AddPage();
        $pdf->SetX(20);
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 25);
        $pdf->SetX(14);
        $pdf->Cell(14, 7, "Next Steps", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->setFontSpacing(0.1);
        $pdf->SetXY(14, 44, true);
        $pdf->SetFont('centurygothic', 'N', 10);
        $html = 'As a first step, you may want to consider reviewing the frameworks and key guidelines that make <span style="letter-spacing: 1px;">up the free HR Capability Toolkit for SMEs at www.hrcapability.com. The website also makes available tips and pointers on how to manage specific HR matters, </span><span style="letter-spacing: 0px;">including templates that can be adopted with minimal customization in the following 8 areas:</span>';
        $pdf->setFontSpacing(-0.001);
        $pdf->writeHTMLCell(185, 60, 14, 44, $html);
        $pdf->setFontSpacing(0);
        $pdf->Ln(3);
        $html = "<ol style=\"width: 960px;float: left;\">
            <li>Manpower Planning</li>
            <li>Recruitment & Selection</li>
            <li>Compensation & Benefits</li>
            <li>Performance Management</li>
            <li>Career Management</li>
            <li>Learning & Development</li>
            <li>Talent Management & Succession Planning</li>
            <li>Employee Relations</li>
          </ol>";
        $pdf->SetX(20);
        $pdf->writeHTMLCell(184, 60, 20, 75, $html);
        $pdf->Ln(3);
        $html = '<span style="letter-spacing: 1px;">If you require expert assistance, you should consider tapping into the Innovation Capability Voucher (ICV)</span> by SPRING Singapore. This scheme provides SMEs up to two $5,000 vouchers for HR';
        $html2 = 'capability enhancement projects of 6 months duration or less. Each voucher can be used in one of the following HR areas:';
        $pdf->setFontSpacing(0.16);
        $pdf->writeHTMLCell(186, 60, 14, 120, $html);
        $pdf->setFontSpacing(0.18);
        $pdf->writeHTMLCell(186, 60, 14, 128.5, $html2);
        $pdf->setFontSpacing(0);
        $html = "<ol style=\"width: 960px;float: left;\">
            <li>Manpower Planning</li>
            <li>Recruitment & Selection</li>
            <li>Compensation & Benefits</li>
            <li>Performance Management</li>
            <li>Career Management</li>
            <li>Learning & Development</li>
          </ol>";
        $pdf->Ln(3);
        $pdf->SetX(20);
        $pdf->writeHTMLCell(184, 60, 20, 145, $html);
        $html = "Visit the SPRING website to find out the list of approved service providers you can contact to take advantage of the ICV scheme for HR upgrading initiatives.";
        $pdf->Ln(3);
        $pdf->SetX(20);
        $pdf->setFontSpacing(0.1);
        $pdf->writeHTMLCell(184, 60, 14, 180, $html);
        $pdf->setFontSpacing(0);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $html = 'If you would like to enhance the overall HR capability of your organization in a more';
        $pdf->Ln(3);
        $pdf->SetX(20);
        $pdf->setFontSpacing(0.4);
        $pdf->writeHTMLCell(184, 60, 14, 195, $html);
        $pdf->setFontSpacing(0.35);
        $html = 'comprehensive and integrated manner, please approach SPRING on how to access the  Capability Development Grant (CDG).';
        $pdf->writeHTMLCell(184, 60, 14, 200, $html);
        $pdf->setFontSpacing(0);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->Ln(3);
        $pdf->SetX(20);
        $html = "The CDG is a financial assistance program aimed at helping SMEs defray up to 70% of qualifying project costs*, relating to consultancy, manpower, training, etc. The CDG can be applied to HR Projects that develop a strong human capital foundation for business sustainability in three areas: HR Management and Development, Leadership Development, and Talent Attraction.";
        $pdf->setFontSpacing(0.15);
        $pdf->writeHTMLCell(184, 60, 14, 215, $html);
        $pdf->setFontSpacing(0);
        $pdf->Ln(18);
        $pdf->SetFont('centurygothic', 'I', 9);
        $pdf->SetX(20);
        $html = "* SPRING's enhanced funding support of up to 70% would be effective for three years until 31 March 2015.";
        $pdf->writeHTMLCell(184, 0, 14, 265, $html);
        $pdf->lastPage();
        // PAGE 8 //

        $pdf->AddPage();
        $pdf->SetFont('centurygothic', 'N', 12);
        $pdf->setJPEGQuality(100);
        $html = "<table  style=\"border-collapse: collapse;float: left;\">
          <tr>
            <td style=\"vertical-align: middle; text-align:center; color:#00B0F0;font-weight:bold;border:solid 2px #000000;\">CDG HR Areas</td>
            <td style=\"vertical-align: middle; text-align:center; color:#00B0F0;font-weight:bold;border:solid 1px #000000;border-right:solid 2px #000000;\">Supported Activities</td>
          </tr>
          <tr>
            <td style=\"vertical-align: top; text-align:left;border:solid 2px #000000;\"><strong>HR Management & Development</strong><br />
              Implement effective HR processes, practices and policies to attract, develop and retain talent to support SME growth strategies. </td>
            <td style=\"vertical-align: top; text-align:left;border:solid 2px #000000;border-right:solid 1px #000000;\">– Manpower planning<br />
              – Recruitment and selection<br />
              – Compensation and benefits<br />
              – Performance management<br />
              – Learning and development<br />
              – Career management<br />
              – Talent management<br />
              – Employee engagement<br />
              – Other HR management or development areas</td>
          </tr>
          <tr>
            <td style=\"vertical-align: top; text-align:left;border:solid 2px #000000;\"><strong>Leadership Development</strong><br />
              Strengthen leadership skills of senior management and develop managerial competencies for middle management.</td>
            <td style=\"vertical-align: top; text-align:left;border:solid 2px #000000;border-right:solid 1px #000000;\">– Developing leadership abilities and skills through executive development programmes and postgraduate programmes<br />
              – For Senior Management<br />
              – For Middle Management<br />
              – Engaging business advisors to improve business and processes<br />
              – Engaging business mentors to advise SME CEOs on business strategies</td>
          </tr>
          <tr>
            <td height=\"254\" style=\"vertical-align: top; text-align:left;border:solid 2px #000000;\"><strong>Talent Attraction</strong><br />
              Develop and anchor a strong pipeline of young local talents for business growth and sustainability. <br />
              Become the employer of choice which offer attractive job opportunities to fresh local talents. <br />
              <br />
              Note: SMEs should have minimum group revenue of S$10 million per annum required for leadership development and talent attraction</td>
            <td style=\"vertical-align: top; text-align:left;border:solid 2px #000000;border-right:solid 1px #000000;\">– Recruiting interns to attract and expose them to SME’s thriving work environment<br />
              – Offering local university scholarships<br />
              – Offering study awards and job opportunities to polytechnic and ITE students (under SME Talent Programme)<br />
              – Hiring and training fresh graduates (polytechnic & university) as management associates<br />
              – Workshops to build up SME’s knowledge on talent management</td>
          </tr>
        </table>";
        $pdf->writeHTMLCell(184, 0, 15, 30, $html);
        $pdf->lastPage();
        // PAGE 9 //   

        $pdf->AddPage();
        $pdf->SetX(20);
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf->Line(15, 26, 198, 26, $style);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 25);
        $pdf->SetX(20);
        $pdf->Cell(20, 7, "Appendix - Process Area Details", 0, false, 'L', 0, '', 0, true, 'T', 'M');
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q1.jpg', $x = 15, $y = 43, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW QUESTION IN TABLE
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        // QUESTION  1 - 3
        $question_in_table = $full_question[0]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, 17.5, 56.5, $question_in_table);
        $question_in_table = $full_question[1]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, 17.5, 67.5, $question_in_table);
        $question_in_table = $full_question[2]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, 17.5, 78.5, $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $temp_category = $category[0]['NM_CATEGORY'];
        $pdf->writeHTMLCell(0, 0, 15, 45.5, '1. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;


        for ($i = 0; $i < 34; $i++) {
            if (!isset($query['DRAW_ANSWER'][$i]['IN_POINT']) || empty($query['DRAW_ANSWER'][$i]['IN_POINT'])) {
                $query['DRAW_ANSWER'][$i]['IN_POINT'] = 0;
            }
            $query['GAP_CAL'][$i]['SUB'] = $query['DRAW_BENCHMARK'][$i]['IN_POINT'] - $query['DRAW_ANSWER'][$i]['IN_POINT'];
            if ($query['GAP_CAL'][$i]['SUB'] < 0) {
                //$query['GAP_CAL'][$i]['SUB'] = 0;
            }
        }
        $selected = $query['DRAW_ANSWER'][0]['IN_POINT'];
        $location = $this->draw_answer(1, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][1]['IN_POINT'];
        $location = $this->draw_answer(1, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][2]['IN_POINT'];
        $location = $this->draw_answer(1, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK

        $selected = $query['DRAW_BENCHMARK'][0]['IN_POINT'];

        $location = $this->draw_benchmark(1, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][1]['IN_POINT'];
        $location = $this->draw_benchmark(1, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][2]['IN_POINT'];
        $location = $this->draw_benchmark(1, 3, $selected);

        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 2
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q2.jpg', $x = 15, $y = 94, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // QUESTION  4 - 7
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[3]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[4]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[5]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 94;
        $temp_category = $category[1]['NM_CATEGORY'];
        $pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '2. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;

        $selected = $query['DRAW_ANSWER'][3]['IN_POINT'];
        $location = $this->draw_answer(2, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][4]['IN_POINT'];
        $location = $this->draw_answer(2, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][5]['IN_POINT'];
        $location = $this->draw_answer(2, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK

        $selected = $query['DRAW_BENCHMARK'][3]['IN_POINT'];

        $location = $this->draw_benchmark(2, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][4]['IN_POINT'];
        $location = $this->draw_benchmark(2, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][5]['IN_POINT'];
        $location = $this->draw_benchmark(2, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);

        // TABLE 3

        // DRAW TABLE

        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q3.jpg', $x = 15, $y = 146, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);

        $question_in_table = $full_question[6]['NM_QUESTION'];
        $question_in_table = str_replace('Organisation', 'Org', $question_in_table);
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[7]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[8]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 146;
        $temp_category = $category[2]['NM_CATEGORY'];
        $pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '3. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;

        $selected = $query['DRAW_ANSWER'][6]['IN_POINT'];
        $location = $this->draw_answer(3, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][7]['IN_POINT'];
        $location = $this->draw_answer(3, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][8]['IN_POINT'];
        $location = $this->draw_answer(3, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK

        $selected = $query['DRAW_BENCHMARK'][6]['IN_POINT'];

        $location = $this->draw_benchmark(3, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][7]['IN_POINT'];
        $location = $this->draw_benchmark(3, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][8]['IN_POINT'];
        $location = $this->draw_benchmark(3, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 4

        // DRAW TABLE

        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q4.jpg', $x = 15, $y = 198, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[9]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[10]['NM_QUESTION'];
        $question_in_table = str_replace('and Development', '& Devt', $question_in_table);
        $pdf->SetFont('centurygothic', 'N', 11);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $pdf->SetFont('centurygothic', 'N', 11);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $question_in_table = $full_question[11]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $question_in_table = $full_question[12]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 33), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 198;
        $temp_category = $category[3]['NM_CATEGORY'];
        $pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '4. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;

        $selected = $query['DRAW_ANSWER'][9]['IN_POINT'];
        $location = $this->draw_answer(4, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][10]['IN_POINT'];
        $location = $this->draw_answer(4, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][11]['IN_POINT'];
        $location = $this->draw_answer(4, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][12]['IN_POINT'];
        $location = $this->draw_answer(4, 4, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);

        // DRAW BENCHMARK

        $selected = $query['DRAW_BENCHMARK'][9]['IN_POINT'];

        $location = $this->draw_benchmark(4, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][10]['IN_POINT'];
        $location = $this->draw_benchmark(4, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][11]['IN_POINT'];
        $location = $this->draw_benchmark(4, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][12]['IN_POINT'];
        $location = $this->draw_benchmark(4, 4, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);

        // DRAW GAP AND CURRENT
        $pdf->SetFont('centurygothic', 'N', 22);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $html = $query['GAP_CAL'][0]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 54, $html);
        $html = $query['GAP_CAL'][1]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 65, $html);
        $html = $query['GAP_CAL'][2]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 76, $html);
        $html = $query['GAP_CAL'][3]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 105, $html);
        $html = $query['GAP_CAL'][4]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 116, $html);
        $html = $query['GAP_CAL'][5]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 127, $html);
        $html = $query['GAP_CAL'][6]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 157, $html);
        $html = $query['GAP_CAL'][7]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 167, $html);
        $html = $query['GAP_CAL'][8]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 178, $html);
        $html = $query['GAP_CAL'][9]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 209, $html);
        $html = $query['GAP_CAL'][10]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 220, $html);
        $html = $query['GAP_CAL'][11]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 231, $html);
        $html = $query['GAP_CAL'][12]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 242, $html);
        // DRAW  CURRENT

        $total_point = 0;
        $pdf->SetFont('centurygothic', 'N', 24);
        $temp = ($query['DRAW_ANSWER'][0]['IN_POINT'] + $query['DRAW_ANSWER'][1]['IN_POINT'] + $query['DRAW_ANSWER'][2]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;

        $pdf->writeHTMLCell(0, 0, 175, 64, $html);
        $temp = ($query['DRAW_ANSWER'][3]['IN_POINT'] + $query['DRAW_ANSWER'][4]['IN_POINT'] + $query['DRAW_ANSWER'][5]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 116, $html);
        $temp = ($query['DRAW_ANSWER'][6]['IN_POINT'] + $query['DRAW_ANSWER'][7]['IN_POINT'] + $query['DRAW_ANSWER'][8]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 167, $html);
        $temp = ($query['DRAW_ANSWER'][9]['IN_POINT'] + $query['DRAW_ANSWER'][10]['IN_POINT'] + $query['DRAW_ANSWER'][11]['IN_POINT'] + $query['DRAW_ANSWER'][12]['IN_POINT']) / 4;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 225, $html);
        // here
        $pdf->lastPage();
        // PAGE 10

        $pdf->AddPage();
        $pdf->SetX(20);
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        // TABLE 5

        // DRAW TABLE

        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q5.jpg', $x = 15, $y = 26, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[13]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[14]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[15]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $question_in_table = $full_question[16]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 33), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 26;
        $temp_category = $category[4]['NM_CATEGORY'];
        $pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '5. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;

        $selected = $query['DRAW_ANSWER'][13]['IN_POINT'];
        $location = $this->draw_answer(5, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][14]['IN_POINT'];
        $location = $this->draw_answer(5, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][15]['IN_POINT'];
        $location = $this->draw_answer(5, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][16]['IN_POINT'];
        $location = $this->draw_answer(5, 4, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);

        // DRAW BENCHMARK

        $selected = $query['DRAW_BENCHMARK'][13]['IN_POINT'];

        $location = $this->draw_benchmark(5, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][14]['IN_POINT'];
        $location = $this->draw_benchmark(5, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][15]['IN_POINT'];
        $location = $this->draw_benchmark(5, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][16]['IN_POINT'];
        $location = $this->draw_benchmark(5, 4, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 6
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q6.jpg', $x = 15, $y = 87, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[17]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[18]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[19]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 87;
        $temp_category = $category[5]['NM_CATEGORY'];
        $pdf->writeHTMLCell(60, 0, $x, ($y), '6. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;
        $selected = $query['DRAW_ANSWER'][17]['IN_POINT'];
        $location = $this->draw_answer(6, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][18]['IN_POINT'];
        $location = $this->draw_answer(6, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][19]['IN_POINT'];
        $location = $this->draw_answer(6, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK
        $selected = $query['DRAW_BENCHMARK'][17]['IN_POINT'];
        $location = $this->draw_benchmark(6, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][18]['IN_POINT'];
        $location = $this->draw_benchmark(6, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][19]['IN_POINT'];
        $location = $this->draw_benchmark(6, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 7
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q7.jpg', $x = 15, $y = 136, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[20]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[21]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[22]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 136;
        $temp_category = $category[6]['NM_CATEGORY'];
        $pdf->writeHTMLCell(60, 0, $x, ($y), '7. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;
        $selected = $query['DRAW_ANSWER'][20]['IN_POINT'];
        $location = $this->draw_answer(7, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][21]['IN_POINT'];
        $location = $this->draw_answer(7, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][22]['IN_POINT'];
        $location = $this->draw_answer(7, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK
        $selected = $query['DRAW_BENCHMARK'][20]['IN_POINT'];
        $location = $this->draw_benchmark(7, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][21]['IN_POINT'];
        $location = $this->draw_benchmark(7, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][22]['IN_POINT'];
        $location = $this->draw_benchmark(7, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 8
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q8.jpg', $x = 15, $y = 185, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[23]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[24]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[25]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 185;
        $temp_category = $category[7]['NM_CATEGORY'];
        $pdf->writeHTMLCell(60, 0, $x, ($y), '8. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;
        $selected = $query['DRAW_ANSWER'][23]['IN_POINT'];
        $location = $this->draw_answer(8, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][24]['IN_POINT'];
        $location = $this->draw_answer(8, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][25]['IN_POINT'];
        $location = $this->draw_answer(8, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK
        $selected = $query['DRAW_BENCHMARK'][23]['IN_POINT'];
        $location = $this->draw_benchmark(8, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][24]['IN_POINT'];;
        $location = $this->draw_benchmark(8, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][25]['IN_POINT'];
        $location = $this->draw_benchmark(8, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 9
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q9.jpg', $x = 15, $y = 235, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[26]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[27]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 235;
        $temp_category = $category[8]['NM_CATEGORY'];
        $pdf->writeHTMLCell(60, 0, $x, ($y), '9. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;
        $selected = $query['DRAW_ANSWER'][26]['IN_POINT'];
        $location = $this->draw_answer(9, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][27]['IN_POINT'];
        $location = $this->draw_answer(9, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK
        $selected = $query['DRAW_BENCHMARK'][26]['IN_POINT'];
        $location = $this->draw_benchmark(9, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][27]['IN_POINT'];
        $location = $this->draw_benchmark(9, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW GAP
        $pdf->SetFont('centurygothic', 'N', 22);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $html = $query['GAP_CAL'][13]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 37, $html);
        $html = $query['GAP_CAL'][14]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 48, $html);
        $html = $query['GAP_CAL'][15]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 59, $html);
        $html = $query['GAP_CAL'][16]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 70, $html);
        $html = $query['GAP_CAL'][17]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 98, $html);
        $html = $query['GAP_CAL'][18]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 109, $html);
        $html = $query['GAP_CAL'][19]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 120, $html);
        $html = $query['GAP_CAL'][20]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 148, $html);
        $html = $query['GAP_CAL'][21]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 159, $html);
        $html = $query['GAP_CAL'][22]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 170, $html);
        $html = $query['GAP_CAL'][23]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 196, $html);
        $html = $query['GAP_CAL'][24]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 207, $html);
        $html = $query['GAP_CAL'][25]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 218, $html);
        $html = $query['GAP_CAL'][26]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 246, $html);
        $html = $query['GAP_CAL'][27]['SUB'];
        $pdf->writeHTMLCell(20, 10, 153, 257, $html);
        // DRAW  CURRENT
        $pdf->SetFont('centurygothic', 'N', 24);
        $temp = ($query['DRAW_ANSWER'][13]['IN_POINT'] + $query['DRAW_ANSWER'][14]['IN_POINT'] + $query['DRAW_ANSWER'][15]['IN_POINT'] + $query['DRAW_ANSWER'][16]['IN_POINT']) / 4;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 53, $html);
        $temp = ($query['DRAW_ANSWER'][17]['IN_POINT'] + $query['DRAW_ANSWER'][18]['IN_POINT'] + $query['DRAW_ANSWER'][19]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 109, $html);
        $temp = ($query['DRAW_ANSWER'][20]['IN_POINT'] + $query['DRAW_ANSWER'][21]['IN_POINT'] + $query['DRAW_ANSWER'][22]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 159, $html);
        $temp = ($query['DRAW_ANSWER'][23]['IN_POINT'] + $query['DRAW_ANSWER'][24]['IN_POINT'] + $query['DRAW_ANSWER'][25]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 207, $html);
        $temp = ($query['DRAW_ANSWER'][26]['IN_POINT'] + $query['DRAW_ANSWER'][27]['IN_POINT']) / 2;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 251, $html);
        $pdf->lastPage();
        // PAGE 11
        $pdf->AddPage();
        $pdf->SetX(20);
        $pdf->SetFont('centurygothic', 'N', 17);
        $pdf->setJPEGQuality(100);
        // TABLE 10
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q10.jpg', $x = 15, $y = 26, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[28]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[29]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
        $question_in_table = $full_question[30]['NM_QUESTION'];
        $pdf->writeHTMLCell(55, 0, $x + 2.5, ($y + 11.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 26;
        $temp_category = $category[9]['NM_CATEGORY'];
        $pdf->writeHTMLCell(70, 0, $x, ($y), '10. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;
        $selected = $query['DRAW_ANSWER'][28]['IN_POINT'];
        $location = $this->draw_answer(10, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][29]['IN_POINT'];
        $location = $this->draw_answer(10, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][30]['IN_POINT'];
        $location = $this->draw_answer(10, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK
        $selected = $query['DRAW_BENCHMARK'][28]['IN_POINT'];
        $location = $this->draw_benchmark(10, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][29]['IN_POINT'];
        $location = $this->draw_benchmark(10, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][30]['IN_POINT'];
        $location = $this->draw_benchmark(10, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // TABLE 11
        // DRAW TABLE
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q11.jpg', $x = 15, $y = 77, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $pdf->SetFont('centurygothic', 'N', 11);
        $question_in_table = $full_question[31]['NM_QUESTION'];
        $pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
        $question_in_table = $full_question[32]['NM_QUESTION'];
        $pdf->writeHTMLCell(65, 0, $x + 2.5, ($y + 11.5 + 11), $question_in_table);
        $question_in_table = $full_question[33]['NM_QUESTION'];
        $pdf->writeHTMLCell(55, 0, $x + 2.5, ($y + 11.5 + 22), $question_in_table);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'B', 11);
        $x = 15;
        $y = 77;
        $temp_category = $category[10]['NM_CATEGORY'];
        $pdf->writeHTMLCell(70, 0, $x, ($y + 2.5), '11. ' . $temp_category);
        $pdf->SetTextColorArray(array(0, 0, 0));
        $pdf->SetFont('centurygothic', 'N', 12);
        // DRAW ANSWER;
        $selected = $query['DRAW_ANSWER'][31]['IN_POINT'];
        $location = $this->draw_answer(11, 1, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][32]['IN_POINT'];
        $location = $this->draw_answer(11, 2, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_ANSWER'][33]['IN_POINT'];
        $location = $this->draw_answer(11, 3, $selected);
        $pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW BENCHMARK
        $selected = $query['DRAW_BENCHMARK'][31]['IN_POINT'];
        $location = $this->draw_benchmark(11, 1, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][32]['IN_POINT'];
        $location = $this->draw_benchmark(11, 2, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $selected = $query['DRAW_BENCHMARK'][33]['IN_POINT'];
        $location = $this->draw_benchmark(11, 3, $selected);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW GAP
        $pdf->SetFont('centurygothic', 'N', 22);
        $pdf->SetTextColorArray(array(8, 112, 190));
        $html = $query['GAP_CAL'][28]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 37, $html);
        $html = $query['GAP_CAL'][29]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 48, $html);
        $html = $query['GAP_CAL'][30]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 59, $html);
        $html = $query['GAP_CAL'][31]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 88, $html);
        $html = $query['GAP_CAL'][32]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 99, $html);
        $html = $query['GAP_CAL'][33]['SUB'];
        $pdf->writeHTMLCell(10, 10, 153, 110, $html);
        // DRAW INFORMATION FOR SURVEY
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p11_total.jpg', $x = 15, $y = 127, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        $pdf->Image(base_url() . 'assets/tcpdf/img_report/p11_note_color.jpg', $x = 15, $y = 230, $w = 70, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
        // DRAW  CURRENT
        $pdf->SetFont('centurygothic', 'N', 24);
        $temp = ($query['DRAW_ANSWER'][28]['IN_POINT'] + $query['DRAW_ANSWER'][29]['IN_POINT'] + $query['DRAW_ANSWER'][30]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 48, $html);
        $temp = ($query['DRAW_ANSWER'][31]['IN_POINT'] + $query['DRAW_ANSWER'][32]['IN_POINT'] + $query['DRAW_ANSWER'][33]['IN_POINT']) / 3;
        $temp = floor($temp * 10) / 10;
        $total_point = $total_point + $temp;
        $html = $temp;
        $pdf->writeHTMLCell(0, 0, 175, 99, $html);
        $html = floor(($total_point / 11) * 10) / 10;
        $pdf->SetTextColorArray(array(255, 255, 255));
        $pdf->writeHTMLCell(0, 0, 175, 125.5, $html);
        $pdf->lastPage();
        // ---------------------------------------------------------
        //Close and output PDF document
        //
        $temp_name = $query['COMPANY_INFO'][0]['NM_COMPANY'];
        $file_name = "$temp_name.pdf";
        if (!file_exists('temp')) {
            mkdir('temp', 0777, true);
        }

        $pdf->Output('temp/' . $file_name, 'F');
    }

    /**
     * [draw_answer description]
     * @param  integer $number_table [description]
     * @param  integer $number_answer [description]
     * @param  integer $selected [description]
     * @return [type]                 [description]
     *
     * input : number table, number answer, selected
     * output : location (x, y, with, height)
     */
    public function draw_answer($number_table = 0, $number_answer = 0, $selected = 0)
    {
        if ($selected == 0) {
            $array_location = array('x' => 0, 'y' => 0, 'w' => 1, 'h' => 1);
            return $array_location;
        }
        if ($number_table == 1) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 54, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 54, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 54, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 54, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 65, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 65, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 65, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 65, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 76, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 76, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 76, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 76, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 2) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 105, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 105, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 105, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 105, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 116, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 116, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 116, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 116, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 127, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 127, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 127, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 127, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 3) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 157, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 157, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 157, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 157, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 168, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 168, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 168, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 168, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 179, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 179, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 179, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 179, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 4) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 209, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 209, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 209, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 209, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 220, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 220, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 220, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 220, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 231, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 231, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 231, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 231, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 242, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 242, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 242, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 242, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 5) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 6) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 98, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 98, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 98, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 98, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 109, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 109, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 109, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 109, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 120, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 120, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 120, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 120, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 131, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 131, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 131, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 131, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 7) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 147, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 147, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 147, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 147, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 158, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 158, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 158, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 158, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 169, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 169, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 169, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 169, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 180, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 180, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 180, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 180, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 8) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 196, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 196, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 196, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 196, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 207, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 207, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 207, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 207, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 218, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 218, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 218, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 218, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 229, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 229, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 229, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 229, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 9) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 246, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 246, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 246, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 246, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 257, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 257, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 257, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 257, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 268, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 268, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 268, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 268, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 279, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 279, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 279, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 279, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 10) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 37, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 48, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 59, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 70, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else if ($number_table == 11) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 88, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 88, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 88, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 88, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 99, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 99, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 99, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 99, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 110, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 110, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 110, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 110, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else if ($number_answer == 4) {
                if ($selected == 1) {
                    $array_location = array('x' => 82, 'y' => 121, 'w' => 16, 'h' => 12);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 82, 'y' => 121, 'w' => 33, 'h' => 12);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 82, 'y' => 121, 'w' => 49, 'h' => 12);
                    return $array_location;
                } else {
                    $array_location = array('x' => 82, 'y' => 121, 'w' => 66, 'h' => 12);
                    return $array_location;
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function draw_benchmark($number_table = 0, $number_answer = 0, $selected = 0)
    {
        if ($number_table == 1) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 57, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 57, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 57, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 57, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 68, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 68, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 68, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 68, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 79, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 79, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 79, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 79, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else if ($number_table == 2) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 108, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 108, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 108, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 108, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 119, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 119, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 119, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 119, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 130, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 130, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 130, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 130, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 141, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 141, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 141, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 141, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 3) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 160, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 160, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 160, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 160, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 171, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 171, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 171, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 171, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 182, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 182, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 182, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 182, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 193, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 193, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 193, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 193, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 4) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 212, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 212, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 212, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 212, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 223, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 223, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 223, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 223, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 234, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 234, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 234, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 234, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 245, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 245, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 245, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 245, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 5) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 6) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 101, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 101, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 101, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 101, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 112, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 112, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 112, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 112, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 123, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 123, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 123, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 123, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 134, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 134, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 134, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 134, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 7) {

            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 150, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 150, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 150, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 150, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 161, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 161, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 161, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 161, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 172, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 172, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 172, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 172, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 183, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 183, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 183, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 183, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 8) {

            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 199, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 199, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 199, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 199, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 210, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 210, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 210, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 210, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 221, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 221, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 221, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 221, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 232, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 232, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 232, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 232, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 9) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 249, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 249, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 249, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 249, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 260, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 260, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 260, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 260, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 271, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 271, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 271, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 271, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 282, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 282, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 282, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 282, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 10) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 40, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 51, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 62, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 73, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else if ($number_table == 11) {
            if ($number_answer == 1) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 91, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 91, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 91, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 91, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 2) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 102, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 102, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 102, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 102, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else if ($number_answer == 3) {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 113, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 113, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 113, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 113, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            } else {
                if ($selected == 1) {
                    $array_location = array('x' => 87, 'y' => 124, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 2) {
                    $array_location = array('x' => 104, 'y' => 124, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 3) {
                    $array_location = array('x' => 121, 'y' => 124, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else if ($selected == 4) {
                    $array_location = array('x' => 138, 'y' => 124, 'w' => 5, 'h' => 5);
                    return $array_location;
                } else {
                    return null;
                }
            }
        } else {
        }
    }
}
