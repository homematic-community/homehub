<?php

function Text($component) {
    if (!isset($component['color'])) $component['color'] = '#FFCC00';    
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            .  $component["text"] 
            . '<div class="clearfix"></div>'
        . '</div>';
}
