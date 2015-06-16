<?php echo link_tag('css/themes/bg-1.css'); ?>

<h3 class="custom-page-header">Create Company Profile</h3>
<p class="custom-page-description">&nbsp;</p>
<div class="well">
    <form id="form-create-company-profile" action="<?php  echo site_url('company_profile/save/'); ?>" method="post" class="form-horizontal" novalidate>
    <input type="hidden" name="id_ai" value="<?php echo $id_ai ; ?>">
        <div class="form-group">
            <label for="company-id-create" class="control-label col-sm-3">UEN <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="company_id" class="form-control" name="company_id" maxlength="50" disabled="disabled" autofocus value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } else echo $id_selected; ?>">
                <input type="hidden" id="company_id_hidden" name="company_id_hidden" value="<?php if (isset($company_id) && $company_id !== null ){ echo $company_id; } else echo $id_selected; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company-name-create">Company Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" class="form-control" name="company_name" id="company-name-create" maxlength="50" disabled="disabled" value="<?php if (isset($company_name) && $company_name !== null ){ echo $company_name; } else echo $nm_selected; ?>">
                <input type="hidden" name="company_name_hidden" id="company-name-hidden-create" value="<?php if (isset($company_name) && $company_name !== null ){ echo $company_name; } else echo $nm_selected; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="ceo-name-create">CEO Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="ceo-name-create" class="form-control" name="ceo_name" maxlength="50" value="<?php if (isset($ceo_name) && $ceo_name !== null ){ echo $ceo_name; } ?>" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="designation-1-create-company-profile">Designation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="designation-1-create-company-profile" class="form-control" name="designation1" maxlength="50" value="<?php if (isset($designation1) && $designation1 !== null ){ echo $designation1; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="phone-1-create-company-profile">Phone <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="phone-1-create-company-profile" class="form-control" name="phone1" maxlength="50" value="<?php if (isset($phone1) && $phone1 !== null ){ echo $phone1; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email-1-create-company-profile">Email <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="email" class="form-control" name="email1" id="email-1-create-company-profile" maxlength="50" value="<?php if(isset($email1) && $email1 !== null ){ echo $email1; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="hr-rep-name">HR Rep Name <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="hr-rep-name" class="form-control" name="hr_rep_name" maxlength="50" value="<?php if(isset($hr_rep_name) && $hr_rep_name !== null ){ echo $hr_rep_name; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="designation-2-create-company-profile">Designation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="designation-2-create-company-profile" class="form-control" name="designation2" maxlength="50" value="<?php if(isset($designation2) && $designation2 !== null ){ echo $designation2; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="phone-2-create-company-profile">Phone <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="text" id="phone-2-create-company-profile" class="form-control" name="phone2" maxlength="50" value="<?php if(isset($phone2) && $phone2 !== null ){ echo $phone2; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email-2-create-company-profile">Email <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <input type="mail" id="email-2-create-company-profile" class="form-control" name="email2" maxlength="50" value="<?php if(isset($email2) && $email2 !== null ){ echo $email2; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="industry">Industry <small>(Select primary industry company operate in)</small><span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <?php echo form_dropdown('nm_industry', $industry_info, isset($industry_selected) ? $industry_selected : '','id="industry" class="custom-select-chosen-js form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company-type">Company Type <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <?php echo form_dropdown('nm_type', $type_info, isset($type_selected) ? $type_selected : '','id="company-type" class="custom-select-chosen-js form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="scope-of-operation">Scope of Operation <span class="text-danger">*<span></label>
            <div class="col-sm-8 col-md-6 col-lg-5">
                <?php echo form_dropdown('nm_scope', $scope_info, isset($scope_selected) ? $scope_selected : '','id="scope-of-operation" class="custom-select-chosen-js form-control"'); ?>
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
                        <input id="local-revenue" name="local_revenue" type="text" class="form-control" maxlength="11" value="<?php if(isset($local_revenue) && $local_revenue !== null ){ echo $local_revenue; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-revenue"><small>Overseas Revenue $</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="overseas_revenue" id="overseas-revenue" maxlength="11" value="<?php if(isset($overseas_revenue) && $overseas_revenue !== null ){ echo $overseas_revenue; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="gross-profit"><small>Gross Profit %</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="gross_profit" id="gross-profit" maxlength="11" value="<?php if(isset($gross_profit) && $gross_profit !== null ){ echo $gross_profit; } ?>">
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
                        <input type="text" class="form-control" name="total_local_staff" id="total-no-of-local-staff" maxlength="11" value="<?php if(isset($total_local_staff) && $total_local_staff !== null ){ echo $total_local_staff; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="no-of-university-graduate"><small>No. of University Graduates</small></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="university_graduate" id="no-of-university-graduate" maxlength="11" value="<?php if(isset($university_graduate) && $university_graduate !== null ){ echo $university_graduate; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="no-of-poly-graduate"><small>No. of Poly Graduates</small></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="poly_graduate" id="no-of-poly-graduate" maxlength="11" value="<?php if(isset($poly_graduate) && $poly_graduate !== null ){ echo $poly_graduate; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="no-of-ite-graduate"><small>No. of ITE Graduates</small></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="ite_graduate" id="no-of-ite-graduate" maxlength="11" value="<?php if(isset($ite_graduate) && $ite_graduate !== null ){ echo $ite_graduate; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-staff-part-time"><small>Total Part-time Staff in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="local_staff_part_time" id="local-staff-part-time" maxlength="11" value="<?php if(isset($local_staff_part_time) && $local_staff_part_time !== null ){ echo $local_staff_part_time; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-hr-team-size"><small>HR Team Size in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="local_hr_team" id="local-hr-team-size" maxlength="11" value="<?php if(isset($local_hr_team) && $local_hr_team !== null ){ echo $local_hr_team; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="total-no-overseas-staff"><small>Total No.of Overseas Staffs</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="total_overseas_staff" id="total-no-overseas-staff" maxlength="11" value="<?php if(isset($total_overseas_staff) && $total_overseas_staff !== null ){ echo $total_overseas_staff; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-hr-team-size"><small>Overseas HR Team Size</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="overseas_hr_team_size" id="overseas-hr-team-size" maxlength="11" value="<?php if(isset($overseas_hr_team_size) && $overseas_hr_team_size !== null ){ echo $overseas_hr_team_size; } ?>">
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
                        <input type="text" class="form-control" name="local_staff_retention" id="local-staff-retention" maxlength="11" value="<?php if(isset($local_staff_retention) && $local_staff_retention !== null ){ echo $local_staff_retention; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-staff-retention"><small>Overseas Staff Retention</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control" name="overseas_staff_retention" id="overseas-staff-retention" maxlength="11" value="<?php if(isset($overseas_staff_retention) && $overseas_staff_retention !== null ){ echo $overseas_staff_retention; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="local-staff-turnover"><small>Turnover of Staff in Singapore</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="local_staff_turnover" id="local-staff-turnover" maxlength="11" value="<?php if(isset($local_staff_turnover) && $local_staff_turnover !== null ){ echo $local_staff_turnover; } ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="overseas-staff-turnover"><small>Overseas Staff Turnover</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="overseas_staff_turnover" id="overseas-staff-turnover" maxlength="11" value="<?php if(isset($overseas_staff_turnover) && $overseas_staff_turnover !== null ){ echo $overseas_staff_turnover; } ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="training-cost"><small>Training Cost as % Payroll</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="training_cost" id="training-cost" maxlength="11" value="<?php if(isset($training_cost) && $training_cost !== null ){ echo $training_cost; } ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-md-3" for="training-participation"><small>Training Participation of Staff</small> <span class="text-danger">*<span></label>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="training_participation" id="training-participation" maxlength="11" value="<?php if(isset($training_participation) && $training_participation !== null ){ echo $training_participation; } ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
                <button type="submit" name="submit" value="Save" class="btn--consapp btn btn-primary">Save</button>
                <button type="submit" name="submit" value="Submit" class="btn--consapp btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>