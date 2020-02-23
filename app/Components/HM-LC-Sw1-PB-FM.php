<?php

// HM-LC-Sw1-PB-FM|Lichtschalter Büro:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=4866|STICKY_UNREACH=4862|CONFIG_PENDING=4848|LOWBAT=4856|DUTYCYCLE=4852|RSSI_DEVICE=4860|RSSI_PEER=4861|
// HM-LC-Sw1-PB-FM|Licht Büro|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=4874|

// validated by ger.isi

function HM_LC_Sw1_PB_FM($component) {
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
