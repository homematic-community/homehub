<?php
/*

         {
            "component":"abfallkalender",
            "name":"Abfallkalender",
            "icon":"message_garbage.png",
			"tage":"14"
         },

*/

$debug = 0;
if(isset($_GET['lade']))
{
  if($_GET['lade'] == "content")
  {
	// Cache deaktiviert da Datei lokal
    if(file_Exists("../../cache/abfallkalender.cache"))
    {
      if(date("d.m.Y",filemtime("../../cache/abfallkalender.cache")) == date("d.m.Y",time()))
      {
	     echo file_get_contents('../../cache/abfallkalender.cache') ." °";
		 exit();
      }
    }

    if ($debug==1) { echo "lege neue Datei an"; }
    $datei = fopen("../../cache/abfallkalender.cache","w+");

    $url = "abfallkalender.ics";
	
	if($debug==1) echo  date("Y",filemtime($url));
	
	if(date("Y",filemtime($url)) <> date("Y",time()))
	{
		echo "ICS-Datei veraltet - Datei ist von ".date("Y",filemtime($url))."<br>";
		fwrite($datei,"ICS-Datei - Datei ist von ".date("Y",filemtime($url))."<br>");
	}
	if(!isset($_GET["tage"]))
	{
		$tage = "30";
	}
	else
	{
		$tage = $_GET["tage"];
	}

    $timestamp = time();
    $datumstart = date("Ymd",$timestamp);

	$datumende = date("Ymd",$timestamp+(86400* $tage));


    $the_file = file_get_contents($url);

    $die_Datei = explode("BEGIN",$the_file);
	$Ausgabe = "";
    foreach ($die_Datei as $dataentry) 
	{
	  $datumdeseintrags = "";
	  $text4 = "";
	  $dataentryDetail = explode("\n",$dataentry);
	  if ($debug==5) { echo print_r($dataentryDetail); }
	  
	  foreach($dataentryDetail as $entryDetail)
	  {
        if ($debug==1) {  echo  "##".$entryDetail."<br>"; }
		$dataentryDetailZeile = explode(":",$entryDetail);
		   
		if (strpos($dataentryDetailZeile[0], "SUMMARY") !== false) 
	    {
	      if(isset($dataentryDetailZeile[1]))
	      {
			  if ($debug==1) { echo "<br>ÜÜÜÜÜ".$dataentryDetailZeile[0]." - ".$dataentryDetailZeile[1]; }	  
		      $text4 = $dataentryDetailZeile[1];
		  }
		}
		   
		   
		if ($debug==1) { echo  "<br><br>".$dataentryDetailZeile[0]."<br>"; }

		if (strpos($dataentryDetailZeile[0], "DTSTART") !== false) 
	    {

	      if(isset($dataentryDetailZeile[1]))
	      {
	        if ($debug==1) { echo "<br><br>".$dataentryDetailZeile[0]." - ".$dataentryDetailZeile[1]; }	 

		    $text1 = substr($dataentryDetailZeile[1],6,2);
		    $text2 = substr($dataentryDetailZeile[1],4,2);
		    $text3 = substr($dataentryDetailZeile[1],0,4);
		    $datumdeseintrags = substr($dataentryDetailZeile[1], 0,4).substr($dataentryDetailZeile[1], 4,2).substr($dataentryDetailZeile[1], 6,2);
		
     	  }
		}
 
		if ($datumdeseintrags >= $datumstart AND $datumdeseintrags <=$datumende AND $text4 != "")
		{
	        if(isset($dataentryDetailZeile[1]))
	        {

			  $Ausgabe = $Ausgabe.$text3.$text2.$text1.$text4."#";
			  $text4 = "";
	        }
		}
	  }
    }
	$AusgabeArray = explode("#",$Ausgabe);
	asort($AusgabeArray);
	foreach($AusgabeArray as $AusgabeArrayText)
	{
      if(trim($AusgabeArrayText) <> "")
	  {
		if(isset($FinaleAusgabe)) 
		{ 
	      echo "<br>";
		  fwrite($datei,"<br>");
		}
		
		
		$Eintrag = substr($AusgabeArrayText,8,strlen($AusgabeArrayText)-8);
		
		// Suchen ersetzen

		if (strpos(strtolower($Eintrag), "bio") !== false) 
		{
			$Eintrag = "<span style='color:green;'>".$Eintrag."</span>";
		}
	
		
		else if (strpos(strtolower($Eintrag), "rest") !== false) 
		{
			$Eintrag = "<span style='color:red;'>".$Eintrag."</span>";
		}
		
		else if (strpos(strtolower($Eintrag), "papier") !== false) 
		{
			$Eintrag = "<span style='color:#4287f5;'>".$Eintrag."</span>";
		}
		else if (strpos(strtolower($Eintrag), "glas") !== false) 
		{
			$Eintrag = "<span style='color:white;'>".$Eintrag."</span>";
		}		
		else if (strpos(strtolower($Eintrag), "gelb") !== false) 
		{
			$Eintrag = "<span style='color:yellow;'>".$Eintrag."</span>";
		}			
		else if(strpos(strtolower($Eintrag), "plastik") !== false) 
		{
			$Eintrag = "<span style='color:yellow;'>".$Eintrag."</span>";
		}				
		else
		{
			//
		}
  
		
		
		
		$FinaleAusgabe = substr($AusgabeArrayText,6,2).".".substr($AusgabeArrayText,4,2).".".substr($AusgabeArrayText,0,4)." - ".$Eintrag;


		echo $FinaleAusgabe;
		fwrite($datei,$FinaleAusgabe);
	  }
    }
	
	fclose($datei);
  }
}






function Abfallkalender($component) {
    $modalId = mt_rand();
	        if (!isset($component['color'])) $component['color'] = '#595959';
	return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">'.$component['name'].'</div>'
            . '<div class="pull-right"></div>'
        . '<div class="hh2" id="' . $modalId . '"><br>'
		   .'<span id="Abfallkalender">... lade Daten</span>'
        . '</div>'
    . '</div>
	<script type="text/javascript">
function execute_Abfallkalender() {
  $.ajax({
    url: "custom/components/abfallkalender.php?lade=content&tage='.$component["tage"].'",
    success: function(data) {
	  $("#Abfallkalender").html("" + data);
    }
  });
  //setTimeout(execute_Abfallkalender, 900000); // 15 Minuten
}

setTimeout(execute_Abfallkalender, 150);
</script>';
}
?>


