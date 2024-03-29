<?php

// http://www.tagesschau.de/export/video-podcast/webxl/tagesschau-in-100-sekunden/
// http://media.tagesschau.de/video/100s/2015/1212/TV-100s-1947.webxl.h264.mp4

function Tagesschau($component) {
    $modalId = mt_rand();
        
    $cacheFile = 'cache/Tagesschau.' . md5(serialize($component)) . '.tmp';
    
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - 60 * 5 ))) {
        $rssFeed = file_get_contents($cacheFile);
    } else {
        $rssFeed = file_get_contents('http://www.tagesschau.de/export/video-podcast/webxl/tagesschau-in-100-sekunden/');
        file_put_contents($cacheFile, $rssFeed, LOCK_EX);
    }
    
    $xml = simplexml_load_string($rssFeed);
    
    return '<div class="hh">'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<img src="../assets/icons/' . $component["icon"] . '" class="icon">Tagesschau in 100 Sekunden'
        . '</div>'
        . '<div class="hh2 collapse" id="' . $modalId . '">'
            . '<div class="embed-responsive embed-responsive-16by9">'
                . '<video controls name="media">'
                    . '<source src="' . $xml->channel->item->enclosure[0]['url'] . '" type="video/mp4">'
                . '</video>'
            . '</div>'
        . '</div>'
    . '</div>';
}
