<?php echo link_tag('css/themes/bg-4.css');?>

<h3 class="custom-page-header">Compute Norm Score</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php echo form_open(site_url('norm/'), array('class' => 'form-horizontal', 'novalidate' => 'novalidate')); ?>
    <div class="form-group">
        <label class="control-label col-sm-7">To process the Norm Score, click on the below button.</label>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="start-date-norm-compute">Start Date <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <div class="input-group">
                <?php $value = (isset($DT_START) ? $DT_START : ''); echo form_input(array('id' => 'start-date-norm-compute',
                    'name' => 'DT_START', 'value' => $value, 'readonly' => "readonly", 'class' => 'norm-start-date-calendar-js form-control')); ?>
                <label for="start-date-norm-compute" class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="end-date-norm-compute">End Date <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <div class="input-group">
                <?php $value = (isset($DT_END) ? $DT_END : ''); echo form_input(array('id' => 'end-date-norm-compute',
                    'name' => 'DT_END', 'value' => $value, 'readonly' => "readonly", 'class' => 'norm-end-date-calendar-js form-control')); ?>
                <label for="end-date-norm-compute" class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
            <input name="action" type="submit" class="btn btn-primary" value="Process Norm Score">
        </div>
    </div>
    <?php echo form_close(); ?>
</div>