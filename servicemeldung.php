<?php
include('config/config.php');

// interface Pfad bestimmen
$interface = $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].str_replace("servicemeldung.php", "",$_SERVER['PHP_SELF']);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $interface = "https://".$interface;
}
else $interface = "http://".$interface;

if(isset($_GET['ise_id']))
{
	if($_GET['ise_id'] == "all")
	{
		$xml = simplexml_load_file($interface.'\interface.php?systemNotificationClear.cgi');
	}
	else
	{
		$file_handle = fopen('cache/service_'.$_GET['ise_id'].'.txt', 'a+');
		fclose($file_handle);	
	}
}
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "")
{
	$url = $_SERVER['HTTP_REFERER'];
	header("Location: ".$url);
}
else
{
	header("Location: index.php");
}
?>  
