<?php 
function gbsH($now, $end){
	$v1 = array($now['X'],$now['Y']);
	$v2 = array($end['X'],$end['Y']);
	return manhattanDis($v1,$v2);
}
function gbs($maze, $start, $end, $aimCount){
	$pqueue = array(array($maze[$start['Y']][$start['X']],"dis" => gbsH($start, $end),"cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = gbs_helper($maze, $pqueue, $end, 0, 1, 0);
	return $maze;
}
function array_uppri($array){
	$obj = 0;
	$size = sizeof($array);
	for($i = 0; $i < $size; $i++){
		if($array[$i]["dis"] < $array[$obj]["dis"]){
			$obj = $i;
		}
	}
	$temp = $array[0];
	$array[0] = $array[$obj];
	$array[$obj] = $temp;
	return $array;
}

function gbs_helper($maze, $pqueue, $end, $counter, $aimCount, $findCount){
	if($frontier < sizeof($pqueue)){
		$frontier = sizeof($pqueue);
	}
	if(empty($pqueue)){
		return -1;
	}
	$pqueue = array_uppri($pqueue);
	$now = array_shift($pqueue);
	
	$depth = max($depth,$now['cost']);
	
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return array($maze,$now['cost'],$counter+1);
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										"dis" => gbsH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), $end),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										"dis" => gbsH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), $end),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		return gbs_helper($maze, $pqueue, $end, $counter+1);
	}
}

?>