<?php

// HM-Sec-SD-2-Team|Rauchmelder Gruppe Flur:0|BidCos-RF||0|VISIBLE=|OPERATE=|
// HM-Sec-SD-2-Team|Rauchmelder Gruppe|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=1849|

// validated by Braindead

function HM_Sec_SD_2_Team($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
