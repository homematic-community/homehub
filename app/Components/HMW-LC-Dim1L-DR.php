<?php

// HMW-LC-Dim1L-DR|HMW-LC-Dim1L-DR MEQxxxxxxxx:0|BidCos-Wired|MEQxxxxxxxx|0|VISIBLE=|OPERATE=|UNREACH=3103|STICKY_UNREACH=3099|CONFIG_PENDING=3095|
// HMW-LC-Dim1L-DR|HMW-LC-Dim1L-DR MEQxxxxxxxx:1|BidCos-Wired|MEQxxxxxxxx|1|VISIBLE=true|OPERATE=true|PRESS_SHORT=3110|PRESS_LONG=3109|
// HMW-LC-Dim1L-DR|HMW-LC-Dim1L-DR MEQxxxxxxxx:2|BidCos-Wired|MEQxxxxxxxx|2|VISIBLE=true|OPERATE=true|PRESS_SHORT=3114|PRESS_LONG=3113|
// HMW-LC-Dim1L-DR|HMW-LC-Dim1L-DR MEQxxxxxxxx:3|BidCos-Wired|MEQxxxxxxxx|3|VISIBLE=true|OPERATE=true|LEVEL=3119|

// validated by cd84

function HMW_LC_Dim1L_DR($component) {
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
        
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info set" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL" data-set-id="' . $component['LEVEL'] . '" data-set-value=""></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">Aus'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.2">20%'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.4">40%'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.6">60%'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.8">80%'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">100%'
                        . '</button>'                      
                    . '</div>'
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="row text-center">'
                        . '<div class="form-inline">'
                            . '<div class="input-group">'
                                . '<input type="number" name="' . $component['LEVEL'] . '" min="0" max="100" class="form-control" placeholder="Wert">'
                                . '<span class="input-group-btn">'
                                    . '<button class="btn btn-primary set" data-datapoint="DIMLEVEL" data-set-id="' . $component['LEVEL'] . '" data-set-value="">OK</button>'
                                . '</span>'
                            . '</div>'
                        . '</div>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
