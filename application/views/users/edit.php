<?php
$user_session = $this->session->userdata('UPDATE_USER');
$this->session->unset_userdata('UPDATE_USER');
?>
<?php echo link_tag('css/themes/bg-5.css'); ?>

<h3 class="custom-page-header">Edit/Delete User</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php echo form_open('users/edit_submit', array('class' => 'form-horizontal', 'novalidate' => 'novalidate')); ?>
    <?php
    $value = (isset($user_info[0]['ID_USER']) ? $user_info[0]['ID_USER'] : '');
    if(isset($id_user) && $id_user != ''){$value = $id_user;}
    $hidden_data = array(
        'id_user'  => $value,
    );

    echo form_hidden($hidden_data);
    ?>
    <div class="form-group">
        <label class="control-label col-sm-3" for="user-id-edit-user">User ID <span class="text-danger">*<span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $id_login = (isset($user_info[0]['ID_LOGIN']) ? $user_info[0]['ID_LOGIN'] : '');
            }
            if(!isset($id_login)){$id_login = null;}
            echo form_input(array('id' => 'user-id-edit-user', 'name' => 'id_login', 'class' => 'form-control', 'value' => $id_login, 'disabled' => 'disabled', 'required' => 'required', 'maxlength' => '50'));
            echo form_hidden(array('id_login' => $id_login));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="user-name-edit-user">Name <span class="text-danger">*<span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $user_name = (isset($user_info[0]['USER_NAME']) ? $user_info[0]['USER_NAME'] : '');
            }
            if(!isset($user_name)){$user_name = null;}
            echo form_input(array('id' => 'user-name-edit-user', 'name' => 'user_name', 'class' => 'form-control', 'required' => 'required', 'maxlength' => '50', 'autofocus' => 'autofocus', 'value' => htmlspecialchars_decode($user_name)));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="email-edit-user">Email <span class="text-danger">*<span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $tx_useremail = (isset($user_info[0]['TX_USEREMAIL']) ? $user_info[0]['TX_USEREMAIL'] : '');
            }

            if(!isset($tx_useremail)){
                $tx_useremail = null;
            }

            echo form_input(array('id' => 'email-edit-user', 'name' => 'tx_useremail', 'type' => 'email', 'class' => 'form-control', 'required' => 'required', 'maxlength' => '50', 'value' => $tx_useremail));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="phone-edit-user">Phone <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $phone_number = (isset($user_info[0]['PHONE_NUMBER']) ? $user_info[0]['PHONE_NUMBER'] : '');
            }
            if(!isset($phone_number)){
                $phone_number = null;
            }
            ?>

            <input id="phone-edit-user" name="phone_number" type="text" class="form-control" required maxlength="16" value="<?php echo $phone_number; ?>">
        </div>
    </div>

    <div class="form-group password_group">
        <div class="col-sm-offset-3 col-sm-8 col-md-6 col-lg-5">
            <div class="checkbox">
                <label>
                    <input name="reset_password" type="checkbox" value="1">
                    Check to reset password
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="organization-edit-user">Agency <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
                if(!isset($org_checked)){
                    $org_checked = '';
                }

                echo form_dropdown('nm_organisation', $org_info, $org_checked,'id="organization-edit-user" class="custom-select-chosen-js form-control"');
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Role <span class="text-danger">*<span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            $checked = false;
            foreach($role_info as $key => $value){ if(isset($role_checked)) { if($key==$role_checked) $checked = true; }  ?>
                <div class="radio">
                    <label>
                        <?php
                        echo form_radio(array('id' => 'role-' . $key, 'name' => 'user_role', 'checked' => $checked, 'value' => $key));
                        $checked = false;
                        echo $value;
                        ?>
                    </label>
                </div>
            <?php
            }?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
            <button id="delete-edit-user" type="button" class="btn--consapp btn btn-default">Delete</button>
            <button id="update-edit-user" type="submit" class="btn--consapp btn btn-primary">Update</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>