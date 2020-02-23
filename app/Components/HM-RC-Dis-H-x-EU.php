<?php

// HM-RC-Dis-H-x-EU|OLED Fernbedienung:0|BidCos-RF|MEQ00xxxxx|0|VISIBLE=|OPERATE=|UNREACH=16390|STICKY_UNREACH=16386|CONFIG_PENDING=16372|LOWBAT=16380|RSSI_DEVICE=16384|RSSI_PEER=16385|DEVICE_IN_BOOTLOADER=16376|UPDATE_PENDING=16394|
// HM-RC-Dis-H-x-EU|OLED FB Wohnzimmer Stehlampe|BidCos-RF|MEQ00xxxxx|1|VISIBLE=true|OPERATE=true|PRESS_SHORT=16403|PRESS_LONG=16401|
// HM-RC-Dis-H-x-EU|OLED FB Wohnzimmer Licht|BidCos-RF|MEQ00xxxxx|2|VISIBLE=true|OPERATE=true|PRESS_SHORT=16409|PRESS_LONG=16407|
// HM-RC-Dis-H-x-EU|OLED FB Essecke Licht|BidCos-RF|MEQ00xxxxx|3|VISIBLE=true|OPERATE=true|PRESS_SHORT=16415|PRESS_LONG=16413|
// HM-RC-Dis-H-x-EU|OLED FB Küche Licht|BidCos-RF|MEQ00xxxxx|4|VISIBLE=true|OPERATE=true|PRESS_SHORT=16421|PRESS_LONG=16419|
// HM-RC-Dis-H-x-EU|OLED FB Vorhaus Licht|BidCos-RF|MEQ00xxxxx|5|VISIBLE=true|OPERATE=true|PRESS_SHORT=16427|PRESS_LONG=16425|
// bis 20

// LOWBAT wird nicht angezeigt

// Validated by renmet

function HM_RC_Dis_H_x_EU($component) {
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
