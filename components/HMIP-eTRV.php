<?php
function HMIP_eTRV($component) {

     global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['CONTROL_MODE'])) {
        $modalId = mt_rand();        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_POINT_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_POINT_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>'
                    . '<span class="info" data-id="' . $component['WINDOW_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="WINDOW_STATE"></span>'
                    . '<span class="info set btn-icon" data-id="' . $component['SET_POINT_MODE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_POINT_MODE" data-set-id="" data-set-value=""></span>'
                    . '<span class="info set btn-icon" data-id="' . $component['ACTIVE_PROFILE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTIVE_PROFILE" data-set-id="" data-set-value=""></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center"  style="padding-bottom:15px;">'
					.' <div class="form-inline">'
						.'<span class="info" data-id="' . $component['PARTY_TIME_START'] . '" data-component="' . $component['component'] . '" id="' . $component['PARTY_TIME_START'] . '" data-datapoint="PARTY_TIME_START" style="display:none;"></span>'
						.'<span class="info" data-id="' . $component['PARTY_TIME_END'] . '" data-component="' . $component['component'] . '" id="' . $component['PARTY_TIME_END'] . '" data-datapoint="PARTY_TIME_END" style="display:none;"></span>'
					. '</div>'
					. '</div>'
                . '<div class="row text-center">'		
                    . '<div class="form-inline">'				
					.'Temperatur: '
                        . '<div class="input-group">'
                            . '<input type="number" name="' . $component['SET_POINT_TEMPERATURE'] . '" min="4.5" max="30.5" step="0.5" class="form-control" placeholder="Zahl eingeben">'
                            . '<span class="input-group-btn">'
                                . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . $component['SET_POINT_TEMPERATURE'] . '" data-set-value="">OK</button>'
                            . '</span>'
                        . '</div>'               
                        . '&nbsp;&nbsp;&nbsp;Profil: ' 
                        . '<div class="btn-group">'
                          . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ACTIVE_PROFILE'] . '" data-set-value="1">'
                              . '1'
                          . '</button>'
                          . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ACTIVE_PROFILE'] . '" data-set-value="2">'
                              . '2'
                          . '</button>'
                          . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ACTIVE_PROFILE'] . '" data-set-value="3">'
                              . '3'
                          . '</button>'
                      . '</div>'                    
                    . '</div>'                    
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['CONTROL_MODE'] . '" data-set-value="0">'
                            . 'Auto'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['CONTROL_MODE'] . '" data-set-value="1">'
                            . 'Manu'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
