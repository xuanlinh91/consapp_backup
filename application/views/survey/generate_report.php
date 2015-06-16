<?php echo link_tag('css/themes/bg-1.css'); ?>


<h3 class="custom-page-header">Generate Report</h3>

<div class="row">
    <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <nav class="custom-menu-list">
                    <ul class="list-unstyled">
                        <li><a target="_blank" href="<?php echo site_url('report/download_report/'.$ID_COMPANY.'/'.$ID_SURVEY.'/1'); ?>" class="btn btn-block" title="Create User Profile">Generate Internal Report</a></li>
                        <li><a target="_blank" href="<?php echo site_url('report/download_report/'.$ID_COMPANY.'/'.$ID_SURVEY.'/2'); ?>" class="btn btn-block" title="Show All User">Generate External Report</a></li>
                        <li><a target="_blank" href="<?php echo base_url('files/HRMD_Survey_Booklet_2015.pdf'); ?>" class="btn btn-block" title="Show All User">Download Survey Booklet</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>