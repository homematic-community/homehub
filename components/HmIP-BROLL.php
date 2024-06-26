<?php

// Validated by Gerti

function HmIP_BROLL($component) {

    global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."3", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $state_component[$datapoint['type']] = $datapoint['ise_id']; }
 
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STOP'])) {
        $modalId = mt_rand();
        if (!isset($component['color'])) $component['color'] = '#0033FF';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '</div>'    
            . '<div class="pull-right">' 
                . '<span class="info" style="font-size: 11px;" data-id="' . $state_component['LEVEL']. '_value" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>&nbsp;&nbsp;&nbsp;'
                . '<button type="button" class="btn btn-noicon set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                    . '<img src="icon/control_centr_arrow_up.png" />'
                . '</button>'
                . '<button type="button" class="btn btn-noicon set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                . '<img src="icon/control_centr_arrow_down.png" />'                
                . '</button>'
                . '<button type="button" class="btn btn-noicon set" data-set-id="' . $component['STOP'] . '" data-set-value="1">'  
                    . '<span class="info noicon" data-id="' . $state_component['LEVEL']. '" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>'
                . '</button>' 
            . '</div>'
            . '<div class="clearfix"></div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="icon/fts_window_2w.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.8">'
                            . '<img src="icon/fts_shutter_20.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.6">'
                            . '<img src="icon/fts_shutter_40.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.4">'
                            . '<img src="icon/fts_shutter_60.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.2">'
                            . '<img src="icon/fts_shutter_80.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                            . '<img src="icon/fts_shutter_100.png" />'
                        . '</button>'
                    . '</div>'                  
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="icon/control_centr_arrow_up.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['STOP'] . '" data-set-value="1">'
                            . '<img src="icon/message_stop.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                            . '<img src="icon/control_centr_arrow_down.png" />'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
