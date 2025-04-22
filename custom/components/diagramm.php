<?php

/***********************************************
Diagramm Addon
***********************************************/

// Parameter (config/custom.json)
//
// component: diagramm
//
// Einstellungen für die Daten
// ise_id: eine oder mehrere (durch Komma getrennte) ise_id des/der zu sammelnden Datenpunkte(s)
// collect (optional): Speicher-Interval. Standard immer
//	- Ganzzahl: alle <collect> Minuten sammeln
//	- feste Uhrzeit(en) im Format HH:MM[,HH:MM[,...]]
//	- min: Tagesniederstwert, max: Tageshöchstwert, minmax: beides
// history (optional): maximale Anzahl gespeicherter Werte, 1...5000. Standard 200
// precision (optional): Anzahl Dezimalstellen bei numerischen Werten. Standard 1
// only_changed (optional): 1/true/yes: nur speichern, wenn sich der Wert geändert hat. Standard false
//
// Einstellungen für die Darstellung
// legend (optional): Legende/Beschriftung der Datenlinien
// color (optional): HTML-Farbcode des Balkens am linken Rand. Standard transparent
// size (optional): Höhe des Diagramms 0...3. Standard 100% Fensterhöhe
// aufgeklappt (optional): 1/true/yes: Diagramm wird beim laden aufgeklappt. Standard false
// point-radius (optional): Durchmesser der Messwertpunkte in px. Standard 0
// line-color (optional): Linienfarbe 0-10. Bei mehreren ise_id eine Farbe für alle oder durch Komma getrennt. Standard 0,1,2,...,10
// min-y, max-y (optional): Unterster bzw. oberster Wertbereich der Y-Achse. Standard angepasst an Werte
// bool-true-value, bool-false-value: Umrechnungswerte für boolean Datenpunkte, Wert für true bzw. false. Standard 1 / 0
//
////////////////////////////////////////////////////

$colors = array('53a6dc', 'ec7657', 'f3af54', 'adff2f', '6a3ba3', 'cc3300', 'ffff00', 'ffffcc', '339933', '999966', 'cc33ff');

