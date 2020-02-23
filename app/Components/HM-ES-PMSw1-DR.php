<?php

// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:0||VISIBLE=|OPERATE=|UNREACH=3493|STICKY_UNREACH=3489|CONFIG_PENDING=3475|DUTYCYCLE=3483|RSSI_DEVICE=3487|RSSI_PEER=3488|DEVICE_IN_BOOTLOADER=3479|UPDATE_PENDING=3497|
// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:1||VISIBLE=true|OPERATE=true|STATE=3505|
// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:2||VISIBLE=true|OPERATE=true|ENERGY_COUNTER=3510|POWER=3512|CURRENT=3509|VOLTAGE=3513|FREQUENCY=3511|
// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:3||VISIBLE=true|OPERATE=true|DECISION_VALUE=3515|
// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:4||VISIBLE=true|OPERATE=true|DECISION_VALUE=3517|
// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:5||VISIBLE=true|OPERATE=true|DECISION_VALUE=3519|
// HM-ES-PMSw1-DR|HM-ES-PMSw1-DR:6||VISIBLE=true|OPERATE=true|DECISION_VALUE=3521|

// Validated by Manu

function HM_ES_PMSw1_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                //. '<span class="right info" data-id="' . ($component['STATE']+8) . '" data-component="' . $component['component'] . '" data-datapoint="VOLTAGE"></span>'
                //. '<span class="right info" data-id="' . ($component['STATE']+6) . '" data-component="' . $component['component'] . '" data-datapoint="FREQUENCY"></span>'
                . '<span class="info" data-id="' . ($component['STATE']+4) . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT"></span>'
                . '<span class="info" data-id="' . ($component['STATE']+7) . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
                . '<span class="info" data-id="' . ($component['STATE']+5) . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
