<?php

// HM-CC-SCD|CO2-Melder:0||0|VISIBLE=|OPERATE=|UNREACH=23635|STICKY_UNREACH=23631|CONFIG_PENDING=23625|RSSI_DEVICE=23629|RSSI_PEER=23630|
// HM-CC-SCD|CO2-Melder||VISIBLE=true|OPERATE=true|STATE=23641|

// Validated by Manu

function HM_CC_SCD($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['STATE']-7) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
