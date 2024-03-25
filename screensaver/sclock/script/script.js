/*
  2023 by Gerti
*/
const heute = new Date(); 
var seconds = heute.getSeconds();
var minuten = heute.getMinutes();
var cnum_a = "0";
if (minuten % 2 != 0) {
  cnum_a = "1";
}    
var imgupdate = 1;
document.getElementById("clock0").style.display="none";
document.getElementById("clock1").style.display="none";

movetextclock(cnum_a);
textclock(cnum_a);
showclock(cnum_a);

var x = setInterval(clockcount, 1000);
var y = setInterval(switchimg, intervall * 60 * 1000);

function switchimg() {
   if (imgupdate == 0) { imgupdate = 1; }
}

function clockcount() {
   const heute = new Date(); 
   var seconds = heute.getSeconds();
   var minuten = heute.getMinutes();
   var cnum_a = "0";
   var cnum_b = "1";
   if (minuten % 2 != 0) {
      cnum_a = "1";
      cnum_b = "0";
   }
   if (seconds == 59) {
      movetextclock(cnum_b);
      if (updateimg == true && imgupdate == 1) {
        document.getElementById("hideslide").style.animation="slideunvisi 0.8s linear";
        document.getElementById("hideslide").style.display="inline";
      }      
   }
   if (seconds == 0) {         
      hideclock(cnum_b); 
      textclock(cnum_a);
      if (updateimg == true && imgupdate == 1) {
        document.getElementById("backgroundslide").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/bg.jpg?" + minuten + "')";
      }
      showclock(cnum_a);     
   }
}

function hideclock(cnum) {
   document.getElementById("clock" + cnum).style.animation="unvisi 1s linear";
    setTimeout(function() {
        document.getElementById("clock" + cnum).style.display="none";
    }, 900); 
}

function showclock(cnum) {
   document.getElementById("clock" + cnum).style.display="inline";
   document.getElementById("clock" + cnum).style.animation="visi 1s linear";   
   if (updateimg == true && imgupdate == 1) {
        document.getElementById("hideslide").style.animation="slidevisi 1s linear";
        setTimeout(function() {
            document.getElementById("hideslide").style.display="none";
        }, 900);    
        imgupdate = 0;
    }
}

function textclock(cnum) {
   const heute = new Date(); 	
   var stunden = heute.getHours();
   var minuten = heute.getMinutes();

   if (stunden > 12) { stunden = stunden - 12; }
   var text_a = "";
   var text_b = "";
   var text_c = "";
   var text = "";
   
   if (((minuten == 5) && (stunden != 0)) || (minuten == 55)) {
      text_a = "f&uuml;nf";
      if (minuten == 5) { text_b = "nach"; }
      else {
        text_b = "vor";
        stunden = stunden + 1;
        if (stunden > 12) { stunden = 1; } 
      }
      text_c = numtoText(stunden);
   }
   else if (((minuten == 10) && (stunden != 0)) || (minuten == 50)) {
      text_a = "zehn";
      if (minuten == 10) { text_b = "nach"; }
      else {
        text_b = "vor";
        stunden = stunden + 1;
        if (stunden > 12) { stunden = 1; } 
      }
      text_c = numtoText(stunden);
   }
   else if (((minuten == 15) && (stunden != 0)) || (minuten == 45)) {
      text_a = "viertel";
      if (minuten == 15) { text_b = "nach"; }
      else {
        text_b = "vor";
        stunden = stunden + 1;
        if (stunden > 12) { stunden = 1; } 
      }
      text_c = numtoText(stunden);
   }
   else if (((minuten == 20) && (stunden != 0)) || (minuten == 40)) {
      text_a = "zwanzig";
      if (minuten == 20) { text_b = "nach"; }
      else {
        text_b = "vor";
        stunden = stunden + 1;
        if (stunden > 12) { stunden = 1; } 
      }
      text_c = numtoText(stunden);
   }
   else if (minuten == 30) {
      text_a = "halb";
      stunden = stunden + 1;
      if (stunden > 12) { stunden = 1; }
      text_b = numtoText(stunden);
      text_c = "";
   }
   else if (minuten == 0) {
      text_a = numtoText(stunden);
      if (text_a == "eins") { text_a = "ein"; } 
      text_b = "uhr";
      text_c = "";
   }
   else {
      text_a = numtoText(stunden);
      if (text_a == "eins") { text_a = "ein"; } 
      text_b = "uhr";
      text_c = numtoText(minuten);
   }	
   
   text = text_a + " " + text_b + " " + text_c; 
   document.getElementById("clock" + cnum).innerHTML = text;
}   

