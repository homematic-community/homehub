<?php 

// Eintrag in Crontab
//
// Sofern kein PHP-CLI zur Verfügung steht:
// */1 * * * * curl --silent http://localhost/homehub/diagramm_collect.php >/dev/null 2>&1
//
// mit PHP-CLI
// */1 * * * * /usr/bin/php -f /pfad-zu-homehub/diagramm_collect.php >/dev/null 2>&1

require_once(__DIR__.'/interface.php');

date_default_timezone_set("Europe/Berlin");
$tage = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");

if (php_sapi_name() != "cli") echo '<pre>'.PHP_EOL;

$minute = date('H')*60 + date('i');
echo "Es ist ".$tage[date('w')].' '.date('d.m.Y H:i:s').', die '.$minute.'. Minute des Tages'.PHP_EOL;

function read_config($file) {
	if (!is_file($file)) return false;
	$config = file_get_contents($file);

	// BOM erkennen und entfernen
	if (strncmp($config, pack("CCC", 0xef, 0xbb, 0xbf), 3) === 0) $config = substr($config, 3);

	// nicht-UTF8 Inhalt zu UTF8 konvertieren
	if (extension_loaded('mbstring')) return mb_convert_encoding($config, 'UTF-8', mb_detect_encoding($config, 'UTF-8, ISO-8859-1', true));
	else {
		if (!preg_match('/(*UTF8)[äöüÄÖÜß]/', $config)) {
			return html_entity_decode(htmlentities($config, ENT_QUOTES, 'ISO-8859-1'), ENT_QUOTES , 'UTF-8');
		} else {
			return $config;
		}
	}
}

// optinale Werte aus custom.json bzw. Standardwerte an Array übergeben
function add_diagramm($custom) {
	return array(
		'only_changed' => ( !empty($custom['only_changed']) or strtolower($custom['component'])=="diagramm_change" ),
		'precision' => ( empty($custom['precision']) ? 1 : intval($custom['precision']) ),
	);
}

// Lese aus custom.json die ise_id, die geloggt werden sollen
$data = read_config(__DIR__.'/config/custom.json');
$json = json_decode($data, true);

foreach ($json['custom'] as $customs) {
	foreach ($customs as $custom) {
		if (!empty($custom['component'])) {
			// <component> ist eines von ...
			if (in_array(strtolower($custom['component']), array("diagramm", "diagramm_eckig", "mdiagramm", "diagramm_change"))) {

				// history auf ganzzahlige Werte zwischen 1 und 5000 begrenzen, Standard 200
				$history = ( empty($custom['history']) ? 200 : max(1, min(intval($custom['history']), 5000)) );

				if (empty($custom['collect'])) {
				// <collect> nicht definiert => immer sammeln
					$diagramm[$custom['ise_id']][0][$history] = add_diagramm($custom);
					echo '- sammle '.$custom['ise_id'].' '.$history.' immer'.PHP_EOL;
				}
				elseif (preg_match('/^\d+$/', $custom['collect'])) {
				// <collect> ist eine natürliche Zahl => alle X Minuten sammeln
					// collect auf Werte zwischen 1 Minute und 24 Stunden begrenzen
					$collect = max(1, min(60*24, $custom['collect']));
					if ($minute % $collect == 0) {
					// Minute des Tages ist glatt durch <collect> teilbar
						$diagramm[$custom['ise_id']][$collect][$history] = add_diagramm($custom);
						echo '- sammle '.$custom['ise_id'].' '.$history.' alle '.$custom['collect'].' Minuten'.PHP_EOL;
					}
					else echo '- überspringe '.$custom['ise_id'].' '.$history.', fällig in '.($custom['collect'] - ($minute % $custom['collect'])).' Minuten (alle '.$custom['collect'].' Minuten)'.PHP_EOL;
				}
				elseif (preg_match('/^(\d+):(\d+)$/', $custom['collect'], $col)) {
				// <collect> sieht nach Uhrzeit aus, zu dieser Uhrzeit sammeln (1x täglich)
					if (sprintf("%02d", $col[1]).':'.sprintf("%02d", $col[2]) == date('H:i')) {
					// Stunden und Minuten auf zweistellig ergänzen und mit aktueller Uhrzeit vergleichen
						$diagramm[$custom['ise_id']][$custom['collect']][$history] = add_diagramm($custom);
						echo '- sammle '.$custom['ise_id'].' '.[$custom['collect']].' '.$history.PHP_EOL;
					}
					else echo '- überspringe '.$custom['ise_id'].' '.$history.', fällig um '.$custom['collect'].PHP_EOL;
				}
				elseif (preg_match('/^(\d+:\d+\D*)+$/', $custom['collect'], $col)) {
				// <collect> sieht nach mehreren Uhrzeiten aus, zu diesen Uhrzeiten sammeln
					$col = preg_split('/[^\d:]+/', $col[0]);
					foreach ($col as $time) {
						$time = explode(':', $time);
						if (sprintf("%02d", $time[0]).':'.sprintf("%02d", $time[1]) == date('H:i')) {
						// Stunden und Minuten auf zweistellig ergänzen und mit aktueller Uhrzeit vergleichen
							$diagramm[$custom['ise_id']][$custom['collect']][$history] = add_diagramm($custom);
							echo '- sammle '.$custom['ise_id'].' '.$custom['collect'].' '.$history.PHP_EOL;
						}
					}
					if (!isset($diagramm[$custom['ise_id']][$custom['collect']][$history])) echo '- überspringe '.$custom['ise_id'].' '.$history.', fällig um '.$custom['collect'].PHP_EOL;
				}
				else {
					echo '- '.$custom['collect'].' für '.$custom['ise_id'].' '.$history.' kann nicht interpretiert werden'.PHP_EOL;
				}

			}
		}
	}
}

