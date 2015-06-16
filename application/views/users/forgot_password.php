<?php echo link_tag('css/themes/bg-5.css'); ?>

<h3 class="login-header-text">HUMAN RESOURCE MATURITY MODEL (HRMM) V3.1</h3>
<h3 class="login-header-desc">FORGOT PASSWORD</h3>

<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <form class="error-js form-horizontal" action="<?php echo site_url('users/forgot_password'); ?>" method="post" novalidate>
                    <div class="form-group">
                        <input type="text" placeholder="Username" name="ID_LOGIN" maxlength="30" value="<?php
                        if (isset($user_name) && !empty($user_name)) {
                            echo $user_name;
                        }
                        ?>" autocomplete="off" autofocus class="form-control text-center">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="action" class="btn btn-primary btn-block" value="Confirm">
                    </div>
                </form>
            </div>
        </div>
        <ul class="login-help-list list-unstyled text-center">
            <li>
                <a href="<?php echo site_url('users/login'); ?>" title="Back To Login Page">Back To Login Page</a>
            </li>
        </ul>
    </div>
</div>