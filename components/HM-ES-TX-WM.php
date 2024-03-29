<?php
function HM_ES_TX_WM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true') {
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
		// LED Sensor
		if(isset($component['GAS_ENERGY_COUNTER'])) {
			return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
					. '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
					. '<div class="pull-right">'
					. '<span class="info" data-id="' . ($component['GAS_ENERGY_COUNTER']-21) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
					. '<span class="info" data-id="' . $component['GAS_ENERGY_COUNTER'] . '" data-component="' . $component['component'] . '" data-datapoint="GAS_ENERGY_COUNTER"></span>'
					. '<span class="info" data-id="' . $component['GAS_POWER'] . '" data-component="' . $component['component'] . '" data-datapoint="GAS_POWER"></span>'
					. '<span class="info" data-id="' . $component['ENERGY_COUNTER'] . '" data-component="' . $component['component'] . '" data-datapoint="ENERGY_COUNTER"></span>'
					. '<span class="info" data-id="' . $component['POWER'] . '" data-component="' . $component['component'] . '" data-datapoint="POWER"></span>'
				. '</div>'
				. '<div class="clearfix"></div>'
			. '</div>';
		}
		// IS-IEC Sensor
		else
		{
			return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
					. '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
					. '<div class="pull-right">'
					. '<span class="info" data-id="' . $component['IEC_ENERGY_COUNTER'] . '" data-component="' . $component['component'] . '" data-datapoint="IEC_ENERGY_COUNTER"></span>'
					. '<span class="info" data-id="' . $component['IEC_POWER'] . '" data-component="' . $component['component'] . '" data-datapoint="IEC_POWER"></span>'
				. '</div>'
				. '<div class="clearfix"></div>'
			. '</div>';
		}
    }
}
