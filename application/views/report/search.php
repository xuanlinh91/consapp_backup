<?php echo link_tag('css/themes/bg-4.css'); ?>
<h3 class="custom-page-header">Search</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form class="form-horizontal" action="<?php  echo site_url('report/search'); ?>" method="post" novalidate>
        <div class="row">
            <div class="col-sm-4 col-sm-push-8 col-md-3 col-md-push-9">
                <p>
                    <a class="btn btn-info btn-block" href="<?php echo site_url('report/search'); ?>" title="Search">Search</a>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('report/reports'); ?>" title="Reports">Reports</a>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('report/training'); ?>" title="Training">Training</a>
                </p>
            </div>
            <div class="col-sm-8 col-sm-pull-4 col-md-9 col-md-pull-3">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-search-input-js" title="Agency">Company Name</label>
                            <div class="col-sm-6">
                                <?php echo form_input(array('id' => 'manage-report-search-input-js', 'name' => 'NM_COMPANY', 'class' => 'form-control', 'maxlength' => 50, 'autofocus' => 'autofocus', 'value' => isset($NM_COMPANY_SELECT)? $NM_COMPANY_SELECT: '')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-manage-style" title="Agency">Company Current Management Style</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('ID_MS2', $Management_Style, isset($ID_MS2_SELECT) ? $ID_MS2_SELECT : '' , 'id="manage-report-manage-style" class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-industry" title="Agency">Industry</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('NM_INDUSTRY', $Company_Industry, isset($NM_INDUSTRY_SELECT) ? $NM_INDUSTRY_SELECT : '' ,
                                    'id="manage-report-industry" class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-leadership" title="Agency">Leadership Commitment to HR Development</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('ID_LC3', $Leader_Ship, isset($ID_LC3_SELECT) ? $ID_LC3_SELECT : '' ,
                                    'id="manage-report-leadership" class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-scope" title="Agency">Scope of Operations</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('NM_SCOPE', $Scope_Of_Operation, isset($NM_SCOPE_SELECT) ? $NM_SCOPE_SELECT : '' ,
                                    'id="manage-report-scope" class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-revenue" title="Agency">Revenue</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('REVENUE', $Revenue, isset($REVENUE_SELECT) ? $REVENUE_SELECT : '' , 'id="manage-report-revenue"
                        class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-company-type" title="Agency">Company Type</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('NM_TYPE', $Company_Type, isset($NM_TYPE_SELECT) ? $NM_TYPE_SELECT : '' , 'id="manage-report-company-type"
                        class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="manage-report-team-size" title="Agency">Total HR Team Size</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('N_L_HR', $HR_Staff, isset($N_L_HR_SELECT) ? $N_L_HR_SELECT : '' , 'id="manage-report-team-size"
                        class="custom-select-chosen-js form-control"'); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3" for="manage-report-growth-stage" title="Agency">Company Growth Stage</label>
                    <div class="col-sm-3">
                        <?php echo form_dropdown('ID_GS1', $Growth_Stage, isset($ID_GS1_SELECT) ? $ID_GS1_SELECT : '' , 'id="manage-report-growth-stage"
                        class="custom-select-chosen-js form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="officer-1-name-report-management" title="Officer 1">Officer 1 Name</label>
                    <div class="col-sm-3">
                        <?php echo form_dropdown('officer_1', $User_List, isset($officer_1_SELECT) ? $officer_1_SELECT : '' , 'id="officer-1-name-report-management"
                        class="custom-select-chosen-js form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="officer-2-name-report-management" title="Officer 2">Officer 2 Name</label>
                    <div class="col-sm-3">
                        <?php echo form_dropdown('officer_2', $User_List, isset($officer_2_SELECT) ? $officer_2_SELECT : '' , 'id="officer-2-name-report-management"
                        class="custom-select-chosen-js form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="start-date-report-management" title="From">Survey Completion Date <span class="text-danger">*<span></label>
                    <div class="col-sm-4 col-md-3">
                        <div class="input-group">
                            <?php
                            if (isset($DT_START_SELECT) && $DT_START_SELECT != null) {
                                $value = $DT_START_SELECT;
                            } else {
                                $value = '' ;
                            }
                             echo form_input(array('name' => 'DT_START', 'id' => 'start-date-report-management', 'value' => $value, 'readonly' => "readonly",
                                 'class' => 'start-date-calendar-js form-control col-sm-3')); ?>
                            <label class="input-group-addon" for="start-date-report-management"><i class="fa fa-calendar"></i></label>
                        </div>
                    </div>

                    <label class="control-label col-sm-1" for="end-date-report-management" title="To">to</label>
                    <div class="col-sm-4 col-md-3">
                        <div class="input-group">
                            <?php
                            if (isset($DT_END_SELECT) && $DT_END_SELECT != null) {
                                $value = $DT_END_SELECT ;
                            } else {
                                $value = '';
                            }
                            echo form_input(array('name' => 'DT_END', 'id' => 'end-date-report-management', 'value' => $value, 'readonly' => "readonly",
                                'class' => 'end-date-calendar-js form-control col-sm-3'));
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
        if (!empty($result_search)) {
            ?>
            <div class="table-responsive">
                <table id="search-results-management-reports" class="table table-bordered table-striped table-hover table--consapp">
                    <thead>
                    <tr>
                        <?php
                        $columnIndex = 1;
                        foreach ($title_col as $key => $value) {
                            ?>
                            <th class="column-<?php echo $columnIndex; ?> text-center"><?php echo $value;?></th>
                            <?php
                            $columnIndex++;
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody><?php
                    foreach ($result_search as $key => $value) {?>
                        <tr>
                            <?php
                            foreach ($value as $cellKey => $cellValue) {
                                ?>
                                <td class="<?php // if (is_numeric($cellValue)) echo 'text-right'; ?>"><?php echo $cellValue; ?></td>
                            <?php
                            }?>
                        </tr>
                    <?php
                    }
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
                <em>Can't find Survey.</em>
            </div>
        <?php
        }
    }
    ?>
    </form>
</div>