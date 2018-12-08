<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

$inputTagID = $_GET["tagID"];
$inputEventID = $_GET["evtID"];
$inputProfileID = $_GET["profileID"];

// Find duplicate
$checkduplicate = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID'";

$duplicatequery = mysqli_query($conn,$checkduplicate);

$count = mysqli_num_rows($duplicatequery);
if ($count>0) {
  echo "<script>
          alert('The record already exists.');
        </script>";
        header("Location: {$_SERVER['HTTP_REFERER']}");
  return false;
}else {
  $sql = "INSERT INTO attendance(EventID, TagID, ProfileID, Status) VALUES ('$inputEventID', '$inputTagID', '$inputProfileID', 'Registered')";
  if ($conn->query($sql) === TRUE) {
      echo "<script>
              alert('Record added successfully.');
            </script>";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
