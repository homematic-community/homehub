<?php

// http://edge.live.mp3.mdn.newmedia.nacamar.net/ps-radioerft/livestream.mp3

function Audio($component) {
    $modalId = mt_rand();
        
    return '<div class="hh">'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<img src="../assets/images/' . $component["icon"] . '" class="icon">&nbsp;&nbsp;&nbsp;' . $component['name']
        . '</div>'
        . '<div class="hh2 collapse" id="' . $modalId . '">'
            . '<audio src="' . $component['file'] . '" controls style="width: 100%;"></audio>'
        . '</div>'
    . '</div>';
}
