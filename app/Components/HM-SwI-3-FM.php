<?php

// HM-SwI-3-FM|Anwesenheit2:0||VISIBLE=|OPERATE=|UNREACH=24864|STICKY_UNREACH=24860|CONFIG_PENDING=24850|LOWBAT=24854|RSSI_DEVICE=24858|RSSI_PEER=24859|
// HM-SwI-3-FM|HelgaA2||VISIBLE=true|OPERATE=true|PRESS=24870|
// HM-SwI-3-FM|MichaelA2||VISIBLE=true|OPERATE=true|PRESS=24873|
// HM-SwI-3-FM|SylviaA3||VISIBLE=true|OPERATE=true|PRESS=24876|

// LOWBAT wird nicht angezeigt

// Validated by Manu

function HM_SwI_3_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS'] . '" data-set-value="1">Dr&uuml;cken</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
