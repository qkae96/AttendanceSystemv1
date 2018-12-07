<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

$inputEventID = $_POST["EventID"];
$inputTagID = $_POST["TagID"];
$inputStartTime = $_POST["startTime"];
$inputEndTime = $_POST["endTime"];
$inputDate = $_POST["date"];
$dateTimeFormatStart = $inputDate." ".$inputStartTime;
$dateTimeFormatEnd = $inputDate." ".$inputEndTime;
$timeStampStart = strtotime($dateTimeFormatStart);
$timeStampEnd = strtotime($dateTimeFormatEnd);

// Find duplicate
// $checkduplicate = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID' AND CheckIn >= '$timeStampStart' AND CheckOut <= '$timeStampEnd'";

$checkduplicate = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID'";

$duplicatequery = mysqli_query($conn,$checkduplicate);

$count = mysqli_num_rows($duplicatequery);

// Find null checkin
// $checknullcheckin = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID' AND CheckIn = null AND CheckOut = null";
//
// $nullcheckinquery = mysqli_query($conn,$checknullcheckin);
//
// $checkincount = mysqli_num_rows($nullcheckinquery);

// Find null CheckOut
// $checknullcheckout = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID' AND CheckIn >= '$timeStampStart' AND CheckOut = null";
//
// $nullcheckoutquery = mysqli_query($conn,$checknullcheckout);
//
// $checkoutcount = mysqli_num_rows($nullcheckoutquery);

if ($count>0) {
	echo "<script>
					alert('Record already exists.');
				</script>";
}else {
	$sql = "INSERT INTO attendance (TagID, EventID) VALUES ('$inputTagID','$inputEventID')";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	echo "<script>
					alert('Welcome newcomers.');
				</script>";
}


// if ($count>0) {
// 	if ($checkincount>0) {
// 		$sqlcheckin = "INSERT INTO attendance.CheckIn VALUES NOW()";
// 		echo "<script>
// 	          alert('Check In Done');
// 	        </script>";
// 	}elseif ($checkoutcount>0) {
// 		$sqlcheckout = "INSERT INTO attendance.CheckOut VALUES NOW()";
// 		echo "<script>
// 	          alert('Check Out Done');
// 	        </script>";
// 	}
// 	echo "<script>
// 					alert('Record already exists.');
// 				</script>";
// }else {
// 	$sql = "INSERT INTO attendance (TagID, EventID) VALUES ('$inputTagID','$inputEventID')";
// 	if ($conn->query($sql) === TRUE) {
// 	    echo "New record created successfully";
// 	} else {
// 	    echo "Error: " . $sql . "<br>" . $conn->error;
// 	}
// 	echo "<script>
// 					alert('Welcome newcomers.');
// 				</script>";
// }

$conn->close();
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
