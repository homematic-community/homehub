<?php

// HM-CC-VD|HZ21_AZ_Stellantrieb:0||VISIBLE=|OPERATE=|UNREACH=7202|STICKY_UNREACH=7198|CONFIG_PENDING=7188|LOWBAT=7192|RSSI_DEVICE=7196|RSSI_PEER=7197|
// HM-CC-VD|HZ21_AZ_VentilPos||VISIBLE=true|OPERATE=true|VALVE_STATE=7220|ERROR=7207|

// validated by charlyphyro

function HM_CC_VD($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['VALVE_STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['VALVE_STATE']-28) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['VALVE_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="VALVE_STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
