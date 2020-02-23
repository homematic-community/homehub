<?php

// HM-Sen-EP|Torkontakt-Auto:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=1731|STICKY_UNREACH=1727|CONFIG_PENDING=1719|LOWBAT=1723|RSSI_DEVICE=27661|RSSI_PEER=27662|
// HM-Sen-EP|Hondakontakt1|BidCos-RF||1|VISIBLE=true|OPERATE=true|SEQUENCE_OK=1737|
// HM-Sen-EP|Hondakontakt2|BidCos-RF||2|VISIBLE=true|OPERATE=true|SEQUENCE_OK=1740|

// LOWBAT wird nicht angezeigt

// Validated by ColleLupi

function HM_Sen_EP($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['SEQUENCE_OK'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['SEQUENCE_OK'] . '" data-set-value="1">OK</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
