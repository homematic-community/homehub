<?php

// HMW-RCV-50|HMW-RCV-50 BidCos-Wired:0|BidCos-Wired|BidCos-Wired|0|VISIBLE=|OPERATE=|INSTALL_MODE=1013|
// HMW-RCV-50|Virtuell Jalousie morgens:1|BidCos-Wired|BidCos-Wired|1|VISIBLE=true|OPERATE=true|PRESS_LONG=1016|PRESS_SHORT=1017|LEVEL=1015|
// HMW-RCV-50|Virtuell Jalousie abends:2|BidCos-Wired|BidCos-Wired|2|VISIBLE=true|OPERATE=true|PRESS_LONG=1020|PRESS_SHORT=1021|LEVEL=1019|
// HMW-RCV-50|Virtuell Jalousie Beschattung:3|BidCos-Wired|BidCos-Wired|3|VISIBLE=true|OPERATE=true|PRESS_LONG=1024|PRESS_SHORT=1025|LEVEL=1023|
// HMW-RCV-50|Virtuelle Fernbedienung:4|BidCos-Wired|BidCos-Wired|4|VISIBLE=true|OPERATE=true|PRESS_LONG=1028|PRESS_SHORT=1029|LEVEL=1027|
// HMW-RCV-50|Virtuelle Fernbedienung:5|BidCos-Wired|BidCos-Wired|5|VISIBLE=true|OPERATE=true|PRESS_LONG=1032|PRESS_SHORT=1033|LEVEL=1031|
// HMW-RCV-50|Virtuelle Fernbedienung:6|BidCos-Wired|BidCos-Wired|6|VISIBLE=true|OPERATE=true|PRESS_LONG=1036|PRESS_SHORT=1037|LEVEL=1035|
// bis 50

function HMW_RCV_50($component) {
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
}
