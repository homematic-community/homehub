<?php


function HmIP_MOD_HO($component) 
{
	if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['DOOR_STATE']) ) 
	{
        $modalId = mt_rand();
        return '<div class="hh">'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
						.'<span class="info" data-id="' . $component['DOOR_STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="DOOR_STATE"></span>'
						.'<span class="set btn-action" data-id="' . $component['DOOR_STATE'] . '_2" data-component="' . $component['component'] . '" data-datapoint="DOOR_COMMAND" data-set-id="' . $component['DOOR_COMMAND'] . '" data-set-value="4" style="margin-bottom:5px;">Lüften</span>'
						.'<span class="set btn-action" data-id="' . $component['DOOR_STATE'] . '_1" data-component="' . $component['component'] . '" data-datapoint="DOOR_COMMAND" data-set-id="' . $component['DOOR_COMMAND'] . '" data-set-value="1">auf</span>'
						.'<span class="set btn-action" data-id="' . $component['DOOR_STATE'] . '_0" data-component="' . $component['component'] . '" data-datapoint="DOOR_COMMAND" data-set-id="' . $component['DOOR_COMMAND'] . '" data-set-value="3">zu</span>'

					.'</div>'
					.'<div class="clearfix"></div>'
				.'</div>';
    }
}
