<?php
function drawSolution($maze, $p, $start){
	$maze[$p['Y']][$p['X']]["CONT"] = ".";
	if($maze[$p['Y']][$p['X']]['PREV'][0] == $start['X'] && $maze[$p['Y']][$p['X']]['PREV'][1] == $start['Y']){  
		
		return $maze;
	}
	else{
		//echo $maze[$p['Y']][$p['X']]['PREV'][0].",".$maze[$p['Y']][$p['X']]['PREV'][1]."\n";
		return drawSolution($maze, array("X" => $maze[$p['Y']][$p['X']]['PREV'][0], "Y" => $maze[$p['Y']][$p['X']]['PREV'][1]),$start);
	}
}

function printMaze($maze,$w,$h){
	for($i = 0; $i < $h; $i++){
		for($j = 0; $j < $w; $j++){
			echo $maze[$i][$j]['CONT'];
		}
		echo "\n";
	}
}

function minkowskiDis($v1,$v2,$h){
	$sum = 0;
	$size = sizeof($v1);
	for($i = 0; $i < $size; $i++){
		$sum += pow(abs($v1[$i]-$v2[$i]),$h);
	}
	return pow($sum,1/$h);
}

function manhattanDis($v1,$v2){
	return minkowskiDis($v1,$v2,1);
}
?>