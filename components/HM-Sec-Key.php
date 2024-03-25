<?php
function HM_Sec_Key($component) {  
    if ($component['parent_device_interface'] == 'BidCos-RF' && $component['visible'] == 'true' && isset($component['STATE'])) {
        $modalId = mt_rand();
        if (!isset($component['color'])) $component['color'] = '#FF0000';
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
              . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                  .'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
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
