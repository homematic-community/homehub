<?php
function HmIP_SCTH230($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['CONCENTRATION'])) {
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['CONCENTRATION'] . '" data-component="' . $component['component'] . '" data-datapoint="CONCENTRATION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
