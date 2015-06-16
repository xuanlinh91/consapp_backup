<?php echo link_tag('css/themes/bg-4.css'); ?>
<h3 class="custom-page-header">Training</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form class="form-horizontal" action="<?php  echo site_url('report/training/0'); ?>" method="post" novalidate>
        <div class="row">
            <div class="col-sm-4 col-sm-push-8 col-md-3 col-md-push-9">
                <p>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('report/search'); ?>" title="Search">Search</a>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('report/reports'); ?>" title="Reports">Reports</a>
                    <a class="btn btn-info btn-block" href="<?php echo site_url('report/training'); ?>" title="Training">Training</a>
                </p>
            </div>
            <div class="col-sm-8 col-sm-pull-4 col-md-9 col-md-pull-3">
                <input type="hidden" name="txt_search" value="<?php if (isset($txt_search)) { echo $txt_search; } ?>">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="manage-report-training-txt-search" >Participant Name</label>
                    <div class="col-sm-9 col-md-7">
                        <input id="manage-report-training-txt-search" name="manage-report-training-txt-search" type="text" class="form-control company-name-report-filter-js" autofocus placeholder="Enter Participant Name" value="<?php
                        if( isset($data_search)){
                            $temp = htmlentities($data_search);
                            echo ($temp);
                        }
                        ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="agency-report-management" title="Agency">Agency</label>
                    <div class="col-sm-9 col-md-7">
                        <?php echo form_dropdown('organisation', $org_info, isset($organisation) ? $organisation : '' , 'id="agency-report-management" class="custom-select-chosen-js form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="start-date-report-management" title="From">Survey Completion Date <span class="text-danger">*<span></label>
                    <div class="col-sm-4 col-md-3">
                        <div class="input-group">
                            <?php
                            $value = (isset($DT_START) ? $DT_START : '');
                             echo form_input(array('name' => 'DT_START', 'id' => 'start-date-report-management', 'required' => 'required', 'maxlength' => 10, 'value' => $value, 'readonly' => "readonly", 'class' => 'start-date-calendar-js form-control col-sm-3')); ?>
                            <label class="input-group-addon" for="start-date-report-management"><i class="fa fa-calendar"></i></label>
                        </div>
                    </div>

                    <label class="control-label col-sm-1" for="end-date-report-management" title="To">to</label>
                    <div class="col-sm-4 col-md-3">
                        <div class="input-group">
                            <?php
                            $value = (isset($DT_END) ? $DT_END : '');
                            echo form_input(array('name' => 'DT_END', 'id' => 'end-date-report-management', 'required' => 'required', 'maxlength' => 10, 'value' => $value, 'readonly' => "readonly", 'class' => 'end-date-calendar-js form-control col-sm-3'));
                            ?>
                            <label class="input-group-addon" for="end-date-report-management"><i class="fa fa-calendar"></i></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9 custom-btn-groups">
                        <input type="submit" name="action" value="Search" class="btn btn-primary" />
                    </div>

                </div>

                <hr>

            </div>
        </div>
    <?php
    if (isset($result_search)) {

        if (!empty($result_search)) {?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table--consapp">
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col width="70">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>Participants Email</th>
                        <th>Participants Name</th>
                        <th>Agency</th>
                        <th>Date of Training</th>
                        <th>Account ID</th>
                        <th class="text-center">Pass</th>
                    </tr>
                    </thead>
                    <tbody><?php
                    foreach ($result_search as $value) {
                        $temp = explode(' ', $value['DT_START']);
                        ?>
                        <tr>
                            <td><?php echo $value['NM_EMAIL']?></td>
                            <td><?php echo $value['NM_PARTICIPANT']?></td>
                            <td><?php echo $value['NM_ORGANISATION']?></td>
                            <td><?php echo $temp[0]?></td>
                            <td><?php echo isset($value['ID_LOGIN'])? $value['ID_LOGIN'] : '';  ?></td>
                            <td class="text-center"><?php echo isset($value['ID_LOGIN'])? 'X' : '';  ?></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <nav class="text-center">
                        <?php if (isset($pagination)) {
                            echo $pagination;
                        } ?>
                    </nav>
                </div>
                <div class="col-sm-2">
                    <input type="submit" name="action" value="Export" class="btn btn-info btn-block" />
                </div>
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
</div>