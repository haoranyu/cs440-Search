<?php
function printMaze($maze,$w,$h){
	for($i = 0; $i < $h; $i++){
		for($j = 0; $j < $w; $j++){
			echo $maze[$i][$j]['CONT'];
		}
		echo "\n";
	}
}
function i2l($int){
	$letter = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	return $letter[$int];
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