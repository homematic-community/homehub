<?php

// HM-LC-Sw4-WM|Garten-Ventile:0||VISIBLE=|OPERATE=|UNREACH=7843|STICKY_UNREACH=7839|CONFIG_PENDING=7825|LOWBAT=7833|DUTYCYCLE=7829|RSSI_DEVICE=7837|RSSI_PEER=7838|
// HM-LC-Sw4-WM|Wasser-Terrasse||VISIBLE=true|OPERATE=true|STATE=7851|
// HM-LC-Sw4-WM|Wasser-Beete||VISIBLE=true|OPERATE=true|STATE=7857|
// HM-LC-Sw4-WM|Wasser-Pool||VISIBLE=true|OPERATE=true|STATE=7863|
// HM-LC-Sw4-WM|XXXX-ohne-Funktion||VISIBLE=true|OPERATE=true|STATE=7869|

// LOWBAT wird nicht angezeigt

function HM_LC_Sw4_WM($component) {
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
