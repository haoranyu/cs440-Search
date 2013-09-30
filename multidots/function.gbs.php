<?php 
set_time_limit(60);
function gbs($maze, $start, $end, $aimCount){
	$nowAim = getNowaim($start, $end);
	$pqueue = array(array($maze[$start['Y']][$start['X']],"dis" => gbsH($start, $nowAim),"cost" => 0));
	$retval = gbs_helper($maze, $pqueue, $end, 0, $aimCount, 0, $nowAim);
	while($retval[4] != $aimCount){
		$retval = gbs_helper($retval[0], $retval[1], $retval[2], $retval[3], $aimCount, $retval[4], $retval[5]);
	}
	return array($retval[0], $retval[1][0]["cost"], $retval[3]);
}
function gbs_helper($maze, $pqueue, $end, $counter, $aimCount, $findCount, $nowAim){
	if(empty($pqueue)){
		return -1;
	}
	//print_r($pqueue);
	$pqueue = array_uppri($pqueue);
	$now = array_shift($pqueue);
	//echo $now[0]['X'].",".$now[0]['Y']."=>".$nowAim["X"].",".$nowAim["Y"]."(".$findCount.")"."\n";

	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		$maze[$now[0]['Y']][$now[0]['X']]["CONT"] = i2l($findCount);
		$maze[$now[0]['Y']][$now[0]['X']]["STAT"]++;
		$end = evcFinish($end, array("X" => $now[0]['X'], "Y" => $now[0]['Y']));
		$findCount++;
		return array($maze, array(array($maze[$now[0]['Y']][$now[0]['X']],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']), getNowaim(array("X" => $now[0]['X'], "Y" => $now[0]['Y']), $end)), 
										"cost" => $now['cost'])), $end, $counter, $findCount, $nowAim);
		$counter++;
	}
	else{
		if(($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] != -1)){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										"dis" => gbsH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), getNowaim(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end)),
										"cost" => ($now['cost'] + 1)
									  ));
			$counter++;
		}
		if(($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] != -1)){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), getNowaim(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), $end)),
										"cost" => ($now['cost'] + 1)
									  ));
			$counter++;
		}
		if(($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] != -1)){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										"dis" => gbsH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), getNowaim(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end)),
										"cost" => ($now['cost'] + 1)
									  ));
			$counter++;
		}
		if(($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != ($findCount + 1)) && ($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] != -1)){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = $findCount + 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), getNowaim(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), $end)),
										"cost" => ($now['cost'] + 1)
									  ));
			$counter++;
		}
		return gbs_helper($maze, $pqueue, $end, $counter, $aimCount, $findCount, $nowAim);
	}
}

function gbsH($now, $end){
	$v1 = array($now['X'],$now['Y']);
	$v2 = array($end['X'],$end['Y']);
	return manhattanDis($v1,$v2);
}
function getNowaim($now, $end){
	$dis = 999999999999;
	$nowAim = -1;
	foreach($end as $e){
		if(gbsH($now, $e) < $dis){
			$dis = gbsH($now, $e);
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

?>