<?php
//ini_set('display_errors', 'on');
// php8

$page = $_SERVER['PHP_SELF'];
$sec = "500";
//header("Refresh: $sec; url=".$page."?".$_SERVER['QUERY_STRING']);

// Prüfe auf custom.json
if(!file_exists("config/custom.json"))
{
	echo "config/custom.json existiert nicht. Kopiere config/custom.template.json nach config/custom.json";
	echo "Aktualsiere die Seite";
	if (!copy("config/custom.template.json", "config/custom.json")) {
		echo "Konnte Datei nicht kopieren. Gibt Schreibreche auf den Ordner 'config'";
		exit();
	}

}
// Prüfe auf categories.json
if(!file_exists("config/categories.json"))
{
	echo "config/categories.json existiert nicht. Kopiere config/categories.template.json nach config/categories.json";
	echo "Aktualsiere die Seite";
	if (!copy("config/categories.template.json", "config/categories.json")) {
		echo "Konnte Datei nicht kopieren. Gibt Schreibreche auf den Ordner 'config'";
		exit();
	}


}

// definiere Interface
$interface = $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].str_replace("index.php", "",$_SERVER['PHP_SELF']);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	$interface = "https://".$interface;
}
else $interface = "http://".$interface; 

// Prüfe auf config.php
if(!file_exists("config/config.php"))
{
	header('Location: setup.php');
	exit;
}

// Lade Konfiuration der Homematic
require("config/config.php");

// Setze Variable selectedCat auf die aktuelle Seite
if(!isset($_GET['seite']))
{
	$selectedCat = "Home";
}
else
{
	$selectedCat = urldecode($_GET['seite']);
}

// Prüfe ob Import bzw. führe Import bei fehlender export.json durch
if($selectedCat == "Import" OR !file_exists("config/export.json"))
{
	header('Location: import.php');
	exit;
}


// MENU # json_decode Config files
$categories = array();
$menu = array();    
if(file_exists('config/categories.json')) 
{
    $str = file_get_contents('config/categories.json');
	
	// Prüfe UTF-8
	if (!mb_check_encoding($str, 'UTF-8')) 
	{
		echo "Datei 'config/categories.json' entspricht nicht dem UTF-8 Format. Bitte als UTF-8 speichern.";
		exit();
	}	
	
    $json = json_decode($str, true);
    $menu = $json['categories'];
    if(isset($menu[0]['name'])) { $Startseite = $menu[0]['name']; }
    // Erstelle Array mit name = aktuelle seite und displayname = aktuele Seite
    $categories[] = array(
        'name' => $selectedCat,
        'display_name' => $selectedCat
    );
	
	
	// Suche an welcher Stelle in der Name Spalte der aktuellen Seite  aufgeführt ist
    $key = array_search($selectedCat, array_column($json['categories'], 'name'));
		
	// Wenn gefunden und Subcategorien gefunden werden
    if(is_int($key) && isset($json['categories'][$key]['subcategories'])) 
	{		
	    // Für jede Subcategorie dem categories Array ein Subarray mit Subcategorie (name/displayname) hinzufügen
        foreach($json['categories'][$key]['subcategories'] as $subCategory) 
		{
        	// Wenn nur eine Subcategorie
            if(!is_array($subCategory)) 
			{
                $categories[] = array(
                    'name' => $subCategory,
                    'display_name' => $subCategory
                );
			// bei mehreren
            } else {
				// wenn Displayname nicht gegeben ist dann nimm name der Subcategorie
                if(!isset($subCategory['display_name'])) 
				{
                    $categories[] = array(
                        'name' => $subCategory['name'],
                        'display_name' => $subCategory['name']
                    );
				// ansonsten den mitgegebenen displaynamen
                } else {
                    $categories[] = array(
                        'name' => $subCategory['name'],
                        'display_name' => $subCategory['display_name']
                    );
                }
            }
        }
    }
}
else 
{ 
	"Konfigurationsdatei 'config/categories.json' nicht gefunden!";
	exit();
}

	
// CUSTOM # Anpassungen des Benutzers
$custom = array();
if(file_exists('config/custom.json')) 
{
    $str = file_get_contents('config/custom.json');
	
	// Prüfe UTF-8
	if (!mb_check_encoding($str, 'UTF-8')) 
	{
		echo "Datei 'config/custom.json' entspricht nicht dem UTF-8 Format. Bitte als UTF-8 speichern.";
		exit();
	}	
	
	
    $json = json_decode($str, true);
    if(isset($json['custom'])) 
	{
        $custom = $json['custom'];
    }
}
else 
{ 
	"Konfigurationsdatei 'config/custom.json' nicht gefunden!";
	exit();
}


