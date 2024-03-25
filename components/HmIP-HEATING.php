<?php
/*

  {
         "component":"HmIP-HEATING",
         "parent_device_type":"HmIP-HEATING",
         "parent_device_interface":"VirtualDevices",
         "name":"Heizung Bad 1",
         "type":"17",
         "address":"INT0000029:1",
         "ise_id":"53418",
         "direction":"UNKNOWN",
         "parent_device":"53387",
         "index":"1",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"DEFAULT",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"VirtualDevices.INT0000029:1.ACTIVE_PROFILE",
               "type":"ACTIVE_PROFILE",
               "ise_id":"53419",
               "state":"1",
               "value":"1",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.ACTUAL_TEMPERATURE",
               "type":"ACTUAL_TEMPERATURE",
               "ise_id":"53420",
               "state":"22.500000",
               "value":"22.500000",
               "valuetype":"4",
               "valueunit":"\u00b0C",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.ACTUAL_TEMPERATURE_STATUS",
               "type":"ACTUAL_TEMPERATURE_STATUS",
               "ise_id":"53421",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.BOOST_MODE",
               "type":"BOOST_MODE",
               "ise_id":"53422",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1685037741",
               "operations":"6"
            },
            {
               "name":"VirtualDevices.INT0000029:1.BOOST_TIME",
               "type":"BOOST_TIME",
               "ise_id":"53423",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.CONTROL_DIFFERENTIAL_TEMPERATURE",
               "type":"CONTROL_DIFFERENTIAL_TEMPERATURE",
               "ise_id":"53424",
               "state":"0.000000",
               "value":"",
               "valuetype":"4",
               "valueunit":"\u00b0C",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"VirtualDevices.INT0000029:1.CONTROL_MODE",
               "type":"CONTROL_MODE",
               "ise_id":"53425",
               "state":"0",
               "value":"",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"VirtualDevices.INT0000029:1.DURATION_UNIT",
               "type":"DURATION_UNIT",
               "ise_id":"53426",
               "state":"0",
               "value":"",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"VirtualDevices.INT0000029:1.DURATION_VALUE",
               "type":"DURATION_VALUE",
               "ise_id":"53427",
               "state":"0",
               "value":"",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"VirtualDevices.INT0000029:1.FROST_PROTECTION",
               "type":"FROST_PROTECTION",
               "ise_id":"53428",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.HEATING_COOLING",
               "type":"HEATING_COOLING",
               "ise_id":"53429",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.HUMIDITY",
               "type":"HUMIDITY",
               "ise_id":"53430",
               "state":"64",
               "value":"64",
               "valuetype":"16",
               "valueunit":"% rF",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.HUMIDITY_STATUS",
               "type":"HUMIDITY_STATUS",
               "ise_id":"53431",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.LEVEL",
               "type":"LEVEL",
               "ise_id":"53432",
               "state":"0.000000",
               "value":"0.000000",
               "valuetype":"4",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.LEVEL_STATUS",
               "type":"LEVEL_STATUS",
               "ise_id":"53433",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.PARTY_MODE",
               "type":"PARTY_MODE",
               "ise_id":"53434",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.PARTY_SET_POINT_TEMPERATURE",
               "type":"PARTY_SET_POINT_TEMPERATURE",
               "ise_id":"53435",
               "state":"4.500000",
               "value":"4.500000",
               "valuetype":"4",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.PARTY_TIME_END",
               "type":"PARTY_TIME_END",
               "ise_id":"53436",
               "state":"2000_01_01 00:00",
               "value":"2000_01_01 00:00",
               "valuetype":"20",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.PARTY_TIME_START",
               "type":"PARTY_TIME_START",
               "ise_id":"53437",
               "state":"2000_01_01 00:00",
               "value":"2000_01_01 00:00",
               "valuetype":"20",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.QUICK_VETO_TIME",
               "type":"QUICK_VETO_TIME",
               "ise_id":"53438",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.SET_POINT_MODE",
               "type":"SET_POINT_MODE",
               "ise_id":"53439",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.SET_POINT_TEMPERATURE",
               "type":"SET_POINT_TEMPERATURE",
               "ise_id":"53440",
               "state":"23.000000",
               "value":"23.000000",
               "valuetype":"4",
               "valueunit":"\u00b0C",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.SWITCH_POINT_OCCURED",
               "type":"SWITCH_POINT_OCCURED",
               "ise_id":"53441",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.VALVE_ADAPTION",
               "type":"VALVE_ADAPTION",
               "ise_id":"53442",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            },
            {
               "name":"VirtualDevices.INT0000029:1.VALVE_STATE",
               "type":"VALVE_STATE",
               "ise_id":"53443",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"5"
            },
            {
               "name":"VirtualDevices.INT0000029:1.WINDOW_STATE",
               "type":"WINDOW_STATE",
               "ise_id":"53444",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1685037832",
               "operations":"7"
            }
         ]
      },
*/



function HmIP_HEATING($component) {
    if ($component['parent_device_interface'] == 'VirtualDevices' && $component['visible'] == 'true' && isset($component['group_partner']) && isset($component['ACTUAL_TEMPERATURE'])) {
		
		 global $export;
		// print_r($component);
    $obj = $export;
	//echo substr($component['name'], 0, -1)."2";
    //$key = array_search(substr($component['name'], 0, -1)."2", array_column($obj['channels'], 'name'));
	$key = array_search(substr($component['address'], 0, -1)."2", array_column($obj['channels'], 'address'));
	//echo "#".$key;
	/*
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
	
    { 
	//echo "<br>".$datapoint['ise_id'];
	$State_component[$datapoint['type']] = $datapoint['ise_id']; 
	}
	*/
	
    if(!isset($component['button'])) {
        $component['button'] = 'switch';
    }
	
        $modalId = mt_rand();
        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
       $Ausgabe = '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                .'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['WINDOW_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_POINT_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_POINT_MODE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">
                <div class="row text-center">'
                    . '<div class="form-inline">'
                        . '<div class="input-group">'
                            . '<input type="number" name="' . $component['SET_POINT_TEMPERATURE'] . '" min="4.5" max="30.5" class="form-control" placeholder="Zahl eingeben">'
                            . '<span class="input-group-btn">'
                                . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . $component['SET_POINT_TEMPERATURE'] . '" data-set-value="">OK</button>'
                            . '</span>'
                        . '</div>'
                        . '<div class="btn-group">';
						
                        if(isset($component['COMFORT_MODE']))
						{
							$Ausgabe = $Ausgabe. '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMFORT_MODE'] . '" data-set-value="1">'
                                . 'Komfort'
                            . '</button>';
						}
						if(isset($component['LOWERING_MODE']))
						{
                            $Ausgabe = $Ausgabe. '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LOWERING_MODE'] . '" data-set-value="1">'
                                . 'Absenkung'
                            . '</button>';
						}
                        $Ausgabe = $Ausgabe.'</div>'
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
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['BOOST_MODE'] . '" data-set-value="1">'
                            . 'Boost'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
			return $Ausgabe;
    }

}


