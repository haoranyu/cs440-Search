<?php 
function dfs($maze, $start, $aimCount){
	$stack = array(array($maze[$start['Y']][$start['X']],'x','x',"cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = dfs_helper($maze, $stack, 0, $aimCount, 0);
	return $maze;
}

function dfs_helper($maze, $stack, $counter, $aimCount, $findCount){
	if(empty($stack)){
		return -1;
	}
	$now = array_pop($stack);

	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		$maze[$now[0]['Y']][$now[0]['X']]["CONT"] = i2l($findCount);
		$findCount++;
	}
	if($aimCount == $findCount){
		return array($maze,$now['cost'], $counter);
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
		return dfs_helper($maze, $stack, $counter+1, $aimCount, $findCount);
	}
}

?>