<?php

// HM-Sec-WDS-2|Wassermelder Küche:0||VISIBLE=|OPERATE=|UNREACH=25337|STICKY_UNREACH=25333|CONFIG_PENDING=25323|LOWBAT=25327|RSSI_DEVICE=25331|RSSI_PEER=25332|
// HM-Sec-WDS-2|Wassermelder Küche||VISIBLE=true|OPERATE=true|STATE=25344|LOWBAT=25343|

// Validated by Manu

function HM_Sec_WDS_2($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['STATE']-7) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
