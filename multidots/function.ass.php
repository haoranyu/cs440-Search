<?php 
function assH($now, $end, $cost){
	$sum = 0;
	$v1 = array($now['X'],$now['Y']);
	foreach($end as $e){
		$v2 = array($e['X'],$e['Y']);
		$sum += manhattanDis($v1,$v2);
	}
	return $sum + $cost;
}

function evcFinish($end, $p){
	$retval = array();
	foreach($end as $e){
		if($e['X'] != $p['X'] || $e['Y'] != $p['Y'])
			array_push($retval, array("X" => $e['X'], "Y" => $e['Y']));
	}
	return $retval;
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

function ass($maze, $start, $end, $aimCount){
	$pqueue = array(array($maze[$start['Y']][$start['X']],'x','x',"dis" => 0, "cost" => 0));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = ass_helper($maze, $pqueue, $end, 0, $aimCount, 0);
	return $maze;
}

function ass_helper($maze, $pqueue, $end, $counter, $aimCount, $findCount){

	if(empty($pqueue)){
		return -1;
	}
	$pqueue = array_uppri($pqueue);
	$now = array_shift($pqueue);

	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		$end = evcFinish($end, array("X" => $now[0]['X'], "Y" => $now[0]['Y']));
		$maze[$now[0]['Y']][$now[0]['X']]["CONT"] = i2l($findCount);
		$findCount++;
	}
	if($aimCount == $findCount){
		return array($maze,$now['cost'], $counter);
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => assH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), 
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
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => assH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), 
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
		return ass_helper($maze, $pqueue, $end, $counter+1, $aimCount, $findCount);
	}
}

?>