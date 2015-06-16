<?php
$list_of_errors = $this->session->userdata('list_of_errors');
$error_flag_code = $this->session->userdata('error_flag_code');
$error_mess_code = $this->session->userdata('error_mess_code');
$type_mess_code = $this->session->userdata('type_mess_code');

$userDisplayName = 'Guest';
if (isset($userdata)) {
    if (isset($userdata["USER_NAME"]) && !empty($userdata["USER_NAME"])) {
        $userDisplayName = $userdata["USER_NAME"];
    } else if (!empty($userdata["USER_NAME"])) {
        $userDisplayName = $userdata["ID_LOGIN"];
    }
}
?>
<?php echo doctype('html5'); ?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="Hay Group HR Maturity Survey System">
    <meta name="keywords" content="Survey, Hay Group, HR Survey System, HR Maturity Survey System">
    <meta name="author" content="Hay Group HR Maturity Survey System">

    <title><?php if(!empty($this->page_title)) { echo $this->page_title; } else { echo DEFAULT_PAGE_TITLE; } ?></title>

    <?php
    echo link_tag('favicon.ico', 'shortcut icon', 'image/ico');
    echo link_tag('css/bootstrap.min.css');
    echo link_tag('css/bootstrap-theme.min.css');
    echo link_tag('css/chosen.min.css');
    echo link_tag('css/font-awesome.min.css');
    echo link_tag('css/bootstrap-custom.css');
    echo link_tag('css/jquery-ui.min.css');
    echo link_tag('css/default.css');

//    echo script_tag('js/modernizr-2.8.3.js');
    ?>

    <script type="text/javascript">
        var configs = {
            base_url: "<?php echo base_url(); ?>",
            site_url: "<?php echo site_url(); ?>",
            <?php if (isset($list_of_errors) && gettype($list_of_errors) == 'string' && strlen($list_of_errors) > 4) 	{
                echo 'listOfErrors: ' . json_encode($list_of_errors) . ',';
            } else {
                echo 'listOfErrors: [],';
            } ?>

            <?php if (isset($error_flag_code) && !empty($error_flag_code)) 	{
                echo 'errorFlag: ' . $error_flag_code . ',';
            } else {
                echo 'errorFlag: 0,';
            } ?>

            <?php if (isset($error_mess_code) && !empty($error_mess_code)) 	{
                echo 'errorMess: ' . json_encode(strip_tags($error_mess_code, '<a>')) . ',';
            } else {
                echo 'errorMess: "",';
            } ?>

            <?php if (isset($type_mess_code) && !empty($type_mess_code)) 	{
                echo 'typeMess: "' . $type_mess_code . '"';
            } else {
                echo 'typeMess: "none"';
            } ?>

        };
    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <img src="<?php echo base_url('/img/processing.gif'); ?>" alt="Loading" style="display: none;">
    <?php if(isset($userdata)) { ?>
    <nav class="navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 tracking-menu">
                    <?php if (isset($is_tracking) && $is_tracking = true): ?>
                        <div class="tracking-summary">
                            <?php $this->load->view('tracking/tracking_view', $tracking_data); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-1">
                    <div class="navbar-right">
                        <div class="dropdown clearfix">
                            <button id="main-menu" type="button" class="navbar-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="display: block;">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="main-menu">
                                <li class="disabled"><a role="menuitem" href="#"><strong>Hi, <?php echo $userDisplayName; ?>!</strong></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('home'); ?>">Search</a></li>
                                <?php if (is_spadmin_hp($userdata)) { ?>
                                    <li><a role="menuitem" href="<?php echo site_url('users'); ?>">Account Management</a></li>
                                <?php } ?>

                                <?php if (is_admin_hp($userdata) || is_user_hp($userdata)) { ?>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('company/index/'); ?>">Create/Rename Company</a></li>
                                <?php } ?>

                                <?php if (is_spadmin_hp($userdata)) { ?>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('training_session/filters'); ?>">Training Management</a></li>
                                <?php } ?>

                                <?php if (is_admin_hp($userdata)) { ?>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('report/index'); ?>">Management Reports</a></li>
                                <?php } ?>

                                <?php if (is_spadmin_hp($userdata)) { ?>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('norm/index'); ?>">Compute Norm Scores</a></li>
                                <?php } ?>
                                <li role="presentation"><a role="menuitem" href="<?php echo base_url('files/toolkit.zip'); ?>">Toolkit</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="<?php echo site_url('users/logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <?php } ?>