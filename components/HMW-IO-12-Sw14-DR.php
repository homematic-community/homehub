<?php
function HMW_IO_12_Sw14_DR($component) {
    if ($component['parent_device_interface'] == 'BidCos-Wired' && $component['visible'] == 'true' && $component['index'] >= 1 && $component['index'] <= 14) {
        if (isset($component['STATE'])) {
            if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info set" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE" data-set-id="' . $component['STATE'] . '" data-set-value=""></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
        
        if (isset($component['FREQUENCY'])) {
            $modalId = mt_rand();
            if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                    . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
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
            if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
        
        if (isset($component['VALUE'])) {
            if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['VALUE'] . '" data-component="' . $component['component'] . '" data-datapoint="VALUE"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
        
        if (isset($component['FREQUENCY'])) {
            if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['FREQUENCY'] . '" data-component="' . $component['component'] . '" data-datapoint="FREQUENCY"></span>'
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
        }
    }
}
