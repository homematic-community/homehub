<?php
/*
<device name="HmIP-ASIR-O 00209A499CD3F0" ise_id="34952" unreach="false" config_pending="false">
<channel name="HmIP-ASIR-O 00209A499CD3F0:0" ise_id="34953" index="0" visible="true" operate="true">
<datapoint name="HmIP-RF.00209A499CD3F0:0.CONFIG_PENDING" type="CONFIG_PENDING" ise_id="34954" value="false" valuetype="2" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.DUTY_CYCLE" type="DUTY_CYCLE" ise_id="34958" value="false" valuetype="2" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.ERROR_BAD_RECHARGEABLE_BATTERY_HEALTH" type="ERROR_BAD_RECHARGEABLE_BATTERY_HEALTH" ise_id="34959" value="false" valuetype="2" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.ERROR_CODE" type="ERROR_CODE" ise_id="34963" value="0" valuetype="8" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.LOW_BAT" type="LOW_BAT" ise_id="34965" value="false" valuetype="2" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.OPERATING_VOLTAGE" type="OPERATING_VOLTAGE" ise_id="34969" value="4.200000" valuetype="4" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.OPERATING_VOLTAGE_STATUS" type="OPERATING_VOLTAGE_STATUS" ise_id="34970" value="0" valuetype="16" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.RSSI_DEVICE" type="RSSI_DEVICE" ise_id="34971" value="185" valuetype="8" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.RSSI_PEER" type="RSSI_PEER" ise_id="34972" value="0" valuetype="8" valueunit="" timestamp="0" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.SABOTAGE" type="SABOTAGE" ise_id="34973" value="false" valuetype="2" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.UNREACH" type="UNREACH" ise_id="34977" value="false" valuetype="2" valueunit="" timestamp="1582744981" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:0.UPDATE_PENDING" type="UPDATE_PENDING" ise_id="34981" value="false" valuetype="2" valueunit="" timestamp="1582745111" operations="5"/>
</channel>
<channel name="HmIP-ASIR-O 00209A499CD3F0:1" ise_id="34985" index="1" visible="true" operate="true"/>
<channel name="HmIP-ASIR-O 00209A499CD3F0:2" ise_id="34986" index="2" visible="false" operate="true"/>
<channel name="HmIP-ASIR-O 00209A499CD3F0:3" ise_id="34987" index="3" visible="true" operate="true">
<datapoint name="HmIP-RF.00209A499CD3F0:3.ACOUSTIC_ALARM_ACTIVE" type="ACOUSTIC_ALARM_ACTIVE" ise_id="34988" value="false" valuetype="2" valueunit="" timestamp="1582744982" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:3.ACOUSTIC_ALARM_SELECTION" type="ACOUSTIC_ALARM_SELECTION" ise_id="34989" value="" valuetype="16" valueunit="" timestamp="0" operations="2"/>
<datapoint name="HmIP-RF.00209A499CD3F0:3.DURATION_UNIT" type="DURATION_UNIT" ise_id="34990" value="" valuetype="16" valueunit="" timestamp="0" operations="2"/>
<datapoint name="HmIP-RF.00209A499CD3F0:3.DURATION_VALUE" type="DURATION_VALUE" ise_id="34991" value="" valuetype="16" valueunit="" timestamp="0" operations="2"/>
<datapoint name="HmIP-RF.00209A499CD3F0:3.OPTICAL_ALARM_ACTIVE" type="OPTICAL_ALARM_ACTIVE" ise_id="34992" value="false" valuetype="2" valueunit="" timestamp="1582744982" operations="5"/>
<datapoint name="HmIP-RF.00209A499CD3F0:3.OPTICAL_ALARM_SELECTION" type="OPTICAL_ALARM_SELECTION" ise_id="34993" value="" valuetype="16" valueunit="" timestamp="0" operations="2"/>
</channel>
</device>
*/

function HmIP_ASIR_2($component) {
	
	
	global $export;
	
	// Datein von Channel 0 noch einlesen
/*
$json_string = 'config/export.json';
$jsondata = file_get_contents($json_string);
$obj = json_decode($jsondata,true);
*/
$obj = $export;
$key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
foreach($obj['channels'][$key]['datapoints'] as $datapoint)
{ $component2[$datapoint['type']] = $datapoint['ise_id']; }


	
	
	
	
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['ACOUSTIC_ALARM_ACTIVE']) && isset($component['OPTICAL_ALARM_ACTIVE'])) {
        $modalId = mt_rand();
		if (!isset($component['color'])) $component['color'] = '#595959';
		
		// ShowTime - Uhrzeit der letzten Änderung anzeigen
		if(isset($component['showtime']))
		{
			if($component['showtime'] == "true") { $ShowTime = '<span class="info" data-id="' . $component['ise_id']  . 't" data-component="showtime" data-datapoint="showtime"></span>&nbsp;&nbsp;'		; }
			else { $ShowTime = ''; }
		}
		else { $ShowTime = ''; }
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                .'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
				. $ShowTime
				.'<span class="info" data-id="' . $component2['LOW_BAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOW_BAT"></span>'
                    . '<!--Optischer Alarm--><span class="info" data-id="' . $component['OPTICAL_ALARM_ACTIVE'] . '" data-component="' . $component['component'] . '" data-datapoint="OPTICAL_ALARM_ACTIVE"></span> '
                    .'<!--Akustischer Alarm--><span class="info" data-id="' . $component['ACOUSTIC_ALARM_ACTIVE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACOUSTIC_ALARM_ACTIVE"></span>'
                    //. '<span class="info" data-id="' . $component2['OPERATING_VOLTAGE'] . '" data-component="' . $component['component'] . '" data-datapoint="OPERATING_VOLTAGE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
        . '</div>';
    }
}
