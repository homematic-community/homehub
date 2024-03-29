/* Put your customm JS here */
var mousetimeout;
var screensaver_active = false;

// HIER SEKUNDEN BIS BILDSCHIRMSCHONER ANGEHT
var idletime = 5;

// POSITIONSWECHSEL IN SEKUNDEN (INKL. AKTUALISIERUNG DATUM UND UHRZEIT)
var jumptime = 5;

// AUS- UND EINFADETIME BEI NEUER POSITION IN MILLISEKUNDEN
var fadetime = 1000;



document.write('<style>');

document.write('#Screensaver {');
document.write('width: 100%;');
document.write('height: 100%;');
document.write('position: fixed;');
document.write('left: 0px;');
document.write('top: 0px;');
document.write('display: none;z-index:999998;background-color:black;');
document.write('background-image:url("screensaver_bg.jpg");');
document.write('background-repeat:no-repeat;background-size:cover;background-position:center;');
document.write('color: #bebdba;');
document.write('}');
document.write('');

document.write('#ScreensaverContent {');
document.write('width: 96%;');
document.write('height: 96%;');
document.write('margin: 2% 2% 2% 2%;');
document.write('}');
document.write('');

document.write('#ScreensaverBox {');
document.write('position: absolute;');
document.write('top: 50%;');
document.write('left: 50%;');
document.write('z-index:999999;');
document.write('}');
document.write('');

document.write('</style>');


document.write('<div id="Screensaver">');
document.write('<div id="ScreensaverContent">');
document.write('<div id="ScreensaverBox">');

// HIER ISE ID DER ICON SYSTEMVARIABLE
document.write('<span class="info" data-id="31585" data-component="Screensaver" data-indicator="-1" data-datapoint="icon"></span>');

document.write('<br>');

// UHRZEIT
document.write('<span class="info" style="font-size: 160pt;" id="Clock">' + dTime() + '</span>');

document.write('<br>');

// DATUM
document.write('<span class="info" style="font-size: 30pt;" id="Date">' + dDate() + '</span>');

document.write('<br>');


// HIER ISE ID DER TEXT SYSTEMVARIABLE
document.write('<span class="info" style="font-size: 20pt;" data-id="31584" data-component="Screensaver" data-indicator="-1" data-datapoint="text"></span>');
document.write('</div>');


document.write('</div>');
document.write('</div>');




//functions for date and time formatted
function dTime() {
	var d = new Date();
	return ('0' + d.getHours()).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2);
}

function dDate() {
	var d = new Date();
	return d.toLocaleDateString('de-de', { weekday:"long", month:"long", day:"numeric"});
}


//change div position and text
function refreshDiv(){
	
	if (screensaver_active) {
		var ssContent = document.getElementById('ScreensaverContent');
		var positionInfo = ssContent.getBoundingClientRect();
		var ssContentHeight = positionInfo.height;
		var ssContentWidth = positionInfo.width;
		
		var offsetWidth = 500;
		var offsetHeight = 500;
		
		var nw = 0;
		while (nw <= 0 || nw >= (ssContentWidth - offsetWidth)) {
			nw = Math.floor(Math.random() * (ssContentWidth - offsetWidth));
		}
		
		var nh = 0;
		while (nh <= 0 || nh >= (ssContentHeight - offsetHeight)) {
			nh = Math.floor(Math.random() * (ssContentHeight - offsetHeight));
		}
		
		
		$("#ScreensaverBox").fadeOut(fadetime);
		
		$('#ScreensaverBox').animate({ top: nh, left: nw });
		
		document.querySelector('[id="Clock"]').innerHTML = dTime();
		document.querySelector('[id="Date"]').innerHTML = dDate();
		
		$("#ScreensaverBox").fadeIn(fadetime);
		
		setTimeout(refreshDiv, jumptime * 1000);
	}
	
};


// detect whether the mouse is moving
$(document).mousemove(function(){
  clearTimeout(mousetimeout);
  if (screensaver_active) {
    stop_screensaver();
  }
  mousetimeout = setTimeout(show_screensaver, 1000 * idletime);
})

// show screensaver function
function show_screensaver(){
  screensaver_active = true; 
  $("#Screensaver").fadeIn();
  refreshDiv();
}


// stop screensaver
function stop_screensaver(){
  $("#Screensaver").fadeOut();
  screensaver_active = false;
}

setTimeout(show_screensaver, 1000 * idletime);

