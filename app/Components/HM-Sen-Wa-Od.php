<?php

// HM-Sen-Wa-Od|Zisternenpegel:0||VISIBLE=|OPERATE=|UNREACH=2707|STICKY_UNREACH=2703|CONFIG_PENDING=2689|LOWBAT=2697|RSSI_DEVICE=2701|RSSI_PEER=2702|DEVICE_IN_BOOTLOADER=2693|UPDATE_PENDING=2711|
// HM-Sen-Wa-Od|Pegel_Zisterne||VISIBLE=true|OPERATE=true|FILLING_LEVEL=2716|

// validated by onkeltom

function HM_Sen_Wa_Od($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['FILLING_LEVEL'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['FILLING_LEVEL']-19) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['FILLING_LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="FILLING_LEVEL"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
