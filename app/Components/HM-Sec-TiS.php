<?php

// HM-Sec-TiS|Garage Neigungssensor:0||VISIBLE=|OPERATE=|UNREACH=1333|STICKY_UNREACH=1329|CONFIG_PENDING=1319|LOWBAT=1323|RSSI_DEVICE=1327|RSSI_PEER=1328|
// HM-Sec-TiS|Garage Neigungssensor:1||VISIBLE=true|OPERATE=true|STATE=1340|LOWBAT=1339|

// Validated by steingarten

function HM_Sec_TiS($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
