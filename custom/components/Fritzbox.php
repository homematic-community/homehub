<?php

 // Script zur Abfrage der Anruferliste einer Fritzbox über das TR-064 Protokoll
 // zur Darstellung in dem Web Frontend HomeHub WebUI für HomeMatic-Komponenten:
 // https://homematic-forum.de/forum/viewtopic.php?f=41&t=76034&start=10#p741718
 // 27.02.2022 v1.3 erstellt und optimiert von TheGhost (Vielen Dank), 0m1d und Slice
 
function appendRow($date, $type, $caller, $called, $duration) {
    global $types;
   $types = array( 1 => 'Eingehender Anruf', 2 => 'Verpasster Anruf', 3 => 'Ausgehender Anruf', 10 => 'Blockierter Anruf' );

    return '    <tr style="color: '.(($type == 3) ? '#2E2EFE' : (($type == 2) ? '#FF0040' : (($type == 1) ? '#01DF01' : '#BDBDBD'))).'" >
    <td>'.$date.'</td>
     <td>'.(isset($types[$type]) ? $types[$type] : 'Unknown').'</td>
     <td>'.$caller.'</td>
     <td>'.$called.'</td>
     <td>'.$duration.'</td>
   </tr>
';
}

function Fritzbox($component) {
    $fritz_url = 'FRITZBOXIP';
    $fritz_pwd = 'FRITZBOXPW';
    $fritz_user = 'FRITZBOXUSER';
	
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
    $cl = simplexml_load_string(file_get_contents(sprintf('http://%s:49000/calllist.lua?sid=%s', $fritz_url, $sid)));

    $modalId = mt_rand();
    $retValue = '<div class="hh">
    <div data-toggle="collapse" data-target="#'.$modalId.'">
    <img src="icon/'.$component["icon"].'" class="icon">'.$component['name'].'
    </div>
    <div class="hh2 collapse" id="'.$modalId.'">
    <table class="table">
       <thead>
         <tr>
           <th>Datum</th>
           <th>Typ</th>
           <th>Anrufer</th>
           <th>Angerufene</th>
           <th>Dauer</th>
         </tr>
       </thead>
    <tbody>';

    $max = 20;
    $counter = 1;
    foreach($cl->Call as $call) {
        if ($counter > $max) {
            break;
        }
        $type = trim($call->Type);
        if ($type == 3) {
            $retValue .= appendRow($call->Date, $type, $call->CallerNumber, $call->Called, $call->Duration);
        } else {
            $retValue .= appendRow($call->Date, $type, $call->Caller, $call->CalledNumber, $call->Duration);
        }
        $counter++;
    }

    return $retValue .= '      </tbody>
    </table>
   </div>
 </div>';
}
?>
