<?php
include("config.php");
include("load_maze.php");
include("function.php");

if(isset($_GET['dfs'])){
	include("function.dfs.php");
	$maze = dfs($maze, $start);
}
elseif(isset($_GET['bfs'])){
	include("function.bfs.php");
	$maze = bfs($maze, $start);
}
elseif(isset($_GET['gbs'])){
	include("function.gbs.php");
	$maze = gbs($maze, $start, $end);
}
elseif(isset($_GET['ucs'])){
	include("function.ucs.php");
	$maze = ucs($maze, $start);
}
else{
	include("function.ass.php");
	$maze = ass($maze, $start, $end);
}

if($maze == -1){
	exit("Cannot find a solution");
}
$maze[0] = drawSolution($maze[0], $end, $start);
printMaze($maze[0],$mazeW,$mazeH);

echo "Path cost: ".$maze[1]."\n";
echo "Number of nodes expanded: ".$maze[2]."\n";
echo "Maximum size of the frontier: ".$maze[3]."\n";
echo "Maximum tree depth searched: ".$maze[4];
?>
