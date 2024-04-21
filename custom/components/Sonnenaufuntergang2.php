<?php

/*

{
 "component": "Sonnenaufuntergang",
 "name": "OK - Sonne A/U",
 "icon": "weather_sunrise.png",
 "ise_id_sonnenaufgang":"55907",
 "ise_id_sonnenuntergang":"55908"
},
 
*/
function Sonnenaufuntergang2($component) {
	   if (!isset($component['color'])) $component['color'] = '#595959';
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
        . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component["name"] . '</div>'
        . '<div class="pull-right">'
        . '<span class="info">Sonnenaufgang:<span class="info" data-id="' . $component["ise_id_sonnenaufgang"] . '" data-component="SysVar" data-datapoint="" data-unit=""></span></span>'
        . '<span class="info">Sonnenuntergang:<span class="info" data-id="' . $component["ise_id_sonnenuntergang"] . '" data-component="SysVar" data-datapoint="" data-unit=""></span></span>'
        . '</div>'
        . '<div class="clearfix"></div>'
    . '</div>';
}