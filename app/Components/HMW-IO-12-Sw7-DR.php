<?php

// HMW-IO-12-Sw7-DR|UK_Modul_03:0|BidCos-Wired||0|VISIBLE=|OPERATE=|UNREACH=2333|STICKY_UNREACH=2329|CONFIG_PENDING=2325|
// HMW-IO-12-Sw7-DR|RA_Kellertreppe_Taster|BidCos-Wired||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=2340|PRESS_LONG=2339|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:2|BidCos-Wired||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=2344|PRESS_LONG=2343|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:3|BidCos-Wired||3|VISIBLE=true|OPERATE=true|PRESS_SHORT=2348|PRESS_LONG=2347|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:4|BidCos-Wired||4|VISIBLE=true|OPERATE=true|PRESS_SHORT=2352|PRESS_LONG=2351|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:5|BidCos-Wired||5|VISIBLE=true|OPERATE=true|PRESS_SHORT=2356|PRESS_LONG=2355|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:6|BidCos-Wired||6|VISIBLE=true|OPERATE=true|PRESS_SHORT=2360|PRESS_LONG=2359|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:7|BidCos-Wired||7|VISIBLE=true|OPERATE=true|PRESS_SHORT=2364|PRESS_LONG=2363|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:8|BidCos-Wired||8|VISIBLE=true|OPERATE=true|PRESS_SHORT=2368|PRESS_LONG=2367|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:9|BidCos-Wired||9|VISIBLE=true|OPERATE=true|PRESS_SHORT=2372|PRESS_LONG=2371|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:10|BidCos-Wired||10|VISIBLE=true|OPERATE=true|PRESS_SHORT=2376|PRESS_LONG=2375|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:11|BidCos-Wired||11|VISIBLE=true|OPERATE=true|PRESS_SHORT=2380|PRESS_LONG=2379|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:12|BidCos-Wired||12|VISIBLE=true|OPERATE=true|PRESS_SHORT=2384|PRESS_LONG=2383|
// HMW-IO-12-Sw7-DR|RA16_Kellertreppe_Wandleuchten|BidCos-Wired||13|VISIBLE=true|OPERATE=true|STATE=2388|
// HMW-IO-12-Sw7-DR|RA26_Flur_Weihnachtsbeleuchtung|BidCos-Wired||14|VISIBLE=true|OPERATE=true|STATE=2393|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:15|BidCos-Wired||15|VISIBLE=true|OPERATE=true|STATE=2398|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:16|BidCos-Wired||16|VISIBLE=true|OPERATE=true|STATE=2403|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:17|BidCos-Wired||17|VISIBLE=true|OPERATE=true|STATE=2408|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:18|BidCos-Wired||18|VISIBLE=true|OPERATE=true|STATE=2413|
// HMW-IO-12-Sw7-DR|HMW-IO-12-Sw7-DR:19|BidCos-Wired||19|VISIBLE=true|OPERATE=true|STATE=2418|

// validated by cd84

function HMW_IO_12_Sw7_DR($component) {
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
