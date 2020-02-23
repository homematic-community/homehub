<?php

// HM-Sec-MDIR|BM1:0||VISIBLE=|OPERATE=|UNREACH=3223|STICKY_UNREACH=3219|CONFIG_PENDING=3208|LOWBAT=3213|RSSI_DEVICE=3217|RSSI_PEER=3218|
// HM-Sec-MDIR|BM1:1||VISIBLE=true|OPERATE=true|BRIGHTNESS=3228|MOTION=3252|ERROR=3229|

// Validated by vepman

function HM_Sec_MDIR($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="right info" data-id="' . ($component['BRIGHTNESS']-15) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="right info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'
                . '<span class="right info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