function movetextclock(cnum) { 
  var element = document.getElementById("clock" + cnum);
  var x = Math.floor(Math.random() * ((window.innerWidth)-760));
  var y = Math.floor(Math.random() * ((window.innerHeight)-160));
  var x_align = Math.floor(Math.random() * 2);
  if (x_align == 0) {  element.style.textAlign = "left"; }
  else { element.style.textAlign = "right"; }
  element.style.left = x + 10 + "px";
  element.style.top = y + 10 + "px";
}     

function numtoText(i) {
  var text = "";
    switch (i) {
      case 0:
        text = "null";
        break;
      case 1:
        text = "eins";
        break;
      case 2:
        text = "zwei";
        break;
      case 3:
        text = "drei";
        break;
      case 4:
        text = "vier";
        break;
      case 5:
        text = "f&uuml;nf";
        break;
      case 6:
        text = "sechs";
        break;
      case 7:
        text = "sieben";
        break;
      case 8:
        text = "acht";
        break;
      case 9:
        text = "neun";
        break;
      case 10:
        text = "zehn";
        break;
      case 11:
        text = "elf";
        break;
      case 12:
        text = "zw&ouml;lf";
        break;
      case 13:
        text = "dreizehn";
        break;
      case 14:
        text = "vierzehn";
        break;
      case 15:
        text = "f&uuml;nfzehn";
        break;
      case 16:
        text = "sechzehn";
        break;
      case 17:
        text = "siebzehn";
        break;
      case 18:
        text = "achtzehn";
        break;
      case 19:
        text = "neunzehn";
        break;
      case 20:
        text = "zwanzig";
        break;
      case 21:
        text = "einundzwanzig";
        break;
      case 22:
        text = "zweiundzwanzig";
        break;
      case 23:
        text = "dreiundzwanzig";
        break;
      case 24:
        text = "vierundzwanzig";
        break;
      case 25:
        text = "f&uuml;nfundzwanzig";
        break;
      case 26:
        text = "sechsundzwanzig";
        break;
      case 27:
        text = "siebenundzwanzig";
        break;
      case 28:
        text = "achtundzwanzig";
        break;
      case 29:
        text = "neunundzwanzig";
        break;
      case 30:
        text = "drei&szlig;ig";
        break;
      case 31:
        text = "einunddrei&szlig;ig";
        break;
      case 32:
        text = "zweiunddrei&szlig;ig";
        break;
      case 33:
        text = "dreiunddrei&szlig;ig";
        break;
      case 34:
        text = "vierunddrei&szlig;ig";
        break;
      case 35:
        text = "f&uuml;nfunddrei&szlig;ig";
        break;
      case 36:
        text = "sechsunddrei&szlig;ig";
        break;
      case 37:
        text = "siebenunddrei&szlig;ig";
        break;
      case 38:
        text = "achtunddrei&szlig;ig";
        break;
      case 39:
        text = "neununddrei&szlig;ig";
        break;
      case 40:
        text = "vierzig";
        break;
      case 41:
        text = "einundvierzig";
        break;
      case 42:
        text = "zweiundvierzig";
        break;
      case 43:
        text = "dreiundvierzig";
        break;
      case 44:
        text = "vierundvierzig";
        break;
      case 45:
        text = "f&uuml;nfundvierzig";
        break;
      case 46:
        text = "sechsundvierzig";
        break;
      case 47:
        text = "siebenundvierzig";
        break;
      case 48:
        text = "achtundvierzig";
        break;
      case 49:
        text = "neunundvierzig";
        break;
      case 50:
        text = "f&uuml;nfzig";
        break;
      case 51:
        text = "einundf&uuml;nfzig";
        break;
      case 52:
        text = "zweiundf&uuml;nfzig";
        break;
      case 53:
        text = "dreiundf&uuml;nfzig";
        break;
      case 54:
        text = "vierundf&uuml;nfzig";
        break;
      case 55:
        text = "f&uuml;nfundf&uuml;nfzig";
        break;
      case 56:
        text = "sechsundf&uuml;nfzig";
        break;
      case 57:
        text = "siebenundf&uuml;nfzig";
        break;
      case 58:
        text = "achtundf&uuml;nfzig";
        break;
      case 59:
        text = "neunundf&uuml;nfzig";
        break;
  }
  return text;
}

function updatebg() {
}
