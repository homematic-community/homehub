<?php

function HmIP_SMO230($component) {

    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
		
		
		 if (!isset($component['operate'])) $component['operate'] = 'true';
		 if ($component['operate'] == 'true') $content = $content.' set';
		 
		 
		// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }
		
      if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
				.$ShowTime
                . '<span class="right info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                . '<span class="right info" data-id="' . $component['CURRENT_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT_ILLUMINATION"></span>'
                . '<span class="right info '.$content.'" data-id="' . $component['MOTION_DETECTION_ACTIVE'] . '" data-component="' . $component['component'] . '" data-set-id="' . $component['MOTION_DETECTION_ACTIVE'] . '" data-button="' . $component['button'] . '" data-set-value="" data-datapoint="MOTION_DETECTION_ACTIVE"></span>'
                . '<span class="right info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
