<?php

// Validated by Gerti

function HmIP_SWO_B($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['ACTUAL_TEMPERATURE'])) {
        $modalId = mt_rand();        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
              . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                 . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                 . '<div class="pull-right">'
                   . '<span class="info" data-id="' . $component['WIND_SPEED'] . '" data-component="' . $component['component'] . '" data-datapoint="WIND_SPEED"></span>'
                 . '</div>'
                 . '<div class="clearfix"></div>'
              . '</div>'
        
              . '<div class="hh2 collapse" id="' . $modalId . '"> 
                  <div class="row text-center">' 
                   . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                   . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                   . '<span class="info" data-id="' . $component['ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="ILLUMINATION"></span>'
                 . '</div>'
             . '</div>'
             . '</div>';             
    }
}
