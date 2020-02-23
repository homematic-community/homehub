<?php

// HM-PB-2-WM55|KuecheOGLichts:0||VISIBLE=|OPERATE=|UNREACH=29913|STICKY_UNREACH=29909|CONFIG_PENDING=29899|LOWBAT=29903|RSSI_DEVICE=29907|RSSI_PEER=29908|
// HM-PB-2-WM55|KuecheOGLichts1||VISIBLE=true|OPERATE=true|PRESS_SHORT=29922|PRESS_LONG=29920|
// HM-PB-2-WM55|KuecheOGLichts2||VISIBLE=true|OPERATE=true|PRESS_SHORT=29928|PRESS_LONG=29926|

// LOWBAT wird nicht angezeigt

// Validated by Manu

function HM_PB_2_WM55($component) {
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
