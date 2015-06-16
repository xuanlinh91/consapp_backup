<?php echo link_tag('css/themes/bg-2.css'); ?>

<script type="text/javascript">
    var page = "home-index";
    var company_list = <?php if(isset($company_info) && $company_info != '') {echo $company_info;}?>;
</script>

<h3 class="custom-page-header">HRMD Web App</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php  echo site_url('home'); ?>" method="post" class="form-horizontal" novalidate onSubmit= "window.focus();">
        <div class="form-group">
            <label class="control-label col-sm-3 col-xs-12" for="home-input-js">Company search:</label>

            <div class="col-sm-6">
                <?php echo form_input(array('id' => 'home-input-js', 'name' => 'NM_COMPANY', 'class' => 'form-control',
                    'placeholder' => 'Enter UEN, Company Name', 'autofocus' => 'autofocus', 'value' => isset($txt_search) ? $txt_search : null)); ?>
            </div>
            <br class="visible-xs">
            <div class="col-sm-3">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </div>
        </div>
        <?php
        if (isset($result_search) && count($result_search) > 0) {
            if (!empty($result_search)) {?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table--consapp">
                        <colgroup>
                            <col width="70">
                            <col>
                            <col>
                            <col>
                            <col width="260">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">S/No</th>
                            <th>UEN</th>
                            <th>Company Name</th>
                            <th class="text-center">Stage</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($result_search as $key => $value){?>
                            <tr class="gradeC">
                                <td class="text-center"><?php echo (++$offset); ?></td>
                                <td><?php echo $value['ID_COMPANY'];?></td>
                                <td><?php echo $value['NM_COMPANY'];?></td>
                                <td class="text-center">
                                    <?php if (isset($value['STAGE']) && $value['STAGE'] >= 1 ) {
                                        echo 'Stage '.$value['STAGE'];
                                    } else {
                                        echo 'NA';
                                    }?>
                                </td>
                                <td class="text-center"><?php
                                    if(isset($value['ACTION'])){
                                        if($value['ACTION'] == 'View Report'){
                                            if (isset($value['RESUME'])) { ?>
                                                <a href="<?php echo $value['RESUME_LINK'];?>" class="btn btn-info"><?php echo $value['RESUME']; ?></a>
                                            <?php } ?>
                                            <a href="<?php echo $value['ACTION_LINK'];?>" class="btn btn-info"><?php echo $value['ACTION']; ?></a>
                                        <?php } elseif ($value['ACTION'] == 'Start' || $value['ACTION'] == 'Continue Survey') {?>
                                            <a href="<?php echo $value['ACTION_LINK'];?>" class="btn btn-info"><?php echo $value['ACTION']; ?></a>
                                        <?php } ?>

                                    <?php }?>

                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else { ?>
            <?php }
        } else { ?>
        <?php } ?>
    </form>

    <nav class="text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </nav>
</div>