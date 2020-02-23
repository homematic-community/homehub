<?php

// HM-RC-Key4-2|SenderA:0||VISIBLE=|OPERATE=|UNREACH=8136|STICKY_UNREACH=8132|CONFIG_PENDING=8118|LOWBAT=8126|RSSI_DEVICE=8130|RSSI_PEER=8131|DEVICE_IN_BOOTLOADER=8122|UPDATE_PENDING=8140|
// HM-RC-Key4-2|SenderA:auf||VISIBLE=true|OPERATE=true|PRESS_SHORT=8147|PRESS_LONG=8146|
// HM-RC-Key4-2|SenderA:zu||VISIBLE=true|OPERATE=true|PRESS_SHORT=8151|PRESS_LONG=8150|
// HM-RC-Key4-2|SenderA:Lampe||VISIBLE=true|OPERATE=true|PRESS_SHORT=8155|PRESS_LONG=8154|
// HM-RC-Key4-2|SenderA:tuer||VISIBLE=true|OPERATE=true|PRESS_SHORT=8159|PRESS_LONG=8158|

// LOWBAT wird nicht angezeigt

// Validated by vepman

function HM_RC_Key4_2($component) {
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
