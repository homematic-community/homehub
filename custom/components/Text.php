<?php
/*
 {
    "component": "Text",  
    "text": "nun kommt Text oder sonstiges <img src='bildurl.jpg' alt='Beschreibung'> <br> das war's."
 },
*/
function Text($component) {
    if (!isset($component['color'])) $component['color'] = '#FFCC00';    
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            .  $component["text"] 
            . '<div class="clearfix"></div>'
        . '</div>';
}
