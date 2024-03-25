<?php
ini_set('log_errors', false);
if(isset($_GET['datapoint_id']))
{
	if(!isset($_GET['debug'])) { header('Content-type: text/xml; charset=utf-8'); }
	if(!isset($_GET['debug'])) { echo '<?xml version="1.0" encoding="ISO-8859-1" ?><state>'; }
	$array = json_decode(file_get_contents("export.json"), true);
	if(isset($_GET['debug'])) {  print_r($array); }


    $gesuchte_ids = explode(",", $_GET['datapoint_id']);
	
	foreach($gesuchte_ids as $gesuchte_id )
	{

		$i = 0;
		foreach ($array['channels'] as $element) 
		{
		
			//echo 'ID: ' . $element["id"] . ' - Name: ' . $element["name"] . '<br>';
			//print_r($element)."<br><br>";

			if(isset($element['ise_id'])) 
			{ 
				if($element['ise_id'] == $gesuchte_id)
				{
					if(isset($element['value'])) 
					{	
				 $element['value'] = str_replace("<","&lt;",  $element['value']);
  $element['value'] = str_replace( ">","&gt;", $element['value']);
						echo '<datapoint ise_id="'.$element['ise_id'].'" value="'.$element['value'].'"/>';
						echo "\n";
					}
					else
					{
						echo '<datapoint ise_id="'.$element['ise_id'].'" value=""/>';
						echo "\n";
					}
				}
			}
			foreach (@$array['channels'][$i]['datapoints'] as $element2) 
			{
				//echo 'ID: ' . $element["id"] . ' - Name: ' . $element["name"] . '<br>';
				//print_r($element)."<br><br>";

				if(isset($element2['ise_id'])) 
				{ 
					if($element2['ise_id'] == $gesuchte_id)
					{
						if(isset($element2['value'])) 
						{
							
  $element2['value'] = str_replace("<","&lt;",  $element2['value']);
  $element2['value'] = str_replace( ">","&gt;", $element2['value']);

							echo '<datapoint ise_id="'.$element2['ise_id'].'" value="'.$element2['value'].'"/>';
							echo "\n";
						}
						else
						{
							echo '<datapoint ise_id="'.$element2['ise_id'].'" value=""/>';
							echo "\n";
						}
					}
				
				}
			}
			$i = $i +1;
 

		}
	
	
	
		foreach ($array['systemvariables'] as $element) 
		{
		
			//echo 'ID: ' . $element["id"] . ' - Name: ' . $element["name"] . '<br>';
			//print_r($element)."<br><br>";

			if(isset($element['ise_id'])) 
			{ 
				if($element['ise_id'] == $gesuchte_id)
				{
					if(isset($element['value'])) 
					{
										 $element['value'] = str_replace("<","&lt;",  $element['value']);
  $element['value'] = str_replace( ">","&gt;", $element['value']);
						echo '<datapoint ise_id="'.$element['ise_id'].'" value="'.$element['value'].'"/>';
						echo "\n";
					}
					else
					{
						echo '<datapoint ise_id="'.$element['ise_id'].'" value=""/>';
						echo "\n";
					}
				}
			}
		}
 
	}


	if(!isset($_GET['debug'])) { echo '</state>'; }

}

?>
