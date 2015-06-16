<?php echo link_tag('css/themes/bg-4.css'); ?>

<h3 class="custom-page-header">Manage Training Session</h3>
<p class="custom-page-description">&nbsp;</p>
<div class="well">
    <form class="form-horizontal" action="<?php echo site_url('training_session/filters'); ?>" method="post" novalidate>
        <?php echo form_hidden(array('name' => 'txt_search', 'value' => $txt_search)); ?>
        <?php echo form_hidden(array('name' => 'PER_IN_PAGE', 'value' => $per_in_page)); ?>
        <?php echo form_hidden(array('name' => 'ACTOR', 'value' => $actor)); ?>
        <?php echo form_hidden(array('name' => 'SORT', 'value' => $sort)); ?>

        <div class="form-group">
            <div class="col-sm-12">
                <a class="btn btn-default" href="<?php  echo site_url('training_session/create'); ?>">Create New Session</a>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3" for="ID_SESSION" title="Session ID and Session Name">Training Session:</label>
            <div class="col-sm-6">
                <input id="ID_SESSION" name="ID_SESSION" type="text" class="form-control" autofocus placeholder="Enter Session ID, Session Name" value="<?php
                if( isset($data_search)){
                    $temp = htmlentities($data_search);
                    echo ($temp);
                }
                ?>">
                <label class="radio-inline">
                    <?php
                    $checked1 = false;
                    $checked2 = false;
                    if( isset($filter) && $filter != ''){
                        if($filter == 2) {$checked2 = 'checked';} else
                            if($filter == 1) {$checked1 = 'checked';}
                    } else $checked1 = true;

                    echo form_radio(array('name' => 'filter', 'id' => 'filter1', 'value' => '1', 'checked' => $checked1));
                    ?>
                    Open Only
                </label>
                <label class="radio-inline">
                    <?php echo form_radio(array('name' => 'filter', 'id' => 'filter2', 'value' => '2', 'checked' => $checked2)); ?>
                    All
                </label>
            </div>
            <br class="visible-xs">
            <div class="col-sm-3">
                <input type="submit" name="action" value="Search" class="btn btn-primary">
            </div>
        </div>
        <?php
        if (isset($result_search)) {
            if (!empty($result_search)) {?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table--consapp">
                        <colgroup>
                            <col width="70">
                            <col>
                            <col>
                            <col width="70">
                            <col width="315">
                        </colgroup>
                        <thead>
                        <tr>
                            <th id="sort_1" class="text-center">S/No</th>
                            <th id="sort_2">Session ID</th>
                            <th id="sort_3">Session Name</th>
                            <th id="sort_4" class="text-center">Status</th>
                            <th id="sort_5" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($result_search as $key => $value){?>
                            <tr>
                                <td class="text-center">
                                    <?php if ($sort == 'asc') {
                                        echo (++$offset);
                                    } else {
                                        echo ($offset--);
                                    }?>
                                </td>
                                <td><?php echo isset($value['NM_SESSION_NAME'])? $value['NM_SESSION_NAME']: '';?></td>
                                <td><?php echo isset($value['NM_SESSION']) ? $value['NM_SESSION']: '';?></td>
                                <td class="text-center">
                                    <?php if($value['ID_STATUS']==0){echo 'Open';} else {echo 'Closed';} ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="<?php echo site_url('training_session/edit').'/'.$value['ID_SESSION']; ?>">View/Update Info</a>
                                    <a class="btn btn-info" href="<?php echo site_url('participants/filters').'/'.$value['ID_SESSION']; ?>">Manage Participants</a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                ?>
                <div class="text-center">
                    <em>Can't find Training Session.</em>
                </div>
            <?php
            }
        }
        ?>
    </form>
    <nav class="text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </nav>
</div>