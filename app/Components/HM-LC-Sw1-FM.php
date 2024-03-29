<?php
function HM_LC_Sw1_FM($component) {
<<<<<<< HEAD:components/HM-LC-Sw1-FM.php


    
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
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
		
=======
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
>>>>>>> parent of c7c5bad (Update zu Version 4.1):app/Components/HM-LC-Sw1-FM.php
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
<<<<<<< HEAD:components/HM-LC-Sw1-FM.php
			. $ShowTime
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-button="' . $component['button'] . '" data-set-value=""></span>'
=======
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
>>>>>>> parent of c7c5bad (Update zu Version 4.1):app/Components/HM-LC-Sw1-FM.php
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
