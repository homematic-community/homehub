<?php

// Validated by Gerti

function HmIPW_DRI16($component) {

    global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
    
    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
      if (!isset($component['color'])) $component['color'] = '#595959';
<<<<<<< HEAD:components/HmIP-SWDM-B2.php
	  
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
	  
      if(!isset($component['state_icons'])) {
                    $component['state_icons'] = '';
      }
      
=======
>>>>>>> parent of c7c5bad (Update zu Version 4.1):app/Components/HmIPW-DRI16.php
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
<<<<<<< HEAD:components/HmIP-SWDM-B2.php
			.$ShowTime	
                . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-state-icons="' . $component['state_icons'] . '" data-datapoint="STATE"></span>'
=======
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
>>>>>>> parent of c7c5bad (Update zu Version 4.1):app/Components/HmIPW-DRI16.php
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
