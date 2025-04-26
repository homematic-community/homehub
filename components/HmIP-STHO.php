<?php


// Parameter (config/custom.json)
 //
// Einstellungen
// Parameter config/custom.json 
//
// ccujack_value (optional): Wert der genutzt werden soll im folgenden Beispiel "VOLTAGE" -> "ccujack_value":"VOLTAGE"
//
// Hier anbei ein Beispiel des Wertes aus der Export. -> VOLTAGE - value ist der gewünschte Wert - also VOLTAGE
/*

 {
         "component":"HM-LC-Sw1-FM",
         "parent_device_type":"HM-LC-Sw1-FM",
         "parent_device_interface":"CCU-Jack",
         "name":"Bad-Miefquirl-Temperatur",
         "type":"28",
         "address":"JACK000043:2",
         "ise_id":"37308",
         "direction":"",
         "parent_device":"37294",
         "index":"2",
         "group_partner":"",
         "aes_available":"",
         "transmission_mode":"",
         "visible":"true",
         "ready_config":"",
         "operate":"true",
         "datapoints":[
            {
               "name":"CCU-Jack.JACK000043:2.VOLTAGE",
               "type":"VOLTAGE",
               "ise_id":"37310",
               "state":"56.600000",
               "value":"56.600000",
               "valuetype":"4",
               "valueunit":"",
               "timestamp":"1744013287",
               "operations":"7"
            },
            {
               "name":"CCU-Jack.JACK000043:2.VOLTAGE_STATUS",
               "type":"VOLTAGE_STATUS",
               "ise_id":"37311",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1744013287",
               "operations":"7"
            }
         ]
      },


*/
// Bei folgenden 2 Einstellungen wird die Ausgabe gesteuert - Wenn der Wert VOLTAGE aus dem Beispiel als Temperatur angezeigt werden soll, einen Aktor eintragen der Temperatur kann.
// bei der Suche hilft die "js/script.js.php" !!!!
//
// ccujack_component(optional): Die Komponente - HmIP-STHO -> "ccujack_component":"HmIP-STHO"
// ccujack_datapoint(optional): Der Datenpunkt der obigen Komponente - ACTUAL_TEMPERATURE -> "ccujack_datapoint":"ACTUAL_TEMPERATURE"


function HmIP_STHO($component) {
    

    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['ACTUAL_TEMPERATURE'])) {    
		global $export;
		$obj = $export;
		$key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
		foreach($obj['channels'][$key]['datapoints'] as $datapoint)
		{ $status_component[$datapoint['type']] = $datapoint['ise_id']; }	
        if (!isset($component['color'])) $component['color'] = '#00CC33';
		
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                 . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                 . '<div class="pull-right" style="white-space: nowrap;">'
                   . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                   . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                   . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                 . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';          
    }
	
	if ($component['parent_device_interface'] == 'CCU-Jack' && $component['visible'] == 'true' && isset($component['ACTUAL_TEMPERATURE'])) {    
		global $export;
		$obj = $export;
		$key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
		foreach($obj['channels'][$key]['datapoints'] as $datapoint)
		{ $status_component[$datapoint['type']] = $datapoint['ise_id']; }	
		
		
		if (!isset($component['color'])) $component['color'] = '#00CC33';
		
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                 . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                 . '<div class="pull-right" style="white-space: nowrap;">'
                   . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                   . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                 . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';          
    }
	
	if ($component['parent_device_interface'] == 'CCU-Jack' && $component['visible'] == 'true' && !isset($component['ACTUAL_TEMPERATURE'])) {  

		// Setze KEIN !!!! Button wenn Parameter nicht gesetzt ist
		if(!isset($component['button'])) $component['button'] = '';

		// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }
				


		

		
		if(!isset($component['ccujack_value'])) {
			// Nimm den ersten Wert der GROSS geschrieben wird
			foreach (array_keys($component) as $test_case) {
				if (ctype_upper($test_case)) {
					$component['ccujack_value'] = $test_case;
					break;
				}
			}	
		}
		if(!isset($component['ccujack_component'])) { $component['ccujack_component'] = "HM-LC-Sw1-FM"; }
		if(!isset($component['ccujack_datapoint'])) { $component['ccujack_datapoint'] = "Text"; }
		

		
		// Setze Standard-Farbe wenn keine gesetzt ist
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
		
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
			. $ShowTime
                . '<span class="info set" data-id="' . $component[$component['ccujack_value']] . '" data-component="' . $component['ccujack_component'] . '" data-datapoint="'.$component['ccujack_datapoint'].'" data-set-id="' . $component['ccujack_value'] . '" data-button="' . $component['button'] . '"  data-set-value="" data-state-icons=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }				
}
