<?php
 /* ENERGY-GRID 
unbedingt auch custom js EnergyGrid.js beachten!
 
config:
{
	"component": "EnergyGrid",
	"name": "Energieübersicht",
	"icon": "pv_verbraucher.png",
	"pv": "46682",
	"battery": "43301",
	"battery_level": "46681",
	"house": "64567",
	"wallbox": "38816",
	"wallbox_level": "38816",
	"grid": "22719",
	"aufgeklappt": "1"
}

// Bei allen Werten wird die ise_id angegeben als Quelle:
//
// grid: negativer Wert ist Einspeiung / Positiver Bezug
// battery: negativer Wert ist einspeisung ins Haus, positiver Laden des Akkus (optional)
// battery_level: prozentualer Wert (optional)
// wallbox: negativer Wert ist einspeisung ins Haus, positiver Laden des Akkus (optional)
// wallbox_level: prozentualer Wert (optional)
// house: Hausverbrauch
// PV: Watt die die PV liefert
//
// Optional sind wallbox / wallbox_level 
//               battery / battery_level
//
// aufgeklappt	= 0 zugeklappt 1 aufgeklappt - standard 1
*/

/*
// ACHTUNG: in die "custom\js\custom.js" müssen folgende 2 Zeilen aufgenommen werden !!!

let EnergyGridPV = 0;
let EnergyGridHouse = 0;



*/

