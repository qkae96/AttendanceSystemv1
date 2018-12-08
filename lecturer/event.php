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
  <title>Event</title>
  <style>
  #eventTable{
    width:90%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  th{
    text-align: center;
  }

  #addEventButton{
    float: right;
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
				<a class="navbar-brand" href="/AttendanceSystemv1/lecturer/index.php">Attendance System v1</a>
			</div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="/AttendanceSystemv1/lecturer/event.php">Event</a></li>
          <li><a href="/AttendanceSystemv1/lecturer/attendance.php">Attendance</a></li>
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

  <div style="width: 8%;">
    <button type="button" class="btn btn-outline-primary" id="addEventButton" onclick="addEvent()">+</button>
  </div>

  <div>
  <table class="table table-striped" id="eventTable" style="cursor: pointer;">
    <thead>
      <tr>
        <th class="No">No</th>
        <th class="EventID" hidden>Event ID</th>
        <th class="EventCode">Event Code</th>
        <th class="EventName">Event Name</th>
        <th class="EventDate">Event Date</th>
        <th class="EventStartTime">Event Start Time</th>
        <th class="EventEndTime">Event End Time</th>
        <th class="EventVenue">Venue</th>
        <th class="Action" colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $Event = new Event;
      $conn = connectTo();
  		$sql="SELECT * FROM event";
  		$result = mysqli_query($conn,$sql);

  		while($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td></td>
    		    <td id="tableEventID" hidden><?php echo $row['EventID'] ?></td>
            <?php
    		    echo "<td>" . $row['EventCode'] . "</td>";
    		    echo "<td>" . $row['EventName'] . "</td>";
    		    echo "<td>" . $row['EventDate'] . "</td>";
    		    echo "<td>" . $row['EventStartTime'] . "</td>";
    		    echo "<td>" . $row['EventEndTime'] . "</td>";
    		    echo "<td>" . $row['EventVenue'] . "</td>";
            ?>
            <td><button class=btn-primary name=updateEvent type=button onclick="updateEvent()" data-toggle="modal" data-target="#updateEvent"> Update </button></td>
            <td><button class=btn-success name=attendance type=button onclick="attendanceModal()" data-toggle="modal" data-target="#attendance"> Attendance </button></td>
            <td><button class=btn-danger name=deleteEvent type=button onclick="deleteEvent()" data-toggle="modal" data-target="#deleteEvent"> Delete </button></td>
  		    </tr>
          <?php
  			}
      ?>
    </tbody>
  </table>
  </div>

<!-- Update Modal -->
  <div class="modal fade" id="updateEvent" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Event</h4>
        </div>
        <form class="modal-body" id="modalUpdateEvent" method="post" action="php/updateevent.php" onsubmit="return validateEventForm()" autocomplete="off">
          <div hidden>
            <label>Event ID: </label>
            <input type="text" name="modalEventID" id="modalEventID">
          </div>
          <div>
            <label>Event Code: </label>
            <input type="text" name="modalEventCode" id="modalEventCode">
          </div>
          <div>
            <label>Event Name: </label>
            <input type="text" name="modalEventName" id="modalEventName">
          </div>
          <div>
            <label>Event Date: </label>
            <input type="Date" name="modalEventDate" id="modalEventDate">
          </div>
          <div>
            <label>Event Start Time: </label>
            <input type="time" name="modalStartTime" id="modalStartTime">
          </div>
          <div>
            <label>Event End Time: </label>
            <input type="time" name="modalEndTime" id="modalEndTime">
          </div>
          <div>
            <label>Event Veue: </label>
            <input type="text" name="modalEventVenue" id="modalEventVenue">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info" formaction="php/addstudentform.php" formmethod="get">Add Students</button>
            <button type="submit" class="btn btn-default" onclick="saveUpdateEvent()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Delete Modal -->
  <div class="modal fade" id="deleteEvent" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Event</h4>
        </div>
        <form class="modal-body" id="modalDeleteEvent" method="post" action="php/deleteevent.php">
          <div hidden>
            <label>Event ID: </label>
            <input type="text" name="deleteEventID" id="deleteEventID" disabled>
          </div>
          <p>Are you sure to delete this event?</p>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" onclick="confirmDeleteEvent()">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Attendance Modal -->
<div class="modal fade" id="attendance" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Attendance</h4>
      </div>
      <form class="modal-body" id="modalAttendance" method="post" autocomplete="off">
        <div hidden>
          <label>Event ID: </label>
          <input type="text" name="attendanceEventID" id="attendanceEventID" disabled>
        </div>
        <div>
          <label>Event Code: </label>
          <input type="text" name="attendanceEventCode" id="attendanceEventCode" disabled>
        </div>
        <div>
          <label>Event Name: </label>
          <input type="text" name="attendanceEventName" id="attendanceEventName" disabled>
        </div>
        <div>
          <label>Event Date: </label>
          <input type="Date" name="attendanceEventDate" id="attendanceEventDate" disabled>
        </div>
        <div>
          <label>Event Start Time: </label>
          <input type="time" name="attendanceStartTime" id="attendanceStartTime" disabled>
        </div>
        <div>
          <label>Event End Time: </label>
          <input type="time" name="attendanceEndTime" id="attendanceEndTime" disabled>
        </div>
        <div>
          <label>Event Veue: </label>
          <input type="text" name="attendanceEventVenue" id="attendanceEventVenue" disabled>
        </div>
        <div class="modal-footer">
          <button type="button" name="takeattendancebutton" class="btn btn-default" onclick="takeAttendance()">Take Attendance</button>
          <button type="button" name="viewattendancebutton" class="btn btn-default" onclick="viewAttendance()">View Attendance</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
