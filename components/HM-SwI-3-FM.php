<?php
function HM_SwI_3_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS'] . '" data-set-value="1">Dr&uuml;cken</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
