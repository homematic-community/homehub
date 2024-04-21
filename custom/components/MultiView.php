<?php
// Multiview Ise
/*

	  		{
		"component":"MultiView",
		"name":"WZ Fenster",
		"icon":"time_graph.png",
		"ise_id":"33687,33620,51944,32394",
		"ise_unit":"links,mitte,rechts",
		"pre_ise_text":"Text vor Wert 1,Text vor Wert 2,Text vor Wert 3",
		"ise_component":"HmIP-SWDO-I,HmIP-SWDO-I,HmIP-SWDO-I,HmIP-BWTH",
		"ise_datapoint":"STATE,STATE,STATE,ACTUAL_TEMPERATURE",
		"url":"http://google.de"
		},

Optional url, falls Komponentenname klickbar sein soll
Optional pre_ise_text 
*/

function MultiView($component) {
	if((!isset($component['name'])) OR (!isset($component['icon'])) OR (!isset($component['ise_id'])) OR (!isset($component['ise_unit'])))
	{
		return ' // Nicht korrekt nach Muster eingetragen.
		         {
            "component":"MultiView",
            "name":"MultiView",
            "icon":"fts_shutter_automatic.png",
            "ise_id":"32997,46681,36605,36607,32474",
			"ise_unit":"w,kwh,,,"
         },
		
		';
	}
	$modalId = mt_rand();
	if (!isset($component['color'])) $component['color'] = '#595959';
	
    if(isset($component["url"]))
	{
		$url = '<a href="' . $component["url"] . '">' . $component['name'] . '</a>';
	}
	else
	{
		$url = $component['name'];
	}
	
    $ausgabe = '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
             . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">'. $url . '</div>'
        . '</div>'
        . '<div class="pull-right">';
		
		$iseWerte = explode(",",$component["ise_id"]);
		$iseUnit = explode(",",$component["ise_unit"]);
		if(isset($component["pre_ise_text"])) $preiseText = explode(",",$component["pre_ise_text"]); 
		$iseComponent = explode(",",$component["ise_component"]);
		$iseDatapoint = explode(",",$component["ise_datapoint"]);
		if(isset($component["ise_datavaluelist"]))  { $iseDataValuelist = explode(",",$component["ise_datavaluelist"]); }
		$i = 0;
		foreach ($iseWerte as $iseWert) {
			if(!isset($iseDataValuelist[$i])) { $iseDataValuelist[$i] = ""; }
			if($i != "0") $ausgabe = $ausgabe .  " | ";
			if(isset($preiseText[$i])) $ausgabe = $ausgabe . $preiseText[$i]." ";
			$ausgabe = $ausgabe .  '<span class="info set " data-id="'.$iseWert.'" data-component="'.$iseComponent[$i].'" data-datapoint="'.$iseDatapoint[$i].'" data-unit="'.$iseUnit[$i].'" data-state-icons="" data-indicator="-1" data-valuelist="'.$iseDataValuelist[$i].'" Style="margin-left:0px;" data-set-value=""></span> '.$iseUnit[$i]."";
			$i++;
		}
    $ausgabe = $ausgabe . '<div class="clearfix"></div></div></div>';
	return $ausgabe;
}
?>