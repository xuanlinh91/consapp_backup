<?php echo link_tag('css/themes/bg-5.css'); ?>

<?php
$user_session = $this->session->userdata('UPDATE_USER');
$this->session->unset_userdata('UPDATE_USER');
?>
<h3 class="custom-page-header">Create New User</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php echo form_open('users/create_submit', array('class' => 'form-horizontal', 'novalidate' => 'novalidate')); ?>
    <?php
    $value = (isset($user_info[0]['ID_USER']) ? $user_info[0]['ID_USER'] : '');
    if(isset($id_user) && $id_user != ''){$value = $id_user;}
    $hidden_data = array(
        'id_user'  => $value,
    );

    echo form_hidden($hidden_data);
    ?>
    <div class="form-group">
        <label class="control-label col-sm-3" for="user-id-create-user">User ID <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $id_login = (isset($user_info[0]['ID_LOGIN']) ? $user_info[0]['ID_LOGIN'] : '');
            }

            if(!isset($id_login)){
                $id_login = null;
            }
            ?>

            <input id="user-id-create-user" name="id_login" type="text" class="form-control" required maxlength="30" autofocus value="<?php echo $id_login; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="user-name-create-user">Name <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $user_name = (isset($user_info[0]['USER_NAME']) ? $user_info[0]['USER_NAME'] : '');
            }

            if(!isset($user_name)){
                $user_name = null;
            }
            ?>

            <input id="user-name-create-user" name="user_name" type="text" class="form-control" required maxlength="50" value="<?php echo $user_name; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="email-create-user">Email <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $tx_useremail = (isset($user_info[0]['TX_USEREMAIL']) ? $user_info[0]['TX_USEREMAIL'] : '');
            }

            if(!isset($tx_useremail)){
                $tx_useremail = null;
            }
            ?>
            <input id="email-create-user" name="tx_useremail" type="text" class="form-control" required maxlength="50" value="<?php echo $tx_useremail; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="phone-create-user">Phone <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $phone_number = (isset($user_info[0]['PHONE_NUMBER']) ? $user_info[0]['PHONE_NUMBER'] : '');
            }

            if(!isset($phone_number)){
                $phone_number = null;
            }
            ?>
            <input id="phone-create-user" name="phone_number" type="text" class="form-control" required maxlength="16" value="<?php echo $phone_number; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="organization-create-user">Agency <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php echo form_dropdown('nm_organisation', $org_info, $org_checked, 'id="organization-create-user" class="custom-select-chosen-js form-control"'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Role <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            $checked = false;
            foreach($role_info as $key => $value){ if(isset($role_checked)){if($key==$role_checked) $checked = true;}?>
                <div class="radio">
                    <label>
                        <?php
                        $user_role_id = ($key == '1') ? 'user_role' : 'role_'.$key;
                        echo form_radio(array('name' => 'user_role', 'id' => $user_role_id, 'value' => $key , 'checked' => $checked));
                        $checked = false;
                        echo $value;
                        ?>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
            <button type="submit" class="btn--consapp btn btn-primary">Create</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>