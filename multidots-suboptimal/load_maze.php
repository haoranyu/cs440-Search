<?php
$maze = str_replace("\r","",$maze);
$maze = str_replace("\n\n","",$maze);
$maze = trim($maze);
$maze = explode("\n",$maze);
$mazeW = strlen($maze[0]);
$mazeH = sizeof($maze);
$start = array(0,0);
$end = array();

$hCount = 0;
foreach($maze as &$ml){
	$newArray = array();
	for($i = 0; $i < $mazeW; $i++){
			if("%" == $ml[$i]){
				array_push($newArray,array("X" => $i, "Y" => $hCount, "CONT" => $ml[$i], "STAT" => -1));
			}
			else if("P" == $ml[$i]){
				array_push($newArray,array("X" => $i, "Y" => $hCount, "CONT" => $ml[$i],"STAT" => 1));
			}
			else{
				array_push($newArray,array("X" => $i, "Y" => $hCount, "CONT" => $ml[$i],"STAT" => 0));
			}
			if($ml[$i] == "P"){$start = array("X" => $i, "Y" => $hCount);}
			if($ml[$i] == "."){
				array_push($end, array("X" => $i, "Y" => $hCount));
			}
	}
	$ml = $newArray;
	$hCount++;
}

$aimCount = sizeof($end);

?>