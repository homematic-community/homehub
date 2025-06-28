<?php

// Parameter (config/custom.json)
//
// Einstellungen
// onerow (optional): wenn leer nutze für alles eine eigene Zeile, ansonsten alles in einer Reihe ("onerow":"true")
// label-a (optional): Wenn etwas vor den ersten Wert geschrieben werden soll
// label-b (optional): Wenn etwas vor den zweiten Wert geschrieben werden soll

/*
{
	"name": "Poolwasser Temperatursensor oben",
	"icon": "water_temperature.png",
	"display_name": "tttt",
	"color": "#0033FF",
	"onerow":"true",
	"label-a":"pool oben",
	"label-b":"pool unten"
	},	

*/

function HM_WDS30_OT2_SM($component) {

    if ($component['parent_device_interface'] == 'BidCos-RF' && isset($component['onerow'])) {

	global $export;
    $obj = $export;
	
    $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
	foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_componentA[$datapoint['type']] = $datapoint['ise_id']; }		
    $key = array_search(substr($component['address'], 0, -1)."1", array_column($obj['channels'], 'address'));
	foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_componentB[$datapoint['type']] = $datapoint['ise_id']; }		
    $key = array_search(substr($component['address'], 0, -1)."2", array_column($obj['channels'], 'address'));
	foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_componentC[$datapoint['type']] = $datapoint['ise_id']; }
    $key = array_search(substr($component['address'], 0, -1)."3", array_column($obj['channels'], 'address'));
	foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_componentD[$datapoint['type']] = $datapoint['ise_id']; }
    $key = array_search(substr($component['address'], 0, -1)."4", array_column($obj['channels'], 'address'));
	foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_componentE[$datapoint['type']] = $datapoint['ise_id']; }	
	
	if(isset($component['label-a'])) { $labela = $component['label-a']; }
	else { $labela = ""; }
	if(isset($component['label-b'])) { $labelb = $component['label-b']; }
	else { $labelb = ""; }	
		
    if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $status_componentA['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
				.$labela
                . '<span class="info" data-id="' . $status_componentB['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
				.$labelb
                . '<span class="info" data-id="' . $status_componentC['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'				
				. '<span class="info" data-id="' . $status_componentD['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'	
				. '<span class="info" data-id="' . $status_componentE['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'	
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
	
	if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }	
}
