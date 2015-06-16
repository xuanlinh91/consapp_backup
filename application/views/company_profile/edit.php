<?php echo link_tag('css/themes/bg-1.css'); ?>
<h3 class="custom-page-header">Update Company Profile</h3>
<p class="custom-page-description">&nbsp;</p>
<div class="well">
    <form action="<?php echo site_url('company_profile/update/'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="id_ai" value="<?php if (isset($id_ai) && $id_ai !== null ){ echo $id_ai; } else echo $company_profile['ID_AI']?>">
        <input type="hidden" name="company_id_ai" value="<?php echo $company_id_ai; ?>">

        <div class="form-group">
            <label for="company-id-create" class="control-label col-sm-3">UEN <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="company-id-create" class="form-control" name="company_id" maxlength="50" disabled="disabled" value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } else echo $company_profile['ID_COMPANY']; ?>">
                <input type="hidden" id="company_id_hidden" name="company_id_hidden" value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } else echo $company_profile['ID_COMPANY']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company-name-create">Company Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="company-name-create" class="form-control" name="company_name" maxlength="50" disabled="disabled" value="<?php if (isset($company_name) && $company_name !== null ){ echo $company_name; } else echo $company_profile['NM_COMPANY']; ?>">
                <input type="hidden" id="company-name-hidden-create" name="company_name_hidden" value="<?php if (isset($company_name) && $company_name !== null ){ echo $company_name; } else echo $company_profile['NM_COMPANY']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="ceo-name-create">CEO Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="ceo-name-create" class="form-control" name="ceo_name" maxlength="50" value="<?php if (isset($ceo_name) && $ceo_name !== null ){ echo $ceo_name; } else echo $company_profile['NM_CEO']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="designation-1-create-company-profile">Designation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="designation-1-create-company-profile" class="form-control" maxlength="50" name="designation1" value="<?php if (isset($designation1) && $designation1 !== null ){ echo $designation1; } else echo $company_profile['NM_DESIGNATION1']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="phone-1-create-company-profile">Phone <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="phone-1-create-company-profile" class="form-control" name="phone1" maxlength="50" value="<?php if (isset($phone1) && $phone1 !== null ){ echo $phone1; } else echo $company_profile['N_HP1']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email-1-create-company-profile">Email <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="email" class="form-control" name="email1" id="email-1-create-company-profile" maxlength="50" value="<?php if (isset($email1) && $email1 !== null ){ echo $email1; } else echo $company_profile['N_EMAIL1']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="hr-rep-name">HR Rep Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="hr-rep-name" class="form-control" name="hr_rep_name" maxlength="50" value="<?php if (isset($hr_rep_name) && $hr_rep_name !== null ){ echo $hr_rep_name; } else echo $company_profile['NM_HR']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="designation-2-create-company-profile">Designation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="designation-2-create-company-profile" class="form-control" maxlength="50" name="designation2" value="<?php if (isset($designation2) && $designation2 !== null ){ echo $designation2; } else echo $company_profile['NM_DESIGNATION2']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="phone-2-create-company-profile">Phone <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="phone-2-create-company-profile" class="form-control" name="phone2" maxlength="50" value="<?php if (isset($phone2) && $phone2 !== null ){ echo $phone2; } else echo $company_profile['N_HP2']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email-2-create-company-profile">Email <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="mail" id="email-2-create-company-profile" class="form-control" name="email2" maxlength="50" value="<?php if (isset($email2) && $email2 !== null ){ echo $email2; } else echo $company_profile['N_EMAIL2']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="industry">Industry <small>(Select primary industry company operate in)</small><span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <?php echo form_dropdown('nm_industry', $industry_info, $industry_selected,'id="industry" class="custom-select-chosen-js form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company-type">Company Type <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <?php echo form_dropdown('nm_type', $type_info, $type_selected, 'id="company-type" class="custom-select-chosen-js form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="scope-of-operation">Scope of Operation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <?php echo form_dropdown('nm_scope', $scope_info, $scope_selected, 'id="scope-of-operation" class="custom-select-chosen-js form-control"'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label col-sm-12" for="local-revenue">Company Financials</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-revenue"><small>Local Revenue $</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="local_revenue" id="local-revenue" maxlength="11" value="<?php if (isset($local_revenue) && $local_revenue !== null ){ echo $local_revenue; } else echo $company_profile['N_L_REVENUE']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-revenue"><small>Overseas Revenue $</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="overseas_revenue" id="overseas-revenue" maxlength="11" value="<?php if (isset($overseas_revenue) && $overseas_revenue !== null ){ echo $overseas_revenue; } else echo $company_profile['N_O_REVENUE']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="gross-profit"><small>Gross Profit %</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="gross_profit" id="gross-profit" maxlength="11" value="<?php if (isset($gross_profit) && $gross_profit !== null ){ echo $gross_profit; } else echo $company_profile['N_GROSS']; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label col-sm-12" for="total-no-of-local-staff">Workforce Composition<br><small>Please indicate for the latest year</small></label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="total-no-of-local-staff"><small>Total Staff in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="total_local_staff" id="total-no-of-local-staff" maxlength="11" value="<?php if (isset($total_local_staff) && $total_local_staff !== null ){ echo $total_local_staff; } else echo $company_profile['N_LOCAL_STAFF']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="no-of-university-graduate"><small>No. of University Graduates</small></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="university_graduate" id="no-of-university-graduate" maxlength="11" value="<?php if (isset($university_graduate) && $university_graduate !== null ){ echo $university_graduate; } else echo $company_profile['N_UNI']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="no-of-poly-graduate"><small>No. of Poly Graduates</small></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="poly_graduate" id="no-of-poly-graduate" maxlength="11" value="<?php if (isset($poly_graduate) && $poly_graduate !== null ){ echo $poly_graduate; } else echo $company_profile['N_POLY']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="no-of-ite-graduate"><small>No. of ITE Graduates</small></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="ite_graduate" id="no-of-ite-graduate" maxlength="11" value="<?php if (isset($ite_graduate) && $ite_graduate !== null ){ echo $ite_graduate; } else echo $company_profile['N_ITE']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-staff-part-time"><small>Total Part-time Staff in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="local_staff_part_time" id="local-staff-part-time" maxlength="11" value="<?php if (isset($local_staff_part_time) && $local_staff_part_time !== null ){ echo $local_staff_part_time; } else echo $company_profile['N_PARTTIME']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-hr-team-size"><small>HR Team Size in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="local_hr_team" id="local-hr-team-size" maxlength="11" value="<?php if (isset($local_hr_team) && $local_hr_team !== null ){ echo $local_hr_team; } else echo $company_profile['N_L_HR']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="total-no-overseas-staff"><small>Total No.of Overseas Staffs</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="total_overseas_staff" id="total-no-overseas-staff" maxlength="11" value="<?php if (isset($total_overseas_staff) && $total_overseas_staff !== null ){ echo $total_overseas_staff; } else echo $company_profile['N_OVERSEAS_STAFF']; ?>">
                    </div>
                </div>
                <div class="form-group">

                    <label class="control-label col-sm-5 col-md-3" for="overseas-hr-team-size"><small>Overseas HR Team Size</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="overseas_hr_team_size" id="overseas-hr-team-size" maxlength="11" value="<?php if (isset($overseas_hr_team_size) && $overseas_hr_team_size !== null ){ echo $overseas_hr_team_size; } else echo $company_profile['N_OVERSEAS_HR']; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label col-sm-12" for="local-staff-retention">Workforce Metrics<br><small>Please indicate for the latest year</small><br><small>Required Fields</small> <span class="text-danger">*<span></label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-staff-retention"><small>Retention of Staff in<br>Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="local_staff_retention" id="local-staff-retention" maxlength="11" value="<?php if (isset($local_staff_retention) && $local_staff_retention !== null ){ echo $local_staff_retention; } else echo $company_profile['N_L_RETENTION']; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-staff-retention"><small>Overseas Staff Retention</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="overseas_staff_retention" id="overseas-staff-retention" maxlength="11" value="<?php if (isset($overseas_staff_retention) && $overseas_staff_retention !== null ){ echo $overseas_staff_retention; } else echo $company_profile['N_O_RETENTION']; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-staff-turnover"><small>Turnover of Staff in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="local_staff_turnover" id="local-staff-turnover" maxlength="11" value="<?php if (isset($local_staff_turnover) && $local_staff_turnover !== null ){ echo $local_staff_turnover; } else echo $company_profile['N_L_TURNOVER']; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-staff-turnover"><small>Overseas Staff Turnover</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="overseas_staff_turnover" id="overseas-staff-turnover" maxlength="11" value="<?php if (isset($overseas_staff_turnover) && $overseas_staff_turnover !== null ){ echo $overseas_staff_turnover; } else echo $company_profile['N_O_TURNOVER']; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="training-cost"><small>Training Cost as % Payroll</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="training_cost" id="training-cost" maxlength="11" value="<?php if (isset($training_cost) && $training_cost !== null ){ echo $training_cost; } else echo $company_profile['N_TRAINING_COST']; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="training-participation"><small>Training Participation of Staff</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="training_participation" id="training-participation" maxlength="11" value="<?php if (isset($training_participation) && $training_participation !== null ){ echo $training_participation; } else echo $company_profile['N_TRAINING_PARTICIPATION']; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php if (is_spadmin_hp($userdata)) { ?>
        <div class="form-group">
            <label for="nm_status" class="control-label col-sm-3">Status</label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <select id="nm_status" name="nm_status" class="custom-select-chosen-js form-control"><?php
                    foreach(array(0 => 'Active', 1 => 'Deleted') as $key => $val){ ?>
                        <option value="<?php echo $key; ?>" <?php if($key == $status) echo ' selected'; ?>><?php echo $val; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <?php } else { ?>
        <input type="hidden" name="nm_status" value="0">
    <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
                <button type="submit" name="submit" value="Save" class="btn--consapp btn btn-primary submit-deleted">Save</button>
                <button type="submit" name="submit" value="Submit" class="btn--consapp btn btn-primary submit-deleted">Submit</button>
            </div>
        </div>
    </form>
</div>