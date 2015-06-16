<?php
if(!isset($question['url_background']))
{
  $question['url_background'] = 'img/background/burj-khalifa-aka-burj-duba.jpg';
}
$optinal_answers = array(137, 138, 139);
$optinal_questions = array(32, 33, 34);
?>

<style type="text/css">
  body {
    background-image: url("<?php echo base_url() . $question['url_background']; ?>");
  }
</style>

<h3 class="custom-page-header"><?php if( isset($question['nm_category']) && isset($step) ) echo $question['nm_category']; ?></h3>
<p class="custom-page-description">
  <?php if ( isset($question['nm_question']) ) echo $step . '. '.$question['nm_question']; ?>
  <?php  if (isset($question['id_question'])) { 
    if(in_array($question['id_question'], $optinal_questions)) {
      //echo " <i>(Optional)</i>";
    } 
  }
  ?>
</p>
<div class="navbar pull right">
  <div class="navbar-inner">
    <?php $last_answer = ($last_answer == '34') ? 33 : $last_answer; ?>
    <form action="<?php if(isset($id_company) && isset($step)) echo site_url("survey/goto_survey/$id_company/$step");?>" method="post" class="form-horizontal search" novalidate id="cpa_form">
      <select name="no_question">
        <option value="1" >Question 1</option>
        <?php for ($i = 1; $i <= $last_answer; $i++) : ?>
          <option value="<?php echo $i+1; ?>" <?php if ($i+1 == $step) : ?> selected = "selected" <?php endif; ?>>Question <?php echo $i+1; ?></option>
        <?php endfor; ?>
      </select>
      <input name="go_to_id_survey" type="hidden" value="<?php if(isset($id_survey) && !empty($id_survey) ){echo $id_survey;} ?>">
      <button name="submit" type="submit" class="btn btn-primary pull-right" value="Search">Goto</button>
    </form>
  </div>
</div>
<div class="well">
  <form action="<?php echo site_url("survey/processing_take_survey"); ?>" method="post" class="form-horizontal">
    <?php
    if( isset( $question['id_question'] ) ){
      echo form_hidden('id_question', $question['id_question']);
    }

    if( isset( $question['nm_category'] ) ){
      echo form_hidden('nm_category', $question['nm_category']);
    }

    if(isset($option) && !is_null($option)){

      foreach ($option as $key => $value) {
        $hide = '';
        $checked = '';
        if (in_array($value['ID_ANSWER'], $optinal_answers)) {
          $hide = 'style="display:none;"';
        }
        if (isset($id_answer)) {
          if ($id_answer == $value['ID_ANSWER']) $checked = 'checked';
        }
        // elseif (in_array($value['ID_ANSWER'], $optinal_answers)) {
        //   $checked = '';
        // }
        ?>
        <?php if ($hide == '') : ?>
        <div class="radio" <?php echo $hide; ?>>
          <label>
            <input name="id_answer" type="radio" value="<?php if (isset($value)) echo $value['ID_ANSWER']; ?>" <?php echo $checked; ?>>
            <?php echo $value['NM_ANSWER']; ?>
          </label>
        </div>
      <?php endif; ?>
        <?php
      }
    }
    ?>
    <hr>
    <div class="form-group">
      <div class="col-sm-12">
        <?php if(isset($step) && is_numeric($step)) : ?>
          <input name="nm_company" type="hidden" value="<?php if(isset($nm_company) && !empty($nm_company) ){echo $nm_company;} ?>">
          <input id="submit_step" name="submit_step" type="hidden" value="<?php if(isset($step) && !empty($step) ){echo $step;} ?>">
          <input name="submit_id_survey" type="hidden" value="<?php if(isset($id_survey) && !empty($id_survey) ){echo $id_survey;} ?>">
          <?php if (($step != 34 && $step != 31)  || ($step == 31 && !$is_overseas)) : ?>
            <button name="submit" type="submit" value="Next" class="btn--consapp btn btn-primary pull-right" autofocus>Next</button>
          <?php endif; ?>
          <?php if ($step == 34 || ($step == 31 && $is_overseas)) : ?>
            <button name="submit" type="submit" value="Save" class="btn--consapp btn btn-primary pull-right" autofocus>Save Survey Responses</button>
          <?php endif; ?>
          <?php if ($step != 1) : ?>
            <button type="submit" name="submit" value="Previous" class="btn--consapp btn btn-primary pull-left">Previous</button>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </form>
</div>