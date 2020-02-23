<?php

// HM-ES-PMSw1-Pl|Toilette Waschmaschine:0||VISIBLE=|OPERATE=|UNREACH=7238|STICKY_UNREACH=7234|CONFIG_PENDING=7220|DUTYCYCLE=7228|RSSI_DEVICE=7232|RSSI_PEER=7233|DEVICE_IN_BOOTLOADER=7224|UPDATE_PENDING=7242|
// HM-ES-PMSw1-Pl|Toilette Waschmaschine:1||VISIBLE=true|OPERATE=true|STATE=7250|
// HM-ES-PMSw1-Pl|Toilette Waschmaschine:2||VISIBLE=true|OPERATE=true|ENERGY_COUNTER=7255|POWER=7257|CURRENT=7254|VOLTAGE=7258|FREQUENCY=7256|
// HM-ES-PMSw1-Pl|Toilette Waschmaschine:3||VISIBLE=true|OPERATE=true|DECISION_VALUE=7260|
// HM-ES-PMSw1-Pl|Toilette Waschmaschine:4||VISIBLE=true|OPERATE=true|DECISION_VALUE=7262|
// HM-ES-PMSw1-Pl|Toilette Waschmaschine:5||VISIBLE=true|OPERATE=true|DECISION_VALUE=7264|
// HM-ES-PMSw1-Pl|Toilette Waschmaschine:6||VISIBLE=true|OPERATE=true|DECISION_VALUE=7266|

// Validated by Braindead, steingarten

function HMIP_PSM($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        $modalId = mt_rand();  
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                    . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                    . '<div class="pull-right">'
                        . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
                    . '</div>'
                    . '<div class="clearfix"></div>'
                . '</div>'
                . '<div class="hh2 collapse" id="' . $modalId . '"> 
                    <div class="row text-center">'
                    . '<span class="info" data-id="' . ($component['STATE']+12) . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT"></span>'
                    . '<span class="info" data-id="' . ($component['STATE']+16) . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
                    . '<span class="info" data-id="' . ($component['STATE']+13) . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
