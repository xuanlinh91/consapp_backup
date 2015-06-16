<?php echo link_tag('css/themes/bg-3.css'); ?>

<script type="text/javascript">
    var page = "login";
</script>
<h3 class="login-header-text">HUMAN RESOURCE MATURITY MODEL (HRMM) V3.1</h3>
<p class="login-header-desc">A Self-Diagnostics Survey for Singapore SMEs</p>

<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <?php  echo form_open('users/check_login', array('method' => 'post', 'class' => 'login-form error-js', 'novalidate' => 'novalidate')); ?>
                <div class="form-group">
                    <input type="text" placeholder="Username" id="username-login" name="ID_LOGIN" maxlength="30" value="<?php
                    if(isset($ID_LOGIN)) {
                        echo $ID_LOGIN;
                    }
                    ?>" autocomplete="off" autofocus class="form-control text-center">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" id="password-login" name="EN_PASSWORD" class="form-control text-center" maxlength="128">
                </div>
                <div class="form-group">
                    <input type="submit" name="action" value="Login" class="btn btn-primary btn-block">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <ul class="login-help-list list-unstyled text-center">
            <li>
                <a href="<?php echo site_url('users/forgot_password'); ?>" title="Forgot password">Forgot Password</a>
            </li>
            <li>&nbsp;</li>
            <li>
                <a href="<?php echo site_url('users/forgot_id'); ?>" title="Forgot Login ID">Forgot Username</a>
            </li>
        </ul>
    </div>
</div>