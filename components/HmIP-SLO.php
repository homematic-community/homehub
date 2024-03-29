<?php

// Validated by Gerti

function HmIP_SLO($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['CURRENT_ILLUMINATION'])) {
        $modalId = mt_rand();        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
              . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                 . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                 . '<div class="pull-right">'
                   . '<span class="info" data-id="' . $component['CURRENT_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT_ILLUMINATION"></span>'
                 . '</div>'
                 . '<div class="clearfix"></div>'
              . '</div>'
        
              . '<div class="hh2 collapse" id="' . $modalId . '"> 
                  <div class="row text-center">' 
                   . '<span class="info" data-id="' . $component['AVERAGE_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="AVERAGE_ILLUMINATION"></span>'
                   . '<span class="info" data-id="' . $component['LOWEST_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWEST_ILLUMINATION"></span>'
                   . '<span class="info" data-id="' . $component['HIGHEST_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="HIGHEST_ILLUMINATION"></span>'
                 . '</div>'
             . '</div>'
             . '</div>';             
    }
}
