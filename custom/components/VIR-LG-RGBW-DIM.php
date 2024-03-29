<?php
// VIR-LG-RGBW-DIM (VIR-LG-WHITE-DIM)
// 20230820 PL
// Vorlage HmIP-RGBW, Änderung, Schnittstelle VirtualDevices, LEVEL,+  

/*
script.js.php
Änderung: 
url: XMLURL + '?statechange.cgi&sid=' + apitoken + '&ise_id=' + id + '&new_value=' + escape(value),
Neu:
url: XMLURL + '?statechange.cgi&sid=' + apitoken + '&ise_id=' + id + '&new_value=' + encodeURIComponent(value),

Übergibt "rgb(0,255,0)" nicht korrekt bzw. 'escape' ist veraltet.
Siehe https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/escape?retiredLocale=de

XML gibt es einer Sonder Abfrage rgb* > somit kann leider nur rgb(...,...,...) übertragen werden oder WHITE und oder LEVEL.

<datapoint name="VirtualDevices.HU-Hue Centris:1.LEVEL" type="LEVEL" ise_id="49764" value="0.2" valuetype="4" valueunit="100%" timestamp="xxxxxxxxxx" operations="3"/>
<datapoint name="VirtualDevices.HU-Hue Centris:1.RGBW" type="RGBW" ise_id="49765" value="rgb(0,255,0)" valuetype="20" valueunit="" timestamp="xxxxxxxxxx" operations="3"/>
<datapoint name="VirtualDevices.HU-Hue Centris:1.WHITE" type="WHITE" ise_id="49766" value="2700.000000" valuetype="4" valueunit="100%" timestamp="xxxxxxxxxx" operations="3"/>
*/



function VIR_LG_RGBW_DIM($component) {
	
	global $export;
  $obj = $export;
  $key = array_search(substr($component['address'], 0, -1)."0", array_column($obj['channels'], 'address'));
  foreach($obj['channels'][$key]['datapoints'] as $datapoint)
  { $status_component[$datapoint['type']] = $datapoint['ise_id']; }
  
  if ($component['parent_device_interface'] == 'VirtualDevices' && $component['visible'] == 'true' && isset($component['LEVEL'])) {
  	$modalId = mt_rand();
    if (!isset($component['color'])) $component['color'] = '#FFCC00';
      
    return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
         . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
            . '<div class="pull-left"><img src="icon/' . $component['icon'] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>'
        . '<div class="hh2 collapse" id="' . $modalId . '">'
            . '<div class="row text-center">'
                . '<div class="form-inline">'
                    . '<div class="btn-group">'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.0">'
                            . '<img src="icon/light_light_dim_00.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.2">'
                            . '<img src="icon/light_light_dim_20.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.4">'
                            . '<img src="icon/light_light_dim_40.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.6">'
                            . '<img src="icon/light_light_dim_60.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="0.8">'
                            . '<img src="icon/light_light_dim_80.png" />'
                        . '</button>'
                        . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['LEVEL'] . '" data-set-value="1.0">'
                            . '<img src="icon/light_light_dim_100.png" />'
                        . '</button>'
                    . '</div>'
                . '</div>'
            . '</div>'

            . '<div class="row text-center top15">'
                . '<div class="row text-center">'
                    . '<div class="form-inline">'
                        . '<div class="btn-group">'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['RGBW'] . '" data-set-value="rgb(142,109,30)">'
                              . 'Entspannen'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['RGBW'] . '" data-set-value="rgb(255,226,137)">'
                            	. 'Lesen'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['RGBW'] . '" data-set-value="rgb(242,247,255)">'
                            	. 'Konzentrieren'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['RGBW'] . '" data-set-value="rgb(181,196,255)">'
                              . 'Enerie tanken'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['WHITE'] . '" data-set-value="3500">'
                              . 'Warmweiß'
                            . '</button>'
                            . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['WHITE'] . '" data-set-value="6500">'
                              . 'Kaltweiß'
                            . '</button>'
                        . '</div>'
                    . '</div>'
                . '</div>'
            . '</div>'          
        . '</div>'
    . '</div>';
  }
}