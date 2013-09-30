<?php
include("config.php");
include("load_maze.php");
include("function.php");

include("function.sub.php");
$maze = sub($maze, $start, $end, $aimCount);

if($maze == -1){
	exit("Cannot find a solution");
}
printMaze($maze[0],$mazeW,$mazeH);

echo "Path cost: ".$maze[1]."\n";
echo "Number of nodes expanded: ".$maze[2]."\n";
/*
echo "Maximum size of the frontier: ".$maze[3]."\n";
echo "Maximum tree depth searched: ".$maze[4];
*/
?>
