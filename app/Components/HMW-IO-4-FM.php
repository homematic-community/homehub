<?php

// HMW-IO-4-FM|4-Fach-Modul-Cantina:0|BidCos-Wired||0|VISIBLE=|OPERATE=|UNREACH=2010|STICKY_UNREACH=2006|CONFIG_PENDING=2002|
// HMW-IO-4-FM|TeichLED-Mitte|BidCos-Wired||1|VISIBLE=true|OPERATE=true|STATE=58064|
// HMW-IO-4-FM|Teichpumpe rechts|BidCos-Wired||2|VISIBLE=true|OPERATE=true|STATE=58055|
// HMW-IO-4-FM|Teichpumpe rechts|BidCos-Wired||3|VISIBLE=true|OPERATE=true|PRESS_SHORT=2781|PRESS_LONG=2780|
// HMW-IO-4-FM|Teichpumpe rechts|BidCos-Wired||4|VISIBLE=true|OPERATE=true|PRESS_SHORT=2785|PRESS_LONG=2784|

// Validated by ColleLupi

function HMW_IO_4_FM($component) {
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
