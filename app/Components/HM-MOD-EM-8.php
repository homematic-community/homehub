<?php

// HM-MOD-EM-8|a:0||VISIBLE=|OPERATE=|UNREACH=49070|STICKY_UNREACH=49066|CONFIG_PENDING=49052|LOWBAT=49060|RSSI_DEVICE=49064|RSSI_PEER=49065|DEVICE_IN_BOOTLOADER=49056|UPDATE_PENDING=49074|
// HM-MOD-EM-8|a1||VISIBLE=true|OPERATE=true|PRESS=49126|
// HM-MOD-EM-8|a2||VISIBLE=true|OPERATE=true|STATE=49128|LOWBAT=49127|
// HM-MOD-EM-8|a3||VISIBLE=true|OPERATE=true|PRESS_SHORT=49095|PRESS_LONG=49093|
// HM-MOD-EM-8|a4||VISIBLE=true|OPERATE=true|PRESS_SHORT=49101|PRESS_LONG=49099|
// HM-MOD-EM-8|a5||VISIBLE=true|OPERATE=true|PRESS_SHORT=49107|PRESS_LONG=49105|
// HM-MOD-EM-8|a6||VISIBLE=true|OPERATE=true|PRESS_SHORT=49113|PRESS_LONG=49111|
// HM-MOD-EM-8|a7||VISIBLE=true|OPERATE=true|PRESS_SHORT=49119|PRESS_LONG=49117|
// HM-MOD-EM-8|a8||VISIBLE=true|OPERATE=true|PRESS_SHORT=49125|PRESS_LONG=49123|

// LOWBAT wird nicht angezeigt

function HM_MOD_EM_8($component) {
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
