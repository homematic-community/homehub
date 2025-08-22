<?php

 // Script zur Abfrage der Anruferliste einer Fritzbox über das TR-064 Protokoll
 // zur Darstellung in dem Web Frontend HomeHub WebUI für HomeMatic-Komponenten:
 // https://homematic-forum.de/forum/viewtopic.php?f=41&t=76034&start=10#p741718
 // 27.02.2022 v1.3 erstellt und optimiert von TheGhost (Vielen Dank), 0m1d und Slice
 // Ergänzt 01.02.2024 v2 Steingarten, Namensanzeige, Übernahme in die custom.json
 // Danke an GNOM und PaulM
 // https://homematic-forum.de/forum/viewtopic.php?p=795301#p795301
 
 
 
/*
In der custom.json

{
"component":"Fritzbox2",
"name":"Fritzbox-Anruferliste",
"icon":"it_telephone.png",
"fritz_url":"192.x.x.x",
"fritz_pwd":"daskennwortdesusers",
"fritz_user":"deruser"
}

ggf.zusätzliche Zeilen übernehmen für die maximale Anzahl der sichtbaren Einträge (Standard 20) und eine Änderung der Standard-Farbwerte
sowie die Möglichkeit direkt aufgeklappt anzuzeigen:

"anzahl":"20",
"ausgehend":"#2E2EFE",
"verpasst":"#FF0040",
"eingehend":"#01DF01",
"blockiert":"#BDBDBD",
"ab":"#fc4103",
"aufgeklappt":"1"

*/
 
function appendRow($date, $type, $caller, $called, $duration,$path,$AnrufAusgehend,$AnrufVerpasst,$AnrufEingehend,$AnrufBlockiert,$AnrufAB,$device,$port) {
    global $types;
    //$types = array( 1 => 'Eingehender Anruf', 2 => 'Verpasster Anruf', 3 => 'Ausgehender Anruf', 10 => 'Blockierter Anruf' );
	if((substr($port, 0, 1)) == "4" AND (strlen($port) > 1)) 
	{ 
	  if($path != "") 
	  { 
        $fritzfarbe = $AnrufAB; 
		$icon = '<img src="icon/phone_answering.png">';
	  }
	  else 
	  { 
	    $fritzfarbe = $AnrufVerpasst; 
		$icon = '<img src="icon/phone_missed_out.png">';
	  }
	}
    elseif($type == 3) 
	{ 
	  $fritzfarbe = $AnrufAusgehend; 
	  $icon = '<img src="icon/phone_ring_out.png">';
	}
	elseif($type == 2) 
	{ 
	  $fritzfarbe = $AnrufVerpasst; 
	  $icon = '<img src="icon/phone_missed_out.png">';
	}
	elseif($type == 1) 
	{ 
	  $fritzfarbe = $AnrufEingehend; 
	    $icon = '<img src="icon/phone_ring_in.png">';
	}
	else 
	{ 
      $fritzfarbe = $AnrufBlockiert; 
	    $icon = '<img src="icon/control_cancel.png">';
	}
	
    return '    <tr style="color: '.$fritzfarbe.';" >
    <td>'.$date.'</td>
     <td>'.$icon.'</td>
     <td>'.$caller.'</td>
     <td>'.$called.'</td>
	 <td>'.$device.'</td>
     <td>'.$duration.'</td>
	 <!--<td>'.substr($port, 0, 1).'</td>
	 <td>'.$path.'</td>-->
   </tr>
';
}

function Fritzbox2($component) {
    $fritz_url = $component["fritz_url"];
    $fritz_pwd = $component["fritz_pwd"];
    $fritz_user = $component["fritz_user"];
	
	
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
	
	if(isset($component["ausgehend"])) { $AnrufAusgehend = $component["ausgehend"]; }
	else { $AnrufAusgehend = "#4287f5"; }	
	if(isset($component["verpasst"])) { $AnrufVerpasst = $component["verpasst"]; }
	else { $AnrufVerpasst = "#e05a55"; }	
	if(isset($component["eingehend"])) { $AnrufEingehend = $component["eingehend"]; }
	else { $AnrufEingehend = "#8bba8a"; }	
	if(isset($component["blockiert"])) { $AnrufBlockiert = $component["blockiert"]; }
	else { $AnrufBlockiert = "#ff0900"; }	
	if(isset($component["ab"])) { $AnrufAB = $component["ab"]; }
	else { $AnrufAB = "#f5b342"; }	

	$AnrufAusgehend = substr($AnrufAusgehend,-6);
	$AnrufVerpasst = substr($AnrufVerpasst,-6);
	$AnrufEingehend = substr($AnrufEingehend,-6);
	$AnrufBlockiert = substr($AnrufBlockiert,-6);
	$AnrufAB = substr($AnrufAB,-6);

    $modalId = mt_rand();
	return '<div class="hh hhdouble" style="width:100%;height:100%;">'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</div>'
           // . '<div class="pull-right"></div>'
        . '<div class="hh2" id="' . $modalId . '"><br><br>lade Liste ...<br>'
        . '</div>'
    . '</div>
	<script type="text/javascript">

  $.ajax({
    url: "custom/components/Fritzbox2.php?fritz_url='.$fritz_url.'&fritz_pwd='.urlencode($component["fritz_pwd"]).'&fritz_user='.$fritz_user.'&aufgeklappt='.$aufgeklappt.'&AnrufAusgehend='.$AnrufAusgehend.'&AnrufVerpasst='.$AnrufVerpasst.'&AnrufEingehend='.$AnrufEingehend.'&AnrufBlockiert='.$AnrufBlockiert.'&AnrufAB='.$AnrufAB.'",
    success: function(data) {
	  $("#' . $modalId . '").html("" + data);
    }
  });

</script>';
}





	
		



