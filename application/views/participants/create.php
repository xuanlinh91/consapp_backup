<?php
$user_session = $this->session->userdata('UPDATE_USER');
$this->session->unset_userdata('UPDATE_USER');
?>
<?php echo link_tag('css/themes/bg-1.css'); ?>

<script type="text/javascript">
    var page = "participants-create";
</script>

<h3 class="custom-page-header">Create New User</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php echo form_open('users/create_ac_submit', array('class' => 'form-horizontal', 'novalidate' => 'novalidate')); ?>
    <?php
    $value = (isset($user_info[0]['id']) ? $user_info[0]['id'] : '');
    if(isset($id_user) && $id_user != ''){$value = $id_user;}
    $hidden_data = array(
        'id_user'  => $value,
    );

    echo form_hidden($hidden_data);
    ?>
    <div class="form-group">
        <label class="control-label col-sm-3" for="user-id-participant-create-user">User ID <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $id_login = (isset($user_info[0]['ID_LOGIN']) ? $user_info[0]['ID_LOGIN'] : '');
            }

            if(!isset($id_login)){ $id_login = null; }
            echo form_input(array('id' => 'user-id-participant-create-user', 'name' => 'id_login', 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'value' => $id_login));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="name-participant-create-user" class="control-label col-sm-3">Name <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $user_name = (isset($user_info[0]['NM_PARTICIPANT']) ? $user_info[0]['NM_PARTICIPANT'] : '');
            }

            if(!isset($user_name)){$user_name = null;}
            echo form_input(array('id' => 'name-participant-create-user', 'name' => 'user_name', 'class' => 'form-control', 'required' => 'required', 'value' => $user_name));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="email-participant-create-user">Email <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $tx_useremail = (isset($user_info[0]['NM_EMAIL']) ? $user_info[0]['NM_EMAIL'] : '');
            }

            if(!isset($tx_useremail)){$tx_useremail = null;}

            echo form_input(array('id' => 'email-participant-create-user', 'name' => 'tx_useremail', 'type' => 'email', 'class' => 'form-control', 'required' => 'required', 'value' => $tx_useremail));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="phone-participant-create-user">Phone <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if(isset($user_info) && count($user_info) > 0){
                $phone_number = (isset($user_info[0]['PHONE_NUMBER']) ? $user_info[0]['PHONE_NUMBER'] : '');
            }

            if(!isset($phone_number)){
                $phone_number = null;
            }
            ?>
            <input id="phone-participant-create-user" name="phone_number" type="text" class="form-control" required maxlength="16" value="<?php echo $phone_number; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="organization-participant-create-user">Organization <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php echo form_dropdown('nm_organisation', $org_info, $org_checked, 'id="organization-participant-create-user" class="form-control"'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Role <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            $checked = false;
            foreach($role_info as $key => $value){
                if(isset($role_checked)){
                    if($key==$role_checked) $checked = true;
                }
            ?>
                <div class="radio">
                    <label>
                        <?php
                        echo form_radio(array('name' => 'user_role', 'value' => $key , 'checked' => $checked));
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