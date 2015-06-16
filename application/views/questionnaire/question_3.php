<?php echo link_tag('css/themes/bg-6.css'); ?>
<h3 class="custom-page-header">Questionnaires</h3>
<p class="custom-page-description">Leadership Commitment to Human Capital Development</p>

<div class="well">
    <form action="<?php  echo site_url('questionnaires/submit_question_3'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="id_company" value="<?php echo $company_profile['ID_COMPANY']; ?>">
        <div class="control-group">
            <h4>Q3: Leaderships’ commitment to Human Capital Development.</h4>
            <br>
            <?php
            if(isset($question_3) && !is_null($question_3)){
                foreach ($question_3 as $key => $value) {
                    ?>
                    <div class="radio">
                        <label>
                            <input name="ID_LC3" type="radio" value="<?php echo $question_3[$key]['ID_GS']; ?>"<?php if (isset($company_profile['ID_LC3'])) if ($company_profile['ID_LC3'] == $question_3[$key]['ID_GS']) echo ' checked'; ?> > <?php echo $question_3[$key]['VALUE']; ?>
                        </label>
                    </div>
                <?php
                }
            }
            ?>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <input name="step" type="hidden" value="3">
                <input name="key_page" type="hidden" value="<?php if ($this->session->userdata('STEP_1') && $this->session->userdata['STEP_1']['key_page']) { echo $this->session->userdata['STEP_1']['key_page']; } ?>">
                <button name="submit" type="submit" value="SAVE" class="btn--consapp btn btn-primary pull-right">Save</button>
                <button name="submit" type="submit" value="BACK" class="btn--consapp btn btn-primary pull-left">Back</button>
            </div>
        </div>
    </form>
</div>