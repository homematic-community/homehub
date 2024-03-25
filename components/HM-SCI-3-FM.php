<?php

// custom.json


/*

{
    "name":"HM-SCI-3-FM OEQ0132606:2",
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


function HM_SCI_3_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
		  // Indikator anzeigen?
                if(!isset($component['indicator'])) {
                    $component['indicator'] = '-1';
                }
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value="" data-indicator="' . $component['indicator'] . '"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
