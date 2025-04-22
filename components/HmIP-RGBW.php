<?php
function HmIP_RGBW($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['LEVEL'])) {
        $modalId = mt_rand();
        // COMBINED_PARAMETER
        if (!isset($component['color'])) $component['color'] = '#FFCC00';
		    if(!isset($component['button'])) {
        $component['button'] = '';
    }
        return '<div class="hh" style=\'border-left-color: '.$component['color']. '; border-left-style: solid;\'>'
            . '<!--<div data-toggle="collapse" data-target="#' . $modalId . '">-->'
				. '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
				. '<div class="pull-right">'
				. '<span class="info" data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" id ="dim'.$component['LEVEL']. 'rahmen" data-datapoint="LEVEL"></span>&nbsp;&nbsp;|&nbsp;&nbsp;'
				. '<input class="info" data-id="' . $component['HUE']. '" data-component="' . $component['component'] . '" id="hue_'.$component['HUE']. '" data-datapoint="HUE" style="display:none;">'
				. '<input class="info" data-id="' . $component['SATURATION'] . '" data-component="' . $component['component'] . '" id="hue_'.$component['SATURATION']. '" data-datapoint="SATURATION" style="display:none;">'
				. '<input type="color"  id="color_'.$component['HUE']. '"  onchange="hue'.$component['HUE']. 'change();">&nbsp;&nbsp;|'
				. '<span class="info set"  data-id="' . $component['LEVEL'] . '" data-component="' . $component['component'] . '" data-datapoint="LEVEL" data-set-id="' . $component['LEVEL'] . '" data-button="' . $component['button'] . '" data-set-value=""></span>'
				. '<script type="text/javascript">'."\n"
				. 'function hue'.$component['HUE']. '() {'." \n"
					. 'let  hue'.$component['HUE']. ' = document.getElementById("hue_'.$component['HUE']. '").value;'	
					. 'let  sat'.$component['HUE']. ' = (document.getElementById("hue_'.$component['SATURATION']. '").value * 100);'	
					. 'h=hue'.$component['HUE']."\n"
					. 's=sat'.$component['HUE']." \n"
					. 'l=50;'."\n"

					. 's /= 100;'."\n"
					. 'l /= 100;'."\n"

					. 'let c = (1 - Math.abs(2 * l - 1)) * s,'."\n"
					. '  x = c * (1 - Math.abs((h / 60) % 2 - 1)),'."\n"
					. 'm = l - c/2,'."\n"
					. 'r = 0,'."\n"
					. 'g = 0, '."\n"
					. 'b = 0; '."\n"

					. 'if (0 <= h && h < 60) {'."\n"
					. '    r = c; g = x; b = 0;'."\n"
					. '} else if (60 <= h && h < 120) {'."\n"
					. '    r = x; g = c; b = 0;'."\n"
					. '} else if (120 <= h && h < 180) {'."\n"
					. '    r = 0; g = c; b = x;'."\n"
					. '  } else if (180 <= h && h < 240) {'."\n"
					. 'r = 0; g = x; b = c;'."\n"
					. '} else if (240 <= h && h < 300) {'."\n"
					. '    r = x; g = 0; b = c;'."\n"
					. '  } else if (300 <= h && h < 360) {'."\n"
					. 'r = c; g = 0; b = x;'."\n"
					. '}'

					. 'r = Math.round((r + m) * 255).toString(16);'."\n"
					. 'g = Math.round((g + m) * 255).toString(16);'."\n"
					. 'b = Math.round((b + m) * 255).toString(16);'."\n"


					. 'if (r.length == 1)'."\n"
					. '    r = "0" + r;'."\n"
					. '  if (g.length == 1)'."\n"
					. 'g = "0" + g;'."\n"
					. 'if (b.length == 1)'."\n"
					. '    b = "0" + b;'."\n"
					. 'console.log("hue -> " + h + " | sat -> " +s + " | ergibt -> #"  + r + g + b);'					
					. 'document.getElementById("color_'.$component['HUE']. '").value = "#" + r + g + b'."\n"

				. '}'." \n"
				. 'setTimeout(hue'.$component['HUE']. ', 2000);'." \n"
				. 'setInterval(hue'.$component['HUE']. ', 10000);'." \n"
				
				
				. 'function hue'.$component['HUE']. 'change() {'." \n"
				. 'let H = document.getElementById("color_'.$component['HUE']. '").value;'."\n"
  . 'let r = 0, g = 0, b = 0;'." \n"
  . 'if (H.length == 4) {'." \n"
  . '  r = "0x" + H[1] + H[1];'." \n"
  . '  g = "0x" + H[2] + H[2];'." \n"
. '    b = "0x" + H[3] + H[3];'." \n"
  . '} else if (H.length == 7) {'." \n"
    . 'r = "0x" + H[1] + H[2];'." \n"
    . 'g = "0x" + H[3] + H[4];'." \n"
    . 'b = "0x" + H[5] + H[6];'." \n"
  . '}'." \n"
  . '// Then to HSL'." \n"
  . 'r /= 255;'." \n"
  . 'g /= 255;'." \n"
  . 'b /= 255;'." \n"
  . 'let cmin = Math.min(r,g,b),'." \n"
      . 'cmax = Math.max(r,g,b),'." \n"
      . 'delta = cmax - cmin,'." \n"
      . 'h = 0,'." \n"
      . 's = 0,'." \n"
      . 'l = 0;'." \n"

  . 'if (delta == 0)'." \n"
    . 'h = 0;'." \n"
  . 'else if (cmax == r)'." \n"
    . 'h = ((g - b) / delta) % 6;'." \n"
  . 'else if (cmax == g)'." \n"
    . 'h = (b - r) / delta + 2;'." \n"
  . 'else'." \n"
    . 'h = (r - g) / delta + 4;'." \n"

  . 'h = Math.round(h * 60);'." \n"

. '  if (h < 0)'." \n"
    . 'h += 360;'." \n"

  . 'l = (cmax + cmin) / 2;'." \n"
  . 's = delta == 0 ? 0 : delta / (1 - Math.abs(2 * l - 1));'." \n"
  . 's = +(s * 100).toFixed(1);'." \n"
  . 'l = +(l * 100).toFixed(1);'." \n"


					.'// console.log("Neuer Wert -> "+ h + "," + s + "%," + l + "%");'	."\n"

					.'setDatapoint("'.$component['COMBINED_PARAMETER'].'", "\"L=50,RT=1,H="+Math.ceil(h)+",SAT="+Math.ceil(s)+",OT=0,RTTDV=0,RTTDU=0\"");'."\n"
				. '}'."\n"


				. '</script>'."\n"
                . '</div>'
                . '<div class="clearfix"></div>'
            . '</div>';
    }
}



/*



            . '<!--<div class="hh2 collapse" id="' . $modalId . '">'
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
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=0,RT=1,H=0,SAT=0,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Aus'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=0,SAT=0,OT=0,RTTDV=0,RTTDU=0">'
                                    . 'Weiß'
                                . '</button>'
                                . '<button type="button" class="btn btn-primary set" data-set-id="' . $component['COMBINED_PARAMETER'] . '" data-set-value="L=100,RT=1,H=0,SAT=100,OT=0,RTTDV=0,RTTDU=0">'
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
            . '</div>'
        . '</div>-->'
		
		*/