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

  /* #inputSection{
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  } */

  /* #inputSection-cover{
    width: auto;
  } */
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

  <div class="container" id="inputContainer">
    <form class="form-inline" name="attendanceform" id="attendanceform" onsubmit="return checkInput()" method="post" action="php/attendanceform.php" autocomplete="off" autofocus>
      <div class="form-group">
        <label for="inputLabel">Input:</label>
        <input type="text" class="form-control" name="TagID" placeholder="Scan card" maxlength="10" autofocus>
        <button type="submit" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-danger" name="deleteEvent" onclick="deleteEvent()">Discard</button>
      </div>
    </form>
  </div>

      <!-- <div class="container">
        <form class="form-inline justify-content-center" name="attendanceform" id="attendanceform" onsubmit="return checkInput()" method="post" action="php/attendanceform.php" autocomplete="off" autofocus>
      		<div class="form-group row">
            <div>
              <label for="inputEventCode">Input:</label>
              <input type="text" class="form-control" name="TagID" placeholder="Scan card" maxlength="10" autofocus>
              <div class="form-group row">
                <div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="DiscardLastAttendance.php">Discard</a>
                </div>
              </div>
            </div>
      		</div>
      	</form>
      </div> -->
  <br>

<?php
  $conn = connectTo();
  $sql="SELECT attendance.AttendanceID, attendance.CheckIn, attendance.TagID, profile.Name, profile.MatricNo FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID";

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
