<?php

// HM-Sec-Key|Haustür-Schloss:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=19224|STICKY_UNREACH=19220|CONFIG_PENDING=19206|LOWBAT=19214|DUTYCYCLE=19210|RSSI_DEVICE=19218|RSSI_PEER=19219|
// HM-Sec-Key|Haustür-Schloss:1|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=19241|OPEN=19239|RELOCK_DELAY=19240|STATE_UNCERTAIN=19242|ERROR=19230|

// Validated by firephaser

function HM_Sec_Key($component) {  
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        $modalId = mt_rand();
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
              . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                  .'<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
              . '</div>'
              . '<div class="pull-right">'
                  . '<span class="info" data-id="' . ($component['STATE']-27) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                  . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
              . '</div>'
              . '<div class="clearfix"></div>'
              . '<div class="hh2 collapse" id="' . $modalId . '">'
                . '<div class="row text-center">'
                    . '<div class="btn-group">'
                    . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['OPEN'] . '" data-set-value="1">&Ouml;ffnen'
                    . '</button>'
                    . '</div>'
                . '</div>' 
            . '</div>'
            . '</div>';
    }
}
