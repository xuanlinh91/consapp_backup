<?php
$uniqueIdIndex = 0;
?>
<?php echo link_tag('css/themes/bg-1.css'); ?>

<h3 class="custom-page-header">Create Company Info</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php  echo site_url('company/save/'); ?>" method="post" class="form-horizontal" novalidate>
        <div class="form-group">
            <label for="company-id" class="control-label col-sm-3">UEN <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="company-id" class="form-control" name="company_id" maxlength="30" autofocus value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company_name">Company Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="company_name" class="form-control" name="company_name" maxlength="50" value="<?php if (isset($company_name) && $company_name !== null ){ echo $company_name; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="respondent_name">Respondent Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="respondent_name" class="form-control" name="respondent_name" maxlength="50" value="<?php if (isset($respondent_name) && $respondent_name !== null ){ echo $respondent_name; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="designation">Designation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="designation" class="form-control" name="designation" maxlength="50" value="<?php if (isset($designation) && $designation !== null ){ echo $designation; } ?>">
            </div>
        </div>
        <?php if(isset($target)){
            $is_selected = '';
            $is_first = true;
            $is_leader = true;
            foreach($target as $t_key =>$t_value){
                $uniqueIdIndex++;
                ?>
            <div class="form-group officer-active-js">
                <?php if($is_first){
                    $is_first = false;?>
                    <label for="select-officer-create-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer<small>(Leader)</small><span class="text-danger">*<span></label>
                <?php } else { ?>
                    <label for="select-officer-create-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer</label>
                <?php } ?>
                <div class="col-sm-8 col-md-6 col-lg-5">
                    <select id="select-officer-create-company-info-<?php echo $uniqueIdIndex; ?>" name="assigned_officer[]" class="custom-select-chosen-js form-control" data-placeholder="Select Officers">
                        <?php foreach($user_list as $u_key => $u_value) {
                            if($u_value['ID_USER'] == $t_key){
                                $is_selected = 'selected';
                            } else $is_selected = '' ?>
                            <option value="<?php echo $u_value['ID_USER']; ?>" <?php echo $is_selected; ?>><?php echo $u_value['USER_NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php if($is_leader){
                    $is_leader = false; ?>
                <?php } else { ?>
                    <label class="col-sm-3">
                        <a class="remove-officer-js" href="#">Remove</a>
                    </label>
                <?php } ?>
            </div>
            <?php }
        } else { ?>
            <div class="form-group officer-active-js">
                <label for="select-officer-create-company-info" class="control-label col-sm-3">Assigned Officer<small>(Leader) </small><span class="text-danger">*<span></label>
                <div class="col-sm-8 col-md-6 col-lg-5">
                    <select id="select-officer-create-company-info" name="assigned_officer[]" class="custom-select-chosen-js form-control" data-placeholder="Select Officers">
<!--                        <option value="-1" disabled selected>Select leader officer</option>-->
                        <?php foreach($user_list as $key => $value) { ?>
                            <option value="<?php echo $value['ID_USER']; ?>"><?php echo $value['USER_NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        <?php }?>
        <?php if (is_admin_hp($userdata)) { ?>
            <div class="form-group">
                <div class="col-sm-3 text-right">
                    <a id="add-officer" style="text-decoration: underline;" href="#">Add Officer</a>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
                <button type="submit" name="submit" value="Create" class="btn--consapp btn btn-primary">Create Company</button>
            </div>
        </div>
    </form>
</div>
<div id="div-add-officer" style="display: none;">
    <label class="control-label col-sm-3">Assigned Officer</label>
    <div class="col-sm-8 col-md-6 col-lg-5">
        <select id="select-officer-optional-create-company-info-" name="assigned_officer[]" class="add-officer-select-js form-control">
<!--            <option value="-1" disabled selected>Select an officer</option>-->
            <?php foreach($user_list as $key => $value) { ?>
                <option value="<?php echo $value['ID_USER']; ?>"><?php echo $value['USER_NAME']; ?></option>
            <?php } ?>
        </select>
    </div>
    <label class="col-sm-1 col-md-3 col-lg-4 control-label" style="text-align: left;">
        <a class="remove-officer-js" href="#">Remove</a>
    </label>
</div>