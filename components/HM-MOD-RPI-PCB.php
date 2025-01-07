<?php   
function HM_MOD_RPI_PCB($component) {
   // if ($component['parent_device_interface'] == 'HmIP-RF' ) {
        $modalId = mt_rand();        
        if (!isset($component['color'])) $component['color'] = '#00CC33';
      

  return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                .'Belegung Funkband<span class="info" data-id="' . $component['CARRIER_SENSE_LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="CARRIER_SENSE_LEVEL"></span>&nbsp;|&nbsp;'
                    . 'Duty Cycle<span class="info" data-id="' . $component['DUTY_CYCLE_LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="DUTY_CYCLE_LEVEL"></span>'

                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>'
   
        . '</div>';
    }
//}
