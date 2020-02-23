<?php

// HM-Sen-DB-PCB|Klingelsensor:0||VISIBLE=|OPERATE=|UNREACH=9825|STICKY_UNREACH=9821|CONFIG_PENDING=9807|LOWBAT=9815|RSSI_DEVICE=9819|RSSI_PEER=9820|DEVICE_IN_BOOTLOADER=9811|UPDATE_PENDING=9829|
// HM-Sen-DB-PCB|Klingelsensor:1||VISIBLE=true|OPERATE=true|PRESS_SHORT=9836|

function HM_Sen_DB_PCB($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['PRESS_SHORT']-21) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
