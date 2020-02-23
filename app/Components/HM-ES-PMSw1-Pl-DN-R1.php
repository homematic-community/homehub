<?php

// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:0||VISIBLE=|OPERATE=|UNREACH=7238|STICKY_UNREACH=7234|CONFIG_PENDING=7220|DUTYCYCLE=7228|RSSI_DEVICE=7232|RSSI_PEER=7233|DEVICE_IN_BOOTLOADER=7224|UPDATE_PENDING=7242|
// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:1||VISIBLE=true|OPERATE=true|STATE=7250|
// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:2||VISIBLE=true|OPERATE=true|ENERGY_COUNTER=7255|POWER=7257|CURRENT=7254|VOLTAGE=7258|FREQUENCY=7256|
// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:3||VISIBLE=true|OPERATE=true|DECISION_VALUE=7260|
// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:4||VISIBLE=true|OPERATE=true|DECISION_VALUE=7262|
// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:5||VISIBLE=true|OPERATE=true|DECISION_VALUE=7264|
// HM-ES-PMSw1-Pl-DN-R1|Toilette Waschmaschine:6||VISIBLE=true|OPERATE=true|DECISION_VALUE=7266|

function HM_ES_PMSw1_Pl_DN_R1($component) {
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
