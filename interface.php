<?php

//   CCU User -> Falls authentifizierung notwendig, bitte in "config/config.php" wie folgt eintragen:
/*

$ccu_user = "";  // in die Anführungsstriche den Benutzernamen
$ccu_pass = "";  // in die Anführungsstriche das dazugehörige Kennwort

*/

if (!file_exists(__DIR__.'/config/config.php')) {
	header('Location: setup.php');
	exit;
}
require_once(__DIR__.'/config/config.php');

// Konfiguration als Array aus Config-Variablen zusammenbauen
if (empty($ccu) or !is_array($ccu)) $ccu = array(
  'host' => $homematicIp,
  'https' => !empty($ccu_https),
  'user' => ( isset($ccu_user) ? $ccu_user : false ),
  'pw' => ( isset($ccu_pass) ? $ccu_pass : false ),
);
// --

$ccu['url'] = "http".(!empty($ccu['https']) ? 's' : '')."://" . $ccu['host'] . ":".(!empty($ccu['https']) ? '4' : '')."8181/homehub.exe";


function ccu_remote($ccu, $ccu_request, $plain_result = false) {

  // Als indikator für die Rückgabe, um den Overhead zu filtern
  $delimeter = '---'.uniqid('hm-end').'---';
  if (!$plain_result) {
    $ccu_request = str_replace(array('<','>'), array('*<*','*>*'), $ccu_request);
    $ccu_request = $ccu_request."\nWriteLine(\"".$delimeter."\");";
  }

  // curl Anfrage bauen
  $curl = curl_init($ccu['url']);
  if (!empty($ccu['user']) and !empty($ccu['pw'])) curl_setopt($curl, CURLOPT_USERPWD, $ccu['user'].':'.$ccu['pw']);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $ccu_request);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
  curl_setopt($curl, CURLOPT_TIMEOUT, 20);
  curl_setopt($curl, CURLOPT_FAILONERROR, true);
  if (!empty($ccu['https'])) {
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  }
  $content = curl_exec($curl);
  if ($content === false) {
    die(basename(__FILE__) . " - CURL error " . curl_getinfo($curl_handle, CURLINFO_HTTP_CODE) . " " . curl_error($curl_handle));
  }
  curl_close($curl);
  #var_dump("\n\nCCU remote", $content, "\n ---------- \n\n");

  // Trenne Rückgabe vom Overhead
  if (!$plain_result) $content = strstr($content, $delimeter, true);

  if (!$plain_result) {
    if (strpos($content, '<') !== false) {
      // Konvertiere XML kritische Zeichen in HTML-Format     #  Maskierung sollte eigentlich nicht notwendig sein.
      $content = str_replace('<', '&lt;', $content);          #  Ggf. sollten wir uns eine elegantere Variante überlegen, RegEx oder ähnliches,
      $content = str_replace('>', '&gt;', $content);          #  oder im HM-Skript mit .replace() maskieren.
      $content = str_replace('*&lt;*', '<', $content);
      $content = str_replace('*&gt;*', '>', $content);
    }
  }

  return $content;
}

if (!function_exists("array_is_list")) {
  function array_is_list(array $array): bool {
    $i = -1;
      foreach ($array as $k => $v) {
        ++$i;
        if ($k !== $i) return false;
      }
    return true;
  }
}

// ALLE STATES
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "statelist.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_statelist($ccu, isset($_GET['debug']));
}

