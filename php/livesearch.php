<?php
require_once('defines.php');
// Connecting to the MySQL server
$conn = connectTo();

//get the q parameter from URL
$q=$_GET["q"];

$hint = "";

$sql = "SELECT Name FROM profile";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($row as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// // Output "no suggestion" if no hint was found or output correct values
// echo $hint === "" ? "no suggestion" : $hint;

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
