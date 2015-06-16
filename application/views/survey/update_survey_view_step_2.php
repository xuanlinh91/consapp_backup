<?php
if(!isset($question['url_background']))
{
    $question['url_background'] = 'img/background/burj-khalifa-aka-burj-duba.jpg';
}
?>

<style type="text/css">
    body {
        background-image: url("<?php echo base_url() . $question['url_background']; ?>");
    }
</style>

<?php
	preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
?>
<div id="my" class="navbar navbar-inverse pull right">
    <div class="navbar-inner">
        <!-- Main Navigation: Register-->
        <form action="<?php if( isset( $nm_company ) && isset($step) ){ echo site_url("survey/goto_survey/$nm_company/$step"); } ?>" method="post" class="form-horizontal search" novalidate id="cpa_form">
            <?php
            if (count($matches)>1){
                $version = $matches[1];
                if($version<=9){?>
                    <input name="no_question" type="number" min="1" max="34" value="<?php echo $step; ?>">
                <?php   }else{ ?>
                    <input name="no_question" type="number" min="1" max="34" value="<?php echo $step; ?>" placeholder="Question No.">
                <?php
                }
            }else{?>
                <input type="number" name="no_question" min="1" max="34" placeholder="Question No." value="<?php echo $step; ?>">
            <?php
            }	?>
            <button name="submit" type="submit" class="btn btn-primary pull-right" value="Search">Search</button>
        </form>
    </div>
</div>

<h3 class="custom-page-header"><?php if( isset($question['nm_category']) && isset($step) ) echo $question['nm_category']; ?></h3>
<p class="custom-page-description"><?php if( isset($question['nm_question']) ) echo (int)$step . '. ' .$question['nm_question']; ?></p>

<div class="well">
    <form action="<?php echo site_url("survey/processing_update_survey"); ?>" method="post" class="form-horizontal" novalidate id="hqp-from">
        <?php
        if( isset( $question['id_question'] ) ){
            echo form_hidden('id_question', $question['id_question']);
        }

        if( isset( $question['nm_category'] ) ){
            echo form_hidden('nm_category', $question['nm_category']);
        }
        ?>
        <?php
        if(isset($option) && !is_null($option)){
            foreach ($option as $key => $value) {
                ?>
				    <div class="radio">
                        <label>
                            <input name="id_answer" type="radio" value="<?php if(isset($value)) echo $value['ID_ANSWER']; ?>"<?php if (isset($id_answer)) { if ($id_answer == $value['ID_ANSWER']) { echo " checked"; } } ?>>
                            <?php echo $value['NM_ANSWER']; ?>
                        </label>
                    </div>
                <?php
            }
        }
        ?>

        <div class="form-group">
            <div class="col-sm-12">
                <?php
                if(isset($step) && is_numeric($step)) {
                    if($step != 1)
                    {
                        ?>
                        <button type="submit" name="submit" value="Previous" class="btn--consapp btn pull-left">Previous</button>
                    <?php
                    }
                    ?>

                    <?php
                    if($step != 34)
                    {
                        ?>
                        <button name="submit" type="submit" value="Save_Current" class="btn--consapp btn center-block">Save</button>
                        <button id="Next" name="submit" type="submit" value="Next" class="btn--consapp btn pull-right" autofocus>Next</button>
                    <?php
                    }
                    if($step == 34)
                    {
                        ?>
                        <button name="submit" type="submit" value="Save" class="btn--consapp btn pull-right" autofocus>Save Survey Responses</button>
                        <button name="submit" type="submit" value="Save" class="btn--consapp btn pull-right" autofocus>Save Survey Responses</button>
                    <?php
                    }
                }
                ?>

                <input type="hidden" name="nm_company" value="<?php if(isset($nm_company) && !empty($nm_company) ){echo $nm_company;} ?>">
                <input type="hidden" name="submit_step" id="submit_step" value="<?php if(isset($step) && !empty($step) ){echo $step;} ?>">
                <input type="hidden" name="submit_id_survey" value="<?php if(isset($id_survey) && !empty($id_survey) ){echo $id_survey;} ?>">
            </div>
        </div>
    </form>
</div>