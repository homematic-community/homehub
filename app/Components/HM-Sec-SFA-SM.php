<?php

// HM-Sec-SFA-SM|Alarmanlage:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=37850|STICKY_UNREACH=37846|CONFIG_PENDING=37808|LOWBAT=37828|DUTYCYCLE=37812|RSSI_DEVICE=37832|RSSI_PEER=37833|ERROR_POWER=37820|STICKY_POWER=37838|ERROR_SABOTAGE=37824|STICKY_SABOTAGE=37842|ERROR_BATTERY=37816|STICKY_BATTERY=37834|
// HM-Sec-SFA-SM|Sirene|BidCos-RF||1|VISIBLE=true|OPERATE=true|STATE=37862|ERROR_POWER=37856|ERROR_SABOTAGE=37857|ERROR_BATTERY=37855|LOWBAT=37860|
// HM-Sec-SFA-SM|Blitzlicht|BidCos-RF||2|VISIBLE=true|OPERATE=true|STATE=37872|ERROR_POWER=37866|ERROR_SABOTAGE=37867|ERROR_BATTERY=37865|LOWBAT=37870|

// LOWBAT wird nicht angezeigt

// validated by ger.isi

function HM_Sec_SFA_SM($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
