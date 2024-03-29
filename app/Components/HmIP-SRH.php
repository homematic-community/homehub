<?php

// HM-Sec-RHS|Fenster Praxis:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=14439|STICKY_UNREACH=14435|CONFIG_PENDING=14425|LOWBAT=14429|RSSI_DEVICE=14433|RSSI_PEER=14434|
// HM-Sec-RHS|Fenster Praxis|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=14467|ERROR=14444|LOWBAT=17872|

function HmIP_SRH($component) {
    global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
