<?php



/*
		
// Lampe/Steckdose ein-/ausschalten
		 {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",			
            "name":"Aussenlampe",
            "icon":"light_floor_lamp_2.png",
            "objekt":"yeelight-2.0.Dimmer.control.power",
			"modus":"toggle"
		 },
		 
		 
		 
		 // Helligkeit Dimmer
		 
		  {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",			
            "name":"Schrankbeleuchtung Dimmer",
            "icon":"light_floor_lamp_2.png",
            "objekt":"yeelight-2.0.Buero.control.active_bright",
			"modus":"dimmer"
		 },

		// Farbe einstellen

		  {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",
            "name":"Schrankbeleuchtung Farbe",
            "icon":"light_floor_lamp_2.png",
            "objekt":"yeelight-2.0.Buero.control.rgb",
			"modus":"color"
		 },
		 
		 
		 // Programm starten / Taster 

		  {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",			
            "name":"HomeServer Restart",
            "icon":"light_floor_lamp_2.png",
            "objekt":"linux-control.0.HomeServer.control.restart",
			"modus":"program"
		 },
		 
		 // Objekttext ausgeben
		  {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",			
            "name":"Schrankbeleuchtung Level Text",
            "icon":"light_floor_lamp_2.png",
            "objekt":"yeelight-2.0.Buero.control.active_bright",
			"modus":"text"
		 },		 
		 		 // Midas Mode
		  {
			"component":"ioBroker", 
			"api":"http://10.1.1.4:8087",			
            "name":"Poolwärmepumpenmodus",
            "icon":"sani_pool_heat_pump.png",
            "objekt":"0_userdata.0.Poolheizung.mode,0_userdata.0.Poolheizung.mode",
			"modus":"text,midasmode"
		 },		 
		 
		 // Werte können kombiniert werden
		  {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",			
            "name":"Schrankbeleuchtung",
            "icon":"light_floor_lamp_2.png",
            "objekt":"yeelight-2.0.Buero.control.active_bright,yeelight-2.0.Buero.control.rgb,yeelight-2.0.Buero.control.power",
			"modus":"dimmer,color,toggle"
		 },		 
		 
		 // Presets für Licht einstellungen Szenen
		         {
            "component":"ioBroker",
            "api":"http://192.168.178.13:8087",
            "name":"Aussenlampe",
            "icon":"light_floor_lamp_2.png",
			"objekt":"yeelight-2.0.Aussenlampe.control.active_bright,yeelight-2.0.Aussenlampe.control.rgb,yeelight-2.0.Aussenlampe.control.power,yeelight-2.0.Aussenlampe.control.power",
            "modus":"dimmer,color,toggle,presets",
            "unit":"100",
            "operate":",false,true",
			"presets_id":"0,3,6",
			"presets_text":"Solid,Wipe,Sweep",
            "showtime":"true"
         },
*/


$ioBrokerComponent = "1";


