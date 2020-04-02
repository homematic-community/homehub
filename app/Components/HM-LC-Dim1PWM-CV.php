<?php

// HM-LC-Dim1PWM-CV|OG-Kino-Dimmer-Vitrine:0||VISIBLE=|OPERATE=|UNREACH=2702|STICKY_UNREACH=2698|CONFIG_PENDING=2688|DUTYCYCLE=2692|RSSI_DEVICE=2696|RSSI_PEER=2697|DEVICE_IN_BOOTLOADER=12097|UPDATE_PENDING=12098|
// HM-LC-Dim1PWM-CV|Vitrine||VISIBLE=true|OPERATE=true|LEVEL=2718|OLD_LEVEL=2720|LEVEL_REAL=2719|RAMP_TIME=2723|RAMP_STOP=2722|ERROR_REDUCED=2712|ERROR_OVERHEAT=2708|
// HM-LC-Dim1PWM-CV|HM-LC-Dim1PWM-CV:2||VISIBLE=true|OPERATE=true|LEVEL=2737|OLD_LEVEL=2739|LEVEL_REAL=2738|RAMP_TIME=2742|RAMP_STOP=2741|ERROR_REDUCED=2731|ERROR_OVERHEAT=2727|
// HM-LC-Dim1PWM-CV|HM-LC-Dim1PWM-CV:3||VISIBLE=true|OPERATE=true|LEVEL=2756|OLD_LEVEL=2758|LEVEL_REAL=2757|RAMP_TIME=2761|RAMP_STOP=2760|ERROR_REDUCED=2750|ERROR_OVERHEAT=2746|

// Validated by Manu

function HM_LC_Dim1PWM_CV($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['LEVEL'])) {
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
