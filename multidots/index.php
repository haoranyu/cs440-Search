<?php
include("config.php");
include("load_maze.php");
include("function.php");

if(isset($_GET['dfs'])){
	include("function.dfs.php");
	$maze = dfs($maze, $start, $aimCount);
}
elseif(isset($_GET['bfs'])){
	include("function.bfs.php");
	$maze = bfs($maze, $start, $aimCount);
}
elseif(isset($_GET['gbs'])){
	include("function.gbs.php");
	$maze = gbs($maze, $start, $end, $aimCount);
}
elseif(isset($_GET['ass'])){
	include("function.ass.php");
	$maze = ass($maze, $start, $end, $aimCount);
}

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
