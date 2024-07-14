<?php

/*
         {
            "name":"2024_heizung_Badewanne",
            "icon":"secur_burglary.png",
            "showtime":"true",
			"showstate":"true"

         }
		 
		 
		 showtime zeigt zeit der letzten änderung
		 showstate zeigt ob das programm aktiv oder inaktiv ist
		 ob dies über das icon geändert werden kann wird über bedienbar bei den programmen in der ccu konfiguriert, bei änderungen import nicht vergessen.


*/

function Program($component) {
    if ($component['visible'] == 'true' && isset($component['ise_id'])) {


		//$component['showtime'] = "true";
		//$component['showstate'] = "true";
		
		// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }		


		// Operate

	//	return $component['operate'];
		if($component['operate'] == "true") { $operate = "runmode"; }
		else { $operate = ""; }


		// ShowState - Zeige Status an
		if(isset($component['showstate']))
		{
			if($component['showstate'] == "true") { $ShowState = '<span class="'.$operate.' info " data-id="' . $component['ise_id']  . 'a" data-run-id="' . $component['ise_id'] . '" data-component="showstate" data-datapoint="showstate"></span>'		; }
			else { $ShowState = ''; }
		}
		else { $ShowState = ''; }
		
		

		
        if (!isset($component['color'])) $component['color'] = '#595959';
		if(isset($component['label'])) { $label = $component['label']; }
		else { $label = "Start"; }
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
			    .$ShowTime 
				.$ShowState
                . '<span class="run btn-action" data-id="' . $component['ise_id'] . '" data-run-id="' . $component['ise_id'] . '">'.$label.'</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
