<?php

// HM-Sen-MDIR-O|BewegGarage:0||VISIBLE=|OPERATE=|UNREACH=49036|STICKY_UNREACH=49032|CONFIG_PENDING=49017|LOWBAT=49026|RSSI_DEVICE=49030|RSSI_PEER=49031|DEVICE_IN_BOOTLOADER=49021|UPDATE_PENDING=49040|
// HM-Sen-MDIR-O|BewegGarage1||VISIBLE=true|OPERATE=true|BRIGHTNESS=49045|MOTION=49047|

function HM_Sen_MDIR_O($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['BRIGHTNESS']-19) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'
                . '<span class="info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
