<?php
function HM_OU_LED16($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS"></span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
