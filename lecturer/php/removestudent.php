<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

$inputTagID = $_GET["tagID"];
$inputEventID = $_GET["evtID"];

$sql = "DELETE FROM attendance WHERE EventID = $inputEventID AND TagID = $inputTagID";

if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: ".mysqli_error($conn);
}

$conn->close();
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
