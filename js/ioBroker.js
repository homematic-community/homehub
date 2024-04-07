
var timerioBroker;

$(document).ready(function () {
    updateDatapointsioBroker();

    $('.setioBroker').click(function () {
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
var ioBrokerAPI =$(this).attr('data-api');	
        setDatapointIoBroker(id, value,datapoint,ioBrokerAPI);
    });
	
 $('.runioBroker').click(function () {
        var id = $(this).attr('data-run-id');
		var ioBrokerAPI =$(this).attr('data-api');	
		
        runioBrokerProgram(id, ioBrokerAPI);
    });
});

var updateDatapointsioBroker = function () 
{
	window.clearTimeout(timerioBroker);
    $('.infoioBroker').each(function ()
	{
        ioBroker_id = $(this).attr('data-id');
		//console.log($(this).attr('data-id'));
		id = $(this).attr('data-id');
		ioBrokerAPI =$(this).attr('data-api');			
			//	alert(ioBrokerAPI);
	
		$.ajax({
			type: 'GET',
			timeout:100,
			url:  ioBrokerAPI + '/get/' + ioBroker_id + '/?prettyPrint',
			dataType: 'json',
			async: false,
			 
			success: function (json) 
			{
				//console.log(json);
				xml = OBJtoXML(json,ioBroker_id);
				$(xml).find('datapoint').each(function (index) 
				{
					//console.log(index);
					var ise_id = $(this).attr('ise_id');
					var value = $(this).attr('value');
					var iobshowtime = $(this).attr('ts');
					//var iobshowtime = iobshowtime.substr(0, 10);


					
				


					var component = $('[data-id="' + ise_id + '"]').attr('data-component');
					var datapoint = $('[data-id="' + ise_id + '"]').attr('data-datapoint');
					var unit = $('[data-id="' + ise_id + '"]').attr('data-unit');
					var valueList = $('[data-id="' + ise_id + '"]').attr('data-valuelist');
					//console.log(ioBroker_id);
					if (!unit) {
						unit = '';
					}
					if (!valueList) {
						valueList = '';
					}
					
					
	var myEle = document.getElementById(ise_id+"t");

										if(myEle) {
											
	var textfarbe = "#ffffff";
var difference = Date.now() - iobshowtime;
//console.log(Date.now() + " - " + iobshowtime);
var daysDifference = Math.floor(difference/1000/60/60/24);
difference -= daysDifference*1000*60*60*24
var hoursDifference = Math.floor(difference/1000/60/60);
difference -= hoursDifference*1000*60*60
var minutesDifference = Math.floor(difference/1000/60);
difference -= minutesDifference*1000*60
var secondsDifference = Math.floor(difference/1000);
if(daysDifference > "500") {
	document.getElementById(ise_id+"t").innerHTML = ".";
} else if(daysDifference>1) {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor " + daysDifference + " Tagen  </span>";
} else if(daysDifference>0) {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor einem Tag | </span>";
} else if (hoursDifference>1) {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor " + hoursDifference + " Std.  </span>";
} else if (hoursDifference>0) {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor " + hoursDifference + " Std.  </span>";		  
} else if (minutesDifference>1) {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor " + minutesDifference + " Min.  </span>";	  
} else if (minutesDifference>0) {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor " + minutesDifference + " Min.  </span>";
} else {
	document.getElementById(ise_id+"t").innerHTML = "<span style='font-size: smaller; color: " + textfarbe + ";'> vor " + secondsDifference + " Sek.  </span>";
}

										}
										
					//console.log(datapoint);
					switch (component) {  
						case 'ioBroker':
							switch (datapoint) {


									

								
								case 'toggle':
								//console.log(ise_id+"t");
									var button = $('[data-id="' + ise_id + '"]').attr('data-button');
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
								case 'color':
									if(value.includes("#") === false)
									{
 									value = "#" + dec2Hex(value);
									} 
										
									
									
									
									$('[data-id="' + ise_id + '"]').html('<input type="color" id="favcolor'+ise_id+'" name="favcolor" value="'+value+'" >');
									let sel = document.getElementById('favcolor'+ise_id);
sel.addEventListener ("change", function () {
   let show = document.getElementById('favcolor'+ise_id).value;
   show =  show.substr(1); 
 //  alert(show);
 show = "%23" + show
 //  $('[data-id="' + ise_id + '"]').attr('data-set-value', show);
       setDatapointIoBroker(ise_id, show,datapoint,ioBrokerAPI);
	 //  alert(show);
});
									break;
									
									
								case 'dimmer':
									if(unit == '') { unit = 100; }
									$('[data-id="' + ise_id + '"]').html('<input style="display:inline;margin:0px;width:100px;" type="range" id="dim'+ise_id+'" step="5" value="'+value+'" min="0" max="'+unit+'">');
									let sel2 = document.getElementById('dim'+ise_id);
sel2.addEventListener ("change", function () {
   let show = document.getElementById('dim'+ise_id).value;
  // myElement.innerHTML;

 //  $('[data-id="' + ise_id + '"]').attr('data-set-value', show);
       setDatapointIoBroker(ise_id, show,datapoint,ioBrokerAPI);
	
});
									break;									
								default:
								//value= "68.3456";
								    // Fange undefined ab
									if(value === "undefined") { value = "0"; }
									if(value === "null") { value = "0"; }
									// Runde wenn zahl
									if (!isNaN(value)) { 

											value = Math.round(value*100)/100;
									}
									if (unit !== '') {
										$('[data-id="' + ise_id + '"]').html(value + ' ' + unit);
									} else {
										$('[data-id="' + ise_id + '"]').html(value);
									}
								break;
							}
						
					 

					
					}
					

				});
			},
			error: function () 
			{
				$('[data-id="' + id + '"]').html('<img src="icon/red_dot.png" alt="ioBroker Rest-API nicht erreichbar" title="ioBroker Rest-API nicht erreichbar" />');
			}




        
		});

	});
		//Run update periodically	
		timerioBroker = window.setTimeout(updateDatapointsioBroker,10000);	
}

