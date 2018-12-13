<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

$inputDeleteID = $_POST["deleteAttendanceEventID"];

$sql = "DELETE FROM `attendance` WHERE `EventID` = '$inputDeleteID'";

if(mysqli_query($conn, $sql)){
    echo "Record deleted successfully";
} else{
    echo "Error deleting record:".mysqi_error($conn);
}

$conn->close();
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>
