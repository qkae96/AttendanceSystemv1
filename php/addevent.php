<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

// Storing form values into PHP variables
$EventCode = $_POST["EventCode"]; // Since method=”post” in the form
$EventName = $_POST["EventName"];
$EventDate = $_POST["EventDate"];
$StartTime = $_POST["EventStartTime"];
$EndTime = $_POST["EventEndTime"];
$Venue = $_POST["EventVenue"];
$RepeatEvent = $_POST["RepeatEvent"];
$EndRepeat = $_POST["EndRepeat"];
$EventClockOut = $_POST["EventClockOut"];
$EventDescription = $_POST["EventDescription"];

$sql = "INSERT INTO event(EventCode, EventName, EventDate, EventStartTime, EventEndTime, EventVenue, RepeatEvent, EndRepeat, EventClockOut, EventDescription) VALUES ('$EventCode', '$EventName', '$EventDate', '$StartTime', '$EndTime', '$Venue', '$RepeatEvent', '$EndRepeat', '$EventClockOut', '$EventDescription')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>
