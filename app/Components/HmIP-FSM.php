<?php

// Validated by Gerti

function HmIP_FSM($component) {

    global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."5", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $power_component[$datapoint['type']] = $datapoint['ise_id']; }

    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        $modalId = mt_rand();  
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">' 
                . '<div class="row text-center">'
                    . '<span class="info" data-id="' . ($power_component['CURRENT']) . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT"></span>'
                    . '<span class="info" data-id="' . ($power_component['POWER']) . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
                    . '<span class="info" data-id="' . ($power_component['ENERGY_COUNTER']) . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
