<?php

// HM-CC-VG-1|Heizung INT0000001:0||VISIBLE=|OPERATE=|UPDATE_PENDING=2085|RSSI_DEVICE=2081|AES_KEY=2076|DEVICE_IN_BOOTLOADER=2078|CONFIG_PENDING=2077|UNREACH=2084|LOWBAT=2080|STICKY_UNREACH=2083|RSSI_PEER=2082|
// HM-CC-VG-1|Heizung INT0000001:1||VISIBLE=true|OPERATE=false|CONTROL_MODE=2092|ACTUAL_HUMIDITY=2087|BOOST_MODE=2090|AUTO_MODE=2089|SET_TEMPERATURE=2105|ACTUAL_TEMPERATURE=2088|MANU_MODE=2094|COMFORT_MODE=2091|LOWERING_MODE=2093|PARTY_TEMPERATURE=2104|PARTY_START_TIME=2098|PARTY_START_DAY=2096|PARTY_START_MONTH=2097|PARTY_START_YEAR=2099|PARTY_STOP_TIME=2102|PARTY_STOP_DAY=2100|PARTY_STOP_MONTH=2101|PARTY_STOP_YEAR=2103|PARTY_MODE_SUBMIT=2095|
// HM-CC-VG-1|Heizung INT0000001:2||VISIBLE=true|OPERATE=false|STATE=2107|

// Validiert von Braindead

function HM_CC_VG_1($component) {
    if ($component['parent_device_interface'] == 'VirtualDevices' && $component['visible'] == 'true' && isset($component['CONTROL_MODE'])) {
        $modalId = mt_rand();
        
        return '<div class="hh">'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                .'<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['ACTUAL_TEMPERATURE']-12) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                    . '<span class="info" data-id="' . ($component['ACTUAL_TEMPERATURE']+15) . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['CONTROL_MODE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">
                <div class="row text-center">'
                    . '<div class="form-inline">'
                        . '<div class="input-group">'
                            . '<input type="number" name="' . $component['SET_TEMPERATURE'] . '" min="4.5" max="30.5" class="form-control" placeholder="Zahl eingeben">'
                            . '<span class="input-group-btn">'
                                . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . $component['SET_TEMPERATURE'] . '" data-set-value="">OK</button>'
                            . '</span>'
                        . '</div>'
                        . '<div class="btn-group">'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMFORT_MODE'] . '" data-set-value="1">'
                                . 'Komfort'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LOWERING_MODE'] . '" data-set-value="1">'
                                . 'Absenkung'
                            . '</button>'
                        . '</div>'
                    . '</div>'                    
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['AUTO_MODE'] . '" data-set-value="1">'
                            . 'Auto'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['MANU_MODE'] . '" data-set-value="1">'
                            . 'Manu'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['BOOST_MODE'] . '" data-set-value="1">'
                            . 'Boost'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
