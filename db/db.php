<?php 

$host = "localhost"; 
$user = "root";
$pass = ""; 
$db_name = "chat"; 

$con = new mysqli($host,$user,$pass,$db_name);
// to select just the time 
function formatDate($date){
	return date('g:i a', strtotime($date));
}


?>