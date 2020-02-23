<?php

// HM-Sen-MDIR-WM55|Bewegung Vorbau:0|BidCos-RF|MEQ0xxxxxx|0|VISIBLE=|OPERATE=|UNREACH=18358|STICKY_UNREACH=18354|CONFIG_PENDING=18340|LOWBAT=18348|RSSI_DEVICE=18352|RSSI_PEER=18353|DEVICE_IN_BOOTLOADER=18344|UPDATE_PENDING=18362|
// HM-Sen-MDIR-WM55|Licht Eingang aus|BidCos-RF|MEQ0xxxxxx|1|VISIBLE=true|OPERATE=true|PRESS_SHORT=18371|PRESS_LONG=18369|
// HM-Sen-MDIR-WM55|Licht Eingang an|BidCos-RF|MEQ0xxxxxx|2|VISIBLE=true|OPERATE=true|PRESS_SHORT=18377|PRESS_LONG=18375|
// HM-Sen-MDIR-WM55|Bewegung Vorbau|BidCos-RF|MEQ0xxxxxx|3|VISIBLE=true|OPERATE=true|BRIGHTNESS=18379|MOTION=18381|

// Lowbat wid nicht angezeigt

// Validated by Manu

function HM_Sen_MDIR_WM55($component) {
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
    
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['BRIGHTNESS'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'
                . '<span class="info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
