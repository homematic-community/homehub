<?php

// HM-LC-Sw1-FM|Garten-Wasser:0||VISIBLE=|OPERATE=|UNREACH=8887|STICKY_UNREACH=8883|CONFIG_PENDING=8869|LOWBAT=8877|DUTYCYCLE=8873|RSSI_DEVICE=8881|RSSI_PEER=8882|
// HM-LC-Sw1-FM|Wasser||VISIBLE=true|OPERATE=true|STATE=8895|

// Validated by vepman

function HM_LC_Sw1_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['STATE']-18) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
