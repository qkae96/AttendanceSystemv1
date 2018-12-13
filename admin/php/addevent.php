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

// Find duplicate
$checkduplicate = "SELECT * FROM event WHERE EventCode = '$EventCode' AND EventName = '$EventName' AND EventDate = '$EventDate' AND EventStartTime = '$StartTime' AND EventEndTime = '$EndTime' AND EventVenue = '$Venue'";

$duplicatequery = mysqli_query($conn,$checkduplicate);

$count = mysqli_num_rows($duplicatequery);
if ($count>0) {
  echo "<script>
          alert('The record already exists.');
          window.location.href = '/AttendanceSystemv1/event.php';
        </script>";
  return false;
}else {
  $sql = "INSERT INTO event(EventCode, EventName, EventDate, EventStartTime, EventEndTime, EventVenue, RepeatEvent, EndRepeat, EventClockOut, EventDescription) VALUES ('$EventCode', '$EventName', '$EventDate', '$StartTime', '$EndTime', '$Venue', '$RepeatEvent', '$EndRepeat', '$EventClockOut', '$EventDescription')";
  if ($conn->query($sql) === TRUE) {
      echo "<script>
              alert('New record created successfully.');
              window.location.href = '/AttendanceSystemv1/event.php';
            </script>";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// $sql = "INSERT INTO event(EventCode, EventName, EventDate, EventStartTime, EventEndTime, EventVenue, RepeatEvent, EndRepeat, EventClockOut, EventDescription) VALUES ('$EventCode', '$EventName', '$EventDate', '$StartTime', '$EndTime', '$Venue', '$RepeatEvent', '$EndRepeat', '$EventClockOut', '$EventDescription')";
//
//
// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
$conn->close();
header("Location: ../event.php");
exit;
?>
