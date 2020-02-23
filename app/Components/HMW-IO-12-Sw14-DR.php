<?php

// HMW-IO-12-Sw14-DR|UD_Modul_03:0|BidCos-Wired||0|VISIBLE=|OPERATE=|UNREACH=8522|STICKY_UNREACH=8518|CONFIG_PENDING=8514|
// HMW-IO-12-Sw14-DR|ROD34_GA2_RollladenAuf|BidCos-Wired||1|VISIBLE=true|OPERATE=true|STATE=8527|
// HMW-IO-12-Sw14-DR|ROD34_GA2_RollladenZu|BidCos-Wired||2|VISIBLE=true|OPERATE=true|STATE=8529|
// HMW-IO-12-Sw14-DR|ROD35_FLO_RollladenAuf|BidCos-Wired||3|VISIBLE=true|OPERATE=true|STATE=8531|
// HMW-IO-12-Sw14-DR|ROD35_FLO_RollladenZu|BidCos-Wired||4|VISIBLE=true|OPERATE=true|STATE=8533|
// HMW-IO-12-Sw14-DR|ROD36_BAD_RollladenAuf|BidCos-Wired||5|VISIBLE=true|OPERATE=true|STATE=8535|
// HMW-IO-12-Sw14-DR|ROD36_BAD_RollladenZu|BidCos-Wired||6|VISIBLE=true|OPERATE=true|STATE=8537|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:7|BidCos-Wired||7|VISIBLE=true|OPERATE=true|FREQUENCY=18399|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:8|BidCos-Wired||8|VISIBLE=true|OPERATE=true|FREQUENCY=18403|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:9|BidCos-Wired||9|VISIBLE=true|OPERATE=true|FREQUENCY=18401|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:10|BidCos-Wired||10|VISIBLE=true|OPERATE=true|FREQUENCY=18402|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:11|BidCos-Wired||11|VISIBLE=true|OPERATE=true|FREQUENCY=18400|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:12|BidCos-Wired||12|VISIBLE=true|OPERATE=true|FREQUENCY=18405|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:13|BidCos-Wired||13|VISIBLE=true|OPERATE=true|FREQUENCY=18404|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:14|BidCos-Wired||14|VISIBLE=true|OPERATE=true|FREQUENCY=18407|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:15|BidCos-Wired||15|VISIBLE=true|OPERATE=true|FREQUENCY=18406|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:16|BidCos-Wired||16|VISIBLE=true|OPERATE=true|FREQUENCY=18408|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:17|BidCos-Wired||17|VISIBLE=true|OPERATE=true|FREQUENCY=18412|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:18|BidCos-Wired||18|VISIBLE=true|OPERATE=true|FREQUENCY=18417|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:19|BidCos-Wired||19|VISIBLE=true|OPERATE=true|FREQUENCY=18411|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:20|BidCos-Wired||20|VISIBLE=true|OPERATE=true|FREQUENCY=18414|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:21|BidCos-Wired||21|VISIBLE=true|OPERATE=true|VALUE=18413|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:22|BidCos-Wired||22|VISIBLE=true|OPERATE=true|VALUE=18415|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:23|BidCos-Wired||23|VISIBLE=true|OPERATE=true|VALUE=18416|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:24|BidCos-Wired||24|VISIBLE=true|OPERATE=true|VALUE=18409|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:25|BidCos-Wired||25|VISIBLE=true|OPERATE=true|VALUE=18418|
// HMW-IO-12-Sw14-DR|HMW-IO-12-Sw14-DR:26|BidCos-Wired||26|VISIBLE=true|OPERATE=true|VALUE=18410|
// 
// Kanal 1-14 Ausgang und 15-26 Eingang
// oder alle digital mit STATE=

// validated by onkeltom

function HMW_IO_12_Sw14_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && $component['index'] >= 1 && $component['index'] <= 14) {
        if (isset($component['STATE'])) {
            return '<div class="hh">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
        
        if (isset($component['FREQUENCY'])) {
            $modalId = mt_rand();
        
            return '<div class="hh">'
                . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                    . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                    . '<div class="pull-right">'
                        . '<span class="info" data-id="' . $component['FREQUENCY'] . '" data-component="' . $component['component'] . '" data-datapoint="FREQUENCY"></span>'
                    . '</div>'
                    . '<div class="clearfix"></div>'
                . '</div>'
                . '<div class="hh2 collapse" id="' . $modalId . '">'
                    . '<div class="row text-center">'
                        . '<div class="form-inline">'
                            . '<input type="number" name="' . $component['FREQUENCY'] . '" min="0.0" max="50000.0" class="form-control" placeholder="Zahl eingeben">'
                            . '<span class="input-group-btn">'
                                . '<button class="btn btn-primary set" data-datapoint="4" data-set-id="' . $component['FREQUENCY'] . '" data-set-value="">OK</button>'
                            . '</span>'
                        . '</div>'
                    . '</div>'
                . '</div>'
            . '</div>';
        }
    }
    
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && $component['index'] >= 15 && $component['index'] <= 26) {
        if (isset($component['STATE'])) {
            return '<div class="hh">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
        
        if (isset($component['VALUE'])) {
            return '<div class="hh">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['VALUE'] . '" data-component="' . $component['component'] . '" data-datapoint="VALUE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
        
        if (isset($component['FREQUENCY'])) {
            return '<div class="hh">'
                . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['FREQUENCY'] . '" data-component="' . $component['component'] . '" data-datapoint="FREQUENCY"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
    }
}