function api_statelist($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
WriteLine("<stateList>");
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

  boolean isRemote = ( ("#HMW-RCV-50" == oDevice.HssType()) || ("#HM-RCV-50" == oDevice.HssType()) || ("#HmIP-RCV-50" == oDevice.HssType()) );
		
  if( (oDeviceInterface) && (true == bDevReady) && ( ( isRemote == false ) || ( show_remote == 1 ) ) ) {
  
  
  string sDevInterface   = oDeviceInterface.Name();
  string sDevType        = oDevice.HssType();



  WriteLine("<device name='" # oDevice.Name() #"' ise_id='" # oDevice.ID() # "' unreach='false' sticky_unreach='false' config_pending='false'>");

  string cid;
  integer x = 0;
  ! Alle Datenpunkte durchlaufen
  foreach(cid, oDevice.Channels()) {

    ! Einzelnen Kanal holen
    var ch = dom.GetObject(cid);
    ! Namen und Wert des Kanals ausgeben
    Write("<channel name='"#ch.Name()#"' ise_id='"#ch.ID()#"' direction='' index='"# x #"'");

    if (false == ch.Internal()) {
      Write(" visible='" # ch.Visible() # "'");
    } else {
      Write(" visible=''");
    }

    Write(" ready_config='' operate='");
    if (false == ch.Internal()) {
     if( ch.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
        Write("true");
      } else {
         Write("false");
      }
    }
    Write("'>");
    WriteLine("");


    string did;

    ! Alle Datenpunkte durchlaufen
    foreach(did, ch.DPs().EnumUsedIDs()) {
      var dp = dom.GetObject(did);
	     string dpA = dp.Name().StrValueByIndex(".", 2);

                if( (dpA != "ON_TIME") && (dpA != "INHIBIT") && (dpA != "CMD_RETS") && (dpA != "CMD_RETL") && (dpA != "CMD_SETS") && (dpA != "CMD_SETL") ) {
      WriteLine("<datapoint name='"#dp.Name()#"' type='" # dp.Name().StrValueByIndex(".", 2) #"' ise_id='"#dp.ID()#"' state='"#dp.Value()#"' value='"#dp.Value()#"' valuetype='"#dp.ValueType()#"' valueunit='" # dp.ValueUnit() # "' timestamp='" # dp.Timestamp().ToInteger()# "' operations='"#dp.Operations()#"'/>");
				  }
    }
    WriteLine("</channel>");
	  x=x+1;
  }


  WriteLine("</device>");
  }
}
WriteLine("</stateList>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// ALLE STATES
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "statelistall.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_statelistall($ccu, isset($_GET['debug']));
}

function api_statelistall($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
WriteLine("<stateList>");
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

  WriteLine("<device name='" # oDevice.Name() #"' ise_id='" # oDevice.ID() # "' unreach='false' sticky_unreach='false' config_pending='false'>");

  string cid;
  integer x = 0;
  ! Alle Datenpunkte durchlaufen
  foreach(cid, oDevice.Channels()) {

    ! Einzelnen Kanal holen
    var ch = dom.GetObject(cid);
    ! Namen und Wert des Kanals ausgeben
    Write("<channel name='"#ch.Name()#"' ise_id='"#ch.ID()#"' direction='' index='"# x #"'  timestamp='" # ch.LastTimestamp().ToInteger()# "'");

    if (false == ch.Internal()) {
      Write(" visible='" # ch.Visible() # "'");
    } else {
      Write(" visible=''");
    }

    Write(" ready_config='' operate='");
    if (false == ch.Internal()) {
     if( ch.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
        Write("true");
      } else {
         Write("false");
      }
    }
    Write("'>");
    WriteLine("");


    string did;

    ! Alle Datenpunkte durchlaufen
    foreach(did, ch.DPs()) {
      var dp = dom.GetObject(did);
	     string dpA = dp.Name().StrValueByIndex(".", 2);

                if( (dpA != "ON_TIME") && (dpA != "INHIBIT") && (dpA != "CMD_RETS") && (dpA != "CMD_RETL") && (dpA != "CMD_SETS") && (dpA != "CMD_SETL") ) {
      WriteLine("<datapoint name='"#dp.Name()#"' type='" # dp.Name().StrValueByIndex(".", 2) #"' ise_id='"#dp.ID()#"' state='"#dp.Value()#"' value='"#dp.Value()#"' valuetype='"#dp.ValueType()#"' valueunit='" # dp.ValueUnit() # "' timestamp='" # dp.LastTimestamp().ToInteger()# "' operations='"#dp.Operations()#"'/>");
				  }
    }
    WriteLine("</channel>");
	  x=x+1;
  }


  WriteLine("</device>");
}
WriteLine("</stateList>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// ALLE DEVICES
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "devicelist.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_devicelist($ccu, isset($_GET['debug']));
}

function api_devicelist($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
WriteLine("");
string  PARTNER_INVALID = "65535";
integer show_internal = "} 1 {";
integer show_remote = "} 1 {";
 WriteLine("<deviceList>");
string id;
! Alle Datenpunkte durchlaufen

!foreach(id, root.Devices().EnumUsedIDs()) {
foreach(id, dom.GetObject(ID_DEVICES).EnumUsedIDs()) {
  ! Einzelnen Datenpunkt holen
  object oDevice = dom.GetObject(id);

  integer iDevInterfaceId = oDevice.Interface();
  object oDeviceInterface = dom.GetObject(iDevInterfaceId);
  boolean bDevReady = oDevice.ReadyConfig();
  boolean isRemote = ( ("#HMW-RCV-50" == oDevice.HssType()) || ("#HM-RCV-50" == oDevice.HssType()) || ("#HmIP-RCV-50" == oDevice.HssType()) );
		
  if( (oDeviceInterface) && (true == bDevReady) && ( ( isRemote == false ) || ( show_remote == 1 ) ) ) {
    ! Namen und Wert des Elements ausgeben - geht nicht -> logged  info

    boolean bDevReady = oDevice.ReadyConfig();

    string sDevInterface   = oDeviceInterface.Name();
    string sDevType        = oDevice.HssType();
    Write("<device name='" # oDevice.Name() #"' address='" # oDevice.Address() # "' ise_id='" # oDevice.ID() # "' interface='" # sDevInterface # "' device_type='" # sDevType # "' ready_config='" # bDevReady # "' >");
    WriteLine("");

    string cid;
    integer x = 0;

    ! Alle Datenpunkte durchlaufen
    foreach(cid, oDevice.Channels()) {

      ! Einzelnen Kanal holen
      var ch = dom.GetObject(cid);
      ! Namen und Wert des Kanals ausgeben
      !WriteLine(ch.Name() # ": " # ch.ID());
	  string  sChnPartnerId = ch.ChnGroupPartnerId();
	  if (PARTNER_INVALID == sChnPartnerId) { sChnPartnerId = ""; }
      Write("<channel name='"#ch.Name()#"' type='"#ch.ChannelType()#"' address='"#ch.Address()#"' ise_id='"#ch.ID()#"' direction='' parent_device='"#ch.Device()#"' index='"# x #"' group_partner='" # sChnPartnerId # "' aes_available='' transmission_mode=''");

      if (false == ch.Internal()) {
        Write(" visible='" # ch.Visible() # "'");
      } else {
        Write(" visible=''");
      }

      Write(" ready_config='' operate='");
      if (false == ch.Internal()) {
        if( ch.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
          Write("true");
        } else {
          Write("false");
        }
      }
      Write("' />");
      WriteLine("");
      x=x+1;
    }
    WriteLine("</device>");
  }
}
WriteLine("</deviceList>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// ALLE PROGRAMME
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "programlist.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_programlist($ccu, isset($_GET['debug']));
}

function api_programlist($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
WriteLine("<programList>");
string id;
! Alle Datenpunkte durchlaufen
foreach(id, dom.GetObject(ID_PROGRAMS).EnumUsedIDs()) {
  ! Einzelnen Datenpunkt holen
  var sysProgram = dom.GetObject(id);
  ! Namen und Wert des Elements ausgeben - speziell -> operate=''
  Write("<program id='" # sysProgram.ID() # "' active='" # sysProgram.Active() # "' timestamp='" # sysProgram.ProgramLastExecuteTime().ToInteger() # "' name='" # sysProgram.Name() # "' description='" # sysProgram.PrgInfo() # "' visible='" # sysProgram.Visible() # "' operate='");
  object o_sysVar = dom.GetObject(sysProgram.ID());
  if( o_sysVar.UserAccessRights(iulOtherThanAdmin) == iarFullAccess ) {
    Write("true'/>");
  } else {
    Write("false'/>");
  }
  WriteLine("");
}
WriteLine("</programList>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// ALLE SYSTEMVARIABLEN
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "sysvarlist.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_sysvarlist($ccu, isset($_GET['debug']));
}

function api_sysvarlist($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
WriteLine("<systemVariables>\n");

string id;
! Alle Datenpunkte durchlaufen
foreach(id, dom.GetObject(ID_SYSTEM_VARIABLES).EnumUsedIDs()){
  ! Einzelnen Datenpunkt holen
  var oSysVar = dom.GetObject(id);
  ! Namen und Wert des Elements ausgeben - fehlt -> visible
  Write("<systemVariable name='" # oSysVar.Name() # "' ");
    if (oSysVar.ValueSubType() == 6) {
      Write("variable='" # oSysVar.AlType() # "' ");
    } else {
      Write("variable='" # oSysVar.Variable() # "' ");
    }
    Write("value='" # oSysVar.Value() # "' ");
    Write("value_list='");
    if (oSysVar.ValueType() == 16) {
      Write( oSysVar.ValueList());
    }
	Write("' ise_id='"#oSysVar.ID()#"' ");
    Write("  min='");
    if (oSysVar.ValueType() == 4) {
      Write( oSysVar.ValueMin());
    }

    Write("' max='");
    if (oSysVar.ValueType() == 4) {
      Write( oSysVar.ValueMax());
    }
	Write("' ");
	Write("unit='" # oSysVar.ValueUnit() # "' type='" # oSysVar.ValueType() # "' subtype='" # oSysVar.ValueSubType() # "' logged='" # oSysVar.DPArchive() # "' visible='" # oSysVar.Visible() # "' timestamp='" # oSysVar.Timestamp().ToInteger()# "' value_name_0='" # oSysVar.ValueName0() # "' value_name_1='" # oSysVar.ValueName1() # "' info='" # oSysVar.DPInfo() # "'/>");
  }
  WriteLine("</systemVariables>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// PROGRAMM
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "runprogram.cgi") !== false)) {
  $prog_id = ( !empty($_GET['program_id']) ? intval($_GET['program_id']) : false );

  // Beende wenn keine Program_ID übergeben wird
  if(empty($prog_id))
  {
	die('Program-ID fehlt');
  }

  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_runprogram($ccu, $prog_id, isset($_GET['debug']));
}

function api_runprogram($ccu, int $prog_id, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
!WriteLine("<runprogram>");
!Write(dom.GetObject("$prog_id"));
!WriteLine("</runprogram>");
dom.GetObject("$prog_id").ProgramExecute();
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request, true);

}


// PROGRAMM aktiv inaktiv schalten
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "setprogrammode.cgi") !== false)) {
  $prog_id = ( !empty($_GET['program_id']) ? intval($_GET['program_id']) : false );

  // Beende wenn keine Program_ID übergeben wird
  if(empty($prog_id))
  {
	die('Program-ID fehlt');
  }

  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_setprogrammode($ccu, $prog_id, isset($_GET['debug']));
}

function api_setprogrammode($ccu, int $prog_id, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
!WriteLine("<setprogrammode>");
!Write(dom.GetObject("$prog_id"));
!WriteLine("</setprogrammode>");
object oDatapoint = dom.GetObject("$prog_id");
if (oDatapoint.IsTypeOf(OT_PROGRAM)) {
  if (oDatapoint.Active()) { oDatapoint.Active(false); }
  else { oDatapoint.Active(true); }
}
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request, true);

}


// WERTÄNDERUNG
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "statechange.cgi") !== false)) {

  // Beende, wenn keine Ise_ID übergeben wird
  if (empty($_GET['ise_id'])) die('Ise-ID fehlt');

  // Beende, wenn keine Werte übergeben werden
  if (!isset($_GET['new_value'])) die('Wert fehlt');

  // Trenne ise_id und new_value anhand , auf und setze als assoziatives Array zusammen
  $iseids = $_GET['ise_id'];
  $a_iseids = str_getcsv($iseids, ',', '"', '\\');
  $iseids = ( count($a_iseids) ? $a_iseids : array($iseids) );
  $newvalues = $_GET['new_value'];
  $a_newvalues = str_getcsv($newvalues, ',', '"', '\\');
  $newvalues = ( count($a_newvalues) ? array_map('rawurldecode', $a_newvalues) : array(rawurldecode($newvalues)) );
  if (count($iseids) != count($newvalues)) die('Anzahl Parameter stimmt nicht überein');
  $set = array_combine($iseids, $newvalues);

  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_statechange($ccu, $set, isset($_GET['debug']));

}

function api_statechange($ccu, $set, $debug = false) {

  // $set : assoziatives Array im Format ["ise_id" => "wert"]

  // Baue Skript zusammen
  $ccu_request = '';
  #$ccu_request = $ccu_request."WriteLine(\"<statechange>\");\n";
  foreach ($set as $ise_id => $new_value) {
	if (ctype_digit($ise_id)) {
      #$ccu_request = $ccu_request."WriteLine(dom.GetObject(\"".$ise_id."\"));\n";
	  $ccu_request = $ccu_request."dom.GetObject(\"".$ise_id."\").State(\"".addslashes($new_value)."\");\n";
    }
  }
  #$ccu_request = $ccu_request."WriteLine(\"</statechange>\");\n";

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request, true);

}


//SYSVAR

if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "sysvar.cgi") !== false)) {

  // Beende, wenn keine Ise_ID übergeben wird
  if (empty($_GET['ise_id'])) die('Ise-ID fehlt');

  $ise_id = $_GET['ise_id'];

  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_sysvar($ccu, $ise_id, isset($_GET['debug']));

}

function api_sysvar($ccu, $ise_id, $debug = false) {

  // Baue Skript zusammen                 # Warum braucht man hier eine Schleife? Man könnte doch die SV direkt mit dom.GetObject("ise_id") aufrufen und ggf. den Typ prüfen.
  $ccu_request = <<<EOHM
WriteLine("<systemVariables>");
string id;
! Alle Datenpunkte durchlaufen
foreach(id, dom.GetObject(ID_SYSTEM_VARIABLES).EnumUsedIDs()){

  ! Einzelnen Datenpunkt holen
  var sysVar = dom.GetObject(id);
   if($ise_id == sysVar.ID()) {
  ! Namen und Wert des Elements ausgeben - fehlt -> visible
  Write("<systemVariable name='" # sysVar.Name() # "' variable='" # sysVar.Variable() # "' value='" # sysVar.Value() # "' value_list='" # sysVar.ValueList() # "' ise_id='" # sysVar.ID() # "' min='" # sysVar.ValueMin() # "' max='" # sysVar.ValueMax() # "' unit='" # sysVar.ValueUnit() # "' type='" # sysVar.ValueType() # "' subtype='" # sysVar.ValueSubType() # "' logged='" # sysVar.DPArchive() # "' visible='" # sysVar.Visible() # "' timestamp='" # sysVar.Timestamp().ToInteger()# "' value_name_0='" # sysVar.ValueName0() # "' value_name_1='" # sysVar.ValueName1() # "' info='" # sysVar.DPInfo() # "'/>");
  WriteLine("");
  }
}
WriteLine("</systemVariables>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


function strip_a(string $str) {
  return str_replace('a', '', $str);
}

function strip_t(string $str) {
  return str_replace('t', '', $str);
}

// STATUS
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "state.cgi") !== false)) {

  // Beende, wenn keine Program_ID übergeben wird                    # => führt zu Problemen mit nicht-HM Seiten (zB. iframe) !!!
  # if (empty($_GET['datapoint_id'])) die('Datapoint-ID fehlt');     #    Der fehlerhafte / unnötige Aufruf der state.cgi müsste im dortigen Code korrigiert werden.
  $datapoints = $_GET['datapoint_id'];

  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_state($ccu, $datapoints, isset($_GET['onlyvalue']), isset($_GET['debug']));
}

function api_state($ccu, $datapoints, bool $onlyvalue = false, $debug = false) {

  if (!is_array($datapoints)) {
    if (strpos($datapoints, ',') !== false) $a_datapoints = str_getcsv($datapoints, ',', '"', '\\');
    else $a_datapoints = array($datapoints);
  } else {
    if (array_is_list($datapoints)) $a_datapoints = $datapoints;
    else $a_datapoints = array_values($datapoints);
  }

  $a_datapoints = array_map('strip_a', $a_datapoints);
  $a_datapoints = array_map('strip_t', $a_datapoints);

  //Bei Diagram Collect darf nicht optimiert werden
  if (empty($onlyvalue)) $a_datapoints = array_unique($a_datapoints);

  $ccu_request = "WriteLine(\"<state>\");\r\n";
  foreach ($a_datapoints as $datapoint) {

	if (ctype_digit($datapoint)) {

	  $ccu_request = $ccu_request . "object oDatapoint = dom.GetObject(".$datapoint.");\r\n";
	  // Wenn es sich um ein Datenpunkt handelt gib value aus
	  $ccu_request = $ccu_request . "if (oDatapoint.IsTypeOf(OT_DP)) {\r\n";
	  $ccu_request = $ccu_request . "WriteLine(\"<datapoint ise_id='".$datapoint."' value='\"#dom.GetObject(".$datapoint.").Value().ToString()#\"'/>\");\r\n";
	  $ccu_request = $ccu_request . "}\r\n";

	  // Wenn es sich um ein Programm handelt gibt aus ob aktiv oder inaktiv
	  $ccu_request = $ccu_request . "if (oDatapoint.IsTypeOf(OT_PROGRAM)) {\r\n";
	  $ccu_request = $ccu_request . "if (oDatapoint.Active()) {\r\nWriteLine(\"<datapoint ise_id='".$datapoint."a' value='true'/>\");}\r\n";
	  $ccu_request = $ccu_request . "else {\r\nWriteLine(\"<datapoint ise_id='".$datapoint."a' value='false'/>\"); }\r\n";
	  $ccu_request = $ccu_request . "}\r\n";

	  if (empty($onlyvalue)) {
	    // Wenn es sich um einen Channel handelt gib Timestamp aus
	    $ccu_request = $ccu_request . "if (oDatapoint.IsTypeOf(OT_CHANNEL)) {\r\n";
	    $ccu_request = $ccu_request . "WriteLine(\"<datapoint ise_id='".$datapoint."t' value='\"#dom.GetObject(".$datapoint.").LastDPActionTime().ToString(\"%m.%d.%Y %H:%M:%S\")#\"'/>\");";
	    $ccu_request = $ccu_request . "}\r\n";
	    // Wenn es sich um einen Datenpunkt handelt gib Timestamp aus
	    $ccu_request = $ccu_request . "if (oDatapoint.IsTypeOf(OT_DP)) {\r\n";
	    $ccu_request = $ccu_request . "WriteLine(\"<datapoint ise_id='".$datapoint."t' value='\"#dom.GetObject(".$datapoint.").Timestamp().ToString(\"%m.%d.%Y %H:%M:%S\")#\"'/>\");";
	    $ccu_request = $ccu_request . "}\r\n";
	    // Wenn es sich um ein Programm handelt gib Timestamp aus
	    $ccu_request = $ccu_request . "if (oDatapoint.IsTypeOf(OT_PROGRAM)) {\r\n";
	    $ccu_request = $ccu_request . "WriteLine(\"<datapoint ise_id='".$datapoint."t' value='\"#dom.GetObject(".$datapoint.").ProgramLastExecuteTime().ToString(\"%m.%d.%Y %H:%M:%S\")#\"'/>\");";
	    $ccu_request = $ccu_request . "}\r\n";
	  }

    }

  }
  $ccu_request = $ccu_request . "WriteLine(\"</state>\");\r\n";

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// SYSTEMNOTIFICATION
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "systemNotification.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_systemNotification($ccu, $prog_id, isset($_GET['debug']));
}

function api_systemNotification($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
WriteLine("<systemNotification>");
  string id; 
  ! Alle Datenpunkte durchlaufen
  foreach(id, dom.GetObject(ID_SERVICES).EnumUsedIDs()){

    ! Einzelnen Datenpunkt holen
    var serviceVar = dom.GetObject(id);
    object trigDP = dom.GetObject(serviceVar.AlTriggerDP());
    if( serviceVar.IsTypeOf( OT_ALARMDP ) && ( serviceVar.AlState() == asOncoming ) ){
      ! Namen und Wert des Elements ausgeben - fehlt -> visible
      Write("<notification ise_id='" # serviceVar.AlTriggerDP() # "' name='" # trigDP.Name() # "' type='" # trigDP.HssType() # "' timestamp='" # serviceVar.LastTriggerTime().ToInteger() # "'/>");
      WriteLine("");
    }
  }
  WriteLine("</systemNotification>");
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request);

}


// SYSTEMNOTIFICATIONCLEAR
if (isset($_SERVER['QUERY_STRING']) and (strpos($_SERVER['QUERY_STRING'], "systemNotificationClear.cgi") !== false)) {
  header("Content-Type: text/xml; charset=ISO-8859-1");
  echo api_systemNotificationClear($ccu, isset($_GET['debug']));
}

function api_systemNotificationClear($ccu, $debug = false) {

  // Baue Skript zusammen
  $ccu_request = <<<EOHM
string itemID;
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
}
EOHM;

  // Debug Mode
  if ($debug) return($ccu_request);

  // Schreibe Ausgabe
  return "<?xml version='1.0' encoding='ISO-8859-1' ?>\n".ccu_remote($ccu, $ccu_request, true);

}

?>
