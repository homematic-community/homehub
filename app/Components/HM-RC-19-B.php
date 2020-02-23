<?php

// HM-RC-19-B|Fernbedienung:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=6634|STICKY_UNREACH=6630|CONFIG_PENDING=6620|LOWBAT=6624|RSSI_DEVICE=6628|RSSI_PEER=6629|
// HM-RC-19-B|FB_Taste01|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=6643|PRESS_LONG=6641|
// HM-RC-19-B|FB_Taste02|BidCos-RF||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=6649|PRESS_LONG=6647|
// bis 17

// LOWBAT wird nicht angezeigt

// validated by gs-rider

function HM_RC_19_B($component) {
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
