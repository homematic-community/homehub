<?php

// HM-SCI-3-FM|Zustandsmelder 1:0||VISIBLE=|OPERATE=|UNREACH=16257|STICKY_UNREACH=16253|CONFIG_PENDING=16243|LOWBAT=16247|RSSI_DEVICE=16251|RSSI_PEER=16252|
// HM-SCI-3-FM|Alarmanlageneingang||VISIBLE=true|OPERATE=true|STATE=16264|LOWBAT=16263|
// HM-SCI-3-FM|HM-SCI-3-FM:2||VISIBLE=true|OPERATE=true|STATE=16268|LOWBAT=16267|
// HM-SCI-3-FM|HM-SCI-3-FM:3||VISIBLE=true|OPERATE=true|STATE=16272|LOWBAT=16271|

// Validated by vepman

function HM_SCI_3_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
