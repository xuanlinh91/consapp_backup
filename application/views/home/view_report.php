<script type="text/javascript">
    var page = "report-view";
</script>
<h3 class="custom-page-header">View Reports</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <?php
    echo form_open('', array('class' => 'form-horizontal', 'novalidate' => 'novalidate'));
    ?>
    <div class="form-group">
        <label class="control-label col-sm-5" for="company-id-view-report">UEN</label>

        <div class="col-sm-4">
            <?php echo form_input(array('id' => 'company-id-view-report', 'value' => isset($ID_COMPANY)? $ID_COMPANY: null, 'readonly' => 'readonly', 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5" for="company-name-view-report">Company Name</label>

        <div class="col-sm-4">
            <?php echo form_input(array('id' => 'company-name-view-report', 'value' => isset($NM_COMPANY)? $NM_COMPANY: null, 'readonly' => 'readonly', 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5" for="company-name-view-report">Industry</label>

        <div class="col-sm-4">
            <?php echo form_input(array('id' => 'company-name-view-report', 'value' => isset($NM_INDUSTRY)? $NM_INDUSTRY: null, 'readonly' => 'readonly', 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table--consapp">
            <colgroup>
                <col>
                <col>
                <col>
                <col>
                <col>
                <?php if(is_spadmin_hp($userdata)){?>
                    <col width="490">
                <?php } else {?>
                    <col width="290">
                <?php }?>

            </colgroup>
            <thead>
            <tr>
                <th>Year</th>
                <th>Survey ID</th>
                <th>Date Survey Completed</th>
                <th>Agency</th>
                <th>Lead Officer</th>
                <th class="text-center">Report</th>
            </tr>
            </thead>
            <tbody><?php if (isset($result) && count($result) > 0) {
             foreach ($result as $key => $value) {?>
                    <tr class="gradeC">
                            <td><?php echo $value['year']; ?></td>
                            <td><?php echo isset($value['ID_SURVEY']) ? $value['ID_SURVEY']: NULL; ?></td>
                            <td><?php $dt = explode(' ', $value['DT_END']); echo isset($dt) ? $dt[0]: NULL; ?></td>
                            <td><?php echo isset($value['agency']) ? $value['agency'] : NULL ; ?></td>
                            <td><?php echo isset($value['officer']) ? $value['officer'] : NULL ; ?></td>
                            <td class="text-center">
                                <?php if($value['type_report'] == 0){ ?>
                                    <a href="<?php echo site_url("report/download_report/".$ID_COMPANY."/".$value['ID_SURVEY']."/1")?>" class="internal-report-view-report-js btn btn-info">Internal Reports</a>
                                <?php } ?>
                                <a href="<?php echo site_url("report/download_report/".$ID_COMPANY."/".$value['ID_SURVEY']."/2")?>" class="external-report-view-report-js btn btn-info">External Reports</a>
                                <?php if(is_spadmin_hp($userdata)){?>
                                    <a href="<?php echo site_url("company_profile/delete_profile/".$value['ID_AI'].'/'.$ID_COMPANY_AI)?>" class="delete-profile-view-report-js btn btn-info">Delete Survey</a>
                                <?php } ?>
                            </td>

                    </tr>
            <?php
             }}
            ?>
            </tbody>
        </table>
    </div>
    <?php echo form_close(); ?>
    <nav class="text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </nav>

</div>