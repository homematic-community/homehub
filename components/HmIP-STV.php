<?php

// HmIP-STV 
// 20230818 - PL 

/*
Beispiele "custom.json"

"Garage_Rollladen":[
    {
       "name":"Garagentor Status:1",
       "icon":"fts_garage.png",
       "display_name":"Garagentor",
       "state_icons": "false,fts_garage_door_10.png;true,fts_shutter_100.png"
    }
]

oder 

"EG_Sonstiges":[
    {
    "name":"Bruch_Terrasse:1",
    "icon":"secur_breakage_glass.png",
    "display_name":"Bruch Terrasse",
    "color":"#ffcc00"
    }
]
*/

/*
// <datapoint name="HmIP-RF.xxxxxxxxxxxxxx:0.LOW_BAT" type="LOW_BAT" ise_id="XXXXX" value="false" valuetype="2" valueunit="" timestamp="xxxxxxxxxx" operations="5"/>
// <datapoint name="HmIP-RF.xxxxxxxxxxxxxx:1.MOTION" type="MOTION" ise_id="XXXXX" value="false" valuetype="2" valueunit="" timestamp="xxxxxxxxxx" operations="5"/>
// java-skript Vorlage HmIP-SCI "STATE" > "MOTION" ausgetauscht.
case 'HmIP-STV':
    switch (datapoint) {
    case 'LOW_BAT':
    if (value === 'true') {
        $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
    }
    break;
    case 'MOTION':
    var state_icons = $('[data-id="' + ise_id + '"]').attr('data-state-icons');
    if (state_icons !== "") {
        // Liste suchen und zerlegen
        var res = state_icons.search(",");
        if (res > -1) {
        var iconarray = state_icons.split(';');
        for (var i = 0; i < iconarray.length; i++){
            var icon_array = iconarray[i].split(',');
            if (value === icon_array[0].trim()){ var icon = '<img src="icon/' + icon_array[1].trim() + '" />'; }
        }
        }
    }
    else {
        if (value == "0" || value === "false") {
            var icon = '<img src="icon/fts_window_1w_gn.png" />';         
        } else {
            var icon = '<img src="icon/fts_window_1w_open_rd.png" />';  
        }
    } 
    $('[data-id="' + ise_id + '"]').html(icon);
    break;
    default:
    console.log("default" + ise_id+ datapoint);
    $('[data-id="' + ise_id + '"]').html(value);
}
break;
*/

function HmIP_STV($component) {

    global $export;
    $obj = $export;
    $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
    { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
    
    
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['MOTION'])) {
      if (!isset($component['color'])) $component['color'] = '#595959';
      if(!isset($component['state_icons'])) {
                    $component['state_icons'] = '';
      }
      
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $status_component['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                . '<span class="info" data-id="' . $component['MOTION'] . '" data-component="' . $component['component'] . '" data-state-icons="' . $component['state_icons'] . '" data-datapoint="MOTION"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}