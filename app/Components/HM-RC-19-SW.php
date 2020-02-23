<?php

// HM-RC-19-SW|Fernbedienung 19Tasten:0|BidCos-RF||0|VISIBLE=|OPERATE=|UNREACH=38275|STICKY_UNREACH=38271|CONFIG_PENDING=38261|LOWBAT=38265|RSSI_DEVICE=38269|RSSI_PEER=38270|
// HM-RC-19-SW|HM-RC-19-SW:1|BidCos-RF||1|VISIBLE=true|OPERATE=true|PRESS_SHORT=38284|PRESS_LONG=38282|
// HM-RC-19-SW|HM-RC-19-SW:2|BidCos-RF||2|VISIBLE=true|OPERATE=true|PRESS_SHORT=38290|PRESS_LONG=38288|
// HM-RC-19-SW|HM-RC-19-SW:3|BidCos-RF||3|VISIBLE=true|OPERATE=true|PRESS_SHORT=38296|PRESS_LONG=38294|
// HM-RC-19-SW|HM-RC-19-SW:4|BidCos-RF||4|VISIBLE=true|OPERATE=true|PRESS_SHORT=38302|PRESS_LONG=38300|
// HM-RC-19-SW|HM-RC-19-SW:5|BidCos-RF||5|VISIBLE=true|OPERATE=true|PRESS_SHORT=38308|PRESS_LONG=38306|
// HM-RC-19-SW|HM-RC-19-SW:6|BidCos-RF||6|VISIBLE=true|OPERATE=true|PRESS_SHORT=38314|PRESS_LONG=38312|
// HM-RC-19-SW|HM-RC-19-SW:7|BidCos-RF||7|VISIBLE=true|OPERATE=true|PRESS_SHORT=38320|PRESS_LONG=38318|
// HM-RC-19-SW|HM-RC-19-SW:8|BidCos-RF||8|VISIBLE=true|OPERATE=true|PRESS_SHORT=38326|PRESS_LONG=38324|
// HM-RC-19-SW|HM-RC-19-SW:9|BidCos-RF||9|VISIBLE=true|OPERATE=true|PRESS_SHORT=38332|PRESS_LONG=38330|
// HM-RC-19-SW|HM-RC-19-SW:10|BidCos-RF||10|VISIBLE=true|OPERATE=true|PRESS_SHORT=38338|PRESS_LONG=38336|
// HM-RC-19-SW|HM-RC-19-SW:11|BidCos-RF||11|VISIBLE=true|OPERATE=true|PRESS_SHORT=38344|PRESS_LONG=38342|
// HM-RC-19-SW|HM-RC-19-SW:12|BidCos-RF||12|VISIBLE=true|OPERATE=true|PRESS_SHORT=38350|PRESS_LONG=38348|
// HM-RC-19-SW|HM-RC-19-SW:13|BidCos-RF||13|VISIBLE=true|OPERATE=true|PRESS_SHORT=38356|PRESS_LONG=38354|
// HM-RC-19-SW|HM-RC-19-SW:14|BidCos-RF||14|VISIBLE=true|OPERATE=true|PRESS_SHORT=38362|PRESS_LONG=38360|
// HM-RC-19-SW|HM-RC-19-SW:15|BidCos-RF||15|VISIBLE=true|OPERATE=true|PRESS_SHORT=38368|PRESS_LONG=38366|
// HM-RC-19-SW|HM-RC-19-SW:16|BidCos-RF||16|VISIBLE=true|OPERATE=true|PRESS_SHORT=38374|PRESS_LONG=38372|
// HM-RC-19-SW|Temperatur und Zustand senden|BidCos-RF||17|VISIBLE=true|OPERATE=true|PRESS_SHORT=38380|PRESS_LONG=38378|
// HM-RC-19-SW|Display FB|BidCos-RF||18|VISIBLE=true|OPERATE=true|TEXT=38398|BULB=38389|SWITCH=38397|WINDOW=38400|DOOR=38391|BLIND=38388|SCENE=38394|PHONE=38393|BELL=38387|CLOCK=38390|ARROW_UP=38384|ARROW_DOWN=38383|UNIT=38399|BEEP=38386|BACKLIGHT=38385|SUBMIT=38396|ALARM_COUNT=38382|SERVICE_COUNT=38395|

// LOWBAT wird nicht angezeigt

// validated by ger.isi

function HM_RC_19_SW($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_LONG'] . '" data-set-value="1">Lang</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
