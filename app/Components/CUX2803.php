<?php
function CUX2803($component) {
    if ($component['parent_device_interface'] == 'CUxD' && $component['visible'] == 'true' && isset($component['IP'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['INFO'] . '" data-component="' . $component['component'] . '" data-datapoint="INFO"></span>'
                //. '<span class="info" data-id="' . $component['IP'] . '" data-component="' . $component['component'] . '" data-datapoint="IP"></span>'
                //. '<span class="info" data-id="' . $component['UNREACH_CTR'] . '" data-component="' . $component['component'] . '" data-datapoint="UNREACH_CTR"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
