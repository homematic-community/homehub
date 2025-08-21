<?php

/*
{
"component":"ical_calendar",
"name":"Familienkalender",
"icon":"time_calendar.png",
"url":"https://pfad-zur-ics.datei",
"aufgeklappt":"1",
"beschreibung":"0",
"tage":"8",
"height":"400px"
},		

// aufgeklappt	= 0 zugeklappt 1 aufgeklappt - standard 1
// height = höhe
// url - es können mehrere angegeben werden durch ; getrennt

Caching beträg ein Tag damit die Datei nicht zu oft von google geladen wird.
			
Den Link erhält ihr in der Weboberfläche von Google.
-> Mit dieser Adresse können Sie von anderen Anwendungen aus auf den Kalender zugreifen, ohne ihn öffentlich zu machen.

Siehe Datei: ical_calendar.png
*/


ini_set('display_errors', 'on');
function ical_calendar($component) {
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
	if (!isset($component['tage'])) $component['tage'] = '14';
	if (!isset($component['beschreibung'])) $component['tage'] = '0';
	return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
		. '<div data-toggle="collapse" data-target="#' . $modalId . '" style="display:flow-root;" class="collapsed">'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</div>'
        //    . '<div class="pull-right"></div>'
		.'</div>'
         . '<div class="hh2 '.$aufgeklappt.'" id="' . $modalId . '">'
        . '</div>'
    . '</div>
	<script type="text/javascript">
//function execute_ical_calendar_' . $modalId . '() {
  $.ajax({
    url: "custom/components/ical_calendar.php?url='.urlencode($component["url"]).'&tage='.$component["tage"].'&beschreibung='.$component["beschreibung"].'",
    success: function(data) {
	  $("#' . $modalId . '").html("" + data);
    }
  });
  //setTimeout(execute_Abfallkalender, 900000); // 15 Minuten
//}

//setTimeout(execute_ical_calendar_' . $modalId . ', 150);
</script>';
}






 




 


