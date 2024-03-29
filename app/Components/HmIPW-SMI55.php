<?php

// Validated by Gerti

function HmIPW_SMI55($component) {

    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
      if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="right info" data-id="' . $component['CURRENT_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT_ILLUMINATION"></span>'
                . '<span class="right info" data-id="' . $component['MOTION_DETECTION_ACTIVE'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION_DETECTION_ACTIVE"></span>'
                . '<span class="right info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
