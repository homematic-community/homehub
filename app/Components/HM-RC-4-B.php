<?php

// HM-RC-4-B|FB Gästezimmer:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=15759|STICKY_UNREACH=15755|CONFIG_PENDING=15745|LOWBAT=15749|RSSI_DEVICE=15753|RSSI_PEER=15754|
// HM-RC-4-B|Licht AUS Bett Gästezimmer|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=15768|PRESS_LONG=15766|
// HM-RC-4-B|Licht EIN Bett Gästezimmer|BidCos-RF||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=15774|PRESS_LONG=15772|
// HM-RC-4-B|Licht AUS Vorzimmer EG|BidCos-RF||3|VISIBLE=true|OPERATE=true|PRESS_SHORT=15780|PRESS_LONG=15778|
// HM-RC-4-B|Licht EIN Vorzimmer EG|BidCos-RF||4|VISIBLE=true|OPERATE=true|PRESS_SHORT=15786|PRESS_LONG=15784|

// LOWBAT wird nicht angezeigt

// validated by ger.isi

function HM_RC_4_B($component) {
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