if (!empty($_GET['diagramm'])) {

	// Diagramm-Parameter
	if (!$param = json_decode(base64_decode($_GET['diagramm']), true)) die('Fehlerhafte Daten');
	if (!$chart_id = preg_replace('/[^\d\w\-_]/i', '', $param['chart'])) die('Ungültiger Diagrammlink');
	$modal_id = rtrim(base64_encode($chart_id), '=');
	$legend = ( !empty($param['legend']) ? preg_split("/[\t,;]/i", $param['legend']) : array() );

	// Dateiname der cache Datei diagramm_<ise_id>_<collect>_<history>.csv
	$cfile = realpath(__DIR__.'/../../cache').'/diagramm_'.$chart_id.'.csv';
	if (!file_exists($cfile)) die('Cache-Datei '.$cfile.' existiert nicht');

	// Daten zeilenweise in ein Array einlesen
	$cache = file($cfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	if (!is_array($cache)) die('Diagramm hat keine Werte');
	foreach($cache as $linenr => $record) {
		$record = explode(';', rtrim(trim($record), ';'));

		// Zeilen ohne Wert(e) überspringen
		if (count($record) < 2) continue;

		// Prefix zwischenspeichern und entfernen
		$label[$linenr] = $record[0];
		array_shift($record);

/*
		// High und Low berechnen
		$y_min = ( isset($y_min) ? min($y_min, $record) : min($record) );
		$y_max = ( isset($y_max) ? max($y_max, $record) : max($record) );
*/

		// Array transponieren. Erzeugt pro Datenpunkt ein Array mit den Werten.
		foreach ($record as $column => $val) {

			// boolean Werte in numerische Werte umwandeln
			if (in_array(strtolower($val), ['true', 'false'])) $val = ( strtolower($val) == 'true' ? ( isset($param['bool-true-value']) ? floatval($param['bool-true-value']) : 1 ) : ( isset($param['bool-false-value']) ? floatval($param['bool-false-value']) : 0 ) );

			$chart[$column][$linenr] = $val;
		}
	}

	// Puffer freigeben
	unset ($cache);

	// Linienfarben
	if (isset($param['line-color'])) {
		if (preg_match('/\D/i', $param['line-color'])) $param['line-color'] = preg_split("/\D+/i", $param['line-color']);	// einzelne Farben trennen
		else $param['line-color'] = array_fill(0, count($chart), intval($param['line-color']));		// gleiche Farbe für alle
	}
	else $param['line-color'] = array();	// Standardfarben

	echo '<canvas id="chart_'.$modal_id.'" style="position: relative; width: 100vw; height: '.( (isset($param['size']) and is_numeric($param['size'])) ? strval(30 + 20 * intval($param['size'])) : '100' ).'vh"></canvas>'.PHP_EOL;

// Doku: https://www.chartjs.org/docs/latest/charts/line.html

	echo '
<script>
ctx = document.getElementById("chart_'.$modal_id.'");

new Chart(ctx, {
	type: "line",
	data: {
		labels: ["'.implode('","', $label).'"],
		datasets: [
';

	// Datenreihen schreiben
	foreach ($chart as $line => $values) {
		echo '		{
			label: "'.( isset($legend[$line]) ? $legend[$line] : '' ).'",
			data: ['.implode(',', $values).'],
			borderColor: "#'.$colors[(( isset($param['line-color'][$line]) ? intval($param['line-color'][$line]) : $line ) % count($colors))].'",
			borderWidth: 1.5,
			pointRadius: '.( isset($param['point-radius']) ? intval($param['point-radius']) : 0 ).',
			fill: false,
			backgroundColor: "transparent",
			lineTension: 0.1,
		},
';
	}

	// Diagramm-Parameter
	echo '		]
	},
	options: {
		animation: {
			duration: 0,
		},
		plugins: {
			legend: {
				display: '.( count($legend) ? 'true' : 'false' ).',
			},
		},
		scales: {
			x: {
				ticks: {
					maxTicksLimit: 11,
					minRotation: 0,
					labelOffset: 0,
					sampleSize: 20,
					color: "white",
				},
				grid: {
					display: true,
					drawOnChartArea: false,
					drawTicks: true,
				},
			},
			y: {
				'.( isset($param['min-y']) ? 'min: '.intval($param['min-y']).',' : '' ).'
				'.( isset($param['max-y']) ? 'max: '.intval($param['max-y']).',' : '' ).'
				ticks: {
					precision: '.( isset($param['precision']) ? intval($param['precision']) : 0 ).',
					color: "white",
				},
				grid: {
					display: true,
					drawOnChartArea: true,
					drawTicks: false,
					color: "grey",
				}
			},
		}
	}
});
</script>
';

	exit();
}

function diagramm($component) {

	$collect = ( isset($component['collect']) ? $component['collect'] : 0 );

	// history auf ganzzahlige Werte zwischen 1 und 5000 begrenzen, Standard 200
	$history = ( isset($component['history']) ? max(1, min(intval($component['history']), 5000)) : 200 );

	// Dateiname der cache Datei diagramm_<ise_id>_<collect>_<history>.csv
	$chart_id = preg_replace('/\D+/', '-', $component['ise_id']).'_'.preg_replace('/\W/', '-', $collect).'_'.$history;
	$cfilelink	= 'cache/diagramm_'.$chart_id.'.csv';

	// dom Diagramm-ID
	$modal_id = rtrim(base64_encode($chart_id), '=');

	$refresh = ( (!empty($component['refresh']) and intval($component['refresh'])) ? 'refresh_diagramm_'.$modal_id.' = setInterval(execute_diagramm_'.$modal_id.', '.(intval($component['refresh']) * 1000 * 60).');' : '' );

	// Parameter formatieren und zusammenfassen
	$param = array('chart' => $chart_id);
	foreach ($component as $key => $val) {
		// Parameter ausschließen, die nicht an das Diagramm übergeben werden sollen. Alle anderen stehen dann im Array param zur Verfügung.
		if (in_array($key, ['component', 'name', 'ise_id', 'collect', 'history', 'color', 'link', 'icon', 'aufgeklappt', 'only_changed'])) continue;
		$param[$key] = $val;
	}

	if(isset($component['aufgeklappt']) and in_array(strtolower($component['aufgeklappt']), array('1', 'yes', 'true'))) {
		$aufgeklappt = array('collapse in', 'true', 'collapse collapsed in');
	} else {
		$aufgeklappt = array('collapse collapsed', 'false', 'collapse collapsed');
	}

	if (!isset($component['color'])) $component['color'] = 'transparent';
	if (isset($component['link'])) { $link = '<a href="'.$component['link'].'" target="_blank"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'].'</a>'; }
	else { $link = '<img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'];}

	return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
		. '<div data-toggle="collapse" data-target="#' . $modal_id . '" style="display:flow-root;" class="'.$aufgeklappt[0].'" aria-expanded="'.$aufgeklappt[1].'">'
			. '<a href="'.$cfilelink .'"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</a>'
		. '</div>'
		. '<div class="hh2 '.$aufgeklappt[0].'" id="'.$modal_id.'" aria-expanded="'.$aufgeklappt[1].'">'
		.' ...'
		. '</div><div class="clearfix"></div></div>'
	. '
<script type="text/javascript">
$(window).bind("load", execute_diagramm_'. $modal_id.');
function execute_diagramm_'. $modal_id.'() {
  $.ajax({
	url: "custom/components/diagramm.php?diagramm='.base64_encode(json_encode($param)).'",
	success: function(data) {
	  $("#'. $modal_id.'").html("" + data);
	}
  });
}
'.$refresh.'
</script>
';
}

?>
