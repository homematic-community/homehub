<?php

// HM-Sec-MDIR-2|Bewegungsmelder George:0||VISIBLE=|OPERATE=|UNREACH=15714|STICKY_UNREACH=15710|CONFIG_PENDING=15695|LOWBAT=15704|RSSI_DEVICE=15708|RSSI_PEER=15709|DEVICE_IN_BOOTLOADER=15699|UPDATE_PENDING=15718|
// HM-Sec-MDIR-2|BM George||VISIBLE=true|OPERATE=true|BRIGHTNESS=15723|MOTION=15747|ERROR=15724|

// Validated by Manu

function HM_Sec_MDIR_2($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['BRIGHTNESS']-19) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'
                . '<span class="info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
