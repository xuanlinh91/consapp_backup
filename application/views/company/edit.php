<?php
$uniqueIdIndex = 0;
?>
<?php echo link_tag('css/themes/bg-1.css'); ?>

<h3 class="custom-page-header">Edit Company Info</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php  echo site_url('company/update/'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" value="<?php echo $id; ?>" name="id_company_ai">
        <div class="form-group">
            <label for="company_id_disabled" class="control-label col-sm-3">UEN <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input disabled="disabled" type="text" id="company_id_disabled" class="form-control" name="company_id_disabled" maxlength="30" value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } else echo $company_list['ID_COMPANY']; ?>">
                <input type="hidden" id="company_id" class="form-control" name="company_id" maxlength="30" readonly value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } else echo $company_list['ID_COMPANY']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company_name">Company Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="company_name" name="company_name" class="form-control" maxlength="50" autofocus
                       value="<?php
                       if(isset($company_name) && $company_name !== null ){
                           echo $company_name;
                       } else echo $company_list['NM_COMPANY'];?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="respondent_name">Respondent Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="respondent_name" class="form-control" name="respondent_name" maxlength="50"
                       value="<?php
                       if(isset($respondent_name) && $respondent_name !== null ){
                           echo $respondent_name;
                       } else echo $company_list['NM_RESPONDENT']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="designation">Designation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="designation" class="form-control" name="designation" maxlength="50"
                       value="<?php
                       if(isset($designation) && $designation !== null ){
                           echo $designation;
                       } else echo $company_list['NM_DESIGNATION'];?>">
            </div>
        </div>
        <?php if(isset($target)){
            $is_selected = '';
            $is_first = true;
            $is_leader = true;
            if(isset($leader_officer)){?>
                <div class="form-group">
                    <label for="leader_officer_disabled" class="control-label col-sm-3">Assigned Officer(Leader)</label>
                    <div class="col-sm-8 col-md-6 col-lg-5">
                        <input disabled="disabled" type="text" id="leader_officer_disabled" class="form-control" name="leader_officer_disabled" maxlength="30" value="<?php echo $leader_officer['USER_NAME']; ?>">
                        <input type="hidden" id="leader_officer" class="form-control" name="leader_officer" maxlength="30" readonly value="<?php echo $leader_officer['ID_USER'] ; ?>">
                    </div>
                </div>
            <?php }
            if(is_user_hp($userdata)){?>
                <div class="form-group">
                    <label for="leader_officer_disabled" class="control-label col-sm-3">Assigned Officer</label>
                    <div class="col-sm-8 col-md-6 col-lg-5">
                        <input disabled="disabled" type="text" id="leader_officer_disabled" class="form-control" name="leader_officer_disabled" maxlength="30" value="<?php echo $list_officer_selected[0]['USER_NAME'] ; ?>">
                        <input type="hidden" id="leader_officer" class="form-control" name="leader_officer" maxlength="30" readonly value="<?php echo $list_officer_selected[0]['ID_USER'] ; ?>">
                    </div>
                </div>
            <?php
            } else {
                foreach($target as $t_key =>$t_value){
                    $uniqueIdIndex++;
                    ?>
                    <div class="form-group officer-active-js">
                        <?php if($is_first){
                            $is_first = false; ?>
                            <label for="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer(Leader)</label>
                        <?php } else { ?>
                            <label for="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer</label>
                        <?php } ?>
                        <div class="col-sm-8 col-md-6 col-lg-5">
                            <select id="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" name="assigned_officer[]" class="custom-select-chosen-js form-control">
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
                            <label class="col-sm-1 col-md-3 col-lg-4 control-label" style="text-align: left;">
                                <a class="remove-officer-js" href="#">Remove</a>
                            </label>
                        <?php } ?>
                    </div>
                <?php
                }
            }
        } else {
            if(isset($list_officer_selected)){
                $is_selected = '';
                $is_first = true;
                $is_leader = true;
                if(isset($leader_officer) && $leader_officer['ID_USER'] != $list_officer_selected[0]['ID_USER']){?>
                    <div class="form-group">
                        <label for="leader_officer_disabled" class="control-label col-sm-3">Assigned Officer(Leader)</label>
                        <div class="col-sm-8 col-md-6 col-lg-5">
                            <input disabled="disabled" type="text" id="leader_officer_disabled" class="form-control" name="leader_officer_disabled" maxlength="30" value="<?php echo $leader_officer['USER_NAME'] ; ?>">
                            <input type="hidden" id="leader_officer" class="form-control" name="leader_officer" maxlength="30" readonly value="<?php echo $leader_officer['ID_USER'] ; ?>">
                        </div>
                    </div>
                <?php }
                if(is_user_hp($userdata)){?>
                    <div class="form-group">
                        <label for="leader_officer_disabled" class="control-label col-sm-3">Assigned Officer
                            <?php if(isset($leader_officer) && $leader_officer['ID_USER'] == $list_officer_selected[0]['ID_USER']) echo '(Leader)';?></label>
                        <div class="col-sm-8 col-md-6 col-lg-5">
                            <input disabled="disabled" type="text" id="leader_officer_disabled" class="form-control" name="leader_officer_disabled" maxlength="30" value="<?php echo $list_officer_selected[0]['USER_NAME'] ; ?>">
                            <input type="hidden" id="leader_officer" class="form-control" name="leader_officer" maxlength="30" readonly value="<?php echo $list_officer_selected[0]['ID_USER'] ; ?>">
                        </div>
                    </div>
                <?php
                } elseif(is_agency_admin_hp($userdata)){
                        $i = 0;
                        foreach($list_officer_selected as $l_key =>$l_value){
                            $uniqueIdIndex++;
                            $i++;
                            $label_leader = ($i == '1') ? '(Leader)' : '';
                            ?>
                            <div class="form-group officer-active-js">
                                <label for="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer<?php echo $label_leader; ?></label>
                                <div class="col-sm-8 col-md-6 col-lg-5">
                                    <select id="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" name="assigned_officer[]" class="custom-select-chosen-js form-control">
                                        <?php
                                        $j = 0;
                                        foreach($user_list as $u_key => $u_value) {
                                            $is_selected = '';
                                            if ($l_value['ID_USER'] == $u_value['ID_USER']) {
                                                $j++;
                                                $is_selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?php echo $u_value['ID_USER']; ?>" <?php echo $is_selected; ?>><?php echo $u_value['USER_NAME']; ?></option>
                                        <?php }
                                        if ($j == '0') { ?>
                                            <option value="<?php echo $l_value['ID_USER']; ?>" selected><?php echo $l_value['USER_NAME']; ?></option>
                                       <?php }?>
                                    </select>
                                </div>
                                <?php if ($i > '1') : ?>
                                    <label class="col-sm-1 col-md-3 col-lg-4 control-label" style="text-align: left;">
                                        <a class="remove-officer-js" href="#">Remove</a>
                                    </label>
                                <?php endif; ?>
                            </div>
                        <?php
                        }
                } else {
                    foreach($list_officer_selected as $l_key =>$l_value){
                        $uniqueIdIndex++;
                        ?>
                        <div class="form-group officer-active-js">
                            <?php if($is_first){
                                $is_first = false; ?>
                                <label for="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer(Leader)</label>
                            <?php } else { ?>
                                <label for="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" class="control-label col-sm-3">Assigned Officer</label>
                            <?php } ?>
                            <div class="col-sm-8 col-md-6 col-lg-5">
                                <select id="select-officer-update-company-info-<?php echo $uniqueIdIndex; ?>" name="assigned_officer[]" class="custom-select-chosen-js form-control">
                                    <?php foreach($user_list as $u_key => $u_value) {
                                        if($u_value['ID_USER'] == $l_value['ID_USER']){
                                            $is_selected = 'selected';
                                        } else $is_selected = '' ?>
                                        <option value="<?php echo $u_value['ID_USER']; ?>" <?php echo $is_selected; ?>><?php echo $u_value['USER_NAME']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if($is_leader){
                                $is_leader = false; ?>
                            <?php } else { ?>
                                <label class="col-sm-1 col-md-3 col-lg-4 control-label" style="text-align: left;">
                                    <a class="remove-officer-js" href="#">Remove</a>
                                </label>
                            <?php } ?>
                        </div>
                    <?php }
                }
            } else { ?>
                <div class="form-group officer-active-js">
                    <label for="select-officer-update-company-info" class="control-label col-sm-3">Assigned Officer<small>(Leader)</small><span class="text-danger">*<span></label>
                    <div class="col-sm-8 col-md-6 col-lg-5">
                        <select id="select-officer-update-company-info" name="assigned_officer[]" class="custom-select-chosen-js form-control">
                            <?php foreach($user_list as $u_key => $u_value) {?>
                                <option value="<?php echo $u_value['ID_USER']; ?>"><?php echo $u_value['USER_NAME']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php }
        } ?>
        <?php if (is_admin_hp($userdata)) { ?>
            <div class="col-sm-3 text-right">
                <a id="add-officer" style="text-decoration: underline;" href="#">Add Officer</a>
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
                <button type="submit" name="submit" value="Update" class="btn--consapp btn btn-primary">Update Company</button>
            </div>
        </div>
    </form>
</div>
<div id="div-add-officer" style="display: none;">
    <label class="control-label col-sm-3">Assigned Officer</label>
    <div class="col-sm-8 col-md-6 col-lg-5">
        <select id="select-officer-optional-update-company-info-" name="assigned_officer[]" class="add-officer-select-js form-control">
            <?php foreach($user_list as $key => $value) { ?>
                <option value="<?php echo $value['ID_USER']; ?>"><?php echo $value['USER_NAME']; ?></option>
            <?php } ?>
        </select>
    </div>
    <label class="col-sm-1 col-md-3 col-lg-4 control-label" style="text-align: left;">
        <a class="remove-officer-js" href="#">Remove</a>
    </label>
</div>


