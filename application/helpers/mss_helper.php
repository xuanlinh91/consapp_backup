<?php
if (!function_exists('validate_load')) {
    function validate_load($rule = array())
    {
        if (!function_exists('form_error') || !function_exists('array_push')) {
            echo 'Form validation was not include';
            exit;
        }

        $error = array();
        foreach ($rule as $rule_index => $rule_item) {
            if (strlen(form_error($rule_item['field'])) > 0) {
                array_push($error, array(
                    'id' => $rule_item['field'],
                    'content' => form_error($rule_item['field'])
                ));
            }
        }

        return $error;
    }

}
if (!function_exists('array_comlumnfx')) {
    function array_comlumnfx($arr = array(), $keyword = '')
    {
        $arr_return = array();
        foreach ($arr as $key => $value) {
            foreach ($value as $key_1 => $value_1) {
                if ($key_1 == $keyword) {
                    array_push($arr_return, $value_1);
                }
            }
        }

        return $arr_return;
    }
}

if (!function_exists('multi_number')) {
    function multi_number($numb = null, $pow = 1)
    {
        if ($numb != null) {
            for ($i = 0; $i <= $pow; $i++) {
                if ($numb < pow(10, $i + 1) && $numb >= pow(10, $i)) {
                    for ($j = $i + 1; $j <= $pow - 1; $j++) {
                        $numb = '0' . $numb;
                    }

                    return $numb;
                }
            }
        }
    }
}

if (!function_exists('lock_company')) {
    function lock_company($id_company, $session_id, $type = LOCK_COMPANY_INFO)
    {
        if (isset($session_id) && isset($id_company)) {
            $arr = array();
            $arr['ID_SESSION_LOCK'] = $session_id;
            $arr['TIME_LOCK'] = date('Y-m-d h:i:s');

            $CI =& get_instance();
            if ($type == 2) {
                $CI->load->model('t_company_profile');
                $CI->t_company_profile->update_data_by_property($arr, array('ID_AI' => $id_company));

            } else {
                $CI->load->model('t_company_info');
                $CI->t_company_info->update_data_by_property($arr, array('ID_COMPANY_AI' => $id_company));
            }

            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('unlock_company')) {
    function unlock_company($id_company, $session_id, $type = LOCK_COMPANY_INFO)
    {

        if (isset($session_id) && isset($id_company)) {
            $arr = array();
            $arr['ID_SESSION_LOCK'] = NULL;
            $arr['TIME_LOCK'] = NULL;
            $CI =& get_instance();
            if ($type == 2) {
                $CI->load->model('t_company_profile');
                $CI->t_company_profile->update_data_by_property($arr, array('ID_AI' => $id_company));

            } else {
                $CI->load->model('t_company_info');
                $CI->t_company_info->update_data_by_property($arr, array('ID_COMPANY_AI' => $id_company));
            }

            return true;
        } else {

            return false;
        }

    }
}

if (!function_exists('is_company_locked')) {
    function is_company_locked($id_company, $session_id, $type = LOCK_COMPANY_INFO)
    {
        if (isset($session_id) && isset($id_company)) {
            $CI =& get_instance();
            if ($type == 2) {
                $CI->load->model('t_company_profile');
                $result = $CI->t_company_profile->get_data_by_property('*', array('ID_AI' => $id_company));
            } else {
                $CI->load->model('t_company_info');
                $result = $CI->t_company_info->get_data_by_property('*', array('ID_COMPANY_AI' => $id_company));
            }

            if (count($result) > 0) {
                if ($result['TIME_LOCK'] != NULL) {
                    $result_time = $result['TIME_LOCK'];
                    $result_time = strtotime($result_time);
                    $now_time = date('Y-m-d h:i:s');
                    $now_time = strtotime($now_time);
                    $time_going = floor(abs($now_time - $result_time) / 60);
                } else {
                    return false;
                }

                $result_id = $result['ID_SESSION_LOCK'];
                if ($result_id == $session_id) {

                    return $result_id;
                } elseif ($time_going >= LOCK_TIMEOUT ){
                    unlock_company($id_company, $session_id, $type);

                    return false;
                } else {

                    return true;
                }
            } else {

                return false;
            }
        } else {

            return false;
        }

    }
}
if (!function_exists('is_null_answer')) {
    function is_null_answer($id_survey, $id_question)
    {
        if (isset($id_survey) && isset($id_question)) {
            $CI =& get_instance();
            $CI->load->model('t_survey_response_dtl');
            $data = array(
                'ID_SURVEY' => $id_survey, 
                'ID_QUESTION' => $id_question, 
                'ID_ANSWER' => OPTION_ANSWER
            );
            $result = $CI->t_survey_response_dtl->get_data_by_property('*', $data);
            if (count($result) > 0) {
                return true;
            }
            else {
                return false;
            }
        } else {
            return false;
        }

    }
}

if (!function_exists('date_time')) {
    function date_time($date =null, $type = 0)
    {
        if ($date != null) {
            if ($type == 0) {
                $date .= ' 00:00:00';
            } else {
                $date .= ' 23:59:59';
            }
            return $date;
        } else {
            return null;
        }

    }
}


