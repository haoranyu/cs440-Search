<?php 
function gbsH($now, $end){
	$v1 = array($now['X'],$now['Y']);
	$v2 = array($end['X'],$end['Y']);
	return manhattanDis($v1,$v2);
}
function gbs($maze, $start, $end){
	$pqueue = array(array($maze[$start['Y']][$start['X']],'x','x',"dis" => gbsH($start, $end)));
	$maze[$start['Y']][$start['X']]["STAT"] = 1;
	$maze = gbs_helper($maze, $pqueue, $end);
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

function gbs_helper($maze, $pqueue, $end){
	$pqueue = array_uppri($pqueue);
	$now = array_shift($pqueue);

	$maze[$now[0]['Y']][$now[0]['X']]["PREV"] = array($now[1],$now[2]);
	if($maze[$now[0]['Y']][$now[0]['X']]["CONT"] == "."){
		return $maze;
	}
	else{
		if($maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']+1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']+1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => gbsH(array("X" => $now[0]['X']+1, "Y" => $now[0]['Y']), $end)
									  ));
		}
		if($maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']+1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']+1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']+1), $end)
									  ));
		}
		if($maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] == 0){
			$maze[$now[0]['Y']][$now[0]['X']-1]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']][$now[0]['X']-1],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => gbsH(array("X" => $now[0]['X']-1, "Y" => $now[0]['Y']), $end)
									  ));
		}
		if($maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] == 0){
			$maze[$now[0]['Y']-1][$now[0]['X']]["STAT"] = 1;
			array_push($pqueue, array(	$maze[$now[0]['Y']-1][$now[0]['X']],
										$now[0]['X'],
										$now[0]['Y'],
										"dis" => gbsH(array("X" => $now[0]['X'], "Y" => $now[0]['Y']-1), $end)
									  ));
		}
		return gbs_helper($maze, $pqueue, $end);
	}
}

?>