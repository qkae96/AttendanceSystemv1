<?php
include 'getevent.php';
if(!isAdmin()){
	$_SESSION['msg'] = "You must log in first";
}if(isset($_GET['logout'])){
	session_destroy();
  unset($_SESSION['user']);
  header("location: ../index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/style.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap-theme.min.css">
  <script src="/AttendanceSystemv1/js/jquery.min.js"></script>
  <script src="/AttendanceSystemv1/js/bootstrap.min.js"></script>
  <script src="/AttendanceSystemv1/js/jscript.js"></script>
  <title>Profile</title>
    <style>
  body{
    margin: auto;
    text-align: center;
  }
  th{
    text-align: center;
  }
div.relative {
  position: relative;
  right: 10;
  width: 400px;
  height: 200px;
} 

div.absolute {
  position: absolute;
  top: 50px;
  right: 0;
  width: 200px;
  height: 100px;
}

  #footer{
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
    background: #D3D3D3;
  }
  button[name=click_btn] {
        background: #003366;
    }
    button[name=logout_btn] {
            background: #FF6347;
        }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle = "collapsed" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/AttendanceSystemv1/admin/index.php">Attendance System v1</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/AttendanceSystemv1/admin/event.php">Event</a></li>
          <li><a href="/AttendanceSystemv1/admin/attendance.php">Attendance</a></li>
          <li class="active"><a href="/AttendanceSystemv1/admin/profile.php">Profile</a></li>
          <li><a href="#" data-toggle="modal" data-target="#logout-modal">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

	<!-- Logout Modal -->
	  <div class="modal fade" id="logout-modal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Logout</h4>
	        </div>
	        <form class="modal-body" id="logoutform" method="post" action="/AttendanceSystemv1/admin/index.php?logout='1'">
	          <div hidden>
	            <label>Event ID: </label>
	            <input type="text" name="logout" id="logout" value="1" disabled>
	          </div>
	          <p>You are logging out?</p>
	          <div class="modal-footer">
	            <button type="submit" class="btn btn-default">Yes</button>
	            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	          </div>
	        </form>
	      </div>
	    </div>
	  </div>


  </div>
<?php
/*function admin_import() {

  if (isset($_REQUEST['upload'])) {
    $ok = true;
    $file = $_FILES['csv_file']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == NULL) {
      error(_('Please select a file to import'));
      redirect(page_link_to('admin_export'));
    }
    else {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          $nick_name = $filesop[0];
          $first_name = $filesop[1];
          $last_name = $filesop[2];
          $email = $filesop[3];
          $age = $filesop[4];
          $current_city = $filesop[5];
          $password = $filesop[6];
          $mobile = $filesop[7];
// example error handling. We can add more as required for the database.

        if ( strlen($email) && preg_match("/^[a-z0-9._+-]{1,64}@(?:[a-z0-9-]{1,63}\.){1,125}[a-z]{2,63}$/", $mail) > 0) {
          if (! check_email($email)) {
            $ok = false;
            $msg .= error(_("E-mail address is not correct."), true);
          }
        }
// error handling for password        
        if (strlen($password) >= MIN_PASSWORD_LENGTH) {
            $ok = true;
          } else {
            $ok = false;
            $msg .= error(sprintf(_("Your password is too short (please use at least %s characters)."), MIN_PASSWORD_LENGTH), true);
        }
 // If the tests pass we can insert it into the database.       
        if ($ok) {
          $sql = sql_query("
            INSERT INTO `User` SET
            `Nick Name`='" . sql_escape($nick_name) . "',
            `First Name`='" . sql_escape($first_name) . "',
            `Last Name`='" . sql_escape($last_name) . "',
            `email`='" . sql_escape($email) . "',
            `Age`='" . sql_escape($age) . "',
            `current_city`='" . sql_escape($current_city) . "',
            `Password`='" . sql_escape($password) . "',
             `mobile`='" . sql_escape($mobile) . "',");
        }
      }

      if ($sql) {
        success(_("You database has imported successfully!"));
        redirect(page_link_to('admin_export'));
      } else {
        error(_('Sorry! There is some problem in the import file.'));
        redirect(page_link_to('admin_export'));
        }
    }
  }
//form_submit($name, $label) Renders the submit button of a form
//form_file($name, $label) Renders a form file box

 return page_with_title("Import Data", array(
   msg(),
  div('row', array(
          div('col-md-12', array(
              form(array(
                form_file('csv_file', _("Import user data from a csv file")),
                form_submit('upload', _("Import"))
              ))
          ))
      ))
  ));
}*/
if(isset($_POST["Import"]))
{
    //First we need to make a connection with the database
    $conn = connectTo();
    //this is for when you want to delete entire table everytime you upload the CSV file
    //$deleterecords = "TRUNCATE TABLE user";
    //mysqli_query($conn,$deleterecords);

    $filename = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM prod_list_1 ";
        while (($emapData = fgetcsv($file, 100000, ",", "'")) !== FALSE)
        {
            //print_r($emapData);
            //exit();
            $sql = "INSERT into profile(Name, MatricNo, TagID, ProfileType, Email, PhoneNo, Username, Password) values ('".($emapData[0])."','".$emapData[1]."','".$emapData[2]."','".$emapData[3]."','".$emapData[4]."','".$emapData[5]."','".$emapData[6]."','".$emapData[7]."')";
            //$sql = "INSERT into user(Name, Age, Email) values ('".$emapData[0]."','".$emapData[1]."','".$emapData[2]."')";
            $result = mysqli_query($conn,$sql);
        }
        fclose($file);
        $message1="CSV File has been successfully Imported";
        echo "<script type='text/javascript'>alert('$message1');</script>";
        //header('Location: ../admin/profile.php');
    }
    else{
    	$message2="Invalid File:Please Upload CSV File";
        echo "<script type='text/javascript'>alert('$message2');</script>";
    }
}
?>
<form enctype="multipart/form-data" method="post" role="form">
    <div class="relative">
        <!--<label for="exampleInputFile">File Upload</label>-->
        <div class="absolute">
        	<h4>File Upload</h4>
        <input type="file" name="file" id="file" >
    
        <p class="help-block">Only Excel/CSV File Import.</p>

    <button type="submit" class="btn btn-default" name="Import" value="Import">Upload</button>
		</div>
	</div>
</form>
	<!--<div class="form-group" >
          <h2> Import Excel File Data to MYSQL</h2>
          <h4>Please selecet .csv file to be uploaded</h4>

          <label for="inputLabel">Name:</label>
        <input type="text" class="form-control" name="name" id="searchinput" placeholder="Search here" onkeyup="showResult()" autofocus>
        <button type="button" class="btn btn-default" onclick="myFunction()">Print!</button>
        <button type="button" class="btn btn-danger" onclick="goToEvent()">Reset</button>
-->

<footer id="page-footer">
  <div id="footer">
    <div class="footer-bootom">
      <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</a></p>
    </div>
  </div>
</footer>
</body>
</html>