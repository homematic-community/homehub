<?php
/*

{
  "component":"sysvarpin",
  "icon":"secur_burglary.png",
  "display_name":"text oder zahl",
  "code":"0815",
  "ise_id":"55369",
  "pinvalue":"true,false"
},		 

*/


ini_set('display_errors', 'on');

// Lade Interface zur Homematic
require_once('interface.php');

function sysvarpin($component) {
global $ccu;
	
	if (isset($component['ise_id'])) {
		$modalId = mt_rand();
		if(file_exists("dev/e5xport.json")) {
			$xmlFile = 'dev/sysvar.php?ise_id='.$component['ise_id'];
			$xml = simplexml_load_file($xmlFile);
		} else {
			$xml = simplexml_load_string(api_sysvar($ccu, $component['ise_id']));
		}
		
		//print_r($xml);
		
		foreach ($xml->systemVariable as $states)  
		{  

		if(isset($states['type'])) { $component['type'] = $states['type']; } else { $component['type'] = ""; }
			if(isset($states['unit'])) { $component['unit'] = $states['unit']; }  else { $component['unit'] = ""; }
			if(isset($states['max'])) $component['max'] = $states['max'];
			if(isset($states['min'])) $component['min'] = $states['min'];
			if(isset($states['value_list'])) $component['value_list'] = $states['value_list'];
			if(isset($states['buttons'])) $component['buttons'] = $states['buttons'];
			if(isset($states['value_name_0'])) $component['value_name_0'] = $states['value_name_0'];
			if(isset($states['value_name_1'])) $component['value_name_1'] = $states['value_name_1'];
  
		}
		if(isset($component['display_name']))
		{
			$component['name'] = $component['display_name'];
		}
		// Fehlerausgabe bei fehlenden Werten in der custom.json
		if(!isset($component['code'])) { 
			echo "Fehler: Wert \"code\" fehlt bei \"".$component['name']."\" in custom.json"; 
		}
		$content = '<style>
					/* Modal Window */
					.modal-window input {
						height:60px;
					}
					.modal-window {
						position: fixed;
						background-color: rgba(255, 255, 255, 0.7);

						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						transition: all 0.3s;
						display:none;
						 z-index: 99999;
					}
					.modal-window > div {
						width: 400px;
						height: 400px;
						position: absolute;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
						padding: 1.8em;
						background: white;
						
						border: 1px solid grey;
						border-radius: 5px;
						overflow: auto;
						
					}
					.modal-close {
						color: #aaa;
						line-height: 50px;
						font-size: 80%;
						position: absolute;
						right: 0;
						text-align: center;
						top: 0;
						width: 70px;
						text-decoration: none;
						width: 35px;
						height: 35px;
						display:block;
						background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox=\'0 0 32 32\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath stroke=\'rgba(0,0,0, 1)\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M8 8 L24 24 M8 24 L24 8\'/%3E%3C/svg%3E");
}
					</style>';
				
					
        if (!isset($component['operate'])) $component['operate'] = 'true';
        switch($component['type']) {
            case '2':  
			
				// Fehlerausgabe bei fehlenden Werten in der custom.json
				if(!isset($component['pinvalue'])) { 
					echo "Fehler: Wert \"pinvalue\" fehlt bei \"".$component['name']."\" in custom.json"; 
				}
				
				
                // True / False
                $valueList = '';
                if($component['value_name_0'] <> '' ||$component['value_name_1'] <> '') {
                    $valueList = $component['value_name_0'].';'.$component['value_name_1'];
                } 
                
                // Indikator anzeigen?
                if(!isset($component['indicator'])) {
                    $component['indicator'] = '-1';
                }
                
				
                if (!isset($component['color'])) $component['color'] = '#595959';
                $content = $content. '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                    . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                    . '<div class="pull-right">'
                        . '<span  onclick="passcodeloadertruefalse(\''.$modalId.'\',\''.$component["ise_id"].'\',\''.$component["pinvalue"].'\');"   class="info';
                       // if ($component['operate'] == 'true') $content = $content.' set';
                         $content = $content.'" data-id="' . $component['ise_id'] . '" data-component="SysVar" data-datapoint="2" data-unit="' . htmlentities($component['unit']) . '" data-set-id="' . $component['ise_id'] . '" data-set-value="" data-valuelist="'.$valueList.'" data-indicator="' . $component['indicator'] . '"></span>'
                    . '</div>'
					.'<script>
					//alert(dev);
						function passcodeloadertruefalse(modalId,ise_id,pinvalue) {
						$.ajax({
							type: "GET",
							url: "interface.php?state.cgi&datapoint_id="+ise_id,
							dataType: "xml",
							success: function (xml) {
								$("#flash-error").hide();
								$(xml).find("datapoint").each(function (index) {
									var ise_id = $(this).attr("ise_id");
									var value = $(this).attr("value");
									 
									if(value == "true") { TargetValue = "false"; }
									else { TargetValue = "true"; }
									var n = pinvalue.includes(TargetValue,);
									if(n == false) {
										if(value == "true") { TargetValue = "0"; }
										else { TargetValue = "1"; }
										
										var xhr = new XMLHttpRequest();
										xhr.open("GET", "interface.php?statechange.cgi&ise_id="+ise_id+"&new_value="+TargetValue);
										xhr.send();					
										updateDatapoints();
										passcodeclear(modalId)
									}
									else
									{
										document.getElementById("open-modal"+modalId).style.display="block";
									}
								});
							}
						});
					}
					function passcodeclear(modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = "";
					}					
					function klickpasscode(Code,modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = password.value + Code;
					}
					function sendpasscode(modalId,ise_id,PassCode,pinvalue) {
						var password = document.getElementById("password"+modalId);
						if (password.value == PassCode) {
							$.ajax({
								type: "GET",
								url: "interface.php?state.cgi&datapoint_id=" + ise_id,
								dataType: "xml",
								success: function (xml) {
									$("#flash-error").hide();
									$(xml).find("datapoint").each(function (index) {
										var ise_id = $(this).attr("ise_id");										
										var value = $(this).attr("value");
										
										if(value == "true") { TargetValue = "0"; }
										else { TargetValue = "1"; }
										
										var xhr = new XMLHttpRequest();
										xhr.open("GET", "interface.php?statechange.cgi&ise_id="+ise_id+"&new_value="+TargetValue);
										xhr.send();
										updateDatapoints();
										document.getElementById("open-modal"+modalId).style.display="none"										
										passcodeclear(modalId)

									});
								}
							});
						}
						else
						{
							alert("Code falsch");
							passcodeclear(modalId)
						}
					}
					</script>'
					. '<div id="open-modal'.$modalId.'" class="modal-window" >'
						.' <div class="modalDIV">'
							.' <a onclick= "document.getElementById(\'open-modal'.$modalId.'\').style.display=\'none\';" title="Close" class="modal-close"></a>'
							.' <div id="pinpad">'
								.' <form>'
									.' <input type="text" id="password'.$modalId.'" style=" padding: 0 60px;border-radius: 5px;width: 100%;margin: auto;border: 1px solid rgb(228, 220, 220);outline: none;font-size: 60px;color: transparent;text-shadow: 0 0 0 rgb(71, 71, 71);text-align: center;" value=""></br>'
									.' <input type="button" value="1" onclick="klickpasscode(\'1\',\''.$modalId.'\');"  style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="2" onclick="klickpasscode(\'2\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="3" onclick="klickpasscode(\'3\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="4" onclick="klickpasscode(\'4\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="5" onclick="klickpasscode(\'5\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="6" onclick="klickpasscode(\'6\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="7" onclick="klickpasscode(\'7\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="8" onclick="klickpasscode(\'8\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="9" onclick="klickpasscode(\'9\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="clear" onclick="passcodeclear(\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="0" onclick="klickpasscode(\'0\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="enter" onclick="sendpasscode(\''.$modalId.'\',\''.$component["ise_id"].'\',\''.$component['code'].'\',\''.$component['pinvalue'].'\');"  id="enter" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
								.' </form>'
							.' </div>'
						.' </div>'
					.' </div>'
                    . '<div class="clearfix"></div>'
                . '</div>';
                return $content;
                break;
            case '4':
                // Number
        
                // Indikator anzeigen?
                if(!isset($component['indicator'])) {
                    $component['indicator'] = '-1';
                }

                if (!isset($component['color'])) $component['color'] = '#595959';
                    $content = $content. '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>';
                    if ($component['operate'] == 'true') $content = $content.'<div data-toggle="collapse" data-target="#' . $modalId . '">';
                        $content = $content.'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                        . '<div class="pull-right">'
                            . '<span class="info';
                            if ($component['indicator'] == '-1') $content = $content.' lheight';
                            $content = $content.'" data-id="' . $component['ise_id'] . '" data-component="SysVar" data-datapoint="4" data-unit="' . htmlentities($component['unit']) . '" data-indicator="' . $component['indicator'] . '"></span>'
                        . '</div>';
                    if ($component['operate'] == 'true') $content = $content.'<div class="clearfix"></div></div><div class="hh2 collapse" id="' . $modalId . '">'
                        . '<div class="row text-center">'
                            . '<div class="form-inline">'
                                . '<div class="input-group">'
                                    . '<input type="number" id="input'.$component['ise_id'].'" name="' . $component['ise_id'] . '" min="' . $component['min'] . '" max="' . $component['max'] . '" class="form-control" placeholder="Zahl eingeben">'
                                    . '<span class="input-group-btn">'
                                        . '<button onclick="passcodeloaderinputfield(\''.$modalId.'\',\''.$component["ise_id"].'\');"  class="btn btn-primary" data-datapoint="4" data-set-id="' . $component['ise_id'] . '" data-set-value="">OK</button>'
                                    . '</span>'
                                . '</div>'
                            . '</div>'
                        . '</div></div>'	

.'<script>
function passcodeloaderinputfield(modalId,ise_id) {
										document.getElementById("open-modal"+modalId).style.display="block";
					}	
					function klickpasscode(Code,modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = password.value + Code;
					}
					function sendpasscodeinputfield(modalId,ise_id,PassCode) {
						var inputfield= document.getElementById("input"+ise_id);
						var password = document.getElementById("password"+modalId);
						if (password.value == PassCode) {
							var xhr = new XMLHttpRequest();
							xhr.open("GET", "interface.php?statechange.cgi.cgi&ise_id="+ise_id+"&new_value="+inputfield.value);
							xhr.send();
							updateDatapoints();
							document.getElementById("open-modal"+modalId).style.display="none"										
							passcodeclear(modalId)
						}
						else
						{
							alert("Code falsch");
							passcodeclear(modalId)
						}
					}
					
					
					//true,false
				
					function passcodeclear(modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = "";
					}	
</script>'					
						. '<div id="open-modal'.$modalId.'" class="modal-window">'
							.' <div class="modalDIV">'
								.' <a onclick= "document.getElementById(\'open-modal'.$modalId.'\').style.display=\'none\';" title="Close" class="modal-close"></a>'
								.' <div id="pinpad">'
								.' <form>'
									.' <input type="text" id="password'.$modalId.'" style=" padding: 0 60px;border-radius: 5px;width: 100%;margin: auto;border: 1px solid rgb(228, 220, 220);outline: none;font-size: 60px;color: transparent;text-shadow: 0 0 0 rgb(71, 71, 71);text-align: center;" value=""></br>'
									.' <input type="button" value="1" onclick="klickpasscode(\'1\',\''.$modalId.'\');"  style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="2" onclick="klickpasscode(\'2\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="3" onclick="klickpasscode(\'3\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="4" onclick="klickpasscode(\'4\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="5" onclick="klickpasscode(\'5\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="6" onclick="klickpasscode(\'6\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="7" onclick="klickpasscode(\'7\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="8" onclick="klickpasscode(\'8\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="9" onclick="klickpasscode(\'9\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="clear" onclick="passcodeclear(\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="0" onclick="klickpasscode(\'0\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="enter" onclick="sendpasscodeinputfield(\''.$modalId.'\',\''.$component["ise_id"].'\',\''.$component['code'].'\');"  id="enter" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
								.' </form>'
							.' </div>'
						.'</div>'
                    . '</div>';
					
                $content = $content.'</div>';
                return $content;
                break;
            case '16':
                // Value List
				
        		// Fehlerausgabe bei fehlenden Werten in der custom.json
				if(!isset($component['pinvalue'])) { 
					echo "Fehler: Wert \"pinvalue\" fehlt bei \"".$component['name']."\" in custom.json"; 
				}
                $valueList = '';
                if($component['value_list'] <> '') {
                    $valueList = $component['value_list'];
                    
					$pinvaluelist = explode(',', $component['pinvalue']);
					
					
					
                    $dummy = explode(';', $valueList);
                    $buttons = '';
                    foreach($dummy as $key => $value) {
						$i = 0;
						foreach($pinvaluelist as $pinvaluekey) {
							if ($pinvaluekey== $value) {
								$i = 1;
							}
						}
						if($i==1) 
						{
							$buttons .= '<button type="button" onclick="passcodeloadervaluelist(\''.$modalId.'\',\''.$component["ise_id"].'\',\''.$key.'\');"   class="btn btn-primary" data-set-id="' . $component['ise_id'] . '" data-set-value="' . $key .'">'. $value.'</button>';
						}
						else
						{
							$buttons .= '<button type="button" class="btn btn-primary set" data-set-id="' . $component['ise_id'] . '" data-set-value="' . $key .'">'. $value.'</button>';
						}
                    }
                }
                // Indikator anzeigen?
                if(!isset($component['indicator'])) {
                    $component['indicator'] = '-1';
                }
                
                if (!isset($component['color'])) $component['color'] = '#595959';
                    $content = $content. '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>';
                    if ($component['operate'] == 'true') $content = $content.'<div data-toggle="collapse" data-target="#' . $modalId . '">';
                        $content = $content.'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                        . '<div class="pull-right">'
                            . '<span class="info';
                            if ($component['indicator'] == '-1') $content = $content.' lheight';
                            $content = $content.'" data-id="' . $component['ise_id'] . '" data-component="SysVar" data-datapoint="16" data-unit="' . htmlentities($component['unit']) . '" data-valuelist="'.$valueList.'" data-indicator="' . $component['indicator'] . '"></span>'
                        . '</div>';
                    if ($component['operate'] == 'true') $content = $content.'<div class="clearfix"></div></div><div class="hh2 collapse" id="' . $modalId . '">'
                        . '<div class="row text-center">'
                            . '<div class="btn-group"><input  id="input'.$component['ise_id'].'" value="" style="display:none;">'
                                . $buttons
                            . '</div>'
                        . '</div>'


.'<script>
					function passcodeloadervaluelist(modalId,ise_id,setkey) {
						var inputfield= document.getElementById("input"+ise_id);
						inputfield.value = setkey;
						document.getElementById("open-modal"+modalId).style.display="block";
					}
				
					function klickpasscode(Code,modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = password.value + Code;
					}
					
					function sendpasscodeinputfield(modalId,ise_id,PassCode) {
						var inputfield= document.getElementById("input"+ise_id);
						var password = document.getElementById("password"+modalId);
						if (password.value == PassCode) {
							var xhr = new XMLHttpRequest();
							xhr.open("GET", "interface.php?statechange.cgi&ise_id="+ise_id+"&new_value="+inputfield.value);
							xhr.send();
							updateDatapoints();
							document.getElementById("open-modal"+modalId).style.display="none"										
							passcodeclear(modalId)
						}
						else
						{
							alert("Code falsch");
							passcodeclear(modalId)
						}
					}
					function passcodeclear(modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = "";
					}
					</script>'
						
						. '<div id="open-modal'.$modalId.'" class="modal-window">'
							.' <div class="modalDIV">'
								.' <a onclick= "document.getElementById(\'open-modal'.$modalId.'\').style.display=\'none\';" title="Close" class="modal-close"></a>'
								.' <div id="pinpad"> '
									.' <form>'
										.' <input type="text" id="password'.$modalId.'" style=" padding: 0 60px;border-radius: 5px;width: 100%;margin: auto;border: 1px solid rgb(228, 220, 220);outline: none;font-size: 60px;color: transparent;text-shadow: 0 0 0 rgb(71, 71, 71);text-align: center;" value=""></br>'
										.' <input type="button" value="1" onclick="klickpasscode(\'1\',\''.$modalId.'\');"  style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="2" onclick="klickpasscode(\'2\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="3" onclick="klickpasscode(\'3\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
										.' <input type="button" value="4" onclick="klickpasscode(\'4\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="5" onclick="klickpasscode(\'5\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="6" onclick="klickpasscode(\'6\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
										.' <input type="button" value="7" onclick="klickpasscode(\'7\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="8" onclick="klickpasscode(\'8\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="9" onclick="klickpasscode(\'9\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
										.' <input type="button" value="clear" onclick="passcodeclear(\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="0" onclick="klickpasscode(\'0\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
										.' <input type="button" value="enter" onclick="sendpasscodeinputfield(\''.$modalId.'\',\''.$component["ise_id"].'\',\''.$component['code'].'\');"  id="enter" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' </form>'
								.' </div>'
							.' </div>'
						.' </div>'
                    . '</div>';
                $content = $content.'</div>';
                return $content;
            case '20':
                // Text
        
                // Indikator anzeigen?
                if(!isset($component['indicator'])) {
                    $component['indicator'] = '-1';
                }
 
                if (!isset($component['color'])) $component['color'] = '#595959';
                    $content = $content. '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>';
                    if ($component['operate'] == 'true') $content = $content.'<div data-toggle="collapse" data-target="#' . $modalId . '">';
                        $content = $content.'<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                        . '<div class="pull-right">'
                            . '<span class="info';
                            if ($component['indicator'] == '') $content = $content.' lheight';
                            $content = $content.'" data-id="' . $component['ise_id'] . '" data-component="SysVar" data-datapoint="20" data-unit="' . htmlentities($component['unit']) . '" data-indicator="' . $component['indicator'] . '"></span>'
                        . '</div>';
                    if ($component['operate'] == 'true') $content = $content.'<div class="clearfix"></div></div><div class="hh2 collapse" id="' . $modalId . '">'
                        . '<div class="row text-center">'
                            . '<div class="form-inline">'
                                . '<div class="input-group">'
                                    . '<input type="text" id="input'.$component['ise_id'].'" name="' . $component['ise_id'] . '" class="form-control" placeholder="Text eingeben">'
                                    . '<span class="input-group-btn">'
                                        . '<button onclick="passcodeloaderinputfield(\''.$modalId.'\',\''.$component["ise_id"].'\');" class="btn btn-primary" data-datapoint="20" data-set-id="' . $component['ise_id'] . '" data-set-value="">OK</button>'
                                    .'</span>'
                                . '</div>'
                            . '</div>'
                        . '</div>'
					.'</div>'			


.'<script>
function passcodeloaderinputfield(modalId,ise_id) {
										document.getElementById("open-modal"+modalId).style.display="block";
					}	
					function klickpasscode(Code,modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = password.value + Code;
					}
					function sendpasscodeinputfield(modalId,ise_id,PassCode) {
						var inputfield= document.getElementById("input"+ise_id);
						var password = document.getElementById("password"+modalId);
						if (password.value == PassCode) {
							var xhr = new XMLHttpRequest();
							xhr.open("GET", "interface.php?statechange.cgi&ise_id="+ise_id+"&new_value="+inputfield.value);
							xhr.send();
							updateDatapoints();
							document.getElementById("open-modal"+modalId).style.display="none"										
							passcodeclear(modalId)
						}
						else
						{
							alert("Code falsch");
							passcodeclear(modalId)
						}
					}
					
					
					//true,false
				
					function passcodeclear(modalId) {
						var password = document.getElementById("password"+modalId);
						password.value = "";
					}	
</script>'									
					. '<div id="open-modal'.$modalId.'" class="modal-window">'
						.' <div class="modalDIV">'
							.' <a onclick= "document.getElementById(\'open-modal'.$modalId.'\').style.display=\'none\';" title="Close" class="modal-close"></a>'
							.' <div id="pinpad"> '
								.' <form>'
									.' <input type="text" id="password'.$modalId.'" style=" padding: 0 60px;border-radius: 5px;width: 100%;margin: auto;border: 1px solid rgb(228, 220, 220);outline: none;font-size: 60px;color: transparent;text-shadow: 0 0 0 rgb(71, 71, 71);text-align: center;" value=""></br>'
									.' <input type="button" value="1" onclick="klickpasscode(\'1\',\''.$modalId.'\');"  style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="2" onclick="klickpasscode(\'2\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="3" onclick="klickpasscode(\'3\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="4" onclick="klickpasscode(\'4\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="5" onclick="klickpasscode(\'5\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="6" onclick="klickpasscode(\'6\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="7" onclick="klickpasscode(\'7\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="8" onclick="klickpasscode(\'8\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="9" onclick="klickpasscode(\'9\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/><br>'
									.' <input type="button" value="clear" onclick="passcodeclear(\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="0" onclick="klickpasscode(\'0\',\''.$modalId.'\');" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 1.2em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
									.' <input type="button" value="enter" onclick="sendpasscodeinputfield(\''.$modalId.'\',\''.$component["ise_id"].'\',\''.$component['code'].'\');"  id="enter" style="box-shadow: #4e4e4e 0 0 1px 1px;font-size: 0.8em;border-radius: 50%;height: 50px;font-weight: 550;width: 50px;color: transparent;text-shadow: 0 0 0 rgb(102, 101, 101);margin: 7px 27px;"/>'
								.' </form>'
							.' </div>'
						.'</div>'
                    . '</div>';
			
                $content = $content.'</div>';
                return $content;
            default:
                if (!isset($component['color'])) $component['color'] = '#595959'; 
                return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
                    . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
                    . '<div class="pull-right">'
                        . '<span class="info" data-id="' . $component['ise_id'] . '" data-component="SysVar" data-datapoint="ise_id" data-unit="' . htmlentities($component['unit']) . '"></span>'
                    . '</div>'
                    . '<div class="clearfix"></div>'
                . '</div>';
        }
    }
}
