<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

// $inputEventCode = $POST[""];
$inputTagID = $_POST["TagID"];
$sql = "INSERT INTO attendance (TagID) VALUES ('$inputTagID');";

if ($inputTagID == "") {
	echo "Empty value!!! <br>";
} elseif ($conn->multi_query($sql) === TRUE) {
	echo "New records created successfully";
}

$conn->close();
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
