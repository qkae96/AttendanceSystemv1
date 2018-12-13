<!DOCTYPE html>
<?php
include 'getevent.php';
if(!isLoggedIn()){
	$_SESSION['msg'] = "You must log in first";
}if(isset($_GET['logout'])){
	session_destroy();
  unset($_SESSION['user']);
  header("location: ../index.php");
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/style.css">
  <script src="/AttendanceSystemv1/js/jquery.min.js"></script>
  <script src="/AttendanceSystemv1/js/bootstrap.min.js"></script>
  <script src="/AttendanceSystemv1/js/jscript.js"></script>
  <title>Attendance</title>
  <style>
	#eventTable{
    width:90%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  #currentAttendance{
    width:60%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  td,th{
    text-align: center;
  }

  #inputContainer{
    width: 60%;
    margin: auto;
    padding: inherit;
  }

  table{
    counter-reset: rowNumber;
  }

  table tr > td:first-child{
    counter-increment: rowNumber;
  }

  table tr td:first-child::before{
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
  }

  #footer{
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
    background: #D3D3D3;
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
          <li><a href="/AttendanceSystemv1/admin/profile.php">Profile</a></li>
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

<?php
  $inputEventID = $_GET['evtID'];
  $startTime = $_GET['startTime'];
  $endTime = $_GET['endTime'];
  $date = $_GET['date'];
  ?>

	<div>
  <table class="table table-striped" id="eventTable" style="cursor: pointer;">
    <thead>
      <tr>
				<th hidden>No</th>
        <th class="EventID">Event ID</th>
        <th class="EventCode">Event Code</th>
        <th class="EventName">Event Name</th>
        <th class="EventDate">Event Date</th>
        <th class="EventStartTime">Event Start Time</th>
        <th class="EventEndTime">Event End Time</th>
        <th class="EventVenue">Venue</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $Event = new Event;
      $conn = connectTo();
      $sql="SELECT * FROM event WHERE event.EventID=$inputEventID";
      $result = mysqli_query($conn,$sql);

      while($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
						<td hidden></td>
            <td id="tableEventID"><?php echo $row['EventID'] ?></td>
            <?php
            echo "<td>" . $row['EventCode'] . "</td>";
            echo "<td>" . $row['EventName'] . "</td>";
            echo "<td>" . $row['EventDate'] . "</td>";
            echo "<td>" . $row['EventStartTime'] . "</td>";
            echo "<td>" . $row['EventEndTime'] . "</td>";
            echo "<td>" . $row['EventVenue'] . "</td>";
            ?>
          </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
  </div>

	<br>

  <div class="container" id="inputContainer">
    <form class="form-inline" name="attendanceform" id="attendanceform" onsubmit="return checkInput()" method="post" action="../php/attendanceform.php" autocomplete="off" autofocus>
      <div hidden>
        <label for="eventID">Event ID:</label>
        <input type="text" class="form-control" id="EventID" name="EventID" value="<?=$inputEventID?>">
        <label for="startTime">Event Start Time:</label>
        <input type="time" class="form-control" id="startTime" name="startTime" value="<?=$startTime?>">
        <label for="endTime">Event End Time:</label>
        <input type="time" class="form-control" id="endTime" name="endTime" value="<?=$endTime?>">
        <label for="date">Event Date:</label>
        <input type="date" class="form-control" id="date" name="date" value="<?=$date?>">
      </div>
      <div class="form-group">
        <label for="inputLabel">Input:</label>
        <input type="text" class="form-control" name="TagID" id="tagID" placeholder="Scan card" maxlength="10" autofocus>
        <button type="submit" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-danger" onclick="discardAttendance()">Discard</button>
      </div>
    </form>
  </div>

  <br>

<?php
  $conn = connectTo();
  $sql="SELECT attendance.AttendanceID, attendance.CheckIn, attendance.CheckOut, attendance.TagID, profile.Name, profile.MatricNo, profile.ProfileID FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID WHERE attendance.EventID = $inputEventID";

  $result = mysqli_query($conn,$sql);
  ?>
  <table class="table table-striped" id="currentAttendance">
  <tr>
  <th>No</th>
  <th hidden>AttendanceID</th>
  <th hidden>ProfileID</th>
  <th>CheckIn</th>
  <th>CheckOut</th>
  <th>TagID</th>
  <th>Name</th>
  <th>Matric No</th>
  </tr>
<?php
  while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      ?>
      <td></td>
      <?php
      echo "<td hidden>" . $row['AttendanceID'] . "</td>";
      echo "<td hidden>" . $row['ProfileID'] . "</td>";
      echo "<td>" . $row['CheckIn'] . "</td>";
      echo "<td>" . $row['CheckOut'] . "</td>";
      echo "<td>" . $row['TagID'] . "</td>";
      echo "<td>" . $row['Name'] . "</td>";
      echo "<td>" . $row['MatricNo'] . "</td>";
      echo "</tr>";
  }
  ?>
  </table>
<?php
  mysqli_close($conn);
  ?>
  <footer id="page-footer">
    <div id="footer">
      <div class="footer-bootom">
        <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</p>
      </div>
    </div>
  </footer>
</body>
</html>
