<?php
?>
var timer;
$(document).ready(function () {
    updateDatapoints();

    $('.set').click(function () {
        var id = $(this).attr('data-set-id');
        var value = $(this).attr('data-set-value');
        var datapoint = $(this).attr('data-datapoint');

        if (datapoint == '4' || datapoint == '20') {
            value = $('[name="' + id + '"]').val();
        }
        else if (datapoint === 'DIMLEVEL') {
            value = $('[name="' + id + '"]').val();
            value = value/100;
        }

        setDatapoint(id, value);
    });

    $('.run').click(function () {
        var id = $(this).attr('data-run-id');

        runProgram(id);
    });
    $('.runmode').click(function () {
        var id = $(this).attr('data-run-id');

        setProgramMode(id);
    });	
});

var updateDatapoints = function () {
	window.clearTimeout(timer);
    //192.168.2.6/config/xmlapi/state.cgi?datapoint_id=    
    showTitle();
    var id = '';
    
    $('.info').each(function () {
        if (id === '') {
            id = $(this).attr('data-id');
        } else {
            id = id + ',' + $(this).attr('data-id');
        }
        
    });

	if (dev == "1") {
		XMLURL = 'dev/state.php';
	} else {
		XMLURL = 'interface.php';
	}			
    $.ajax({
        type: 'GET',
        url: XMLURL + '?state.cgi&datapoint_id=' + id,
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            $(xml).find('datapoint').each(function (index) {
                var ise_id = $(this).attr('ise_id');
                var value = $(this).attr('value');

                var component = $('[data-id="' + ise_id + '"]').attr('data-component');
                var datapoint = $('[data-id="' + ise_id + '"]').attr('data-datapoint');
                var unit = $('[data-id="' + ise_id + '"]').attr('data-unit');
                var valueList = $('[data-id="' + ise_id + '"]').attr('data-valuelist');
                
                if (!unit) {
                    unit = '';
                }
                if (!valueList) {
                    valueList = '';
                }

                switch (component) {  
					<?php
					// Custom_js  Dateien auslesen und einbeinden
					$alledateien = scandir("../custom/js"); 
					foreach ($alledateien as $datei) {
						$dateiinfo = pathinfo("../custom/js/".$datei); 
						if ($datei != "." && $datei != ".."  && $datei != "custom.js" && $datei != "ioBroker.js" && $dateiinfo['extension'] == "js") { 
							$customjs = file_get_contents("../custom/js/".$datei);
							echo $customjs;
							/*
							echo $datei;
							$customjs  = file("../custom/js/".$datei);
							for($i=0;$i < count($customjs); $i++) {
								echo $i.": ".$customjs[$i]."";
							}
							*/
						}						
					}
					?>
					case 'showtime':

					var difference = new Date() - new Date(value.replace(/\./g, '/'));
				
					var daysDifference = Math.floor(difference/1000/60/60/24);
						difference -= daysDifference*1000*60*60*24
						var hoursDifference = Math.floor(difference/1000/60/60);
						difference -= hoursDifference*1000*60*60
						var minutesDifference = Math.floor(difference/1000/60);
						difference -= minutesDifference*1000*60
						var secondsDifference = Math.floor(difference/1000);
						if(daysDifference > "500") {
							$('[data-id="' + ise_id + '"]').html(".");
						} else if(daysDifference>1) {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor " + daysDifference + " Tagen</span>");
						} else if(daysDifference>0) {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor einem Tag</span>");
						} else if (hoursDifference>1) {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor " + hoursDifference + " Std.</span>");
						} else if (hoursDifference>0) {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor " + hoursDifference + " Std.</span>");		  
						} else if (minutesDifference>1) {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor " + minutesDifference + " Min.</span>");	  
						} else if (minutesDifference>0) {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor " + minutesDifference + " Min.</span>");
						} else {
							$('[data-id="' + ise_id + '"]').html("<span style='font-size: smaller;'>vor " + secondsDifference + " Sek.</span>");
						}
						break;
						
						
					case 'showstate':

					 if (value === "true") {
						$('[data-id="' + ise_id + '"]').html("<img src='icon/green_dot.png'>");
						
					 }
					 else
					 {
						$('[data-id="' + ise_id + '"]').html("<img src='icon/red_dot.png'>");
					 }
					 break;
                    case 'HMIP-PSM':
                    case 'HMIP-PS':
                    case 'HmIP-PSM-2':
                    case 'HmIP-PS-2':
					case 'HmIP-PS-2 9YM':
                    case 'HmIP-BSM':
                    case 'HmIP-BS2':
                    case 'HmIP-FSM':
                    case 'HmIP-FSM16':
                    case 'HmIP-BSL':
                    case 'HmIP-FSI16':
                    case 'HmIPW-DRS8':
                    case 'HmIPW-DRS4':
                    case 'HmIP-DRSI4':
                    case 'HmIP-FWI':
                    case 'HM-LC-Sw1-Ba-PCB':
                    case 'HM-LC-Sw1-DR':
                    case 'HM-LC-Sw1-FM':
                    case 'HM-LC-Sw1-PB-FM':
                    case 'HM-LC-Sw1-Pl-2':
                    case 'HM-LC-Sw1-Pl-DN-R1':
                    case 'HM-LC-Sw1-Pl-DN-R5':
                    case 'HM-LC-Sw1-Pl':
                    case 'HM-LC-Sw1-SM':
                    case 'HM-LC-Sw1PBU-FM':
                    case 'HM-LC-Sw2-FM':
                    case 'HM-LC-Sw2PBU-FM':
                    case 'HM-LC-Sw4-Ba-PCB':
                    case 'HM-LC-Sw4-DR':
                    case 'HM-LC-Sw4-DR-2':
                    case 'HM-LC-Sw4-PCB':
                    case 'HM-LC-Sw4-SM':
                    case 'HM-LC-Sw4-WM':
                    case 'HM-MOD-Re-8':
                    case 'HM-OU-CFM-Pl':
                    case 'HM-OU-CM-PCB':
                    case 'HM-Sec-SFA-SM':
                    case 'HMW-IO-12-FM':
                    case 'HMW-IO-12-Sw7-DR':
                    case 'HMW-IO-4-FM':
                    case 'HMW-LC-Sw2-DR':
                    case 'HM-Dis-TD-T':
                        var button = $('[data-id="' + ise_id + '"]').attr('data-button');
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    if (button !== "bulb") { $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_on.png" />'); }
                                    else { $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_on.png" />'); }                                    
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    if (button !== "bulb") { $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_off.png" />'); }
                                    else { $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_off.png" />'); }
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                if (value < 1000) {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                }
                                else {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10000).toFixed(2) + ' kWh');
                                }
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            case 'LOWBAT':
							case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-BROLL':
                    case 'HmIP-BROLL-2':
                    case 'HmIP-FROLL':
                    case 'HmIP-BBL':
                    case 'HmIP-BBL-2':
                    case 'HmIP-FBL':
                    case 'HmIP-DRBLI4':
                    case 'HmIPW-DRBL4':
                    case 'HM-LC-Bl1-FM':
                    case 'HM-LC-Bl1-SM':
                    case 'HM-LC-Bl1PBU-FM':
                    case 'HMW-LC-Bl1-DR':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);
                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_100.png" />');
                                } 
                                $('[data-id="' + ise_id + '_value"]').html(value + '%');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value + ' %');
                        }
                        break;  
                    case 'HmIP-BDT':
                    case 'HmIP-FDT':
                    case 'HmIP-PDT':
                    case 'HmIP-DRDI3':
                    case 'HmIPW-DRD3':
                    case 'HM-LC-Dim1PWM-CV':
                    case 'HM-LC-Dim1T-CV':
                    case 'HM-LC-Dim1T-FM':
                    case 'HM-LC-Dim1T-Pl':
                    case 'HM-LC-Dim1TPBU-FM':
                    case 'HMW-LC-Dim1L-DR':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);
                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                }
                                else {
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SMI':
                    case 'HmIP-SMI55':
                    case 'HmIP-SMI55-2':
                    case 'HmIPW-SMI55':
                    case 'HmIP-SMO':
					case 'HmIP-SMO230':
                    case 'HmIP-SMO-A':
					case 'HmIP-SMO230-A':
                        switch (datapoint) {
                            case 'CURRENT_ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html(Math.round(value));
                                break;
                            case 'ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html(Math.round(value));
                                break;								
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_n_a.png" />');
                                }
                                break;
                            case 'MOTION_DETECTION_ACTIVE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_presence_active.png" />');
									$('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_presence_disabled.png" />');
									$('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
							case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
					case 'HmIP-SLO':
                      switch (datapoint) {
                            case 'CURRENT_ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Lux');
                                break;
                            case 'AVERAGE_ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/control_arrow_right.png" /> ' + (Math.round(value * 10) / 10) + ' Lux');
                                break;		
							case 'LOWEST_ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/control_arrow_down.png" /> ' + (Math.round(value * 10) / 10) + ' Lux');
                                break;	
							case 'HIGHEST_ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/control_arrow_up.png" /> ' + (Math.round(value * 10) / 10) + ' Lux');
                                break;									
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;					
					case 'HM-Sen-LI-O':
                        switch (datapoint) {
                            case 'LUX':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Lux');
                                break;					
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break; 						
                    case 'HmIP-SPI':
                    case 'HmIPW-SPI':
                        switch (datapoint) {
                            case 'CURRENT_ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html(Math.round(value));
                                break;
                            case 'ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html(Math.round(value));
                                break;								
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'PRESENCE_DETECTION_STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_n_a.png" />');
                                }
                                break;
                            case 'PRESENCE_DETECTION_ACTIVE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_presence_active.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_presence_disabled.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break; 
					case 'HM-SCI-3-FM':	
					case 'HmIP-FCI6':	
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
							
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Offen');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Zu');

                                }
                                
								
								 // Yes/No 
                                
                                var indicator = $('[data-id="' + ise_id + '"]').attr('data-indicator');
                                if (value === '') value = "false";                
                                if (indicator !== "-1" && indicator != undefined) {
                                  // Liste suchen und zerlegen
                                  var res = indicator.search(",");
                                  if (res > -1) {
                                 
                                    var indarray = indicator.split(';');
                                    for (var i = 0; i < indarray.length; i++){
                                      var indicator_array = indarray[i].split(',');
                                      if (indicator_array[0].trim() === '1') { indicator_array[0] = 'true'; }
                                      else if (indicator_array[0].trim() === '0') { indicator_array[0] = 'false'; }
                                      if (value === indicator_array[0].trim()){
                                        if (indicator_array[1].trim() === "true") {
                                           var on_type = "true";
                                           var off_type = "false";
                                           var snd_off_type = "alarm";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "alarm") {
                                           var on_type = "alarm";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "warn") {
                                           var on_type = "warn";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "alarm";
                                        }
                                        else {
                                           var on_type = "false";
                                           var off_type = "alarm";
                                           var snd_off_type = "true";
                                           var trd_off_type = "warn";
                                        }
                                        break;
                                      }
                                      else if ((i+1) === indarray.length) {
                                        var on_type = "false";
                                        var off_type = "alarm";
                                        var snd_off_type = "true";
                                        var trd_off_type = "warn";
                                      }
                                    }
                                  }
                                }
                                else {
                                    if (value === 'false') {
                                        var on_type = "false";
                                        var off_type = "true";
                                    }
                                    else {
                                        var on_type = "true";
                                        var off_type = "false";
                                    }
                                    var snd_off_type = "alarm";
                                    var trd_off_type = "warn";
                                } 
								//alert(value);
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('Zu');                                    
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Offen');
                                } 
                                $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);
                                $('[data-id="' + ise_id + '"]').removeClass('btn-' + snd_off_type);
                                $('[data-id="' + ise_id + '"]').removeClass('btn-' + trd_off_type);
								break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SC-2':
                    case 'HM-Sec-SC':
                    case 'HM-Sec-SCo':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                var state_icons = $('[data-id="' + ise_id + '"]').attr('data-state-icons');
                                if (state_icons !== "") {
                                  // Liste suchen und zerlegen
                                  var res = state_icons.search(",");
                                  if (res > -1) {
                                    var iconarray = state_icons.split(';');
                                    for (var i = 0; i < iconarray.length; i++){
                                      var icon_array = iconarray[i].split(',');
                                      if (value === icon_array[0].trim()){ var icon = '<img src="icon/' + icon_array[1].trim() + '" />'; }
                                    }
                                  }
                                }
                                else {
                                  if (value === 'false') {
                                      var icon = '<img src="icon/fts_window_1w_gn.png" />';         
                                  } else {
                                      var icon = '<img src="icon/fts_window_1w_open_rd.png" />';  
                                  }
                                }
                                $('[data-id="' + ise_id + '"]').html(icon);
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                case 'HmIP-STV':
                    switch (datapoint) {
                        case 'LOW_BAT':
                            if (value === 'true') {
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                            }
                            break;
                        case 'MOTION':
                            var state_icons = $('[data-id="' + ise_id + '"]').attr('data-state-icons');
                            if (state_icons !== "") {
                                // Liste suchen und zerlegen
                                var res = state_icons.search(",");
                                if (res > -1) {
                                    var iconarray = state_icons.split(';');
                                    for (var i = 0; i < iconarray.length; i++){
                                        var icon_array = iconarray[i].split(',');
                                        if (value === icon_array[0].trim()){ var icon = '<img src="icon/' + icon_array[1].trim() + '" />'; }
                                    }
                                }
                            }
                            else {
                                if (value == "0" || value === "false") {
                                    var icon = '<img src="icon/fts_window_1w_gn.png" />';         
                                } else {
                                    var icon = '<img src="icon/fts_window_1w_open_rd.png" />';  
                                }
                            } 
                            $('[data-id="' + ise_id + '"]').html(icon);
                            break;
                            default:
                            console.log("default" + ise_id+ datapoint);
                            $('[data-id="' + ise_id + '"]').html(value);
                        }
                    break;						
                    case 'HmIP-SWDO-I':
                    case 'HMIP-SWDO':
                    case 'HmIP-SWDM':
					case 'HmIP-SWDM-B2':
					case 'HmIP-SWDM-2':
                    case 'HmIP-SWDO-PL':
                    case 'HmIP-SCI':
                    case 'HmIPW-DRI16':
                    case 'HmIPW-DRI32':
                        switch (datapoint) {
                            case 'LOW_BAT':
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                var state_icons = $('[data-id="' + ise_id + '"]').attr('data-state-icons');
                                if (state_icons !== "") {
                                  // Liste suchen und zerlegen
                                  var res = state_icons.search(",");
                                  if (res > -1) {
                                    var iconarray = state_icons.split(';');
                                    for (var i = 0; i < iconarray.length; i++){
                                      var icon_array = iconarray[i].split(',');
                                      if (value === icon_array[0].trim()){ var icon = '<img src="icon/' + icon_array[1].trim() + '" />'; }
                                    }
                                  }
                                }
                                else {
                                  if (value == "0" || value === "false") {
                                      var icon = '<img src="icon/fts_window_1w_gn.png" />';         
                                  } else {
                                      var icon = '<img src="icon/fts_window_1w_open_rd.png" />';  
                                  }
                                } 
                                $('[data-id="' + ise_id + '"]').html(icon);
                                break;
                            default:
								 console.log("default" + ise_id+ datapoint);
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-STHO':
                    case 'HmIP-STHO-A':
                    case 'ELV-SH-CTH':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/humidity.png" height=17 /> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/temp_temperature.png" height=17 /> ' + (Math.round(value * 10) / 10) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;   
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-STH':
                    case 'HmIP-STHD':
					case 'HMIP-WTH':
					case 'HmIP-WTH-1':
                    case 'HmIP-WTH-2':
                    case 'HmIP-BWTH':
                    case 'HmIP-WTH-B':
                    case 'HmIPW-WTH':
                    case 'HmIPW-STHD':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/humidity.png" height=17/> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id)-10); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id)-10); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                }
                                break;
                            case 'ACTIVE_PROFILE':
                                if (value < 4) $('[data-id="' + ise_id + '"]').html(value + '&nbsp;<img src="icon/heating.png"/>');
                                else $('[data-id="' + ise_id + '"]').html(value + '&nbsp;<img src="icon/cooling.png"/>');
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w_open.png" />');
                                }
                                break; 
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;   
							case 'STATE':
                                if (value === 'false') {
									$('[data-id="' + ise_id + '"]').html('<img src="icon/sani_valve_0.png" />');
                                } else {
									$('[data-id="' + ise_id + '"]').html('<img src="icon/sani_valve_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMIP-eTRV':
                    case 'HmIP-eTRV-2':
					case 'HmIP-eTRV-2 I9F': 
					case 'HmIP-eTRV-B-2 R4M':
                    case 'HmIP-eTRV-B':
					case 'HmIP-eTRV-B1':
                    case 'HmIP-eTRV-E':
                    case 'HmIP-eTRV-E-A':
                    case 'HmIP-eTRV-E-S':
					case 'HmIP-eTRV-CL':
                    case 'HmIP-eTRV-C':
                    case 'HmIP-eTRV-C-2':   
                        switch (datapoint) {
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id)-10); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id)-10); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                }
                                break;
                            case 'ACTIVE_PROFILE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C');
                                break;
                            case 'LEVEL':
                                $('[data-id="' + ise_id + '"]').html('&nbsp;&nbsp;&nbsp;&nbsp;<img src="icon/ventil.png" /> ' + (Math.round(value * 1000) / 10) + ' %');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w_open.png" />');
                                }
                                break; 
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;  
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-eTRV-F':
                    case 'HmIP-eTRV-3':    
                        switch (datapoint) {
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id)-10); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id)-10); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                }
                                break;
                            case 'ACTIVE_PROFILE':
                                if (value < 4) $('[data-id="' + ise_id + '"]').html(value + '&nbsp;<img src="icon/heating.png"/>');
                                else $('[data-id="' + ise_id + '"]').html(value + '&nbsp;<img src="icon/cooling.png"/>');
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C');
                                break;
                            case 'LEVEL':
                                $('[data-id="' + ise_id + '"]').html('&nbsp;&nbsp;&nbsp;&nbsp;<img src="icon/ventil.png" /> ' + (Math.round(value * 1000) / 10) + ' %');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w_open.png" />');
                                }
                                break; 
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;  
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-FALMOT-C12':
                        switch (datapoint) {
                            case 'LEVEL':
                                var channel = $('[data-id="' + ise_id + '"]').attr('data-channel');
                                var channelpos = $('[data-id="' + ise_id + '"]').attr('data-channel-pos');
                                var totalchannels = $('[data-id="' + ise_id + '"]').attr('data-channel-total');
                                var offset = (12-totalchannels)*20;
                                if (value) {
                                  value = (Math.round(value * 1000) / 10);
                                  var iconvalue = ((Math.ceil(value/10))*10).toString();
                                  $('[data-id="' + ise_id + '"]').html('<div style="position: absolute; width: 40px; margin-top: 2px; margin-left:' + ((channelpos*40)-268-offset) + 'px;"><img src="icon/level_' + iconvalue + '.png" /></div><div style="font-size:5pt; position: absolute; margin-top: -6px; margin-left:' + ((channelpos*40)-266-offset) + 'px;">' + channel + '</div><div style="font-size:5pt; position: absolute; margin-top: 31px; margin-left:' + ((channelpos*40)-266-offset) + 'px;">' + value + '%</div>');
                                }
                                else {
                                  $('[data-id="' + ise_id + '"]').html('<div style="position: absolute; width: 40px; margin-top: 2px; margin-left:' + ((channelpos*40)-268-offset) + 'px;"><img src="icon/level_off.png" /></div><div style="font-size:5pt; position: absolute; margin-top: -6px; margin-left:' + ((channelpos*40)-266-offset) + 'px;">' + channel + '</div><div style="font-size:5pt; position: absolute; margin-top: 31px; margin-left:' + ((channelpos*40)-266-offset) + 'px;">- . -</div>');
                                }
                                break; 
                              default:
                                  $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SWO-B':
                    case 'HmIP-SWO-PL':
                    case 'HmIP-SWO-PR':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html('Helligkeit: ' + (Math.round(value * 10) / 10) + ' Lux');
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('Feuchte: ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'SUNSHINEDURATION':
								Stunden = Math.floor(value/60); // liefert den ganzzahligen Anteil einer Division
								Minuten = value % 60; 
                                //$('[data-id="' + ise_id + '"]').html('Sonnenschein: ' + (Math.round(value * 10) / 10) + ' Min.');
								$('[data-id="' + ise_id + '"]').html('Sonnenschein: ' + Stunden + ':' + Minuten );
                                break;
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Temperatur: ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'WIND_SPEED':
                                $('[data-id="' + ise_id + '"]').html('Wind: ' + (Math.round(value * 10) / 10) + ' km/h');
                                break;
                            case 'RAIN_COUNTER':
                                $('[data-id="' + ise_id + '"]').html('Regenmenge: '+ (Math.round(value * 10) / 10) + ' mm');
                                break;
                            case 'RAINING':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_rain.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_sun.png" />');
                                }
                                break;
                            case 'WIND_DIR':

							
							
							if(((Math.round(value * 10) / 10)) >= 338)  {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Nord');
							} else if (((Math.round(value * 10) / 10)) >= 293) {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Nordwest');
							} else if (((Math.round(value * 10) / 10)) >= 248) {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: West');
							} else if (((Math.round(value * 10) / 10)) >= 203) {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Südwest');
							} else if (((Math.round(value * 10) / 10)) >= 158) {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Süd');
							} else if (((Math.round(value * 10) / 10)) >= 113) {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Südost');
							} else if (((Math.round(value * 10) / 10)) >= 68) {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Ost');
							} else if (((Math.round(value * 10) / 10)) >= 23) {								
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Nordost');
							} else {
								$('[data-id="' + ise_id + '"]').html('Windrichtung: Nord');
							}
								
                               // $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + '&deg;');
                                break;
                            case 'WIND_DIR_RANGE':
				
                                $('[data-id="' + ise_id + '"]').html('Schwankbreite: '+ (Math.round(value * 10) / 10) + '&deg;');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
					case 'HmIP-MOD-HO':
						switch (datapoint) {
							case 'DOOR_STATE':
								switch (value) {
									case '0':
										// zu
										$('[data-id="' + ise_id + '_0"]').html('zu');
										$('[data-id="' + ise_id + '_0"]').addClass('btn-true');
										$('[data-id="' + ise_id + '_0"]').removeClass('btn-false');
										$('[data-id="' + ise_id + '_0"]').removeClass('btn-text');
										$('[data-id="' + ise_id + '_1"]').addClass('btn-text');
										$('[data-id="' + ise_id + '_2"]').addClass('btn-text');
										$('[data-id="' + ise_id + '_1"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '_2"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '"]').html('');
										break;
									case '1':
										// auf
										$('[data-id="' + ise_id + '_1"]').html('auf');
										$('[data-id="' + ise_id + '_1"]').addClass('btn-true');
										$('[data-id="' + ise_id + '_1"]').removeClass('btn-false');
										$('[data-id="' + ise_id + '_1"]').removeClass('btn-text');
										$('[data-id="' + ise_id + '_0"]').addClass('btn-text');
										$('[data-id="' + ise_id + '_2"]').addClass('btn-text');
										$('[data-id="' + ise_id + '_0"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '_2"]').removeClass('btn-true')
										$('[data-id="' + ise_id + '"]').html('');
										break;
									case '2':
										// lüften
										$('[data-id="' + ise_id + '_2"]').html('Lüften');
										$('[data-id="' + ise_id + '_2"]').addClass('btn-true');
										$('[data-id="' + ise_id + '_2"]').removeClass('btn-false');
										$('[data-id="' + ise_id + '_2"]').removeClass('btn-text');
										$('[data-id="' + ise_id + '_0"]').addClass('btn-text');
										$('[data-id="' + ise_id + '_1"]').addClass('btn-text');
										$('[data-id="' + ise_id + '_1"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '_0"]').removeClass('btn-true')
										$('[data-id="' + ise_id + '"]').html('');
										break;
									case '3':
										// fährt
										$('[data-id="' + ise_id + '"]').html('fährt');
										break;
								}
								break;
							default:
								$('[data-id="' + ise_id + '"]').html(value);
						}
						break;						
                    case 'HmIP-DLD':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'LOCK_STATE':
                                if (value === '2') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/secur_open_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-alarm');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-warn');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else if (value === '1') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/secur_locked_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-alarm');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-warn');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/secur_undefined_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-warn');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-alarm');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break; 
                     case 'HmIP-SCTH230':
                        switch (datapoint) {
                            case 'CONCENTRATION':
                                var ppm = (Math.round(value * 10) / 10) + ' ppm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                if (value < 600) {
                                    $('[data-id="' + ise_id + '"]').html(ppm + 'Sehr gut');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-warn');
                                }
                                else if (value < 900) {
                                    $('[data-id="' + ise_id + '"]').html(ppm + 'Gut');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-warn');
                                }
                                else if (value < 1200) {
                                    $('[data-id="' + ise_id + '"]').html(ppm + 'Erh&ouml;ht');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-warn');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                }
                                else if (value < 1500) {
                                    $('[data-id="' + ise_id + '"]').html(ppm + 'Schlecht');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-warn');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                }
                                else {
                                    $('[data-id="' + ise_id + '"]').html(ppm + 'Sehr schlecht');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-warn');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                } 
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;               
                    
                    case 'HmIP-SAM':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break; 
                    case 'HmIP-SWD':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'ALARMSTATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_bell.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/control_ok.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;                   
                    case 'HmIP-SRH':
                    case 'HM-Sec-RHS':
                        switch (datapoint) {
                            case 'LOW_BAT':
							case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE': 
                                var state_icons = $('[data-id="' + ise_id + '"]').attr('data-state-icons');
                                if (state_icons !== "") {
                                  // Liste suchen und zerlegen
                                  var res = state_icons.search(",");
                                  if (res > -1) {
                                    var iconarray = state_icons.split(';');
                                    for (var i = 0; i < iconarray.length; i++){
                                      var icon_array = iconarray[i].split(',');
                                      if (value === icon_array[0].trim()){ var icon = '<img src="icon/' + icon_array[1].trim() + '" />'; }
                                    }
                                  }
                                }
                                else {
                                  if (value === '0') {
                                      var icon = '<img src="icon/fts_window_1w_gn.png" />';         
                                  } else if (value === '1') {
                                      var icon = '<img src="icon/fts_window_1w_tilt_rd.png" />';         
                                  } else {
                                      var icon = '<img src="icon/fts_window_1w_open_rd.png" />';  
                                  }
                                }
                                $('[data-id="' + ise_id + '"]').html(icon); 
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SWSD':
                    case 'HmIP-SWSD-2':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'SMOKE_DETECTOR_ALARM_STATUS':
                              	if (value === 'false') {
                             		$('[data-id="' + ise_id + '"]').html('<img src="icon/control_clear.png" />');                            
                                } else if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/control_clear.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_attention.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SRD':
                        switch (datapoint) {
                            case 'RAINING':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_sun.png" />');
                                } else if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_rain.png" />');
                                } 
                                break;                              
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'SysVar':
                        switch (datapoint) {
                            case '2':
                                // Yes/No 
                                
                                var indicator = $('[data-id="' + ise_id + '"]').attr('data-indicator');
                                if (value === '') value = "false";                
                                if (indicator !== "-1" && indicator != undefined) {
                                  // Liste suchen und zerlegen
                                  var res = indicator.search(",");
                                  if (res > -1) {
                                    
                                    var indarray = indicator.split(';');
                                    for (var i = 0; i < indarray.length; i++){
                                      var indicator_array = indarray[i].split(',');
                                      if (indicator_array[0].trim() === '1') { indicator_array[0] = 'true'; }
                                      else if (indicator_array[0].trim() === '0') { indicator_array[0] = 'false'; }
                                      if (value === indicator_array[0].trim()){
                                        if (indicator_array[1].trim() === "true") {
                                           var on_type = "true";
                                           var off_type = "false";
                                           var snd_off_type = "alarm";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "alarm") {
                                           var on_type = "alarm";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "warn") {
                                           var on_type = "warn";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "alarm";
                                        }
                                        else {
                                           var on_type = "false";
                                           var off_type = "alarm";
                                           var snd_off_type = "true";
                                           var trd_off_type = "warn";
                                        }
                                        break;
                                      }
                                      else if ((i+1) === indarray.length) {
                                        var on_type = "false";
                                        var off_type = "alarm";
                                        var snd_off_type = "true";
                                        var trd_off_type = "warn";
                                      }
                                    }
                                  }
                                }
                                else {
                                    if (value === 'true') {
                                        var on_type = "true";
                                        var off_type = "false";
                                    }
                                    else {
                                        var on_type = "false";
                                        var off_type = "true";
                                    }
                                    var snd_off_type = "alarm";
                                    var trd_off_type = "warn";
                                } 
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html(valueList.split(';')[parseInt(1)]);                                    
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(valueList.split(';')[parseInt(0)]);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } 
                                $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);
                                $('[data-id="' + ise_id + '"]').removeClass('btn-' + snd_off_type);
                                $('[data-id="' + ise_id + '"]').removeClass('btn-' + trd_off_type);
                                break;
                            case '4':
                                // Number

                                var indicator = $('[data-id="' + ise_id + '"]').attr('data-indicator');
                                                 
                                if (indicator !== "-1" && indicator != undefined) {
                                  // Liste suchen und zerlegen
                                  var res = indicator.search(",");
                                  if (res > -1) {
                                    
                                    var indarray = indicator.split(';');
                                    for (var i = 0; i < indarray.length; i++){
                                      var indicator_array = indarray[i].split(',');
                                      if (parseFloat(value) <= indicator_array[0].trim()){
                                        if (indicator_array[1].trim() === "true") {
                                           var on_type = "true";
                                           var off_type = "false";
                                           var snd_off_type = "alarm";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "alarm") {
                                           var on_type = "alarm";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "warn") {
                                           var on_type = "warn";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "alarm";
                                        }
                                        else {
                                           var on_type = "false";
                                           var off_type = "alarm";
                                           var snd_off_type = "true";
                                           var trd_off_type = "warn";
                                        }
                                        break;
                                      }
                                      else if ((i+1) === indarray.length) {
                                        var on_type = "false";
                                        var off_type = "alarm";
                                        var snd_off_type = "true";
                                        var trd_off_type = "warn";
                                      }
                                    }
                                    $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + snd_off_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + trd_off_type);
                                  }
                                                                   
                                }   
                                if (unit !== '') {
                                    $('[data-id="' + ise_id + '"]').html(parseFloat(value) + ' ' + unit);
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(parseFloat(value));
                                }      
                                break;
                            case '16':
                                // Value List
                                var indicator = $('[data-id="' + ise_id + '"]').attr('data-indicator');
                                                               
                                if (indicator !== "-1" && indicator != undefined) {
                                  // Liste suchen und zerlegen
                                  var res = indicator.search(",");
                                  if (res > -1) {
                                    var indarray = indicator.split(';');
                                    for (var i = 0; i < indarray.length; i++){
                                      var indicator_array = indarray[i].split(',');
                                      if (value === indicator_array[0].trim()){
                                        if (indicator_array[1].trim() === "true") {
                                           var on_type = "true";
                                           var off_type = "false";
                                           var snd_off_type = "alarm";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "alarm") {
                                           var on_type = "alarm";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "warn") {
                                           var on_type = "warn";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "alarm";
                                        }
                                        else {
                                           var on_type = "false";
                                           var off_type = "alarm";
                                           var snd_off_type = "true";
                                           var trd_off_type = "warn";
                                        }
                                        break;
                                      }
                                      else if ((i+1) === indarray.length) {
                                        var on_type = "false";
                                        var off_type = "alarm";
                                        var snd_off_type = "true";
                                        var trd_off_type = "warn";
                                      }
                                    }
                                    $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + snd_off_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + trd_off_type);
                                  }
                                  else {                                
                                    var off_type = "false";
                                    var on_type = "true";
                                     
                                    if (value === indicator) {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);                                 
                                    } else {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-' + off_type);
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-' + on_type); 
                                    } 
                                  }
                                }
                                if (valueList !== '') {
                                    $('[data-id="' + ise_id + '"]').html(valueList.split(';')[parseInt(value)]);
                                }
                                break;
                            case '20':
                                // Text
                                var indicator = $('[data-id="' + ise_id + '"]').attr('data-indicator');
                                  
                                if (indicator !== "-1" && indicator != undefined) {
                                  // Liste suchen und zerlegen
                                  var res = indicator.search(",");
                                  if (res > -1) {
                                    var indarray = indicator.split(';');
                                    for (var i = 0; i < indarray.length; i++){
                                      var indicator_array = indarray[i].split(',');
                                      var patt = new RegExp(indicator_array[0].trim());
                                      var res = patt.test(value);
                                      if (res === true){
                                        if (indicator_array[1].trim() === "true") {
                                           var on_type = "true";
                                           var off_type = "false";
                                           var snd_off_type = "alarm";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "alarm") {
                                           var on_type = "alarm";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "warn";
                                        }
                                        else if (indicator_array[1].trim() === "warn") {
                                           var on_type = "warn";
                                           var off_type = "true";
                                           var snd_off_type = "false";
                                           var trd_off_type = "alarm";
                                        }
                                        else {
                                           var on_type = "false";
                                           var off_type = "alarm";
                                           var snd_off_type = "true";
                                           var trd_off_type = "warn";
                                        }                                        
                                        break;
                                      }                                     
                                      else if ((i+1) === indarray.length) {
                                        var on_type = "false";
                                        var off_type = "alarm";
                                        var snd_off_type = "true";
                                        var trd_off_type = "warn";                                        
                                      }
                                    }
                                    $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + snd_off_type);
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-' + trd_off_type);
                                  }
                                  else {  
                                    var patt = new RegExp(indicator);
                                    var res = patt.test(value);
                                    
                                    var off_type = "false";
                                    var on_type = "true";
  
                                    if (res === true) {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-' + on_type);
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-' + off_type);
                                        
                                    } else {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-' + off_type);
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-' + on_type);                                 
                                    }
                                  }
                                }
                                
                                if (unit !== '') {
                                    $('[data-id="' + ise_id + '"]').html(value + ' ' + unit);
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                if (unit !== '') {
                                    $('[data-id="' + ise_id + '"]').html(value + ' ' + unit);
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(value);
                                }
                        }
                        break;
					case 'HmIP-ASIR':
					case 'HmIP-ASIR-2':					
                    case 'HmIP-ASIR-O':
                        switch (datapoint) {
							case 'OPERATING_VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_75.png" height=19 /> ' + ((Math.round(value * 10) / 10) + ' V'));
                                break;
							case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
							  case 'OPTICAL_ALARM_ACTIVE':
                                switch (value) {
                                    case 'true':
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/red_dot.png" />&nbsp;&nbsp;<img src="icon/light_light_dim_on_100.png" />');
                                        break;
                                    case 'false':
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_off.png" />');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
							  case 'ACOUSTIC_ALARM_ACTIVE':
                                switch (value) {
                                    case 'true':
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/red_dot.png" />&nbsp;&nbsp;<img src="icon/audio_volume_high.png" />');
                                        break;
                                    case 'false':
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/audio_volume_mute.png" />');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;								
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;						
                    case 'HM-CC-RT-DN':
                    case 'HmIP-STE2-PCB':
                        switch (datapoint) {
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'BATTERY_STATE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_75.png" height=19 /> ' + ((Math.round(value * 10) / 10) + ' V'));
                                break;
                            case 'CONTROL_MODE':
                                switch (value) {
                                    case '0':
                                        // AUTO_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/time_automatic.png" />');
                                        break;
                                    case '1':
                                        // MANU_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/time_manual_mode.png" />');
                                        break;
                                    case '2':
                                        // PARTY_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/scene_party.png" />');
                                        break;
                                    default:
                                        // BOOST_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/text_max.png" />');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'SET_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'VALVE_STATE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/sani_valve_50.png" height=19 /> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-SCD':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('Normal');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('Leicht erh&ouml;ht');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('Stark erh&ouml;ht');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
					case 'HM-CC-TC':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'SETPOINT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
							case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C');
                                break;
							case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C');
                                break;
							case 'ACTUAL_HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/humidity.png" height=17/> ' + (Math.round(value *  10) / 10) + ' %');
                                break;								
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
							
                        }
                        break;
                    case 'HM-CC-VD':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'VALVE_STATE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-VG-1':
					   case 'HmIP-HEATING':
                        switch (datapoint) {
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'CONTROL_MODE':
                                switch (value) {
                                    case '0':
                                        // AUTO_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/time_automatic.png" />');
                                        break;
                                    case '1':
                                        // MANU_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/time_manual_mode.png" />');
                                        break;
                                    case '2':
                                        // PARTY_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/scene_party.png" />');
                                        break;
                                    default:
                                        // BOOST_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="icon/text_max.png" />');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'SET_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'STATE':
                                if (value == "0" || value === "false") {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-ES-PMSw1-DR':
                    case 'HM-ES-PMSw1-Pl-DN-R1':
                    case 'HM-ES-PMSw1-Pl-DN-R5':
                    case 'HM-ES-PMSw1-Pl':
						var button = $('[data-id="' + ise_id + '"]').attr('data-button');
                        switch (datapoint) {
                            case 'CONTROL_MODE':
                                if (value === 'true') {
                                    if (button !== "bulb") { $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_on.png" />'); }
                                    else { $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_on.png" />'); }                                    
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    if (button !== "bulb") { $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_off.png" />'); }
                                    else { $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_off.png" />'); }
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                if (value < 1000) {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                }
                                else {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10000).toFixed(2) + ' kWh');
                                }
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'STATE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                     case 'HM-ES-TX-WM':
                        switch (datapoint) {
                            case 'ENERGY_COUNTER':
                                if (value > 0) {
                                    if (value < 1000) {
                                      $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                    }
                                    else {
                                       $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10000).toFixed(3) + ' kWh');
                                    }
                                }
                                break;
                            case 'IEC_ENERGY_COUNTER':
                                if (value > 0) {
                                    if (value < 1000) {
                                      $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                    }
                                    else {
                                       $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10).toFixed(3) + ' kWh');
                                    }
								}
                                break;
                            case 'GAS_ENERGY_COUNTER':
                                value = Math.round(value * 10) / 10;
                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' m&sup3;');
                                }
                                break;
                            case 'GAS_POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' m&sup3;');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'IEC_POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                }
								else
								{
							        $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
								}
                                break;
							case 'POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-RGBW-WM':
						switch (datapoint) {
                           case 'LEVEL':
                                if (value >= '0.1') {

                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_on.png" />');                                
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_off.png" />'); 
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
									
                                break;
							case 'COLOR':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
									
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
							}
							break;
					
                       case 'HmIP-RGBW':
                        switch (datapoint) {
                           case 'LEVEL':
                                if (value >= '0.1') {

                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_on.png" />');                                
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_off.png" />'); 
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
								document.getElementById('dim'+ise_id+'rahmen').innerHTML = '<input style="display:inline;margin:0px;width:100px;" type="range" id="dim'+ise_id+'" step="0.1" value="'+value+'" min="0" max="1">'
								//$('[data-id="' + ise_id + '_level"]').html('<input style="display:inline;margin:0px;width:100px;" type="range" id="dim'+ise_id+'" step="0.1" value="'+(value/10)+'" min="0" max="1">');
								let sel2 = document.getElementById('dim'+ise_id);
								sel2.addEventListener ("change", function () {
								let show = document.getElementById('dim'+ise_id).value;
								shot = show/100;
								setDatapoint(ise_id, show);
								});			
                                break;
							case 'COLOR':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            
                            case 'HUE_ALT':
                                if (value < 30 || value >= 330) $('[data-id="' + ise_id + '"]').html('<img src="icon/red_dot.png" />');
                                else if (value < 90) $('[data-id="' + ise_id + '"]').html('<img src="icon/yellow_dot.png" />');
                                else if (value < 150) $('[data-id="' + ise_id + '"]').html('<img src="icon/green_dot.png" />');
                                else if (value < 210) $('[data-id="' + ise_id + '"]').html('<img src="icon/cyan_dot.png" />');
                                else if (value < 270) $('[data-id="' + ise_id + '"]').html('<img src="icon/blue_dot.png" />');
                                else if (value < 330) $('[data-id="' + ise_id + '"]').html('<img src="icon/purple_dot.png" />');
                                break;
                            
							
                            case 'HUE':	
								$('[data-id="' + ise_id + '"]').val(value);
								break;
                            case 'SATURATION':	
								$('[data-id="' + ise_id + '"]').val(value);
								
								break;								
																
                            case 'SATURATION_ALT':    
                                value = 1-value;                        
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/white_dot.png" style="opacity:' + value + '"/>');
                                break;
                            
                            case 'LEVEL_ALT':
                                value = (Math.round(value * 1000) / 10);
                                
                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_00.png" />');
                                    $('[data-id="' + ise_id + '_dot"]').html('<img src="icon/grey_dot.png" />');
                                }
                                break;


		


									
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;                   
                 case 'HM-OU-LED16':
                        switch (datapoint) {
                            case 'LED_STATUS':
                                switch (value) {
                                    case '0':
                                       // $('[data-id="' + ise_id + '"]').html('Aus');
										$('[data-id="' + ise_id + '"]').addClass('btn-false');
										$('[data-id="' + ise_id + '"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '"]').removeClass('btn-warn');
										$('[data-id="' + ise_id + '"]').removeClass('btn-alarm');
                                        break;
                                    case '1':
                                        //$('[data-id="' + ise_id + '"]').html('Rot');
										$('[data-id="' + ise_id + '"]').removeClass('btn-false');
										$('[data-id="' + ise_id + '"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '"]').removeClass('btn-warn');
										$('[data-id="' + ise_id + '"]').addClass('btn-alarm');										
                                        break;
                                    case '2':
                                        //$('[data-id="' + ise_id + '"]').html('Gr&uuml;n');
										$('[data-id="' + ise_id + '"]').removeClass('btn-false');
										$('[data-id="' + ise_id + '"]').addClass('btn-true');
										$('[data-id="' + ise_id + '"]').removeClass('btn-warn');
										$('[data-id="' + ise_id + '"]').removeClass('btn-alarm');										
                                        break;
                                    default:
                                        //$('[data-id="' + ise_id + '"]').html('Orange');
										$('[data-id="' + ise_id + '"]').removeClass('btn-false');
										$('[data-id="' + ise_id + '"]').removeClass('btn-true');
										$('[data-id="' + ise_id + '"]').addClass('btn-warn');
										$('[data-id="' + ise_id + '"]').removeClass('btn-alarm');										
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-Key':
                    case 'HM-Sec-Key-S':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/secur_open_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-alarm');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/secur_locked_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-alarm');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'STATE_UNCERTAIN':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/control_x.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;  
                    case 'HM-Sec-SD-Team':
                    case 'HM-Sec-SD-2-Team':
                    case 'HM-Sec-SD':
                    case 'HM-Sec-SD-2':					
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/control_clear.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/message_attention.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-TiS':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_garage_door_100.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_garage.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-WDS':
                    case 'HM-Sec-WDS-2':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('Trocken');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('Feucht');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('Nass');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-Win':
                        switch (datapoint) {
                            case 'BATTERY_LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_100.png" />');
                                } else if (value >= 75) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_75.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_50.png" />');
                                } else if (value >= 25) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                } else if (value >= 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_0.png" />');
                                }
                                break
                            case 'LEVEL':
                                if (value === '-0.005000') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/secur_locked.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 1000) / 10) + ' %');
                                }
                                break;
                            case 'STATE_UNCERTAIN':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/control_x.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-DB-PCB':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-EP':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-Sec-MDIR':
                    case 'HM-Sec-MDIR-2':
                    case 'HM-Sen-MDIR-O-2':
                    case 'HM-Sen-MDIR-O':
                    case 'HM-Sen-MDIR-WM55':
                    case 'HM-Sen-MDIR-SM':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-RD-O':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_sun.png" />');
                                } else if (value === '1') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_rain.png" />');
                                } else if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-SwI-3-FM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-TC-IT-WM-W-EU':
                        switch (datapoint) {
                            case 'ACTUAL_HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/humidity.png" height=17/> ' + (Math.round(value *  10) / 10) + ' %&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'BATTERY_STATE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_75.png" height=19 /> ' + ((Math.round(value * 10) / 10) + ' V'));
                                break;
                            case 'CONTROL_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) + 3); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) - 6); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'SET_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/soll_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            case 'WINDOW_OPEN_REPORTING':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_1w_open.png" />');
                                }
                                break;   
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDC7000':
                        switch (datapoint) {
                            case 'AIR_PRESSURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' hPa');
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS10-TH-O':
                    case 'HM-WDS30-T-O':
                    case 'HM-WDS40-TH-I-2':
                    case 'HM-WDS30-OT2-SM':
                    case 'HM-WDS30-OT2-SM-2':
                    case 'HM-WDS40-TH-I':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/humidity.png" height=17/> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
					case 'HM-WDS30-T-O':
                    case 'HM-WDS30-OT2-SM':
					    switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10).toFixed(1) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS100-C6-O':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'RAIN_COUNTER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mm');
                                break;
                            case 'RAINING':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_rain.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/weather_sun.png" />');
                                }
                                break;
                            case 'SUNSHINEDURATION':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Min.');
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'WIND_DIRECTION':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + '&deg;');
                                break;
                            case 'WIND_DIRECTION_RANGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + '&deg;');
                                break;
                            case 'WIND_SPEED':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' km/h');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;

                    case 'HmIPW-FAL24-C10':

                        switch (datapoint) {
							   case 'STATE':
                                if (value === 'true') {                                  
                                     $('[data-id="' + ise_id + '"]').html('<img src="icon/temp_temperature_max.png" />');                                    
                                } else {
                                     $('[data-id="' + ise_id + '"]').html('<img src="icon/temp_temperature.png" />');       
                                }
                                break;                          
                              default:
                                  $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
					case 'HmIP-ESI':
                        switch (datapoint) {
                            case 'ENERGY_COUNTER':
                                if (value > 0) {
                                    if (value < 1000) {
                                      $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Wh');
                                    }
                                    else {
                                       $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10000).toFixed(3) + ' kWh');
                                    }
                                }
                                break;
                            case 'IEC_ENERGY_COUNTER':
                                if (value > 0) {
                                    if (value < 1000) {
                                      $('[data-id="' + ise_id + '"]').html( (Math.round(value * 10) / 10) + ' Wh');
                                    }
                                    else {
                                       $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10).toFixed(3) + ' kWh');
                                    }
								}
                                break;
                            case 'GAS_ENERGY_COUNTER':
                                value = Math.round(value * 10) / 10;
                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' m&sup3;');
                                }
                                break;
                            case 'GAS_POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' m&sup3;');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            case 'IEC_POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                }
								else
								{
							        $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
								}
                                break;
							case 'POWER':
                                value = Math.round(value * 10) / 10;

                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;						
                    case 'HmIP-MOD-OC8':
                        var button = $('[data-id="' + ise_id + '"]').attr('data-button');
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    if (button !== "bulb") { $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_on.png" />'); }
                                    else { $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_on.png" />'); }                                    
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    if (button !== "bulb") { $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_off.png" />'); }
                                    else { $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_off.png" />'); }
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                if (value < 1000) {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                }
                                else {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10000).toFixed(2) + ' kWh');
                                }
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            case 'LOWBAT':
							case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;						
                    case 'HMW-IO-12-Sw14-DR':
                        switch (datapoint) {
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mHz');
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_on.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_off.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'VALUE':
                                $('[data-id="' + ise_id + '"]').html(Math.round(value * 10) / 10);
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-MOD-EM-8':
                    case 'HM-PB-2-FM':
                    case 'HM-PB-2-WM':
                    case 'HM-PB-4-WM':
                    case 'HM-PB-2-WM55-2':
                    case 'HM-PB-2-WM55':
                    case 'HM-PB-4Dis-WM-2':
                    case 'HM-PB-4Dis-WM':
                    case 'HM-PB-6-WM55':
                    case 'HM-PBI-4-FM':
                    case 'HM-RC-19-B':
                    case 'HM-RC-19-SW':
                    case 'HM-RC-19':
                    case 'HM-RC-4-2':
                    case 'HM-RC-4-B':
                    case 'HM-RC-4':   
                    case 'HM-RC-8':
                    case 'HM-RC-Dis-H-x-EU':
                    case 'HM-RC-Key3-B':
                    case 'HM-RC-Key4-2':
                    case 'HM-RC-P1':
                    case 'HM-Dis-WM55':
                    case 'HM-RCV-50':
                    case 'HmIP-RCV-50':
					case 'HmIP-WGC':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'CUX2801':
					case 'CUX2804':
                        switch (datapoint) {
							   case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                if (value < 1000) {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                }
                                else {
                                   $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10000).toFixed(2) + ' kWh');
                                }
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'BLIND_LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/fts_shutter_100.png" />');
                                }
                                break;
                            case 'DIMMER_LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/light_light_dim_00.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_on.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="icon/switch_off.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'CUX2803':
                        switch (datapoint) {
                            case 'INFO':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'IP':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('online');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('offline');
                                }
                                break;
                            case 'UNREACH_CTR':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'CUX4000':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'CUX9002':
                        switch (datapoint) {
                            case 'ABS_HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' g/m3');
                                break;
                            case 'DEW_POINT':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/temp_dew_point.png" /> ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'HUM_MAX_24H':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/text_max.png" /> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'HUM_MIN_24H':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/text_min.png" /> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/humidity.png" /> ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'TEMP_MAX_24H':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/text_max.png" /> ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'TEMP_MIN_24H':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/text_min.png" /> ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('<img src="icon/ist_temperatur.png" /> ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    default:
                        $('[data-id="' + ise_id + '"]').html(value);
                }
            });

            //Run update periodically
            timer = window.setTimeout(updateDatapoints, timerMiliseconds);
        },
        //other code
        error: function () {
            $('#flash-error').html('Der Update Prozess wurde unterbrochen.').show();

            //Run update periodically
            timer = window.setTimeout(updateDatapoints, timerMiliseconds);
        }
    });
};

