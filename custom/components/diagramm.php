<?php

/***********************************************
Diagramm Addon
***********************************************/

// Parameter (config/custom.json)
//
// component: diagramm
// ise_id: eine oder mehrere (durch Komma getrennte) ISE_ID des/der zu sammelnden Datenpunkte(s)
// collect: Abstand der Speicherung in Minuten, oder feste Uhrzeit(en) im Format HH:MM[,HH:MM[,...]]
// history (optional): maximale Anzahl gespeicherter Werte, 1...5000. Standard 200.
// size (optional): Höhe des Diagramms 0...3. Standard 100% Fensterhöhe.
// precision (optional): Anzahl Dezimalstellen bei numerischen Werten. Standard 1.
// only_changed (optional): 1/true/yes: nur speichern, wenn sich der Wert geändert hat. Standard false.
// aufgeklappt (optional): 1/true/yes: Diagramm wird beim laden aufgeklappt. Standard false.
// 
////////////////////////////////////////////////////

if(isset($_GET['lade']))
{
  if($_GET['lade']== "content")
  {

    $collect = ( isset($_GET['collect']) ? $_GET['collect'] : 0 );

    // history auf ganzzahlige Werte zwischen 1 und 5000 begrenzen, Standard 200
    $history = ( isset($_GET['history']) ? max(1, min(intval($_GET['history']), 5000)) : 200 );

    // Dateiname der cache Datei diagramm_<ise_id>_<collect>_<history>.csv
    $datei = '../../cache/diagramm_'.preg_replace('/\D/', '-', $_GET['ise_id']).'_'.preg_replace('/\D/', '-', $collect).'_'.$history.'.csv';

    // Daten zeilenweise in ein Array einlesen
    if(!file_exists($datei))
    {
      echo "Cache-Datei existiert nicht";
      exit();
    }

    // Daten zeilenweise in ein Array einlesen
    $array = file($datei);

    $p = 0;
    $Ch = -1000;
    $Cl = 1000;
	$diaexplodeA = "";
	$diaexplodeB = "";
	$diaexplodeC = "";
	$diaexplodeD = "";
	$diaexplodeE = "";
	$diaexplodeF = "";
	foreach($array AS $arrayinhalt) 
	{
 
		$p++;
		$diaexplode = explode(";", trim($arrayinhalt));
		/*
		if (str_replace(":", "",$diaexplode[0]) % 2 == 0)
		{
			// zahl teilbar / ist bei doppelten einträem
		}
		else
		{
			$diaexplode[0] = "";	
		}
		*/
		// Nur runde Werte, danach wieder in ursprungsvariable
		$RunderWert = explode(".",$diaexplode[1]);

		
		// High und Low berechnen
		if(intval($diaexplode[1]) > $Ch) { $Ch = intval($diaexplode[1]); }
		if(intval($diaexplode[1]) < $Cl) { $Cl = intval($diaexplode[1]); }
		
		
			if(isset($diaexplodeA)) { $diaexplodeA = $diaexplodeA .","."'".$diaexplode[0]."'"; }
			else {  $diaexplodeA = ","."'".$diaexplode[0]."'"; }
			if(isset($diaexplodeB)) { $diaexplodeB = $diaexplodeB .",".$diaexplode[1]; }
			else { $diaexplodeB = ",".$diaexplode[1]; }
		    if(isset($diaexplodeC)) { $diaexplodeC = $diaexplodeC .",".$diaexplode[2]; }
			else { $diaexplodeC = ",".$diaexplode[2]; }
			if(isset($diaexplodeD)) { $diaexplodeD = $diaexplodeD .",".$diaexplode[3]; }
			else { $diaexplodeD = ",".$diaexplode[3]; }
			if(isset($diaexplodeE)) { $diaexplodeE = $diaexplodeE .",".$diaexplode[4]; }
			else { $diaexplodeE = ",".$diaexplode[4]; }
			if(isset($diaexplodeF)) { $diaexplodeF = $diaexplodeF .",".$diaexplode[5]; }
			else { $diaexplodeF = ",".$diaexplode[5]; }			
		/*
		if((trim($diaexplode[0]) == "") OR ($p<=15) or (trim(substr($diaexplode[0], -2)) != "00"))
		{
          $diaexplodeA = $diaexplodeA .","."''";
          $diaexplodeB = $diaexplodeB .",".$diaexplode[1];
          $diaexplodeC = $diaexplodeC .",".$diaexplode[2];
          if(isset($diaexplode[3])) { $diaexplodeD = $diaexplodeD .",".$diaexplode[3]; }
          if(isset($diaexplode[4])) { $diaexplodeE = $diaexplodeE .",".$diaexplode[4]; }
        }
        else
        {
          $diaexplodeA = $diaexplodeA .","."'".$diaexplode[0]."'";
          $diaexplodeB = $diaexplodeB .",".$diaexplode[1];
          $diaexplodeC = $diaexplodeC .",".$diaexplode[2];
          if(isset($diaexplode[3])) { $diaexplodeD = $diaexplodeD .",".$diaexplode[3]; }
          if(isset($diaexplode[4])) { $diaexplodeE = $diaexplodeE .",".$diaexplode[4]; }
          $p = 0;
        }
		*/
      }
  }


echo '<canvas id="chart_'.$_GET['modalID'].'" style="position: relative; width: 100vw; height: '.( (isset($_GET['size']) and is_numeric($_GET['size'])) ? strval(30 + 20 * intval($_GET['size'])) : '100' ).'vh"></canvas>';

$tCh = ($Cl + 0.5) - $Ch;
if($tCh > 0) { $Ch = $Ch + $tCh; }


if ($Cl <> 0) { $Cl = $Cl -0.5; }
else { $Cl = "-1"; }
if( $Ch == 100) { $Ch = 99.5; }


if(isset($_GET["legend"])) {
	$legend = explode(";",$_GET["legend"]);
}

echo '<script>
ctx = document.getElementById("chart_'.$_GET['modalID'].'");

new Chart(ctx, 
{
	type: "line",
	data: 
	{
		labels: ['.$diaexplodeA.'],
		datasets: [
		{
			label:"'.$legend[0].'",
			data: ['.$diaexplodeB.'],
			borderColor: "#53a6dc",
			borderWidth: 1.5,
			pointRadius: 0,
			fill: false,
			backgroundColor: "transparent",
			lineTension: 0.1,
		}';
		
		if(str_replace(",", "", $diaexplodeC) != "")
		{
			echo '
			,{
			label:"'.$legend[1].'",
			data: ['.$diaexplodeC.'],
			borderColor: "#ec7657",
			borderWidth: 1.5,
			pointRadius: 0,
			fill: false,
			backgroundColor: "transparent",
			lineTension: 0.1,
			}';
		}
		if(str_replace(",", "", $diaexplodeD) != "")
		{
			echo '
			,{
			label:"'.$legend[2].'",
			data: ['.$diaexplodeD.'],
			borderColor: "#f3af54",
			borderWidth: 1.5,
			pointRadius: 0,
			fill: false,
			backgroundColor: "transparent",
			lineTension: 0.1,
			}';
		}
		if(str_replace(",", "", $diaexplodeE) != "")
		{
			echo '
			,{
			label:"'.$legend[3].'",
			data: ['.$diaexplodeE.'],
			borderColor: "#6fc689",
			borderWidth: 1.5,
			pointRadius: 0,
			fill: false,
			backgroundColor: "transparent",
			lineTension: 0.1,
			}';
		}
		if(str_replace(",", "", $diaexplodeF) != "")
		{
			echo '
			,{
			label:"'.$legend[4].'",
			data: ['.$diaexplodeF.'],
			borderColor: "#6a3ba3",
			borderWidth: 1.5,
			pointRadius: 0,
			fill: false,
			backgroundColor: "transparent",
			lineTension: 0.1,
			}';
		}	
	echo '		
	]
	},
	options: 
	{
		animation: 
		{
			duration: 0,
		},
		plugins: 
		{
			legend: 
			{';
			
			
			if(isset($_GET['legend'])) { echo 'display: true,'; }
			else { echo 'display: false,'; }
			echo '},
		},
		scales:
		{
			x:
			{

				ticks: {
				maxTicksLimit:11,
				minRotation:0,
				labelOffset:0,
				sampleSize:20,
			  	color:"white",
		
                },
		  grid: 
				{
					display: true,
					drawOnChartArea: false,
					drawTicks: true,
				},
		

			},
			y:
			{

ticks: {
	precision:0,
					color:"white"
},
				grid: 
				{
					display: true,
					drawOnChartArea: true,
					drawTicks: false,
color:"grey"
				}	
			},
			
			 
		}
	}
  
});
</script>';


  exit();
}

function diagramm($component) {
    $modalId = mt_rand();
	
    $collect = ( isset($component['collect']) ? $component['collect'] : 0 );

	// history auf ganzzahlige Werte zwischen 1 und 5000 begrenzen, Standard 200
    $history = ( isset($component['history']) ? max(1, min(intval($component['history']), 5000)) : 200 );

	// Dateiname der cache Datei diagramm_<ise_id>_<collect>_<history>.csv
	$dateilink  = 'cache/diagramm_'.preg_replace('/\D/', '-', $component['ise_id']).'_'.preg_replace('/\D/', '-', $collect).'_'.$history.'.csv';

	$refresh = ( !empty($component["refresh"]) ? 'setInterval(execute_diagramm_'. $modalId.',('.$component['refresh'].'*1000));' : '' );

	$legend = ( !empty($component['legend']) ? '&legend='.$component['legend'] : '' );

    if (!isset($component['size'])) $component['size'] = '';

	//style="display:flow-root;
	
	//$aufgeklappt = ( (isset($component['aufgeklappt']) and in_array(strtolower($component['aufgeklappt']), array('1', 'yes', 'true'))) ? '$("#'.$modalId.'").collapse("toggle");' : '' );
	
	if(isset($component['aufgeklappt']) and in_array(strtolower($component['aufgeklappt']), array('1', 'yes', 'true')))
	{
		$aufgeklapptA = "collapse in";
		$aufgeklapptB = "true";
		$aufgeklapptC = "collapse collapsed in";
	}
	else
	{
		$aufgeklapptA = "collapse collapsed";
		$aufgeklapptB = "false";
		$aufgeklapptC = "collapse collapsed";
	}
	
	
	if (!isset($component['color'])) $component['color'] = 'transparent';  
	if(isset($component['link'])) { $link = '<a href="'.$component['link'].'" target="_blank"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'].'</a>'; }
	else { $link = '<img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'];}
	
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '" style="display:flow-root;" class="'.$aufgeklapptA.'" aria-expanded="'.$aufgeklapptB.'">'
            . '<a href="'.$dateilink .'"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</a>'
        . '</div>'
        . '<div class="hh2 '.$aufgeklapptA.'" id="'.$modalId.'" aria-expanded="'.$aufgeklapptB.'">'
        .' ...'
        . '</div><div class="clearfix"></div></div>'
    . '
<script type="text/javascript">
$(window).bind("load", execute_diagramm_'. $modalId.');
function execute_diagramm_'. $modalId.'() {
  $.ajax({
    url: "custom/components/diagramm.php?lade=content&modalID='.$modalId.'&ise_id='.$component['ise_id'].'&history='.$history.'&size='.$component['size'].'&collect='.$collect.$legend.'",
    success: function(data) {
	  $("#'. $modalId.'").html("" + data);
	 // '.$aufgeklappt.'
	   
    }
  });
}
</script>
';
}
  
?>
