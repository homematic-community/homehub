<?php

// HM-PB-2-WM|Wandtaster Hundeküche:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=29260|STICKY_UNREACH=29256|CONFIG_PENDING=29246|LOWBAT=29250|RSSI_DEVICE=29254|RSSI_PEER=29255|
// HM-PB-2-WM|Geschirrspüler EIN/AUS|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=29269|PRESS_LONG=29267|
// HM-PB-2-WM|Deckenspots EIN/AUS|BidCos-RF||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=29275|PRESS_LONG=29273|

// LOWBAT wird nicht angezeigt

// validated by ger.isi

function HM_PB_2_WM($component) {
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
