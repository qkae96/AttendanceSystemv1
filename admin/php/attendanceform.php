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

$checkduplicate = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID' AND CheckIn IS NOT NULL";

$duplicatequery = mysqli_query($conn,$checkduplicate);

$count = mysqli_num_rows($duplicatequery);

// Find null checkin
$checknullcheckin = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID' AND CheckIn IS NULL AND CheckOut IS NULL";

$nullcheckinquery = mysqli_query($conn,$checknullcheckin);

$checkincount = mysqli_num_rows($nullcheckinquery);

// Find null CheckOut
$checknullcheckout = "SELECT * FROM attendance WHERE EventID = '$inputEventID' AND TagID = '$inputTagID' AND CheckIn >= '$timeStampStart' AND CheckOut IS NULL";

$nullcheckoutquery = mysqli_query($conn,$checknullcheckout);

$checkoutcount = mysqli_num_rows($nullcheckoutquery);

// Working algo
// if ($count>0) {
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


	if ($checkincount>0) {
		$sqlcheckin = "UPDATE attendance SET Status = 'CheckedIn', CheckOut = NULL, CheckIn = CURRENT_TIMESTAMP WHERE EventID = '$inputEventID' AND TagID = '$inputTagID'";
		if ($conn->query($sqlcheckin) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		echo "<script>
	          alert('Check In Done');
	        </script>";
	}elseif ($checkoutcount>0) {
		$sqlcheckout = "UPDATE attendance SET Status = 'CheckedOut', CheckOut = CURRENT_TIMESTAMP WHERE EventID = '$inputEventID' AND TagID = '$inputTagID'";
		if ($conn->query($sqlcheckout) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		echo "<script>
	          alert('Check Out Done');
	        </script>";
	}elseif ($count>0) {
		echo "<script>
						alert('Record already exists.');
					</script>";
	}else {
	$sql = "INSERT INTO attendance (TagID, EventID, CheckIn, Status) VALUES ('$inputTagID','$inputEventID',CURRENT_TIMESTAMP,'CheckedIn')";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	echo "<script>
					alert('Welcome newcomers.');
				</script>";
}

$conn->close();
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
