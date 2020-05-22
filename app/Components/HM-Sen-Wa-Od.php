<?php
function HM_Sen_Wa_Od($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['FILLING_LEVEL'])) {
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['FILLING_LEVEL']-19) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['FILLING_LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="FILLING_LEVEL"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