function EnergyGrid($component) {
	
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
	
	
	
	if (!isset($component['color'])) $component['color'] = '#595959';
	
	$fill = "#292929";
    $retVal = '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">'.$component["name"]. '</div>'
        . '</div>'
		 . '<div class="pull-right" style="display:no4ne;">'
		
		//Header-Texte mit Werten
		.'<span class="info" data-id="'.$component["pv"].'" data-component="energygrid_pv-value" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (PV) | ';
		if(isset($component["battery_level"]))
		{
			$retVal = $retVal   .'<span class="info" data-id="'.$component["battery"].'" data-component="energygrid_battery-value" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (Speicher) | '
			.'<span class="info" data-id="'.$component["battery_level"].'" data-component="energygrid_battery-level" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (%) | ';
		}

		$retVal = $retVal   .'<span class="info" data-id="'.$component["house"].'" data-component="energygrid_house-value" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (Haus) | '
		.'<span class="info" data-id="'.$component["grid"].'" data-component="energygrid_grid-value" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (Zähler) | ';
		if(isset($component["wallbox"]))
		{
			$retVal = $retVal   .'<span class="info" data-id="'.$component["wallbox"].'" data-component="energygrid_wallbox-value" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (WB)';
		}
		if(isset($component["wallbox_level"]))
		{
			$retVal = $retVal   .' | <span class="info" data-id="'.$component["wallbox_level"].'" data-component="energygrid_wallbox-level" data-datapoint="4" data-unit=" W" data-indicator="-1" style="margin-left:0px;"></span> (%)';
		}
		$retVal = $retVal 	.'</div>'
		
		
		//SVG
        . '<div class="hh2 '.$aufgeklappt.'" id="' . $modalId . '">'
			.''
			.'<center><br>'
			.'<svg xmlns="http://www.w3.org/2000/svg" style="bor4der: 1px solid red;max-height: 400px;max-width:100%;" viewBox="0 0 650 500" fill="none" width="650" height="500" >
            <style>
                           .energyline {
                satroke-width: 2;
                satroke-dasharray: 20;
				
                }

                .neutral {
                stroke: #0e2f44;
                stroke: grey;
                }

                .good {
                stro2ke: green;
                }

                .bad {
                str2oke: #f54842;
                }


                .fw {
                animation: dash-fw 5s linear infinite reverse;
              

  animation: move 3s linear reverse infinite; /* reverse dreht alles um */
}
@keyframes move {
  from { offset-distance: 0%; }
  to { offset-distance: 100%; }
}

                .bw {
                animation: dash-bw 5s linear infinite reverse;
				

                }

                @keyframes dash-bw {
                to {
                stroke-dashoffset: 200;
                }
            }

                .heavy {
                font: bold 30px sans-serif;
                fill: white;
                }
				
				.energyline-value {
					text-align: center;
					font-size: 14px;
				}
				.info {
					text-align: center;
					font-size: 14px;
				}
				


                
            </style>'
			
			//SVG-Linien zur Darstellung der Verbindungen / des Flusses; müssen zuerst kommen, damit die Kreise darüber liegen"
			
            .'
			


			  
			  
			  
   		      <path id="eg_grid_to_house" d="M 50 255 L 575 255" fill="none" stroke="grey" stroke-width="1"/>
			  <circle id="eg_grid_to_house_circle" r="5" fill="#9c7140" >
			  <animateMotion id="eg_grid_to_house_animate" dur="2.2s"  begin="0.4s" repeatCount="indefinite"  keyTimes="0;1">
              <mpath xlink:href="#eg_grid_to_house" />
              </animateMotion>
	          </circle>';
			  
			  if(isset($component["battery"]))
			{
		      $retVal = $retVal 		
			
            .'<path id="eg_pv_to_battery" d="M 325 120 L 325 400" fill="none" stroke="grey" stroke-width="1"/>
			  <circle id="eg_pv_to_battery_circle" r="5" fill="#e0d055" >
			  <animateMotion id="eg_pv_to_battery_animate" dur="2.2s"  begin="0.4s" repeatCount="indefinite" keyTimes="0;1">
              <mpath xlink:href="#eg_pv_to_battery" />
              </animateMotion>
	          </circle>';
			}
			 if(isset($component["wallbox"]))
			{
		      $retVal = $retVal 		
			
            .'<path id="eg_wallbox_to_house" d="M 575 120 L 575 255" fill="none" stroke="grey" stroke-width="1"/>
			  <circle id="eg_wallbox_to_house_circle" r="5" fill="#8cb9fd" >
			  <animateMotion id="eg_wallbox_to_house_animate" dur="2.2s"  begin="0.4s" repeatCount="indefinite" keyTimes="0;1">
              <mpath xlink:href="#eg_wallbox_to_house" />
              </animateMotion>
	          </circle>';
				}
		  $retVal = $retVal 
.'<path id="eg_pv_to_grid" d="M317,120 v15 c0,105 -10,105 -30,105 h-200" stroke="grey" stroke-width="1" />
  <circle id="eg_pv_to_grid_circle" r="5" fill="#e0d055" >
              <animateMotion id="eg_pv_to_grid_animate" dur="2.5s" begin="0s" repeatCount="indefinite"  keyTimes="0;1">
              <mpath xlink:href="#eg_pv_to_grid" />
              </animateMotion>
	          </circle>

<path id="eg_pv_to_house" d="M333,120 v15 c0,105 10,105 30,105 h200" stroke="grey" stroke-width="1" />
			  <circle id="eg_pv_to_house_circle" r="5" fill="#e0d055" >
              <animateMotion id="eg_pv_to_house_animate" dur="2.5s" begin="0s" repeatCount="indefinite"  keyTimes="0;1">
              <mpath xlink:href="#eg_pv_to_house" />
              </animateMotion>
	          </circle>';
			  
			if(isset($component["battery"]))
			{
		      $retVal = $retVal 		
			
            .'  
<path id="eg_battery_to_house" d="M335,370 v5 c0,-105 10,-105 30,-105 h200" stroke="grey" stroke-width="1" />
 <circle id="eg_battery_to_house_circle" r="5" fill="#e96a93">
			  <animateMotion id="eg_battery_to_house_animate" dur="2.3s"  begin="0.3s" repeatCount="indefinite"  keyTimes="0;1">
              <mpath xlink:href="#eg_battery_to_house" />
              </animateMotion>
	          </circle>';
			
			}

            $EnergyGridX = "325";
			$EnergyGridY = "75";
			
			$retVal = $retVal 			
            .'<circle id="pv" cx="'.$EnergyGridX.'" cy="'.$EnergyGridY.'" r="50" stroke="#e0d055" stroke-width="3" fill="'.$fill.'" />
			<image x="'.($EnergyGridX-15).'" y="'.($EnergyGridY-35).'" width="30" height="30" clip-path="url(#clip)" xlink:href="icon/sani_solar.png" />
			<foreignobject class="node" width="100" height="30" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+3).'">
				<span id="pv_value" class="energyline-value" data-id="'.$component["pv"].'" data-component="energygrid_pv-value"></span>
			</foreignobject>';

			
            $EnergyGridX = "75";
			$EnergyGridY = "255";
			
			$retVal = $retVal 			
            .'<circle id="grid" cx="'.$EnergyGridX.'" cy="'.$EnergyGridY.'" r="50" stroke="#9c7140" stroke-width="3" fill="'.$fill.'" />
			<image x="'.($EnergyGridX-15).'" y="'.($EnergyGridY-35).'" width="30" height="30" clip-path="url(#clip)" xlink:href="icon/scene_power_grid.png"  />
			<foreignobject class="node" width="100" height="30" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+3).'">
				<span id="grid_value" class="energyline-value" data-id="'.$component["grid"].'" data-component="energygrid_grid-value"></span>
			</foreignobject>';
			
            $EnergyGridX = "575";
			$EnergyGridY = "255";
			
			$retVal = $retVal 			
            .'<circle id="house" cx="'.$EnergyGridX.'" cy="'.$EnergyGridY.'" r="50" stroke="#5cb4ac" stroke-width="3" fill="'.$fill.'" />
			<image x="'.($EnergyGridX-15).'" y="'.($EnergyGridY-35).'" width="30" height="30" clip-path="url(#clip)" xlink:href="icon/status_comfort.png"  />
			<foreignobject class="node" width="100" height="30" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+3).'">
				<span id="house_value" class="energyline-value" data-id="'.$component["house"].'" data-component="energygrid_house-value"></span>
			</foreignobject>';
			
			if(isset($component["battery"]))
			{

            $EnergyGridX = "325";
			$EnergyGridY = "420";
			
			$retVal = $retVal 			
            .'<circle id="battery" cx="'.$EnergyGridX.'" cy="'.$EnergyGridY.'" r="50" stroke="#e96a93" stroke-width="3" fill="'.$fill.'" />
			<image id="battery_level_icon" x="'.($EnergyGridX-15).'" y="'.($EnergyGridY-35).'" width="30" height="30" clip-path="url(#clip)" xlink:href="icon/measure_battery_0.png"  />
			<foreignobject class="node" width="100" height="50" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY-3).'">
				<span id="battery_value" class="energyline-value" data-id="'.$component["battery"].'" data-component="energygrid_battery-value"></span><br>
			</foreignobject>
			<foreignobject class="node" width="100" height="50" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+15).'">
				<span id="battery_level" class="energyline-value" data-id="'.$component["battery_level"].'" data-component="energygrid_battery-level"></span>
			</foreignobject>';
			
			}
			
			
