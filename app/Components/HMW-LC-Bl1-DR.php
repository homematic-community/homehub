<?php

// HMW-LC-Bl1-DR MEQxxxxxxxx:0|BidCos-Wired|MEQxxxxxxxx|0|VISIBLE=|OPERATE=|UNREACH=3074|STICKY_UNREACH=3070|CONFIG_PENDING=3066|
// HMW-LC-Bl1-DR|HMW-LC-Bl1-DR MEQxxxxxxxx:1|BidCos-Wired|MEQxxxxxxxx|1|VISIBLE=true|OPERATE=true|PRESS_SHORT=3081|PRESS_LONG=3080|
// HMW-LC-Bl1-DR|HMW-LC-Bl1-DR MEQxxxxxxxx:2|BidCos-Wired|MEQxxxxxxxx|2|VISIBLE=true|OPERATE=true|PRESS_SHORT=3085|PRESS_LONG=3084|
// HMW-LC-Bl1-DR|HMW-LC-Bl1-DR MEQxxxxxxxx:3|BidCos-Wired|MEQxxxxxxxx|3|VISIBLE=true|OPERATE=true|LEVEL=3090|STOP=3091|

// Validated by steingarten and gs-rider

function HMW_LC_Bl1_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
    
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['LEVEL'])) {
        $modalId = mt_rand();
        
        return '<div class="hh">'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="../assets/icons/fts_window_2w.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.8">'
                            . '<img src="../assets/icons/fts_shutter_20.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.6">'
                            . '<img src="../assets/icons/fts_shutter_40.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.4">'
                            . '<img src="../assets/icons/fts_shutter_60.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.2">'
                            . '<img src="../assets/icons/fts_shutter_80.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                            . '<img src="../assets/icons/fts_shutter_100.png" />'
                        . '</button>'
                    . '</div>'
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="../assets/icons/control_centr_arrow_up.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['STOP'] . '" data-set-value="1">'
                            . '<img src="../assets/icons/message_stop.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                            . '<img src="../assets/icons/control_centr_arrow_down.png" />'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
