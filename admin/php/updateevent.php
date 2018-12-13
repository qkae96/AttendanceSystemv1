<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

// Storing form values into PHP variables
$EventID = $_POST["modalEventID"];
$EventCode = $_POST["modalEventCode"]; // Since method=”post” in the form
$EventName = $_POST["modalEventName"];
$EventDate = $_POST["modalEventDate"];
$StartTime = $_POST["modalStartTime"];
$EndTime = $_POST["modalEndTime"];
$Venue = $_POST["modalEventVenue"];

$sql = "UPDATE event SET EventCode='$EventCode', EventName='$EventName', EventDate='$EventDate', EventStartTime='$StartTime', EventEndTime='$EndTime', EventVenue='$Venue' WHERE EventID = '$EventID'";

if (mysqli_query($conn, $sql)) {
  echo "Recorded";
} else {
  echo "Error";
}

$conn->close();
header('location: '.$_SERVER["HTTP_REFERER"]);
exit;
 ?>
