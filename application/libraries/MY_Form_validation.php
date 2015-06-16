<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    protected $CI;

    public function __construct($config = array()) {
        parent::__construct($config);

        // reference to the CodeIgniter super object
        $this->CI =& get_instance();

        // remove <p> tag from error message
        $this->set_error_delimiters('<span class="text-danger custom-error-message">', '</span>');
    }

    /**
     * Is Unique
     *
     * Check if the input value doesn't already exist
     * in the specified database field.
     * ex: <table>.<field name>.[field_name_2 (not required)]
     *
     * @param	string	$str
     * @param	string	$fields
     * @return	bool
     */
    function custom_field_unique($str, $fields) {
        $field = '';
        $notEqualValueOfField = '';
        sscanf($fields, '%[^.].%[^.].%[^.]', $table, $field, $notEqualValueOfField);
        $this->CI->db->where($field, $str);
        if (is_string($notEqualValueOfField) && strlen($notEqualValueOfField) >= 1) {
            $value = $this->CI->input->post($notEqualValueOfField);
            $this->CI->db->where($notEqualValueOfField .' !=', $value);
        }

        $query = $this->CI->db->get($table);
        if ($query->num_rows() > 0){
            return FALSE;
        }

        return TRUE;
    }

    function custom_validate_user_id ($str) {
        if (preg_match('/(^[a-z][\w]*)$/i', $str)) {
            return TRUE;
        }

        return FALSE;
    }

    function custom_validate_name_user($str)
    {
        if (preg_match('/^[^\<\>]+$/i', $str)) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }

        return $result;
    }

    function validate_name_part($str)
    {
        if (preg_match('/^([a-z\d\s])+$/i', $str)) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }

        return $result;
    }
}