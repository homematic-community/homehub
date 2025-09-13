<?php
setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'deu_deu');






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
function ical_calendar($component) 
{
  $modalId = mt_rand();
	
  if(isset($component["aufgeklappt"])) {
    if($component["aufgeklappt"] == "1") {
	  $aufgeklappt = "collapsed";
	} else {
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
		  .'<div data-toggle="collapse" data-target="#' . $modalId . '" style="display:flow-root;" class="collapsed">'
           .'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</div>'
  		  .'</div>'
         .'<div class="hh2 '.$aufgeklappt.'" id="' . $modalId . '"></div>'
       .'</div>
	     <script type="text/javascript">

         $.ajax({
           url: "custom/components/ical_calendar.php?url='.urlencode($component["url"]).'&tage='.$component["tage"].'&beschreibung='.$component["beschreibung"].'",
           success: function(data) {
	         $("#' . $modalId . '").html("" + data);
           }
         });
         </script>';
}











 

// Wenn Parameter uebergeben werden, dann wird nachgeladen
if(isset($_GET['url']) AND isset($_GET['tage']) AND isset($_GET['beschreibung']))
{
	
  $calender_cache = "../../cache/ical_calender_".md5($_GET['url']).".txt";
  
  // Fenn Cachedatei keine Stunde alt ist nimm diese
  if(file_Exists($calender_cache) AND !isset($_GET['debug']))
  {
    if(date("ymdh",filemtime($calender_cache)) == date("ymdh"))
    {
	  echo file_get_contents($calender_cache);
	  exit();
	}
  }	   

  
  $contentall = "";
  $tage = $_GET['tage'];
  $url = $_GET['url'];
  $urls = explode(";",$url);
  
  // Sammle alle ICS-Dateiinhalte
  foreach ($urls as $url) 
  {
	if(isset($_GET['debug'])) { echo $url."<br><br>"; }
    $beschreibung = $_GET['beschreibung']; 
    $cachedatei = "../../cache/".md5($url).".txt";
  
    if(file_Exists($cachedatei))
    {
      // Wenn ICAL Datei keine Stunde alt ist nimm diese
      if(date("ymdh",filemtime($cachedatei)) == date("ymdh",time()))
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
	if(isset($_GET['debug'])) { echo "<br><br><hr>".$result[0][$i]."<hr>"; }
	// trenne die Zeilen
    $tmpbyline = explode("\n", $result[0][$i]);
    // gernerie Array
	foreach ($tmpbyline as $item) 
	{
	  if(isset($_GET['debug'])) { echo $item."<br>"; }
      $tmpholderarray = explode(":",rtrim($item));
      if (count($tmpholderarray) >1) 
	  {
        
		if(isset($tmpholderarray[1])) { $majorarray[$tmpholderarray[0]] = $tmpholderarray[1]; }
		if(isset($tmpholderarray[2])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[2]; }
		if(isset($tmpholderarray[3])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[3]; }
		if(isset($tmpholderarray[4])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[4]; }
		if(isset($tmpholderarray[5])) { $majorarray[$tmpholderarray[0]] = $majorarray[$tmpholderarray[0]].$tmpholderarray[5]; }
      }
  
    }
	

	// Beschreibungstext anpassen falls vorhanden
    if (preg_match('/DESCRIPTION:(.*)END:VEVENT/si', $result[0][$i], $regs)) 
	{
      $majorarray['DESCRIPTION'] = str_replace("  ", " ", str_replace("\r\n", "", $regs[1]));
    }

	
 	// Damit Werte gefüllt sind
	
	
	foreach ($majorarray as $key => $value) {
		if(isset($_GET['debug'])) { echo "<hr>###Schlüssel: ".$key." => Wert: ".$value."<br>"; }
	  if (substr($key, 0, 7) == "DTSTART")
	  {
		
		$majorarray['DTSTART'] = $value;
	  }
		
      
	}

	
	if(Isset($majorarray['DTSTART;VALUE=DATE'])) { $majorarray['DTSTART'] = $majorarray['DTSTART;VALUE=DATE']; }	
	if(Isset($majorarray['DTSTART;TZID=Europe/Berlin'])) { $majorarray['DTSTART'] = $majorarray['DTSTART;TZID=Europe/Berlin']; }
	if(Isset($majorarray['DTSTART;TZID=Africa/Ceuta'])) { $majorarray['DTSTART'] = $majorarray['DTSTART;TZID=Africa/Ceuta']; }
	
	
	
	if(Isset($majorarray['DTEND;VALUE=DATE'])) { $majorarray['DTEND'] = $majorarray['DTEND;VALUE=DATE']; }
	if(Isset($majorarray['DTEND;TZID=Europe/Berlin'])) { $majorarray['DTEND'] = $majorarray['DTEND;TZID=Europe/Berlin']; }
    if(Isset($majorarray['DTEND;TZID=Africa/Ceuta'])) { $majorarray['DTEND'] = $majorarray['DTSTART;TZID=Africa/Ceuta']; }
	
	// Damit DTEND;VALUE=DATE korrekt umgesetzt
	if(Isset($majorarray['DTSTART']))		
	{
	
      if (strpos($majorarray['DTSTART'], "Z") !== false)
	  { 
		$majorarray['DTSTART'] = str_replace("Z", "", $majorarray['DTSTART']);
	    $utc_time_string =  substr($majorarray['DTSTART'], 0, 4).'-'.substr($majorarray['DTSTART'], 4, 2).'-'.substr($majorarray['DTSTART'], 6, 2).' '.substr($majorarray['DTSTART'], 9, 2).':'.substr($majorarray['DTSTART'], 11, 2).':'.substr($majorarray['DTSTART'], 13, 2);
	    $utc_datetime = new DateTime($utc_time_string, new DateTimeZone('UTC'));
	    $mez_datetime = $utc_datetime->setTimezone(new DateTimeZone('Europe/Berlin')); // Berlin is a common MEZ timezone
	    $mez_time = $mez_datetime->format('YmdHis');
		$majorarray['DTSTART'] = $mez_time;
	  }
	  $majorarray['DTSTART'] = str_replace("T", "", $majorarray['DTSTART']);	  
	  $majorarray['DTSTART'] = str_pad($majorarray['DTSTART'],14,"0");
	}
	
	if(Isset($majorarray['DTEND']))		
	{
		if (strpos($majorarray['DTEND'], "Z") !== false)
		{ 
          $majorarray['DTEND'] = str_replace("Z", "", $majorarray['DTEND']);
	      $utc_time_string =  substr($majorarray['DTEND'], 0, 4).'-'.substr($majorarray['DTEND'], 4, 2).'-'.substr($majorarray['DTEND'], 6, 2).' '.substr($majorarray['DTEND'], 9, 2).':'.substr($majorarray['DTEND'], 11, 2).':'.substr($majorarray['DTEND'], 13, 2);
	      $utc_datetime = new DateTime($utc_time_string, new DateTimeZone('UTC'));
	      $mez_datetime = $utc_datetime->setTimezone(new DateTimeZone('Europe/Berlin')); // Berlin is a common MEZ timezone
	      $mez_time = $mez_datetime->format('YmdHis');
          $majorarray['DTEND'] = $mez_time;
		}
		$majorarray['DTEND'] = str_replace("T", "", $majorarray['DTEND']);
		$majorarray['DTEND'] = str_replace(" ", "", $majorarray['DTEND']);
		$majorarray['DTEND'] = str_pad($majorarray['DTEND'],14,"0");
	}
	
	// Filtere Zeichen
	$majorarray['SUMMARY'] = str_replace("()", "", $majorarray['SUMMARY']);
	$majorarray['SUMMARY'] = str_replace('\\', "", $majorarray['SUMMARY']);
	
	if(!isset($majorarray['DTEND'])) { $majorarray['DTEND'] = $majorarray['DTSTART'];  
	//echo $majorarray['SUMMARY']."setze dtend ".str_pad(date("Ymd", strtotime("+1 day")),14,"0")."<br>";
	}
	if(isset($majorarray['DTSTART']) AND isset($majorarray['DTEND']))
	{
		
	  // Wiederkehrende Termine ausrechnen
	  $z = 0;
	  if(Isset($majorarray['RRULE']))
	  {
		
	      while($majorarray['DTEND'] <= date("YmdHis", strtotime("+".$tage." day")))
		  {
			
			

		
	        if(isset($_GET['debug'])) {
			echo "<hr>Ende: ".$majorarray['DTEND'];
			echo "<br>Aktuelles + x Tage: ".date("YmdHis", strtotime("+".$tage." day"));
			echo "<br>DT Start erste 8: ".substr($majorarray['DTSTART'], 0, 8);
			echo "<br>DT Ende erste 8: ".substr($majorarray['DTEND'], 0, 8);
            }

            // Ende Datum beachten - Datum
			$EndDate = explode("UNTIL=",$majorarray['RRULE']);
		    if(isset($EndDate[1]))
			{
				$EndDate = explode(";",$EndDate[1]);
				
				$EndDate[0] = str_replace("T", "", $EndDate[0]);
				$EndDate[0] = str_replace("Z", "", $EndDate[0]);
				if(isset($_GET['debug'])) {echo "<br>wenn ".$EndDate[0]." größer als ".$majorarray['DTEND']; }
				if($EndDate[0] <= $majorarray['DTEND'])
				{
					if(isset($_GET['debug'])) {echo "<hr>#ö#<hr><br>EndeDatum".$EndDate[0]; }
					if(isset($_GET['debug'])) {echo "<hr><br>".date("YmdHis")."<hr>"; }
					break;
				}
			}
            // Ende Datum beachten - Count
			$EndDate = explode("COUNT=",$majorarray['RRULE']);
		    if(isset($EndDate[1]))
			{
				
				$EndDate = explode(";",$EndDate[1]);
				if(isset($_GET['debug'])) {echo "<br>wenn ".$EndDate[0]." größer als ".$z; }
				if($EndDate[0] <= $z)
				{
					if(isset($_GET['debug'])) {echo "<hr>Count erreicht<hr><br>".$z; }

					break;
				}
			}
			
			
			// Intervall
			$Interval = explode("INTERVAL=",$majorarray['RRULE']);
		    if(isset($Interval[1]))
			{
				$Interval = explode(";",$Interval[1]);
				if(isset($_GET['debug'])) {echo "<hr>Interval<hr><br>".$Interval[0]; }
				$Interval = $Interval[0];
			}
			else
			{
				$Interval = "1";
			}
			
			

            if($majorarray['DTSTART'] >= date("YmdHis")) 
	        {
		      // Alle Events die maximal 7 Tage älter sind.
		      //if(substr($majorarray['DTSTART'], 0, 8) <= date("Ymd", strtotime("+".$tage." day")))
		      if($majorarray['DTSTART'] <= date("YmdHis", strtotime("+".$tage." day")))
		      {
			    $events[] = $majorarray;
		      }
	        }
	        else if(substr($majorarray['DTSTART'], 0, 8) <= date("Ymd") AND substr($majorarray['DTEND'], 0, 8) >= date("Ymd", strtotime("+1 day"))) 
	        {
		      $events[] = $majorarray;
  	        }
	        else
	        {
		
	        }
			
			
	  
	        if(strpos($majorarray['RRULE'], "YEARLY") !== false)
		    {
		  	  $majorarray['DTSTART'] = date('YmdHis', (strtotime($majorarray['DTSTART'])+(31536000*$Interval)));
			  if(isset($_GET['debug'])) { echo "<br>".$majorarray['DTSTART']; }
			  $majorarray['DTEND'] = date('YmdHis', (strtotime($majorarray['DTEND'])+(31536000*$Interval)));
			  if(isset($_GET['debug'])) { echo "<br>".$majorarray['DTEND']; }
		    }
			
		    else if(strpos($majorarray['RRULE'], "DAILY") !== false)
		    {
				
			  $majorarray['DTSTART'] = date('YmdHis', (strtotime($majorarray['DTSTART'])+(86400*$Interval)));
			  if(isset($_GET['debug'])) { echo "<br>a".$majorarray['DTSTART'];}
			  $majorarray['DTEND'] = date('YmdHis', (strtotime($majorarray['DTEND'])+(86400*$Interval)));
			  if(isset($_GET['debug'])) { echo "<br>b".$majorarray['DTEND']; }
		    }
		    else if(strpos($majorarray['RRULE'], "WEEKLY") !== false)
		    {
			  $majorarray['DTSTART'] = date('YmdHis', (strtotime($majorarray['DTSTART'])+(604800*$Interval)));
			  if(isset($_GET['debug'])) { echo "<br>a".$majorarray['DTSTART']; }
			  $majorarray['DTEND'] = date('YmdHis', (strtotime($majorarray['DTEND'])+(604800**$Interval)));
			  if(isset($_GET['debug'])) { echo "<br>b".$majorarray['DTEND']; }
		    }			
			else
			{
			  break;
			}
			
			$z++;
			unset($interval);
		  }
	
	  
	  }
	  else
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
	    {
	  	  $events[] = $majorarray;
  	    }
	    else
	    {
	    }	
	  }
	}
	if(isset($_GET['debug'])) { print_r($majorarray); }
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
	
    unset($majorarray);
  }

  // Sortiere Events
  usort($events, function($a, $b) 
  {
    if (isset($a["DTSTART"]) && isset($b["DTSTART"])) {
      return strtotime($a["DTSTART"]) - strtotime($b["DTSTART"]);
    }
  }); 

  $tagtemp = "";
  $tagalt = "";
  $content_output = "";
  $content_output.= "<style>";
  $content_output.= ".icalcalendar tr td { padding:2px 10px 2px 0px;border:0px solid red;vertical-align: top;}";
  $content_output.= "</style>";
  $content_output.= "<table border='0' class='icalcalendar'>";
  $i = 1;   

  foreach($events as $event)
  {
    $content_output.= "<tr>";
    $now = date('Y-m-d H:i:s');//current date and time
    $eventdate = date('Y-m-d H:i:s', strtotime($event['DTSTART']));//user friendly date
	$tage = array("So","Mo","Di","Mi","Do","Fr","Sa");
			
	$tagalt = $tagtemp;
	$tagtemp = date('d.m.', strtotime($event['DTSTART']));
    if($tagalt == $tagtemp)
    {
      $tag = "";
      $wochentag = "";
    }
    else
    {
      $tag = date('d.m.', strtotime($event['DTSTART']));
      $wochentag =  $wochentag = $tage[date("w",strtotime($event['DTSTART']))];
    }
			
    if(substr($event['DTSTART'], 0, 8) < date("Ymd"))
    {
      $content_output.= '<td>seit</td><td>'.$tag.'</td><td>ganztags</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
    }
    else if(substr($event['DTSTART'], 0, 8) == date("Ymd") AND substr($event['DTSTART'], -6) == "000000")
    {
      $content_output.= '<td>heute</td><td>'.$tag.'</td><td>ganztags</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
    }
    else if(substr($event['DTSTART'], 0, 8) == date("Ymd"))
    {
      if(date('d.m.Y', strtotime($event['DTSTART'])) == date('d.m.Y', strtotime($event['DTEND'])))
      {
        $content_output.= '<td>heute</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' - '.date('H:i', strtotime($event['DTEND'])).'</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
      }
      else
      {
        $content_output.= '<td>heute</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' - '.date('d.m. H:i', strtotime($event['DTEND'])).'</td><td><span style="color:green;">'.$event['SUMMARY'].'</span></td>';
      }
    }
    else if(substr($event['DTSTART'], -6) == "000000")
    {
      $content_output.= "<td>".$wochentag."</td><td>".$tag.'</td><td>ganztags</td><td><span style="color:;">'.$event['SUMMARY'].'</span></td>';
    }			
    else
    {
      if (date('d.m', strtotime($event['DTSTART'])) == date('d.m', strtotime($event['DTEND'])))
      {
        $content_output.= '<td>'.$wochentag.'&nbsp;</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' bis '.date('H:i', strtotime($event['DTEND'])).'</td><td><span style="color:;">'.$event['SUMMARY'].'</span></td>';
      }
      else
      {
        $content_output.= '<td>'.$wochentag.'&nbsp;</td><td>'.$tag.'</td><td>'.date('H:i', strtotime($event['DTSTART'])).' bis '.date('d.m. H:i', strtotime($event['DTEND'])).'</td><td><span style="color:;">'.$event['SUMMARY'].'</span></td>';
      }
    }
    if($beschreibung == 1) 
	{ 
	  if(isset($event['DESCRIPTION']))
      {
        $content_output.= $event['DESCRIPTION']; 
      }		
    }
    $i++;
    $content_output.= "</tr>";
  }
  $content_output.= "</table>";
  
  // Scrheibe datei          
  $datei = fopen($calender_cache,"w+");
  fwrite($datei,$content_output); 
  fclose($datei);
  // Ausgabe
  echo $content_output;
}




?>

