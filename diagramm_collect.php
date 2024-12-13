<?php 

// Eintrag in Crontab
//
// Sofern kein PHP-CLI zur Verfügung steht:
// */1 * * * * curl --silent http://localhost/homehub/diagramm_collect.php >/dev/null 2>&1
//
// mit PHP-CLI
// */1 * * * * /usr/bin/php -f /pfad-zu-homehub/diagramm_collect.php >/dev/null 2>&1


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

require_once(__DIR__.'/interface.php');


date_default_timezone_set("Europe/Berlin");
$tage = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");


// Lese aus custom.json die diagramm ise_id welche geloggt werden sollen
#$data = file_get_contents(__DIR__.'/config/custom.json');
$data = read_config(__DIR__.'/config/custom.json');
$json = json_decode($data, true);


// damit der zweite cron keine zeitangabe in den diagrammen erzeugt.
$Zeit = date("s",time());

echo "Uhrzeit: ".date("H",time()).":".date("i",time()).":".$Zeit;
echo "<br>";
$MinuteDesTages = (date("H",time()) * 60) + date("i",time());
echo "Minute des Tages: ".$MinuteDesTages;
echo "<br>";

foreach($json['custom'] as $custom) 
{
  foreach($custom as $custom2)
  {
	if(isset($custom2['component']))
	{
	////
    if($custom2['component'] == "diagramm" OR $custom2['component'] == "diagramm_eckig" OR $custom2['component'] == "mdiagramm")
    {
      if(!isset($custom2['collect'])) 
      {
        $custom2['collect'] = "5";
      }
      if ($MinuteDesTages % $custom2['collect'] == 0) 
      {
        // damit der zweite cron keine zeitangabe in den diagrammen erzeugt.
        if ($Zeit[0] == "0")
        {
          $diagramm = @$diagramm.$custom2['ise_id'].",";
          echo "-a: ".$diagramm."<br>";
          // Speicherdauer der Komponente auslesen, ansonsten Standard
          if(isset($custom2['history'])) 
          {
            $diagramm_history = @$diagramm_history.$custom2['history'].",";
          }
          else
          {
            $diagramm_history = $diagramm_history."200,";
          }			
          echo "-b: ".$diagramm_history."<br>";					
        }
      }
    }
    elseif(@$custom2['component'] == "diagramm_change")
    {
      if(!isset($custom2['collect'])) 
      {
        $custom2['collect'] = "1";
      }
      if ($MinuteDesTages % $custom2['collect'] == 0) 
      {
        // damit der zweite cron keine zeitangabe in den diagrammen erzeugt.
        if ($Zeit[0] == "0")
        {
          $diagramm_change = @$diagramm_change.$custom2['ise_id'].",";
          echo "-c: ".$diagramm_change."<br>";
          // Speicherdauer der Komponente auslesen, ansonsten Standard
          if(isset($custom2['history'])) 
          {
            $diagramm_change_history = @$diagramm_change_history.$custom2['history'].",";
          }
          else
          {
            $diagramm_change_history = $diagramm_change_history."20,";
          }
          echo "-d: ".$diagramm_change_history."<br>";
        }
      }
      else
      {
        echo "Für: ".@$diagramm_change.$custom2['ise_id']." muss nicht gesammelt werden, da nicht im Zeitabschnitt ".$custom2['collect'];
      }
    }
    else
    {
      // keine gewünschte Komponente
    }
	////
	}
  }
}



