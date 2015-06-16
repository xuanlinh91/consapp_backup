<?php echo link_tag('css/themes/bg-1.css'); ?>

<h3 class="custom-page-header">Interview Feedbacks</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php  echo site_url('interview/submit_interview/'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="id_ai" value="<?php echo $company_info['ID_COMPANY_AI']; ?>">
        <div class="form-group">
            <label for="company-id-disabled-interview-note" class="control-label col-sm-3">UEN</label>
            <div class="col-sm-4">
                <input id="company-id-disabled-interview-note" name="company_id_disabled" type="text" class="form-control" maxlength="30" disabled="disabled" value="<?php echo $company_info['ID_COMPANY']; ?>" >
                <input id="company-id-interview-note" name="company_id" type="hidden" class="form-control" maxlength="30"  value="<?php echo $company_info['ID_COMPANY']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="company-name-disabled-interview-note">Company Name</label>
            <div class="col-sm-4">
                <input id="company-name-disabled-interview-note" name="company_name_disabled" type="text" class="form-control" maxlength="50" disabled="disabled" value="<?php echo $company_info['NM_COMPANY']; ?>">
                <input id="company-name-interview-note" name="company_name" type="hidden" class="form-control" maxlength="50" value="<?php echo $company_info['NM_COMPANY']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="interview-note-1">Interview 1</label>
            <div class="col-sm-8">
                <textarea id="interview-note-1" autofocus name="interview_1" class="text-counter-js form-control" rows="10" cols="20" maxlength="4900"><?php if (isset($company_profile['TX_NOTES_1'])) echo $company_profile['TX_NOTES_1'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="interview-note-2">Interview 2</label>
            <div class="col-sm-8">
                <textarea id="interview-note-2" name="interview_2" class="text-counter-js form-control" rows="10" cols="20" maxlength="4900"><?php if (isset($company_profile['TX_NOTES_2'])) echo $company_profile['TX_NOTES_2'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="interview-note-3">Interview 3</label>
            <div class="col-sm-8">
                <textarea id="interview-note-3" name="interview_3" class="text-counter-js form-control" rows="10" cols="20" maxlength="4900"><?php if (isset($company_profile['TX_NOTES_3'])) echo $company_profile['TX_NOTES_3'];?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
                <button id="save-create-interview" type="submit" name="submit" value="Save" class="btn--consapp btn btn-primary">Save</button>
                <button id="submit-create-interview" type="submit" name="submit" value="Submit" class="btn--consapp btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>