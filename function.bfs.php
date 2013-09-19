<?php 
function bfs($maze, $start){
	$queue = array(array($maze[$start['Y']][$start['X']],'x','x'));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = bfs_helper($maze, $queue);
	return $maze;
}

function bfs_helper($maze, $queue){
	$now = array_shift($queue);
	$maze[$now[0]['Y']][$now[0]['X']]["PREV"] = array($now[1],$now[2]);
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return $maze;
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']][$now[0]['X']+1],$now[0]['X'],$now[0]['Y']));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']+1][$now[0]['X']],$now[0]['X'],$now[0]['Y']));
		}
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']][$now[0]['X']-1],$now[0]['X'],$now[0]['Y']));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']-1][$now[0]['X']],$now[0]['X'],$now[0]['Y']));
		}
		return bfs_helper($maze, $queue);
	}
}

?>