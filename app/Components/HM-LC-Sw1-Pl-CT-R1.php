<?php

// HM-LC-Sw1-Pl-CT-R1|Garagenöffner:0|BidCos-RF|MEQ0xxxxx|0|VISIBLE=|OPERATE=|UNREACH=17506|STICKY_UNREACH=17502|CONFIG_PENDING=17484|LOWBAT=17496|DUTYCYCLE=17492|RSSI_DEVICE=17500|RSSI_PEER=17501|DEVICE_IN_BOOTLOADER=17488|UPDATE_PENDING=17510|
// HM-LC-Sw1-Pl-CT-R1|Garagentor Öffner|BidCos-RF|MEQ0xxxxx|1|VISIBLE=false|OPERATE=true|STATE=17518|

// validated by onkeltom

function HM_LC_Sw1_Pl_CT_R1($component) {
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
