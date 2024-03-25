<?php
ini_set('display_errors', 'on');
function HM_OU_LED16($component) {
	


	
	
	/*
	
	default
	
			  "Statusanzeige":[
	    {
            "name":"ZZ LED 01 RoDG",
            "icon":"secur_burglary.png",
            "display_name":"TEST",
	
         }
		 
	anzeige wie das display mit allen (ZZ LED 01 RoDG muss eines der erst 9 Namen des Display sein !! ) Im Label werden die angezeigten Namen hinterlegt (lässt sich nicht auslesen).
	
		  "Statusanzeige":[
	    {
            "name":"ZZ LED 01 RoDG",
            "icon":"secur_burglary.png",
            "display_name":"TEST",
			"label":"ZZ LED 01 RoDG,ZZ LED 02 RoEG,ZZ LED 03 FeDG,ZZ LED 04 FeWC,ZZ LED 05 FeKü,ZZ LED 06 FeWZ,ZZ LED 07 FeGa,ZZ LED 08 TüGa,ZZ LED 09 AlSt,ZZ LED 10 Alrm,ZZ LED 11 KGLi,ZZ LED 12 AULi,ZZ LED 13 AUSt,ZZ LED 14 GaAl,ZZ LED 15 GaBw,ZZ LED 16 GaTo"
         }
	*/
	
	if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT']) && isset($component['label'] )) {
	
		global $export;
		$obj = $export;		  

	$label = explode ( ',', $component['label']);

		  
		   $key = array_search(substr($component['address'], 0, -1)."1", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component1[$datapoint['type']] = $datapoint['ise_id']; }
		
		   $key = array_search(substr($component['address'], 0, -1)."2", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component2[$datapoint['type']] = $datapoint['ise_id']; }
		   
		   $key = array_search(substr($component['address'], 0, -1)."3", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component3[$datapoint['type']] = $datapoint['ise_id']; }	
		   
		   $key = array_search(substr($component['address'], 0, -1)."4", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component4[$datapoint['type']] = $datapoint['ise_id']; }

		   $key = array_search(substr($component['address'], 0, -1)."5", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component5[$datapoint['type']] = $datapoint['ise_id']; }
		
		   $key = array_search(substr($component['address'], 0, -1)."6", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component6[$datapoint['type']] = $datapoint['ise_id']; }
		   
		   $key = array_search(substr($component['address'], 0, -1)."7", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component7[$datapoint['type']] = $datapoint['ise_id']; }	
		   
		   $key = array_search(substr($component['address'], 0, -1)."8", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component8[$datapoint['type']] = $datapoint['ise_id']; }
		   
		   $key = array_search(substr($component['address'], 0, -1)."9", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component9[$datapoint['type']] = $datapoint['ise_id']; }
		
		   $key = array_search(substr($component['address'], 0, -1)."10", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component10[$datapoint['type']] = $datapoint['ise_id']; }
		   
		   $key = array_search(substr($component['address'], 0, -1)."11", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component11[$datapoint['type']] = $datapoint['ise_id']; }	
		   
		   $key = array_search(substr($component['address'], 0, -1)."12", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component12[$datapoint['type']] = $datapoint['ise_id']; }

		   $key = array_search(substr($component['address'], 0, -1)."13", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component13[$datapoint['type']] = $datapoint['ise_id']; }
		
		   $key = array_search(substr($component['address'], 0, -1)."14", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component14[$datapoint['type']] = $datapoint['ise_id']; }
		   
		   $key = array_search(substr($component['address'], 0, -1)."15", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component15[$datapoint['type']] = $datapoint['ise_id']; }	
		   
		   $key = array_search(substr($component['address'], 0, -1)."16", array_column($obj['channels'], 'address'));
           foreach($obj['channels'][$key]['datapoints'] as $datapoint)
           { $status_component16[$datapoint['type']] = $datapoint['ise_id']; }

		   
            if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component1['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component1['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[0].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[8].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component9['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component9['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'
		
			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component2['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component2['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[1].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[9].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component10['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component10['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'
			
			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component3['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component3['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[2].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[10].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component11['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component11['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'

			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component4['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component4['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[3].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[11].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component12['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component12['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'

			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component5['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component5['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[4].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[12].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component13['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component13['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'

			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component6['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component6['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[5].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[13].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component14['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component14['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'
			
			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component7['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component7['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[6].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[14].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component15['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component15['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>'
			
			.'<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
			.'<table width="100%"><tr><td width="10%"><span class=" set info" data-id="' . $status_component8['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component8['PRESS_SHORT'] . '" data-set-value="1"></span></td>'
			.'<td width="40%">'.$label[7].'</td>'
			.'<td width="40%" style="text-align:right;">'.$label[15].'</td>'
			.'<td width="10%"><span class=" set info" data-id="' . $status_component16['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS" data-set-id="' . $status_component16['PRESS_SHORT'] . '" data-set-value="1"></span></td></tr></table>'
			. '<div class="clearfix"></div></div>';
			
           

		
		
		
		
    }
	    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class=" set info" data-id="' . $component['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-set-id="' . $component['PRESS_SHORT'] . '" data-datapoint="LED_STATUS" data-set-value="1"></span>'

            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}


