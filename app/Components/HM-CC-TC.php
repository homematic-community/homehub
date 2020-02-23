<?php

// HM-CC-TC|HZ21_AZ_WandThermostat:0||VISIBLE=|OPERATE=|UNREACH=7168|STICKY_UNREACH=7164|CONFIG_PENDING=7154|LOWBAT=7158|RSSI_DEVICE=7162|RSSI_PEER=7163|
// HM-CC-TC|HZ21_AZ_IstTemp||VISIBLE=true|OPERATE=true|TEMPERATURE=7174|HUMIDITY=7173|
// HM-CC-TC|HZ21_AZ_SollTemp||VISIBLE=true|OPERATE=true|SETPOINT=7178|ADJUSTING_COMMAND=7176|ADJUSTING_DATA=7177|
// HM-CC-TC|HM-CC-TC:3||VISIBLE=true|OPERATE=true|

function HM_CC_TC($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        $modalId = mt_rand();
        
        return '<div class="hh">'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['TEMPERATURE']-16) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                    . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">
                    <div class="row text-center">'
                        . '<div class="form-inline">'
                            . '<div class="input-group">'
                                . '<input type="number" name="' . ($component['TEMPERATURE']+4) . '" min="6.0" max="30.0" class="form-control" placeholder="Zahl eingeben">'
                                . '<span class="input-group-btn">'
                                    . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . ($component['TEMPERATURE']+4) . '" data-set-value="">OK</button>'
                                . '</span>'
                            . '</div>'
                        . '</div>'                    
                    . '</div>'
                . '</div>'
            . '</div>';
    }
}
