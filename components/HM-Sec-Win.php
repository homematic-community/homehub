<?php
function HM_Sec_Win($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['RELOCK_DELAY'])) {
        $modalId = mt_rand();
        
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
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
                            . '<img src="icon/control_centr_arrow_up.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['STOP'] . '" data-set-value="1">'
                            . '<img src="icon/message_stop.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="icon/control_centr_arrow_down.png" />'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
