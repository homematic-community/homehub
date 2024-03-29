<?php

// Component Location kann wie folgt ermittelt werden.
// meteoblue.com aufrufen und eigenen Ort wählen.
// In der Adressleiste des Browsers erscheint der Ort
// https://www.meteoblue.com/de/wetter/woche/h%c3%bcrth_deutschland_2897216
// Den hinteren Abschnitt (also z.B. h%c3%bcrth_deutschland_2897216) als location on der custom.json hinterlegen.
//
// Abschnitt in der custom.json:
//
//  {
//    "component": "Meteoblue",
//    "name": "Wettervorhersage",
//    "icon": "weather_wind.png",
//    "color": "#595959",
//    "location": "h%c3%bcrth_deutschland_2897216"
//  }
//
//  Optional Höhenangabe in % oder px
//
//    "height":"50%"


function Meteoblue($component) {
	$modalId = mt_rand();
    if (!isset($component['color'])) $component['color'] = '#595959';  
	if(isset($component['height'])) { $Maxheight= $component['height']; } 
	else { $Maxheight = "630px"; }	
    return '<fieldset><legend>'.$component['name'].'</legend>'
    . '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'    
        . '<div class="hh2" id="' . $modalId . '">'
            . '<iframe src="https://www.meteoblue.com/de/wetter/widget/three/' . $component['location'] . '?geoloc=fixed&nocurrent=0&noforecast=0&days=7&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=dark" width="100%" height="'.$Maxheight.'" frameborder="0" border="0"></iframe>'
        . '</div>'
    . '</div></fieldset>';
}
