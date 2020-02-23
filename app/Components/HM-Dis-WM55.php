<?php

// HM-Dis-WM55|Display1:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=28955|STICKY_UNREACH=28951|CONFIG_PENDING=28937|LOWBAT=28945|RSSI_DEVICE=28949|RSSI_PEER=28950|DEVICE_IN_BOOTLOADER=28941|UPDATE_PENDING=28959|
// HM-Dis-WM55|HM-Dis-WM55:1|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=28968|PRESS_LONG=28966|SUBMIT=28969|
// HM-Dis-WM55|HM-Dis-WM55:2|BidCos-RF||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=28975|PRESS_LONG=28973|SUBMIT=28976|
// HM-Dis-WM55|HM-Dis-WM55:3|BidCos-RF||3|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:4|BidCos-RF||4|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:5|BidCos-RF||5|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:6|BidCos-RF||6|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:7|BidCos-RF||7|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:8|BidCos-RF||8|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:9|BidCos-RF||9|VISIBLE=true|OPERATE=true|
// HM-Dis-WM55|HM-Dis-WM55:10|BidCos-RF||10|VISIBLE=true|OPERATE=true|

// LOWBAT wird nicht angezeigt

// validated by ger.isi

function HM_Dis_WM55($component) {
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
