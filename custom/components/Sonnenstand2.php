<?php
/*
{
 "component": "Sonnenstand",
 "name": "OK - Sonne",
 "icon": "weather_sun.png",
 "ise_id_azimut":"55945",
  "ise_id_elevation":"55946"
},
*/

function Sonnenstand2($component) {
	   if (!isset($component['color'])) $component['color'] = '#595959';
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
        . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component["name"] . '</div>'
        . '<div class="pull-right">'
        . '<span class="info">Sonne Azimut:<span class="info" data-id="' . $component["ise_id_azimut"] . '" data-component="SysVar" data-datapoint="4" data-unit="°"></span></span>'
        . '<span class="info">Sonne Elevation:<span class="info" data-id="' . $component["ise_id_elevation"] . '" data-component="SysVar" data-datapoint="4" data-unit="°"></span></span>'
        . '</div>'
        . '<div class="clearfix"></div>'
    . '</div>';
}