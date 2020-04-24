<?php

//Program|CCU Reboot||ID=4592|ACTIVE=true|TIMESTAMP=1442258266|DESCRIPTION=Wird nur beim Neustart der CCU ausgeführt|VISIBLE=false|OPERATE=false|

// Validated by Braindead

function Program($component) {
    if ($component['visible'] == 'true' && isset($component['ise_id'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="run btn-action" data-id="' . $component['ise_id'] . '" data-run-id="' . $component['ise_id'] . '">Start</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
