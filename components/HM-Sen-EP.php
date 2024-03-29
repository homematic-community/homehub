<?php
function HM_Sen_EP($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['SEQUENCE_OK'])) {
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['SEQUENCE_OK'] . '" data-set-value="1">OK</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
