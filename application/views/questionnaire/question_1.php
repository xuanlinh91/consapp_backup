<?php echo link_tag('css/themes/bg-6.css'); ?>

<h3 class="custom-page-header">Questionnaires</h3>
<p class="custom-page-description">Company's Current Growth Stage</p>

<div class="well">
    <form action="<?php echo site_url('questionnaires/submit_question_1'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="step" value="1">
        <input type="hidden" name="id_company" value="<?php echo $company_profile['ID_COMPANY']; ?>">

        <h4>Q1: Most important business priorities or challenges?</h4>
        <br>
        <?php
        if (isset($question_1) && !is_null($question_1)) {
            foreach ($question_1 as $key => $value) {
                ?>
                <div class="radio">
                    <label>
                        <input name="ID_GS1" type="radio" value="<?php echo $question_1[$key]['ID_GS']; ?>"<?php if (isset($company_profile['ID_GS1'])) if ($company_profile['ID_GS1'] == $question_1[$key]['ID_GS']) echo ' checked'; ?> >
                        <?php echo $question_1[$key]['VALUE']; ?>
                    </label>
                </div>
            <?php
            }
        }
        ?>

        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <input name="key_page" type="hidden" value="<?php if ($this->session->userdata('STEP_1') && $this->session->userdata['STEP_1']['key_page']) { echo $this->session->userdata['STEP_1']['key_page']; } ?>">
                <button name="submit" type="submit" value="NEXT" class="btn--consapp btn btn-primary pull-right">Next</button>
                <button name="submit" type="submit" value="BACK" class="btn--consapp btn btn-primary pull-left">Back</button>
            </div>
        </div>
    </form>
</div>