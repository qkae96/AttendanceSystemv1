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
  #eventTable{
    width:90%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  th{
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

  #currentAttendance{
    counter-reset: rowNumber;
  }

  #currentAttendance tr > td:first-child{
    counter-increment: rowNumber;
  }

  #currentAttendance tr td:first-child::before{
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
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

  <br>

  <div>
  <table class="table table-striped" id="eventTable" style="cursor: pointer;">
    <thead>
      <tr>
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

<?php
  $conn = connectTo();
  $sql="SELECT attendance.AttendanceID, attendance.CheckIn, attendance.TagID, profile.Name, profile.MatricNo FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID WHERE attendance.EventID = $inputEventID";

  $result = mysqli_query($conn,$sql);
  ?>
  <table class="table table-striped" id="currentAttendance">
  <tr>
  <th>No</th>
  <th hidden>AttendanceID</th>
  <th>CheckIn</th>
  <th>TagID</th>
  <th>Name</th>
  <th>Matric No</th>
  </tr>
<?php
  while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";?>
        <td></td>
        <?php
      echo "<td hidden>" . $row['AttendanceID'] . "</td>";
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
