<?php
function HM_Sec_MDIR($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="right info" data-id="' . ($component['BRIGHTNESS']-15) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="right info" data-id="' . $component['BRIGHTNESS'] . '" data-component="' . $component['component'] . '" data-datapoint="BRIGHTNESS"></span>'
                . '<span class="right info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