function ioBroker($component) 
{
	$modalId = mt_rand();
  if ((isset($component['objekt'])) AND (isset($component['api']))) 
  {
	  


	  
	$Server = explode(":",$component['api']);
	$Port = $Server[2];
	$Server = explode("//",$Server[1]);
	$Server = $Server[1];
	
	
	$VerbindingsTest =  @fsockopen($Server, $Port,$errno, $errstr, 1);

    if (!$VerbindingsTest) {
     return "";
	}
	$presets = "";
	$Ausgabe = "";
	$Ausgabe2 = "";
	$i = 0;
	$iseWerte = explode(",",$component['objekt']);
	
	 
	if(isset($component['modus']))
	{
	 $iseModus = explode(",",$component['modus']);
	}
	if(isset($component['value']))
	{
	 $iseValue = explode(",",$component['value']);
	}
	if(isset($component['unit']))
	{
	 $iseUnit = explode(",",$component['unit']);
	}	
	if(isset($component['operate']))
	{
	 $iseOperate = explode(",",$component['operate']);
	}	
	$iseAPI = $component['api'];	
	if(isset($component['label']))
	{
	 $iseLabel = explode(",",$component['label']);
	}	
	
	// Farbe vorne
    if (!isset($component['color'])) $component['color'] = '#FFCC00';
	foreach ($iseWerte as $iseWert) 
	{
		if(!isset($iseModus[$i])) { $iseModus[$i] = "text"; }
		if(!isset($iseValue[$i])) { $iseValue[$i] = ""; }
		if(!isset($iseUnit[$i])) { $iseUnit[$i] = ""; }
		if(!isset($iseAPI[$i])) { $iseAPI[$i] = ""; }
		if(!isset($iseOperate[$i])) { $iseOperate[$i] = ""; }
		if(!isset($iseLabel[$i]) OR $iseLabel[$i] == "") { $iseLabel[$i] = "Start"; }
		if($i != "0") $Ausgabe = $Ausgabe .  "&nbsp;&nbsp;|&nbsp;&nbsp;";
		
		// Wenn operate auf false dann mache komponente nicht schaltbar
        if ($iseOperate[$i] == 'false') { $operate  = ' '; }
		else { $operate  = ' setioBroker'; }

		   
		if($iseModus[$i] == "toggle")
		{
				 // ShowTime - Uhrzeit der letzten Änderung anzeigen
			if(isset($component['showtime']))
			{
				if($component['showtime'] == "true") { $ShowTime = '<span class="infoioBrokershowtime" id="' . $iseWert  . 't" data-component="iobrokershowtime" data-datapoint="showtime"></span>'; }
				else { $ShowTime = ''; }
			}
			else { $ShowTime = ''; }
		$Ausgabe = $Ausgabe . ' <span class="infoioBroker '.$operate.'" data-id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="' . $iseUnit[$i] . '" data-valuelist="'.$iseValue[$i].'" data-api="'.$iseAPI.'"></span>';
		}
		else if($iseModus[$i] == "color")
		{
		$Ausgabe = $Ausgabe .  ' <span class="infoioBroker '.$operate.'" data-id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="' . $iseUnit[$i] . '" data-valuelist="'.$iseValue[$i].'" data-api="'.$iseAPI.'"></span>';
		}
		else if($iseModus[$i] == "dimmer")
		{
		$Ausgabe = $Ausgabe .  ' <span class="infoioBroker '.$operate.'" data-id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="' . $iseUnit[$i] . '" data-valuelist="'.$iseValue[$i].'" data-api="'.$iseAPI.'"></span>';
		}
		else if($iseModus[$i] == "midasmode")
		{
			
					 // ShowTime - Uhrzeit der letzten Änderung anzeigen
			if(isset($component['showtime']))
			{
				if($component['showtime'] == "true") { $ShowTime = '<span class="infoioBrokershowtime" id="' . $iseWert  . 't" data-component="iobrokershowtime" data-datapoint="showtime"></span>'; }
				else { $ShowTime = ''; }
			}
			else { $ShowTime = ''; }
			
		$Ausgabe = $Ausgabe .  '<span class="btn-action  infoioBroker setioBroker" data-id="' . $iseWert . '" id="' . $iseWert . '_-1" data-component="ioBroker" data-datapoint="midasmode" data-unit="" data-valuelist="" data-api="'.$iseAPI.'" data-set-id="'.$iseWert.'" data-set-value="-1">Aus</span> '
		.'<span class="btn-action infoioBroker setioBroker" data-id="' . $iseWert . '" id="' . $iseWert . '_0" data-component="ioBroker" data-datapoint="midasmode" data-unit="" data-valuelist="" data-api="'.$iseAPI.'" data-set-id="'.$iseWert.'" data-set-value="0">Cool</span> '
		.'<span class="btn-action infoioBroker setioBroker"  data-id="' . $iseWert . '" id="' . $iseWert . '_1" data-component="ioBroker" data-datapoint="midasmode" data-unit="" data-valuelist="" data-api="'.$iseAPI.'" data-set-id="'.$iseWert.'" data-set-value="1">Heizen</span> '
		.'<span class="btn-action infoioBroker setioBroker"  data-id="' . $iseWert . '" id="' . $iseWert . '_2" data-component="ioBroker" data-datapoint="midasmode" data-unit="" data-valuelist="" data-api="'.$iseAPI.'" data-set-id="'.$iseWert.'" data-set-value="2">Auto</span> ';
		}
		else if ($iseModus[$i] == "program")
		{
			if(isset($component['showtime']))
			{
				if($component['showtime'] == "true") { $ShowTime = '<span class="infoioBrokershowtime" id="' . $iseWert  . 't" data-component="iobrokershowtime" data-datapoint="showtime"></span>'; }
				else { $ShowTime = ''; }
			}
			else { $ShowTime = ''; }
			$Ausgabe = $Ausgabe .  ' <span class="infoioBroker" data-id="' . $iseWert . '" data-api="'.$iseAPI.'" style="display:none;"></span><span class="runioBroker btn-action" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-run-id="' . $iseWert . '" data-api="'.$iseAPI.'">'.$iseLabel[$i].'</span>';
		}
		else if ($iseModus[$i] == "presets")
		{
			if(isset($component['showtime']))
			{
				if($component['showtime'] == "true") { $ShowTime = '<span class="infoioBrokershowtime" id="' . $iseWert  . 't" data-component="iobrokershowtime" data-datapoint="showtime"></span>'; }
				else { $ShowTime = ''; }
			}
			else { $ShowTime = ''; }
			if (!isset($component['presets_id']))
			{
				$component['presets_id']= "1,2,3,4,5,6,7,8,9,10";
				echo "###";
			}
			if (!isset($component['presets_text']))
			{
				$component['presets_text']= "Effekt 1";
			}
			$presets_ids = explode(",",$component['presets_id']);
			$presets_text = explode(",",$component['presets_text']);
			$y = "0";
			
			foreach ($presets_ids as $presets_id) 
			{
				//$presets = $presets .  '<span class="btn-action  setioBroker" data-id="' . $iseWert . '"  id="' . $iseWert . '_'.$y.'" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="" data-valuelist="" >'.$presets_text[$y].'</span> ';
				$presets = $presets .  '<span><button type="button" class="btn btn-primary setioBroker" data-datapoint="'. $iseModus[$i] .'" data-api="'.$iseAPI.'" data-set-id="'.$iseWert.'" data-set-value="'.$presets_id.'">'.$presets_text[$y].'</button>';
				//$presets = $presets .  '<span><button type="button" class="btn btn-primary setioBroker" data-id="' . $iseWert . '"  id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-api="'.$iseAPI.'" data-set-id="'.$iseWert.'" data-set-value="'.$presets_id.'">'.$presets_text[$y].'</button>';
				$y++;
			}
		}		
		else if($iseModus[$i] == "text")
		{
			if(isset($component['showtime']))
			{
				if($component['showtime'] == "true") { $ShowTime = '<span class="infoioBrokershowtime" id="' . $iseWert  . 't" data-component="iobrokershowtime" data-datapoint="showtime"></span>'; }
				else { $ShowTime = ''; }
			}
			else { $ShowTime = ''; }
			
			$Ausgabe = $Ausgabe .  ' <span class="infoioBroker '.$operate.'" data-id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="' . $iseUnit[$i] . '" data-valuelist="'.$iseValue[$i].'" data-api="'.$iseAPI.'"></span>';
			if($iseOperate[$i] != "false")
			{
			$Ausgabe2 = '<div class="hh2 collapse" id="'.$modalId.'" aria-expanded="true" style="">'
			.'<div class="row text-center">'
			.'<div class="form-inline">'
			.'<div class="input-group">'
			.'<input type="text" name="38488" class="form-control" placeholder="Text eingeben"  id="'.$iseWert.'submit">'
			.'<span class="input-group-btn"><button class="btn btn-primary '.$operate.'" data-datapoint="'. $iseModus[$i] .'" data-set-id="'.$iseWert.'"  data-api="'.$iseAPI.'">OK</button></span>'
			.'</div></div></div></div>';
			}

			
		}		
		else
		{
			if(isset($component['showtime']))
			{
				if($component['showtime'] == "true") { $ShowTime = '<span class="infoioBrokershowtime" id="' . $iseWert  . 't" data-component="iobrokershowtime" data-datapoint="showtime"></span>'; }
				else { $ShowTime = ''; }
			}
			else { $ShowTime = ''; }
			$Ausgabe = $Ausgabe .  ' <span class="infoioBroker '.$operate.'" data-id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="' . $iseUnit[$i] . '" data-valuelist="'.$iseValue[$i].'" data-api="'.$iseAPI.'"></span>';
		}
		$i++;
	}
	
		 

   
   return '<div class="hh"  style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
					.'<div>'
					.'<div class="pull-left" data-toggle="collapse" data-target="#'.$modalId.'" class="" aria-expanded="true"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                    .'<div class="pull-right">'
						.$ShowTime
					. $Ausgabe
                    . '</div>'
                    . '<div class="clearfix"></div>'
					
					 .'<div class="hh2 collapse" id="' . $modalId . '">'
				. '<div class="row text-center">'
                    . '<div class="btn-group">'
                        .$presets
                    . '</div>'
                . '</div>'
				. '</div>'
				
                . '</div>'

				.$Ausgabe2
								.'</div>';

    }
}


