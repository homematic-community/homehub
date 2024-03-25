<?php
// VIR-LG-RGBW-DIM (VIR-LG-WHITE-DIM)
// 20230820 PL
// Vorlage HmIP-RGBW, Änderung, Schnittstelle VirtualDevices, LEVEL, Rest auskommentiert.  

/*
</device>
<device name="Arbeitszimmer HU-Surimu" ise_id="75302">

{"name":"Arbeitszimmer HU-Surimu","address":"HU-Hue Surimu ","ise_id":"75302","interface":"VirtualDevices","device_type":"","ready_config":"true"}

<channel name="Arbeitszimmer HU-Surimu:0" ise_id="75303" index="0" visible="true" operate="true"/>
<channel name="Arbeitszimmer HU-Surimu:1" ise_id="75304" index="1" visible="true" operate="true">
	<datapoint name="VirtualDevices.HU-Hue Surimu :1.LEVEL" type="LEVEL" ise_id="75305" value="0.000000" valuetype="4" valueunit="100%" timestamp="1692379861" operations="3"/>
	<datapoint name="VirtualDevices.HU-Hue Surimu :1.RGBW" type="RGBW" ise_id="75306" value="rgb(0,0,0)" valuetype="20" valueunit="" timestamp="1692379861" operations="3"/>
	<datapoint name="VirtualDevices.HU-Hue Surimu :1.WHITE" type="WHITE" ise_id="75307" value="6100.000000" valuetype="4" valueunit="100%" timestamp="1692379861" operations="3"/>
</channel>
</device>

Kein geräte Typ!
{"component":"","parent_device_type":"","parent_device_interface":"VirtualDevices","name":"Arbeitszimmer HU-Surimu:0","type":"30","address":"HU-Hue Surimu :0","ise_id":"75303","direction":"UNKNOWN","parent_device":"75302","index":"0","group_partner":"","aes_available":"false","transmission_mode":"DEFAULT","visible":"true","ready_config":"true","operate":"true"},{"component":"","parent_device_type":"","parent_device_interface":"VirtualDevices","name":"Arbeitszimmer HU-Surimu:1","type":"17","address":"HU-Hue Surimu :1","ise_id":"75304","direction":"UNKNOWN","parent_device":"75302","index":"1","group_partner":"","aes_available":"false","transmission_mode":"DEFAULT","visible":"true","ready_config":"true","operate":"true","datapoints":[{"name":"VirtualDevices.HU-Hue Surimu :1.LEVEL","type":"LEVEL","ise_id":"75305","state":"0.000000","value":"0.000000","valuetype":"4","valueunit":"100%","timestamp":"1692379861","operations":"3"},{"name":"VirtualDevices.HU-Hue Surimu :1.RGBW","type":"RGBW","ise_id":"75306","state":"rgb(0,0,0)","value":"rgb(0,0,0)","valuetype":"20","valueunit":"","timestamp":"1692379861","operations":"3"},
{"name":"VirtualDevices.HU-Hue Surimu :1.WHITE","type":"WHITE","ise_id":"75307","state":"6100.000000","value":"6100.000000","valuetype":"4","valueunit":"100%","timestamp":"1692379861","operations":"3"}]}


<device name="Wohnzimmer HU-Centris4er.Balken" ise_id="49761">
<channel name="Wohnzimmer HU-Centris4er.Balken:0" ise_id="49762" index="0" visible="true" operate="true"/>
<channel name="Wohnzimmer HU-Centris4er.Balken:1" ise_id="49763" index="1" visible="true" operate="true">
<datapoint name="VirtualDevices.HU-Hue Centris:1.LEVEL" type="LEVEL" ise_id="49764" value="0.000000" valuetype="4" valueunit="100%" timestamp="1692477557" operations="3"/>
<datapoint name="VirtualDevices.HU-Hue Centris:1.RGBW" type="RGBW" ise_id="49765" value="rgb(0,0,0)" valuetype="20" valueunit="" timestamp="1692477557" operations="3"/>
<datapoint name="VirtualDevices.HU-Hue Centris:1.WHITE" type="WHITE" ise_id="49766" value="2700.000000" valuetype="4" valueunit="100%" timestamp="1692477557" operations="3"/>
</channel>
*/


function VIR_LG_WHITE_DIM($component) {
    
    if ($component['parent_device_interface'] == 'VirtualDevices' && $component['visible'] == 'true' && isset($component['LEVEL'])) {
      $modalId = mt_rand();
    
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
        
        return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div data-toggle="collapse" data-target="#' . $modalId . '">'
                . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                . '<div class="pull-right">'
                    . '<span class="info" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL"></span>'
                    /*. '<span class="info" data-id="' . $component['RGBW'] . '" data-component="' . $component['component'] . '" data-datapoint="RGBW" style="margin-left: 9px"></span>'*/
                    /*. '<span class="info" data-id="' . $component['SATURATION'] . '" data-component="' . $component['component'] . '" data-datapoint="SATURATION" style="margin-top: -28px; margin-left: -16px"></span>'*/
                    /*. '<span class="info" data-id="' . $component['LEVEL'] . '_dot" data-component="' . $component['component'] . '" data-datapoint="LEVEL" style="margin-top: -28px; margin-left: -16px"></span>'*/
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
                /*
                . '<div class="row text-center top15">'
                    . '<div class="row text-center">'
                        . '<div class="form-inline">'
                            . '<div class="btn-group">'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="rgb(0,0,0)">'
                                    . 'Aus'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="rgb(255,255,255)">'
                                    . 'Weiß'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="rgb(40,43,51)">'
                                    . 'Rot'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=60,SAT=100,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Gelb'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=120,SAT=100,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Gr&uuml;n'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=180,SAT=100,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Cyan'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=240,SAT=100,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Blau'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=300,SAT=100,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Lila'
                                . '</button>'
                            . '</div>'
                        . '</div>'
                    . '</div>'
                . '</div>'          
                */
            . '</div>'
        . '</div>';
    }
}