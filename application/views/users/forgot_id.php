<?php echo link_tag('css/themes/bg-5.css'); ?>

<h3 class="login-header-text">HUMAN RESOURCE MATURITY MODEL (HRMM) V3.1</h3>
<h3 class="login-header-desc">FORGOT USERNAME</h3>

<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <form action="<?php echo site_url('users/forgot_id'); ?>" method="post" class="error-js" novalidate>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" id="TX_USEREMAIL" name="TX_USEREMAIL" maxlength="50"
                               value="<?php
                               if (isset($TX_USEREMAIL) && $TX_USEREMAIL != null) {
                                   echo $TX_USEREMAIL;
                               }
                               ?>" autocomplete="off" autofocus class="form-control text-center">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="action" value="Confirm" class="btn btn-primary btn-block">
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