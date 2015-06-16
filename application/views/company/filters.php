<?php echo link_tag('css/themes/bg-1.css'); ?>
<script type="text/javascript">
    var company_ac = <?php if(isset($company_ac) && $company_ac != '') {echo $company_ac;}?>;
    var page = "company-filter";
</script>

<h3 class="custom-page-header">Search Company</h3>
<p class="custom-page-description">&nbsp;</p>
<div class="well">
    <form action="<?php  echo site_url('company/filters'); ?>" method="post" class="form-horizontal" novalidate onSubmit= "window.focus();">
        <?php echo form_hidden(array('name' => 'txt_search', 'value' => $txt_search)); ?>
        <?php echo form_hidden(array('name' => 'PER_IN_PAGE', 'value' => $per_in_page)); ?>
        <?php echo form_hidden(array('name' => 'ACTOR', 'value' => $actor)); ?>
        <?php echo form_hidden(array('name' => 'SORT', 'value' => $sort)); ?>

        <div class="form-group">
            <label class="control-label col-sm-3" for="company-info" title="UEN and Company Name">Company:</label>
            <div class="col-sm-6">
                <input id="company-info" name="NM_COMPANY" type="text" class="form-control" autofocus placeholder="Enter UEN, Company Name" value="<?php
                if( isset($data_search)){
                    $temp = htmlentities($data_search);
                    echo ($temp);
                }
                ?>">
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
                    <table id="list-company-info" class="table table-bordered table-striped table-hover table--consapp">
                        <colgroup>
                            <col width="70">
                            <col>
                            <col>
                            <col width="150">
                            <col width="140">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center" id="sort_1">S/No</th>
                            <th id="sort_2">UEN</th>
                            <th id="sort_2">Company Name</th>
                            <th class="text-center">Date Creation</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($result_search as $key => $value){?>
                            <tr class="gradeC">
                                <td class="text-center"><?php if ($sort == 'asc') { echo (++$offset); } else { echo ($offset--); }?></td>
                                <td>
                                    <?php echo $value['ID_COMPANY'];?>
                                </td>
                                <td>
                                    <?php echo $value['NM_COMPANY'];?>
                                </td>
                                <td class="text-center">
                                    <?php echo $value['DATE_CREATION'];?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="<?php echo site_url('company/edit/' . $value['ID_COMPANY_AI'] . ''); ?>">Edit Company</a>
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
                    <em>Can't find Company.</em>
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