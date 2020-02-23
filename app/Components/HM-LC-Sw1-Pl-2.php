<?php

// HM-LC-Sw1-Pl-2|Klemmlampe Kueche:0||VISIBLE=|OPERATE=|UNREACH=1491|STICKY_UNREACH=1487|CONFIG_PENDING=1473|LOWBAT=1481|DUTYCYCLE=1477|RSSI_DEVICE=1485|RSSI_PEER=1486|
// HM-LC-Sw1-Pl-2|Klemmlampe Kueche:1||VISIBLE=true|OPERATE=true|STATE=1499|

// Validated by vepman

function HM_LC_Sw1_Pl_2($component) {
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
