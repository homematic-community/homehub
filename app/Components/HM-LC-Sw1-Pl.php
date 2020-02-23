<?php

// HM-LC-Sw1-Pl|KuecheOGDunsthaube:0||VISIBLE=|OPERATE=|UNREACH=4992|STICKY_UNREACH=4988|CONFIG_PENDING=4974|LOWBAT=4982|DUTYCYCLE=4978|RSSI_DEVICE=4986|RSSI_PEER=4987|
// HM-LC-Sw1-Pl|KuecheOGDunsthaube1||VISIBLE=true|OPERATE=true|STATE=5000|

function HM_LC_Sw1_Pl($component) {
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
