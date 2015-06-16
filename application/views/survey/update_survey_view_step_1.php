<h3 class="custom-page-header">Update Survey Responses - Select Company</h3>
<p class="custom-page-description">&nbsp;</p>
<div class="well">
    <form action="<?php  echo site_url('survey/update_search'); ?>" method="post" class="form-horizontal" novalidate>
        <input type="hidden" name="txt_search" value="<?php if (isset($txt_search)) { echo $txt_search; } ?>">
        <input type="hidden" name="PER_IN_PAGE" value="<?php if (isset($per_in_page)) { echo $per_in_page; } else { echo PER_IN_PAGE; } ?>">
        <input type="hidden" name="ACTOR" value="<?php if (isset($actor)) { echo $actor; } ?>">
        <input type="hidden" name="SORT" value="<?php if (isset($sort)) { echo $sort; } else { echo 'asc'; } ?>">

        <div class="form-group">
            <label class="control-label col-sm-3" for="NM_COMPANY">Company ID</label>
            <div class="col-sm-4">
                <input id="NM_COMPANY" name="NM_COMPANY" type="text" class="form-control" value="<?php
                if( isset($data_search)){

                    $temp = htmlentities($data_search);

                    echo ($temp);

                }
                ?>">
            </div>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        <!-- <table class="table table-bordered table-striped table-hover table--consapp">
							<?php
        if (!isset($offset)) {
            $offset= 0;
        }
        if (isset($result_search)) {

            if (!empty($result_search))
            {
                ?>
									<thead>
										<tr>
											<th class="sort" id="sort_1">S/No</th>
											<th class="sort" id="sort_2">Company ID</th>
											<th class="sort" id="sort_3">Designation</th>
											<th class="sort" id="sort_4">Revenue size</th>
											<th class="sort" id="sort_5">Total staff size</th>
											<th class="sort" id="sort_6">HR staff size</th>
											<th class="sort" id="sort_7">Company industry</th>
											<th class="sort" id="sort_8">Overall HRMM Maturity Level points</th>
											<th class="sort" id="sort_9">Survey completion date</th>
											<th class="sort" id="sort_10">Consultant ID</th>
										</tr>
									</thead>
									<tbody>
									<?php

                foreach ($result_search as $key => $value) {
                    ?>
													<tr class="gradeC">
														<td><?php
                    if ($sort == 'asc') {

                        echo (++$offset_ie);

                    }
                    else{

                        echo ($offset_ie--);

                    }?></td>
														<td><a href="<?php echo site_url('survey/update_survey/'. $value['NM_COMPANY']); ?>"><?php echo $value['NM_COMPANY'];?></a></td>
														<td><?php echo $value['NM_DESIGNATION'];?></td>
														<td><?php echo $value['REVENUE'];?></td>
														<td><?php echo $value['TOTAL_STAFF'];?></td>
														<td><?php echo $value['HR_STAFF'];?></td>
														<td><?php echo $value['INDUSTRY'];?></td>
														<td><?php echo $value['HRMM_LEVEL'];?></td>
														<td><?php if(isset($value['DT_SURVEY_COMPLETE'])) echo $value['DT_SURVEY_COMPLETE'];?></td>
														<td><?php echo $value['ID_CONSULTANT'];?></td>
													</tr>

										<?php
                }
            }
            else
            {

                ?>
											<div class="accordion-inner">
												<p>
													<?php echo $this->lang->line('cant_found_company_profile');?>
												</p>
											</div>
										<?php
            }
        }
        else
        {
            ?>
										<div class="accordion-inner">
											<p>
												<?php echo $this->lang->line('cant_found_company_profile');?>
											</p>
										</div>
									<?php
        }
        ?>
							</tbody>
					</table> -->
        <?php
        if (!isset($offset)) {
            $offset = 0;
        }
        if (isset($result_search)) {

            if (!empty($result_search))	{
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table--consapp">
                        <colgroup>
                            <col width="70">
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center" id="sort_1">S/No</th>
                            <th id="sort_2">Company ID</th>
                            <th id="sort_3">Designation</th>
                            <th id="sort_4">Revenue size</th>
                            <th id="sort_5">Total staff size</th>
                            <th id="sort_6">HR staff size</th>
                            <th id="sort_7">Company industry</th>
                            <th id="sort_8">Overall HRMM Maturity Level points</th>
                            <th id="sort_9">Survey completion date</th>
                            <th id="sort_10">Consultant ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($result_search as $key => $value) {?>
                            <tr class="gradeC">
                                <td><?php
                                    if ($sort == 'asc') {

                                        echo (++$offset);

                                    }
                                    else{

                                        echo ($offset--);

                                    }?></td>
                                <td><a href="<?php echo site_url('survey/update_survey/'. $value['NM_COMPANY']); ?>" ><?php echo $value['NM_COMPANY']; ?></a></td>
                                <td><?php echo $value['NM_DESIGNATION'];?></td>
                                <td><?php echo $value['REVENUE'];?></td>
                                <td><?php echo $value['TOTAL_STAFF'];?></td>
                                <td><?php echo $value['HR_STAFF'];?></td>
                                <td><?php echo $value['INDUSTRY'];?></td>
                                <td><?php echo $value['HRMM_LEVEL'];?></td>
                                <td><?php if(isset($value['DT_SURVEY_COMPLETE'])) echo $value['DT_SURVEY_COMPLETE'];?></td>
                                <td style="word-wrap: break-word;"><?php echo $value['ID_CONSULTANT'];?></td>
                            </tr>
                        <?php 	} ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }else{ ?>
                <div class="accordion-inner">
                    <p>
                        <?php echo $this->lang->line('cant_found_company_profile');?>
                    </p>
                </div>
            <?php
            }
        }else{ ?>
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