<?php

// HM-OU-CM-PCB|HM-OU-CM-PCB MEQ0xxxxx:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=18177|STICKY_UNREACH=18173|CONFIG_PENDING=18155|LOWBAT=18167|DUTYCYCLE=18163|RSSI_DEVICE=18171|RSSI_PEER=18172|DEVICE_IN_BOOTLOADER=18159|UPDATE_PENDING=18181|
// HM-OU-CM-PCB|HM-OU-CM-PCB MEQ0xxxxx:1|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=18189|SUBMIT=18190|

// validated by onkeltom

function HM_OU_CM_PCB($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['STATE']-22) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
