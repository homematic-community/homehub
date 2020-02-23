<?php

// HM-RC-4|HM-RC-4:0||VISIBLE=|OPERATE=|UNREACH=7756|STICKY_UNREACH=7752|CONFIG_PENDING=7742|LOWBAT=7746|RSSI_DEVICE=7750|RSSI_PEER=7751|
// HM-RC-4|Taster1:1||VISIBLE=true|OPERATE=true|PRESS_SHORT=7765|PRESS_LONG=7763|
// HM-RC-4|Taster1:2||VISIBLE=true|OPERATE=true|PRESS_SHORT=7771|PRESS_LONG=7769|
// HM-RC-4|Taster1:3||VISIBLE=true|OPERATE=true|PRESS_SHORT=7777|PRESS_LONG=7775|
// HM-RC-4|Taster1:4||VISIBLE=true|OPERATE=true|PRESS_SHORT=7783|PRESS_LONG=7781|

// LOWBAT wird nicht angezeigt

// Validated by vepman

function HM_RC_4($component) {
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
