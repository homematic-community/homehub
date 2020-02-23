<?php

// HM-Dis-TD-T|StatusAnzeigeA:0||VISIBLE=|OPERATE=|UNREACH=4479|STICKY_UNREACH=4475|CONFIG_PENDING=4461|LOWBAT=4469|DUTYCYCLE=4465|RSSI_DEVICE=4473|RSSI_PEER=4474|DEVICE_IN_BOOTLOADER=24137|UPDATE_PENDING=24138|
// HM-Dis-TD-T|KlappAnzeigeA1||VISIBLE=true|OPERATE=true|STATE=4487|

function HM_Dis_TD_T($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['STATE']-18) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
