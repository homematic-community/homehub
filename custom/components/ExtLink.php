<?php
/*
Beispiel
		 {
			"component":"ExtLink",
			"name":"Externer Link zu Google",
			"icon":"measure_globe.png",
			"url":"http://google.de",
			"text":"Mit klick wird google ge&ouml;ffnet",
			"new_window":"true"
		 },


// name; gibt den Beschreibenden Namen vorne an
// icon: gibt den Dateinamen des Icons an
// url: Gibt die aufzurufende URL an
// text (optional): Zeifenfolge - Beschriftet den Button mit dem angegebenen text. Standard &Ouml;ffnen
// new_window (optional): true - Öffnet die URL in einem neuen Fenster. Standard false
*/

function ExtLink($component) {
    if (!isset($component['color'])) $component['color'] = '#FFCC00'; 
	
    if (!isset($component['text'])) 
	{
		$ButtonText = "&Ouml;ffnen";
	}
	else
	{
		$ButtonText = $component['text'];
	}
	
	if (isset($component['new_window']) && ($component['new_window'] == "true"))
	{
		$Button = '<span class="btn-action" onclick="window.open(\''.$component['url'] .'\');">'.$ButtonText.'</span>';
	}
	else
	{
		$Button = '<span class="btn-action" onclick="location.href=\'' . $component['url'] . '\'">'.$ButtonText.'</span>';
	}
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . $Button
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
}
