<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

// Storing form values into PHP variables
$ProfileID = $_POST["modalProfileID"];
$Name = $_POST["modalName"]; // Since method=”post” in the form
$MatricNo = $_POST["modalMatricNo"];
$TagID = $_POST["modalTagID"];
$ProfileType = $_POST["modalProfileType"];
$Email = $_POST["modalEmail"];
$PhoneNo = $_POST["modalPhoneNo"];
$Username = $_POST["modalUsername"];
$Password = $_POST["modalPassword"];

$sql = "UPDATE profile SET ProfileID='$ProfileID', Name='$Name', MatricNo='$MatricNo', TagID='$TagID', ProfileType='$ProfileType', Email='$Email', PhoneNo='$PhoneNo', Username='$Username', Password='$Password', WHERE ProfileID = '$ProfileID'";

if (mysqli_query($conn, $sql)) {
  echo "Recorded";
} else {
  echo "Error";
}

$conn->close();
header('location: '.$_SERVER["HTTP_REFERER"]);
exit;
 ?>