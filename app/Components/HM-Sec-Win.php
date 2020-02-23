<?php

// HM-Sec-Win|Fenster Stiegenhaus:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=24011|STICKY_UNREACH=24007|CONFIG_PENDING=23993|LOWBAT=24001|DUTYCYCLE=23997|RSSI_DEVICE=24005|RSSI_PEER=24006|
// HM-Sec-Win|Fensterantrieb Gang|BidCos-RF||1|VISIBLE=true|OPERATE=true|LEVEL=24025|RELOCK_DELAY=24026|SPEED=24027|STOP=24029|STATE_UNCERTAIN=24028|ERROR=24017|
// HM-Sec-Win|Fensterantrieb Gang Batterie|BidCos-RF||2|VISIBLE=true|OPERATE=true|LEVEL=24032|STATUS=24033|

// Validated by ger.isi

function HM_Sec_Win($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['RELOCK_DELAY'])) {
        $modalId = mt_rand();
        
        return '<div class="hh">'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['LEVEL']+7) . '" data-component="' . $component['component'] . '" data-datapoint="BATTERY_LEVEL"></span>'
                    . '<span class="info" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>'
                    . '<span class="info" data-id="' . $component['STATE_UNCERTAIN'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE_UNCERTAIN"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="-0.005">'
                            . 'Verriegeln'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">0%</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.2">20%</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.4">40%</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.6">60%</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.8">80%</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">100%</button>'
                    . '</div>'
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                            . '<img src="../assets/icons/control_centr_arrow_up.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['STOP'] . '" data-set-value="1">'
                            . '<img src="../assets/icons/message_stop.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="../assets/icons/control_centr_arrow_down.png" />'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
