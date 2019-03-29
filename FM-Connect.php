<?php

require "Config.php";

function DBInit($dbadres, $dbuser, $dbpass){
	$dbsrv_descriptor=mysqli_connect($dbadres, $dbuser, $dbpass);
	if($dbsrv_descriptor){
		$dbsrv_status="Не удалось подключиться MySQL серверу!<br>".mysqli_error($dbsrv_descriptor)."<br>";
	} else {	
		$dbsrv_status="Подключение к MySQL серверу успешно.<br>";
	}
	return $dbsrv_descriptor;
}


function DBConn($dbname, $dbdscr){
	$req_res=mysqli_select_db($dbdscr, $dbname);
	if($req_res){     
		return $req_res;
    } else {    
		return $req_res;
    }
}

?>