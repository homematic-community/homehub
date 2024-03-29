<?php
if(isset($_GET['ise_id']))
{
	if(!isset($_GET['debug'])) { header('Content-type: text/xml; charset=utf-8'); }
	if(!isset($_GET['debug'])) { echo '<?xml version="1.0" encoding="ISO-8859-1" ?><systemVariables>'; }
	$array = json_decode(file_get_contents("export.json"), true);
	if(isset($_GET['debug'])) {  print_r($array); }


    $gesuchte_ids = explode(",", $_GET['ise_id']);
	
	foreach($gesuchte_ids as $gesuchte_id )
	{

		$i = 0;
		foreach ($array['systemvariables'] as $element) 
		{
		
		//	echo 'ID: ' . $element["ise_id"] . ' - Name: ' . $element["name"] . ' - gesuchte id '.$gesuchte_id.'<br>';
		//	print_r($element)."<br><br>";

			if(isset($element['ise_id'])) 
			{ 
				if($element['ise_id'] == $gesuchte_id)
				{
					if(isset($element['value'])) 
					{	
					echo "<systemVariable name='".$element['name']."' variable='".$element['variable']."' value='".$element['value']."' value_list='".$element['value_list']."' value_text='".$element['value_text']."'  ise_id='".$element['ise_id']."' min='".$element['min']."'  max='".$element['max']."'  unit='".$element['unit']."'  type='".$element['type']."' subtype='".$element['subtype']."'  timestamp='".$element['timestamp']."' value_name_0='".$element['value_name_0']."' value_name_1='".$element['value_name_1']."'/>";
						echo "\n";
					}
					else
					{
echo "<systemVariable name='".$element['name']."' variable='".$element['variable']."' value='".$element['value']."' value_list='".$element['value_list']."' value_text='".$element['value_text']."'  ise_id='".$element['ise_id']."' min='".$element['min']."'  max='".$element['max']."'  unit='".$element['unit']."'  type='".$element['type']."' subtype='".$element['subtype']."'  timestamp='".$element['timestamp']."' value_name_0='".$element['value_name_0']."' value_name_1='".$element['value_name_1']."'/>";
						echo "\n";
						
					}
					
		
					
				}
			}
			$i = $i +1;
 

		}
	
	
	
	
 
	}


	if(!isset($_GET['debug'])) { echo '</systemVariables>'; }

}

?>
