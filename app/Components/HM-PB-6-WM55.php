<?php

// HM-PB-6-WM55|Wandtaster-Wohnzimmer:0||VISIBLE=|OPERATE=|UNREACH=5436|STICKY_UNREACH=5432|CONFIG_PENDING=5418|LOWBAT=5426|RSSI_DEVICE=5430|RSSI_PEER=5431|DEVICE_IN_BOOTLOADER=5422|UPDATE_PENDING=5440|
// HM-PB-6-WM55|Markise raus||VISIBLE=false|OPERATE=false|PRESS_SHORT=5449|PRESS_LONG=5447|
// HM-PB-6-WM55|Markise rein||VISIBLE=false|OPERATE=false|PRESS_SHORT=5455|PRESS_LONG=5453|
// HM-PB-6-WM55|Garagentor hoch||VISIBLE=false|OPERATE=false|PRESS_SHORT=5461|PRESS_LONG=5459|
// HM-PB-6-WM55|Garagentor runter||VISIBLE=false|OPERATE=false|PRESS_SHORT=5467|PRESS_LONG=5465|
// HM-PB-6-WM55|Wasserventil||VISIBLE=false|OPERATE=false|PRESS_SHORT=5473|PRESS_LONG=5471|
// HM-PB-6-WM55|Pumpe||VISIBLE=false|OPERATE=false|PRESS_SHORT=5479|PRESS_LONG=5477|

// LOWBAT wird nicht angezeigt

// Validated by Manu

function HM_PB_6_WM55($component) {
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