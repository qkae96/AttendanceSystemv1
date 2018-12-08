<?php
require_once('defines.php');
session_start();

// connect to database
	$db = connectTo();

// variable declaration
	$username = "";
	$email    = "";
	$errors   = array();

// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}
// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("../login.php");
	}

// REGISTER USER
function register(){
  global $db, $errors;
  // receive all input values from the form
  $username    =  e($_POST['Username']);
	$email       =  e($_POST['Email']);
	$password_1  =  e($_POST['Password_1']);
	$password_2  =  e($_POST['Password_2']);
	$name  =  e($_POST['Name']);
	$phone  =  e($_POST['PhoneNo']);
	$matric  =  e($_POST['MatricNo']);
	$tagid  =  e($_POST['TagID']);
  // form validation: ensure that the form is correctly filled
  if (empty($username)){
    array_push($errors, "Username is required");
  }if(empty($email)){
    array_push($errors, "Email is required");
  }if(empty($password_1)){
    array_push($errors, "Password is required");
  }if($password_1 != $password_2){
    array_push($errors, "The password do not match");
  }
  // first check the database to make sure
	// a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM profile WHERE Username='$username' OR Email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if($user){ // if user exists
    if($user['Username'] === $username){
      array_push($errors, "Username already exists");
    }if($user['Email'] === $email){
      array_push($errors, "Email already exists");
    }
  }
  // register user if there are no errors in the form
  if(count($errors) == 0){
    $password = ($password_1);//encrypt the password before saving in the database
    if(isset($_POST['ProfileType'])){
      $account = e($_POST['ProfileType']);
			$query = "INSERT INTO profile (Name, MatricNo, TagID, ProfileType, Email, PhoneNo, Username, Password) VALUES ('$name', '$matric', '$tagid', '$account', '$email', '$phone', '$username', '$password')";
      mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: index.php');
    }else{
      $query = "INSERT INTO profile (Name, MatricNo, TagID, ProfileType, Email, PhoneNo, Username, Password) VALUES ('$name', '$matric', '$tagid', 'user', '$email', '$phone', '$username', '$password')";
      mysqli_query($db, $query);
      // get id of the created user
      $logged_in_user_id = mysqli_insert_id($db);
      $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
      $_SESSION['success']  = "You are now logged in";
      header('location: index.php');
    }
  }
}

// LOGIN USER
function login(){
  global $db, $username, $errors;
  // grap form values
  $username = e($_POST['username']);
  $password = e($_POST['password']);

  // make sure form is filled properly
  if(empty($username)){
    array_push($errors, "Username is required");
  }if(empty($password)){
    array_push($errors, "Password is required");
  }
  // attempt login if no errors on form
  if(count($errors) == 0){
    $password = ($password);
    $query = "SELECT * FROM profile WHERE Username='$username' AND Password='$password' LIMIT 1";
    $results = mysqli_query($db, $query);
    if(mysqli_num_rows($results) == 1){ // user found
      // check if user is admin or user
      $logged_in_user = mysqli_fetch_assoc($results);
      if($logged_in_user['ProfileType'] == 'admin'){
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: ../admin/index.php');
      }else if($logged_in_user['ProfileType'] == 'lecturer'){
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: ../lecturer/index.php');
      }else{
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: user.php');
      }
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

function isAdmin(){
  if(isset($_SESSION['user']) && $_SESSION['user']['ProfileType'] == 'admin' ){
    return true;
  }else{
    return false;
  }
}

// escape string
function e($val){
  global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error(){
  global $errors;
  if(count($errors) > 0){
    echo '<div class="error">';
    foreach ($errors as $error){
      echo $error .'<br>';
    }
    echo '</div>';
  }
}

// return user array from their id
function getUserById($ProfileID){
  global $db;
  $query = "SELECT * FROM profile WHERE ProfileID=".$ProfileID;
  $result = mysqli_query($db, $query);
  $user = mysqli_fetch_assoc($result);
  return $user;
}

function isLoggedIn(){
  if (isset($_SESSION['user'])){
    return true;
    }else{
      return false;
    }
  }

class Event
{
  private $EventID;
  private $EventName;
  private $EventDate;
  private $EventStartTime;
  private $EventEndTime;
  private $EventVenue;
  private $EventClockOut;
  private $EventDescription;
  private $RepeatEvent;
  private $EndRepeat;
  private $ProfileID;
  private $EventCode;
}

 ?>
