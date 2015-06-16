<?php echo link_tag('css/themes/bg-5.css'); ?>

<h3 class="custom-page-header">Search User</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php echo site_url('users/filters'); ?>" method="post" class="form-horizontal" novalidate>
        <?php echo form_hidden(array('name' => 'txt_search', 'value' => $txt_search)); ?>
        <?php echo form_hidden(array('name' => 'data_search', 'value' => $data_search)); ?>
        <?php echo form_hidden(array('name' => 'PER_IN_PAGE', 'value' => $per_in_page)); ?>
        <?php echo form_hidden(array('name' => 'ACTOR', 'value' => $actor)); ?>
        <?php echo form_hidden(array('name' => 'SORT', 'value' => $sort)); ?>

        <div class="form-group">
            <label class="control-label col-sm-3" for="ID_LOGIN" title="User ID and User Name">User:</label>
            <div class="col-sm-6">
                <input type="text" id="ID_LOGIN" name="ID_LOGIN" class="form-control" autofocus placeholder="Enter User ID, User Name" value="<?php if (isset($data_search)){ echo htmlentities($data_search); } ?>">
            </div>
            <br class="visible-xs">
            <div class="col-sm-3">
                <input type="submit" name="action" class="btn btn-primary" value="Search">
            </div>
        </div>

        <?php
        if (isset($result_search)) {
            if (count($result_search) > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table--consapp">
                        <colgroup>
                            <col width="70">
                            <col>
                            <col>
                            <col>
                            <col width="140">
                        </colgroup>
                        <thead>
                        <tr>
                            <th id="sort_1" class="text-center">S/No</th>
                            <th id="sort_2">User ID</th>
                            <th id="sort_3">Name</th>
                            <th id="sort_4">Agency</th>
                            <th id="sort_5" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!isset($offset)) {
                            $offset = 0;
                        }

                        if (!isset($txt_search)) {
                            $txt_search = null;
                        }

                        foreach ($result_search as $value) {
                            ?>
                            <tr class="gradeC">
                                <td class="text-center">
                                    <?php if ($sort == 'asc') {
                                        echo(++$offset);
                                    } else {
                                        echo($offset--);
                                    } ?>
                                </td>
                                <td><a href="<?php echo site_url('users/edit/' . $value['ID_USER']); ?>"><?php echo $value['ID_LOGIN']; ?></a></td>
                                <td><?php echo $value['USER_NAME']; ?></td>
                                <td><?php echo $value['NM_ORGANISATION']; ?></td>
                                <td class="text-center"><a class="btn btn-info" href="<?php echo site_url('users/edit/' . $value['ID_USER']); ?>">Edit User</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>

                <div class="text-center">
                    <em>Can't find User.</em>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="text-center">
                <em>Can't find User.</em>
            </div>
        <?php
        }
        ?>
    </form>

    <nav class="text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </nav>
</div>