// MAPPING # Voreingestellte Icon für Komponenten
$mapping = array();
if(file_exists('config/mapping.json')) 
{
    $str = file_get_contents('config/mapping.json');
    $json = json_decode($str, true);
    if(isset($json['mapping'])) 
	{
        $mapping = $json['mapping'];
    }
}
else 
{ 
	"Konfigurationsdatei 'config/mapping.json' nicht gefunden!";
	exit();
}
    


// EXPORT # Lade Exportdatei der Homematic
$export = array();
if(file_exists('config/export.json')) 
{
    $str = file_get_contents('config/export.json');
    $export = json_decode($str, true);
}
else 
{ 
	"Konfigurationsdatei 'config/export.json' nicht gefunden!";
	exit();
}
    


// Komponenten einlesen
$components = array();
if(count((array)$export) > 0) 
{
    foreach($categories as $category) 
	{
        $mappingComponents = array();
        $customComponents = array();
		
        //echo "###".$category['name']."<br>\n";
		//echo "****".$mapping[$category['name']]." - wenn leer dann gibts keinen eintrag in mapping<br>\n";
			
		// Wenn der Komponentennamen in der Mapping aufgelistet wird
        if(isset($mapping[$category['name']])) 
		{
			//echo "PPP";
            foreach($mapping[$category['name']] as $mappingEntry) 
			{
                foreach(array('channels', 'systemvariables', 'programs') AS $part) 
				{
                    $dummies = array_filter($export[$part], function($dummy) use ($mappingEntry) {
                            if($dummy['component'] == $mappingEntry['name']) {
                                if(isset($dummy['visible']) && $dummy['visible'] === 'true') {
                                    return true;
                                }
                            }
                        });
						
                    foreach($dummies as $dummy) 
					{
                        if(isset($dummy['datapoints'])) 
						{
                            foreach($dummy['datapoints'] as $datapoint) 
							{
                                $dummy[$datapoint['type']] = $datapoint['ise_id'];
                            }
                            unset($dummy['datapoints']);
                        }
                            
                        $mappingComponents[] = array_merge($mappingEntry, $dummy);
                    }
                }
            }

            // Alphabetisch sortieren
            if(isset($mappingComponents) && count((array)$mappingComponents) > 0) 
			{
                usort($mappingComponents, function($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
            }
        }

        // Wenn Kategoriename in custom.json gelistet ist
        if(isset($custom[$category['name']])) 
		{
		//echo "CUSTOM".print_r ($custom[$category['name']]);
		
		
            foreach($custom[$category['name']] as $customEntry) 
			{
                // Custom Komponente?
                if(isset($customEntry['component'])) 
				{
                    $customComponents[] = $customEntry;
                }
				
                    
                foreach(array('channels', 'systemvariables', 'programs') AS $part) 
				{
                    $key = @array_search($customEntry['name'], array_column($export[$part], 'name'));
                    if(is_int($key)) 
					{
                        if($export[$part][$key]['visible'] == true) 
						{
                            $dummy = $export[$part][$key];
                            if(isset($dummy['datapoints'])) 
							{
                                foreach($dummy['datapoints'] as $datapoint) 
								{
                                    $dummy[$datapoint['type']] = $datapoint['ise_id'];
                                }
                                unset($dummy['datapoints']);
                            }

                            $key2 = array_search($dummy['name'], array_column($mappingComponents, 'name'));
                            if(is_int($key2)) 
							{
                                unset($mappingComponents[$key2]);
                                $mappingComponents = array_values($mappingComponents);
                            }

                            if(isset($customEntry['display_name']) && $customEntry['display_name'] <> '') 
							{
                                $dummy['name'] = $customEntry['display_name'];
                            }
                            $customComponents[] = array_merge($customEntry, $dummy);
                        }
                    }
                }
            }
        }
         //  print_r($customComponents);
        $components[$category['display_name']] = array_merge($customComponents, $mappingComponents);
		//print_r($components[$category['display_name']]);
		//echo $category['display_name'];
    }
}
//echo "------";
   // print_r($components['$selectedCat']);

	

?>
<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=<?php echo strip_tags($viewport); ?>">
		<meta name="format-detection" content="telephone=no"/>
        <title><?php echo strip_tags($title); ?></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<?php
		if($navi_fix == true) { 
			echo '<style>nav {position: fixed;} </style>';
        }
		?>
      	<link href="css/style.css" rel="stylesheet">
		<?php
		if($responsive == true) { 
			echo '<link href="css/responsive.css" rel="stylesheet">';
        }
		if(file_exists("custom/css/custom.css"))
		{
			echo "<link href='custom/css/custom.css' rel='stylesheet'>  ";
		}
		?>		
             
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="apple-touch-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon-180x180.png" />

		

    </head>
    <body name="top">

		<header>
	
            <span id="date" ondblclick="startImport();">&nbsp;</span>
            <span id="title"><?php echo "<a href='index.php?seite=".$Startseite."'>". $title."</a>"; ?></span>  
            <span id="time">&nbsp;</span>
        </header>
		<div class="container" id="wrapper">
			
 
          		<label for="open-menu" class="open-menu-label"></label>
  <input type="checkbox" id="open-menu" onclick="document.location.href='#top'">


		<?php
		// Setze Seite auf Home wenn ohne Categorie Seite gestartet wird
		if(!isset($_GET['seite']))
		{
		  $Page = "Home";
		}
		else
		{
			$Page = $_GET['seite'];
		}
		
        echo "<nav id='sidebar' class='offcanvas'>\n";
            
                    foreach($menu as $entry) {
                        if (!isset($entry['visible'])) { $entry['visible'] = "true"; }
                        if ($entry['visible'] == "true") {
                          $selected = '';
                          if($entry['name'] == $selectedCat) {
                              $selected = 'selected';
                          }
                          if (!isset($entry['icon'])) $entry['icon'] = "audio_stop.png";
                          if (!isset($entry['color'])) $entry['color'] = '#595959';
                          echo "<a class='".$selected."' href='?seite=".urlencode($entry['name'])."' style='border-left-color: ".$entry["color"]."; border-left-style: solid;'><img src='icon/".$entry['icon']."' class='icon'></a>\n";
                                                  
                          if(isset($entry['append_divider']) && $entry['append_divider'] == "true") {
                          echo "<div class='divider'></div>\n";
                          }
                        }
                    }

         echo "</nav>\n";
        echo "<nav id='sidebarkomplett' class='offcanvas'>\n";
               
                    foreach($menu as $entry) {
                        if (!isset($entry['visible'])) { $entry['visible'] = "true"; }
                        if ($entry['visible'] == "true") {
                          $selected = '';
                          if($entry['name'] == $selectedCat) {
                              $selected = 'selected';
                          }
                          if (!isset($entry['icon'])) $entry['icon'] = "audio_stop.png";
                          if (!isset($entry['color'])) $entry['color'] = '#595959';
                          echo "<a class='".$selected."' href='?seite=".urlencode($entry['name'])."' style='border-left-color: ".$entry["color"]."; border-left-style: solid;'><img src='icon/".$entry['icon']."' class='icon'>".$entry['name']."</a>\n";
                                                  
                          if(isset($entry['append_divider']) && $entry['append_divider'] == "true") {
                          echo "<div class='divider'></div>\n";
                          }
                        }
                    }

         echo "</nav>\n";



		
		// Hauptseite
		echo "<div id='content' class='panel-group'>\n";
        echo "<div id='flash-error'></div>\n";        


		// Servicemeldungen auf der Hauptseite - Start
		if(!isset($Servicemeldungen))
		{
			$Servicemeldungen ="Home";			
		}
		else
		{
					if($Page == $Servicemeldungen)
					{
				
						if(file_exists("dev/export.json")) { 
							$xml = simplexml_load_file('dev/systemNotification.php'); 
							$str = file_get_contents('dev/export.json');
						} else {
						
							//$xml = simplexml_load_file('http://'.$homematicIp.'/config/xmlapi/systemNotification.cgi?sid='.$apitoken);
							$xml = simplexml_load_file($interface.'interface.php?systemNotification.cgi');
							$str = file_get_contents('config/export.json');
						}
						// Für Devices
						
						$jsondevices = json_decode($str,true);
						foreach ($xml->notification as $notificationentry)
						{
							//echo $notificationentry['ise_id'];
						    if(!file_exists('cache/service_'.$notificationentry['ise_id'].'.txt'))
							{
								$timestamp = $notificationentry['timestamp'] -1;
								for($i=0; $i < count((array)$jsondevices['channels']); $i++)
								{
									//echo $jsondevices['channels'][$i]['name']."<br>";
									if(isset($jsondevices['channels'][$i]['datapoints']))
									{									
										for($u=0; $u < count((array)$jsondevices['channels'][$i]['datapoints']); $u++)
										{
											//echo $jsondevices['channels'][$i]['datapoints'][$u]['ise_id']." - ".$jsondevices['channels'][$i]['datapoints'][$u]['name']."<br>";
											if($jsondevices['channels'][$i]['datapoints'][$u]['ise_id'] == $notificationentry['ise_id'])
											{
												//echo $notificationentry['type']."##<br>";
												if($notificationentry['type'] == "STICKY_UNREACH" OR $notificationentry['type'] == "UNREACH")
												{
													if(isset($Service)) { $Service = $Service .  $jsondevices['channels'][$i]['name']." konnte am ". date("d.m.Y H:i",$timestamp)." nicht erreicht werden. (<a href='servicemeldung.php?ise_id=".$notificationentry['ise_id']."'>ausblenden</a>/<a href='servicemeldung.php?ise_id=all'>best&auml;tigen</a>)<br>"; }
													else { $Service =  $jsondevices['channels'][$i]['name']." konnte am ". date("d.m.Y H:i",$timestamp)." nicht erreicht werden. (<a href='servicemeldung.php?ise_id=".$notificationentry['ise_id']."'>ausblenden</a>/<a href='servicemeldung.php?ise_id=all'>best&auml;tigen</a>)<br>"; }
												}
												else 
												{
													if(isset($Service)) { $Service = $Service .  $jsondevices['channels'][$i]['name']." hatte folgendes Problem ".$notificationentry['type'] ." am ". date("d.m.Y H:i",$timestamp). " (<a href='servicemeldung.php?ise_id=".$notificationentry['ise_id']."'>ausblenden</a>/<a href='servicemeldung.php?ise_id=all'>best&auml;tigen</a>)<br>"; }
													else { $Service = $jsondevices['channels'][$i]['name']." hatte folgendes Problem ".$notificationentry['type'] ." am ". date("d.m.Y H:i",$timestamp)." (<a href='servicemeldung.php?ise_id=".$notificationentry['ise_id']."'>ausblenden</a>/<a href='servicemeldung.php?ise_id=all'>best&auml;tigen</a>)<br>"; }
												}
											}
											
										}
									}
								}
							}
						}
						$ServiceCount = 1;


						// Gebe Servicemeldung aus wenn welche existieren
						if(isset($Service)) 
						{ 
							echo "<div id='flash-error-service'>";   
							echo $Service;
							echo "</a></div>\n";
						}
					
						// Servicemeldungen auf der Hauptseite - Ende

		  
		  
					}
        }
		// Alle Geräte auflisten

		// Alle Programme auflisten
		if($Page=="Programme") 
		{
			foreach($components[$Page] as $entry)
			{ 
		
				if(isset($entry['ise_id']))
				{
					$functionname = str_replace("-", "_", $entry['component']);
					if (!function_exists($functionname))
					{
					  	if(file_exists("custom/components/".$functionname.".php"))   { require("custom/components/".$functionname.".php"); }
					  	elseif (file_exists("components/".$functionname.".php")) { require("components/".$functionname.".php"); }
						else {  }
					}
					echo $functionname($entry);	
					if(isset($entry['append_divider']))
					{
					  if($entry['append_divider'] == true) { echo "<div class='divider'></div>\n"; }					
					}
				}
			}
		}
		// Alle Systemvariablen auflisten
		elseif($Page=="Systemvariablen") 
		{
			foreach($components[$Page] as $entry)
			{ 
				if(isset($entry['ise_id']))
				{
					$functionname = str_replace("-", "_", $entry['component']);
					if (!function_exists($functionname))
					{
						if(file_exists("custom/components/".$functionname.".php"))   { require("custom/components/".$functionname.".php"); }
					  	elseif (file_exists("components/".$functionname.".php")) { require("components/".$functionname.".php"); }
						else {  }
					}
					echo $functionname($entry);
					if(isset($entry['append_divider']))
					{
					  if($entry['append_divider'] == true) { echo "<div class='divider'></div>\n"; }					
					}
				}
			}
		}		
		else
		{
			
			$lastCategory = $selectedCat;
			// echo $lastCategory;
				//print_r($categoryComponents);
				 //echo "<br><br><br>";
			foreach($components as $category => $categoryComponents) {

				foreach($categoryComponents as $component) 
				{
					$func = str_replace('-', '_', $component['component']);
					$func = str_replace(' ', '', $func);
						
					if(function_exists($func)) 
					{
						$retVal = call_user_func($func, $component);
					}
					else
					{

						if(file_exists("custom/components/".$component['component'].".php")) 
						{
							require("custom/components/".$component['component'].".php");
							$retVal = call_user_func($func, $component);
						}
						elseif(file_exists("components/".$component['component'].".php")) 
						{ 
							require("components/".$component['component'].".php");
							$retVal = call_user_func($func, $component);
						}
						else { echo "Fehler: Komponente ".$component['component']." wurde noch nicht integriert"; }
					}
					if(function_exists($func)) 
					{
					
					    if($retVal <> '') 
						{
                            if($lastCategory == $selectedCat && $lastCategory <> $category) 
							{
                                echo '<fieldset><legend>'.$category.'</legend>';
                                $lastComponent = '';
                            } 
							elseif($lastCategory <> $category) 
							{
                                echo '</fieldset><fieldset><legend>'.$category.'</legend>';
                                $lastComponent = '';
                            }
                            echo $retVal;

							
                            if(isset($component['append_divider']) && $component['append_divider'] == "true") 
							{
                                echo '<div class="divider"></div>';
                            }

                            $lastCategory = $category;
                         }
					}
				}
			}
			if($lastCategory <> $selectedCat) 
			{
				echo '</fieldset>';
            }
		      
	

		}
		echo '</div>';
		echo '</div>';
		?>

		</div>

	    <script type="text/javascript">
            //<![CDATA[
            var homematicIp = '<?php echo $homematicIp; ?>';
			<?php if(file_exists("dev/export.json")) { echo "var dev = 1;\n"; } else { echo "var dev = 0;\n"; }?>
            var logo = '<?php echo $logo; ?>';
            var latitude = '<?php echo $latitude; ?>';
            var longitude = '<?php echo $longitude; ?>';       
            var timerMiliseconds = <?php echo $timerPeriod * 1000; ?>;
            //]]>
        </script>
        
		<script src="js/jquery-3.7.1.min.js"></script>
		<script src="js/chart.js"></script>
		<script src="js/bootstrap.min.js.php?transition_duration=<?php echo $transition_duration; ?>"></script>
		<script src='js/sun.js'></script> 		
        <script src='js/script.js.php?<?php echo "id=".rand(1,100); ?>'></script>
		
		<?php if(file_exists("custom/js/custom.js")) { echo "<script src='custom/js/custom.js?id=".rand(1,100)."'></script>"; } ?>
        <?php if(isset($ioBrokerComponent)) { echo "<script src='js/ioBroker.js?id=".rand(1,100)."'></script>"; } ?>





	 
	</body>
</html>
