<?php

// HM-Sec-SCo|Badezimmer Fenster:0||VISIBLE=|OPERATE=|UNREACH=1416|STICKY_UNREACH=1412|CONFIG_PENDING=1398|LOWBAT=1406|RSSI_DEVICE=1410|RSSI_PEER=1411|DEVICE_IN_BOOTLOADER=1402|UPDATE_PENDING=1420|
// HM-Sec-SCo|Badezimmer Fenster:1||VISIBLE=true|OPERATE=true|STATE=1449|ERROR=1425|LOWBAT=1448|

// Validated by Braindead, steingarten

function HM_Sec_SCo($component) {
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
      if (!isset($component['color'])) $component['color'] = '#595959';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LOWBAT'] . '" data-component="' . $component['component'] . '" data-datapoint="LOWBAT"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
