<?php

function ExtLink($component) {
    if (!isset($component['color'])) $component['color'] = '#FFCC00';    
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="run btn-action" onclick="location.href=\'' . $component['url'] . '\'">&Ouml;ffnen</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
}
