<?php

// HM-WDS100-C6-O|Wettersensoren:0||VISIBLE=|OPERATE=|UNREACH=10317|STICKY_UNREACH=10313|CONFIG_PENDING=10299|LOWBAT=10307|RSSI_DEVICE=10311|RSSI_PEER=10312|DEVICE_IN_BOOTLOADER=10303|UPDATE_PENDING=10321|
// HM-WDS100-C6-O|Wettersensor||VISIBLE=true|OPERATE=true|TEMPERATURE=10331|HUMIDITY=10327|RAINING=10328|RAIN_COUNTER=10329|WIND_SPEED=10334|WIND_DIRECTION=10332|WIND_DIRECTION_RANGE=10333|SUNSHINEDURATION=10330|BRIGHTNESS=10326|=10335|=10336|

// Validated by Manu

function HM_WDS100_C6_O($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['HUMIDITY']-20) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
                . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                . '<span class="info" data-id="' . $component['RAINING'] . '" data-component="' . $component['component'] . '" data-datapoint="RAINING"></span>'
                . '<span class="info" data-id="' . $component['RAIN_COUNTER'] . '" data-component="' . $component['component'] . '" data-datapoint="RAIN_COUNTER"></span>'
                . '<span class="info" data-id="' . $component['WIND_SPEED'] . '" data-component="' . $component['component'] . '" data-datapoint="WIND_SPEED"></span>'
                . '<span class="info" data-id="' . $component['WIND_DIRECTION'] . '" data-component="' . $component['component'] . '" data-datapoint="WIND_DIRECTION"></span>'
                . '<span class="info" data-id="' . $component['WIND_DIRECTION_RANGE'] . '" data-component="' . $component['component'] . '" data-datapoint="WIND_DIRECTION_RANGE"></span>'
                . '<span class="info" data-id="' . $component['SUNSHINEDURATION'] . '" data-component="' . $component['component'] . '" data-datapoint="SUNSHINEDURATION"></span>'
                . '<span class="info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
