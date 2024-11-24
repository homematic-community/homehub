<?php
require_once(__DIR__.'/interface.php');

if(isset($_GET['ise_id']))
{
	if($_GET['ise_id'] == "all")
	{
		$xml = simplexml_load_string(api_systemNotificationClear($ccu));
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
	header("Location: ./index.php");
}
?>
