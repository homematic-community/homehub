<?php

// HM-LC-Sw4-DR|PoolSteuerung:0||VISIBLE=|OPERATE=|UNREACH=7252|STICKY_UNREACH=7248|CONFIG_PENDING=7234|LOWBAT=7242|DUTYCYCLE=7238|RSSI_DEVICE=7246|RSSI_PEER=7247|
// HM-LC-Sw4-DR|PoolPumpe||VISIBLE=true|OPERATE=true|STATE=7260|
// HM-LC-Sw4-DR|PoolUWScheinwerfer||VISIBLE=true|OPERATE=true|STATE=7266|
// HM-LC-Sw4-DR|PoolBelGehwegli||VISIBLE=true|OPERATE=true|STATE=7272|
// HM-LC-Sw4-DR|PoolBelGehwegre||VISIBLE=true|OPERATE=true|STATE=7278|

// LOWBAT wird nicht angezeigt

function HM_LC_Sw4_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
