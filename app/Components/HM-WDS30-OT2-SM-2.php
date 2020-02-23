<?php

// HM-WDS30-OT2-SM-2|SonneHinten:0||VISIBLE=|OPERATE=|UNREACH=22747|STICKY_UNREACH=22743|CONFIG_PENDING=22733|LOWBAT=22737|RSSI_DEVICE=22741|RSSI_PEER=22742|
// HM-WDS30-OT2-SM-2|SonneHinten1||VISIBLE=true|OPERATE=true|TEMPERATURE=22753|LOWBAT=22752|
// HM-WDS30-OT2-SM-2|SonneHinten2||VISIBLE=true|OPERATE=true|TEMPERATURE=22756|LOWBAT=22755|
// HM-WDS30-OT2-SM-2|SonneHinten3||VISIBLE=true|OPERATE=true|TEMPERATURE=22759|LOWBAT=22758|
// HM-WDS30-OT2-SM-2|SonneHinten4||VISIBLE=true|OPERATE=true|TEMPERATURE=22762|LOWBAT=22761|
// HM-WDS30-OT2-SM-2|SonneHinten5||VISIBLE=true|OPERATE=true|TEMPERATURE=22765|LOWBAT=22764|

// Validated by Manu

function HM_WDS30_OT2_SM_2($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
