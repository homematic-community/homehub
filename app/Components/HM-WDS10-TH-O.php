<?php

// HM-WDS10-TH-O|Garten Wetter:0||VISIBLE=|OPERATE=|UNREACH=7210|STICKY_UNREACH=7206|CONFIG_PENDING=7196|LOWBAT=7200|RSSI_DEVICE=7204|RSSI_PEER=7205|
// HM-WDS10-TH-O|Garten Wetter:1||VISIBLE=true|OPERATE=true|TEMPERATURE=7216|HUMIDITY=7215|

// Validated by Braindead

function HM_WDS10_TH_O($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
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
