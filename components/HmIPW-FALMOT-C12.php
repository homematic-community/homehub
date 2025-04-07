<?php
function HmIPW_FALMOT_C12($component) {

    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['DATE_TIME_UNKNOWN'])) {       
    global $export;
    $obj = $export;
    $channels = "";
    $channelpos = 12;
    
	if (!isset($component['channels'])) $component['channels'] = "1,2,3,4,5,6,7,8,9,10,11,12";
	
	
    $totalchannels = 0;
    $temp_channel = explode(",", $component['channels']);
    for ($i = 0; $i < count((array)$temp_channel);$i++) {
        $showchannel[$temp_channel[$i]] = 1;
        $totalchannels += 1;
    }
		
	
    for ($i = count((array)$temp_channel); $i > 0; $i--) {
        $key = array_search(substr($component['address'], 0, -1).$i, array_column($obj['channels'], 'address'));

        foreach($obj['channels'][$key]['datapoints'] as $datapoint)
        { 
		  $component[$i][$datapoint['type']] = $datapoint['ise_id']; 
		  
		}
		/*
		print_r($component[$i]);
		echo "<hr>";
		echo $component[$i]['LEVEL'];
		echo "<hr>";
		*/
        if (isset($showchannel[$i])) {
            $channels = '<span style="font-size:5px;line-height:1;display: inline-block;height:30px;" class="info" data-id="' . $component[$i]['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL" data-channel="'.$i.'" data-channel-pos="'.$channelpos.'" data-channel-total="'.$totalchannels.'"></span>'.$channels;
            $channelpos -= 1;
        }
    }
    

        if (!isset($component['color'])) $component['color'] = '#00CC33';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right" style="max-height:30px;margin-top:-5px;margin-bottom:-15px;">'
                    . $channels
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
    }
}
