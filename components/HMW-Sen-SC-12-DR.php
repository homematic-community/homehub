<?php
function HMW_Sen_SC_12_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['SENSOR'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['SENSOR'] . '" data-component="' . $component['component'] . '" data-datapoint="SENSOR"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
