<?php

// HM-TC-IT-WM-W-EU|HM-TC-IT-WM-W-EU:1||VISIBLE=true|OPERATE=true|TEMPERATURE=5539|HUMIDITY=5538|
// HM-TC-IT-WM-W-EU|Wandthermostat Wohnzimmer||VISIBLE=true|OPERATE=true|CONTROL_MODE=5549|LOWBAT_REPORTING=5550|COMMUNICATION_REPORTING=5548|WINDOW_OPEN_REPORTING=5564|BATTERY_STATE=5544|BOOST_STATE=5546|ACTUAL_TEMPERATURE=5542|ACTUAL_HUMIDITY=5541|SET_TEMPERATURE=5563|AUTO_MODE=5543|MANU_MODE=5552|BOOST_MODE=5545|COMFORT_MODE=5547|LOWERING_MODE=5551|PARTY_MODE_SUBMIT=5553|PARTY_TEMPERATURE=5562|PARTY_START_TIME=5556|PARTY_START_DAY=5554|PARTY_START_MONTH=5555|PARTY_START_YEAR=5557|PARTY_STOP_TIME=5560|PARTY_STOP_DAY=5558|PARTY_STOP_MONTH=5559|PARTY_STOP_YEAR=5561|

// Validated by Manu

function HM_TC_IT_WM_W_EU($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['CONTROL_MODE'])) {
        $modalId = mt_rand();
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_HUMIDITY"></span>'
                    /*. '<span class="info" data-id="' . $component['BATTERY_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="BATTERY_STATE"></span>'
                    . '<span class="info" data-id="' . $component['WINDOW_OPEN_REPORTING'] . '" data-component="' . $component['component'] . '" data-datapoint="WINDOW_OPEN_REPORTING"></span>'*/
                    . '<span class="info set btn-icon" data-id="' . $component['CONTROL_MODE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE" data-set-id="" data-set-value""></span>'
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
