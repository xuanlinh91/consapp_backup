<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::__configure();

        $this->load->library('session');
        $this->load->file("application/controllers/email.php", false);
        $this->load->file("application/controllers/parse.php", false);
        $this->load->model('t_user');
        $this->load->file(APPPATH . 'models/form_validation/user_rules.php', false);
        $this->load->helper('email');
        $this->load->helper('mss');
    }

    /**
     * [index Check and redirect interface for user]
     * @return [interface] [return interface follow with user role]
     */
    public function index()
    {
        $this->set_page_title("Accounts Management");
        $this->check_role(array(ROLE_ADMIN), 0);
        $this->delete_session_rubish();
        $this->view('default', 'users/menu', $this->data);
    }

    /**
     * [check_login check data login]
     * @return [type] [set session and redirect to view with user role]
     *
     */
    public function check_login()
    {
        if ($this->input->post() && $this->input->post('action') == 'Login') {
            $this->load->library('form_validation');
            $login_rules = array(
                array(
                    'field' => 'ID_LOGIN',
                    'label' => 'User Name',
                    'rules' => 'required|max_length[50]'
                ),
                array(
                    'field' => 'EN_PASSWORD',
                    'label' => 'Password',
                    'rules' => 'required|max_length[128]'
                )
            );
            $this->form_validation->set_rules($login_rules);
            if ($this->form_validation->run()) {
                $id_login = ($this->input->post('ID_LOGIN'));
                $password = ($this->input->post('EN_PASSWORD'));

                $this->load->model('t_user');
                $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $id_login));
                if (count($query_result)) {
                    $data = $query_result[0];
                    if ($data['EN_PASSWORD'] == md5($password)) {
                        if ($data['IN_ACTIVE'] == "0") {
                            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            $this->session->set_userdata('error_flag_code', 1);
                            $this->session->set_userdata('error_mess_code', "Your account is not active, please check your email for activation or <a href='" . site_url('users/send_active_email') . '/' . $id_login . '/' . $data['ID_USER'] . '/false' . "'>click here</a> to resend activation email");
                             $this->session->set_userdata('ID_LOGIN', $id_login);
                            $this->session->set_userdata('error_timeout', 300000);
                            $segment = array($this->router->class, 'login');
                            $this->redirect($segment);
                        } else {
                            $userdata = $this->session->userdata(USER_SESSION_KEY);
                            if (!empty($userdata) && $data['ID_LOGIN'] != $userdata['ID_LOGIN'] ) {
                                $this->session->unset_userdata(USER_SESSION_KEY);
                                $this->session->unset_userdata('ROLE');
                                $this->session->sess_destroy();
                                $this->session->set_userdata('ROLE', MY_Controller::get_user_role());
                                $this->session->set_userdata(USER_SESSION_KEY, $data);
                                $this->update_last_login($data['ID_USER']);
                                $segment = array('home', 'index');
                                $this->redirect($segment);
                            } else {
                                if ($data['TX_SECURITY_CODE'] == NULL) {
                                    $this->t_user->update_data_by_property(array("TX_SECURITY_CODE" => md5($password)));
                                    $segment = array('users', 'force_change_password', $data['ID_LOGIN'], $password);
                                    $this->redirect($segment);
                                } else {
                                    $this->save_session_login($data);
                                    $this->update_last_login($data['ID_USER']);
                                    $this->session->set_userdata('ROLE', MY_Controller::get_user_role());
                                    $segment = array('home', 'index');
                                    $this->redirect($segment);
                                }
                            }
                        }
                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 0);
                        $list_of_errors = array(
                            array(
                                'id' => 'EN_PASSWORD',
                                'content' => '<span class="text-danger custom-error-message">'.$this->lang->line('invalid_password').'</span>'
                            )
                        );
                        $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                        $this->session->set_userdata('error_mess_code', 'Password does not match');
                        $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
                        $segment = array($this->router->class, 'login');
                        $this->redirect($segment);
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 0);
                    $list_of_errors = array(
                        array(
                            'id' => 'ID_LOGIN',
                            'content' => '<span class="text-danger custom-error-message">'.$this->lang->line('invalid_username').'</span>'
                        )
                    );
                    $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                    $this->session->set_userdata('error_mess_code', 'Username does not exit');
                    $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
                    $segment = array($this->router->class, 'login');
                    $this->redirect($segment);
                }
            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 0);
                $list_of_errors = validate_load($login_rules);
                $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                $this->session->set_userdata('error_mess_code', validation_errors());
                if ($this->input->post('ID_LOGIN')) {
                    $temp = $this->input->post('ID_LOGIN');
                     $this->session->set_userdata('ID_LOGIN', $temp);
                }

                $segments = array($this->router->class, 'login');
                $this->redirect($segments);
            }
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Page not found. You can not access this url!';
            $this->display_error($this->data);
        }
    }

    public function update_last_login($id = null)
    {
        if (!empty($id)) {
            $this->load->model('t_user');
            //date_default_timezone_set(TIME_ZONE);
            $time = date("Y-m-d H:i:s");
            $this->t_user->update_data_by_property(array("DT_LAST_LOGIN" => $time), array("ID_USER" => $id));
            //$this->delete_session_rubish();
        } else {

            return false;
        }
    }

    public function login()
    {
        if ($this->session->userdata(USER_SESSION_KEY)) {
            $this->redirect_login();
        } else {
            if ($this->session->userdata('ID_LOGIN')) {
                $temp = $this->session->userdata['ID_LOGIN'];
                $this->data['ID_LOGIN'] = $temp;
                $this->session->unset_userdata('ID_LOGIN');
            }
            $this->set_page_title("Login");
            $this->view('default', 'users/login', $this->data);
        }
    }

    /**
     * [random_password description]
     * @return string [description]
     * format same : Abc1a5g - Lenght = 9
     * with create active code
     */
    public function random_password()
    {
        mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 9);

        return $uuid;
    }

    public function logout()
    {
        if ($this->session->userdata(USER_SESSION_KEY)) {
            $this->session->sess_destroy();
            $segment = array($this->router->class, 'login');
            $this->redirect($segment);
        } else {
            $segment = array($this->router->class, 'login');
            $this->redirect($segment);
        }
    }

    /**
     * [save_session_login description]
     * @param  string $sessionArray [description]
     * @return [type]               [description]
     * save session
     */
    public function save_session_login($session_array = null)
    {
        unset($session_array['EN_PASSWORD']);
        unset($session_array['TX_ACTIVE_CODE']);
        unset($session_array['TX_SECURITY_CODE']);
        return $this->session->set_userdata(USER_SESSION_KEY, $session_array);
    }

    /**
     * [redirect_login description]
     * @return [type] [description]
     *  redirect to page from role
     */
    public function redirect_login()
    {
        if ($this->session->userdata(USER_SESSION_KEY)) {
            if ($this->is_login()) {
                $segment = array('home', 'index');
                $this->redirect($segment);
            } else {
                $this->session->sess_destroy();
                unset($this->session->userdata);
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 1);
                $this->session->set_userdata('error_mess_code', 'Unable to identify your account');
                $segment = array($this->router->class, 'login');
                $this->redirect($segment);
            }
        }
    }

    /**
     * [forgot_id description]
     * @return [type] [description]
     *  redirect to page forgot id
     */
    public function forgot_id()
    {
        if ($this->is_login()) {
            $segment = array($this->router->class, 'login');
            $this->redirect($segment);
        } else {
            $post = $this->input->post();
            if ($post['action'] == 'Confirm') {
                $id = $post['TX_USEREMAIL'];
                $this->load->library('form_validation');
                $this->form_validation->set_rules('TX_USEREMAIL', 'Email', 'trim|required|valid_email');
                if ($this->form_validation->run()) {
                    $check = $this->t_user->get_data_by_property('*', array('TX_USEREMAIL' => $id));
                    if (count($check) > 0) {
                        $segment = array($this->router->class, 'send_mail_contain_id', $check[0]['ID_USER'], true);
                        $this->redirect($segment);

                    } else {
                        $this->session->set_userdata('FORGOT_ID', $this->input->post());
                        $this->noti('Email does not exist!');
                        $segment = array($this->router->class, 'forgot_id');
                        $this->redirect($segment);
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 0);
                    $ext_field = array(
                        array(
                            'field' => 'TX_USEREMAIL',
                            'label' => 'Email'
                        )
                    );

                    $ext_field = validate_load($ext_field);
                    $this->session->set_userdata('list_of_errors', json_encode($ext_field));
                    $this->session->set_userdata('error_mess_code', validation_errors());
                    $this->session->set_userdata('FORGOT_ID', $this->input->post());
                    $segment = array($this->router->class, 'forgot_id');
                    $this->redirect($segment);
                }
            } elseif ($this->session->userdata('FORGOT_ID')) {
                $temp = $this->session->userdata('FORGOT_ID');
                $this->data['TX_USEREMAIL'] = $temp['TX_USEREMAIL'];
                $this->session->unset_userdata('FORGOT_ID');

            }

            $this->set_page_title("Forgot username");
            $this->view('default', 'users/forgot_id', $this->data);

        }
    }

    /**
     * [forgot_id description]
     * @return [type] [description]
     *  redirect to page forgot password
     */
    public function send_active_email($id, $id_user, $redirect)
    {
        $this->load->model('t_user');
        $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $id));
        $user_mail = $query_result[0]['TX_USEREMAIL'];
        if (count($query_result)) {
            $this->load->model('t_email_template');
            $get_parse_email = new ParserCompany();
            $random_code = $this->random_password();
            $password = $this->random_password();
            $user_name = $query_result[0]['USER_NAME'];
            $this->t_user->update_data_by_id(array("TX_ACTIVE_CODE" => $random_code), $id_user);
            $data = array("TX_PASSWORD" => $password, "TX_USER_NAME" => $user_name, "LINK_ACTIVE" => site_url() . '/users/active_account/' . $id_user . '/' . $random_code, "TX_USERNAME" => $id, "HOME_PAGE" => "javascript:void(0);", "ALT_BODY" => ALT_BODY_ACTIVE_ACCOUNT, "LOGIN_PAGE" => site_url() . '/users/login');
            $get_parse_email->send_active_code($data);
            $parse_email = $get_parse_email->public_template['template'];
            $parse_subject = $get_parse_email->public_template['subject'];
            if (!empty($parse_email) && !empty($parse_subject)) {
                $sendemail = new Email();
                $arraymail = array('SUBJECT' => $parse_subject,
                    'TO' => $user_mail,
                    'BODY' => $parse_email
                );
                $this->t_user->update_data_by_property(array("TX_SECURITY_CODE" => md5($random_code), 'EN_PASSWORD' => md5($password)), array("ID_LOGIN" => $id));
                if ($sendemail->send_mail($arraymail)) {
                    $this->noti('Your active email has been sent to your mailbox.', 'success');
                    if ($redirect == true) {
                        $segment = array($this->router->class, 'login');
                        $this->redirect($segment);
                    }
                } else {
                    $this->noti('Process to send email errors, please try again.', 'error');
                }
            } else {
                $this->noti('Process to send email errors, please try again.', 'error');
            }
        } else {
            $this->noti('Email_not_exist', 'error');
            $segment = array($this->router->class, 'filters');
            $this->redirect($segment);
        }
    }

    public function active_account($id, $active_code)
    {
        if ($this->is_login()) {

            $this->noti('Please logout to active this account!');
            $segment = array($this->router->class, 'login');
            $this->redirect($segment);
        } else {
            if (isset($id) && isset($active_code)) {
                $this->load->model('t_user');
                $query_result = $this->t_user->get_data_by_property('*', array('ID_USER' => $id));
                if (count($query_result) > 0) {
                    if ($query_result[0]['IN_ACTIVE'] == 1) {
                        $this->noti('Account already activated!');
                        $segment = array($this->router->class, 'login');
                        $this->redirect($segment);
                    } else
                        if ($query_result[0]['TX_ACTIVE_CODE'] == $active_code) {
                            $this->t_user->update_data_by_id(array("IN_ACTIVE" => 1), $query_result[0]['ID_USER']);
                            $this->noti('Account active successfully!', 'success');
                            $segment = array($this->router->class, 'login');
                            $this->redirect($segment);
                        } else {
                            $this->noti('Account active failed! Wrong active code.');
                            $segment = array($this->router->class, 'login');
                            $this->redirect($segment);
                        }
                } else {
                    $this->noti('Account active failed!');
                    $segment = array($this->router->class, 'login');
                    $this->redirect($segment);
                }
            }
        }

    }

    public function forgot_password()
    {
        if ($this->is_login()) {
            $segment = array($this->router->class, 'logout');
            $this->redirect($segment);
        } else {
            $post = $this->input->post();
            if ($post['action'] == 'Confirm') {
                $id = $post['ID_LOGIN'];
                $this->load->library('form_validation');
                $this->form_validation->set_rules('ID_LOGIN', 'Username', 'trim|required|max_length[50]|custom_validate_user_id');
                if ($this->form_validation->run()) {
                    $check = $this->t_user->get_data_by_property('*', array('ID_LOGIN' => $id));
                    if (count($check) > 0) {
                        $segment = array($this->router->class, 'send_mail_contain_password', $check[0]['ID_USER'], true);
                        $this->redirect($segment);

                    } else {
                        $this->session->set_userdata('FORGOT_PASSWORD', $this->input->post());
                        $this->noti('User name does not exist!');
                        $segment = array($this->router->class, 'forgot_password');
                        $this->redirect($segment);
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 0);
                    $ext_field = array(
                        array(
                            'field' => 'ID_LOGIN',
                            'label' => 'Username'
                        )
                    );

                    $ext_field = validate_load($ext_field);
                    $this->session->set_userdata('list_of_errors', json_encode($ext_field));
                    $this->session->set_userdata('error_mess_code', validation_errors());
                    $this->session->set_userdata('FORGOT_PASSWORD', $this->input->post());
                    $segment = array($this->router->class, 'forgot_password');
                    $this->redirect($segment);
                }
            } else {
                if ($this->session->userdata('FORGOT_PASSWORD')) {
                    $temp = $this->session->userdata('FORGOT_PASSWORD');
                    $this->data['user_name'] = $temp['ID_LOGIN'];
                    $this->session->unset_userdata('FORGOT_PASSWORD');

                }
            }
            $this->set_page_title("Forgot password");
            $this->view('default', 'users/forgot_password', $this->data);
        }


    }

    /**
     * [send_mail_contain_id description]
     * @return [type] [description]
     * Send email with id to usermail
     */
    public function send_mail_contain_id($id_user = null, $redirect = false)
    {
        if ($this->is_login()) {
            $segment = array($this->router->class, 'login');
            $this->redirect($segment);
        } else {

            $check = $this->t_user->get_data_by_property('*', array('ID_USER' => $id_user));
            $email = $check[0]['TX_USEREMAIL'];
            if ($email) {
                $this->load->model('t_user');
                $query_result = $this->t_user->get_data_by_property('*', array("TX_USEREMAIL" => $email));
                $this->load->model('t_email_template');
                $get_parse_email = new ParserCompany();
                $data = array("ID_LOGIN" => $query_result[0]['ID_LOGIN'], "LINK_LOGIN" => site_url() . '/users/logout', "HOME_PAGE" => "javascript:void(0);", "ALT_BODY" => ALT_BODY_FORGOT_ID);
                $get_parse_email->send_id($data);
                $parse_email = $get_parse_email->public_template['template'];
                $parse_subject = $get_parse_email->public_template['subject'];
                if (!empty($parse_email) && !empty($parse_subject)) {
                    $sendemail = new Email();
                    $arraymail = array('SUBJECT' => $parse_subject, 'TO' => $email, 'BODY' => $parse_email);
                    if ($sendemail->send_mail($arraymail)) {
                        $this->noti($this->lang->line('username_has_sent'), 'success');
                        $segment = array($this->router->class, 'login');
                        $this->redirect($segment);
                    } else {
                        return;
                        $this->noti('Process to send email errors1, please try again.');
                        $this->session->set_userdata('TX_USEREMAIL', $email);
                        $segment = array($this->router->class, 'forgot_id');
                        $this->redirect($segment);
                    }
                } else {
                    $this->noti('Process to send email errors2, please try again.');
                    $this->session->set_userdata('TX_USEREMAIL', $email);
                    $segment = array($this->router->class, 'forgot_id');
                    $this->redirect($segment);
                }
            } else {
                $this->set_page_title("ERROR");
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'Page not found. You can not access this url!';
                $this->display_error($this->data);
            }
        }
    }

    /**
     * [send_mail_contain_password description]
     * @return [type] [description]
     * Send email with password to usermail
     */
    public function send_mail_contain_password($id_user = null, $redirect = false)
    {
        if (isset($id_user) && $id_user != null) {
            $query_result = $this->t_user->get_data_by_property('*', array("ID_USER" => $id_user));
            $temp = $query_result[0]['ID_LOGIN'];
            $this->session->set_userdata('ID_LOGIN', $temp);
        } else {
            $this->load->library('form_validation');
            $temp = $this->input->post('ID_LOGIN');
            $this->session->set_userdata('ID_LOGIN', $temp);
            $username = trim($temp);
            $this->load->model('t_user');
            $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $username));
            if ($temp) {
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 0);
                    $list_of_errors = array();
                    array_push($list_of_errors, array(
                        'id' => 'ID_LOGIN',
                        'content' => $this->lang->line('invalid_username')
                    ));
                    $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
                    $this->session->set_userdata('error_mess_code', validation_errors());
                    $segments = array($this->router->class, 'forgot_password');
                    $this->redirect($segments);
                }
            }
        }
        if (count($query_result) < 1) {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', $this->lang->line('username_not_exist'));
            $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
            $segment = array($this->router->class, 'forgot_password');
            $this->redirect($segment);
            return;
        }

        $username = $query_result[0]['ID_LOGIN'];
        if (count($query_result)) {
            $this->load->model('t_email_template');
            $get_parse_email = new ParserCompany();
            $random_code = $this->random_password();
            $data = array("TX_SECURITY_CODE" => $random_code, "LINK_CHANGEPASSWORD" => site_url() . '/users/force_change_password/' . $username . '/' . $random_code, "TX_USERNAME" => $username, "HOME_PAGE" => "javascript:void(0);", "ALT_BODY" => ALT_BODY_FORGOT_PASSWORD, "LOGIN_PAGE" => site_url() . '/users/logout');
            $get_parse_email->send_password($data);
            $parse_email = $get_parse_email->public_template['template'];
            $parse_subject = $get_parse_email->public_template['subject'];
            if (!empty($parse_email) && !empty($parse_subject)) {
                $sendemail = new Email();
                $arraymail = array('SUBJECT' => $parse_subject,
                    'TO' => $query_result[0]['TX_USEREMAIL'],
                    'BODY' => $parse_email
                );
                if ($sendemail->send_mail($arraymail)) {
                    if ($this->t_user->update_data_by_property(array('TX_SECURITY_CODE' => md5($random_code)), array("ID_LOGIN" => $username))) {
                        $this->session->set_userdata('type_mess_code', SUCCESS_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', 'Your new password has been sent to your mailbox.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->unset_userdata('TX_USEREMAIL');
                        if ($this->input->post('ID_LOGIN')) {
                            $segment = array($this->router->class, 'login');
                            $this->redirect($segment);
                        }
                        if ($redirect == true) {
                            $segment = array($this->router->class, 'login');
                            $this->redirect($segment);
                        }

                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('error_mess_code', 'An error in the database, please try again after few minutes');
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('error_mess_code', 'Process to send email errors 1, please try again');
                    $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
                }
            } else {
                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                $this->session->set_userdata('error_flag_code', 1);
                $this->session->set_userdata('error_mess_code', 'Process to send email errors 2, please try again');
                $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
            }
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 1);
            $this->session->set_userdata('error_mess_code', $this->lang->line('email_not_exist'));
            $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
        }
    }

    public function send_new_password($id_user = null)
    {
        if (isset($id_user) && $id_user != null) {
            $query_result = $this->t_user->get_data_by_property('*', array("ID_USER" => $id_user));
        }

        $username = $query_result[0]['ID_LOGIN'];
        if (count($query_result)) {
            $this->load->model('t_email_template');
            $get_parse_email = new ParserCompany();
            $random_code = $this->random_password();
            $data = array("TX_SECURITY_CODE" => $random_code, "TX_USERNAME" => $username, "HOME_PAGE" => "javascript:void(0);", "ALT_BODY" => ALT_BODY_FORGOT_PASSWORD);
            $get_parse_email->send_new_password($data);
            $parse_email = $get_parse_email->public_template['template'];
            $parse_subject = $get_parse_email->public_template['subject'];
            if (!empty($parse_email) && !empty($parse_subject)) {
                $sendemail = new Email();
                $arraymail = array('SUBJECT' => $parse_subject,
                    'TO' => $query_result[0]['TX_USEREMAIL'],
                    'BODY' => $parse_email
                );
                if ($sendemail->send_mail($arraymail)) {
                    if ($this->t_user->update_data_by_property(array("TX_SECURITY_CODE" => md5($random_code), 'EN_PASSWORD' => md5($random_code)), array("ID_LOGIN" => $username))) {
                        $this->noti('Your new password has been send to mailbox.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->unset_userdata('TX_USEREMAIL');
                        if ($this->input->post('ID_LOGIN')) {
                            $segment = array($this->router->class, 'login');
                            $this->redirect($segment);
                        }
                    } else {
                        $this->noti('Process to send email errors, please try again.');
                    }
                } else {
                    $this->noti('An error in the database, please try again after few minutes.');
                    $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
                    $segment = array($this->router->class, 'forgot_password');
                    $this->redirect($segment);
                }
            } else {
                $this->noti('Process to send email errors, please try again.');
                $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
                $segment = array($this->router->class, 'forgot_password');
                $this->redirect($segment);
            }
        } else {
            $this->noti($this->lang->line('email_not_exist'));
            $this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));
            $segment = array($this->router->class, 'forgot_password');
            $this->redirect($segment);
        }
    }

    /**
     * [force_change_password description]
     * @return [type] [description]
     * view change  password
     */
    public function force_change_password($id_login = null, $active_code = null)
    {
        if ($this->is_login()) {
            $this->noti('Please log out to change password!', 'error');
            $segment = array($this->router->class, 'login');
            $this->redirect($segment);
        } else {
            if (!empty($active_code) && strlen($active_code) == 9 && !empty($id_login)) {
                $this->load->model('t_user');
                $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $id_login));
                if (count($query_result)) {
                    $data = $query_result[0];
                    $id_login_up = strtoupper(trim($id_login));
                    if (strtoupper(trim($data['ID_LOGIN'])) == $id_login_up && $data['TX_SECURITY_CODE'] == md5($active_code)) {
                        $this->session->set_userdata('ID_LOGIN', $id_login);
                        $this->session->set_userdata('TX_SECURITY_CODE', $active_code);
                        // auto chang current password
                        $this->data['ID_LOGIN'] = $id_login;
                        $this->data['TX_SECURITY_CODE'] = $active_code;
                        $this->view('default', 'users/change_password', $this->data);
                    } else {
                        $this->data['title'] = 'Error access!';
                        $this->data['message'] = 'Page not found. Please check the link again!';
                        $this->display_error($this->data);
                    }
                } else {
                    $this->data['title'] = 'Error access!';
                    $this->data['message'] = 'Page not found. You can not access this url!';
                    $this->display_error($this->data);
                }
            } else if ($this->session->userdata('TX_SECURITY_CODE') && $this->session->userdata('ID_LOGIN')) {
                $active_code = $this->session->userdata['TX_SECURITY_CODE'];
                $id_login = $this->session->userdata['ID_LOGIN'];
                $this->load->model('t_user');
                $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $id_login));
                if (count($query_result)) {
                    $data = $query_result[0];
                    if ($data['ID_LOGIN'] == $id_login && $data['TX_SECURITY_CODE'] == md5($active_code)) {
                        $this->session->set_userdata('ID_LOGIN', $id_login);
                        $this->session->set_userdata('TX_SECURITY_CODE', $active_code);
                        $this->view('default', 'users/change_password', $this->data);
                    } else {
                        $this->data['title'] = 'Error access!';
                        $this->data['message'] = 'Page not found. Please check the link again!';
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
    }

    /**
     * [change_password description]
     * @return [type] [description]
     * CONTINUE.... 29/03/2014 19:16
     * NEXT BEGIN : 21:00 current day
     */
    public function change_password()
    {
        if ($this->input->post()) {
            if ($this->input->post('ID_LOGIN') && $this->input->post('TX_SECURITY_CODE')) {
                $username = trim($this->input->post('ID_LOGIN'));
                $security_code = $this->input->post('TX_SECURITY_CODE');
                $this->load->library('form_validation');
                $this->form_validation->set_rules(User_rules::get_change_password_rules());
                if ($this->form_validation->run()) {
                    $id_login = trim($this->input->post('ID_LOGIN'));
                    $security_code = trim($this->input->post('TX_SECURITY_CODE'));
                    $new_password = trim($this->input->post('NEW_PASSWORD'));
                    $cofirm_password = trim($this->input->post('CONFIRM_NEW_PASSWORD'));
                    if (strpos($id_login, " ") != 0) {
                        $this->noti('Don\'t Alow Blank Character in Username.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                        $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                        $this->redirect($segment);

                        return;
                    }

                    if ($this->check_valid_password($new_password) == false) {
                        $this->noti('Password must be contain alpha and numeric.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                        $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                        $this->redirect($segment);
                        return;
                    }

                    if (strpos($security_code, " ") != 0) {
                        $this->noti('Don\'t Alow Blank Character in Security Code.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                        $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                        $this->redirect($segment);
                        return;
                    }

                    if (strpos($new_password, " ") != 0) {
                        $this->noti('Don\'t Alow Blank Character in New Password.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                        $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                        $this->redirect($segment);
                        return;
                    }
                    if (strpos($cofirm_password, " ") != 0) {
                        $this->noti('Don\'t Allow Blank Character in Confirm New Password.');
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                        $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                        $this->redirect($segment);
                        return;
                    }
                    if ($new_password == $cofirm_password) {
                        $this->load->model('t_user');
                        $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $id_login));
                        if (count($query_result)) {
                            $data = $query_result[0];
                            if ($data['TX_SECURITY_CODE'] == md5($security_code)) {
                                $this->load->model('t_user');
                                $new_security_password = $this->random_password();
                                if ($this->t_user->update_data_by_property(array("EN_PASSWORD" => md5($new_password), "TX_SECURITY_CODE" => md5($new_security_password)), array("ID_LOGIN" => $id_login))) {
                                    $this->noti('Change password success, please login.', 'success');
                                    $this->session->set_userdata('ID_LOGIN', $id_login);
                                    //$this->session->set_userdata('EN_PASSWORD', $new_password);
                                    $this->session->set_userdata('error_mess_code', 'Your password had changed susccessful');
                                    $this->session->unset_userdata('ID_LOGIN');
                                    $this->session->unset_userdata('EN_PASSWORD');
                                    $new_pass = $new_password;
                                    // autologin
                                    $query_result = $this->t_user->get_data_by_property('*', array("ID_LOGIN" => $id_login, "EN_PASSWORD" => md5($new_password)));
                                    if (count($query_result) > 0) {
                                        $data = $query_result[0];
                                        $segment = array($this->router->class, 'login');
                                        $data['token'] = $this->create_token();
                                        $this->save_session_login($data);
                                        $this->update_last_login($this->session->userdata[USER_SESSION_KEY]['ID_USER']);
                                        $this->session->set_userdata('ROLE', MY_Controller::get_user_role());
                                        $segment = array('home', 'index');
                                        $this->redirect($segment);
                                    } else {
                                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                        $this->session->set_userdata('error_flag_code', 1);
                                        $this->session->set_userdata('error_mess_code', 'Can\'t found login information. Please login again.');
                                        $segment = array($this->router->class, 'login');
                                        $this->redirect($segment);
                                    }
                                } else {
                                    $this->session->set_userdata('ID_LOGIN', $username);
                                    $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                    $this->session->set_userdata('error_flag_code', 1);
                                    $this->session->set_userdata('error_mess_code', 'Change Password failed, please retry');
                                    $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                                    $this->redirect($segment);
                                }
                            } else {
                                $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                                $this->session->set_userdata('error_flag_code', 1);
                                $this->session->set_userdata('error_mess_code', 'The security code does not match');
                                $this->session->set_userdata('ID_LOGIN', $username);
                                $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                                $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                                $this->redirect($segment);
                            }
                        } else {
                            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                            $this->session->set_userdata('error_flag_code', 1);
                            $this->session->set_userdata('error_mess_code', 'Username does not exits');
                            $this->session->set_userdata('ID_LOGIN', $username);
                            $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                            $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                            $this->redirect($segment);
                        }
                    } else {
                        $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                        $this->session->set_userdata('error_flag_code', 1);
                        $this->session->set_userdata('ID_LOGIN', $username);
                        $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                        $this->session->set_userdata('error_mess_code', 'Confirm password does not match!');
                        $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                        $this->redirect($segment);
                    }
                } else {
                    $this->session->set_userdata('type_mess_code', ERROR_CLASS);
                    $this->session->set_userdata('error_flag_code', 1);
                    $this->session->set_userdata('ID_LOGIN', $username);
                    $this->session->set_userdata('TX_SECURITY_CODE', $security_code);
                    $this->session->set_userdata('error_mess_code', validation_errors());
                    $segment = array($this->router->class, 'force_change_password/' . $username . '/' . $security_code);
                    $this->redirect($segment);
                }
            } else {
                $this->data['title'] = 'Error access!';
                $this->data['message'] = 'Data not valid. You can not access this url!';
                $this->display_error($this->data);
            }
        } else {
            $this->data['title'] = 'Error access!';
            $this->data['message'] = 'Page not found. You can not access this url!';
            $this->display_error($this->data);
        }
    }

    public function check_valid_password($str = '')
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return true;
        }

        return false;
    }

    public function check_data_login_ajax()
    {
        if ($this->input->post()) {
            $id_temp = $this->input->post('id_login');
            $pass_temp = $this->input->post('passwd');
            $this->load->model('t_user');
            $query_result = $this->t_user->get_data_by_property('*', array('ID_LOGIN' => $id_temp));
            if (count($query_result) > 0) {
                if (md5($pass_temp) == $query_result[0]['EN_PASSWORD'] || md5($pass_temp) == $query_result[0]['TX_SECURITY_CODE']) {
                    echo '1'; // SUSSCESS
                    return;
                } else {
                    echo '2'; // WRONG PASS
                    return;
                }
            } else {
                echo '0'; // ID_LOGIN DOES NOT EXIST
                return;
            }
        } else {
            echo '3'; // LOST DATA
            return;
        }
    }

    public function get_user_to_take($offset = null, $start = null)
    {
        $this->db->select('t_user.id_user,t_user.id_login, t_user.in_admin, t_user.in_consultant, t_user.in_user');
        $this->db->from('t_user');
        $this->db->limit($offset, $start);
        $query = $this->db->get();
        $query = $query->result_array();
        if (count($query) > 0) {
            return $query;
        } else {
            return null;
        }
    }

    public function get_count_user()
    {
        $this->db->select('*');
        $this->db->from('t_user');
        $query = $this->db->get();
        $query = $query->result_array();
        return count($query);
    }

    public function create_ac($tid = null)
    {
        $this->check_role(array(1), 0);
        $this->load->model('t_user');
        $this->load->model('t_org_mapping');
        $this->load->model('t_role');
        $this->load->model('t_participants_info');
        $option = array();
        foreach ($this->t_role->get_data() as $role) {
            $val = $role['ID'];
            $option[$val] = $role['NM_ROLE'];
        }

        $this->data['role_info'] = $option;
        $option = array();
        foreach ($this->t_org_mapping->get_data() as $org) {
            $val = $org['NM_AGENCY'];
            $option[$val] = $org['NM_AGENCY'];
        }
        $this->data['org_info'] = $option;
        $this->data['org_checked'] = '';

        if ($this->session->userdata('UPDATE_PART')) {
            foreach ($this->session->userdata('UPDATE_PART') as $key => $value) {
                $this->data[$key] = $value;
            }
            $temp = $this->session->userdata('UPDATE_PART');
            unset($this->session->userdata['UPDATE_PART']);
            $this->data['org_checked'] = $temp['nm_organisation'];
            $this->data['role_checked'] = $temp['user_role'];

        } else {
            if ($tid != null) {
                $this->data['user_info'] = $this->t_participants_info->get_data_by_property('*', array('ID' => $tid));
                $this->data['role_checked'] = 3;
                $this->data['org_checked'] = $this->data['user_info']['0']['NM_ORGANISATION'];
            }
        }

        $this->view('default', 'participants/create', $this->data);
    }

    public function create_ac_submit()
    {
        $this->check_role(array(1), 0);
        $record = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules(User_rules::create_user_rules());
        $this->form_validation->set_rules('id_login', 'User ID', 'trim|required|max_length[50]|callback_custom_validate_user_id|callback_create_unique_user[t_user.ID_LOGIN.' . $record['id_user'] . ']');
        $this->form_validation->set_rules('tx_useremail', 'Email', 'trim|required|max_length[100]|xss_clean|valid_email|callback_create_unique_email[t_user.TX_USEREMAIL.' . $record['id_user'] . ']');
        if ($this->form_validation->run()) {

            $this->load->model('t_user');
            // New user create here
            unset($record['id_participant']);
            $time = date("Y-m-d H:i:s");
            $record['dt_created'] = $time;
            $result = $this->t_user->set_data($record);
            $this->send_active_email($record['id_login'], $result, false);
            $this->noti('User create successfully.', 'success');
            $segments = array('users', 'filters');
            $this->redirect($segments);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $list_of_errors = array();
            $ext_field = array(
                array(
                    'field' => 'id_login',
                    'label' => 'Username'
                ),
                array(
                    'field' => 'tx_useremail',
                    'label' => 'Email'
                )
            );

            $list_of_errors = validate_load(User_rules::create_user_rules());
            array_push($list_of_errors, validate_load($ext_field));
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('error_mess_code', validation_errors());
            $this->session->set_userdata('UPDATE_PART', $this->input->post());
            $temp = $this->session->userdata['UPDATE_PART'];
            $segment = array($this->router->class, 'create_ac');
            $this->redirect($segment);
        }
    }

    public function admin_participants_update_form($pid = null)
    {
        $this->load->model('t_participants_info');
        $this->load->model('t_organisation');
        $this->load->model('t_role');
        $data = array();
        if ($pid != null) {
            $data['user_info'] = $this->t_participants_info->get_data_by_property('*', array('id' => $pid));
        }

        $option = array();
        foreach ($this->t_organisation->get_data() as $org) {
            $val = $org['id'];
            $option[$val] = $org['NM_ORG'];
        }

        $data['org_info'] = $option;
        $data['org_checked'] = $data['user_info']['0']['ID_ORGANISATION'];
        $option = array();
        foreach ($this->t_role->get_data() as $role) {
            $val = $role['ID'];
            $option[$val] = $role['NM_ROLE'];
        }

        $data['role_info'] = $option;
        $data['role_checked'] = '3';
        $this->view('default', 'participants/create', $data);
    }

    public function create($uid = null)
    {
        $this->set_page_title("Create new user");
        $this->check_role(array(1), 0);
        $this->load->model('t_user');
        $this->load->model('t_org_mapping');
        $this->load->model('t_participants_info');
        $this->load->model('t_role');
        $this->load->model('t_organisation');

        $option = array();
        foreach ($this->t_role->get_data() as $role) {
            $val = $role['ID'];
            $option[$val] = $role['NM_ROLE'];
        }

        $this->data['role_info'] = $option;
        $option = array();
        foreach ($this->t_org_mapping->get_data() as $org) {
            $val = $org['NM_AGENCY'];
            $option[$val] = $org['NM_AGENCY'];
        }

        $this->data['org_info'] = $option;
        $this->data['org_checked'] = '';
        if ($this->session->userdata('CREATE_USER')) {
            foreach ($this->session->userdata('CREATE_USER') as $key => $value) {
                $this->data[$key] = $value;
            }
            $temp = $this->session->userdata('CREATE_USER');

            $this->session->unset_userdata('CREATE_USER');
            $this->data['org_checked'] = $temp['nm_organisation'];
            if (isset($temp['user_role'])) {
                $this->data['role_checked'] = $temp['user_role'];
            }

        } else {
            $this->data['role_checked'] = 1;
        }
        $this->view('default', 'users/create', $this->data);
    }

    public function edit($uid = null)
    {
        $this->set_page_title("Edit/Delete user");
        $this->check_role(array(1), 0);
        $this->load->model('t_user');
        $this->load->model('t_organisation');
        $this->load->model('t_participants_info');
        $this->load->model('t_role');
        $this->load->model('t_org_mapping');
        $this->data['org_info'] = $this->t_organisation->get_data();


        $option = array();
        foreach ($this->t_role->get_data() as $role) {
            $val = $role['ID'];
            $option[$val] = $role['NM_ROLE'];
        }
        $this->data['role_info'] = $option;

        $option = array();
        foreach ($this->t_org_mapping->get_data() as $org) {
            $val = $org['NM_AGENCY'];
            $option[$val] = $org['NM_AGENCY'];
        }

        $this->data['org_info'] = $option;
        if ($this->session->userdata('UPDATE_USER')) {
            foreach ($this->session->userdata('UPDATE_USER') as $key => $value) {
                $this->data[$key] = $value;
            }

            $temp = $this->session->userdata('UPDATE_USER');
            $this->session->unset_userdata('UPDATE_USER');
            $this->data['org_checked'] = $temp['nm_organisation'];
            $this->data['role_checked'] = $temp['user_role'];

        } else {
            $check_deleted = $this->t_user->is_deleted($uid);
            if ($check_deleted) {
                $this->noti('User does not exist!');
                $segment = array($this->router->class, 'filters');
                $this->redirect($segment);

            }

            $result = $this->t_user->get_data_by_property('*', array('id_user' => $uid));
            if (count($result)) {
                $this->data['user_info'] = $result;
                $this->data['org_checked'] = $this->data['user_info']['0']['NM_ORGANISATION'];
                $this->data['role_checked'] = $this->data['user_info']['0']['USER_ROLE'];
                $this->data['page'] = 'update';
                $this->data['key_page'] = $this->create_token();

            }
        }

        $this->view('default', 'users/edit', $this->data);
    }

    public function create_submit()
    {

        $this->set_page_title("Create new user");
        $this->check_role(array(1), 0);
        $record = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_login', 'User ID', 'trim|required|max_length[50]|custom_validate_user_id|callback_create_unique_user[t_user.ID_LOGIN.' . $record['id_user'] . ']');
        $this->form_validation->set_rules('tx_useremail', 'Email', 'trim|required|max_length[100]|valid_email|xss_clean|callback_create_unique_email[t_user.TX_USEREMAIL.' . $record['id_user'] . ']');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|max_length[16]|callback_validate_phone_number');
        $this->form_validation->set_rules(User_rules::create_user_rules());

        if ($this->form_validation->run()) {
            $this->load->model('t_user');
            // New user create here
            unset($record['id_participant']);
            $time = date("Y-m-d H:i:s");
            $record['dt_created'] = $time;
            $result = $this->t_user->set_data($record);

            $this->send_active_email($record['id_login'], $result, false);
            $this->noti('User create successfully.', 'success');
            $segments = array('users', 'filters');
            $this->redirect($segments);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $ext_field = array(
                array(
                    'field' => 'id_login',
                    'label' => 'Username'
                ),
                array(
                    'field' => 'tx_useremail',
                    'label' => 'Email'
                )
            ,
                array(
                    'field' => 'phone_number',
                    'label' => 'Phone number'
                )
            );

            $list_of_errors = validate_load(User_rules::create_user_rules());
            $ext_field = validate_load($ext_field);
            $list_of_errors = array_merge($list_of_errors, $ext_field);
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('error_mess_code', validation_errors());
            $this->session->set_userdata('CREATE_USER', $this->input->post());
            $segment = array($this->router->class, 'create');
            $this->redirect($segment);
        }
    }

    public function edit_submit()
    {
        $this->set_page_title("Edit/Delete user");
        $this->check_role(array(1), 0);
        $record = $this->input->post();
        $check_deleted = $this->t_user->is_deleted($record['id_user']);
        if ($check_deleted) {
            $this->noti('User does not exist!');
            $segment = array($this->router->class, 'filters');
            $this->redirect($segment);

        }

        if (isset($record['reset_password'])) {
            $checked = true;
            unset($record['reset_password']);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('tx_useremail', 'Email', 'trim|required|max_length[100]|valid_email|xss_clean|callback_edit_unique_email[t_user.TX_USEREMAIL.' . $record['id_user'] . ']');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|max_length[16]|callback_validate_phone_number');
        $this->form_validation->set_rules(User_rules::update_user_rule());
        if ($this->form_validation->run()) {
            unset($record['key_page']);
            unset($record['en_password']);
            $this->t_user->update_data_by_id($record, $record['id_user']);
            $id_to_mail = $record['id_user'];
            if (isset($checked) && $checked == true) {
                try {
                    $this->send_new_password($id_to_mail);
                } catch (Exception $e) {
                    // alert the user then kill the process
                }
            }

            $this->noti('User update successful.', 'success');
            $segments = array('users', 'filters');
            $this->redirect($segments);
        } else {
            $this->session->set_userdata('type_mess_code', ERROR_CLASS);
            $this->session->set_userdata('error_flag_code', 0);
            $ext_field = array(
                array(
                    'field' => 'id_login',
                    'label' => 'Username'
                ),
                array(
                    'field' => 'tx_useremail',
                    'label' => 'Email'
                ),
                array(
                    'field' => 'phone_number',
                    'label' => 'Phone number'
                )
            );

            $list_of_errors = validate_load(User_rules::update_user_rule());
            $list_of_errors = array_merge($list_of_errors, validate_load($ext_field));
            $this->session->set_userdata('list_of_errors', json_encode($list_of_errors));
            $this->session->set_userdata('error_mess_code', validation_errors());
            $this->session->set_userdata('UPDATE_USER', $this->input->post());
            $temp = $this->session->userdata['UPDATE_USER'];
            $segment = array($this->router->class, 'edit/' . $temp['id_user']);
            $this->redirect($segment);
        }
    }

    public function filters($offset = 0, $sort = 'ascsort_2')
    {
        $this->set_page_title("Accounts Search");
        $this->check_role(array(1), 0);
        if ($this->input->post('action') != 'Search' && $offset === 0) {
            $this->session->unset_userdata('USER_SEARCH');
        }

        if ($this->input->post('action')) {
            $txt_search = $this->input->post('ID_LOGIN');
            $this->session->set_userdata('USER_SEARCH', $txt_search);
        } else {
            $txt_search = $this->session->userdata('USER_SEARCH');
        }

        $total_rows = $this->t_user->get_count_user($txt_search);
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
        $config['base_url'] = site_url('/users/filters/');
        $config['uri_segment'] = 3;
        $config['sort'] = $sort;
        $this->sort = $sort;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment(3) == 0) ? 0 : $this->uri->segment(3);
        $this->data['pagination'] = $pagination;
        $this->data['result_search'] = $this->t_user->get_data_user_not_delete($config['per_page'], $offset, $txt_search, null);
        $this->data['txt_search'] = $txt_search;
        $this->data['data_search'] = $txt_search;
        $st = explode('sort_', $sort);
        $this->data['sort'] = $st[0];
        if ($st[0] != 'asc') {
            $offset = $total_rows - $offset;
        }

        $this->data['offset'] = $offset;
        $this->data['per_in_page'] = PER_IN_PAGE;
        $this->data['actor'] = $config['base_url'];
        $this->view('default', 'users/filters', $this->data);
    }

    public function map_user_participant($id_user, $id_participant)
    {
        if (isset($id_user) && isset($id_participant)) {
            $this->load->model('t_participants_info');
            $this->t_participants_info->update_data_by_id(array('mapped_user' => $id_user), $id_participant);
        }
    }

    public function reset_password($id_user)
    {
        $this->send_mail_contain_password($id_user, true);
    }

    public function update_date_create($id)
    {
        $this->load->model('t_user');
        $time = date("Y-m-d H:i:s");
        $this->t_user->update_data_by_property(array("DT_CREATED" => $time), array("ID_USER" => $id));
    }

    public function delete($id_user)
    {
        $this->check_role(1, 0);
        $this->load->model('t_survey_response_hdr');
        $this->load->model('t_company_assignment');
        $query = $this->t_survey_response_hdr->get_data_by_property('*', array('CONSULTANT_ID' => $id_user));
        $query_assigned = $this->t_company_assignment->get_data_by_property('*', array('ID_CONSULTANT' => $id_user));
        if (count($query) > 0 || count($query_assigned) > 0) {
            $this->noti('Cannot delete, a survey was assigned to this user!');
            $segments = array($this->router->class, 'edit/' . $id_user);
            $this->redirect($segments);
        } else {
            $this->load->model('t_user');
            $time = date("Y-m-d H:i:s");
            $this->t_user->update_data_by_id(array('DT_DELETED' => $time), $id_user);
            $this->noti('User has been deleted!', 'success');
            $segments = array($this->router->class, 'filters');
            $this->redirect($segments);
        }

        return false;
    }

    public function edit_unique_email($value, $params)
    {
        $this->form_validation->set_message('edit_unique_email', 'The %s is already being used by another account.');
        list($table, $field, $id) = explode(".", $params, 3);
        $query = $this->db->select($field)->from($table)
            ->where($field, $value)->where('ID_USER !=', $id)->where('DT_DELETED is NULL', null, false)->limit(1)->get();
        if ($query->row()) {
            return false;
        }

        return true;
    }

    public function create_unique_email($value, $params)
    {
        $this->form_validation->set_message('create_unique_email', 'The %s is already being used by another account.');
        list($table, $field, $id) = explode(".", $params, 3);
        $query = $this->db->select($field)->from($table)
            ->where($field, $value)->where('DT_DELETED is NULL', null, false)->limit(1)->get();
        if ($query->row()) {
            return false;
        }

        return true;
    }

    public function create_unique_user($value, $params)
    {
        $this->form_validation->set_message('create_unique_user', 'The %s is already being used by another account.');
        list($table, $field, $id) = explode(".", $params, 3);
        $query = $this->db->select($field)->from($table)
            ->where($field, $value)->where('DT_DELETED is NULL', null, false)->limit(1)->get();

        if ($query->row()) {
            return false;
        }

        return true;
    }

    function validate_phone_number($str)
    {
        $this->form_validation->set_message('validate_phone_number', $this->lang->line('validate_phone_number'));
        if (preg_match('/[^0-9\(\)\+ ]/i', $str)) {
            $result = FALSE;
        } else {
            $result = TRUE;
        }

        return $result;
    }

    function validate_email_user($str)
    {
        $this->form_validation->set_message('validate_email_user', $this->lang->line('invalid_email'));
        $result = $this->t_user->get_data_by_property('*', array('TX_USEREMAIL' => $str));
        if (count($result) > 0) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}