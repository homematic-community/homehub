<?php

// HM-PBI-4-FM|Honda:0||VISIBLE=|OPERATE=|UNREACH=7265|STICKY_UNREACH=7261|CONFIG_PENDING=7251|LOWBAT=7255|RSSI_DEVICE=7259|RSSI_PEER=7260|
// HM-PBI-4-FM|CBF Poller/Kette||VISIBLE=true|OPERATE=true|PRESS_SHORT=7274|PRESS_LONG=7272|
// HM-PBI-4-FM|CBF Garagentor||VISIBLE=true|OPERATE=true|PRESS_SHORT=7280|PRESS_LONG=7278|
// HM-PBI-4-FM|HM-PBI-4-FM:3||VISIBLE=true|OPERATE=true|PRESS_SHORT=7286|PRESS_LONG=7284|
// HM-PBI-4-FM|HM-PBI-4-FM:4||VISIBLE=true|OPERATE=true|PRESS_SHORT=7292|PRESS_LONG=7290|

// LOWBAT wird nicht angezeigt

function HM_PBI_4_FM($component) {
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
