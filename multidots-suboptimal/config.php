<?php
	header('Content-Type: text/plain');
	
	$map_array = array(
				'medium',
				'big');
				
	if(isset($_GET['map']) && (in_array($_GET['map'], $map_array))){
		$maze = file_get_contents('map/'.$_GET['map'].'Search.lay');
	}
	else{
		exit("no map specified(medium, big)");
	}
?>