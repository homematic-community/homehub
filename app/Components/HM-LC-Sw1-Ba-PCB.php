<?php

// HM-LC-Sw1-Ba-PCB|Test Aktor:0||VISIBLE=|OPERATE=|UNREACH=10691|STICKY_UNREACH=10687|CONFIG_PENDING=10669|LOWBAT=10681|DUTYCYCLE=10677|RSSI_DEVICE=10685|RSSI_PEER=10686|DEVICE_IN_BOOTLOADER=10673|UPDATE_PENDING=10695|
// HM-LC-Sw1-Ba-PCB|Test Aktor:1||VISIBLE=true|OPERATE=true|STATE=10703|

// Validated by Braindead

function HM_LC_Sw1_Ba_PCB($component) {
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
