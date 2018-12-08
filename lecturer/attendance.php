<!DOCTYPE html>
<?php
include '../lecturer/php/getevent.php';
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
  <link rel="stylesheet" href="/AttendanceSystemv1/css/style.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap-theme.min.css">
  <script src="/AttendanceSystemv1/js/jquery.min.js"></script>
  <script src="/AttendanceSystemv1/js/bootstrap.min.js"></script>
  <script src="/AttendanceSystemv1/js/jscript.js"></script>
  <title>Attendance</title>
  <style>
  #attendanceTable{
    width:90%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  th,p{
    text-align: center;
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
				<a class="navbar-brand" href="/AttendanceSystemv1/lecturer/index.php">Attendance System v1</a>
			</div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
					<li><a href="/AttendanceSystemv1/lecturer/event.php">Event</a></li>
          <li class="active"><a href="/AttendanceSystemv1/lecturer/attendance.php">Attendance</a></li>
          <li><a href="/AttendanceSystemv1/lecturer/profile.php">Profile</a></li>
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
	        <form class="modal-body" id="logoutform" method="post" action="/AttendanceSystemv1/lecturer/index.php?logout='1'">
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

  <div>
    <p>Available Attendance</p>
  <table class="table table-striped" id="attendanceTable" style="cursor: pointer;">
    <thead>
      <tr>
        <th class="EventID">Event ID</th>
        <th class="EventCode">Event Code</th>
        <th class="EventName">Event Name</th>
        <th class="EventDate">Event Date</th>
        <th class="EventStartTime">Event Start Time</th>
        <th class="EventEndTime">Event End Time</th>
        <th class="EventVenue">Venue</th>
        <th class="Action" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $Event = new Event;
      $conn = connectTo();
      $sql="SELECT DISTINCT attendance.EventID, event.EventName, event.EventCode, event.EventDate, event.EventStartTime, event.EventEndTime, event.EventVenue FROM attendance LEFT JOIN event ON attendance.EventID = event.EventID";
      $result = mysqli_query($conn,$sql);

      while($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td id="tableEventID"><?php echo $row['EventID'] ?></td>
            <?php
            echo "<td>" . $row['EventCode'] . "</td>";
            echo "<td>" . $row['EventName'] . "</td>";
            echo "<td>" . $row['EventDate'] . "</td>";
            echo "<td>" . $row['EventStartTime'] . "</td>";
            echo "<td>" . $row['EventEndTime'] . "</td>";
            echo "<td>" . $row['EventVenue'] . "</td>";
            ?>
            <td><button class=btn-success name=attendance type=button onclick="viewAttendanceFromAttendance()"> View </button></td>
            <td><button class=btn-danger name=deleteEvent type=button onclick="deleteAttendanceFromAttendance()" data-toggle="modal" data-target="#deleteAttendance"> Delete </button></td>
          </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
  </div>

  <form id="getAttendanceEventID" method="post">
    <div hidden>
      <label>Event ID: </label>
      <input type="text" name="viewAttendanceEventID" id="viewAttendanceEventID" disabled>
    </div>
  </form>

  <!-- Delete Modal -->
    <div class="modal fade" id="deleteAttendance" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Attendance</h4>
          </div>
          <form class="modal-body" id="modalDeleteAttendance" method="post" action="php/deleteattendance.php">
            <div hidden>
              <label>Event ID: </label>
              <input type="text" name="deleteAttendanceEventID" id="deleteAttendanceEventID" disabled>
            </div>
            <p>Are you sure to delete this attendance?</p>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default" onclick="confirmDeleteAttendance()">Yes</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer id="page-footer">
      <div id="footer">
        <div class="footer-bootom">
          <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</a></p>
        </div>
      </div>
    </footer>
</body>
</html>
