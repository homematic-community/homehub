<?php
// Parameter
// name 		= angezeigter Name
// url 			= die URL zum Bild
// icon			= Icon
// autorefresh 	= 1 aktualisiert selbstständig, ansonsten statisch
// aufgeklappt	= 0 zugeklappt 1 aufgeklappt - standard 1

function Webcam($component) {
    $modalId = mt_rand();
	if (!isset($component['color'])) $component['color'] = '#595959';
	if(isset($component["autorefresh"])) {
		if($component["autorefresh"] == "1") {
			$AutoRefresh = 'timeoutHandle_'.$modalId.' = window.setTimeout(webcam_'.$modalId.', 3000);';
		}
		else
		{
			$AutoRefresh = "";
		}
	}
	else
	{
		$AutoRefresh = "";
	}
	
	
	if(isset($component["aufgeklappt"])) {
		if($component["aufgeklappt"] == "1") {
			$aufgeklappt = "collapsed";
		}
		else {
			$aufgeklappt = "collapse";
		}
	}
	else
	{
		$aufgeklappt = "collapse";
	}
	
	// Bild ohne ? in der URL Damit URL nicht verändert wird

if(isset($component["file"])) { $url = $component["file"]; }
if(isset($component["url"])) { $url = $component["url"]; }

	if (strpos($url, "?") !== false)
	{
// nix
	}
 else
 {	 
		$url = $url."?";
	}

    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
	
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<img src="icon/' . $component["icon"] . '" class="icon">'.$component["name"]
        . '</div>'
        . '<div class="hh2 '.$aufgeklappt.'" id="' . $modalId . '">'
            . '<img id="stream_'.$modalId.'" src="'.$url.'" style="width: 100%;">'
            . '<div class="row text-center top15">'
                . '<div class="btn-group">'
                    . '<button type="button" class="btn btn-primary" onclick="webcam_'.$modalId.'();">'
                        . 'AutoRefresh'
                    . '</button>'
                    . '<button type="button" class="btn btn-primary" onclick="clearTimeout(timeoutHandle_'.$modalId.');">'
                        . 'AutoRefresh stop'						
                    . '</button>'

                . '</div>'
            . '</div>'
        . '</div>'
    . '</div>'
	
	. '<script type="text/javascript">'
	. 'function webcam_'.$modalId.'() {'
	. 'var now = new Date();'
	. 'var dummystring = parseInt(now.getTime() / 1000);'
	. 'stream_'.$modalId.'.src = "'.$url.'&" + dummystring;'
	. 'timeoutHandle_'.$modalId.' = window.setTimeout(webcam_'.$modalId.', 3000);'
	. '}'
	.$AutoRefresh
	. '</script>';
	
}
