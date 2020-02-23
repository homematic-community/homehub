<?php

// HM-OU-LED16|LEDAnzeige:0||VISIBLE=|OPERATE=|UNREACH=4521|STICKY_UNREACH=4517|CONFIG_PENDING=4510|RSSI_DEVICE=4515|RSSI_PEER=4516|LED_STATUS=4514|
// HM-OU-LED16|HM-OU-LED16:1||VISIBLE=true|OPERATE=true|PRESS_SHORT=4529|LED_STATUS=4528|ALL_LEDS=4526|
// HM-OU-LED16|HM-OU-LED16:2||VISIBLE=true|OPERATE=true|PRESS_SHORT=4534|LED_STATUS=4533|ALL_LEDS=4531|
// HM-OU-LED16|HM-OU-LED16:3||VISIBLE=true|OPERATE=true|PRESS_SHORT=4539|LED_STATUS=4538|ALL_LEDS=4536|
// HM-OU-LED16|HM-OU-LED16:4||VISIBLE=true|OPERATE=true|PRESS_SHORT=4544|LED_STATUS=4543|ALL_LEDS=4541|
// HM-OU-LED16|HM-OU-LED16:5||VISIBLE=true|OPERATE=true|PRESS_SHORT=4549|LED_STATUS=4548|ALL_LEDS=4546|
// HM-OU-LED16|HM-OU-LED16:6||VISIBLE=true|OPERATE=true|PRESS_SHORT=4554|LED_STATUS=4553|ALL_LEDS=4551|
// HM-OU-LED16|HM-OU-LED16:7||VISIBLE=true|OPERATE=true|PRESS_SHORT=4559|LED_STATUS=4558|ALL_LEDS=4556|
// HM-OU-LED16|HM-OU-LED16:8||VISIBLE=true|OPERATE=true|PRESS_SHORT=4564|LED_STATUS=4563|ALL_LEDS=4561|
// HM-OU-LED16|HM-OU-LED16:9||VISIBLE=true|OPERATE=true|PRESS_SHORT=4569|LED_STATUS=4568|ALL_LEDS=4566|
// HM-OU-LED16|HM-OU-LED16:10||VISIBLE=true|OPERATE=true|PRESS_SHORT=4574|LED_STATUS=4573|ALL_LEDS=4571|
// HM-OU-LED16|HM-OU-LED16:11||VISIBLE=true|OPERATE=true|PRESS_SHORT=4579|LED_STATUS=4578|ALL_LEDS=4576|
// HM-OU-LED16|HM-OU-LED16:12||VISIBLE=true|OPERATE=true|PRESS_SHORT=4584|LED_STATUS=4583|ALL_LEDS=4581|
// HM-OU-LED16|HM-OU-LED16:13||VISIBLE=true|OPERATE=true|PRESS_SHORT=4589|LED_STATUS=4588|ALL_LEDS=4586|
// HM-OU-LED16|HM-OU-LED16:14||VISIBLE=true|OPERATE=true|PRESS_SHORT=4594|LED_STATUS=4593|ALL_LEDS=4591|
// HM-OU-LED16|HM-OU-LED16:15||VISIBLE=true|OPERATE=true|PRESS_SHORT=4599|LED_STATUS=4598|ALL_LEDS=4596|
// HM-OU-LED16|HM-OU-LED16:16||VISIBLE=true|OPERATE=true|PRESS_SHORT=4604|LED_STATUS=4603|ALL_LEDS=4601|

// LOWBAT wird nicht angezeigt

// Validated by Manu

function HM_OU_LED16($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['PRESS_SHORT'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LED_STATUS'] . '" data-component="' . $component['component'] . '" data-datapoint="LED_STATUS"></span>'
                . '<span class="set btn-text" data-set-id="' . $component['PRESS_SHORT'] . '" data-set-value="1">Kurz</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
