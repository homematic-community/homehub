<?php

// HM-WDS30-T-O|Temperatursensor Garagenkeller:0|BidCos-RF|VISIBLE=|OPERATE=|UNREACH=3768|STICKY_UNREACH=3764|CONFIG_PENDING=3754|LOWBAT=3758|RSSI_DEVICE=3762|RSSI_PEER=3763|
// HM-WDS30-T-O|Temperatur Garagenkeller|BidCos-RF|VISIBLE=true|OPERATE=false|TEMPERATURE=3773|

function HM_WDS30_T_O($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['TEMPERATURE']-15) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
