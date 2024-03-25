<?php
function HM_ES_PMSw1_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if(!isset($component['button'])) {
            $component['button'] = 'switch';
        }
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                //. '<span class="right info" data-id="' . ($component['STATE']+8) . '" data-component="' . $component['component'] . '" data-datapoint="VOLTAGE"></span>'
                //. '<span class="right info" data-id="' . ($component['STATE']+6) . '" data-component="' . $component['component'] . '" data-datapoint="FREQUENCY"></span>'
                . '<span class="info" data-id="' . ($component['STATE']+4) . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT"></span>'
                . '<span class="info" data-id="' . ($component['STATE']+7) . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
                . '<span class="info" data-id="' . ($component['STATE']+5) . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE" data-set-id="' . $component['STATE'] . '" data-button="' . $component['button'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
