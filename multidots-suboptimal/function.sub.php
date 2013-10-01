<?php 
function sub($maze, $start, $end, $aimCount){
	$nowAim = getNowaim($start, $end, 0);
	$pqueue = array(array($maze[$start['Y']][$start['X']],"dis" => subH($start, $nowAim, 0),"cost" => 0));
	$retval = sub_helper($maze, $pqueue, $end, 0, $aimCount, 0, $nowAim);
	while($retval[4] != $aimCount){
		$retval = sub_helper($retval[0], $retval[1], $retval[2], $retval[3], $aimCount, $retval[4], $retval[5]);
	}
	return array($retval[0], $retval[1][0]["cost"], $retval[3]);
}
function sub_helper($maze, $pqueue, $end, $counter, $aimCount, $findCount, $nowAim){
	if(empty($pqueue)){
		return -1;
	}
	$pqueue = array_uppri($pqueue);
	$now = array_shift($pqueue);

	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		$maze[$now[0]['Y']][$now[0]['X']]["CONT"] = "x";
		$maze[$now[0]['Y']][$now[0]['X']]["STAT"]++;
		$end = evcFinish($end, array("X" => $now[0]['X'], "Y" => $now[0]['Y']));
		$nowAim = getNowaim(array("X" => $now[0]['X'], "Y" => $now[0]['Y']), $end, $now['cost']);
		$findCount++;
		return array($maze, array(array($maze[$now[0]['Y']][$now[0]['X']],
										"dis" => subH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']), $nowAim, $now['cost']), 
										"cost" => $now['cost'])), $end, $counter+1, $findCount, $nowAim);
	}
	else{
		if(($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != -1)){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										"dis" => subH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), getNowaim(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), ($now['cost'] +1)),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		else if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] > ($findCount + 1) && ($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != -1) && array_cheap($pqueue, $now['cost'] + 1, array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']))){
			$pqueue = array_remove($pqueue, array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']));
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => subH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if(($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != -1)){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										"dis" => subH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), getNowaim(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), $end, ($now['cost'] +1)), ($now['cost'] +1)),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		else if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] > ($findCount + 1) && ($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != -1) && array_cheap($pqueue, $now['cost'] + 1, array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1))){
			$pqueue = array_remove($pqueue, array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1));
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => subH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		if(($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != -1)){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										"dis" => subH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), getNowaim(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), ($now['cost'] +1)),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		else if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] > ($findCount + 1) && ($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != -1) && array_cheap($pqueue, $now['cost'] + 1, array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']))){
			$pqueue = array_remove($pqueue, array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']));
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => subH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		
		if(($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != -1)){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										"dis" => subH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), getNowaim(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), $end, ($now['cost'] +1)), ($now['cost'] +1)),
										"cost" => ($now['cost'] + 1)
									  ));
		}
		else if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] > ($findCount + 1) && ($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != -1) && array_cheap($pqueue, $now['cost'] + 1, array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1))){
			$pqueue = array_remove($pqueue, array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1));
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => subH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), $end, ($now['cost'] +1)), 
										"cost" => ($now['cost'] + 1)
									  ));
		}
		return sub_helper($maze, $pqueue, $end, $counter+1, $aimCount, $findCount, $nowAim);
	}
}

function subH($now, $end, $cost){
	$v1 = array($now['X'],$now['Y']);
	$v2 = array($end['X'],$end['Y']);
	return 5 * minkowskiDis($v1,$v2,3) + $cost;
}
function getNowaim($now, $end, $cost){
	$dis = 999999999999;
	$nowAim = -1;
	foreach($end as $e){
		if(subH($now, $e, $cost) < $dis){
			$dis = subH($now, $e, $cost);
			$nowAim = array("X"=> $e['X'], "Y"=> $e['Y']);
		}
	}
	return $nowAim;
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
		if($array[$i]["dis"] < 
		$array[$obj]["dis"]){
			$obj = $i;
		}
	}
	$temp = $array[0];
	$array[0] = $array[$obj];
	$array[$obj] = $temp;
	return $array;
}
function array_cheap($array, $cost, $p){
	foreach($array as $ap){
		if($ap[0]['X'] == $p['X'] && $ap[0]['Y'] == $p['Y']){
			if($ap['cost'] > $cost){
				return 1;
			}
		}
	}
	return 0;
}
?>