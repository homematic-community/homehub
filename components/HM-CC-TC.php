<?php
function HM_CC_TC($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        $modalId = mt_rand();
		global $export;
        $obj = $export;
        $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
        foreach($obj['channels'][$key]['datapoints'] as $datapoint)
        { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
		
		$key = array_search(substr($component['address'], 0, -1)."2", array_column($obj['channels'], 'address'));
        foreach($obj['channels'][$key]['datapoints'] as $datapoint)
        { $status_component2[$datapoint['type']] = $datapoint['ise_id']; }
        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $status_component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
					. '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
					. '<span class="info" data-id="' . $status_component2['SETPOINT'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_POINT_TEMPERATURE"></span>'					
                    . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_HUMIDITY"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">
                    <div class="row text-center">'
                        . '<div class="form-inline">'
                            . '<div class="input-group">'
                                . '<input type="number" name="' . $status_component2['SETPOINT'] . '" min="6.0" max="30.0" class="form-control" placeholder="Zahl eingeben">'
                                . '<span class="input-group-btn">'
                                    . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . $status_component2['SETPOINT'] . '" data-set-value="">OK</button>'
                                . '</span>'
                            . '</div>'
                        . '</div>'                    
                    . '</div>'
                . '</div>'
            . '</div>';
    }
}
