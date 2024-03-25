<?php
/*

<device name="Heizung Hobbyraum" ise_id="3838" unreach="false" sticky_unreach="true" config_pending="false">
<channel name="Heizung Hobbyraum:0" ise_id="3839" index="0" visible="" operate="">
<datapoint name="VirtualDevices.INT0000022:0.UPDATE_PENDING" type="UPDATE_PENDING" ise_id="3849" value="false" valuetype="2" valueunit="" timestamp="1684775137" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:0.RSSI_DEVICE" type="RSSI_DEVICE" ise_id="3845" value="1" valuetype="8" valueunit="" timestamp="1684775137" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:0.AES_KEY" type="AES_KEY" ise_id="3840" value="0" valuetype="8" valueunit="" timestamp="1684775137" operations="1"/>
<datapoint name="VirtualDevices.INT0000022:0.DEVICE_IN_BOOTLOADER" type="DEVICE_IN_BOOTLOADER" ise_id="3842" value="false" valuetype="2" valueunit="" timestamp="1684775137" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:0.CONFIG_PENDING" type="CONFIG_PENDING" ise_id="3841" value="false" valuetype="2" valueunit="" timestamp="1684775137" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:0.UNREACH" type="UNREACH" ise_id="3848" value="false" valuetype="2" valueunit="" timestamp="1684775137" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:0.LOWBAT" type="LOWBAT" ise_id="3844" value="false" valuetype="2" valueunit="" timestamp="1684828593" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:0.STICKY_UNREACH" type="STICKY_UNREACH" ise_id="3847" value="true" valuetype="2" valueunit="" timestamp="1684775137" operations="7"/>
<datapoint name="VirtualDevices.INT0000022:0.RSSI_PEER" type="RSSI_PEER" ise_id="3846" value="1" valuetype="8" valueunit="" timestamp="1684775137" operations="5"/>
</channel>
<channel name="Heizung Hobbyraum 1" ise_id="3850" index="1" visible="true" operate="true">
<datapoint name="VirtualDevices.INT0000022:1.CONTROL_MODE" type="CONTROL_MODE" ise_id="3856" value="1" valuetype="16" valueunit="" timestamp="1684869567" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:1.ACTUAL_HUMIDITY" type="ACTUAL_HUMIDITY" ise_id="3851" value="61.000000" valuetype="4" valueunit="%" timestamp="1684869479" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:1.BOOST_MODE" type="BOOST_MODE" ise_id="3854" value="" valuetype="2" valueunit="" timestamp="0" operations="2"/>
<datapoint name="VirtualDevices.INT0000022:1.AUTO_MODE" type="AUTO_MODE" ise_id="3853" value="" valuetype="2" valueunit="" timestamp="0" operations="2"/>
<datapoint name="VirtualDevices.INT0000022:1.SET_TEMPERATURE" type="SET_TEMPERATURE" ise_id="3869" value="5.000000" valuetype="4" valueunit="°C" timestamp="1684869567" operations="7"/>
<datapoint name="VirtualDevices.INT0000022:1.ACTUAL_TEMPERATURE" type="ACTUAL_TEMPERATURE" ise_id="3852" value="21.000000" valuetype="4" valueunit="°C" timestamp="1684869567" operations="5"/>
<datapoint name="VirtualDevices.INT0000022:1.MANU_MODE" type="MANU_MODE" ise_id="3858" value="" valuetype="4" valueunit="°C" timestamp="0" operations="2"/>
<datapoint name="VirtualDevices.INT0000022:1.COMFORT_MODE" type="COMFORT_MODE" ise_id="3855" value="" valuetype="2" valueunit="" timestamp="0" operations="2"/>
<datapoint name="VirtualDevices.INT0000022:1.LOWERING_MODE" type="LOWERING_MODE" ise_id="3857" value="" valuetype="2" valueunit="" timestamp="0" operations="2"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_TEMPERATURE" type="PARTY_TEMPERATURE" ise_id="3868" value="5.000000" valuetype="4" valueunit="°C" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_START_TIME" type="PARTY_START_TIME" ise_id="3862" value="0" valuetype="16" valueunit="minutes" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_START_DAY" type="PARTY_START_DAY" ise_id="3860" value="1" valuetype="16" valueunit="day" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_START_MONTH" type="PARTY_START_MONTH" ise_id="3861" value="1" valuetype="16" valueunit="month" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_START_YEAR" type="PARTY_START_YEAR" ise_id="3863" value="0" valuetype="16" valueunit="year" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_STOP_TIME" type="PARTY_STOP_TIME" ise_id="3866" value="0" valuetype="16" valueunit="minutes" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_STOP_DAY" type="PARTY_STOP_DAY" ise_id="3864" value="1" valuetype="16" valueunit="day" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_STOP_MONTH" type="PARTY_STOP_MONTH" ise_id="3865" value="1" valuetype="16" valueunit="month" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_STOP_YEAR" type="PARTY_STOP_YEAR" ise_id="3867" value="0" valuetype="16" valueunit="year" timestamp="1684869567" operations="3"/>
<datapoint name="VirtualDevices.INT0000022:1.PARTY_MODE_SUBMIT" type="PARTY_MODE_SUBMIT" ise_id="3859" value="" valuetype="20" valueunit="" timestamp="0" operations="2"/>
</channel>
<channel name="Heizung Hobbyraum 2" ise_id="3870" index="2" visible="true" operate="true">
<datapoint name="VirtualDevices.INT0000022:2.STATE" type="STATE" ise_id="3871" value="true" valuetype="2" valueunit="" timestamp="1684828593" operations="5"/>
</channel>
</device>

*/



