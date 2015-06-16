<?php
/**
 * Tracking_view is used for tracking summary.
 */

$segments = array('company_profile', 'edit', $tracking_record['company_id']);
$stage_1 = site_url($segments);

$segments = array('interview', 'create', $tracking_record['company_id']);
$stage_2 = site_url($segments);

$segments = array('questionnaires', 'take', $tracking_record['company_id']);
$stage_3 = site_url($segments);
$segments = array('survey', 'take_survey', $tracking_record['company_id']);
$stage_4 = site_url($segments);

$segments = array('survey', 'take_gap', $tracking_record['company_id']);
$stage_5 = site_url($segments);

$segments = array('survey', 'generate_report', $tracking_record['company_id']);
$stage_6 = site_url($segments);

$segments = array('survey', 'close', $tracking_record['company_id']);
$stage_7 = site_url($segments);

$stage_list = array('STAGE_1' => $stage_1, 'STAGE_2' => $stage_2, 'STAGE_3' => $stage_3, 'STAGE_4' => $stage_4, 'STAGE_5' => $stage_5, 'STAGE_6' => $stage_6, 'STAGE_7' => $stage_7);
$stage_status = array();
if (isset($tracking_record) && isset($tracking_record['STAGE_1'])) {
    foreach ($stage_list as $key => $value) {
        if ($tracking_record[$key] != null) {
            $item = new stdClass();
            $item->stage = $key;
            $item->status = $tracking_record[$key];
            $item->link = $value;
            array_push($stage_status, $item);
        }
    }
} else {
    for ($i = 0; $i < 7; $i++) {
        $item = new stdClass();
        $stage_name = 'STAGE_' . ($i + 1);
        if ($i == 0) {
            $item->stage = $stage_name;
            $item->status = '1';
        } else {
            $item->stage = $stage_name;
            $item->status = '0';
        }

        array_push($stage_status, $item);
    }
}

$tracking_html = '<div class="tracking-summary-toolbar"><ol class="tracking-summary-group clearfix">';

foreach ($stage_status as $key => $value) {
    $imageFileName = $key + 3;
    $imageFolderName = '';
    switch ($value->status) {
        case TRACKING_NOT_COMPLETED:
            $imageFolderName .= 'gray';
            break;
        case TRACKING_IN_PROGRESS:
            $imageFolderName .= 'blue';
            break;
        case TRACKING_AVAILABLE:
            $imageFolderName .= 'blue';
            break;
        case TRACKING_COMPLETED:
            $imageFolderName .= 'green';
            break;
        default:
            $imageFolderName .= 'gray';
            break;
    }

    $link_start = '';
    if($key == '0') {
        $link_start = site_url(array('company_profile', 'create', $tracking_record['company_id']));
    } else {
        $link_start = '';
    }

    $imageFullPath = '/img/summary-tracker/' . $imageFolderName . '/0' . $imageFileName . '.png';
    switch ($value->status) {
        case TRACKING_NOT_COMPLETED:
            $tracking_html .= '<li company="' . $tracking_record['company_id'] . '" class="not-completed stage_' . $key . ' ' . ($key == 0 ? 'first' : ($key == sizeof($stage_status) - 1 ? 'last' : '')) . '"><a href="#" onclick="return false;" ><img class="img-responsive" src="' . base_url($imageFullPath) . '" alt=""></a></li>';
            break;
        case TRACKING_IN_PROGRESS:
            $tracking_html .= '<li company="' . $tracking_record['company_id'] . '" class="active stage_' . $key . ' ' . ($key == 0 ? 'first' : ($key == sizeof($stage_status) - 1 ? 'last' : '')) . '"><a href="' . (isset($value->link) ? $value->link : $link_start) . '"><img class="img-responsive" src="' . base_url($imageFullPath) . '" alt=""></a></li>';
            break;
        case TRACKING_AVAILABLE:
            $tracking_html .= '<li company="' . $tracking_record['company_id'] . '" class="active stage_' . $key . ' ' . ($key == 0 ? 'first' : ($key == sizeof($stage_status) - 1 ? 'last' : '')) . '"><a href="' . (isset($value->link) ? $value->link : $link_start) . '"><img class="img-responsive" src="' . base_url($imageFullPath) . '" alt=""></a></li>';
            break;
        case TRACKING_COMPLETED:
            $tracking_html .= '<li company="' . $tracking_record['company_id'] . '" class="completed stage_' . $key . ' ' . ($key == 0 ? 'first' : ($key == sizeof($stage_status) - 1 ? 'last' : '')) . '"><a href="' . (isset($value->link) ? $value->link : '#') . '"><img class="img-responsive" src="' . base_url($imageFullPath) . '" alt=""></a></li>';
            break;
    }
}

$tracking_html .= '</ol>';
$tracking_html .= '</div>';

echo $tracking_html;
