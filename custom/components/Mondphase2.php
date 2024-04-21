<?php

/*

{
 "component": "Mondphase2",
 "name": "OK - Mond",
 "icon": "weather_moon_phases_7_half.png",
 "ise_id_mondphase":"55892",
"ise_id_mondstand":"55893",
 "ise_id_mondtag":"55894",
 "ise_id_naechstervollmond":"58182"
 
 }
 
},
 
 */
function Mondphase2($component) {
	   if (!isset($component['color'])) $component['color'] = '#595959';
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
        . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component["name"] . '</div>'
        . '<div class="pull-right">'
		. '<span class="info"><span class="info" data-id="' . $component["ise_id_mondphase"] . '" data-component="SysVar" data-datapoint="" data-unit=""></span>'
        . '<span class="info">Mondstand:<span class="info" data-id="' . $component["ise_id_mondstand"] . '" data-component="SysVar" data-datapoint="" data-unit=""></span>'
        . '<span class="info">Mondtag:<span class="info" data-id="' . $component["ise_id_mondtag"] . '" data-component="SysVar" data-datapoint=""></span>'
        . '<span class="info">Vollmond am:<span class="info" data-id="' . $component["ise_id_naechstervollmond"] . '" data-component="SysVar" data-datapoint="" data-unit=""></span>'
        . '</div>'
        . '<div class="clearfix"></div>'
    . '</div>';
}