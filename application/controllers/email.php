<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Email controller.
 *
 */
class Email extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library('session');
        $this->load->library('phpmailer');
    }

    public function index()
    {

    }

    /**
     * [sendmail description]
     * @param  string $arraymail [description]
     *         string $arraymail['subject'] [description]
     *         string $arraymail['to'] [description]
     *         string $arraymail['body'] [description]
     * @return [type]            [description]
     */
    public function send_mail($array_mail = array(), $path_attach = null)
    {
        if (!empty($array_mail)) {

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Port = PORT;
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 2;
            $mail->SMTPSecure = SMTPSECURE;
            $mail->SMTPAuth = true; // OR SSL
            $mail->Host = HOST_MAIL;
            $mail->SMTPAuth = true;
            $mail->Username = USERNAME;
            $mail->Password = PASSWORD;
            $mail->From = USERNAME;
            $mail->FromName = USERNAME;
            $mail->Sender = USERNAME;
            $mail->Subject = $array_mail['SUBJECT'];
            $mail->AddAddress($array_mail['TO']);
            $mail->Body = $array_mail['BODY'];
            $mail->IsHTML(true);
            if ($path_attach != null) {
                $mail->AddAttachment($path_attach['link'], $path_attach['name']);
            }
            // switch ($type) {
            // 	case 'forgot_password':
            // 		$mail->AltBody = ALT_BODY_FORGOT_PASSWORD;
            // 		break;
            // 	case 'forgot_username':
            // 		$mail->AltBody = ALT_BODY_FORGOT_ID;
            // 		break;
            // 	case 'active_account':

            // 		$mail->AltBody = ALT_BODY_ACTIVE_ACCOUNT;
            // 		break;
            // 	case 'weekly_notification':
            // 		$mail->AltBody = ALT_BODY_WEEKLY_NOTIFICATION;
            // 		break;
            // 	case 'complete_when_finish_survey':
            // 		$mail->AltBody = ALT_BODY_FINISH_SURVEY_NOTIFICATION;
            // 		$mail->AddAddress(ADMIN_MAIL);
            // 		break;
            // 	case 'complete_when_finish_report':
            // 		$mail->AltBody = ALT_BODY_REPORT_NOTIFICATION;
            // 		$mail->AddAddress(ADMIN_MAIL);
            // 		break;
            // 	default:
            // 		return false;
            // 		break;
            // }
            if ($mail->Send()) {
                return true;

            } else {
                return false;

            }
        } else {

            return false;

        }
    }
}