// Diagramm_Change
if(isset($diagramm_change))
{
  // Speicherdauer in Array
  $history = explode(",",$diagramm_change_history);
  $historyZaehler = 0;
	
  // Abfrage an die CCU
  $xml = simplexml_load_string(api_state($ccu, $diagramm_change, true));
	echo $xml;
  foreach ( $xml->datapoint as $states )  
  {  
    $inhalt = "";
	unset($last);
	
    echo '<br><b>Id: ' . $states['ise_id'] . ' mit Wert '.$states['value'].'</b><br>';
		
    // Setze Wert mit . in Wert mit , um
    if(strpos($states['value'],".")!==false)
    {
      $x = explode(".", $states['value']);
      $states['value'] = $x[0].'.'.substr($x[1],0,1);
    }
	
    if(file_exists(__DIR__."/cache/diagramm_change_".$states['ise_id']."_".$history[$historyZaehler].".csv"))
	{
      // Lese Datei in Array
      $lines = file(__DIR__."/cache/diagramm_change_".$states['ise_id']."_".$history[$historyZaehler].".csv");

      // Sortiere alte Einträge aus	
      if(count((array)$lines)>= $history[$historyZaehler])
      {
        $Startbei = (count((array)$lines) - $history[$historyZaehler]);
      }
      else
      {
        $Startbei = 0;
      }
      echo "<br>Starte Bereinigung , daher Werte ab: ".$Startbei." - [History -> ".$history[$historyZaehler]."]<br>";
	
      for($i=0;$i < count((array)$lines); $i++)
      {
        if($i >= $Startbei)
        {
          $inhalt = $inhalt.$lines[$i];
          $last = $lines[$i];
        }
	  }

      if(isset($last))
      {


        $lastexploded =  explode(";", trim($last));
        if($lastexploded[1] != $states['value'])
        {
          // Schreiben
          $inhalt = $inhalt.$tage[date("w")]." ".date("H:i",time()).";".$states['value']."\n";
          $file_handle = fopen(__DIR__."/cache/diagramm_change_".$states['ise_id']."_".$history[$historyZaehler].".csv", 'w+');
          fwrite($file_handle, $inhalt);
          fclose($file_handle);
        }
        else
        {
          echo "<br>WERT gleich<br>";
        }
      }
      else
      {
        // Schreiben
        $inhalt = $inhalt.$tage[date("w")]." ".date("H:i",time()).";".$states['value']."\n";
        $file_handle = fopen(__DIR__."/cache/diagramm_change_".$states['ise_id']."_".$history[$historyZaehler].".csv", 'w+');
        fwrite($file_handle, $inhalt);
        fclose($file_handle);
      }
    }
    $historyZaehler++;
  }
}


if(isset($diagramm))
{
  // Speicherdauer in Array
  $history = explode(",",$diagramm_history);
  $historyZaehler = 0;
	
  // Abfrage an die CCU
  $xml = simplexml_load_string(api_state($ccu, $diagramm, true));
  echo $xml;
  foreach ($xml->datapoint as $states)  
  {  
    $inhalt = "";
	unset($last);
    echo '<br><b>Id: ' . $states['ise_id'] . ' mit Wert '.$states['value'].'</b><br>';
		
    // Setze Wert mit . in Wert mit , um
	
	
	$Value = explode(";",$states['value']);
	$states['value'] = "";
	
	foreach ($Value as $ValueEntry)
	{
		
		if(strpos($ValueEntry,".")!==false)
		{
			$x = explode(".", $ValueEntry);
			$ValueEntry = $x[0].'.'.substr($x[1],0,1);
		}
		$states['value'] = $states['value'] . $ValueEntry.";";
		
	}
    
	
	
    if(file_exists(__DIR__."/cache/diagramm_".$states['ise_id']."_".$history[$historyZaehler].".csv"))
	{
      // Lese Datei in Array
      $lines = file(__DIR__."/cache/diagramm_".$states['ise_id']."_".$history[$historyZaehler].".csv");

      // Sortiere alte Einträge aus	
      if(count((array)$lines)>= $history[$historyZaehler])
      {
        $Startbei = (count((array)$lines) - $history[$historyZaehler]);
      }
      else
      {
        $Startbei = 0;
      }
      echo "<br>Starte Bereinigung , daher Werte ab: ".$Startbei." - [History -> ".$history[$historyZaehler]."]<br>";
      for($i=0;$i < count((array)$lines); $i++)
      {
        if($i >= $Startbei)
        {
          $inhalt = $inhalt.$lines[$i];
        }
      }
	}
    if(date("i",time()) == "00")
    {
      $inhalt = $inhalt.date("H:i",time()).";".$states['value']."\n";	
    }
    else
    {
      $inhalt = $inhalt.date("H:i",time()).";".$states['value']."\n";	
    }
    $file_handle = fopen(__DIR__."/cache/diagramm_".$states['ise_id']."_".$history[$historyZaehler].".csv", 'w+');
    fwrite($file_handle, $inhalt);
    fclose($file_handle);
    $historyZaehler++;
  }
}
echo "Ende";

?>
