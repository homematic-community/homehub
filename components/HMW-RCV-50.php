<?php
/*
mit folgendem können die Schaltflächen beschriftet werden

"label":"Text kurz,Text lang"

ist der Text leer wird die Schaltfläche nicht angezeigt. (hier kurz)

"label":",Text lang"

*/
function HMW_RCV_50($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
		
				// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>&nbsp;&nbsp;'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }
						if(isset($component['label']))
		{
			$Label = explode(",",$component['label']);
			if($Label[0] <> "") { $LabelKurz = '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">'.$Label[0].'</span>'; }
			else { $LabelKurz = ''; }
			if($Label[1] <> "") { $LabelLang = '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">'.$Label[1].'</span>'; }
			else { $LabelLang = ''; }
		}
		else
		{
			$LabelKurz = '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>';
			$LabelLang = '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>';
		}
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
			. $ShowTime
         . $LabelKurz
                . $LabelLang
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
