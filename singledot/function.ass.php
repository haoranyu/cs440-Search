<?php 
function assH($now, $end, $cost){
	$v1 = array($now['X'],$now['Y']);
	$v2 = array($end['X'],$end['Y']);
	return manhattanDis($v1,$v2) + $cost;
}
function ass($maze, $start, $end){
	$pqueue = array(array($maze[$start['Y']][$start['X']],'x','x',"dis" => assH($start, $end, 0), "cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = ass_helper($maze, $pqueue, $end, 0, 1, 0);
	return $maze;
}
function array_uppri($array){
	$obj = 0;
	$size = sizeof($array);
	for($i = 0; $i < $size; $i++){
		if(($array[$i]["dis"]) < ($array[$obj]["dis"])){
			$obj = $i;
		}
	}
	$temp = $array[0];
	$array[0] = $array[$obj];
	$array[$obj] = $temp;
	return $array;
}

function ass_helper($maze, $pqueue, $end, $counter, $frontier, $depth){
	if($frontier < sizeof($pqueue)){
		$frontier = sizeof($pqueue);
	}
	if(empty($pqueue)){
		return -1;
	}
	$pqueue = array_uppri($pqueue);
	$now = array_shift($pqueue);
	//echo $now[0]['X'].",".$now[0]['Y'].": ".($now['dis']).";".$now['cost']."\n";
	$depth = max($depth,$now['cost']);
	$maze[$now[0]['Y']][$now[0]['X']]["PREV"] = array($now[1],$now[2]);
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return array($maze,$now['cost'],$counter, $frontier, $depth);
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => assH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => assH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => assH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => assH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		return ass_helper($maze, $pqueue, $end, $counter+1, $frontier, $depth);
	}
}

?>