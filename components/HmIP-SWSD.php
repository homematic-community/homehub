<?php

// HmIP-SWSD 
// 20230818 - PL 

/*
// <datapoint name="HmIP-RF.xxxxxxxxxxxxxx:0.LOW_BAT" type="LOW_BAT" ise_id="XXXX" value="false" valuetype="2" valueunit="" timestamp="xxxxxxxxxx" operations="5"/>
// <datapoint name="HmIP-RF.xxxxxxxxxxxxxx:1.SMOKE_DETECTOR_ALARM_STATUS" type="SMOKE_DETECTOR_ALARM_STATUS" ise_id="XXXX" value="0" valuetype="16" valueunit="" timestamp="xxxxxxxxxx" operations="5"/>
// java-skript Eingefuegt Batterie Status LOW_BAT
// java-skript Aenderung SMOKE_DETECTOR_ALARM_STATUS Abfrage von "(value === 'false')" auf "(value === '0')".
case 'HmIP-SWSD':
switch (datapoint) {
    case 'LOW_BAT':
    if (value === 'true') {
        $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
    }
    break;
    case 'SMOKE_DETECTOR_ALARM_STATUS':
    //
    if (value === '0') {
        $('[data-id="' + ise_id + '"]').html('<img src="icon/control_clear.png" />');
    } else {
        $('[data-id="' + ise_id + '"]').html('<img src="icon/message_attention.png" />');
    }
    break;
    default:
    $('[data-id="' + ise_id + '"]').html(value);
}
break;
*/

function HmIP_SWSD($component) {

    global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['SMOKE_DETECTOR_ALARM_STATUS'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                . '<span class="info" data-id="' . $component['SMOKE_DETECTOR_ALARM_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="SMOKE_DETECTOR_ALARM_STATUS"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
