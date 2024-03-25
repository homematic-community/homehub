<?php
    require_once("../config/config.php");
    if ($interval < 1) { $interval = 1; }
    
    if ($slideshow == true) {
    
        $page = $_SERVER['PHP_SELF'];
        $sec = strval($interval * 60);
        header("Refresh: $sec; url=".$page);
        $reload = false;        
        $filename = 'bg.jpg';
        
        if (file_exists($filename)) {
            $filetime = filemtime($filename);
            $currentime = time(); 
            $t_interval = $interval * 60;    
            if (($currentime - $filetime) >= $t_interval) { $reload = true; }
        }
        else { $reload = true; }
        
        if ($reload == true) {
          $linkadd = "";
          if ($blur > 0) { $linkadd = "/?blur=".$blur; }
          $url = 'https://picsum.photos/'.$width.'/'.$height.$linkadd;
          $curl = curl_init($url); // Initialisiert
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($curl, CURLOPT_MAXREDIRS, 10); //follow up to 10 redirections - avoids loops
          curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
          curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36');
          $content = curl_exec($curl); // Führt curl Abfrage aus und speichert es in die Variabel  
          curl_close($curl); 
                 
          $fp = fopen($filename, 'w+');
          fwrite($fp, $content);
          fclose($fp);
        }  
    } 
?>
