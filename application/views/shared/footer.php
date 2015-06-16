<?php
echo script_tag(array(
    'js/jquery-1.11.3.min.js',
//    'js/jquery-migrate-1.2.1.min.js',
    'js/jquery-ui.min.js',
    'js/bootstrap.min.js',
    'js/chosen.jquery.min.js',
    'js/jquery.textareaCounter.plugin.js'
));

echo script_tag('js/script.js');
?>

</body>
</html>
<?php
$this->session->unset_userdata('list_of_errors');
$this->session->unset_userdata('error_mess_code');
$this->session->unset_userdata('error_flag_code');
$this->session->unset_userdata('type_mess_code');
?>