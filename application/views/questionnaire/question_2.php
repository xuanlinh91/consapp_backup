<?php echo link_tag('css/themes/bg-6.css'); ?>

<h3 class="custom-page-header">Questionnaires</h3>
<p class="custom-page-description">Company's Current Management Style</p>

<div class="well">
    <form action="<?php  echo site_url('questionnaires/submit_question_2'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="step" value="2">
        <input type="hidden" name="id_company" value="<?php echo $company_profile['ID_COMPANY']; ?>">
        <h4>Q2: Management Style?</h4>
        <br>
        <?php
        if(isset($question_2) && !is_null($question_2)){
            foreach ($question_2 as $key => $value) { ?>
                <div class="radio">
                    <label>
                        <input name="ID_MS2" type="radio" value="<?php echo $question_2[$key]['ID_GS']; ?>"<?php if (isset($company_profile['ID_MS2'])) if ($company_profile['ID_MS2'] == $question_2[$key]['ID_GS']) echo ' checked'; ?> >
                        <?php echo $question_2[$key]['VALUE']; ?>
                    </label>
                </div>
            <?php
            }
        }
        ?>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="hidden" name="key_page" value="<?php if ($this->session->userdata('STEP_1') && $this->session->userdata['STEP_1']['key_page']) { echo $this->session->userdata['STEP_1']['key_page']; } ?>">
                <button name="submit" type="submit" value="NEXT" class="btn--consapp btn btn-primary pull-right">Next</button>
                <button name="submit" type="submit" value="BACK" class="btn--consapp btn btn-primary pull-left">Back</button>
            </div>
        </div>
    </form>
</div>