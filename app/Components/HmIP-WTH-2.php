<?php

// HmIP-WTH-2|Thermostat Gästetoilette:0||CONFIG_PENDING=62855|DUTY_CYCLE=62859|LOW_BAT=62860|OPERATING_VOLTAGE=62864|RSSI_DEVICE=62865|RSSI_PEER=62866|UNREACH=62867|UPDATE_PENDING=62871|
// HmIP-WTH-2|Thermostat Gästetoilette:1||ACTIVE_PROFILE=62876|ACTUAL_TEMPERATURE=62877|BOOST_MODE=62878|CONTROL_DIFFERENTIAL_TEMP=62879|CONTROL_MODE=62880|DURATION_UNIT=62881|DURATION_VALUE=62882|FROST_PROTECTION=62883|HEATING_COOLING=62884|HUMIDITY=62885|PARTY_MODE=62886|PARTY_SET_POINT_TEMPERATU=62887|PARTY_TIME_END=62888|PARTY_TIME_START=62889|SET_POINT_MODE=62890|SET_POINT_TEMPERATURE=62891|SWITCH_POINT_OCCURED=62892|WINDOW_STATE=62893|

   
function HmIP_WTH_2($component) {

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
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_POINT_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_POINT_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                    . '<span class="info" data-id="' . $component['WINDOW_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="WINDOW_STATE"></span>'
                    . '<span class="info set btn-icon" data-id="' . $component['SET_POINT_MODE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_POINT_MODE" data-set-id="" data-set-value""></span>'
                    . '<span class="info set btn-icon" data-id="' . $component['ACTIVE_PROFILE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTIVE_PROFILE" data-set-id="" data-set-value""></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">
                <div class="row text-center">'
                    . '<div class="form-inline">Temperatur: '
                        . '<div class="input-group">'
                            . '<input type="number" name="' . $component['SET_POINT_TEMPERATURE'] . '" min="4.5" max="30.5" class="form-control" placeholder="Zahl eingeben">'
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
                          . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ACTIVE_PROFILE'] . '" data-set-value="4">'
                              . '4'
                          . '</button>'
                          . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ACTIVE_PROFILE'] . '" data-set-value="5">'
                              . '5'
                          . '</button>'
                          . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ACTIVE_PROFILE'] . '" data-set-value="6">'
                              . '6'
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
