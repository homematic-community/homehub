<?php

// HM-CC-RT-DN|Badezimmer Heizung:0||VISIBLE=|OPERATE=|UNREACH=1472|STICKY_UNREACH=1468|CONFIG_PENDING=1453|LOWBAT=1462|RSSI_DEVICE=1466|RSSI_PEER=1467|DEVICE_IN_BOOTLOADER=1457|UPDATE_PENDING=1476|
// HM-CC-RT-DN|Badezimmer Heizung:1||VISIBLE=true|OPERATE=false|
// HM-CC-RT-DN|Badezimmer Heizung:2||VISIBLE=true|OPERATE=false|
// HM-CC-RT-DN|Badezimmer Heizung:3||VISIBLE=true|OPERATE=false|
// HM-CC-RT-DN|Badezimmer Heizung:4||VISIBLE=true|OPERATE=true|CONTROL_MODE=1490|FAULT_REPORTING=1491|BATTERY_STATE=1486|VALVE_STATE=1526|BOOST_STATE=1488|ACTUAL_TEMPERATURE=1484|SET_TEMPERATURE=1525|AUTO_MODE=1485|MANU_MODE=1514|BOOST_MODE=1487|COMFORT_MODE=1489|LOWERING_MODE=1513|PARTY_MODE_SUBMIT=1515|PARTY_TEMPERATURE=1524|PARTY_START_TIME=1518|PARTY_START_DAY=1516|PARTY_START_MONTH=1517|PARTY_START_YEAR=1519|PARTY_STOP_TIME=1522|PARTY_STOP_DAY=1520|PARTY_STOP_MONTH=1521|PARTY_STOP_YEAR=1523|
// HM-CC-RT-DN|Badezimmer Heizung:5||VISIBLE=true|OPERATE=false|
// HM-CC-RT-DN|Badezimmer Heizung:6||VISIBLE=true|OPERATE=false|

// Validated by Braindead

function HM_CC_RT_DN($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['CONTROL_MODE'])) {
        $modalId = mt_rand();
        
        return '<div class="hh">'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                .'<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['ACTUAL_TEMPERATURE']-22) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['VALVE_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="VALVE_STATE"></span>'
                    . '<span class="info" data-id="' . $component['BATTERY_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="BATTERY_STATE"></span>'
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
