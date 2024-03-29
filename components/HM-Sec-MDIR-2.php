<?php
function HM_Sec_MDIR_2($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
		
		
	// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }	

		
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
					. $ShowTime
                . '<span class="info" data-id="' . ($component['BRIGHTNESS']-19) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
				. '<span class="info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
                . '<span class="info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'

            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
