<?php 
function dfs($maze, $start){
	$stack = array(array($maze[$start['Y']][$start['X']],'x','x',"cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = dfs_helper($maze, $stack, 0, 1);
	return $maze;
}

function dfs_helper($maze, $stack, $counter, $frontier){
	if($frontier < sizeof($stack)){
		$frontier = sizeof($stack);
	}
	$now = array_pop($stack);
	$maze[$now[0]['Y']][$now[0]['X']]["PREV"] = array($now[1],$now[2]);
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return array($maze,$now['cost'], $counter, $frontier);
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']][$now[0]['X']+1],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']+1][$now[0]['X']],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
		}
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']][$now[0]['X']-1],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($stack, array($maze[$now[0]['Y']-1][$now[0]['X']],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
		}
		return dfs_helper($maze, $stack, $counter+1, $frontier);
	}
}

?>