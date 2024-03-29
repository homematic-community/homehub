<?php

//Program|CCU Reboot||ID=4592|ACTIVE=true|TIMESTAMP=1442258266|DESCRIPTION=Wird nur beim Neustart der CCU ausgeführt|VISIBLE=false|OPERATE=false|

// Validated by Braindead

function Program($component) {
    if ($component['visible'] == 'true' && isset($component['ise_id'])) {
		
		// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }		
		
        if (!isset($component['color'])) $component['color'] = '#595959';
		if(isset($component['label'])) { $label = $component['label']; }
		else { $label = "Start"; }
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
			    .$ShowTime 
                . '<span class="run btn-action" data-id="' . $component['ise_id'] . '" data-run-id="' . $component['ise_id'] . '">'.$label.'</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