var setDatapointIoBroker = function (id, value,datapoint,ioBrokerAPI) {

	 if (datapoint == "toggle")
	 {
		 
    $.ajax({
        type: 'GET',
        url: ioBrokerAPI + '/toggle/' + id + '/&prettyPrint',
        dataType: 'json',
        success: function (json) {
            $('#flash-error').hide();
            updateDatapointsioBroker();
        },
        //other code
        error: function () {
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Reqeusts.').show();
        }
    });

	 
		 
	 }
	 else if (datapoint == "color")
	 {
		 	 url = ioBrokerAPI + '/set/' + id + '?value='+ value
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (json) {
            $('#flash-error').hide();

            updateDatapointsioBroker();
        },
        //other code
        error: function () {
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Reqeusts.').show();
        }
    });
	 }
	 	 else if (datapoint == "dimmer")
	 {
		 if(value !== undefined && datapoint !== undefined)
		 {
		 url = ioBrokerAPI + '/set/' + id + '?value='+ value + '&dimmer'
		 console.log(url);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (json) {
            $('#flash-error').hide();

            updateDatapointsioBroker();
        },
        //other code
        error: function () {
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Reqeusts.').show();
        }
    });
		 }
		 else
		 {
			 console.log("Dimmer aber ohne Wert - Fehler");
		 }
	 }
	 else
	 {
		 alert("kein Modus definiert");
	 }
};


var runioBrokerProgram = function (id,ioBrokerAPI) {
	if (dev == "1") {
		XMLURL = 'dev/runprogram.php';
	} else {
		XMLURL = 'interface.php';
	}	
		 url = ioBrokerAPI + '/set/' + id + '?value=true&ack=true'
		 // alert(url);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (json) {
            $('#flash-error').hide();
// nicht notwendig
           // updateDatapoints();
        },
        //other code
        error: function () {			
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Requests.').show();
        }
    });
}; 


function OBJtoXML(obj,ise) {
  var xml = "<?xml\n";
  xml += "version='1.0' encoding='ISO-8859-1' ?>\n<state>\n";

  for (var prop in obj) {
	 if (prop== "val")
	 {
		var datapointval = obj[prop];
	 }	 
	 if (ise.includes("yeelight"))
	 {
		 //console.log("yeelight");
		 if (prop== "lc")
		{
			var datapointts = obj[prop];
		}
		 
		 
	 }
	 else  	 
	 {
		// console.log("other");
		if (prop== "ts")
		{
			var datapointts = obj[prop];
		}
	 }
  }
  //xml += obj[prop] instanceof Array ? '' : "<datapoint ise_id='" + ise + "' value='" + datapointval + "' />\n";
  xml += obj[prop] instanceof Array ? '' : "<datapoint ise_id='" + ise + "' value='" + datapointval + "' ts='" + datapointts+ "'/>\n";
  xml += "</state>";
  var xml = xml.replace(/<\/?[0-9]{1,}>/g, '');
  return xml
}


function dec2Hex(dec) {
        return Math.abs(dec).toString(16);
    }
function hex2dec(hexa){
    var chunks = [];
    var tmp,i;
    hexa = hexa.substr(1); // remove the pound 
    if ( hexa.length === 3){
        tmp = hexa.split("");
        for(i=0;i<3;i++){
            chunks.push(parseInt(tmp[i]+""+tmp[i],16));
        }
    }else if (hexa.length === 6){
        tmp = hexa.match(/.{2}/g);
        for(i=0;i<3;i++){
            chunks.push(parseInt(tmp[i],16));
        }
    }else {
        throw new Error("'"+hexa+"' is not a valid hex format");
    }

    return chunks;
}