<?php

// HM-PB-4Dis-WM-2|Wandtaster Keller:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=4893|STICKY_UNREACH=4889|CONFIG_PENDING=4879|LOWBAT=4883|RSSI_DEVICE=4887|RSSI_PEER=4888|
// HM-PB-4Dis-WM-2|Licht Garten AUS Kellertaster|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=4900|PRESS_LONG=4899|
// HM-PB-4Dis-WM-2|Licht Garten EIN Kellertaster|BidCos-RF||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=4904|PRESS_LONG=4903|
// HM-PB-4Dis-WM-2|Licht Stellplatz Terasse AUS|BidCos-RF||3|VISIBLE=true|OPERATE=true|PRESS_SHORT=4908|PRESS_LONG=4907|
// HM-PB-4Dis-WM-2|Licht Stellplatz Terasse EIN|BidCos-RF||4|VISIBLE=true|OPERATE=true|PRESS_SHORT=4912|PRESS_LONG=4911|
// HM-PB-4Dis-WM-2|Aussenbeleuchtung AUS Kellertaster|BidCos-RF||5|VISIBLE=true|OPERATE=true|PRESS_SHORT=4916|PRESS_LONG=4915|
// HM-PB-4Dis-WM-2|Aussenbeleuchtung EIN Kellertaster|BidCos-RF||6|VISIBLE=true|OPERATE=true|PRESS_SHORT=4920|PRESS_LONG=4919|
// bis 20

// LOWBAT wird nicht angezeigt

function HM_PB_4Dis_WM_2($component) {
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
