<?php

// HM-MOD-Re-8|RolladenVeluxOG:0||VISIBLE=|OPERATE=|UNREACH=37869|STICKY_UNREACH=37865|CONFIG_PENDING=37847|LOWBAT=37859|DUTYCYCLE=37855|RSSI_DEVICE=37863|RSSI_PEER=37864|DEVICE_IN_BOOTLOADER=37851|UPDATE_PENDING=37873|
// HM-MOD-Re-8|VeluuxGruppe1Rauf||VISIBLE=true|OPERATE=true|STATE=37881|
// HM-MOD-Re-8|VeluuxGruppe1Runter||VISIBLE=true|OPERATE=true|STATE=37887|
// HM-MOD-Re-8|VeluuxGruppe2Rauf||VISIBLE=true|OPERATE=true|STATE=37893|
// HM-MOD-Re-8|VeluuxGruppe2Runter||VISIBLE=true|OPERATE=true|STATE=37899|
// HM-MOD-Re-8|VeluuxGruppe3Rauf||VISIBLE=true|OPERATE=true|STATE=37905|
// HM-MOD-Re-8|VeluuxGruppe3Runter||VISIBLE=true|OPERATE=true|STATE=37911|
// HM-MOD-Re-8|VeluuxGruppe4Rauf||VISIBLE=true|OPERATE=true|STATE=37917|
// HM-MOD-Re-8|VeluuxGruppe4Runter||VISIBLE=true|OPERATE=true|STATE=37923|

// Lowbat wird nicht angezeigt

function HM_MOD_Re_8($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
