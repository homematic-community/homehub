<?php


/*

{
    "name":"HmIP-FCI6 OEQ0132606:2",
    "icon":"message_socket_on_off.png",
	"indicator": "0,true;1,false"
},

Status: 
-------

true = offen = 1
false = geschlossen = 0


Werte:
------- 
true -> grün
false -> grau
alarm -> rot
warn -> gelb


standard  default wenn kein indicator angegeben wurde
-> geschlossen grau, offen grün

"indicator": "0,false;1,true"
-> geschlossen grau, offen grün
  

"indicator": "0,alarm;1,true"
-> geschlossen Alarm, offen grün
*/

/*
    "component":"HmIP-FCI6",
         "parent_device_type":"HmIP-FCI6",
         "parent_device_interface":"HmIP-RF",
         "name":"KG Flur SK HTO",
         "type":"28",
         "address":"001F1F298D2896:1",
         "ise_id":"73496",
         "direction":"SENDER",
         "parent_device":"73472",
         "index":"1",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001F1F298D2896:1.PRESS_LONG",
               "type":"PRESS_LONG",
               "ise_id":"73497",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001F1F298D2896:1.PRESS_LONG_RELEASE",
               "type":"PRESS_LONG_RELEASE",
               "ise_id":"73498",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001F1F298D2896:1.PRESS_LONG_START",
               "type":"PRESS_LONG_START",
               "ise_id":"73499",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001F1F298D2896:1.PRESS_SHORT",
               "type":"PRESS_SHORT",
               "ise_id":"73500",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1703504612",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001F1F298D2896:1.STATE",
               "type":"STATE",
               "ise_id":"73501",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1703518147",
               "operations":"5"
            }
         ]
      },
*/
function HmIP_FCI6($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
		 global $export;

		$obj = $export;
$key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
foreach($obj['channels'][$key]['datapoints'] as $datapoint)

{ $component2[$datapoint['type']] = $datapoint['ise_id']; }
		
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component2['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
