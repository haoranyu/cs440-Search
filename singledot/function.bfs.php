<?php 
function bfs($maze, $start){
	$queue = array(array($maze[$start['Y']][$start['X']],'x','x',"cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = bfs_helper($maze, $queue, 0, 1, 0);
	return $maze;
}

function bfs_helper($maze, $queue, $counter, $frontier, $depth){
	if($frontier < sizeof($queue)){
		$frontier = sizeof($queue);
	}
	if(empty($queue)){
		return -1;
	}
	$now = array_shift($queue);
	$depth = max($depth,$now['cost']);
	$maze[$now[0]['Y']][$now[0]['X']]["PREV"] = array($now[1],$now[2]);
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return array($maze,$now['cost'],$counter+1,$frontier,$depth);
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']][$now[0]['X']-1],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
			$counter++;
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']+1][$now[0]['X']],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
			$counter++;
		}
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']][$now[0]['X']+1],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
			$counter++;
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($queue, array($maze[$now[0]['Y']-1][$now[0]['X']],$now[0]['X'],$now[0]['Y'],"cost" => ($now['cost'] + 1)));
			$counter++;
		}
		return bfs_helper($maze, $queue, $counter, $frontier, $depth);
	}
}

?>