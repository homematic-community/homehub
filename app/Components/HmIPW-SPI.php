<?php

// Validated by Gerti

function HmIP_SPI($component) {
 
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['PRESENCE_DETECTION_STATE'])) {
      if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="right info" data-id="' . $component['CURRENT_ILLUMINATION'] . '" data-component="' . $component['component'] . '" data-datapoint="CURRENT_ILLUMINATION"></span>'
                . '<span class="right info" data-id="' . $component['PRESENCE_DETECTION_ACTIVE'] . '" data-component="' . $component['component'] . '" data-datapoint="PRESENCE_DETECTION_ACTIVE"></span>'
                . '<span class="right info" data-id="' . $component['PRESENCE_DETECTION_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="PRESENCE_DETECTION_STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
