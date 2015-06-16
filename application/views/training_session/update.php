<?php echo link_tag('css/themes/bg-4.css'); ?>

<h3 class="custom-page-header">Update Training Session</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php echo form_open('training_session/edit', array('class' => 'form-horizontal', 'novalidate' => 'novalidate')); ?>
    <?php
    if(isset($session_info[0]['ID_SESSION_HIDDEN'])){
        $value = $session_info[0]['ID_SESSION_HIDDEN'];
    }

    $hidden_data = array(
        'ID_SESSION_HIDDEN'  => $value,
    );

    echo form_hidden($hidden_data);
    ?>
    <div class="form-group">
        <label class="control-label col-sm-3" for="session-no-update-training-session">Session No <span class="text-danger">*<span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            if (isset($session_info[0]['ID_SESSION'])){
                $value = $session_info[0]['ID_SESSION'];
            }

            echo form_input(array('id' => 'session-no-update-training-session', 'name' => 'ID_SESSION', 'value' => $value, 'disabled' => 'disabled', 'class' => 'form-control'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="session-name-update-training-session">Name <span class="text-danger">*<span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            $value = (isset($session_info[0]['NM_SESSION']) ? $session_info[0]['NM_SESSION'] : '');
            echo form_input(array('id' => 'session-name-update-training-session', 'name' => 'NM_SESSION', 'value' => htmlspecialchars_decode($value), 'class' => 'form-control', 'autofocus' => 'autofocus'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="start-date-update-training-session">Start Date <span class="text-danger">*</span></label>

        <div class="col-sm-8 col-md-6 col-lg-5">
            <div class="input-group">
                <?php $value = (isset($session_info[0]['DT_START']) ? $session_info[0]['DT_START'] : ''); echo form_input(array('name' => 'DT_START','id' => 'start-date-update-training-session', 'value' => $value, 'readonly' => "readonly", 'class' => 'start-date-calendar-js form-control')); ?>
                <label for="start-date-update-training-session" class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="end-date-update-training-session">End Date <span class="text-danger">*</span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <div class="input-group">
                <?php $value = (isset($session_info[0]['DT_END']) ? $session_info[0]['DT_END'] : ''); echo form_input(array('name' => 'DT_END','id' => 'end-date-update-training-session', 'value' => $value, 'readonly' => "readonly", 'class' => 'end-date-calendar-js form-control')); ?>
                <label for="end-date-update-training-session" class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="trainer-update-training-session">Trainer</label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            $value = (isset($session_info[0]['NM_TRAINER']) ? $session_info[0]['NM_TRAINER'] : '');
            echo form_input(array('id' => 'trainer-update-training-session', 'name' => 'NM_TRAINER', 'class' => 'form-control', 'value' => $value));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3" for="venue-update-training-session">Venue</label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php
            $value = (isset($session_info[0]['NM_VENUE']) ? $session_info[0]['NM_VENUE'] : '');
            echo form_input(array('id' => 'venue-update-training-session', 'name' => 'NM_VENUE', 'class' => 'form-control', 'value' => $value));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="status-update-training-session">Status <span class="text-danger">*<span></label>
        <div class="col-sm-8 col-md-6 col-lg-5">
            <?php echo form_dropdown('ID_STATUS', $status_info, $session_info[0]['ID_STATUS'], 'id="status-update-training-session" class="custom-select-chosen-js form-control"'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
            <input type="hidden" name="action" value="Update" />
            <input type="submit" name="submit" id="update_submit" value="Update" class="btn--consapp btn btn-primary" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>