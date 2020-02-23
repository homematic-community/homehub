<?php

// HM-RCV-50|HM-RCV-50 BidCos-RF:0|BidCos-RF|BidCos-RF|0|VISIBLE=|OPERATE=|INSTALL_MODE=1013|
// HM-RCV-50|Virtuell Jalousie morgens:1|BidCos-RF|BidCos-RF|1|VISIBLE=true|OPERATE=true|PRESS_LONG=1016|PRESS_SHORT=1017|LEVEL=1015|
// HM-RCV-50|Virtuell Jalousie abends:2|BidCos-RF|BidCos-RF|2|VISIBLE=true|OPERATE=true|PRESS_LONG=1020|PRESS_SHORT=1021|LEVEL=1019|
// HM-RCV-50|Virtuell Jalousie Beschattung:3|BidCos-RF|BidCos-RF|3|VISIBLE=true|OPERATE=true|PRESS_LONG=1024|PRESS_SHORT=1025|LEVEL=1023|
// HM-RCV-50|Virtuelle Fernbedienung:4|BidCos-RF|BidCos-RF|4|VISIBLE=true|OPERATE=true|PRESS_LONG=1028|PRESS_SHORT=1029|LEVEL=1027|
// HM-RCV-50|Virtuelle Fernbedienung:5|BidCos-RF|BidCos-RF|5|VISIBLE=true|OPERATE=true|PRESS_LONG=1032|PRESS_SHORT=1033|LEVEL=1031|
// HM-RCV-50|Virtuelle Fernbedienung:6|BidCos-RF|BidCos-RF|6|VISIBLE=true|OPERATE=true|PRESS_LONG=1036|PRESS_SHORT=1037|LEVEL=1035|
// bis 50

// Validated by Braindead

function HM_RCV_50($component) {
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
