<?php

// HM-ES-TX-WM|Stromzaehler:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=21447|STICKY_UNREACH=21443|CONFIG_PENDING=21429|LOWBAT=21437|RSSI_DEVICE=21441|RSSI_PEER=21442|DEVICE_IN_BOOTLOADER=21433|UPDATE_PENDING=21451|
// HM-ES-TX-WM|HM-ES-TX-WM:1|BidCos-RF||1|VISIBLE=true|OPERATE=true|GAS_ENERGY_COUNTER=21458|GAS_POWER=21459|ENERGY_COUNTER=21457|POWER=21460|

// validated by onkeltom and charlyphyro

function HM_ES_TX_WM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['GAS_ENERGY_COUNTER'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['GAS_ENERGY_COUNTER']-21) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['GAS_ENERGY_COUNTER'] . '" data-component="' . $component['component'] . '" data-datapoint="GAS_ENERGY_COUNTER"></span>'
                . '<span class="info" data-id="' . $component['GAS_POWER'] . '" data-component="' . $component['component'] . '" data-datapoint="GAS_POWER"></span>'
                . '<span class="info" data-id="' . $component['ENERGY_COUNTER'] . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
                . '<span class="info" data-id="' . $component['POWER'] . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
