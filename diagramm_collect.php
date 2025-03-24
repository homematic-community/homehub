<?php

// Eintrag in Crontab
//
// Sofern kein PHP-CLI zur Verfügung steht:
// */1 * * * * curl --silent http://localhost/homehub/diagramm_collect.php >/dev/null 2>&1
//
// mit PHP-CLI
// */1 * * * * /usr/bin/php -f /pfad-zu-homehub/diagramm_collect.php >/dev/null 2>&1

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');

require_once(__DIR__.'/interface.php');

date_default_timezone_set("Europe/Berlin");
$tage = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");

if (php_sapi_name() != "cli") echo '<pre>'.PHP_EOL;

$minute = date('H')*60 + date('i');
echo "Es ist ".$tage[date('w')].' '.date('d.m.Y H:i:s').', die '.$minute.'. Minute des Tages'.PHP_EOL;

if (isset($_GET['dryrun']) or (!empty($argv[1]) and $argv[1]=='dryrun')) { echo '--- SIMULATION ---'.PHP_EOL; $_dryrun=true; $_verbose=true; }
elseif (isset($_GET['test']) or (!empty($argv[1]) and $argv[1]=='test')) { echo '--- TEST ---'.PHP_EOL; $_test=true; $_verbose=true; }
elseif (isset($_GET['verbose']) or (!empty($argv[1]) and $argv[1]=='verbose')) { $_verbose=true; }
if (isset($_GET['minute'])) $minute = intval($_GET['minute']);
elseif (!empty($argv[1]) and is_numeric(trim($argv[1]))) { $minute = intval(trim($argv[1])); $_verbose=true; }

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
		'type' => trim(strtolower($custom['component'])),
		'only_changed' => ( !empty($custom['only_changed']) or strtolower($custom['component'])=="diagramm_change" ),
		'precision' => ( !isset($custom['precision']) ? 1 : min(abs(intval($custom['precision'])), 5) ),
	);
}

// Lese aus custom.json die ise_id, die geloggt werden sollen
$data = read_config(__DIR__.'/config/custom.json');
if (!$json = json_decode($data, true)) {
	echo '!! Syntaxfehler custom.json !!'.PHP_EOL.PHP_EOL;
	if (php_sapi_name() != "cli") echo '</pre>'.PHP_EOL;
	exit(0);
}

if (empty($_test) and empty($_dryrun)) {
	$startdelay = rand(2, 8);
	echo '- warte '.$startdelay.' Sekunden...'.PHP_EOL;
	sleep($startdelay);
	unset($startdelay);
}

$combine = array();
$datapoints = array();

