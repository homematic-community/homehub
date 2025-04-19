<?php

// Parameter config/custom.json oder config/mapping.json
// use_device_counter (optional): wenn leer nutze CCU-Zähler, ansonsten Geräteinternen Zähler ("use_device_counter":"true")

function HmIP_PSM_2QHJ($component) {

    global $export;
    $key = array_search(substr($component['address'], 0, -1)."6", array_column($export['channels'], 'address'));
    foreach($export['channels'][$key]['datapoints'] as $datapoint) $power_component[$datapoint['type']] = $datapoint['ise_id'];

    if (empty($component['use_device_counter']) or (strtolower($component['use_device_counter']) == 'false')) {
        if (!empty($key) and !empty($power_component['ENERGY_COUNTER']) and !empty($export['systemvariablesinternal'])) {
            foreach ($export['systemvariablesinternal'] as $sv_int) {
                if (strpos($sv_int['name'], 'svEnergyCounter_'.$export['channels'][$key]["ise_id"]) !== false) {
                    // echo PHP_EOL.$component['ise_id'].': ersetze ENERGY_COUNTER '.$power_component['ENERGY_COUNTER'].' durch Systemvariable '.$sv_int['ise_id'].' '.$sv_int['name'].PHP_EOL;
                    $power_component['ENERGY_COUNTER'] = $sv_int['ise_id'];
                }
            }
        }
    }

    if(!isset($component['button'])) {
        $component['button'] = 'switch';
    }

    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        $modalId = mt_rand();
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-button="' . $component['button'] . '" data-set-value=""></span>'
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