if(isset($_GET['fritz_url']))
{
	$fritz_url = $_GET['fritz_url'];
	$fritz_pwd = urldecode($_GET['fritz_pwd']);
	$fritz_user = $_GET['fritz_user'];
	$aufgeklappt = $_GET['aufgeklappt'];
	$AnrufAusgehend = "#".$_GET['AnrufAusgehend'];
	$AnrufVerpasst = "#".$_GET['AnrufVerpasst'];
	$AnrufEingehend = "#".$_GET['AnrufEingehend'];
	$AnrufBlockiert = "#".$_GET['AnrufBlockiert'];
	$AnrufAB = "#".$_GET['AnrufAB'];
    // Get Challenge-String
	$req_url = 'http://' . $fritz_url . '/login_sid.lua';
	$l = simplexml_load_string(file_get_contents($req_url));
	if ($l->BlockTime > 0) {
		sleep($l->BlockTime);
		$l = simplexml_load_string(file_get_contents($req_url));
	}
	$c = $l->Challenge;	
	// Get SID
	$c_str = sprintf("%s-%s", $c, $fritz_pwd);
	$md_str = md5(iconv("UTF-8", "UTF-16LE",  $c_str));

	$response = $c . '-' . $md_str;
	$l = simplexml_load_string(file_get_contents($req_url . '?user=' . 
	$fritz_user . '&response=' . $response));
	$sid = $l->SID;	
	
    // Get Calllist
//echo sprintf('http://%s:49000/calllist.lua?sid=%s', $fritz_url, $sid);
    $cl = simplexml_load_string(file_get_contents(sprintf('http://%s:49000/calllist.lua?sid=%s', $fritz_url, $sid)));
//print_r($cl);
    $modalId = mt_rand();
    $retValue = '
    <table class="table">
       <thead>
         <tr>
           <th>Datum</th>
           <th>Typ</th>
           <th>Anrufer</th>
           <th>Angerufene</th>
		   <th>Ger&auml;t</th>
           <th>Dauer</th>
		   <!--<th>Dauer</th>
		   <th>Dauer</th>-->
         </tr>
       </thead>
    <tbody>';
if(isset($component["anzahl"]))
{
    $max = $component["anzahl"];
}
else
{
	$max = 20;
}
    $counter = 1;
    foreach($cl->Call as $call) {
        if ($counter > $max) {
            break;
        }
        $type = trim($call->Type);
		if($call->Name != "")
		{

		if ($type == 3) 
		{
            $retValue .= appendRow($call->Date, $type, $call->CallerNumber, $call->Name, $call->Duration,$call->Path,$AnrufAusgehend,$AnrufVerpasst,$AnrufEingehend,$AnrufBlockiert,$AnrufAB,$call->Device,$call->Port);
        } else {
            $retValue .= appendRow($call->Date, $type, $call->Name, $call->CalledNumber, $call->Duration,$call->Path,$AnrufAusgehend,$AnrufVerpasst,$AnrufEingehend,$AnrufBlockiert,$AnrufAB,$call->Device,$call->Port);
        }
		}
		else
		{
			        if ($type == 3) {
            $retValue .= appendRow($call->Date, $type, $call->CallerNumber, $call->Called, $call->Duration,$call->Path,$AnrufAusgehend,$AnrufVerpasst,$AnrufEingehend,$AnrufBlockiert,$AnrufAB,$call->Device,$call->Port);
        } else {
            $retValue .= appendRow($call->Date, $type, $call->Caller, $call->CalledNumber, $call->Duration,$call->Path,$AnrufAusgehend,$AnrufVerpasst,$AnrufEingehend,$AnrufBlockiert,$AnrufAB,$call->Device,$call->Port);
        }
		}

        $counter++;
    }

    echo $retValue;
    echo '</tbody>
    </table>';
}
?>
