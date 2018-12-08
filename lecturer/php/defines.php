<?php
DEFINE('servername','127.0.0.1');
DEFINE('username', 'root');
DEFINE('password', '');
DEFINE('dbname', 'attendancesystem');

function connectTo(){
	$conn = mysqli_connect(servername, username, password, dbname);
	return $conn;
}

function sqlReady($input){
	$conn = connectTo();
	$string = mysqli_real_escape_string($conn, $input);
	$conn->close();
	return $string;
}
 ?>
