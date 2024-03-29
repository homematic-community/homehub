<?php
function HM_Sec_Key_S($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse">'
                .'<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['STATE']-27) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                    . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
                    . '<span class="set btn-text" data-id="' . $component['OPEN'] . '" data-component="' . $component['component'] . '" data-datapoint="OPEN" data-set-id="' . $component['OPEN'] . '" data-set-value="1">&Ouml;ffnen</span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
        . '</div>';
    }
}
