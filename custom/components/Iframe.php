<?php
/*
         {
            "component":"Iframe",
            "name":"Maps",
            "icon":"status_away_2.png",
            "url":"http://irgendwas.de"
         },



 Optional
 
 			"aufgeklappt":"1",
			"height":"50%"
			
			
			
			// aufgeklappt	= 0 zugeklappt 1 aufgeklappt - standard 1
			// height = höhe
			// link = link der aufgerufen wird wenn man auf den Namen des iframe klickt
*/





function Iframe($component) {
    $modalId = mt_rand();
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
	if(isset($component['height'])) { $Maxheight= $component['height']; } 
	else { $Maxheight = "630px"; }
	
    if (!isset($component['color'])) $component['color'] = '#595959';  
	if(isset($component['link'])) { $link = '<a href="'.$component['link'].'" target="_blank"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'].'</a>'; }
	else { $link = '<img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'];}
	
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
               . '<div data-toggle="collapse" data-target="#' . $modalId . '" style="display:flow-root;" class="collapsed">'
            . $link
        . '</div>'
        . '<div class="hh2 '.$aufgeklappt.'" id="' . $modalId . '">'
            . '<iframe src="' . $component['url'] . '" width="100%" height="'.$Maxheight.'"></iframe>'
        . '</div>'
    . '</div>';
}
