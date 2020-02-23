<?php

// HM-PB-2-FM|BadEGLi:0||VISIBLE=|OPERATE=|UNREACH=37608|STICKY_UNREACH=37604|CONFIG_PENDING=37590|LOWBAT=37598|RSSI_DEVICE=37602|RSSI_PEER=37603|DEVICE_IN_BOOTLOADER=37594|UPDATE_PENDING=37612|
// HM-PB-2-FM|BadEGLiLichtOFF||VISIBLE=true|OPERATE=true|PRESS_SHORT=37621|PRESS_LONG=37619|
// HM-PB-2-FM|BadEGLiLichtON||VISIBLE=true|OPERATE=true|PRESS_SHORT=37627|PRESS_LONG=37625|

// LOWBAT wird nicht angezeigt

function HM_PB_2_FM($component) {
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
