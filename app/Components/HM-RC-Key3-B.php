<?php

// HM-RC-Key3-B|MasterFBKeymaticA:0||VISIBLE=|OPERATE=|UNREACH=4723|STICKY_UNREACH=4719|CONFIG_PENDING=4709|LOWBAT=4713|RSSI_DEVICE=4717|RSSI_PEER=4718|
// HM-RC-Key3-B|MasterFBKeymatic 1||VISIBLE=true|OPERATE=true|PRESS_SHORT=4732|PRESS_LONG=4730|
// HM-RC-Key3-B|MasterFBKeymatic 2||VISIBLE=true|OPERATE=true|PRESS_SHORT=4738|PRESS_LONG=4736|
// HM-RC-Key3-B|MasterFBKeymatic||VISIBLE=true|OPERATE=true|PRESS_SHORT=4744|PRESS_LONG=4742|

// LOWBAT wird nicht angezeigt

function HM_RC_Key3_B($component) {
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
