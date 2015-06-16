<h3 class="custom-page-header">Take Survey - Select Company</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php  echo site_url('survey/take_search'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="txt_search" value="<?php if(isset($txt_search)){echo $txt_search;}?>">
        <input type="hidden" name="PER_IN_PAGE" value="<?php if (isset($per_in_page)) { echo $per_in_page; } else { echo PER_IN_PAGE; } ?>">

        <input type="hidden" name="ACTOR" value="<?php if (isset($actor)) { echo $actor; } ?>">

        <input type="hidden" name="SORT" value="<?php if (isset($sort)) { echo $sort; } else { echo 'asc'; } ?>">

        <div class="form-group">
            <label class="control-label col-sm-3" for="NM_COMPANY">Company ID</label>
            <div class="col-sm-4">
                <input type="text" id="NM_COMPANY" class="form-control" name="NM_COMPANY" value="<?php
                if( isset($data_search)){
                    $temp = htmlentities($data_search);
                    echo ($temp);
                }
                ?>">
            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
        <?php
        if (isset($result_search)) {
            if (count($result_search) > 0){?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table--consapp">
                        <colgroup>
                            <col width="70">
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center" id="sort_1">S/No</th>
                            <th id="sort_2">Company ID</th>
                            <th id="sort_3">Survey Status</th>
                            <th class="text-center" id="sort_4">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!isset($offset)){
                            $offset = 0;
                        }

                        if (!isset($txt_search)){
                            $txt_search = null;
                        }
                        foreach ($result_search as $key => $value) {

                            ?>
                            <tr class="gradeC">
                                <td><?php
                                    if ($sort == 'asc') {

                                        echo (++$offset);

                                    }
                                    else{

                                        echo ($offset--);

                                    }?></td>
                                <td><a href="<?php echo site_url('survey/take_survey/'.$value['nm_company'].'/'.$offset.'/'.$txt_search);  ?>" <?php if ($value['tx_status'] == 'Completed') {
                                        echo ' class="completed"';
                                    } ?>><?php echo $value['nm_company']; ?></a></td>
                                <td><?php echo $value['tx_status'];?></td>
                                <td>
                                    <a href="<?php echo site_url('survey/delete_survey/'.$value['id_survey']) ?>">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>

                <div class="accordion-inner">
                    <p>
                        <?php echo $this->lang->line('cant_found_company_profile');?>
                    </p>
                </div>
            <?php
            }
        } else { ?>
            <div class="accordion-inner">
                <p>
                    <?php echo $this->lang->line('cant_found_company_profile');?>
                </p>
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