foreach ($json['custom'] as $customs) {
	foreach ($customs as $custom) {
		if (!empty($custom['component'])) {
			// <component> ist eines von ...
			if ((in_array(trim(strtolower($custom['component'])), array("diagramm", "diagramm_eckig", "mdiagramm", "diagramm_change")) and empty($_test)) or ((trim(strtolower($custom['component'])) == 'diagramm_test') and !empty($_test))) {

				if (preg_match('/\D/', $custom['ise_id'])) {
					if (!empty($_verbose)) echo 'v  formatiere "'.$custom['ise_id'].'" zu "';
					$custom['ise_id'] = trim(preg_replace('/\D+/', '-', $custom['ise_id']), '-');
					if (!empty($_verbose)) echo $custom['ise_id'].'"'.PHP_EOL;
				}

				// <historyY auf ganzzahlige Werte zwischen 1 und 5000 begrenzen, Standard 200
				$history = intval( empty($custom['history']) ? 200 : max(1, min(intval($custom['history']), 5000)) );

				if (isset($custom['collect'])) $custom['collect'] = trim($custom['collect']);

				// alle Definitionen zwischenspeichern
				$diagramm_custom[$custom['ise_id']][( empty($custom['collect']) ? 0 : $custom['collect'] )][$history] = true;

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
					} else {
						echo '- überspringe '.$custom['ise_id'].' '.$history.', fällig in '.($custom['collect'] - ($minute % $custom['collect'])).' Minuten (alle '.$custom['collect'].' Minuten)'.PHP_EOL;
						continue;
					}
				}
				elseif (preg_match('/^(\d+):(\d+)$/', $custom['collect'], $col)) {
				// <collect> sieht nach Uhrzeit aus, zu dieser Uhrzeit sammeln (1x täglich)
					if (sprintf("%02d", $col[1]).':'.sprintf("%02d", $col[2]) == date('H:i')) {
					// Stunden und Minuten auf zweistellig ergänzen und mit aktueller Uhrzeit vergleichen
						$diagramm[$custom['ise_id']][$custom['collect']][$history] = add_diagramm($custom);
						echo '- sammle '.$custom['ise_id'].' '.[$custom['collect']].' '.$history.PHP_EOL;
					} else {
						echo '- überspringe '.$custom['ise_id'].' '.$history.', fällig um '.$custom['collect'].PHP_EOL;
						continue;
					}
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
					if (!isset($diagramm[$custom['ise_id']][$custom['collect']][$history])) {
						echo '- überspringe '.$custom['ise_id'].' '.$history.', fällig um '.$custom['collect'].PHP_EOL;
						continue;
					}
				}
				elseif (preg_match('/(min|max)/i', $custom['collect'])) {
				// Tagesniederst- und/oder -höchstwert
					$custom['collect'] = preg_replace('/[\W]/', '-', $custom['collect']);
					$diagramm[$custom['ise_id']][$custom['collect']][$history] = add_diagramm($custom);
					echo '- hole '.$custom['ise_id'].' für Ermittlung '.$custom['collect'].'-Wert'.PHP_EOL;
				}
				else {
					echo '- '.$custom['collect'].' für '.$custom['ise_id'].' '.$history.' kann nicht interpretiert werden'.PHP_EOL;
					continue;
				}

				// Datenpunkte sammeln
				// Mehrere ise_id einer Definition vereinzeln, damit alle Werte bei der CCU abgefragt werden
				// Erklärung: Wenn Datenpunkte als Array an die api_state in der interface.php übergeben, trennt diese nicht mehr nach Trennzeichen.
				if (strpos($custom['ise_id'], '-')) {
					$split = explode('-', $custom['ise_id']);
					if (!empty($_verbose)) echo 'v  trenne '.$custom['ise_id'].', '.count($split).' Datenpunkte: '.implode(' ', $split).PHP_EOL;
					$combine[$custom['ise_id']] = $split;		// damit nachher wieder zusammengesetzt werden kann
					$datapoints = array_merge($datapoints, $split);
				} else {
					$datapoints[] = $custom['ise_id'];
				}

			}
		}
	}
}

if (!empty($_verbose)) echo 'v  gefundene Indizes "'.implode('", "', array_keys($diagramm)).'"'.PHP_EOL;

$datapoints = array_unique($datapoints);
if (!empty($_verbose)) echo 'v  abzufragende Datenpunkte '.implode(', ', $datapoints).PHP_EOL;

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
	$values[$ise_id] = $value;
	echo '- Wert: '.strval($ise_id).' = '.strval($value).PHP_EOL;
}

// Werte für Mehrfach-Diagramme zusammensetzen
if (count($combine)) {
	foreach ($combine as $ise_id => $multiple) {
		if (!empty($_verbose)) echo 'v  setze '.$ise_id.' zusammen'.PHP_EOL;
		$join = array();
		foreach ($multiple as $datapoint) {
			if (!isset($values[$datapoint])) {
				echo '! Datenpunkt '.$datapoint.' in CCU-Antwort nicht gefunden'.PHP_EOL;
				continue;
			}
			$join[] = $values[$datapoint];
		}
		$values[$ise_id] = $join;
		if (!empty($_verbose)) echo 'v  '.implode(', ', $values[$ise_id]).PHP_EOL;
	}
}

