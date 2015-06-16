<?php echo link_tag('css/themes/bg-5.css'); ?>

<script type="text/javascript">
    var page = "user-change-password";
</script>

<h3 class="custom-page-header">HUMAN RESOURCE MATURITY MODEL (HRMM) V3.1</h3>
<p class="custom-page-description">RESET PASSWORD</p>

<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <form action="<?php echo site_url('users/change_password'); ?>" method="post" novalidate>
                    <div class="form-group">
                        <input type="text" placeholder="<?php if (isset($ID_LOGIN)) {
                            echo $ID_LOGIN;
                        } else { echo $ID_LOGIN;} ?>" id="ID_LOGIN"  name="ID_LOGIN" value="<?php
                        if (isset($ID_LOGIN)) {
                            echo $ID_LOGIN;
                        }
                        ?>" autocomplete="off" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="<?php if (isset($TX_SECURITY_CODE)) { echo $TX_SECURITY_CODE; } ?>" id="TX_SECURITY_CODE" name="TX_SECURITY_CODE" value="<?php if (isset($TX_SECURITY_CODE)) { echo $TX_SECURITY_CODE; } ?>" autocomplete="off" readonly class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="password" placeholder="New Password" id="NEW_PASSWORD" name="NEW_PASSWORD" class="form-control" value="<?php
                        if(isset($this->session->userdata['NEW_PASSWORD']) && !empty($this->session->userdata['NEW_PASSWORD'])) {
                            //echo $this->session->userdata['NEW_PASSWORD'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password" id="CONFIRM_NEW_PASSWORD" name="CONFIRM_NEW_PASSWORD" class="form-control" value="<?php
                        if(isset($this->session->userdata['CONFIRM_NEW_PASSWORD']) && !empty($this->session->userdata['CONFIRM_NEW_PASSWORD'])) {
                            //echo $this->session->userdata['CONFIRM_NEW_PASSWORD'];
                        }
                        ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </form>
                <br>
            </div>
        </div>
        <ul class="login-help-list list-unstyled text-center">
            <li>
                <a href="<?php echo site_url('users/login'); ?>" title="Login">Back to login</a>
            </li>
        </ul>
    </div>
</div>