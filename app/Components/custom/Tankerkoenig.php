<?php

// Mit dem folgenden Link kann die Tankstellen ID ermittelt werden. Es müssen LAT, LONG und der eigene APIKEY eingetragen werden
// https://creativecommons.tankerkoenig.de/json/list.php?lat=LAT&lng=LONG&rad=3&type=diesel&apikey=APIKEY&sort=price
// 
// Mit dem folgenden Link werden die Spritpreise abgefragt. Es müssen TANKSTELLEN_ID und APIKEY eingetragen werden
// https://creativecommons.tankerkoenig.de/json/detail.php?id=TANKSTELLEN_ID&apikey=APIKEY

function Tankerkoenig($component) {
    $cacheFile = 'cache/Tankerkoenig.' . md5(serialize($component)) . '.tmp';
    
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - 60 * 5 ))) {
        $json = file_get_contents($cacheFile);
    } else {
        $json = file_get_contents('https://creativecommons.tankerkoenig.de/json/detail.php?id=' . $component['station_id'] . '&apikey=' . $component['api_key']);
        file_put_contents($cacheFile, $json, LOCK_EX);
    }   
    
    $data = json_decode($json, true);
    
    $retVal = '';
    
    if(isset($data['status']) && $data['status'] == 'ok') {
        if($data['station']['isOpen'] == '1') {
            if(isset($component['fuel_types'])) {
                foreach($component['fuel_types'] as $fuel_type) {
                    if(isset($data['station'][$fuel_type])) {
                        $retVal .= '<span class="info">' . ucfirst($fuel_type) . ': ' . $data['station'][$fuel_type] . ' Euro</span>';
                    }
                }
            } else {
                // Alle ausgeben
                $retVal = '<span class="info">E5: ' . $data['station']['e5'] . ' Euro</span>'
                    . '<span class="info">E10: ' . $data['station']['e10'] . ' Euro</span>'
                    . '<span class="info">Diesel: ' . $data['station']['diesel'] . ' Euro</span>';
            }
        } else {
            $retVal = 'geschlossen';
        }
    } else {
        $retVal = 'FEHLER';
    }
    
    return '<div class="hh">'
        . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component["name"] . '</div>'
        . '<div class="pull-right">' . $retVal . '</div>'
        . '<div class="clearfix"></div>'
    . '</div>';
}
