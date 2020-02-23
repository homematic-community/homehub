<?php

// HM-WDS10-TH-O|Garten Wetter Web:0|CUxD|CUX9002001|VISIBLE=|OPERATE=|UNREACH=5467|
// HM-WDS10-TH-O|Garten Wetter Web:1|CUxD|CUX9002001|VISIBLE=true|OPERATE=true|TEMPERATURE=5479|HUMIDITY=5474|DEW_POINT=5473|ABS_HUMIDITY=5472|TEMP_MIN_24H=5481|TEMP_MAX_24H=5480|HUM_MIN_24H=5476|HUM_MAX_24H=5475|
// HM-WDS10-TH-O|Garten Wetter Web:2|CUxD|CUX9002001|VISIBLE=true|OPERATE=true|
// HM-WDS10-TH-O|Garten Wetter Web:3|CUxD|CUX9002001|VISIBLE=true|OPERATE=true|

// Validated by Braindead

function CUX9002($component) {
    if ($component['parent_device_interface'] == 'CUxD' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        $datapoints = array();
        
        if(isset($component['TEMPERATURE'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>';
        }
        if(isset($component['HUMIDITY'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>';
        }
        if(isset($component['DEW_POINT'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['DEW_POINT'] . '" data-component="' . $component['component'] . '" data-datapoint="DEW_POINT"></span>';
        }
        if(isset($component['ABS_HUMIDITY'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['ABS_HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="ABS_HUMIDITY"></span>';
        }
        if(isset($component['TEMP_MIN_24H'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['TEMP_MIN_24H'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMP_MIN_24H"></span>';
        }
        if(isset($component['TEMP_MAX_24H'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['TEMP_MAX_24H'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMP_MAX_24H"></span>';
        }
        if(isset($component['HUM_MIN_24H'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['HUM_MIN_24H'] . '" data-component="' . $component['component'] . '" data-datapoint="HUM_MIN_24H"></span>';
        }
        if(isset($component['HUM_MAX_24H'])) {
            $datapoints[] = '<span class="info" data-id="' . $component['HUM_MAX_24H'] . '" data-component="' . $component['component'] . '" data-datapoint="HUM_MAX_24H"></span>';
        }
        
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . implode('', $datapoints)
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
