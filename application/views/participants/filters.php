<?php echo link_tag('css/themes/bg-1.css'); ?>

<script type="text/javascript">
    var page='participants-filters';
</script>

<h3 class="custom-page-header">Manage Participants</h3>
<p class="custom-page-description">&nbsp;</p>
<div class="well">
    <form id="form-participants-filters" class="form-horizontal" action="<?php echo site_url('/participants/add_participant'); ?>" method="post" novalidate>
        <?php echo form_hidden(array('name' => 'ID_SESSION', 'value' => $session_info['ID_SESSION'])); ?>
        <?php echo form_hidden(array('name' => 'id_session', 'value' => $id_session)); ?>
        <input type="hidden" name="id_offset" value="<?php echo $offset; ?>">
        <div class="row">
            <div class="col-sm-12"><strong>Session No:</strong> <?php echo multi_number($session_info['ID_SESSION'], 3);?></div>
        </div>
        <div class="row">
            <div class="col-sm-12"><strong>Session Name:</strong> <?php echo $session_info['NM_SESSION'];?></div>
        </div>
         <div class="row">
            <div class="col-sm-12"><strong>Participants:</strong></div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table--consapp">
                <colgroup>
                    <col width="30">
                    <col>
                    <col>
                    <col width="170">
                    <col>
                    <col width="200">
                </colgroup>
                <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">S/No</th>
                    <th id="sort_2">Name</th>
                    <th class="text-center" id="sort_3">Organisation</th>
                    <th id="sort_4">Email</th>
                    <th class="text-center">Action</th>
                </tr>
                <?php if(isset($session_info) && $session_info['ID_STATUS'] == 0) { ?>
                    <tr>
                        <td class="text-center" style="vertical-align: top!important;"></td>
                        <td class="text-center" style="vertical-align: top!important;"></td>
                        <td class="th_name" style="vertical-align: top!important;">
                            <input id="NM_PARTICIPANT" name="NM_PARTICIPANT" type="text" class="form-control" maxlength="50" autofocus value="<?php
                            if(isset($NM_PARTICIPANT) && !empty($NM_PARTICIPANT))
                            {
                                if (strpos($NM_PARTICIPANT, "\"") || substr($NM_PARTICIPANT, 0,1) == "\"")
                                {
                                    $a = htmlentities($NM_PARTICIPANT);
                                    echo($a);
                                }
                                else
                                {
                                    echo $NM_PARTICIPANT;
                                }
                            }?>">
                        </td>
                        <td style="vertical-align: top!important;">
                            <?php
                            $a = 1;
                            if(isset($NM_ORGANISATION) && !empty($NM_ORGANISATION))
                            {
                                if (strpos($NM_ORGANISATION, "\"") || substr($NM_ORGANISATION, 0,1) == "\"")
                                {
                                    $a = htmlentities($NM_ORGANISATION);
                                }
                                else
                                {
                                    $a = $NM_ORGANISATION;
                                }
                            }
                            echo form_dropdown('NM_ORGANISATION', $org_info, $a,'class="form-control"');
                            ?>
                        </td>
                        <td class="th_email" style="vertical-align: top!important;">
                            <input id="NM_EMAIL" name="NM_EMAIL" type="text" class="form-control" maxlength="50" value="<?php
                            if(isset($NM_EMAIL) && !empty($NM_EMAIL))
                            {
                                if (strpos($NM_EMAIL, "\"") || substr($NM_EMAIL, 0,1) == "\"")
                                {
                                    $a = htmlentities($NM_EMAIL);
                                    echo($a);
                                } else {
                                    echo $NM_EMAIL;
                                }
                            }?>">
                        </td>
                        <td class="text-center" style="vertical-align: top!important;">
                            <input id="participant-add-js" type="submit" class="btn btn-primary" value="Add Participants">
                        </td>
                    </tr>
                <?php } ?>
                </thead>
                <tbody>
                <?php foreach ($result_search as $key => $value){?>
                    <tr>
                        <td>
                            <?php
                            $data = array(
                                'name'        => 'check_delete',
                                'id'          => $value['ID'],
                                'checked'     => FALSE
                            );
                            echo form_checkbox($data);
                            ?>
                        </td>
                        <td class="text-center">
                            <?php if ($sort == 'asc') { echo(++$offset); } else { echo($offset--); } ?>
                        </td>
                        <td>
                            <span id="name_<?php echo 'span_'.$value['ID'];?>" class="span <?php echo 'span_'.$value['ID'];?>"><?php echo $value['NM_PARTICIPANT'];?></span>
                            <input id="NM_PARTICIPANT_<?php echo 'span_'.$value['ID'];?>" name="NM_PARTICIPANT_<?php echo 'span_'.$value['ID'];?>" class="form-control edit add_part <?php echo 'name_'.$value['ID'];?>" style="display: none" type="text" value="<?php echo $value['NM_PARTICIPANT'];?>">
                        </td>
                        <td>
                            <input name="org_select" type="hidden" value="<?php echo $value['ID']; ?>">
                            <span id="org_<?php echo 'span_'.$value['ID'];?>" class="span <?php echo 'span_'.$value['ID'];?>"><?php echo $value['NM_ORGANISATION'];?></span>
                            <div class="edit edit_<?php echo $value['ID'];?>" style="display: none;">
                                <?php echo form_dropdown('org_'.$value['ID'], $org_info, $value['NM_ORGANISATION'], 'class="form-control org-'.$value['ID'].'"'); ?>
                            </div>
                        </td>
                        <td>

                            <span id="email_<?php echo 'span_'.$value['ID'];?>" class="span <?php echo 'span_'.$value['ID'];?>"><?php echo $value['NM_EMAIL'];?></span>
                            <input id="NM_EMAIL_<?php echo 'span_'.$value['ID'];?>" name = "NM_EMAIL_<?php echo 'span_'.$value['ID'];?>" class="form-control edit add_part <?php echo 'email_'.$value['ID'];?>" style="display: none" type="text" value="<?php echo $value['NM_EMAIL'];?>">
                        </td>

                        <td class="text-center">
                            <input name="participant_id" type="hidden" value="<?php echo $value['ID']; ?>">
                            <?php if(isset($session_info) && $session_info['ID_STATUS']==0){ ?>
                                <input name="edit_<?php echo $value['ID'];?>" class="edit-btn btn btn-info edit-btn-<?php echo $value['ID'];?>" type="button" value="Edit">
                            <?php } ?>
                            <input name="save_<?php echo $value['ID'];?>" class="save-btn btn btn-info save-cancel save-cancel-<?php echo $value['ID'];?> save-btn-<?php echo $value['ID'];?>" style="display: none;" type="button" value="Save">
                            <input name="cancel_<?php echo $value['ID'];?>" class="cancel-btn btn btn-info save-cancel save-cancel-<?php echo $value['ID'];?> cancel-btn-<?php echo $value['ID'];?>" style="display: none;" type="button" value="Cancel">
                            <a class="btn btn-info createac-btn createac-btn-<?php echo $value['ID'];?>" href="<?php echo site_url('/users/create_ac/' . $value['ID']); ?>">Create A/C</a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="col-sm-4">
                <div class="form-actions">
                    <button id="remove-selected-list-participants" type="button" class="btn btn-primary" value="Remove Selected">Remove Selected</button>
                </div>
            </div>
        </div>
    </form>
    <nav class="text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </nav>
</div>