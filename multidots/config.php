<?php
	header('Content-Type: text/plain');
	if(isset($_GET['map'])){
		//$maze = file_get_contents('http://www.cs.illinois.edu/~slazebni/fall13/assignment1/'.$_GET['map'].'Maze.lay');
		$maze = file_get_contents('test.lay');
	}
	else{
		exit("no map specified");
	}
	$letter[26] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
?>