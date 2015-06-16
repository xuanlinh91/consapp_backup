<h3 class="custom-page-header">Rename survey</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php
    echo form_open('users/admin_update', array('class' => 'form-horizontal', 'novalidate' => 'novalidate'));
    ?>
    <?php
    $value = (isset($user_info[0]['ID_SURVEY']) ? $user_info[0]['ID_SURVEY'] : '');
    $hidden_data = array(
        'id_survey'  => $value
    );

    echo form_hidden($hidden_data);
    ?>

    <div class="form-group">
        <div class="controls">
            <div class="form-actions">
                <button type="reset" class="btn--consapp btn btn-primary">Reset</button>
                <button type="submit" class="btn--consapp btn btn-primary">Save</button>
            </div>
        </div>
    </div>
    <?php
    echo form_close();
    ?>
</div>