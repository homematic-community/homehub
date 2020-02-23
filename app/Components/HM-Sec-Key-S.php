<?php

// HM-Sec-Key-S|Keymatic:0||VISIBLE=|OPERATE=|UNREACH=8096|STICKY_UNREACH=8092|CONFIG_PENDING=8078|LOWBAT=8086|DUTYCYCLE=8082|RSSI_DEVICE=8090|RSSI_PEER=8091|
// HM-Sec-Key-S|Keymatic:1||VISIBLE=true|OPERATE=true|STATE=8113|OPEN=8111|RELOCK_DELAY=8112|STATE_UNCERTAIN=8114|ERROR=8102|

// Validated by vepman

function HM_Sec_Key_S($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div data-toggle="collapse">'
                .'<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['STATE']-27) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                    . '<span class="info" data-id="' . $component['STATE_UNCERTAIN'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE_UNCERTAIN"></span>'
                    . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
                    . '<span class="set btn-text" data-id="' . $component['OPEN'] . '" data-component="' . $component['component'] . '" data-datapoint="OPEN" data-set-id="' . $component['OPEN'] . '" data-set-value="1">&Ouml;ffnen</span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
        . '</div>';
    }
}
