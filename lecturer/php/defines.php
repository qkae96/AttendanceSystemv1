<?php
DEFINE('servername','127.0.0.1');
DEFINE('username', 'root');
DEFINE('password', 'test123');
DEFINE('dbname', 'login');

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
