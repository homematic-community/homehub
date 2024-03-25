<?php
    require_once("config/config.php");
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">	
  <title>LittleMovingClock</title>
  <link rel="stylesheet" href="./css/style.css">
  <?
    if ($slideshow == true) { echo '<link rel="stylesheet" href="./css/photos.css">'; }
  ?>
  

</head>
<body>
<?
    if ($slideshow == true) {
        echo '<div id="backgroundslide"></div><div id="hideslide"></div><div id="clock0"></div><div id="clock1"></div><div id="imgload"><iframe src="image/getimage.php"></iframe></div>';
        echo '<script type="text/javascript">';
        echo 'var updateimg = true;';
        echo 'var intervall = '.$interval.';';
        echo '</script>';    
        
    }
    else {
        echo '<div id="clock0"></div><div id="clock1"></div><script type="text/javascript">';
        echo 'var updateimg = false;';
        echo 'var intervall = 60000;';
        echo '</script>';         
    }
?>
<script src="./script/script.js"></script>
</body>
</html>