function precision($values, $precision = 1) {
// Numerische Werte in Dezimalzahl mit <precision> Nachkommastellen formatieren
	global $_verbose;

	if (is_array($values)) {
		foreach ($values as $key => $value) {
			if (!empty($_verbose)) echo 'v  formatiere '.$values[$key].' in ';
			if (is_numeric($value)) $values[$key] = ( $precision ? number_format(floatval($values[$key]), $precision, '.', '') : intval($values[$key]) );
			if (!empty($_verbose)) echo $values[$key].PHP_EOL;
		}
	}
	elseif (is_numeric($values)) {
		if (!empty($_verbose)) echo 'v  formatiere '.$values.' in ';
		$values = ( $precision ? number_format(floatval($values), $precision, '.', '') : intval($values) );
		if (!empty($_verbose)) echo $values.PHP_EOL;
	}

	return $values;
}

foreach ($diagramm as $ise_id => $collects) {
	if (isset($values[$ise_id])) {
	// Datenpunkt nur verarbeiten, wenn Wert von CCU vorhanden ist

		foreach ($collects as $collect => $histories) {
			foreach ($histories as $history => $arr) {
			// Einzelne Dateie je <collect> und <history> schreiben
				if (!empty($_verbose)) echo 'v  verarbeite '.$ise_id.', collect '.$collect.', history '.$history.PHP_EOL;

				$write[$ise_id] = precision($values[$ise_id], $arr['precision']);
				$write[$ise_id] = ( is_array($write[$ise_id]) ? implode(';', $write[$ise_id]) : $write[$ise_id] );
				if (!empty($_verbose)) echo 'v  CCU Werte '.strval($write[$ise_id]).PHP_EOL;

				// Prefix für Beschriftung X-Achse
				if (preg_match('/^\d+:\d+/', $collect)) $prefix = $tage[date('w')].' '.date('d.m.');
				elseif (preg_match('/(min|max)/i', $collect)) $prefix = $tage[date('w')].' '.date('d.m.');
				else $prefix = $tage[date('w')].' '.date('H:i');
				if (!empty($_verbose)) echo 'v  Datensatz-Prefix '.($prefix).PHP_EOL;

				$cfile = __DIR__.'/cache/diagramm_'.( $arr['type']=='diagramm_test' ? 'test_' : '' ).$ise_id.'_'.preg_replace('/\W/', '-', $collect).'_'.$history.'.csv';

				if (file_exists($cfile)) {
				// cache Datei ist vorhanden

					$csv = file($cfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					echo '- '.basename($cfile).' hat '.count($csv).' Zeilen, maximal '.$history.PHP_EOL;

					// Array auf maximal <history> Werte kürzen
					while (count($csv) >= $history) array_shift($csv);

					if (preg_match_all('/(min|max)/i', $collect, $minmax, PREG_PATTERN_ORDER)) {
					// letzten Wert für Min/Max auslesen, Element überschreiben
						if (count($csv)) {
							$last = explode(';', rtrim($csv[count($csv)-1], ';'));
							if ($last[0] == $prefix) {
							// gleicher Tag wie letzter Wert => überschreiben
								array_shift($last);
								if (count($minmax[0]) == 2) {
								// min und max
									// min() von aktuellem Wert und erstem Wert der letzten Zeile, max() von aktuellm Wert und zweitem Wert der letzten Zeile
									$write[$ise_id] = array();
									foreach (( is_array($values[$ise_id]) ? $combine[$ise_id] : array($ise_id) ) as $key => $m_ise_id) {
										$write[$ise_id][] = min(floatval($values[$m_ise_id]), $last[($key * 2)]);
										$write[$ise_id][] = max(floatval($values[$m_ise_id]), $last[(($key * 2) + 1)]);
										if (!empty($_verbose)) echo 'v  '.$ise_id.' '.$collect.' '.$m_ise_id.' letzte Werte '.$last[($key * 2)].' '.$last[(($key * 2) + 1)].', aktueller Wert '.$values[$m_ise_id].PHP_EOL;
									}
									$write[$ise_id] = precision($write[$ise_id], $arr['precision']);
									$write[$ise_id] = implode(';', $write[$ise_id]);
									if ($write[$ise_id] == implode(';', $last)) {
										echo '- überspringe '.$collect.' '.$ise_id.' '.$history.', Werte sind unverändert '.str_replace(';', ' / ', $write[$ise_id]).PHP_EOL;
										continue;
									}
									array_pop($csv);
									echo '- '.$collect.'-Werte '.$ise_id.' '.$history.' alt '.implode(' / ', $last).' neu '.str_replace(';', ' / ', $write[$ise_id]).PHP_EOL;
								} else {
								// nur min oder max
									// min() bzw. max() von aktuellen Werten und Werten der letzten Zeile
									$m_value = array();
									foreach (( is_array($values[$ise_id]) ? $combine[$ise_id] : array($ise_id) ) as $key => $m_ise_id) {
										$m_value[] = precision(( preg_match('/min/i', $collect) ? min(floatval($values[$m_ise_id]), $last[$key]) : max(floatval($values[$m_ise_id]), $last[$key]) ), $arr['precision']);
										if (!empty($_verbose)) echo 'v  '.$ise_id.' '.$collect.' '.$m_ise_id.' letzter Wert '.$last[$key].', aktueller Wert '.$values[$m_ise_id].PHP_EOL;
									}
									$write[$ise_id] = implode(';', $m_value);
									if ($write[$ise_id] == implode(';', $last)) {
										echo '- überspringe '.$collect.' '.$ise_id.' '.$history.', Wert ist unverändert '.str_replace(';', ' / ', $write[$ise_id]).PHP_EOL;
										continue;
									}
									array_pop($csv);
									echo '- '.$collect.'-Wert '.$ise_id.' '.$history.' alt '.implode(' / ', $last).' neu '.str_replace(';', ' / ', $write[$ise_id]).PHP_EOL;
								}
							} else {
							// Neuer Tag, neue Zeile mit Werten anhängen. Für min+max aktuellen Wert als Min und Max aneinanderreihen.
								if (count($minmax[0]) == 2) {
									$m_value = '';
									foreach (( is_array($values[$ise_id]) ? $combine[$ise_id] : array($ise_id) ) as $m_ise_id) {
										$m_value .= str_repeat(precision(floatval($values[$m_ise_id]), $arr['precision']).';', 2);
									}
									$write[$ise_id] = rtrim($m_value, ';');
								}
								echo '- '.$collect.' '.$ise_id.' '.$history.', beginne neuen Tag mit '.str_replace(';', ' / ', $write[$ise_id]).PHP_EOL;
							}
						}
					}

					// Letzten gespeicherten Wert auslesen, überspringen falls unverändert
					elseif (!empty($arr['only_changed'])) {
						if (count($csv)) {

							$last = explode(';', rtrim($csv[count($csv)-1], ';'), 2);
							if ($last[1] == $write[$ise_id]) {
								echo '- überspringe '.$ise_id.' '.$collect.' '.$history.', Wert ist unverändert '.$write[$ise_id].'.'.PHP_EOL;
								continue;
							}

						}
					}

					// Tagesdatum statt Uhrzeit schreiben bei <collect> größer als 2h und Aufbewahrung länger als 7 Tage, wenn erster Wert eines neuen Tages
					if (preg_match('/^\d+$/',$collect) and ($collect >= 120) and ($history * $collect >= 7 * 24 * 60)) {
						if (date('Ymd', filemtime($cfile)) < date('Ymd')) $prefix = $tage[date('w')].' '.date('d.m.');
					}

				} else {
				// cache Datei nicht vorhanden, anlegen und Schreirechte setzen

					echo '- '.basename($cfile).' nicht vorhanden'.PHP_EOL;

					// Prüfen, ob es eine cache Datei in altem Dateinamenformat (diagramm_<ise_id>_<history>.csv) gibt
					$oldfile = __DIR__.'/cache/diagramm_'.$ise_id.'_'.$history.'.csv';
					if (file_exists($oldfile)) {
					// alte Datei vorhanden, Inhalt einlesen und Datei löschen
						echo '- Verschiebe Daten von '.basename($oldfile).' nach '.basename($cfile).PHP_EOL;
						$csv = file($oldfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						if (empty($_dryrun)) unlink($oldfile);
					}
					else {

						// Prüfen, ob es eine cache Datei mit anderem collect/history gibt, die nicht mehr verwendet wird
						$oldfile = glob(__DIR__.'/cache/diagramm_'.$ise_id.'_*.csv');
						if (count($oldfile) == 1) {
						// genau eine alte Datei gefunden
							if (preg_match('/diagramm_[\d\-]+_([\w\-]+)_(\d+)/', basename($oldfile[0]), $old)) {
								echo '- alte cache Datei gefunden mit collect '.$old[1].', history '.$old[2].PHP_EOL;
								foreach ($diagramm_custom[$ise_id] as $active_collect => $active_histories) {
									foreach ($active_histories as $active_history => $active_array) {
										echo '- aktives Diagramm für '.$ise_id.': collect '.$active_collect.', history '.$active_history.PHP_EOL;
										if (($old[1] == preg_replace('/\W/', '-', $active_collect)) and ($old[2] == $active_history)) {
											echo '- '.basename($oldfile[0]).' wird noch verwendet'.PHP_EOL;
											unset($oldfile[0]);
											break;
										}
									}
									if (empty($oldfile[0])) break;
								}
								if (!empty($oldfile[0])) {
									// keine Verwendung mehr, Inhalt einlesen und Datei löschen
									echo '- Verschiebe Daten von '.basename($oldfile[0]).' nach '.basename($cfile).PHP_EOL;
									$csv = file($oldfile[0], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
									if (!empty($_verbose)) echo 'v  '.count($csv).' Zeilen übertragen'.PHP_EOL;
									if (empty($_dryrun)) unlink($oldfile[0]);
								}
							}
						}

					}

					// keine Daten, leeres Array erzeugen und Datei anlegen
					if (empty($csv)) $csv = array();

					// Datei anlegen
					if (empty($_dryrun)) {
						touch($cfile);
						if (!chmod($cfile, 0666)) echo 'Fehler beim setzen der Schreibrechte für '.$cfile.PHP_EOL;
					}

					// Wert doppeln bei min+max, damit die neue Datei zwei Werte hat
					if (preg_match('/min/i', $collect) and preg_match('/max/i', $collect)) {
						$m_value = '';
						foreach (( !empty($combine[$ise_id]) ? $combine[$ise_id] : array($ise_id) ) as $m_ise_id) {
							$m_value .= str_repeat(precision(floatval($values[$m_ise_id]), $arr['precision']).';', 2);
						}
						$write[$ise_id] = rtrim($m_value, ';');
					}

					// Tagesdatum statt Uhrzeit schreiben bei <collect> größer als 2h und Aufbewahrung länger als 7 Tage, wenn erster Wert eines neuen Tages
					if (preg_match('/^\d+$/',$collect) and ($collect > 120) and ($history * $collect > 7 * 24 * 60)) {
						$prefix = $tage[date('w')].' '.date('d.m.');
					}

				}

				$csv[] = $prefix.';'.$write[$ise_id].';';
				echo '- schreibe '.$prefix.' = '.$write[$ise_id].' nach '.basename($cfile).PHP_EOL;
				if (empty($_dryrun)) file_put_contents($cfile, implode("\n", $csv));
				unset($csv);

			}
		}

	}

}

echo 'Fertig.'.PHP_EOL.PHP_EOL;

if (php_sapi_name() != "cli") echo '</pre>'.PHP_EOL;

?>
