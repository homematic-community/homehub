<?php

// HM-RC-19|Intertechno:0|CUxD|CUX4000001|0|VISIBLE=|OPERATE=|
// HM-RC-19|Wohnzimmer Kugellampe:1|CUxD|CUX4000001|1|VISIBLE=true|OPERATE=true|PRESS_SHORT=11829|PRESS_LONG=11828|SEND_CMD=11832|RCVS=11831|RCVL=11830|
// HM-RC-19|Intertechno:2|CUxD|CUX4000001|2|VISIBLE=true|OPERATE=true|PRESS_SHORT=11842|PRESS_LONG=11841|SEND_CMD=11845|RCVS=11844|RCVL=11843|
// HM-RC-19|Intertechno:3|CUxD|CUX4000001|3|VISIBLE=true|OPERATE=true|PRESS_SHORT=11855|PRESS_LONG=11854|SEND_CMD=11858|RCVS=11857|RCVL=11856|
// HM-RC-19|Intertechno:4|CUxD|CUX4000001|4|VISIBLE=false|OPERATE=false|PRESS_SHORT=11868|PRESS_LONG=11867|SEND_CMD=11871|RCVS=11870|RCVL=11869|
// bis 19

// validated by Braindead

function CUX4000($component) {
    if ($component['parent_device_interface'] == 'CUxD' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
    
    if ($component['parent_device_interface'] == 'CUxD' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
