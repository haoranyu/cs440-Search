<?php
	header('Content-Type: text/plain');
	
	$map_array = array(
				'big',
				'open',
				'small',
				'medium');
				
	if(isset($_GET['map']) && (in_array($_GET['map'], $map_array))){
		$maze = file_get_contents('map/'.$_GET['map'].'Maze.lay');
	}
	else{
		exit("no map specified(big, small, open, medium)");
	}
?>