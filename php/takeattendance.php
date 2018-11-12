<!DOCTYPE html>
<?php include 'getevent.php'; ?>
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
        <a class="navbar-brand" href="/AttendanceSystemv1/index.php">Attendance System v1</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/AttendanceSystemv1/event.php">Event</a></li>
          <li><a href="/AttendanceSystemv1/attendance.php">Attendance</a></li>
          <li><a href="/AttendanceSystemv1/profile.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>
  <p></p>


<?php
  $inputEventID = $_GET['evtID'];
  ?>


  <div class="container" id="inputContainer">
    <form class="form-inline" name="attendanceform" id="attendanceform" onsubmit="return checkInput()" method="post" action="/AttendanceSystemv1/php/attendanceform.php" autocomplete="off" autofocus>
      <div hidden>
        <label for="eventID">Event ID:</label>
        <input type="text" class="form-control" id="EventID" name="EventID" value="<?=$inputEventID?>">
      </div>
      <div class="form-group">
        <label for="inputLabel">Input:</label>
        <input type="text" class="form-control" name="TagID" placeholder="Scan card" maxlength="10" autofocus>
        <button type="submit" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-danger" onclick="discardAttendance()">Discard</button>
      </div>
    </form>
  </div>

  <br>

<?php
  $conn = connectTo();
  $sql="SELECT attendance.AttendanceID, attendance.CheckIn, attendance.TagID, profile.Name, profile.MatricNo FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID WHERE attendance.EventID = $inputEventID";

  $result = mysqli_query($conn,$sql);
  ?>
  <table class="table table-striped" id="currentAttendance">
  <tr>
  <th>No</th>
  <th>CheckIn</th>
  <th>TagID</th>
  <th>Name</th>
  <th>Matric No</th>
  </tr>
<?php
  while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['AttendanceID'] . "</td>";
      echo "<td>" . $row['CheckIn'] . "</td>";
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
</body>
</html>
