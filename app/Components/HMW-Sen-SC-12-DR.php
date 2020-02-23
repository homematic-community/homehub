<?php

// HMW-Sen-SC-12-DR|UK_Modul_04:0|BidCos-Wired||0|VISIBLE=|OPERATE=|UNREACH=5033|STICKY_UNREACH=5029|CONFIG_PENDING=5025|
// HMW-Sen-SC-12-DR|Schaltschrank|BidCos-Wired||1|VISIBLE=true|OPERATE=true|SENSOR=5039|
// HMW-Sen-SC-12-DR|HMW-Sen-SC-12-DR:2|BidCos-Wired||2|VISIBLE=true|OPERATE=true|SENSOR=5042|
// HMW-Sen-SC-12-DR|HMW-Sen-SC-12-DR:3|BidCos-Wired||3|VISIBLE=true|OPERATE=true|SENSOR=5045|
// bis 12

// LOWBAT wird nicht angezeigt

function HMW_Sen_SC_12_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['SENSOR'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['SENSOR'] . '" data-component="' . $component['component'] . '" data-datapoint="SENSOR"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
