<?php 
function dfs($maze, $start, $aimCount){
	$stack = array(array($maze[$start['Y']][$start['X']],"cost" => 0));
	$retval = dfs_helper($maze, $stack, 0, $aimCount, 0);
	while($retval[3] != $aimCount){
		$retval = dfs_helper($retval[0], $retval[1], $retval[2], $aimCount, $retval[3]);
	}
	return array($retval[0], $retval[1][0]["cost"], $retval[2]);
}

function dfs_helper($maze, $stack, $counter, $aimCount, $findCount){
	if(empty($stack)){
		return -1;
	}
	//print_r($stack);
	$now = array_pop($stack);

	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		$maze[$now[0]['Y']][$now[0]['X']]["CONT"] = i2l($findCount);
		$maze[$now[0]['Y']][$now[0]['X']]["STAT"]++;
		$findCount++;
		return array($maze, array(array($maze[$now[0]['Y']][$now[0]['X']],"cost" => $now['cost'])), $counter, $findCount);
	}
	else{
		if(($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != -1)){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = $findCount + 1;
			array_push($stack, array($maze[$now[0]['Y']][$now[0]['X']-1],"cost" => ($now['cost'] + 1)));
		}
		if(($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != -1)){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = $findCount + 1;
			array_push($stack, array($maze[$now[0]['Y']+1][$now[0]['X']],"cost" => ($now['cost'] + 1)));
		}
		if(($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != -1)){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = $findCount + 1;
			array_push($stack, array($maze[$now[0]['Y']][$now[0]['X']+1],"cost" => ($now['cost'] + 1)));
		}
		if(($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != -1)){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = $findCount + 1;
			array_push($stack, array($maze[$now[0]['Y']-1][$now[0]['X']],"cost" => ($now['cost'] + 1)));
		}
		return dfs_helper($maze, $stack, $counter+1, $aimCount, $findCount);
	}
}

?>