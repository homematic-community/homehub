<?php

function WeatherUnderground($component) {
    $cacheFile = 'cache/WeatherUnderground.' . md5(serialize($component)) . '.tmp';
    
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - 60 * 5 ))) {
        $json = file_get_contents($cacheFile);
    } else {
        $json = file_get_contents('http://api.wunderground.com/api/' . $component['api_key'] . '/conditions/forecast/lang:DL/q/' . $component['station'] . '.json');
        file_put_contents($cacheFile, $json, LOCK_EX);
    }
    
    $data = json_decode($json, true);
    
    $retVal = '';
    
    if(isset($data['current_observation'])) {
        $modalId = mt_rand();
        
        switch ($data['current_observation']['pressure_trend']) {
            case '0':
                $pressureTrend = 'Gleichbleibend';
                break;
            case '+':
                $pressureTrend = 'Besser';
                break;            
            case '-':
                $pressureTrend = 'Schlechter';
                break;            
            default:
                $pressureTrend = $data['current_observation']['pressure_trend'];
                break;
        }
        
        $icon = array(
            'chanceflurries' => 'snowflake-in-a-cloud.png',
            'chancerain' => 'rain-cloud.png',
            'chancesleet' => 'rain-cloud.png',
            'chancesnow' => 'snowflake-in-a-cloud.png',
            'chancetstorms' => 'storm-cloud.png',
            'clear' => 'clear-sun.png',
            'cloudy' => 'cloud.png',
            'flurries' => 'snowflake-in-a-cloud.png',
            'fog' => 'stripped-cloud.png',
            'hazy' => 'stripped-cloud.png',
            'mostlycloudy' => 'cloudy-day.png',
            'mostlysunny' => 'cloudy-day.png',
            'partlysunny' => 'cloudy-day.png',
            'sleet' => 'rain-cloud.png',
            'rain' => 'rain-cloud.png',
            'snow' => 'snowflake-in-a-cloud.png',
            'sunny' => 'clear-sun.png',
            'tstorms' => 'storm-cloud.png',
            'partlycloudy' => 'cloudy-day.png'
        );	
        
        return '<div class="hh">'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component['icon'] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">' 
                    . '<span class="info">' . $data['current_observation']['temp_c'] . ' &deg;C</span>'
                    . '<span class="info">' . $data['current_observation']['weather'] . '</span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<img src="../assets/images/WeatherUnderground/' . $icon[$data['current_observation']['icon']] . '" class="icon"><br />'
                    . 'Luftfeuchtigkeit: '. $data['current_observation']['relative_humidity'] . '<br />'
                    . 'Windst&auml;rke: '. $data['current_observation']['wind_kph'] . ' km/h<br />'
                    . 'Windrichtung: '. $data['current_observation']['wind_dir'] . '<br />'
                    . 'Niederschlag: '. $data['current_observation']['precip_today_metric'] . ' mm<br />'
                    . 'Ausschichten: '. $pressureTrend
                . '</div>'
            . '</div>'
        . '</div>';
    } else {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component["name"] . '</div>'
            . '<div class="pull-right">FEHLER</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
