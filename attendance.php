<!DOCTYPE html>
<?php include 'php/getevent.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jscript.js"></script>
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
        <a class="navbar-brand" href="index.php">Attendance System v1</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="event.php">Event</a></li>
          <li class="active"><a href="attendance.php">Attendance</a></li>
          <li><a href="profile.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>
  <p></p>

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
          <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</p>
        </div>
      </div>
    </footer>
</body>
</html>