// Mehrere ise_id einer Definition vereinzeln, damit alle Werte bei der CCU abgefragt werden
// Erklärung: Wenn Datenpunkte als Array an die api_state in der interface.php übergeben, trennt diese nicht mehr nach Trennzeichen.
$datapoints = array_keys($diagramm);
$combine = array();
foreach ($datapoints as $key => $ise_id) {
	if (preg_match('/\D/', $ise_id)) {
		$split = preg_split('/\D+/', $ise_id);
		$combine[$ise_id] = $split;		// damit nachher wieder zusammengesetzt werden kann
		array_splice($datapoints, $key, 1);		// diesen Eintrag löschen, dafür ...
		$datapoints = array_merge($datapoints, $split);		// ... einzelne Datenpunkte anhängen
	}
}

if (!count($datapoints)) {
	echo 'Beende, da keine relevanten Datenpunkte.'.PHP_EOL.PHP_EOL;
	if (php_sapi_name() != "cli") echo '</pre>'.PHP_EOL;
	exit(0);
}

// Werte der Datenpunkte von der CCU lesen
$xml = simplexml_load_string(api_state($ccu, $datapoints, true));
if (!is_object($xml->datapoint)) die('Fehler beim Auslesen der CCU-Abfrage!'.PHP_EOL);
foreach ($xml->datapoint as $datapoint) {
	$ise_id = strval($datapoint->attributes()['ise_id']);
	$value = strval($datapoint->attributes()['value']);
	echo '- Wert: '.$ise_id.' = '.$value.PHP_EOL;
	$values[$ise_id] = $value;
}

// Werte für Mehrfach-Diagramme zusammensetzen
if (count($combine)) {
	foreach ($combine as $ise_id => $multiple) {
		$join = array();
		foreach ($multiple as $datapoint) {
			$join[] = $values[$datapoint];
		}
		$values[$ise_id] = $join;
	}
}

foreach ($diagramm as $ise_id => $collects) {
	if (isset($values[$ise_id])) {
	// Datenpunkt nur verarbeiten, wenn Wert von CCU vorhanden ist

		foreach ($collects as $collect => $histories) {
			foreach ($histories as $history => $arr) {
			// Einzelne Dateie je <collect> und <history> schreiben

				$cfile = __DIR__.'/cache/diagramm_'.preg_replace('/\D/', '-', $ise_id).'_'.preg_replace('/\D/', '-', $collect).'_'.$history.'.csv';

				// Numerische Werte in Dezimalzahl mit <precision> Nachkommastellen formatieren
				if (is_numeric($values[$ise_id])) $values[$ise_id] = number_format(floatval($values[$ise_id]), $arr['precision'], '.', '');

				// Werte für Mehrfach-Diagramme zusammensetzen
				elseif (is_array($values[$ise_id])) {
					$m_values = $values[$ise_id];
					foreach ($m_values as $key => $value) {
						if (is_numeric($value)) $m_values[$key] = number_format(floatval($m_values[$key]), $arr['precision'], '.', '');
					}
					$values[$ise_id] = implode(';', $m_values);
				}

				if (file_exists($cfile)) {
				// cache Datei ist vorhanden

					$csv = file($cfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					echo '- '.basename($cfile).' hat '.count($csv).' Zeilen, maximal '.$history.PHP_EOL;

					// Array auf maximal <history> Werte kürzen
					while (count($csv) >= $history) array_shift($csv);

					// Letzten gespeicherten Wert auslesen, überspringen falls unverändert
					if (!empty($arr['only_changed'])) {
						if (count($csv)) {
							$last = explode(';', rtrim($csv[count($csv)-1], ';'), 2);
							if ($last[1] == $values[$ise_id]) {
								echo '- überspringe '.$ise_id.' '.$collect.' '.$history.', Wert ist unverändert '.$values[$ise_id].'.'.PHP_EOL;
								continue;
							}
						}
					}

				} else {
				// cache Datei nicht vorhanden, anlegen und Schreirechte setzen

					echo '- '.basename($cfile).' nicht vorhanden, lege neu an'.PHP_EOL;
					touch($cfile);
					if (!chmod($cfile, 0666)) echo 'Fehler beim setzen der Schreibrechte für '.$cfile.PHP_EOL;

					// Prüfen, ob es eine cache Datei in altem Dateinamenformat (diagramm_<ise_id>_<history>.csv) gibt
					$oldfile = __DIR__.'/cache/diagramm_'.preg_replace('/\D/', '-', $ise_id).'_'.$history.'.csv';
					if (file_exists($oldfile)) {
					// alte Datei vorhanden, Inhalt einlesen und Datei löschen
						echo '- Verschiebe Daten von '.basename($oldfile).' nach '.basename($cfile).PHP_EOL;
						$csv = file($oldfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						unlink($oldfile);
					}

					// keine Daten, leeres Array erzeugen
					else $csv = array();
				}

				// Prefix für Beschriftung X-Achse
				if (preg_match('/^(\d+):(\d+)$/', $collect)) $prefix = $tage[date('w')].' '.date('d.m.');
				else $prefix = $tage[date('w')].' '.date('H:i');
				# todo: Tag nur schreiben, wenn neuer Tag seit letztem Wert. Sollte mit $last[0] machbar sein #

				$csv[] = $prefix.';'.$values[$ise_id].';';
				echo '- schreibe '.$prefix.' = '.$values[$ise_id].' nach '.basename($cfile).PHP_EOL;
				file_put_contents($cfile, implode("\n", $csv));

			}
		}

	}

}

echo 'Fertig.'.PHP_EOL.PHP_EOL;

if (php_sapi_name() != "cli") echo '</pre>'.PHP_EOL;

?>