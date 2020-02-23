<?php

// HM-Sen-MDIR-SM|WintergartenBewegung:0||VISIBLE=|OPERATE=|
// HM-Sen-MDIR-SM|WintergartenBewegung:1||VISIBLE=true|OPERATE=true|MOTION=25175|EVENTCTR=25174|

function HM_Sen_MDIR_SM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