function HM_CC_VG_1($component) {
    if ($component['parent_device_interface'] == 'VirtualDevices' && $component['visible'] == 'true' && isset($component['CONTROL_MODE'])) {
		
		 global $export;
		// print_r($component);
    $obj = $export;
	//echo substr($component['name'], 0, -1)."2";
    //$key = array_search(substr($component['name'], 0, -1)."2", array_column($obj['channels'], 'name'));
	$key = array_search(substr($component['address'], 0, -1)."2", array_column($obj['channels'], 'address'));
	//echo "#".$key;
    foreach($obj['channels'][$key]['datapoints'] as $datapoint)
	
    { 
	//echo "<br>".$datapoint['ise_id'];
	$State_component[$datapoint['type']] = $datapoint['ise_id']; 
	}
	
	
    if(!isset($component['button'])) {
        $component['button'] = 'switch';
    }
	
        $modalId = mt_rand();
        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                .'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . ($component['ACTUAL_TEMPERATURE']-12) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                    . '<span class="info" data-id="' . $State_component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
                    . '<span class="info" data-id="' . $component['ACTUAL_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="ACTUAL_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['SET_TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="SET_TEMPERATURE"></span>'
                    . '<span class="info" data-id="' . $component['CONTROL_MODE'] . '" data-component="' . $component['component'] . '" data-datapoint="CONTROL_MODE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
            . '<div class="hh2 collapse" id="' . $modalId . '">
                <div class="row text-center">'
                    . '<div class="form-inline">'
                        . '<div class="input-group">'
                            . '<input type="number" name="' . $component['SET_TEMPERATURE'] . '" min="4.5" max="30.5" class="form-control" placeholder="Zahl eingeben">'
                            . '<span class="input-group-btn">'
                                . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . $component['SET_TEMPERATURE'] . '" data-set-value="">OK</button>'
                            . '</span>'
                        . '</div>'
                        . '<div class="btn-group">'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMFORT_MODE'] . '" data-set-value="1">'
                                . 'Komfort'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LOWERING_MODE'] . '" data-set-value="1">'
                                . 'Absenkung'
                            . '</button>'
                        . '</div>'
                    . '</div>'                    
                . '</div>'
                . '<div class="row text-center top15">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['AUTO_MODE'] . '" data-set-value="1">'
                            . 'Auto'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['MANU_MODE'] . '" data-set-value="1">'
                            . 'Manu'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['BOOST_MODE'] . '" data-set-value="1">'
                            . 'Boost'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'
        . '</div>';
    }
}
