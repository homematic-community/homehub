<?php
ini_set('display_errors', 'on');
$beginn = microtime(true);
$exportFile = 'config/export.json';

// Lösche vorhandene export.json
if(file_exists($exportFile)) 
{
    unlink($exportFile);
}
touch($exportFile);


// Wenn Konfiguration nicht existiert wechsele zum Setup
if(!file_exists("config/config.php"))
{
	header('Location: setup.php');
	exit;
}
else
{
	// Lade Konfiuration der Homematic
	require("config/config.php");
}

$export = array();
$interface = $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].str_replace($_SERVER['DOCUMENT_ROOT'], "", dirname(__FILE__));
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $interface = "https://".$interface;
}
else $interface = "http://".$interface;
    
// Devices und Channels von der CCU laden
$devicelistCgi = curl_get_content($interface.'/interface.php?devicelist.cgi');
$devicesXml = simplexml_load_string($devicelistCgi);

$statelistCgi = curl_get_content($interface.'/interface.php?statelist.cgi'); 
$statesXml = simplexml_load_string($statelistCgi);


   
    // Devices
    foreach ($devicesXml->device as $device) {
        $dummy = array();
        foreach($device->attributes() as $attribute => $value) {
            $dummy[strval($attribute)] = strval($value);            
        }
        
        $statesXmlDevice = $statesXml->xpath('//device[@ise_id="' . strval($device['ise_id']) . '"]');
        if(isset($statesXmlDevice[0])) {
            foreach($statesXmlDevice[0]->attributes() as $attribute => $value) {
                $dummy[strval($attribute)] = strval($value);
            }
        }

        $export['devices'][] = $dummy;
    }

	// Virtuelle Fernbedienung
    $device = $statesXml->xpath('//device[contains(@name, "HM-RCV-50")]');
    if(count($device) > 0) {
        $device = $device[0];
        
        $dummy = array(
            'name' => strval($device['name']),
            'address' => 'BidCos-RF',            
            'ise_id' => strval($device['ise_id']),
            'interface' => 'BidCos-RF',
            'device_type' => 'HM-RCV-50'
        );

        $export['devices'][] = $dummy;
    }

	
    // Channels
    $channelDevicesXml = $devicesXml->xpath('//channel');
    foreach ($channelDevicesXml as $channel) {
        $device = $devicesXml->xpath('//device[@ise_id="' . strval($channel['parent_device']) . '"]');
        $device = $device[0];
        
        $dummy = array();
        
        if(strval($device['interface']) <> 'CUxD') {
            $dummy['component'] = strval($device['device_type']);
        } else {
            $dummy['component'] = substr(strval($device['address']), 0, 7);
        }
        $dummy['parent_device_type'] = strval($device['device_type']);
        $dummy['parent_device_interface'] = strval($device['interface']);
        
        foreach($channel->attributes() as $attribute => $value) {
            $dummy[strval($attribute)] = strval($value);            
        }
        
        $channelStatesXml = $statesXml->xpath('//channel[@ise_id="' . strval($channel['ise_id']) . '"]');
        if(isset($channelStatesXml[0])) {
            foreach($channelStatesXml[0]->attributes() as $attribute => $value) {
                $dummy[strval($attribute)] = strval($value);
            }

            foreach($channelStatesXml[0]->datapoint as $datapoint) {
                $dummy2 = array();
                foreach($datapoint->attributes() as $attribute => $value) {
                    $dummy2[strval($attribute)] = strval($value);
                }

                $dummy['datapoints'][] = $dummy2;
            }
        }

        $export['channels'][] = $dummy;
    }
    
    // Channels Virtuelle Fernbedienung
    $device = $statesXml->xpath('//device[contains(@name, "HM-RCV-50")]');
    if(count($device) > 0) {
        $device = $device[0];
        
        $channelXml = $statesXml->xpath('//device[@ise_id="' . strval($device['ise_id']) . '"]/channel');
        foreach ($channelXml as $channel) {
            $dummy = array();
            $dummy['component'] = 'HM-RCV-50';
            $dummy['parent_device_type'] = 'HM-RCV-50';
            $dummy['parent_device_interface'] = 'BidCos-RF';
            
            foreach($channel->attributes() as $attribute => $value) {
                $dummy[strval($attribute)] = strval($value);
            }

            foreach ($channel->datapoint as $datapoint) {
                $dummy2 = array();
                foreach($datapoint->attributes() as $attribute => $value) {
                    $dummy2[strval($attribute)] = strval($value);
                }

                $dummy['datapoints'][] = $dummy2;
            }

            $export['channels'][] = $dummy;
        }
    }	
	
    // Aufräumen
    unset($devicelistCgi);
    unset($devicesXml);
    unset($statelistCgi);
    unset($statesXml);
    
    // Systemvariablen von der CCU laden
	$sysvarlistCgi = curl_get_content($interface.'/interface.php?sysvarlist.cgi');
    $sysvarsXml = simplexml_load_string($sysvarlistCgi);

    // Systemvariablen
    foreach ($sysvarsXml->systemVariable as $sysvar) {
        $dummy = array();
        $dummy['component'] = 'SysVar';
        
        foreach($sysvar->attributes() as $attribute => $value) {
            $dummy[strval($attribute)] = strval($value);
        }
        $export['systemvariables'][] = $dummy;
    }
    
    // Aufräumen
    unset($sysvarlistCgi);
    unset($sysvarsXml);
    
    // Programme von der CCU laden
	$programlistCgi = curl_get_content($interface.'/interface.php?programlist.cgi');
    $programsXml = simplexml_load_string($programlistCgi);
    
    // Programme
    foreach ($programsXml->program as $program) {
        $dummy = array();
        $dummy['component'] = 'Program';
        
        foreach($program->attributes() as $attribute => $value) {
            // Unstimmigkeit in der XML-API korrigieren
            if(strval($attribute) == 'id') {
                $dummy['ise_id'] = strval($value);
            } else {
                $dummy[strval($attribute)] = strval($value);
            }
        }
        $export['programs'][] = $dummy;
    }
    
    // Aufräumen
    unset($programlistCgi);
    unset($programsXml);
    
    // Umlaute ersetzen
    $json = str_replace(
        array('\u00c4', '\u00e4', '\u00d6', '\u00f6', '\u00dc', '\u00fc', '\u00df'),
        array('Ä', 'ä', 'Ö', 'ö', 'Ü', 'ü', 'ß'),
        json_encode($export)
    );
    file_put_contents($exportFile, $json);

if(isset($_GET['debug']))
{
	$dauer = microtime(true) - $beginn; 
	echo "Verarbeitung des Skripts: ".$dauer." Sek.";
	exit();
}
else
{
		header('Location: index.php');
}

function curl_get_content( $url ) {
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,$url);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $content;
}
?>

