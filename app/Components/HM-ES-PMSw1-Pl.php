<?php

// Validated by Braindead, steingarten

function HM_ES_PMSw1_Pl($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        $modalId = mt_rand();  
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                    . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
                . '<div class="hh2 collapse" id="' . $modalId . '"> 
                    <div class="row text-center">'
                    . '<span class="info" data-id="' . ($component['STATE']+4) . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT"></span>'
                    . '<span class="info" data-id="' . ($component['STATE']+7) . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
                    . '<span class="info" data-id="' . ($component['STATE']+5) . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