$EnergyGridX = "575";
			$EnergyGridY = "75";
			
			if(isset($component["wallbox_level"]) AND isset($component["wallbox"]))
			{
				
			
			
			$retVal = $retVal 			
            .'<circle id="wallbox" cx="'.$EnergyGridX.'" cy="'.$EnergyGridY.'" r="50" stroke="#8cb9fd" stroke-width="3" fill="'.$fill.'" />
			<image id="wallbox_level_icon" x="'.($EnergyGridX-15).'" y="'.($EnergyGridY-35).'" width="30" height="30" clip-path="url(#clip)" xlink:href="icon/measure_battery_50.png" />
			<foreignobject class="node" width="100" height="30" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+0).'">
				<span id="wallbox_value" class="energyline-value" data-id="'.$component["wallbox"].'" data-component="energygrid_wallbox-value"></span>
			</foreignobject>			
			<foreignobject class="node" width="100" height="50" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+15).'">
				<span id="wallbox_level" class="energyline-value" data-id="'.$component["wallbox_level"].'" data-component="energygrid_wallbox-level"></span>
			</foreignobject>';
			}
			elseif(isset($component["wallbox"]))
			{
			$retVal = $retVal 			
            .'<circle id="wallbox" cx="'.$EnergyGridX.'" cy="'.$EnergyGridY.'" r="50" stroke="#8cb9fd" stroke-width="3" fill="'.$fill.'" />
			<image x="'.($EnergyGridX-15).'" y="'.($EnergyGridY-35).'" width="30" height="30" clip-path="url(#clip)" xlink:href="icon/it_ups.png" />
			<foreignobject class="node" width="100" height="30" x="'.($EnergyGridX-50).'" y="'.($EnergyGridY+3).'">
				<span id="wallbox_value" class="energyline-value" data-id="'.$component["wallbox"].'" data-component="energygrid_wallbox-value"></span>
			</foreignobject>';
			}
			else
			{
				
			}
			
			$retVal = $retVal .'<path class="grid" id="grid" vector-effect="non-scaling-stroke" d="M0,50 H500"></path>';

			
			//$retVal = $retVal 
           // .'</svg>
            
//';		

						
			
			$retVal .='</svg>'

			
			.'</center>'
			
        . '</div>'
    . '</div>';
	
	
	return $retVal;
}





