<?php

// HM-LC-Dim1T-Pl|Dunstabzug Licht:0||VISIBLE=|OPERATE=|UNREACH=13221|STICKY_UNREACH=13217|CONFIG_PENDING=13207|DUTYCYCLE=13211|RSSI_DEVICE=13215|RSSI_PEER=13216|
// HM-LC-Dim1T-Pl|Dunstabzug Licht:1|BidCos-RF||1|VISIBLE=true|OPERATE=true|LEVEL=4825|OLD_LEVEL=4826|RAMP_TIME=4829|RAMP_STOP=4828|ERROR_REDUCED=4819|ERROR_OVERLOAD=4815|ERROR_OVERHEAT=4811|

// Validated by firephaser

function HM_LC_Dim1T_Pl($component) {
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
