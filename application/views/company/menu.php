<?php echo link_tag('css/themes/bg-1.css'); ?>

<h3 class="custom-page-header">Company Info</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="row">
    <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <nav class="custom-menu-list">
                    <?php if (is_admin_hp($userdata) || is_user_hp($userdata)) { ?>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo site_url('company/create'); ?>" class="btn btn-block" title="Create Company Info">Create Company Info</a></li>
                            <li><a href="<?php echo site_url('company/filters'); ?>" class="btn btn-block" title="Edit Company Info">Edit Company Info</a></li>
                        </ul>
                    <?php } ?>
                </nav>
            </div>
        </div>
    </div>
</div>