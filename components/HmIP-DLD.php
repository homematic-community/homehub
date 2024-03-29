<?php
function HmIP_DLD($component) { 


     
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['LOCK_STATE'])) {
        $modalId = mt_rand();
		
		global $export;
		$obj = $export;
		$key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
		foreach($obj['channels'][$key]['datapoints'] as $datapoint)
		{ $status_component[$datapoint['type']] = $datapoint['ise_id']; }		

		// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }
		
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
              . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                  .'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
              . '</div>'
              . '<div class="pull-right">'
			  .$ShowTime
                  . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                  . '<span class="info set" data-id="' . $component['LOCK_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="LOCK_STATE" data-set-id="' . $component['LOCK_TARGET_LEVEL'] . '" data-set-value=""></span>'
              . '</div>'
              . '<div class="clearfix"></div>'
              . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<div class="btn-group">'
                    . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LOCK_TARGET_LEVEL'] . '" data-set-value="2">&Ouml;ffnen'
                    . '</button>'
                    . '</div>'
                . '</div>' 
            . '</div>'
            . '</div>';
    }
}
