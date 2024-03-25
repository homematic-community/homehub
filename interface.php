<?php
require_once 'config/config.php';

//   CCU User -> Falls authentifizierung notwendig, bitte in "config/config.php" wie folgt eintragen:
/*

$ccu_user = "";  // in die Anführungsstriche den Benutzernamen
$ccu_pass = "";  // in die Anführungsstriche das dazugehörige Kennwort

*/


if(!isset($ccu_user)) { $ccu_user = ""; }
if(!isset($ccu_pass)) { $ccu_pass = ""; }

// ALLE STATES
if (strpos($_SERVER['QUERY_STRING'], "statelist.cgi") !== false) {
  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . "WriteLine(\"*<*stateList*>*\");
integer show_remote = 1;
integer show_internal = 1;
string id; 
! Alle Datenpunkte durchlaufen

!foreach(id, dom.GetObject(ID_DEVICES).EnumUsedIDs()) {
	foreach(id, root.Devices().EnumUsedIDs()) {
  ! Einzelnen Datenpunkt holen
  object oDevice = dom.GetObject(id);

  integer iDevInterfaceId = oDevice.Interface();
  object oDeviceInterface = dom.GetObject(iDevInterfaceId);
  ! Namen und Wert des Elements ausgeben - geht nicht -> logged  info

  boolean bDevReady = oDevice.ReadyConfig();
  string sDevInterface   = oDeviceInterface.Name();
  string sDevType        = oDevice.HssType();

  WriteLine(\"*<*device name='\" # oDevice.Name() #\"' ise_id='\" # oDevice.ID() # \"' unreach='false' sticky_unreach='false' config_pending='false'*>*\");

  string cid; 
  integer x = 0;
  ! Alle Datenpunkte durchlaufen
  foreach(cid, oDevice.Channels()) {

    ! Einzelnen Kanal holen
    var ch = dom.GetObject(cid);
    ! Namen und Wert des Kanals ausgeben
    Write(\"*<*channel name='\"#ch.Name()#\"' ise_id='\"#ch.ID()#\"' direction='' index='\"# x #\"'\");

    if (false == ch.Internal()) {
      Write(\" visible='\" # ch.Visible() # \"'\");
    } else {
      Write(\" visible=''\");
    }

    Write(\" ready_config='' operate='\");
    if (false == ch.Internal()) {
     if( ch.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
        Write(\"true\");
      } else {
         Write(\"false\");
      }
    }
    Write(\"'*>*\");
    WriteLine(\"\");


    string did; 

    ! Alle Datenpunkte durchlaufen
    foreach(did, ch.DPs().EnumUsedIDs()) {
      var dp = dom.GetObject(did);
	     string dpA = dp.Name().StrValueByIndex(\".\", 2);

                if( (dpA != \"ON_TIME\") && (dpA != \"INHIBIT\") && (dpA != \"CMD_RETS\") && (dpA != \"CMD_RETL\") && (dpA != \"CMD_SETS\") && (dpA != \"CMD_SETL\") ) {
      WriteLine(\"*<*datapoint name='\"#dp.Name()#\"' type='\" # dp.Name().StrValueByIndex(\".\", 2) #\"' ise_id='\"#dp.ID()#\"' state='\"#dp.Value()#\"' value='\"#dp.Value()#\"' valuetype='\"#dp.ValueType()#\"' valueunit='\" # dp.ValueUnit() # \"' timestamp='\" # dp.Timestamp().ToInteger()# \"' operations='\"#dp.Operations()#\"'/*>*\");
				  }
    }
    WriteLine(\"*<*/channel*>*\");
	  x=x+1;
  }
 

  WriteLine(\"*<*/device*>*\");
}
WriteLine(\"*<*/stateList*>*\");";

  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";

// Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
 // exit();
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}

// ALLE DEVICES
if (strpos($_SERVER['QUERY_STRING'], "devicelist.cgi") !== false) {
  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . " WriteLine(\"\");
    string  PARTNER_INVALID = \"65535\";
integer show_internal = \"} 1 {\";
      integer show_remote = \"} 1 {\";
  WriteLine(\"*<*deviceList*>*\");
string id; 
! Alle Datenpunkte durchlaufen

foreach(id, dom.GetObject(ID_DEVICES).EnumUsedIDs()) {
!	foreach(id, root.Devices().EnumUsedIDs()) {
  ! Einzelnen Datenpunkt holen
  object oDevice = dom.GetObject(id);

  integer iDevInterfaceId = oDevice.Interface();
  object oDeviceInterface = dom.GetObject(iDevInterfaceId);
  ! Namen und Wert des Elements ausgeben - geht nicht -> logged  info



  boolean bDevReady = oDevice.ReadyConfig();
  string sDevInterface   = oDeviceInterface.Name();
  string sDevType        = oDevice.HssType();
  Write(\"*<*device name='\" # oDevice.Name() #\"' address='\" # oDevice.Address() # \"' ise_id='\" # oDevice.ID() # \"' interface='\" # sDevInterface # \"' device_type='\" # sDevType # \"' ready_config='\" # bDevReady # \"' *>*\");
  WriteLine(\"\");

  string cid; 
  integer x = 0;

  ! Alle Datenpunkte durchlaufen
  foreach(cid, oDevice.Channels()) {



    ! Einzelnen Kanal holen
    var ch = dom.GetObject(cid);
    ! Namen und Wert des Kanals ausgeben
    !WriteLine(ch.Name() # \": \" # ch.ID());
	string  sChnPartnerId = ch.ChnGroupPartnerId();
	if (PARTNER_INVALID == sChnPartnerId) { sChnPartnerId = \"\"; }
    Write(\"*<*channel name='\"#ch.Name()#\"' type='\"#ch.ChannelType()#\"' address='\"#ch.Address()#\"' ise_id='\"#ch.ID()#\"' direction='' parent_device='\"#ch.Device()#\"' index='\"# x #\"' group_partner='\" # sChnPartnerId # \"' aes_available='' transmission_mode=''\");

 if (false == ch.Internal()) {
                Write(\" visible='\" # ch.Visible() # \"'\");
              } else {
                Write(\" visible=''\");
              }

 Write(\" ready_config='' operate='\");
 if (false == ch.Internal()) {
   if( ch.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
                  Write(\"true\");
                } else {
                  Write(\"false\");
                }
}
Write(\"' /*>*\");
 WriteLine(\"\");
 

 x=x+1;



  }
 WriteLine(\"*<*/device*>*\");


}
WriteLine(\"*<*/deviceList*>*\");";

  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";

// Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
 // exit();
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}	
	


// ALLE PROGRAMME
if (strpos($_SERVER['QUERY_STRING'], "programlist.cgi") !== false) {
	
  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . "WriteLine(\"*<*programList*>*\");
string id; 
! Alle Datenpunkte durchlaufen
foreach(id, dom.GetObject(ID_PROGRAMS).EnumUsedIDs()) {
  ! Einzelnen Datenpunkt holen
  var sysProgram = dom.GetObject(id);
  ! Namen und Wert des Elements ausgeben - speziell -> operate=''
  Write(\"*<*program id='\" # sysProgram.ID() # \"' active='\" # sysProgram.Active() # \"' timestamp='\" # sysProgram.ProgramLastExecuteTime().ToInteger() # \"' name='\" # sysProgram.Name() # \"' description='\" # sysProgram.PrgInfo() # \"' visible='\" # sysProgram.Visible() # \"' operate='\");
  object o_sysVar = dom.GetObject(sysProgram.ID());
  if( o_sysVar.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
    Write(\"true'/*>*\");
  } else {
    Write(\"false'/*>*\");
  }
  WriteLine(\"\");
}
WriteLine(\"*<*/programList*>*\");";

  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";

// Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
 // exit();
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}


// ALLE SYSTEMVARIABLEN
if (strpos($_SERVER['QUERY_STRING'], "sysvarlist.cgi") !== false) {
	
  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . "WriteLine(\"*<*systemVariables*>*\n\");
     
string id; 
! Alle Datenpunkte durchlaufen
foreach(id, dom.GetObject(ID_SYSTEM_VARIABLES).EnumUsedIDs()){
  ! Einzelnen Datenpunkt holen
  var oSysVar = dom.GetObject(id);
  ! Namen und Wert des Elements ausgeben - fehlt -> visible
  Write(\"*<*systemVariable name='\" # oSysVar.Name() # \"' \");
    if (oSysVar.ValueSubType() == 6) {
      Write(\"variable='\" # oSysVar.AlType() # \"' \");
    } else {
      Write(\"variable='\" # oSysVar.Variable() # \"' \");
    } 
    Write(\"value='\" # oSysVar.Value() # \"' \");
    Write(\"value_list='\");
    if (oSysVar.ValueType() == 16) {
      Write( oSysVar.ValueList());
    }
	Write(\"' ise_id='\"#oSysVar.ID()#\"' \");
    Write(\"  min='\");
    if (oSysVar.ValueType() == 4) {
      Write( oSysVar.ValueMin());
    }
   
    Write(\"' max='\");
    if (oSysVar.ValueType() == 4) {
      Write( oSysVar.ValueMax());
    }
	Write(\"' \");
	Write(\"unit='\" # oSysVar.ValueUnit() # \"' type='\" # oSysVar.ValueType() # \"' subtype='\" # oSysVar.ValueSubType() # \"' logged='\" # oSysVar.DPArchive() # \"' visible='\" # oSysVar.Visible() # \"' timestamp='\" # oSysVar.Timestamp().ToInteger()# \"' value_name_0='\" # oSysVar.ValueName0() # \"' value_name_1='\" # oSysVar.ValueName1() # \"' info='\" # oSysVar.DPInfo() # \"'/*>*\");
  }
  WriteLine(\"*<*/systemVariables*>*\");";


 


  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";

// Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
 // exit();
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}


// PROGRAMM
if (strpos($_SERVER['QUERY_STRING'], "runprogram.cgi") !== false) {


  // Beende wenn keine Program_ID übergeben wird
  if(!isset($_GET['program_id'])) 
  {
	echo "keine program_id";
	exit();
  }

  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . ' dom.GetObject("'.$_GET['program_id'].'").ProgramExecute();';
  $ccu_request = $ccu_request . "\r\n";  
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";


  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }
  
  
  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";
  
  // Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);

  // Trenne Rückgabe vom Overhead
  //$cleancontent = explode("ENDE",$content);
  //echo $cleancontent[0];
  exit();

  // Schreibe Ausgabe
  //header("Content-Type: application/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?><state>"; 
  //<result><started program_id="55436"/></result>

}

// WERTÄNDERUNG
if (strpos($_SERVER['QUERY_STRING'], "statechange.cgi") !== false) {


  // Beende wenn keine Program_ID übergeben wird
  if((!isset($_GET['ise_id'])) OR (!isset($_GET['new_value'])))
  {
	echo "keine ise_id oder new_value gesetzt";
	exit();
  }
  // Trenne ise_id und new_value anhand , auf
  $iseids = explode(",",$_GET['ise_id']);
  $newvalues = explode(",",$_GET['new_value']);
  $ccu_request = "";
  
  // Zähler für new_values
   $i = 0;
    // Baue Skript zusammen
   foreach ($iseids as $iseid) {
	if( ctype_digit($iseid) ) {
    //  $ccu_request = $ccu_request . 'WriteLine("'.$datapoint.'**Steingarten**" #dom.GetObject('.$datapoint.').Value().ToString().UriEncode()#" ");';
	  $ccu_request = $ccu_request . ' dom.GetObject("'.$iseid.'").State("'.$newvalues[$i].'");';
      $ccu_request = $ccu_request . "\r\n";
	  $i++;
    }
  }
  


  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }
  
  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";
  
  
  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";
  
  // Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);

  // Trenne Rückgabe vom Overhead
  //$cleancontent = explode("ENDE",$content);
  //echo $cleancontent[0];
  exit();

  // Schreibe Ausgabe
  //header("Content-Type: application/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?><state>"; 
  //<result><started program_id="55436"/></result>

}
//SYSVAR

if (strpos($_SERVER['QUERY_STRING'], "sysvar.cgi") !== false) {


  // Beende wenn keine Datapoint_ID übergeben wird
  if(!isset($_GET['ise_id'])) 
  {
	echo "keine ise_ids";
	exit();
  }
  
  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . "WriteLine(\"*<*systemVariables*>*\");
string id; 
! Alle Datenpunkte durchlaufen
foreach(id, dom.GetObject(ID_SYSTEM_VARIABLES).EnumUsedIDs()){

 
  ! Einzelnen Datenpunkt holen
  var sysVar = dom.GetObject(id);
   if(".$_GET['ise_id']." ==  sysVar.ID()) {
  ! Namen und Wert des Elements ausgeben - fehlt -> visible
  Write(\"*<*systemVariable name='\" # sysVar.Name() # \"' variable='\" # sysVar.Variable() # \"' value='\" # sysVar.Value() # \"' value_list='\" # sysVar.ValueList() # \"' ise_id='\" # sysVar.ID() # \"' min='\" # sysVar.ValueMin() # \"' max='\" # sysVar.ValueMax() # \"' unit='\" # sysVar.ValueUnit() # \"' type='\" # sysVar.ValueType() # \"' subtype='\" # sysVar.ValueSubType() # \"' logged='\" # sysVar.DPArchive() # \"' visible='\" # sysVar.Visible() # \"' timestamp='\" # sysVar.Timestamp().ToInteger()# \"' value_name_0='\" # sysVar.ValueName0() # \"' value_name_1='\" # sysVar.ValueName1() # \"' info='\" # sysVar.DPInfo() # \"'/*>*\");
  WriteLine(\"\");
  }
}
WriteLine(\"*<*/systemVariables*>*\");";

  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";

// Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
 // exit();
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}


// STATUS
else if (strpos($_SERVER['QUERY_STRING'], "state.cgi") !== false) {


  // Beende wenn keine Datapoint_ID übergeben wird
  if(!isset($_GET['datapoint_id'])) 
  {
	echo "keine datapoint_ids";
	exit();
  }
  // Trenne datapoint_id anhand , auf
  $datapoints = explode(",",$_GET['datapoint_id']);
  $ccu_request = "";
  
  // Baue Skript zusammen
  $ccu_request = $ccu_request . "WriteLine(\"*<*state*>*\");\r\n";
  foreach ($datapoints as $datapoint) {
	 
	if( ctype_digit($datapoint) ) {
	  $ccu_request = $ccu_request . "object oDatapoint = dom.GetObject(".$datapoint.");\r\n";
	  $ccu_request = $ccu_request . "if (oDatapoint.IsTypeOf(OT_DP)) {\r\n";
	   $ccu_request = $ccu_request . "WriteLine(\"*<*datapoint ise_id='".$datapoint."' value='\"#dom.GetObject(".$datapoint.").Value().ToString()#\"'/*>*\");\r\n";
	 // $ccu_request = $ccu_request . "WriteLine(\"*<*datapoint ise_id='".$datapoint."' value='\"#dom.GetObject(.$datapoint.').Value().ToString().UriEncode()#\"'/>");
	  $ccu_request = $ccu_request . "}\r\n";
    }
	
  }
   $ccu_request = $ccu_request . "WriteLine(\"*<*/state*>*\");\r\n";
  
  
  
  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }
  
  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";
  
  // Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
  
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}






// SYSTEMNOTIFICATION

if (strpos($_SERVER['QUERY_STRING'], "systemNotification.cgi") !== false) {



  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . "WriteLine(\"*<*systemNotification*>*\");
  string id; 
  ! Alle Datenpunkte durchlaufen
  foreach(id, dom.GetObject(ID_SERVICES).EnumUsedIDs()){

 
    ! Einzelnen Datenpunkt holen
    var serviceVar = dom.GetObject(id);
    object trigDP = dom.GetObject(serviceVar.AlTriggerDP());
    if( serviceVar.IsTypeOf( OT_ALARMDP ) && ( serviceVar.AlState() == asOncoming ) ){
      ! Namen und Wert des Elements ausgeben - fehlt -> visible
      Write(\"*<*notification ise_id='\" # serviceVar.AlTriggerDP() # \"' name='\" # trigDP.Name() # \"' type='\" # trigDP.HssType() # \"' timestamp='\" # serviceVar.LastTriggerTime().ToInteger() # \"'/*>*\");
      WriteLine(\"\");
    }
  }
  WriteLine(\"*<*/systemNotification*>*\");";

  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";

// Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);
 // exit();
  // Trenne Rückgabe vom Overhead
  $cleancontent = explode("ENDE",$content);
  
  // Konvertiere XML kritische Zeichen in HTML-Format
  $cleancontent[0] = str_replace("<","&lt;",  $cleancontent[0]);
  $cleancontent[0] = str_replace( ">","&gt;", $cleancontent[0]);
  $cleancontent[0] = str_replace("*&lt;*","<",  $cleancontent[0]);
  $cleancontent[0] = str_replace("*&gt;*", ">", $cleancontent[0]);
 

  // Schreibe Ausgabe
  header("Content-Type: text/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?>"; 
  echo $cleancontent[0];
  exit();
}


// SYSTEMNOTIFICATIONCLEAR
if (strpos($_SERVER['QUERY_STRING'], "systemNotificationClear.cgi") !== false) {



  $ccu_request = "";

  // Baue Skript zusammen
  $ccu_request = $ccu_request . "string itemID;
string address;
object aldp_obj;

foreach(itemID, dom.GetObject(ID_DEVICES).EnumUsedIDs()) {
address = dom.GetObject(itemID).Address();
aldp_obj = dom.GetObject(\"AL-\" # address # \":0.STICKY_UNREACH\");
if (aldp_obj) {
if (aldp_obj.Value()) {
aldp_obj.AlReceipt();
}
}
} ";  
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";


  // Debug Mode
  if(isset($_GET["debug"]))
  {
    echo $ccu_request;
    exit();
  }
  
  
  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $ccu_request = $ccu_request ."WriteLine(\"ENDE\");";
  
  // Curl Anfrage bauen
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, "http://" . $homematicIp . ":8181/hmip.exe");
  if ($ccu_user != "" && $ccu_pass != "") {
    curl_setopt($curl,CURLOPT_USERPWD, $ccu_user.":".$ccu_pass);	
  }
  curl_setopt($curl,CURLOPT_POST, 1);
  curl_setopt($curl,CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,2);
  curl_setopt($curl,CURLOPT_TIMEOUT, 20);
  $content = curl_exec($curl);
  curl_close($curl);

  // Trenne Rückgabe vom Overhead
  //$cleancontent = explode("ENDE",$content);
  //echo $cleancontent[0];
  exit();

  // Schreibe Ausgabe
  //header("Content-Type: application/xml; charset=ISO-8859-1");  
  echo "<?xml version='1.0' encoding='ISO-8859-1' ?><state>"; 
  //<result><started program_id="55436"/></result>

}

?>


