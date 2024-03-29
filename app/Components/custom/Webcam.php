<?php

function Webcam($component) {
    $modalId = mt_rand();
        
    return '<div class="hh">'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<img src="../assets/icons/' . $component["icon"] . '" class="icon">Haustür Webcam'
        . '</div>'
        . '<div class="hh2 collapse" id="' . $modalId . '">'
            . '<img id="stream" src="http://192.168.2.7/mjpegstream.cgi?-chn=11&-usr=admin&pwd=instar" style="width: 100%;">'
            . '<div class="row text-center top15">'
                . '<div class="btn-group">'
                    /*. '<button type="button" class="btn btn-primary" onclick="$.get(\'http://192.168.2.7/cgi-bin/hi3510/param.cgi?cmd=setmdattr&-enable=0&-s=50&-name=1&-x=0&-y=0&-w=60&-h=60&usr=admin&pwd=instar\'); $.get(\'http://192.168.2.7/cgi-bin/hi3510/param.cgi?cmd=setmdattr&-enable=1&-s=50&-name=1&-x=0&-y=0&-w=60&-h=60&usr=admin&pwd=instar\'); alert(\'ok\');">'
                        . 'Snapshot'
                    . '</button>'*/
                    . '<button type="button" class="btn btn-primary" onclick="$(\#stream\').removeAttr(\'src\').attr(\'src\', \'http://192.168.2.7/mjpegstream.cgi?-chn=11&-usr=admin&pwd=instar\');;">'
                        . 'Refresh'
                    . '</button>'
                    . '<button type="button" class="btn btn-primary" onclick="$.get(\'http://192.168.2.7/cgi-bin/hi3510/param.cgi?cmd=setinfrared&-infraredstat=auto&usr=admin&pwd=instar\');">'
                        . 'IR auto'
                    . '</button>'
                    . '<button type="button" class="btn btn-primary" onclick="$.get(\'http://192.168.2.7/cgi-bin/hi3510/param.cgi?cmd=setinfrared&-infraredstat=close&usr=admin&pwd=instar\');">'
                        . 'IR aus'
                    . '</button>'
                . '</div>'
            . '</div>'
        . '</div>'
    . '</div>';
}
