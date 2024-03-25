<?php
function HmIP_SRD($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['RAINING'])) {
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['RAINING'] . '" data-component="' . $component['component'] . '" data-datapoint="RAINING"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
