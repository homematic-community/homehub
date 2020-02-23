<?php

// HM-LC-Sw2-FM|Garten-Pool:0|BidCos-RF|...|0|VISIBLE=|OPERATE=|UNREACH=8752|STICKY_UNREACH=8748|CONFIG_PENDING=8734|LOWBAT=8742|DUTYCYCLE=8738|RSSI_DEVICE=8746|RSSI_PEER=8747|
// HM-LC-Sw2-FM|AB-Garten-Pool-Reserve|BidCos-RF|...|1|VISIBLE=true|OPERATE=true|STATE=8760|
// HM-LC-Sw2-FM|Poolpumpe|BidCos-RF|...|2|VISIBLE=true|OPERATE=true|STATE=8766|

// LOWBAT wird nicht angezeigt

function HM_LC_Sw2_FM($component) {
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
