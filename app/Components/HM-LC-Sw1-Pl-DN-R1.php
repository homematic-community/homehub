<?php

// HM-LC-Sw1-Pl-DN-R1|Schlafzimmer Aktor:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=1641|STICKY_UNREACH=1637|CONFIG_PENDING=1619|LOWBAT=1631|DUTYCYCLE=1627|RSSI_DEVICE=1635|RSSI_PEER=1636|DEVICE_IN_BOOTLOADER=1623|UPDATE_PENDING=1645|
// HM-LC-Sw1-Pl-DN-R1|Schlafzimmer Aktor|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=1653|

function HM_LC_Sw1_Pl_DN_R1($component) {
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