if(isset($_GET['url']) AND isset($_GET['tage']) AND isset($_GET['beschreibung']))
{
  $contentall = "";
  $tage = $_GET['tage'];
  $url = $_GET['url'];
  $urls = explode(";",$url);
  
  foreach ($urls as $url) {
	
	  //echo $url."<br>";


    $beschreibung = $_GET['beschreibung']; 

    $cachedatei = "../../cache/".md5($url).".txt";
	//echo $cachedatei."<br>";
  
    if(file_Exists($cachedatei))
    {
    // echo "Cachedatei existiert";
      if(date("d.m.Y",filemtime($cachedatei)) == date("d.m.Y",time()))
      {
	   // echo "Cachedatei wird genutzt";
	   $content = file_get_contents($cachedatei);
      }
	  else
	  {
		  $content = file_get_contents($url); 
	 if($content != "") 
	 { 
        $datei = fopen($cachedatei,"w+");
		fwrite($datei,$content); 
		fclose($datei);
	 
	 }
	  }
    }
	else
	{
		$content = file_get_contents($url); 
	 if($content != "") 
	 { 
        $datei = fopen($cachedatei,"w+");
		fwrite($datei,$content); 
		fclose($datei);
	 
	 }
	}
  
  
  
  


$contentall = $contentall."\r\n".$content;

}
	  // Ersetze Zeilenumbruch
	  $content = str_replace("\r\n ", "", $contentall);

  // Suche Events nach BEGIN und END
  preg_match_all('/(BEGIN:VEVENT.*?END:VEVENT)/si', $content, $result, PREG_PATTERN_ORDER);
  for ($i = 0; $i < count($result[0]); $i++) 
  {
	// trenne die Zeilen
    $tmpbyline = explode("\r\n", $result[0][$i]);
    // gernerie Array
	foreach ($tmpbyline as $item) 
	{
      $tmpholderarray = explode(":",$item);
      if (count($tmpholderarray) >1) 
	  {
        $majorarray[$tmpholderarray[0]] = $tmpholderarray[1];
		if(isset($tmpholderarray[2])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[2]; }
		if(isset($tmpholderarray[3])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[3]; }
		if(isset($tmpholderarray[4])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[4]; }
		if(isset($tmpholderarray[5])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[5]; }
      }
  
    }
	
	//print_r($majorarray);

	// Beschreibungstext anpassen falls vorhanden
    if (preg_match('/DESCRIPTION:(.*)END:VEVENT/si', $result[0][$i], $regs)) 
	{
      $majorarray['DESCRIPTION'] = str_replace("  ", " ", str_replace("\r\n", "", $regs[1]));
    }

	
 	// Damit Werte gefüllt sind
	if(Isset($majorarray['DTSTART;VALUE=DATE'])) { $majorarray['DTSTART'] = $majorarray['DTSTART;VALUE=DATE']; }
	if(Isset($majorarray['DTSTART;TZID=Europe/Berlin'])) { $majorarray['DTSTART'] = $majorarray['DTSTART;TZID=Europe/Berlin']; }
	
	
	if(Isset($majorarray['DTEND;VALUE=DATE'])) { $majorarray['DTEND'] = $majorarray['DTEND;VALUE=DATE']; }
	if(Isset($majorarray['DTEND;TZID=Europe/Berlin'])) { $majorarray['DTEND'] = $majorarray['DTEND;TZID=Europe/Berlin']; }

	// Damit DTEND;VALUE=DATE korrekt umgesetzt
	if(Isset($majorarray['DTSTART']))		
	{
		$majorarray['DTSTART'] = str_replace("Z", "", $majorarray['DTSTART']);
		$majorarray['DTSTART'] = str_replace("T", "", $majorarray['DTSTART']);
		$majorarray['DTSTART'] = str_pad($majorarray['DTSTART'],14,"0");
	}
	
	if(Isset($majorarray['DTEND']))		
	{
		$majorarray['DTEND'] = str_replace("Z", "", $majorarray['DTEND']);
		$majorarray['DTEND'] = str_replace("T", "", $majorarray['DTEND']);
		$majorarray['DTEND'] = str_pad($majorarray['DTEND'],14,"0");
	}
	
	$majorarray['SUMMARY'] = str_replace('\\', "", $majorarray['SUMMARY']);
	
	
	if(isset($_GET['debug'])) 
	{ 
	  echo "<hr>";
  	  echo "EndEvent ".substr($majorarray['DTEND'], 0, 8)."<br>";
	  echo "EndEvent ".$majorarray['DTEND']."<br>";	  
	  echo "5 tage + ".date("Ymd", strtotime("+".$tage." day"))."<br>"; 
	  echo "StartEvent ".substr($majorarray['DTSTART'], 0, 8)."<br>";
	  echo "StartEvent ".$majorarray['DTSTART']."<br>";
	  echo "aktuelles datum ".date("Ymd")."<br>";
	  if(isset($majorarray['DESCRIPTION'])) { echo $majorarray['DESCRIPTION']; }
	}
	
	// Filtere Zeichen
	$majorarray['SUMMARY'] = str_replace("()", "", $majorarray['SUMMARY']);
	
	if(!isset($majorarray['DTEND'])) { $majorarray['DTEND'] = $majorarray['DTSTART'];  
	//echo $majorarray['SUMMARY']."setze dtend ".str_pad(date("Ymd", strtotime("+1 day")),14,"0")."<br>";
	}
	if(isset($majorarray['DTSTART']) AND isset($majorarray['DTEND']))
	{
	  // Alle Events die neuer sind
	  //if(substr($majorarray['DTSTART'], 0, 8) >= date("Ymd")) 
	  if($majorarray['DTSTART'] >= date("YmdHis")) 
	  {
		// Alle Events die maximal 7 Tage älter sind.
		//if(substr($majorarray['DTSTART'], 0, 8) <= date("Ymd", strtotime("+".$tage." day")))
		if($majorarray['DTSTART'] <= date("YmdHis", strtotime("+".$tage." day")))
		{
			$events[] = $majorarray;
		}
	  }
	  // oder alle events deren Start vor oder am gleichen Tag war und nach oder am gleichen tag endet
	  else if(substr($majorarray['DTSTART'], 0, 8) <= date("Ymd") AND substr($majorarray['DTEND'], 0, 8) >= date("Ymd", strtotime("+1 day"))) 
	//	  else if($majorarray['DTSTART'] <= date("YmdHis") AND $majorarray['DTEND'] >= date("YmdHis", strtotime("+1 day"))) 
	  {
		$events[] = $majorarray;
		
  	  }
	  else
	  {
		
	  }
	}
	/*
	// Nur solche beachten die nicht vergangen sind	
	if(substr($majorarray['DTEND'], 0, 8) <= (date("Ymd", strtotime("+".$tage." day")))) 
	{
//AND (substr($majorarray['DTSTART'], 0, 8) <= date("Ymd"))) 
		$events[] = $majorarray;
		if(isset($_GET['debug'])) { print_r($majorarray); }
		echo "<hr>";
	}
	*/
	//$events[] = $majorarray;
//print_r($majorarray);
    unset($majorarray);
	
	//echo $majorarray['DTSTART']."<br>";
	//echo "<hr>".$majorarray['DTSTART']."<br>".$majorarray['DESCRIPTION'];
    //$icalarray[] = $majorarray;

  }
  
   
   
   
// if(isset($_GET['debug'])) { print_r($events); }
 
// if(isset($_GET['debug'])) { exit(); }
  //sort events into date order
  
  
usort($events, function($a, $b) {

    if (isset($a["DTSTART"]) && isset($b["DTSTART"])) {
        return strtotime($a["DTSTART"]) - strtotime($b["DTSTART"]);
    }
});


/*
// Feld 'name' extrahieren
$eventdaten = array_column($events, 'DTSTART');

// Nach dem Feld 'name' sortieren (aufsteigend)
array_multisort($eventdaten, SORT_ASC, $events);
*/
$tagtemp = "";
$tagalt = "";
echo "<style>";
echo ".icalcalendar tr td { padding:2px 10px 2px 0px;border:0px solid red;vertical-align: top;}";
echo "</style>";
echo "<table border='0' class='icalcalendar'>";
  $i = 1;   
  foreach($events as $event)
  {
	echo "<tr>";
    $now = date('Y-m-d H:i:s');//current date and time
	//$now = date('Y-m-d-m-Y H:i');//current date and time
    $eventdate = date('Y-m-d H:i:s', strtotime($event['DTSTART']));//user friendly date
	//$eventdate = date('d-m-Y H:i', strtotime($event['DTSTART']));//user friendly date

   // if($eventdate > $now)
	//{
	
      /*  echo "
            <div class='eventHolder'>
                <div class='eventDate'>$eventdate</div>
                <div class='eventTitle'>".$event['SUMMARY']."</div>
            </div>";*/
			$tage = array("So","Mo","Di","Mi","Do","Fr","Sa");
			if($i > 1)
			{
				//echo "<br>";
			}
			
			
			$tagalt = $tagtemp;
			$tagtemp = date('d.m.', strtotime($event['DTSTART']));
			if($tagalt == $tagtemp)
			{
				$tag = "";
				$wochentag = "";
			}
			else
			{
				$tag =date('d.m.', strtotime($event['DTSTART']));
				$wochentag =  $wochentag = $tage[date("w",strtotime($event['DTSTART']))];
			}
			
			if(substr($event['DTSTART'], 0, 8) < date("Ymd"))
			{
				
				echo '<td>seit</td><td>'.$tag.'</td><td>ganztags</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
			}
			else if(substr($event['DTSTART'], 0, 8) == date("Ymd") AND substr($event['DTSTART'], -6) == "000000")
			{

				echo '<td>heute</td>'.$tag.'<td><td>ganztags</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
			}
			else if(substr($event['DTSTART'], 0, 8) == date("Ymd"))
			{

				
	if(date('d.m.Y', strtotime($event['DTSTART'])) == date('d.m.Y', strtotime($event['DTEND'])))
				{
				  echo '<b>heute '.date('H:i', strtotime($event['DTSTART'])).' - '.date('H:i', strtotime($event['DTEND'])).' - <span style="color:green;">'.$event['SUMMARY'].'</span></b>';	
				echo '<td>heute</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' - '.date('H:i', strtotime($event['DTEND'])).'</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
				}
				else
				{
echo '<td>heute</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' - '.date('d.m. H:i', strtotime($event['DTEND'])).'</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
				}
			}
			else if(substr($event['DTSTART'], -6) == "000000")
			{

				echo "<td>".$wochentag."</td><td>".$tag.'</td><td>ganztags</td><td><span style="color:;">'.$event['SUMMARY'].'</span></td>';
			}			
			else
			{


				if (date('d.m', strtotime($event['DTSTART'])) == date('d.m', strtotime($event['DTEND'])))
				{
				//	echo date('d.m.  H:i', strtotime($event['DTSTART'])).' bis '.date('H:i', strtotime($event['DTEND'])).' - <span style="color:#4287f5;">'.$event['SUMMARY'].'</span>';
								echo '<td>'.$wochentag.'&nbsp;</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' bis '.date('H:i', strtotime($event['DTEND'])).'</td><td><span style="color:;">'.$event['SUMMARY'].'</span></td>';
				}
				else
				{
					//echo date('d.m.  H:i', strtotime($event['DTSTART'])).' bis '.date('d.m. H:i', strtotime($event['DTEND'])).' - <span style="color:#4287f5;">'.$event['SUMMARY'].'</span>';
					echo '<td>'.$wochentag.'&nbsp;</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' bis '.date('d.m. H:i', strtotime($event['DTEND'])).'</td><td><span style="color:;">'.$event['SUMMARY'].'</span></td>';
				}
				
			}
			if($beschreibung == 1) 
			{ 
				if(isset($event['DESCRIPTION']))
				{
					echo $event['DESCRIPTION']; 
				}		
			}
			/*
					//if(substr($majorarray['DTEND'], 0, 8) < date("Ymd")) { $majorarray['DTEND'] = date("Ymd"); }
			
			if(date('H:i', strtotime($event['DTSTART'])) == "00:00") { echo date('d-m-Y', strtotime($event['DTSTART']))." <span style='color:transparent;'>".date('H:i', strtotime($event['DTSTART']))."</span> - "; }
			else { echo date('d-m-Y H:i', strtotime($event['DTSTART']))." - "; }
				
			if(date('Y-m-d') == date('Y-m-d', strtotime($event['DTSTART']))) 
			{ echo '<span style="color:green;">'.$event['SUMMARY'].'</span>'; }
			else { echo $event['SUMMARY']; }
			*/

			$i++;

					
					
  //  }
  }
  echo "</tr>";
}
echo "</table>";





?>