var setDatapoint = function (id, value) {
	if (dev == "1") {
		XMLURL = 'dev/statechange.php';
	} else {
		XMLURL = 'interface.php';
	}
    $.ajax({
        type: 'GET',
        url: XMLURL + '?statechange.cgi&ise_id=' + id + '&new_value=' + escape(value),
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            updateDatapoints();
        },
        //other code
        error: function () {
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Reqeusts.').show();
        }
    });
};

var runProgram = function (id) {
	if (dev == "1") {
		XMLURL = 'dev/runprogram.php';
	} else {
		XMLURL = 'interface.php';
	}	
    $.ajax({
        type: 'GET',
        url: XMLURL + '?runprogram.cgi&program_id=' + id,
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            updateDatapoints();
        },
        //other code
        error: function () {			
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Requests.').show();
        }
    });
};         

var setProgramMode = function (id) {
	if (dev == "1") {
		XMLURL = 'dev/runprogram.php';
	} else {
		XMLURL = 'interface.php';
	}	
    $.ajax({
        type: 'GET',
        url: XMLURL + '?setprogrammode.cgi&program_id=' + id,
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            updateDatapoints();
        },
        //other code
        error: function () {			
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Requests.').show();
        }
    });
};                

var showTitle = function () {

    // Uhrzeit, Datum und Logo setzen
    date = new Date();
    
    if ((latitude != 0) || (longitude != 0)){
        var sunset_time = new Date().sunset(latitude, longitude);
        var sunset = ('0' + sunset_time.getHours()).slice(-2) + ':' + ('0' + sunset_time.getMinutes()).slice(-2);
        var sunrise_time = new Date().sunrise(latitude, longitude);
        var sunrise = ('0' + sunrise_time.getHours()).slice(-2) + ':' + ('0' + sunrise_time.getMinutes()).slice(-2);
        var suntext = '<img src="icon/sunrise.png"> ' + sunrise + '&nbsp;&nbsp;&nbsp;<img src="icon/sunset.png"> ' + sunset + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    else {
        var suntext = "";              
    }
    
    $('#time').html(suntext + '<img src="icon/time.png">&nbsp;&nbsp;' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2));
    
    if (logo !== "") {
        var showlogo = '<img src="' + logo + '"> &nbsp;&nbsp;&nbsp;';
    } else {
       var showlogo = "";
    }
    
    $('#date').html(showlogo + ('0' + date.getDate()).slice(-2) + '.' + ('0' + (date.getMonth()+1)).slice(-2) + '.' + date.getFullYear()); 
    
};                

function startImport() {
    if (logo !== "") {
        var showlogo = '<img src="' + logo + '"> &nbsp;&nbsp;&nbsp;';
    } else {
       var showlogo = "";
    }
    $('#date').html(showlogo + "Import l&auml;uft...bitte warten!");
    window.clearTimeout(timer);
    window.location = "?seite=Import";
}
