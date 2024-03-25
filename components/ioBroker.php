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
		 
		 // Werte können kombiniert werden
		  {
			"component":"ioBroker", 
			"api":"http://192.168.178.21:8087",			
            "name":"Schrankbeleuchtung",
            "icon":"light_floor_lamp_2.png",
            "objekt":"yeelight-2.0.Buero.control.active_bright,yeelight-2.0.Buero.control.rgb,yeelight-2.0.Buero.control.power",
			"modus":"dimmer,color,toggle"
		 },		 
*/


$ioBrokerComponent = "1";


function ioBroker($component) 
{
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
	
	$Ausgabe = "";
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
		else if ($iseModus[$i] == "program")
		{
			$Ausgabe = $Ausgabe .  ' <span class="runioBroker btn-action" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-run-id="' . $iseWert . '" data-api="'.$iseAPI.'">'.$iseLabel[$i].'</span>';
		}
		else
		{
			$Ausgabe = $Ausgabe .  ' <span class="infoioBroker '.$operate.'" data-id="' . $iseWert . '" data-component="ioBroker" data-datapoint="'. $iseModus[$i] .'" data-unit="' . $iseUnit[$i] . '" data-valuelist="'.$iseValue[$i].'" data-api="'.$iseAPI.'"></span>';
		}
		$i++;
	}
	
		 

   
   return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                   . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                    . '<div class="pull-right">'
					. $Ausgabe
                    . '</div>'
                    . '<div class="clearfix"></div>'
                . '</div>';
    }
}


