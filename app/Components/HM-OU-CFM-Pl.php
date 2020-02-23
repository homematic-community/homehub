<?php

// HM-OU-CFM-Pl|HM-OU-CFM-Pl LEQxxxxxxxx:0|BidCos-RF|LEQxxxxxxxx|0|VISIBLE=|OPERATE=|UNREACH=2900|STICKY_UNREACH=2896|CONFIG_PENDING=2878|LOWBAT=2890|DUTYCYCLE=2886|RSSI_DEVICE=2894|RSSI_PEER=2895|DEVICE_IN_BOOTLOADER=2882|UPDATE_PENDING=2904|
// HM-OU-CFM-Pl|HM-OU-CFM-Pl LEQxxxxxxxx:1|BidCos-RF|LEQxxxxxxxx|1|VISIBLE=true|OPERATE=true|STATE=2912|SUBMIT=2913|
// HM-OU-CFM-Pl|HM-OU-CFM-Pl LEQxxxxxxxx:2|BidCos-RF|LEQxxxxxxxx|2|VISIBLE=true|OPERATE=true|STATE=2919|SUBMIT=2920|

function HM_OU_CFM_Pl($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
