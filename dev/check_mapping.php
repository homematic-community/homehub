<?php
$components = preg_grep('~\.(php)$~', scandir("../components"));

$mapping = file_get_contents("../config/mapping.json");
$i = 0;
$Gesamt = "";
foreach ($components as $component) 
{
	$component = str_replace(".php","",$component);
$i++;
$pos = strpos($mapping, $component);
if ($pos === false) {
echo "<span style='color:red;'>".$component."</span> existiert nicht<br>";
} else {
    
	    echo "<span style='color:green;'>".$component."</span> existiert<br>";
}
$Gesamt = $Gesamt . $component." || " ;

}

echo "<br><br>Aktuell <b>".$i."</b> integrierte Komponenten";
echo "<br><br>".$Gesamt;
?>