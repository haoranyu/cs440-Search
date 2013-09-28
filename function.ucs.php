<?php 
function ucsH($x, $cost){
	$newCost1 = pow(1/2,$x);
	$newCost2 = pow(2,$x);
	return  $newCost1 + $cost; //please change the return part to get different cost function
}
function ucs($maze, $start){
	$pqueue = array(array($maze[$start['Y']][$start['X']],'x','x',"dis" => 0, "cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = ucs_helper($maze, $pqueue, 0, 1, 0);
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

function ucs_helper($maze, $pqueue, $counter, $frontier, $depth){
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
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => ucsH($now['dis'], $now[0]['X'] + 1), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => ucsH($now['dis'], $now[0]['X']), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => ucsH($now['dis'], $now[0]['X'] - 1), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => ucsH($now['dis'], $now[0]['X']), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		return ucs_helper($maze, $pqueue, $counter+1, $frontier, $depth);
	}
}

?>