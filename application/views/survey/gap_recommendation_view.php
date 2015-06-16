<?php
$category_list = array('RECRUITMENT', 'HR MANAGEMENT', 'MANPOWER PLANNING', 'TRAINING AND DEVELOPMENT', 'PERFORMANCE MANAGEMENT', 'COMPENSATION AND BENEFITS (C&B)', 'TALENT MANAGEMENT AND SUCCESSION PLANNING', 'ORGANISATION CULTURE', 'EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 'EMPLOYEE VALUE PROPOSITION (EVP) or “Employer Unique Selling Point”', 'INTERNATIONALIZATION');
$gap_group_index = 1;
?>
<h3 class="custom-page-header">GAP recommendation</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="well">
    <form action="<?php echo site_url('/survey/save_all_recommendation'); ?>" method="post" class="form-horizontal" novalidate>
        <?php echo form_hidden(array('id_survey' => $gap_data[0]['ID_SURVEY'])); ?>
        <?php echo form_hidden(array('id_company' => $id_company)); ?>
        <?php echo form_hidden(array('id_company_ai' => $id_company_ai)); ?>
        <div id="gap-recommendation-content" class="table-responsive">
            <table class="table table--no-border">
                <tr>
                    <td colspan="6">
                        <div class="gap-cols-header">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col>
                                    <col width="70">
                                    <col width="245">
                                    <col width="70">
                                    <col width="245">
                                    <col width="95">
                                </colgroup>
                                <tr>
                                    <td class="bg--blue nm-question">Area</td>
                                    <td class="bg--blue text-center in-point">Score</td>
                                    <td class="bg--blue tx-default"><span>Recommendation</span></td>
                                    <td class="bg--blue text-center norm">Norm</td>
                                    <td class="bg--blue notes">Notes</td>
                                    <td class="gap-actions"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <?php foreach ($category_list as $item): ?>
                    <?php if ($item == 'INTERNATIONALIZATION' && $is_overseas) { continue; } ?>
                    <tr>
                        <td colspan="6">
                            <div class="bg--grey gap-group-header" data-toggle="collapse" data-target="#gap-group-<?php echo $gap_group_index; ?>"><?php echo $item; ?></div>
                    <?php
                    $filters = array_filter($gap_data, function ($value) use ($item) { return $value['ID_CATEGORY'] == $item; });
                    if (count($filters) > 0): ?>
                        <div id="gap-group-<?php echo $gap_group_index; ?>" class="gap-group-items collapse in">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col>
                                    <col width="70">
                                    <col width="245">
                                    <col width="70">
                                    <col width="245">
                                    <col width="95">
                                </colgroup>
                                <?php foreach ($filters as $value): ?>
                                    <tr data-survey-id="<?php echo $value['ID']; ?>"
                                        data-question-id="<?php echo $value['ID_QUESTION']; ?>"
                                        id="record-<?php echo $value['ID'] . '-' . $value['ID_QUESTION']; ?>">
                                        <td class="nm-question <?php echo ((int)$value['IN_POINT'] < 0) ? 'bg--red' : 'bg--green'; ?>"><?php echo $value['NM_QUESTION']; ?></td>
                                        <td class="in-point text-center <?php echo ((int)$value['IN_POINT'] < 0) ? 'bg--red' : 'bg--green'; ?>"><?php echo $value['IN_POINT']; ?></td>
                                        <td class="tx-default <?php echo ((int)$value['IN_POINT'] < 0) ? 'bg--red' : 'bg--green'; ?>">
                                            <?php echo form_textarea(array('rows' => '2', 'id' => 'recommendation-' . $value['ID_QUESTION'] . '-' . $value['ID'], 'name' => 'recommendation_' . $value['ID_QUESTION'] . '_' . $value['ID'], 'class' => 'form-control recommendation text-input-gap-js', 'text_type' => 'TX_RECOMMENDATION', 'data-default-value' => $value['TX_DEFAULT'], 'value' => $value['TX_RECOMMENDATION'])); ?>
                                        </td>
                                        <td class="norm text-center <?php echo ((int)$value['IN_POINT'] < 0) ? 'bg--red' : 'bg--green'; ?>"><?php echo ($value['S_SCORE'] == '-' || $value['S_SCORE'] == '' || $value['S_SCORE'] == '0' || $value['S_SCORE'] == null) ? '-' : (float) $value['S_SCORE']; ?></td>
                                        <td class="notes <?php echo ((int)$value['IN_POINT'] < 0) ? 'bg--red' : 'bg--green'; ?>">
                                            <?php
                                            $note = (isset($value['TX_NOTES']) ? $value['TX_NOTES'] : 'Notes');
                                            echo form_textarea(array('rows' => '2', 'id' => 'note-' . $value['ID_QUESTION'] . '-' . $value['ID'], 'name' => 'note_' . $value['ID_QUESTION'] . '_' . $value['ID'], 'class' => 'form-control text-input-gap-js', 'text_type' => 'TX_NOTES', 'value' => $note, 'placeholder' => 'Notes'));
                                            ?>
                                        </td>
                                        <td class="gap-actions">
                                            <button type="button" class="btn btn-info reset-gap-js">Reset</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php $gap_group_index++; endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <?php echo form_textarea(array('id' => 'free-text-gap', 'name' => 'free_text', 'rows' => '7', 'cols' => '20', 'maxlength' => '1000', 'class' => 'form-control text-counter-js', 'placeholder' => 'Free text box for user input.', 'value' => $free_text)); ?>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12 custom-btn-groups">
                <input id="save-gap" type="submit" name="submit" class="btn--consapp gap-submit-js btn btn-primary" value="Save">
                <input id="submit-gap" type="submit" name="submit" class="btn--consapp btn gap-submit-js btn-primary" value="Submit">
            </div>
        </div>
    </form>
</div>