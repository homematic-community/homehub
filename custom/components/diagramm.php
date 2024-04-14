<?php
// php8

/***********************************************
Diagramm Addon
***********************************************/

// Parameter
// aufgeklappt	= 0 zugeklappt 1 aufgeklappt - standard 0

if(isset($_GET['lade']))
{
  if($_GET['lade']== "content")
  {
    if(isset($_GET['history']))
    {
	  $history = $_GET['history'];
    }
    else
    {
	  $history = "200";
    }

    // Datei definieren
    $datei = "../../cache/diagramm_".$_GET['ise_id']."_".$history.".csv";

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




	if($_GET['size'] == "klein")
	{
		//echo '<div class="ct-chart ct-golden-section" id="chart_'.$_GET['modalID'].'" style="height:120px;position: absolute;bottom: -30px;"></div>';
		echo '<canvas id="chart_'.$_GET['modalID'].'" width="100%" ></canvas>';
	}
	elseif($_GET['size'] == "2")
	{
	//	echo '<div class="ct-chart ct-golden-section" id="chart_'.$_GET['modalID'].'" style="height:100px;position: absolute;bottom: 20px;"></div>';
	echo '<canvas id="chart_'.$_GET['modalID'].'" width="100%" ></canvas>';
	}
	elseif($_GET['size'] == "3")
	{
	//	echo '<div class="ct-chart ct-golden-section" id="chart_'.$_GET['modalID'].'" style="height:100px;position: absolute;bottom: 120px;border:0px solid;"></div>';
	echo '<canvas id="chart_'.$_GET['modalID'].'" width="100%" height="70%"></canvas>';
	}
	else
	{
		echo '<canvas id="chart_'.$_GET['modalID'].'" style="padding:0px;margin:5px;height:80%;width:100%;"></canvas>';
	}

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
	
	 $dateilink  = "cache/diagramm_".$component['ise_id']."_".$component['history'].".csv";
	  
	  
	if(!isset($component["refresh"]))
	{
		$refresh = "";
	}
    else
	{
		//	$component["refresh"] = "900"; 
		$refresh = 'setInterval(execute_diagramm_'. $modalId.',('.$component["refresh"].'*1000));';
	}
	// Legend
	 if(isset($component['legend']))
	 {
		 $legend = "&legend=".$component['legend'];
	 }
	 else
	 {
		 $legend = "";
	 }

	$Groesse = "hhdouble";
    if(isset($component['size']))
	{
		if($component['size'] == "klein")
		{
			$Groesse = "";
		}
	}
	else
	{
		$component['size'] = "";
	}

	
	//style="display:flow-root;
	
		if(isset($component["aufgeklappt"])) {
		if($component["aufgeklappt"] == "1") {
			$aufgeklappt = '$("#'.$modalId.'").collapse("toggle");';
		}
		else {
			$aufgeklappt = "";
		}
	}
	else
	{
		$aufgeklappt = "";
	}
	
	 return '<div class="hh">'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '" style="display:flow-root;" class="collapsed">'
            . '<a href="'.$dateilink .'"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</a>'
        . '</div>'
        . '<div class="hh2 collapse" id="'.$modalId.'">'
        .' ...'
        . '</div><div class="clearfix"></div></div>'
    . '
<script type="text/javascript">
function execute_diagramm_'. $modalId.'() {
  $.ajax({
    url: "custom/components/diagramm.php?lade=content&modalID='.$modalId.'&ise_id='.$component['ise_id'].'&size='.$component['size'].'&history='.$component['history'].$legend.'",
    success: function(data) {
	  $("#'. $modalId.'").html("" + data);
	  '.$aufgeklappt.'
	   
    }
  });
}

setTimeout(execute_diagramm_'. $modalId.',500);
'. $refresh.'
</script>
';
}
  
?>
