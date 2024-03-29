<?php
function HM_Sen_DB_PCB($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['PRESS_SHORT']-21) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
