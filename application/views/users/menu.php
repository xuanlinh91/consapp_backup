<?php echo link_tag('css/themes/bg-5.css'); ?>

<h3 class="custom-page-header">Accounts Management</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="row">
    <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
        <div class="panel panel--no-background">
            <div class="panel-body">
                <nav class="custom-menu-list">
                    <ul class="list-unstyled">
                        <li><a href="<?php echo site_url('users/create'); ?>" class="btn btn-block" title="Create User Profile">Create New User</a></li>
                        <li><a href="<?php echo site_url('users/filters'); ?>" class="btn btn-block" title="Show All User">Edit/Delete User</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>