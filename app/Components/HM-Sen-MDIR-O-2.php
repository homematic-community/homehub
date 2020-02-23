<?php

// HM-Sen-MDIR-O-2|Bewegungsmelder-Garage-Innen:0||VISIBLE=|OPERATE=|UNREACH=12050|STICKY_UNREACH=12046|CONFIG_PENDING=12031|LOWBAT=12040|RSSI_DEVICE=12044|RSSI_PEER=12045|DEVICE_IN_BOOTLOADER=12035|UPDATE_PENDING=12054|
// HM-Sen-MDIR-O-2|BM-Garage-innen||VISIBLE=true|OPERATE=true|BRIGHTNESS=12059|MOTION=12061|

function HM_Sen_MDIR_O_2($component) {
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
