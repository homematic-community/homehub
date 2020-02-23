<?php

// HM-LC-Sw1PBU-FM|Bad Decke:0||VISIBLE=|OPERATE=|UNREACH=1526|STICKY_UNREACH=1522|CONFIG_PENDING=1504|LOWBAT=1516|DUTYCYCLE=1512|RSSI_DEVICE=1520|RSSI_PEER=1521|DEVICE_IN_BOOTLOADER=1508|UPDATE_PENDING=1530|
// HM-LC-Sw1PBU-FM|Bad Decke:1||VISIBLE=true|OPERATE=true|STATE=1538|

function HM_LC_Sw1PBU_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['STATE']-22) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
