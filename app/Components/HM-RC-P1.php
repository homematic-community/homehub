<?php

// HM-RC-P1|Panikhandsender:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=17526|STICKY_UNREACH=17522|CONFIG_PENDING=17512|LOWBAT=17516|RSSI_DEVICE=17520|RSSI_PEER=17521|
// HM-RC-P1|Panik Licht EIN|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=17535|PRESS_LONG=17533|

// LOWBAT wird nicht angezeigt

// validated by ger.isi

function HM_RC_P1($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
