<?php

function db_connect(){
	//データベース接続
	$server = "127.0.0.1";  
	$userName = "root"; 
	$password = "root0629"; 
	$dbName = "to_do_list";

	$mysqli = new mysqli($server, $userName, $password,$dbName);

	if ($mysqli->connect_error){
		echo $mysqli->connect_error;
		exit();
	}else{
		$mysqli->set_charset("utf8mb4");
	}
	return $mysqli;
}

?>
