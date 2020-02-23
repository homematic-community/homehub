<?php

// HM-PB-2-WM55-2|Test Schalter:0||VISIBLE=|OPERATE=|UNREACH=10650|STICKY_UNREACH=10646|CONFIG_PENDING=10636|LOWBAT=10640|RSSI_DEVICE=10644|RSSI_PEER=10645|
// HM-PB-2-WM55-2|Test Schalter:1||VISIBLE=true|OPERATE=true|PRESS_SHORT=10659|PRESS_LONG=10657|
// HM-PB-2-WM55-2|Test Schalter:2||VISIBLE=true|OPERATE=true|PRESS_SHORT=10665|PRESS_LONG=10663|

// LOWBAT wird nicht angezeigt

// Validated by Braindead

function HM_PB_2_WM55_2($component) {
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
