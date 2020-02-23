<?php

// HM-PB-4-WM|HMTasterGarageWGEGT:0||VISIBLE=|OPERATE=|UNREACH=4650|STICKY_UNREACH=4646|CONFIG_PENDING=4636|LOWBAT=4640|RSSI_DEVICE=4644|RSSI_PEER=4645|
// HM-PB-4-WM|WintergartenRolladenRauf||VISIBLE=true|OPERATE=true|PRESS_SHORT=4659|PRESS_LONG=4657|
// HM-PB-4-WM|WintergartenRolladenRunter||VISIBLE=true|OPERATE=true|PRESS_SHORT=4665|PRESS_LONG=4663|
// HM-PB-4-WM|EingangstuereRolladenRauf||VISIBLE=true|OPERATE=true|PRESS_SHORT=4671|PRESS_LONG=4669|
// HM-PB-4-WM|EingangstuereRolladenRauf 1||VISIBLE=true|OPERATE=true|PRESS_SHORT=4677|PRESS_LONG=4675|

// LOWBAT wird nicht angezeigt

function HM_PB_4_FM($component) {
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
