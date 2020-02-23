<?php

// HM-WDS40-TH-I-2|Garten Wetter:0||VISIBLE=|OPERATE=|UNREACH=7210|STICKY_UNREACH=7206|CONFIG_PENDING=7196|LOWBAT=7200|RSSI_DEVICE=7204|RSSI_PEER=7205|
// HM-WDS40-TH-I-2|Garten Wetter:1||VISIBLE=true|OPERATE=true|TEMPERATURE=7216|HUMIDITY=7215|

// validated by onkeltom

function HM_WDS40_TH_I_2($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['HUMIDITY']-15) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
                . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
