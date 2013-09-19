<?php 
function dfs($maze, $start){
	$stack = array(array($maze[$start['Y']][$start['X']],'x','x'));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = dfs_helper($maze, $stack);
	return $maze;
}

function dfs_helper($maze, $stack){
	$now = array_pop($stack);
	$maze[$now[0]['Y']][$now[0]['X']]["PREV"] = array($now[1],$now[2]);
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return $maze;
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']][$now[0]['X']+1],$now[0]['X'],$now[0]['Y']));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']+1][$now[0]['X']],$now[0]['X'],$now[0]['Y']));
		}
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']][$now[0]['X']-1],$now[0]['X'],$now[0]['Y']));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']-1][$now[0]['X']],$now[0]['X'],$now[0]['Y']));
		}
		return dfs_helper($maze, $stack);
	}
}

?>