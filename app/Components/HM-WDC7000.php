<?php

// HM-WDC7000|Wetterstation-Innen Piano:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=1423|STICKY_UNREACH=1419|CONFIG_PENDING=1411|LOWBAT=1415|RSSI_DEVICE=27659|RSSI_PEER=27660|
// HM-WDC7000|Wetterstation Innen Piano|BidCos-RF||1|VISIBLE=true|OPERATE=true|
// HM-WDC7000|Temperatur Glashaus 1|BidCos-RF||2|VISIBLE=true|OPERATE=true|
// HM-WDC7000|Temperatur 1.Stock 1|BidCos-RF||3|VISIBLE=true|OPERATE=true|
// HM-WDC7000|Temperatur Heizungsspeicher 1|BidCos-RF||4|VISIBLE=true|OPERATE=true|
// HM-WDC7000|Pool-Temperatur 1|BidCos-RF||5|VISIBLE=true|OPERATE=true|
// HM-WDC7000|HM-WDC7000:6|BidCos-RF||6|VISIBLE=true|OPERATE=true|
// HM-WDC7000|HM-WDC7000:7|BidCos-RF||7|VISIBLE=true|OPERATE=true|
// HM-WDC7000|HM-WDC7000:8|BidCos-RF||8|VISIBLE=true|OPERATE=true|
// HM-WDC7000|HM-WDC7000:9|BidCos-RF||9|VISIBLE=true|OPERATE=true|
// HM-WDC7000|Wetterstation Innen Piano 1|BidCos-RF||10|VISIBLE=true|OPERATE=true|TEMPERATURE=1439|HUMIDITY=1438|AIR_PRESSURE=1437|

// Validated by ColleLupi

function HM_WDC7000($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['TEMPERATURE'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . ($component['TEMPERATURE']-24) . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['TEMPERATURE'] . '" data-component="' . $component['component'] . '" data-datapoint="TEMPERATURE"></span>'
                . '<span class="info" data-id="' . $component['HUMIDITY'] . '" data-component="' . $component['component'] . '" data-datapoint="HUMIDITY"></span>'
                . '<span class="info" data-id="' . $component['AIR_PRESSURE'] . '" data-component="' . $component['component'] . '" data-datapoint="AIR_PRESSURE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
