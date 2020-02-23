<?php

// HM-RC-8|Handsender 1:0||VISIBLE=|OPERATE=|UNREACH=3607|STICKY_UNREACH=3603|CONFIG_PENDING=3589|LOWBAT=3597|RSSI_DEVICE=3601|RSSI_PEER=3602|DEVICE_IN_BOOTLOADER=3593|UPDATE_PENDING=3611|
// HM-RC-8|HS1 Poller||VISIBLE=true|OPERATE=true|PRESS_SHORT=3620|PRESS_LONG=3618|
// HM-RC-8|HS1 Reserve||VISIBLE=true|OPERATE=true|PRESS_SHORT=3626|PRESS_LONG=3624|
// HM-RC-8|HS1 Tor Garten||VISIBLE=true|OPERATE=true|PRESS_SHORT=3632|PRESS_LONG=3630|
// HM-RC-8|HS1 Tor Einfahrt||VISIBLE=true|OPERATE=true|PRESS_SHORT=3638|PRESS_LONG=3636|
// bis 8

// LOWBAT wird nicht angezeigt

function HM_RC_8($component) {
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
