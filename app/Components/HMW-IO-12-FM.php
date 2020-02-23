<?php

// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:0|BidCos-Wired|LEQxxxxxxxx|0|VISIBLE=|OPERATE=|UNREACH=2746|STICKY_UNREACH=2742|CONFIG_PENDING=2738|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:1|BidCos-Wired|LEQxxxxxxxx|1|VISIBLE=true|OPERATE=true|STATE=2835|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:2|BidCos-Wired|LEQxxxxxxxx|2|VISIBLE=true|OPERATE=true|STATE=2829|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:3|BidCos-Wired|LEQxxxxxxxx|3|VISIBLE=true|OPERATE=true|STATE=2823|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:4|BidCos-Wired|LEQxxxxxxxx|4|VISIBLE=true|OPERATE=true|STATE=2826|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:5|BidCos-Wired|LEQxxxxxxxx|5|VISIBLE=true|OPERATE=true|STATE=2832|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:6|BidCos-Wired|LEQxxxxxxxx|6|VISIBLE=true|OPERATE=true|STATE=2838|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:7|BidCos-Wired|LEQxxxxxxxx|7|VISIBLE=true|OPERATE=true|STATE=2841|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:8|BidCos-Wired|LEQxxxxxxxx|8|VISIBLE=true|OPERATE=true|PRESS_SHORT=2781|PRESS_LONG=2780|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:9|BidCos-Wired|LEQxxxxxxxx|9|VISIBLE=true|OPERATE=true|PRESS_SHORT=2785|PRESS_LONG=2784|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:10|BidCos-Wired|LEQxxxxxxxx|10|VISIBLE=true|OPERATE=true|PRESS_SHORT=2789|PRESS_LONG=2788|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:11|BidCos-Wired|LEQxxxxxxxx|11|VISIBLE=true|OPERATE=true|PRESS_SHORT=2793|PRESS_LONG=2792|
// HMW-IO-12-FM|HMW-IO-12-FM LEQxxxxxxxx:12|BidCos-Wired|LEQxxxxxxxx|12|VISIBLE=true|OPERATE=true|PRESS_SHORT=2797|PRESS_LONG=2796|


function HMW_IO_12_FM($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
    
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
