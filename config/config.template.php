<?php

// IP-address oder DNS name of your CCU
$homematicIp = '192.168.2.30';

// Nötig wenn Homematic Skript authentifizierung aktiv - ansonsten leer lassen
$ccu_user = "";  // in die Anführungsstriche den Benutzernamen
$ccu_pass = "";  // in die Anführungsstriche das dazugehörige Kennwort

// Time in seconds HomeHub periodically updates the status
$timerPeriod = 5;

// Title shown in Header
$title = 'Titel der Seite';

// Logo (30px x 30px) shown in Header
$logo = 'images/hmip_logo.png';

// Latidute und Longitude für Sonnenauf- und untergang
// Ermittelbar unter https://www.koordinaten-umrechner.de/decimal/52.517037,13.388860?karte=OpenStreetMap&zoom=8
$latitude = 50.86;
$longitude = 6.9;  

// Navigation fixieren
$navi_fix = false;

// Viewport (device-width oder feste Größe)
$viewport = 'device-width';
//$viewport = '1200';

// Schnelligkeit des Einblendeffekts bei erweiterten Komponentenmöglichkeiten
// 1 = direkt einblenden / 350 = langsam einscrollen
$transition_duration = 10;

//Reiter bei dem die Servicemeldungen eingeblendet werden
$Servicemeldungen = "Home";

// Responsive aktivieren (unterschiedliche Ansichten für tablet und Smartphone) - true/false - viewport muss dann zwingend 'device-width' sein
$responsive = true;

?>
