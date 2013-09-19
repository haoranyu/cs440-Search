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
else{
	include("function.ass.php");
	$maze = ass($maze, $start, $end);
}
$maze = drawSolution($maze, $end, $start);
printMaze($maze,$mazeW,$mazeH);
?>
