<?php

// HMW-LC-Sw2-DR|HKV_UG:0|BidCos-Wired||0|VISIBLE=|OPERATE=|UNREACH=11720|STICKY_UNREACH=11716|CONFIG_PENDING=11712|
// HMW-LC-Sw2-DR|HKV_UG:1|BidCos-Wired||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=11727|PRESS_LONG=11726|
// HMW-LC-Sw2-DR|HKV_UG:2|BidCos-Wired||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=11731|PRESS_LONG=11730|
// HMW-LC-Sw2-DR|HKV_UG:3|BidCos-Wired||3|VISIBLE=true|OPERATE=true|STATE=11735|
// HMW-LC-Sw2-DR|HKV_UG:4|BidCos-Wired||4|VISIBLE=true|OPERATE=true|STATE=11740|

// Validated by AudioSonic

function HMW_LC_Sw2_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
    
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['STATE'])) {
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
