<?php

function Iframe($component) {
    $modalId = mt_rand();
        
    return '<div class="hh">'
        . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name']
        . '</div>'
        . '<div class="hh2 collapse" id="' . $modalId . '">'
            . '<iframe src="' . $component['url'] . '" width="100%" height="450"></iframe>'
        . '</div>'
    . '</div>';
}
