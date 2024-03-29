<?php
function HM_LC_Sw2PBU_FM($component) {

    if(!isset($component['button'])) {
        $component['button'] = 'switch';
    }
	
	// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }		
    
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
			. $ShowTime
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-button="' . $component['button'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
